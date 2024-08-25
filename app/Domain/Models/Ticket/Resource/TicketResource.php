<?php

namespace App\Domain\Models\Ticket\Resource;

use App\Domain\Models\Film\Resource\FilmResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'uuid' => $this->uuid,
            'price' => $this->price,
            'seat' => $this->seat,
            'status' => $this->status->label(),
            'film' => new FilmResource($this->film)
        ];
    }
}
