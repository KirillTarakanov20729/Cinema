<?php

namespace App\Domain\Models\User\Listener;

use App\Application\Services\Payment\Event\PaymentSuccess;
use App\Application\Services\User\DTO\ShowUserDTO;
use App\Domain\Models\User\Notification\SendPaymentNotification;
use App\Infrastructure\Repository\User\UserContract;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserMail implements ShouldQueue
{
    private UserContract $repository;
    public function __construct(UserContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentSuccess $event): void
    {
        $user = $this->repository->show(new ShowUserDTO(['email' => $event->getCustomerEmail()]));

        $user->notify(new SendPaymentNotification());
    }
}
