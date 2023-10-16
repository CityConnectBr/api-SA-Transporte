<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fiscal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ativo',
        'nome',
        'id_integracao',
        'nome',
        'cpf',
        'telefone',
        'email',
        'cargo',
        'unidade_trabalho',
        'endereco_id',
        'foto_uid'
    ];

    protected $table = 'fiscais';

    /*protected $attributes = [
        'versao' => 0
    ];*/

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'fiscal_id', 'id');
    }

    // /////////////////
    public static function findComplete($id)
    {
        return Fiscal::with('endereco')->find($id);
    }

    public static function findByIntegracaoComplete($id)
    {
        return Fiscal::with('endereco')->firstWhere("id_integracao", $id);
    }

    /*public static function search($search)
    {
        return Fiscal::where("nome", "like", "%" . $search . "%")->with("endereco")
            ->orderBy("nome")
            ->paginate(40);
    }*/

    public static function search($search, $ativo, $usuario = false, $todos = false, $onlyEmailFCMValido = false)
    {
        $query = Fiscal::where("nome", "like", "%" . $search . "%")
            ->with("endereco")
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
                "email",
            );
            return $query->get();
        }

        return $query->simplePaginate(15);
    }

    public static function firstByCpf($cpf)
    {
        return Fiscal::where("cpf", $cpf)->first();
    }
}