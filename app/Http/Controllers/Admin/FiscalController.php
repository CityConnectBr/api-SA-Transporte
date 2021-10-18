<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Fiscal;
use App\Utils\Util;
use Illuminate\Http\Request;

class FiscalController extends AdminSuperController
{

    function __construct(Request $request)
    {
        $postMethod = $request->method() == 'POST';
        parent::__construct(
            Fiscal::class, [
                'nome' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'cpf' => [
                    'required',
                    'max:11',
                    'min:11',
                    'regex:'.Util::REGEX_CPF_CNPJ,
                    $postMethod?'unique:fiscais':''
                ],
                'telefone' => [
                    'nullable',
                    'regex:'.Util::REGEX_PHONE,
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
                    $postMethod?'required':'',
                    'exists:enderecos,id'
                ],
            ],
            $request
        );
    }
}
