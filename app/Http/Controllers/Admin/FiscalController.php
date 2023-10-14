<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Fiscal;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FiscalController extends AdminSuperController
{

    function __construct(Request $request)
    {
        $postMethod = $request->method() == 'POST';
        parent::__construct(
            Fiscal::class,
            [
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
                    $postMethod ? 'unique:fiscais' : ''
                ],
                'telefone' => [
                    'nullable',
                    'regex:' . Util::REGEX_PHONE,
                ],
                'email' => [
                    'nullable',
                    'email',
                    'max:200',
                ],
                'cargo' => [
                    'max:40',
                ],
                'unidade_trabalho' => [
                    'max:40',
                ],
                'endereco_id' => [
                    $postMethod ? 'required' : '',
                    'exists:enderecos,id'
                ],
            ],
            $request
        );
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