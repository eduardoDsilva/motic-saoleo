<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuplentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suplentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 100);
            $table->string('area', 100);
            $table->string('estande', 50)->nullable();
            $table->longText('resumo');
            $table->integer('ano')->default(date('Y'));

            $table->unsignedInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            $table->unsignedInteger('escola_id');
            $table->foreign('escola_id')->references('id')->on('escolas')->onDelete('cascade');

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
        Schema::dropIfExists('projetos');
    }
}