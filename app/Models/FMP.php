<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FMP extends Model
{
    protected $fillable = [
        'descricao',
        'id_integracao',
        'data_inicial',
        'data_final',
        'valor',
        'moeda_id'
    ];

    protected $table = 'fmp';

    public static function search($search)
    {
        return FMP::where("moeda_id", "like", "%" . $search . "%")
            ->paginate(15);
    }
}
