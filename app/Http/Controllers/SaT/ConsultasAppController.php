<?php
namespace app\Http\Controllers\SaT;

use App\Http\Controllers\Controller;
use App\Models\Alvara;
use App\Models\Permissionario;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class ConsultasAppController extends Controller
{

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function permissaoDeOperacao(Request $request)
    {
        $param = $request->param;

        if ($param == null || $param == '') {
            return parent::responseJSON([
                'alvaraValido' => false,
                'mensagem' => 'Veículo não encontrado'
            ], 200);
        }

        // Verifica se o parâmetro contém apenas números e letras
        if (!preg_match('/^[a-zA-Z0-9]+$/', $param)) {
            return parent::responseJSON([
                'alvaraValido' => false,
                'mensagem' => 'Veículo não encontrado'
            ], 200);
        }

        $permissionario = Permissionario::firstByCpfCnpj($param);
        $veiculo = Veiculo::where('placa', $param)->first();
        if (!isset($veiculo) && !isset($permissionario)) {
            return parent::responseJSON([
                'alvaraValido' => false,
                'mensagem' => 'Veículo ou permissionário não encontrado'
            ], 200);
        }

        $alvarasPermissionario = Alvara::findByPermissionario($permissionario != null
            ? $permissionario->id
            : $veiculo->permissionario_id);

        $alvaraValido = false;
        foreach ($alvarasPermissionario as $alvara) {
            if ($alvara->data_vencimento >= date('Y-m-d')) {
                $alvaraValido = true;

                break;
            }
        }

        return parent::responseJSON([
            'alvaraValido' => $alvaraValido,
            'mensagem' => $alvaraValido ? 'Alvará válido' : 'Alvará inválido'
        ], 200);
    }

}