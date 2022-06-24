<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedTracks=[
            ['artist' => 'Jean Michel Jarre', 'album' => 'Oxygène','genre' => 'Electronic','track_number' => '1','name' => 'Oxygène (Part I)','length' => '00:07:39','year' => '1977'],
            ['artist' => 'AllttA', 'album' => 'Facing Giants','genre' => 'Hip Hop','track_number' => '2','name' => 'More Better  (fg. II) [feat. 20syl & Mr. J Medeiros]','length' => '00:02:57','year' => '2017'],
            ['artist' => 'Tangerine Dream', 'album' => 'Rubycon','genre' => 'Electronic','track_number' => '1','name' => 'Rubycon, Part I','length' => '00:17:19','year' => '1975'],
            ['artist' => 'Zutomayo', 'album' => 'Gusare','genre' => 'Jazz','track_number' => '4','name' => 'Hunch Gray','length' => '00:04:10','year' => '2021'],
            ['artist' => 'Apocalyptica', 'album' => 'Inquisition Symphony','genre' => 'Metal','track_number' => '7','name' => 'Inquisition Symphony','length' => '00:04:59','year' => '1998'],
            ['artist' => 'Beck', 'album' => 'Midnight Vultures','genre' => 'Pop','track_number' => '1','name' => 'Nicotine & Gravy','length' => '00:05:13','year' => '1999'],
            ['artist' => 'Beck', 'album' => 'Midnight Vultures','genre' => 'Pop','track_number' => '2','name' => 'Mixed Bizness','length' => '00:04:10','year' => '1999'],
            ['artist' => 'Zutomayo', 'album' => 'Gusare','genre' => 'Jazz','track_number' => '2','name' => 'Can\'t Be Right','length' => '00:04:01','year' => '2021'],
            ['artist' => 'Bryan Adams', 'album' => 'Unplugged','genre' => 'Rock','track_number' => '7','name' => '18 til I die','length' => '00:03:31','year' => '1997'],
            ['artist' => 'Bryan Adams', 'album' => 'Unplugged','genre' => 'Rock','track_number' => '12','name' => 'Heaven','length' => '00:04:31','year' => '1997'],
            ['artist' => 'Dead Can Dance', 'album' => 'Dead Can Dance','genre' => 'Alternative','track_number' => '1','name' => 'Carnival of Light','length' => '00:03:33','year' => '2008'],
            ['artist' => 'Dead Can Dance', 'album' => 'Dead Can Dance','genre' => 'Alternative','track_number' => '2','name' => 'In Power we Entrust the Love Advocated','length' => '00:04:12','year' => '2008'],
            ['artist' => 'Eric Prydz', 'album' => 'Opus','genre' => 'Electronic Dance Music','track_number' => '6','name' => 'Moody Mondays (feat. The Cut)','length' => '00:04:43','year' => '2016'],
            ['artist' => 'Eric Prydz', 'album' => 'Opus','genre' => 'Electronic Dance Music','track_number' => '19','name' => 'Opus','length' => '00:09:04','year' => '2016'],
            ['artist' => 'Jean Michel Jarre', 'album' => 'Oxygène','genre' => 'Electronic','track_number' => '2','name' => 'Oxygène (Part II)','length' => '00:07:49','year' => '1977'],
            ['artist' => 'Jean Michel Jarre', 'album' => 'Oxygène','genre' => 'Electronic','track_number' => '3','name' => 'Oxygène (Part III)','length' => '00:03:16','year' => '1977'],
            ['artist' => 'Bryan Adams', 'album' => 'Unplugged','genre' => 'Rock','track_number' => '11','name' => 'A Little Love','length' => '00:03:23','year' => '1997'],
            ['artist' => 'Apocalyptica', 'album' => 'Shadowmaker','genre' => 'Metal','track_number' => '12','name' => 'Dean Man\'s Eyes','length' => '00:09:43','year' => '2015'],
            ['artist' => 'Lemongrass', 'album' => 'Windows','genre' => 'Easy Listening','track_number' => '2','name' => 'Imagine','length' => '00:04:42','year' => '2001'],
            ['artist' => 'Kate Bush', 'album' => 'The Kick Inside','genre' => 'Alternative','track_number' => '5','name' => 'The Man with the Child in His Eyes','length' => '00:02:41','year' => '1978'],
            ['artist' => 'Matsumoto Zuko', 'album' => 'Matsumoto Zuko','genre' => 'Electronic','track_number' => '2','name' => 'Bologna','length' => '00:02:33','year' => '2014'],
            ['artist' => 'Matsumoto Zuko', 'album' => 'Matsumoto Zuko','genre' => 'Electronic','track_number' => '3','name' => 'Melbourne','length' => '00:03:53','year' => '2014'],
            ['artist' => 'Mike Oldfield', 'album' => 'Amarok','genre' => 'Electronic','track_number' => '1','name' => 'Amarok','length' => '00:01:00','year' => '1990'],
            ['artist' => 'AllttA', 'album' => 'Facing Giants','genre' => 'Hip Hop','track_number' => '3','name' => 'Choo Choo (fg. III) [feat. 20syl & Mr. J Medeiros]','length' => '00:02:35','year' => '2017'],
            ['artist' => 'Tangerine Dream', 'album' => 'Rubycon','genre' => 'Electronic','track_number' => '2','name' => 'Rubycon, Part II','length' => '00:17:35','year' => '1975'],
            ['artist' => 'Tarja Turunen', 'album' => 'My Winter Storm','genre' => 'Metal','track_number' => '2','name' => 'I Walk Alone','length' => '00:03:53','year' => '2007'],
            ['artist' => 'Zutomayo', 'album' => 'Gusare','genre' => 'Jazz','track_number' => '1','name' => 'One\'s Mind','length' => '00:04:19','year' => '2021'],
            ['artist' => 'Beck', 'album' => 'Midnight Vultures','genre' => 'Pop','track_number' => '3','name' => 'Get Real Paid','length' => '00:04:44','year' => '1999'],
            ['artist' => 'Zutomayo', 'album' => 'Gusare','genre' => 'Jazz','track_number' => '3','name' => 'Obenkyou Shitoiteyo','length' => '00:04:39','year' => '2021'],
            ['artist' => 'Epica', 'album' => 'Live Station 4','genre' => 'Metal','track_number' => '2','name' => 'Sensorium','length' => '00:04:56','year' => '2010'],
            ['artist' => 'Kate Bush', 'album' => 'The Kick Inside','genre' => 'Alternative','track_number' => '6','name' => 'Wuthering Heights','length' => '00:04:29','year' => '1978'],
            ['artist' => 'Kate Bush', 'album' => 'Hounds of Love','genre' => 'Alternative','track_number' => '2','name' => 'Hounds of Love','length' => '00:03:03','year' => '1985'],
            ['artist' => 'Dead Can Dance', 'album' => 'Dead Can Dance','genre' => 'Alternative','track_number' => '4','name' => 'Flowers of the Sea','length' => '00:03:27','year' => '2008'],
            ['artist' => 'Kate Bush', 'album' => 'Hounds of Love','genre' => 'Alternative','track_number' => '10','name' => 'Jig of Life','length' => '00:04:04','year' => '1985'],
            ['artist' => 'Kate Bush', 'album' => 'Hounds of Love','genre' => 'Alternative','track_number' => '11','name' => 'Hello Earth','length' => '00:06:13','year' => '1985'],
            ['artist' => 'Dead Can Dance', 'album' => 'Dead Can Dance','genre' => 'Alternative','track_number' => '3','name' => 'The Arcane','length' => '00:03:48','year' => '2008'],
            ['artist' => 'Matsumoto Zuko', 'album' => 'Matsumoto Zuko','genre' => 'Electronic','track_number' => '1','name' => 'Wa','length' => '00:04:30','year' => '2014'],
            ['artist' => 'Jean Michel Jarre', 'album' => 'Oxygène','genre' => 'Electronic','track_number' => '4','name' => 'Oxygène (Part IV)','length' => '00:04:14','year' => '1977'],
            ['artist' => 'AllttA', 'album' => 'Facing Giants','genre' => 'Hip Hop','track_number' => '1','name' => 'Snow Fire (fg. I) [feat. 20syl & Mr. J Medeiros]','length' => '00:04:23','year' => '2017'],
            ['artist' => 'Jean Michel Jarre', 'album' => 'Oxygène','genre' => 'Electronic','track_number' => '5','name' => 'Oxygène (Part V)','length' => '00:10:23','year' => '1977'],
            ['artist' => 'Jean Michel Jarre', 'album' => 'Oxygène','genre' => 'Electronic','track_number' => '6','name' => 'Oxygène (Part VI)','length' => '00:06:20','year' => '1977'],
            ['artist' => 'Lemongrass', 'album' => 'Windows','genre' => 'Easy Listening','track_number' => '1','name' => 'The Well','length' => '00:01:33','year' => '2001'],
        ];
        foreach ($seedTracks as $seedTrack) {
            Track::create($seedTrack);

        }
    }
}
