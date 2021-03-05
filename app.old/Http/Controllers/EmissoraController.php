<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Service\ErrorsService;

use Illuminate\Http\Request;
use App\Emissora;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Dao\ImageDao;
use App\Http\Dao\ConfigDao;
use App\Http\Dao\CadastroBasicoDao;

class EmissoraController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $filtro = "";
        $order = " id ";
        $order_type = "desc";
              
        if ($request->input("filtro")  != "") {
            $str_filt = str_replace("'", "''", $request->input("filtro"));
            $filtro .= " and ( nome like '%".$str_filt."%'  ) ";
        }

        if ($request->input("order")  != "") {
            $order = $request->input("order");
        }
                        
        if ($request->input("order_type")  != "") {
            $order_type = $request->input("order_type");
        }
               
               
        // $sql = "select p.*"
        //          . " from emissora p where 1 = 1 ". $filtro . " order by ".$order. " ".$order_type ;
        //  DB::select($sql);
        $itens = \App\Http\Dao\EmissoraDao::getListGridCad($filtro, $order, $order_type) ;
                
        return $this->sendResponse(array("data" => $itens , "qtde" =>  count($itens) ));
    }
        
        
    public function listarApresentador($id_emissora, Request $request)
    {
        $id_programa_real = ConfigDao::getIDByOrigem($id_emissora, "emissora");
        if ($id_programa_real == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"não encontrado programa para a id de origem". $id_emissora  ));
        }
        $filtro = " and p.id in ( select id_pai from associacao_cadastros where classificacao='apresentadorxemissora' and tabela_pai = 'jornalista_apresentador' "
                            . " and tabela_filho = 'emissora' and id_filho = ". $id_programa_real." ) ";
               
        $ls_programas = \App\Http\Dao\JornalistaApresentadorDao::getListGridCad($filtro); // ClienteDao::getListTopicos($id_origem_cliente);
               
        return $this->sendResponse(array("data" => $ls_programas , "qtde" => count($ls_programas) ));
    }
        
        
    public function saveJsonApresentador($id_emissora, Request $request)
    {
        $data = $request->input("data");
        $deleta_outros = $request->input("deleta_outros");

        if ($data == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"O campo data esta vazio"  ));
        }
                
        $id_programa_real = ConfigDao::getIDByOrigem($id_emissora, "emissora");
                
        if ($id_programa_real == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"não achei emissora com id de origem" . $id_emissora ));
        }
        if ($deleta_outros == "1") {
                    
                    //$reg->id, $id_programa, "jornalista_apresentador", "programa", "apresentadorxprograma"
            DB::statement("delete from classificacao='apresentadorxemissora' and tabela_pai = 'jornalista_apresentador' "
                            . " and tabela_filho = 'emissora' and id_filho = ". $id_programa_real);
        }
                
        $lsData = \App\Http\Dao\JornalistaApresentadorDao::salvarDadosJsonByEmissora($data, $id_programa_real);


        return $this->sendResponse(array("data"=>$lsData,"qtde"=>count($lsData)));
    }
            

    public function saveJsonData(Request $request)
    {
        $data = $request->input("data");

        if ($data == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"O campo data esta vazio"  ));
        }

        $itens = \App\Http\Dao\EmissoraDao::salvarDadosJson($data);

        return $this->sendResponse($itens);
    }
    
    /*
                Route::get('/api/emissora', 'EmissoraController@index');
                Route::get('/api/emissora/{id}', 'EmissoraController@show');
                Route::put('/api/emissora/{id}', 'EmissoraController@update');
                Route::post('/api/emissora', 'EmissoraController@create');
                Route::delete('/api/emissora/{id}', 'EmissoraController@destroy');

        Route::resource('emissora', 'EmissoraController');
                router_resourceapi("emissora", "EmissoraController");

                */

    
    private function loadRequests(Request $request, \App\Emissora &$reg)
    {
        $reg->nome = $request->input('nome');
        $item_req = (object) $request->all();
                          
        if ($request->input('id_praca') != "") {
            $reg->id_praca = $request->input('id_praca');//\App\Http\Dao\CadastroBasicoDao::getIDByOrigem($request->input('id_praca'), 4);
        }
                      
        $reg->id_veiculo =  13;
                        
        if ($request->input('veiculo') != "") {
            if (strtolower($request->input('veiculo')) == "radio"  || strtolower($request->input('veiculo')) == "rádio") {
                $reg->id_veiculo =  14;
            }

            if (strtolower($request->input('veiculo')) == "tv") {
                $reg->id_veiculo =  13;
            }
        }
        $reg->com_stream = 0;
        if (property_exists($item_req, "habilita_stream") && $item_req->habilita_stream != "") {
            $reg->com_stream = ConfigDao::numeroBanco($item_req->habilita_stream);
        }
                        
        $reg->modelo_streaming = 2; //a cada 5 minutos gera um novo arquivo.
        $reg->tabela_importado = ConfigDao::getTabela();
        $reg->nome = $item_req->nome;
                        
        if (property_exists($item_req, "url_stream_hd") && $item_req->url_stream_hd != "") {
            $reg->url_stream_hd2 = $item_req->url_stream_hd ;
        }
        if (property_exists($item_req, "url_stream_sd") && $item_req->url_stream_sd != "") {
            $reg->url_stream_sd2 = $item_req->url_stream_sd ;
        }
        if (property_exists($item_req, "uf") && $item_req->uf != "") {
            $reg->uf = $item_req->uf;
        }
                          
        /*
              $reg->servidor = $request->input('servidor');
              $reg->sequencial = $request->input('sequencial');
              $reg->ano = $request->input('ano');
              $reg->id_veiculo = $request->input('id_veiculo');
              $reg->id_registro_importado = $request->input('id_registro_importado');
              $reg->tabela_importado = $request->input('tabela_importado');
              $reg->id_exibido = $request->input('id_exibido');
              $reg->id_forma_cobranca = $request->input('id_forma_cobranca');
              $reg->preco_visualizacao = $request->input('preco_visualizacao');
              $reg->banco_importado = $request->input('banco_importado');
              $reg->sigla = $request->input('sigla');
              $reg->id_praca = $request->input('id_praca');
              $reg->preco_revista = $request->input('preco_revista');
              $reg->classificacao = $request->input('classificacao');
              $reg->id_regiao = $request->input('id_regiao');
              $reg->uf = $request->input('uf');
              $reg->com_stream = $request->input('com_stream');
              $reg->url_stream_sd = $request->input('url_stream_sd');
              $reg->url_stream_hd = $request->input('url_stream_hd');
              $reg->audiencia = $request->input('audiencia');
              $reg->site = $request->input('site');
              $reg->modelo_streaming = $request->input('modelo_streaming');
              $reg->url_stream_sd2 = $request->input('url_stream_sd2');
              $reg->url_stream_hd2 = $request->input('url_stream_hd2');
              $reg->transcricao_qualidade = $request->input('transcricao_qualidade');
              $reg->transcricao_url = $request->input('transcricao_url');
              $reg->transcricao_url2 = $request->input('transcricao_url2');
         *
         */
        
        
        \App\Http\Dao\ConfigDao::blankToNull($reg);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $reg = new \App\Emissora;

        $this->loadRequests($request, $reg);
        
        $ret = $reg->save();

        $msg = "sucesso!";
        $code = 1;
        if (! $ret) {
            $code = 0;
            $msg = "erro";
        }

        $final = array("msg"=>$msg, "data"=> \App\Http\Dao\EmissoraDao::getById($reg->id) );
                       
        return $this->sendResponse($final);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $reg = \App\Http\Dao\EmissoraDao::getById($reg->id); // Emissora::find($id);

          
        $final =  array( "code" =>  1, "data"=> $reg);
        return $this->sendResponse($final);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Request $request)
    {
        // return "metodo EDIT";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $reg = new Emissora();
                   
        if ($id  != "") {
            $id_tmp = \App\Http\Dao\ConfigDao::getIDByOrigem($id, "emissora");
                             
            if ($id_tmp != "") {
                $reg = Emissora::find($id_tmp);
            }
        }
            
        //$reg = Emissora::find($id);

        $this->loadRequests($request, $reg);
        $ret = $reg->save();

        $msg = "sucesso!";
        $code = 1;
        if (! $ret) {
            $code = 0;
            $msg = "erro";
        }
            
           
        $final = array("msg"=>$msg, "code" =>  $code , "data"=> \App\Http\Dao\EmissoraDao::getById($reg->id) );
        return $this->sendResponse($final);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $id_tmp = \App\Http\Dao\ConfigDao::getIDByOrigem($id, "emissora");
        $reg = null;
                
        if ($id_tmp != "") {
            $reg = Emissora::find($id_tmp);
            $ret = $reg->delete();
                       
            $reg = \App\Http\Dao\EmissoraDao::getById($id_tmp);
        }
        
        $final =  array("msg"=>"sucesso", "data"=> $reg);
        
        return $this->sendResponse($final);
    }
}
