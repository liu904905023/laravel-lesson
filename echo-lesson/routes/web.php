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
//    $order = \App\Order::find(1);
//    event(new \App\Events\OrderUpdate($order));
//    \App\Events\OrderUpdate::dispatch();
    return view('welcome');
});
Route::get('/order/{id}', function ($id) {
    $order = \App\Order::find($id);
    event(new \App\Events\OrderUpdate($order));
//    \App\Events\OrderUpdate::dispatch();
//    return view('welcome');
});

Route::get('/tasks', function () {
    return \App\Task::all()->pluck('body');
});
Route::post('/tasks', function () {
    $task =\App\Task::forceCreate(['body' => request('body')]);
    event(new \App\Events\TaskCreated($task));
//    var_dump($task);
});

Route::get('/projects/{project}', function (\App\Project $project) {

    return view('project.show', compact('project'));
});
Route::get('/api/projects/{project}/tasks', function (\App\Project $project) {

    return $project->tasks->pluck('body');
});
Route::post('/api/projects/{project}/tasks', function (\App\Project $project) {

    $task =$project->tasks()->create(['body' => request('body')]);
    event(new \App\Events\TaskCreated($task));
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/aaa/{user}',function (\App\User $user){
    $bb =  Auth::user()->projectuser;
    return $bb;
});
Route::get('/bbb/{user}',function (\App\User $user){
    $bb = \App\User::with('projectuser')->where('id','>','1')->get();
    return $bb;
});
