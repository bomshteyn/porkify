<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SongFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'      => $this->faker->word(),
            'artist_id'   => Artist::factory(),
            'album_id'    => Album::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
