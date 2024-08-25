<?php

namespace Database\Seeders;

use App\Domain\Models\Actor\Actor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Actor::query()->count() == 0) {
            $this->createTomHanks();
            $this->createTomCruise();
            $this->createTomHolland();
        }
    }

    private function createTomHanks(): void
    {
        Actor::create([
            'name' => 'Tom Hanks'
        ]);
    }

    private function createTomCruise(): void
    {
        Actor::create([
            'name' => 'Tom Cruise'
        ]);
    }

    private function createTomHolland(): void
    {
        Actor::create([
            'name' => 'Tom Holland'
        ]);
    }
}
