<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certidao;
use App\Models\Condutor;
use App\Models\Empresa;
use App\Models\EmpresaVistoriadora;
use App\Models\Endereco;
use App\Models\EntidadeAssociativa;
use App\Models\Infracao;
use App\Models\Modalidade;
use App\Models\Monitor;
use App\Models\Municipio;
use App\Models\Permissionario;
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
        if (isset($this->request['id'])) {
            return $this->formularioRequerimentoSubstituicaoVeiculoAuto();
        } else if (isset($this->request['permissionario'])) {
            return $this->formularioRequerimentoSubstituicaoVeiculoManual();
        } else {
            return parent::responseMsgJSON("ID do permissionário ou veículo não encontrado", 404);
        }
    }

    private function formularioRequerimentoSubstituicaoVeiculoAuto()
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

        $placa = $obj['placa'];
        $marcaModelo = $obj['marcaModeloVeiculo']['descricao'];
        $ano = $obj['ano_modelo'];

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario05reqsubveiculo";

        $pdf = PDF::loadView('formularios/' . $formlario, compact(
            'obj',
            'placa',
            'marcaModelo',
            'ano',
            'dataFormatada',
            'usuario'
        )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    private function formularioRequerimentoSubstituicaoVeiculoManual()
    {
        if ($this->request['permissionario'] == null) {
            return parent::responseMsgJSON("Não encontrado", 404);
        }

        $obj = new Veiculo();
        $obj->permissionario_id = $this->request['permissionario'];
        $obj->permissionario = Permissionario::find($this->request['permissionario']);

        if ($obj->permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if ($obj == null) {
            return parent::responseMsgJSON("veículo não encontrado", 404);
        }

        if ($obj->permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($obj['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $placa = $this->request['placa'];
        $marcaModelo = $this->request['marca_modelo'];
        $ano = $this->request['ano'];

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario05reqsubveiculo";

        $pdf = PDF::loadView('formularios/' . $formlario, compact(
            'obj',
            'placa',
            'marcaModelo',
            'ano',
            'dataFormatada',
            'usuario'
        ));

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
        if (isset($this->request['id'])) {
            return $this->formulariodeclaracaomonitorAuto();
        } else if (isset($this->request['permissionario'])) {
            return $this->formulariodeclaracaomonitorManual();
        } else {
            return parent::responseMsgJSON("ID do permissionário ou monitor não encontrado", 404);
        }
    }

    function formulariodeclaracaomonitorAuto()
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

        $nomeMonitorExclusao = $monitor != null ? $monitor['nome'] : null;
        $rgMonitorExclusao = $monitor != null ? $monitor['rg'] : null;
        $cpfMonitorExclusao = $monitor != null ? $monitor['cpf'] : null;

        $nomeMonitorInclusao = $solicitacao != null && $solicitacao['campo10'] != null ? $solicitacao['campo10'] : null;
        $rgMonitorInclusao = $solicitacao != null && $solicitacao['campo11'] != null ? $solicitacao['campo11'] : null;
        $cpfMonitorInclusao = $solicitacao != null && $solicitacao['campo12'] != null ? $solicitacao['campo12'] : null;
        $enderecoMonitorInclusao = $enderecoSolicitacao;
        $emailMonitorInclusao = $solicitacao != null && $solicitacao['campo1'] != null ? $solicitacao['campo1'] : null;
        $telefoneMonitorInclusao = $solicitacao != null && $solicitacao['campo2'] != null ? $solicitacao['campo2'] : null;

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario07declaracaodemonitor";

        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
                'permissionario',
                'nomeMonitorExclusao',
                'rgMonitorExclusao',
                'cpfMonitorExclusao',
                'nomeMonitorInclusao',
                'rgMonitorInclusao',
                'cpfMonitorInclusao',
                'enderecoMonitorInclusao',
                'emailMonitorInclusao',
                'telefoneMonitorInclusao',
                'dataFormatada',
                'usuario'
            )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    function formulariodeclaracaomonitorManual()
    {

        if ($this->request['permissionario'] == null) {
            return parent::responseMsgJSON("Id não encontrado", 404);
        }

        $permissionario = Permissionario::find($this->request['permissionario']);
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        $nomeMonitorExclusao = $this->request['nome_monitor_exclusao'];
        $rgMonitorExclusao = $this->request['rg_monitor_exclusao'];
        $cpfMonitorExclusao = $this->request['cpf_monitor_exclusao'];

        $nomeMonitorInclusao = $this->request['nome_monitor_inclusao'];
        $rgMonitorInclusao = $this->request['rg_monitor_inclusao'];
        $cpfMonitorInclusao = $this->request['cpf_monitor_inclusao'];
        $enderecoMonitorInclusao = $this->request['endereco_monitor_inclusao'];
        $emailMonitorInclusao = $this->request['email_monitor_inclusao'];
        $telefoneMonitorInclusao = $this->request['telefone_monitor_inclusao'];

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario07declaracaodemonitor";

        $pdf = PDF::loadView('formularios/' . $formlario, compact(
            'permissionario',
            'nomeMonitorExclusao',
            'rgMonitorExclusao',
            'cpfMonitorExclusao',
            'nomeMonitorInclusao',
            'rgMonitorInclusao',
            'cpfMonitorInclusao',
            'enderecoMonitorInclusao',
            'emailMonitorInclusao',
            'telefoneMonitorInclusao',
            'dataFormatada',
            'usuario'
        )
        );

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
            $empresa2 = $empresa2->nome . ", localizada na " . $empresa2->endereco->endereco . ", " . $empresa2->endereco->numero . ", " . $empresa2->endereco->bairro . ", " . $empresa2->endereco->municipio->nome . ", " . $empresa2->endereco->uf . ", Telefone: " . $empresa2->telefone;
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
        if (isset($this->request['veiculo'])) {
            return $this->getFormulario120Automatico();
        } else if (isset($this->request['permissionario'])) {
            return $this->getFormulario120Manual();
        } else {
            return parent::responseMsgJSON("ID do permissionário ou veículo não encontrado", 404);
        }
    }

    private function getFormulario120Manual()
    {
        $id = $this->request['permissionario'];

        $permissionario = Permissionario::find($id);
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if ($permissionario['ativo'] == 0) {
            return parent::responseMsgJSON("Permissionário inativo", 404);
        }

        if ($permissionario['data_obito'] != null) {
            return parent::responseMsgJSON("Permissionário falecido", 404);
        }

        $placa = $this->request['placa'];
        $marca_modelo = $this->request['marca_modelo'];
        $cor = $this->request['cor'];
        $ano = $this->request['ano'];
        $taximetro = $this->request['taximetro'];
        $ponto = PontoDoPermissionario::findPontoByPermissionario($permissionario->id)->ponto->id_integracao;

        $empresa = Empresa::findComplete(1);

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario120solicitacaoafericaotaximetro";

        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
                'permissionario',
                'placa',
                'marca_modelo',
                'cor',
                'ano',
                'empresa',
                'dataFormatada',
                'usuario',
                'ponto'
            )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    private function getFormulario120Automatico()
    {
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

        $placa = $veiculo->placa;
        $marca_modelo = $veiculo->MarcaModeloVeiculo->descricao;
        $cor = $veiculo->cor->descricao;
        $ano = $veiculo->ano_fabricacao;
        $ponto = PontoDoPermissionario::findPontoByPermissionario($permissionario->id)->ponto->id_integracao;

        $empresa = Empresa::findComplete(1);

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario120solicitacaoafericaotaximetro";

        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
                'permissionario',
                'placa',
                'marca_modelo',
                'cor',
                'ano',
                'empresa',
                'dataFormatada',
                'usuario',
                'ponto'
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

        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
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

        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
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

        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
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

        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
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

        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
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

        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
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

        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
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

    //formulario131
    public function substituicaoDeVeiculo()
    {

        if ($this->request['veiculo1'] == null) {
            return parent::responseMsgJSON("Veículo vazio não encontrado", 404);
        }

        $veiculo1 = $this->request['veiculo1'];
        if (gettype($this->request['veiculo1']) == 'integer') {
            $veiculo1 = Veiculo::findComplete($this->request['veiculo1']);
            if ($veiculo1 == null) {
                return parent::responseMsgJSON("Veículo não encontrado", 404);
            }
        }

        if ($this->request['veiculo2'] == null) {
            return parent::responseMsgJSON("ID do veículo não encontrado", 404);
        }
        $id = $this->request['veiculo2'];

        $veiculo2 = Veiculo::findComplete($id);
        if ($veiculo2 == null) {
            return parent::responseMsgJSON("Veículo não encontrado", 404);
        }

        if (isset($this->request['permissionario'])) {
            $permissionario = Permissionario::find($this->request['permissionario']);
        } else {
            $permissionario = $veiculo1->permissionario;
        }

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
        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
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
        $npixOuBoleto = $infracao->codigo_pix ? $infracao->codigo_pix : $infracao->num_boleto;
        $venctoBoletoFormatado = Carbon::parse($infracao->data_vendimento_boleto)->format('d/m/Y');
        $valorFMPFormatado = number_format($infracao->FMP->valor, 2, ',', '.');
        $valorEmFMP = $infracao->FMP->valor * $infracao->FMP->qtd_fmp;
        $valorEmFMPFormatado = number_format($infracao->FMP->valor * $infracao->qtd_fmp, 2, ',', '.');

        $usuario = auth()->user();

        $formlario = "formulario134aip";

        $pdf = PDF::loadView(
            'formularios/' . $formlario,
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
            )
        );

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

        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
                'veiculo',
                'permissionario',
                'ponto',
                'dataFormatada',
                'usuario'
            )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario136
    public function filhaPermissionario()
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

        $empresa = Empresa::findComplete(1);

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $inicioAtividades = "";
        if ($permissionario->inicio_atividades != null) {
            $inicioAtividades = Carbon::parse($permissionario->inicio_atividades)->format('d/m/Y');
        }

        $ativo = $permissionario->ativo ? 'Sim' : 'Não';

        $dataNasc = Carbon::parse($permissionario->data_nascimento)->format('d/m/Y');

        $endereco = $permissionario->endereco;

        $municipio = Municipio::find($endereco->municipio_id);

        $entidadeAssociativa = "";
        if ($permissionario->entidade_associativa_id != null) {
            $entidadeAssociativa = EntidadeAssociativa::find($permissionario->entidade_associativa_id);
        }

        $cnhVencto = $permissionario->cnhVencto;
        if ($permissionario->cnhVencto != null) {
            $cnhVencto = Carbon::parse($permissionario->cnhVencto)->format('d/m/Y');
        }

        $pontos = PontoDoPermissionario::findPontosByPermissionario($permissionario->id);

        $ponto1 = "";
        if(sizeof($pontos) > 0) {
            $enderecoPonto = Endereco::findComplete($pontos[0]->ponto->endereco_id);
            $ponto1 = $pontos[0]->ponto->id_integracao . " - " . $enderecoPonto->endereco;
        }

        $ponto2 = "";
        if(sizeof($pontos) > 1) {
            $enderecoPonto = Endereco::findComplete($pontos[1]->ponto->endereco_id);
            $ponto2 = $pontos[1]->ponto->id_integracao . " - " . $enderecoPonto->endereco;
        }

        $ponto3 = "";
        if(sizeof($pontos) > 2) {
            $enderecoPonto = Endereco::findComplete($pontos[2]->ponto->endereco_id);
            $ponto3 = $pontos[2]->ponto->id_integracao . " - " . $enderecoPonto->endereco;
        }

        $ponto4 = "";
        if(sizeof($pontos) > 3) {
            $enderecoPonto = Endereco::findComplete($pontos[3]->ponto->endereco_id);
            $ponto4 = $pontos[3]->ponto->id_integracao . " - " . $enderecoPonto->endereco;
        }

        $ponto5 = "";
        if(sizeof($pontos) > 4) {
            $enderecoPonto = Endereco::findComplete($pontos[4]->ponto->endereco_id);
            $ponto5 = $pontos[4]->ponto->id_integracao . " - " . $enderecoPonto->endereco;
        }

        $ponto6 = "";
        if(sizeof($pontos) > 5) {
            $enderecoPonto = Endereco::findComplete($pontos[5]->ponto->endereco_id);
            $ponto6 = $pontos[5]->ponto->id_integracao . " - " . $enderecoPonto->endereco;
        }

        $ponto7 = "";
        if(sizeof($pontos) > 6) {
            $enderecoPonto = Endereco::findComplete($pontos[6]->ponto->endereco_id);
            $ponto7 = $pontos[6]->ponto->id_integracao . " - " . $enderecoPonto->endereco;
        }

        $ponto8 = "";
        if (sizeof($pontos) > 7) {
            $enderecoPonto = Endereco::findComplete($pontos[7]->ponto->endereco_id);
            $ponto8 = $pontos[7]->ponto->id_integracao . " - " . $enderecoPonto->endereco;
        }

        $ponto9 = "";
        if (sizeof($pontos) > 8) {
            $enderecoPonto = Endereco::findComplete($pontos[8]->ponto->endereco_id);
            $ponto9 = $pontos[8]->ponto->id_integracao . " - " . $enderecoPonto->endereco;
        }

        $emissaoAlvara = "";
        $vencimentoAlvara = "";
        $retornoAlvara = "";
        $obsAlvara = "";
        $lastAlvara = $permissionario->lastAlvara;
        if ($lastAlvara != null) {
            $emissaoAlvara = $lastAlvara->data_emissao != null ? $lastAlvara->data_emissao : "";
            $vencimentoAlvara = $lastAlvara->data_vencimento != null ? Carbon::parse($lastAlvara->data_vencimento)->format('d/m/Y') : '';
            $retornoAlvara = $lastAlvara->data_retorno != null ? Carbon::parse($lastAlvara->data_retorno)->format('d/m/Y') : '';
            $obsAlvara = $lastAlvara->observacao_retorno != null ? $lastAlvara->observacao_retorno : '';
        }

        $validadeCertidaoNegativa = "";
        if ($permissionario->validade_certidao_negativa != null) {
            $validadeCertidaoNegativa = Carbon::parse($permissionario->validade_certidao_negativa)->format("d/m/Y");
        }

        $emissaoCursoPrimeirosSocorros = "";
        if ($permissionario->curso_primeiro_socorros_emissao != null) {
            $emissaoCursoPrimeirosSocorros = Carbon::parse($permissionario->curso_primeiro_socorros_emissao)->format("d/m/Y");
        }

        $condutores = Condutor::findAllByPermissionarioAtivos($permissionario->id);

        $condutor1Nome = "";
        $condutor1Cpf = "";
        $condutor1Rg = "";
        $condutor1Cnh = "";
        $condutor1CnhCategoria = "";
        $condutor1CnhVencimento = "";
        $condutor1AtestadoDeSaude = "";
        $condutor1RegistroCTPS = "";
        $condutor1CertidaoNegativa = "";
        $condutor1CertidaoNegativaValidade = "";
        $condutor1CursoPrimeirosSocorros = "";
        $condutor1CursoPrimeirosSocorrosEmissao = "";
        $condutor1MotAfastamento = "";
        $condutor1PeriodoAfastamentoInicio = "";
        $condutor1PeriodoAfastamentoFim = "";
        if (sizeof($condutores) > 0) {
            $condutor1Nome = $condutores[0]->nome;
            $condutor1Cpf = $condutores[0]->cpf;
            $condutor1Rg = $condutores[0]->rg;
            $condutor1Cnh = $condutores[0]->cnh;
            $condutor1CnhCategoria = $condutores[0]->categoria_cnh;
            $condutor1CnhVencimento = $condutores[0]->vencimento_cnh != null ? Carbon::parse($condutores[0]->vencimento_cnh)->format("d/m/Y") : "";
            $condutor1AtestadoDeSaude = $condutores[0]->atestado_de_saude;
            $condutor1RegistroCTPS = $condutores[0]->registro_ctps;
            $condutor1CertidaoNegativa = $condutores[0]->certidao_negativa;
            $condutor1CertidaoNegativaValidade = $condutores[0]->validade_certidao_negativa != null ? Carbon::parse($condutores[0]->validade_certidao_negativa)->format("d/m/Y") : "";
            $condutor1CursoPrimeirosSocorros = $condutores[0]->primeiros_socorros;
            $condutor1CursoPrimeirosSocorrosEmissao = $condutores[0]->emissao_primeiros_socorros != null ? Carbon::parse($condutores[0]->emissao_primeiros_socorros)->format("d/m/Y") : "";
            $condutor1MotAfastamento = $condutores[0]->motivo_afastamento != null ? $condutores[0]->motivo_afastamento : "";
            $condutor1PeriodoAfastamentoInicio = $condutores[0]->data_inicio_afastamento != null ? Carbon::parse($condutores[0]->data_inicio_afastamento)->format("d/m/Y") : "";
            $condutor1PeriodoAfastamentoFim = $condutores[0]->data_termino_afastamento != null ? Carbon::parse($condutores[0]->data_termino_afastamento)->format("d/m/Y") : "";
        }

        $condutor2Nome = "";
        $condutor2Cpf = "";
        $condutor2Rg = "";
        $condutor2Cnh = "";
        $condutor2CnhCategoria = "";
        $condutor2CnhVencimento = "";
        $condutor2AtestadoDeSaude = "";
        $condutor2RegistroCTPS = "";
        $condutor2CertidaoNegativa = "";
        $condutor2CertidaoNegativaValidade = "";
        $condutor2CursoPrimeirosSocorros = "";
        $condutor2CursoPrimeirosSocorrosEmissao = "";
        $condutor2MotAfastamento = "";
        $condutor2PeriodoAfastamentoInicio = "";
        $condutor2PeriodoAfastamentoFim = "";
        if (sizeof($condutores) > 1) {
            $condutor2Nome = $condutores[1]->nome;
            $condutor2Cpf = $condutores[1]->cpf;
            $condutor2Rg = $condutores[1]->rg;
            $condutor2Cnh = $condutores[1]->cnh;
            $condutor2CnhCategoria = $condutores[1]->categoria_cnh;
            $condutor2CnhVencimento = $condutores[1]->vencimento_cnh != null ? Carbon::parse($condutores[1]->vencimento_cnh)->format("d/m/Y") : "";
            $condutor2AtestadoDeSaude = $condutores[1]->atestado_de_saude;
            $condutor2RegistroCTPS = $condutores[1]->registro_ctps;
            $condutor2CertidaoNegativa = $condutores[1]->certidao_negativa;
            $condutor2CertidaoNegativaValidade = $condutores[1]->validade_certidao_negativa != null ? Carbon::parse($condutores[1]->validade_certidao_negativa)->format("d/m/Y") : "";
            $condutor2CursoPrimeirosSocorros = $condutores[1]->primeiros_socorros;
            $condutor2CursoPrimeirosSocorrosEmissao = $condutores[1]->emissao_primeiros_socorros != null ? Carbon::parse($condutores[1]->emissao_primeiros_socorros)->format("d/m/Y") : "";
            $condutor2MotAfastamento = $condutores[1]->motivo_afastamento != null ? $condutores[1]->motivo_afastamento : "";
            $condutor2PeriodoAfastamentoInicio = $condutores[1]->data_inicio_afastamento != null ? Carbon::parse($condutores[1]->data_inicio_afastamento)->format("d/m/Y") : "";
            $condutor2PeriodoAfastamentoFim = $condutores[1]->data_termino_afastamento != null ? Carbon::parse($condutores[1]->data_termino_afastamento)->format("d/m/Y") : "";
        }

        $monitores = Monitor::findAllByPermissionarioAtivo($permissionario->id);

        $monitor1Nome = "";
        $monitor1RG = "";
        $monitor1DataNasc = "";
        $monitor1CursoPrimeirosSocorros = "";
        $monitor1CursoPrimeirosSocorrosEmissao = "";
        if (sizeof($monitores) > 0) {
            $monitor1Nome = $monitores[0]->nome;
            $monitor1RG = $monitores[0]->rg;
            $monitor1DataNasc = $monitores[0]->data_nascimento != null ? Carbon::parse($monitores[0]->data_nascimento)->format("d/m/Y") : "";
            $monitor1CursoPrimeirosSocorros = $monitores[0]->curso_de_primeiro_socorros;
            $monitor1CursoPrimeirosSocorrosEmissao = $monitores[0]->emissao_curso_de_primeiro_socorros != null ? Carbon::parse($monitores[0]->emissao_curso_de_primeiro_socorros)->format("d/m/Y") : "";
        }

        $monitor2Nome = "";
        $monitor2RG = "";
        $monitor2DataNasc = "";
        $monitor2CursoPrimeirosSocorros = "";
        $monitor2CursoPrimeirosSocorrosEmissao = "";
        if (sizeof($monitores) > 1) {
            $monitor2Nome = $monitores[1]->nome;
            $monitor2RG = $monitores[1]->rg;
            $monitor2DataNasc = $monitores[1]->data_nascimento != null ? Carbon::parse($monitores[1]->data_nascimento)->format("d/m/Y") : "";
            $monitor2CursoPrimeirosSocorros = $monitores[1]->curso_de_primeiro_socorros;
            $monitor2CursoPrimeirosSocorrosEmissao = $monitores[1]->emissao_curso_de_primeiro_socorros != null ? Carbon::parse($monitores[1]->emissao_curso_de_primeiro_socorros)->format("d/m/Y") : "";
        }

        $monitor3Nome = "";
        $monitor3RG = "";
        $monitor3DataNasc = "";
        $monitor3CursoPrimeirosSocorros = "";
        $monitor3CursoPrimeirosSocorrosEmissao = "";
        if (sizeof($monitores) > 2) {
            $monitor3Nome = $monitores[2]->nome;
            $monitor3RG = $monitores[2]->rg;
            $monitor3DataNasc = $monitores[2]->data_nascimento != null ? Carbon::parse($monitores[2]->data_nascimento)->format("d/m/Y") : "";
            $monitor3CursoPrimeirosSocorros = $monitores[2]->curso_de_primeiro_socorros;
            $monitor3CursoPrimeirosSocorrosEmissao = $monitores[2]->emissao_curso_de_primeiro_socorros != null ? Carbon::parse($monitores[2]->emissao_curso_de_primeiro_socorros)->format("d/m/Y") : "";
        }

        $monitor4Nome = "";
        $monitor4RG = "";
        $monitor4DataNasc = "";
        $monitor4CursoPrimeirosSocorros = "";
        $monitor4CursoPrimeirosSocorrosEmissao = "";
        if (sizeof($monitores) > 3) {
            $monitor4Nome = $monitores[3]->nome;
            $monitor4RG = $monitores[3]->rg;
            $monitor4DataNasc = $monitores[3]->data_nascimento != null ? Carbon::parse($monitores[3]->data_nascimento)->format("d/m/Y") : "";
            $monitor4CursoPrimeirosSocorros = $monitores[3]->curso_de_primeiro_socorros;
            $monitor4CursoPrimeirosSocorrosEmissao = $monitores[3]->emissao_curso_de_primeiro_socorros != null ? Carbon::parse($monitores[3]->emissao_curso_de_primeiro_socorros)->format("d/m/Y") : "";
        }

        $monitor5Nome = "";
        $monitor5RG = "";
        $monitor5DataNasc = "";
        $monitor5CursoPrimeirosSocorros = "";
        $monitor5CursoPrimeirosSocorrosEmissao = "";
        if (sizeof($monitores) > 4) {
            $monitor5Nome = $monitores[4]->nome;
            $monitor5RG = $monitores[4]->rg;
            $monitor5DataNasc = $monitores[4]->data_nascimento != null ? Carbon::parse($monitores[4]->data_nascimento)->format("d/m/Y") : "";
            $monitor5CursoPrimeirosSocorros = $monitores[4]->curso_de_primeiro_socorros;
            $monitor5CursoPrimeirosSocorrosEmissao = $monitores[4]->emissao_curso_de_primeiro_socorros != null ? Carbon::parse($monitores[4]->emissao_curso_de_primeiro_socorros)->format("d/m/Y") : "";
        }

        $monitor6Nome = "";
        $monitor6RG = "";
        $monitor6DataNasc = "";
        $monitor6CursoPrimeirosSocorros = "";
        $monitor6CursoPrimeirosSocorrosEmissao = "";
        if (sizeof($monitores) > 5) {
            $monitor6Nome = $monitores[5]->nome;
            $monitor6RG = $monitores[5]->rg;
            $monitor6DataNasc = $monitores[5]->data_nascimento != null ? Carbon::parse($monitores[5]->data_nascimento)->format("d/m/Y") : "";
            $monitor6CursoPrimeirosSocorros = $monitores[5]->curso_de_primeiro_socorros;
            $monitor6CursoPrimeirosSocorrosEmissao = $monitores[5]->emissao_curso_de_primeiro_socorros != null ? Carbon::parse($monitores[5]->emissao_curso_de_primeiro_socorros)->format("d/m/Y") : "";
        }

        $usuario = auth()->user();

        $formlario = "formulario136fichapermissionario";
        
        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
                'permissionario',
                'inicioAtividades',
                'ativo',
                'dataNasc',
                'endereco',
                'municipio',
                'empresa',
                'dataFormatada',
                'entidadeAssociativa',
                'cnhVencto',
                'veiculo',
                'usuario',
                'ponto1',
                'ponto2',
                'ponto3',
                'ponto4',
                'ponto5',
                'ponto6',
                'ponto7',
                'ponto8',
                'ponto9',
                'emissaoAlvara',
                'vencimentoAlvara',
                'retornoAlvara',
                'obsAlvara',
                'validadeCertidaoNegativa',
                'emissaoCursoPrimeirosSocorros',
                'condutor1Nome',
                'condutor1Cpf',
                'condutor1Rg',
                'condutor1Cnh',
                'condutor1CnhCategoria',
                'condutor1CnhVencimento',
                'condutor1AtestadoDeSaude',
                'condutor1RegistroCTPS',
                'condutor1CertidaoNegativa',
                'condutor1CertidaoNegativaValidade',
                'condutor1CursoPrimeirosSocorros',
                'condutor1CursoPrimeirosSocorrosEmissao',
                'condutor1MotAfastamento',
                'condutor1PeriodoAfastamentoInicio',
                'condutor1PeriodoAfastamentoFim',
                'condutor2Nome',
                'condutor2Cpf',
                'condutor2Rg',
                'condutor2Cnh',
                'condutor2CnhCategoria',
                'condutor2CnhVencimento',
                'condutor2AtestadoDeSaude',
                'condutor2RegistroCTPS',
                'condutor2CertidaoNegativa',
                'condutor2CertidaoNegativaValidade',
                'condutor2CursoPrimeirosSocorros',
                'condutor2CursoPrimeirosSocorrosEmissao',
                'condutor2MotAfastamento',
                'condutor2PeriodoAfastamentoInicio',
                'condutor2PeriodoAfastamentoFim',
                'monitor1Nome',
                'monitor1RG',
                'monitor1DataNasc',
                'monitor1CursoPrimeirosSocorros',
                'monitor1CursoPrimeirosSocorrosEmissao',
                'monitor2Nome',
                'monitor2RG',
                'monitor2DataNasc',
                'monitor2CursoPrimeirosSocorros',
                'monitor2CursoPrimeirosSocorrosEmissao',
                'monitor3Nome',
                'monitor3RG',
                'monitor3DataNasc',
                'monitor3CursoPrimeirosSocorros',
                'monitor3CursoPrimeirosSocorrosEmissao',
                'monitor4Nome',
                'monitor4RG',
                'monitor4DataNasc',
                'monitor4CursoPrimeirosSocorros',
                'monitor4CursoPrimeirosSocorrosEmissao',
                'monitor5Nome',
                'monitor5RG',
                'monitor5DataNasc',
                'monitor5CursoPrimeirosSocorros',
                'monitor5CursoPrimeirosSocorrosEmissao',
                'monitor6Nome',
                'monitor6RG',
                'monitor6DataNasc',
                'monitor6CursoPrimeirosSocorros',
                'monitor6CursoPrimeirosSocorrosEmissao'
            )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario137
    public function certidaoIPI()
    {
        $certidao = null;
        if(isset($this->request['id'])){
            $certidao = Certidao::findByIdComplete($this->request['id']);
        }

        $empresa = Empresa::findComplete(1);        

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario137certidaoIPI";
        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
                'certidao',
                'empresa',
                'dataFormatada',
                'usuario'
            )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    //formulario138
    public function certidaoICMS()
    {
        $certidao = null;
        if(isset($this->request['id'])){
            $certidao = Certidao::findByIdComplete($this->request['id']);
        }

        $empresa = Empresa::findComplete(1);        

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario138certidaoICMS";
        $pdf = PDF::loadView(
            'formularios/' . $formlario,
            compact(
                'certidao',
                'empresa',
                'dataFormatada',
                'usuario'
            )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }


}
