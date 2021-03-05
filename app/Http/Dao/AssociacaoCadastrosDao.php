<?php
namespace App\Http\Dao;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;

use App\AssociacaoCadastros;

class AssociacaoCadastrosDao {
    
       public static function getListGridCad($filtro, $order, $order_type){
           
             $sql = "select p.* from associacao_cadastros p where 1 = 1 ". $filtro .
                     " order by ".$order. " ".$order_type;
             
             $itens = DB::select($sql);
             

             for ($i=0; $i < count( $itens) ; $i++) { 
                    $item = &$itens[$i];
                    $valor = $item->data;
                    
                    
                   // $item->data = $this->DataBR($valor, true); //Colocando como formato BR
             }
             
             return $itens;
           
       }


   
        public static function getIDAssociacoesPai($oConn, $classificacao, $id_filho, $tabela_pai, $tabela_filho)
        {
                        $sql = "select id_pai from associacao_cadastros where tabela_pai='" . $tabela_pai . "' and tabela_filho ='" . $tabela_filho.
                        "' and id_filho in ( " . $id_filho . " ) and classificacao='" . $classificacao . "' ";


                    $dt_saida = DB::select(  $sql);

                    $saida = "";
                    for ( $i = 0; $i < count( $dt_saida ) ; $i++)
                    {
                        if ($saida != "")
                            $saida .= ",";


                        $saida .= $dt_saida[$i]->id_pai;
                    }

                    return $saida;

        }





       public static function getIdAssociacao($id_pai, $id_filho, $tabela_pai, $classificacao ){
           
              $filtro = "";
              $filtro .= " and id_pai= ". $id_pai;
              $filtro .= " and id_filho= ". $id_filho;
              $filtro .= " and classificacao= '". $classificacao."' ";
              $filtro .= " and tabela_pai= '". $tabela_pai."' ";
           
              $sql = "select p.* from associacao_cadastros p where 1 = 1 ". $filtro;
              
              $lista = DB::select($sql);
           
              if ( count($lista) > 0 ){
                  return $lista[0]->id;
              }
              
              return "";
       }
       
       public static function salvar($id_pai, $id_filho, $tabela_pai, $tabela_filho, $classificacao ){
           
           
                $reg = new AssociacaoCadastros();
                $reg->tabela_pai = $tabela_pai;
                $reg->tabela_filho = $tabela_filho;
                $reg->classificacao = $classificacao;
                $reg->id_pai = $id_pai;
                $reg->id_filho = $id_filho;

                ConfigDao::blankToNull($reg);
                ConfigDao::configuraChave($reg, "associacao_cadastros");
                $ret = $reg->save();
                
               return $reg;

       }
       
       
       public static function salvarByIds( $classificacao, $id_pai, $ids_filho,  $tabela_pai, $tabela_filho, $deleta = false)
        {
            $arps = explode(",", $ids_filho); // ids_filho.ToString().Split(',');

            $lista_ids = "0";

            for ($i = 0; $i < count($arps); $i++)
            {
		if ($arps[$i] == "")
                    continue;

                $id_filho = $arps[$i];
                
                $dr = new AssociacaoCadastros();
                
                $sql = "select id as res from associacao_cadastros where tabela_pai='"  .$tabela_pai . "' and tabela_filho ='" .$tabela_filho .
                    "' and id_pai = " . $id_pai . " and classificacao='" . $classificacao . "' and id_filho= ". $id_filho;
                
                $idtmp = ConfigDao::executeScalar($sql );

                if ( $idtmp != "" )
                {
                    $lista_ids .= "," . $idtmp;
                    continue;
                }

                $dr->tabela_pai = $tabela_pai;
                $dr->tabela_filho = $tabela_filho;
                $dr->classificacao = $classificacao;
                $dr->id_pai = $id_pai;
                $dr->id_filho = $id_filho;
                
                ConfigDao::blankToNull($dr);
                ConfigDao::configuraChave($dr, "associacao_cadastros");
                $dr->save();
                
                $lista_ids .= "," . $dr->id;


            }
			
		if ( $deleta ){
                    $sql_delete = " delete from associacao_cadastros where id_pai = " .$id_pai. " and tabela_pai='" .$tabela_pai. "' and tabela_filho ='" .$tabela_filho.
                    "' and id_pai = " .$id_pai." and classificacao='" .$classificacao. "' and id not in ( " .$lista_ids. ")  ";
                    DB::delete($sql_delete);
                    
                }
                
                return $lista_ids;

        }
       
       public static function deleteById($id){
           
                             $reg = AssociacaoCadastros::find($id);
                             
                             if (! is_null(  $reg ) ){
                                 $reg->delete();
                             }
       }


        public static function getIDAssociacoesFilho( $classificacao, $id_pai, $tabela_pai, $tabela_filho)
        {
                 
    $sql = "select id_filho from associacao_cadastros where tabela_pai='" . $tabela_pai .
     "' and tabela_filho ='" . $tabela_filho.
                "' and id_pai = " . $id_pai . " and classificacao='" . $classificacao . "' ";


                $dt_saida = DB::select(  $sql);

                $saida = "";
                for ( $i = 0; $i < count( $dt_saida ) ; $i++)
                {
                    if ($saida != "")
                        $saida .= ",";


                    $saida .= $dt_saida[$i]->id_filho;
                }

                    return $saida;

        }
    
       public static function salvarDadosJson( $hd_json, $ids_delete_json ){
           
           $itens = json_decode($hd_json);
           $ids_delete = json_decode($ids_delete_json);
           
           $qtde_salvo = 0; $qtde_delete = 0;
           
           for ( $i = 0; $i < count($itens); $i++){
                           
                       $item_req = $itens[$i];    
                       
                       $reg = new AssociacaoCadastros();
                       
                       if ( $item_req->id != ""){
                             $reg = AssociacaoCadastros::find($item_req->id);
                       }
					      $reg->id_pai = ConfigDao::numeroBanco(  $item_req->id_pai  );  
                           $reg->tabela_pai = $item_req->tabela_pai;   
                           $reg->tipo_pai = $item_req->tipo_pai;   
                     $reg->id_filho = ConfigDao::numeroBanco(  $item_req->id_filho  );  
                           $reg->tabela_filho = $item_req->tabela_filho;   
                           $reg->tipo_filho = $item_req->tipo_filho;   
                           $reg->classificacao = $item_req->classificacao;   
                     $reg->sequencial = ConfigDao::numeroBanco(  $item_req->sequencial  );  
                     $reg->ano = ConfigDao::numeroBanco(  $item_req->ano  );  
                     $reg->servidor = ConfigDao::numeroBanco(  $item_req->servidor  );  
                           $reg->tabela_importado = $item_req->tabela_importado;   
                           $reg->banco_importado = $item_req->banco_importado;   
                           $reg->id_registro_importado = $item_req->id_registro_importado;   
                     $reg->data_referencia = ConfigDao::dataBanco(  $item_req->data_referencia  );  
                       
                       
                       ConfigDao::blankToNull($reg);
                       
		       $ret = $reg->save();
                       $qtde_salvo++;
           }
           
           for ( $i = 0; $i < count($ids_delete); $i++){
               $item_req = $ids_delete[$i];
               
                 if ( $item_req != ""){
                             $reg = AssociacaoCadastros::find($item_req);
                             $reg->delete();//Removendo o item desejado para deletar.
                             $qtde_delete++;
                 }
           }
           
           return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
           
       }
       
       
        
}

