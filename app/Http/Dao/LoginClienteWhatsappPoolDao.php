<?php
namespace App\Http\Dao;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;

use App\LoginClienteWhatsappPool;

class LoginClienteWhatsappPoolDao {
    
    
      public static function getLista(){
            $sql = " select p.id, p.texto, p.id_materia as id_origem,
                                p.status, p.data_cadastro, p.contatos_envio as id_origem_contato
                           from  login_cliente_whatsapp_pool p 
                           where 1 = 1 ";
            
            return $sql;
            
            
        }
        public static function mostraItem($reg){
            $sql = self::getLista()." and p.id = ". $reg->id;
            
            $ls =  DB::select($sql);
            
            if ( count($ls) > 0 ){
                return $ls[0];
            }
        }
    
       public static function getListGridCad($filtro, $order, $order_type){
           
             $sql = "select p.* from login_cliente_whatsapp_pool p where 1 = 1 ". $filtro .
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
                       
                       $reg = new LoginClienteWhatsappPool();
                       
                       if ( $item_req->id != ""){
                             $reg = LoginClienteWhatsappPool::find($item_req->id);
                       }
					      $reg->id_login_cliente = ConfigDao::numeroBanco(  $item_req->id_login_cliente  );  
         $reg->id_materia = $item_req->id_materia;   
   $reg->status = ConfigDao::numeroBanco(  $item_req->status  );  
   $reg->data_cadastro = ConfigDao::dataBanco(  $item_req->data_cadastro  );  
   $reg->data_envio = ConfigDao::dataBanco(  $item_req->data_envio  );  
         $reg->contatos_envio = $item_req->contatos_envio;   
   $reg->data_materia = ConfigDao::dataBanco(  $item_req->data_materia  );  
   $reg->robo = ConfigDao::numeroBanco(  $item_req->robo  );  
                       
                       
                       ConfigDao::blankToNull($reg);
                       
		       $ret = $reg->save();
                       $qtde_salvo++;
           }
           
           for ( $i = 0; $i < count($ids_delete); $i++){
               $item_req = $ids_delete[$i];
               
                 if ( $item_req != ""){
                             $reg = LoginClienteWhatsappPool::find($item_req);
                             $reg->delete();//Removendo o item desejado para deletar.
                             $qtde_delete++;
                 }
           }
           
           return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
           
       }
       
       
        
}

