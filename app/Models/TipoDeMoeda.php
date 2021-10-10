<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDeMoeda extends Model
{
    protected $fillable = [
        'id_integracao',
        'nome'
    ];

    protected $table = 'moedas';

    public static function search($search)
    {
        return TipoDeMoeda::where("nome", "like", "%" . $search . "%")
        ->orderBy("nome")
        ->paginate(40);
    }
}
