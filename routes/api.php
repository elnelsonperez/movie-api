<?php

Route::get('movie/search', 'MoviesController@search')->name('movies.search');
Route::get('movie/favorite-list', 'MoviesController@listFavorites')->name('movies.list_favorites');
Route::post('movie/favorite-list', 'MoviesController@addFavorite')->name('movies.add_favorite');
Route::delete('movie/favorite-list', 'MoviesController@deleteFavorites')->name('movies.delete_favorite');
