<?php
namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\v1\Admin\AdminSuperController;
use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Perfil::class, [
                'nome' => [
                    'required',
                    'max:20',
                    'min:3'
                ]
            ],
            $request
        );
    }
}
