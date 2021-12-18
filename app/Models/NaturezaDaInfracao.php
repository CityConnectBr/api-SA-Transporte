<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NaturezaDaInfracao extends Model
{
    protected $fillable = [
        'id_integracao',
        'descricao',
    ];

    protected $table = 'naturezas_da_infracao';

    public static function search($search)
    {
        return NaturezaDaInfracao::where("descricao", "like", "%" . $search . "%")
            ->orderBy("descricao")
            ->paginate(40);
    }

}
