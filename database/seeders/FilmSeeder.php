<?php

namespace Database\Seeders;

use App\Domain\Models\Film\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createWolfOfWallStreet();
        $this->createJoker();
        $this->createInception();
    }

    private function createWolfOfWallStreet(): void
    {
        Film::query()->create([
            'name' => 'Wolf of Wall Street',
        ]);
    }

    private function createJoker(): void
    {
        Film::query()->create([
            'name' => 'Joker',
        ]);
    }

    private function createInception(): void
    {
        Film::query()->create([
            'name' => 'Inception',
        ]);
    }
}
