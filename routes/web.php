<?php

// Rotas Front
Route::name('front.')->group(function(){
    Route::get('{metal}', 'FrontController@index')->name('index');
    Route::get('/lme', 'FrontController@lme')->name('lme');
});
