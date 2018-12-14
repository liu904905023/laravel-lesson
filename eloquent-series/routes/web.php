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
Auth::LoginUsingId(5);
Route::get('/', function () {
    $post = \App\Post::find(10);
    $comment = $post->comments()->create(['body'=>'use trait']);
    return $comment;
});
Route::get('/lesson', function () {
    $lesson = \App\Lesson::find(1);
    $comment = $lesson->comments()->create(['body'=>'use trait']);
    return $comment;
});
Route::get('/activity', function () {
    $user = Auth::user();
    $activity = $user->activities;
    return $activity;
});

Route::get('/post', function () {
   $post = \App\Post::create([
       'user_id' => Auth::id(),
       'body'=>'use trait body',
       'title'=>'use trait title',

   ]) ;
    return $post;
});