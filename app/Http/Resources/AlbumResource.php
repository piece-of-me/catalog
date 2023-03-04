<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
