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

Route::get('/integrador', 'IntegradorController@index');
Route::get('/materiartv/getnewid', 'IntegradorController@getnewid');


Route::get('/Pool', 'PoolController@index');
Route::get('/Pool/Verifica', 'PoolController@verifica');
Route::get('/Pool/Historico', 'PoolController@historico');

Route::get('/Pool/Runing', 'PoolController@Runing_get');
Route::post('/Pool/Runing', 'PoolController@Runing_post');


