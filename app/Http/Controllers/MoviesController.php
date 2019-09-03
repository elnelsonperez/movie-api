<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchMovie;
use Tmdb\Client;


class MoviesController extends Controller
{

    public function search(Client $client, SearchMovie $request)
    {

        try {
            $response = $client->getSearchApi()->searchMovies($request->get('query'));
            return response()->api($response);
        } catch (\Exception $exception) {
            return response()->api($response, false, 500);
        }

    }

}
