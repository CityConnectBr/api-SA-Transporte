<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Ponto;
use Illuminate\Http\Request;

class PontoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Ponto::class, [
                'descricao' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'base_legal' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'capacidade_legal' => [
                    'required',
                    'max:40',
                    'min:3'
                ]
            ],
            $request
        );
    }
}
