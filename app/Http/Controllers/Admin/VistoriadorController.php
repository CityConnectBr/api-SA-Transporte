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
                    'max:7',
                    'min:7'
                ],'cargo' => [
                    'required',
                    'max:11',
                    'min:11'
                ],'empresa_vistoriadora_id' => [
                    'required',
                    'exists:empresas_vistoriadoras,id'
                ]
            ],
            $request
        );
    }
}
