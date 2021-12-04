<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infracao extends Model
{
    protected $fillable = [
        'id_integracao',
        'num_aip',
        'data_infracao',
        'hora_infracao',
        'local',
        'obs_aip',
        'descricao',
        'acao_tomada',
        'num_processo',
        'num_boleto',
        'data_vendimento_boleto',
        'qtd_moeda',
        'reincidente',
        'valor_moeda',
        'moeda_id',
        'permissionario_id',
        'quadro_infracao_id',
        'natureza_infracao_id',
    ];

    protected $table = 'infracoes';

    public static function search($search)
    {
        return Infracao::where("num_aip", "like", "%" . $search . "%")
            ->orderBy("data_infracao", 'desc')
            ->paginate(40);
    }

}
