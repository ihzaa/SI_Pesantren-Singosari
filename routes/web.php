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

Route::get('/login', 'UserController@login')->name('userlogin');

Route::post('/login/cek', 'UserController@cek')->name('userlogincek');

Route::prefix('santri')->middleware('CekStatusSantri')->group(function () {
    Route::get('/', 'SantriController@index')->name('santriidx');
});
Route::prefix('pengajar')->middleware('CekStatusPengajar')->group(function () {
    Route::get('/', 'PengajarController@index')->name('pengajaridx');
});


