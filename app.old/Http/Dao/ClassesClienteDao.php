<?php
namespace App\Http\Dao;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;

use App\ClassesCliente;

class ClassesClienteDao {
    
       public static function getListGridCad($filtro, $order="id", $order_type="desc"){
           
             $sql = "select p.id, p.id_registro_importado as id_origem, nome  from classes_cliente p where 1 = 1 ". $filtro .
                     " order by ".$order. " ".$order_type;
             
             $itens = DB::select($sql);
             
             return $itens;
           
       }
       
       
       

       public static function salvarByNome($id_cliente, $nome, $id_origem){

         $nome = str_replace("'","", $nome );

         $filtro = " and lower(nome) = lower('".trim($nome)."') ";
         
         if ( $id_origem != ""){
             $filtro = " and ". ConfigDao::getColunaID() . "  = ". $id_origem . " and tabela_importado = '".ConfigDao::getTabela()."' "; 
         }
         
         $filtro .= " and id_cliente = ". $id_cliente;
         
         $sql = "select p.id as res from classes_cliente p where 1 = 1 ". $filtro;
         
         
         $res = ConfigDao::executeScalar($sql);
         
         $reg = new ClassesCliente();
         if ( $res != ""){
             
             $reg = ClassesCliente::find($res);
             // return $res;
         }
             
         $reg->id_cliente = $id_cliente;
         $reg->nome = $nome;
         $reg->tabela_importado = ConfigDao::getTabela();
         $reg->id_registro_importado = $id_origem;
         ConfigDao::configuraChave($reg, "dicionario_tags");
         ConfigDao::blankToNull($reg);
         
         $reg->status = 1;
         $reg->ativo = 1; 
         $reg->save();
         
         
         $reg->ordem = str_pad($reg->id, 8, "0", STR_PAD_LEFT);
         ConfigDao::blankToNull($reg);
         $reg->save();
         
         return $reg;
         
       }
       
       
       
          public static function salvarTopicosByJson($id_cliente, $hd_json){
           
           $saidas = array();
           
           $itens = json_decode($hd_json);
            for ( $i = 0; $i < count($itens); $i++){
                
                $item = $itens[$i];
                
                $palavra = $item->nome;
                $id_origem = "";
                
                if (property_exists($item, "id_origem")){
                     $id_origem =  $item->id_origem;
                }
                
                if ( trim($palavra) == "")
                    continue;
                
                $reg = self::salvarByNome($id_cliente, $palavra, $id_origem);
                
                $id_dicionario =$reg->id;
                if ( $reg->id_registro_importado != "" ){
                     $id_dicionario = $reg->id_registro_importado;
                }
                
                $saidas[count($saidas)]= array("id"=>$id_dicionario, "nome"=>$palavra);
            }
            
            return $saidas;
       }
       
        public static function salvarDadosByJsonOrigem( $hd_json, $ids_delete_json = "" ){
           
           $itens = json_decode($hd_json);
           
           $qtde_salvo = 0; $qtde_delete = 0;
           
           for ( $i = 0; $i < count($itens); $i++){
                           
                       $item_req = $itens[$i];    
                       
                        
                        $id_origem_cliente = @$item_req->id_cliente;
                        
                        $id_cliente = ConfigDao::getIDByOrigem($id_origem_cliente, "cliente");
                        
                        if ( $id_cliente != ""){
                            
                               self::salvarByNome($id_cliente, $item_req->nome , $item_req->id_origem);
                               $qtde_salvo++;
                        }
                        
                        
                        /* $reg->id_cliente = ConfigDao::numeroBanco(  $item_req->id_cliente  );  
                        $reg->servidor = ConfigDao::numeroBanco(  $item_req->servidor  );  
                        $reg->ano = ConfigDao::numeroBanco(  $item_req->ano  );  
                        $reg->sequencial = ConfigDao::numeroBanco(  $item_req->sequencial  );  
                        $reg->id_pai = $item_req->id_pai;   
                        $reg->nivel = $item_req->nivel;   
                        $reg->ordem = $item_req->ordem;   
                        $reg->status = ConfigDao::numeroBanco(  $item_req->status  );  
                        $reg->id_registro_importado = ConfigDao::numeroBanco(  $item_req->id_registro_importado  );  
                        $reg->tabela_importado = $item_req->tabela_importado;    
                       
                       
                       ConfigDao::blankToNull($reg);
                       
		       $ret = $reg->save();
                         * 
                         */
           }
           
           if ( $ids_delete_json != ""){
                            $ids_delete = json_decode($ids_delete_json);
                            for ( $i = 0; $i < count($ids_delete); $i++){
                                $item_req = $ids_delete[$i];

                                  if ( $item_req != ""){
                                              $reg = ClassesCliente::find($item_req);
                                              $reg->delete();//Removendo o item desejado para deletar.
                                              $qtde_delete++;
                                  }
                            }
           }
           
           return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
           
       }
    
       public static function salvarDadosJson( $hd_json, $ids_delete_json ){
           
           $itens = json_decode($hd_json);
           $ids_delete = json_decode($ids_delete_json);
           
           $qtde_salvo = 0; $qtde_delete = 0;
           
           for ( $i = 0; $i < count($itens); $i++){
                           
                       $item_req = $itens[$i];    
                       
                       $reg = new ClassesCliente();
                       
                       if ( @$item_req->id != ""){
                             $reg = ClassesCliente::find($item_req->id);
                       }
			$reg->nome = $item_req->nome;  
                        
                        $id_origem_cliente = @$item_req->id_cliente;
                        
                        $id_cliente = ConfigDao::getIDByOrigem($id_origem_cliente, "cliente");
                        
                        $this->salvarByNome($id_cliente, $reg->nome , $item_req->id_origem);
                        
                        /* $reg->id_cliente = ConfigDao::numeroBanco(  $item_req->id_cliente  );  
                        $reg->servidor = ConfigDao::numeroBanco(  $item_req->servidor  );  
                        $reg->ano = ConfigDao::numeroBanco(  $item_req->ano  );  
                        $reg->sequencial = ConfigDao::numeroBanco(  $item_req->sequencial  );  
                        $reg->id_pai = $item_req->id_pai;   
                        $reg->nivel = $item_req->nivel;   
                        $reg->ordem = $item_req->ordem;   
                        $reg->status = ConfigDao::numeroBanco(  $item_req->status  );  
                        $reg->id_registro_importado = ConfigDao::numeroBanco(  $item_req->id_registro_importado  );  
                        $reg->tabela_importado = $item_req->tabela_importado;    
                       
                       
                       ConfigDao::blankToNull($reg);
                       
		       $ret = $reg->save();
                         * 
                         */
                       $qtde_salvo++;
           }
           
           for ( $i = 0; $i < count($ids_delete); $i++){
               $item_req = $ids_delete[$i];
               
                 if ( $item_req != ""){
                             $reg = ClassesCliente::find($item_req);
                             $reg->delete();//Removendo o item desejado para deletar.
                             $qtde_delete++;
                 }
           }
           
           return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
           
       }
       
       
        
}

