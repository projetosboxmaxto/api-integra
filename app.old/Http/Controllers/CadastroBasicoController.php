<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Service\ErrorsService;

use Illuminate\Http\Request;
use App\CadastroBasico;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Dao\CadastroBasicoDao;

class CadastroBasicoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request, $tipo)
	{
	      $filtro = "";
              $order = " id "; $order_type = "desc";
              
              if ( $request->input( "filtro")  != ""){
                         	$str_filt = str_replace("'","''", $request->input( "filtro") );
                        	$filtro .= " and ( descricao like '%".$str_filt."%'  ) ";
               }

              if ( $tipo  != ""){
                        $filtro .= " and tipo_cadastro_basico = " .  $tipo;
              }

              $itens = CadastroBasicoDao::getListGridCad($filtro);
			  return $this->sendResponse( array("data" => $itens , "qtde" =>  count($itens) ) );
				
	}
	public function indexPraca(Request $request)
	{
		return $this->index($request, 4);
	}
	public function indexImpacto(Request $request)
	{
		return $this->index($request, 3);
	}
	

	public function saveJsonData(Request $request, $tipo){

		$data = $request->input("data");

		if ( $data == ""){

		       return $this->sendErro( array( "code"=>0,"msg"=>"O campo data esta vazio"  ));
		}

		$itens = CadastroBasicoDao::salvarDadosJson($data, $tipo );

		return $this->sendResponse( $itens );
	}

	public function saveJsonPraca(Request $request){

		return $this->saveJsonData($request, 4 );
	}
	public function saveJsonImpacto(Request $request){

		return $this->saveJsonData($request, 3 );
	}

	public function deleteData(Request $request, $tipo){
		$ids_delete_json = $request->input("data");
		$itens = CadastroBasicoDao::removeByIds($ids_delete_json, $tipo);
		return $this->sendResponse( $itens );
	}


	public function deletePraca(){
		return $this->deleteData( $request, 4  );
	}


	

	public function deleteImpacto(){
		return $this->deleteData( $request, 3  );
	}
	
	/*
	            Route::get('/api/cadastro_basico', 'CadastroBasicoController@index');
                Route::get('/api/cadastro_basico/{id}', 'CadastroBasicoController@show');
                Route::put('/api/cadastro_basico/{id}', 'CadastroBasicoController@update');
                Route::post('/api/cadastro_basico', 'CadastroBasicoController@create');
                Route::delete('/api/cadastro_basico/{id}', 'CadastroBasicoController@destroy');
				
				Route::resource('cadastro_basico', 'CadastroBasicoController');
                router_resourceapi("cadastro_basico", "CadastroBasicoController");
				
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


                         $sql = " select count(*) as res from cadastro_basico where 1 = 1 ".$filtro ;
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

                         $sql = "select p.* from cadastro_basico p where 1 = 1 ". $filtro . " order by ".$order. " ".$order_type .
						    $this->get_limit_sql(  $inicio,  $pagesize) ;
                         $itens = DB::select($sql);
                         //OFFSET 50 ROWS FETCH NEXT 100 ROWS ONLY 

                         $saida = array("page"=>$page, "pagesize" => $pagesize, "order"=>$order,
                          "total"=>$total_itens, "total_itens"=> $total_itens,
                          "order_type"=> $order_type, "itens" =>  $itens);

                         return $saida;
		
		
	}
	
	private function loadRequests(Request $request, \App\CadastroBasico &$reg){

          $reg->descricao = $request->input('descricao');  
  $reg->tipo_cadastro_basico = $request->input('tipo_cadastro_basico');  
  $reg->servidor = $request->input('servidor');  
  $reg->ano = $request->input('ano');  
  $reg->sequencial = $request->input('sequencial');  
  $reg->tipo = $request->input('tipo');  
  $reg->id_registro_importado = $request->input('id_registro_importado');  
  $reg->tabela_importado = $request->input('tabela_importado');  
  $reg->campo1 = $request->input('campo1');  
  $reg->campo2 = $request->input('campo2');  
  $reg->campo3 = $request->input('campo3');  
		
		
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
		$reg = new \App\CadastroBasico;

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
		
		   $reg = CadastroBasico::find($id);

          
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
		   $reg = CadastroBasico::find($id);

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
		$reg = CadastroBasico::find($id);
		$ret = $reg->delete();
		
		$final =  array("msg"=>"sucesso", "code" =>  1 , "success" => $ret, "data"=> $reg);
		
		return $this->sendResponse( $final  );
	}
        
        

}
