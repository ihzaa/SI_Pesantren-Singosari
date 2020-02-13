<?php
Route::get('/', 'front_end@index')->name('halaman_depan');
Route::get('/informasi/{id}/{nama}', 'front_end@pengumuman');
