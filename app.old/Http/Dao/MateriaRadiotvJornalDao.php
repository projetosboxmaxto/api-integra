<?php
namespace App\Http\Dao;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;
use DateTime;

use App\MateriaRadiotvJornal;

class MateriaRadiotvJornalDao
{
    public static function getList($filtro, $id_cliente = "", $order = "id", $order_type = "desc")
    {
        $from = " from  materia_radiotv_jornal m  ";
           
        if ($id_cliente != "") {
            $from = " from associacao_materia_radiotv_jornal aj "
                           . " inner join materia_radiotv_jornal m on m.id = aj.id_materia_radiotv_jornal ";
        }
        $sql = "select m.id,  m.titulo, m.sinopse, m.texto,  m.data_insert_materia,  m.data_hora_materia as data_materia"
                      . ", "
                      . " ja.nome as apresentador, ja.id_registro_importado as id_apresentador, pr.id_registro_importado as id_programa , pr.nome as programa,  m.hora_inicio, "
                . " m.duracao_segundos as duracao, em.id_registro_importado as id_emissora, em.nome as emissora, vei.descricao as emissora_tipo, '' as clientes, '' as arquivos, m.status_atual as status "
                   . $from . " 
                    inner join materia_radio_tv mtv on mtv.id = m.id 
                    left join emissora em on em.id = m.id_emissora 
                    left join cadastro_fixo vei on vei.id = em.id_veiculo 
                    left join programa pr on pr.id = mtv.id_programa
                    left join jornalista_apresentador ja on ja.id = mtv.id_apresentador ";
              
        if ($id_cliente != "") {
            $filtro .= " and aj.id_entidade = ". $id_cliente;
        }
               
        $sql .=  " where 1 = 1 "  .$filtro . " order by ".$order. " ".$order_type; //m.id = " . $id ;
        
        if (trim($filtro) == "") {
            $sql .= " limit 0, 200 ";
        }
        //die( $sql );
        $lista  = DB::select($sql);
             
        $PATH_SISTEMA_MIDIACLIP = env("PATH_SISTEMA_MIDIACLIP");
             
        for ($i = 0; $i < count($lista); $i++) {
            $item_req = &$lista[$i];
                       
                       
            $dt = new DateTime($item_req->data_insert_materia);
            $item_req->clientes = self::getClientes($item_req->id);
            $item_req->arquivos = self::getArquivos($item_req->id, $PATH_SISTEMA_MIDIACLIP, $dt);
        }
             
             
        return $lista;
    }
       
    public static function getArquivos($id_materia, $PATH_SISTEMA_MIDIACLIP, $dt)
    {
        $ano = $dt->format("Y");
        $mes = (int)$dt->format("m");
             
        $EH_INTEGRADOR = ConfigDao::getValor("EH_INTEGRADOR");
             
        $url_base_arquivo = $PATH_SISTEMA_MIDIACLIP."arquivos/";
             
        if ($EH_INTEGRADOR) {//não é midiaclip
            $URL_ARQUIVOS_MATERIA = ConfigDao::getValor("URL_ARQUIVOS_MATERIA");
            if ($URL_ARQUIVOS_MATERIA != "") {
                $url_base_arquivo = $URL_ARQUIVOS_MATERIA;
            }
        }
            
        $sql = "select a.id, a.nome, concat('".$url_base_arquivo."RTV/".$ano."/".$mes."/', a.nome) as url from arquivos a where a.id_materia = ". $id_materia;
           
        $lista  = DB::select($sql);
             
        return $lista;
    }
    public static function getClientes($id_materia)
    {
        $sql = " select cl.nome as cliente, cl.id_registro_importado as id_cliente, bas.descricao as impacto, bas.descricao as impacto, "
                    . " bas.id_registro_importado as id_impacto, clcl.id_registro_importado as id_topico, clcl.nome as topico "
                    . " from associacao_materia_radiotv_jornal aj "
                    . " left join avaliacao_impacto av on av.id_materia = aj.id_materia_radiotv_jornal and av.id_cliente = aj.id_entidade  "
                    . " left join cadastro_basico bas on bas.id = av.id_impacto "
                    . " left join cliente cl on cl.id = aj.id_entidade "
                    . " left join classes_cliente clcl on clcl.id = av.id_categoria_cliente "
                    . " where aj.id_materia_radiotv_jornal =  ". $id_materia . " order by cl.nome ";
        $itens = DB::select($sql);
             
        return $itens;
    }
    
    public static function salvarDadosJson($hd_json, $ids_delete_json)
    {
        $itens = json_decode($hd_json);
        $ids_delete = json_decode($ids_delete_json);
           
        $qtde_salvo = 0;
        $qtde_delete = 0;
           
        for ($i = 0; $i < count($itens); $i++) {
            $item_req = $itens[$i];
                       
            $reg = new MateriaRadiotvJornal();
                       
            if ($item_req->id != "") {
                $reg = MateriaRadiotvJornal::find($item_req->id);
            }
            $reg->servidor = ConfigDao::numeroBanco($item_req->servidor);
            $reg->sequencial = ConfigDao::numeroBanco($item_req->sequencial);
            $reg->ano = ConfigDao::numeroBanco($item_req->ano);
            $reg->titulo = $item_req->titulo;
            $reg->sinopse = $item_req->sinopse;
            $reg->texto = $item_req->texto;
            $reg->data_insert_materia = ConfigDao::dataBanco($item_req->data_insert_materia);
            $reg->data_materia = ConfigDao::dataBanco($item_req->data_materia);
            $reg->hora_inicio = $item_req->hora_inicio;
            $reg->hora_fim = $item_req->hora_fim;
            $reg->duracao = $item_req->duracao;
            $reg->duracao_segundos = ConfigDao::numeroBanco($item_req->duracao_segundos);
            $reg->id_praca = ConfigDao::numeroBanco($item_req->id_praca);
            $reg->id_veiculo = ConfigDao::numeroBanco($item_req->id_veiculo);
            $reg->id_emissora = ConfigDao::numeroBanco($item_req->id_emissora);
            $reg->id_impacto = ConfigDao::numeroBanco($item_req->id_impacto);
            $reg->id_categoria = ConfigDao::numeroBanco($item_req->id_categoria);
            $reg->id_exibido = ConfigDao::numeroBanco($item_req->id_exibido);
            $reg->id_faixa_horaria = ConfigDao::numeroBanco($item_req->id_faixa_horaria);
            $reg->valor_referencia = ConfigDao::numeroBanco($item_req->valor_referencia);
            $reg->id_modulo = ConfigDao::numeroBanco($item_req->id_modulo);
            $reg->materia_enviada = ConfigDao::dataBanco($item_req->materia_enviada);
            $reg->id_registro_importado = $item_req->id_registro_importado;
            $reg->tabela_importado = $item_req->tabela_importado;
            $reg->alias_importado = $item_req->alias_importado;
            $reg->id_operador = $item_req->id_operador;
            $reg->banco_importado = $item_req->banco_importado;
            $reg->data_hora_materia = ConfigDao::dataBanco($item_req->data_hora_materia);
            $reg->sinopse_html = $item_req->sinopse_html;
            $reg->texto_html = $item_req->texto_html;
            $reg->status_atual = ConfigDao::numeroBanco($item_req->status_atual);
            $reg->cita_cliente = ConfigDao::numeroBanco($item_req->cita_cliente);
            $reg->tags = $item_req->tags;
            $reg->quadrante = $item_req->quadrante;
            $reg->id_classificacao = ConfigDao::numeroBanco($item_req->id_classificacao);
            $reg->classificacao = $item_req->classificacao;
            $reg->classificacao_resultado = $item_req->classificacao_resultado;
            $reg->nao_envia_email = ConfigDao::numeroBanco($item_req->nao_envia_email);
            $reg->destaque = $item_req->destaque;
            $reg->com_audio = ConfigDao::numeroBanco($item_req->com_audio);
            $reg->capa = ConfigDao::numeroBanco($item_req->capa);


            ConfigDao::blankToNull($reg);
                       
            $ret = $reg->save();
            $qtde_salvo++;
        }
           
        for ($i = 0; $i < count($ids_delete); $i++) {
            $item_req = $ids_delete[$i];
               
            if ($item_req != "") {
                $reg = MateriaRadiotvJornal::find($item_req);
                $reg->delete();//Removendo o item desejado para deletar.
                $qtde_delete++;
            }
        }
           
        return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
    }
       
       
       
    public static function salvarAssociacoesMaterias($id_materia, $filhos, $excluiFora = false, $tabela = "materia_radiotv_jornal")
    {
        $data_hora_materia = null;

        if ($tabela == "materia_radiotv_jornal") {
            $sql_hora_materia = "select data_hora_materia from materia_radiotv_jornal where id = " . $id_materia;

            $data_hora_materia = App\Http\Dao\ConfigDao::executeScalar($sql_hora_materia);
        }

        //id, servidor, sequencial, ano, id_materia_radiotv_jornal,
        //id_entidade, id_tipo_entidade, id_categoria, tabela_importado, banco_importado, id_registro_importado, classificacao

        $ar = explode(",", $filhos);

        $dt = null;

        if ($filhos != "") {
            $dt = DB::select("select id, nome, id_tipo from cliente where id in ( " . $lista_filhos . ") ");
        }
        $id_modulo = 3;
        //object id_modulo = ConnAccess.getScalar("select id_modulo from " + tabela + " where id = " + id_materia.ToString());

        $ls_excluir = "0";

        $classificacao = "materiartv";
            
        for ($i = 0; $i < count($dt); $i++) {
            $classificacao = "materiartv";

            if ($id_modulo == "4") {
                $classificacao = "materiajornal";
            }

            if ($tabela == "materia_eleicao") {
                $classificacao = "materia_eleicao";
            }


            if ($tabela == "campanha_eleicao") {
                $classificacao = "materia_eleicao";
            }

            if ($dt[$i]->id_tipo == "21") {
                $classificacao .= "xentidade";
            } elseif ($dt[$i]->id_tipo == "22") {
                $classificacao .= "xsubentidade";
            } elseif ($dt[$i]->id_tipo == "23") {
                $classificacao .= "xsetor";
            }
                
            $dr = new \App\AssociacaoMateriaRadiotvJornal();
                
            $sql = "select id as res from associacao_" . $tabela . " where ".
                         " and id_" . $tabela . " =" .  $id_materia .
                        " and classificacao = '" .$classificacao. "' and id_entidade = " .
                    $dt[$i]->id . " and id_categoria = 1 and  id_tipo_entidade = " . $dt[$i]->id_tipo;
                
            $id_tmp = App\Http\Dao\ConfigDao::executeScalar($sql);
                
            if ($id_tmp != "") {
                $dr = \App\AssociacaoMateriaRadiotvJornal::find($id_tmp);
            }

            if (! is_null($dr->id)) {
                $ls_excluir .= "," . $dr->id;
                continue;
            }

            $campo_id_materia = "id_". $tabela;
            $dr->$campo_id_materia = $id_materia;
            $dr->id_tipo_entidade = $dt[$i]->id_tipo;
            $dr->id_entidade = $dt[$i]->id;
            $dr->classificacao = $classificacao;
            $dr->id_categoria = 1;
            $dr->banco_importado = \App\Http\Service\UtilService::getCurrentBDdate();
                

            if ($data_hora_materia != "") {
                $dr->data_materia = $data_hora_materia;
            }
            App\Http\Dao\ConfigDao::configuraChave($dr, "materia_radiotv_jornal");
            App\Http\Dao\ConfigDao::blankToNull($dr);
            $dr->save();

            $ls_excluir .= "," .  $dr->id; // dr["id"].ToString();
        }

      

        if ($excluiFora) {
            $sql = "delete from associacao_" . $tabela . " where id_" . $tabela . " = " .
                                      $id_materia .  "  and id_categoria = " .
                                       " 1 and id not in ( " . $ls_excluir . ")  ";
            DB::statement($sql);
        }
    }
        
    public static function garanteAssociacaoEntidadesPai($id_materia, $tabela)
    {
        $sql = " select id_entidade from associacao_" .$tabela. " where id_" .$tabela. " =" .
                $id_materia . " and id_categoria = 1 ";
            
        $dt = DB::select($sql);
            
        if (count($dt) <= 0) {
            return false;
        }

        $arr = new \App\Http\Service\ArrayListService();

        $lista_filhos = \App\Http\Service\UtilService::arrayToString($dt, "id_entidade");
            
        $dt2 = DB::select("select id, nome, id_tipo, id_pai from cliente where id in ( " . $lista_filhos .
                      ") and id_pai is not null ");
            
        $pais_faltam = \App\Http\Service\UtilService::arrayToString($dt, "id_pai");


        if (count($dt2) > 0 && $pais_faltam != "") {
            self::salvarAssociacoesMaterias($id_materia, $pais_faltam, false, $tabela);
        }
    }
}
