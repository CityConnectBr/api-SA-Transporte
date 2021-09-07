<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntidadeAssociativa extends Model
{
    protected $fillable = [
        'id_integracao',
        'nome'
    ];

    protected $table = 'entidades_associativa';

    ///////////////////

    public static function search($search)
    {
        return EntidadeAssociativa::where("nome", "like", "%" . $search . "%")
        ->orderBy("nome")
        ->paginate(15);
    }

}
