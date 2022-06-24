<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Genre::all();
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

        $genre = Genre::create([
            'name' => $request->input('name'),
            'picture' => $request->input('picture'),
            'parent_id' => $request->input('parent_id'),
        ]);

        $response = $genre;
        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Genre::find($id);
        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => "Genre not found."
            ], 404);
        }
        if ($genre) {
            return response()->json([
                'success' => true,
                'data' => $genre,
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $genre = Genre::find($request->id);
        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => "Genre not found."
            ], 404);
        }
        $genre->name = $request->name??$genre->name;
        $genre->picture = $request->picture??$genre->picture;
        $genre->parent_id = $request->parent_id??$genre->parent_id;
        $result = $genre->save();
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => "Genre updated.",
                'data' => $genre,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Genre::find($id);
        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => "Genre not found."
            ]);
        }

        $result = $genre->destroy($id);
        if ($result == 1) {
            return response()->json([
                'success' => true,
                'message' => "Genre $id successfully destroyed"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Delete operation has failed."
        ]);

    }
}
