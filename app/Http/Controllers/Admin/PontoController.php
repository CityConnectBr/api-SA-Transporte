<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Ponto;
use App\Utils\Util;
use Illuminate\Http\Request;

class PontoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Ponto::class, [
                'descricao' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'modalidade_id' => [
                    'required',
                    'exists:modalidades,id'
                ],
                'id_integracao' => [
                    'max:40',
                ],
                'telefone' => [
                    'nullable',
                    'regex:'.Util::REGEX_PHONE,
                ],
                'data_criacao' => [
                    'nullable',
                    'regex:'.Util::REGEX_DATE
                ],
                'data_extincao' => [
                    'nullable',
                    'regex:'.Util::REGEX_DATE
                ],
                'ocupacao_atual' => [
                    'max:40',
                ],
                'observacao' => [
                    'max:500',
                ],
            ],
            $request
        );
    }
}
