<?php
namespace App\Http\Dao;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;

use App\AssociacaoMateriaRadiotvJornal;

class AssociacaoMateriaRadiotvJornalDao {
    
       public static function getListGridCad($filtro, $order, $order_type){
           
             $sql = "select p.* from associacao_materia_radiotv_jornal p where 1 = 1 ". $filtro .
                     " order by ".$order. " ".$order_type;
             
             $itens = DB::select($sql);
             

             for ($i=0; $i < count( $itens) ; $i++) { 
                    $item = &$itens[$i];
                    $valor = $item->data;
                    
                    
                   // $item->data = $this->DataBR($valor, true); //Colocando como formato BR
             }
             
             return $itens;
           
       }
    
       public static function salvarDadosJson( $hd_json, $ids_delete_json ){
           
           $itens = json_decode($hd_json);
           $ids_delete = json_decode($ids_delete_json);
           
           $qtde_salvo = 0; $qtde_delete = 0;
           
           for ( $i = 0; $i < count($itens); $i++){
                           
                       $item_req = $itens[$i];    
                       
                       $reg = new AssociacaoMateriaRadiotvJornal();
                       
                       if ( $item_req->id != ""){
                             $reg = AssociacaoMateriaRadiotvJornal::find($item_req->id);
                       }
					      $reg->servidor = ConfigDao::numeroBanco(  $item_req->servidor  );  
   $reg->sequencial = ConfigDao::numeroBanco(  $item_req->sequencial  );  
   $reg->ano = ConfigDao::numeroBanco(  $item_req->ano  );  
         $reg->id_materia_radiotv_jornal = $item_req->id_materia_radiotv_jornal;   
   $reg->id_entidade = ConfigDao::numeroBanco(  $item_req->id_entidade  );  
   $reg->id_tipo_entidade = ConfigDao::numeroBanco(  $item_req->id_tipo_entidade  );  
         $reg->id_categoria = $item_req->id_categoria;   
         $reg->tabela_importado = $item_req->tabela_importado;   
         $reg->banco_importado = $item_req->banco_importado;   
         $reg->id_registro_importado = $item_req->id_registro_importado;   
         $reg->classificacao = $item_req->classificacao;   
   $reg->data_envio_email = ConfigDao::dataBanco(  $item_req->data_envio_email  );  
   $reg->data_materia = ConfigDao::dataBanco(  $item_req->data_materia  );  
   $reg->id_veiculo = ConfigDao::numeroBanco(  $item_req->id_veiculo  );  
   $reg->id_emissora = ConfigDao::numeroBanco(  $item_req->id_emissora  );  
                       
                       
                       ConfigDao::blankToNull($reg);
                       
		       $ret = $reg->save();
                       $qtde_salvo++;
           }
           
           for ( $i = 0; $i < count($ids_delete); $i++){
               $item_req = $ids_delete[$i];
               
                 if ( $item_req != ""){
                             $reg = AssociacaoMateriaRadiotvJornal::find($item_req);
                             $reg->delete();//Removendo o item desejado para deletar.
                             $qtde_delete++;
                 }
           }
           
           return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
           
       }
       
       
        
}

