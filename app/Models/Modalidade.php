<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
    protected $fillable = [
        'id',
        'identificador',
        'descricao'
    ];
    
    public static function findOne($identificador){
        return Modalidade::where('identificador', $identificador)->first();
    }
}
