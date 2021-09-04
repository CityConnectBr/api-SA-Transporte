<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Modalidade;
use Illuminate\Http\Request;

class ModalidadeController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Modalidade::class, [
                'identificador' => [
                    'required',
                    'max:1',
                    'min:1',
                    'unique:modalidades'
                ],
                'descricao' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'limite' => [
                    'required',
                    'numeric',
                    'max:2'
                ]
            ],
            $request
        );
    }
}
