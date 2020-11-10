<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'email',
        'cpf_cnpj',
        'cnh',
        'password',
        'permissionario_id',
        'fiscal_id',
        'monitor_id',
        'tipo_id',
        'codigo_de_recuperacao',
        'data_hora_ultimo_codigo_de_recuperacao'
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
    
    public function permissionario()
    {
        return $this->hasOne(Permissionario::class, 'id', 'permissionario_id')->withoutGlobalScopes();
    }
    
    //////////////////////////////////////

    public static function findComplete($id)
    {
        return Usuario::with('tipo')->find($id);
    }
    
    public static function findByEmail($email)
    {
        return Usuario::where("email", $email)->first();
    }
    
    public static function findByEmailWithRecoveryCode($email, $code)
    {
        return Usuario::where("email", $email)->where("codigo_de_recuperacao", $code)->first();
    }
    
    public static function findByEmailOrCpfCnpj($email, $cpfCnpj){
        return Usuario::where("email", $email)->orWhere("cpf_cnpj", $cpfCnpj)->get();
    }
    
    //////////////////////////////////////

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
