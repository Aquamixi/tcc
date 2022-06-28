<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('rua')->nullable();
            $table->integer('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('cep')->nullable();
            $table->unsignedBigInteger('uf_id');
            $table->unsignedBigInteger('pai_id');
        });

        Schema::table('enderecos', function (Blueprint $table) {
            $table->foreign('uf_id')->references('id')->on('ufs');
            $table->foreign('pai_id')->references('id')->on('pais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropForeign('enderecos_uf_id_foreign');
            $table->dropForeign('enderecos_pai_id_foreign');
        });

        Schema::dropIfExists('enderecos');
    }
}
