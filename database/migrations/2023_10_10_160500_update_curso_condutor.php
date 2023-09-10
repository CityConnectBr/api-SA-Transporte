<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCursoCondutor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cursos_do_monitor', function (Blueprint $table) {
            if (!Schema::hasColumn('cursos_do_monitor', 'data_validade')) {
                $table->date('data_validade')->nullable();
            }

            // Verifique se a coluna 'nome' não existe antes de criar
            if (!Schema::hasColumn('cursos_do_monitor', 'nome')) {
                $table->string('nome', 100)->nullable();
            }

            // Verifique se a coluna 'descricao' não existe antes de criar
            if (!Schema::hasColumn('cursos_do_monitor', 'descricao')) {
                $table->string('descricao', 150)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cursos_do_monitor', function (Blueprint $table) {
            $table->dropColumn('data_validade');
            $table->dropColumn('nome');
            $table->dropColumn('descricao');
        });
    }
}