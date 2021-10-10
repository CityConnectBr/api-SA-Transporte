<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\TipoDeCertidao;
use Illuminate\Http\Request;

class TipoDeCertidaoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            TipoDeCertidao::class, [
                'descricao' => [
                    'required',
                    'max:60',
                    'min:2'
                ]
            ],
            $request
        );
    }
}
