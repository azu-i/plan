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


Route::get('/setEvents', 'EventController@setEvents')->middleware('auth');

Route::post('/ajax/addEvent', 'EventController@addEvent');
Route::post('/ajax/editEventDate', 'EventController@editEventDate');

//Planについて
Route::get('/plan','PlanController@getPlan')->middleware('auth');
Route::post('/plan','PlanController@postPlan')->middleware('auth');
Route::get('/plan','PlanController@planHistory')->middleware('auth');
Route::get('/plan/delete', 'PlanController@delete')->middleware('auth');

Route::get('/calendar' , 'EventController@calendar')->middleware('auth');
