<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Service\ErrorsService;

use Illuminate\Http\Request;
use App\ClienteConfiguracao;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class TopicoController extends Controller {


        public function saveJsonData(Request $request){

		$data = $request->input("data");

		if ( $data == ""){

		       return $this->sendErro( array( "code"=>0,"msg"=>"O campo data esta vazio"  ));
		}

		$itens = \App\Http\Dao\ClassesClienteDao::salvarDadosByJsonOrigem ($data );

		return $this->sendResponse( $itens );
	}
    
    
}
