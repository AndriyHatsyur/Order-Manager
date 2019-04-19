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

use Carbon\Carbon;
Route::get('/',function (Request $request){


    return view('main');


});

//Route::get('/app/test', 'OrderController@cancel');

Route::post('/app/login', 'Auth\LoginController@login');
Route::get('/app/logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => 'auth', 'prefix' => '/app'], function () {



	Route::get('/orders', 'OrderController@index')->name('orders');
	Route::post('/orders', 'OrderController@create');
    Route::delete('/orders', 'OrderController@cancel');
    Route::post('/orders-success', 'OrderController@success');
    Route::post('/zonder/', 'OrderController@zonder');

	Route::get('/my-orders', 'OrderController@myOrders')->name('myOrders');
	Route::get('/group-orders', 'OrderController@groupOrders')->name('grouOrders');


    Route::post('/term/', 'OrderController@setTerm');

	// admin routes
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::get('users', 'AdminUserController@index');
        Route::post('users', 'AdminUserController@create');
        Route::delete('users', 'AdminUserController@destroy');
    });

});


