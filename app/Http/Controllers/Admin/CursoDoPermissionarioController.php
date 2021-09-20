<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\CursoDoPermissionario;
use Illuminate\Http\Request;

class CursoDoPermissionarioController extends AdminSuperController
{
    function __construct(Request $request)
    {
        parent::__construct(
            CursoDoPermissionario::class, [
                'permissionario_id' => [
                    'required',
                    'exists:permissionarios,id'
                ],
                'tipo_do_curso_id' => [
                    'required',
                    'exists:tipos_de_curso,id'
                ],
                'data_emissao' => [
                    'required',
                ],
            ],
            $request
        );
    }
}
