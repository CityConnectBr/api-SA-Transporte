<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\Empresa;
use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Utils\Util;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(Empresa::class, [
            'nome' => [
                'required',
                'max:40',
                'min:2',
            ],
            'telefone' => [
                'nullable',
                'regex:'.Util::REGEX_PHONE,
            ],
            'fax' => [
                'nullable',
                'regex:'.Util::REGEX_PHONE,
            ],
            'home_page' => [
                'max:200',
            ],
            'email' => [
                'max:200',
            ],
            'cnpj' => [
                'required',
                'regex:'.Util::REGEX_CPF_CNPJ,
            ],
            'inscricao_estadual' => [
                'max:20',
            ],
            'inscricao_municipal' => [
                'max:9',
            ],
            'nome_do_diretor' => [
                'max:40',
            ],
            'nome_do_gerente' => [
                'max:40',
            ],
            'nome_do_encarregado_vistoriador' => [
                'max:40',
            ],
            'portaria_diretor' => [
                'max:10',
            ],
            'data_nomeacao_diretor' => [
                'regex:'.Util::REGEX_DATE,
                'nullable'
            ],
            'decreto_municipal_taxi' => [
                'max:60',
            ],
            'decreto_municipal_escolar' => [
                'max:60',
            ],
        ]);
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
        $endereco->save();

        $obj = new Empresa();
        $obj->fill($request->all());
        $obj->endereco_id = $endereco->id;

        $obj->save();

        return $obj;
    }

}
