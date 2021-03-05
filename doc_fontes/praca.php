
/**
 * @api {post} /praca_bulk/ Save from JSON
 * @apiGroup Praça
 * @apiParam {text} data Array de dados em formato JSON - cada registro precisa ter id_origem e nome.
 *
 * @apiParamExample {json} Request-Example:
 *     {
  *         "data":"[{"id_origem":1,"nome":"LOCAL"},{"id_origem":2,"nome":"NACIONAL"}]"         
 *
 *     }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "qtde": 1, 
 *       "data":[
 *        {
 *          "id": 1
 *          "id_origem": 1
 *          "nome": "LOCAL"
 *
 *        }
 ,        ]
 *      "msg": "Sucesso!"
 *    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200
 *     {
 *          "msg": "erro",
 *          "code": 0
 *     }
 *
 *
 *
 **/
