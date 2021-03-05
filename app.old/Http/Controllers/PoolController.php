<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Service\ErrorsService;

use Illuminate\Http\Request;
use App\LoginClienteWhatsappPool;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Dao\ImageDao;
use App\Http\Dao\ConfigDao;
use Illuminate\Support\Facades\Mail;

class PoolController extends Controller {
    
    
    public function index(Request $request){
        
             $data = $request->input("data");
             $status = $request->input("status");
             $robo = $request->input("robo");
             $write = $request->input("write");

            $dataConsulta = date("Y-m-d"); // \App\Http\Service\UtilService::getCurrentBDdate();

            if ($data != "")
            {
               $dataConsulta =  $data;
            }

            $sql2 = "select * from login_cliente_registros where tipo='whatsapp' ";

            if ($robo != "")
            {
                $sql2 .= " and robo = " . $robo;
                
            } else
            {
                $sql2 .=  " and ifNull(robo,0) > 0 ";
            }
            if ($request->input("id_login_cliente") != "")
            {
                $sql2 .= " and id_login_cliente = " . $request->input("id_login_cliente") ;
            }

            //sql2 += " and id = 12 ";

            $dt = DB::select( $sql2 );

            $lst = array();

            for ($i = 0; $i < count($dt); $i++)
            {
                $dr = (array)$dt[$i];

                $sql = @"select  p.* from login_cliente_whatsapp_pool p where 1 = 1 ";


                $sql .= " and p.data_envio is null and p.data_materia >= '" .$dataConsulta. " 00:00:00' and " . " p.data_materia <= '" .$dataConsulta. " 23:59:59' ";

                $sql .= " and p.status = 1 and p.id_login_cliente = " . $dr["id_login_cliente"] . " and not exists ( select sub.id from login_cliente_whatsapp_pool_log sub  " .
                    " where sub.id_materia = p.id_materia and sub.id_login_cliente_registro = " . $dr["id"] . " )" .
                  " order by p.data_materia ";

                if ($write != "")
                {
                    die($sql );
                }
               
                $dt02 = DB::select($sql);
					
		$SubList02 = "";

                for ($zz = 0; $zz < count($dt02); $zz++)
                {
                    $sub_item = (array) $dt02[$zz];
                    
                  if ( $SubList02 != "")
			$SubList02 .= ";";
					
			$SubList02 .= $sub_item["id"]. "|" .$sub_item["id_materia"] ."|".
                                 str_replace(";","", str_replace("|","", $sub_item["texto"] ));
                }

                $nome = $dr["nome"];
                
                if ( $SubList02 != ""){
                    
                    
                    $item_saida = array("contato"=> $nome, "id" => $dr["id"] ,
                           "id_login_cliente" => $dr["id_login_cliente"], "itens" => $SubList02);
                    
                    $lst[count($lst)] = $item_saida;
                }

            }

		return $this->sendResponse( $lst );
        
        
    }
    
    
    
    
     public function historico(Request $request){



            $id_pool = $request->input("id_pool");
            $id_materia = $request->input("id_materia");
            $id_login_cliente_registro = $request->input("id_login_cliente_registro");
            $id_login_cliente = $request->input("id_login_cliente");

            if ($id_login_cliente != "" && $id_materia != ""
                 && $id_login_cliente_registro != "" && $id_pool != "")
            {
                $sql = "select id from login_cliente_whatsapp_pool_log 
                                    where id_login_cliente = " . $id_login_cliente . 
                                    " and id_materia = " . $id_materia . 
                                    " and id_login_cliente_registro = " . $id_login_cliente_registro . 
                                    " and id_pool = " . $id_pool;

                $dt = DB::select($sql);
                
                if ( count($dt) <= 0)
                {
                    $item = new \App\LoginClienteWhatsappPoolLog();

                    $item->data_envio = App\Http\Service\UtilService::getCurrentBDdate();
                    $item->id_login_cliente = $id_login_cliente;
                    $item->id_materia = $id_materia;
                    $item->id_login_cliente_registro = $id_login_cliente_registro;
                    $item->id_pool = $id_pool;
                    $item->save();
                }

                return array("success"=>true,"allready"=>false );

            }

                return array("success"=>true,"allready"=>true );
        }
        
         public function Runing_post(Request $request) //Vai indicar se o robô ainda esta rodando..
        {
             $sep_robo = ""; //Se for robô null ou 1 , vou usar a primeira variavel.

            $robo = $request->input("robo");

            if ($robo != "" )
            {
                 $sep_robo = $robo;
            }
            
            \App\Http\Dao\ConfigDao::setValor("wh_robo_runing". $sep_robo, \App\Http\Service\UtilService::getCurrentBDdate() );
             
            return array("success"=>true);
             
         }
        
          public function Runing_get(Request $request) //Vai indicar se o robô ainda esta rodando..
        {
            $sep_robo = ""; //Se for robô null ou 1 , vou usar a primeira variavel.

            $robo = $request->input("robo");

            if ($robo != "" )
            {
                 $sep_robo = $robo;
            }
            $wh_robo_runing = \App\Http\Dao\ConfigDao::getValor("wh_robo_runing". $sep_robo );
            
            return array("success"=>true, "dt" => $wh_robo_runing);  

          
        }

        
        
        
        
       // public function verifica(Request $request){
         public function TestaRoboById($roboid)
        {

            $sep_id = "";

            if ( $roboid > 1)
            {
                $sep_id = $roboid;
            }

            $wh_robo_runing = \App\Http\Dao\ConfigDao::getValor("wh_robo_runing" . $sep_id);
            $wh_robo_ultimoaviso = \App\Http\Dao\ConfigDao::getValor("wh_robo_ultimoaviso" . $sep_id);
            $wh_robo_qtde = \App\Http\Dao\ConfigDao::getValor("wh_robo_qtde");
            
            if ($wh_robo_runing == "")
            {
                return array(  "success" => false, "msg" => "O robô ainda nem começou", "id" => $roboid );
            }


            $comple = "";

            if ($wh_robo_qtde != "")
            {
                $comple = " where id_login_cliente_registro in ( select id from login_cliente_registro where tipo='whatsapp' and robo = " . $roboid . " ) ";
            }

            $max_data_envio = \App\Http\Dao\ConfigDao::executeScalar("select max(data_envio) from login_cliente_whatsapp_pool_log " . $comple);
          
            if ($max_data_envio == "")
            {
                return array( "success" => false,
                      "msg" => "O robô ainda nem começou - ultima data de envio vazia",
                      "id" => $roboid);
            }


             $dtRoboRuning = new DateTime($wh_robo_runing);
             $dtMaxEnvio = new DateTime($max_data_envio);
             $dtAgora = new DateTime(App\Http\Service\UtilService::getCurrentBDdate());
                
             $time01 = $dtAgora->diff($dtRoboRuning);
             $time02 = $dtAgora->diff($dtMaxEnvio);
          //  DateTime dtMaxEnvio = Convert.ToDateTime(max_data_envio);

          //  TimeSpan time01 = DateTime.Now - dtRoboRuning;
          //  TimeSpan time02 = DateTime.Now - dtMaxEnvio;

            $posso_enviar = false;

            if ($wh_robo_ultimoaviso == "")
            {
                $posso_enviar = true;
            }
            else
            {
                $dtLastAviso = new DateTime( $wh_robo_ultimoaviso);
                $interval = $dtAgora->diff($dtLastAviso); // DateTime.Now - dtLastAviso;
                
                $horas = $interval->format('%h') + $interval->format('%a')*24;

                if ($horas > 10)
                {
                    $posso_enviar = true; //Já tem 10 horas que mandamos isso, vou mandar mais um email porque esqueceram de ativar.
                }
            }
            
            $time02_TotalMinutes = $time02->format('%a')*24 + $time02->format('%h') + $time02->format('%i');
            $time01_TotalMinutes = $time01->format('%a')*24 + $time01->format('%h') + $time01->format('%i');


            if ($time02_TotalMinutes > 30 && $time01_TotalMinutes > 30 && $posso_enviar)
            {

                        $msg = "Ultima interação da fila do whatsapp: " .$dtRoboRuning->format("d/m/Y H:i:s"). " " .
                              "<br>Último envio de matéria: " .$dtMaxEnvio->format("d/m/Y H:i:s") . " <br><br><b>O robô ".  $roboid . "  parece que" .
                            "está parado. Verifique se o mesmo ainda continua rodando";
                        
                        $ENVIA_EMAIL = env("ENVIA_EMAIL");
                        
                        if ($ENVIA_EMAIL ){
                            
                            $EMAIL_DESTINO = env("EMAIL_DESTINO");   
                            
                            if ( $EMAIL_WHATSAPP != ""){
                                
                                           Mail::send([], [], function ($message) use ($textoEmail)  {

                                                $email_destino = env("EMAIL_DESTINO");
                                                $name_origem = env("APP_NAME");
                                                $MAIL_USERNAME = env("MAIL_USERNAME");

                                                $message->to($email_destino, $name_origem)->subject
                                                   ('Aviso de robô parado.'); 

                                                $message->setBody( $msg , 'text/html' );

                                                $message->from($MAIL_USERNAME,$name_origem);
                                             });
                            }
                               
                            
                        }

                       // EnvioEmail.Enviar(oConn, param.getValor("EmailEnvio"),
                       //     "rafaelrend@gmail.com", "robsonbrito@midiaclip.com.br,helpdesk@midiaclip.com.br",
                       //     "Aviso de Robô "+ roboid.ToString()+" whatsapp parado ", msg);

                       \App\Http\Dao\ConfigDao::setValor("wh_robo_ultimoaviso". $sep_id, App\Http\Service\UtilService::getCurrentBDdate() );
                       // param.setValor("wh_robo_ultimoaviso"+ sep_id, DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss"));
                       // return new { success = true, msg = "Avisei que o robô esta parado", id = roboid };
                       return array("success" => true, "msg" => "Avisei que o robô esta parado", "id" => $roboid );


            }
            
            return array(
                "success" => true,
                "msg" => "Robô rodando normalmente. Último envio em " +
                $dtMaxEnvio->format("d/m/Y H:i:s") . "  última interação: " . $dtRoboRuning->format("d/m/Y H:i:s") ,
            );


        }
        
        public function verifica(Request $request){
            
            $qtde_robos = 1;

            $wh_robo_qtde = \App\Http\Dao\ConfigDao::getValor("wh_robo_qtde");// param.getValor("wh_robo_qtde");

            if ($wh_robo_qtde != "" )
            {
                $qtde_robos = $wh_robo_qtde;              
            }

            $listSaida = array();
            for ( $i = 1; $i <= $qtde_robos; $i++)
            {
                $listSaida[count($listSaida)] = $this->TestaRoboById($i);
            }

            return array("res"=>$listSaida);            
        }
    
    
    
}