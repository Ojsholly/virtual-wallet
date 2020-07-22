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

    Route::get('/{id}', 'ProfileController@show')->middleware('auth', 'verified');

    Route::get('/edit-profile/{id}', 'ProfileController@edit')->middleware('auth', 'verified');
    Route::put('/edit-profile/{id}', 'ProfileController@update')->middleware('auth', 'verified');

    Route::get('/bank-accounts/{id}', 'ProfileController@bank_accounts')->middleware('auth', 'verified');
});

Route::group(['prefix' => 'bank-accounts', 'namespace' => 'Account'], function () {

    Route::get('/', 'AccountController@index')->middleware('auth', 'verified');
    Route::post('/new-account', 'AccountController@store')->middleware('auth', 'verified');
});

Route::group(['prefix' => 'transactions', 'namespace' => 'Transaction'], function () {

    Route::get('/', 'TransactionController@index')->middleware('auth', 'verified');

    Route::get('/deposit', 'TransactionController@create')->middleware('auth', 'verified');

    Route::get('/transfer', 'TransactionController@transfer')->middleware('auth', 'verified', 'password.confirm');

    Route::post('/confirmation', 'TransactionController@confirm')->middleware('auth', 'verified');

    Route::get('/status', array('as' =>  'transactions.status', 'uses' => 'TransactionController@status'))->middleware('auth', 'verified');

    Route::post('/transfer-money', 'TransactionController@transfer_money')->middleware('auth', 'verified');
});