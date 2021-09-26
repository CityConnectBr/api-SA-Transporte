<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\CursoDoCondutor;
use Illuminate\Http\Request;

class CursoDoCondutorController extends AdminSuperController
{
    function __construct(Request $request)
    {
        parent::__construct(
            CursoDoCondutor::class, [
                'condutor_id' => [
                    'required',
                    'exists:condutores,id'
                ],
                'tipo_do_curso_id' => [
                    'required',
                    'exists:tipos_de_curso,id'
                ],
                'data_emissao' => [
                    'required',
                ],
            ],
            $request
        );
    }
}
