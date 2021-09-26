<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\AnexoDoCondutor;
use Illuminate\Http\Request;

class AnexoDoCondutorController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            AnexoDoCondutor::class, [
                'condutor_id' => [
                    'required',
                    'exists:condutores,id'
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
