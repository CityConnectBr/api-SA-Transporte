<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\SolicitacaoDeAlteracao;
use Illuminate\Http\Request;

class SolicitacaoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            SolicitacaoDeAlteracao::class, [
            ],
            $request
        );
    }

    public function store(Request $request)
    {
        return parent::responseMsgJSON("Não implementado!", 501);
    }

    public function update(Request $request, $id)
    {
        return parent::responseMsgJSON("Não implementado!", 501);
    }
}
