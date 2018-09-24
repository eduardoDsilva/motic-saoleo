<?php

Route::group(['prefix' => 'admin/suplente', 'namespace' => 'Admin\Suplente'], function () {

    Route::get('/', ['as' => 'admin.suplente', 'uses' => 'AdminSuplenteController@index']);

    Route::get('show/{id}', ['as' => 'admin.suplente.show', 'uses' => 'AdminSuplenteController@show']);

    Route::get('destroy/{id}', ['as' => 'admin.suplente.destroy', 'uses' => 'AdminSuplenteController@destroy']);

    Route::get('edit/{id}', ['as' => 'admin.suplente.edit', 'uses' => 'AdminSuplenteController@edit']);

    Route::get('create', ['as' => 'admin.suplente.create', 'uses' => 'AdminSuplenteController@create']);

    Route::get('promove/{id}', ['as' => 'admin.suplente.promove', 'uses' => 'AdminSuplenteController@promoveSuplente']);

    Route::post('update/{id}', ['as' => 'admin.suplente.update', 'uses' => 'AdminSuplenteController@update']);

    Route::any('filtrar', ['as' => 'admin.suplente.filtrar', 'uses' => 'AdminSuplenteController@filtrar']);

    Route::post('store', ['as' => 'admin.suplente.store', 'uses' => 'AdminSuplenteController@store']);

    Route::get('relatorios', ['as' => 'admin.suplente.relatorios', 'uses' => 'AdminSuplenteRelatorioController@index']);

    Route::get('relatorios/todos-projetos', ['as' => 'admin.suplente.relatorios.todos-projetos', 'uses' => 'AdminSuplenteRelatorioController@todosProjetos']);

    Route::get('relatorios/categoria-projetos/{id}', ['as' => 'admin.suplente.relatorios.categoria-projetos', 'uses' => 'AdminSuplenteRelatorioController@categoriaProjetos']);

    Route::get('relatorios/projeto-individual/{id}', ['as' => 'admin.suplente.relatorios.projeto-individual', 'uses' => 'AdminSuplenteRelatorioController@projetoIndividual']);

    Route::any('relatorios/filtro/projetos', ['as' => 'admin.suplente.relatorios.filtro-projetos', 'uses' => 'AdminSuplenteRelatorioController@filtroProjetos']);
});
Route::get('/json-categorias-suplente', 'Admin\Suplente\AdminSuplenteController@categorias');

Route::get('/json-alunos', 'Admin\Suplente\AdminSuplenteController@alunos');

Route::get('/json-professores', 'Admin\Suplente\AdminSuplenteController@professores');