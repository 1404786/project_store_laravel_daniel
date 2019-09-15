<?php

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::any('historic-search', 'BalanceController@searchHistoric')->name('historic.search');
    Route::get('historic', 'BalanceController@historic')->name('admin.historic');

    Route::post('transfer', 'BalanceController@transferStore')->name('transfer.store');
    Route::post('confirm-transfer', 'BalanceController@confirmTransfer')->name('transfer.confirm');
    Route::get('transfer', 'BalanceController@transfer')->name('balance.transfer');

    Route::post('withdraw', 'BalanceController@withdrawStore')->name('withdraw.store');
    Route::get('withdraw', 'BalanceController@withdraw')->name('balance.withdraw');

    Route::post('deposit', 'BalanceController@depositStore')->name('deposit.store');    
    Route::get('deposit', 'BalanceController@deposit')->name('balance.deposit');
    Route::get('balance', 'BalanceController@index')->name('admin.balance');

    Route::get('/', 'AdminController@Index')->name('admin');
});


Route::post('atualizar-perfil', 'Admin\UserController@profileUpdate')->name('profile.update')->middleware('auth');
Route::get('meu-perfil', 'Admin\UserController@profile')->name('profile')->middleware('auth');

Route::get('/', 'Site\SiteController@Index')->name('home');

Auth::routes();

Route::get('/products', 'ProductController@index')->name('products.index');
