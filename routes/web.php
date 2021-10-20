<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'UsersController@listing');

Route::get('/signup', 'SignupController@form');
Route::post('/signup', 'SignupController@signup');

Route::get('/login', 'LoginController@form');
Route::post('/login', 'LoginController@login');

Route::get('/blog', 'BlogController@home');
Route::post('/blog', 'ChannelController@new')->middleware('App\Http\Middleware\Auth');
Route::group([
    'middleware' => 'blog',
], function () {
    Route::get('/blog/channels/{channel_id}', 'ChannelController@show');
    Route::post('/blog/channels/{channel_id}', 'ArticleController@new')->middleware('auth');
    Route::get('/blog/articles/{article_id}', 'ArticleController@show');
});

Route::group([
    'middleware' => 'auth',
], function () {
    Route::view('/my-account', 'my-account');

    Route::get('/logout', 'AccountController@logout');
    Route::post('/password-modification', 'AccountController@changePassword');
    Route::post('/avatar-modification', 'AccountController@changeAvatar');

    Route::post('/{email}/follow', 'FollowsController@create');
    Route::delete('/{email}/follow', 'FollowsController@delete');

    Route::post('/messages', 'MessagesController@publish');

    Route::get('/news', 'NewsController@news');
});

Route::get('/{email}', 'UsersController@see');

