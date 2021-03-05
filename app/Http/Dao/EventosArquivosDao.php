<?php
namespace App\Http\Dao;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;

use App\EventosArquivos;

class EventosArquivosDao {
    
       public static function getListGridCad($filtro, $order = " id ", $order_type = "desc "){
           
           $DB_TRANSCRICAO = env("DB_TRANSCRICAO");
           if ( $DB_TRANSCRICAO != "")
           {
               $DB_TRANSCRICAO .=".";
           }
           $DB_DATABASE = env("DB_DATABASE");
           $PATH_URL_VIDEOS = env("PATH_URL_VIDEOS ");
           
             $sql = "select p.id, p.path, '' as url, ev.data,  p.nome, p.hora_inicio, p.texto, p.json, p.id_evento, p.com_temp_search as com_busca_salva, p.status ,"
                     . "  pr.id_registro_importado as id_programa, em.id_registro_importado as id_emissora,"
                     . "  pr.nome as nome_programa, em.nome as nome_emissora from ".$DB_TRANSCRICAO."eventos_arquivos p"
                     . " inner join ".$DB_TRANSCRICAO."eventos ev on ev.id = p.id_evento "
                     . " left join programa pr on pr.id = ev.id_programa "
                     . " left join emissora em on em.id = ev.id_emissora "
                     . "  where 1 = 1 ". $filtro .
                     " order by ".$order. " ".$order_type;
             
             $itens = DB::select($sql);
             
         for ($i=0; $i < count( $itens) ; $i++) { 
                    $item = &$itens[$i];
                    $item->url = $PATH_URL_VIDEOS . str_replace("//", "/",$item->path );
                   // $valor = $item->data;
                    
                    
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
                       
                       $reg = new EventosArquivos();
                       
                       if ( $item_req->id != ""){
                             $reg = EventosArquivos::find($item_req->id);
                       }
					            $reg->path = $item_req->path;   
         $reg->nome = $item_req->nome;   
   $reg->id_evento = ConfigDao::numeroBanco(  $item_req->id_evento  );  
   $reg->tempo_realizado_minutos = ConfigDao::numeroBanco(  $item_req->tempo_realizado_minutos  );  
         $reg->hora_inicio = $item_req->hora_inicio;   
         $reg->id_materia_radiotv_jornal = $item_req->id_materia_radiotv_jornal;   
         $reg->titulo = $item_req->titulo;   
   $reg->status = ConfigDao::numeroBanco(  $item_req->status  );  
   $reg->bloqueado_por_id = ConfigDao::numeroBanco(  $item_req->bloqueado_por_id  );  
   $reg->com_elastic_search = ConfigDao::numeroBanco(  $item_req->com_elastic_search  );  
         $reg->meta_dados_elastic = $item_req->meta_dados_elastic;   
                       
                       
                       ConfigDao::blankToNull($reg);
                       
		       $ret = $reg->save();
                       $qtde_salvo++;
           }
           
           for ( $i = 0; $i < count($ids_delete); $i++){
               $item_req = $ids_delete[$i];
               
                 if ( $item_req != ""){
                             $reg = EventosArquivos::find($item_req);
                             $reg->delete();//Removendo o item desejado para deletar.
                             $qtde_delete++;
                 }
           }
           
           return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
           
       }
       
       
        
}

