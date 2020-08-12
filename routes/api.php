<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "";
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::name('auth.')->group(function () {
        Route::post('/login', 'UserController@login')->name('login');
        Route::post('/signin', 'UserController@signin')->name('signin');
        Route::get('/logout', 'UserController@logout')->name('logout');
        Route::get('/refresh', 'UserController@refresh')->name('refresh');
    });
});

Route::group([
    'middleware' => [
        'auth'
    ],
    'prefix' => 'api'
], function () {
    Route::name('api.')->group(function () {
        Route::get('/me', 'UserController@me')->name('me');
        Route::put('/me', 'UserController@update')->name('me.update');
        
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
