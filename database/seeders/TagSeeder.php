<?php

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tagList = collect([
            'tag1',
            'tag2',
            'tag3',
        ]);

        $tagList->each(function (string $tagName) {
            Tag::create(['name' => $tagName]);
        });

        $tags = Tag::all();

        Song::all()->each(function (Song $song) use ($tags) {
            $song->attachTag($tags->random());
            $song->attachTag($tags->random());
        });
    }
}
