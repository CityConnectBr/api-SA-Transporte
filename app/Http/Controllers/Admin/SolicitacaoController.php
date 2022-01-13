<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Condutor;
use App\Models\Endereco;
use App\Models\Fiscal;
use App\Models\Monitor;
use App\Models\Permissionario;
use App\Models\SolicitacaoDeAlteracao;
use App\Models\TipoDeSolicitacaoDeAlteracao;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SolicitacaoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            SolicitacaoDeAlteracao::class,
            [],
            $request
        );
    }

    public function show($id)
    {
        $obj = $this->objectModel::findComplete($id);
        if (isset($obj)) {
            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $search = $this->request->input('search');
        if ($search == null) {
            $search = $this->request->query('search');
        }

        $obj = SolicitacaoDeAlteracao::searchInverseOrder($search);

        if ($obj != null) {
            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

    public function concluir($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => [
                'required',
                'regex:/(A|R|C)/'
            ],
        ]);

        if ($validator->fails()) {
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }

        if ($request['status'] !== 'A') {
            if (!isset($request['motivo_recusado'])) {
                return Parent::responseMsgsJSON("Campo motivo_recusado obrigatório.", 400);
            }
        }

        $solicitacao = SolicitacaoDeAlteracao::find($id);
        if ($solicitacao != null) {
            if ($solicitacao->status !== null) {
                return Parent::responseMsgsJSON("Solicitação ja se encontra concluida.", 401);
            }

            if ($request['status'] !== 'A') {
                $solicitacao->status = $request['status'];
                $solicitacao->motivo_recusado = $request['motivo_recusado'];
                $solicitacao->update();
            } else {
                $tipoDaSolicitacao = TipoDeSolicitacaoDeAlteracao::find($solicitacao->tipo_solicitacao_id);

                if (Str::contains($tipoDaSolicitacao->nome, ['condutor'])) {
                    $this->saveObj(
                        $solicitacao,
                        $tipoDaSolicitacao,
                        Condutor::class
                    );
                } else if (Str::contains($tipoDaSolicitacao->nome, ['permissionario'])) {
                    $this->saveObj(
                        $solicitacao,
                        $tipoDaSolicitacao,
                        Permissionario::class
                    );
                } else if (Str::contains($tipoDaSolicitacao->nome, ['monitor'])) {
                    $this->saveObj(
                        $solicitacao,
                        $tipoDaSolicitacao,
                        Monitor::class
                    );
                } else if (Str::contains($tipoDaSolicitacao->nome, ['fiscal'])) {
                    $this->saveObj(
                        $solicitacao,
                        $tipoDaSolicitacao,
                        Fiscal::class
                    );
                } else if (Str::contains($tipoDaSolicitacao->nome, ['veiculo'])) {
                    $this->saveObj(
                        $solicitacao,
                        $tipoDaSolicitacao,
                        Veiculo::class
                    );
                } else {
                    return parent::responseMsgJSON("Tipo não encontrado", 404);
                }

                //finalisando solicitacao
                $solicitacao->status = $request['status'];
                $solicitacao->update();
            }
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

    private function saveObj($solicitacao, $tipoDaSolicitacao, $obj)
    {
        $id = $solicitacao['referencia_id'];
        $permissionarioId = $solicitacao['permissionario_id'];
        $array = $this->getArrayInfoToSave($tipoDaSolicitacao, $solicitacao);

        $obj = new $obj();
        $enderecoObj = null;
        if ($id != null) {
            $obj = $obj::find($id);
            if ($obj->endereco_id !== null)
                $enderecoObj = Endereco::find($obj->endereco_id);
        }

        if (
            Str::contains($tipoDaSolicitacao->nome, ['contato']) ||
            Str::contains($tipoDaSolicitacao->nome, ['identidade']) ||
            Str::contains($tipoDaSolicitacao->nome, ['cnh']) ||
            Str::contains($tipoDaSolicitacao->nome, ['cadastro']) ||
            Str::contains($tipoDaSolicitacao->nome, ['veiculo'])
        ) {
            $obj->permissionario_id = $permissionarioId;
            $obj->fill($array);

            if(Str::contains($tipoDaSolicitacao->nome, ['veiculo']))
                $obj->categoria_id = 1;//Setando categoria veículo
        }

        if (
            Str::contains($tipoDaSolicitacao->nome, ['cadastro']) ||
            Str::contains($tipoDaSolicitacao->nome, ['endereco'])
        ) {
            if ($enderecoObj == null)
                $enderecoObj = new Endereco();

            $enderecoObj->fill($array);

            if ($enderecoObj->id !== null) {
                $enderecoObj->update();
            } else {
                $enderecoObj->save();
            }
        }

        if (Str::contains($tipoDaSolicitacao->nome, ['foto'])) {
            $obj->foto_uid = $solicitacao->arquivo1_uid;
        }


        if ($id != null) {
            $obj->update();
        } else {
            if ($enderecoObj!==null && $enderecoObj->id !== null)
                $obj->endereco_id = $enderecoObj->id;

            $obj->save();
        }
    }

    private function getArrayInfoToSave($tipoDaSolicitacao, $solicitacao)
    {
        $toSave = array();
        for ($i = 1; $i < 21; $i++) {
            $nameField = $tipoDaSolicitacao["nome_campo" . $i];
            $contentField = $solicitacao["campo" . $i];
            if (
                $nameField == null || $nameField == ''
                || $contentField == null || $contentField == ''
            ) {
                continue;
            }
            $toSave[$nameField] = $contentField;
        }

        return $toSave;
    }
}
