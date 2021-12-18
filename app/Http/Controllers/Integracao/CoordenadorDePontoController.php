<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\CoordenadorDoPonto;
use App\Models\Permissionario;
use App\Models\Ponto;
use Illuminate\Http\Request;
use App\Utils\Util;
use Illuminate\Support\Facades\Validator;

class CoordenadorDePontoController extends IntegracaoController
{
    function __construct()
    {
        parent::__construct(CoordenadorDoPonto::class, [
            'data_inicial' => [
                'nullable',
                'regex:'.Util::REGEX_DATE
            ],
            'data_termino' => [
                'nullable',
                'regex:'.Util::REGEX_DATE
            ],
            'observacao' => [
                'max:500',
            ],
            'permissionario_id' => [
                'required',
            ],
            'ponto_id' => [
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
        $obj = new CoordenadorDoPonto();
        $obj->fill($request->all());
        $obj->permissionario_id = Permissionario::firstWhere("id_integracao", $request->input("permissionario_id"))->id;
        $obj->ponto_id = Ponto::firstWhere("id_integracao", $request->input("ponto_id"))->id;

        $obj->save();

        return $obj;
    }


}
