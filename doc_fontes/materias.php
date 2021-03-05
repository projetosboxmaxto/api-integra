
/**
 * @api {get} /materias/ Listar
 * @apiGroup Matérias
 * @apiParam {text} data_inicio Data de início para pesquisar matéria. Formato yyyy-MM-dd HH:mm:ss Ex: 2020-01-20 10:00:00 (campo opcional)
 * @apiParam {text} data_fim Data Final para pesquisar matéria. Formato yyyy-MM-dd HH:mm:ss Ex: 2020-01-20 10:00:00 (campo opcional)
 * @apiParam {text} id_emissora ID de emissora (campo opcional)
 * @apiParam {text} id_cliente ID de cliente (campo opcional)
 * @apiParam {text} min_id mínima ID de matéria. Se informado, sistema só trará matérias com ID acima desta. (campo opcional)
 *
 *
 * @apiSuccessExample {json} Sucesso
 *    HTTP/1.1 200 OK
 *    {
 *       "qtde": 1, 
 *       "data":[
 *          "id": 3,
 *           "titulo": "mais uma matéria",
 *           "texto": "Testes",
 *            "data_insert_materia": "2020-02-24 14:27:06",
 *            "data_materia": "2019-10-16 00:02:49",
 *            "apresentador": "Moisés Bizesti",
 *            "id_programa": 100,
 *            "programa": "Programa novo",
 *            "hora_inicio": "00:02:49",
 *            "duracao": "00:00:20",
 *            "id_emissora": 1,
 *            "emissora": "TV Bahia",
 *            "clientes": [
 *                {
 *                    "cliente": "Novo Cliente",
 *                    "id_cliente": 1,
 *                    "impacto": "NEUTRO",
 *                    "id_impacto": 2,
 *                    "id_topico": 2,
 *                    "topico": "Ministério Público"
 *                }
 *            ],
 *            "arquivos": [
 *                {
 *                     "id": 2,
 *                     "nome": "3.1.20200224_1427.mp3",
 *                     "url": "http://localhost/midiaclip/arquivos/RTV/2020/2/2.1.20200224_1403.mp3"
 *                }
 *           ],
 *            "status": 0
 *      ]
 *     
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
