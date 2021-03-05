<?php


/**
 * @api {get} /arquivos_transcritos Listar
 * @apiGroup Arquivos Transcritos
 * @apiParam {text} filtro  por texto existente na transcrição.
 * @apiParam {text} data_inicio Data de início, formato YYYY-MM-DD ex: 2020-02-20
 * @apiParam {text} data_fim Data de início, formato YYYY-MM-DD ex: 2020-02-20
 * @apiParam {number} id_programa ID do programa (no cadastro do cliente)
 * @apiParam {number} id_emissora ID da emissora (no cadastro do cliente)
 * @apiParam {number} com_busca_salva Arquivos que já tiveram buscas ou não. 0 - Não fez busca, 1 - Fez buscas. Vazio ou Nulo =>Tudo
 * @apiParam {number} min_id menor id do arquivo. Se informado a lista só trará arquivos com id acima do informado neste campo.
 * @apiParamExample {json} Request-Example:
 * {
 *          "filtro": "",
 *          "data_inicio": "",
 *          "data_fim": "",
 *          "id_programa": "",
 *          "id_emissora": "",
 *          "com_busca_salva": ""
 *
 * }
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
       "qtde": 2,
       "data": [
        {
            "id": 12,
            "path": "eventos/20191016/2/43-metropolefm_2019-10-16_06-51-20.mp3",
            "url": "eventos/20191016/2/43-metropolefm_2019-10-16_06-51-20.mp3",
            "data": "2019-10-16 00:00:00",
            "nome": "43-metropolefm_2019-10-16_06-51-20.mp3",
            "hora_inicio": "06:50:03",
            "texto": "reforma administrativa elinaldo ele fez com que desaparecessem retirou das das secretarias a secretaria de turismo depois harry fez a reforma administrativa fez uma segunda reforma administrativa e colocou a secretaria de turismo que está totalmente ineficiente pagando uma fortuna por mês de aluguel de uma casa lá botou um vereador sem perfil para o turismo lá em camaçari e nós temos hoje um problema seríssimo na orla que é a falta de estrutura a falta de desenvolvimento do turismo não se reforma administrativa ele criou cargos cargos novos cargos é porque os cargos mais importantes da a que sou secretários depois ver as coordenações das assessorias ele iniciou com gente de fora né trouxe de césar para feira de santana trouxe de salvador trouxe",
            "json": "[{\"final_result\": true, \"result_status\": \"RECOGNIZED\", \"start_time\": 0.0, \"alternatives\": [{\"text\": \"reforma administrativa elinaldo ele fez com...",
            "id_evento": 1,
            "com_busca_salva": 0,
            "status": 1,
            "id_programa": 100,
            "id_emissora": 1,
            "nome_programa": "Programa novo",
            "nome_emissora": "TV Bahia"
        },
        {
            "id": 13,
            "path": "eventos/20191016/2/43-metropolefm_2019-10-16_06-56-20.mp3",
            "url": "eventos/20191016/2/43-metropolefm_2019-10-16_06-56-20.mp3",
            "data": "2019-10-16 00:00:00",
            "nome": "43-metropolefm_2019-10-16_06-56-20.mp3",
            "hora_inicio": "06:55:03",
            "texto": "reforma administrativa elinaldo ele fez com que desaparecessem retirou das das secretarias a secretaria de turismo depois harry fez a reforma administrativa fez uma segunda reforma administrativa e colocou a secretaria de turismo que está totalmente ineficiente pagando uma fortuna por mês de aluguel de uma casa lá botou um vereador sem perfil para o turismo lá em camaçari e nós temos hoje um problema seríssimo na orla que é a falta de estrutura a falta de desenvolvimento do turismo não se reforma administrativa ele criou cargos cargos novos cargos é porque os cargos mais importantes da a que sou secretários depois ver as coordenações das assessorias ele iniciou com gente de fora né trouxe de césar para feira de santana trouxe de salvador trouxe",
            "json": "[{\"final_result\": true, \"result_status\": \"RECOGNIZED\", \"start_time\": 0.0, \"alternatives\": [{\"text\": \"reforma administrativa elinaldo ele fez com...",
            "id_evento": 1,
            "com_busca_salva": 0,
            "status": 1,
            "id_programa": 100,
            "id_emissora": 1,
            "nome_programa": "Programa novo",
            "nome_emissora": "TV Bahia"
        }
    ]
}
 *
 *
 **/


/**
 * @api {post} /arquivos_transcritos/palavras Salvar Busca Realizada
 * @apiGroup Arquivos Transcritos
 * @apiParam {text} palavra  Palavra Chave
 * @apiParam {text} tempo  Tempo (HH:MM:SS) em que esta palavra foi localizada na legenda, Ex: 00:20:01
 * @apiParam {number} id_arquivo  Id do arquivo
 * @apiParam {number} id_cliente  Id do cliente 
 * @apiParam {number} cita_diretamente  0 ou 1 - Caso cite diretamente o nome do cliente 
 * @apiParam {number} id_dicionario  Id da palavra cadastrada (opcional)
 * @apiParam {text} sentimento  Sentimento sobre o termo localizado.
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *          "id_arquivo": 1,
 *          "id_cliente": 1,
 *          "cita_diretamente": 1,
 *          "palavra": "Salvador",
 *          "tempo": "00:01:00",
 *          "id_dicionario": 1,
 *          "sentimento": "neutro",
 *          "trecho": "cidade Salvador enfrenta problemas"
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
          {
		        "id": 14,
		        "data": "2019-10-16 00:00:00",
		        "id_evento": 1,
		        "id_evento_arquivo": 1,
		        "id_cliente": 1,
		        "cita_diretamente": 1,
		        "palavra": "metro",
		        "tempo": "00:00:39",
		        "tempo_seg": 39,
		        "id_dicionario_tag": null,
		        "status": 1,
		        "operador": null,
		        "id_operador": null,
		        "trecho": "cidade Salvador enfrenta problemas",
		        "id_notificacao_agrupamento": null,
		        "indexed": null,
		        "sentimento": "neutro"
          },
 *      "msg": "Sucesso!"
 *    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200
 *     {
 *          "msg": "erro",
 *          "code": 0,
 *    }
 *
 *
 *
 **/



/**
 * @api {post} /arquivos_transcritos/palavras_bulk Salvar Busca por JSON
 * @apiGroup Arquivos Transcritos
 * @apiParam {text} data  Json (em formato de texto) com várias buscas a serem salvas. Veja no exemplo abaixo o modelo.
 *
 * @apiParamExample {json} Request-Example:
 *    {
         "data":
             [
                    {
                      "id_arquivo":1, 
                     "id_cliente":1,
                      "cita_diretamente":1,
                      "palavra":"Salvador",
                      "tempo":"00:01:00",
                      "id_dicionario":1,
                      "sentimento":"neutro"
                      }
             ]
      }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
		    "qtde_salvo": 1,
		    "success": true
	  }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200
 *     {
 *          "msg": "erro",
 *          "code": 0,
 *    }
 *
 *
 *
 **/

