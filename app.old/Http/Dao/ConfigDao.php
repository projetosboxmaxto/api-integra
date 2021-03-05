<?php
namespace App\Http\Dao;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\ParametrosConfiguracao;

class ConfigDao
{
    public static $tabela_importado = "integrador";

    public static function getIDByOrigem($id_origem, $tabela)
    {
        $tabela_importado = self::getTabela();

        $sql = "select id as res from ". $tabela." where id_registro_importado = ".$id_origem .
                       " and tabela_importado = '". $tabela_importado ."' ";
        //die($sql );
        return self::executeScalar($sql);
    }
        
    public static function getIDSByOrigem($ids_origem, $tabela)
    {
        $tabela_importado = self::getTabela();

        $sql = "select id from ". $tabela." where id_registro_importado in ( ".$ids_origem .
                       " )  and tabela_importado = '". $tabela_importado ."' ";
        $ls = DB::select($sql);
        $ids_saida = \App\Http\Service\UtilService::arrayToString($ls, "id", ",");
               
        return $ids_saida;
    }
       
    public static function getColunaID()
    {
        return "id_registro_importado";
    }
        
    public static function getTabela()
    {
        return "integrador";
    }
        
        
    public static function setValor($key, $value)
    {
        $idtmp = self::getValor($key, "id");

        if ($idtmp == "") {
            $obj = new ParametrosConfiguracao();
            $obj->codigo =  $key;
            $obj->valor =  $value;

            $obj->save();

            return $obj;
        } else {
            $obj = ParametrosConfiguracao::find($idtmp);
            $obj->codigo =  $key;
            $obj->valor =  $value;
            $obj->save();
        }
    }
    
    public static function getValor($key, $campo = "valor")
    {
        $sql = " select ".$campo." as res from parametros_configuracao where  codigo ='". $key."' ";

        $res = self::executeScalar($sql);

        return $res;
    }
    
    
    public static function executeScalar($sql)
    {
        $ar = DB::select($sql);
                                        
        if (count($ar) <= 0) {
            return "";
        }
                    
        //print_r( $ar ); die(" ");
                    
        return $ar[0]->res;
    }
    public static function configuraChave(&$item, $tabela)
    {
        $ano = date("Y");
        $servidor = 1;
        $sequencial = 1;
        
        try {
            $sql = "select max(sequencial) as res from ". $tabela. " where ano = ". $ano. " and servidor = ". $servidor;
            $sequencial = self::executeScalar($sql);

            if ($sequencial == "") {
                $sequencial = 0;
            }
            $sequencial++;

            $item->servidor = $servidor;
            $item->ano = $ano;
            $item->sequencial = $sequencial;
        } catch (Exception $ex) {
        }
    }
    public static function executeScalar2($sql)
    {
        $ar = DB::connection('mysql_transcricao')->select($sql);
                                        
        if (count($ar) <= 0) {
            return "";
        }
                    
        //print_r( $ar ); die(" ");
                    
        return $ar[0]->res;
    }
         
    
    public static function blankToNull(&$eloquentObj)
    {
        $columns =  $eloquentObj->getFillable();
                    
                    
        foreach ($columns as $column) {
            if ($eloquentObj->$column == "") {
                $eloquentObj->$column = null;
            }
        }
    }
    
    
    public static function dataBanco($valor)
    {
        if ($valor == "") {
            return "";
        }
        
        $hora = "";
        if (strpos(" ". $valor, ":")) {
            $ar = explode(" ", $valor);
                    
            if (@$ar[1] != "") {
                $hora = " ". $ar[1];
            }
            $valor = $ar[0];
        }
                
                
        $arr = explode("/", $valor);
        
        return trim($arr[2])."-".trim($arr[1])."-".trim($arr[0]). $hora;
    }
        
    public static function DataBR($valor, $semhora =false)
    {
        if ($valor == "") {
            return "";
        }

        if (strpos(" ". $valor, ".")) {
            $exp = explode(".", $valor);
            $valor = $exp[0];
        }


        $valor = str_replace("-", "/", $valor);

        $ar = explode(" ", $valor);
        $arr = explode("/", $ar[0]);

        if (count($arr) < 3) {
            return "";
        }

        $hora = "";
        if (! $semhora) {
            $hora = " " . @$ar[1];
        }

        return $arr[2]."/".$arr[1]."/".$arr[0].$hora;
    }
            
    public static function DataToHourBR($valor)
    {
        if ($valor == "") {
            return "";
        }

        if (strpos(" ". $valor, ".")) {
            $exp = explode(".", $valor);
            $valor = $exp[0];
        }


        $valor = str_replace("-", "/", $valor);

        $ar = explode(" ", $valor);
        $arr = explode("/", $ar[0]);

        if (count($arr) < 3) {
            return "";
        }

        $hora = "";
        $hora =  @$ar[1];

        return $hora;
    }
            
    public static function numeroBanco($valor)
    {
        $val = str_replace(".", "", $valor);
        $val = str_replace(",", ".", $val);
        
        $val  = round($val, 2);
        
        $val = str_replace(".00", "", $val);
        for ($i =1 ; $i <= 9; $i++) {
            $val = str_replace(".".$i."0", ".".$i, $val);
        }
        
        return $val;
    }
    public static function numeroTela($valor, $removeZeros=1)
    {
        if ($valor == null || $valor =="") {
            return "";
        }
        
        $val = number_format($valor, 2, ",", ".");
        
        // $val = str_replace(".",",",$valor);
        if ($removeZeros) {
            $val = str_replace(",00", "", $val);
            for ($i =1 ; $i <= 9; $i++) {
                $val = str_replace(",".$i."0", ",".$i, $val);
            }
        }
        if ($removeZeros == 1) {
            $val = str_replace(".", "", $val);
        }
            
            
        return $val;
    }
        
              
    
    public static function arrayToString(
        $arr,
        $propriedade,
        $sep = ",",
        $idd = 0,
        $testaVazio = false,
        $format = false
    )
    {
        $str = "";
        for ($i = 0; $i< count($arr); $i++) {
            $vv = $arr[$i]->$propriedade;
            
            if ($testaVazio) {
                if (trim($vv) == "") {
                    continue;
                }
            }
            
            if ($format) {
                $vv = str_replace("'", "", $vv);
                $vv = str_replace($sep, "+", $vv);
            }
                        
            if ($str != "") {
                $str .= $sep;
            }
                        
            $str .= $vv;
        }
        
        return $str;
    }
}
