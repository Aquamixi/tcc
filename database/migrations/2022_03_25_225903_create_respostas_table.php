<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respostas', function (Blueprint $table) {
            $table->id();
            $table->text('resposta')->nullable();
            $table->dateTime('data_resposta');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('comentario_id');
        });

        Schema::table('respostas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('comentario_id')->references('id')->on('comentarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('respostas', function (Blueprint $table) {
            $table->dropForeign('respostas_user_id_foreign');
            $table->dropForeign('respostas_comentario_id_foreign');
        });

        Schema::dropIfExists('respostas');
    }
}
