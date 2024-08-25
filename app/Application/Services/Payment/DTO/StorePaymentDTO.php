<?php

namespace App\Application\Services\Payment\DTO;

use App\Domain\Models\Ticket\Ticket;
use Spatie\DataTransferObject\DataTransferObject;

class StorePaymentDTO extends DataTransferObject
{
    public int $user_id;

    public Ticket $ticket;
}
