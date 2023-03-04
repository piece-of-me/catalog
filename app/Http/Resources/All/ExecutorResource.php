<?php

namespace App\Http\Resources\All;

use Illuminate\Http\Resources\Json\JsonResource;

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
