<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ativo',
        'nome',
        'email',
        'password',
        'permissionario_id',
        'fiscal_id',
        'condutor_id',
        'tipo_id',
        'perfil_web_id',
        'codigo_de_recuperacao',
        'data_hora_ultimo_codigo_de_recuperacao',
        'perfil_web_id',
        'assinatura',
        'token_fcm'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function tipo()
    {
        return $this->hasOne(TiposDeUsuarios::class, 'id', 'tipo_id');
    }

    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'id', 'perfil_web_id');
    }

    public function permissionario()
    {
        return $this->hasOne(Permissionario::class, 'id', 'permissionario_id')->withoutGlobalScopes();
    }

    public function fiscal()
    {
        return $this->hasOne(Fiscal::class, 'id', 'fiscal_id')->withoutGlobalScopes();
    }

    public function condutor()
    {
        return $this->hasOne(Condutor::class, 'id', 'condutor_id')->withoutGlobalScopes();
    }

    //////////////////////////////////////

    public static function findComplete($id)
    {
        return Usuario::with('tipo')->with('perfil')->find($id);
    }

    public static function findByEmail($email)
    {
        return Usuario::where("email", $email)->first();
    }

    /*
    public static function findByCpfCnpj($cpfCnpj){
        return Usuario::where("cpf_cnpj", $cpfCnpj)->first();
    }*/

    public static function findByCNH($cnh)
    {
        return Usuario::where("cnh", $cnh)->first();
    }

    public static function findByEmailWithRecoveryCode($email, $code)
    {
        return Usuario::where("email", $email)->where("codigo_de_recuperacao", $code)->first();
    }

    /*public static function findByEmailOrCpfCnpj($email, $cpfCnpj){
        return Usuario::where("email", $email)->get();
    }*/

    //////////////////////////////////////
    public static function search($search)
    {
        return Usuario::where("nome", "like", "%" . $search . "%")
            ->orderBy("nome")
            ->simplePaginate(15);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}