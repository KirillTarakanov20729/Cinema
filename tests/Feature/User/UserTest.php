<?php

namespace Tests\Feature\User;

use App\Infrastructure\Trait\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use TestTrait;

    public function test_index_user_work(): void
    {
        $this->createData();

        $response = $this->get('/api/users/index/1');

        $response->assertStatus(200);

        $response->assertSee('test@mail.ru');
    }
}
