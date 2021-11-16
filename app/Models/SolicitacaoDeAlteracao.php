<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoDeAlteracao extends Model
{

    protected $fillable = [
        'referencia_remota_id',
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
        'fiscal_id',
        'referencia_fiscal_id',
        'referencia_permissionario_id',
        'referencia_monitor_id',
        'referencia_condutor_id',
        'referencia_veiculo_id',
        'arquivo1_uid',
        'arquivo2_uid',
        'arquivo3_uid',
        'arquivo4_uid',
    ];

    protected $attributes = [
        'sincronizado' => false
    ];

    public $referencia_id;

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

    ///////////////////

    public static function search($search)
    {
        return TipoDeCertidao::where("descricao", "like", "%" . $search . "%")
        ->orderBy("descricao")
        ->paginate(40);
    }

    public static function findComplete($id)
    {
        return SolicitacaoDeAlteracao::with("tipo")->with("permissionario")
            ->with("condutor")
            ->with("fiscal")
            ->find($id);
    }

    public static function findAllWaitingByReference($tipo, $referenceId)
    {
        return SolicitacaoDeAlteracao::where('status', null)->where('tipo_solicitacao_id', $tipo)
        ->where(function ($q) use ($referenceId){
            $q->orWhere('referencia_fiscal_id', $referenceId)
            ->orWhere('referencia_permissionario_id', $referenceId)
            ->orWhere('referencia_monitor_id', $referenceId)
            ->orWhere('referencia_condutor_id', $referenceId)
            ->orWhere('referencia_veiculo_id', $referenceId);
        })->get();
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

    public static function searchComplete($usuario, $tipo, $referencia, $status)
    {
        if (isset($usuario->permissionario_id)) {
            $query = SolicitacaoDeAlteracao::where("permissionario_id", "=", $usuario->permissionario_id)->with("permissionario");
        } else if (isset($usuario->fiscal_id)) {
            $query = SolicitacaoDeAlteracao::where("fiscal_id", "=", $usuario->fiscal_id)->with("fiscal");
        } else if (isset($usuario->condutor_id)) {
            $query = SolicitacaoDeAlteracao::where("condutor_id", "=", $usuario->condutor_id)->with("condutor");
        }

        if(isset($tipo)){
            $query->where("tipo_solicitacao_id", "=", $tipo);
        }

        if(isset($status)){
            if(strcmp("null", $status)==0){
                $query->where("status", "=", null);
            }else{
                $query->where("status", "=", $status);
            }
        }

        if(isset($referencia)){
            $query->where(function ($q) use ($referencia){
                $q->orWhere('referencia_fiscal_id', $referencia)
                ->orWhere('referencia_permissionario_id', $referencia)
                ->orWhere('referencia_monitor_id', $referencia)
                ->orWhere('referencia_condutor_id', $referencia)
                ->orWhere('referencia_veiculo_id', $referencia);
            });
        }

        return $query->with('tipo')->orderBy("created_at", 'DESC')->paginate(40);
    }
}
