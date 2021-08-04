<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Perfil;
use App\Rules\PerfilExists;
use Illuminate\Http\Request;

class UsuarioController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Perfil::class, [
                'nome' => [
                    'required',
                    'max:100',
                    'min:3'
                ],
                'email' => [
                    'email',
                    'max:200',
                ],
                'password' => [
                    'required',
                    'min:6'
                ],
                'perfil_web_id' => [
                    'required',
                    new PerfilExists
                ]
            ],
            $request
        );
    }
}
