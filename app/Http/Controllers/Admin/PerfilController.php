<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
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
