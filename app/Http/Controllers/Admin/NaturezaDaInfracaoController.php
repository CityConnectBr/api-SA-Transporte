<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Empresa;
use App\Utils\Util;
use Illuminate\Http\Request;

class NaturezaDaInfracaoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            NaturezaDaInfracao::class, [
                'descricao' => [
                    'required',
                    'max:40',
                    'min:2',
                ],
            ],
            $request
        );
    }
}
