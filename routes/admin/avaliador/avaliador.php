<?php

Route::group(['prefix' => 'admin/avaliador', 'namespace' => 'Admin\Avaliador'], function () {

    Route::get('/', ['as' => 'admin.avaliador', 'uses' => 'AdminAvaliadorController@index']);

    Route::get('show/{id}', ['as' => 'admin.avaliador.show', 'uses' => 'AdminAvaliadorController@show']);

    Route::get('avaliador/destroy/{id}', ['as' => 'admin.avaliador.destroy', 'uses' => 'AdminAvaliadorController@destroy']);

    Route::get('edit/{id}', ['as' => 'admin.avaliador.edit', 'uses' => 'AdminAvaliadorController@edit']);

    Route::get('create', ['as' => 'admin.avaliador.create', 'uses' => 'AdminAvaliadorController@create']);

    Route::post('update/{id}', ['as' => 'admin.avaliador.update', 'uses' => 'AdminAvaliadorController@update']);

    Route::any('filtrar', ['as' => 'admin.avaliador.filtrar', 'uses' => 'AdminAvaliadorController@filtrar']);

    Route::post('store', ['as' => 'admin.avaliador.store', 'uses' => 'AdminAvaliadorController@store']);

    Route::get('relatorios', ['as' => 'admin.avaliador.relatorios', 'uses' => 'AdminAvaliadorRelatorioController@index']);

    Route::get('vincular-projetos/{id}', ['as' => 'admin.avaliador.vincular-projetos', 'uses' => 'AdminAvaliadorController@vincularProjetos']);

    Route::get('desvincular-projetos/{id}', ['as' => 'admin.avaliador.desvincular-projetos', 'uses' => 'AdminAvaliadorController@desvincularProjetos']);

    Route::get('vincula-projetos/{id}', ['as' => 'admin.avaliador.desvincula-projetos', 'uses' => 'AdminAvaliadorController@desvinculaProjetos']);

    Route::post('vincula-projetos', ['as' => 'admin.avaliador.vincula-projetos', 'uses' => 'AdminAvaliadorController@vinculaProjetos']);

    Route::get('avaliadores-projetos', ['as' => 'admin.avaliador.avaliador-projetos', 'uses' => 'AdminAvaliadorRelatorioController@avaliadorProjetos']);

    Route::get('todos-avaliadores', ['as' => 'admin.avaliador.todos-avaliadores', 'uses' => 'AdminAvaliadorRelatorioController@todosAvaliadores']);

    Route::get('avaliador-individual/{id}', ['as' => 'admin.avaliador.avaliador-individual', 'uses' => 'AdminAvaliadorRelatorioController@avaliadorIndividual']);

    Route::post('filtrar/avaliador-individual', ['as' => 'admin.avaliador.relatorios.filtrar', 'uses' => 'AdminAvaliadorRelatorioController@filtrar']);

    Route::get('avaliador-individual-projetos/{id}', ['as' => 'admin.avaliador.relatorios.projetos-avaliador', 'uses' => 'AdminAvaliadorRelatorioController@avaliadorIndividualProjetos']);

});
