<?php

namespace Database\Seeders;

use App\Domain\Models\Actor\Actor;
use App\Domain\Models\Film\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorFilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $films = Film::query()->get();
        foreach ($films as $film) {
            $actor_one = Actor::query()->inRandomOrder()->first();
            $actor_two = Actor::query()->inRandomOrder()->where('id', '!=', $actor_one->id)->first();

            $film->actors()->sync([$actor_one->id, $actor_two->id]);
        }
    }
}
