<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPerfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perfis', function (Blueprint $table) {
            $table->dropColumn('incluir');
            $table->dropColumn('alterar');
            $table->dropColumn('excluir');
            $table->dropColumn('consultar');
            $table->dropColumn('imprimir');

            $table->boolean('cadastro_usuario')->nullable();
            $table->boolean('cadastro_perfil')->nullable();
            $table->boolean('cadastro_principais')->nullable();
            $table->boolean('cadastro_tabelas_base')->nullable();
            $table->boolean('lancamentos')->nullable();
            $table->boolean('impressos')->nullable();
            $table->boolean('relatorios')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::alter('perfis', function (Blueprint $table) {
            $table->boolean('incluir')->default(false);
            $table->boolean('alterar')->default(false);
            $table->boolean('excluir')->default(false);
            $table->boolean('consultar')->default(false);
            $table->boolean('imprimir')->default(false);

            $table->boolean('cadastro_usuario')->default(false)->change();
            $table->boolean('cadastro_perfil')->default(false)->change();
            $table->boolean('cadastro_principais')->default(false)->change();
            $table->boolean('cadastro_tabelas_base')->default(false)->change();
            $table->boolean('lancamentos')->default(false)->change();
            $table->boolean('impressos')->default(false)->change();
            $table->boolean('relatorios')->default(false)->change();
        });
    }
}