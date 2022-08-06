<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_receita')->nullable();
            $table->text('modo_preparo')->nullable();
            $table->string('tempo_preparo')->nullable();
            $table->integer('qtde_porcoes')->nullable();
            $table->integer('qtde_curtidas')->nullable();
            $table->integer('qtde_comentarios')->nullable();
            $table->integer('qtde_compartilhamentos')->nullable();
            $table->float('avaliacao')->nullable();
            $table->date('data_postagem');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sabor_id');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('velocidade_id');
        });

        Schema::table('receitas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sabor_id')->references('id')->on('sabors');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('velocidade_id')->references('id')->on('velocidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receitas', function (Blueprint $table) {
            $table->dropForeign('receitas_user_id_foreign');
            $table->dropForeign('receitas_sabor_id_foreign');
            $table->dropForeign('receitas_categoria_id_foreign');
            $table->dropForeign('receitas_velocidade_id_foreign');
        });

        Schema::dropIfExists('receitas');
    }
}
