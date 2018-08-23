<?php

Route::middleware(['auth', 'check.escola'])->group(function () {

    Route::get('escola/home', ['as' => 'escola', 'uses' => 'Escola\EscolaController@index']);

    Route::get('escola/clear-cache', function() {
        Artisan::call('cache:clear');
        return "Cache is cleared";
    });

    Route::get('escola/config-cache', function() {
        Artisan::call('config:cache');
        return "Config cache";
    });

    Route::get('escola/view-cache', function() {
        Artisan::call('view:clear');
        return "View is cleared";
    });

    require_once('aluno/aluno.php');

    require_once('configuracoes/configuracoes.php');

    require_once('documentos/documentos.php');

    require_once('professor/professor.php');

    require_once('projeto/projeto.php');

    require_once('suplente/suplente.php');

});

