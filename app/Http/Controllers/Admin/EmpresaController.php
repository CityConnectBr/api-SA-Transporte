<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Empresa;
use App\Utils\Util;
use Illuminate\Http\Request;

class EmpresaController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Empresa::class, [
                'nome' => [
                    'required',
                    'max:40',
                    'min:2',
                ],
                'telefone' => [
                    'max:11',
                ],
                'fax' => [
                    'max:11',
                ],
                'home_page' => [
                    'max:200',
                ],
                'email' => [
                    'max:200',
                ],
                'cnpj' => [
                    'required',
                    'regex:'.Util::REGEX_CPF_CNPJ,
                ],
                'inscricao_estadual' => [
                    'max:20',
                ],
                'inscricao_municipal' => [
                    'max:9',
                ],
                'nome_do_diretor' => [
                    'max:40',
                ],
                'nome_do_gerente' => [
                    'max:40',
                ],
                'nome_do_encarregado_vistoriador' => [
                    'max:40',
                ],
                'portaria_diretor' => [
                    'max:10',
                ],
                'data_nomeacao_diretor' => [
                    'regex:'.Util::REGEX_DATE,
                    'nullable'
                ],
                'decreto_municipal_taxi' => [
                    'max:60',
                ],
                'decreto_municipal_escolar' => [
                    'max:60',
                ],
                'endereco_id' => [
                    'required',
                    'exists:enderecos,id'
                ],

            ],
            $request
        );
    }
}
