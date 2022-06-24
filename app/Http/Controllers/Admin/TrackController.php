<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Track;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = Track::paginate(25);
        return view('admin.tracks.index', compact(['tracks']))
            ->with("i", (\request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if($user->hasRole(['astronaut'])){
            return redirect(route('tracks.index'));
        }

        $genres = Genre::all();
        return view('admin.tracks.create', compact(['genres']));
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
            'artist' => ['required', 'string', 'max:64'],
            'album' => ['required', 'string', 'max:64',],
            'genre' => ['required'],
            'track_number' => ['required', 'max:2'],
            'year' => ['required', 'max:4',],
            'length' => ['required', ]
        ]);

        Track::create([
            'name' => $request->input('name'),
            'artist' => $request->input('artist'),
            'album' => $request->input('album'),
            'genre' => $request->input('genre'),
            'track_number' => $request->input('track_number'),
            'year' => $request->input('year'),
            'length' => $request->input('length'),
        ]);
        return redirect(route('tracks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        return view('admin.tracks.show', compact('track'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        $user = auth()->user();
        if($user->hasRole(['astronaut'])){
            return redirect(route('tracks.index'));
        }

        $genres = Genre::all();
        return view('admin.tracks.update', compact(['track', 'genres']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Track $track)
    {
        $user = auth()->user();
        if($user->hasRole(['astronaut'])){
            return redirect(route('tracks.index'));
        }

        $rules = [];
        $rules[] = ['name' => ['required', 'string', 'max:64']];

        if (isset($request['artist']) && !is_null($request->input('artist'))) {
            $rules[] = [
                'artist' => ['required', 'string', 'max:64'],
            ];
        }

        if ($request->input('album') !== $track->album) {
            $rules[] = [
                'album' => ['required', 'string', 'max:64'],
            ];
        }

        if ($request->input('genre')!== $track->genre) {
            $rules[] = [
                'genre' => ['required']
            ];
        }

        if ($request->input('track_number')!== $track->track_number) {
            $rules[] = [
                'track_number' => ['required']
            ];
        }

        if ($request->input('year')!== $track->year) {
            $rules[] = [
                'year' => ['required']
            ];
        }

        if ($request->input('length')!== $track->length) {
            $rules[] = [
                'length' => ['required']
            ];
        }

        foreach ($rules as $rule) {
            $request->validate($rule);
        }


        if ($request->input('name') !== $track->name) {
            $track->name = $request->input('name');
        }
        if ($request->input('artist') !== $track->artist) {
            $track->artist = $request->input('artist');
        }
        if ($request->input('album') !== $track->album) {
            $track->album = $request->input('album');
        }
        if ($request->input('genre') !== $track->genre) {
            $track->genre = $request->input('genre');
        }
        if ($request->input('track_number') !== $track->track_number) {
            $track->track_number = $request->input('track_number');
        }
        if ($request->input('year') !== $track->year) {
            $track->year = $request->input('year');
        }
        if ($request->input('length') !== $track->length) {
            $track->length = $request->input('length');
        }
        $track->save();
        return redirect(route('tracks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track)
    {
        $track->delete();
        return redirect(route('tracks.index'));
    }
}
