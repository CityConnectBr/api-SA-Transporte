<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntidadeAssociativa extends Model
{
    protected $fillable = [
        'id_integracao',
        'descricao'
    ];

    protected $table = 'entidades_associativa';

    ///////////////////

    public static function search($search)
    {
        return EntidadeAssociativa::where("descricao", "like", "%" . $search . "%")
        ->orderBy("descricao")
        ->paginate(15);
    }

}
