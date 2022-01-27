<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vistoriador extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ativo',
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
