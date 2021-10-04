<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Veiculo::class, [
                'placa' => [
                    'required',
                    'max:7',
                    'min:7'
                ],'cod_renavam' => [
                    'required',
                    'max:11',
                    'min:11'
                ],'chassi' => [
                    'required',
                    'max:25',
                    'min:3'
                ],'ano_fabricacao' => [
                    'required',
                    'number'
                ],'ano_modelo' => [
                    'required',
                    'number'
                ],'capacidade' => [
                    'required',
                    'max:15',
                    'min:1'
                ],'observacao_capacidade' => [
                    'required',
                    'max:40',
                    'min:3'
                ],'anos_vida_util_veiculo' => [
                    'required',
                    'number'
                ],'observacao_capacidade' => [
                    'max:40',
                ],'marca_modelo_veiculo_id' => [
                    'required',
                    'exists:marcas_modelos_veiculos,id'
                ],'tipo_combustivel_id' => [
                    'required',
                    'exists:tipos_combustiveis,id'
                ],'cor_id' => [
                    'required',
                    'exists:cores_veiculos,id'
                ],'tipo_veiculo_id' => [
                    'required',
                    'exists:tipos_veiculos,id'
                ],'permissionario_id' => [
                    'required',
                    'exists:permissionarios,id'
                ],'categoria_id' => [
                    'required',
                    'exists:categorias_veiculos,id'
                ]
            ],
            $request
        );
    }
}
