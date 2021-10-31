<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\FPM;
use App\Utils\Util;
use Illuminate\Http\Request;

class FPMController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            FPM::class, [
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
