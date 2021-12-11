<?php

namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\TipoDeCurso;

class TipoDeCursoController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(TipoDeCurso::class, [
            'descricao' => [
                'max:40',
            ],
             'modalidade' => [
                'required',
                'regex:/(E|G|T)/'
            ],
        ]);
    }
}
