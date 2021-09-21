<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\ObservacaoDoPermissionario;
use Illuminate\Http\Request;

class ObservacaoDoPermissionarioController extends AdminSuperController
{
    function __construct(Request $request)
    {
        parent::__construct(
            ObservacaoDoPermissionario::class, [
                'permissionario_id' => [
                    'required',
                    'exists:permissionarios,id'
                ],
                'titulo' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'observacao' => [
                    'required',
                    'max:500',
                    'min:3'
                ],
            ],
            $request
        );
    }
}
