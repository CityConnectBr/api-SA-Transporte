<?php
namespace app\Http\Controllers\SaT;

use App\Http\Controllers\Controller;
use App\Models\Alvara;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class ConsultasAppController extends Controller
{

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function consultaStatusVeiculo(Request $request)
    {
        $veiculo = Veiculo::where('placa', $request->placa)->first();

        if (!isset($veiculo)) {
            return parent::responseMsgJSON('Veículo não encontrado', 404);
        }

        $alvarasPermissionario = Alvara::findByPermissionario($veiculo->permissionario_id);

        $alvaraValido = false;
        foreach ($alvarasPermissionario as $alvara) {
            if ($alvara->data_vencimento >= date('Y-m-d')) {
                $alvaraValido = true;

                break;
            }
        }

        return parent::responseJSON([
            'alvaraValido' => $alvaraValido
        ], 200);
    }

}