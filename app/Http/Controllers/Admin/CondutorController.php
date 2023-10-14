<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Condutor;
use App\Utils\Util;
use Illuminate\Http\Request;

class CondutorController extends AdminSuperController
{

    function __construct(Request $request)
    {
        $postMethod = $request->method() == 'POST';
        parent::__construct(
            Condutor::class,
            [
                'numero_de_cadastro_antigo' => [
                    'max:10',
                ],
                'nome' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'cpf' => [
                    'required',
                    'max:11',
                    'min:11',
                    'regex:' . Util::REGEX_CPF_CNPJ,
                ],
                'rg' => [
                    'required',
                    'max:9',
                ],
                'telefone' => [
                    'nullable',
                    'regex:' . Util::REGEX_PHONE,
                ],
                'celular' => [
                    'nullable',
                    'regex:' . Util::REGEX_PHONE,
                ],
                'email' => [
                    'nullable',
                    'email',
                    'max:200',
                ],
                'cnh' => [
                    'required',
                    'max:15',
                ],
                'categoria_cnh' => [
                    'required',
                    'max:2',
                    'min:1'
                ],
                'vencimento_cnh' => [
                    'required',
                    'regex:' . Util::REGEX_DATE
                ],
                'atestado_de_saude' => [
                    'boolean',
                    'nullable'
                ],
                'certidao_negativa' => [
                    'boolean',
                    'nullable'
                ],
                'validade_certidao_negativa' => [
                    'nullable',
                    'regex:' . Util::REGEX_DATE
                ],
                'registro_ctps' => [
                    'boolean',
                    'nullable'
                ],
                'primeiros_socorros' => [
                    'boolean',
                    'nullable'
                ],
                'emissao_primeiros_socorros' => [
                    'nullable',
                    'regex:' . Util::REGEX_DATE
                ],
                'motivo_afastamento' => [
                    'nullable',
                    'max:40',
                ],
                'data_inicio_afastamento' => [
                    'nullable',
                    'regex:' . Util::REGEX_DATE
                ],
                'data_termino_afastamento' => [
                    'nullable',
                    'regex:' . Util::REGEX_DATE
                ],
                'endereco_id' => [
                    $postMethod ? 'required' : '',
                    'exists:enderecos,id'
                ],
                'permissionario_id' => [
                    $postMethod ? 'required' : '',
                    'exists:permissionarios,id'
                ],
            ],
            $request
        );
    }

    public function getByPermissionario($permissionarioId)
    {
        return Condutor::searchByPermissionario($permissionarioId, "");
    }

    public function index()
    {
        $objSearch = null;
        $search = $this->request->input('search');
        if ($search == null) {
            $search = $this->request->query('search');
        }

        $ativo = $this->request->input('ativo');
        $usuario = $this->request->input('usuario');
        $todos = $this->request->input('todos');
        $emailPushValidos = $this->request->input('email_push_validos');

        if (isset($todos)) {
            $objSearch = $this->objectModel::search($search, $ativo, $usuario, true, $emailPushValidos);
        } else {
            $objSearch = $this->objectModel::search($search, $ativo, $usuario, false, $emailPushValidos);
        }

        if ($objSearch != null) {
            return $objSearch;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

}