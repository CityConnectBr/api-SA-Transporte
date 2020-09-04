<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\MarcaModeloVeiculo;

class MarcaModeloVeiculoController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(MarcaModeloVeiculo::class, [
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
