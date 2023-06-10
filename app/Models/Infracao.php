<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Infracao extends Model
{
    use SoftDeletes;

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
        'moeda_id',
        'permissionario_id',
        'veiculo_id',
        'quadro_infracao_id',
        'natureza_infracao_id',
        'foto_uid',
        'tipo_pagamento',
        'chave_pix',
        'codigo_pix',
        'data_pagamento',
        'status', //(pendente, pago, cancelado, aguardando_confirmacao)
        'arquivo_comprovante_uid',
        'data_envio_comprovante',
        'valor_fmp_atual',
        'fmp_id',
        'qtd_fmp',
        'valor_fmp', //valor automatico: qtd_moeda * valor_fmp_atual
        'valor_final',
        'usuario_pagamento_id',
        'empresa_id'
    ];

    protected $table = 'infracoes';

    public function moeda()
    {
        return $this->hasOne(TipoDeMoeda::class, 'id', 'moeda_id');
    }

    public function permissionario()
    {
        return $this->hasOne(Permissionario::class, 'id', 'permissionario_id');
    }

    public function veiculo()
    {
        return $this->hasOne(Veiculo::class, 'id', 'veiculo_id');
    }

    public function quadro_infracao()
    {
        return $this->hasOne(QuadroDeInfracoes::class, 'id', 'quadro_infracao_id');
    }

    public function natureza_infracao()
    {
        return $this->hasOne(NaturezaDaInfracao::class, 'id', 'natureza_infracao_id');
    }

    public function usuario_pagamento()
    {
        return $this->hasOne(Usuario::class, 'id', 'usuario_pagamento_id');
    }

    public function empresa()
    {
        return $this->hasOne(Empresa::class, 'id', 'empresa_id');
    }

    public function FMP()
    {
        return $this->hasOne(FMP::class, 'id', 'fmp_id');
    }

    public static function search($search)
    {
        return Infracao::where("status", 'like', "%{$search}%")
            ->with('permissionario', 'veiculo', 'empresa')
            ->orderBy("data_infracao", 'desc')
            ->paginate(40);
    }

    public static function findComplete($id)
    {
        return Infracao::where("id", $id)
            ->with('permissionario', 'veiculo', 'empresa', 'moeda', 'quadro_infracao', 'natureza_infracao', 'usuario_pagamento', 'FMP')
            ->first();
    }

}