<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Condutor;
use App\Models\Endereco;
use App\Models\Modalidade;
use App\Models\Monitor;
use App\Models\Municipio;
use App\Models\Permissionario;
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

    function formulariorenovacaopermissao(){

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

        $pdf = PDF::loadView('formularios/'.$formlario, compact('obj', 'placas', 'dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    function formulariodeclaracaomonitor(){

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
            if ($solicitacao->nome != 'monitor_cadastro') {
                return parent::responseMsgJSON("Solicitação não é do tipo de cadastro de monitor", 404);
            }
            $enderecoSolicitacao = $solicitacao['campo4'].', '.$solicitacao['campo5'].', '.$solicitacao['campo7'].', '.$solicitacao['campo8'].'-'.$solicitacao['campo9'];
        }

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario07declaracaodemonitor";

        $pdf = PDF::loadView('formularios/'.$formlario, compact('permissionario', 'monitor', 'solicitacao', 'enderecoSolicitacao', 'dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    function condutorauxiliar(){

        if ($this->request['id'] == null) {
            return parent::responseMsgJSON("Id não encontrado", 404);
        }
        $id = $this->request['id'];

        $permissionario = Permissionario::find($id);
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }
        $modalidadeDoPermissionario = $permissionario->modalidade_id!=null?Modalidade::find($permissionario->modalidade_id):null;

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
            $enderecoCondutor = $enderecoObj['endereco'].', '.$enderecoObj['numero'].', '.$enderecoObj['bairro'].', '.$municipioObj['nome'].'-'.$enderecoObj['uf'];
            $emailCondutor = $condutor->email;
        }else if ($this->request['solicitacao_id'] != null) {
            $solicitacao = SolicitacaoDeAlteracao::findComplete($id, $this->request['solicitacao_id']);
            if ($solicitacao->nome != 'condutor_cadastro') {
                return parent::responseMsgJSON("Solicitação não é do tipo de cadastro de monitor", 404);
            }
            $inscricaoOuRenovacao = 0;
            $nomeCondutor = $solicitacao['campo15'];
            $rgCondutor = $solicitacao['campo17'];
            $cnhCondutor = $solicitacao['campo1'];
            $categoriaCNHCondutor = $solicitacao['campo2'];
            $telefoneCondutor = $solicitacao['campo6'];
            $enderecoCondutor = $solicitacao['campo9'].', '.$solicitacao['campo10'].', '.$solicitacao['campo12'].', '.$solicitacao['campo13'].'-'.$solicitacao['campo14'];
            $emailCondutor = $solicitacao['campo11'];
        }

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario08condutorauxiliar";

        $pdf = PDF::loadView('formularios/'.$formlario, compact('permissionario', 'modalidadeDoPermissionario', 'inscricaoOuRenovacao', 'nomeCondutor', 'rgCondutor', 'cnhCondutor', 'categoriaCNHCondutor', 'telefoneCondutor', 'enderecoCondutor', 'emailCondutor', 'dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    function solicitacaodebaixadecondutorauxiliar(){

        if ($this->request['id'] == null) {
            return parent::responseMsgJSON("Id não encontrado", 404);
        }
        $id = $this->request['id'];

        $permissionario = Permissionario::find($id);
        if ($permissionario == null) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }
        $modalidadeDoPermissionario = $permissionario->modalidade_id!=null?Modalidade::find($permissionario->modalidade_id):null;

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

        $pdf = PDF::loadView('formularios/'.$formlario, compact('permissionario', 'modalidadeDoPermissionario', 'condutor', 'dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }
}
