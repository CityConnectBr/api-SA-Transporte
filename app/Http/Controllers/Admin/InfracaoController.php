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
                'valor_fmp_atual' => [
                    'required',
                    'regex:'.Util::REGEX_NUMBER
                ],
                'fmp_id' => [
                    'required',
                    'exists:fmp,id'
                ],
                'qtd_fmp' => [
                    'required',
                    'regex:'.Util::REGEX_NUMBER
                ],
                'valor_fmp' => [
                    'required',
                    'regex:'.Util::REGEX_NUMBER
                ],
                'valor_final' => [
                    'required',
                    'regex:'.Util::REGEX_NUMBER
                ],
                'empresa_id' => [
                    'required',
                    'exists:empresas,id'
                ],
                /*'data_pagamento' => [
                    'nullable',
                    'regex:' . Util::REGEX_DATE,
                ],
                'status' => [
                    'nullable',
                    'regex:/^(pendente|pago|cancelado|confirmacao_pendente)$/'
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

        $obj->status="pendente";

        $obj->save();

        $solicitacao = SolicitacaoDeAlteracao::find($request['solicitacao_id']);
        if($solicitacao!=null && $solicitacao->status!="A"){
            $solicitacao->status="A";
            $solicitacao->update();
        }

        return $obj;
    }

    public function update(Request $request, $id)
    {
        $obj = $this->objectModel::find($id);

        if($obj==null){
            return Parent::responseMsgsJSON("Objeto não encontrado", 400);
        }

        if($obj->status=="pago"){
            return Parent::responseMsgsJSON("Não é possível alterar uma infração paga", 400);
        }

        if($request['veiculo_id']!=null){
            $veiculo = Veiculo::find($request['veiculo_id']);
            if($veiculo!=null && $veiculo->permissionario_id!=$request['permissionario_id']){
                return Parent::responseMsgsJSON("Veículo não pertence ao permissionário", 400);
            }
        }

        if($request['status']!=null && $request['status']=="pago"){
            return Parent::responseMsgsJSON("Não é possível alterar uma infração paga", 400);
        }

        $obj->fill($request->all());

        $obj->update();

        return $obj;
    }

    public function destroy($id)
    {
        $obj = $this->objectModel::find($id);

        if($obj==null){
            return Parent::responseMsgsJSON("Objeto não encontrado", 400);
        }

        if($obj->status=="pago"){
            return Parent::responseMsgsJSON("Não é possível excluir uma infração paga", 400);
        }

        $obj->delete();

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

    public function reprovarPagamento(Request $request, $id)
    {
        //TODO: 
        /*$validator = Validator::make($request->all(), [
            'obs_reprovacao' => [
                'required',
                'max:500',
            ],
        ]);

        if ($validator->fails()) {
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }
        */

        $obj = $this->objectModel::find($id);        
        $obj->usuario_pagamento_id = auth()->id()!=null?auth()->id():auth('api')->id();

        if($obj==null){
            return Parent::responseMsgsJSON("Objeto não encontrado", 400);
        }

        if($obj->status!="confirmacao_pendente"){
            return Parent::responseMsgsJSON("Infração não está com status de confirmação pendente", 400);
        }

        $obj->status="confirm_rejeitada";
        //$obj->obs_reprovacao=$request['obs_reprovacao'];//TODO
        $obj->update();

        return $obj;
    }


}
