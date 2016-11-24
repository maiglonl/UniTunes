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

Route::get('/', "HomeController@welcome")->name("welcome");
Route::get('/home', "HomeController@home")->name("home");

Auth::routes();

/*
|--------------------------------------------------------------------------
| Media Routes
|--------------------------------------------------------------------------
*/
Route::get('/musics', "MediaController@musicsHome")->name("musics.home");
Route::get('/musics/detail/{id}', "MediaController@musicsDetails")->name("musics.details");
Route::get('/musics/list/{id}', "MediaController@musicsList")->name("musics.list");
Route::get('/musics/new', "MediaController@musicsNewMedia")->name("musics.new");
Route::post('/musics/new', "MediaController@PostMedia")->name("musics.new");

Route::get('/videos', "MediaController@videosHome")->name("videos.home");
Route::get('/videos/detail/{id}', "MediaController@videosDetails")->name("videos.details");
Route::get('/videos/new', "MediaController@videosNewMedia")->name("videos.new");
Route::post('/videos/new', "MediaController@PostMedia")->name("videos.new");

Route::get('/books', "MediaController@booksHome")->name("books.home");
Route::get('/books/detail/{id}', "MediaController@booksDetails")->name("books.details");
Route::get('/books/list/{id}', "MediaController@booksList")->name("books.list");
Route::get('/books/new', "MediaController@booksNewMedia")->name("books.new");
Route::post('/books/new', "MediaController@PostMedia")->name("books.new");

Route::get('/podcasts', "MediaController@podcastsHome")->name("podcasts.home");
Route::get('/podcasts/detail/{id}', "MediaController@podcastsDetails")->name("podcasts.details");
Route::get('/podcasts/list/{id}', "MediaController@podcastsList")->name("podcasts.list");
Route::get('/podcasts/new', "MediaController@podcastsNewMedia")->name("podcasts.new");
Route::post('/podcasts/new', "MediaController@PostMedia")->name("podcasts.new");

Route::get('/medias/buy/{id}', "MediaController@buyMedia")->name("medias.buy");
Route::get('/medias/download/{id}', "MediaController@downloadMedia")->name("medias.download");

Route::get('/medias/receipt/{id}', "MediaController@getReceipt")->name("medias.receipt");
Route::get('/medias/delete/{id}', "MediaController@deleteMedia")->name("medias.delete");

Route::get('/medias/favorites/set/{id}', "MediaController@setFavorite")->name("favorites.set");
Route::get('/medias/favorites/unset/{id}', "MediaController@unsetFavorite")->name("favorites.unset");
/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
*/
Route::get('/users/myProfile', "UserController@myProfile")->name("users.myProfile");
Route::get('/users/list', "UserController@usersList")->name("users.list");
Route::get('/users/delete/{id}', "UserController@deleteUser")->name("users.delete");
Route::get('/users/profile/{id}', "UserController@profile")->name("users.profile");
Route::post('/users/credit', "UserController@credit")->name("users.credit");
