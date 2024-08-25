<?php

namespace App\Application\Services\Ticket\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class IndexTicketDTO extends DataTransferObject
{
    public int $page;
}
