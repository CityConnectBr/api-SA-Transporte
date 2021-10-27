<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalaoDoFiscal extends Model
{
    protected $fillable = [
        'numero',
        'tipo_documento',
        'serie_documento',
        'numero_primeira_folha',
        'numero_ultima_folha',
        'data_recebimento',
        'fiscal_id',
    ];

    protected $table = 'taloes_do_fiscal';

    //////////////////////////////////////
    public static function search($search)
    {
        return TalaoDoFiscal::where("tipo_documento", "like", "%" . $search . "%")
            ->orderBy("tipo_documento")
            ->simplePaginate(15);
    }
}
