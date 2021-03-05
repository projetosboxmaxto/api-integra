<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Service\ErrorsService;

use Illuminate\Http\Request;
use App\MateriaRadioTv;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Dao\ImageDao;
use App\Http\Dao\PostsDao;

class MateriaRadioTvController extends Controller
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
        $order_type = "asc";
              
        $id_cliente = "";
        $id_emissora = "";
        $id_programa = "";
              
        $campos = $request->all();
              
        // print_r( $campos );die(" ");
              
        if ($request->input("id_cliente")  != "") {
            $id_cliente = \App\Http\Dao\ConfigDao::getIDByOrigem($request->input("id_cliente"), "cliente");
            // die("id cliente? ". $id_cliente );
        }
        if ($request->input("id_emissora")  != "") {
            $id_emissora = \App\Http\Dao\ConfigDao::getIDByOrigem($request->input("id_emissora"), "emissora");
        }
        if ($request->input("id_programa")  != "") {
            $id_programa = \App\Http\Dao\ConfigDao::getIDByOrigem($request->input("id_programa"), "programa");
        }
              
        if ($request->input("data_inicio")  != "") {
            $filtro .= " and m.data_hora_materia >= '".$request->input("data_inicio")."' ";
            if ($id_cliente != "") {
                $filtro .= " and aj.data_materia >= '".$request->input("data_inicio")."' ";
            }
        }
        if ($request->input("data_fim")  != "") {
            $filtro .= " and m.data_hora_materia <= '".$request->input("data_fim")."' ";
            if ($id_cliente != "") {
                $filtro .= " and aj.data_materia <='".$request->input("data_fim")."' ";
            }
        }
               
        if ($id_emissora != "") {
            $filtro .= " and m.id_emissora = " . $id_emissora;
            if ($id_emissora != "") {
                $filtro .=  " and aj.id_emissora = ". $id_emissora;
            }
        }
               
        if ($id_programa != "") {
            $filtro .= " and m.id_programa = " . $id_programa;
        }
               
               
        if ($request->input("min_id")  != "") {
            $filtro .= " and m.id > ". $request->input("min_id");
        }

        if ($request->input("order")  != "") {
            $order = $request->input("order");
        }
                
        if ($request->input("order_type")  != "") {
            $order_type = $request->input("order_type");
        }
               
               
        $itens = \App\Http\Dao\MateriaRadiotvJornalDao::getList($filtro, $id_cliente, $order, $order_type);
                
                
        return $this->sendResponse(array("qtde" => count($itens), "data" => $itens ));
    }
    
    /*
                Route::get('/api/materia_radio_tv', 'MateriaRadioTvController@index');
                Route::get('/api/materia_radio_tv/{id}', 'MateriaRadioTvController@show');
                Route::put('/api/materia_radio_tv/{id}', 'MateriaRadioTvController@update');
                Route::post('/api/materia_radio_tv', 'MateriaRadioTvController@create');
                Route::delete('/api/materia_radio_tv/{id}', 'MateriaRadioTvController@destroy');

                Route::resource('materia_radio_tv', 'MateriaRadioTvController');
                router_resourceapi("materia_radio_tv", "MateriaRadioTvController");

                */

        
    public function testheader(Request $request)
    {
        $o_auth_header  = $GLOBALS["auth_header"] ;
        return array("msg"=>"Teste", "header" => $o_auth_header );
    }

        
    
    public function grid(Request $request)
    {
        $filtro = "";
        $str_filt = "";

        $page = $request->input("page");
        $pagesize = $request->input("pagesize");

        if ($pagesize == "") {
            $pagesize = 10;
        }

        if ($page == "") {
            $page = 1;
        }

        if ($request->input("filtro")  != "") {
            $str_filt = str_replace("'", "''", $request->input("filtro"));
            $filtro .= " and ( nome like '%".$str_filt."%' or email like '%".$str_filt."%' ) ";
        }


        $sql = " select count(*) as res from materia_radio_tv where 1 = 1 ".$filtro ;
        $total_itens = $this->executeScalar($sql);

        $inicio = 0;
        $fim = 0;
        $this->SetaRsetPaginacao($pagesize, $page, $total_itens, $inicio, $fim);

        $order = $request->input("order");
        $order_type = $request->input("order_type");
        if ($order == "") {
            $order = "id";
        }
        if ($order_type == "") {
            $order_type = "asc";
        }

        $sql = "select p.* from materia_radio_tv p where 1 = 1 ". $filtro . " order by ".$order. " ".$order_type .
                            $this->get_limit_sql($inicio, $pagesize) ;
        $itens = DB::select($sql);
        //OFFSET 50 ROWS FETCH NEXT 100 ROWS ONLY

        $saida = array("page"=>$page, "pagesize" => $pagesize, "order"=>$order,
                          "total"=>$total_itens, "total_itens"=> $total_itens,
                          "order_type"=> $order_type, "itens" =>  $itens);

        return $saida;
    }
    
    private function loadRequests(Request $request, \App\MateriaRadioTv &$reg)
    {
        $reg->id_programa = $request->input('id_programa');
        $reg->id_apresentador = $request->input('id_apresentador');
        $reg->indicar_programa = $request->input('indicar_programa');
        $reg->fixar_programacao = $request->input('fixar_programacao');
        $reg->nr_registro_importado = $request->input('nr_registro_importado');
        
        
        PostsDao::blankToNull($reg);
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
        $reg = new \App\MateriaRadioTv;

        $this->loadRequests($request, $reg);
        
        $ret = $reg->save();

        $msg = "sucesso!";
        $code = 1;
        if (! $ret) {
            $code = 0;
            $msg = "erro";
        }

        $final = array("msg"=>$msg, "code" =>  $code , "success" => $ret, "results"=> $reg,
                       "data"=> $reg, "item"=> $reg);
                       
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
        $reg = MateriaRadioTv::find($id);

          
        $final =  array( "code" =>  1, "data"=> $reg, "item"=> $reg);
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
        $reg = MateriaRadioTv::find($id);

        $this->loadRequests($request, $reg);

        $ret = $reg->save();

        $msg = "sucesso!";
        $code = 1;
        if (! $ret) {
            $code = 0;
            $msg = "erro";
        }
            
           
        $final = array("msg"=>$msg, "code" =>  $code , "success" => $ret, "data"=> $reg, "item" => $reg);
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
        $reg = MateriaRadioTv::find($id);
        $ret = $reg->delete();
        
        $final =  array("msg"=>"sucesso", "code" =>  1 , "success" => $ret, "data"=> $reg);
        
        return $this->sendResponse($final);
    }
}
