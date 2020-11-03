<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposSolicitacaoDeAlteracaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '1',
            'nome' => 'condutor_contato',
            'nome_campo1' => 'Email',
            'desc_campo1' => 'email',
            'regex_campo1' => '^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$',
            'nome_campo2' => 'DDD',
            'desc_campo2' => 'ddd',
            'regex_campo2' => '^\d{2}$',
            'nome_campo3' => 'Telefone',
            'desc_campo3' => 'telefone',
            'regex_campo3' => '^(\d{9}|\d{8}|)$',
            'nome_campo4' => 'Celular',
            'desc_campo4' => 'celular',
            'regex_campo4' => '^(\d{9}|\d{8}|)$',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '2',
            'nome' => 'condutor_endereco',
            'nome_campo1' => 'CEP',
            'desc_campo1' => 'cep',
            'regex_campo1' => '^(\d{8})$',
            'nome_campo2' => 'Endereco',
            'desc_campo2' => 'endereco',
            'regex_campo2' => '^.{1,40}$',
            'nome_campo3' => 'Numero',
            'desc_campo3' => 'numero',
            'regex_campo3' => '^.{1,5}$',
            'nome_campo4' => 'Complemento',
            'desc_campo4' => 'complemento',
            'regex_campo4' => '^.{0,15}$',
            'nome_campo5' => 'Bairro',
            'desc_campo5' => 'bairro',
            'regex_campo5' => '^.{1,100}$',
            'nome_campo6' => 'Municipio',
            'desc_campo6' => 'municipio',
            'regex_campo6' => '^.{1,25}$',
            'nome_campo7' => 'UF',
            'desc_campo7' => 'uf',
            'regex_campo7' => '^.{2,2}$'
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '3',
            'nome' => 'condutor_identidade',
            'desc_campo1' => 'Nome',
            'desc_campo1' => 'nome',
            'regex_campo1' => '^.{1,40}$',
            'desc_campo2' => 'CPF',
            'desc_campo2' => 'cpf/cnpj',
            'regex_campo2' => '^(\d{11}|\d{14})$',
            'desc_campo3' => 'RG',
            'desc_campo3' => 'rg',
            'regex_campo3' => '^.{1,15}$',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '4',
            'nome' => 'condutor_cnh',
            'nome_campo1' => 'CNH',
            'desc_campo1' => 'cnh',
            'regex_campo1' => '^(\d{11})$',
            'nome_campo2' => 'CategoriaCNH',
            'desc_campo2' => 'categoria da CNH',
            'regex_campo2' => '^.{1,3}$',
            'nome_campo3' => 'ValidadeCNH',
            'desc_campo3' => 'vencimento da CNH',
            'regex_campo3' => '^\d{4}-\d{2}-\d{2}$',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '5',
            'nome' => 'condutor_cadastro',
            'nome_campo1' => 'CNH',
            'desc_campo1' => 'cnh',
            'regex_campo1' => '^(\d{11})$',
            'nome_campo2' => 'CategoriaCNH',
            'desc_campo2' => 'categoria da CNH',
            'regex_campo2' => '^.{1,3}$',
            'nome_campo3' => 'ValidadeCNH',
            'desc_campo3' => 'vencimento da CNH',
            'regex_campo3' => '^\d{4}-\d{2}-\d{2}$',
            'nome_campo4' => 'Email',
            'desc_campo4' => 'email',
            'regex_campo4' => '^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$',
            'nome_campo5' => 'DDD',
            'desc_campo5' => 'ddd',
            'regex_campo5' => '^\d{2}$',
            'nome_campo6' => 'Telefone',
            'desc_campo6' => 'telefone',
            'regex_campo6' => '^(\d{9}|\d{8}|)$',
            'nome_campo7' => 'Celular',
            'desc_campo7' => 'celular',
            'regex_campo7' => '^(\d{9}|\d{8}|)$',
            'nome_campo8' => 'CEP',
            'desc_campo8' => 'cep',
            'regex_campo8' => '^(\d{8})$',
            'nome_campo9' => 'Endereco',
            'desc_campo9' => 'endereco',
            'regex_campo9' => '^.{1,40}$',
            'nome_campo10' => 'Numero',
            'desc_campo10' => 'numero',
            'regex_campo10' => '^[0-9]*$',
            'nome_campo11' => 'Complemento',
            'desc_campo11' => 'complemento',
            'regex_campo11' => '^.{0,15}$',
            'nome_campo12' => 'Bairro',
            'desc_campo12' => 'bairro',
            'regex_campo12' => '^.{1,100}$',
            'nome_campo13' => 'Municipio',
            'desc_campo13' => 'municipio',
            'regex_campo13' => '^.{1,25}$',
            'nome_campo14' => 'UF',
            'desc_campo14' => 'uf',
            'regex_campo14' => '^.{2,2}$',
            'nome_campo15' => 'Nome',
            'desc_campo15' => 'nome',
            'regex_campo15' => '^.{1,40}$',
            'nome_campo16' => 'CPF',
            'desc_campo16' => 'cpf',
            'regex_campo16' => '^(\d{11}|\d{14})$',
            'nome_campo17' => 'RG',
            'desc_campo17' => 'rg',
            'regex_campo17' => '^.{1,15}$',
        ]);
    }
}
