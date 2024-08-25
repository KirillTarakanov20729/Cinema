<?php

namespace Tests\Feature\Category;

use App\Infrastructure\Trait\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    use TestTrait;

    public function test_index_categories_index()
    {
        $this->createData();

        $response = $this->get('/api/categories/index/1');

        $response->assertStatus(200);

        $response->assertSee('Horror');
    }
}
