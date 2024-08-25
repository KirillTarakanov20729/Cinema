<?php

namespace App\Application\Providers;

use App\Application\Services\Payment\Event\PaymentFailure;
use App\Application\Services\Payment\Event\PaymentStored;
use App\Application\Services\Payment\Event\PaymentSuccess;
use App\Application\Services\Payment\Listener\ChangePaymentStatus;
use App\Application\Services\Ticket\Listeners\CompleteTicketStatus;
use App\Application\Services\Ticket\Listeners\ProcessTicketStatus;
use App\Domain\Models\User\Listener\SendUserMail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppEventProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Event::listen(
            PaymentStored::class,
            ProcessTicketStatus::class
        );

        Event::listen(
            PaymentSuccess::class,
            ChangePaymentStatus::class
        );

        Event::listen(
            PaymentSuccess::class,
            SendUserMail::class
        );

        Event::listen(
            PaymentSuccess::class,
            CompleteTicketStatus::class
        );

        Event::listen(
            PaymentFailure::class,
            ChangePaymentStatus::class
        );
    }
}
