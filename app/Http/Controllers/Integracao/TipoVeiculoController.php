<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\TipoVeiculo;

class TipoVeiculoController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(TipoVeiculo::class, [
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
