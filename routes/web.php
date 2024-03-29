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
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){

	Route::any('historic_search', 'BalanceController@searchHistoric')->name('historic.search');
	Route::get('historic', 'BalanceController@historic')->name('admin.historic');

	Route::post('transfer', 'BalanceController@transferStore')->name('transfer.store');
	Route::post('confirm-transfer', 'BalanceController@confirmTransfer')->name('confirm.transfer');
	Route::get('transfer', 'BalanceController@transfer')->name('balance.transfer');

	Route::post('withdraw', 'BalanceController@withdrawStore')->name('withdraw.store');
	Route::get('withdraw', 'BalanceController@withdraw')->name('balance.withdraw');

	Route::post('deposit', 'BalanceController@depositStore')->name('deposit.store');
	Route::get('deposit', 'BalanceController@deposit')->name('balance.deposit');
	Route::get('balance', 'BalanceController@index')->name('admin.balance');
	Route::get('/', 'AdminController@index')->name('admin.home');
});

Route::post('atualizar-prefil', 'Admin\UserController@profileUpdate')->name('profile.update')->middleware('auth');
Route::get('meu-perfil', 'Admin\UserController@profile')->name('profile')->middleware('auth');

Route::get('/', 'SiteController@index')->name('home');

Auth::routes();