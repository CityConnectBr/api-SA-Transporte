<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\TalaoDoFiscal;
use App\Utils\Util;
use Illuminate\Http\Request;

class TalaoDoFiscalController extends AdminSuperController
{
    function __construct(Request $request)
    {
        parent::__construct(
            TalaoDoFiscal::class,
            [
                'tipo_documento' => [
                    'required',
                    'max:11',
                    'min:2',
                ], 'serie_documento' => [
                    'max:2',
                ], 'numero_primeira_folha' => [
                    'required',
                    'numeric',
                ], 'numero_ultima_folha' => [
                    'required',
                    'numeric',
                ], 'numero_ultima_folha' => [
                    'required',
                    'numeric',
                ], 'data_recebimento' => [
                    'required',
                    'regex:' . Util::REGEX_DATE
                ],
                'fiscal_id' => [
                    'required',
                    'exists:fiscais,id'
                ],
            ],
            $request
        );
    }
}
