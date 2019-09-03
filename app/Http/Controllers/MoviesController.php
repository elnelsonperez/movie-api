<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddFavoriteMovie;
use App\Http\Requests\SearchMovie;
use Tmdb\Client;


class MoviesController extends Controller
{

    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;

    }

    public function search(SearchMovie $request)
    {

        try {

            // Validation takes care of making sure either id or search query is provided
            if ($request->has('movie_id')) {
                $response = $this->client->getMoviesApi()->getMovie($request->get('movie_id'));
            } else {
                $response = $this->client->getSearchApi()->searchMovies($request->get('title'));
            }

            return response()->api($response);
        } catch (\Exception $exception) {
            return response()->api($exception->getMessage(), false, 500);
        }

    }

    public function addFavorite(AddFavoriteMovie $request)
    {
        try {

            // Validation takes care of making sure either id or search query is provided
            if ($request->has('movie_id')) {
                $response = $this->client->getMoviesApi()->getMovie($request->get('id'));
            } else {
                $response = $this->client->getSearchApi()->searchMovies($request->get('title'));
            }

            return response()->api($response);
        } catch (\Exception $exception) {
            return response()->api($exception->getMessage(), false, 500);
        }
    }

}
