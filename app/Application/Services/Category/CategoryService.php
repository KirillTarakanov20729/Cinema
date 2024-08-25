<?php

namespace App\Application\Services\Category;

use App\Application\Services\Category\DTO\IndexCategoryDTO;
use App\Infrastructure\Repository\Category\CategoryContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

readonly class CategoryService
{
    public function __construct(private CategoryContract $service)
    {
    }

    public function index(IndexCategoryDTO $data): LengthAwarePaginator
    {
        try {
            return $this->service->index($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
