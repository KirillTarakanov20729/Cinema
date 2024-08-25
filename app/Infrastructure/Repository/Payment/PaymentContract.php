<?php

namespace App\Infrastructure\Repository\Payment;

use App\Application\Services\Payment\DTO\ChangePaymentStatusDTO;
use App\Application\Services\Payment\DTO\ShowPaymentDTO;
use App\Application\Services\Payment\DTO\StorePaymentDTO;
use App\Application\Services\Ticket\DTO\ShowTicketDTO;
use App\Domain\Models\Payment\Payment;
use App\Domain\Models\Ticket\Ticket;

interface PaymentContract
{
    public function store(StorePaymentDTO $data): Payment;

    public function changeStatus(ChangePaymentStatusDTO $data): Payment;

    public function getPayment(ShowPaymentDTO $data): Payment;

    public function getTicket(ShowTicketDTO $data): Ticket;
}
