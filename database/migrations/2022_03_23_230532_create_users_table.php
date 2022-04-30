<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('endereco_id')->nullable()->unique();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('telefone')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->date('first_login')->nullable();
            $table->string('genero')->nullable();
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('endereco_id')->references('id')->on('enderecos');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_endereco_id_foreign');
        });

        Schema::dropIfExists('users');
    }
}
