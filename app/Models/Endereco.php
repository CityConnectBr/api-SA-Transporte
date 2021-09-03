<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'id',
        'cep',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'municipio_id',
        'uf',
    ];

    //////////////////////////////////////
    public static function search($search)
    {
        return Endereco::where("endereco", "like", "%" . $search . "%")
            ->orderBy("endereco")
            ->simplePaginate(15);
    }
}
