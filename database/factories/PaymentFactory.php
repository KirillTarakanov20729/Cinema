<?php

namespace Database\Factories;

use App\Domain\Models\Payment\Enum\PaymentStatusEnum;
use App\Domain\Models\Payment\Payment;
use App\Domain\Models\Ticket\Ticket;
use App\Domain\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Models\Payment\Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'ticket_id' => Ticket::query()->inRandomOrder()->first()->id,
            'amount' => $this->faker->numberBetween(100, 1000),
            'status' => PaymentStatusEnum::created
        ];
    }
}
