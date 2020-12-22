<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Monitor extends Model
{

    protected $fillable = [
        'nome',
        'id_integracao',
        'situacao',
        'cpf',
        'rg',
        'telefone',
        'email',
        'data_nascimento',
        'versao',
        'foto_uid'
    ];
    
    protected $table = 'monitores';
    
    protected $attributes = [
        'versao' => 0
    ];

    protected static function booted()
    {
        static::addGlobalScope('situacao', function (Builder $builder) {
            $builder->where('situacao', "A");
        });
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }

    public function permissionario()
    {
        return $this->hasOne(Permissionario::class, 'id', 'permissionario_id')->withoutGlobalScopes();
    }

    // /////////////////
    public static function findComplete($id, $withoutGlobalScope = false)
    {
        if ($withoutGlobalScope) {
            return Monitor::withoutGlobalScope('situacao')->with('permissionario')
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
            return Monitor::withoutGlobalScope('situacao')->with('permissionario')
            ->with('endereco')
            ->with("permissionario")
            ->firstWhere("id_integracao", $id);
        } else {
            return Monitor::with('endereco')->with('permissionario')->firstWhere("id_integracao", $id);
        }
    }
    
    public static function search($permissionario_id, $search)
    {
        return Monitor::where("permissionario_id", "=", $permissionario_id)->where("nome", "like", "%" . $search . "%")
        ->with("endereco")
        ->with("permissionario")
        ->orderBy("nome")
        ->paginate(40);
    }

}
