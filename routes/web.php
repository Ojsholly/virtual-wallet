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

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'profile', 'namespace' => 'Profile'], function () {

    Route::get('/{id}', 'ProfileController@show');

    Route::get('/edit-profile/{id}', 'ProfileController@edit');
    Route::put('/edit-profile/{id}', 'ProfileController@update');

    Route::get('/bank-accounts/{id}', 'ProfileController@bank_accounts');
});

Route::group(['prefix' => 'bank-accounts', 'namespace' => 'Account'], function () {

    Route::get('/', 'AccountController@index')->middleware('password.confirm');
    Route::post('/save-bank-account', 'AccountController@store');
});

Route::group(['prefix' => 'transactions', 'namespace' => 'Transaction'], function () {

    Route::get('/', 'TransactionController@index');

    Route::get('/deposit', 'TransactionController@create');

    Route::get('/transfer', 'TransactionController@transfer')->middleware('password.confirm');

    Route::post('/confirmation', 'TransactionController@confirm');

    Route::get('/status', array('as' =>  'transactions.status', 'uses' => 'TransactionController@status'));

    Route::post('/transfer-money', 'TransactionController@transfer_money');

    Route::get('/withdraw', 'TransactionController@withdraw')->middleware('password.confirm');

    Route::post('/withdraw', 'TransactionController@confirmation');

    Route::post('/withdraw-money', 'TransactionController@withdraw_money');
});