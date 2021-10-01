<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorDeVeiculo extends Model
{
    protected $fillable = [
        'id_integracao',
        'descricao'
    ];

    protected $table = 'cores_veiculos';

    ///////////////////

    public static function search($search)
    {
        return CorDeVeiculo::where("descricao", "like", "%" . $search . "%")
        ->orderBy("descricao")
        ->paginate(15);
    }

}
