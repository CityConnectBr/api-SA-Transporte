<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aplicativo extends Model
{
    protected $fillable = [
        'id_integracao',
        'descricao',
    ];

    protected $table = 'aplicativos';

    //////////////////////////////////////
    public static function search($search)
    {
        return Aplicativo::where("descricao", "like", "%" . $search . "%")
            ->orderBy("descricao")
            ->simplePaginate(40);
    }
}
