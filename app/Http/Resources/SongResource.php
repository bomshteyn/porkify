<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SongResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $song = [
            'id'       => $this->id,
            'title'    => $this->title,
            'artist'   => $this->artist->name,
            'album'    => $this->album->title,
            'category' => $this->category->name,
            'tags'     => $this->tags->pluck('name')
        ];

        if ($this->media) {
            $song['media'] = [
                'name' => $this->media->file_name,
                'url' => Storage::disk($this->media->disk)->url($this->media->path),
                'type' => $this->media->mime_type,
                'size' => $this->media->size
            ];
        }

        return $song;
    }
}
