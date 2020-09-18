<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCombustivel extends Model
{
    protected $fillable = [
        'id_integracao',
        'descricao',
    ];
    
    protected $table = 'tipos_combustiveis';
}