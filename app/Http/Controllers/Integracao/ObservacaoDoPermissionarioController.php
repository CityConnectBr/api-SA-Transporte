<?php

namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\ObservacaoDoPermissionario;
use App\Models\Permissionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObservacaoDoPermissionarioController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(
            ObservacaoDoPermissionario::class,
            [
                'titulo' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'observacao' => [
                    'required',
                    'max:500',
                    'min:3'
                ],
            ]
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
            return response()->json($validator->errors(), 400);
        }

        $permissionario = Permissionario::firstWhereByIntegracao($request->permissionario_id);

        if ($permissionario==null) {
            return response()->json('Permissionário não encontrado', 404);
        }

        $obj = new ObservacaoDoPermissionario();
        $obj->fill($request->all());
        $obj->permissionario_id = $permissionario->id;

        $obj->save();

        return $obj;
    }
}
