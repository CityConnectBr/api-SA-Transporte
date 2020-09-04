<?php
namespace app\Http\Controllers\Integracao;

use App\Models\CorVeiculo;
use App\Http\Controllers\Integracao\IntegracaoController;

class CorVeiculoController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(CorVeiculo::class, [
            'descricao' => [
                'required',
                'max:40',
                'min:3'
            ],
            'id_integracao' => [
                'required',
                'numeric'
            ]
        ]);
    }
}
