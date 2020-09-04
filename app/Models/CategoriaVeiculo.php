<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaVeiculo extends Model
{
    protected $fillable = [
        'nome',
    ];
    
    protected $table = 'categorias_veiculos';
    
}
