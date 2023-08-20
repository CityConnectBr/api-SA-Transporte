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
        'modalidade',
        'codigo',
        'qtd_reincidencia',
        'unidade_reincidencia',
        'natureza_infracao_id',
    ];

    protected $table = 'quadro_de_infracoes';

    public function naturezaInfracao()
    {
        return $this->hasOne(NaturezaDaInfracao::class, 'id', 'natureza_infracao_id');
    }

    public static function search($search, $modalidade)
    {
        return QuadroDeInfracoes::where("descricao", "like", "%" . $search . "%")
            ->where("modalidade", "=", $modalidade)
            ->with('naturezaInfracao')
            ->orderBy("descricao")
            ->paginate(40);
    }
}
