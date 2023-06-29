<?php
namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Arquivo;
use App\Models\Empresa;
use App\Models\Endereco;
use App\Models\Infracao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InfracaoController extends Controller
{
    function __construct(Request $request)
    {
    }

    public function index()
    {
        $user = parent::getUserLogged();

        $infracoes = Infracao::findByPermissionarioDifferentStatusCancelado($user->permissionario_id);

        $empresa = null;
        $enderecoEmpresa = null;

        $infracoesDTO = [];
        foreach ($infracoes as $infracao) {
            if ($empresa == null || $empresa->id != $infracao->empresa_id) {
                $empresa = Empresa::find($infracao->empresa_id);
                $enderecoEmpresa = Endereco::find($empresa->endereco_id);
            }

            $infracaoDTO = [];
            $infracaoDTO['id'] = $infracao->id;
            $infracaoDTO['codigo_infracao'] = $infracao->quadro_infracao->id_integracao;
            $infracaoDTO['data_infracao'] = $infracao->data_infracao;
            $infracaoDTO['descricao'] = $infracao->quadro_infracao->descricao;
            $infracaoDTO['chave_pix'] = $infracao->id;
            $infracaoDTO['empresa'] = $empresa->nome;
            $infracaoDTO['cep'] = $enderecoEmpresa->cep;
            $infracaoDTO['municipio'] = $enderecoEmpresa->municipio->nome;
            $infracaoDTO['status'] = $infracao->status;
            $infracaoDTO['valor_final'] = $infracao->valor_final;

            array_push($infracoesDTO, $infracaoDTO);
        }

        return parent::responseJSON(
            $infracoesDTO,
            200
        );
    }

    public function show($id)
    {
        $user = parent::getUserLogged();

        $obj = Infracao::findByPermissionarioAndId($user->permissionario_id, $id);

        if ($obj == null) {
            return parent::responseMsgsJSON("Objeto não encontrado", 400);
        }

        return $obj;
    }
    public function updatePagamento(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'arquivo' => [
                'required',
                'file',
            ],
        ]);


        if ($validator->fails()) {
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $user = parent::getUserLogged();

        $obj = Infracao::findByPermissionarioAndId($user->permissionario_id, $id);

        if ($obj == null) {
            return parent::responseMsgsJSON("Infração não encontrada", 400);
        }

        if ($obj->status != "pendente") {
            return parent::responseMsgsJSON("Infração já paga", 400);
        }

        if (preg_match("/([a-zA-Z0-9\s_\\.\-\(\):])+(.jpg|.jpeg|.png)$/", $request['arquivo']->getClientOriginalName()) == 0) {
            return parent::responseMsgsJSON("Arquivo inválido", 400);
        }

        $arquivo = new Arquivo();
        $arquivo->origem = "app";
        $arquivo->save();

        $request['arquivo']->storeAs('/arquivos', $arquivo->id . ".jpg");

        $obj->status = "confirmacao_pendente";
        $obj->arquivo_comprovante_uid = $arquivo->id;
        $obj->data_envio_comprovante = date('Y-m-d H:i:s');
        $obj->update();

        return $obj;
    }


}