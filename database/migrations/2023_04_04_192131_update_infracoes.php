<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInfracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::table('infracoes', function (Blueprint $table) {
            $table->string('tipo_pagamento', 20)->nullable();
            $table->string('chave_pix', 200)->nullable();
            $table->string('codigo_pix', 200)->nullable();
            $table->date('data_pagamento')->nullable();
            $table->string('status', 20);//(pendente, pago, cancelado, aguardando_confirmacao)
            $table->string('arquivo_comprovante_uid')->nullable();
            $table->string('data_envio_comprovante')->nullable();         
            $table->double('valor_fmp_atual')->nullable();
            $table->integer('fmp_id')->nullable()->unsigned();
            $table->integer('qtd_fmp')->nullable();
            $table->double('valor_fmp')->nullable();
            $table->double('valor_final')->nullable();
            $table->bigInteger('usuario_pagamento_id')->nullable()->unsigned();
            $table->integer('empresa_id')->unsigned();
            
            $table->foreign('usuario_pagamento_id')->references('id')->on('usuarios');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('fmp_id')->references('id')->on('fmp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('infracoes', function (Blueprint $table) {
            $table->dropColumn('tipo_pagamento');
            $table->dropColumn('chave_pix');
            $table->dropColumn('codigo_pix');
            $table->dropColumn('data_pagamento');
            $table->dropColumn('status');
            $table->dropColumn('arquivo_comprovante_uid');
            $table->dropColumn('data_envio_comprovante');
            $table->dropColumn('valor_fmp_atual');
            $table->dropColumn('fmp_id');
            $table->dropColumn('qtd_fmp');
            $table->dropColumn('valor_fmp');
            $table->dropColumn('valor_final');
            $table->dropColumn('usuario_pagamento_id');
            $table->dropColumn('empresa_id');

            $table->dropForeign('infrações_usuario_pagamento_id_foreign');
            $table->dropForeign('infrações_empresa_id_foreign');
            $table->dropForeign('infrações_fmp_id_foreign');
        });
    }
}
