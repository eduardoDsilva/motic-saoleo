<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('historicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 100);
            $table->string('area', 100);
            $table->string('estande', 50)->nullable();
            $table->longText('resumo');
            $table->integer('ano')->default(date('Y'));
            $table->enum('tipo', ['normal', 'suplente'])->default('normal');
            $table->bigInteger('notaUm')->unsigned();
            $table->bigInteger('notaDois')->unsigned();
            $table->bigInteger('notaTres')->unsigned();
            $table->bigInteger('notaQuatro')->unsigned();
            $table->bigInteger('notaCinco')->unsigned();
            $table->bigInteger('notaFinal')->unsigned();
            $table->longText('observacoes')->nullable();

            $table->unsignedInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            $table->unsignedInteger('escola_id');
            $table->foreign('escola_id')->references('id')->on('escolas')->onDelete('cascade');

            $table->unsignedInteger('orientador_id');
            $table->foreign('orientador_id')->references('id')->on('professores');

            $table->unsignedInteger('coorientador_id');
            $table->foreign('coorientador_id')->references('id')->on('professores');

            $table->unsignedInteger('primeiro_aluno_id');
            $table->foreign('primeiro_aluno_id')->references('id')->on('alunos');

            $table->unsignedInteger('segundo_aluno_id');
            $table->foreign('segundo_aluno_id')->references('id')->on('alunos');

            $table->unsignedInteger('terceiro_aluno_id');
            $table->foreign('terceiro_aluno_id')->references('id')->on('alunos');

            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('historicos');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
