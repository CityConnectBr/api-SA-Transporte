<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\TalaoDoFiscal;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TalaoDoFiscalController extends AdminSuperController
{
    function __construct(Request $request)
    {
        parent::__construct(
            TalaoDoFiscal::class,
            [
                'numero' => [
                    'required',
                    'max:11',
                ], 'tipo_documento' => [
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validatorList);

        if ($validator->fails()) {
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }

        if (sizeof(TalaoDoFiscal::findFiscalAndNumero($request['fiscal_id'], $request['numero'])) > 0) {
            return Parent::responseMsgsJSON("Número/Fiscal ja existem cadastrados.", 400);
        }

        return parent::store($request);
    }
}
