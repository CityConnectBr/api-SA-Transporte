<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\CursoDoPermissionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TipoDeCurso;
use App\Models\Permissionario;

class CursoDoPermissionarioController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(CursoDoPermissionario::class, [
            'permissionario_id' => [
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

        $obj = new CursoDoPermissionario();
        $obj->fill($request->all());
        $obj->permissionario_id = Permissionario::firstWhere("id_integracao", $request->input("permissionario_id"))->id;
        $obj->tipo_do_curso_id = TipoDeCurso::firstWhere("id_integracao", $request->input("tipo_do_curso_id"))->id;

        $obj->save();

        return $obj;
    }

}
