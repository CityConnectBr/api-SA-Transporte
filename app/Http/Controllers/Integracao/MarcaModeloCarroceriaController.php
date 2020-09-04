<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\MarcaModeloCarroceria;

class MarcaModeloCarroceriaController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(MarcaModeloCarroceria::class, [
            'descricao' => [
                'required',
                'max:40',
                'min:3'
            ],
            'modelo' => [
                'required',
                'max:20',
                'min:3'
            ],
            'id_integracao' => [
                'required',
                'numeric'
            ]
        ]);
    }
}
