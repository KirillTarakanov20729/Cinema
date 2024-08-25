<?php

namespace App\Application\Services\Actor\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class IndexActorDTO extends DataTransferObject
{
    public int $page;
}
