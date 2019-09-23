<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostagemTable extends Migration {

    public function up() {
        Schema::create('postagem', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo', 120)->nullable();
            $table->longText('descricao');
            $table->string('imagem', 120);
            $table->enum('ativa', ['S', 'N'])->default('N')->comment = "Se a postagem deve aparecer na home | S = Sim | N = Nao";
            $table->dateTime('publish_at')->nullable();
            $table->unsignedBigInteger('user_inc');
            $table->foreign('user_inc')->references('id')->on('users');
            $table->unsignedBigInteger('user_alt');
            $table->foreign('user_alt')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('postagem');
    }
}
