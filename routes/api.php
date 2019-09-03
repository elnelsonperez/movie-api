<?php

Route::get('movie/search', 'MoviesController@search')->name('movies.search');

Route::post('movie/favorite-list', 'MoviesController@addFavorite')->name('movies.add_favorite');
