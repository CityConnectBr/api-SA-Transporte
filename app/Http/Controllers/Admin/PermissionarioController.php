<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Permissionario;
use App\Utils\Util;
use Illuminate\Http\Request;

class PermissionarioController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Permissionario::class, [
                'numero_de_cadastro_antigo' => [
                    'max:10',
                ],
                'nome_razao_social' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'tipo' => [
                    'required',
                    'regex:/(F|J)/'
                ],
                'cpf_cnpj' => [
                    'required',
                    'max:14',
                    'min:11',
                    'regex:'.Util::REGEX_CPF_CNPJ,
                    'unique:permissionarios'
                ],
                'rg' => [
                    'max:9',
                ],
                'estado_civil' => [
                    'required',
                    'max:1',
                    'min:1'
                ],
                'inscricao_municipal' => [
                    'required',
                    'max:15',
                    'min:3'
                ],
                'alvara_de_funcionamento' => [
                    'max:15',
                ],
                'responsavel' => [
                    'max:40',
                ],
                'procurador_responsavel' => [
                    'max:40',
                ],
                'telefone' => [
                    'regex:'.Util::REGEX_PHONE,
                ],
                'telefone2' => [
                    'regex:'.Util::REGEX_PHONE,
                ],
                'celular' => [
                    'regex:'.Util::REGEX_PHONE,
                ],
                'email' => [
                    'email',
                    'max:200',
                    'min:3'
                ],
                'data_nascimento' => [
                    'required',
                    'regex:'.Util::REGEX_DATE
                ],
                'naturalidade' => [
                    'max:15',
                ],
                'nacionalidade' => [
                    'max:15',
                ],
                'cnh' => [
                    'max:15',
                ],
                'categoria_cnh' => [
                    'max:2',
                    'min:1'
                ],
                'vencimento_cnh' => [
                    'regex:'.Util::REGEX_DATE
                ]
            ],
            $request
        );
    }
}
