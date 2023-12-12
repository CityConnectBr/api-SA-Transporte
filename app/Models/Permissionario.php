<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permissionario extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ativo',
        'id_integracao',
        'numero_de_cadastro_antigo',
        'nome_razao_social',
        'tipo',
        'cpf_cnpj',
        'rg',
        'estado_civil',
        'inscricao_municipal',
        'alvara_de_funcionamento',
        'responsavel',
        'procurador_responsavel',
        'telefone',
        'telefone2',
        'celular',
        'email',
        'data_nascimento',
        'naturalidade',
        'nacionalidade',
        'cnh',
        'prefixo',
        'inss',
        'modalidade_id',
        'entidade_associativa_id',
        'categoria_cnh',
        'vencimento_cnh',
        'endereco_id',
        'atestado_de_saude',
        'certidao_negativa',
        'validade_certidao_negativa',
        'comprovante_de_endereco',
        'inscricao_do_cadastro_mobiliario',
        'numero_do_cadastro_mobiliario',
        'curso_primeiro_socorros',
        'curso_primeiro_socorros_emissao',
        'crlv',
        'dpvat',
        'certificado_pontuacao_cnh',
        'contrato_comodato',
        'contrato_comodato_validade',
        'ipva',
        'relacao_dos_alunos_transportados',
        'laudo_vistoria_com_aprovacao_da_sa_trans',
        'ciretran_vistoria',
        'ciretran_autorizacao',
        'selo_gnv',
        'selo_gnv_validade',
        'taximetro_tacografo',
        'taximetro_tacografo_numero',
        'taximetro_tacografo_afericao',
        'inicio_atividades',
        'termino_atividades',
        'termino_atividades_motivo',
        'data_transferencia',
        'data_obito',
        'certidao_de_obito',
        'observacao_obito',
        'nome_inventariante',
        'numero_do_processo_do_inventario',
        'grau_de_paretesco_inventariante',
        'parecer_do_juiz_sobre_inventario',
        'data_processo_seletivo',
        'classificacao_do_processo',
        'numero_do_processo',

        'foto_uid'
    ];

    protected $dates = ['vencimento_cnh', 'taximetro_tacografo_afericao'];

    protected $temporaly = [
        'modalidade_transporte'
    ];

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }

    public function modalidade()
    {
        return $this->hasOne(Modalidade::class, 'id', 'modalidade_id');
    }

    public function lastAlvara()
    {
        return $this->hasOne(Alvara::class, 'permissionario_id', 'id')->orderBy('created_at', 'desc');
    }

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'permissionario_id', 'id');
    }


    //////////////////////////////////////
    public static function search(
        $search,
        $ativo = true,
        $modalidade_id = null,
        $usuario = false,
        $todos = false,
        $onlyEmailFCMValido = false
    ) {
        $query = Permissionario::where(function ($query) use ($search) {
            $query->where("nome_razao_social", "like", "%" . $search . "%")
                ->orWhere("id_integracao", "like", "%" . $search . "%")
                ->orWhere("cpf_cnpj", "like", "%" . $search . "%")
                ->orWhere("prefixo", "like", "%" . $search . "%");
        })
            ->where("ativo", "=", $ativo)
            ->with("modalidade")
            ->orderBy("nome_razao_social");

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

        if ($modalidade_id) {
            $query->where("modalidade_id", "=", $modalidade_id);
        }

        if ($todos) {
            $query->select(
                "id",
                "nome_razao_social",
                "cpf_cnpj",
                "prefixo",
                "modalidade_id",
                "email"
            );
            return $query->get();
        }

        return $query->simplePaginate(15);
    }

    public static function searchByPermissionario($permissionario_id, $search)
    {
        return Permissionario::where("id", "=", $permissionario_id)->where("nome_razao_social", "like", "%" . $search . "%")
            ->with("endereco")
            ->orderBy("nome")
            ->paginate(40);
    }

    public static function findByIdWithEndereco($id)
    {
        return Permissionario::with('endereco')->firstWhere("id", $id);
    }

    public static function findByIntegracaoComplete($id)
    {
        return Permissionario::with('modalidade')
            ->with('endereco')
            ->with('alvara')
            ->firstWhere("id_integracao", $id);
    }

    public static function firstWhereByIntegracao($id)
    {
        return Permissionario::firstWhere("id_integracao", $id);
    }

    public static function firstByCpfCnpj($cpfCnj)
    {
        return Permissionario::where("cpf_cnpj", $cpfCnj)->first();
    }

    public static function firstByCnh($cpfCnj)
    {
        return Permissionario::where("cnh", $cpfCnj)->first();
    }

    public static function findPermissionariosComDocumentosExpirados()
    {
        return Permissionario::where("vencimento_cnh", "<", date("Y-m-d"))
            ->orWhere("validade_certidao_negativa", "<", date("Y-m-d"))
            ->orWhere("contrato_comodato_validade", "<", date("Y-m-d"))
            ->orWhere("selo_gnv_validade", "<", date("Y-m-d"))
            ->get();
    }

    public static function findWithUsuario($id)
    {
        return Permissionario::with('usuario')->firstWhere("id", $id);
    }

    public function permissionarioHistorico()
    {
        return $this->hasMany(PermissionarioHistorico::class);
    }

    public function formattedCpfCnpj() {
        if (strlen($this->cpf_cnpj) == 11) {
            return substr($this->cpf_cnpj, 0, 3) . '.' . substr($this->cpf_cnpj, 3, 3) . '.' . substr($this->cpf_cnpj, 6, 3) . '-' . substr($this->cpf_cnpj, 9, 2);
        } else {
            return substr($this->cpf_cnpj, 0, 2) . '.' . substr($this->cpf_cnpj, 2, 3) . '.' . substr($this->cpf_cnpj, 5, 3) . '/' . substr($this->cpf_cnpj, 8, 4) . '-' . substr($this->cpf_cnpj, 12, 2);
        }
    }

}
