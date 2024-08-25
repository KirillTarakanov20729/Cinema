<?php

namespace App\Application\Services\Ticket\Listeners;

use App\Application\Services\Payment\DTO\ShowPaymentDTO;
use App\Application\Services\Payment\Event\PaymentSuccess;
use App\Application\Services\Ticket\DTO\ChangeTicketStatusDTO;
use App\Application\Services\Ticket\DTO\ShowTicketDTO;
use App\Domain\Models\Ticket\Enum\TicketStatusEnum;
use App\Infrastructure\Repository\Ticket\TicketContract;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class CompleteTicketStatus implements ShouldQueue
{
    private TicketContract $repository;
    public function __construct(TicketContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentSuccess $event): void
    {
        $data_for_show_payment = new ShowPaymentDTO(['payment_uuid' => $event->getPaymentUuid()]);

        try {
            $payment = $this->repository->getPayment($data_for_show_payment);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return;
        }

        $data_for_show_ticket = new ShowTicketDTO(['ticket_id' => $payment->ticket_id]);

        try {
            $ticket = $this->repository->show($data_for_show_ticket);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return;
        }

        $data_for_update = new ChangeTicketStatusDTO(['ticket' => $ticket, 'status' => TicketStatusEnum::paid]);

        try {
            $this->repository->changeStatus($data_for_update);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return;
        }
    }
}
