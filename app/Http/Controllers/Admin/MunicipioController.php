<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Municipio::class, [
                'nome' => [
                    'required',
                    'max:40',
                    'min:3'
                ],
                'uf' => [
                    'required',
                    'max:2',
                    'min:2'
                ]
            ],
            $request
        );
    }

    public function indexByUf()
    {
        $search = $this->request->input('search');
        if( $search == null ) {
            $search = $this->request->query('search');
        }

        $uf = $this->request->input('uf');
        if( $uf == null ) {
            return parent::responseMsgJSON("UF não encontrado", 404);
        }

        $obj = Municipio::searchByUf($uf, $search);
        if (isset($obj)) {
            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }
}
