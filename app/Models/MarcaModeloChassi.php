<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarcaModeloChassi extends Model
{
    protected $fillable = [
        'id_integracao',
        'descricao',
        'modelo'
    ];
    
    protected $table = 'marcas_modelos_chassis';
}
