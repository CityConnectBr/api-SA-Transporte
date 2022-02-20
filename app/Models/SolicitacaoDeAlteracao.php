<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoDeAlteracao extends Model
{

    protected $fillable = [
        'referencia_id',
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
        'valor_anterior_campo1',
        'valor_anterior_campo2',
        'valor_anterior_campo3',
        'valor_anterior_campo4',
        'valor_anterior_campo5',
        'valor_anterior_campo6',
        'valor_anterior_campo7',
        'valor_anterior_campo8',
        'valor_anterior_campo9',
        'valor_anterior_campo10',
        'valor_anterior_campo11',
        'valor_anterior_campo12',
        'valor_anterior_campo13',
        'valor_anterior_campo14',
        'valor_anterior_campo15',
        'valor_anterior_campo16',
        'valor_anterior_campo17',
        'valor_anterior_campo18',
        'valor_anterior_campo19',
        'valor_anterior_campo20',
        'valor_anterior_campo21',
        'valor_anterior_campo22',
        'valor_anterior_campo23',
        'valor_anterior_campo24',
        'valor_anterior_campo25',
        'tipo_solicitacao_id',
        'permissionario_id',
        'condutor_id',
        'fiscal_id',
        'referencia_fiscal_id',
        'referencia_permissionario_id',
        'referencia_monitor_id',
        'referencia_condutor_id',
        'referencia_veiculo_id',
        'endereco_id',
        'arquivo1_uid',
        'arquivo2_uid',
        'arquivo3_uid',
        'arquivo4_uid',
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

    public function permissionarioReferencia()
    {
        return $this->hasOne(Permissionario::class, 'id', 'referencia_permissionario_id');
    }

    public function condutorReferencia()
    {
        return $this->hasOne(Condutor::class, 'id', 'referencia_condutor_id');
    }

    public function fiscalReferencia()
    {
        return $this->hasOne(Fiscal::class, 'id', 'referencia_fiscal_id');
    }

    public function veiculoReferencia()
    {
        return $this->hasOne(Veiculo::class, 'id', 'referencia_veiculo_id');
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }

    ///////////////////

    public static function search($search, $inverseOrder = false)
    {
        if ($search == null || $search == '') {
            $query = SolicitacaoDeAlteracao::whereNull("status");
        } else if ($search == 'T') {
            $query = SolicitacaoDeAlteracao::where("id", "like", "%"); //figurante...
        } else {
            $query = SolicitacaoDeAlteracao::where("status", "like", $search);
        }

        $query->with("tipo");
        $query->with("permissionario");
        $query->with("condutor");
        $query->with("fiscal");
        $query->with("permissionarioReferencia");
        $query->with("condutorReferencia");
        $query->with("fiscalReferencia");
        $query->with("veiculoReferencia");
        $query->with("endereco");

        if ($inverseOrder) {
            $query->orderBy("created_at", 'DESC');
        } else {
            $query->orderBy("status");
        }

        return $query->paginate(40);
    }

    public static function findByPermissionarioAndTipo($permissionarioId, $tipo)
    {
        $query = SolicitacaoDeAlteracao::where("permissionario_id", $permissionarioId);
        $query->where("tipo_solicitacao_id", $tipo);
        $query->with("tipo");
        $query->with("permissionario");
        $query->with("condutor");
        $query->with("fiscal");
        $query->with("permissionarioReferencia");
        $query->with("condutorReferencia");
        $query->with("fiscalReferencia");
        $query->with("veiculoReferencia");
        $query->with("endereco");
        $query->orderBy("status");

        return $query->get();
    }

    public static function searchInverseOrder($search)
    {
        return SolicitacaoDeAlteracao::search($search, true);
    }

    public static function findComplete($id)
    {
        return SolicitacaoDeAlteracao::with("tipo")
            ->with("tipo")
            ->with("permissionario")
            ->with("condutor")
            ->with("fiscal")
            ->with("permissionarioReferencia")
            ->with("condutorReferencia")
            ->with("fiscalReferencia")
            ->with("veiculoReferencia")
            ->with("endereco")
            ->find($id);
    }

    public static function findAllWaitingByReference($tipo, $referenceId)
    {
        return SolicitacaoDeAlteracao::where('status', null)->where('tipo_solicitacao_id', $tipo)
            ->where(function ($q) use ($referenceId) {
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

        if (isset($tipo)) {
            $query->where("tipo_solicitacao_id", "=", $tipo);
        }

        if (isset($status)) {
            if (strcmp("null", $status) == 0) {
                $query->where("status", "=", null);
            } else {
                $query->where("status", "=", $status);
            }
        }

        if (isset($referencia)) {
            $query->where(function ($q) use ($referencia) {
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
