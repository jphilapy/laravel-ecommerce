<?php

namespace Tests\Feature\budget;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_create_transactions()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
