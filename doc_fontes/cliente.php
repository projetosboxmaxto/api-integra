<?php


/**
 * @api {get} /clientes Lista Clientes
 * @apiGroup Clientes
 * @apiParamExample {json} Request-Example:
 * {
 *          "filtro": ""
 *
 * }
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *     [
 *		  { 
 *          "id": 1
 *          "nome": "Nome do Cliente",
 *          "id_origem": 1,
 *          "fantasia": "Nome fantasia"
 *          "cpf_cnpj": "CPF ou CNPJ",    
 *          "id_origem_pai": null,
            "tipo": "Cliente",
			"todos_programas": 1
 *        },
 *		  { 
 *          "id": 2
 *          "nome": "Nome do Sub-Cliente",
 *          "id_origem": 1,
 *          "fantasia": "Nome fantasia"
 *          "cpf_cnpj": "CPF ou CNPJ",    
 *          "id_origem_pai": 1,
            "tipo": "Sub-Cliente",
			"todos_programas": 0
 *        },
 *     ]   
 *    }
 *
 *
 *
 **/

/**
 * @api {get} /clientes/:id Show
 * @apiGroup Clientes
 * @apiParam {number} id Id de Origem do Cliente (ID do cliente no seu sistema)
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *      {
 *       "code": 1,
 *       "data":
 *        { 
 *          "id": 1
 *          "nome": "Nome do Cliente",
 *          "id_origem": 1,
 *          "fantasia": "Nome fantasia"
 *          "cpf_cnpj": "CPF ou CNPJ",    
 *          "id_origem_pai": null,
            "tipo": "Cliente",
			"todos_programas": 1
 *        }
 *    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400
 *     {
 *       "message": "cliente não encontrado"
 *     }
 *
 *
 *
 **/

/**
 * @api {post} /clientes/ Create
 * @apiGroup Clientes
 * @apiParam {text} nome Nome do Cliente
 * @apiParam {number} id_origem Id do Cliente no sistema de origem.
 * @apiParam {text} fantasia Nome fantasia do cliente
 * @apiParam {text} cpf_cnpj CPF / CNPJ do Cliente
 * @apiParam {text} tipo tipo: Cliente, Sub-Cliente, Setor
 * @apiParam {number} id_origem_pai id de origem do cliente pai, para o caso desse cliente estar ligado a outro cliente (ex: setor de um cliente)
 * @apiParam {number} todos_programas Flag todos os programas (0 ou 1 ) - O cliente , com esta flag ativada, terá suas palavras chaves pesquisadas em todos os programas. Sem esta flag, ele será pesquisado apenas nos programas associados e ele.
 *
 * @apiParamExample {json} Request-Example:
 *     {
  *         "id": 1
 *          "nome": "Nome do Cliente",
 *          "id_origem": 1,
 *          "fantasia": "Nome fantasia"
 *          "cpf_cnpj": "CPF ou CNPJ",    
 *          "id_origem_pai": null,
 *          "tipo": "Cliente",
 *			"todos_programas" : 1
 *
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
  *         "id": 1
 *          "nome": "Nome do Cliente",
 *          "id_origem": 1,
 *          "fantasia": "Nome fantasia"
 *          "cpf_cnpj": "CPF ou CNPJ",    
 *          "id_origem_pai": null,
            "tipo": "Cliente",
			"todos_programas": 1
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
 * @api {put} /clientes/:id Update
 * @apiGroup Clientes
 * @apiParam {number} id Id do Cliente no sistema de origem.
 *
 * @apiParamExample {json} Request-Example:
 *     {
  *         "id": 1
 *          "nome": "Nome do Cliente",
 *          "id_origem": 1,
 *          "fantasia": "Nome fantasia"
 *          "cpf_cnpj": "CPF ou CNPJ",    
 *          "id_origem_pai": null,
            "tipo": "Cliente",
			"todos_programas": 1
 *
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
  *         
  *         "id": 1
 *          "nome": "Nome do Cliente",
 *          "id_origem": 1,
 *          "fantasia": "Nome fantasia"
 *          "cpf_cnpj": "CPF ou CNPJ",    
 *          "id_origem_pai": null,
            "tipo": "Cliente",
			"todos_programas": 1
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
 * @api {delete} /clientes/:id Delete
 * @apiGroup Clientes
 * @apiParam {number} id Id de Origem do Cliente (ID do cliente no seu sistema)
 *
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
  *         "id": 1
 *          "nome": "Nome do Cliente",
 *          "id_origem": 1,
 *          "fantasia": "Nome fantasia"
 *          "cpf_cnpj": "CPF ou CNPJ",    
 *          "id_origem_pai": null,
            "tipo": "Cliente",
			"todos_programas": 1
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
 * @api {post} /clientes_bulk/ Save from JSON
 * @apiGroup Clientes
 * @apiParam {text} data Array de Clientes em formato JSON - Obs: enviar o dado como texto. Ex: [{"nome":"Novo Cliente","id_origem":1,"fantasia":"Novo Cliente Fantasia","cpf_cnpj":"0123456789","id_origem_pai":null,"tipo":"Cliente"}, "todos_programas" : 1 ]
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *        "data": "[{"nome":"Novo Cliente","id_origem":1,"fantasia":"Novo Cliente Fantasia","cpf_cnpj":"0123456789","id_origem_pai":null,"tipo":"Cliente"}, "todos_programas" : 1 ]"
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
  *         "id": 1
 *          "nome": "Nome do Cliente",
 *          "id_origem": 1,
 *          "fantasia": "Nome fantasia"
 *          "cpf_cnpj": "CPF ou CNPJ",    
 *          "id_origem_pai": null,
            "tipo": "Cliente",
			"todos_programas": 1
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
 * @api {post} /clientes/:id_cliente/topicos Save Tópicos
 * @apiGroup Clientes
 * @apiParam {number} id_cliente ID de Origem do Cliente
 * @apiParam {text} data Array de tópicos, em formato JSON, do cliente. Ex: [{"id":1,"nome":"secretaria de cultura"}, {"id":2,"nome":"ministério público"} ]
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *        "data": "[     {"id":1,"nome":"secretaria de cultura"},
                         {"id":2,"nome":"ministério público"}
                   ]"
          "id_cliente": 1
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *             {"qtde":2,
                          "data":[
                                   {"id":1,"nome":"secretaria de cultura"},
                                   {"id":2,"nome":"ministério público"}
                                 ]
                }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200
 *     {
 *          "msg": "erro, campo data vazio.",
 *          "code": 0,
 *    }
 *
 *
 *
 **/

/**
 * @api {post} /clientes/:id_cliente/programas Save Programas
 * @apiGroup Clientes
 * @apiParam {number} id_cliente ID de Origem do Cliente
 * @apiParam {text} ids_programa Ids (de origem) dos programas separados por vírgula
 * @apiParam {bit} deleta_outros 0 ou 1 - Opcional: se deseja remover todos os outros programas, indique 1 neste campo.
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *        "data": "100,101"
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *             {
 *                "data": [
*					        {
*					            "id": 1,
*					            "nome": "Programa novo",
*					            "id_origem": 100,
*					            "hora_inicio": "00:10:01",
*					            "hora_fim": "02:00:00",
*					            "transcricao_tempo_extra_inicio": "00:05:00",
*					            "transcricao_tempo_extra_fim": "00:05:00",
*					            "transcricao_prioridade": "Normal",
*					            "transcricao_dias": "1,2,3,4,5",
*					            "id_emissora": 1,
*					            "transcricao_ativar": 1
*					        },
*					         {
*					            "id": 2,
*					            "nome": "Programa 0002",
*					            "id_origem": 101,
*					            "hora_inicio": "00:10:01",
*					            "hora_fim": "02:00:00",
*					            "transcricao_tempo_extra_inicio": "00:05:00",
*					            "transcricao_tempo_extra_fim": "00:05:00",
*					            "transcricao_prioridade": "Normal",
*					            "transcricao_dias": "1,2,3,4,5",
*					            "id_emissora": 1,
*					            "transcricao_ativar": 1
*					        }
*
*					    ]
*    ],
*    "qtde_salvos": 2,
*    "qtde_total_programas": 5
*    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200
 *     {
 *          "msg": "erro, campo {campo} vazio.",
 *          "code": 0,
 *    }
 *
 *
 *
 **/


/**
 * @api {get} /clientes/:id/topicos Lista Tópicos
 * @apiGroup Clientes
 * @apiParam {number} id Id de Origem do Cliente (ID do cliente no seu sistema)
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *      {
 *          "data": [
 *			        {
 *			            "id": 2,
 *			            "id_origem": 2,
 *			            "nome": "Ministério Público"
 *			        },
 *			        {
 *			            "id": 1,
 *			            "id_origem": 1,
 *			            "nome": "Secretaria de cultura"
 *			        }
 *			    ],
 *		    "qtde": 2
 *    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400
 *     {
 *       "message": "cliente não encontrado"
 *     }
 *
 *
 *
 **/

/**
 * @api {get} /clientes/:id/programas Lista Programas
 * @apiGroup Clientes
 * @apiParam {number} id Id de Origem do Cliente (ID do cliente no seu sistema)
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *      {
 *          "data": [
 * 		          {
 * 		            "id": 1,
 * 		            "nome": "Programa novo",
 * 		            "id_origem": 100,
 * 		            "hora_inicio": "00:10:01",
 * 		            "hora_fim": "02:00:00",
 * 		            "transcricao_tempo_extra_inicio": "00:05:00",
 * 		            "transcricao_tempo_extra_fim": "00:05:00",
 * 		            "transcricao_prioridade": "Normal",
 * 		            "transcricao_dias": "1,2,3,4,5",
 * 		            "id_emissora": 1,
 * 		            "transcricao_ativar": 1
 * 		          }
 *			    ],
 *		    "qtde": 1
 *    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400
 *     {
 *       "message": "cliente não encontrado"
 *     }
 *
 *
 *
 **/

