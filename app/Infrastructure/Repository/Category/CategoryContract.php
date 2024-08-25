<?php

namespace App\Infrastructure\Repository\Category;

use App\Application\Services\Category\DTO\IndexCategoryDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryContract
{
    public function index(IndexCategoryDTO $data): LengthAwarePaginator;
}
