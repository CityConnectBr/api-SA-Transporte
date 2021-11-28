<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\VistoriaPonto;
use App\Utils\Util;
use Illuminate\Http\Request;

class VistoriaPontoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            VistoriaPonto::class, [
                'data_vistoria' => [
                    'required',
                    'regex:'.Util::REGEX_DATE
                ],'condicoes_de_pintura' => [
                    'required',
                    'regex:'.Util::REGEX_NUMBER
                ],'condicoes_de_cobertura' => [
                    'required',
                    'regex:'.Util::REGEX_NUMBER
                ],'condicoes_de_emplacamento' => [
                    'required',
                    'regex:'.Util::REGEX_NUMBER
                ],'condicoes_de_sanitario' => [
                    'required',
                    'regex:'.Util::REGEX_NUMBER
                ],'observacoes' => [
                    'max:500',
                ],'vistoriador_id' => [
                    'required',
                    'exists:vistoriadores,id'
                ],'ponto_id' => [
                    'required',
                    'exists:pontos,id'
                ]
            ],
            $request
        );
    }
}
