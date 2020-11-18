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
                
                Route::get('/coresveiculos', 'CorVeiculoController@index');
                Route::get('/coresveiculos/{id}', 'CorVeiculoController@show');
                
                Route::get('/marcasmodeloscarrocerias', 'MarcaModeloCarroceriaController@index');
                Route::get('/marcasmodeloscarrocerias/{id}', 'MarcaModeloCarroceriaController@show');
                
                Route::get('/marcasmodeloschassis', 'MarcaModeloChassiController@index');
                Route::get('/marcasmodeloschassis/{id}', 'MarcaModeloChassiController@show');
                
                Route::get('/marcasmodelosveiculos', 'MarcaModeloVeiculoController@index');
                Route::get('/marcasmodelosveiculos/{id}', 'MarcaModeloVeiculoController@show');
                
                Route::get('/tiposcombustiveis', 'TipoCombustivelController@index');
                Route::get('/tiposcombustiveis/{id}', 'TipoCombustivelController@show');
                
                Route::get('/tiposveiculos', 'TipoVeiculoController@index');
                Route::get('/tiposveiculos/{id}', 'TipoVeiculoController@show');
                
                Route::get('/veiculos', 'CondutorController@index');
                Route::get('/veiculos/{id}', 'CondutorController@show');
                
                Route::get('/condutores', 'CondutorController@index');
                Route::get('/condutores/{id}', 'CondutorController@show');
                
                Route::get('/monitores', 'MonitorController@index');
                Route::get('/monitores/{id}', 'MonitorController@show');
                
                Route::get('/monitores', 'MonitorController@index');
                Route::get('/monitores/{id}', 'MonitorController@show');

                Route::resource('/solicitacaodealteracao', 'SolicitacaoDeAlteracaoController');
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
        Route::resource('/fiscais', 'Integracao\FiscalController');
        Route::resource('/monitores', 'Integracao\MonitorController');
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
