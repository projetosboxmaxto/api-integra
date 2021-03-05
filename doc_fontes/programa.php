<?php


/**
 * @api {get} /programas Lista Programas
 * @apiGroup Programas
 * @apiParamExample {json} Request-Example:
 * {
 *          "filtro": "",
 *          "order": "nome",
 *          "order_type": "asc"
 *
 * }
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *     [
 *		  { 
 *	           "id": 100,
 *             "nome": "Programa a hora",
 *             "hora_inicio": "00:10:10",
 *             "hora_fim": "02:00:00",
 *             "id_origem": 145,
 *             "transcricao_ativar": 1,
 *             "transcricao_tempo_extra_inicio": "00:05:00",
 *             "transcricao_tempo_extra_fim": "00:05:00",
 *             "transcricao_prioridade": "Normal",
 *             "transcricao_dias": "1,2,3,4,5",
 *             "id_emissora": 1
 *        }
 *     ]   
 *    }
 *
 *
 *
 **/

/**
 * @api {get} /programas/:id Show
 * @apiGroup Programas
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *      {
 *       "code": 1,
 *       "data":
 *        { 
 *	        "id": 100,
 *          "nome": "Programa a hora",
 *          "hora_inicio": "00:10:10",
 *          "hora_fim": "02:00:00",
 *          "id_origem": 145,
 *          "transcricao_ativar": 1,
 *          "transcricao_tempo_extra_inicio": "00:05:00",
 *          "transcricao_tempo_extra_fim": "00:05:00",
 *          "transcricao_prioridade": "Normal",
 *          "transcricao_dias": "1,2,3,4,5",
 *          "id_emissora": 1
 *        }
 *    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400
 *     {
 *       "message": "erro"
 *     }
 *
 *
 *
 **/

/**
 * @api {post} /programas/ Create
 * @apiGroup Programas
 * @apiParam {text} nome Nome do Programa
 * @apiParam {number} id_origem Id do programa no cadastro do cliente
 * @apiParam {text} hora_inicio Hora de Início do programa, formato => hora : minuto : segundos -> ex: 01:30:00
 * @apiParam {text} hora_fim Hora final do programa, formato => hora : minuto : segundos -> ex: 04:30:00
 * @apiParam {number} transcricao_ativar Ativa transcrição? (1 ou 0 ) - 1 - Sim, 0 - Não 
 * @apiParam {number} transcricao_prioridade prioridade: Baixa, Normal, Alta
 * @apiParam {text} transcricao_tempo_extra_inicio Tempo extra de início, ex: 00:05:00
 * @apiParam {text} transcricao_tempo_extra_fim Tempo extra final, ex: 00:05:00
 * @apiParam {text} transcricao_dias Dias da semana que o programa deve ser gravado=> 0-domingo, 1 - segunda, 3 - terça... 6- sábado. Salve separado por vírgula, ex: 1,2,3
 * @apiParam {number} id_emissora Id da emissora no cadastro do cliente
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *          "nome": "Programa a hora",
 *          "hora_inicio": "00:10:10",
 *          "hora_fim": "02:00:00",
 *          "id_origem": 145,
 *          "transcricao_ativar": 1,
 *          "transcricao_tempo_extra_inicio": "00:05:00",
 *          "transcricao_tempo_extra_fim": "00:05:00",
 *          "transcricao_prioridade": "Normal",
 *          "transcricao_dias": "1,2,3,4,5",
 *          "id_emissora": 1
 *
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
 *          "id": 1,
 *          "nome": "Programa a hora",
 *          "hora_inicio": "00:10:10",
 *          "hora_fim": "02:00:00",
 *          "id_origem": 145,
 *          "transcricao_ativar": 1,
 *          "transcricao_tempo_extra_inicio": "00:05:00",
 *          "transcricao_tempo_extra_fim": "00:05:00",
 *          "transcricao_prioridade": "Normal",
 *          "transcricao_dias": "1,2,3,4,5",
 *          "id_emissora": 1
 *
 *        },
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
 * @api {put} /programas/:id Update
 * @apiGroup Programas
 * @apiParam {number} id Id de origem do programa no cadastro do cliente.
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *          "id": 1,
 *          "nome": "Programa a hora",
 *          "hora_inicio": "00:10:10",
 *          "hora_fim": "02:00:00",
 *          "id_origem": 145,
 *          "transcricao_ativar": 1,
 *          "transcricao_tempo_extra_inicio": "00:05:00",
 *          "transcricao_tempo_extra_fim": "00:05:00",
 *          "transcricao_prioridade": "Normal",
 *          "transcricao_dias": "1,2,3,4,5",
 *          "id_emissora": 1
 *
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
 *          "id": 1,
 *          "nome": "Programa a hora",
 *          "hora_inicio": "00:10:10",
 *          "hora_fim": "02:00:00",
 *          "id_origem": 145,
 *          "transcricao_ativar": 1,
 *          "transcricao_tempo_extra_inicio": "00:05:00",
 *          "transcricao_tempo_extra_fim": "00:05:00",
 *          "transcricao_prioridade": "Normal",
 *          "transcricao_dias": "1,2,3,4,5",
 *          "id_emissora": 1
 *
 *        },
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
 **/
 
 /**
 * @api {delete} /programas/:id Delete
 * @apiGroup Programas 
 * @apiParam {number} id Id de origem do programa no cadastro do cliente.
 *
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
 *          "id": 1,
 *          "nome": "Programa a hora",
 *          "hora_inicio": "00:10:10",
 *          "hora_fim": "02:00:00",
 *          "id_origem": 145,
 *          "transcricao_ativar": 1,
 *          "transcricao_tempo_extra_inicio": "00:05:00",
 *          "transcricao_tempo_extra_fim": "00:05:00",
 *          "transcricao_prioridade": "Normal",
 *          "transcricao_dias": "1,2,3,4,5",
 *          "id_emissora": 1
 *
 *        },
 *      "msg": "Sucesso!"
 *    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200
 *     {
 *          "msg": "erro",
 *          "code": 0,
 *     }
 *
 *
 **/
 

 /**
 * @api {post} /programas_bulk/ Save from JSON
 * @apiGroup Programas
 * @apiParam {text} data Array de Programas  em formato JSON - Obs: enviar o dado como texto
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *        "data": "[
 *					        {
 *                              "nome": "Programa a hora",
 *                              "hora_inicio": "00:10:10",
 *                              "hora_fim": "02:00:00",
 *                              "id_origem": 145,
 *                              "transcricao_ativar": 1,
 *                              "transcricao_tempo_extra_inicio": "00:05:00",
 *                              "transcricao_tempo_extra_fim": "00:05:00",
 *                              "transcricao_prioridade": "Normal",
 *                              "transcricao_dias": "1,2,3,4,5",
 *                              "id_emissora": 1
 *					        }
 *					    ]"
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *		 { 
 * 		    "qtde": 1,
 *		    "data": [
 *		       {
 *                    "id": 1,
 *                    "nome": "Programa a hora",
 *                    "hora_inicio": "00:10:10",
 *                    "hora_fim": "02:00:00",
 *                    "id_origem": 145,
 *                    "transcricao_ativar": 1,
 *                    "transcricao_tempo_extra_inicio": "00:05:00",
 *                    "transcricao_tempo_extra_fim": "00:05:00",
 *                    "transcricao_prioridade": "Normal",
 *                    "transcricao_dias": "1,2,3,4,5",
 *                    "id_emissora": 1
 *		        }
 *		    ]
 *		}
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

