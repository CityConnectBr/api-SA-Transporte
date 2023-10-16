<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Monitor;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MonitorController extends AdminSuperController
{

    function __construct(Request $request)
    {
        $postMethod = $request->method() == 'POST';
        parent::__construct(
            Monitor::class,
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
                'data_nascimento' => [
                    'required',
                    'regex:' . Util::REGEX_DATE
                ],
                'certidao_negativa' => [
                    'boolean',
                    'nullable'
                ],
                'validade_da_certidao_negativa' => [
                    'nullable',
                    'regex:' . Util::REGEX_DATE
                ],
                'curso_de_primeiro_socorros' => [
                    'boolean',
                    'nullable'
                ],
                'emissao_curso_de_primeiro_socorros' => [
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function indexByPermissionario()
    {
        $permissionarioId = $this->request->input('permissionario_id');
        $search = $this->request->input('search');

        return Monitor::searchByPermissionario($permissionarioId, $search);
    }

    public function index()
    {
        $objSearch = null;
        $search = $this->request->input('search');
        if ($search == null) {
            $search = $this->request->query('search');
        }

        $ativo = $this->request->input('ativo');
        $todos = $this->request->input('todos');
        $emailValidos = true;

        if (isset($todos)) {
            $objSearch = $this->objectModel::search($search, $ativo, true, $emailValidos);
        } else {
            $objSearch = $this->objectModel::search($search, $ativo, false, $emailValidos);
        }

        if ($objSearch != null) {
            return $objSearch;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

}