<?php

namespace App\Infrastructure\Repository\Category;

use App\Application\Services\Category\DTO\IndexCategoryDTO;
use App\Domain\Models\Category\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryContract
{
    public function index(IndexCategoryDTO $data): LengthAwarePaginator
    {
        return Category::query()->paginate(10, ['*'], 'page', $data->page);
    }
}
