<?php
namespace App\Http\Dao;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;
use App\Http\Dao\CadastroBasicoDao;

use App\Emissora;

class EmissoraDao {
    
       public static function getListGridCad($filtro, $order = "id", $order_type = "desc"){
           
             $sql = "select p.id, p.nome, p.id_registro_importado as id_origem, "
                     . " case when p.id_veiculo = 13 then 'tv'"
                     . " when p.id_veiculo = 14 then 'radio'"
                     . " else '' end as veiculo, pra.id as id_praca, p.com_stream as habilita_stream,"
                     . " p.uf, p.transcricao_url as transcricao_url, p.transcricao_url2 as transcricao_url2 "
                     . "  from emissora p "
                     . " left join cadastro_basico pra on pra.id = p.id_praca "
                     . " where 1 = 1 ". $filtro .
                     " order by ".$order. " ".$order_type;
             //die( $sql );
             $itens = DB::select($sql);
             
             return $itens;
           
       }
       
       public static function getById($id){
           $ls = self::getListGridCad(" and p.id = ". $id );
           
           if ( count($ls) > 0 ){
               return $ls[0];
           }
           return null;
       }
    
       public static function salvarDadosJson( $hd_json, $ids_delete_json = "" ){
           
           $itens = json_decode($hd_json);
           
           $qtde_salvo = 0; $qtde_delete = 0;
           $ids = "0";
           
           for ( $i = 0; $i < count($itens); $i++){
                           
                       $item_req = $itens[$i];    
                       
                       $reg = new Emissora();
                       
                       if ( property_exists($item_req, "id_origem") && $item_req->id_origem != ""){
                             $id_tmp = ConfigDao::getIDByOrigem($item_req->id_origem , "emissora");
                             
                             if ( $id_tmp != ""){
                                       $reg = Emissora::find($id_tmp);
                             }
                             
                                $reg->id_registro_importado = $item_req->id_origem ;  
                       }
                       
                       
                       if ( property_exists($item_req, "id_praca") && $item_req->id_praca != ""){
                           
                            $reg->id_praca = $item_req->id_praca ;//CadastroBasicoDao::getIDByOrigem($item_req->id_praca, 4); // CadastroBasicoDao::getIDByOrigem($item_req->id_praca, 4);  
                       }
                       $reg->id_veiculo =  13;
                        
                       if ( property_exists($item_req, "veiculo") && $item_req->veiculo != ""){
                           
                           if (strtolower($item_req->veiculo) == "radio"  || strtolower($item_req->veiculo) == "rádio"){
                                 $reg->id_veiculo =  14;
                           }
                           
                           if (strtolower($item_req->veiculo) == "tv" ){
                                 $reg->id_veiculo =  13;
                           }
                           
                       }
                        $reg->com_stream = 0;
                        if ( property_exists($item_req, "habilita_stream") && $item_req->habilita_stream != ""){
                              $reg->com_stream = ConfigDao::numeroBanco(  $item_req->habilita_stream );  
                        }
                        
                        if ( property_exists($item_req, "id_exibicao") && $item_req->id_exibicao != ""){
                         //     $reg->com_stream = ConfigDao::numeroBanco(  $item_req->habilita_stream );  
                        }
                        $reg->modelo_streaming = 2; //a cada 5 minutos gera um novo arquivo.
                        $reg->tabela_importado = ConfigDao::getTabela();   
			$reg->nome = $item_req->nome;   
                        
                        if ( property_exists($item_req, "url_stream_hd") && $item_req->url_stream_hd != ""){
                              $reg->url_stream_hd2 = $item_req->url_stream_hd ;  
                        }
                        if ( property_exists($item_req, "url_stream_sd") && $item_req->url_stream_sd != ""){
                              $reg->url_stream_sd2 = $item_req->url_stream_sd ;  
                        }
                        if ( property_exists($item_req, "transcricao_url2") && $item_req->transcricao_url2 != ""){
                              $reg->transcricao_url2 = $item_req->transcricao_url2 ;  
                        }
                          if ( property_exists($item_req, "transcricao_url") && $item_req->transcricao_url != ""){
                              $reg->transcricao_url = $item_req->transcricao_url ;  
                        }
                        
                         if ( property_exists($item_req, "uf") && $item_req->uf != ""){
                             $reg->uf = $item_req->uf;  
                        }
                               // $reg->servidor = ConfigDao::numeroBanco(  $item_req->servidor  );  
                               // $reg->sequencial = ConfigDao::numeroBanco(  $item_req->sequencial  );  
                               // $reg->ano = ConfigDao::numeroBanco(  $item_req->ano  );  
                         /*       $reg->id_veiculo = ConfigDao::numeroBanco(  $item_req->id_veiculo  );  
                                     
                                $reg->id_exibido = ConfigDao::numeroBanco(  $item_req->id_exibido  );  
                                      $reg->id_forma_cobranca = $item_req->id_forma_cobranca;   
                                $reg->preco_visualizacao = ConfigDao::numeroBanco(  $item_req->preco_visualizacao  );  
                                      $reg->banco_importado = $item_req->banco_importado;   
                                      $reg->sigla = $item_req->sigla;   
                                      $reg->preco_revista = $item_req->preco_revista;   
                                      $reg->classificacao = $item_req->classificacao;   
                                $reg->id_regiao = ConfigDao::numeroBanco(  $item_req->id_regiao  );  
                                         
                              
                                      $reg->url_stream_sd = $item_req->url_stream_sd;   
                                      $reg->url_stream_hd = $item_req->url_stream_hd;   
                                      $reg->audiencia = $item_req->audiencia;   
                                      $reg->site = $item_req->site;   
                                $reg->modelo_streaming = ConfigDao::numeroBanco(  $item_req->modelo_streaming  );  
                                      $reg->url_stream_sd2 = $item_req->url_stream_sd2;   
                                      $reg->url_stream_hd2 = $item_req->url_stream_hd2;   
                                      $reg->transcricao_qualidade = $item_req->transcricao_qualidade;   
                                      $reg->transcricao_url = $item_req->transcricao_url;   
                                      $reg->transcricao_url2 = $item_req->transcricao_url2; 
                          * 
                          */  
                       
                       
                       ConfigDao::blankToNull($reg);
                       ConfigDao::configuraChave ($reg, "emissora");
                       
		       $ret = $reg->save();
                       $qtde_salvo++;
                       $ids .=", ". $reg->id;
           }
           
           if ( $ids_delete_json != ""){
                        $ids_delete = json_decode($ids_delete_json);
                        for ( $i = 0; $i < count($ids_delete); $i++){
                            $item_req = $ids_delete[$i];

                              if ( $item_req != ""){
                                          $reg = Emissora::find($item_req);
                                          $reg->delete();//Removendo o item desejado para deletar.
                                          $qtde_delete++;
                              }
                        }
           }
           
           $ls_data = self::getListGridCad(" and p.id in ( ". $ids . ") ");
           
           return array("qtde" => $qtde_salvo, "data" => $ls_data);
          // return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
           
       }
       
       
        
}

