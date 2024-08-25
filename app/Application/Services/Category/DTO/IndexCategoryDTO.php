<?php

namespace App\Application\Services\Category\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class IndexCategoryDTO extends DataTransferObject
{
    public int $page;
}
