<?php

Route::prefix('pengajar')->middleware('CekStatusPengajar')->group(function () {

    Route::get('/','PengajarController@index')->name('pengajaridx');

});

Route::prefix('santri')->middleware('CekStatusSantri')->group(function(){
    
    Route::get('/', 'SantriController@index')->name('santriidx');

});