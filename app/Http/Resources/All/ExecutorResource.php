<?php

namespace App\Http\Resources\All;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="AllExecutorResource",
 *     description="Данные об исполнителях",
 *     @OA\Property (property="id", type="integer", example="1", description="Id исполнителя"),
 *     @OA\Property (property="name", type="string", example="Corey Taylor", description="Название исполнителя"),
 *     @OA\Property (property="albums", type="array", @OA\Items(ref="#/components/schemas/AllAlbumResource"))
 * )
 */
class ExecutorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'albums' => AlbumResource::collection($this->albums),
        ];
    }
}
