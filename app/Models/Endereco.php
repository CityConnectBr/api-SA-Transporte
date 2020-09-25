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
        'municipio',
        'uf',
    ];

    function permissionario() {
        return $this->belongsTo('App\Models\Permissionario');
    }
}
