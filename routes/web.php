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

Auth::routes(['verify' => true]);

Route::get('/dashboard', 'HomeController@index')->name('home')->middleware('auth', 'verified');

Route::group(['prefix' => 'profile', 'namespace' => 'Profile'], function () {

    Route::get('/view-profile/{id}', 'ProfileController@show')->middleware('auth', 'verified');

    Route::get('/edit-profile/{id}', 'ProfileController@edit')->middleware('auth', 'verified');
    Route::put('/edit-profile/{id}', 'ProfileController@update')->middleware('auth', 'verified');
});