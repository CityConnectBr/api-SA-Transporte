<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourceController;

Route::get('/', function () {
    return "";
});

Route::group([
    'prefix' => 'v{v}/auth'
], function () {
    Route::name('auth.')->group(function () {
        Route::post('/login', ResourceController::getController('UsuarioController@login'));
        Route::post('/signin', ResourceController::getController('UsuarioController@signin'));
        Route::get('/logout', ResourceController::getController('UsuarioController@logout'));
        Route::get('/refresh', ResourceController::getController('UsuarioController@refresh'));
        Route::post('/generaterecovercode', ResourceController::getController('UsuarioController@generateRecoverCode'));
        Route::post('/validaterecoverycode', ResourceController::getController('UsuarioController@validateRecoveryCode'));
        Route::post('/recoverypassword', ResourceController::getController('UsuarioController@recoverPassword'));
    });
});

Route::group([
    'middleware' => [
        'auth'
    ],
    'prefix' => 'v{v}'
], function () {
    Route::name('api.')->group(function () {
        Route::get('/user', ResourceController::getController('UsuarioController@user'));
        Route::get('/photouser', ResourceController::getController('UsuarioController@photoUser'));
        Route::post('/user/solicitacaodealteracao', ResourceController::getController('SolicitacaoDeAlteracaoController@storeFromUser'));
        Route::patch('/password', ResourceController::getController('UsuarioController@updatePassword'));

        // permissionarios
        Route::group([
            'middleware' => [
                'permissionario'
            ],
            'prefix' => 'permissionarios'
        ], function () {
            Route::name('permissionarios.')->group(function () {

                // Route::get('/condutores', 'CondutorController@index')->name('condutores.index');

                Route::get('/coresveiculos', ResourceController::getController('CorVeiculoController@index'));
                Route::get('/coresveiculos/{id}', ResourceController::getController('CorVeiculoController@show'));

                Route::get('/marcasmodeloscarrocerias', ResourceController::getController('MarcaModeloCarroceriaController@index'));
                Route::get('/marcasmodeloscarrocerias/{id}', ResourceController::getController('MarcaModeloCarroceriaController@show'));

                Route::get('/marcasmodeloschassis', ResourceController::getController('MarcaModeloChassiController@index'));
                Route::get('/marcasmodeloschassis/{id}', ResourceController::getController('MarcaModeloChassiController@show'));

                Route::get('/marcasmodelosveiculos', ResourceController::getController('MarcaModeloVeiculoController@index'));
                Route::get('/marcasmodelosveiculos/{id}', ResourceController::getController('MarcaModeloVeiculoController@show'));

                Route::get('/tiposcombustiveis', ResourceController::getController('TipoCombustivelController@index'));
                Route::get('/tiposcombustiveis/{id}', ResourceController::getController('TipoCombustivelController@show'));

                Route::get('/tiposveiculos', ResourceController::getController('TipoVeiculoController@index'));
                Route::get('/tiposveiculos/{id}', ResourceController::getController('TipoVeiculoController@show'));

                Route::get('/veiculos', ResourceController::getController('CondutorController@index'));
                Route::get('/veiculos/{id}', ResourceController::getController('CondutorController@show'));

                Route::get('/condutores', ResourceController::getController('CondutorController@index'));
                Route::get('/condutores/{id}', ResourceController::getController('CondutorController@show'));
                Route::get('/condutores/{id}/foto', ResourceController::getController('CondutorController@showPhoto'));

                Route::get('/monitores', ResourceController::getController('MonitorController@index'));
                Route::get('/monitores/{id}', ResourceController::getController('MonitorController@show'));
                Route::get('/monitores/{id}/foto', ResourceController::getController('MonitorController@showPhoto'));
                
                Route::get('/monitores', ResourceController::getController('MonitorController@index'));
                Route::get('/monitores/{id}', ResourceController::getController('MonitorController@show'));

                Route::resource('/solicitacaodealteracao', ResourceController::getController('SolicitacaoDeAlteracaoController'));
                
                Route::get('/arquivo/{id}', 'ArquivoController@show');
                
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
