<?php


/**
 * @api {get} /whatsapp_contatos Lista
 * @apiGroup Whatsapp_Contatos
 * @apiParamExample {json} Request-Example:
 * {
 *          "id_origem_cliente": "",
 *          "filtro": ""
 *
 * }
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *     [
 *	 { 
 *          "id": 1,
 *          "nome": "Fulano de Tal",
 *          "id_origem": 1,
 *          "robo": 1,
 *          "cliente_nome": "Nome do Cliente"
 *          "id_origem_cliente": 10
 *        }
 *     ]   
 *    }
 *
 *
 *
 **/

/**
 * @api {get} /whatsapp_contatos/:id_origem Get One
 * @apiGroup Whatsapp_Contatos
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *      {
 *       "code": 1,
 *       "data":
 *        {
 *          "id": 1,
 *          "nome": "Fulano de Tal",
 *          "id_origem": 1,
 *          "robo": 1,
 *          "cliente_nome": "Nome do Cliente"
 *          "id_origem_cliente": 10
 *        }
 *    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400
 *     {
 *       "message": "contato não localizado"
 *     }
 *
 *
 *
 **/

/**
 * @api {post} /whatsapp_contatos Create
 * @apiGroup Whatsapp_Contatos
 * @apiParam {text} nome Nome do contato (igual existente no smartphone)
 * @apiParam {number} id_origem_cliente Id do Cliente 
 * @apiParam {number} robo ID do Robo (se nao informado o padrao sera 1 )
 * @apiParam {number} id_origem Id do contato
 *
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *          "nome": "Fulano de Tal",
 *          "id_origem_cliente": 1,
 *          "robo": 1,
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
 *          "nome": "Fulano de Tal",
 *          "id_origem": 1,
 *          "robo": 1,
 *          "cliente_nome": "Nome do Cliente"
 *          "id_origem_cliente": 10
 *
 *        },
 *      "msg": "Sucesso!"
 *    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200
 *     {
 *          "msg": "erro",
 *          "code": 0
 *    }
 *
 *
 *
 **/

/**
 * @api {put} /whatsapp_contatos/:id_origem Update
 * @apiParam {number} id_origem Id do cadastro do contato
 * @apiGroup Whatsapp_Contatos
 * 
 * @apiParamExample {json} Request-Example:
 *     {
 *          "nome": "Fulano de Tal",
 *          "id_origem_cliente": 1,
 *          "robo": 1
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
 *          "nome": "Fulano de Tal",
 *          "id_origem": 1,
 *          "robo": 1,
 *          "cliente_nome": "Nome do Cliente"
 *          "id_origem_cliente": 10
 *
 *        },
 *      "msg": "Sucesso!"
 *    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200
 *     {
 *          "msg": "erro",
 *          "code": 0
 *    }
 *
 *
 **/
 
 /**
 * @api {delete} /whatsapp_contatos/:id_origem Delete
 * @apiGroup Whatsapp_Contatos

 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
 *          "id": 1,
 *          "nome": "Fulano de Tal",
 *          "id_origem": 1,
 *          "robo": 1,
 *          "cliente_nome": "Nome do Cliente"
 *          "id_origem_cliente": 10
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
 
 