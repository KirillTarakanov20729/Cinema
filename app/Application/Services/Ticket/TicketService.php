<?php

namespace App\Application\Services\Ticket;

use App\Application\Services\Ticket\DTO\IndexTicketDTO;
use App\Application\Services\Ticket\DTO\ShowTicketDTO;
use App\Application\Services\Ticket\DTO\StorePaymentDTO;
use App\Domain\Models\Payment\Payment;
use App\Domain\Models\Ticket\Ticket;
use App\Infrastructure\Repository\Ticket\TicketContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

readonly class TicketService
{
    public function __construct(private TicketContract $repository)
    {
    }

    public function index(IndexTicketDTO $data): LengthAwarePaginator
    {
        try {
            return $this->repository->index($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function show(ShowTicketDTO $data): Ticket
    {
        try {
            return $this->repository->show($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

}
