<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('PT Cahaya Binar Berlian');
        $response->assertSee('ORINAMIA');

        $loginResponse = $this->get('/login');

        $loginResponse->assertStatus(200);
    }
}
