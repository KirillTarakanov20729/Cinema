<?php

namespace Database\Factories;

use App\Domain\Models\Actor\Actor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Models\Actor\Actor>
 */
class ActorFactory extends Factory
{
    protected $model = Actor::class;
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
        ];
    }
}
