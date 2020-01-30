<?php

Route::prefix('pengajar')->middleware('CekStatusPengajar')->group(function () {

Route::get('/','PengajarController@index');



});
