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



Route::get('/',function (){

    return view('main');

});


Route::post('/app/login', 'Auth\LoginController@login');
Route::get('/app/logout', 'Auth\LoginController@logout');


Route::group(['middleware' => 'auth', 'prefix' => '/app'], function () {

	Route::get('/orders', 'OrderController@index');
	Route::post('/orders', 'OrderController@create');
    Route::post('/orders-cancel', 'OrderController@cancel');
    Route::post('/orders-success', 'OrderController@success');
    Route::post('/zonder/', 'OrderController@zonder');

	Route::get('/user-orders', 'OrderController@userOrders');

    Route::post('/term/', 'OrderController@setTerm');

    Route::post('/history-order', 'HistoryOrderController@getHistory');

	// admin routes
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::get('users', 'AdminUserController@index');
        Route::post('users', 'AdminUserController@create');
        Route::delete('users', 'AdminUserController@destroy');
    });

});


