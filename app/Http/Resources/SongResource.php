<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="SongResource",
 *     description="Данные о песне",
 *     @OA\Property (property="id", type="integer", example="2", description="Id песни"),
 *     @OA\Property (property="name", type="string", example="Wait and Bleed", description="Название песни"),
 *     @OA\Property (property="orderNumberInAlbum", type="integer", example="4", description="Порядковый номер в альбоме"),
 *     @OA\Property (property="album", type="object", description="Информация об альбоме",
 *         @OA\Property (property="id", type="integer", example="2", description="Id альбома"),
 *         @OA\Property (property="name", type="string", example="Iowa", description="Название альбома"),
 *         @OA\Property (property="yearOfIssue", type="integer", example="2001", description="Год выпуска")
 *     )
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
            'album' => [
                'id' => $this->album->id,
                'name' => $this->album->name,
                'year_of_issue' => $this->album->year_of_issue
            ],
        ];
    }
}