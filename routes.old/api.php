<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/login', 'Auth\LoginController@defaultMessage');
Route::post('/login', 'Auth\LoginController@login');

Route::group([
        'middleware' => [ 'api']
    ], function ($router) {


		Route::get('/praca', 'CadastroBasicoController@indexPraca');
		Route::post('/praca_bulk', 'CadastroBasicoController@saveJsonPraca');
		Route::delete('/praca', 'CadastroBasicoController@deletePraca');


		Route::get('/impacto', 'CadastroBasicoController@indexImpacto');
		Route::post('/impacto_bulk', 'CadastroBasicoController@saveJsonImpacto');
		Route::delete('/impacto', 'CadastroBasicoController@deleteImpacto');
                
                
		Route::post('/clientes_bulk', 'ClienteController@saveJsonData');
		Route::resource('clientes', 'ClienteController');
		//Route::get('/clientes', 'ClienteController@index');
		Route::post('/clientes/{id_origem_cliente}/dicionario', 'ClienteController@saveDicionarios');
		Route::post('/clientes/{id_origem_cliente}/topicos', 'ClienteController@saveTopicos');
                Route::post('/clientes/{id_origem_cliente}/programa', 'ClienteController@salvarProgramas');
                Route::post('/clientes/{id_origem_cliente}/programas', 'ClienteController@salvarProgramas');
                
                
                Route::get('/clientes/{id_origem_cliente}/programas', 'ClienteController@listarProgramas');
                Route::get('/clientes/{id_origem_cliente}/dicionario', 'ClienteController@listarDicionario');
                Route::get('/clientes/{id_origem_cliente}/topicos', 'ClienteController@listarTopicos');
                
                
                
                
		Route::post('/emissoras_bulk', 'EmissoraController@saveJsonData');
		//Route::get('/emissoras', 'EmissoraController@index');
		Route::resource('emissoras', 'EmissoraController');
                Route::get('/emissoras/{id_emissora}/apresentadores', 'EmissoraController@listarApresentador');
                Route::post('/emissoras/{id_emissora}/apresentadores', 'EmissoraController@saveJsonApresentador');
                
                
                
		Route::resource('programas', 'ProgramaController');
		Route::post('/programas_bulk', 'ProgramaController@saveJsonData');
                Route::post('/programas/{id_programa}/apresentadores', 'ProgramaController@saveJsonApresentador');
                Route::get('/programas/{id_programa}/apresentadores', 'ProgramaController@listarApresentador');
                
                
		Route::get('/materias', 'MateriaRadioTvController@index');
		Route::get('/arquivos_transcritos', 'EventosArquivosController@index');
		Route::post('/arquivos_transcritos/palavras', 'EventosArquivosController@salvarClientePalavra');
		Route::post('/arquivos_transcritos/palavras_bulk', 'EventosArquivosController@saveJsonData');
                
                
                
		Route::resource('whatsapp_contatos', 'LoginClienteRegistrosController');
		Route::resource('whatsapp_pool', 'LoginClienteWhatsappPoolController');


});