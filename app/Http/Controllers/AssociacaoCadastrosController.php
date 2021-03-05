<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Service\ErrorsService;

use Illuminate\Http\Request;
use App\AssociacaoCadastros;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Dao\ImageDao;
use App\Http\Dao\PostsDao;

class AssociacaoCadastrosController extends Controller {

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
                        	$filtro .= " and ( nome like '%".$str_filt."%' or email like '%".$str_filt."%' ) ";
               }

 		if ( $request->input( "order")  != ""){
			 $order = $request->input( "order");
		}
				
		if ( $request->input( "order_type")  != ""){
			 $order_type = $request->input( "order_type");
		}
               
               
                $sql = "select p.*"
                        . " from associacao_cadastros p where 1 = 1 ". $filtro . " order by ".$order. " ".$order_type ;
                $itens = DB::select($sql);
				
				return $this->sendResponse( $itens );
				
	}
	
	/*
	            Route::get('/api/associacao_cadastros', 'AssociacaoCadastrosController@index');
                Route::get('/api/associacao_cadastros/{id}', 'AssociacaoCadastrosController@show');
                Route::put('/api/associacao_cadastros/{id}', 'AssociacaoCadastrosController@update');
                Route::post('/api/associacao_cadastros', 'AssociacaoCadastrosController@create');
                Route::delete('/api/associacao_cadastros/{id}', 'AssociacaoCadastrosController@destroy');
				
				Route::resource('associacao_cadastros', 'AssociacaoCadastrosController');
                router_resourceapi("associacao_cadastros", "AssociacaoCadastrosController");
				
				*/

        
		public function testheader(Request $request){

				  $o_auth_header  = $GLOBALS["auth_header"] ;
				  return array("msg"=>"Teste", "header" => $o_auth_header );
		}

        
	
	public function grid(Request $request){
		
		
		         $filtro = ""; $str_filt = "";

                         $page = $request->input( "page");
                         $pagesize = $request->input( "pagesize");  

                         if ( $pagesize == "")
                         	$pagesize = 10;

                         if ( $page == "")
                         	$page = 1;

                         if ( $request->input( "filtro")  != ""){
                         	$str_filt = str_replace("'","''", $request->input( "filtro") );
                         	$filtro .= " and ( nome like '%".$str_filt."%' or email like '%".$str_filt."%' ) ";
                         }


                         $sql = " select count(*) as res from associacao_cadastros where 1 = 1 ".$filtro ;
                         $total_itens = $this->executeScalar(  $sql );

                         $inicio = 0; $fim = 0;
                         $this->SetaRsetPaginacao($pagesize, $page,$total_itens, $inicio, $fim);

                         $order = $request->input("order");
                         $order_type = $request->input("order_type");
                         if ( $order == ""){
                         	$order = "id";
                         }
                          if ( $order_type == ""){
                         	$order_type = "asc";
                         }

                         $sql = "select p.* from associacao_cadastros p where 1 = 1 ". $filtro . " order by ".$order. " ".$order_type .
						    $this->get_limit_sql(  $inicio,  $pagesize) ;
                         $itens = DB::select($sql);
                         //OFFSET 50 ROWS FETCH NEXT 100 ROWS ONLY 

                         $saida = array("page"=>$page, "pagesize" => $pagesize, "order"=>$order,
                          "total"=>$total_itens, "total_itens"=> $total_itens,
                          "order_type"=> $order_type, "itens" =>  $itens);

                         return $saida;
		
		
	}
	
	private function loadRequests(Request $request, \App\AssociacaoCadastros &$reg){

          $reg->id_pai = $request->input('id_pai');  
  $reg->tabela_pai = $request->input('tabela_pai');  
  $reg->tipo_pai = $request->input('tipo_pai');  
  $reg->id_filho = $request->input('id_filho');  
  $reg->tabela_filho = $request->input('tabela_filho');  
  $reg->tipo_filho = $request->input('tipo_filho');  
  $reg->classificacao = $request->input('classificacao');  
  $reg->sequencial = $request->input('sequencial');  
  $reg->ano = $request->input('ano');  
  $reg->servidor = $request->input('servidor');  
  $reg->tabela_importado = $request->input('tabela_importado');  
  $reg->banco_importado = $request->input('banco_importado');  
  $reg->id_registro_importado = $request->input('id_registro_importado');  
  $reg->data_referencia = $request->input('data_referencia');  
		
		
         PostsDao::blankToNull(  $reg );

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
		$reg = new \App\AssociacaoCadastros;

		$this->loadRequests($request, $reg);
		
		$ret = $reg->save();

		$msg = "sucesso!"; $code = 1;
		if (! $ret  ){
              $code = 0;
              $msg = "erro";
		}

         $final = array("msg"=>$msg, "code" =>  $code , "success" => $ret, "results"=> $reg,
                       "data"=> $reg, "item"=> $reg);
					   
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
		
		   $reg = AssociacaoCadastros::find($id);

          
           $final =  array( "code" =>  1, "data"=> $reg, "item"=> $reg);
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
		   $reg = AssociacaoCadastros::find($id);

		   $this->loadRequests($request, $reg);

			$ret = $reg->save();

		     $msg = "sucesso!"; $code = 1;
			if (! $ret  ){
                  $code = 0;
	              $msg = "erro";
			}
			
           
            $final = array("msg"=>$msg, "code" =>  $code , "success" => $ret, "data"=> $reg, "item" => $reg);
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
		$reg = AssociacaoCadastros::find($id);
		$ret = $reg->delete();
		
		$final =  array("msg"=>"sucesso", "code" =>  1 , "success" => $ret, "data"=> $reg);
		
		return $this->sendResponse( $final  );
	}
        
        

}
