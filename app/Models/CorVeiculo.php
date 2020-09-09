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
    
}
