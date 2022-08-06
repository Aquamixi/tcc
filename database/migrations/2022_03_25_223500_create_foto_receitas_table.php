<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoReceitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_receitas', function (Blueprint $table) {
            $table->id();
            $table->string('anexo')->nullable();
            $table->unsignedBigInteger('receita_id');
        });

        Schema::table('foto_receitas', function (Blueprint $table) {
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
        Schema::table('foto_receitas', function (Blueprint $table) {
            $table->dropForeign('foto_receitas_receita_id_foreign');
        });

        Schema::dropIfExists('foto_receitas');
    }
}
