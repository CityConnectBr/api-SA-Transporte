<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certidao extends Model
{
    use SoftDeletes;
    use ProtocolEvent;

    protected $fillable = [
        'id_integracao',
        'data',
        'renavam',
        'placa',
        'ano_fabricacao',
        'chassis',
        'prefixo',
        'marca_modelo_veiculo_id',
        'tipo_de_certidao_id',
        'permissionario_id',
        'tipo_combustivel_id',
        'cor_id',
        'ponto_id',
        'observacao',
        'protocol',
    ];

    protected $table = 'certidoes';

    ///////////////////

    public static function search($search)
    {
        return Certidao::where("placa", "like", "%" . $search . "%")
            ->orderBy("data")
            ->paginate(40);
    }

    ///////////////////

    public function permissionario()
    {
        return $this->hasOne(Permissionario::class, 'id', 'permissionario_id');
    }

    public function marcaModeloVeiculo()
    {
        return $this->hasOne(MarcaModeloVeiculo::class, 'id', 'marca_modelo_veiculo_id');
    }

    public function tipoCombustivel()
    {
        return $this->hasOne(TipoCombustivel::class, 'id', 'tipo_combustivel_id');
    }

    public function cor()
    {
        return $this->hasOne(CorVeiculo::class, 'id', 'cor_id');
    }

    public function ponto()
    {
        return $this->hasOne(Ponto::class, 'id', 'ponto_id');
    }

    public function tipoDeCertidao()
    {
        return $this->hasOne(TipoDeCertidao::class, 'id', 'tipo_de_certidao_id');
    }

    ///////////////////

    public static function findByIdComplete($id)
    {
        return Certidao::with('permissionario', 'marcaModeloVeiculo', 'tipoCombustivel', 'cor', 'ponto', 'tipoDeCertidao')
            ->where('id', $id)
            ->first();
    }
}