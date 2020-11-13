<?php
namespace app\Http\Controllers\Integracao;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\SolicitacaoDeAlteracao;

class SolicitacaoDeAlteracaoController extends Controller
{

    function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SolicitacaoDeAlteracao::findAllNotSinc();
    }
    
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitacao = SolicitacaoDeAlteracao::find($id);
        if (isset($solicitacao)) {
            return $solicitacao;
        } else {
            return parent::responseMsgJSON("Solicitação não encontrada", 400);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function setSinc($id)
    {
        $solicitacao = SolicitacaoDeAlteracao::find($id);
        if (isset($solicitacao)) {
            SolicitacaoDeAlteracao::setSinc($id);
            return parent::responseMsgJSON("Realizada com sucesso");
        } else {
            return parent::responseMsgJSON("Solicitação não encontrada", 400);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function setStatus($id, $status)
    {
        if(!preg_match("/^(A|R)$/", $status)){
            return parent::responseMsgJSON("Status aceitos somente: A(Aceito), R(Recusado)", 400);
        }

        $motivoRecusa = $this->request["motivo_recusado"];
                
        if(!isset($motivoRecusa) && (preg_match("/^R$/", $status) && !preg_match("/^.{1,40}$/", $motivoRecusa))){
            return parent::responseMsgJSON("Em caso de motivo R(Recusado) é necessário ter um motivo(motivo_recusado)", 400);
        }
        
        $solicitacao = SolicitacaoDeAlteracao::find($id);
        if (isset($solicitacao)) {
            SolicitacaoDeAlteracao::setStatus($id, $status, $motivoRecusa);
            return parent::responseMsgJSON("Realizada com sucesso");
        } else {
            return parent::responseMsgJSON("Solicitação não encontrada", 400);
        }
    }
    
}
