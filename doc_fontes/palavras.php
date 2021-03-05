<?php

/**
 * @api {post} /clientes/:id_cliente/dicionario Save by Cliente
 * @apiGroup Palavras Chave
 * @apiParam {number} id_cliente ID de Origem do Cliente
 * @apiParam {text} data Array de palavras, para pesquisa, em formato JSON do cliente. Ex: [{"id":1,"nome":"Polícia"}, {"id":2,"nome":"Carnaval"} ]
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *        "data": "[     {"id":1,"nome":"Polícia"},
                         {"id":2,"nome":"Carnaval"}
                   ]"
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *             {
 *                   "qtde": 2,
 *                   "data": [
 *                       {
 *                           "id": 1,
 *                           "nome": "Secretaria de cultura"
 *                       },
 *                       {
 *                           "id": 2,
 *                           "nome": "Ministério Público"
 *                       }
 *                   ]
 *               }
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
 * @api {get} /clientes/:id/dicionario Lista por Cliente
 * @apiGroup Palavras Chave
 * @apiParam {number} id Id de Origem do Cliente (ID do cliente no seu sistema)
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *      {
 *          "data": [
 *			                 {
 *						            "id": 5,
 *						            "id_origem": 2,
 *						            "nome": "Carnaval"
 *						        },
 *						        {
 *						            "id": 4,
 *						            "id_origem": 1,
 *						            "nome": "Polícia"
 *						        }
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