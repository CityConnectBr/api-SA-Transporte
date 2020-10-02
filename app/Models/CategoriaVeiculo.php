<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaVeiculo extends Model
{
    protected $fillable = [
        'nome',
    ];
    
    protected $table = 'categorias_veiculos';
    
    ///////////////////
    
    public static function search($search)
    {
        return CategoriaVeiculo::where("nome", "like", "%" . $search . "%")
        ->orderBy("nome")
        ->paginate(40);
    }
    
}
