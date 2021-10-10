<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\EntidadeCurso;
use Illuminate\Http\Request;

class EntidadeCursoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            EntidadeCurso::class, [
                'descricao' => [
                    'required',
                    'max:40',
                    'min:2',
                ],'base_legal' => [
                    'max:40',
                ],
            ],
            $request
        );
    }
}
