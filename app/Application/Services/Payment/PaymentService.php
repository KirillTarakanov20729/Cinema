<?php

namespace App\Application\Services\Payment;

use App\Application\Services\Payment\DTO\ChangePaymentStatusDTO;
use App\Application\Services\Payment\DTO\ShowPaymentDTO;
use App\Application\Services\Payment\DTO\StorePaymentDTO;
use App\Application\Services\Payment\Event\PaymentStored;
use App\Application\Services\Ticket\DTO\ShowTicketDTO;
use App\Domain\Models\Payment\Payment;
use App\Domain\Models\Ticket\Enum\TicketStatusEnum;
use App\Infrastructure\Repository\Payment\PaymentContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

readonly class PaymentService
{
    public function __construct(private PaymentContract $paymentRepository)
    {
    }

    public function store(StorePaymentDTO $data): Payment
    {
        if ($data->ticket->status != TicketStatusEnum::created) {
            throw new \Exception('Ticket is already reserved');
        }

        $payment = null;

        DB::transaction(function() use ($data, &$payment) {
            try {
                $payment =  $this->paymentRepository->store($data);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                throw $e;
            }

            PaymentStored::dispatch($payment);
        });

        return $payment;
    }

    public function changeStatus(ChangePaymentStatusDTO $data): Payment
    {
        try {
            return $payment = $this->paymentRepository->changeStatus($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function getPayment(ShowPaymentDTO $data): Payment
    {
        try {
            return $payment = $this->paymentRepository->getPayment($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
