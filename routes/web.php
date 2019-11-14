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

Route::group(['middleware' => 'web'], function () {

	Route::get('/', 'shopifyAppInstallContoller@index');
	Route::any('/install', 'shopifyAppInstallContoller@install');
	Route::get('/getToken', 'shopifyAppInstallContoller@getToken');
	Route::any('/appMain','appMainController@index')->name('appMain');
	
});