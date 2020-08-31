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
    
    function findOne($identificador){
        return Modalidade::where('identificador', $identificador)->first()->id;
    }
}
