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

Route::get('/','PostsController@index');
Route::get('/user/login','UsersController@login');
Route::get('/register','UsersController@register');
Route::get('/verify/{confirm_code}','UsersController@confirmEmail');
Route::post('/register','UsersController@store');
Route::post('/user/login','UsersController@signin');
Route::get('/logout', 'UsersController@logout');
Route::resource('discussions','PostsController');
Route::resource('comment','CommentsController');
//Route::get('/login', 'UsersController@login')->name('login');
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
