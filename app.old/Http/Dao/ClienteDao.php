<?php
namespace App\Http\Dao;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;

use App\Cliente;

class ClienteDao {
    
       public static function getListGridCad($filtro, $order = "p.id", $order_type = "desc"){
           
             $sql = "select p.id, p.id_registro_importado as id_origem, p.nome, p.fantasia, p.cpf_cnpj, "
                     . " ti.descricao as tipo, pai.id_registro_importado as id_origem_pai, p.bl_todos_programas as todos_programas "
                     . "  from cliente p "
                     . " left join cadastro_fixo ti on ti.id = p.id_tipo "
                     . " left join cliente pai on pai.id = p.id_pai "
                     . " where 1 = 1 ". $filtro .
                     " order by ".$order. " ".$order_type;
             
             $itens = DB::select($sql);
             
             return $itens;
           
       }
       
       public static function getListProgramas($id_origem_cliente ){
           
               $id_cliente = $id_origem_cliente;//ConfigDao::getIDByOrigem( $id_origem_cliente , "cliente"); //$request->input("id_cliente")
               $ids_programas = \App\Http\Dao\AssociacaoCadastrosDao::getIDAssociacoesFilho( "entidadexprograma", $id_cliente, "cliente", "programa");
               if ( $ids_programas == ""){
                   $ids_programas = " 0 ";
               }
               
               return  \App\Http\Dao\ProgramaDao::getListGridCad(" and p.id in ( ". $ids_programas . ") ");
       }
       
       public static function getListDicionario($id_origem_cliente ){
           
               $id_cliente = $id_origem_cliente;//;ConfigDao::getIDByOrigem( $id_origem_cliente , "cliente"); //$request->input("id_cliente")
               $ids = \App\Http\Dao\AssociacaoCadastrosDao::getIDAssociacoesFilho( "clientexdicionario", $id_cliente, "cliente", "dicionario_tags");
               if ( $ids == ""){
                   $ids = " 0 ";
               }
               
               return \App\Http\Dao\DicionarioTagsDao::getListGridCad(" and p.id in ( ". $ids. " ) ");
       }
       
           public static function getListTopicos($id_origem_cliente ){
           
               $id_cliente = $id_origem_cliente;//ConfigDao::getIDByOrigem( $id_origem_cliente , "cliente"); //$request->input("id_cliente")
               
               if ( $id_cliente == ""){
                   $id_cliente = "0 ";
               }
               return \App\Http\Dao\ClassesClienteDao::getListGridCad(" and p.id_cliente =  ". $id_cliente. " ");
       }
       
       
        public static function getById($id){
            if ($id == "") {
                $id = "null";
            }

           $ls = self::getListGridCad(" and p.id = ". $id );
           
           if ( count($ls) > 0 ){
               return $ls[0];
           }
           return null;
       }
    
    
       public static function salvarDadosJson( $hd_json, $ids_delete_json = ""){
           
           $itens = json_decode($hd_json);
           $ids_delete = json_decode($ids_delete_json);
           $ids = "0";
          
           
           $qtde_salvo = 0; $qtde_delete = 0;
           
       
           
           for ( $i = 0; $i < count($itens); $i++){
                           
                       $item_req = $itens[$i];   
                       
                       $reg = new Cliente();
                       
                       if (property_exists($item_req, "by_tipo") && @$item_req->tipo != "" ){
                               $id_encontra_tipo = ConfigDao::executeScalar("select id as res from cadastro_fixo where descricao "
                                       . " like '%".$item_req->tipo ."%' and id_tipo_cadastro_fixo = 5 ");
                               
                               if ( $id_encontra_tipo != ""){
                                   $reg->id_tipo =$id_encontra_tipo;
                               }
                       }
                       
                       if ( $reg->id_tipo == ""){
                           $reg->id_tipo = 21;
                       }
                       
                       
                         if ( $item_req->id_origem != ""){
                             
                             $complemento = "";
                             
                             if (property_exists($item_req, "by_tipo") && $reg->by_tipo == "1" ){
                                 $complemento = " and id_tipo = ". $reg->id_tipo;
                             } 
                             
                             $idtmp = ConfigDao::executeScalar("select id as res from cliente "
                                     . " where tabela_importado = '".ConfigDao::getTabela()."' and ".
                                     ConfigDao::getColunaID()."= " . $item_req->id_origem. $complemento );
                             
                             if ( $idtmp != ""){
                                 
                                      $reg = Cliente::find($idtmp);
                             }

                             $reg->id_registro_importado = $item_req->id_origem;   
                       }
                       
                       
                       $reg->tabela_importado = ConfigDao::getTabela(); 
                       $reg->nome = $item_req->nome;  
                       if (property_exists($item_req, "fantasia")){
                             $reg->fantasia = $item_req->fantasia; 
                       } else {
                           
                              $reg->fantasia = $item_req->nome;  
                       }
                       $reg->cpf_cnpj = $item_req->cpf_cnpj; 
                       $reg->id_tipo = 21;
                       $reg->status = 1;
                       
                       $reg->bl_todos_programas = @$item_req->todos_programas;
                       
                       if ( ! @$reg->bl_todos_programas ){
                            $reg->bl_todos_programas = 0;
                       }
                       
                       if (property_exists($item_req, "id_origem_pai") && $item_req->id_origem_pai != "" ){
                           
                           $idtmp_pai = ConfigDao::executeScalar("select id as res from cliente "
                                     . " where tabela_importado = '".ConfigDao::getTabela()."' and ".
                                     ConfigDao::getColunaID()."= " . $item_req->id_origem_pai);
                           
                           if ( $idtmp_pai != ""){
                               $reg->id_pai =$idtmp_pai;
                           }else{
                               $reg->id_pai = null;
                           }
                           
                       }
                       
                       if (property_exists($item_req, "tipo") && @$item_req->tipo != "" ){
                               $id_encontra_tipo = ConfigDao::executeScalar("select id as res from cadastro_fixo where descricao "
                                       . " like '%".$item_req->tipo ."%' and id_tipo_cadastro_fixo = 5 ");
                               
                               if ( $id_encontra_tipo != ""){
                                   $reg->id_tipo =$id_encontra_tipo;
                               }
                       }
                       /*
                                $reg->servidor = ConfigDao::numeroBanco(  $item_req->servidor  );  
                                $reg->ano = ConfigDao::numeroBanco(  $item_req->ano  );  
                                $reg->sequencial = ConfigDao::numeroBanco(  $item_req->sequencial  );  
                                      $reg->id_registro_importado = $item_req->id_registro_importado;   
                                      $reg->tabela_importado = $item_req->tabela_importado;   
                                      $reg->banco_importado = $item_req->banco_importado;   
                                      $reg->fantasia = $item_req->fantasia;   
                                      $reg->cpf_cnpj = $item_req->cpf_cnpj;   
                                      $reg->telefone = $item_req->telefone;   
                                      $reg->fax = $item_req->fax;   
                                      $reg->status = $item_req->status;   
                                      $reg->id_pai = $item_req->id_pai;   
                                      $reg->site = $item_req->site;   
                                      $reg->template_html = $item_req->template_html;   
                                      $reg->login = $item_req->login;   
                                      $reg->senha = $item_req->senha;   
                                $reg->id_tipo = ConfigDao::numeroBanco(  $item_req->id_tipo  );  
                                $reg->id_modelo_email = ConfigDao::numeroBanco(  $item_req->id_modelo_email  );  
                                      $reg->modulos_email = $item_req->modulos_email;   
                                $reg->mostra_mensuracao = ConfigDao::numeroBanco(  $item_req->mostra_mensuracao  );  
                                $reg->id_regiao = ConfigDao::numeroBanco(  $item_req->id_regiao  );  
                                      $reg->label_classes = $item_req->label_classes;   
                                $reg->mostra_relatorio = ConfigDao::numeroBanco(  $item_req->mostra_relatorio  );  
                                      $reg->id_monitoramento_scup = $item_req->id_monitoramento_scup;   
                                $reg->mostra_so_prioridade = ConfigDao::numeroBanco(  $item_req->mostra_so_prioridade  );  
                                $reg->online_calculo_valor_banner = ConfigDao::numeroBanco(  $item_req->online_calculo_valor_banner  );  
                                $reg->online_calculo_largura_banner = ConfigDao::numeroBanco(  $item_req->online_calculo_largura_banner  );  
                                $reg->online_calculo_altura_banner = ConfigDao::numeroBanco(  $item_req->online_calculo_altura_banner  );  
                                $reg->online_calculo_valor_caractere = ConfigDao::numeroBanco(  $item_req->online_calculo_valor_caractere  );  
                                $reg->data_ultima_edicao_dicionario = ConfigDao::dataBanco(  $item_req->data_ultima_edicao_dicionario  );  
                       
                       */
                       ConfigDao::configuraChave($reg, "cliente");
                       ConfigDao::blankToNull($reg);
                       
                   
                       $reg->ativo = 1;    
		       $ret = $reg->save();
                       
                       $ids .= ",". $reg->id;
                       $qtde_salvo++;
           }
           
           
           $ls_data = self::getListGridCad("and p.id in ( ". $ids." ) ");
           
           //"qtde_deleted" => $qtde_delete 
           return array("qtde" => $qtde_salvo, "data" => $ls_data);
           
           
           /*
           for ( $i = 0; $i < count($ids_delete); $i++){
               $item_req = $ids_delete[$i];
               
                 if ( $item_req != ""){
                             $reg = Cliente::find($item_req);
                             $reg->delete();//Removendo o item desejado para deletar.
                             $qtde_delete++;
                 }
           }
           
           return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
           
            * 
            */
       }
       
       public static function getIdByOrigem($id_origem){
           
                             $idtmp = ConfigDao::executeScalar("select id as res from cliente "
                                     . "where tabela_importado = '".ConfigDao::getTabela()."' and ".ConfigDao::getColunaID()."  = " . $id_origem );
                             
                             return $idtmp;
           
       }
       
       
       public static function removeByIds($ids_delete_json, $tipo_cadastro_basico){

         if ( $ids_delete_json != ""){

                $ls_data = self::getListGridCad("and id in ( ". $ids_delete_json." ) ");
                $ids_delete = explode(",", $ids_delete_json);

                for ( $i = 0; $i < count($ids_delete); $i++){
                   $item_req = $ids_delete[$i];
                   
                     if ( $item_req != ""){
                             $idtmp = ConfigDao::executeScalar("select id as res from cliente "
                                     . "where tabela_importado = '".self::$tabela_importado."' and ".ConfigDao::getColunaID()."  = " . $item_req );

                               if ( $idtmp != "" ){

                                     $reg = Cliente::find($idtmp);
                                     $reg->delete();//Removendo o item desejado para deletar.
                                     $qtde_delete++;

                               }
                     }
               }

               return array("qtde" => $qtde_salvo, "data" => $ls_data);

           }

           return array("qtde" => 0, "data" => null );

       }
       
       
        
}

