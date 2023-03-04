<?php

namespace App\Http\Resources\All;

use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'orderNumberInAlbum' => $this->order_number_in_album,
        ];
    }
}
