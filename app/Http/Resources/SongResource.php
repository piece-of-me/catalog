<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'orderNumberInAlbum' => $this->order_number_in_album,
            'album' => [
                'id' => $this->album->id,
                'name' => $this->album->name,
                'year_of_issue' => $this->album->year_of_issue
            ],
        ];
    }
}
