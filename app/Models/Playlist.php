<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'type',
    ];

    public function tracks()
    {
        return $this->belongsToMany(Track::class,'playlist_tracks');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
