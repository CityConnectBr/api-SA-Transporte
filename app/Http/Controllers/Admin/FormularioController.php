<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Condutor;
use App\Models\Empresa;
use App\Models\EmpresaVistoriadora;
use App\Models\Endereco;
use App\Models\Infracao;
use App\Models\Modalidade;
use App\Models\Monitor;
use App\Models\Municipio;
use App\Models\Permissionario;
use App\Models\Ponto;
use App\Models\PontoDoPermissionario;
use App\Models\SolicitacaoDeAlteracao;
use App\Models\Veiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class FormularioController extends Controller
{
    function __construct(Request $request)
    {
        $this->objectModel = Veiculo::class;
        $this->request = $request;
    }

    //formulario1
    function formularioRenovacaoPermissao()
    {
        if ($this->request['id'] == null) {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
        $id = $this->request['id'];

        $obj = Permissionario::find($id);
        if ($obj == null) {
            return parent::responseMsgJSON("Não encontrado", 404);
        }

        /*if ($obj['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }*/

        if ($obj['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $veiculosDoPermissionario = Veiculo::searchByIdPermissionario($id, '');

        $placas = [];
        foreach ($veiculosDoPermissionario as $veiculo) {
            $placas[] = $veiculo->placa;
        }

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario01renovacaopermissao";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('obj', 'placas', 'dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario2
    function formularioRequerimentoTransferencia()
    {

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario02requerimentodetransferencia";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario3
    function formularioTransfPermissaoTranspEscolar()
    {

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario03formulariotransfpermissaotranspescolar";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario4
    function formularioTransfPermissaoTranspTaxi()
    {

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario04formulariotransfpermissaotransptaxi";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario5
    function formularioRequerimentoSubstituicaoVeiculo()
    {

        if ($this->request['id'] == null) {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
        $id = $this->request['id'];

        $obj = Veiculo::findComplete($id);
        if ($obj == null) {
            return parent::responseMsgJSON("veículo não encontrado", 404);
        }

        if ($obj['ativo'] == 0) {
            return parent::responseMsgJSON("Veículo inativo", 404);
        }

        if ($obj->permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($obj['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario05reqsubveiculo";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('obj', 'dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario5
    function formularioRequerimentoProrrogacaoSubstituicaoVeiculo()
    {

        if ($this->request['id'] == null) {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
        $id = $this->request['id'];

        $obj = Veiculo::findComplete($id);
        if ($obj == null) {
            return parent::responseMsgJSON("veículo não encontrado", 404);
        }

        if ($obj['ativo'] == 0) {
            return parent::responseMsgJSON("Veículo inativo", 404);
        }

        if ($obj->permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($obj['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario06reqprorrsubveiculo";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('obj', 'dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario7
    function formulariodeclaracaomonitor()
    {

        if ($this->request['id'] == null) {
            return parent::responseMsgJSON("Id não encontrado", 404);
        }
        $id = $this->request['id'];

        $permissionario = Permissionario::find($id);
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        /*if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }*/

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $monitor = null;
        if ($this->request['monitor_id'] != null) {
            $monitor = Monitor::findComplete($this->request['monitor_id']);
            if ($monitor->permissionario_id != $permissionario->id) {
                return parent::responseMsgJSON("Monitor não pertence ao permissionário", 404);
            }
        }

        $enderecoSolicitacao = null;
        $solicitacao = null;
        if ($this->request['solicitacao_id'] != null) {
            $solicitacao = SolicitacaoDeAlteracao::findComplete($id, $this->request['solicitacao_id']);
            if ($solicitacao != null && $solicitacao->tipo_solicitacao_id != 23) { // 23 = monitor_cadastro
                return parent::responseMsgJSON("Solicitação não é do tipo de cadastro de monitor", 404);
            }

            if ($solicitacao != null)
                $enderecoSolicitacao = $solicitacao['campo4'] . ', ' . $solicitacao['campo5'] . ', ' . $solicitacao['campo7'] . ', ' . $solicitacao['campo8'] . '-' . $solicitacao['campo9'];
        }

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario07declaracaodemonitor";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('permissionario', 'monitor', 'solicitacao', 'enderecoSolicitacao', 'dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario8
    function condutorauxiliar()
    {

        if ($this->request['id'] == null) {
            return parent::responseMsgJSON("Id não encontrado", 404);
        }
        $id = $this->request['id'];

        $permissionario = Permissionario::find($id);
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }
        $modalidadeDoPermissionario = $permissionario->modalidade_id != null ? Modalidade::find($permissionario->modalidade_id) : null;

        /*if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }*/

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $inscricaoOuRenovacao = null;
        $nomeCondutor = null;
        $rgCondutor = null;
        $cnhCondutor = null;
        $categoriaCNHCondutor = null;
        $telefoneCondutor = null;
        $enderecoCondutor = null;
        $emailCondutor = null;
        if ($this->request['condutor_id'] != null) {
            $condutor = Condutor::findComplete($this->request['condutor_id']);
            if ($condutor->permissionario_id != $permissionario->id) {
                return parent::responseMsgJSON("Condutor não pertence ao permissionário", 404);
            }
            $enderecoObj = Endereco::find($condutor->endereco_id);
            $municipioObj = Municipio::find($enderecoObj->municipio_id);

            $inscricaoOuRenovacao = 1;
            $nomeCondutor = $condutor->nome;
            $rgCondutor = $condutor->rg;
            $cnhCondutor = $condutor->cnh;
            $categoriaCNHCondutor = $condutor->categoria_cnh;
            $telefoneCondutor = $condutor->telefone;
            $enderecoCondutor = $enderecoObj['endereco'] . ', ' . $enderecoObj['numero'] . ', ' . $enderecoObj['bairro'] . ', ' . $municipioObj['nome'] . '-' . $enderecoObj['uf'];
            $emailCondutor = $condutor->email;
        } else if ($this->request['solicitacao_id'] != null) {
            $solicitacao = SolicitacaoDeAlteracao::findComplete($this->request['solicitacao_id']);
            if ($solicitacao->tipo_solicitacao_id != 5) { //5 = condutor_cadastro
                return parent::responseMsgJSON("Solicitação não é do tipo de cadastro de monitor", 404);
            }
            if ($solicitacao->permissionario_id != $permissionario->id) {
                return parent::responseMsgJSON("Solicitação não esta relacionada a permissionário", 404);
            }

            $inscricaoOuRenovacao = 2;
            $nomeCondutor = $solicitacao['campo15'];
            $rgCondutor = $solicitacao['campo17'];
            $cnhCondutor = $solicitacao['campo1'];
            $categoriaCNHCondutor = $solicitacao['campo2'];
            $telefoneCondutor = $solicitacao['campo6'];
            $enderecoCondutor = $solicitacao['campo9'] . ', ' . $solicitacao['campo10'] . ', ' . $solicitacao['campo12'] . ', ' . $solicitacao['campo13'] . '-' . $solicitacao['campo14'];
            $emailCondutor = $solicitacao['campo11'];
        }
        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario08condutorauxiliar";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('permissionario', 'modalidadeDoPermissionario', 'inscricaoOuRenovacao', 'nomeCondutor', 'rgCondutor', 'cnhCondutor', 'categoriaCNHCondutor', 'telefoneCondutor', 'enderecoCondutor', 'emailCondutor', 'dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario9
    function declaracaoAtendimentoAoDisposto()
    {

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario09formulariodecatenddisposto";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario16
    function solicitacaoDeRessarcimento()
    {

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario16declaracaoressarcimento";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario17
    function solicitacaodebaixadecondutorauxiliar()
    {

        if ($this->request['id'] == null) {
            return parent::responseMsgJSON("Id não encontrado", 404);
        }
        $id = $this->request['id'];

        $permissionario = Permissionario::find($id);
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }
        $modalidadeDoPermissionario = $permissionario->modalidade_id != null ? Modalidade::find($permissionario->modalidade_id) : null;

        /*if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }*/

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $condutor = null;
        if ($this->request['condutor_id'] != null) {
            $condutor = Condutor::findComplete($this->request['condutor_id']);
            if ($condutor->permissionario_id != $permissionario->id) {
                return parent::responseMsgJSON("Condutor não pertence ao permissionário", 404);
            }
        }

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario17solicitacaodebaixadecondutorauxiliar";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('permissionario', 'modalidadeDoPermissionario', 'condutor', 'dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario18
    function solicitacaoDeTransporteEscolarProprioEstabelecimentoEnsino()
    {

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario18formulariosoltranspescolar";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario119
    function solicitacaoDeAdesivacao()
    {
        if ($this->request['veiculo'] == null) {
            return parent::responseMsgJSON("ID do veículo não encontrado", 404);
        }
        $id = $this->request['veiculo'];

        $veiculo = Veiculo::findComplete($id);
        if ($veiculo == null) {
            return parent::responseMsgJSON("Veículo não encontrado", 404);
        }

        if ($this->request['data_limite'] == null) {
            return parent::responseMsgJSON("Data limite não encontrada", 404);
        }
        $dataLimite = $this->request['data_limite'];

        $permissionario = $veiculo->permissionario;
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        $empresa1 = null;
        $empresa1Nome = null;
        if ($this->request['empresa1'] != null) {
            $empresa1 = EmpresaVistoriadora::findComplete($this->request['empresa1']);
            $empresa1Nome = $empresa1->nome;
            $empresa1 = $empresa1->nome . ", localizada na " . $empresa1->endereco->endereco . ", " . $empresa1->endereco->numero . ", " . $empresa1->endereco->bairro . ", " . $empresa1->endereco->municipio->nome . ", " . $empresa1->endereco->uf . ", Telefone: " . $empresa1->telefone;
        }

        $empresa2 = null;
        $empresa2Nome = null;
        if ($this->request['empresa2'] != null) {
            $empresa2 = EmpresaVistoriadora::findComplete($this->request['empresa2']);
            $empresa2Nome = $empresa2->nome;
            $empresa2 = $empresa1->nome . ", localizada na " . $empresa1->endereco->endereco . ", " . $empresa1->endereco->numero . ", " . $empresa1->endereco->bairro . ", " . $empresa1->endereco->municipio->nome . ", " . $empresa1->endereco->uf . ", Telefone: " . $empresa1->telefone;
        }

        if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario119solicitacaoadesivacao";

        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
                'veiculo',
                'permissionario',
                'empresa1',
                'empresa1Nome',
                'empresa2',
                'empresa2Nome',
                'dataFormatada',
                'dataLimite',
                'usuario'
            )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario120
    public function solicitacaoDeAfericaoTaximetro()
    {
        if ($this->request['veiculo'] == null) {
            return parent::responseMsgJSON("ID do veículo não encontrado", 404);
        }
        $id = $this->request['veiculo'];

        $veiculo = Veiculo::findComplete($id);
        if ($veiculo == null) {
            return parent::responseMsgJSON("Veículo não encontrado", 404);
        }

        $permissionario = $veiculo->permissionario;
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $empresa = Empresa::findComplete(1);

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario120solicitacaoafericaotaximetro";

        $pdf = PDF::loadView('formularios/' . $formlario, compact(
            'permissionario',
            'veiculo',
            'empresa',
            'dataFormatada',
            'usuario'
        )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario121
    public function solicitacaoDeAutorizacaoProvisoria()
    {
        if ($this->request['veiculo'] == null) {
            return parent::responseMsgJSON("ID do veículo não encontrado", 404);
        }
        $id = $this->request['veiculo'];

        if ($this->request['motivo'] == null) {
            return parent::responseMsgJSON("Motivo não encontrado", 404);
        }
        $motivo = $this->request['motivo'];

        if ($this->request['dataLimite'] == null) {
            return parent::responseMsgJSON("Data limite não encontrada", 404);
        }
        $dataLimite = $this->request['dataLimite'];

        if ($this->request['quandoDevera'] == null) {
            return parent::responseMsgJSON("Quando deverá não encontrada", 404);
        }
        $quandoDevera = $this->request['quandoDevera'];

        $veiculo = Veiculo::findComplete($id);
        if ($veiculo == null) {
            return parent::responseMsgJSON("Veículo não encontrado", 404);
        }

        $permissionario = $veiculo->permissionario;
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $empresa = Empresa::findComplete(1);

        $ponto = PontoDoPermissionario::findPontoByPermissionario($permissionario->id);
        if ($ponto == null) {
            return parent::responseMsgJSON("Ponto não encontrado", 404);
        } else {
            $ponto = $ponto->ponto;
            $enderecoPonto = Endereco::findComplete($ponto->endereco_id);
            $ponto = $ponto->id_integracao . " - " . $enderecoPonto->endereco . ", " . $enderecoPonto->numero . ", " . $enderecoPonto->bairro . ", " . $enderecoPonto->municipio->nome . ", " . $enderecoPonto->uf;
        }

        $condutores = Condutor::findAllByPermissionario($permissionario->id);


        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario121solicitacaoautorizacaoprovisoria";

        $pdf = PDF::loadView('formularios/' . $formlario, compact(
            'permissionario',
            'veiculo',
            'empresa',
            'condutores',
            'ponto',
            'motivo',
            'dataLimite',
            'quandoDevera',
            'dataFormatada',
            'usuario'
        )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario122
    public function solicitacaoDeAutorizacaoProvisoriaEscolar()
    {
        if ($this->request['veiculo'] == null) {
            return parent::responseMsgJSON("ID do veículo não encontrado", 404);
        }
        $id = $this->request['veiculo'];

        if ($this->request['motivo'] == null) {
            return parent::responseMsgJSON("Motivo não encontrado", 404);
        }
        $motivo = $this->request['motivo'];

        if ($this->request['dataLimite'] == null) {
            return parent::responseMsgJSON("Data limite não encontrada", 404);
        }
        $dataLimite = $this->request['dataLimite'];

        if ($this->request['quandoDevera'] == null) {
            return parent::responseMsgJSON("Quando deverá não encontrada", 404);
        }
        $quandoDevera = $this->request['quandoDevera'];

        $veiculo = Veiculo::findComplete($id);
        if ($veiculo == null) {
            return parent::responseMsgJSON("Veículo não encontrado", 404);
        }

        $permissionario = $veiculo->permissionario;
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $empresa = Empresa::findComplete(1);

        $pontos = PontoDoPermissionario::findPontosByPermissionario($permissionario->id);

        $monitores = Monitor::findAllByPermissionario($permissionario->id);

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario122solicitacaoautorizacaoprovisoriaescolar";

        $pdf = PDF::loadView('formularios/' . $formlario, compact(
            'permissionario',
            'veiculo',
            'empresa',
            'monitores',
            'pontos',
            'motivo',
            'dataLimite',
            'quandoDevera',
            'dataFormatada',
            'usuario'
        )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario126
    public function declaracaoParaTaxista()
    {

        if ($this->request['permissionario'] == null) {
            return parent::responseMsgJSON("ID do permissionário não encontrado", 404);
        }

        $permissionario = Permissionario::find($this->request['permissionario']);
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $ponto = PontoDoPermissionario::findPontoByPermissionario($permissionario->id);
        if ($ponto == null) {
            return parent::responseMsgJSON("Ponto não encontrado", 404);
        } else {
            $ponto = $ponto->ponto;
            $enderecoPonto = Endereco::findComplete($ponto->endereco_id);
            $ponto = $ponto->id_integracao . " - " . $enderecoPonto->endereco;
        }

        $empresa = Empresa::findComplete(1);

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario126declaracaoptaxista";

        $pdf = PDF::loadView('formularios/' . $formlario, compact(
            'permissionario',
            'empresa',
            'ponto',
            'dataFormatada',
            'usuario'
        )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario127
    public function declaracaoParaTransporteEscolar()
    {

        if ($this->request['permissionario'] == null) {
            return parent::responseMsgJSON("ID do permissionário não encontrado", 404);
        }

        $permissionario = Permissionario::find($this->request['permissionario']);
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $empresa = Empresa::findComplete(1);

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario127declaracaoptransporteescolar";

        $pdf = PDF::loadView('formularios/' . $formlario, compact(
            'permissionario',
            'empresa',
            'dataFormatada',
            'usuario'
        )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario128
    public function formularioDeRequerimento()
    {

        if ($this->request['permissionario'] == null) {
            return parent::responseMsgJSON("ID do permissionário não encontrado", 404);
        }

        $permissionario = Permissionario::findByIdWithEndereco($this->request['permissionario']);
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $ponto = PontoDoPermissionario::findPontoByPermissionario($permissionario->id);
        $enderecoPonto = null;
        if ($ponto == null) {
            return parent::responseMsgJSON("Ponto não encontrado", 404);
        } else {
            $ponto = $ponto->ponto;
            $enderecoPonto = Endereco::findComplete($ponto->endereco_id);
        }

        $empresa = Empresa::findComplete(1);

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario128declaracaoderequerimento";

        $pdf = PDF::loadView('formularios/' . $formlario, compact(
            'permissionario',
            'empresa',
            'enderecoPonto',
            'dataFormatada',
            'usuario'
        )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario129
    public function laudoDeVistoriaTransportesEspeciais()
    {

        if ($this->request['veiculo'] == null) {
            return parent::responseMsgJSON("ID do veículo não encontrado", 404);
        }
        $id = $this->request['veiculo'];

        $veiculo = Veiculo::findComplete($id);
        if ($veiculo == null) {
            return parent::responseMsgJSON("Veículo não encontrado", 404);
        }

        $permissionario = $veiculo->permissionario;
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $ponto = PontoDoPermissionario::findPontoByPermissionario($permissionario->id);
        $enderecoPonto = null;
        if ($ponto == null) {
            return parent::responseMsgJSON("Ponto não encontrado", 404);
        } else {
            $ponto = $ponto->ponto;
            $enderecoPonto = Endereco::findComplete($ponto->endereco_id);
        }

        $empresa = Empresa::findComplete(1);

        $vencimentoCNHFormatada = Carbon::parse($permissionario->vencimento_cnh)->format('d/m/Y');
        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario129laudovistoriatranspespeciais";

        $pdf = PDF::loadView('formularios/' . $formlario, compact(
            'veiculo',
            'permissionario',
            'vencimentoCNHFormatada',
            'empresa',
            'ponto',
            'enderecoPonto',
            'dataFormatada',
            'usuario'
        )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario130
    public function notificacao()
    {

        if ($this->request['permissionario'] == null) {
            return parent::responseMsgJSON("ID do permissionário não encontrado", 404);
        }

        if ($this->request['prazo'] == null) {
            return parent::responseMsgJSON("Prazo não encontrado", 404);
        }
        $prazo = $this->request['prazo'];

        if ($this->request['notificado'] == null) {
            return parent::responseMsgJSON("Notificado não encontrado", 404);
        }
        $notificado = $this->request['notificado'];

        $permissionario = Permissionario::findByIdWithEndereco($this->request['permissionario']);
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $empresa = Empresa::findComplete(1);

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario130notificacao";

        $pdf = PDF::loadView('formularios/' . $formlario, compact(
            'permissionario',
            'empresa',
            'prazo',
            'notificado',
            'dataFormatada',
            'usuario'
        )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    public function substituicaoDeVeiculo()
    {

        if ($this->request['veiculo1'] == null) {
            return parent::responseMsgJSON("ID do veículo não encontrado", 404);
        }
        $id = $this->request['veiculo1'];

        $veiculo1 = Veiculo::findComplete($id);
        if ($veiculo1 == null) {
            return parent::responseMsgJSON("Veículo não encontrado", 404);
        }

        if ($this->request['veiculo2'] == null) {
            return parent::responseMsgJSON("ID do veículo não encontrado", 404);
        }
        $id = $this->request['veiculo2'];

        $veiculo2 = Veiculo::findComplete($id);
        if ($veiculo2 == null) {
            return parent::responseMsgJSON("Veículo não encontrado", 404);
        }

        $permissionario = $veiculo1->permissionario;
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $ponto = PontoDoPermissionario::findPontoByPermissionario($permissionario->id);

        $empresa = Empresa::findComplete(1);

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario131substituicaoveiculo";
        $pdf = PDF::loadView('formularios/' . $formlario, compact(
            'veiculo1',
            'veiculo2',
            'permissionario',
            'ponto',
            'empresa',
            'dataFormatada',
            'usuario'
        )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario132
    function termoDeCredenciamentoTaxi()
    {

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario132termocredenciamentotaxi";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario133
    function termoDeCredenciamentoTransporteEscolar()
    {

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario133termocredenciamentoescolar";

        $pdf = PDF::loadView('formularios/' . $formlario, compact('dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }


    //formulario134
    function aip()
    {

        if ($this->request['infracao'] == null) {
            return parent::responseMsgJSON("ID da infração não encontrado", 404);
        }

        $infracao = Infracao::findComplete($this->request['infracao']);
        if ($infracao == null) {
            return parent::responseMsgJSON("Veículo não encontrado", 404);
        }

        //dd($infracao->veiculo);
        $empresa = Empresa::findComplete(1);

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');
        $dataEmissaoFormatada = Carbon::parse($infracao->created_at)->format('d/m/Y');
        $dataInfracaoFormatada = Carbon::parse($infracao->data_infracao)->format('d/m/Y');
        $horarioInfracaoFormatado = Carbon::parse($infracao->hora_infracao)->format('H:i');
        $npixOuBoleto = $infracao->codigo_pix? $infracao->codigo_pix : $infracao->num_boleto;
        $venctoBoletoFormatado = Carbon::parse($infracao->data_vendimento_boleto)->format('d/m/Y');
        $valorFMPFormatado = number_format($infracao->FMP->valor, 2, ',', '.');
        $valorEmFMP = $infracao->FMP->valor*$infracao->FMP->qtd_fmp;
        $valorEmFMPFormatado = number_format($infracao->FMP->valor*$infracao->qtd_fmp, 2, ',', '.');

        $usuario = auth()->user();

        $formlario = "formulario134aip";

        $pdf = PDF::loadView('formularios/' . $formlario,
        compact(
            'infracao',
            'empresa',
            'dataFormatada',
            'dataEmissaoFormatada',
            'dataInfracaoFormatada',
            'horarioInfracaoFormatado',
            'npixOuBoleto',
            'venctoBoletoFormatado',
            'valorFMPFormatado',
            'valorEmFMP',
            'valorEmFMPFormatado',
            'usuario'
        ));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario135
    function alvaraDoPermissionario()
    {

        if ($this->request['veiculo'] == null) {
            return parent::responseMsgJSON("ID do veículo não encontrado", 404);
        }
        $id = $this->request['veiculo'];

        $veiculo = Veiculo::findComplete($id);
        if ($veiculo == null) {
            return parent::responseMsgJSON("Veículo não encontrado", 404);
        }

        $permissionario = $veiculo->permissionario;
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $ponto = PontoDoPermissionario::findPontoByPermissionario($permissionario->id);
        if ($ponto == null) {
            return parent::responseMsgJSON("Ponto não encontrado", 404);
        } else {
            $ponto = $ponto->ponto;
        }

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario135alvaradopermissionario";

        $pdf = PDF::loadView('formularios/' . $formlario, compact(
            'veiculo',
            'permissionario',
            'ponto',
            'dataFormatada',
            'usuario'
        )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

}
