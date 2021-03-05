<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Service\ErrorsService;

use Illuminate\Http\Request;
use App\LoginClienteRegistros;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Dao\ImageDao;
use App\Http\Dao\ConfigDao;

class LoginClienteRegistrosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	      $filtro = "";
              $order = " p.id "; $order_type = "desc";
              
              $sql = \App\Http\Dao\LoginClienteDao::getLoginRegistros();
              
                if ( $request->input( "id_origem_cliente")  != ""){
                    $sql .= " and c.id_registro_importado = " . $request->input( "id_origem_cliente");
                }
              
              
                if ( $request->input( "filtro")  != ""){
                         	$str_filt = str_replace("'","''", $request->input( "filtro") );
                        	$filtro .= " and ( c.nome like '%".$str_filt."%'  ) ";
                }
                if ( $request->input( "robo")  != ""){
                         	$str_filt = str_replace("'","''", $request->input( "robo") );
                        	$filtro .= " and p.robo = ".$str_filt." ";
                }
                 
                 if ( $request->input( "order_type")  != ""){
			 $order_type = $request->input( "order_type");
		}

 		if ( $request->input( "order")  != ""){
			 $order = $request->input( "order");
		}
               
                $itens = DB::select( $sql . " order by ".$order. " ".$order_type );
				
		return $this->sendResponse( array("data"=> $itens , "qtde" => count($itens)) );
				
	}
	
	/*
	            Route::get('/api/login_cliente_registros', 'LoginClienteRegistrosController@index');
                Route::get('/api/login_cliente_registros/{id}', 'LoginClienteRegistrosController@show');
                Route::put('/api/login_cliente_registros/{id}', 'LoginClienteRegistrosController@update');
                Route::post('/api/login_cliente_registros', 'LoginClienteRegistrosController@create');
                Route::delete('/api/login_cliente_registros/{id}', 'LoginClienteRegistrosController@destroy');
				
				Route::resource('login_cliente_registros', 'LoginClienteRegistrosController');
                router_resourceapi("login_cliente_registros", "LoginClienteRegistrosController");
				
				*/

        
		public function testheader(Request $request){

				  $o_auth_header  = $GLOBALS["auth_header"] ;
				  return array("msg"=>"Teste", "header" => $o_auth_header );
		}

        
	
	
	private function loadRequests(Request $request, \App\LoginClienteRegistros &$reg){
            
           $id_origem = $request->input("id_origem");

           if ( $id_origem != ""){
                     $idtmp = \App\Http\Dao\ConfigDao::executeScalar("select id as res from login_cliente_registros "
                             . " where tabela_importado = '".\App\Http\Dao\ConfigDao::getTabela()."' and ".
                             \App\Http\Dao\ConfigDao::getColunaID()."= " . $id_origem );

                     if ( $idtmp != ""){

                              $reg = \App\LoginClienteRegistros::find($idtmp);
                     }

                     $reg->id_registro_importado = $id_origem;   
               }

            $reg->data_cadastro = \App\Http\Service\UtilService::getCurrentBDdate(); // $request->input('data_cadastro');  
            $reg->nome = $request->input('nome');  
            $reg->detalhes = $request->input('detalhes');  
            $reg->tipo = "whatsapp"; //  $request->input('tipo');  
            //$reg->sequencial = $request->input('sequencial');  
            $reg->robo = $request->input('robo');  
            if ( !  $reg->robo  ){
                 $reg->robo  = 1;
            }
            $reg->id_registro_importado =  $id_origem;
            $reg->tabela_importado = \App\Http\Dao\ConfigDao::getTabela();
            
          //  $reg->id_login_cliente = $request->input('id_login_cliente');  
            $id_origem_cliente = $request->input('id_origem_cliente');
            if (  $id_origem_cliente ){
                
                $id_cliente            = \App\Http\Dao\ConfigDao::getIDByOrigem($id_origem_cliente, "cliente");
                $id_login_cliente      = \App\Http\Dao\LoginClienteDao::getByIdCliente($id_cliente);
                $reg->id_login_cliente = $id_login_cliente;
            }
            
            
            \App\Http\Dao\ConfigDao::blankToNull(  $reg );

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
		$reg = new \App\LoginClienteRegistros;

		$this->loadRequests($request, $reg);
		
		$ret = $reg->save();

		$msg = "sucesso!"; $code = 1;
		if (! $ret  ){
                            $code = 0;
                            $msg = "erro";
		}
                
                
               $sql = \App\Http\Dao\LoginClienteDao::getLoginRegistros(). " and p.id = ". $reg->id;
               $ls = DB::select($sql);

                $final = array("msg"=>$msg, "code" =>  $code , "data"=> $ls[0]);
					   
		return $this->sendResponse( $final  );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$sql = \App\Http\Dao\LoginClienteDao::getLoginRegistros(). " and p.id = ". $id;
               $ls = DB::select($sql);
		//   $reg = LoginClienteRegistros::find($id);

          
           $final =  array( "code" =>  1, "data"=> @$ls[0]);
		   return $this->sendResponse( $final  );
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
            
		   $reg = LoginClienteRegistros::find(ConfigDao::getIDByOrigem($id, "login_cliente_registros"));
                     if ( ! $reg ){
                        return $this->sendErro(array("msg"=>"Não localizado", "code" => 0 ));
                    }
		   //$reg = LoginClienteRegistros::find($id);

		   $this->loadRequests($request, $reg);

			$ret = $reg->save();

		     $msg = "sucesso!"; $code = 1;
			if (! $ret  ){
                                            $code = 0;
                                            $msg = "erro";
			}
                        
                        
                        $sql = \App\Http\Dao\LoginClienteDao::getLoginRegistros(). " and p.id = ". $id;
                        $ls = DB::select($sql);
			
           
                    $final = array("msg"=>$msg, "code" =>  $code , "success" => $ret, "data"=> @$ls[0]);
		    return $this->sendResponse( $final  );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$reg = LoginClienteRegistros::find(ConfigDao::getIDByOrigem($id, "login_cliente_registros"));
                if ( ! $reg ){
                    return $this->sendErro(array("msg"=>"Não localizado", "code" => 0 ));
                }
		$ret = $reg->delete();
		
		$final =  array("msg"=>"sucesso", "code" =>  1 , "success" => $ret, "data"=> $reg);
		
		return $this->sendResponse( $final  );
	}
        
        

}
