<?php

namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\EmpresaVistoriadora;
use App\Models\Endereco;
use App\Models\Municipio;
use Illuminate\Http\Request;
use App\Utils\Util;
use Illuminate\Support\Facades\Validator;

class EmpresaVistoriadoraController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(
            EmpresaVistoriadora::class,
            [
                'nome' => [
                    'required',
                    'max:40',
                    'min:2',
                ],
                'tipo' => [
                    'required',
                    'regex:/(A|V)/'
                ],
                'email' => [
                    'max:200',
                ],
                'cnpj' => [
                    'nullable',
                    'regex:' . Util::REGEX_CPF_CNPJ,
                ],
                'inscricao_estadual' => [
                    'max:20',
                ],
                'inscricao_municipal' => [
                    'max:9',
                ],
                'nome_diretor' => [
                    'max:40',
                ],
                'nome_delegado' => [
                    'max:40',
                ],
                'total_vistorias_dia' => [
                    'nullable',
                    'regex:' . Util::REGEX_NUMBER,
                ],
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validatorList);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $endereco = new Endereco();
        $endereco->fill($request->all());
        $municipios = Municipio::searchByUf($endereco->uf, $request['municipio']);
        if(sizeof($municipios)>0){
            $endereco->municipio_id = $municipios[0]->id;
        }
        $endereco->save();

        $obj = new EmpresaVistoriadora();
        $obj->fill($request->all());
        $obj->endereco_id = $endereco->id;

        $obj->save();

        return $obj;
    }
}
