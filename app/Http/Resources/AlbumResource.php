<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="AlbumResource",
 *     description="Данные об альбоме",
 *     @OA\Property (property="id", type="integer", example="2", description="Id альбома"),
 *     @OA\Property (property="name", type="string", example="Iowa", description="Название альбома"),
 *     @OA\Property (property="yearOfIssue", type="integer", example="2001", description="Год выпуска"),
 *     @OA\Property (property="executor", type="object", description="Информация об исполнителе альбома",
 *         @OA\Property (property="id", type="integer", example="1", description="Id исполнителя"),
 *         @OA\Property (property="name", type="string", example="Corey Taylor", description="Название исполнителя")
 *     )
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
            'executor' => [
                'id' => $this->executor->id,
                'name' => $this->executor->name,
            ],
        ];
    }
}
