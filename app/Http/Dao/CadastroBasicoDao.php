<?php
namespace App\Http\Dao;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Dao\ConfigDao;

use App\CadastroBasico;

class CadastroBasicoDao
{
    public static $tabela_importado = "integrador";
    
    public static function getListGridCad($filtro= "", $order = "descricao", $order_type = "asc")
    {
        $sql = "select p.id, p.descricao as nome, p.id_registro_importado as id_origem from cadastro_basico p where 1 = 1 ". $filtro .
                     " order by ".$order. " ".$order_type;
             
        $itens = DB::select($sql);

        return $itens;
    }
       
    public static function getIDByOrigem($id_origem, $tipo_cadastro_basico)
    {
        $tabela = "cadastro_basico";
        $tabela_importado = ConfigDao::getTabela();
               
        $sql = "select id as res from ". $tabela." where id_registro_importado = ".$id_origem .
                       " and tabela_importado = '". $tabela_importado ."' and tipo_cadastro_basico = ". $tipo_cadastro_basico;
        return ConfigDao::executeScalar($sql);
    }
    
    public static function salvarDadosJson($hd_json, $tipo_cadastro_basico, $ids_delete_json = "")
    {
        $itens = json_decode($hd_json);
        //print_r( $itens ); die(" ");
           
        $qtde_salvo = 0;
        $qtde_delete = 0;
        $ids = "0";
           
        for ($i = 0; $i < count($itens); $i++) {
            $item_req = $itens[$i];
                       
            $reg = new CadastroBasico();
                       
            if ($item_req->id_origem != "") {
                $sql = "select id as res from cadastro_basico "
                                     . " where tabela_importado = '".self::$tabela_importado."' and ".
                                     ConfigDao::getColunaID()."= " . $item_req->id_origem." and tipo_cadastro_basico = ". $tipo_cadastro_basico;
                //die( $sql );
                             
                $idtmp = ConfigDao::executeScalar($sql);
                if ($idtmp != "") {
                    $reg = CadastroBasico::find($idtmp);
                }
            }
            $reg->descricao = $item_req->nome;
            $reg->tipo_cadastro_basico = $tipo_cadastro_basico;
            $reg->id_registro_importado = $item_req->id_origem;
            $reg->tabela_importado = self::$tabela_importado;
                       
            if (property_exists($item_req, "campo1")) {
                $reg->campo1 = $item_req->campo1;
                $reg->campo2 = $item_req->campo2;
                $reg->campo3 = $item_req->campo3;
            }
                       
                       
            ConfigDao::configuraChave($reg, "cadastro_basico");
            ConfigDao::blankToNull($reg);
                       
            $ret = $reg->save();

            $ids .= ",". $reg->id;
            $qtde_salvo++;
        }
           
        if ($ids_delete_json != "") {
            $ids_delete = json_decode($ids_delete_json);

            for ($i = 0; $i < count($ids_delete); $i++) {
                $item_req = $ids_delete[$i];
                   
                if ($item_req != "") {
                    $idtmp = ConfigDao::executeScalar("select id as res from cadastro_basico where"
                                     . " tabela_importado = '".self::$tabela_importado."' and ".ConfigDao::getColunaID()." = " . $item_req ." and tipo_cadastro_basico = ". $tipo_cadastro_basico);

                    if ($idtmp != "") {
                        $reg = CadastroBasico::find($idtmp);
                        $reg->delete();//Removendo o item desejado para deletar.
                        $qtde_delete++;
                    }
                }
            }
        }

        $ls_data = self::getListGridCad("and id in ( ". $ids." ) ");
           
        //"qtde_deleted" => $qtde_delete
        return array("qtde" => $qtde_salvo, "data" => $ls_data);
    }
       
    public static function removeByIds($ids_delete_json, $tipo_cadastro_basico)
    {
        if ($ids_delete_json != "") {
            $ls_data = self::getListGridCad("and id in ( ". $ids_delete_json." ) ");
            $ids_delete = explode(",", $ids_delete_json);

            for ($i = 0; $i < count($ids_delete); $i++) {
                $item_req = $ids_delete[$i];
                   
                if ($item_req != "") {
                    $idtmp = ConfigDao::executeScalar("select id as res from cadastro_basico "
                                     . "where tabela_importado = '".self::$tabela_importado."' and ".ConfigDao::getColunaID()."  = " . $item_req ." and tipo_cadastro_basico = ". $tipo_cadastro_basico);

                    if ($idtmp != "") {
                        $reg = CadastroBasico::find($idtmp);
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
