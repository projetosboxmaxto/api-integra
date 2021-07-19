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

//Essa classe vai substituir a página handlerMateriaRtv.aspx
class IntegradorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    
        public function getnewid(Request $request)
        {
            
           $dr = new \App\MateriaRadiotvJornal();
           ConfigDao::configuraChave($dr, "materia_radiotv_jornal");
           echo "TESTE 2";die;  
            $obj_saida = array(
                "id"=>"",
                "servidor"=>$dr->servidor,
                "ano"=>$dr->ano,
                "sequencial"=>$dr->sequencial,
                "meta_dados"=>array(),
                "clientes"=>array(),
                "impactos"=>array(),
                "integrador"=>1
            );
            
            $meta_dados = array();
            $clientes = array();
            $impactos = array();

            if ($request->input("arquivos") == "1")
            {
                $drarquivo = new \App\Arquivos();
                ConfigDao::configuraChave($drarquivo, "arquivos");

                $arquivo = 
                        (object) array("id"=>$drarquivo->id,"ano"=>$drarquivo->ano, "sequencial"=>$drarquivo->sequencial,
                            "servidor"=>$drarquivo->servidor );
                   
                $meta_dados[count($meta_dados)] = array("Codigo"=>"arquivo",
                    "Nome"=> $drarquivo->id.";".$drarquivo->servidor.";".$drarquivo->ano.";".$drarquivo->sequencial  );
                //obj_saida.arquivo = obj_saida;
            }

            if ( $request->input("clientes") != "")
            {
                $qtde = $request->input("clientes");

                for ($i = 0; $i < $qtde; $i++)
                {
                    
                    $dr_impacto = new \App\AvaliacaoImpacto();
                    ConfigDao::configuraChave($dr_impacto, "avaliacao_impacto");

                    $dr_associacao = new \App\AssociacaoMateriaRadiotvJornal();
                    ConfigDao::configuraChave($dr_associacao, "associacao_materia_radiotv_jornal");
                    
                    $impactos[count($impactos)] = array("Codigo"=>$dr_impacto->id,
                        "Nome"=> $dr_impacto->servidor .";". $dr_impacto->ano .";".$dr_impacto->sequencial );
                    
                    
                    $clientes[count($clientes)] = array("Codigo"=>$dr_associacao->id,
                        "Nome"=> $dr_associacao->servidor .";". $dr_associacao->ano .";".$dr_associacao->sequencial );

                  
                }
            }
            $obj_saida["meta_dados"] = $meta_dados;
            $obj_saida["impactos"] = $impactos;
            $obj_saida["clientes"] = $clientes;

            
           return $this->sendResponse($obj_saida);
        }
	public function index(Request $request)
	{
            $acao = $request->input("acao");
            $id = $request->input("id");
            
             if ($acao == "path_rtv")
             {
                 $ano = date("Y");
                 $mes = date("m");
                 $mes = (int)$mes;
                            $valor = \App\Http\Service\IntegradorService::getPastaMateria(3,$ano , $mes );
                            
                            $saida = array("Codigo"=>$valor,"Nome"=> \App\Http\Service\IntegradorService::getPrefixoModulo(3)."/".$ano."/".$mes );
                            
                            return $this->sendResponse($saida);
            }
            
            if ($acao == "get_new_id")
            {
                $dr = new \App\MateriaRadiotvJornal();
                ConfigDao::configuraChave($dr, "materia_radiotv_jornal");
                
                $saida = array("Codigo"=>$dr->id, "Nome" => $dr->servidor. ";" . $dr->ano .";". $dr->sequencial, "Integrador"=>1 );
                
                 $mes = date("m");
                 $mes = (int)$mes;
                \App\Http\Service\IntegradorService::getPastaMateria(3, date("Y"), $mes);
                
                
                return $this->sendResponse($saida);
               

            }
            
            
        if ($acao == "completa_materia" && $id != "")
        {

            $dr_materia = \App\MateriaRadiotvJornal::find($id);  
            \App\Http\Dao\MateriaRadiotvJornalDao::garanteAssociacaoEntidadesPai($id, "materia_radiotv_jornal");
          

            $sql_temp = " select * from associacao_materia_radiotv_jornal where id_materia_radiotv_jornal = " .
                    $dr_materia->id;

            $dt_tmp = DB::select($sql_temp);
            
            for ($iii = 0; $iii < count($dt_tmp); $iii++)
            {
                $dr_avaliacao_impacto = new \App\AvaliacaoImpacto();
                $dr_item = $dt_tmp[$iii];

                $id_tmp = ConfigDao::executeScalar("select id from avaliacao_impacto where id_materia = " . 
                        $dr_materia->id . " and id_cliente = " . $dr_materia->id_entidade .  
                         " and tabela_materia='materia_radio_tv_jornal' ");

                if ( is_null($id_tmp) || $id_tmp == "")
                {
                    $dr_avaliacao_impacto->id_materia = $dr_materia->id;
                    $dr_avaliacao_impacto->id_cliente = $dr_item->id_entidade;
                    $dr_avaliacao_impacto->tabela_materia = "materia_radio_tv_jornal";
                    $dr_avaliacao_impacto->data_materia = $dr_materia->data_materia;
                    
                    if ( $dr_avaliacao_impacto->id_impacto == "" ){
                        $dr_avaliacao_impacto->id_impacto = ConfigDao::executeScalar(
                                      "select id_impacto from avaliacao_impacto where tabela_materia='materia_radio_tv_jornal' and id_materia = " .
                         $dr_materia->id . " limit 0, 1 ");
                                
                    }
                    
                    ConfigDao::configuraChave($dr_avaliacao_impacto, "avaliacao_impacto");
                    $dr_avaliacao_impacto->save();
                }
            }

              $saida = array("Codigo" => "Matéria completada com sucesso!",
                  "Nome" => $dr_materia->id." - Módulo: ". $dr_materia->id_modulo);
              
              
             return $this->sendResponse($saida);
        
        }
        
}
}