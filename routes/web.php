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

Route::post('/logincek', 'userController@cek');

Route::get('/login','userController@index')->name('login');

Route::prefix('santri')->group(function () {
	Route::get('/','userController@santriidx')->name('santriidx');

});

Route::prefix('pengajar')->group(function () {
	Route::get('/','userController@pengajaridx')->name('pengajaridx');

});

Route::prefix('admin')->group(function () {
	Route::get('/','userController@adminidx')->name('adminidx');

});