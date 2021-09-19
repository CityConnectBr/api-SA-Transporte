<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Alvara;
use App\Utils\Util;
use Illuminate\Http\Request;

class AlvaraDoPermissionarioController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Alvara::class,
            [
                'permissionario_id' => [
                    'required',
                ],
                'data_emissao' => [
                    'required',
                    'regex:' . Util::REGEX_DATE,
                ],
                'data_vencimento' => [
                    'required',
                    'regex:' . Util::REGEX_DATE,
                ],
                'data_retorno' => [
                    'regex:' . Util::REGEX_DATE,
                ],
                'observacao_retorno' => [
                    'max:15',
                ]
            ],
            $request
        );
    }
}
