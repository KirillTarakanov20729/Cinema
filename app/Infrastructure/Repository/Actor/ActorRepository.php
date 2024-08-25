<?php

namespace App\Infrastructure\Repository\Actor;

use App\Application\Services\Actor\DTO\IndexActorDTO;
use App\Domain\Models\Actor\Actor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ActorRepository implements ActorContract
{

    public function index(IndexActorDTO $data): LengthAwarePaginator
    {
        return Actor::query()->paginate(10, ['*'], 'page', $data->page);
    }
}
