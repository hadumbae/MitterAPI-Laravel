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

Route::get('/symlink', function () {
    Artisan::call('storage:link');
    echo 'Done';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// API User Register & Login

Route::get('/api/register/index', 'API\RegisterAPIController@index')->name('apiregisterindex');
Route::post('/api/register', 'API\RegisterAPIController@create');
Route::post('/api/login', 'API\RegisterAPIController@login');

// API Tweets

Route::get('/api/tweet/index', 'API\TweetAPIController@index');
Route::post('/api/tweet/store', 'API\TweetAPIController@store')->middleware('auth:api');
Route::post('/api/tweet/destroy/{id}', 'API\TweetAPIController@destroy')->middleware('auth:api');
Route::post('/api/tweet/show/{id}', 'API\TweetAPIController@show')->middleware('auth:api');
Route::post('/api/tweet/showAll/{id}', 'API\TweetAPIController@showAll')->middleware('auth:api');
Route::post('/api/tweet/destroy/{id}', 'API\TweetAPIController@destroy')->middleware('auth:api');

// API Users

Route::get('/api/user/index', 'API\UserAPIController@index');
Route::post('/api/user/show/{id}', 'API\UserAPIController@show')->middleware('auth:api');
Route::post('/api/user/showAll', 'API\UserAPIController@showAll')->middleware('auth:api');
Route::post('/api/user/update', 'API\UserAPIController@update')->middleware('auth:api');
Route::post('/api/user/search/{handle}', 'API\UserAPIController@search')->middleware('auth:api');

// API Follow

Route::get('/api/follow/index', 'API\FollowAPIController@index')->middleware('auth:api');
Route::post('/api/follow/follow', 'API\FollowAPIController@follow')->middleware('auth:api');
Route::post('/api/follow/tweetFollow/{id}', 'API\FollowAPIController@tweetFollow')->middleware('auth:api');
Route::post('/api/follow/iFollow/{id}', 'API\FollowAPIController@iFollow')->middleware('auth:api');
Route::post('/api/follow/myFollow/{id}', 'API\FollowAPIController@myFollow')->middleware('auth:api');
Route::post('/api/follow/doIFollow', 'API\FollowAPIController@doIFollow')->middleware('auth:api');
Route::post('/api/follow/followCount/{id}', 'API\FollowAPIController@followCount')->middleware('auth:api');

// API Replies

Route::get('/api/reply/index', 'API\ReplyAPIController@index')->middleware('auth:api');
Route::post('/api/reply/store', 'API\ReplyAPIController@store')->middleware('auth:api');
Route::post('/api/reply/showOne/{id}', 'API\ReplyAPIController@showOne')->middleware('auth:api');
Route::post('/api/reply/showReplies/{id}', 'API\ReplyAPIController@show')->middleware('auth:api');
Route::post('/api/reply/deleteReply/{id}', 'API\ReplyAPIController@destroy')->middleware('auth:api');
Route::post('/api/reply/replyCount/{id}', 'API\ReplyAPIController@countReply')->middleware('auth:api');

// API Likes

Route::get('/api/like/index', 'API\LikeAPIController@index')->middleware('auth:api');
Route::post('/api/like/store', 'API\LikeAPIController@store')->middleware('auth:api');
Route::post('/api/like/likeCount/{id}', 'API\LikeAPIController@count')->middleware('auth:api');
Route::post('/api/like/likeCheck', 'API\LikeAPIController@doILike')->middleware('auth:api');

// API Image

Route::get('/api/image/index', 'API\ImageAPIController@index')->middleware('auth:api');
Route::post('/api/image/tweetImage', 'API\ImageAPIController@tweetImage')->middleware('auth:api');
Route::post('/api/image/avatarImage/{id}', 'API\ImageAPIController@avatarImage')->middleware('auth:api');
Route::post('/api/image/headerImage/{id}', 'API\ImageAPIController@headerImage')->middleware('auth:api');
Route::post('/api/image/getImage/{id}', 'API\ImageAPIController@getImage')->middleware('auth:api');
Route::post('/api/image/getAvatar/{id}', 'API\ImageAPIController@getAvatar')->middleware('auth:api');
Route::post('/api/image/getHeader/{id}', 'API\ImageAPIController@getHeader')->middleware('auth:api');
