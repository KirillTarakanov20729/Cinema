<?php

namespace Tests\Feature\Film;

use App\Infrastructure\Trait\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilmTest extends TestCase
{
    use RefreshDatabase;
    use TestTrait;

    public function test_index_films_work(): void
    {
        $this->createData();

        $response = $this->get('/api/films/index/1');

        $response->assertStatus(200);
    }

    public function test_get_tickets_for_film_work(): void
    {
        $this->createData();

        $response = $this->get('/api/films/1/tickets');

        $response->assertStatus(200);
    }
}
