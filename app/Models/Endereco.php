<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'id',
        'CEP',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'municipio',
        'UF',
        'permissionario_id',
    ];
}
