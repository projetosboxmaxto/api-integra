<?php


/**
 * @api {get} /emissoras Lista Emissoras
 * @apiGroup Emissoras
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
 * 		    "qtde": 1,
 *		    "data": [
 *		     {
 *		            "id": 1,
 *		            "nome": "TV Bahia",
 *		            "id_origem": 1,
 *		            "veiculo": "tv",
 *		            "id_praca": 1,
 *		            "habilita_stream": 1,
 *		            "uf": "BA",
 *		            "transcricao_url": "/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/",
 *		            "transcricao_url2": "/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/"
 *		     }
 *		   ]
 *    }
 *
 *
 *
 **/

/**
 * @api {get} /emissoras/:id Show
 * @apiGroup Emissoras
 * @apiParam {text} data Array de Emissora  em formato JSON - Obs: enviar o dado como texto
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *      {
 *       "code": 1,
 *       "data":
 *        {
 *		            "id": 1,
 *		            "nome": "TV Bahia",
 *		            "id_origem": 1,
 *		            "veiculo": "tv",
 *		            "id_praca": 1,
 *		            "habilita_stream": 1,
 *		            "uf": "BA",
 *		            "transcricao_url":  "/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/",
 *		            "transcricao_url2": ""
 *        }
 *    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400
 *     {
 *       "message": "emissora não encontrado"
 *     }
 *
 *
 *
 **/

/**
 * @api {post} /emissoras Create
 * @apiGroup Emissoras 
 * @apiParam {text} nome Nome da Emissora
 * @apiParam {number} id_origem Id da emissora no cadastro do cliente
 * @apiParam {text} veiculo Veículo (radio, tv)
 * @apiParam {number} id_praca Id da praça no cadastro do cliente
 * @apiParam {text} uf UF do estado (Ex: BA, SE, PA, SP  ) ou 00 para todos.
 * @apiParam {number} habilita_stream Habilita o stream para esta emissora ( 0 ou 1 ), 1 - Sim , 0 - Não
 * @apiParam {text} transcricao_url URL de transcricao
 * @apiParam {text} transcricao_url2 URL alternativa de transcricao
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *		            "nome": "TV Bahia",
 *		            "id_origem": 1,
 *		            "veiculo": "tv",
 *		            "id_praca": 1,
 *		            "habilita_stream": 1,
 *		            "uf": "BA",
 *		            "transcricao_url":  "/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/",
 *		            "transcricao_url2": ""
 *
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
 *		            "id": 1,
 *		            "nome": "TV Bahia",
 *		            "id_origem": 1,
 *		            "veiculo": "tv",
 *		            "id_praca": 1,
 *		            "habilita_stream": 1,
 *		            "uf": "BA",
 *		            "transcricao_url":  "/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/",
 *		            "transcricao_url2": ""
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
 * @api {put} /emissoras/:id Update
 * @apiGroup Emissoras
 * @apiParam {number} id id_origem -> Id da emissora  no cadastro do cliente
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *		            "id": 1,
 *		            "nome": "TV Bahia",
 *		            "id_origem": 1,
 *		            "veiculo": "tv",
 *		            "id_praca": 1,
 *		            "habilita_stream": 1,
 *		            "uf": "BA",
 *		            "transcricao_url":  "/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/",
 *		            "transcricao_url2": ""
 *
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
 *		            "id": 1,
 *		            "nome": "TV Bahia",
 *		            "id_origem": 1,
 *		            "veiculo": "tv",
 *		            "id_praca": 1,
 *		            "habilita_stream": 1,
 *		            "uf": "BA",
 *		            "transcricao_url":  "/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/",
 *		            "transcricao_url2": ""
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
 * @api {delete} /emissoras/:id Delete
 * @apiGroup Emissoras
 * @apiParam {number} id id_origem -> Id da emissora  no cadastro do cliente
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *		            "id": 1,
 *		            "nome": "TV Bahia",
 *		            "id_origem": 1,
 *		            "veiculo": "tv",
 *		            "id_praca": 1,
 *		            "habilita_stream": 1,
 *		            "uf": "BA",
 *		            "transcricao_url":  "/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/",
 *		            "transcricao_url2": ""
 *
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
 *		            "id": 1,
 *		            "nome": "TV Bahia",
 *		            "id_origem": 1,
 *		            "veiculo": "tv",
 *		            "id_praca": 1,
 *		            "habilita_stream": 1,
 *		            "uf": "BA",
 *		            "transcricao_url":  "/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/",
 *		            "transcricao_url2": ""
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
 * @api {post} /emissoras_bulk/ Save from JSON
 * @apiGroup Emissoras
 * @apiParam {text} data Array de Emissora  em formato JSON - Obs: enviar o dado como texto
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *        "data": "[
 *					        {
 *					            "nome": "TV Bahia",
 *					            "id_origem": 1,
 *					            "veiculo": "tv",
 *					            "id_praca": 1,
 *					            "habilita_stream": 1,
 *					            "uf": "BA",
                        *		            "transcricao_url":  "/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/",
                        *		            "transcricao_url2": ""
 *					        }
 *					    ]"
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *		 { 
 * 		    "qtde": 1,
 *		    "data": [
 *		        {
 *		            "id": 1,
 *		            "nome": "TV Bahia",
 *		            "id_origem": 1,
 *		            "veiculo": "tv",
 *		            "id_praca": 1,
 *		            "habilita_stream": 1,
 *		            "uf": "BA", *		      
 *		            "transcricao_url":  "/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/",
 *		            "transcricao_url2": ""
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
