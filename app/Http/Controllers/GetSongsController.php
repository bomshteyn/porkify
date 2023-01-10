<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Http\Request;

class GetSongsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'page' => 'int',
            'per_page' => 'int',
        ]);

        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $songs = Song::with('artist', 'album', 'category', 'media')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        return SongResource::collection($songs);
    }
}
