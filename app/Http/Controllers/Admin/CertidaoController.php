<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Certidao;
use Illuminate\Http\Request;
use App\Utils\Util;

class CertidaoController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Certidao::class, [
                'ano' => [
                    'required',
                    'max:4',
                    'regex:'.Util::REGEX_NUMBER
                ],
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
                    'regex:'.Util::REGEX_NUMBER
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
                    'exists:marcas_modelos_chassis,id'
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
            ],
            $request
        );
    }

    public function update(Request $request, $id)
    {
        return parent::responseMsgJSON("Não permitido para este item!", 401);
    }

    public function destroy($id)
    {
        return parent::responseMsgJSON("Não permitido para este item!", 401);
    }
}
