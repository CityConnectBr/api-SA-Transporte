<?php
namespace app\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\MarcaModeloChassi;
use Illuminate\Http\Request;

class MarcaModeloChassiController extends Controller
{

    function __construct(Request $request)
    {
        parent::__construct(MarcaModeloChassi::class, $request);
    }
}
