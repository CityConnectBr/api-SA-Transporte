<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "";
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::name('auth.')->group(function () {
        Route::post('/login', 'UsuarioController@login')->name('login');
        Route::post('/signin', 'UsuarioController@signin')->name('signin');
        Route::get('/logout', 'UsuarioController@logout')->name('logout');
        Route::get('/refresh', 'UsuarioController@refresh')->name('refresh');
        Route::post('/generaterecovercode', 'UsuarioController@sendTokenToRecoverPassword')->name('sendTokenToRecoverPassword');
        Route::post('/recoverypassword', 'UsuarioController@recoverPassword')->name('recoverPassword');
    });
});

Route::group([
    'middleware' => [
        'auth'
    ],
    'prefix' => 'api'
], function () {
    Route::name('api.')->group(function () {
        Route::get('/me', 'UsuarioController@me')->name('me');
        Route::put('/me', 'UsuarioController@update')->name('me.update');

        Route::resource('/permissionarios', 'PermissionarioController');
    });
});

Route::group([
    'middleware' => [
        "auth.integrador"
    ],
    'prefix' => 'integracao'
], function () {
    Route::name('integracao.')->group(function () {
        Route::resource('/permissionarios', 'PermissionarioController');
    });
});
