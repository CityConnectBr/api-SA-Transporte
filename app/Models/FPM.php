<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FPM extends Model
{
    protected $fillable = [
        'id_integracao',
        'data_inicial',
        'data_final',
        'valor',
        'moeda_id'
    ];

    protected $table = 'fpm';

    public static function search($search)
    {
        return FPM::where("moeda_id", $search)
            ->paginate(15);
    }
}
