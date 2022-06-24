<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Playlist::all();
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
            'owner' => ['required',],
            'type' => ['required',],
        ]);

        $playlist = Playlist::create([
            'name' => $request->input('name'),
            'user_id' => $request->input('owner'),
            'type' => $request->input('type'),
        ]);

        $response = $playlist;
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
        return Playlist::find($id);
        if (!$playlist) {
            return response()->json([
                'success' => false,
                'message' => "Playlist not found."
            ], 404);
        }
        if ($playlist) {
            return response()->json([
                'success' => true,
                'data' => $playlist,
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
    public function update(Request $request, $id)
    {
        $playlist = Playlist::find($request->id);
        if (!$playlist) {
            return response()->json([
                'success' => false,
                'message' => "Playlist not found."
            ], 404);
        }
        $playlist->name = $request->name ?? $playlist->name;
        $playlist->type = $request->type ?? $playlist->type;
        $playlist->user_id = $request->user_id ?? $playlist->user_id;
        $result = $playlist->save();
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => "Playlist updated.",
                'data' => $playlist,
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
    public function destroy($id)
    {
        $playlist = Playlist::find($id);
        if (!$playlist) {
            return response()->json([
                'success' => false,
                'message' => "Playlist not found."
            ]);
        }

        $result = $playlist->destroy($id);
        if ($result == 1) {
            return response()->json([
                'success' => true,
                'message' => "Playlist $id successfully destroyed"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Delete operation has failed."
        ]);
    }
}
