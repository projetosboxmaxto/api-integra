<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Service\ErrorsService;

use Illuminate\Http\Request;
use App\Programa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Dao\ImageDao;
use Illuminate\Support\Facades\Validator;
use App\Http\Dao\ClienteDao;
use App\Http\Dao\ConfigDao;

class ProgramaController extends Controller
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
            $filtro .= " and ( p.nome like '%".$str_filt."%'  ) ";
        }
               
        if ($request->input("id_emissora")  != "") {
            $filtro .= " and em.id_registro_importado = " . $request->input("id_emissora");
        }
               
               

        if ($request->input("order")  != "") {
            $order = $request->input("order");
        }
                
        if ($request->input("order_type")  != "") {
            $order_type = $request->input("order_type");
        }
               
        $itens = \App\Http\Dao\ProgramaDao::getListGridCad($filtro, $order, $order_type);
                
        return $this->sendResponse(array("data" => $itens , "qtde" =>  count($itens) ));
    }
        
        
            
    public function saveJsonData(Request $request)
    {
        $data = $request->input("data");

        if ($data == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"O campo data esta vazio"  ));
        }

        $itens = \App\Http\Dao\ProgramaDao::salvarDadosJson($data);

        return $this->sendResponse($itens);
    }
        
      
    
    /*
                Route::get('/api/programa', 'ProgramaController@index');
                Route::get('/api/programa/{id}', 'ProgramaController@show');
                Route::put('/api/programa/{id}', 'ProgramaController@update');
                Route::post('/api/programa', 'ProgramaController@create');
                Route::delete('/api/programa/{id}', 'ProgramaController@destroy');

                Route::resource('programa', 'ProgramaController');
                router_resourceapi("programa", "ProgramaController");

                */

        
    private function loadRequests(Request $request, \App\Programa &$reg)
    {
        $item_req = (object) $request->all();
        \App\Http\Dao\ProgramaDao::configuraRegistro($reg, $item_req);
            
        /*
         $reg->ano = $request->input('ano');
         $reg->servidor = $request->input('servidor');
         $reg->sequencial = $request->input('sequencial');
         $reg->nome = $request->input('nome');
         $reg->hora_inicio = $request->input('hora_inicio');
         $reg->hora_fim = $request->input('hora_fim');
         $reg->hora_inicio_seg = $request->input('hora_inicio_seg');
         $reg->hora_fim_seg = $request->input('hora_fim_seg');
         $reg->classificacao = $request->input('classificacao');
         $reg->id_meio_comunicacao = $request->input('id_meio_comunicacao');
         $reg->destaque = $request->input('destaque');
         $reg->custo_pub = $request->input('custo_pub');
         $reg->id_registro_importado = $request->input('id_registro_importado');
         $reg->tabela_importado = $request->input('tabela_importado');
         $reg->banco_importado = $request->input('banco_importado');
         $reg->duracao_sem_comercial = $request->input('duracao_sem_comercial');
         $reg->duracao_sem_comercial_seg = $request->input('duracao_sem_comercial_seg');
         $reg->transcricao_ativar = $request->input('transcricao_ativar');
         $reg->transcricao_tempo_extra_inicio = $request->input('transcricao_tempo_extra_inicio');
         $reg->transcricao_tempo_extra_fim = $request->input('transcricao_tempo_extra_fim');
         $reg->transcricao_prioridade = $request->input('transcricao_prioridade');
         $reg->transcricao_prioridade_persistente = $request->input('transcricao_prioridade_persistente');
         $reg->transcricao_dias = $request->input('transcricao_dias');
         $reg->transcricao_tempo_fim_seg = $request->input('transcricao_tempo_fim_seg');
         $reg->transcricao_tempo_inicio_seg = $request->input('transcricao_tempo_inicio_seg');
         $reg->descr_facil = $request->input('descr_facil');
         $reg->id_emissora = $request->input('id_emissora');  */


        \App\Http\Dao\ConfigDao::blankToNull($reg);
        \App\Http\Dao\ConfigDao::configuraChave($reg, "emissora");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
    }
        
    public function listarApresentador($id_programa, Request $request)
    {
        $id_programa_real = ConfigDao::getIDByOrigem($id_programa, "programa");
        if ($id_programa_real == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"não encontrado programa para a id de origem". $id_programa  ));
        }
        $filtro = " and p.id in ( select id_pai from associacao_cadastros where classificacao='apresentadorxprograma' and tabela_pai = 'jornalista_apresentador' "
                            . " and tabela_filho = 'programa' and id_filho = ". $id_programa_real." ) ";
               
        $ls_programas = \App\Http\Dao\JornalistaApresentadorDao::getListGridCad($filtro); // ClienteDao::getListTopicos($id_origem_cliente);
               
        return $this->sendResponse(array("data" => $ls_programas , "qtde" => count($ls_programas) ));
    }

        
    public function saveJsonApresentador($id_programa, Request $request)
    {
        $data = $request->input("data");
        $deleta_outros = $request->input("deleta_outros");

        if ($data == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"O campo data esta vazio"  ));
        }
                
        $id_programa_real = ConfigDao::getIDByOrigem($id_programa, "programa");
                
        if ($deleta_outros == "1") {
                    
                    //$reg->id, $id_programa, "jornalista_apresentador", "programa", "apresentadorxprograma"
            DB::statement("delete from classificacao='apresentadorxprograma' and tabela_pai = 'jornalista_apresentador' "
                            . " and tabela_filho = 'programa' and id_filho = ". $id_programa_real);
        }
                
        $lsData = \App\Http\Dao\JornalistaApresentadorDao::salvarDadosJson($data, $id_programa_real);


        return $this->sendResponse(array("data"=>$lsData,"qtde"=>count($lsData)));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'nome' => 'required',
                'id_origem' => 'required',
                'hora_inicio' => 'required',
                'hora_fim' => 'required',
                'transcricao_prioridade' => 'required',
                'transcricao_dias' => 'required',
                'id_emissora' => 'required',
            ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }
            
        $reg = new \App\Programa;

        $this->loadRequests($request, $reg);
        ConfigDao::configuraChave($reg, "programa");
        $ret = $reg->save();
                
        \App\Http\Dao\ProgramaDao::setaProgramasPorEmissora($reg->id, $reg->id_emissora);

        $msg = "sucesso!";
        $code = 1;
        if (! $ret) {
            $code = 0;
            $msg = "erro";
        }

        $final = array("msg"=>$msg, "code" =>  $code ,
                         "data"=> \App\Http\Dao\ProgramaDao::getById($reg->id));
                       
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
        $idtmp = ConfigDao::getIDByOrigem($id, "programa");
        $reg = \App\Http\Dao\ProgramaDao::getById($idtmp);
        //$reg = Programa::find($id);

          
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
        $validator = Validator::make($request->all(), [
                      'nome' => 'required',
                      'id_origem' => 'required',
                      'hora_inicio' => 'required',
                      'hora_fim' => 'required',
                      'transcricao_prioridade' => 'required',
                      'transcricao_dias' => 'required',
                      'id_emissora' => 'required',
                  ]);
            
        $idtmp = ConfigDao::getIDByOrigem($id, "programa");
        $reg = Programa::find($idtmp);

        $this->loadRequests($request, $reg);
        ConfigDao::configuraChave($reg, "programa");
        $ret = $reg->save();

        \App\Http\Dao\ProgramaDao::setaProgramasPorEmissora($reg->id, $reg->id_emissora);
        $msg = "sucesso!";
        $code = 1;
        if (! $ret) {
            $code = 0;
            $msg = "erro";
        }
            
           
        $final = array("msg"=>$msg, "code" =>  $code ,
                   "data"=>\App\Http\Dao\ProgramaDao::getById($reg->id) );
                 
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
        $idtmp = ConfigDao::getIDByOrigem($id, "programa");
        $reg = Programa::find($idtmp);
        $ret = $reg->delete();
        
        $final =  array("msg"=>"sucesso", "code" =>  1 ,
                      "data"=> \App\Http\Dao\ProgramaDao::getById($reg->id));
        
        return $this->sendResponse($final);
    }
}
