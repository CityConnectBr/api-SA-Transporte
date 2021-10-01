<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\EntidadeAssociativa;
use Illuminate\Http\Request;

class EntidadeAssociativaController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            EntidadeAssociativa::class, [
                'descricao' => [
                    'required',
                    'max:40',
                    'min:2',
                ],
            ],
            $request
        );
    }
}
