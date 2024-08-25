<?php

namespace App\Infrastructure\Repository\Ticket;

use App\Application\Services\Payment\DTO\ShowPaymentDTO;
use App\Application\Services\Ticket\DTO\ChangeTicketStatusDTO;
use App\Application\Services\Ticket\DTO\IndexTicketDTO;
use App\Application\Services\Ticket\DTO\ShowTicketDTO;
use App\Domain\Models\Payment\Payment;
use App\Domain\Models\Ticket\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TicketContract
{
    public function index(IndexTicketDTO $data): LengthAwarePaginator;

    public function show(ShowTicketDTO $data): Ticket;

    public function getPayment(ShowPaymentDTO $data): Payment;

    public function changeStatus(ChangeTicketStatusDTO $data): bool;
}
