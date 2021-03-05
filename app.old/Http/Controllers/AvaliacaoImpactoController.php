<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Service\ErrorsService;

use Illuminate\Http\Request;
use App\AvaliacaoImpacto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Dao\ImageDao;
use App\Http\Dao\PostsDao;

class AvaliacaoImpactoController extends Controller {

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
                        . " from avaliacao_impacto p where 1 = 1 ". $filtro . " order by ".$order. " ".$order_type ;
                $itens = DB::select($sql);
				
				return $this->sendResponse( $itens );
				
	}
	
	/*
	            Route::get('/api/avaliacao_impacto', 'AvaliacaoImpactoController@index');
                Route::get('/api/avaliacao_impacto/{id}', 'AvaliacaoImpactoController@show');
                Route::put('/api/avaliacao_impacto/{id}', 'AvaliacaoImpactoController@update');
                Route::post('/api/avaliacao_impacto', 'AvaliacaoImpactoController@create');
                Route::delete('/api/avaliacao_impacto/{id}', 'AvaliacaoImpactoController@destroy');
				
				Route::resource('avaliacao_impacto', 'AvaliacaoImpactoController');
                router_resourceapi("avaliacao_impacto", "AvaliacaoImpactoController");
				
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


                         $sql = " select count(*) as res from avaliacao_impacto where 1 = 1 ".$filtro ;
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

                         $sql = "select p.* from avaliacao_impacto p where 1 = 1 ". $filtro . " order by ".$order. " ".$order_type .
						    $this->get_limit_sql(  $inicio,  $pagesize) ;
                         $itens = DB::select($sql);
                         //OFFSET 50 ROWS FETCH NEXT 100 ROWS ONLY 

                         $saida = array("page"=>$page, "pagesize" => $pagesize, "order"=>$order,
                          "total"=>$total_itens, "total_itens"=> $total_itens,
                          "order_type"=> $order_type, "itens" =>  $itens);

                         return $saida;
		
		
	}
	
	private function loadRequests(Request $request, \App\AvaliacaoImpacto &$reg){

          $reg->id_impacto = $request->input('id_impacto');  
  $reg->id_cliente = $request->input('id_cliente');  
  $reg->id_materia = $request->input('id_materia');  
  $reg->tabela_materia = $request->input('tabela_materia');  
  $reg->servidor = $request->input('servidor');  
  $reg->ano = $request->input('ano');  
  $reg->sequencial = $request->input('sequencial');  
  $reg->id_categoria_cliente = $request->input('id_categoria_cliente');  
  $reg->cita_cliente = $request->input('cita_cliente');  
  $reg->classificacao = $request->input('classificacao');  
  $reg->classificacao_resultado = $request->input('classificacao_resultado');  
  $reg->data_materia = $request->input('data_materia');  
		
		
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
		$reg = new \App\AvaliacaoImpacto;

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
		
		   $reg = AvaliacaoImpacto::find($id);

          
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
		   $reg = AvaliacaoImpacto::find($id);

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
		$reg = AvaliacaoImpacto::find($id);
		$ret = $reg->delete();
		
		$final =  array("msg"=>"sucesso", "code" =>  1 , "success" => $ret, "data"=> $reg);
		
		return $this->sendResponse( $final  );
	}
        
        

}
