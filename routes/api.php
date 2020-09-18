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
        Route::post('/generaterecovercode', 'UsuarioController@generateRecoverCode')->name('sendTokenToRecoverPassword');
        Route::post('/validaterecoverycode', 'UsuarioController@validateRecoveryCode')->name('validateRecoveryCode');
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
        Route::patch('/password', 'UsuarioController@updatePassword')->name('me.updatePassword');
        //condutor

        //fiscal

    });
});

Route::group([
    'middleware' => [
        "auth.integrador"
    ],
    'prefix' => 'integracao'
], function () {
    Route::name('integracao.')->group(function () {
        Route::resource('/permissionarios', 'Integracao\PermissionarioController');
        Route::resource('/coresveiculos', 'Integracao\CorVeiculoController');
        Route::resource('/marcasmodeloscarrocerias', 'Integracao\MarcaModeloCarroceriaController');
        Route::resource('/marcasmodeloschassis', 'Integracao\MarcaModeloChassiController');
        Route::resource('/marcasmodelosveiculos', 'Integracao\MarcaModeloVeiculoController');
        Route::resource('/tiposcombustiveis', 'Integracao\TipoCombustivelController');
        Route::resource('/tiposveiculos', 'Integracao\TipoVeiculoController');
        Route::resource('/condutores', 'Integracao\CondutorController');
        Route::resource('/onibus', 'Integracao\OnibusController');
        Route::resource('/veiculos', 'Integracao\VeiculoController');
    });
});
