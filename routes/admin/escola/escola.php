<?php

Route::group(['prefix' => 'admin/escola', 'namespace' => 'Admin\Escola'], function () {

    Route::get('/', ['as' => 'admin.escola', 'uses' => 'AdminEscolaController@index']);

    Route::get('show/{id}', ['as' => 'admin.escola.show', 'uses' => 'AdminEscolaController@show']);

    Route::get('destroy/{id}', ['as' => 'admin.escola.destroy', 'uses' => 'AdminEscolaController@destroy']);

    Route::get('edit/{id}', ['as' => 'admin.escola.edit', 'uses' => 'AdminEscolaController@edit']);

    Route::get('create', ['as' => 'admin.escola.create', 'uses' => 'AdminEscolaController@create']);

    Route::post('update/{id}', ['as' => 'admin.escola.update', 'uses' => 'AdminEscolaController@update']);

    Route::any('filtrar', ['as' => 'admin.escola.filtrar', 'uses' => 'AdminEscolaController@filtrar']);

    Route::post('store', ['as' => 'admin.escola.store', 'uses' => 'AdminEscolaController@store']);

    Route::get('relatorios', ['as' => 'admin.escola.relatorios', 'uses' => 'AdminEscolaRelatorioController@index']);

    Route::get('relatorios/todas-escolas', ['as' => 'admin.escola.relatorios.todas.escolas', 'uses' => 'AdminEscolaRelatorioController@todasEscolas']);

    Route::any('relatorios/filtrar', ['as' => 'admin.escola.relatorios.filtrar', 'uses' => 'AdminEscolaRelatorioController@filtro']);

    Route::get('relatorios/escola-individual/{id}', ['as' => 'admin.escola.relatorios.escola-individual', 'uses' => 'AdminEscolaRelatorioController@escolaIndividual']);

    Route::get('relatorios/escola-avaliadores', ['as' => 'admin.escola.relatorios.escola-avaliador', 'uses' => 'AdminEscolaRelatorioController@escolaAvaliadores']);

});