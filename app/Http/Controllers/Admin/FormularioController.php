<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Monitor;
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

        $solicitacao = null;
        if ($this->request['solicitacao_id'] != null) {
            $solicitacao = SolicitacaoDeAlteracao::findComplete($id, $this->request['solicitacao_id']);
            if ($solicitacao->nome != 'monitor_cadastro') {
                return parent::responseMsgJSON("Solicitação não é do tipo de cadastro de monitor", 404);
            }
        }

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $usuario = auth()->user();

        $formlario = "formulario07declaracaodemonitor";

        $pdf = PDF::loadView('formularios/'.$formlario, compact('permissionario', 'monitor', 'solicitacao', 'dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }
}
