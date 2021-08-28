<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Endereco;
use App\Utils\Util;
use Illuminate\Http\Request;

class EnderecoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Endereco::class, [
                'cep' => [
                    'required',
                    'regex:'.Util::REGEX_CEP,
                ],
                'endereco' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'numero' => [
                    'required',
                ],
                'complemento' => [
                    'max:15',
                ],
                'bairro' => [
                    'required',
                    'max:100',
                    'min:1'
                ],
                'municipio_id' => [
                    'required',
                    'numeric',
                    'exists:municipios,id'
                ],
            ],
            $request
        );
    }
}
