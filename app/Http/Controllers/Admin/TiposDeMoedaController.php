<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\TipoDeMoeda;
use Illuminate\Http\Request;

class TiposDeMoedaController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            TipoDeMoeda::class, [
                'nome' => [
                    'required',
                    'max:40',
                    'min:1'
                ]
            ],
            $request
        );
    }
}
