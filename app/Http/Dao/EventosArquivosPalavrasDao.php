<?php
namespace App\Http\Dao;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;

use App\Transcricao\EventosArquivosPalavras;
use DateTime;

class EventosArquivosPalavrasDao
{
    public static function getListGridCad($filtro, $order = "p.id", $order_type = "desc")
    {
        $DB_TRANSCRICAO = env("DB_TRANSCRICAO");
             
        $sql = "select "
                     . " p.id, p.data, p.id_evento, p.id_evento_arquivo, "
                     . " id_cliente, p.cita_diretamente, p.palavra,"
                     . "  p.tempo, p.tempo_seg, p.id_dicionario_tag, "
                     . "  p.status, p.operador, p.id_operador, "
                     . "  p.trecho, "
                     . "  p.id_notificacao_agrupamento,"
                     . "  p.indexed, p.sentimento"
                     . " from ". $DB_TRANSCRICAO . ".eventos_arquivos_palavras p "
                     . " left join cliente c on c.id = p.id_cliente "
                     . " where 1 = 1 ". $filtro .
                     " order by ".$order. " ".$order_type;
             
        $itens = DB::select($sql);
             
             
        return $itens;
    }
       
    public static function getListReduzido($filtro = "")
    {
        $DB_MIDIACLIP = ConfigDao::getSchemaMidiaClip();
             
        $sql = "select distinct p.palavra, p.tempo,  p.tempo_seg , convert(c.nome using utf8) as nome_cliente "
                     . " from eventos_arquivos_palavras p "
                     . " left join ".$DB_MIDIACLIP.".cliente c on c.id = p.id_cliente "
                     . " where 1 = 1 ". $filtro .
                     " order by p.tempo_seg ";
             
        $itens = DB::select($sql);
             
        return $itens;
    }
       
       
       
    public static function agrupaNotificacoes($reg_evento_arquivo)
    {
        $DB_MID = ConfigDao::getSchemaMidiaClip();
           
        $sql = "select count(*) as res from eventos_arquivos_palavras where id_evento_arquivo = ". $reg_evento_arquivo->id;
        $qtde = DB::select($sql);
           
        DB::delete("delete from agrupamento_notificacoes where id_evento_arquivo = ". $reg_evento_arquivo->id);
        $reg_evento = \App\Eventos::find($reg_evento_arquivo->id_evento);
           
        $qtde_feito = 0;
           
        if ($qtde > 0 && $reg_evento->tipo == "pai") {
            $tempo_seg  = $reg_evento_arquivo->tempo_realizado_minutos * 60;
               
            $quebra = 60; // $tempo_seg / 5; -- 60 segundos..
               

            $tempo_final = 0;
            while ($tempo_final < $tempo_seg) {
                $filtra = " and tempo_seg between " . $tempo_final." and " . ($tempo_final+$quebra);
                    
                $sql_arquivos = "select id, palavra, tempo_seg, tempo, id_cliente from eventos_arquivos_palavras where id_evento_arquivo =  ".
                            $reg_evento_arquivo->id. $filtra . " order by tempo_seg asc ";
                 
                $ls_arquivos = DB::select($sql_arquivos);
                    
                $ls_clientes = DB::select("select nome from ". $DB_MID . ".cliente where id in ( "
                            . "    select distinct id_cliente from eventos_arquivos_palavras where id_evento_arquivo = ".  $reg_evento_arquivo->id .
                            $filtra . ") ");
                    
                $ids_arquivos_palavras = \App\Http\Service\UtilService::arrayToString($ls_arquivos, "id");
                if (count($ls_arquivos) > 0) {
                    $obj_json = array();
                   
                    $agrup = new \App\AgrupamentoNotificacoes();
                    $agrup->id_programa = $reg_evento->id_programa;
                    $agrup->id_emissora = $reg_evento->id_emissora;
                    $agrup->palavras = \App\Http\Service\UtilService::arrayToString($ls_arquivos, "palavra", ", ");
                    $agrup->clientes = \App\Http\Service\UtilService::arrayToString($ls_clientes, "nome", ", ");
                    $agrup->tempo_seg = $ls_arquivos[0]->tempo_seg;
                    $agrup->tempo_fim_seg = $ls_arquivos[count($ls_arquivos) -1]->tempo_seg;
                    $agrup->id_evento_arquivo = $reg_evento_arquivo->id;
                    $agrup->dia = $reg_evento->dia;
                            
                    $agrup->hora_inicio_seg = $reg_evento_arquivo->hora_inicio_seg + $ls_arquivos[0]->tempo_seg;
                            
                    if (count($ls_arquivos) > 1) {
                        $agrup->hora_fim_seg = $reg_evento_arquivo->hora_inicio_seg +
                                            ($reg_evento_arquivo->tempo_realizado_minutos * 60) +
                                            $ls_arquivos[count($ls_arquivos) -1]->tempo_seg;
                    } else {
                        $agrup->hora_fim_seg = $agrup->hora_inicio_seg ;
                    }
                            
                            
                            
                    for ($o = 0; $o < count($ls_arquivos); $o++) {
                        $r_arquivo = $ls_arquivos[$o];
                                
                        $obj_json[count($obj_json)] = array("id_evento_arquivo_palavra"=>$r_arquivo->id,"id_cliente"=>$r_arquivo->id_cliente,
                                              "palavra"=> $r_arquivo->palavra ,
                                              "nome_cliente"=> utf8_encode(
                                                  ConfigDao::executeScalar2("select nome as res from cliente where id = ".$r_arquivo->id_cliente)
                                              ),
                                              "tempo_seg" => $r_arquivo->tempo_seg);
                    }
                    // print_r( json_encode(  $obj_json ) ); die(" ? ");
                    $agrup->json = json_encode(array("arquivos"=> $obj_json));
                            
                    $dt_date = new DateTime($reg_evento->data);
                            
                    $agrup->hora_inicio = \App\Http\Service\UtilService::converteSegundos_ParaHoraMinuto($agrup->hora_inicio_seg);
                            
                    $agrup->data = $dt_date->format("Y-m-d")." ".  $agrup->hora_inicio;
                    $agrup->status = 1;
                            
                    $agrup->hora_fim = \App\Http\Service\UtilService::converteSegundos_ParaHoraMinuto($agrup->hora_fim_seg);
                    $agrup->tempo = \App\Http\Service\UtilService::converteSegundos_ParaHoraMinuto($agrup->tempo_seg);
                    $agrup->tempo_fim = \App\Http\Service\UtilService::converteSegundos_ParaHoraMinuto($agrup->tempo_fim_seg);
                            
                            
                    $id_tmp_jatem = ConfigDao::executeScalar("select id as res from agrupamento_notificacoes where  id_evento_arquivo = ". $reg_evento_arquivo->id .
                                    " and hora_inicio_seg = ".$agrup->hora_inicio_seg. " and palavras='". str_replace("'", "''", $agrup->palavras)."' ");
                            
                    if (!$id_tmp_jatem) {
                        $agrup->save();

                        DB::statement("update eventos_arquivos_palavras set id_notificacao_agrupamento = " . $agrup->id.
                                                "  where id in ( " . $ids_arquivos_palavras." ) ");
                    }
                    $qtde_feito++;
                }
                    
                    
                    
                $tempo_final+= $quebra;
            }
        }
           
        return $qtde_feito;
           
        //vou procurar todas as notificações que foram localizadas neste arquivo e vou tentar agrupar em grupos menores de notificações.
        $sql = " select eap.id, ea.id_materia_radiotv_jornal, eap.palavra, eap.id_evento, ea.id as id_evento_arquivo, ea.hora_inicio_seg, ea.hora_inicio, eap.tempo_seg, eap.tempo,
                              eap.trecho from eventos_arquivos_palavras eap 
                    inner join eventos_arquivos ea on ea.id = eap.id_evento_arquivo 
                    inner join eventos ev on ev.id = eap.id_evento
                   where 
                    ea.id = ".$reg_evento_arquivo->id."  order by ea.hora_inicio_seg, eap.tempo_seg ";
           
        $lista = DB::select($sql);
           
           
           
        for ($i = 0; $i < count($lista); $i++) {
            $item = $lista[$i];
            //Um arquivo tem 5 minutos. Vou quebrar ele em até 5 notificações.
        }
    }
       
       
       
    public static function salvarClientes($clientes, $id_evento, $id_evento_arquivo)
    {
           
          //
           
        $reg_arquivo = \App\EventosArquivos::find($id_evento_arquivo);
        $reg_evento = \App\Eventos::find($id_evento);
              
        for ($i = 0; $i < count($clientes); $i++) {
            $item = @$clientes[$i];
                        
            if (is_null($item)) {
                continue;
            }

            $cita_diretamente = 0;

            if (property_exists($item, "citacao_direta")) {
                $cita_diretamente = $item->citacao_direta;
            }
                        
                        
            if ($cita_diretamente) {
                $trecho = "";
                $tempo_seg = \App\Http\Service\EventoArquivoService::buscarTextoFrom($reg_arquivo->json, $item->nome, $trecho);
                       
                $obj_a = array("cita_diretamente" => $cita_diretamente,
                                    "id_evento"=> $id_evento,
                                   "id_evento_arquivo" => $id_evento_arquivo,
                                   "id_cliente"=> $item->id ,
                                  "data"=>$reg_evento->data,
                                   "tempo_seg" => $tempo_seg,
                                   "tempo" => \App\Http\Service\UtilService::converteSegundos_ParaHoraMinuto($tempo_seg),
                                   "palavra"=>$item->nome,
                                  "trecho"=>$trecho,
                                  "indexed" => $item->indexed
                                  );
                              
                self::salvar((object)$obj_a, $item->nome, null);
            }
                        
            if (is_array($item->palavras)) {
                for ($a = 0; $a < count($item->palavras); $a++) {
                    $o_palavra = (object)$item->palavras[$a];

                    $tempo_seg = \App\Http\Service\EventoArquivoService::buscarTextoFrom(
                        $reg_arquivo->json,
                        $o_palavra->nome,
                        $trecho
                    );
                    $obj_a = array(
                                              "cita_diretamente"=> 0,
                                                "id_evento"=> $id_evento,
                                               "id_evento_arquivo" => $id_evento_arquivo,
                                               "id_cliente"=> $item->id ,
                                               "data"=>$reg_evento->data,
                                               "tempo_seg" => floatval($tempo_seg),
                                               "tempo" => \App\Http\Service\UtilService::converteSegundos_ParaHoraMinuto($tempo_seg),
                                               "palavra"=>$o_palavra->nome,
                                              "trecho"=>$trecho
                                              );

                    self::salvar((object)$obj_a, $o_palavra->nome, null, $o_palavra->id);
                }
            }
        }
    }
       
       
    public static function salvar($obj, $palavra, $operador, $id_dicionario_tag = "")
    {
        $sql = "select id as res from eventos_arquivos_palavras where id_evento_arquivo = ".
                    $obj->id_evento_arquivo . " and id_cliente =". $obj->id_cliente;
           
        if ($palavra != "") {
            $sql .= " and upper(palavra) = upper('". $palavra."') ";
        }
           
        if ($id_dicionario_tag != "") {
            $sql .= " and id_dicionario_tag = ". $id_dicionario_tag;
        }
           
        $id_tmp = ConfigDao::executeScalar2($sql);
           
        $reg = new EventosArquivosPalavras();
           
        if (! is_null($id_tmp) && $id_tmp != "") {
            $reg = EventosArquivosPalavras::find($id_tmp);
        }
           
               
        //  print_r( $obj );die(" ");
        $reg->data = @$obj->data;
        $reg->id_evento = $obj->id_evento;
        $reg->id_evento_arquivo = $obj->id_evento_arquivo;
        $reg->id_cliente = $obj->id_cliente;
        $reg->trecho = $obj->trecho;
                        
        if ($reg->data  == "") {
            $reg->data = \App\Http\Dao\ConfigDao::executeScalar2("select data as res from eventos where id =  ". $obj->id_evento);
        }
        if (!is_null($obj->cita_diretamente) &&  $obj->cita_diretamente != "") {
            $reg->cita_diretamente = $obj->cita_diretamente;
        }
        $reg->palavra = $obj->palavra;
        $reg->tempo = $obj->tempo;
        $reg->sentimento = $obj->sentimento;
        if (strpos(" ".$obj->tempo_seg, ",") > 0) {
            $reg->tempo_seg = ConfigDao::numeroBanco($obj->tempo_seg);
        } else {
            $reg->tempo_seg =$obj->tempo_seg;
        }

        if ($id_dicionario_tag != "") {
            $reg->id_dicionario_tag = ConfigDao::numeroBanco($id_dicionario_tag);
        }
        $reg->status = 1 ;
                    
        if (!is_null($operador)) {
            $reg->operador = $operador->nome;
            $reg->id_operador = $operador->id;
        }
        //$evento_arquivo = \App\Transcricao\EventosArquivos::find($obj->id_evento_arquivo);
        ConfigDao::blankToNull($reg);
        $reg->save();
                    
        return $reg->id;
    }
       
       
    public static function buscarTextoFrom($json, $texto, &$trecho)
    {
        $txt = "";
        $objects = json_decode($json);
        $inicio = 0;
        $texto_semacento = UtilService::removeAcentos($texto);
              
        for ($z = 0; $z < count($objects); $z++) {
            $object = $objects[$z];
                       
            if (!property_exists($object, "alternatives") || count($object->alternatives) <= 0) {
                continue;
            }
                        
            $completo = $object->alternatives[0]->text;
            $completo_semacento = UtilService::removeAcentos($completo);
                        
            // echo("\n <br>achei? ". $texto ." - ". $completo ." -- ". strstr(" ".  $completo, $texto ) );
                        
            if (stripos(" ".  $completo, $texto) > 0 || stripos(" ".  $completo_semacento, $texto_semacento) > 0) {
                $trecho = $completo;
                $time_saida = $object->start_time;
                            
                if (strlen($time_saida) > 10) {
                    return UtilService::left($time_saida, 10);
                }
                            
                return $object->start_time;
            } else {
                $proximo_index = self::localizaProximoIndex($objects, $z);
                            
                if ($z < count($objects)-1 && $proximo_index >-1) {
                    if (stripos(" ".  $completo. " ". $objects[$proximo_index]->alternatives[0]->text, $texto) > 0
                                          ||
                                         stripos(" ".  $completo. " ". UtilService::removeAcentos($objects[$proximo_index]->alternatives[0]->text), $texto_semacento) > 0
                                          ) {
                        $trecho = $completo. " ". $objects[$proximo_index]->alternatives[0]->text;
                                      
                                      
                        $time_saida = $object->start_time;
                        if (strlen($time_saida) > 10) {
                            return UtilService::left($time_saida, 10);
                        }
                                      
                        return $object->start_time;
                    }
                }
            }
        }
                  
        return 0;
    }
    
    public static function salvarDadosJson($hd_json, $ids_delete_json = "")
    {
        $itens = json_decode($hd_json);
           
        $qtde_salvo = 0;
        $qtde_delete = 0;
           
        for ($i = 0; $i < count($itens); $i++) {
            $item_req = $itens[$i];
                      
            $reg = new EventosArquivosPalavras();
                       
            // $reg->id_evento = ConfigDao::numeroBanco(  $item_req->id_evento  );
            $reg->id_evento_arquivo = ConfigDao::numeroBanco($item_req->id_arquivo);
            $reg->id_evento = \App\Http\Dao\ConfigDao::executeScalar2("select id_evento as res from eventos_arquivos where id =  ". $reg->id_evento_arquivo); //  $request->input("id_arquivo");
                        
            $reg->id_dicionario_tag = ConfigDao::getIDByOrigem(@$item_req->id_dicionario, "dicionario_tags");
            $reg->id_cliente = \App\Http\Dao\ConfigDao::executeScalar("
                            SELECT 
                                `c`.`id` AS `res`
                                FROM `associacao_cadastros` AS `ac`
                                    INNER JOIN `cliente` AS `c`
                                        ON `ac`.`id_pai` = `c`.`id_registro_importado`
                                    INNER JOIN `dicionario_tags` AS `dt`
                                        ON `ac`.`id_filho` = `dt`.`id`
                                    WHERE `classificacao` = 'clientexdicionario'
                                        AND `dt`.`id_registro_importado` = " . @$item_req->id_dicionario. "
                                    ORDER BY `ac`.`id` DESC
                                    LIMIT 1");

            //$reg->id_cliente =  \App\Http\Dao\ConfigDao::getIDByOrigem( $item_req->id_cliente, "cliente");
            $reg->cita_diretamente = ConfigDao::numeroBanco(@$item_req->cita_diretamente);
            $reg->palavra = $item_req->palavra;
            $reg->tempo = @$item_req->tempo;
            $reg->trecho = @$item_req->trecho;
            $reg->sentimento = @$item_req->sentimento;
            $reg->tempo_seg =\App\Http\Service\UtilService::time_to_seconds2($reg->tempo);
            //$reg->id_dicionario_tag = @$item_req->id_dicionario;
            self::salvar($reg, "", null, $reg->id_dicionario_tag);
            //$reg->status = ConfigDao::numeroBanco(  $item_req->status  );
            //                                    $reg->operador = $item_req->operador;
            //                                  $reg->id_operador = $item_req->id_operador;
            //                                $reg->id_materia_radiotv_jornal = $item_req->id_materia_radiotv_jornal;

                       
            // ConfigDao::blankToNull($reg);
                       
            //$ret = $reg->save();
            /* */
            $qtde_salvo++;
        }
           
           
        if ($ids_delete_json != "") {
            $ids_delete = json_decode($ids_delete_json);
            for ($i = 0; $i < count($ids_delete); $i++) {
                $item_req = $ids_delete[$i];

                if ($item_req->id != "") {
                    $reg = EventosArquivosPalavras::find($item_req->id);
                    $reg->delete();//Removendo o item desejado para deletar.
                    $qtde_delete++;
                }
            }
        }
           
        return array("qtde_salvo" => $qtde_salvo,  "success"=> true ); //"qtde_deleted" => $qtde_delete ,
    }
}
