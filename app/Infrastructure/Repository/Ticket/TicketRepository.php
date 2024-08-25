<?php

namespace App\Infrastructure\Repository\Ticket;

use App\Application\Services\Payment\DTO\ShowPaymentDTO;
use App\Application\Services\Ticket\DTO\ChangeTicketStatusDTO;
use App\Application\Services\Ticket\DTO\IndexTicketDTO;
use App\Application\Services\Ticket\DTO\ShowTicketDTO;
use App\Domain\Models\Payment\Payment;
use App\Domain\Models\Ticket\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TicketRepository implements TicketContract
{

    public function index(IndexTicketDTO $data): LengthAwarePaginator
    {
        return Ticket::query()->paginate(10, ['*'], 'page', $data->page);
    }

    public function changeStatus(ChangeTicketStatusDTO $data): bool
    {
        $data->ticket->status = $data->status;

        return $data->ticket->save();
    }

    public function show(ShowTicketDTO $data): Ticket
    {
        return Ticket::query()->findOrFail($data->ticket_id);
    }

    public function getPayment(ShowPaymentDTO $data): Payment
    {
        return Payment::query()->where('uuid', $data->payment_uuid)->firstOrFail();
    }
}
