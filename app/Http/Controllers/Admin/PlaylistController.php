<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;
use phpDocumentor\Reflection\Types\True_;
use PHPUnit\Framework\Constraint\IsFalse;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userCanEdit(User $user, Playlist $playlist)
    {
        $can = $user->hasRole(["admin"]) ||
            $user->id == $playlist->user->id ||
            $user->hasRole(["manager"]) && $playlist->type == 'Public';

        return $can;
    }

    public function userCanView(User $user, Playlist $playlist){
        $can = True;
        if($playlist->type == "Private") {
            $can = $user->hasRole(["admin"]) ||
                $user->id == $playlist->user->id;
            }
        return $can;
    }

    public function index()
    {
        $user = auth()->user();
        $playlists = null;
        if ($user->can('view-all-playlists')) {
            $playlists = Playlist::paginate(10);

        } elseif ($user->can(['view-public-playlist', 'view-own-playlist'])) {
            $playlists = Playlist::whereUserId($user->id)->orWhere('type', 'Public')->paginate(5);
        } // TODO: Remove this when finished referencing it.
//        else {
//            $playlists = Playlist::whereUserId($user->id)->paginate(5);
//        }
        return view('admin.playlists.index', compact(['playlists','user']))
            ->with("i", (\request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tracks = Track::all();
        $users = User::all();
        $playlists = Playlist::all();
        return view('admin.playlists.create', compact(['playlists', 'users', 'tracks']));
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

        $plist = Playlist::create([
            'name' => $request->input('name'),
            'user_id' => $request->input('owner'),
            'type' => $request->input('type'),
        ]);
        $plist->tracks()->sync($request->tracks);
        return redirect(route('playlists.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Playlist $playlist)
    {
        $user = auth()->user();

        $canEdit = $this->userCanEdit($user, $playlist);
        $canView = $this->userCanView($user, $playlist);
        if(! $canView) {
            return redirect()->action([PlaylistController::class, 'index']);
        }
        return view('admin.playlists.show', compact(['playlist', 'user', 'canEdit', 'canView']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Playlist $playlist)
    {
        $user = auth()->user();

        $canEdit = $this->userCanEdit($user, $playlist);

        if (!$canEdit) {
            return redirect()->action([PlaylistController::class, 'show'], [$playlist]);
        }

        $tracks = Track::all();
        $users = User::all();

        return view('admin.playlists.update', compact(['playlist', 'users', 'tracks', 'canEdit']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Playlist $playlist)
    {
        $rules = [];
        $rules[] = ['name' => ['required', 'string', 'max:64']];


        if ($request->input('owner') !== $playlist->user_id) {
            $rules[] = [
                'owner' => ['required', 'string', 'max:64']
            ];
        }

        foreach ($rules as $rule) {
            $request->validate($rule);
        }


        if ($request->input('name') !== $playlist->name) {
            $playlist->name = $request->input('name');
        }

        if ($request->input('owner') !== $playlist->user_id) {
            $playlist->user_id = $request->input('owner');
        }


        $playlist->save();

        $playlist->tracks()->sync($request->input('tracks'));

        return redirect(route('playlists.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Playlist $playlist)
    {
        $playlist->tracks()->detach();
        $playlist->delete();
        return redirect(route('playlists.index'));
    }
}
