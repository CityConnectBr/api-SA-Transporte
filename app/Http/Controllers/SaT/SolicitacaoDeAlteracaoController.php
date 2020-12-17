<?php
namespace app\Http\Controllers\SaT;

use App\Models\SolicitacaoDeAlteracao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class SolicitacaoDeAlteracaoController extends Controller
{

    function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function getdoc($id)
    {
        $solicitacao = SolicitacaoDeAlteracao::find($id);
        if (! asset($solicitacao)) {
            return parent::responseMsgJSON("Solicitação não encontrada", 404);
        }

        $doc = $this->request->query('doc');

        if (! isset($doc)) {
            $doc = 1;
        }

        return Storage::download('solicitacao_de_alteracao_arquivos/solicitacao_' . $solicitacao->id . '_arquivo' . $doc . '.jpg');
    }
}
