<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certidao extends Model
{
    protected $fillable = [
        'id_integracao',
        'data',
        'renavam',
        'placa',
        'ano_fabricacao',
        'chassis',
        'prefixo',
        'marca_modelo_veiculo_id',
        'tipo_de_certidao_id',
        'permissionario_id',
        'tipo_combustivel_id',
        'cor_id',
        'ponto_id',
        'observacao'
    ];

    protected $table = 'certidoes';

    ///////////////////

    public static function search($search)
    {
        return Certidao::where("placa", "like", "%" . $search . "%")
        ->orderBy("data")
        ->paginate(40);
    }
}