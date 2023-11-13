<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Certidao;
use App\Models\Permissionario;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use App\Utils\Util;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CertidaoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Certidao::class,
            [
                'data' => [
                    'required',
                    'regex:' . Util::REGEX_DATE,
                ],
                'renavam' => [
                    'required',
                    'max:11',
                    'min:11'
                ],
                'placa' => [
                    'required',
                    'max:7',
                    'min:7'
                ],
                'ano_fabricacao' => [
                    'required',
                    'max:4',
                    'regex:' . Util::REGEX_NUMBER
                ],
                'chassis' => [
                    'required',
                    'max:25',
                    'min:3'
                ],
                'prefixo' => [
                    'required',
                    'max:15',
                    'min:3'
                ],
                'observacao' => [
                    'max:200',
                ],
                'tipo_de_certidao_id' => [
                    'required',
                    'exists:tipos_de_certidao,id'
                ],
                'permissionario_id' => [
                    'required',
                    'exists:permissionarios,id'
                ],
                'marca_modelo_veiculo_id' => [
                    'required',
                    'exists:marcas_modelos_veiculos,id'
                ],
                'tipo_combustivel_id' => [
                    'required',
                    'exists:tipos_combustiveis,id'
                ],
                'cor_id' => [
                    'required',
                    'exists:cores_veiculos,id'
                ],
                'ponto_id' => [
                    'required',
                    'exists:pontos,id'
                ],
                'protocol' => [
                    'min:6'
                ]
            ],
            $request
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
            return parent::responseMsgsJSON($validator->errors(), 400);
        }

        $permissionario = Permissionario::find($request->permissionario_id);
        if ($permissionario->modalidade_id != 3) {
            return parent::responseMsgsJSON(['permissionario' => ['O permissionário do veículo não é taxista']], 400);
        }

        if (isset($request->certidao_anterior_id)) {
            $certidaoAnterior = Certidao::find($request->certidao_anterior_id);
            if ($certidaoAnterior->certidao_anterior_id != null) {
                return parent::responseMsgsJSON(['certidao' => ['Certidão ja reemitida, não pode ser emitida novamente.']], 400);
            }
        }

        $veiculoSearch = Veiculo::searchByPlaca($request->placa);
        if ($veiculoSearch->count() > 0 && Carbon::parse($veiculoSearch[0]->created_at)->addYear()->isAfter(Carbon::now())) {
            return parent::responseMsgsJSON(['certidao' => ["O veículo não possui um ano de carência no sistema."]], 400);
        }

        $obj = new $this->objectModel();
        $obj->fill($request->all());

        $obj->save();

        return $obj;
    }
}
