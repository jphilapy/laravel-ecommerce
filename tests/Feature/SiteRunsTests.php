<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteRunsTests extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function site_returns_200_status()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
