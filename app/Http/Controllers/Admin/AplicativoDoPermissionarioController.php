<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\AplicativoDoPermissionario;
use Illuminate\Http\Request;

class AplicativoDoPermissionarioController extends AdminSuperController
{
    function __construct(Request $request)
    {
        parent::__construct(
            AplicativoDoPermissionario::class, [
                'permissionario_id' => [
                    'required',
                    'exists:permissionarios,id'
                ],
                'aplicativo_id' => [
                    'required',
                    'exists:aplicativos,id'
                ],
            ],
            $request
        );
    }
}
