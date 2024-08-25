<?php

namespace Database\Seeders;

use App\Domain\Models\Category\Category;
use App\Domain\Models\Film\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryFilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $films = Film::query()->get();
        foreach ($films as $film) {
            $category_one = Category::query()->inRandomOrder()->first();
            $category_two = Category::query()->inRandomOrder()->where('id', '!=', $category_one->id)->first();

            $film->categories()->sync([$category_one->id, $category_two->id]);
        }
    }
}
