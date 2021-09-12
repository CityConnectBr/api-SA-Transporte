<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Aplicativo;
use Illuminate\Http\Request;

class AplicativoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Aplicativo::class, [
                'descricao' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
            ],
            $request
        );
    }
}
