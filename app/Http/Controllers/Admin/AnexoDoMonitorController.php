<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\AnexoDoMonitor;
use Illuminate\Http\Request;

class AnexoDoMonitorController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            AnexoDoMonitor::class, [
                'monitor_id' => [
                    'required',
                    'exists:monitores,id'
                ],
                'descricao' => [
                    'required',
                    'max:60',
                ],
                'file' => [
                    'required',
                    'file',
                ]
            ],
            $request,
            true
        );
    }
}
