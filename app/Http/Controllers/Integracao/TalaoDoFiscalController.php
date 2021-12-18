<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\Fiscal;
use Illuminate\Http\Request;
use App\Models\TalaoDoFiscal;
use App\Utils\Util;
use Illuminate\Support\Facades\Validator;

class TalaoDoFiscalController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(TalaoDoFiscal::class, [

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
            ],
            'fiscal_id' => [
                'required',
            ],
        ]);
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
            return response()->json($validator->errors(), 400);
        }
        $talao = new TalaoDoFiscal();
        $talao->fill($request->all());
        $talao->fiscal_id = Fiscal::findByIntegracaoComplete($talao->fiscal_id)->id;

        $talao->save();

        return $talao;
    }


}
