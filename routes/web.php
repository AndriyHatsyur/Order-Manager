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

//Auth::routes
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// Registration routes...
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');



Route::group(['middleware' => 'auth'], function () {


	Route::get('/orders', 'OrderController@index')->name('orders');
	Route::post('/orders', 'OrderController@create');
	Route::get('/my-orders', 'OrderController@myOrders')->name('myOrders');
	Route::get('/group-orders', 'OrderController@groupOrders')->name('grouOrders');
	Route::delete('/order-del', 'OrderController@destroy');
	Route::post('/zonder/', 'OrderController@zonder');


});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('users', 'AdminUserController@index');
    Route::post('users', 'AdminUserController@create');
    Route::delete('users', 'AdminUserController@destroy');
});