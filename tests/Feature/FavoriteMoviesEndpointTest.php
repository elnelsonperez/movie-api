<?php

namespace Tests\Feature;

use App\FavoriteMovie;
use Tests\TestCase;

class SearchMoviesApiTest extends TestCase
{

    public function testValidationFailsWhenEmpty()
    {
        $response = $this->json('post', route('movies.add_favorite'));
        $response->assertStatus(422);
    }

    public function testValidationFailsWithInvalidId()
    {
        $response = $this->json('post', route('movies.add_favorite'), ['movie_id' => 1]);
        $response->assertStatus(404);

    }

    public function testAddFavorite()
    {
        $response = $this->json('post', route('movies.add_favorite'), ['movie_id' => 200]);
        $response->assertJsonFragment(['success' => true]);
        $this->assertTrue(FavoriteMovie::all()->first()->movie_id == 200);
    }

}
