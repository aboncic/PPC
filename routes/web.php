<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/topics','TopicsController@index');
// Route::get('/topics/create','TopicsController@create');
// Route::post('/topics','TopicsController@store');
// Route::get('/topics/{id}','TopicsController@show')->name('topic');

Route::resource('topics','TopicsController');
Route::resource('topics.posts','PostsController');