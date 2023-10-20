<?php
namespace app\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\PontoDoPermissionario;
use Illuminate\Http\Request;

class PontoController extends Controller
{

    function __construct(Request $request)
    {
        parent::__construct(PontoDoPermissionario::class, $request);
    }

    public function pontosByPermissionario()
    {
        $permissionarioLogado = parent::getUserLogged()->permissionario_id;
        if(!isset($permissionarioLogado)){
            return parent::responseMsgJSON("Não encontrado!", 404);
        }

        $pontos = PontoDoPermissionario::getAllByPermissionario($permissionarioLogado);
        return parent::responseJSON($pontos);
    }


}
