<?php
Route::post('/logincek', 'adminController@cek');
Route::get('/developer', function () {
    return view('front-end.Information.developer');
})->name('liatDev');

Route::get('/lihat/artikel/{id}', 'front_end@liat_artikel')->name('liat_artikel');

Route::get('4dm1n/login', 'adminController@index')->name('loginadmin');
Route::post('/get/pengumuman/baru', 'front_end@load_data')->name('loadpengumuman');
Route::post('/get/artikel/baru', 'front_end@load_data_artikel')->name('loadartikel');

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
    Route::get('/kelola-pembelajaran/{id}', 'adminController@timeline_tahuna_ajaran')->name('timeline_tahuna_ajaran');
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
    Route::get('/kelola-pengumuman/tambah', function () {
        return view('admin.tambahpengumuman');
    })->name('admintambahpengumuman');
    Route::post('/kelola-pengumuman/tambah/ya', 'adminController@admintambahpengumuman')->name('admintambahpengumumanya');
    Route::post('/kelola-pengumuman/memprioritas', 'adminController@adminmemprioritaskan')->name('adminmemprioritaskan');
    Route::post('/kelola-pengumuman/nonprioritas', 'adminController@adminnonprioritaskan')->name('adminnonprioritaskan');
    Route::post('/kelola-pengumuman/hapus', 'adminController@adminhapuspengumuman')->name('adminhapuspengumuman');
    Route::get('/kelola-pengumuman/edit/{id}/{judul}', 'adminController@admineditpengumuman')->name('admineditpengumuman');
    Route::POST('/kelola-pengumuman/edit/ya', 'adminController@admineditpengumumanya')->name('admineditpengumumanya');

    ####################
    Route::get('/kelola-pembelajaran/{id_ta}/kelola-kelas/{id_kls}/mata-pelajaran', 'adminController@kelas_matpel')->name('kelola_kelas_ta');
    Route::post('/kelola-pembelajaran/tambah-matpel-pengajar', 'adminController@kelas_matpel_tambah')->name('kelas_matpel_tambah');
    Route::post('/kelola-pembelajaran/hapus-matpel-pengajar', 'adminController@kelas_matpel_hapus')->name('kelas_matpel_hapus');

    Route::get('/kelola-pembelajaran/{id_ta}/kelola-kelas/{id_kls}/santri', 'adminController@kelas_santri')->name('kelas_santri');
    Route::post('/kelola-pembelajaran/tambah-santri-kelas', 'adminController@tambah_santri_ke_kelas')->name('tambah_santri_ke_kelas');
    Route::post('/kelola-pembelajaran/hapus-santri-kelas', 'adminController@keluar_santri_santri_kelas')->name('keluar_santri_santri_kelas');

    Route::post('/kelola-pembelajaran/kelas/tambah', 'adminController@tambah_kelas_ta')->name('tambah_kelas_ta');
    Route::post('/kelola-pembelajaran/kelas/hapus', 'adminController@hapus_kelas_ta')->name('hapus_kelas_ta');

    #################
    Route::get('/kelola-profil', 'adminController@kelola_profil')->name('kelola_profil');
    Route::post('/kelola-profil/ubah-username', 'adminController@ubah_username')->name('ubah_username');
    Route::post('/kelola-profil/ubah-password', 'adminController@ubah_password')->name('ubah_password');

    #####################
    Route::get('/kelola-artikel', 'adminController@kelola_artikel')->name('kelola_artikel');
    Route::get('/kelola-artikel/tambah/artikel', function () {
        return view('admin.tambah_edit_artikel');
    })->name('tambahArtikel');
    Route::post('/kelola-artikel/tambah', 'adminController@storeArtikel')->name('storeArtikel');
    Route::get('/kelola-artikel/edit/{id}', 'adminController@bukaeditArtikel')->name('bukaeditArtikel');
    Route::post('/kelola-artikel/edit', 'adminController@editArtikel')->name('editArtikel');
    Route::post('/kelola-artikel/hapus', 'adminController@hapusArtikel')->name('hapusArtikel');
    Route::post('/kelola-artikel/hapus-file', 'adminController@hapusFileArtikel')->name('hapusFileArtikel');
});
