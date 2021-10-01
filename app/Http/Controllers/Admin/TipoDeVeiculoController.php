<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\TipoVeiculo;
use Illuminate\Http\Request;

class TipoDeVeiculoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            TipoVeiculo::class, [
                'descricao' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'modalidade_transporte' => [
                    'required',
                    'regex:/(T|G|E)/'
                ],
                'idade_limite_ingresso' => [
                    'nullable',
                    'number',
                ],
                'idade_limite_permanencia' => [
                    'nullable',
                    'number',
                ],
            ],
            $request
        );
    }
}
