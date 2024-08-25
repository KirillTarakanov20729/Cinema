<?php

namespace App\Domain\Models\Actor\Resource;

use App\Domain\Models\Film\Resource\FilmResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActorResource extends JsonResource
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
            'films' =>FilmsForActorResource::collection($this->films),
        ];
    }
}
