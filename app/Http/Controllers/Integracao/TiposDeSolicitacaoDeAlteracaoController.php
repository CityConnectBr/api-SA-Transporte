<?php
namespace app\Http\Controllers\Integracao;


use App\Models\TipoDeSolicitacaoDeAlteracao;

class TiposDeSolicitacaoDeAlteracaoController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $obj = TipoDeSolicitacaoDeAlteracao::get();
        if (isset($obj)) {
            return $obj;
        } else {
            return response()->json("Não encontrado", 404);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = TipoDeSolicitacaoDeAlteracao::find($id);
        if (isset($obj)) {
            return $obj;
        } else {
            return response()->json("Não encontrado", 404);
        }
    }
}
