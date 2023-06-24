<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alvara extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'data_emissao',
        'data_vencimento',
        'data_retorno',
        'observacao_retorno',
        'permissionario_id',
        'tipo_pagamento',
        'chave_pix',
        'codigo_pix',
        'data_pagamento',
        'status',//(pendente, pago, cancelado, confirmacao_pendente)
        'arquivo_comprovante_uid',
        'data_envio_comprovante',
        'valor',
        'usuario_pagamento_id',
        'empresa_id'
    ];

    protected $table = 'alvara_do_permissionario';

    public function permissionario()
    {
        return $this->belongsTo(Permissionario::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    //////////////////////////////////////
    public static function search($search)
    {
        return Alvara::where("permissionario_id", $search)
            ->orderBy("created_at", "desc")
            ->simplePaginate(20);
    }

    public static function findByPermissionario($permissionario_id)
    {
        return Alvara::where("permissionario_id", $permissionario_id)
            ->orderBy("created_at", "desc")
            ->get();
    }
}
