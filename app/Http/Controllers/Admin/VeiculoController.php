<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Veiculo;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VeiculoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Veiculo::class,
            [],
            $request
        );

        $this->validacaoVeiculo = [
            'placa' => [
                'required',
                'max:7',
                'min:7'
            ], 'cod_renavam' => [
                'required',
                'max:11',
                'min:11'
            ], 'chassi' => [
                'required',
                'max:25',
                'min:3'
            ], 'ano_fabricacao' => [
                'required',
                'regex:' . Util::REGEX_NUMBER
            ], 'ano_modelo' => [
                'required',
                'regex:' . Util::REGEX_NUMBER
            ], 'capacidade' => [
                'required',
                'max:15',
                'min:1'
            ], 'tipo_capacidade' => [
                'required',
                'max:1',
                'min:1'
            ], 'observacao_capacidade' => [
                'required',
                'max:40',
                'min:3'
            ], 'anos_vida_util_veiculo' => [
                'required',
                'regex:' . Util::REGEX_NUMBER
            ], 'observacao_capacidade' => [
                'max:40',
            ], 'marca_modelo_veiculo_id' => [
                'required',
                'exists:marcas_modelos_veiculos,id'
            ], 'tipo_combustivel_id' => [
                'required',
                'exists:tipos_combustiveis,id'
            ], 'cor_id' => [
                'required',
                'exists:cores_veiculos,id'
            ], 'tipo_veiculo_id' => [
                'required',
                'exists:tipos_veiculos,id'
            ], 'permissionario_id' => [
                'required',
                'exists:permissionarios,id'
            ], 'categoria_id' => [
                'required',
                'exists:categorias_veiculos,id'
            ]
        ];


        $this->validacaoOnibus = [
            'placa' => [
                'required',
                'max:7',
                'min:7'
            ], 'cod_renavam' => [
                'required',
                'max:11',
                'min:11'
            ], 'chassi' => [
                'required',
                'max:25',
                'min:3'
            ], 'ano_fabricacao' => [
                'required',
                'regex:' . Util::REGEX_NUMBER
            ], 'ano_modelo' => [
                'required',
                'regex:' . Util::REGEX_NUMBER
            ], 'capacidade' => [
                'required',
                'max:15',
                'min:1'
            ], 'tipo_capacidade' => [
                'required',
                'max:1',
                'min:1'
            ], 'observacao_capacidade' => [
                'required',
                'max:40',
                'min:3'
            ], 'anos_vida_util_veiculo' => [
                'required',
                'regex:' . Util::REGEX_NUMBER
            ], 'observacao_capacidade' => [
                'max:40',
            ], 'marca_modelo_carroceria_id' => [
                'required',
                'exists:marcas_modelos_carrocerias,id'
            ], 'marca_modelo_chassi_id' => [
                'required',
                'exists:marcas_modelos_chassis,id'
            ], 'tipo_combustivel_id' => [
                'required',
                'exists:tipos_combustiveis,id'
            ], 'cor_id' => [
                'required',
                'exists:cores_veiculos,id'
            ], 'tipo_veiculo_id' => [
                'required',
                'exists:tipos_veiculos,id'
            ], 'permissionario_id' => [
                'required',
                'exists:permissionarios,id'
            ], 'categoria_id' => [
                'required',
                'exists:categorias_veiculos,id'
            ]
        ];
    }

    public function store(Request $request)
    {
        $categoria = $request['categoria_id']!=null?$request['categoria_id']:1;
        $validator = Validator::make($request->all(), $categoria==1?$this->validacaoVeiculo:$this->validacaoOnibus);

        if ($validator->fails()) {
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }

        $obj = new $this->objectModel();
        $obj->fill($request->all());

        return $obj;
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->validatorList);

        if ($validator->fails()) {
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }

        $obj = $this->objectModel::find($id);
        if (isset($obj)) {
            $obj->fill($request->all());
            $obj->update();

            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

    public function indexByPermissionario()
    {
        return Veiculo::searchByIdPermissionario($this->request->query->get("permissionario_id"), $this->request->query->get("search"),);
    }
}
