<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "";
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::name('auth.')->group(function () {
        Route::post('/login', 'UsuarioController@login');
        Route::post('/signin', 'UsuarioController@signin');
        Route::get('/logout', 'UsuarioController@logout');
        Route::get('/refresh', 'UsuarioController@refresh');
        Route::post('/generaterecovercode', 'UsuarioController@generateRecoverCode');
        Route::post('/validaterecoverycode', 'UsuarioController@validateRecoveryCode');
        Route::post('/recoverypassword', 'UsuarioController@recoverPassword');
    });
});

Route::group([
    'middleware' => [
        'auth'
    ],
    'prefix' => 'api'
], function () {
    Route::name('api.')->group(function () {
        Route::get('/user', 'UsuarioController@user');
        Route::get('/photouser', 'UsuarioController@photoUser');
        Route::post('/user/v1/solicitacaodealteracao', 'v1\SolicitacaoDeAlteracaoController@storeFromUser');
        Route::patch('/password', 'UsuarioController@updatePassword');

        // permissionarios
        Route::group([
            'middleware' => [
                'permissionario'
            ],
            'prefix' => 'permissionarios'
        ], function () {
            Route::name('permissionarios.')->group(function () {

                // Route::get('/condutores', 'CondutorController@index')->name('condutores.index');

                Route::get('/v1/coresveiculos', 'v1\CorVeiculoController@index');
                Route::get('/v1/coresveiculos/{id}', 'v1\CorVeiculoController@show');

                Route::get('/v1/marcasmodeloscarrocerias', 'v1\MarcaModeloCarroceriaController@index');
                Route::get('/v1/marcasmodeloscarrocerias/{id}', 'v1\MarcaModeloCarroceriaController@show');

                Route::get('/v1/marcasmodeloschassis', 'v1\MarcaModeloChassiController@index');
                Route::get('/v1/marcasmodeloschassis/{id}', 'v1\MarcaModeloChassiController@show');

                Route::get('/v1/marcasmodelosveiculos', 'v1\MarcaModeloVeiculoController@index');
                Route::get('/v1/marcasmodelosveiculos/{id}', 'v1\MarcaModeloVeiculoController@show');

                Route::get('/v1/tiposcombustiveis', 'v1\TipoCombustivelController@index');
                Route::get('/v1/tiposcombustiveis/{id}', 'v1\TipoCombustivelController@show');

                Route::get('/v1/tiposveiculos', 'v1\TipoVeiculoController@index');
                Route::get('/v1/tiposveiculos/{id}', 'v1\TipoVeiculoController@show');

                Route::get('/v1/veiculos', 'v1\CondutorController@index');
                Route::get('/veiculos/{id}', 'v1\CondutorController@show');

                Route::get('/v1/condutores', 'v1\CondutorController@index');
                Route::get('/v1/condutores/{id}', 'v1\CondutorController@show');
                Route::get('/v1/condutores/{id}/foto', 'v1\CondutorController@showPhoto');

                Route::get('/v1/monitores', 'v1\MonitorController@index');
                Route::get('/v1/monitores/{id}', 'v1\MonitorController@show');
                Route::get('/v1/monitores/{id}/foto', 'v1\MonitorController@showPhoto');

                Route::get('/v1/monitores', 'v1\MonitorController@index');
                Route::get('/v1/monitores/{id}', 'v1\MonitorController@show');

                Route::resource('/v1/solicitacaodealteracao', 'v1\SolicitacaoDeAlteracaoController');

                Route::get('/v1/arquivo/{id}', 'v1\ArquivoController@show');

            });
        });

        // condutor
        Route::group([
            'middleware' => [
                'condutor'
            ],
            'prefix' => 'condutores'
        ], function () {
            Route::name('condutores.')->group(function () {


            });
        });

        // fiscal
        Route::group([
            'middleware' => [
                'fiscal'
            ],
            'prefix' => 'fiscais'
        ], function () {
            Route::name('fiscais.')->group(function () {

                Route::get('/veiculos', 'CondutorController@index');
                Route::get('/veiculos/{id}', 'CondutorController@show');

            });
        });
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
        Route::post('/monitores/{id}/foto', 'Integracao\ArquivoController@storeFotoMonitor')->name('monitor.storeFoto');
        Route::resource('/permissionarios', 'Integracao\PermissionarioController');
        Route::post('/permissionarios/{id}/foto', 'Integracao\ArquivoController@storeFotoPermissionario')->name('arquivo.storeFotoPermissionario');
        Route::resource('/coresveiculos', 'Integracao\CorVeiculoController');
        Route::resource('/marcasmodeloscarrocerias', 'Integracao\MarcaModeloCarroceriaController');
        Route::resource('/marcasmodeloschassis', 'Integracao\MarcaModeloChassiController');
        Route::resource('/marcasmodelosveiculos', 'Integracao\MarcaModeloVeiculoController');
        Route::resource('/tiposcombustiveis', 'Integracao\TipoCombustivelController');
        Route::resource('/tiposveiculos', 'Integracao\TipoVeiculoController');
        Route::resource('/condutores', 'Integracao\CondutorController');
        Route::post('/condutores/{id}/foto', 'Integracao\ArquivoController@storeFotoCondutor')->name('condutores.storeFoto');
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
        "apisat"
    ],
    'prefix' => 'apisat'
], function () {
    Route::name('solicitacaodealteracao.')->group(function () {
        Route::get('/arquivo/{id}', 'SaT\ArquivoController@show');
    });
});
