<?php

namespace App\Http\Controllers\Film;

use App\Application\Services\Film\DTO\IndexFilmDTO;
use App\Application\Services\Film\DTO\ShowFilmDTO;
use App\Application\Services\Film\FilmService;
use App\Domain\Models\Film\Resource\FilmResource;
use App\Domain\Models\Ticket\Resource\TicketResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FilmController extends Controller
{
    public function __construct(private readonly FilmService $service)
    {
    }

    public function index(int $page): JsonResponse|AnonymousResourceCollection
    {
        $data = new IndexFilmDTO(['page' => $page]);

        try {
            $films = $this->service->index($data);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }

        return FilmResource::collection($films);
    }

    public function getTickets(int $id): JsonResponse|AnonymousResourceCollection
    {
        $data = new ShowFilmDTO(['id' => $id]);

        try {
            $tickets = $this->service->getTicketsForFilm($data);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }

        return TicketResource::collection($tickets);
    }
}
