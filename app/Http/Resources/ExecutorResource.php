<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ExecutorResource",
 *     description="Данные об исполнителе",
 *     @OA\Property (property="id", type="integer", example="1", description="Id исполнителя"),
 *     @OA\Property (property="name", type="string", example="Corey Taylor", description="Название исполнителя")
 * )
 */
class ExecutorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
