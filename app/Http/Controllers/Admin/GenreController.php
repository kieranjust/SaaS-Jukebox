<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::paginate(10);
        return view('admin.genres.index', compact(['genres']))
            ->with("i", (\request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth()->user();
        if($user->hasRole(['astronaut'])){
            return redirect(route('genres.index'));
        }

        $genres = Genre::all();
        return view('admin.genres.create', compact(['genres']));
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
            'name' => ['required', 'string', 'max:64', ],
            'picture' => ['required'],
            'parent_id' => ['nullable']
        ]);

        Genre::create([
            'name' => $request->input('name'),
            'picture' => $request->input('picture'),
            'parent_id' => $request->input('parent_id'),
        ]);
        return redirect(route('genres.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        return view('admin.genres.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        $user = Auth()->user();
        if($user->hasRole(['astronaut'])){
            return redirect(route('genres.index'));
        }

        $all_genres = Genre::all();
        return view('admin.genres.update', compact('genre', 'all_genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $user = Auth()->user();
        if($user->hasRole(['astronaut'])){
            redirect(route('index.genres'));
        }

        $rules = [];
        $rules[] = ['name' => ['required', 'string', 'max:64']];

        if (isset($request['picture']) && !is_null($request->input('picture'))) {
            $rules[] = [
                'picture' => ['required'],
            ];
        }

        if ($request->input('parent_id') !== $genre->parent_id) {
            $rules[] = [
                'parent_id' => ['nullable']
            ];
        }

        foreach ($rules as $rule) {
            $request->validate($rule);
        }


        if ($request->input('name') !== $genre->name) {
            $genre->name = $request->input('name');
        }
        if ($request->input('picture') !== $genre->picture) {
            $genre->picture = $request->input('picture');
        }
        if ($request->input('parent_id') !== $genre->parent_id) {
            $genre->parent_id = $request->input('parent_id');
        }
        $genre->save();
        return redirect(route('genres.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $user = Auth()->user();
        if($user->hasRole(['astronaut'])){
            redirect(route('genres.index'));
        }

        $genre->delete();
        return redirect(route('genres.index'));
    }
}
