<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condutor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ativo',
        'nome',
        'id_integracao',
        'cpf',
        'rg',
        'telefone',
        'celular',
        'email',
        'cnh',
        'categoria_cnh',
        'vencimento_cnh',
        'atestado_de_saude',
        'certidao_negativa',
        'validade_certidao_negativa',
        'registro_ctps',
        'primeiros_socorros',
        'emissao_primeiros_socorros',
        'motivo_afastamento',
        'data_inicio_afastamento',
        'data_termino_afastamento',
        'endereco_id',
        'permissionario_id',
        'foto_uid'
    ];

    protected $table = 'condutores';

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }

    public function permissionario()
    {
        return $this->hasOne(Permissionario::class, 'id', 'permissionario_id')->withoutGlobalScopes();
    }

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'condutor_id', 'id');
    }

    //////////////////////////////////////
    public static function search($search, $ativo, $usuario = false, $todos = false, $onlyEmailFCMValido = false)
    {
        $query = Condutor::where("nome", "like", "%" . $search . "%")
            ->orderBy("nome");

        if ($ativo) {
            $query->where("ativo", "=", $ativo);
        }

        if ($usuario) {
            $query->with("usuario");
        }

        if ($onlyEmailFCMValido) {
            $query->where(function ($query) {
                $query->whereNotNull("email")
                    ->orWhereHas("usuario", function ($query) {
                        $query->whereNotNull("token_fcm");
                    });
            });
        }

        if ($todos) {
            $query->select(
                "id",
                "nome",
                "cpf",
                "email"
            );
            
            return $query->get();
        }

        return $query->simplePaginate(15);
    }

    public static function searchByPermissionario($permissionario_id, $search)
    {
        return Condutor::where("permissionario_id", "=", $permissionario_id)->where("nome", "like", "%" . $search . "%")
            ->with("endereco")
            ->with("permissionario")
            ->orderBy("nome")
            ->paginate(40);
    }

    public static function findAllByPermissionario($permissionario_id)
    {
        return Condutor::where("permissionario_id", "=", $permissionario_id)
            ->with("endereco")
            ->with("permissionario")
            ->orderBy("nome")
            ->get();
    }

    public static function findAllByPermissionarioAtivos($permissionario_id)
    {
        return Condutor::where("permissionario_id", "=", $permissionario_id)
            ->where("ativo", "=", true)
            ->with("endereco")
            ->with("permissionario")
            ->orderBy("nome")
            ->get();
    }

    public static function findComplete($id, $withoutGlobalScope = false)
    {
        if ($withoutGlobalScope) {
            return Condutor::with('permissionario')
                ->with('endereco')
                ->with("permissionario")
                ->find($id);
        } else {
            return Condutor::with('endereco')->with('permissionario')->find($id);
        }
    }

    public static function findByIntegracaoComplete($id, $withoutGlobalScope = false)
    {
        if ($withoutGlobalScope) {
            return Condutor::with('permissionario')
                ->with('endereco')
                ->with("permissionario")
                ->firstWhere("id_integracao", $id);
        } else {
            return Condutor::with('endereco')->with('permissionario')->firstWhere("id_integracao", $id);
        }
    }

    public static function firstByCNH($cnh)
    {
        return Condutor::where("cnh", $cnh)->first();
    }

}
