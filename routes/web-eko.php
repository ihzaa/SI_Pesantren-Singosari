<?php
Route::get('/', 'front_end@index');
Route::get('/pengumuman/{id}/{nama}', 'front_end@pengumuman');