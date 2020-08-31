<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao',11)->unique();
            $table->string('placa', 7)->nullable();
            $table->string('cod_renavam', 11)->nullable();
            $table->string('chassi', 25)->nullable();
            $table->integer('ano_fabricacao')->nullable();
            $table->integer('ano_modelo')->nullable();
            $table->string('capacidade', 15);
            $table->string('tipo_capacidade', 1);
            $table->string('observacao_capacidade', 40);
            $table->integer('anos_vida_util_veiculo')->nullable();
            $table->string('situacao', 1);//A/I/C
            $table->integer('versao');

            //exclusivo para onibus
            $table->string('prefixo', 15);
            $table->integer('marca_modelo_carroceria_id')->unsigned();
            $table->integer('marca_modelo_chassi_id')->unsigned();

            //
            $table->integer('marca_modelo_veiculo_id')->unsigned();
            $table->integer('tipo_combustivel_id')->unsigned();
            $table->integer('cor_id')->unsigned();
            $table->integer('tipo_veiculo_id')->unsigned();
            $table->integer('permissionario_id')->unsigned();
            $table->integer('categoria_id');

            $table->timestamps();
            $table->foreign('marca_modelo_carroceria_id')->references('id')->on('marcas_modelos_carrocerias');
            $table->foreign('marca_modelo_chassi_id')->references('id')->on('marcas_modelos_chassis');
            $table->foreign('marca_modelo_veiculo_id')->references('id')->on('marcas_modelos_veiculos');
            $table->foreign('tipo_combustivel_id')->references('id')->on('tipos_combustiveis');
            $table->foreign('cor_id')->references('id')->on('cores_veiculos');
            $table->foreign('tipo_veiculo_id')->references('id')->on('tipos_veiculos');
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');
            $table->foreign('categoria_id')->references('id')->on('categorias_veiculos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veiculos');
    }
}
