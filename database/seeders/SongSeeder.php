<?php

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Album::factory(5)->create();
        \App\Models\Artist::factory(5)->create();
        \App\Models\Category::factory(5)->create();

        Song::factory()
            ->count(100)
            ->sequence(function ($sequence) {
                return [
                    'artist_id' => rand(1, 5),
                    'album_id' => rand(1, 5),
                    'category_id' => rand(1, 5),
                ];
            })->create();
    }
}
