<?php

// Rotas Front
Route::name('front.')->group(function(){
    Route::get('/consultar/{metal}', 'FrontController@index')->name('index');
    Route::get('/lme/cron', 'FrontController@lme')->name('lme');
});
