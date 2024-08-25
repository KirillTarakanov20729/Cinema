<?php

namespace App\Infrastructure\Repository\Film;

use App\Application\Services\Film\DTO\IndexFilmDTO;
use App\Application\Services\Film\DTO\ShowFilmDTO;
use App\Domain\Models\Film\Film;
use App\Domain\Models\Ticket\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FilmRepository implements FilmContract
{

    public function index(IndexFilmDTO $data): LengthAwarePaginator
    {
        return Film::query()->paginate(10, ['*'], 'page', $data->page);
    }

    public function show(ShowFilmDTO $data): Film
    {
        return Film::query()->findOrFail($data->id);
    }

    public function getTicketsForFilm(ShowFilmDTO $data): Collection
    {
        return Ticket::query()->where('film_id', $data->id)->get();
    }
}
