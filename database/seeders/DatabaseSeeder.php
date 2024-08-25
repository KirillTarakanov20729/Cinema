<?php

namespace Database\Seeders;

use App\Domain\Models\User\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(ActorSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(FilmSeeder::class);
        $this->call(ActorFilmSeeder::class);
        $this->call(CategoryFilmSeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(PaymentSeeder::class);
    }
}
