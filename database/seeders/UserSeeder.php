<?php

namespace Database\Seeders;

use App\Domain\Models\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (User::query()->count() == 0) {
            User::factory(100)->create();
        }
    }
}
