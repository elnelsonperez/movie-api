<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchMovie;
use Tmdb\Client;


class MoviesController extends Controller
{

    public function search(Client $client, SearchMovie $request)
    {

        try {

            // Validation takes care of making sure either id or search query is provided
            if ($request->has('id')) {
                $response = $client->getMoviesApi()->getMovie($request->get('id'));
            } else {
                $response = $client->getSearchApi()->searchMovies($request->get('title'));
            }

            return response()->api($response);
        } catch (\Exception $exception) {
            return response()->api($exception->getMessage(), false, 500);
        }

    }

}
