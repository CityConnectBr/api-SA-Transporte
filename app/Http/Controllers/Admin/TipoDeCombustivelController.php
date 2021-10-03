<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\TipoCombustivel;
use Illuminate\Http\Request;

class TipoDeCombustivelController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            TipoCombustivel::class, [
                'descricao' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
            ],
            $request
        );
    }
}
