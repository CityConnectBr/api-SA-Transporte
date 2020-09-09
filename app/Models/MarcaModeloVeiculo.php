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
}
