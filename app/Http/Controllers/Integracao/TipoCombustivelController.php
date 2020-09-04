<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\TipoCombustivel;

class TipoCombustivelController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(TipoCombustivel::class, [
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
