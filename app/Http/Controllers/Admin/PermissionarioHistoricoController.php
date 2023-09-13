<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\PermissionarioHistorico;

class PermissionarioHistoricoController extends AdminSuperController
{
    function __construct (Request $request) {
        parent::__construct(
            PermissionarioHistorico::class,
            [
                "permissionario_id",
                "campo",
                "valor_antigo",
                "valor_novo",
            ],
            $request
        );
    }

    public function index()
    {
        $obj = null;

        $permissionario = $this->request->input('permissionario');


        $obj = $this->objectModel::search($permissionario);

        if ($obj != null) {
            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }
}
