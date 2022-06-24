<?php

namespace Database\Seeders;

use App\Models\Playlist;
use Illuminate\Database\Seeder;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedPlaylist = [
            [
                'id' => 1,
                'name' => "Kieran's Playlist",
                'tracks' => [1, 2, 3, 4, 5,],
                'owner' => 5,
                'type' => 'Private',
            ],
            [
                'id' => 2,
                'name' => "Eileen's Playlist",
                'tracks' => [1, 2, 3, 4, 5,],
                'owner' => 10,
                'type' => 'Private',
            ],
            [
                'id' => 3,
                'name' => "Adrian's Playlist",
                'tracks' => [1, 2, 3, 4, 5,],
                'owner' => 6,
                'type' => 'Private',
            ],
            [
                'id' => 4,
                'name' => "Kieran's Public Playlist",
                'tracks' => [1, 2, 3, 4, 5,],
                'owner' => 5,
                'type' => 'Public',
            ],
            [
                'id' => 5,
                'name' => "Eileen's Public Playlist",
                'tracks' => [1, 2, 3, 4, 5,],
                'owner' => 10,
                'type' => 'Public',
            ],
            [
                'id' => 6,
                'name' => "Adrian's Public Playlist",
                'tracks' => [1, 2, 3, 4, 5,],
                'owner' => 6,
                'type' => 'Public',
            ],
        ];


        foreach ($seedPlaylist as $seed){
            $newPlaylistData = [
                'id' => $seed['id'],
                'name' => $seed['name'],
                'type' => $seed['type'],
                'user_id' => $seed['owner'],
            ];

            $newPlaylist = Playlist::create($newPlaylistData);

            $tracks = $seed['tracks'];
            $newPlaylist->tracks()->attach($tracks);
        }
    }

}
