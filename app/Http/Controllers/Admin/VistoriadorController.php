<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Vistoriador;
use Illuminate\Http\Request;

class VistoriadorController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Vistoriador::class, [
                'nome' => [
                    'required',
                    'max:40',
                    'min:3'
                ],'cargo' => [
                    'required',
                    'max:20',
                    'min:2'
                ],'empresa_vistoriadora_id' => [
                    'nullable',
                    'exists:empresas_vistoriadoras,id'
                ]
            ],
            $request
        );
    }
}
