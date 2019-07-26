<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) { //Blueprint gera um objeto tipo $table para rodar todos os codigos dentro desse $Schema para transformar PHP em SQL
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('nivel_user'); // vai dizer o nivel de acesso
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('img',292)->nullable(); //vai dizer onde está hospedada a url
            $table->string('provider')->nullable(); //vai dizer qual rede social o usuário logou
            $table->biginteger('provider_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
