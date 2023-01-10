<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
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
            'song_id' => 'required|int|exists:songs,id|unique:media,song_id',
            'song_file' => ['required', 'file', 'mimes:mp3'],
        ]);

        $file = $request->file('song_file');

        $folder = Str::random(40);
        $name = $file->hashName();

        $upload = Storage::disk('public')->put("mp3/{$folder}/", $file);

        $media = Media::create(
            [
                'name' => "{$name}",
                'song_id' => $request['song_id'],
                'file_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
                'path' => "mp3/{$folder}/{$name}",
                'disk' => 'public',
                'size' => $file->getSize(),
            ]
        );

        return response()->json(['success' => true]);
    }
}
