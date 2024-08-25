<?php

namespace App\Infrastructure\Repository\User;

use App\Application\Services\User\DTO\IndexUserDTO;
use App\Application\Services\User\DTO\ShowUserDTO;
use App\Domain\Models\User\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserContract
{
    public function index(IndexUserDTO $data): LengthAwarePaginator;

    public function show(ShowUserDTO $data): User;
}
