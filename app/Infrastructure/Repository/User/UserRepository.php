<?php

namespace App\Infrastructure\Repository\User;

use App\Application\Services\User\DTO\IndexUserDTO;
use App\Application\Services\User\DTO\ShowUserDTO;
use App\Domain\Models\User\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserContract
{

    public function index(IndexUserDTO $data): LengthAwarePaginator
    {
        return User::query()->paginate(10, ['*'], 'page', $data->page);
    }

    public function show(ShowUserDTO $data): User
    {
        return User::query()->where('email', $data->email)->firstOrFail();
    }
}
