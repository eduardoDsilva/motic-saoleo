<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Authentication Routes...
Route::get('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
    'as' => '',
    'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);

// Password Reset Routes...
Route::post('password/email', [
    'as' => 'password.email',
    'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
    'as' => 'password.request',
    'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
    'as' => '',
    'uses' => 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
    'as' => 'password.reset',
    'uses' => 'Auth\ResetPasswordController@showResetForm'
]);

// Registration Routes...
Route::get('register', [
    'as' => 'register',
    'uses' => 'Auth\RegisterController@showRegistrationForm'
]);
Route::post('register', [
    'as' => '',
    'uses' => 'Auth\RegisterController@register'
]);
Route::get('admin/home', 'Admin\HomeController@index')->name('admin/home');

Route::get('admin/escola/home', 'Admin\escola\EscolaController@escola')->name('admin/escola/home');

Route::get('admin/escola/cadastrar', 'Admin\escola\EscolaController@cadastraEscola')->name('admin/escola/cadastrar');

Route::get('admin/escola/cadastro/usuario', 'Admin\user\UserController@cadastraAluno')->name('admin/escola/cadastro/usuario');

Route::get('admin/escola/cadastra', 'Admin\escola\EscolaController@cadastra')->name('admin/escola/cadastra');

Route::post('admin/user/salvar', 'Admin\user\UserController@salvar')->name('admin/user/salvar');

Route::post('admin/escola/salvar', 'Admin\escola\EscolaController@salvaAluno')->name('admin/escola/salvar');

Route::post('admin/escola/salvar', 'Admin\escola\EscolaController@salvar')->name('admin/escola/salvar');

Route::get('admin/home', 'Admin\HomeController@index')->name('admin/home');

