<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fiscal extends Model
{

    protected $fillable = [
        'nome',
        'id_integracao',
        'nome',
        'cpf',
        'ddd',
        'telefone',
        'email',
        'cargo',
        'versao'
    ];

    protected $table = 'fiscais';

    protected $attributes = [
        'versao' => 0
    ];

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
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

    public static function search($search)
    {
        return Fiscal::where("nome", "like", "%" . $search . "%")->with("endereco")
            ->orderBy("nome")
            ->paginate(40);
    }
    
    public static function firstByCpf($cpf)
    {
        return Fiscal::where("cpf", $cpf)->first();
    }
}
