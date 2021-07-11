<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertidoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certidoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao',11)->nullable()->unique();
            $table->string('ano',4);
            $table->date('data');
            $table->string('renavam', 11)->nullable();
            $table->string('placa', 7)->nullable();
            $table->string('ano_fabricacao', 4)->nullable();
            $table->string('chassis', 25)->nullable();
            $table->string('prefixo', 15)->nullable();

            $table->integer('marca_modelo_veiculo_id')->nullable()->unsigned();
            $table->integer('tipo_de_certidao_id')->nullable()->unsigned();
            $table->integer('permissionario_id')->nullable()->unsigned();
            $table->integer('chassis_id')->nullable()->unsigned();
            $table->integer('tipo_combustivel_id')->nullable()->unsigned();
            $table->integer('cor_id')->nullable()->unsigned();
            $table->integer('ponto_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('tipo_de_certidao_id')->references('id')->on('tipos_de_certidao');
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');
            $table->foreign('marca_modelo_veiculo_id')->references('id')->on('marcas_modelos_veiculos');
            $table->foreign('chassis_id')->references('id')->on('marcas_modelos_chassis');
            $table->foreign('tipo_combustivel_id')->references('id')->on('tipos_combustiveis');
            $table->foreign('cor_id')->references('id')->on('cores_veiculos');
            $table->foreign('ponto_id')->references('id')->on('pontos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certidoes');
    }
}
