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

Route::get('/login', 'userController@index')->name('login');

Route::prefix('santri')->group(function () {
    Route::get('/', 'userController@santriidx')->name('santriidx');
});

Route::prefix('pengajar')->group(function () {
    Route::get('/', 'userController@pengajaridx')->name('pengajaridx');
});

Route::prefix('4dm1n')->group(function () {
    Route::get('/', 'userController@adminidx')->name('adminidx');
    Route::get('kelola-santri', 'userController@adminkelolasantri')->name('adminkelalosantri');
    Route::post('/kelola-santri/changedata', 'userController@changedatasantri')->name('admin_ubah_data_santri');
    Route::post('/kelola-santri/tambahsantri', 'userController@tambahsantri')->name('admin_tambah_santri');
    Route::post('/kelola-santri/tambahfilesantri', 'userController@tambahfilesantri')->name('admin_tambah_file_santri');
    Route::post('/kelola-santri/hapussantri', 'userController@hapussantri')->name('admin_hapus_santri');
    Route::get('/downloadexcsvsantri', 'userController@downloadexcsvsantri')->name('exfilecsvsantri');
    #end manage santri


    Route::get('logout', 'userController@logout')->name('adminlogout');


    Route::get('/kelola-pengajar', 'userController@adminkelolapengajar')->name('adminkelolapengajar');
    Route::post('/kelola-pengajar/changedata', 'userController@changedatapengajar')->name('admin_ubah_data_pengajar');
    Route::post('/kelola-pengajar/tambahpengajar', 'userController@tambahpengajar')->name('admin_tambah_pengajar');
    Route::post('/kelola-pengajar/tambahfilepengajar', 'userController@tambahfilepengajar')->name('admin_tambah_file_pengajar');
    Route::post('/kelola-pengajar/hapuspengajar', 'userController@hapuspengajar')->name('admin_hapus_pengajar');
    Route::get('/downloadexcsvpengajar', 'userController@downloadexcsvpengajar')->name('exfilecsvpengajar');
    #end manage pengajar

    Route::get('/kelola-pembelajaran','userController@adminkelolapembelajaran')->name('adminkelolapembelajaran');
    Route::POST('/kelola-pembelajaran/tambah-tahun-ajaran','userController@admin_tambah_tahun_ajaran')->name('admin_tambah_tahun_ajaran');
    Route::POST('/kelola-pembelajaran/edit-tahun-ajaran','userController@admin_edit_tahun_ajaran')->name('admin_edit_tahun_ajaran');
    Route::POST('/kelola-pembelajaran/hapus-tahun-ajaran','userController@admin_hapus_tahun_ajaran')->name('admin_hapus_tahun_ajaran');

    #end manage pembelajaran
});
