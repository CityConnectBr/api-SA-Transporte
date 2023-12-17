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
        Route::patch('/tokenfcm', 'UsuarioController@updateTokenFCM');
        // fiscal
        Route::group([
            'middleware' => [
                'authPerfilAdmin'
            ],
            'prefix' => 'admin'
        ], function () {
            Route::name('admin.')->group(function () {
                Route::get('/', function () {
                    return "admin ok";
                });

                //--------- CRUDS BASE -------------------
                Route::resource('/empresas', 'Admin\EmpresaController');
                Route::resource('/perfis', 'Admin\PerfilController');
                Route::resource('/pontos', 'Admin\PontoController');
                Route::resource('/aplicativos', 'Admin\AplicativoController');
                Route::resource('/tiposdecurso', 'Admin\TipoDeCursoController');
                Route::resource('/modalidades', 'Admin\ModalidadeController');
                Route::resource('/entidadesassiciativa', 'Admin\EntidadeAssociativaController');
                Route::resource('/coresdeveiculo', 'Admin\CorDeVeiculoController');
                Route::resource('/marcasmodelosdeveiculo', 'Admin\MarcaModeloVeiculoController');
                Route::resource('/marcasmodelosdechassi', 'Admin\MarcaModeloChassiController');
                Route::resource('/marcasmodelosdecarroceria', 'Admin\MarcaModeloCarroceriaController');
                Route::resource('/tiposdeveiculo', 'Admin\TipoDeVeiculoController');
                Route::resource('/tiposdecombustivel', 'Admin\TipoDeCombustivelController');
                Route::resource('/empresasvistoriadoras', 'Admin\EmpresaVistoriadoraController');
                Route::resource('/vistoriadores', 'Admin\VistoriadorController');
                Route::resource('/tiposdecertidao', 'Admin\TipoDeCertidaoController');
                Route::resource('/entidadescurso', 'Admin\EntidadeCursoController');
                Route::resource('/usuarios', 'Admin\UsuarioController');
                Route::post('/usuarios/assinatura', 'UsuarioController@saveAssinatura');
                Route::get('/usuarios/assinatura/{id}', 'UsuarioController@showAssinatura');
                Route::resource('/enderecos', 'Admin\EnderecoController');
                Route::resource('/quadrodeinfracoes', 'Admin\QuadroDeInfracoesController');
                Route::resource('/naturezasdainfracao', 'Admin\NaturezaDaInfracaoController');
                Route::get('/valoresdainfracao/findbynaturezaandmodalidade', 'Admin\ValoresDaInfracaoController@findByModalidadeAndNatureza')->name('valoresdainfracao.findByModalidadeAndNatureza');
                Route::resource('/valoresdainfracao', 'Admin\ValoresDaInfracaoController');
                Route::resource('/tiposdemoeda', 'Admin\TiposDeMoedaController');
                Route::resource('/taloesdofiscal', 'Admin\TalaoDoFiscalController');

                Route::get('/fmp/validos', 'Admin\FMPController@indexFMPsValidos')->name('indexFMPsValidos');
                Route::resource('/fmp', 'Admin\FMPController');

                Route::resource('/fiscais', 'Admin\FiscalController');
                Route::post('/fiscais/{id}/foto', 'Admin\FiscalController@storeFoto');
                Route::get('/fiscais/{id}/foto', 'Admin\FiscalController@showFoto');

                Route::get('/municipios/uf', 'Admin\MunicipioController@indexByUf'); //precisa estar na frente de /municipios
                Route::resource('/municipios', 'Admin\MunicipioController');

                Route::resource('/permissionarios', 'Admin\PermissionarioController');
                Route::post('/permissionarios/{id}/foto', 'Admin\PermissionarioController@storeFoto');
                Route::get('/permissionarios/{id}/foto', 'Admin\PermissionarioController@showFoto');
                Route::get('/permissionarios/{id}/veiculos', 'Admin\PermissionarioController@indexVeiculos');
                Route::get('/permissionarios/{id}/condutores', 'Admin\PermissionarioController@indexCondutores');
                Route::put('/permissionarios/{id}/documentos', 'Admin\PermissionarioController@updateDocumentos');
                Route::put('/permissionarios/{id}/falecimento', 'Admin\PermissionarioController@updateFalecimento');
                Route::resource('/pontosdopermissionario', 'Admin\PontoDoPermissionarioController');
                Route::resource('/aplicativosdopermissionario', 'Admin\AplicativoDoPermissionarioController');
                Route::resource('/cursosdopermissionario', 'Admin\CursoDoPermissionarioController');
                Route::resource('/alunosdopermissionario', 'Admin\AlunoDoPermissionarioController');
                Route::resource('/alvaradopermissionario', 'Admin\AlvaraDoPermissionarioController');
                Route::resource('/observacoesdopermissionario', 'Admin\ObservacaoDoPermissionarioController');
                Route::resource('/anexosdopermissionario', 'Admin\AnexoDoPermissionarioController');

                Route::get('/lancamentoalvaradopermissionario', 'Admin\AlvaraDoPermissionarioController@indexByStatus');
                Route::get('/lancamentoalvaradopermissionario/{id}', 'Admin\AlvaraDoPermissionarioController@show');
                Route::post('/lancamentoalvaradopermissionario/{id}/lancarpagamento', 'Admin\AlvaraDoPermissionarioController@setPagamento');

                Route::resource('/condutores', 'Admin\CondutorController');
                Route::get('/condutores/permissionario/{permissionarioId}', 'Admin\CondutorController@getByPermissionario');
                Route::post('/condutores/{id}/foto', 'Admin\CondutorController@storeFoto');
                Route::get('/condutores/{id}/foto', 'Admin\CondutorController@showFoto');
                Route::resource('/cursosdocondutor', 'Admin\CursoDoCondutorController');
                Route::resource('/anexosdocondutor', 'Admin\AnexoDoCondutorController');

                Route::resource('/monitores', 'Admin\MonitorController');
                Route::get('/monitoresbypermissionario', 'Admin\MonitorController@indexByPermissionario');
                Route::post('/monitores/{id}/foto', 'Admin\MonitorController@storeFoto');
                Route::get('/monitores/{id}/foto', 'Admin\MonitorController@showFoto');
                Route::resource('/cursosdomonitor', 'Admin\CursoDoMonitorController');
                Route::resource('/anexosdomonitor', 'Admin\AnexoDoMonitorController');

                Route::resource('/pontos', 'Admin\PontoController');
                Route::resource('/coordenadoresdoponto', 'Admin\CoordenadorDoPontoController');

                Route::resource('/veiculos', 'Admin\VeiculoController');
                Route::get('/veiculosporpermissionario', 'Admin\VeiculoController@indexByPermissionario');
                Route::resource('/anexosdoveiculo', 'Admin\AnexoDoVeiculoController');

                Route::get('/solicitacoes', 'Admin\SolicitacaoController@index');
                Route::get('/solicitacoes/bypermissionarioandtipo', 'Admin\SolicitacaoController@indexByPermissionarioAndTipo');
                Route::get('/solicitacoes/{id}', 'Admin\SolicitacaoController@show');
                Route::patch('/solicitacoes/{id}/concluir', 'Admin\SolicitacaoController@concluir');

                Route::get('/arquivos/{id}', 'Admin\ArquivoController@show');
                Route::post('/arquivos', 'Admin\ArquivoController@create');

                Route::resource('/certidoes', 'Admin\CertidaoController');
                Route::post('/infracoes/{id}/lancarpagamento', 'Admin\InfracaoController@setPagamento');
                Route::post('/infracoes/{id}/reprovarpagamento', 'Admin\InfracaoController@reprovarPagamento');
                Route::resource('/infracoes', 'Admin\InfracaoController');
                Route::post('/infracoes/{id}/foto', 'Admin\InfracaoController@storeFoto');
                Route::get('/infracoes/{id}/foto', 'Admin\InfracaoController@showFoto');
                Route::resource('/vistoriadepontos', 'Admin\VistoriaPontoController');

                Route::get('/relatorios/entradasaidadeveiculos', 'Admin\RelatorioController@entradaSaudaDeVeiculos');
                Route::get('/relatorios/alvaraexpirado', 'Admin\RelatorioController@alvaraExpirado');
                Route::get('/relatorios/cursospermissionariovencidos', 'Admin\RelatorioController@cursosPermissionarioVencidos');
                Route::get('/relatorios/cursoscondutorvencidos', 'Admin\RelatorioController@cursosCondutorVencidos');
                Route::get('/relatorios/cursosmonitorvencidos', 'Admin\RelatorioController@cursosMonitorVencidos');
                Route::get('/relatorios/documentosexpirados', 'Admin\RelatorioController@documentosExpirados');

                //impressao 1
                Route::get('/impressoes/lancamentocertidao', 'Admin\ImpressoesController@impressoesCertidao');
                Route::get('/impressoes/lancamentolistacertidoes', 'Admin\ImpressoesController@impressoesListaCertidoes');

                //formulario 1
                Route::get('/formularios/formulariorenovacaopermissao', 'Admin\FormularioController@formularioRenovacaoPermissao');
                //formulario 2
                Route::get('/formularios/formulariorequerimentotransferencia', 'Admin\FormularioController@formularioRequerimentoTransferencia'); //formulario 2
                //formulario 3
                Route::get('/formularios/formulariotransfpermissaotranspescolar', 'Admin\FormularioController@formularioTransfPermissaoTranspEscolar'); //formulario 3
                //formulario 4
                Route::get('/formularios/formulariotransfpermissaotransptaxi', 'Admin\FormularioController@formularioTransfPermissaoTranspTaxi'); //formulario 4
                //formulario 5
                Route::get('/formularios/formularioreqsubsveiculo', 'Admin\FormularioController@formularioRequerimentoSubstituicaoVeiculo'); //formulario 5
                //formulario 6
                Route::get('/formularios/formularioreqprorrsubsveiculo', 'Admin\FormularioController@formularioRequerimentoProrrogacaoSubstituicaoVeiculo'); //formulario 6
                //formulario 7
                Route::get('/formularios/formulariodeclaracaomonitor', 'Admin\FormularioController@formulariodeclaracaomonitor');
                //formulario 8
                Route::get('/formularios/condutorauxiliar', 'Admin\FormularioController@condutorauxiliar');
                //formulario 9
                Route::get('/formularios/declaracaoatenddosposto', 'Admin\FormularioController@declaracaoAtendimentoAoDisposto');
                //formulario 16
                Route::get('/formularios/solicitacaoressarcimento', 'Admin\FormularioController@solicitacaoDeRessarcimento');
                //formulario 17
                Route::get('/formularios/solicitacaodebaixadecondutorauxiliar', 'Admin\FormularioController@solicitacaodebaixadecondutorauxiliar');
                //formulario 18
                Route::get('/formularios/soltranspescestensino', 'Admin\FormularioController@solicitacaoDeTransporteEscolarProprioEstabelecimentoEnsino');
                //formulario 119
                Route::get('/formularios/solicitacaoadesivacao', 'Admin\FormularioController@solicitacaoDeAdesivacao');
                //formulario 120
                Route::get('/formularios/solicitacaoafericaotaximetro', 'Admin\FormularioController@solicitacaoDeAfericaoTaximetro');
                //formulario 121
                Route::get('/formularios/solicitacaodeautorizacaoprovisoria', 'Admin\FormularioController@solicitacaoDeAutorizacaoProvisoria');
                //formulario 122
                Route::get('/formularios/solicitacaodeautorizacaoprovisoriaescolar', 'Admin\FormularioController@solicitacaoDeAutorizacaoProvisoriaEscolar');
                //formulario 123
                //
                //formulario 124
                //
                //formulario 125
                //
                //formulario 126
                Route::get('/formularios/declaracaoptaxista', 'Admin\FormularioController@declaracaoParaTaxista');
                //formulario 127
                Route::get('/formularios/declaracaoptransporteescular', 'Admin\FormularioController@declaracaoParaTransporteEscolar');
                //formulario 128
                Route::get('/formularios/formularioderequerimento', 'Admin\FormularioController@formularioDeRequerimento');
                //formulario 129
                Route::get('/formularios/laudovistoriatransportesespeciais', 'Admin\FormularioController@laudoDeVistoriaTransportesEspeciais');
                //formulario 130
                Route::get('/formularios/notificacao', 'Admin\FormularioController@notificacao');
                //formulario 131
                Route::get('/formularios/substituicaodeveiculo', 'Admin\FormularioController@substituicaoDeVeiculo');
                //formulario 132
                Route::get('/formularios/termocredenciamentotaxi', 'Admin\FormularioController@termoDeCredenciamentoTaxi');
                //formulario 133
                Route::get('/formularios/termocredenciamentotranspescolar', 'Admin\FormularioController@termoDeCredenciamentoTransporteEscolar');
                //formulario 134
                Route::get('/formularios/aip', 'Admin\FormularioController@aip');
                //formulario 135
                Route::get('/formularios/alvaradopermissionario', 'Admin\FormularioController@alvaraDoPermissionario');
                //formulario 136
                Route::get('/formularios/fichapermissionario', 'Admin\FormularioController@filhaPermissionario');

                //Historico de Alterações
                Route::get('/permissionariohistorico', 'Admin\PermissionarioHistoricoController@index');
            
                //Mensagens
                Route::post('/mensagens', 'Admin\MensagemController@enviar');
                Route::get('/mensagens', 'Admin\MensagemController@index');
            
            });
        });

        // permissionarios
        Route::group([
            'middleware' => [
                'permissionario'
            ],
            'prefix' => 'permissionarios'
        ], function () {
            Route::name('permissionarios.')->group(function () {
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

                Route::get('/v1/veiculos', 'v1\VeiculoController@index');
                Route::get('/v1/veiculos/{id}', 'v1\VeiculoController@show');

                Route::get('/v1/condutores', 'v1\CondutorController@index');
                Route::get('/v1/condutores/{id}', 'v1\CondutorController@show');
                Route::get('/v1/condutores/{id}/foto', 'v1\CondutorController@showPhoto');

                Route::get('/v1/monitores', 'v1\MonitorController@index');
                Route::get('/v1/monitores/{id}', 'v1\MonitorController@show');
                Route::get('/v1/monitores/{id}/foto', 'v1\MonitorController@showPhoto');

                Route::get('/v1/monitores', 'v1\MonitorController@index');
                Route::get('/v1/monitores/{id}', 'v1\MonitorController@show');              

                Route::get('/v1/pontos', 'v1\PontoController@pontosByPermissionario');

                Route::resource('/v1/solicitacaodealteracao', 'v1\SolicitacaoDeAlteracaoController');

                Route::get('/v1/arquivo/{id}', 'v1\ArquivoController@show');

                Route::get('/formularios/formulariorenovacaopermissao', 'Admin\FormularioController@formulariorenovacaopermissao');
                Route::get('/formularios/formulariodeclaracaomonitor', 'Admin\FormularioController@formulariodeclaracaomonitor');
                Route::get('/formularios/condutorauxiliar', 'Admin\FormularioController@condutorauxiliar');
                Route::get('/formularios/solicitacaodebaixadecondutorauxiliar', 'Admin\FormularioController@solicitacaodebaixadecondutorauxiliar');

                Route::get('/v1/infracoes', 'v1\InfracaoController@index');
                Route::get('/v1/infracoes/{id}', 'v1\InfracaoController@show');
                Route::post('/v1/infracoes/{id}/setpagamento', 'v1\InfracaoController@updatePagamento');
                
                Route::get('/v1/alvara/{id}', 'v1\AlvaraController@show');
                Route::post('/v1/alvara/{id}/setpagamento', 'v1\AlvaraController@updatePagamento');
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
                Route::resource('/v1/solicitacaodealteracao', 'v1\SolicitacaoDeAlteracaoController');

                Route::get('/v1/condutores', 'v1\CondutorController@index');
                Route::get('/v1/condutores/{id}', 'v1\CondutorController@show');
                Route::get('/v1/condutores/{id}/foto', 'v1\CondutorController@showPhoto');
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
                Route::get('/v1/veiculos', 'v1\VeiculoController@index');
                Route::get('/v1/veiculos/{id}', 'v1\VeiculoController@show');
                Route::get('/v1/pontos', 'v1\PontoController@index');
                Route::get('/v1/pontos/{id}', 'v1\PontoController@show');

                Route::resource('/v1/solicitacaodealteracao', 'v1\SolicitacaoDeAlteracaoController');
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

        //REVALIDADOS
        Route::resource('/coresveiculos', 'Admin\CorDeVeiculoController');
        Route::resource('/empresas', 'Integracao\EmpresaController');
        Route::resource('/entidadesassiciativa', 'Admin\EntidadeAssociativaController');
        Route::resource('/empresasvistoriadoras', 'Integracao\EmpresaVistoriadoraController');
        Route::resource('/entidadescurso', 'Admin\EntidadeCursoController');
        Route::resource('/fmp', 'Integracao\FMPController');
        Route::resource('/marcasmodeloscarrocerias', 'Integracao\MarcaModeloCarroceriaController');
        Route::resource('/marcasmodeloschassis', 'Integracao\MarcaModeloChassiController');
        Route::resource('/marcasmodelosveiculos', 'Integracao\MarcaModeloVeiculoController');
        Route::resource('/municipios', 'Admin\MunicipioController');
        Route::resource('/observacoesdopermissionario', 'Integracao\ObservacaoDoPermissionarioController');
        Route::resource('/pontos', 'Integracao\PontoController');
        Route::resource('/quadrodeinfracoes', 'Admin\QuadroDeInfracoesController');
        Route::resource('/tiposdecurso', 'Integracao\TipoDeCursoController');
        Route::resource('/tiposcombustiveis', 'Integracao\TipoCombustivelController');
        Route::resource('/tiposveiculos', 'Integracao\TipoVeiculoController');
        Route::resource('/valoresdainfracao', 'Admin\ValoresDaInfracaoController');
        Route::resource('/vistoriadores', 'Admin\VistoriadorController');
        Route::resource('/permissionarios', 'Integracao\PermissionarioController');
        Route::post('/permissionarios/{id}/foto', 'Integracao\ArquivoController@storeFotoPermissionario')->name('arquivo.storeFotoPermissionario');
        Route::resource('/fiscais', 'Integracao\FiscalController');
        Route::resource('/taloesdofiscal', 'Integracao\TalaoDoFiscalController');
        Route::resource('/condutores', 'Integracao\CondutorController');
        Route::post('/condutores/{id}/foto', 'Integracao\ArquivoController@storeFotoCondutor')->name('condutores.storeFoto');
        Route::resource('/monitores', 'Integracao\MonitorController');
        Route::post('/monitores/{id}/foto', 'Integracao\ArquivoController@storeFotoMonitor')->name('monitor.storeFoto');
        Route::resource('/veiculos', 'Integracao\VeiculoController');
        Route::resource('/onibus', 'Integracao\OnibusController');
        Route::resource('/cursodopermissionario', 'Integracao\CursoDoPermissionarioController');
        Route::resource('/cursodocondutor', 'Integracao\CursoDoCondutorController');
        Route::resource('/certidoes', 'Integracao\CertidaoController');
        Route::resource('/coordenadoresdeponto', 'Integracao\CoordenadorDePontoController');
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
    Route::name('permissaodeoperacao.')->group(function () {
        Route::get('/permissaodeoperacao/{param}', 'SaT\ConsultasAppController@permissaoDeOperacao');
    });
});
