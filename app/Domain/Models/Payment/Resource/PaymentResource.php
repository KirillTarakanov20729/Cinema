<?php

namespace App\Domain\Models\Payment\Resource;

use App\Domain\Models\Ticket\Resource\TicketResource;
use App\Domain\Models\User\Resource\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'user' => new UserResource($this->user),
            'ticket' => new TicketResource($this->ticket),
            'amount' => $this->amount,
            'status' => $this->status->label()
        ];
    }
}
