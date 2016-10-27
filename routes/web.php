<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/musics', 'MusicController@index');
Route::get('/videos', 'VideoController@index');
Route::get('/books', 'BookController@index');
Route::get('/podcasts', 'PodcastController@index');
