<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Song;
use Illuminate\Http\Request;

class AddSongController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'artist' => 'required|string',
            'album' => 'required|string',
            'category' => 'required|string',
            'tags' => 'array',
            'tags.*' => 'string',
        ]);

        $artist = Artist::firstOrCreate(['name' => $request['artist']]);
        $album = Album::firstOrCreate(['title' => $request['album']]);
        $category = Category::firstOrCreate(['name' => $request['category']]);

        $song = Song::create([
            'title' => $request['title'],
            'artist_id' => $artist->id,
            'album_id' => $album->id,
            'category_id' => $category->id,
        ]);

        $song->attachTags($request['tags']);

        return response()->json($song->id);
    }
}
