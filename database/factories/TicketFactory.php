<?php

namespace Database\Factories;

use App\Domain\Models\Film\Film;
use App\Domain\Models\Ticket\Enum\TicketStatusEnum;
use App\Domain\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Models\Ticket\Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;
    public function definition(): array
    {
        return [
            'film_id' => Film::query()->inRandomOrder()->first()->id,
            'status' => TicketStatusEnum::created,
            'price' => $this->faker->randomNumber('3', true),
            'seat' => $this->generateSeat()
        ];
    }

    private function generateSeat(): string
    {
        $letters = range('A', 'Z');
        $randomLetter = $letters[array_rand($letters)];
        $randomNumber = mt_rand(1, 99);

        return $randomLetter . $randomNumber;
    }
}
