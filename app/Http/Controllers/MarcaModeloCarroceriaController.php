<?php
namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MarcaModeloCarroceria;
use Illuminate\Http\Request;

class MarcaModeloCarroceriaController extends Controller
{

    function __construct(Request $request)
    {
        parent::__construct(MarcaModeloCarroceria::class, $request);
    }
}
