<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarcaModeloCarroceria extends Model
{
    protected $fillable = [
        'id_integracao',
        'descricao',
        'modelo'
    ];
    
    protected $table = 'marcas_modelos_carrocerias';
    
    ///////////////////
    
    public static function search($search)
    {
        return MarcaModeloCarroceria::where("descricao", "like", "%" . $search . "%")
        ->orderBy("descricao")
        ->paginate(40);
    }
}
