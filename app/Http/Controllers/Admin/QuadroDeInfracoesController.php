<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\QuadroDeInfracoes;
use Illuminate\Http\Request;

class QuadroDeInfracoesController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            QuadroDeInfracoes::class,
            [
                'codigo' => [
                    'required',
                    'max:10',
                    'min:2',
                ],
                'descricao' => [
                    'required',
                    'max:500',
                    'min:2',
                ],
                'acao' => [
                    'required',
                    'max:500',
                    'min:2',
                ],
                'reincidencia' => [
                    'max:60',
                ],
                'modalidade' => [
                    'required',
                    'max:1',
                ],
            ],
            $request
        );
    }

    public function index()
    {
        $obj = null;
        $search = $this->request->input('search');
        $modalidade = $this->request->input('modalidade');

        $obj = $this->objectModel::search($search, $modalidade);

        if ($obj != null) {
            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }
}