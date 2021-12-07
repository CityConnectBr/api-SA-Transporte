<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\Endereco;
use App\Models\Ponto;
use Illuminate\Http\Request;
use App\Utils\Util;
use Illuminate\Support\Facades\Validator;

class PontoController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(Ponto::class, [
            'modalidade_transporte' => [
                'nullable',
                'regex:/(E|T|G)/'
            ],
            'id_integracao' => [
                'max:40',
            ],
            'telefone' => [
                'nullable',
                'regex:'.Util::REGEX_PHONE,
            ],
            'data_criacao' => [
                'nullable',
                'regex:'.Util::REGEX_DATE
            ],
            'data_extincao' => [
                'nullable',
                'regex:'.Util::REGEX_DATE
            ],
            'ocupacao_atual' => [
                'max:40',
            ],
            'observacao' => [
                'max:500',
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

        $obj = new Ponto();
        $obj->fill($request->all());
        $obj->endereco_id = $endereco->id;

        $obj->save();

        return $obj;
    }

}
