<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\FMP;
use App\Utils\Util;

class FMPController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(FMP::class, [
            'data_inicial' => [
                'required',
                'regex:'.Util::REGEX_DATE
            ],
            'data_final' => [
                'required',
                'regex:'.Util::REGEX_DATE
            ],
            'valor' => [
                'required',
                'numeric'
            ],
            'moeda_id' => [
                'required',
                'exists:moedas,id'
            ],
        ]);
    }
}
