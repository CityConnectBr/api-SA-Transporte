<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\PontoDoPermissionario;
use Illuminate\Http\Request;

class PontoDoPermissionarioController extends AdminSuperController
{
    function __construct(Request $request)
    {
        parent::__construct(
            PontoDoPermissionario::class, [
                'permissionario_id' => [
                    'required',
                    'exists:permissionarios,id'
                ],
                'ponto_id' => [
                    'required',
                    'exists:pontos,id'
                ],
            ],
            $request
        );
    }
}
