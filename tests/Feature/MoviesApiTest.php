<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoviesApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testValidationFailsWhenEmpty()
    {
        $response = $this->json('get', route('movies.search'));
        $response->assertStatus(422);
    }

    public function testGetsResultsWithId()
    {
        $response = $this->json('get', route('movies.search', ['id' => 200]));
        $response->assertJsonFragment(['success' => true]);
    }
}
