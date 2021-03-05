
/**
 * @api {post} /emissoras/:id_emissora/apresentadores Save by Emissora
 * @apiGroup Apresentador
 * @apiParam {number} id_emissora ID de Origem da Emissora
 * @apiParam {text} data Array de apresentadores em formato JSON do cliente. Ex: [{"id_origem":1,"nome":"Carlos"}, {"id_origem":2,"nome":"Fulano"} ]
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *        "data": "[
 *                   {"id_origem":1,"nome":"Carlos"}, 
 *                   {"id_origem":2,"nome":"Fulano"} 
 *                   ]"
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *   {
 *                   "qtde": 2,
 *                   "data": [
*                               {
*							            "id": 1,
*							            "nome": "Carlos",
*							            "id_origem": 1
*							      },
*							      {
*							            "id": 2,
*							            "nome": "Fulano",
*							            "id_origem": 2
*							      }
 *                       
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
 * @api {get} /emissoras/:id_emissora/apresentadores Lista por Emissora
 * @apiGroup Apresentador
 * @apiParam {number} id Id de Origem da Emissora (ID da emissora no seu sistema)
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *      {
 *          "data": [
 *                {
 *					"id": 1,
 *					"nome": "Carlos",
 *					"id_origem": 1
 *				   },
 *				   {
 *					  "id": 2,
 *					  "nome": "Fulano",
 *					  "id_origem": 2
 *				   }
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
 * @api {post} /programas/:id_programa/apresentadores Save by Programa
 * @apiGroup Apresentador
 * @apiParam {number} id_programa ID de Origem do Programa
 * @apiParam {text} data Array de apresentadores em formato JSON do cliente. Ex: [{"id_origem":1,"nome":"Carlos"}, {"id_origem":2,"nome":"Fulano"} ]
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *        "data": "[
 *                   {"id_origem":1,"nome":"Carlos"}, 
 *                   {"id_origem":2,"nome":"Fulano"} 
 *                   ]"
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *             {
 *                   "qtde": 2,
 *                   "data": [
 *                               {
 *							            "id": 1,
 *							            "nome": "Carlos",
 *							            "id_origem": 1
 *							      },
 *							      {
 *							            "id": 2,
 *							            "nome": "Fulano",
 *							            "id_origem": 2
 *							      }
 *                       
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
 * @api {get} /programas/:id_emissora/apresentadores Lista por Programa
 * @apiGroup Apresentador
 * @apiParam {number} id Id de Origem do programa (ID do programa no seu sistema)
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