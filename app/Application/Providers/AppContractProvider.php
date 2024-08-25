<?php

namespace App\Application\Providers;

use App\Infrastructure\Repository\Actor\ActorContract;
use App\Infrastructure\Repository\Actor\ActorRepository;
use App\Infrastructure\Repository\Category\CategoryContract;
use App\Infrastructure\Repository\Category\CategoryRepository;
use App\Infrastructure\Repository\Film\FilmContract;
use App\Infrastructure\Repository\Film\FilmRepository;
use App\Infrastructure\Repository\Payment\PaymentContract;
use App\Infrastructure\Repository\Payment\PaymentRepository;
use App\Infrastructure\Repository\Ticket\TicketContract;
use App\Infrastructure\Repository\Ticket\TicketRepository;
use App\Infrastructure\Repository\User\UserContract;
use App\Infrastructure\Repository\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppContractProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(UserContract::class, UserRepository::class);

        $this->app->bind(CategoryContract::class, CategoryRepository::class);

        $this->app->bind(ActorContract::class, ActorRepository::class);

        $this->app->bind(FilmContract::class, FilmRepository::class);

        $this->app->bind(TicketContract::class, TicketRepository::class);

        $this->app->bind(PaymentContract::class, PaymentRepository::class);
    }
}
