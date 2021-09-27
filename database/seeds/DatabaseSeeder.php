<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ModalidadeSeeder::class);
        $this->call(TiposDeUsuariosSeeder::class);
        $this->call(CategoriasVeiculosSeeder::class);
        $this->call(TiposSolicitacaoDeAlteracaoSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EntidadeAssociativaSeeder::class);
        $this->call(AplicativoSeeder::class);

        //$this->call(UserSeeder::class);
        /*DB::table('users')->insert([
            'nome' => 'teste',
            'cpf_cnpj' => '000',
            'cnh' => '123',
            'email' => 'teste@teste.com',
            'password' => Hash::make('123456'),
        ]);*/

        for($i = 0;$i < 100;$i++){
            DB::table('municipios')->insert([
                'nome' => "Municipio RJ $i",
                'uf' => 'RJ',
            ]);
        }

        for($i = 0;$i < 100;$i++){
            DB::table('municipios')->insert([
                'nome' => "Municipio MG $i",
                'uf' => 'MG',
            ]);
        }

        for($i = 0;$i < 100;$i++){
            DB::table('pontos')->insert([
                'descricao' => "Ponto $i",
                'base_legal' => 'teste',
                'capacidade_legal' => 'teste'
            ]);
        }

        for($i = 0;$i < 10;$i++){
            DB::table('aplicativos')->insert([
                'descricao' => "Aplicativo $i",
            ]);
        }

        for($i = 0;$i < 3;$i++){
            DB::table('tipos_de_curso')->insert([
                'descricao' => "Tipo de Curso $i",
            ]);
        }

        // DEMONSTRACAO
        //permissionario
        DB::table('enderecos')->insert([
            'cep' => '27777-000',
            'endereco' => 'Endereco Teste',
            'numero' => '123',
            'bairro' => 'Bairro',
            'uf' => 'RJ',
            'municipio_id' => 1,
        ]);
        DB::table('enderecos')->insert([
            'cep' => '27777-000',
            'endereco' => 'Endereco Teste2',
            'numero' => '123',
            'bairro' => 'Bairro',
            'uf' => 'RJ',
            'municipio_id' => 1,
        ]);

        DB::table('cores_veiculos')->insert([
            'descricao' => 'Verde',
            'id_integracao' => '321'
        ]);

        DB::table('marcas_modelos_veiculos')->insert([
            'descricao' => 'City',
            'id_integracao' => '321'
        ]);

        DB::table('permissionarios')->insert([
            'nome_razao_social' => 'teste',
            'tipo' => '1',
            'cpf_cnpj' => '67958010800',
            'cnh' => '123',
        ]);

        DB::table('usuarios')->insert([
            'nome' => 'Admin',
            'email' => 'teste2@teste.com',
            'permissionario_id' => 1,
            'tipo_id' => 1,
            'password' => bcrypt('123456'),
        ]);

        DB::table('veiculos')->insert([
            'situacao' => 'A',
            'placa' => 'AAA2211',
            'cod_renavam' => '321',
            'ano_modelo' => '2010',
            'permissionario_id' => 1,
            'categoria_id' => 1,
            'marca_modelo_veiculo_id' => 1,
            'cor_id' => 1,
            'versao' => 0,
        ]);

        DB::table('condutores')->insert([
            //'situacao' => 'A',
            'nome' => 'Fulano',
            'permissionario_id' => 1,
            'endereco_id' => 1,
            //'versao' => 0,
        ]);

        DB::table('monitores')->insert([
            //'situacao' => 'A',
            'nome' => 'Fulano Monitor',
            'permissionario_id' => 1,
            'endereco_id' => 2,
            //'versao' => 0,
        ]);


    }
}
