<?php

Route::group(['prefix' => 'avaliador/conta', 'namespace' => 'Avaliador\Conta'], function () {

    Route::get('alterar-senha', ['as' => 'avaliador.config.alterar-senha', 'uses' => 'AvaliadorContaController@alterarSenha']);

    Route::post('altera-senha', ['as' => 'avaliador.config.altera-senha', 'uses' => 'AvaliadorContaController@alteraSenha']);

    Route::get('edit', ['as' => 'avaliador.edit', 'uses' => 'AvaliadorContaController@edit']);

    Route::post('update', ['as' => 'avaliador.update', 'uses' => 'AvaliadorContaController@update']);

});