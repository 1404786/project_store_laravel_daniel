<?php

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
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


Route::get('/', 'Site\SiteController@Index')->name('home');

Auth::routes();

Route::get('/products', 'ProductController@index')->name('products.index');
