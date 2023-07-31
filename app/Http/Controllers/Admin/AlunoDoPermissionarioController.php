<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\AlunoDoPermissionario;
use Illuminate\Http\Request;

class AlunoDoPermissionarioController extends AdminSuperController
{
    function __construct(Request $request)
    {
        parent::__construct(
            AlunoDoPermissionario::class,
            [
                'nome' => [
                    'required',
                    'max:40'
                ],
                'data_nascimento' => [
                    'nullable',
                    'date'
                ],
                'telefone' => [
                    'nullable',
                    'max:20'
                ],
                'hora_entrada' => [
                    'nullable',
                    'date_format:H:i'
                ],
                'hora_saida' => [
                    'nullable',
                    'date_format:H:i'
                ],
                'email' => [
                    'nullable',
                    'max:200'
                ],
                'permissionario_id' => [
                    'required',
                    'exists:permissionarios,id'
                ],
                'ponto_id' => [
                    'nullable',
                    'exists:pontos,id'
                ],
            ],
            $request
        );
    }
}