<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissionarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_permissionario_integracao')->unique();
            $table->integer('modalidade_id')->nullable(false);
            $table->string('nome', 40);
            $table->string('tipo', 1)->nullable();//J/F
            $table->string('situacao', 1);//A/I/C
            $table->string('cpf_cnpj', 14)->nullable();
            $table->string('rg', 15)->nullable();
            $table->string('inscricao_municipal', 15)->nullable();
            $table->string('ddd', 2)->nullable();
            $table->string('telefone', 8)->nullable();
            $table->string('telefone2', 9)->nullable();
            $table->string('celular', 9)->nullable();
            $table->string('email', 100)->nullable();
            $table->date('data_nascimento', 100)->nullable();
            $table->string('naturalidade', 15)->nullable();
            $table->string('nacionalidade', 15)->nullable();
            $table->string('cnh', 15)->nullable();
            $table->string('categoria_cnh', 2)->nullable();
            $table->date('vencimento_cnh', 100)->nullable();
            $table->integer('versao');
            $table->timestamps();
            $table->foreign('modalidade_id')->references('id')->on('modalidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissionarios');
    }
}
