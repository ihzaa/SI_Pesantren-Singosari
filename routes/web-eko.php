<?php
Route::get('/', 'front_end@index');
Route::get('/informasi/{id}/{nama}', 'front_end@pengumuman');
