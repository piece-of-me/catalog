<?php

namespace App\Http\Resources\All;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="AllSongResource",
 *     description="Данные о песнях",
 *     @OA\Property (property="id", type="integer", example="2", description="Id песни"),
 *     @OA\Property (property="name", type="string", example="Wait and Bleed", description="Название песни"),
 *     @OA\Property (property="orderNumberInAlbum", type="integer", example="4", description="Порядковый номер в альбоме")
 * )
 */
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
