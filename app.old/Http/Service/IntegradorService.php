<?php
namespace App\Http\Service;
use Illuminate\Support\Facades\DB;

 class  IntegradorService
 {
     
    public static function getValor($cod)
    {
            $sql = " select valor from parametros_configuracao where codigo = '" . $cod . "' ";
            $dt = DB::select( $sql );
           

             if (count($dt) > 0)
             {
                 $val = $dt[0]->valor;
                 return $val;
             }
                unset( $dt );
                return "";
     }
     
       public static function getPrefixoModulo($id ){

            if ($id == 4)
                return "IMP";


            if ($id == 3)
                return "RTV";


            if ($id == 1)
                return "ENT";

            if ($id == 40)
                return "ONLINE";

            return "RTV";
        }
    public static function getPastaMateria($id_modulo,  $ano = "", $mes = "")
    {


        $pasta_salvar =  self::getValor("PastaArquivo");
        $pasta_abspath = self::getValor("PastaArquivo_ABSPATH");
        
        $pasta_destino = $pasta_salvar;
        
        $prefixo_modulo = self::getPrefixoModulo($id_modulo);
                
        if ( $pasta_abspath == "1"){
            
            $saida = realpath($pasta_salvar ."/". $prefixo_modulo );
            
            if (!file_exists(realpath($pasta_salvar ."/". $prefixo_modulo ))){
                mkdir( realpath($pasta_salvar ."/". $prefixo_modulo ) , 0777);
            }
            if ( $ano != ""){
                        if (!file_exists(realpath($pasta_salvar ."/". $prefixo_modulo."/".$ano ))){
                            mkdir( realpath($pasta_salvar ."/". $prefixo_modulo."/".$ano ) , 0777);
                        }
                        $saida = realpath($pasta_salvar ."/". $prefixo_modulo."/".$ano );
            }
            if ( $ano != "" && $mes != ""){
                        if (!file_exists(realpath($pasta_salvar ."/". $prefixo_modulo."/".$ano."/".$mes ))){
                            mkdir( realpath($pasta_salvar ."/". $prefixo_modulo."/".$ano."/".$mes ) , 0777);
                        }
                        $saida = realpath($pasta_salvar ."/". $prefixo_modulo."/".$ano."/".$mes );
            }
            
            return $saida;
        }
        else
        {
            $saida = $pasta_salvar . DIRECTORY_SEPARATOR . $prefixo_modulo;
            if (!file_exists( $saida  )){
                mkdir($saida , 0777);
            }
            
            if ( $ano != ""){
                
                        $saida .= DIRECTORY_SEPARATOR . $ano;
                
                        if (!file_exists($saida)){
                            mkdir( $saida  , 0777);
                        }
            }
            if ( $ano != "" && $mes != ""){
                
                        $saida .= DIRECTORY_SEPARATOR . $mes;
                        if (!file_exists($saida)){
                            mkdir( $saida , 0777);
                        }
            }
            
            return $saida;
            
        }

    }
 }

 
 ?>

