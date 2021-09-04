<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
    protected $fillable = [
        'id',
        'identificador',
        'descricao',
        'limite'
    ];

    public static function search($search)
    {
        return Modalidade::where("identificador", "like", "%" . $search . "%")
            ->orderBy("identificador")
            ->simplePaginate(15);
    }

    public static function findOne($identificador){
        return Modalidade::where('identificador', $identificador)->first();
    }
}
