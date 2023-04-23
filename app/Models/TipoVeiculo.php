<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoVeiculo extends Model
{

    protected $fillable = [
        'id_integracao',
        'descricao',
        'modalidade_id',
        'idade_limite_ingresso',
        'idade_limite_permanencia'
    ];

    protected $table = 'tipos_veiculos';

    public function modalidade()
    {
        return $this->hasOne(Modalidade::class, 'id', 'modalidade_id');
    }
    
    ///////////////////
    
    public static function search($search)
    {
        return TipoVeiculo::where("descricao", "like", "%" . $search . "%")
        ->orderBy("descricao")
        ->paginate(40);
    }
}
