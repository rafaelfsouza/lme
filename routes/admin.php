<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'middleware' => 'redirectBack'], function() {

    Route::get('/', function (){
        return redirect()->route('admin.dashboard');
    });

    Route::get('back', function () {
        return redirect()->intended();
    })->name('back');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

    // Register
    //Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
    //Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');

    // Verify
    // Route::get('email/resend', 'Auth\VerificationController@resend')->name('admin.verification.resend');
    // Route::get('email/verify', 'Auth\VerificationController@show')->name('admin.verification.notice');
    // Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('admin.verification.verify');

    Route::middleware(['admin.auth', 'auth:admin'])->name('admin.')->group(function () {

        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::post('upload', 'HomeController@upload')->name('upload');
        Route::put('upload', 'HomeController@upload')->name('upload');
        Route::delete('upload', 'HomeController@uploadDelete')->name('uploadDelete');
        Route::post('download', 'HomeController@download')->name('download');

        Route::namespace('Usuarios')->group(function () {
            Route::get('usuarios/alterar-senha', 'UsuarioController@alterarSenha')->name('senha');
            Route::put('usuarios/alterar', 'UsuarioController@senhaUpdate')->name('senha.update');
        });

    });

    // rotas admin
    Route::middleware(['admin.auth:admin', 'auth:admin', 'permissoes'])->name('admin.')->group(function () {

        Route::namespace('Usuarios')->group(function () {
            Route::resource('perfis', 'PerfilController');
            Route::resource('usuarios', 'UsuarioController');
        });

        Route::namespace('Lme')->group(function () {
            Route::resource('lme', 'LmeController');
        });

    });

});
