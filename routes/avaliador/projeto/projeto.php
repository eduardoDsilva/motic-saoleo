<?php

Route::group(['prefix' => 'avaliador/projeto', 'namespace' => 'Avaliador\Projeto'], function () {

    Route::get('/', ['as' => 'avaliador.projeto', 'uses' => 'AvaliadorProjetoController@index']);

    Route::get('/avaliar/{id}', ['as' => 'avaliador.projeto.avaliar', 'uses' => 'AvaliadorProjetoController@avaliar']);

    Route::get('/editar-avaliacao/{id}', ['as' => 'avaliador.projeto.editar-avaliacao', 'uses' => 'AvaliadorProjetoController@editarAvaliacao']);

    Route::post('/avaliacao', ['as' => 'avaliador.projeto.avaliacao', 'uses' => 'AvaliadorProjetoController@avaliacao']);

    Route::post('/edita-avaliacao', ['as' => 'avaliador.projeto.edita-avaliacao', 'uses' => 'AvaliadorProjetoController@editaAvaliacao']);


});