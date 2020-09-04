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
        //permissionarios
        Route::get('/permissionarios/me', 'PermissionarioController@me')->name('permissionarios.me');
        Route::patch('/permissionarios', 'PermissionarioController@update')->name('permissionarios.update');
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
        Route::resource('/permissionarios', 'integracao\PermissionarioController');
        Route::resource('/coresveiculos', 'integracao\CorVeiculoController');
        Route::resource('/marcasmodeloscarrocerias', 'integracao\MarcaModeloCarroceriaController');
        Route::resource('/marcasmodeloschassis', 'integracao\MarcaModeloChassiController');
        Route::resource('/marcasmodelosveiculos', 'integracao\MarcaModeloVeiculoController');
        Route::resource('/tiposcombustiveis', 'integracao\TipoCombustivelController');
        Route::resource('/tiposveiculos', 'integracao\TipoVeiculoController');
        Route::resource('/condutores', 'integracao\CondutorController');
        Route::resource('/onibus', 'integracao\OnibusController');
        Route::resource('/veiculos', 'integracao\VeiculoController');
    });
});
