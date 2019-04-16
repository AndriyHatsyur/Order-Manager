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


Route::get('/',function (Request $request){

    //return 'home';
    return view('main');
});

Route::post('/app/login', 'Auth\LoginController@login');
Route::get('/app/logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => 'auth', 'prefix' => '/app'], function () {



	Route::get('/orders', 'OrderController@index')->name('orders');
	Route::post('/orders', 'OrderController@create');
	Route::get('/my-orders', 'OrderController@myOrders')->name('myOrders');
	Route::get('/group-orders', 'OrderController@groupOrders')->name('grouOrders');
	Route::delete('/order-del', 'OrderController@destroy');
	Route::post('/zonder/', 'OrderController@zonder');

	// admin routes
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::get('users', 'AdminUserController@index');
        Route::post('users', 'AdminUserController@create');
        Route::delete('users', 'AdminUserController@destroy');
    });

});


