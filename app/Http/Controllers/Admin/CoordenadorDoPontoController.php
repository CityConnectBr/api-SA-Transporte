<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\CoordenadorDoPonto;
use App\Utils\Util;
use Illuminate\Http\Request;

class CoordenadorDoPontoController extends AdminSuperController
{
    function __construct(Request $request)
    {
        parent::__construct(
            CoordenadorDoPonto::class, [
                'data_inicial' => [
                    'nullable',
                    'regex:'.Util::REGEX_DATE
                ],
                'data_termino' => [
                    'nullable',
                    'regex:'.Util::REGEX_DATE
                ],
                'observacao' => [
                    'max:500',
                ],
                'permissionario_id' => [
                    'required',
                    'exists:permissionarios,id'
                ],
                'ponto_id' => [
                    'required',
                    'exists:pontos,id'
                ],
            ],
            $request
        );
    }
}
