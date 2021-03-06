define({ "api": [
  {
    "type": "get",
    "url": "/emissoras/:id_emissora/apresentadores",
    "title": "Lista por Emissora",
    "group": "Apresentador",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de Origem da Emissora (ID da emissora no seu sistema)</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n     {\n         \"data\": [\n               {\n\t\t\t\t\t\"id\": 1,\n\t\t\t\t\t\"nome\": \"Carlos\",\n\t\t\t\t\t\"id_origem\": 1\n\t\t\t\t   },\n\t\t\t\t   {\n\t\t\t\t\t  \"id\": 2,\n\t\t\t\t\t  \"nome\": \"Fulano\",\n\t\t\t\t\t  \"id_origem\": 2\n\t\t\t\t   }\n\t\t\t    ],\n\t\t    \"qtde\": 2\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400\n{\n  \"message\": \"cliente não encontrado\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./apresentador.php",
    "groupTitle": "Apresentador",
    "name": "GetEmissorasId_emissoraApresentadores"
  },
  {
    "type": "get",
    "url": "/programas/:id_emissora/apresentadores",
    "title": "Lista por Programa",
    "group": "Apresentador",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de Origem do programa (ID do programa no seu sistema)</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n     {\n         \"data\": [\n\t\t\t                 {\n\t\t\t\t\t\t            \"id\": 5,\n\t\t\t\t\t\t            \"id_origem\": 2,\n\t\t\t\t\t\t            \"nome\": \"Carnaval\"\n\t\t\t\t\t\t        },\n\t\t\t\t\t\t        {\n\t\t\t\t\t\t            \"id\": 4,\n\t\t\t\t\t\t            \"id_origem\": 1,\n\t\t\t\t\t\t            \"nome\": \"Polícia\"\n\t\t\t\t\t\t        }\n\t\t\t    ],\n\t\t    \"qtde\": 2\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400\n{\n  \"message\": \"cliente não encontrado\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./apresentador.php",
    "groupTitle": "Apresentador",
    "name": "GetProgramasId_emissoraApresentadores"
  },
  {
    "type": "post",
    "url": "/emissoras/:id_emissora/apresentadores",
    "title": "Save by Emissora",
    "group": "Apresentador",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_emissora",
            "description": "<p>ID de Origem da Emissora</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data",
            "description": "<p>Array de apresentadores em formato JSON do cliente. Ex: [{&quot;id_origem&quot;:1,&quot;nome&quot;:&quot;Carlos&quot;}, {&quot;id_origem&quot;:2,&quot;nome&quot;:&quot;Fulano&quot;} ]</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " {\n    \"data\": \"[\n               {\"id_origem\":1,\"nome\":\"Carlos\"}, \n               {\"id_origem\":2,\"nome\":\"Fulano\"} \n               ]\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n  {\n                  \"qtde\": 2,\n                  \"data\": [\n                              {\n\t\t\t\t\t\t\t            \"id\": 1,\n\t\t\t\t\t\t\t            \"nome\": \"Carlos\",\n\t\t\t\t\t\t\t            \"id_origem\": 1\n\t\t\t\t\t\t\t      },\n\t\t\t\t\t\t\t      {\n\t\t\t\t\t\t\t            \"id\": 2,\n\t\t\t\t\t\t\t            \"nome\": \"Fulano\",\n\t\t\t\t\t\t\t            \"id_origem\": 2\n\t\t\t\t\t\t\t      }\n                      \n                  ]\n              }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./apresentador.php",
    "groupTitle": "Apresentador",
    "name": "PostEmissorasId_emissoraApresentadores"
  },
  {
    "type": "post",
    "url": "/programas/:id_programa/apresentadores",
    "title": "Save by Programa",
    "group": "Apresentador",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_programa",
            "description": "<p>ID de Origem do Programa</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data",
            "description": "<p>Array de apresentadores em formato JSON do cliente. Ex: [{&quot;id_origem&quot;:1,&quot;nome&quot;:&quot;Carlos&quot;}, {&quot;id_origem&quot;:2,&quot;nome&quot;:&quot;Fulano&quot;} ]</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " {\n    \"data\": \"[\n               {\"id_origem\":1,\"nome\":\"Carlos\"}, \n               {\"id_origem\":2,\"nome\":\"Fulano\"} \n               ]\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n            {\n                  \"qtde\": 2,\n                  \"data\": [\n                              {\n\t\t\t\t\t\t\t            \"id\": 1,\n\t\t\t\t\t\t\t            \"nome\": \"Carlos\",\n\t\t\t\t\t\t\t            \"id_origem\": 1\n\t\t\t\t\t\t\t      },\n\t\t\t\t\t\t\t      {\n\t\t\t\t\t\t\t            \"id\": 2,\n\t\t\t\t\t\t\t            \"nome\": \"Fulano\",\n\t\t\t\t\t\t\t            \"id_origem\": 2\n\t\t\t\t\t\t\t      }\n                      \n                  ]\n              }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./apresentador.php",
    "groupTitle": "Apresentador",
    "name": "PostProgramasId_programaApresentadores"
  },
  {
    "type": "get",
    "url": "/arquivos_transcritos",
    "title": "Listar",
    "group": "Arquivos_Transcritos",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "filtro",
            "description": "<p>por texto existente na transcrição.</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data_inicio",
            "description": "<p>Data de início, formato YYYY-MM-DD ex: 2020-02-20</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data_fim",
            "description": "<p>Data de início, formato YYYY-MM-DD ex: 2020-02-20</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_programa",
            "description": "<p>ID do programa (no cadastro do cliente)</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_emissora",
            "description": "<p>ID da emissora (no cadastro do cliente)</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "com_busca_salva",
            "description": "<p>Arquivos que já tiveram buscas ou não. 0 - Não fez busca, 1 - Fez buscas. Vazio ou Nulo =&gt;Tudo</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "min_id",
            "description": "<p>menor id do arquivo. Se informado a lista só trará arquivos com id acima do informado neste campo.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n         \"filtro\": \"\",\n         \"data_inicio\": \"\",\n         \"data_fim\": \"\",\n         \"id_programa\": \"\",\n         \"id_emissora\": \"\",\n         \"com_busca_salva\": \"\"\n\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n       \"qtde\": 2,\n       \"data\": [\n        {\n            \"id\": 12,\n            \"path\": \"eventos/20191016/2/43-metropolefm_2019-10-16_06-51-20.mp3\",\n            \"url\": \"eventos/20191016/2/43-metropolefm_2019-10-16_06-51-20.mp3\",\n            \"data\": \"2019-10-16 00:00:00\",\n            \"nome\": \"43-metropolefm_2019-10-16_06-51-20.mp3\",\n            \"hora_inicio\": \"06:50:03\",\n            \"texto\": \"reforma administrativa elinaldo ele fez com que desaparecessem retirou das das secretarias a secretaria de turismo depois harry fez a reforma administrativa fez uma segunda reforma administrativa e colocou a secretaria de turismo que está totalmente ineficiente pagando uma fortuna por mês de aluguel de uma casa lá botou um vereador sem perfil para o turismo lá em camaçari e nós temos hoje um problema seríssimo na orla que é a falta de estrutura a falta de desenvolvimento do turismo não se reforma administrativa ele criou cargos cargos novos cargos é porque os cargos mais importantes da a que sou secretários depois ver as coordenações das assessorias ele iniciou com gente de fora né trouxe de césar para feira de santana trouxe de salvador trouxe\",\n            \"json\": \"[{\\\"final_result\\\": true, \\\"result_status\\\": \\\"RECOGNIZED\\\", \\\"start_time\\\": 0.0, \\\"alternatives\\\": [{\\\"text\\\": \\\"reforma administrativa elinaldo ele fez com...\",\n            \"id_evento\": 1,\n            \"com_busca_salva\": 0,\n            \"status\": 1,\n            \"id_programa\": 100,\n            \"id_emissora\": 1,\n            \"nome_programa\": \"Programa novo\",\n            \"nome_emissora\": \"TV Bahia\"\n        },\n        {\n            \"id\": 13,\n            \"path\": \"eventos/20191016/2/43-metropolefm_2019-10-16_06-56-20.mp3\",\n            \"url\": \"eventos/20191016/2/43-metropolefm_2019-10-16_06-56-20.mp3\",\n            \"data\": \"2019-10-16 00:00:00\",\n            \"nome\": \"43-metropolefm_2019-10-16_06-56-20.mp3\",\n            \"hora_inicio\": \"06:55:03\",\n            \"texto\": \"reforma administrativa elinaldo ele fez com que desaparecessem retirou das das secretarias a secretaria de turismo depois harry fez a reforma administrativa fez uma segunda reforma administrativa e colocou a secretaria de turismo que está totalmente ineficiente pagando uma fortuna por mês de aluguel de uma casa lá botou um vereador sem perfil para o turismo lá em camaçari e nós temos hoje um problema seríssimo na orla que é a falta de estrutura a falta de desenvolvimento do turismo não se reforma administrativa ele criou cargos cargos novos cargos é porque os cargos mais importantes da a que sou secretários depois ver as coordenações das assessorias ele iniciou com gente de fora né trouxe de césar para feira de santana trouxe de salvador trouxe\",\n            \"json\": \"[{\\\"final_result\\\": true, \\\"result_status\\\": \\\"RECOGNIZED\\\", \\\"start_time\\\": 0.0, \\\"alternatives\\\": [{\\\"text\\\": \\\"reforma administrativa elinaldo ele fez com...\",\n            \"id_evento\": 1,\n            \"com_busca_salva\": 0,\n            \"status\": 1,\n            \"id_programa\": 100,\n            \"id_emissora\": 1,\n            \"nome_programa\": \"Programa novo\",\n            \"nome_emissora\": \"TV Bahia\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./eventos_arquivos.php",
    "groupTitle": "Arquivos_Transcritos",
    "name": "GetArquivos_transcritos"
  },
  {
    "type": "post",
    "url": "/arquivos_transcritos/palavras",
    "title": "Salvar Busca Realizada",
    "group": "Arquivos_Transcritos",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "palavra",
            "description": "<p>Palavra Chave</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "tempo",
            "description": "<p>Tempo (HH:MM:SS) em que esta palavra foi localizada na legenda, Ex: 00:20:01</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_arquivo",
            "description": "<p>Id do arquivo</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_cliente",
            "description": "<p>Id do cliente</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "cita_diretamente",
            "description": "<p>0 ou 1 - Caso cite diretamente o nome do cliente</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_dicionario",
            "description": "<p>Id da palavra cadastrada (opcional)</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "sentimento",
            "description": "<p>Sentimento sobre o termo localizado.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " {\n      \"id_arquivo\": 1,\n      \"id_cliente\": 1,\n      \"cita_diretamente\": 1,\n      \"palavra\": \"Salvador\",\n      \"tempo\": \"00:01:00\",\n      \"id_dicionario\": 1,\n      \"sentimento\": \"neutro\",\n      \"trecho\": \"cidade Salvador enfrenta problemas\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n      \"code\": 1,\n      \"data\":\n          {\n\t\t        \"id\": 14,\n\t\t        \"data\": \"2019-10-16 00:00:00\",\n\t\t        \"id_evento\": 1,\n\t\t        \"id_evento_arquivo\": 1,\n\t\t        \"id_cliente\": 1,\n\t\t        \"cita_diretamente\": 1,\n\t\t        \"palavra\": \"metro\",\n\t\t        \"tempo\": \"00:00:39\",\n\t\t        \"tempo_seg\": 39,\n\t\t        \"id_dicionario_tag\": null,\n\t\t        \"status\": 1,\n\t\t        \"operador\": null,\n\t\t        \"id_operador\": null,\n\t\t        \"trecho\": \"cidade Salvador enfrenta problemas\",\n\t\t        \"id_notificacao_agrupamento\": null,\n\t\t        \"indexed\": null,\n\t\t        \"sentimento\": \"neutro\"\n          },\n     \"msg\": \"Sucesso!\"\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./eventos_arquivos.php",
    "groupTitle": "Arquivos_Transcritos",
    "name": "PostArquivos_transcritosPalavras"
  },
  {
    "type": "post",
    "url": "/arquivos_transcritos/palavras_bulk",
    "title": "Salvar Busca por JSON",
    "group": "Arquivos_Transcritos",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data",
            "description": "<p>Json (em formato de texto) com várias buscas a serem salvas. Veja no exemplo abaixo o modelo.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n      \"data\":\n          [\n                 {\n                   \"id_arquivo\":1, \n                  \"id_cliente\":1,\n                   \"cita_diretamente\":1,\n                   \"palavra\":\"Salvador\",\n                   \"tempo\":\"00:01:00\",\n                   \"id_dicionario\":1,\n                   \"sentimento\":\"neutro\"\n                   }\n          ]\n   }",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n\t\t    \"qtde_salvo\": 1,\n\t\t    \"success\": true\n\t  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./eventos_arquivos.php",
    "groupTitle": "Arquivos_Transcritos",
    "name": "PostArquivos_transcritosPalavras_bulk"
  },
  {
    "type": "delete",
    "url": "/clientes/:id",
    "title": "Delete",
    "group": "Clientes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de Origem do Cliente (ID do cliente no seu sistema)</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n      \"code\": 1,\n      \"data\":\n       {\n        \"id\": 1\n         \"nome\": \"Nome do Cliente\",\n         \"id_origem\": 1,\n         \"fantasia\": \"Nome fantasia\"\n         \"cpf_cnpj\": \"CPF ou CNPJ\",    \n         \"id_origem_pai\": null,\n            \"tipo\": \"Cliente\",\n\t\t\t\"todos_programas\": 1\n\n       },\n     \"msg\": \"Sucesso!\"\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 200\n{\n     \"msg\": \"erro\",\n     \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./cliente.php",
    "groupTitle": "Clientes",
    "name": "DeleteClientesId"
  },
  {
    "type": "get",
    "url": "/clientes",
    "title": "Lista Clientes",
    "group": "Clientes",
    "parameter": {
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n         \"filtro\": \"\"\n\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n    [\n\t\t  { \n         \"id\": 1\n         \"nome\": \"Nome do Cliente\",\n         \"id_origem\": 1,\n         \"fantasia\": \"Nome fantasia\"\n         \"cpf_cnpj\": \"CPF ou CNPJ\",    \n         \"id_origem_pai\": null,\n            \"tipo\": \"Cliente\",\n\t\t\t\"todos_programas\": 1\n       },\n\t\t  { \n         \"id\": 2\n         \"nome\": \"Nome do Sub-Cliente\",\n         \"id_origem\": 1,\n         \"fantasia\": \"Nome fantasia\"\n         \"cpf_cnpj\": \"CPF ou CNPJ\",    \n         \"id_origem_pai\": 1,\n            \"tipo\": \"Sub-Cliente\",\n\t\t\t\"todos_programas\": 0\n       },\n    ]   \n   }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./cliente.php",
    "groupTitle": "Clientes",
    "name": "GetClientes"
  },
  {
    "type": "get",
    "url": "/clientes/:id",
    "title": "Show",
    "group": "Clientes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de Origem do Cliente (ID do cliente no seu sistema)</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n     {\n      \"code\": 1,\n      \"data\":\n       { \n         \"id\": 1\n         \"nome\": \"Nome do Cliente\",\n         \"id_origem\": 1,\n         \"fantasia\": \"Nome fantasia\"\n         \"cpf_cnpj\": \"CPF ou CNPJ\",    \n         \"id_origem_pai\": null,\n            \"tipo\": \"Cliente\",\n\t\t\t\"todos_programas\": 1\n       }\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400\n{\n  \"message\": \"cliente não encontrado\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./cliente.php",
    "groupTitle": "Clientes",
    "name": "GetClientesId"
  },
  {
    "type": "get",
    "url": "/clientes/:id/programas",
    "title": "Lista Programas",
    "group": "Clientes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de Origem do Cliente (ID do cliente no seu sistema)</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n     {\n         \"data\": [\n\t\t          {\n\t\t            \"id\": 1,\n\t\t            \"nome\": \"Programa novo\",\n\t\t            \"id_origem\": 100,\n\t\t            \"hora_inicio\": \"00:10:01\",\n\t\t            \"hora_fim\": \"02:00:00\",\n\t\t            \"transcricao_tempo_extra_inicio\": \"00:05:00\",\n\t\t            \"transcricao_tempo_extra_fim\": \"00:05:00\",\n\t\t            \"transcricao_prioridade\": \"Normal\",\n\t\t            \"transcricao_dias\": \"1,2,3,4,5\",\n\t\t            \"id_emissora\": 1,\n\t\t            \"transcricao_ativar\": 1\n\t\t          }\n\t\t\t    ],\n\t\t    \"qtde\": 1\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400\n{\n  \"message\": \"cliente não encontrado\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./cliente.php",
    "groupTitle": "Clientes",
    "name": "GetClientesIdProgramas"
  },
  {
    "type": "get",
    "url": "/clientes/:id/topicos",
    "title": "Lista Tópicos",
    "group": "Clientes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de Origem do Cliente (ID do cliente no seu sistema)</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n     {\n         \"data\": [\n\t\t\t        {\n\t\t\t            \"id\": 2,\n\t\t\t            \"id_origem\": 2,\n\t\t\t            \"nome\": \"Ministério Público\"\n\t\t\t        },\n\t\t\t        {\n\t\t\t            \"id\": 1,\n\t\t\t            \"id_origem\": 1,\n\t\t\t            \"nome\": \"Secretaria de cultura\"\n\t\t\t        }\n\t\t\t    ],\n\t\t    \"qtde\": 2\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400\n{\n  \"message\": \"cliente não encontrado\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./cliente.php",
    "groupTitle": "Clientes",
    "name": "GetClientesIdTopicos"
  },
  {
    "type": "post",
    "url": "/clientes/",
    "title": "Create",
    "group": "Clientes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "nome",
            "description": "<p>Nome do Cliente</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_origem",
            "description": "<p>Id do Cliente no sistema de origem.</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "fantasia",
            "description": "<p>Nome fantasia do cliente</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "cpf_cnpj",
            "description": "<p>CPF / CNPJ do Cliente</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "tipo",
            "description": "<p>tipo: Cliente, Sub-Cliente, Setor</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_origem_pai",
            "description": "<p>id de origem do cliente pai, para o caso desse cliente estar ligado a outro cliente (ex: setor de um cliente)</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "todos_programas",
            "description": "<p>Flag todos os programas (0 ou 1 ) - O cliente , com esta flag ativada, terá suas palavras chaves pesquisadas em todos os programas. Sem esta flag, ele será pesquisado apenas nos programas associados e ele.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "    {\n        \"id\": 1\n         \"nome\": \"Nome do Cliente\",\n         \"id_origem\": 1,\n         \"fantasia\": \"Nome fantasia\"\n         \"cpf_cnpj\": \"CPF ou CNPJ\",    \n         \"id_origem_pai\": null,\n         \"tipo\": \"Cliente\",\n\t\t\t\"todos_programas\" : 1\n\n   }",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n      \"code\": 1,\n      \"data\":\n       {\n        \"id\": 1\n         \"nome\": \"Nome do Cliente\",\n         \"id_origem\": 1,\n         \"fantasia\": \"Nome fantasia\"\n         \"cpf_cnpj\": \"CPF ou CNPJ\",    \n         \"id_origem_pai\": null,\n            \"tipo\": \"Cliente\",\n\t\t\t\"todos_programas\": 1\n\n       },\n     \"msg\": \"Sucesso!\"\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./cliente.php",
    "groupTitle": "Clientes",
    "name": "PostClientes"
  },
  {
    "type": "post",
    "url": "/clientes/:id_cliente/programas",
    "title": "Save Programas",
    "group": "Clientes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_cliente",
            "description": "<p>ID de Origem do Cliente</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "ids_programa",
            "description": "<p>Ids (de origem) dos programas separados por vírgula</p>"
          },
          {
            "group": "Parameter",
            "type": "bit",
            "optional": false,
            "field": "deleta_outros",
            "description": "<p>0 ou 1 - Opcional: se deseja remover todos os outros programas, indique 1 neste campo.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " {\n    \"data\": \"100,101\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n            {\n               \"data\": [\n\t\t\t\t\t        {\n\t\t\t\t\t            \"id\": 1,\n\t\t\t\t\t            \"nome\": \"Programa novo\",\n\t\t\t\t\t            \"id_origem\": 100,\n\t\t\t\t\t            \"hora_inicio\": \"00:10:01\",\n\t\t\t\t\t            \"hora_fim\": \"02:00:00\",\n\t\t\t\t\t            \"transcricao_tempo_extra_inicio\": \"00:05:00\",\n\t\t\t\t\t            \"transcricao_tempo_extra_fim\": \"00:05:00\",\n\t\t\t\t\t            \"transcricao_prioridade\": \"Normal\",\n\t\t\t\t\t            \"transcricao_dias\": \"1,2,3,4,5\",\n\t\t\t\t\t            \"id_emissora\": 1,\n\t\t\t\t\t            \"transcricao_ativar\": 1\n\t\t\t\t\t        },\n\t\t\t\t\t         {\n\t\t\t\t\t            \"id\": 2,\n\t\t\t\t\t            \"nome\": \"Programa 0002\",\n\t\t\t\t\t            \"id_origem\": 101,\n\t\t\t\t\t            \"hora_inicio\": \"00:10:01\",\n\t\t\t\t\t            \"hora_fim\": \"02:00:00\",\n\t\t\t\t\t            \"transcricao_tempo_extra_inicio\": \"00:05:00\",\n\t\t\t\t\t            \"transcricao_tempo_extra_fim\": \"00:05:00\",\n\t\t\t\t\t            \"transcricao_prioridade\": \"Normal\",\n\t\t\t\t\t            \"transcricao_dias\": \"1,2,3,4,5\",\n\t\t\t\t\t            \"id_emissora\": 1,\n\t\t\t\t\t            \"transcricao_ativar\": 1\n\t\t\t\t\t        }\n\n\t\t\t\t\t    ]\n   ],\n   \"qtde_salvos\": 2,\n   \"qtde_total_programas\": 5\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro, campo {campo} vazio.\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./cliente.php",
    "groupTitle": "Clientes",
    "name": "PostClientesId_clienteProgramas"
  },
  {
    "type": "post",
    "url": "/clientes/:id_cliente/topicos",
    "title": "Save Tópicos",
    "group": "Clientes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_cliente",
            "description": "<p>ID de Origem do Cliente</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data",
            "description": "<p>Array de tópicos, em formato JSON, do cliente. Ex: [{&quot;id&quot;:1,&quot;nome&quot;:&quot;secretaria de cultura&quot;}, {&quot;id&quot;:2,&quot;nome&quot;:&quot;ministério público&quot;} ]</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " {\n    \"data\": \"[     {\"id\":1,\"nome\":\"secretaria de cultura\"},\n                      {\"id\":2,\"nome\":\"ministério público\"}\n                ]\"\n       \"id_cliente\": 1\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n         {\"qtde\":2,\n                       \"data\":[\n                                {\"id\":1,\"nome\":\"secretaria de cultura\"},\n                                {\"id\":2,\"nome\":\"ministério público\"}\n                              ]\n             }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro, campo data vazio.\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./cliente.php",
    "groupTitle": "Clientes",
    "name": "PostClientesId_clienteTopicos"
  },
  {
    "type": "post",
    "url": "/clientes_bulk/",
    "title": "Save from JSON",
    "group": "Clientes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data",
            "description": "<p>Array de Clientes em formato JSON - Obs: enviar o dado como texto. Ex: [{&quot;nome&quot;:&quot;Novo Cliente&quot;,&quot;id_origem&quot;:1,&quot;fantasia&quot;:&quot;Novo Cliente Fantasia&quot;,&quot;cpf_cnpj&quot;:&quot;0123456789&quot;,&quot;id_origem_pai&quot;:null,&quot;tipo&quot;:&quot;Cliente&quot;}, &quot;todos_programas&quot; : 1 ]</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " {\n    \"data\": \"[{\"nome\":\"Novo Cliente\",\"id_origem\":1,\"fantasia\":\"Novo Cliente Fantasia\",\"cpf_cnpj\":\"0123456789\",\"id_origem_pai\":null,\"tipo\":\"Cliente\"}, \"todos_programas\" : 1 ]\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n      \"code\": 1,\n      \"data\":\n       {\n        \"id\": 1\n         \"nome\": \"Nome do Cliente\",\n         \"id_origem\": 1,\n         \"fantasia\": \"Nome fantasia\"\n         \"cpf_cnpj\": \"CPF ou CNPJ\",    \n         \"id_origem_pai\": null,\n            \"tipo\": \"Cliente\",\n\t\t\t\"todos_programas\": 1\n\n       },\n     \"msg\": \"Sucesso!\"\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./cliente.php",
    "groupTitle": "Clientes",
    "name": "PostClientes_bulk"
  },
  {
    "type": "put",
    "url": "/clientes/:id",
    "title": "Update",
    "group": "Clientes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>Id do Cliente no sistema de origem.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "    {\n        \"id\": 1\n         \"nome\": \"Nome do Cliente\",\n         \"id_origem\": 1,\n         \"fantasia\": \"Nome fantasia\"\n         \"cpf_cnpj\": \"CPF ou CNPJ\",    \n         \"id_origem_pai\": null,\n            \"tipo\": \"Cliente\",\n\t\t\t\"todos_programas\": 1\n\n   }",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n      \"code\": 1,\n      \"data\":\n       {\n        \n        \"id\": 1\n         \"nome\": \"Nome do Cliente\",\n         \"id_origem\": 1,\n         \"fantasia\": \"Nome fantasia\"\n         \"cpf_cnpj\": \"CPF ou CNPJ\",    \n         \"id_origem_pai\": null,\n            \"tipo\": \"Cliente\",\n\t\t\t\"todos_programas\": 1\n\n       },\n     \"msg\": \"Sucesso!\"\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./cliente.php",
    "groupTitle": "Clientes",
    "name": "PutClientesId"
  },
  {
    "type": "delete",
    "url": "/emissoras/:id",
    "title": "Delete",
    "group": "Emissoras",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>id_origem -&gt; Id da emissora  no cadastro do cliente</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "    {\n\t\t            \"id\": 1,\n\t\t            \"nome\": \"TV Bahia\",\n\t\t            \"id_origem\": 1,\n\t\t            \"veiculo\": \"tv\",\n\t\t            \"id_praca\": 1,\n\t\t            \"habilita_stream\": 1,\n\t\t            \"uf\": \"BA\",\n\t\t            \"transcricao_url\":  \"/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/\",\n\t\t            \"transcricao_url2\": \"\"\n\n   }",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n      \"code\": 1,\n      \"data\":\n       {\n\t\t            \"id\": 1,\n\t\t            \"nome\": \"TV Bahia\",\n\t\t            \"id_origem\": 1,\n\t\t            \"veiculo\": \"tv\",\n\t\t            \"id_praca\": 1,\n\t\t            \"habilita_stream\": 1,\n\t\t            \"uf\": \"BA\",\n\t\t            \"transcricao_url\":  \"/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/\",\n\t\t            \"transcricao_url2\": \"\"\n\n       },\n     \"msg\": \"Sucesso!\"\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 200\n{\n     \"msg\": \"erro\",\n     \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./emissora.php",
    "groupTitle": "Emissoras",
    "name": "DeleteEmissorasId"
  },
  {
    "type": "get",
    "url": "/emissoras",
    "title": "Lista Emissoras",
    "group": "Emissoras",
    "parameter": {
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n         \"filtro\": \"\",\n         \"order\": \"nome\",\n         \"order_type\": \"asc\"\n\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n\t\t    \"qtde\": 1,\n\t\t    \"data\": [\n\t\t     {\n\t\t            \"id\": 1,\n\t\t            \"nome\": \"TV Bahia\",\n\t\t            \"id_origem\": 1,\n\t\t            \"veiculo\": \"tv\",\n\t\t            \"id_praca\": 1,\n\t\t            \"habilita_stream\": 1,\n\t\t            \"uf\": \"BA\",\n\t\t            \"transcricao_url\": \"/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/\",\n\t\t            \"transcricao_url2\": \"/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/\"\n\t\t     }\n\t\t   ]\n   }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./emissora.php",
    "groupTitle": "Emissoras",
    "name": "GetEmissoras"
  },
  {
    "type": "get",
    "url": "/emissoras/:id",
    "title": "Show",
    "group": "Emissoras",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data",
            "description": "<p>Array de Emissora  em formato JSON - Obs: enviar o dado como texto</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n     {\n      \"code\": 1,\n      \"data\":\n       {\n\t\t            \"id\": 1,\n\t\t            \"nome\": \"TV Bahia\",\n\t\t            \"id_origem\": 1,\n\t\t            \"veiculo\": \"tv\",\n\t\t            \"id_praca\": 1,\n\t\t            \"habilita_stream\": 1,\n\t\t            \"uf\": \"BA\",\n\t\t            \"transcricao_url\":  \"/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/\",\n\t\t            \"transcricao_url2\": \"\"\n       }\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400\n{\n  \"message\": \"emissora não encontrado\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./emissora.php",
    "groupTitle": "Emissoras",
    "name": "GetEmissorasId"
  },
  {
    "type": "post",
    "url": "/emissoras",
    "title": "Create",
    "group": "Emissoras",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "nome",
            "description": "<p>Nome da Emissora</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_origem",
            "description": "<p>Id da emissora no cadastro do cliente</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "veiculo",
            "description": "<p>Veículo (radio, tv)</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_praca",
            "description": "<p>Id da praça no cadastro do cliente</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "uf",
            "description": "<p>UF do estado (Ex: BA, SE, PA, SP  ) ou 00 para todos.</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "habilita_stream",
            "description": "<p>Habilita o stream para esta emissora ( 0 ou 1 ), 1 - Sim , 0 - Não</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "transcricao_url",
            "description": "<p>URL de transcricao</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "transcricao_url2",
            "description": "<p>URL alternativa de transcricao</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "    {\n\t\t            \"nome\": \"TV Bahia\",\n\t\t            \"id_origem\": 1,\n\t\t            \"veiculo\": \"tv\",\n\t\t            \"id_praca\": 1,\n\t\t            \"habilita_stream\": 1,\n\t\t            \"uf\": \"BA\",\n\t\t            \"transcricao_url\":  \"/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/\",\n\t\t            \"transcricao_url2\": \"\"\n\n   }",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n      \"code\": 1,\n      \"data\":\n       {\n\t\t            \"id\": 1,\n\t\t            \"nome\": \"TV Bahia\",\n\t\t            \"id_origem\": 1,\n\t\t            \"veiculo\": \"tv\",\n\t\t            \"id_praca\": 1,\n\t\t            \"habilita_stream\": 1,\n\t\t            \"uf\": \"BA\",\n\t\t            \"transcricao_url\":  \"/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/\",\n\t\t            \"transcricao_url2\": \"\"\n\n       },\n     \"msg\": \"Sucesso!\"\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./emissora.php",
    "groupTitle": "Emissoras",
    "name": "PostEmissoras"
  },
  {
    "type": "post",
    "url": "/emissoras_bulk/",
    "title": "Save from JSON",
    "group": "Emissoras",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data",
            "description": "<p>Array de Emissora  em formato JSON - Obs: enviar o dado como texto</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "    {\n       \"data\": \"[\n\t\t\t\t\t        {\n\t\t\t\t\t            \"nome\": \"TV Bahia\",\n\t\t\t\t\t            \"id_origem\": 1,\n\t\t\t\t\t            \"veiculo\": \"tv\",\n\t\t\t\t\t            \"id_praca\": 1,\n\t\t\t\t\t            \"habilita_stream\": 1,\n\t\t\t\t\t            \"uf\": \"BA\",\n\t\t            \"transcricao_url\":  \"/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/\",\n\t\t            \"transcricao_url2\": \"\"\n\t\t\t\t\t        }\n\t\t\t\t\t    ]\"\n   }",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n\t\t { \n\t\t    \"qtde\": 1,\n\t\t    \"data\": [\n\t\t        {\n\t\t            \"id\": 1,\n\t\t            \"nome\": \"TV Bahia\",\n\t\t            \"id_origem\": 1,\n\t\t            \"veiculo\": \"tv\",\n\t\t            \"id_praca\": 1,\n\t\t            \"habilita_stream\": 1,\n\t\t            \"uf\": \"BA\", *\t\t      \n\t\t            \"transcricao_url\":  \"/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/\",\n\t\t            \"transcricao_url2\": \"\"\n\t\t        }\n\t\t    ]\n\t\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./emissora.php",
    "groupTitle": "Emissoras",
    "name": "PostEmissoras_bulk"
  },
  {
    "type": "put",
    "url": "/emissoras/:id",
    "title": "Update",
    "group": "Emissoras",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>id_origem -&gt; Id da emissora  no cadastro do cliente</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "    {\n\t\t            \"id\": 1,\n\t\t            \"nome\": \"TV Bahia\",\n\t\t            \"id_origem\": 1,\n\t\t            \"veiculo\": \"tv\",\n\t\t            \"id_praca\": 1,\n\t\t            \"habilita_stream\": 1,\n\t\t            \"uf\": \"BA\",\n\t\t            \"transcricao_url\":  \"/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/\",\n\t\t            \"transcricao_url2\": \"\"\n\n   }",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n      \"code\": 1,\n      \"data\":\n       {\n\t\t            \"id\": 1,\n\t\t            \"nome\": \"TV Bahia\",\n\t\t            \"id_origem\": 1,\n\t\t            \"veiculo\": \"tv\",\n\t\t            \"id_praca\": 1,\n\t\t            \"habilita_stream\": 1,\n\t\t            \"uf\": \"BA\",\n\t\t            \"transcricao_url\":  \"/mnt/rtv-servers/mdcrd03/radios/internet/salvador/metropolefm/\",\n\t\t            \"transcricao_url2\": \"\"\n\n       },\n     \"msg\": \"Sucesso!\"\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./emissora.php",
    "groupTitle": "Emissoras",
    "name": "PutEmissorasId"
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./doc/main.js",
    "group": "F:\\OpenServers\\apache_php5\\www\\midiaclip\\doc_integrador\\doc\\main.js",
    "groupTitle": "F:\\OpenServers\\apache_php5\\www\\midiaclip\\doc_integrador\\doc\\main.js",
    "name": ""
  },
  {
    "type": "post",
    "url": "/impacto_bulk/",
    "title": "Save from JSON",
    "group": "Impacto",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data",
            "description": "<p>Array de dados em formato JSON - cada registro precisa ter id_origem e nome.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"data\":\"[{\"id_origem\":1,\"nome\":\"POSITIVO\"},{\"id_origem\":2,\"nome\":\"NEUTRO\"},{\"id_origem\":3,\"nome\":\"NEGATIVO\"}]\"         \n\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "  HTTP/1.1 200 OK\n  {\n     \"qtde\": 2, \n     \"data\":[\n      {\n        \"id\": 1\n        \"id_origem\": 1\n        \"nome\": \"POSITIVO\"\n\n      },\n      {\n        \"id\": 2\n        \"id_origem\": 2\n        \"nome\": \"NEUTRO\"\n\n      }\n,        ]\n    \"msg\": \"Sucesso!\"\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 200\n{\n     \"msg\": \"erro\",\n     \"code\": 0\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./impacto.php",
    "groupTitle": "Impacto",
    "name": "PostImpacto_bulk"
  },
  {
    "type": "post",
    "url": "/login/",
    "title": "Login",
    "group": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "email",
            "description": "<p>Login de acesso ao sistema</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "password",
            "description": "<p>Senha de acesso ao sistema</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " {\n      \"email\": \"login_no_sistema\",\n      \"password\": \"minha_senha\"\n\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n{\n   \"code\": 1,\n   \"data\":\n    {\n       \"id\": 1,\n       \"nome\": \"fulano\",\n       \"email\": \"login_no_sistema\",\n       \"token\": \"eyJ0..\",\n       \"perfil_id\": 1\n    },\n   \"msg\": \"Sucesso!\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"login ou senha nao encontrado\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./login.php",
    "groupTitle": "Login",
    "name": "PostLogin"
  },
  {
    "type": "get",
    "url": "/materias/",
    "title": "Listar",
    "group": "Matérias",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data_inicio",
            "description": "<p>Data de início para pesquisar matéria. Formato yyyy-MM-dd HH:mm:ss Ex: 2020-01-20 10:00:00 (campo opcional)</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data_fim",
            "description": "<p>Data Final para pesquisar matéria. Formato yyyy-MM-dd HH:mm:ss Ex: 2020-01-20 10:00:00 (campo opcional)</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "id_emissora",
            "description": "<p>ID de emissora (campo opcional)</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "id_cliente",
            "description": "<p>ID de cliente (campo opcional)</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "min_id",
            "description": "<p>mínima ID de matéria. Se informado, sistema só trará matérias com ID acima desta. (campo opcional)</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n{\n   \"qtde\": 1, \n   \"data\":[\n      \"id\": 3,\n       \"titulo\": \"mais uma matéria\",\n       \"texto\": \"Testes\",\n        \"data_insert_materia\": \"2020-02-24 14:27:06\",\n        \"data_materia\": \"2019-10-16 00:02:49\",\n        \"apresentador\": \"Moisés Bizesti\",\n        \"id_programa\": 100,\n        \"programa\": \"Programa novo\",\n        \"hora_inicio\": \"00:02:49\",\n        \"duracao\": \"00:00:20\",\n        \"id_emissora\": 1,\n        \"emissora\": \"TV Bahia\",\n        \"clientes\": [\n            {\n                \"cliente\": \"Novo Cliente\",\n                \"id_cliente\": 1,\n                \"impacto\": \"NEUTRO\",\n                \"id_impacto\": 2,\n                \"id_topico\": 2,\n                \"topico\": \"Ministério Público\"\n            }\n        ],\n        \"arquivos\": [\n            {\n                 \"id\": 2,\n                 \"nome\": \"3.1.20200224_1427.mp3\",\n                 \"url\": \"http://localhost/midiaclip/arquivos/RTV/2020/2/2.1.20200224_1403.mp3\"\n            }\n       ],\n        \"status\": 0\n  ]\n \n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 200\n{\n     \"msg\": \"erro\",\n     \"code\": 0\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./materias.php",
    "groupTitle": "Matérias",
    "name": "GetMaterias"
  },
  {
    "type": "get",
    "url": "/clientes/:id/dicionario",
    "title": "Lista por Cliente",
    "group": "Palavras_Chave",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de Origem do Cliente (ID do cliente no seu sistema)</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n     {\n         \"data\": [\n\t\t\t                 {\n\t\t\t\t\t\t            \"id\": 5,\n\t\t\t\t\t\t            \"id_origem\": 2,\n\t\t\t\t\t\t            \"nome\": \"Carnaval\"\n\t\t\t\t\t\t        },\n\t\t\t\t\t\t        {\n\t\t\t\t\t\t            \"id\": 4,\n\t\t\t\t\t\t            \"id_origem\": 1,\n\t\t\t\t\t\t            \"nome\": \"Polícia\"\n\t\t\t\t\t\t        }\n\t\t\t    ],\n\t\t    \"qtde\": 2\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400\n{\n  \"message\": \"cliente não encontrado\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./palavras.php",
    "groupTitle": "Palavras_Chave",
    "name": "GetClientesIdDicionario"
  },
  {
    "type": "post",
    "url": "/clientes/:id_cliente/dicionario",
    "title": "Save by Cliente",
    "group": "Palavras_Chave",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_cliente",
            "description": "<p>ID de Origem do Cliente</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data",
            "description": "<p>Array de palavras, para pesquisa, em formato JSON do cliente. Ex: [{&quot;id&quot;:1,&quot;nome&quot;:&quot;Polícia&quot;}, {&quot;id&quot;:2,&quot;nome&quot;:&quot;Carnaval&quot;} ]</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " {\n    \"data\": \"[     {\"id\":1,\"nome\":\"Polícia\"},\n                      {\"id\":2,\"nome\":\"Carnaval\"}\n                ]\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n         {\n               \"qtde\": 2,\n               \"data\": [\n                   {\n                       \"id\": 1,\n                       \"nome\": \"Secretaria de cultura\"\n                   },\n                   {\n                       \"id\": 2,\n                       \"nome\": \"Ministério Público\"\n                   }\n               ]\n           }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./palavras.php",
    "groupTitle": "Palavras_Chave",
    "name": "PostClientesId_clienteDicionario"
  },
  {
    "type": "post",
    "url": "/praca_bulk/",
    "title": "Save from JSON",
    "group": "Praça",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data",
            "description": "<p>Array de dados em formato JSON - cada registro precisa ter id_origem e nome.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"data\":\"[{\"id_origem\":1,\"nome\":\"LOCAL\"},{\"id_origem\":2,\"nome\":\"NACIONAL\"}]\"         \n\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "  HTTP/1.1 200 OK\n  {\n     \"qtde\": 1, \n     \"data\":[\n      {\n        \"id\": 1\n        \"id_origem\": 1\n        \"nome\": \"LOCAL\"\n\n      }\n,        ]\n    \"msg\": \"Sucesso!\"\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 200\n{\n     \"msg\": \"erro\",\n     \"code\": 0\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./praca.php",
    "groupTitle": "Praça",
    "name": "PostPraca_bulk"
  },
  {
    "type": "delete",
    "url": "/programas/:id",
    "title": "Delete",
    "group": "Programas",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de origem do programa no cadastro do cliente.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n{\n   \"code\": 1,\n   \"data\":\n    {\n      \"id\": 1,\n      \"nome\": \"Programa a hora\",\n      \"hora_inicio\": \"00:10:10\",\n      \"hora_fim\": \"02:00:00\",\n      \"id_origem\": 145,\n      \"transcricao_ativar\": 1,\n      \"transcricao_tempo_extra_inicio\": \"00:05:00\",\n      \"transcricao_tempo_extra_fim\": \"00:05:00\",\n      \"transcricao_prioridade\": \"Normal\",\n      \"transcricao_dias\": \"1,2,3,4,5\",\n      \"id_emissora\": 1\n\n    },\n  \"msg\": \"Sucesso!\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 200\n{\n     \"msg\": \"erro\",\n     \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./programa.php",
    "groupTitle": "Programas",
    "name": "DeleteProgramasId"
  },
  {
    "type": "get",
    "url": "/programas",
    "title": "Lista Programas",
    "group": "Programas",
    "parameter": {
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n         \"filtro\": \"\",\n         \"order\": \"nome\",\n         \"order_type\": \"asc\"\n\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n    [\n\t\t  { \n\t           \"id\": 100,\n            \"nome\": \"Programa a hora\",\n            \"hora_inicio\": \"00:10:10\",\n            \"hora_fim\": \"02:00:00\",\n            \"id_origem\": 145,\n            \"transcricao_ativar\": 1,\n            \"transcricao_tempo_extra_inicio\": \"00:05:00\",\n            \"transcricao_tempo_extra_fim\": \"00:05:00\",\n            \"transcricao_prioridade\": \"Normal\",\n            \"transcricao_dias\": \"1,2,3,4,5\",\n            \"id_emissora\": 1\n       }\n    ]   \n   }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./programa.php",
    "groupTitle": "Programas",
    "name": "GetProgramas"
  },
  {
    "type": "get",
    "url": "/programas/:id",
    "title": "Show",
    "group": "Programas",
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n     {\n      \"code\": 1,\n      \"data\":\n       { \n\t        \"id\": 100,\n         \"nome\": \"Programa a hora\",\n         \"hora_inicio\": \"00:10:10\",\n         \"hora_fim\": \"02:00:00\",\n         \"id_origem\": 145,\n         \"transcricao_ativar\": 1,\n         \"transcricao_tempo_extra_inicio\": \"00:05:00\",\n         \"transcricao_tempo_extra_fim\": \"00:05:00\",\n         \"transcricao_prioridade\": \"Normal\",\n         \"transcricao_dias\": \"1,2,3,4,5\",\n         \"id_emissora\": 1\n       }\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400\n{\n  \"message\": \"erro\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./programa.php",
    "groupTitle": "Programas",
    "name": "GetProgramasId"
  },
  {
    "type": "post",
    "url": "/programas/",
    "title": "Create",
    "group": "Programas",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "nome",
            "description": "<p>Nome do Programa</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_origem",
            "description": "<p>Id do programa no cadastro do cliente</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "hora_inicio",
            "description": "<p>Hora de Início do programa, formato =&gt; hora : minuto : segundos -&gt; ex: 01:30:00</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "hora_fim",
            "description": "<p>Hora final do programa, formato =&gt; hora : minuto : segundos -&gt; ex: 04:30:00</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "transcricao_ativar",
            "description": "<p>Ativa transcrição? (1 ou 0 ) - 1 - Sim, 0 - Não</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "transcricao_prioridade",
            "description": "<p>prioridade: Baixa, Normal, Alta</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "transcricao_tempo_extra_inicio",
            "description": "<p>Tempo extra de início, ex: 00:05:00</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "transcricao_tempo_extra_fim",
            "description": "<p>Tempo extra final, ex: 00:05:00</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "transcricao_dias",
            "description": "<p>Dias da semana que o programa deve ser gravado=&gt; 0-domingo, 1 - segunda, 3 - terça... 6- sábado. Salve separado por vírgula, ex: 1,2,3</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_emissora",
            "description": "<p>Id da emissora no cadastro do cliente</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " {\n      \"nome\": \"Programa a hora\",\n      \"hora_inicio\": \"00:10:10\",\n      \"hora_fim\": \"02:00:00\",\n      \"id_origem\": 145,\n      \"transcricao_ativar\": 1,\n      \"transcricao_tempo_extra_inicio\": \"00:05:00\",\n      \"transcricao_tempo_extra_fim\": \"00:05:00\",\n      \"transcricao_prioridade\": \"Normal\",\n      \"transcricao_dias\": \"1,2,3,4,5\",\n      \"id_emissora\": 1\n\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n{\n   \"code\": 1,\n   \"data\":\n    {\n      \"id\": 1,\n      \"nome\": \"Programa a hora\",\n      \"hora_inicio\": \"00:10:10\",\n      \"hora_fim\": \"02:00:00\",\n      \"id_origem\": 145,\n      \"transcricao_ativar\": 1,\n      \"transcricao_tempo_extra_inicio\": \"00:05:00\",\n      \"transcricao_tempo_extra_fim\": \"00:05:00\",\n      \"transcricao_prioridade\": \"Normal\",\n      \"transcricao_dias\": \"1,2,3,4,5\",\n      \"id_emissora\": 1\n\n    },\n  \"msg\": \"Sucesso!\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./programa.php",
    "groupTitle": "Programas",
    "name": "PostProgramas"
  },
  {
    "type": "post",
    "url": "/programas_bulk/",
    "title": "Save from JSON",
    "group": "Programas",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "data",
            "description": "<p>Array de Programas  em formato JSON - Obs: enviar o dado como texto</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "    {\n       \"data\": \"[\n\t\t\t\t\t        {\n                             \"nome\": \"Programa a hora\",\n                             \"hora_inicio\": \"00:10:10\",\n                             \"hora_fim\": \"02:00:00\",\n                             \"id_origem\": 145,\n                             \"transcricao_ativar\": 1,\n                             \"transcricao_tempo_extra_inicio\": \"00:05:00\",\n                             \"transcricao_tempo_extra_fim\": \"00:05:00\",\n                             \"transcricao_prioridade\": \"Normal\",\n                             \"transcricao_dias\": \"1,2,3,4,5\",\n                             \"id_emissora\": 1\n\t\t\t\t\t        }\n\t\t\t\t\t    ]\"\n   }",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n\t\t { \n\t\t    \"qtde\": 1,\n\t\t    \"data\": [\n\t\t       {\n                   \"id\": 1,\n                   \"nome\": \"Programa a hora\",\n                   \"hora_inicio\": \"00:10:10\",\n                   \"hora_fim\": \"02:00:00\",\n                   \"id_origem\": 145,\n                   \"transcricao_ativar\": 1,\n                   \"transcricao_tempo_extra_inicio\": \"00:05:00\",\n                   \"transcricao_tempo_extra_fim\": \"00:05:00\",\n                   \"transcricao_prioridade\": \"Normal\",\n                   \"transcricao_dias\": \"1,2,3,4,5\",\n                   \"id_emissora\": 1\n\t\t        }\n\t\t    ]\n\t\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./programa.php",
    "groupTitle": "Programas",
    "name": "PostProgramas_bulk"
  },
  {
    "type": "put",
    "url": "/programas/:id",
    "title": "Update",
    "group": "Programas",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de origem do programa no cadastro do cliente.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " {\n      \"id\": 1,\n      \"nome\": \"Programa a hora\",\n      \"hora_inicio\": \"00:10:10\",\n      \"hora_fim\": \"02:00:00\",\n      \"id_origem\": 145,\n      \"transcricao_ativar\": 1,\n      \"transcricao_tempo_extra_inicio\": \"00:05:00\",\n      \"transcricao_tempo_extra_fim\": \"00:05:00\",\n      \"transcricao_prioridade\": \"Normal\",\n      \"transcricao_dias\": \"1,2,3,4,5\",\n      \"id_emissora\": 1\n\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n{\n   \"code\": 1,\n   \"data\":\n    {\n      \"id\": 1,\n      \"nome\": \"Programa a hora\",\n      \"hora_inicio\": \"00:10:10\",\n      \"hora_fim\": \"02:00:00\",\n      \"id_origem\": 145,\n      \"transcricao_ativar\": 1,\n      \"transcricao_tempo_extra_inicio\": \"00:05:00\",\n      \"transcricao_tempo_extra_fim\": \"00:05:00\",\n      \"transcricao_prioridade\": \"Normal\",\n      \"transcricao_dias\": \"1,2,3,4,5\",\n      \"id_emissora\": 1\n\n    },\n  \"msg\": \"Sucesso!\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./programa.php",
    "groupTitle": "Programas",
    "name": "PutProgramasId"
  },
  {
    "type": "delete",
    "url": "/whatsapp_contatos/:id_origem",
    "title": "Delete",
    "group": "Whatsapp_Contatos",
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n{\n   \"code\": 1,\n   \"data\":\n    {\n      \"id\": 1,\n      \"nome\": \"Fulano de Tal\",\n      \"id_origem\": 1,\n      \"robo\": 1,\n      \"cliente_nome\": \"Nome do Cliente\"\n      \"id_origem_cliente\": 10\n\n    },\n  \"msg\": \"Sucesso!\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 200\n{\n     \"msg\": \"erro\",\n     \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./login_cliente_registros.php",
    "groupTitle": "Whatsapp_Contatos",
    "name": "DeleteWhatsapp_contatosId_origem"
  },
  {
    "type": "get",
    "url": "/whatsapp_contatos",
    "title": "Lista",
    "group": "Whatsapp_Contatos",
    "parameter": {
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n         \"id_origem_cliente\": \"\",\n         \"filtro\": \"\"\n\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n    [\n\t { \n         \"id\": 1,\n         \"nome\": \"Fulano de Tal\",\n         \"id_origem\": 1,\n         \"robo\": 1,\n         \"cliente_nome\": \"Nome do Cliente\"\n         \"id_origem_cliente\": 10\n       }\n    ]   \n   }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./login_cliente_registros.php",
    "groupTitle": "Whatsapp_Contatos",
    "name": "GetWhatsapp_contatos"
  },
  {
    "type": "get",
    "url": "/whatsapp_contatos/:id_origem",
    "title": "Get One",
    "group": "Whatsapp_Contatos",
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n  {\n   \"code\": 1,\n   \"data\":\n    {\n      \"id\": 1,\n      \"nome\": \"Fulano de Tal\",\n      \"id_origem\": 1,\n      \"robo\": 1,\n      \"cliente_nome\": \"Nome do Cliente\"\n      \"id_origem_cliente\": 10\n    }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400\n{\n  \"message\": \"contato n�o localizado\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./login_cliente_registros.php",
    "groupTitle": "Whatsapp_Contatos",
    "name": "GetWhatsapp_contatosId_origem"
  },
  {
    "type": "post",
    "url": "/whatsapp_contatos",
    "title": "Create",
    "group": "Whatsapp_Contatos",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "nome",
            "description": "<p>Nome do contato (igual existente no smartphone)</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_origem_cliente",
            "description": "<p>Id do Cliente</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "robo",
            "description": "<p>ID do Robo (se nao informado o padrao sera 1 )</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_origem",
            "description": "<p>Id do contato</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " {\n      \"nome\": \"Fulano de Tal\",\n      \"id_origem_cliente\": 1,\n      \"robo\": 1,\n\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n{\n   \"code\": 1,\n   \"data\":\n    {\n      \"id\": 1,\n      \"nome\": \"Fulano de Tal\",\n      \"id_origem\": 1,\n      \"robo\": 1,\n      \"cliente_nome\": \"Nome do Cliente\"\n      \"id_origem_cliente\": 10\n\n    },\n  \"msg\": \"Sucesso!\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./login_cliente_registros.php",
    "groupTitle": "Whatsapp_Contatos",
    "name": "PostWhatsapp_contatos"
  },
  {
    "type": "put",
    "url": "/whatsapp_contatos/:id_origem",
    "title": "Update",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_origem",
            "description": "<p>Id do cadastro do contato</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " {\n      \"nome\": \"Fulano de Tal\",\n      \"id_origem_cliente\": 1,\n      \"robo\": 1\n\n}",
          "type": "json"
        }
      ]
    },
    "group": "Whatsapp_Contatos",
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n{\n   \"code\": 1,\n   \"data\":\n    {\n      \"id\": 1,\n      \"nome\": \"Fulano de Tal\",\n      \"id_origem\": 1,\n      \"robo\": 1,\n      \"cliente_nome\": \"Nome do Cliente\"\n      \"id_origem_cliente\": 10\n\n    },\n  \"msg\": \"Sucesso!\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./login_cliente_registros.php",
    "groupTitle": "Whatsapp_Contatos",
    "name": "PutWhatsapp_contatosId_origem"
  },
  {
    "type": "delete",
    "url": "/whatsapp_pool/:id_origem",
    "title": "Delete",
    "group": "Whatsapp_Pool",
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n{\n   \"code\": 1,\n   \"data\":\n    {\n      \"id\": 1\n      \"id_origem\": 1,\n      \"id_origem_contato\": 1,\n      \"status\": 1,\n      \"data_cadastro\": \"2020-03-16 00:00:00\",\n      \"texto\": \"envio de mensagem. http://login_de_teste.com.br/teste\"\n\n    },\n  \"msg\": \"Sucesso!\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 200\n{\n     \"msg\": \"erro\",\n     \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./login_cliente_whatsapp_pool.php",
    "groupTitle": "Whatsapp_Pool",
    "name": "DeleteWhatsapp_poolId_origem"
  },
  {
    "type": "get",
    "url": "/whatsapp_pool",
    "title": "Lista",
    "group": "Whatsapp_Pool",
    "parameter": {
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n         \"filtro\": \"\",\n         \"id_origem\": \"\"\n\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n   {\n    [\n\t { \n         \"id\": 1\n         \"id_origem\": 1,\n         \"id_origem_contato\": 1,\n         \"status\": 1,\n         \"data_cadastro\": \"2020-03-16 00:00:00\",\n         \"texto\": \"envio de mensagem. http://login_de_teste.com.br/teste\",\n         \"contatos_envio\": \"10,12\"\n       }\n    ]   \n   }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./login_cliente_whatsapp_pool.php",
    "groupTitle": "Whatsapp_Pool",
    "name": "GetWhatsapp_pool"
  },
  {
    "type": "get",
    "url": "/whatsapp_pool/:id_origem",
    "title": "Get One",
    "group": "Whatsapp_Pool",
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "   HTTP/1.1 200 OK\n     {\n      \"code\": 1,\n      \"data\":\n\t { \n         \"id\": 1\n         \"id_origem\": 1,\n         \"id_origem_contato\": 1,\n         \"status\": 1,\n         \"data_cadastro\": \"2020-03-16 00:00:00\",\n         \"texto\": \"envio de mensagem. http://login_de_teste.com.br/teste\"\n       }\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400\n{\n  \"message\": \"N�o localizado\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./login_cliente_whatsapp_pool.php",
    "groupTitle": "Whatsapp_Pool",
    "name": "GetWhatsapp_poolId_origem"
  },
  {
    "type": "post",
    "url": "/whatsapp_pool/",
    "title": "Create",
    "group": "Whatsapp_Pool",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "texto",
            "description": "<p>Texto da mensagem</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_origem_contato",
            "description": "<p>Id do Contato</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_origem",
            "description": "<p>Id da mensagem que ser� enviada</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "\t { \n         \"id_origem\": 1,\n         \"id_origem_contato\": 1,\n         \"texto\": \"envio de mensagem. http://login_de_teste.com.br/teste\"\n       }",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n{\n   \"code\": 1,\n   \"data\":\n    {\n      \"id\": 1\n      \"id_origem\": 1,\n      \"id_origem_contato\": 1,\n      \"status\": 1,\n      \"data_cadastro\": \"2020-03-16 00:00:00\",\n      \"texto\": \"envio de mensagem. http://login_de_teste.com.br/teste\"\n\n    },\n  \"msg\": \"Sucesso!\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./login_cliente_whatsapp_pool.php",
    "groupTitle": "Whatsapp_Pool",
    "name": "PostWhatsapp_pool"
  },
  {
    "type": "post",
    "url": "/whatsapp_pool/:id_origem",
    "title": "Update",
    "group": "Whatsapp_Pool",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "id_origem",
            "description": "<p>Id da mensagem que ser� enviada</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "texto",
            "description": "<p>Texto da mensagem</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " {\n      \"id_origem\": 1,\n      \"id_origem_contato\": 1,\n      \"texto\": \"envio de mensagem. http://login_de_teste.com.br/teste\"\n\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Sucesso",
          "content": "HTTP/1.1 200 OK\n{\n   \"code\": 1,\n   \"data\":\n    {\n      \"id\": 1\n      \"id_origem\": 1,\n      \"id_origem_contato\": 1,\n      \"status\": 1,\n      \"data_cadastro\": \"2020-03-16 00:00:00\",\n      \"texto\": \"envio de mensagem. http://login_de_teste.com.br/teste\"\n\n    },\n  \"msg\": \"Sucesso!\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " HTTP/1.1 200\n {\n      \"msg\": \"erro\",\n      \"code\": 0,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./login_cliente_whatsapp_pool.php",
    "groupTitle": "Whatsapp_Pool",
    "name": "PostWhatsapp_poolId_origem"
  }
] });
