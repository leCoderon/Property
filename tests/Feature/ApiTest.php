<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_making_an_api_request(): void
    {
        $response = $this->getJson('/api/property');

        $response->assertStatus(200)
        ->assertJson([
            'found' => true,
        ]);
    }
}
