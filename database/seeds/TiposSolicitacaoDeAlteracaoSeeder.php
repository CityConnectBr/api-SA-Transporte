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
            'desc_campo1' => 'email',
            'regex_campo1' => '^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$',
            'desc_campo2' => 'ddd',
            'regex_campo2' => '^\d{2}$',
            'desc_campo3' => 'telefone',
            'regex_campo3' => '^(\d{9}|\d{8}|)$',
            'desc_campo4' => 'celular',
            'regex_campo4' => '^(\d{9}|\d{8}|)$',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '2',
            'nome' => 'condutor_endereco',
            'desc_campo1' => 'cep',
            'regex_campo1' => '^(\d{8})$',
            'desc_campo2' => 'endereco',
            'regex_campo2' => '^.{1,40}$',
            'desc_campo3' => 'numero',
            'regex_campo3' => '^[0-9]*$',
            'desc_campo4' => 'complemento',
            'regex_campo4' => '^.{0,40}$',
            'desc_campo5' => 'bairro',
            'regex_campo5' => '^.{1,40}$',
            'desc_campo6' => 'municipio',
            'regex_campo6' => '^.{1,40}$',
            'desc_campo7' => 'uf',
            'regex_campo7' => '^.{2,2}$'
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '3',
            'nome' => 'condutor_identidade',
            'desc_campo1' => 'nome',
            'regex_campo1' => '^.{1,40}$',
            'desc_campo2' => 'cpf/cnpj',
            'regex_campo2' => '^(\d{11}|\d{14})$',
            'desc_campo3' => 'rg',
            'regex_campo3' => '^.{1,40}$',
            'desc_campo4' => 'naturalidade',
            'regex_campo4' => '^.{1,40}$',
            'desc_campo5' => 'nacionalidade',
            'regex_campo5' => '^.{1,40}$',
            'desc_campo6' => 'data_nascimento',
            'regex_campo6' => '^\d{4}-\d{2}-\d{2}$',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '4',
            'nome' => 'condutor_cnh',
            'desc_campo1' => 'cnh',
            'regex_campo1' => '^(\d{11})$',
            'desc_campo2' => 'categoria',
            'regex_campo2' => '^.{1,3}$',
            'desc_campo3' => 'vencimento',
            'regex_campo3' => '^\d{4}-\d{2}-\d{2}$',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '5',
            'nome' => 'condutor_cadastro',
            'desc_campo1' => 'cnh',
            'regex_campo1' => '^(\d{11})$',
            'desc_campo2' => 'categoria',
            'regex_campo2' => '^.{1,3}$',
            'desc_campo3' => 'vencimento',
            'regex_campo3' => '^\d{4}-\d{2}-\d{2}$',
            'desc_campo4' => 'email',
            'regex_campo4' => '^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$',
            'desc_campo5' => 'ddd',
            'regex_campo5' => '^\d{2}$',
            'desc_campo6' => 'telefone',
            'regex_campo6' => '^(\d{9}|\d{8}|)$',
            'desc_campo7' => 'celular',
            'regex_campo7' => '^(\d{9}|\d{8}|)$',
            'desc_campo8' => 'cep',
            'regex_campo8' => '^(\d{8})$',
            'desc_campo9' => 'endereco',
            'regex_campo9' => '^.{1,40}$',
            'desc_campo10' => 'numero',
            'regex_campo10' => '^[0-9]*$',
            'desc_campo11' => 'complemento',
            'regex_campo11' => '^.{0,40}$',
            'desc_campo12' => 'bairro',
            'regex_campo12' => '^.{1,40}$',
            'desc_campo13' => 'municipio',
            'regex_campo13' => '^.{1,40}$',
            'desc_campo14' => 'uf',
            'regex_campo14' => '^.{2,2}$',
            'desc_campo15' => 'nome',
            'regex_campo15' => '^.{1,40}$',
            'desc_campo16' => 'cpf',
            'regex_campo16' => '^(\d{11}|\d{14})$',
            'desc_campo17' => 'rg',
            'regex_campo17' => '^.{1,40}$',
            'desc_campo18' => 'naturalidade',
            'regex_campo18' => '^.{1,40}$',
            'desc_campo19' => 'nacionalidade',
            'regex_campo19' => '^.{1,40}$',
            'desc_campo20' => 'data_nascimento',
            'regex_campo20' => '^\d{4}-\d{2}-\d{2}$',
        ]);
    }
}
