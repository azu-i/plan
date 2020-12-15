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

Auth::routes();


Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

// カレンダー関連
Route::get('/setEvents', 'EventController@setEvents');
Route::post('/ajax/addEvent', 'EventController@addEvent');
Route::post('/ajax/editEventDate', 'EventController@editEventDate');

//Planについて
Route::get('/plan','PlanController@getPlan')->middleware('auth');
Route::post('/plan','PlanController@postPlan')->middleware('auth');
Route::get('/plan','PlanController@planHistory')->middleware('auth');
Route::get('/plan/delete', 'PlanController@delete')->middleware('auth');

Route::get('/calendar' , 'EventController@calendar')->middleware('auth');

//follow関連
Route::get('/users', 'UsersController@userlist')->middleware('auth');
Route::get('users/{user_id}/follow', 'UsersController@follow')->name('follow');
Route::get('users/{user_id}/unfollow', 'UsersController@unfollow')->name('unfollow');

//Follow承認関連
Route::get('follower_accept', 'FollowerAcceptController@index')->middleware('auth');
Route::post('follower_accept/accept', 'FollowerAcceptController@accept')->middleware('auth');

// user編集
Route::get('users/{user_id}/edit', 'UsersController@edit')->middleware('auth');
Route::post('users/{user_id}/update', 'UsersController@update');
Route::get('users/{user_id}/detail','UsersController@show')->middleware('auth');






