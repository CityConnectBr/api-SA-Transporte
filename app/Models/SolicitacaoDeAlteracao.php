<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoDeAlteracao extends Model
{

    protected $fillable = [
        'referencia_id',
        'sincronizado',
        'status', // A-ACEITO,R-RECUSADO,C-CANCELADO,NULL-AGUARDANDO
        'motivo_recusado',
        'campo1',
        'campo2',
        'campo3',
        'campo4',
        'campo5',
        'campo6',
        'campo7',
        'campo8',
        'campo9',
        'campo10',
        'campo11',
        'campo12',
        'campo13',
        'campo14',
        'campo15',
        'campo16',
        'campo17',
        'campo18',
        'campo19',
        'campo20',
        'campo21',
        'campo22',
        'campo23',
        'campo24',
        'campo25',
        'tipo_solicitacao_id',
        'permissionario_id',
        'condutor_id',
        'fiscal_id'
    ];

    protected $attributes = [
        'sincronizado' => false
    ];

    protected $temporaly = [
        'arquivo1',
        'arquivo2',
        'arquivo3',
        'arquivo4'
    ];

    protected $table = 'solicitacoes_de_alteracao';

    public function tipo()
    {
        return $this->hasOne(TipoDeSolicitacaoDeAlteracao::class, 'id', 'tipo_solicitacao_id');
    }

    public function permissionario()
    {
        return $this->hasOne(Permissionario::class, 'id', 'permissionario_id');
    }

    public function condutor()
    {
        return $this->hasOne(Condutor::class, 'id', 'condutor_id');
    }

    public function fiscal()
    {
        return $this->hasOne(Fiscal::class, 'id', 'fiscal_id');
    }

    // /////////////////
    public static function findComplete($id)
    {
        return SolicitacaoDeAlteracao::
            with("tipo")
            ->with("permissionario")
            ->with("condutor")
            ->with("fiscal")
            ->find($id);
    }

    public static function findAllWaitingByReference($referenceId)
    {
        return SolicitacaoDeAlteracao::where('status', null)->where('referencia_id', $referenceId)->get();
    }

    public static function cancel($solicitacao)
    {
        $solicitacao->status = "C";
        $solicitacao->save();
    }

    public static function setSinc($id)
    {
        $solicitacao = SolicitacaoDeAlteracao::find($id);
        $solicitacao->sincronizado = true;
        $solicitacao->save();
    }

    public static function setStatus($id, $status, $motivoRecusa)
    {
        $solicitacao = SolicitacaoDeAlteracao::find($id);
        $solicitacao->status = $status;
        $solicitacao->motivo_recusado = $motivoRecusa;
        $solicitacao->save();
    }

    public static function findAllNotSinc()
    {
        return SolicitacaoDeAlteracao::where('status', null)->where('sincronizado', false)->get();
    }
}
