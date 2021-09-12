<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\AnexoDoPermissionario;
use Illuminate\Http\Request;

class AnexoDoPermissionarioController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            AnexoDoPermissionario::class, [
                'permissionario_id' => [
                    'required',
                    'exists:permissionarios,id'
                ],
                'descricao' => [
                    'required',
                    'max:60',
                ],
                'file' => [
                    'required',
                    'file',
                ]
            ],
            $request,
            true
        );
    }
}
