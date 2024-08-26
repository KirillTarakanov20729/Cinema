<?php

namespace App\Http\Controllers\Ticket;

use App\Application\Services\Ticket\DTO\IndexTicketDTO;
use App\Application\Services\Ticket\TicketService;
use App\Domain\Models\Ticket\Resource\TicketResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


/**
 * @OA\Get (
 *     path="/api/tickets/index/{page}",
 *     summary="Get all tickets",
 *     tags={"Tickets"},
 *
 *     @OA\Parameter(
 *         name="page",
 *         in="path",
 *         required=true,
 *     ),
 *
 *     @OA\Response(
 *         response="200",
 *         description="Get all tickets",
 *     )
 * )
 */
class TicketController extends Controller
{
    public function __construct(readonly private TicketService $ticketService)
    {
    }

    public function index(int $page): JsonResponse|AnonymousResourceCollection
    {
        $data = new IndexTicketDTO(['page' => $page]);

        try {
            $tickets = $this->ticketService->index($data);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return TicketResource::collection($tickets);
    }
}
