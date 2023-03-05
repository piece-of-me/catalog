<?php

namespace App\Http\Resources\All;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="AllAlbumResource",
 *     description="Данные об альбоме",
 *     @OA\Property (property="id", type="integer", example="2", description="Id альбома"),
 *     @OA\Property (property="name", type="string", example="Iowa", description="Название альбома"),
 *     @OA\Property (property="yearOfIssue", type="integer", example="2001", description="Год выпуска"),
 *     @OA\Property (property="songs", type="array", @OA\Items(ref="#/components/schemas/AllSongResource"))
 * )
 */
class AlbumResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'yearOfIssue' => $this->year_of_issue,
            'songs' => SongResource::collection($this->songs),
        ];
    }
}
