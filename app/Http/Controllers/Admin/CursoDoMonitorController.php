<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\CursoDoMonitor;
use Illuminate\Http\Request;

class CursoDoMonitorController extends AdminSuperController
{
    function __construct(Request $request)
    {
        parent::__construct(
            CursoDoMonitor::class, [
                'monitor_id' => [
                    'required',
                    'exists:monitores,id'
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
