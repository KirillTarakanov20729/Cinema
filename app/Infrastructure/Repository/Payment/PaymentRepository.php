<?php

namespace App\Infrastructure\Repository\Payment;

use App\Application\Services\Payment\DTO\ChangePaymentStatusDTO;
use App\Application\Services\Payment\DTO\ShowPaymentDTO;
use App\Application\Services\Payment\DTO\StorePaymentDTO;
use App\Application\Services\Ticket\DTO\ShowTicketDTO;
use App\Domain\Models\Payment\Enum\PaymentStatusEnum;
use App\Domain\Models\Payment\Payment;
use App\Domain\Models\Ticket\Ticket;

class PaymentRepository implements PaymentContract
{

    public function store(StorePaymentDTO $data): Payment
    {
        return Payment::query()->create([
            'user_id' => $data->user_id,
            'ticket_id' => $data->ticket->id,
            'amount' => $data->ticket->price,
            'status' => PaymentStatusEnum::created
        ]);
    }

    public function getTicket(ShowTicketDTO $data): Ticket
    {
        return Ticket::query()->where('id', $data->ticket_id)->firstOrFail();
    }

    public function changeStatus(ChangePaymentStatusDTO $data): Payment
    {
        $data->payment->status = $data->status;
        $data->payment->save();

        return $data->payment;
    }

    public function getPayment(ShowPaymentDTO $data): Payment
    {
        $payment = Payment::query()->where('uuid', $data->payment_uuid)->first();

        if (!$payment) {
            throw new \Exception('Payment not found');
        }

        return $payment;
    }
}
