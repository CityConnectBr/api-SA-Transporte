<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vistoriador extends Model
{

    protected $fillable = [
        'id_integracao',
        'nome',
        'cargo',
        'empresa_vistoriadora_id',
    ];

    protected $table = 'vistoriadores';

    public static function search($search)
    {
        return Vistoriador::where("nome", "like", "%" . $search . "%")
            ->orderBy("nome")
            ->simplePaginate(15);
    }

}
