<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->text('comentario')->nullable();
            $table->date('data_comentario');
            $table->boolean('curtida');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('receita_id');
        });

        Schema::table('comentarios', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('comentarios', function (Blueprint $table) {
            $table->dropForeign('comentarios_user_id_foreign');
            $table->dropForeign('comentarios_receita_id_foreign');
        });

        Schema::dropIfExists('comentarios');
    }
}
