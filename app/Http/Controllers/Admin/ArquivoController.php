<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Arquivo;

class ArquivoController extends Controller
{

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function show($id)
    {
        $arquivo = Arquivo::find($id);
        if (! asset($arquivo)) {
            return parent::responseMsgJSON("Arquivo não encontrado", 404);
        }

        return Storage::download('arquivos/' . $arquivo->id . '.jpg');
    }

    public function create(Request $request)
    {
        $arquivo = new Arquivo();
        $arquivo->origem = "web";
        $arquivo->save();

        $request["foto"]->storeAs('/arquivos', $arquivo->id . ".jpg");

        return $arquivo;
    }
}
