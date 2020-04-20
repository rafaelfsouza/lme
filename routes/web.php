<?php

// Rotas Front
Route::name('front.')->group(function(){
    Route::get('/', function(){
        return redirect('/admin');
    });
    Route::get('/lme', 'FrontController@lme')->name('lme');
});
