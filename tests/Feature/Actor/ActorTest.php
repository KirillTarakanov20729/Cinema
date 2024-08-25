<?php

namespace Tests\Feature\Actor;

use App\Infrastructure\Trait\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActorTest extends TestCase
{
    use RefreshDatabase;
    use TestTrait;

    public function test_index_actors_work(): void
    {
        $this->createData();

        $response = $this->get('/api/actors/index/1');

        $response->assertStatus(200);
    }
}
