<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Alvara;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlvaraDoPermissionarioController extends AdminSuperController
{
    public $validatorsList = 
    [
        'permissionario_id' => [
            'required',
        ],
        'data_emissao' => [
            'required',
            'regex:' . Util::REGEX_DATE,
        ],
        'data_vencimento' => [
            'required',
            'regex:' . Util::REGEX_DATE,
        ],
        'data_retorno' => [
            'regex:' . Util::REGEX_DATE,
        ],
        'observacao_retorno' => [
            'max:15',
        ],                
        'tipo_pagamento' => [
            'required',
            'regex:/^(boleto|pix)$/'
        ],
        'chave_pix' => [
            'max:200',
        ],
        'codigo_pix' => [
            'max:200',
        ],
        'valor' => [
            'required',
            'regex:'.Util::REGEX_NUMBER
        ],
        'empresa_id' => [
            'required',
            'exists:empresas,id'
        ],
    ];

    function __construct(Request $request)
    {
        parent::__construct(
            Alvara::class,
            $this->validatorsList,
            $request
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validatorList);

        if ($validator->fails()) {
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }

        $obj = new $this->objectModel();
        $obj->fill($request->all());
        $obj->status="pendente";
        //caso contenha arquivo anexo
        if (isset($request->file)) {
            $obj->original_file_name = $request->file->getClientOriginalName();
            $obj->file_name = 'file_' . $obj->id . "." . $request->file->extension();
        }
        $obj->save();

        if (isset($request->file)) {
            $request->file->storeAs('/' . $obj->getTable(), $obj->file_name);
        }

        return $obj;
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->validatorList);

        if ($validator->fails()) {
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }

        $obj = $this->objectModel::find($id);

        if($obj==null){
            return Parent::responseMsgsJSON("Objeto não encontrado", 400);
        }

        if($obj->status=="pago"){
            return Parent::responseMsgsJSON("Não é possível alterar uma infração paga", 400);
        }

        if($obj->status==null){
            $obj->status="pendente";
        }

        $obj->fill($request->all());

        $obj->update();

        return $obj;
    }

    public function setPagamento(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'data_pagamento' => [
                'required',
                'regex:' . Util::REGEX_DATE,
            ],
        ]);

        if ($validator->fails()) {
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }

        $obj = $this->objectModel::find($id);        
        $obj->usuario_pagamento_id = auth()->id()!=null?auth()->id():auth('api')->id();

        if($obj==null){
            return Parent::responseMsgsJSON("Objeto não encontrado", 400);
        }

        if($obj->status=="pago"){
            return Parent::responseMsgsJSON("Infração já paga", 400);
        }

        $obj->status="pago";
        $obj->data_pagamento=$request['data_pagamento'];
        $obj->update();

        return $obj;
    }

    public function indexWithStatusPendenteAndAguardandoConfirmacao(Request $request)
    {
        $objs = $this->objectModel::where("status", "pendente")
            ->with("permissionario")
            ->with("empresa")
            ->orWhere("status", "aguardando_confirmacao")
            ->orderBy("created_at", "desc")
            ->simplePaginate(20);

        return $objs;
    }
}
