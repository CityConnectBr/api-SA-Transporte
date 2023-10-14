<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monitor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ativo',
        'nome',
        'numero_de_cadastro_antigo',
        'id_integracao',
        'cpf',
        'rg',
        'telefone',
        'email',
        'data_nascimento',
        'certidao_negativa',
        'validade_da_certidao_negativa',
        'curso_de_primeiro_socorros',
        'emissao_curso_de_primeiro_socorros',
        'permissionario_id',
        'endereco_id',
        'foto_uid'
    ];

    protected $table = 'monitores';

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }

    public function permissionario()
    {
        return $this->hasOne(Permissionario::class, 'id', 'permissionario_id')->withoutGlobalScopes();
    }

    public static function search($search, $ativo, $todos = false, $onlyEmailValido = false)
    {
        $query = Monitor::where("nome", "like", "%" . $search . "%")
            ->orderBy("nome");

        if ($ativo) {
            $query->where("ativo", "=", $ativo);
        }        

        if ($onlyEmailValido) {            
            $query->whereNotNull("email")->where("email", "!=", "");
        }

        if ($todos) {
            $query->select(
                "id",
                "nome",
                "cpf",
                "email",
            );
            return $query->get();
        }

        return $query->simplePaginate(15);
    }

    public static function findComplete($id, $withoutGlobalScope = false)
    {
        if ($withoutGlobalScope) {
            return Monitor::with('permissionario')
                ->with('endereco')
                ->with("permissionario")
                ->find($id);
        } else {
            return Monitor::with('endereco')->with('permissionario')->find($id);
        }
    }

    public static function findByIntegracaoComplete($id, $withoutGlobalScope = false)
    {
        if ($withoutGlobalScope) {
            return Monitor::with('permissionario')
                ->with('endereco')
                ->with("permissionario")
                ->firstWhere("id_integracao", $id);
        } else {
            return Monitor::with('endereco')->with('permissionario')->firstWhere("id_integracao", $id);
        }
    }

    public static function searchPorPermissionario($permissionario_id, $search)
    {
        return Monitor::where("permissionario_id", "=", $permissionario_id)->where("nome", "like", "%" . $search . "%")
            ->with("endereco")
            ->with("permissionario")
            ->orderBy("nome")
            ->paginate(40);
    }

    public static function searchByPermissionario($permissionarioId, $search)
    {
        return Monitor::where("permissionario_id", "=", $permissionarioId)->where("nome", "like", "%" . $search . "%")
            ->with("endereco")
            ->with("permissionario")
            ->orderBy("nome")
            ->simplePaginate(40);
    }

    public static function findAllByPermissionario($permissionarioId)
    {
        return Monitor::where("permissionario_id", "=", $permissionarioId)
            ->with("endereco")
            ->with("permissionario")
            ->orderBy("nome")
            ->get();
    }
}