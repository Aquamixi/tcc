<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceitaGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receita_grupos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('receita_id');
        });

        Schema::table('receita_grupos', function (Blueprint $table) {
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('receita_id')->references('id')->on('receitas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receita_grupos', function (Blueprint $table) {
            $table->dropForeign('receita_grupos_receita_id_foreign');
            $table->dropForeign('receita_grupos_usuario_id_foreign');
        });

        Schema::dropIfExists('receita_grupos');
    }
};
