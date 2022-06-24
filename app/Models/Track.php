<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'artist',
        'album',
        'genre',
        'track_number',
        'name',
        'length',
        'year',
    ];

    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    public function playlists(){
        return $this->belongsToMany(Playlist::class, PlaylistTracks::class, 'track_id', 'playlist_id');
    }
}
