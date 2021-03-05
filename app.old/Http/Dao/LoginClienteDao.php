<?php
namespace App\Http\Dao;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;

use App\LoginCliente;

class LoginClienteDao {
    
    
    
        public static function getLoginRegistros(){
            $sql = " select p.id, p.nome, p.id_registro_importado as id_origem,
                                p.robo, c.nome as cliente_nome, c.id_registro_importado as id_origem_cliente
                           from login_cliente_registros p
                           left join login_cliente lc on lc.id = p.id_login_cliente
                           left join cliente c on c.id = lc.cod_cliente  where 1 = 1 ";
            
            return $sql;
            
            
        }
    
       public static function getListGridCad($filtro, $order, $order_type){
           
             $sql = "select p.* from login_cliente p where 1 = 1 ". $filtro .
                     " order by ".$order. " ".$order_type;
             
             $itens = DB::select($sql);
             

             for ($i=0; $i < count( $itens) ; $i++) { 
                    $item = &$itens[$i];
                    $valor = $item->data;
                    
                    
                   // $item->data = $this->DataBR($valor, true); //Colocando como formato BR
             }
             
             return $itens;
           
       }
       
       public static function getByIdCliente($id_cliente){
           $sql = "select id as res from login_cliente where cod_cliente = '".$id_cliente."' ";
           $id_tmp = ConfigDao::executeScalar($sql);
           
           if ( $id_tmp ){
               return $id_tmp;
           }
           
           $reg_cliente = \App\Cliente::find($id_cliente);
           
           if ( !$reg_cliente ){
               return -1;
           }
           $reg = new LoginCliente();
           $reg->cod_cliente = $id_cliente;
           $reg->nome = $reg_cliente->nome;
           $reg->ativo = 1;
           $reg->save();
           
           return $reg->id;
           
       }
    
       public static function salvarDadosJson( $hd_json, $ids_delete_json ){
           
           $itens = json_decode($hd_json);
           $ids_delete = json_decode($ids_delete_json);
           
           $qtde_salvo = 0; $qtde_delete = 0;
           
           for ( $i = 0; $i < count($itens); $i++){
                           
                       $item_req = $itens[$i];    
                       
                       $reg = new LoginCliente();
                       
                       if ( $item_req->id != ""){
                             $reg = LoginCliente::find($item_req->id);
                       }
					            $reg->nome = $item_req->nome;   
         $reg->login = $item_req->login;   
         $reg->senha = $item_req->senha;   
         $reg->tipo = $item_req->tipo;   
   $reg->ativo = ConfigDao::numeroBanco(  $item_req->ativo  );  
         $reg->email = $item_req->email;   
   $reg->ano = ConfigDao::numeroBanco(  $item_req->ano  );  
   $reg->servidor = ConfigDao::numeroBanco(  $item_req->servidor  );  
   $reg->sequencial = ConfigDao::numeroBanco(  $item_req->sequencial  );  
         $reg->modulos = $item_req->modulos;   
         $reg->status = $item_req->status;   
         $reg->idtablet = $item_req->idtablet;   
         $reg->agrupamento = $item_req->agrupamento;   
   $reg->email_attc_msg = ConfigDao::numeroBanco(  $item_req->email_attc_msg  );  
         $reg->cod_cliente = $item_req->cod_cliente;   
         $reg->nome_cliente = $item_req->nome_cliente;   
         $reg->layout_email = $item_req->layout_email;   
   $reg->id_exibido = ConfigDao::numeroBanco(  $item_req->id_exibido  );  
         $reg->id_monitoramento_scup = $item_req->id_monitoramento_scup;   
   $reg->feed_configuravel = ConfigDao::numeroBanco(  $item_req->feed_configuravel  );  
                       
                       
                       ConfigDao::blankToNull($reg);
                       
		       $ret = $reg->save();
                       $qtde_salvo++;
           }
           
           for ( $i = 0; $i < count($ids_delete); $i++){
               $item_req = $ids_delete[$i];
               
                 if ( $item_req != ""){
                             $reg = LoginCliente::find($item_req);
                             $reg->delete();//Removendo o item desejado para deletar.
                             $qtde_delete++;
                 }
           }
           
           return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
           
       }
       
       
        
}

