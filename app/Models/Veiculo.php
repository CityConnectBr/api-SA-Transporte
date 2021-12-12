<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Veiculo extends Model
{

    protected $fillable = [
        'id_integracao',
        'placa',
        'cod_renavam',
        'chassi',
        'ano_fabricacao',
        'ano_modelo',
        'capacidade',
        'tipo_capacidade',
        'observacao_capacidade',
        'anos_vida_util_veiculo',
        'situacao',
        //'prefixo',//onibus
        'versao',
        'categoria_id',
        //'marca_modelo_carroceria_id',//onibus
        //'marca_modelo_chassi_id',//onibus
        'marca_modelo_veiculo_id',
        'tipo_combustivel_id',
        'cor_id',
        'tipo_veiculo_id',
        'permissionario_id'
    ];

    protected $table = 'veiculos';

    

    public static function returnPaginated()
    {
        return Veiculo::paginate(15);//where("placa", "like", "%" . $search . "%")
            //->orderBy("placa")
            //->simplePaginate(15);
    }

    /*protected $attributes = [
        'versao' => 0
    ];

    protected static function booted()
    {
        static::addGlobalScope('situacao', function (Builder $builder) {
            $builder->where('situacao', "A");
        });
    }*/

    public function marcaModeloCarroceria()
    {
        return $this->hasOne(MarcaModeloCarroceria::class, 'id', 'marca_modelo_carroceria_id');
    }

    public function marcaModeloChassi()
    {
        return $this->hasOne(MarcaModeloChassi::class, 'id', 'marca_modelo_chassi_id');
    }

    public function marcaModeloVeiculo()
    {
        return $this->hasOne(MarcaModeloVeiculo::class, 'id', 'marca_modelo_veiculo_id');
    }

    public function tipoCombustivel()
    {
        return $this->hasOne(TipoCombustivel::class, 'id', 'tipo_combustivel_id');
    }

    public function tipoVeiculo()
    {
        return $this->hasOne(TipoVeiculo::class, 'id', 'tipo_veiculo_id');
    }

    public function cor()
    {
        return $this->hasOne(CorVeiculo::class, 'id', 'cor_id');
    }

    public function permissionario()
    {
        return $this->belongsTo(Permissionario::class, 'permissionario_id', 'id');//->withoutGlobalScopes();
    }

    // /////////////////

    public static function search($search)
    {   
        if($search){
           
        return Veiculo::where("placa", "like", "%" . $search . "%")
            ->with("marcaModeloVeiculo")
            ->with("cor")
            ->with("tipoVeiculo")
            ->with("tipoCombustivel")
            ->with("marcaModeloChassi")
            ->with("marcaModeloCarroceria")
            ->orderBy("placa")
            ->simplePaginate(15);
        }
        else {
            //dd('1');
            return Veiculo::with("marcaModeloVeiculo")
            ->with('cor')
            ->with('tipoVeiculo')
            ->orderBy("placa")
            ->simplePaginate(15);
        }
    }

    public static function findComplete($id, $type, $withoutGlobalScope = false)
    {
        //dd($withoutGlobalScope);
        if ($withoutGlobalScope) {
            return Veiculo::withoutGlobalScope('situacao')->with('marcaModeloCarroceria')
                ->with('marcaModeloChassi')
                ->with('marcaModeloVeiculo')
                ->with('tipoCombustivel')
                ->with('tipoVeiculo')
                ->with('cor')
                ->with('permissionario')
                ->find($id);
        }
        // if($type == '3'){
         
        //     return Veiculo::with('marcaModeloCarroceria')->with('marcaModeloChassi')
        //         ->with('marcaModeloVeiculo')
        //         ->with('tipoCombustivel')
        //         ->with('tipoVeiculo')
        //         ->with('cor')
        //         ->with('permissionario.veiculo')
        //         ->find($id);
        
        // }
         else {
            return Veiculo::with('marcaModeloCarroceria')->with('marcaModeloChassi')
                ->with('marcaModeloVeiculo')
                ->with('tipoCombustivel')
                ->with('tipoVeiculo')
                ->with('cor')
                ->with('permissionario')
                ->find($id);
        }
    }

    public static function findByIntegracaoComplete($id, $withoutGlobalScope = false)
    {
        if ($withoutGlobalScope) {
            return Veiculo::withoutGlobalScope('situacao')->with('marcaModeloCarroceria')
                ->with('marcaModeloChassi')
                ->with('marcaModeloVeiculo')
                ->with('tipoCombustivel')
                ->with('tipoVeiculo')
                ->with('cor')
                ->with('permissionario')
                ->firstWhere("id_integracao", $id);
        } else {
            return Veiculo::with('marcaModeloCarroceria')->with('marcaModeloChassi')
                ->with('marcaModeloVeiculo')
                ->with('tipoCombustivel')
                ->with('tipoVeiculo')
                ->with('cor')
                ->with('permissionario')
                ->firstWhere("id_integracao", $id);
        }
    }

    public static function searchById($permissionario_id, $search)
    {
        return Veiculo::where("permissionario_id", "=", $permissionario_id)->where(function ($q) use ($search) {
            $q->where("placa", "like", "%" . $search . "%")
                ->orWhere("cod_renavam", "like", "%" . $search . "%");
        })
            ->with("marcaModeloCarroceria")
            ->with("marcaModeloChassi")
            ->with("marcaModeloVeiculo")
            ->with("tipoCombustivel")
            ->with("tipoVeiculo")
            ->with("cor")
            ->with("permissionario")
            ->orderBy("placa")
            ->paginate(40);
    }

    public static function returnComplete($withoutGlobalScope = false)
    {
        if ($withoutGlobalScope) {
            return Veiculo::withoutGlobalScope('situacao')->with('marcaModeloCarroceria')
                ->with('marcaModeloChassi')
                ->with('marcaModeloVeiculo')
                ->with('tipoCombustivel')
                ->with('tipoVeiculo')
                ->with('cor')
                ->with('permissionario')
                ->get();
        } else {
            return Veiculo::with('marcaModeloCarroceria')->with('marcaModeloChassi')
                ->with('marcaModeloVeiculo')
                ->with('tipoCombustivel')
                ->with('tipoVeiculo')
                ->with('cor')
                ->with('permissionario')
                ->get();
        }
    }

    public static function returnCondutor ($search, $id){
        //dd($id);
       //
            // return Condutor::where('condutores.id','=',$id)
            // ->join('permissionarios', 'condutores.permissionario_id', '=', 'permissionarios.id')
            // ->join('veiculos', 'permissionarios.veiculo_id', '=', 'veiculos.id')
            // ->select('veiculos.*')
            // ->with('permissionario.veiculo.marcaModeloVeiculo')
            // ->get();
            // return Veiculo::with('marcaModeloCarroceria')->with('marcaModeloChassi')
            //     ->with('marcaModeloVeiculo')
            //     ->with('tipoCombustivel')
            //     ->with('tipoVeiculo')
            //     ->with('cor')
            //     ->with('permissionario')
            //     //->with('permissionario.condutor')
            //     ///->where('permissionario.condutor.id', '=', $id)
            //     // ->join('permissionarios', 'veiculos.permissionario_id', '=', 'permissionarios.id')
            //     // ->rightJoin('condutores', 'permissionarios.id','=', 'condutores.permissionario_id')
            //     //->where('condutor.id', '=', $id)
            //     ->get();
            return Veiculo::with("marcaModeloVeiculo")
            ->with('cor')
            ->with('tipoVeiculo')
            ->join('permissionarios', 'veiculos.id', '=', 'permissionarios.veiculo_id')
            ->join('condutores', 'condutores.permissionario_id', '=', 'permissionarios.id')
            ->where('condutores.id', '=', $id)
            ->select('veiculos.*')
            //->orderBy("placa")
            ->simplePaginate(15);
    }
}
