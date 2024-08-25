<?php

namespace App\Application\Services\User;

use App\Application\Services\User\DTO\IndexUserDTO;
use App\Infrastructure\Repository\User\UserContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

readonly class UserService
{
    public function __construct(private UserContract $repository)
    {
    }

    public function index(IndexUserDTO $data): LengthAwarePaginator
    {
        try {
           return $this->repository->index($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            throw $exception;
        }
    }
}
