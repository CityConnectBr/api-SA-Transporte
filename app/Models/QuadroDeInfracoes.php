<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuadroDeInfracoes extends Model
{
    protected $fillable = [
        'descricao',
        'acao',
        'reincidencia',
        'modalidade_transporte',
        'qtd_reincidencia',
        'unidade_reincidencia',
        'natureza_infracao_id',
    ];

    protected $table = 'quadro_de_infracoes';

    public static function search($search)
    {
        return QuadroDeInfracoes::where("descricao", "like", "%" . $search . "%")
            ->orderBy("descricao")
            ->paginate(40);
    }

}
