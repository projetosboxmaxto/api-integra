<?php
namespace App\Http\Dao;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;

use App\Arquivos;

class ArquivosDao {
    
       public static function getListGridCad($filtro, $order, $order_type){
           
             $sql = "select p.* from arquivos p where 1 = 1 ". $filtro .
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
                       
                       $reg = new Arquivos();
                       
                       if ( $item_req->id != ""){
                             $reg = Arquivos::find($item_req->id);
                       }
					            $reg->id_materia = $item_req->id_materia;   
   $reg->servidor = ConfigDao::numeroBanco(  $item_req->servidor  );  
   $reg->sequencial = ConfigDao::numeroBanco(  $item_req->sequencial  );  
   $reg->ordem = ConfigDao::numeroBanco(  $item_req->ordem  );  
         $reg->nome = $item_req->nome;   
   $reg->tamanho = ConfigDao::numeroBanco(  $item_req->tamanho  );  
         $reg->tipo = $item_req->tipo;   
   $reg->id_tipo = ConfigDao::numeroBanco(  $item_req->id_tipo  );  
   $reg->data_cadastro = ConfigDao::dataBanco(  $item_req->data_cadastro  );  
         $reg->duracao = $item_req->duracao;   
   $reg->duracao_segundos = ConfigDao::numeroBanco(  $item_req->duracao_segundos  );  
   $reg->id_associado = ConfigDao::numeroBanco(  $item_req->id_associado  );  
         $reg->codigo = $item_req->codigo;   
   $reg->ano = ConfigDao::numeroBanco(  $item_req->ano  );  
         $reg->tabela = $item_req->tabela;   
         $reg->thumb = $item_req->thumb;   
         $reg->flv_file = $item_req->flv_file;   
         $reg->url_drive = $item_req->url_drive;   
                       
                       
                       ConfigDao::blankToNull($reg);
                       
		       $ret = $reg->save();
                       $qtde_salvo++;
           }
           
           for ( $i = 0; $i < count($ids_delete); $i++){
               $item_req = $ids_delete[$i];
               
                 if ( $item_req != ""){
                             $reg = Arquivos::find($item_req);
                             $reg->delete();//Removendo o item desejado para deletar.
                             $qtde_delete++;
                 }
           }
           
           return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
           
       }
       
       
        
}

