<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\ValoresDaInfracao;
use App\Utils\Util;
use Illuminate\Http\Request;

class ValoresDaInfracaoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            ValoresDaInfracao::class, [
                'modalidade_transporte' => [
                    'required',
                    'max:1',
                    'min:1'
                ],'quantidade' => [
                    'required',
                    'regex:'.Util::REGEX_NUMBER
                ],'natureza_infracao_id' => [
                    'required',
                    'exists:naturezas_da_infracao,id'
                ],'moeda_id' => [
                    'required',
                    'exists:moedas,id'
                ]
            ],
            $request
        );
    }
}
