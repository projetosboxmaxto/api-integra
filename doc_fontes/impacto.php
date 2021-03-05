
/**
 * @api {post} /impacto_bulk/ Save from JSON
 * @apiGroup Impacto
 * @apiParam {text} data Array de dados em formato JSON - cada registro precisa ter id_origem e nome.
 *
 * @apiParamExample {json} Request-Example:
 *     {
  *         "data":"[{"id_origem":1,"nome":"POSITIVO"},{"id_origem":2,"nome":"NEUTRO"},{"id_origem":3,"nome":"NEGATIVO"}]"         
 *
 *     }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "qtde": 2, 
 *       "data":[
 *        {
 *          "id": 1
 *          "id_origem": 1
 *          "nome": "POSITIVO"
 *
 *        },
 *        {
 *          "id": 2
 *          "id_origem": 2
 *          "nome": "NEUTRO"
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
