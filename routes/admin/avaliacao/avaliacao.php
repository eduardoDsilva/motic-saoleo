<?php

Route::group(['prefix' => 'admin/avaliacao', 'namespace' => 'Admin\Avaliacao'], function () {

    Route::get('classificacao', ['as' => 'admin.avaliacao.classificacao', 'uses' => 'AdminAvaliacaoController@classificacao']);

    Route::get('classificacao-popular', ['as' => 'admin.avaliacao.classificacao-popular', 'uses' => 'AdminAvaliacaoController@classificacaoPopular']);

    Route::get('calcular-notas', ['as' => 'admin.avaliacao.calcular-notas', 'uses' => 'AdminAvaliacaoController@calcularNotas']);

    Route::get('projetos-avaliados', ['as' => 'admin.avaliacao.projetos-avaliados', 'uses' => 'AdminAvaliacaoController@projetosAvaliados']);

    Route::get('projetos-nao-avaliados', ['as' => 'admin.avaliacao.projetos-nao-avaliados', 'uses' => 'AdminAvaliacaoController@projetosNaoAvaliados']);

    Route::post('retorna-classificacao', ['as' => 'admin.avaliacao.retorna-classificacao', 'uses' => 'AdminAvaliacaoController@retornaClassificacao']);

    Route::any('filtro', ['as' => 'admin.avaliacao.filtro', 'uses' => 'AdminAvaliacaoController@filtro']);
});