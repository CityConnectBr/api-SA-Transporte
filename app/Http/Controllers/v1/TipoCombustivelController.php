<?php
namespace app\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\TipoCombustivel;
use Illuminate\Http\Request;


class TipoCombustivelController extends Controller
{

    function __construct(Request $request)
    {
        parent::__construct(TipoCombustivel::class, $request);
    }
}
