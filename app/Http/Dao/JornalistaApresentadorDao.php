<?php
namespace App\Http\Dao;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;

use App\JornalistaApresentador;

class JornalistaApresentadorDao {
    
       public static function getListGridCad($filtro, $order="id", $order_type="desc"){
           
             $sql = "select p.id, p.nome, p.id_registro_importado as id_origem from jornalista_apresentador p where 1 = 1 ". $filtro .
                     " order by ".$order. " ".$order_type;
             
             $itens = DB::select($sql);
             
             return $itens;
           
       }
    
       public static function salvarDadosJson( $hd_json, $id_programa = "", $ids_delete_json = "" ){
           
           $itens = json_decode($hd_json);
           
           $qtde_salvo = 0; $qtde_delete = 0; $ids = "0";
           
           for ( $i = 0; $i < count($itens); $i++){
                           
                       $item_req = (object)$itens[$i];    
                       
                       $reg = new JornalistaApresentador();
                       
                        if ( property_exists($item_req, "id_origem") && $item_req->id_origem != ""){
                             $id_tmp = ConfigDao::getIDByOrigem($item_req->id_origem , "jornalista_apresentador");
                             
                             if ( $id_tmp != ""){
                                       $reg = JornalistaApresentador::find($id_tmp);
                             }
                             
                                $reg->id_registro_importado = $item_req->id_origem ;  
                         }
                       
			 $reg->nome = $item_req->nome;   
                         $reg->tipo = 2;
                         //$reg->servidor = ConfigDao::numeroBanco(  $item_req->servidor  );  
                         //$reg->ano = ConfigDao::numeroBanco(  $item_req->ano  );  
                         //$reg->sequencial = ConfigDao::numeroBanco(  $item_req->sequencial  );  
                         //$reg->id_registro_importado = $item_req->id_registro_importado;   
                         $reg->tabela_importado = ConfigDao::getTabela();   
                            /*     
                        $reg->banco_importado = $item_req->banco_importado;   
                        $reg->login = $item_req->login;   
                        $reg->senha = $item_req->senha;   
                  $reg->tipo = ConfigDao::numeroBanco(  $item_req->tipo  );  
                        $reg->tx_veiculo = $item_req->tx_veiculo;   
                        $reg->tx_exibicao = $item_req->tx_exibicao;   
                        $reg->tx_programa = $item_req->tx_programa;   
                  $reg->influenciador = ConfigDao::numeroBanco(  $item_req->influenciador  );  
                  $reg->nota = ConfigDao::numeroBanco(  $item_req->nota  );  
                             * */
                             
                       ConfigDao::blankToNull($reg);
                       
		       $ret = $reg->save();
                       $qtde_salvo++;
                       
                       $id_apresentador = $reg->id;
                       $ids .= ",". $reg->id;
                       
                       if ( $id_programa != ""){
                           
                               AssociacaoCadastrosDao::salvar($reg->id, $id_programa, "jornalista_apresentador", "programa", "apresentadorxprograma");
                       }
                       
           }
           
           if ( $ids_delete_json != ""){
                $ids_delete = json_decode($ids_delete_json);
                for ( $i = 0; $i < count($ids_delete); $i++){
                    $item_req = $ids_delete[$i];

                      if ( $item_req != ""){
                                  $reg = JornalistaApresentador::find($item_req);
                                  $reg->delete();//Removendo o item desejado para deletar.
                                  $qtde_delete++;
                      }
                }
           }
           
           $ls = self::getListGridCad(" and p.id in ( ".$ids.") ");
           return $ls;
           //return array("qtde_salvo" => count($ls), "data" => $ls );
           
          // return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
           
       }
       
       
         public static function salvarDadosJsonByEmissora( $hd_json, $id_emissora = "", $ids_delete_json = "" ){
           
           $itens = json_decode($hd_json);
           
           $qtde_salvo = 0; $qtde_delete = 0; $ids = "0";
           
           for ( $i = 0; $i < count($itens); $i++){
                           
                       $item_req = (object)$itens[$i];    
                       
                       $reg = new JornalistaApresentador();
                       
                        if ( property_exists($item_req, "id_origem") && $item_req->id_origem != ""){
                             $id_tmp = ConfigDao::getIDByOrigem($item_req->id_origem , "jornalista_apresentador");
                             
                             if ( $id_tmp != ""){
                                       $reg = JornalistaApresentador::find($id_tmp);
                             }
                             
                                $reg->id_registro_importado = $item_req->id_origem ;  
                         }
                       
			 $reg->nome = $item_req->nome;   
                         $reg->tipo = 2;
                         //$reg->servidor = ConfigDao::numeroBanco(  $item_req->servidor  );  
                         //$reg->ano = ConfigDao::numeroBanco(  $item_req->ano  );  
                         //$reg->sequencial = ConfigDao::numeroBanco(  $item_req->sequencial  );  
                         //$reg->id_registro_importado = $item_req->id_registro_importado;   
                         $reg->tabela_importado = ConfigDao::getTabela();   
                            /*     
                        $reg->banco_importado = $item_req->banco_importado;   
                        $reg->login = $item_req->login;   
                        $reg->senha = $item_req->senha;   
                  $reg->tipo = ConfigDao::numeroBanco(  $item_req->tipo  );  
                        $reg->tx_veiculo = $item_req->tx_veiculo;   
                        $reg->tx_exibicao = $item_req->tx_exibicao;   
                        $reg->tx_programa = $item_req->tx_programa;   
                  $reg->influenciador = ConfigDao::numeroBanco(  $item_req->influenciador  );  
                  $reg->nota = ConfigDao::numeroBanco(  $item_req->nota  );  
                             * */
                             
                       ConfigDao::blankToNull($reg);
                       
		       $ret = $reg->save();
                       $qtde_salvo++;
                       
                       $id_apresentador = $reg->id;
                       $ids .= ",". $reg->id;
                       
                       //die(" id emissora? ". $id_emissora);
                       
                       if ( $id_emissora != ""){
                           
                               AssociacaoCadastrosDao::salvar($reg->id, $id_emissora, "jornalista_apresentador", "emissora", "apresentadorxemissora");
                       }
                       
           }
           
           if ( $ids_delete_json != ""){
                $ids_delete = json_decode($ids_delete_json);
                for ( $i = 0; $i < count($ids_delete); $i++){
                    $item_req = $ids_delete[$i];

                      if ( $item_req != ""){
                                  $reg = JornalistaApresentador::find($item_req);
                                  $reg->delete();//Removendo o item desejado para deletar.
                                  $qtde_delete++;
                      }
                }
           }
           
           $ls = self::getListGridCad(" and p.id in ( ".$ids.") ");
           return $ls;
           //return array("qtde_salvo" => count($ls), "data" => $ls );
           
          // return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
           
       }
       
        
}

