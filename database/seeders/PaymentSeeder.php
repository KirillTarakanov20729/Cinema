<?php

namespace Database\Seeders;

use App\Domain\Models\Payment\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        if (Payment::count() == 0) {
            Payment::factory()->count(50)->create();
        }
    }
}
