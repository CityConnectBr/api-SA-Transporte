<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\FMP;
use App\Utils\Util;
use Illuminate\Http\Request;

class FMPController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            FMP::class, [
                'descricao' => [
                    'required',
                    'max:40',
                    'min:2',
                ],
                'data_inicial' => [
                    'required',
                    'regex:'.Util::REGEX_DATE
                ],
                'data_final' => [
                    'required',
                    'regex:'.Util::REGEX_DATE
                ],
                'valor' => [
                    'required',
                    'numeric'
                ],
                'moeda_id' => [
                    'required',
                    'exists:moedas,id'
                ],
            ],
            $request
        );
    }
}
