<?php

namespace App\Http\Controllers;

use App\FavoriteMovie;
use App\Http\Requests\AddFavoriteMovie;
use App\Http\Requests\SearchMovie;
use Illuminate\Support\Facades\Auth;
use Tmdb\Client;
use Tmdb\Exception\TmdbApiException;


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

            $movie_id = $request->get('movie_id');

            try {
               $movie = $this->client->getMoviesApi()->getMovie($movie_id);
            } catch (TmdbApiException $e) {
                if ($e->getResponse()->getCode() === 404) {
                    return response()->api('The movie could not be found', false, 404);
                } else {
                    throw $e;
                }
            }

            FavoriteMovie::firstOrCreate(['user_id' => Auth::user()->id, 'movie_id' => $movie_id]);

            return response()->api($movie, 201);

        } catch (\Exception $exception) {
            return response()->api($exception->getMessage(), false, 500);
        }
    }

}
