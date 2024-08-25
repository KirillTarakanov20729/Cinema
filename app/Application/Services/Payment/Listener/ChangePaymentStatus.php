<?php

namespace App\Application\Services\Payment\Listener;

use App\Application\Services\Payment\DTO\ShowPaymentDTO;
use App\Application\Services\Payment\Event\PaymentFailure;
use App\Application\Services\Payment\Event\PaymentSuccess;
use App\Application\Services\Payment\PaymentService;
use App\Domain\Models\Payment\Enum\PaymentStatusEnum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class ChangePaymentStatus implements ShouldQueue
{
    private PaymentService $service;
    public function __construct(PaymentService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentSuccess|PaymentFailure $event): void
    {
        $payment = null;

        try {
            $payment = $this->service->getPayment(new ShowPaymentDTO(['payment_uuid' => $event->getPaymentUuid()]));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        try {
            $payment->update([
                'status' => $event instanceof PaymentSuccess ? PaymentStatusEnum::success : PaymentStatusEnum::failure
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
