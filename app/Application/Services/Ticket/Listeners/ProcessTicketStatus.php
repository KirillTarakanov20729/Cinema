<?php

namespace App\Application\Services\Ticket\Listeners;

use App\Application\Services\Payment\Event\PaymentStored;
use App\Application\Services\Ticket\DTO\ChangeTicketStatusDTO;
use App\Application\Services\Ticket\DTO\ShowTicketDTO;
use App\Domain\Models\Ticket\Enum\TicketStatusEnum;
use App\Infrastructure\Repository\Ticket\TicketContract;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

readonly class ProcessTicketStatus
{
    public function __construct(private TicketContract $repository)
    {
        //
    }

    public function handle(PaymentStored $event): void
    {
        $data_for_show = new ShowTicketDTO(['ticket_id' => $event->getPayment()->ticket_id]);

        try {
            $ticket = $this->repository->show($data_for_show);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return;
        }

        $data_for_update = new ChangeTicketStatusDTO(['ticket' => $ticket, 'status' => TicketStatusEnum::processing]);

        try {
            $this->repository->changeStatus($data_for_update);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return;
        }
    }
}
