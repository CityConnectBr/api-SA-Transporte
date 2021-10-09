<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\EmpresaVistoriadora;
use App\Utils\Util;
use Illuminate\Http\Request;

class EmpresaVistoriadoraController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            EmpresaVistoriadora::class, [
                'nome' => [
                    'required',
                    'max:40',
                    'min:2',
                ],
                'tipo' => [
                    'required',
                    'regex:/(A|V)/'
                ],
                'telefone' => [
                    'max:11',
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
                'nome_diretor' => [
                    'max:40',
                ],
                'nome_delegado' => [
                    'max:40',
                ],
                'total_vistorias_dia' => [
                    'number',
                    'nullable'
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
