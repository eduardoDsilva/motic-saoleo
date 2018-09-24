<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('notaUm')->unsigned();
            $table->bigInteger('notaDois')->unsigned();
            $table->bigInteger('notaTres')->unsigned();
            $table->bigInteger('notaQuatro')->unsigned();
            $table->bigInteger('notaCinco')->unsigned();
            $table->bigInteger('notaSeis')->unsigned();
            $table->bigInteger('notaSete')->unsigned();
            $table->bigInteger('notaFinal')->unsigned();
            $table->longText('observacoes')->nullable();
            $table->integer('votacao_popular')->nullable();
            $table->unsignedInteger('projeto_id');
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('cascade');
            $table->unsignedInteger('avaliador_id');
            $table->foreign('avaliador_id')->references('id')->on('avaliadores')->onDelete('cascade');
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
        Schema::dropIfExists('notas');
    }
}