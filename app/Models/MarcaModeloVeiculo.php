<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarcaModeloVeiculo extends Model
{
    protected $fillable = [
        'id_integracao',
        'descricao',
    ];

    protected $table = 'marcas_modelos_veiculos';

    ///////////////////

    public static function search($search)
    {
        return MarcaModeloVeiculo::where("descricao", "like", "%" . $search . "%")
        ->orderBy("descricao")
        ->paginate(40);
    }

    public static function getByDescricao($search)
    {
        return MarcaModeloVeiculo::where("descricao", "like", $search)
        ->get();
    }
}
