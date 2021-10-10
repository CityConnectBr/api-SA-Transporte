<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\TipoDeCurso;
use Illuminate\Http\Request;

class TipoDeCursoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            TipoDeCurso::class, [
                'descricao' => [
                    'required',
                    'max:40',
                    'min:3'
                ],'modalidade' => [
                    'required',
                    'regex:/(E|G|T)/'
                ],
            ],
            $request
        );
    }
}
