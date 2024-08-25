<?php

namespace App\Infrastructure\Repository\Actor;

use App\Application\Services\Actor\DTO\IndexActorDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ActorContract
{
    public function index(IndexActorDTO $data): LengthAwarePaginator;
}
