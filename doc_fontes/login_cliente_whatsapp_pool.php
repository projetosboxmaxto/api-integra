<?php


/**
 * @api {get} /whatsapp_pool Lista
 * @apiGroup Whatsapp Pool 
 * @apiParamExample {json} Request-Example:
 * {
 *          "filtro": "",
 *          "id_origem": ""
 *
 * }
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *     [
 *	 { 
 *          "id": 1
 *          "id_origem": 1,
 *          "id_origem_contato": 1,
 *          "status": 1,
 *          "data_cadastro": "2020-03-16 00:00:00",
 *          "texto": "envio de mensagem. http://login_de_teste.com.br/teste",
 *          "contatos_envio": "10,12"
 *        }
 *     ]   
 *    }
 *
 *
 *
 **/

/**
 * @api {get} /whatsapp_pool/:id_origem Get One
 * @apiGroup Whatsapp Pool
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *      {
 *       "code": 1,
 *       "data":
 *	 { 
 *          "id": 1
 *          "id_origem": 1,
 *          "id_origem_contato": 1,
 *          "status": 1,
 *          "data_cadastro": "2020-03-16 00:00:00",
 *          "texto": "envio de mensagem. http://login_de_teste.com.br/teste"
 *        }
 *    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400
 *     {
 *       "message": "Não localizado"
 *     }
 *
 *
 *
 **/

/**
 * @api {post} /whatsapp_pool/ Create
 * @apiGroup Whatsapp Pool
 * @apiParam {text} texto Texto da mensagem
 * @apiParam {number} id_origem_contato Id do Contato
 * @apiParam {number} id_origem Id da mensagem que será enviada
 *
 * @apiParamExample {json} Request-Example:
 *	 { 
 *          "id_origem": 1,
 *          "id_origem_contato": 1,
 *          "texto": "envio de mensagem. http://login_de_teste.com.br/teste"
 *        }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
 *          "id": 1
 *          "id_origem": 1,
 *          "id_origem_contato": 1,
 *          "status": 1,
 *          "data_cadastro": "2020-03-16 00:00:00",
 *          "texto": "envio de mensagem. http://login_de_teste.com.br/teste"
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
 * @api {post} /whatsapp_pool/:id_origem Update
 * @apiGroup Whatsapp Pool
 * @apiParam {number} id_origem Id da mensagem que será enviada
 * @apiParam {text} texto Texto da mensagem
 * @apiParamExample {json} Request-Example:
 *     {
 *          "id_origem": 1,
 *          "id_origem_contato": 1,
 *          "texto": "envio de mensagem. http://login_de_teste.com.br/teste"
 *
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
 *          "id": 1
 *          "id_origem": 1,
 *          "id_origem_contato": 1,
 *          "status": 1,
 *          "data_cadastro": "2020-03-16 00:00:00",
 *          "texto": "envio de mensagem. http://login_de_teste.com.br/teste"
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
  * @api {delete} /whatsapp_pool/:id_origem Delete
 * @apiGroup Whatsapp Pool
 *
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
 *          "id": 1
 *          "id_origem": 1,
 *          "id_origem_contato": 1,
 *          "status": 1,
 *          "data_cadastro": "2020-03-16 00:00:00",
 *          "texto": "envio de mensagem. http://login_de_teste.com.br/teste"
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
 
 