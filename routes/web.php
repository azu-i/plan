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


Auth::routes();


Route::get('/', 'EventController@calendar')->name('home')->middleware('auth');


// カレンダー関連
Route::get('/setEvents', 'EventController@setEvents');
Route::get('/setBirthday', 'EventController@setBirthday');

//Planについて
Route::get('/plan','PlanController@getPlan')->middleware('auth');
Route::post('/plan','PlanController@postPlan')->middleware('auth');
Route::get('/plan','PlanController@planHistory')->middleware('auth');
Route::get('/plan/delete', 'PlanController@delete')->middleware('auth');

Route::get('/calendar', 'EventController@calendar')->middleware('auth');

//follow関連
Route::get('/users', 'UsersController@userlist')->middleware('auth');
Route::get('users/{user_id}/follow', 'UsersController@follow')->name('follow');
Route::get('users/{user_id}/unfollow', 'UsersController@unfollow')->name('unfollow');

//Follow承認関連
Route::get('follower/{user_id}/accept', 'FollowerAcceptController@accept');
Route::get('follower/{user_id}/unaccept', 'FollowerAcceptController@unaccept');

// user編集
Route::get('users/{user_id}/edit', 'UsersController@edit')->middleware('auth');
Route::post('users/{user_id}/update', 'UsersController@update');
Route::get('users/{user_id}/detail','UsersController@show')->middleware('auth');






