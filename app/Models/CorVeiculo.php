<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorVeiculo extends Model
{
    protected $fillable = [
        'id_integracao',
        'descricao'
    ];

    protected $table = 'cores_veiculos';

    ///////////////////

    public static function search($search)
    {
        return CorVeiculo::where("descricao", "like", "%" . $search . "%")
        ->orderBy("descricao")
        ->paginate(40);
    }

    public static function getByDescricao($search)
    {
        return CorVeiculo::where("descricao", "like", $search)
        ->orderBy("descricao")
        ->get();
    }

}
