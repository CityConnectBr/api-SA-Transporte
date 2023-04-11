<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Infracao;
use App\Models\SolicitacaoDeAlteracao;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use App\Utils\Util;
use Illuminate\Support\Facades\Validator;

class InfracaoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Infracao::class, [
                'num_aip' => [
                    'required',
                    'max:11',
                ],
                'data_infracao' => [
                    'required',
                    'regex:' . Util::REGEX_DATE,
                ],
                'hora_infracao' => [
                    'required',
                    'regex:' . Util::REGEX_HOUR,
                ],
                'obs_aip' => [
                    'max:500',
                ],
                'descricao' => [
                    'nullable',
                    'max:500',
                ],
                'acao_tomada' => [
                    'nullable',
                    'max:500',
                ],
                'num_processo' => [
                    'nullable',
                    'max:15',
                ],
                'num_boleto' => [
                    'nullable',
                    'max:15',
                ],
                'data_vendimento_boleto' => [
                    'nullable',
                    'regex:' . Util::REGEX_DATE,
                ],
                'qtd_moeda' => [
                    'required',
                    'regex:'.Util::REGEX_NUMBER
                ],
                'moeda_id' => [
                    'required',
                    'exists:moedas,id'
                ],
                'permissionario_id' => [
                    'required',
                    'exists:permissionarios,id'
                ],
                'veiculo_id' => [
                    'exists:veiculos,id'
                ],
                'quadro_infracao_id' => [
                    'required',
                    'exists:quadro_de_infracoes,id'
                ],
                'natureza_infracao_id' => [
                    'required',
                    'exists:naturezas_da_infracao,id'
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
                /*'data_pagamento' => [
                    'nullable',
                    'regex:' . Util::REGEX_DATE,
                ],
                'status' => [
                    'nullable',
                    'regex:/^(pendente|pago|cancelado|aguardando_confirmacao)$/'
                ],*/
            ],
            $request
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validatorList);

        if ($validator->fails()) {
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }

        if($request['veiculo_id']!=null){
            $veiculo = Veiculo::find($request['veiculo_id']);
            if($veiculo!=null && $veiculo->permissionario_id!=$request['permissionario_id']){
                return Parent::responseMsgsJSON("Veículo não pertence ao permissionário", 400);
            }
        }

        $obj = new $this->objectModel();
        $obj->fill($request->all());
        $obj->save();

        $solicitacao = SolicitacaoDeAlteracao::find($request['solicitacao_id']);
        if($solicitacao!=null){
            $solicitacao->status="A";
            $solicitacao->update();
        }

        return $obj;
    }
}
