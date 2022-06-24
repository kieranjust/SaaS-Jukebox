<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:64',],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->uncompromised(),],
            'email' => ['required', 'email', 'unique:users']
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'password' => $request->input('password'),
            'email' => $request->input('email'),
        ]);

        $response = $user;
        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => "User not found."
            ], 404);
        }
        if ($user) {
            return response()->json([
                'success' => true,
                'data' => $user,
            ], 200);
        }
    }


/**
 * Update the specified resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public
function update(Request $request, $id)
{
    $user = User::find($request->id);
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => "User not found."
        ], 404);
    }
    $user->name = $request->name ?? $user->name;
    $user->email = $request->email ?? $user->email;
    $user->password = $request->password ?? $user->password;

    try {
        $request->validate([
            'name' => ['max:64',],
            'password' => ['confirmed', Password::min(8)->mixedCase()->uncompromised(),],
            'email' => ['email', 'unique:users']
        ]);

        $user = User::update([
            'name' => $request->input('name'),
            'password' => $request->input('password'),
            'email' => $request->input('email'),
        ]);
    }catch(ValidationException $exception){
        return response()->json([
            'success' => false,
            'message' => $exception->errors(),
        ]);
    }

    $result = $user->save();
    if ($result) {
        return response()->json([
            'success' => true,
            'message' => "User updated.",
            'data' => $user,
        ], 200);
    }
    return response()->json([
        'success' => false,
        'message' => "Update operation has failed."
    ]);
}

/**
 * Remove the specified resource from storage.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public
function destroy($id)
{
    $user = User::find($id);
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => "User not found."
        ]);
    }

    $result = $user->destroy($id);
    if ($result == 1) {
        return response()->json([
            'success' => true,
            'message' => "User $id successfully destroyed"
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => "Delete operation has failed."
    ]);
}
}
