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
        Route::get('/user', 'UsuarioController@user')->name('user');
        Route::put('/user', 'UsuarioController@update')->name('user.update');
        Route::patch('/password', 'UsuarioController@updatePassword')->name('user.updatePassword');

        // permissionarios
        Route::group([
            'middleware' => [
                'permissionario'
            ],
            'prefix' => 'permissionarios'
        ], function () {
            Route::name('permissionarios.')->group(function () {

                // Route::get('/condutores', 'CondutorController@index')->name('condutores.index');

                Route::resource('/veiculos', 'VeiculoController');
                Route::resource('/coresveiculos', 'CorVeiculoController');
                Route::resource('/marcasmodeloscarrocerias', 'MarcaModeloCarroceriaController');
                Route::resource('/marcasmodeloschassis', 'MarcaModeloChassiController');
                Route::resource('/marcasmodelosveiculos', 'MarcaModeloVeiculoController');
                Route::resource('/tiposcombustiveis', 'TipoCombustivelController');
                Route::resource('/tiposveiculos', 'TipoVeiculoController');

                Route::resource('/condutores', 'CondutorController');

                // Route::get('/condutores', 'CondutorController@index')->name('condutores.index');

                Route::resource('/solicitacaodealteracao', 'SolicitacaoDeAlteracaoController');

                // Route::get('/user', 'UsuarioController@user')->name('user');
            });
        });

        // condutor

        // fiscal
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
        Route::resource('/tiposdesolicitacao', 'Integracao\TiposDeSolicitacaoDeAlteracaoController');
        Route::resource('/solicitacaodealteracao', 'Integracao\SolicitacaoDeAlteracaoController');
        Route::put('/solicitacaodealteracao/{id}/setsinc', 'Integracao\SolicitacaoDeAlteracaoController@setSinc')->name('solicitacaodealteracao.setSinc');
        Route::put('/solicitacaodealteracao/{id}/setstatus/{status}', 'Integracao\SolicitacaoDeAlteracaoController@setStatus')->name('solicitacaodealteracao.setStatus');
    });
});

Route::group([
    'middleware' => [
        "accessdoc"
    ],
    'prefix' => 'solicitacaodealteracao'
], function () {
    Route::name('solicitacaodealteracao.')->group(function () {
        Route::get('/getdoc/{id}', 'SolicitacaoDeAlteracaoController@getdoc');
    });
});
