<?php
namespace App\Http\Dao;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;

use App\DicionarioTags;

class DicionarioTagsDao
{
    public static function getListGridCad($filtro, $order="id", $order_type="desc")
    {
        $sql = "select p.id, p.id_registro_importado as id_origem, nome from dicionario_tags p where 1 = 1 ". $filtro .
                     " order by ".$order. " ".$order_type;
             
        $itens = DB::select($sql);
             

             
        return $itens;
    }


    public static function salvarByNome($nome, $id_origem, $tipo)
    {
        $nome = str_replace("'", "", $nome);

        $filtro = " and lower(nome) = lower('".trim($nome)."') and tipo = '". $tipo."' ";
         
        if ($id_origem != "" && $id_origem != null) {
            $filtro = " and ". ConfigDao::getColunaID() . "  = ". $id_origem . " and tabela_importado = '".ConfigDao::getTabela()."' ";
        }
         
        $sql = "select p.id as res from dicionario_tags p where 1 = 1 ". $filtro;
         
         
         
        $res = ConfigDao::executeScalar($sql);
         
        $reg = new DicionarioTags();
        if ($res != "") {
            $reg = DicionarioTags::find($res);
            // return $res;
        }
        
        $reg->tipo = $tipo;
        $reg->nome = $nome;
        $reg->tabela_importado = ConfigDao::getTabela();
        if ($id_origem != "" && $id_origem != null && is_numeric($id_origem)) {
            $reg->id_registro_importado = $id_origem;
        }
        ConfigDao::configuraChave($reg, "dicionario_tags");
        ConfigDao::blankToNull($reg);
        $reg->ativo = 1; 
        $reg->save();
         
        return $reg;
    }
       
    public static function salvarDicByJson($id_cliente, $hd_json, $tipo = "dic")
    {
        $saidas = array();
           
        $itens = json_decode($hd_json);
        for ($i = 0; $i < count($itens); $i++) {
            $item = $itens[$i];
                
            $palavra = $item->nome;
            $id_origem = "";
                
            if (property_exists($item, "id_origem") && $item->id_origem != "" && is_numeric($item->id_origem)) {
                $id_origem =  $item->id_origem;
            } else {
                $tipo = "lik";
            }
                
            if (trim($palavra) == "") {
                continue;
            }
                
            $reg = self::salvarByNome($palavra, $id_origem, $tipo);
                
            AssociacaoCadastrosDao::salvar($id_cliente, $reg->id, "cliente", "dicionario_tags", "clientexdicionario");
                
            $id_dicionario =$reg->id;
            if ($reg->id_registro_importado != "") {
                $id_dicionario = $reg->id_registro_importado;
            }
                
            $saidas[count($saidas)]= array("id"=>$reg->id, "nome"=>$palavra);
        }
            
        return $saidas;
    }
    
    public static function salvarDadosJson($hd_json, $ids_delete_json)
    {
        $itens = json_decode($hd_json);
        $ids_delete = json_decode($ids_delete_json);
           
        $qtde_salvo = 0;
        $qtde_delete = 0;
           
        for ($i = 0; $i < count($itens); $i++) {
            $item_req = $itens[$i];
                       
            $reg = new DicionarioTags();
                       
            if ($item_req->id != "") {
                $reg = DicionarioTags::find($item_req->id);
            }
            $reg->nome = $item_req->nome;
            $reg->servidor = ConfigDao::numeroBanco($item_req->servidor);
            $reg->ano = ConfigDao::numeroBanco($item_req->ano);
            $reg->sequencial = ConfigDao::numeroBanco($item_req->sequencial);
            $reg->tipo = $item_req->tipo;
                       
                       
            ConfigDao::blankToNull($reg);
                       
            $ret = $reg->save();
            $qtde_salvo++;
        }
           
        for ($i = 0; $i < count($ids_delete); $i++) {
            $item_req = $ids_delete[$i];
               
            if ($item_req != "") {
                $reg = DicionarioTags::find($item_req);
                $reg->delete();//Removendo o item desejado para deletar.
                $qtde_delete++;
            }
        }
           
        return array("qtde_salvo" => $qtde_salvo, "qtde_deleted" => $qtde_delete , "success"=> true );
    }
}
