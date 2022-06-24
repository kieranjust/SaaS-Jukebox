<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nette\Schema\ValidationException;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Track::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            ($request->validate([
                    'name' => ['required', 'string', 'max:64',],
                    'artist' => ['required', 'string', 'max:64'],
                    'album' => ['required', 'string', 'max:64',],
                    'genre' => ['required'],
                    'track_number' => ['required', 'max:2'],
                    'year' => ['required', 'max:4', 'integer'],
                    'length' => ['required',]
                ]
            ));

            $track = Track::create([
                'name' => $request->input('name'),
                'artist' => $request->input('artist'),
                'album' => $request->input('album'),
                'genre' => $request->input('genre'),
                'track_number' => $request->input('track_number'),
                'year' => $request->input('year'),
                'length' => $request->input('length'),
            ]);

            $response = $track;
            return response($response, 201);
        }

        catch(\Illuminate\Validation\ValidationException $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->errors()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $track = Track::find($id);
        if (!$track) {
            return response()->json([
                'success' => false,
                'message' => "Track not found."
            ], 404);
        }
        if ($track) {
            return response()->json([
                'success' => true,
                'data' => $track,
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $track = Track::find($request->id);
        if (!$track) {
            return response()->json([
                'success' => false,
                'message' => "Track not found."
            ], 404);
        }
        $track->name = $request->name ?? $track->name;
        $track->artist = $request->artist ?? $track->artist;
        $track->album = $request->album ?? $track->album;
        $track->genre = $request->genre ?? $track->genre;
        $track->track_number = $request->track_number ?? $track->track_number;
        $track->year = $request->year ?? $track->year;
        $track->length = $request->length ?? $track->length;
        $result = $track->save();
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => "Track updated.",
                'data' => $track,
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
     * @return Response
     */
    public function destroy($id)
    {
        $track = Track::find($id);
        if (!$track) {
            return response()->json([
                'success' => false,
                'message' => "Track not found."
            ]);
        }

        $result = $track->destroy($id);
        if ($result == 1) {
            return response()->json([
                'success' => true,
                'message' => "Track $id successfully destroyed"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Delete operation has failed."
        ]);

    }
}
