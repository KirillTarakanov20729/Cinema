<?php

namespace App\Application\Services\Ticket\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ShowTicketDTO extends DataTransferObject
{
    public string $ticket_id;
}
