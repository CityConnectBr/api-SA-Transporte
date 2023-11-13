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
        if (!isset($permissionarioLogado)) {
            return parent::responseMsgJSON("Não encontrado!", 404);
        }

        $pontos = PontoDoPermissionario::getAllByPermissionario($permissionarioLogado);
        return parent::responseJSON($pontos);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->request->query->get("modalidade") == null) {
            return parent::responseMsgJSON("Parâmetro modalidade não informado!", 400);
        }
        $modalidade = $this->request->query->get("modalidade");

        if ($modalidade != "escolar" && $modalidade != "taxi") {
            return parent::responseMsgJSON("Parâmetro modalidade inválido!", 400);
        }

        $search = $this->request->query->get("search");
        if ($search == null) {
            $search = "";
        }

        $pontos = null;
        if ($modalidade == "escolar") {
            $pontos = PontoDoPermissionario::searchEscolar(
                $search
            );
        } else {
            $pontos = PontoDoPermissionario::searchTaxi(
                $search
            );
        }

        return parent::responseJSON($pontos);

    }


}
