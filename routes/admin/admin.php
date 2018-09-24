<?php

Route::middleware(['auth', 'check.admin'])->group(function () {

    Route::get('admin/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    Route::get('admin/decomposer','\Lubusin\Decomposer\Controllers\DecomposerController@index');

    Route::get('admin/clear-cache', function() {
        Artisan::call('cache:clear');
        return "Cache is cleared";
    });

    Route::get('admin/config-cache', function() {
        Artisan::call('config:cache');
        return "Config cache";
    });

    Route::get('admin/view-cache', function() {
        Artisan::call('view:clear');
        return "View is cleared";
    });

    Route::get('admin/home', ['as' => 'admin', 'uses' => 'Admin\AdminController@index']);

    require_once('audit/audit.php');

    require_once('aluno/aluno.php');

    require_once('etapa/etapa.php');

    require_once('categoria/categoria.php');

    require_once('professor/professor.php');

    require_once('configuracoes/configuracoes.php');

    require_once('escola/escola.php');

    require_once('avaliador/avaliador.php');

    require_once('projeto/projeto.php');

    require_once('suplente/suplente.php');

    require_once('disciplinas/disciplinas.php');

    require_once('user/user.php');

    require_once('avaliacao/avaliacao.php');

});

Route::get('/json-projeto-categoria', 'Admin\Avaliador\AdminAvaliadorController@projetoAjax');

