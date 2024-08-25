<?php

namespace App\Domain\Models\Film\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'actors' => ActorsForFilmResource::collection($this->actors),
            'categories' => CategoriesForFilmResource::collection($this->categories),
        ];
    }
}
