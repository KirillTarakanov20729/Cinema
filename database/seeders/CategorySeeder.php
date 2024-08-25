<?php

namespace Database\Seeders;

use App\Domain\Models\Category\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        if (Category::query()->count() == 0) {
            $this->createHorror();
            $this->createComedy();
            $this->createDrama();
        }
    }

    private function createHorror(): void
    {
        Category::create([
            'name' => 'Horror'
        ]);
    }

    private function createComedy(): void
    {
        Category::create([
            'name' => 'Comedy'
        ]);
    }

    private function createDrama(): void
    {
        Category::create([
            'name' => 'Drama'
        ]);
    }
}
