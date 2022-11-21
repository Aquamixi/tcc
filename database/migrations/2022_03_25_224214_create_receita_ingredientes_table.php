<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceitaIngredientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receita_ingredientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receita_id');
            $table->text('ingrediente');
        });

        Schema::table('receita_ingredientes', function (Blueprint $table) {
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
        Schema::table('receita_ingredientes', function (Blueprint $table) {
            $table->dropForeign('receita_ingredientes_receita_id_foreign');
        });

        Schema::dropIfExists('receita_ingredientes');
    }
}
