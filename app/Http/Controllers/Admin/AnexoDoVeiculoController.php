<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\AnexoDoVeiculo;
use Illuminate\Http\Request;

class AnexoDoVeiculoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            AnexoDoVeiculo::class, [
                'veiculo_id' => [
                    'required',
                    'exists:veiculos,id'
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
