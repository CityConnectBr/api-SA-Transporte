<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\Condutor;
use App\Models\CursoDoCondutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TipoDeCurso;

class CursoDoCondutorController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(CursoDoCondutor::class, [
            'condutor_id' => [
                'required',
            ],
            'tipo_do_curso_id' => [
                'required',
            ],
            'data_emissao' => [
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

        $obj = new CursoDoCondutor();
        $obj->fill($request->all());
        $obj->condutor_id = Condutor::firstWhere("id_integracao", $request->input("condutor_id"))->id;
        $obj->tipo_do_curso_id = TipoDeCurso::firstWhere("id_integracao", $request->input("tipo_do_curso_id"))->id;

        $obj->save();

        return $obj;
    }

}
