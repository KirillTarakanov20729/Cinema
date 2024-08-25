<?php

namespace App\Application\Services\Ticket\DTO;

use App\Domain\Models\Ticket\Enum\TicketStatusEnum;
use App\Domain\Models\Ticket\Ticket;
use Spatie\DataTransferObject\DataTransferObject;

class ChangeTicketStatusDTO extends DataTransferObject
{
    public string $status;

    public Ticket $ticket;
}
