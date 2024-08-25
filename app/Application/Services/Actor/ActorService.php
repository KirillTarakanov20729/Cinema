<?php

namespace App\Application\Services\Actor;

use App\Application\Services\Actor\DTO\IndexActorDTO;
use App\Infrastructure\Repository\Actor\ActorContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

readonly class ActorService
{
    public function __construct(private ActorContract $repository)
    {
    }

    public function index(IndexActorDTO $data): LengthAwarePaginator
    {
        try {
            return $this->repository->index($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            throw $exception;
        }
    }
}
