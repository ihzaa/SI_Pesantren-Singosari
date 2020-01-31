<?php

Route::prefix('pengajar')->middleware('CekStatusPengajar')->group(function () {

    Route::get('/','PengajarController@index')->name('pengajaridx');
    
    // Route::get('/', 'adminController@adminidx')->name('adminidx');

});
