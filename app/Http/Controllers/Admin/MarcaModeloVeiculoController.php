<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\MarcaModeloVeiculo;
use Illuminate\Http\Request;

class MarcaModeloVeiculoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            MarcaModeloVeiculo::class, [
                'descricao' => [
                    'required',
                    'max:40',
                    'min:2',
                ],
                'codigo_ipva' => [
                    'nullable'
                ]
            ],
            $request
        );
    }
}
