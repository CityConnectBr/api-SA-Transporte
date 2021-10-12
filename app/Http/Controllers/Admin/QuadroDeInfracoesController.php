<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\QuadroDeInfracoes;
use Illuminate\Http\Request;

class QuadroDeInfracoesController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            QuadroDeInfracoes::class, [
                'descricao' => [
                    'required',
                    'max:500',
                    'min:2',
                ],
                'acao' => [
                    'required',
                    'max:500',
                    'min:2',
                ],
                'reincidencia' => [
                    'max:60',
                ]
            ],
            $request
        );
    }
}
