<?php
Route::post('/logincek', 'adminController@cek');

Route::get('4dm1n/login', 'adminController@index')->name('loginadmin');

Route::prefix('4dm1n')->middleware('CekStatusAdmin')->group(function () {

    Route::get('/', 'adminController@adminidx')->name('adminidx');

    Route::get('kelola-santri', 'adminController@adminkelolasantri')->name('adminkelalosantri');
    Route::post('/kelola-santri/changedata', 'adminController@changedatasantri')->name('admin_ubah_data_santri');
    Route::post('/kelola-santri/tambahsantri', 'adminController@tambahsantri')->name('admin_tambah_santri');
    Route::post('/kelola-santri/tambahfilesantri', 'adminController@tambahfilesantri')->name('admin_tambah_file_santri');
    Route::post('/kelola-santri/hapussantri', 'adminController@hapussantri')->name('admin_hapus_santri');
    Route::get('/downloadexcsvsantri', 'adminController@downloadexcsvsantri')->name('exfilecsvsantri');
    #end manage santri

    Route::get('/kelola-pengajar', 'adminController@adminkelolapengajar')->name('adminkelolapengajar');
    Route::post('/kelola-pengajar/changedata', 'adminController@changedatapengajar')->name('admin_ubah_data_pengajar');
    Route::post('/kelola-pengajar/tambahpengajar', 'adminController@tambahpengajar')->name('admin_tambah_pengajar');
    Route::post('/kelola-pengajar/tambahfilepengajar', 'adminController@tambahfilepengajar')->name('admin_tambah_file_pengajar');
    Route::post('/kelola-pengajar/hapuspengajar', 'adminController@hapuspengajar')->name('admin_hapus_pengajar');
    Route::get('/downloadexcsvpengajar', 'adminController@downloadexcsvpengajar')->name('exfilecsvpengajar');
    #end manage pengajar

    Route::get('/kelola-pembelajaran', 'adminController@adminkelolapembelajaran')->name('adminkelolapembelajaran');
    Route::POST('/kelola-pembelajaran/tambah-tahun-ajaran', 'adminController@admin_tambah_tahun_ajaran')->name('admin_tambah_tahun_ajaran');
    Route::POST('/kelola-pembelajaran/edit-tahun-ajaran', 'adminController@admin_edit_tahun_ajaran')->name('admin_edit_tahun_ajaran');
    Route::POST('/kelola-pembelajaran/hapus-tahun-ajaran', 'adminController@admin_hapus_tahun_ajaran')->name('admin_hapus_tahun_ajaran');
    Route::get('/kelola-pembelajaran/{id}-{semester}', 'adminController@timeline_tahuna_ajaran')->name('timeline_tahuna_ajaran');
    Route::POST('/kelola-pembelajaran/kelola-tahun-ajaran/hapus-matpel', 'adminController@adminhapusmatpeldita')->name('adminhapusmatpeldita');
    Route::POST('/kelola-pembelajaran/kelola-tahun-ajaran/tambah-metpen', 'adminController@admin_tambah_mp_ta')->name('admin_tambah_mp_ta');
    Route::post('/kelola-pembelajaran/nonaktif', 'adminController@adminnonaktifpembelajaran')->name('adminnonaktifcarousel');
    Route::post('/kelola-pembelajaran/aktif', 'adminController@adminaktifpembelajaran')->name('adminaktifcarousel');
    #end manage pembelajaran

    Route::get('/kelola-matpel', 'adminController@adminkelolamatpel')->name('adminkelolamatpel');
    Route::POST('/kelola-matpel/tambah', 'adminController@admintambahmatpel')->name('admintambahmatpel');
    Route::POST('/kelola-matpel/edit', 'adminController@admineditmatpel')->name('admineditmatpel');
    Route::POST('/kelola-matpel/hapus', 'adminController@adminhapusmatpel')->name('adminhapusmatpel');
    #end manage matpel

    Route::get('/kelola-carousel', 'adminController@adminkelolacarousel')->name('adminkelolacarousel');
    Route::post('/kelola-carousel/tambah', 'adminController@admintambahcarousel')->name('admintambahcarousel');
    Route::post('/kelola-carousel/edit', 'adminController@admineditcarousel')->name('admineditcarousel');
    Route::post('/kelola-carousel/hapus', 'adminController@adminhapuscarousel')->name('adminhapuscarousel');
    Route::post('/kelola-carousel/nonaktif', 'adminController@adminnonaktifcarousel')->name('adminnonaktifcarousel');
    Route::post('/kelola-carousel/aktif', 'adminController@adminaktifcarousel')->name('adminaktifcarousel');
    #end manage website - carousel

    Route::get('/kelola-donasi', 'adminController@adminkeloladonasi')->name('adminkeloladonasi');

    // Route::post('/kelola-donasi/total/tambah', 'adminController@admintambahtotaldonasi')->name('admintambahtotaldonasi');
    Route::post('/kelola-donasi/total/edit', 'adminController@adminedittotaldonasi')->name('adminedittotaldonasi');
    // Route::post('/kelola-donasi/total/hapus', 'adminController@adminhapustotaldonasi')->name('adminhapustotaldonasi');

    Route::post('/kelola-donasi/masuk/tambah', 'adminController@admintambahdonasimasuk')->name('admintambahdonasimasuk');
    Route::post('/kelola-donasi/masuk/edit', 'adminController@admineditdonasimasuk')->name('admineditdonasimasuk');
    Route::post('/kelola-donasi/masuk/hapus', 'adminController@adminhapusdonasimasuk')->name('adminhapusdonasimasuk');
    Route::POST('/kelola-donasi/info/edit', 'adminController@simpankolokkiridonasi')->name('simpankolokkiridonasi');
    #end manage website - donasi

    Route::get('/kelola-pengumuman', 'adminController@adminkelolapengumuman')->name('adminkelolapengumuman');
});
