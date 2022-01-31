<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\MarcaModeloCarroceria;
use Illuminate\Http\Request;

class MarcaModeloCarroceriaController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            MarcaModeloCarroceria::class, [
                'descricao' => [
                    'required',
                    'max:40',
                    'min:2',
                ],
                'modelo' => [
                    'required',
                    'max:20',
                    'min:2',
                ],
            ],
            $request
        );
    }
}
