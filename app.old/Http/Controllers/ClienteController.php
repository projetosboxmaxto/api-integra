<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Service\ErrorsService;

use Illuminate\Http\Request;
use App\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Dao\ImageDao;
use App\Http\Dao\ClienteDao;
use App\Http\Dao\ConfigDao;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
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
            $filtro .= " and ( nome p.like '%".$str_filt."%' or p.fantasia like '%".$str_filt."%'  ) ";
        }
        if ($request->input("tipo")  != "") {
            if ($request->input("tipo") == "Cliente") {
                $filtro .= " and p.id_tipo = 21 ";
            }
            if ($request->input("tipo") == "Sub-Cliente") {
                $filtro .= " and p.id_tipo = 22 ";
            }
            if ($request->input("tipo") == "Setor") {
                $filtro .= " and p.id_tipo = 23 ";
            }
        }

        $itens = ClienteDao::getListGridCad($filtro);
        return $this->sendResponse(array("data" => $itens , "qtde" =>  count($itens) ));
    }
    public function listarProgramas($id_origem_cliente, Request $request)
    {
        $ls_programas = ClienteDao::getListProgramas($id_origem_cliente);
               
        return $this->sendResponse(array("data" => $ls_programas , "qtde" => count($ls_programas) ));
    }
        
    public function listarDicionario($id_origem_cliente, Request $request)
    {
        $ls_programas = ClienteDao::getListDicionario($id_origem_cliente);
               
        return $this->sendResponse(array("data" => $ls_programas , "qtde" => count($ls_programas) ));
    }
        
    public function listarTopicos($id_origem_cliente, Request $request)
    {
        $ls_programas = ClienteDao::getListTopicos($id_origem_cliente);
               
        return $this->sendResponse(array("data" => $ls_programas , "qtde" => count($ls_programas) ));
    }
        
    public function saveJsonData(Request $request)
    {
        $data = $request->input("data");

        if ($data == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"O campo data esta vazio"  ));
        }

        $itens = ClienteDao::salvarDadosJson($data);

        return $this->sendResponse($itens);
    }
        
          
    public function salvarProgramas($id_origem_cliente, Request $request)
    {
        if ($id_origem_cliente == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"id cliente vazio"  ));
        }
        $validator = Validator::make($request->all(), [
                'ids_programa' => 'required'
            ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }
            
        $id_cliente = ConfigDao::getIDByOrigem($id_origem_cliente, "cliente"); //$request->input("id_cliente")
        $ids_programa = ConfigDao::getIDSByOrigem($request->input("ids_programa"), "programa");
        $deleta = $request->input("deleta_outros");
             
        if ($id_cliente == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"não foram localizados clientes com id de origem informada"  ));
        }
        if ($ids_programa == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"não foram localizados programas com id de origem informada"  ));
        }
             
        $deve_deletar = $deleta == 1;
             
        $ids_assocs = \App\Http\Dao\AssociacaoCadastrosDao::salvarByIds("entidadexprograma", $id_cliente, $ids_programa, "cliente", "programa", $deve_deletar);
            
        $qtde_total_programa = ConfigDao::executeScalar("select count(*) as res from associacao_cadastros where id_pai = ".$id_cliente.
                     " and tabela_pai='cliente' and classificacao = 'entidadexprograma' ");
             
        if ($qtde_total_programa == "") {
            $qtde_total_programa = "0";
        }
        //die(" ids programa? ". $ids_programa );
             
        $ls_programas = \App\Http\Dao\ProgramaDao::getListGridCad(" and p.id in ( ". $ids_programa ." ) ");
             
        return $this->sendResponse(array("data" => $ls_programas ,
                           "qtde_salvos" =>  count($ls_programas),
                           "qtde_total_programas" => $qtde_total_programa));
        // string ids  = Entities.AssociacoesCadastro.getIDAssociacoesPai("entidadexprograma", entidade["id"], "cliente", "programa");
    }
        
    public function saveDicionarios($id_origem_cliente, Request $request)
    {
        $data = $request->input("data");
        $id_cliente = $id_origem_cliente; //$request->input("id_cliente");
        
        if ($id_cliente == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"O campo id_cliente esta vazio"  ));
        }
                
        if ($data == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"O campo data esta vazio"  ));
        }

        $id_cliente_sistema = ClienteDao::getIdByOrigem($id_cliente);
                
        $saida =  \App\Http\Dao\DicionarioTagsDao::salvarDicByJson($id_cliente, $data, "dic");
            
        return $this->sendResponse(array("qtde"=>count($saida), "data" => $saida ));
    }
    
        
    public function saveTopicos($id_origem_cliente, Request $request)
    {
        $data = $request->input("data");
        $id_cliente = $id_origem_cliente; //$request->input("id_cliente");
        if ($id_cliente == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"O campo id_cliente esta vazio"  ));
        }
                
        if ($data == "") {
            return $this->sendErro(array( "code"=>0,"msg"=>"O campo data esta vazio"  ));
        }

        $id_cliente_sistema = ClienteDao::getIdByOrigem($id_cliente);
                
        $saida = \App\Http\Dao\ClassesClienteDao::salvarTopicosByJson($id_cliente, $data); //  \App\Http\Dao\DicionarioTagsDao::salvarDicByJson($id_cliente, $data, "dic");
            
        return $this->sendResponse(array("qtde"=>count($saida), "data" => $saida ));
    }
    /*
                Route::get('/api/cliente', 'ClienteController@index');
                Route::get('/api/cliente/{id}', 'ClienteController@show');
                Route::put('/api/cliente/{id}', 'ClienteController@update');
                Route::post('/api/cliente', 'ClienteController@create');
                Route::delete('/api/cliente/{id}', 'ClienteController@destroy');

                Route::resource('cliente', 'ClienteController');
                router_resourceapi("cliente", "ClienteController");

                */

        
    
    private function loadRequests(Request $request, \App\Cliente &$reg)
    {
        $item_req = (object) $request->all();
                 
        if (property_exists($item_req, "id_origem") && $item_req->id_origem != "") {
            $idtmp = \App\Http\Dao\ConfigDao::executeScalar("select id as res from cliente "
                                     . " where tabela_importado = '".ConfigDao::getTabela()."' and ".
                                     ConfigDao::getColunaID()."= " . $item_req->id_origem);
                             
            if ($idtmp != "") {
                $reg = Cliente::find($idtmp);
            }

            $reg->id_registro_importado = $item_req->id_origem;
        }
                       
                       
        $reg->tabela_importado = \App\Http\Dao\ConfigDao::getTabela();
        $reg->nome = $item_req->nome;
        $reg->fantasia = $item_req->fantasia;
        $reg->cpf_cnpj = $item_req->cpf_cnpj;
        $reg->id_tipo = 21;
        $reg->bl_todos_programas = @$item_req->todos_programas;
        $reg->status = 1;
                       
        if (@$reg->bl_todos_programas) {
            $reg->bl_todos_programas = 0;
        }
                       
        if (property_exists($item_req, "id_origem_pai") && $item_req->id_origem_pai != "") {
            $idtmp_pai = \App\Http\Dao\ConfigDao::executeScalar("select id as res from cliente "
                                     . " where tabela_importado = '".ConfigDao::getTabela()."' and ".
                                     ConfigDao::getColunaID()."= " . $item_req->id_origem_pai);
                           
            if ($idtmp_pai != "") {
                $reg->id_pai =$idtmp_pai;
            } else {
                $reg->id_pai = null;
            }
        }
                       
        if (property_exists($item_req, "tipo") && $item_req->tipo != "") {
            $id_encontra_tipo = ConfigDao::executeScalar("select id as res from cadastro_fixo where descricao like '%".
                                       $item_req->tipo ."%' and id_tipo_cadastro_fixo = 5 ");
                               
            if ($id_encontra_tipo != "") {
                $reg->id_tipo =$id_encontra_tipo;
            }
        }
        /*

         $reg->nome = $request->input('nome');
         $reg->servidor = $request->input('servidor');
         $reg->ano = $request->input('ano');
         $reg->sequencial = $request->input('sequencial');
         $reg->id_registro_importado = $request->input('id_registro_importado');
         $reg->tabela_importado = $request->input('tabela_importado');
         $reg->banco_importado = $request->input('banco_importado');
         $reg->fantasia = $request->input('fantasia');
         $reg->cpf_cnpj = $request->input('cpf_cnpj');
         $reg->telefone = $request->input('telefone');
         $reg->fax = $request->input('fax');
         $reg->status = $request->input('status');
         $reg->id_pai = $request->input('id_pai');
         $reg->site = $request->input('site');
         $reg->template_html = $request->input('template_html');
         $reg->login = $request->input('login');
         $reg->senha = $request->input('senha');
         $reg->id_tipo = $request->input('id_tipo');
         $reg->id_modelo_email = $request->input('id_modelo_email');
         $reg->modulos_email = $request->input('modulos_email');
         $reg->mostra_mensuracao = $request->input('mostra_mensuracao');
         $reg->id_regiao = $request->input('id_regiao');
         $reg->label_classes = $request->input('label_classes');
         $reg->mostra_relatorio = $request->input('mostra_relatorio');
         $reg->id_monitoramento_scup = $request->input('id_monitoramento_scup');
         $reg->mostra_so_prioridade = $request->input('mostra_so_prioridade');
         $reg->online_calculo_valor_banner = $request->input('online_calculo_valor_banner');
         $reg->online_calculo_largura_banner = $request->input('online_calculo_largura_banner');
         $reg->online_calculo_altura_banner = $request->input('online_calculo_altura_banner');
         $reg->online_calculo_valor_caractere = $request->input('online_calculo_valor_caractere');
         $reg->data_ultima_edicao_dicionario = $request->input('data_ultima_edicao_dicionario');
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
        $reg = new \App\Cliente;

        $this->loadRequests($request, $reg);
        
        $ret = $reg->save();

        $msg = "sucesso!";
        $code = 1;
        if (! $ret) {
            $code = 0;
            $msg = "erro";
        }

        $final = array("msg"=>$msg, "code" =>  $code ,
                       "data"=> ClienteDao::getById($reg->id)  );
                       
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
        $reg = ClienteDao::getById(ConfigDao::getIDByOrigem($id, "cliente"));

          
        $final =  array( "code" =>  1, "data"=> $reg  );
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
        $reg = Cliente::find(ConfigDao::getIDByOrigem($id, "cliente"));
           

        $this->loadRequests($request, $reg);

        $ret = $reg->save();

        $msg = "sucesso!";
        $code = 1;
        if (! $ret) {
            $code = 0;
            $msg = "erro";
        }
            
           
        $final = array("msg"=>$msg, "code" =>  $code ,  "data"=> $reg = ClienteDao::getById($reg->id));
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
        $id_origem = ConfigDao::getIDByOrigem($id, "cliente");
        $reg = Cliente::find($id_origem);
        $ret = $reg->delete();
        
        $final =  array("msg"=>"sucesso", "code" =>  1 , "success" => $ret, "data"=> ClienteDao::getById($reg->id) );
        
        return $this->sendResponse($final);
    }
}
