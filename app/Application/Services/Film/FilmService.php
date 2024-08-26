<?php

namespace App\Application\Services\Film;

use App\Application\Services\Film\DTO\IndexFilmDTO;
use App\Application\Services\Film\DTO\ShowFilmDTO;
use App\Infrastructure\Repository\Film\FilmContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

readonly class FilmService
{
    public function __construct(private FilmContract $repository)
    {
    }

    public function index(IndexFilmDTO $data): LengthAwarePaginator
    {
        try {
            return $this->repository->index($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function getTicketsForFilm(ShowFilmDTO $data): Collection
    {
        try {
            return $this->repository->getTicketsForFilm($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
