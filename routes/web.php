<?php

use App\Topic;
use App\User;
use App\Post;


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

Auth::routes();

Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@update_avatar');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('ajaxRequest', 'PostsController@ajaxRequest')->name('ajaxRequest');


Route::get('/avatar/{filename}', function ($filename)
{
    $path = storage_path() . '/avatars/' . $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('avatar');

