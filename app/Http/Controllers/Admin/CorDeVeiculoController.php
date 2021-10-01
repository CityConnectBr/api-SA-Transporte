<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\CorDeVeiculo;
use Illuminate\Http\Request;

class CorDeVeiculoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            CorDeVeiculo::class, [
                'descricao' => [
                    'required',
                    'max:40',
                    'min:2',
                ],
            ],
            $request
        );
    }
}
