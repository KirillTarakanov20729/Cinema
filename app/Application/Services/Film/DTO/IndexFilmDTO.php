<?php

namespace App\Application\Services\Film\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class IndexFilmDTO extends DataTransferObject
{
    public int $page;
}
