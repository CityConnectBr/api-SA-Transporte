<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alvara;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{

    function __construct(Request $request)
    {
        $this->objectModel = Alvara::class;
        $this->request = $request;
    }


    function entradaSaudaDeVeiculos()
    {
        return;
    }

    function alvaraExpirado()
    {
        $alvaras = Alvara::findAlvaraExpirados();

        return parent::responseJSON($alvaras);
    }

}