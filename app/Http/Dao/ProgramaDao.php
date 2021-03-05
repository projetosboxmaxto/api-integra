<?php
namespace App\Http\Dao;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;

use App\Programa;

class ProgramaDao {
    
       public static function getListGridCad($filtro, $order = "id", $order_type = "desc"){
           
           
             $sql = "select p.id, p.nome, p.id_registro_importado as id_origem, "
                     . " p.hora_inicio, p.hora_fim, p.transcricao_tempo_extra_inicio, p.transcricao_tempo_extra_fim, "
                     . " p.transcricao_prioridade, p.transcricao_dias, em.id_registro_importado as id_emissora, p.transcricao_ativar  "
                     . " from programa p "
                     . " left join emissora em on em.id = p.id_emissora "
                     . " where 1 = 1 ". $filtro .
                     " order by ".$order. " ".$order_type;
             $itens = DB::select($sql);
             
             return $itens;
             
                       
       }
       
       public static function salvarApresentadores($json, $id_programa){
           $lista = json_decode($json);
       }
       
       public static function getById($id){
           $ls = self::getListGridCad(" and p.id = ". $id );
           
           if ( count($ls) > 0 ){
               return $ls[0];
           }
           return null;
       }
       public static function setaProgramasPorEmissora($id_programa, $id_emissora){
           //programaxcanal_comunicacao
           $ls = DB::select("select id from associacao_cadastros where classificacao = 'programaxcanal_comunicacao'"
                   . " and tabela_pai='programa' and id_pai= ". $id_programa);
           
           $reg = new \App\AssociacaoCadastros();
           
           if ( count($ls) > 0 ){
               $reg = \App\AssociacaoCadastros::find( $ls[0]->id );
           }
           
           $reg->tabela_pai = "programa";
           $reg->tabela_filho = "emissora";
           $reg->classificacao = "programaxcanal_comunicacao";
           $reg->id_pai =$id_programa;
           $reg->id_filho =$id_emissora;
           $reg->save();
       }
       
        public static function setaProgramasPorClientes($id_programa, $ids_clientes, $deleta = false ){
            
            return AssociacaoCadastrosDao::salvarByIds( "programaxcanal_comunicacao",
                    $id_programa, $ids_clientes, "programa", "emissora", $deleta );
            
       }
       
       public static function configuraRegistro(&$reg, $item_req){
           
                      if (property_exists($item_req, "id_origem") && $item_req->id_origem != ""){
                            $idtmp = ConfigDao::getIDByOrigem($item_req->id_origem, "programa");
                            if ( $idtmp != ""){
                               // die("idtmp? ". $idtmp );
                                     $reg = Programa::find($idtmp);
                                
                            }
                            $reg->id_registro_importado = $item_req->id_origem; 
                       }
                       if ( $item_req->id_emissora != "" ){
                           $reg->id_emissora = $item_req->id_emissora;//ConfigDao::getIDByOrigem($item_req->id_emissora, "emissora");
                       }
                       
                       $reg->nome = $item_req->nome;     
                       $reg->tabela_importado = ConfigDao::getTabela();   
                       $reg->hora_inicio = $item_req->hora_inicio;   
                       $reg->hora_fim = $item_req->hora_fim;  
                       
                       $reg->transcricao_tempo_extra_inicio = ""; $reg->transcricao_tempo_extra_fim =  "";
                       
                       if (property_exists($item_req, "transcricao_tempo_extra_inicio")){
                                $reg->transcricao_tempo_extra_inicio = $item_req->transcricao_tempo_extra_inicio;   
                       }
                       
                       if (property_exists($item_req, "transcricao_tempo_extra_fim")){
                                $reg->transcricao_tempo_extra_fim = $item_req->transcricao_tempo_extra_fim; 
                       }
                       
                       $tempo_extra_inicio  = 0;  $tempo_extra_fim = 0;
                       
                       if ( $reg->transcricao_tempo_extra_inicio != ""){
                           $tempo_extra_inicio = \App\Http\Service\UtilService::time_to_seconds($reg->transcricao_tempo_extra_inicio);
                       }
                        if ( $reg->transcricao_tempo_extra_fim != ""){
                           $tempo_extra_fim = \App\Http\Service\UtilService::time_to_seconds($reg->transcricao_tempo_extra_fim);
                       }
                       
                       if ( property_exists($item_req, "transcricao_ativar")){
                                  $reg->transcricao_ativar = ConfigDao::numeroBanco(  $item_req->transcricao_ativar  ); 
                       } 
                       
                       if ( $reg->id_emissora != ""){
                            $reg->id_meio_comunicacao = ConfigDao::executeScalar("select id_veiculo as res from emissora where id = ".
                                     $reg->id_emissora);
                       }
                       
                        $reg->hora_inicio_seg = \App\Http\Service\UtilService::time_to_seconds($reg->hora_inicio);
                        $reg->hora_fim_seg = \App\Http\Service\UtilService::time_to_seconds($reg->hora_fim);
                        
                        $reg->transcricao_prioridade = $item_req->transcricao_prioridade;   
                        $reg->transcricao_dias = $item_req->transcricao_dias;   
                        $reg->transcricao_prioridade_persistente = "Persistente";
                        
                        $reg->transcricao_tempo_inicio_seg = $reg->hora_inicio_seg -  $tempo_extra_inicio;
                        if (  $reg->transcricao_tempo_inicio_seg < 0  ){
                             $reg->transcricao_tempo_inicio_seg = 0;
                             
                        }
                         $reg->transcricao_tempo_fim_seg = $reg->hora_fim_seg + $tempo_extra_fim;
                        if (  $reg->transcricao_tempo_fim_seg >= (24*60*60)  ){
                             $reg->transcricao_tempo_fim_seg = \App\Http\Service\UtilService::time_to_seconds("23:59:59");
                             
                        }
           
       }
    
       public static function salvarDadosJson( $hd_json, $ids_delete_json = ""){
           
           $itens = json_decode($hd_json);
           
           $qtde_salvo = 0; $qtde_delete = 0;  $ids = "0";
           
           for ( $i = 0; $i < count($itens); $i++){
                           
                       $item_req = $itens[$i];    
                       
                       $reg = new Programa();
                       
                       self::configuraRegistro($reg, $item_req);      
                       
                      // print_r( $reg ); die(" ID? ". $reg->id );
                       
                       ConfigDao::blankToNull($reg);
                       
		       $ret = $reg->save();
                      // die(" ID? ". $reg->id );
                       self::setaProgramasPorEmissora($reg->id, $reg->id_emissora);
                       $qtde_salvo++;
                       $ids .= ",". $reg->id;
           }
           
           if ( $ids_delete_json != ""){
           
                            $ids_delete = json_decode($ids_delete_json);
                            for ( $i = 0; $i < count($ids_delete); $i++){
                                $item_req = $ids_delete[$i];

                                  if ( $item_req != ""){
                                              $reg = Programa::find($item_req);
                                              $reg->delete();//Removendo o item desejado para deletar.
                                              $qtde_delete++;
                                  }
                            }
           }
           $ls_data = self::getListGridCad("and p.id in ( ". $ids." ) ");
           
           //"qtde_deleted" => $qtde_delete 
           return array("qtde" => $qtde_salvo, "data" => $ls_data);
           //return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
           
       }
       
       
        
}

