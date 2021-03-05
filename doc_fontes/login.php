
/**
 * @api {post} /login/ Login
 * @apiGroup Login
 * @apiParam {text} email Login de acesso ao sistema
 * @apiParam {text} password Senha de acesso ao sistema
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *          "email": "login_no_sistema",
 *          "password": "minha_senha"
 *
 *    }
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "code": 1,
 *       "data":
 *        {
 *           "id": 1,
 *           "nome": "fulano",
 *           "email": "login_no_sistema",
 *           "token": "eyJ0..",
 *           "perfil_id": 1
 *        },
 *       "msg": "Sucesso!"
 *    }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200
 *     {
 *          "msg": "login ou senha nao encontrado",
 *          "code": 0,
 *    }
 *
 *
 *
 **/