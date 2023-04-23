<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuadroDeInfracoes extends Model
{
    protected $fillable = [
        'id_integracao',
        'descricao',
        'acao',
        'reincidencia',
        'modalidade_id',
        'qtd_reincidencia',
        'unidade_reincidencia',
        'natureza_infracao_id',
    ];

    protected $table = 'quadro_de_infracoes';

    public function modalidade()
    {
        return $this->hasOne(Modalidade::class, 'id', 'modalidade_id');
    }

    public function naturezaInfracao()
    {
        return $this->hasOne(NaturezaDaInfracao::class, 'id', 'natureza_infracao_id');
    }

    public static function search($search)
    {
        return QuadroDeInfracoes::where("descricao", "like", "%" . $search . "%")
            ->with('naturezaInfracao')
            ->orderBy("descricao")
            ->paginate(40);
    }

}
