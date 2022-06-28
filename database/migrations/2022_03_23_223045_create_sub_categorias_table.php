<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categorias', function (Blueprint $table) {
            $table->id();
            $table->string('sub_categoria')->nullable();
            $table->unsignedBigInteger('categoria_id');
        });

        Schema::table('sub_categorias', function (Blueprint $table){
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_categorias', function (Blueprint $table) {
            $table->dropForeign('sub_categorias_categoria_id_foreign');
        });

        Schema::dropIfExists('sub_categorias');
    }
}
