<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function isAdmin(User $user)
    {
        return $user->hasRole(["admin"]);
    }

    public function index()
    {
        $user = auth()->user();
        if($user->hasRole(["admin"])) {
            $users = User::paginate(5);
        }
        elseif($user->hasRole(["manager"]))
        {
            $users = User::where('id', '!=', 1)->paginate(5);
        }
        else{
            $users = User::where('id', $user->id)->paginate(5);
        }
        return view('admin.users.index', compact(['users']))
            ->with("i", (\request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth()->User();
        if($user->hasRole(["astronaut"])) {
            return redirect(route('users.index'));
        }
        $users = User::all();
        return view('admin.users.create', compact(['users']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate( [
            'name' => ['required', 'max:64', ],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->uncompromised(),],
            'email' => ['required', 'email', 'unique:users']
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'email' => $request->input('email'),
        ]);
        $user->assignRole($request->input('role_selector')??'astronaut');
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $auth = Auth()->user();
        if($user->hasRole("admin") && $auth->hasRole("manager"))
        {
            return redirect(route('users.index'));
        }
        elseif($auth->hasRole("astronaut") && $user->id != $auth->id)
        {
            return redirect(route('users.index'));
        }

        $admin = $this->isAdmin($user);
        return view('admin.users.update', compact(['user', 'admin', 'auth']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [];
        $rules[] = ['name' => ['required', 'string', 'max:64']];

        if (isset($request['password']) && !is_null($request->input('password'))) {
            $rules[] = [
                'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->uncompromised()]
            ];
        }

        if ($request->input('email') !== $user->email) {
            $rules[] = [
                'email' => ['required', 'email', 'unique:users']
            ];
        }

        foreach ($rules as $rule) {
            $request->validate($rule);
        }


        if ($request->input('name') !== $user->name) {
            $user->name = $request->input('name');
        }
        if ($request->input('email') !== $user->email) {
            $user->email = $request->input('email');
        }
        if ($request->input('password') !== $user->password) {
            $user->password = Hash::make($request->input('password'));
        }
        if ($this->isAdmin(Auth()->user()) && !$this->isAdmin($user)) {
            $user->syncRoles($request->input('role_selector') ?? 'astronaut');
        }

        $user->save();
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'));
    }
}
