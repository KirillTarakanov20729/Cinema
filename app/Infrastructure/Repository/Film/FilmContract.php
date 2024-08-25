<?php

namespace App\Infrastructure\Repository\Film;

use App\Application\Services\Film\DTO\IndexFilmDTO;
use App\Application\Services\Film\DTO\ShowFilmDTO;
use App\Domain\Models\Film\Film;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface FilmContract
{
    public function index(IndexFilmDTO $data): LengthAwarePaginator;

    public function show(ShowFilmDTO $data): Film;

    public function getTicketsForFilm(ShowFilmDTO $data): Collection;
}
