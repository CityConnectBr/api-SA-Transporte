<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permissionario;
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

        $pdf = PDF::loadView('formularios/formulario01renovacaopermissao', compact('obj', 'placas', 'dataFormatada', 'usuario'));

        return $pdf->setPaper('a4', 'portrait')->download('formulario01renovacaopermissao.pdf');
    }
}
