<?php

Route::group(['prefix' => 'admin/professor', 'namespace' => 'Admin\Professor'], function () {

    Route::get('/', ['as' => 'admin.professor', 'uses' => 'AdminProfessorController@index']);

    Route::get('show/{id}', ['as' => 'admin.professor.show', 'uses' => 'AdminProfessorController@show']);

    Route::get('destroy/{id}', ['as' => 'admin.professor.destroy', 'uses' => 'AdminProfessorController@destroy']);

    Route::get('edit/{id}', ['as' => 'admin.professor.edit', 'uses' => 'AdminProfessorController@edit']);

    Route::get('create', ['as' => 'admin.professor.create', 'uses' => 'AdminProfessorController@create']);

    Route::post('update/{id}', ['as' => 'admin.professor.update', 'uses' => 'AdminProfessorController@update']);

    Route::any('filtrar', ['as' => 'admin.professor.filtrar', 'uses' => 'AdminProfessorController@filtrar']);

    Route::post('store', ['as' => 'admin.professor.store', 'uses' => 'AdminProfessorController@store']);

    Route::get('relatorios', ['as' => 'admin.professor.relatorios', 'uses' => 'AdminProfessorRelatorioController@index']);

    Route::get('relatorios/todos-professores', ['as' => 'admin.professor.relatorios.todos-professores', 'uses' => 'AdminProfessorRelatorioController@todosProfessores']);

    Route::get('relatorios/professor-individual/{id}', ['as' => 'admin.professor.relatorios.professor-individual', 'uses' => 'AdminProfessorRelatorioController@professorIndividual']);

    Route::any('relatorios/filtro/professores', ['as' => 'admin.professor.relatorios.filtro-professor', 'uses' => 'AdminProfessorRelatorioController@filtroProfessores']);

    Route::get('relatorios/professores-ativos', ['as' => 'admin.professor.relatorios.professores-ativos', 'uses' => 'AdminProfessorRelatorioController@professoresAtivos']);

});