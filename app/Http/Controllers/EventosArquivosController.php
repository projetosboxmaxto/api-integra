<?php

namespace App\Http\Controllers;

use App\EventosArquivos;
use App\Http\Controllers\Controller;
use App\Http\Dao\PostsDao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventosArquivosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $filtro = "";
        $order = " id ";
        $order_type = "asc";
        $id_emissora = "";
        $id_programa = "";

        if ($request->input("filtro") != "") {
            $str_filt = str_replace("'", "''", $request->input("filtro"));
            $filtro .= " and ( texto like '%" . $str_filt . "%'  ) ";
        }
        if ($request->input("id_programa") != "") {
            $id_programa = \App\Http\Dao\ConfigDao::getIDByOrigem($request->input("id_programa"), "programa");
            if ($id_programa != "") {
                $filtro .= " and ev.id_programa = " . $id_programa;
            }
        }
        if ($request->input("id_emissora") != "") {
            $id_emissora = \App\Http\Dao\ConfigDao::getIDByOrigem($request->input("id_emissora"), "emissora");
            if ($id_emissora != "") {
                $filtro .= " and ev.id_emissora = " . $id_emissora;
            }
        }
        if ($request->input("com_busca_salva") != "") {
            $filtro .= " and p.com_temp_search = " . $request->input("com_busca_salva");
        }
        $filtro .= " and ev.tipo = 'pai' ";

        if ($request->input("data_inicio") != "") {
            $filtro .= " and ev.data >= '" . $request->input("data_inicio") . " 00:00:00' ";
        }
        if ($request->input("data_fim") != "") {
            $filtro .= " and ev.data <= '" . $request->input("data_fim") . " 23:59:59' ";
        }
        if ($request->input("min_id") != "") {
            $filtro .= " and p.id > " . $request->input("min_id");
        }

        if ($request->input("order") != "") {
            $order = $request->input("order");
        }

        if ($request->input("order_type") != "") {
            $order_type = $request->input("order_type");
        }

        $itens = \App\Http\Dao\EventosArquivosDao::getListGridCad($filtro, $order, $order_type);

        return $this->sendResponse(array("qtde" => count($itens), "data" => $itens));
    }

    public function saveJsonData(Request $request)
    {
        $data = $request->input("data");

        if ($data == "") {
            return $this->sendErro(array("code" => 0, "msg" => "O campo data esta vazio"));
        }

        $itens = \App\Http\Dao\EventosArquivosPalavrasDao::salvarDadosJson($data);

        return $this->sendResponse($itens);
    }

    public function salvarClientePalavra(Request $request)
    {
        $obj = new \App\Transcricao\EventosArquivosPalavras();

        $obj_arquivo = \App\Transcricao\EventosArquivos::find($request->input("id_arquivo"));
        $id_dicionario = $request->input("id_dicionario");
        $obj->id_evento_arquivo = $request->input("id_arquivo");
        $obj->id_cliente = \App\Http\Dao\ConfigDao::getIDByOrigem($request->input("id_cliente"), "cliente");
        $obj->palavra = $request->input("palavra");
        $obj->id_evento = \App\Http\Dao\ConfigDao::executeScalar2("select id_evento as res from eventos_arquivos where id =  " . $obj->id_evento_arquivo); //  $request->input("id_arquivo");
        $obj->cita_diretamente = $request->input("cita_diretamente");
        $obj->tempo = $request->input("tempo");
        $obj->tempo_seg = \App\Http\Service\UtilService::time_to_seconds2($obj->tempo);
        $obj->data = \App\Http\Dao\ConfigDao::executeScalar2("select data as res from eventos where id =  " . $obj->id_evento);
        $sentimento = $request->input("sentimento");
        $operador = null; // $request->input("operador");

        if ($sentimento != "") {
            $obj->sentimento = $sentimento;
        }
        $trecho = $request->input("trecho");
        if ($trecho != "") {
            $tempo_encontrado = \App\Http\Dao\EventosArquivosPalavrasDao::buscarTextoFrom($obj_arquivo->json, $obj->palavra, $trecho);
        }
        $obj->trecho = $trecho;

        $id_tmp = \App\Http\Dao\EventosArquivosPalavrasDao::salvar($obj, $obj->palavra, $operador, $obj->id_evento_arquivo);

        //die("sentimento ". $obj->sentimento );
        $ls_saida = \App\Http\Dao\EventosArquivosPalavrasDao::getListGridCad(" and p.id = " . $id_tmp);

        //\App\Transcricao\EventosArquivosPalavras::find($id_tmp);

        return $this->sendResponse(array("data" => $ls_saida[0]));
        //$id_arquivo = $request->input("id_arquivo");
        //$id_cliente = $request->input("id_cliente");
        //$cita_diretamente = $request->input("cita_diretamente");
        //$palavra = $request->input("palavra");
        //

        /*
    "id_arquivo": 1,
     *          "id_cliente": 1,
     *          "cita_diretamente": 1,
     *          "palavra": "Salvador",
     *          "tempo": "00:01:00",
     *          "id_dicionario": 1,
     *          "sentimento": "positivo"
     * */
    }

    /*
    Route::get('/api/eventos_arquivos', 'EventosArquivosController@index');
    Route::get('/api/eventos_arquivos/{id}', 'EventosArquivosController@show');
    Route::put('/api/eventos_arquivos/{id}', 'EventosArquivosController@update');
    Route::post('/api/eventos_arquivos', 'EventosArquivosController@create');
    Route::delete('/api/eventos_arquivos/{id}', 'EventosArquivosController@destroy');

    Route::resource('eventos_arquivos', 'EventosArquivosController');
    router_resourceapi("eventos_arquivos", "EventosArquivosController");

     */

    public function testheader(Request $request)
    {
        $o_auth_header = $GLOBALS["auth_header"];
        return array("msg" => "Teste", "header" => $o_auth_header);
    }

    public function grid(Request $request)
    {
        $filtro = "";
        $str_filt = "";

        $page = $request->input("page");
        $pagesize = $request->input("pagesize");

        if ($pagesize == "") {
            $pagesize = 10;
        }

        if ($page == "") {
            $page = 1;
        }

        if ($request->input("filtro") != "") {
            $str_filt = str_replace("'", "''", $request->input("filtro"));
            $filtro .= " and ( nome like '%" . $str_filt . "%' or email like '%" . $str_filt . "%' ) ";
        }

        $sql = " select count(*) as res from eventos_arquivos where 1 = 1 " . $filtro;
        $total_itens = $this->executeScalar($sql);

        $inicio = 0;
        $fim = 0;
        $this->SetaRsetPaginacao($pagesize, $page, $total_itens, $inicio, $fim);

        $order = $request->input("order");
        $order_type = $request->input("order_type");
        if ($order == "") {
            $order = "id";
        }
        if ($order_type == "") {
            $order_type = "asc";
        }

        $sql = "select p.* from eventos_arquivos p where 1 = 1 " . $filtro . " order by " . $order . " " . $order_type .
        $this->get_limit_sql($inicio, $pagesize);
        $itens = DB::select($sql);
        //OFFSET 50 ROWS FETCH NEXT 100 ROWS ONLY

        $saida = array("page" => $page, "pagesize" => $pagesize, "order" => $order,
            "total" => $total_itens, "total_itens" => $total_itens,
            "order_type" => $order_type, "itens" => $itens);

        return $saida;
    }

    private function loadRequests(Request $request, \App\EventosArquivos &$reg)
    {
        $reg->path = $request->input('path');
        $reg->nome = $request->input('nome');
        $reg->id_evento = $request->input('id_evento');
        $reg->tempo_realizado_minutos = $request->input('tempo_realizado_minutos');
        $reg->hora_inicio = $request->input('hora_inicio');
        $reg->id_materia_radiotv_jornal = $request->input('id_materia_radiotv_jornal');
        $reg->titulo = $request->input('titulo');
        $reg->status = $request->input('status');
        $reg->bloqueado_por_id = $request->input('bloqueado_por_id');
        $reg->com_elastic_search = $request->input('com_elastic_search');
        $reg->meta_dados_elastic = $request->input('meta_dados_elastic');

        PostsDao::blankToNull($reg);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $reg = new \App\EventosArquivos;

        $this->loadRequests($request, $reg);

        $ret = $reg->save();

        $msg = "sucesso!";
        $code = 1;
        if (!$ret) {
            $code = 0;
            $msg = "erro";
        }

        $final = array("msg" => $msg, "code" => $code, "success" => $ret, "results" => $reg,
            "data" => $reg, "item" => $reg);

        return $this->sendResponse($final);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $reg = EventosArquivos::find($id);

        $final = array("code" => 1, "data" => $reg, "item" => $reg);
        return $this->sendResponse($final);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Request $request)
    {
        // return "metodo EDIT";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $reg = EventosArquivos::find($id);

        $this->loadRequests($request, $reg);

        $ret = $reg->save();

        $msg = "sucesso!";
        $code = 1;
        if (!$ret) {
            $code = 0;
            $msg = "erro";
        }

        $final = array("msg" => $msg, "code" => $code, "success" => $ret, "data" => $reg, "item" => $reg);
        return $this->sendResponse($final);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $reg = EventosArquivos::find($id);
        $ret = $reg->delete();

        $final = array("msg" => "sucesso", "code" => 1, "success" => $ret, "data" => $reg);

        return $this->sendResponse($final);
    }
}
