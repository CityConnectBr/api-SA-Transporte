<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certidao extends Model
{
    protected $fillable = [
        'id_integracao',
        'ano',
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
    ];

    protected $table = 'certidoes';

    ///////////////////

    public static function search($search)
    {
        return Certidao::where("ano", "like", "%" . $search . "%")
        ->orderBy("ano")
        ->paginate(40);
    }
}
