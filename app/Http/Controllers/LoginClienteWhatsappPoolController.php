<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Service\ErrorsService;

use Illuminate\Http\Request;
use App\LoginClienteWhatsappPool;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Dao\ImageDao;
use App\Http\Dao\ConfigDao;

class LoginClienteWhatsappPoolController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	      $filtro = "";
              $order = " id "; $order_type = "desc";
              
              if ( $request->input( "filtro")  != ""){
                         	$str_filt = str_replace("'","''", $request->input( "filtro") );
                        	$filtro .= " and ( p.texto like '%".$str_filt."%' ) ";
               }
               if ( $request->input( "id_origem")  != ""){
                         	$str_filt = str_replace("'","''", $request->input( "id_origem") );
                        	$filtro .= " and p.id_materia =  ".$str_filt."%'  ";
               }

 		if ( $request->input( "order")  != ""){
			 $order = $request->input( "order");
		}
				
		if ( $request->input( "order_type")  != ""){
			 $order_type = $request->input( "order_type");
		}
                
                $sql = \App\Http\Dao\LoginClienteWhatsappPoolDao::getLista();
               
                $itens = DB::select($sql . $filtro . " order by ".$order. " ".$order_type);
				
		return $this->sendResponse( array("data"=> $itens , "qtde" => count($itens)) );
				
	}
	
	/*
	            Route::get('/api/login_cliente_whatsapp_pool', 'LoginClienteWhatsappPoolController@index');
                Route::get('/api/login_cliente_whatsapp_pool/{id}', 'LoginClienteWhatsappPoolController@show');
                Route::put('/api/login_cliente_whatsapp_pool/{id}', 'LoginClienteWhatsappPoolController@update');
                Route::post('/api/login_cliente_whatsapp_pool', 'LoginClienteWhatsappPoolController@create');
                Route::delete('/api/login_cliente_whatsapp_pool/{id}', 'LoginClienteWhatsappPoolController@destroy');
				
				Route::resource('login_cliente_whatsapp_pool', 'LoginClienteWhatsappPoolController');
                router_resourceapi("login_cliente_whatsapp_pool", "LoginClienteWhatsappPoolController");
				
				*/

        
		public function testheader(Request $request){

				  $o_auth_header  = $GLOBALS["auth_header"] ;
				  return array("msg"=>"Teste", "header" => $o_auth_header );
		}

        
	
	private function loadRequests(Request $request, \App\LoginClienteWhatsappPool &$reg){

            $id_origem_cliente = $request->input('id_origem_cliente');
            if (  $id_origem_cliente ){
                
                $id_cliente            = \App\Http\Dao\ConfigDao::getIDByOrigem($id_origem_cliente, "cliente");
                $id_login_cliente      = \App\Http\Dao\LoginClienteDao::getByIdCliente($id_cliente);
                $reg->id_login_cliente = $id_login_cliente;
            }
            
            //$reg->id_login_cliente = $request->input('id_login_cliente');  
            $reg->id_materia = $request->input('id_origem');  
            $reg->status = 0 ;// $request->input('status');  
            $reg->data_cadastro = \App\Http\Service\UtilService::getCurrentBDdate(); // $request->input('data_cadastro');  
            //$reg->data_envio = $request->input('data_envio');  
            $reg->contatos_envio = $request->input('id_origem_contato');  
            $reg->data_materia =  \App\Http\Service\UtilService::getCurrentBDdate(); //$request->input('data_materia');  
            $reg->robo = 1 ;
            
            if ( $request->input('robo') != "" ){
                $reg->robo = $request->input('robo');
            }  
            $reg->texto = $request->input('texto');  
		
	    if ( $request->input('id_origem') != "" ){

                 $idtmp = ConfigDao::executeScalar("select id as res from login_cliente_whatsapp_pool where id_materia = ". $request->input('id_origem'));
                 if ( $idtmp != ""){
                      $reg->id = $idtmp;
                 }
            }
            ConfigDao::blankToNull(  $reg );

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
		$reg = new \App\LoginClienteWhatsappPool;

		$this->loadRequests($request, $reg);
		
		$ret = $reg->save();

		$msg = "sucesso!"; $code = 1;
		if (! $ret  ){
                            $code = 0;
                            $msg = "erro";
		}

                    $final = array("msg"=>$msg, "code" =>  $code , "success" => $ret, 
                                  "data"=> \App\Http\Dao\LoginClienteWhatsappPoolDao::mostraItem(  $reg) );
					   
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
		   $id_tmp = ConfigDao::executeScalar("select id as res from login_cliente_whatsapp_pool where id_materia  = ". $id );
                   
                   if ( $id_tmp == ""){
                       return $this->sendErro(array("msg" => "Id Origem não localizado"));
                   }
		   $reg = LoginClienteWhatsappPool::find($id_tmp);

          
                   $final =  array( "code" =>  1, "data"=> \App\Http\Dao\LoginClienteWhatsappPoolDao::mostraItem(  $reg ) );
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
		   $id_tmp = ConfigDao::executeScalar("select id as res from login_cliente_whatsapp_pool where id_materia  = ". $id );
		   $reg = LoginClienteWhatsappPool::find($id_tmp);

		   $this->loadRequests($request, $reg);

			$ret = $reg->save();

		     $msg = "sucesso!"; $code = 1;
		    
                     if (! $ret  ){
                             $code = 0;
	                    $msg = "erro";
		     }
			
           
                     $final = array("msg"=>$msg, "code" =>  $code , "success" => $ret, "data"=> \App\Http\Dao\LoginClienteWhatsappPoolDao::mostraItem(  $reg) );
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
		$id_tmp = ConfigDao::executeScalar("select id as res from login_cliente_whatsapp_pool where id_materia  = ". $id );
                if ( $id_tmp == ""){
                       return $this->sendErro(array("msg" => "Id Origem não localizado"));
                }
		$reg = LoginClienteWhatsappPool::find($id_tmp);
		$ret = $reg->delete();
		
		$final =  array("msg"=>"sucesso", "code" =>  1 , "success" => $ret, "data"=> \App\Http\Dao\LoginClienteWhatsappPoolDao::mostraItem(  $reg) );
		
		return $this->sendResponse( $final  );
	}
        
        

}
