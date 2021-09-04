<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\PontoDoPermissionario;
use Illuminate\Http\Request;

class PontoDoUsuarioController extends AdminSuperController
{
    function __construct(Request $request)
    {
        parent::__construct(
            PontoDoPermissionario::class, [
                'permissionario_id' => [
                    'required',
                ],
                'ponto_id' => [
                    'required',
                ],
            ],
            $request
        );
    }
}
