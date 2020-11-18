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
        ////////////////////////////////////
        ///////////////// CONDUTOR
        ///////////////////////////////////
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
            'regex_campo7' => '^.{2,2}$',
            'desc_arquivo1' => 'Comprovante de Endereço',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '3',
            'nome' => 'condutor_identidade',
            'nome_campo1' => 'Nome',
            'desc_campo1' => 'nome',
            'regex_campo1' => '^.{1,40}$',
            'nome_campo2' => 'CPF',
            'desc_campo2' => 'cpf/cnpj',
            'regex_campo2' => '^(\d{11}|\d{14})$',
            'nome_campo3' => 'RG',
            'desc_campo3' => 'rg',
            'regex_campo3' => '^.{1,15}$',
            'desc_arquivo1' => 'Comprovante de Identidade',
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
            'desc_arquivo1' => 'Comprovante de CNH',
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
            'regex_campo10' => '^.{1,5}$',
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
            'desc_arquivo1' => 'Comprovante de CNH',
            'desc_arquivo2' => 'Comprovante de Residência',
            'desc_arquivo3' => 'Foto do Condutor',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '6',
            'nome' => 'condutor_foto',
            'desc_arquivo1' => 'Foto do Condutor',
        ]);
        ////////////////////////////////////
        ///////////////// PERMISSIONARIO
        ///////////////////////////////////
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '10',
            'nome' => 'permissionario_contato',
            'nome_campo1' => 'Email',
            'desc_campo1' => 'email',
            'regex_campo1' => '^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$',
            'nome_campo2' => 'DDD',
            'desc_campo2' => 'ddd',
            'regex_campo2' => '^\d{2}$',
            'nome_campo3' => 'Telefone',
            'desc_campo3' => 'telefone',
            'regex_campo3' => '^(\d{9}|\d{8}|)$',
            'nome_campo4' => 'Recados',
            'desc_campo4' => 'telefone de recados',
            'regex_campo4' => '^(\d{9}|\d{8}|)$',
            'nome_campo5' => 'Celular',
            'desc_campo5' => 'celular',
            'regex_campo5' => '^(\d{9}|\d{8}|)$',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '11',
            'nome' => 'permissionario_endereco',
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
            'regex_campo7' => '^.{2,2}$',
            'desc_arquivo1' => 'Comprovante de Endereço',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '12',
            'nome' => 'permissionario_identidade',
            'nome_campo1' => 'Nome',
            'desc_campo1' => 'nome',
            'regex_campo1' => '^.{1,40}$',
            'nome_campo2' => 'CPF',
            'desc_campo2' => 'cpf/cnpj',
            'regex_campo2' => '^(\d{11}|\d{14})$',
            'nome_campo3' => 'RG',
            'desc_campo3' => 'rg',
            'regex_campo3' => '^.{1,15}$',
            'nome_campo4' => 'DataNascimento',
            'desc_campo4' => 'Data de Nascimento',
            'regex_campo4' => '^\d{4}-\d{2}-\d{2}$',
            'nome_campo5' => 'Naturalidade',
            'desc_campo5' => 'naturalidade',
            'regex_campo5' => '^.{1,15}$',
            'nome_campo6' => 'Nacionalidade',
            'desc_campo6' => 'nacionalidade',
            'regex_campo6' => '^.{1,15}$',
            'desc_arquivo1' => 'Comprovante de Identificação',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '13',
            'nome' => 'permissionario_cnh',
            'nome_campo1' => 'CNH',
            'desc_campo1' => 'cnh',
            'regex_campo1' => '^(\d{11})$',
            'nome_campo2' => 'CategoriaCNH',
            'desc_campo2' => 'categoria da CNH',
            'regex_campo2' => '^.{1,3}$',
            'nome_campo3' => 'ValidadeCNH',
            'desc_campo3' => 'vencimento da CNH',
            'regex_campo3' => '^\d{4}-\d{2}-\d{2}$',
            'desc_arquivo1' => 'Comprovante de CNH',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '14',
            'nome' => 'permissionario_foto',
            'desc_arquivo1' => 'Foto do Permissionário',
        ]);
        ////////////////////////////////////
        ///////////////// MONITORES
        ///////////////////////////////////
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '20',
            'nome' => 'monitor_contato',
            'nome_campo1' => 'Email',
            'desc_campo1' => 'email',
            'regex_campo1' => '^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$',
            'nome_campo2' => 'Telefone',
            'desc_campo2' => 'telefone',
            'regex_campo2' => '^(\d{9}|\d{8}|)$',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '21',
            'nome' => 'monitor_endereco',
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
            'regex_campo7' => '^.{2,2}$',
            'desc_arquivo1' => 'Comprovante de Endereço',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '22',
            'nome' => 'monitor_identidade',
            'nome_campo1' => 'Nome',
            'desc_campo1' => 'nome',
            'regex_campo1' => '^.{1,40}$',
            'nome_campo2' => 'CPF',
            'desc_campo2' => 'cpf',
            'regex_campo2' => '^(\d{11})$',
            'nome_campo3' => 'RG',
            'desc_campo3' => 'rg',
            'regex_campo3' => '^.{1,15}$',
            'nome_campo4' => 'DataNascimento',
            'desc_campo4' => 'Data de Nascimento',
            'regex_campo4' => '^\d{4}-\d{2}-\d{2}$',
            'desc_arquivo1' => 'Comprovante de Identidade',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '23',
            'nome' => 'monitor_cadastro',
            'nome_campo1' => 'Email',
            'desc_campo1' => 'email',
            'regex_campo1' => '^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$',
            'nome_campo2' => 'Telefone',
            'desc_campo2' => 'telefone',
            'regex_campo2' => '^(\d{9}|\d{8}|)$',
            'nome_campo3' => 'CEP',
            'desc_campo3' => 'cep',
            'regex_campo3' => '^(\d{8})$',
            'nome_campo4' => 'Endereco',
            'desc_campo4' => 'endereco',
            'regex_campo4' => '^.{1,40}$',
            'nome_campo5' => 'Numero',
            'desc_campo5' => 'numero',
            'regex_campo5' => '^.{1,5}$',
            'nome_campo6' => 'Complemento',
            'desc_campo6' => 'complemento',
            'regex_campo6' => '^.{0,15}$',
            'nome_campo7' => 'Bairro',
            'desc_campo7' => 'bairro',
            'regex_campo7' => '^.{1,100}$',
            'nome_campo8' => 'Municipio',
            'desc_campo8' => 'municipio',
            'regex_campo8' => '^.{1,25}$',
            'nome_campo9' => 'UF',
            'desc_campo9' => 'uf',
            'regex_campo9' => '^.{2,2}$',
            'nome_campo10' => 'Nome',
            'desc_campo10' => 'nome',
            'regex_campo10' => '^.{1,40}$',
            'nome_campo11' => 'CPF',
            'desc_campo11' => 'cpf',
            'regex_campo11' => '^(\d{11})$',
            'nome_campo12' => 'RG',
            'desc_campo12' => 'rg',
            'regex_campo12' => '^.{1,15}$',
            'nome_campo13' => 'DataNascimento',
            'desc_campo13' => 'Data de Nascimento',
            'regex_campo13' => '^\d{4}-\d{2}-\d{2}$',
            'desc_arquivo1' => 'Comprovante de Identidade',
            'desc_arquivo2' => 'Comprovante de Residência',
            'desc_arquivo3' => 'Foto do Monitor',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '24',
            'nome' => 'monitor_foto',
            'desc_arquivo1' => 'Foto do Monitor',
        ]);
        ////////////////////////////////////
        ///////////////// FISCAL
        ///////////////////////////////////
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '30',
            'nome' => 'fiscal_contato',
            'nome_campo1' => 'Email',
            'desc_campo1' => 'email',
            'regex_campo1' => '^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$',
            'nome_campo3' => 'Telefone',
            'desc_campo3' => 'telefone',
            'regex_campo3' => '^(\d{9}|\d{8}|)$',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '31',
            'nome' => 'fiscal_endereco',
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
            'regex_campo7' => '^.{2,2}$',
            'desc_arquivo1' => 'Comprovante de Endereço',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '32',
            'nome' => 'fiscal_identidade',
            'nome_campo1' => 'Nome',
            'desc_campo1' => 'nome',
            'regex_campo1' => '^.{1,40}$',
            'nome_campo2' => 'CPF',
            'desc_campo2' => 'cpf',
            'regex_campo2' => '^(\d{11})$',
            'desc_arquivo1' => 'Comprovante de Identificação',
        ]);
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '33',
            'nome' => 'fiscal_foto',
            'desc_arquivo1' => 'Foto do Fiscal',
        ]);
        ////////////////////////////////////
        ///////////////// VEICULO
        ///////////////////////////////////
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '40',
            'nome' => 'veiculo',
            'nome_campo1' => 'Placa',
            'desc_campo1' => 'placa',
            'regex_campo1' => '^.{7,7}$',
            'nome_campo2' => 'CodRenavam',
            'desc_campo2' => 'código renavam',
            'regex_campo2' => '^(\d{11})$',
            'nome_campo3' => 'CodMarcaModelo',
            'desc_campo3' => 'marca modelo do veículo',
            'regex_campo3' => '^(\d+)$',
            'nome_campo4' => 'Chassis',
            'desc_campo4' => 'chassi',
            'regex_campo4' => '^.{1,25}$',
            'nome_campo5' => 'CodCombustivel',
            'desc_campo5' => 'tipo de combustivel',
            'regex_campo5' => '^(\d+)$',
            'nome_campo6' => 'AnoFabricacao',
            'desc_campo6' => 'ano de fabricação',
            'regex_campo6' => '^\d{4}$',
            'nome_campo7' => 'AnoModelo',
            'desc_campo7' => 'ano do modelo',
            'regex_campo7' => '^\d{4}$',
            'nome_campo8' => 'CodCor',
            'desc_campo8' => 'cor',
            'regex_campo8' => '^(\d+)$',
            'nome_campo9' => 'TipoVeiculo',
            'desc_campo9' => 'tipo do veículo',
            'regex_campo9' => '^(\d+)$',
            'nome_campo10' => 'Capacidade',
            'desc_campo10' => 'capacidade',
            'regex_campo10' => '^.{1,15}$',
            'nome_campo11' => 'TipoCapacidade',
            'desc_campo11' => 'tipo da capacidade',
            'regex_campo11' => '^.{1,1}$',
            'nome_campo12' => 'ObservacaoCapacidade',
            'desc_campo12' => 'observação sobre a capacidade',
            'regex_campo12' => '^.{0,40}$',
            'nome_campo13' => 'AnosVidaUtilVeiculo',
            'desc_campo13' => 'anos de vida útil do veículo',
            'regex_campo13' => '^(\d+)$',
            'desc_arquivo1' => 'Documento do Veículo',
        ]);
        ////////////////////////////////////
        ///////////////// ONIBUS
        ///////////////////////////////////
        DB::table('tipos_solicitacao_de_alteracao')->insert([
            'id' => '50',
            'nome' => 'onibus',
            'nome_campo1' => 'Placa',
            'desc_campo1' => 'placa',
            'regex_campo1' => '^.{7,7}$',
            'nome_campo2' => 'CodRenavam',
            'desc_campo2' => 'código renavam',
            'regex_campo2' => '^(\d{11})$',
            'nome_campo3' => 'CodMarcaModeloCarroceria',
            'desc_campo3' => 'marca modelo da carroceria',
            'regex_campo3' => '^(\d+)$',
            'nome_campo4' => 'CodMarcaModeloChassis',
            'desc_campo4' => 'marca modelo do chassi',
            'regex_campo4' => '^(\d+)$',
            'nome_campo5' => 'Chassis',
            'desc_campo5' => 'chassi',
            'regex_campo5' => '^.{1,25}$',
            'nome_campo6' => 'CodCombustivel',
            'desc_campo6' => 'tipo de combustivel',
            'regex_campo6' => '^(\d+)$',
            'nome_campo7' => 'AnoFabricacao',
            'desc_campo7' => 'ano de fabricação',
            'regex_campo7' => '^\d{4}$',
            'nome_campo8' => 'AnoModelo',
            'desc_campo8' => 'ano do modelo',
            'regex_campo8' => '^\d{4}$',
            'nome_campo9' => 'CodCor',
            'desc_campo9' => 'cor',
            'regex_campo9' => '^(\d+)$',
            'nome_campo10' => 'Capacidade',
            'desc_campo10' => 'capacidade',
            'regex_campo10' => '^.{0,15}$',
            'nome_campo11' => 'Prefixo',
            'desc_campo11' => 'prefixo',
            'regex_campo11' => '^(\d+)$',
            'desc_arquivo1' => 'Documento do Veículo',
        ]);
    }
}