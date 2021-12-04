<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Infracao;
use Illuminate\Http\Request;
use App\Utils\Util;

class InfracaoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Infracao::class, [
                'num_aip' => [
                    'required',
                    'max:11',
                ],
                'data_infracao' => [
                    'required',
                    'regex:' . Util::REGEX_DATE,
                ],
                'hora_infracao' => [
                    'required',
                    'regex:' . Util::REGEX_HOUR,
                ],
                'obs_aip' => [
                    'max:500',
                ],
                'descricao' => [
                    'required',
                    'max:500',
                ],
                'acao_tomada' => [
                    'required',
                    'max:500',
                ],
                'num_processo' => [
                    'required',
                    'max:15',
                ],
                'num_boleto' => [
                    'required',
                    'max:15',
                ],
                'data_vendimento_boleto' => [
                    'required',
                    'regex:' . Util::REGEX_DATE,
                ],
                'qtd_moeda' => [
                    'required',
                    'regex:'.Util::REGEX_NUMBER
                ],
                'valor_moeda' => [
                    'required',
                    'regex:'.Util::REGEX_NUMBER
                ],
                'moeda_id' => [
                    'required',
                    'exists:moedas,id'
                ],
                'permissionario_id' => [
                    'required',
                    'exists:permissionarios,id'
                ],
                'quadro_infracao_id' => [
                    'required',
                    'exists:quadro_de_infracoes,id'
                ],
                'natureza_infracao_id' => [
                    'required',
                    'exists:naturezas_da_infracao,id'
                ],
            ],
            $request
        );
    }
}
