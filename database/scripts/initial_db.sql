CREATE TABLE IF NOT EXISTS `arquivos` (
  `id` bigint(20) AUTO_INCREMENT COMMENT 'ID' ,
  `id_materia` bigint(20) NOT NULL COMMENT 'Id da matéria associada ao arquivo',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `ordem` smallint(5) unsigned DEFAULT NULL COMMENT 'Ordem de cadastro do arquivo..',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `tamanho` int(11) DEFAULT NULL COMMENT 'Tamanho do arquivo',
  `tipo` varchar(100) DEFAULT NULL COMMENT 'Tipo stream do arquivo',
  `id_tipo` int(11) DEFAULT NULL COMMENT 'Tipo de arquivo',
  `data_cadastro` datetime DEFAULT NULL COMMENT 'Data de cadastro do arquivo',
  `duracao` varchar(8) DEFAULT NULL,
  `duracao_segundos` int(11) DEFAULT NULL COMMENT 'Duração do arquivo',
  `id_associado` int(11) DEFAULT NULL COMMENT 'Associação',
  `codigo` varchar(50) DEFAULT NULL COMMENT 'Código que ajude a identificar o arquivo',
  `ano` smallint(5) unsigned DEFAULT NULL,
  `tabela` varchar(50) DEFAULT NULL,
  `thumb` varchar(300) DEFAULT NULL,
  `flv_file` varchar(300) DEFAULT NULL,
  `url_drive` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_materia` (`id_materia`,`tabela`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci';



-- Copiando estrutura para tabela midiaclip_producao.associacao_cadastros
CREATE TABLE IF NOT EXISTS `associacao_cadastros` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_pai` bigint(20) unsigned DEFAULT NULL COMMENT 'Id do cadastro de pai',
  `tabela_pai` varchar(50) DEFAULT NULL COMMENT 'Nome da tabela, neste sistema, do registro pai',
  `tipo_pai` varchar(30) DEFAULT NULL COMMENT 'Forma de identificar o tipo de registro pai -> não obrigatório',
  `id_filho` bigint(20) unsigned DEFAULT NULL COMMENT 'Id do cadastro filho',
  `tabela_filho` varchar(50) DEFAULT NULL COMMENT 'Forma de identificar a tabela do registro filho',
  `tipo_filho` varchar(30) DEFAULT NULL COMMENT 'Forma de identificar o cadastro filho',
  `classificacao` varchar(300) DEFAULT NULL COMMENT 'Classificação do tipo de relacionamento',
  `sequencial` int(11) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `servidor` smallint(6) DEFAULT NULL,
  `tabela_importado` varchar(50) DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL,
  `id_registro_importado` varchar(50) DEFAULT NULL COMMENT 'id no sistema anterior, caso importado',
  `data_referencia` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_classificacao_tabela_pai_pai` (`classificacao`(255),`tabela_pai`,`id_pai`),
  KEY `ix_busca_filho` (`id_filho`,`classificacao`(255)),
  KEY `ix_data_referencia` (`data_referencia`),
  KEY `ix_busca_filho_table` (`id_filho`,`tabela_filho`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci'
COMMENT='Faz associação em vários cadastros do sistema';




-- Copiando estrutura para tabela midiaclip_producao.associacao_materia_radiotv_jornal
CREATE TABLE IF NOT EXISTS `associacao_materia_radiotv_jornal` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `servidor` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `id_materia_radiotv_jornal` bigint(20) DEFAULT NULL,
  `id_entidade` int(11) DEFAULT NULL,
  `id_tipo_entidade` int(11) DEFAULT NULL,
  `id_categoria` int(10) unsigned DEFAULT NULL,
  `tabela_importado` varchar(50) DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL,
  `id_registro_importado` varchar(30) DEFAULT NULL,
  `classificacao` varchar(300) DEFAULT NULL,
  `data_envio_email` datetime DEFAULT NULL COMMENT 'Data da ultima vez que foi enviada por email',
  `data_materia` datetime DEFAULT NULL,
  `id_veiculo` int(11) DEFAULT NULL,
  `id_emissora` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_entidade` (`id_entidade`),
  KEY `ix_id_materia_radiotv_jornal` (`id_materia_radiotv_jornal`),
  KEY `ix_data_cliente` (`id_entidade`,`data_materia`),
  KEY `ix_cliente_data_envio` (`id_entidade`,`data_envio_email`),
  KEY `id_entidade` (`id_entidade`),
  KEY `id_materia` (`id_materia_radiotv_jornal`),
  KEY `ix_importacao` (`id_registro_importado`,`tabela_importado`,`banco_importado`),
  KEY `ix_entidade_emissora` (`id_entidade`,`id_emissora`),
  KEY `ix_data_materia` (`data_materia`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci';


CREATE TABLE IF NOT EXISTS `avaliacao_impacto` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_impacto` varchar(300) DEFAULT NULL COMMENT 'Impacto',
  `id_cliente` int(11) DEFAULT NULL COMMENT 'Cliente',
  `id_materia` bigint(20) DEFAULT NULL COMMENT 'Matéria',
  `tabela_materia` varchar(50) DEFAULT NULL COMMENT 'Tabela da matéria',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `id_categoria_cliente` int(10) unsigned DEFAULT NULL COMMENT 'Categoria na qual classifica a matéria para o cliente',
  `cita_cliente` tinyint(3) unsigned DEFAULT NULL COMMENT '0 - Não, 1 - Sim',
  `classificacao` varchar(30) DEFAULT NULL,
  `classificacao_resultado` varchar(30) DEFAULT NULL,
  `data_materia` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_tabela_materia` (`tabela_materia`,`id_materia`),
  KEY `ix_cliente` (`id_cliente`),
  KEY `ix_data_materia` (`data_materia`),
  KEY `ix_cliente_materia` (`id_materia`,`id_cliente`),
  KEY `ix_id_materia_cliente` (`id_materia`,`id_cliente`),
  KEY `ix_materia_data_cliente` (`data_materia`,`id_cliente`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci';





-- Copiando estrutura para tabela midiaclip_producao.cadastro_basico
CREATE TABLE IF NOT EXISTS `cadastro_basico` (
  `id` int(11) AUTO_INCREMENT COMMENT 'ID',
  `descricao` varchar(300) DEFAULT NULL COMMENT 'Descrição',
  `tipo_cadastro_basico` int(11) DEFAULT NULL COMMENT 'Tipo de Cadastro Básico',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `tipo` tinyint(3) unsigned DEFAULT NULL COMMENT 'indica o tipo de registro.',
  `id_registro_importado` int(10) unsigned DEFAULT NULL COMMENT 'Se este registro foi importado, esta coluna armazena a id de origem',
  `tabela_importado` varchar(50) DEFAULT NULL,
  `campo1` varchar(30) DEFAULT NULL,
  `campo2` varchar(30) DEFAULT NULL,
  `campo3` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_cadastro_basico` (`tipo_cadastro_basico`),
  KEY `ix_cadastro_basico_importacao` (`id_registro_importado`,`tabela_importado`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.cadastro_fixo
CREATE TABLE IF NOT EXISTS `cadastro_fixo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL COMMENT 'Descrição',
  `id_tipo_cadastro_fixo` int(11) DEFAULT NULL COMMENT 'Tipo de Cadastro Fixo',
  `campo2` varchar(30) DEFAULT NULL,
  `campo1` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_cadastro_fixo` (`id_tipo_cadastro_fixo`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci';


CREATE TABLE IF NOT EXISTS `chaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tabela` varchar(300) DEFAULT NULL COMMENT 'Nome da tabela na qual o incrementador vai ser lançado.',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano em que o registro será cadastrado.',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Indica qual é o servidor ao qual pertence essa pk.',
  `sequencial` int(11) DEFAULT NULL COMMENT 'indica qual é o sequencial atual deste registro, nesta tabela deste servidor e deste ano ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci' 
COMMENT='Esta tabela vai conter as chaves primárias utilizadasno sist';




-- Copiando estrutura para tabela midiaclip_producao.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) AUTO_INCREMENT COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `id_registro_importado` int(10) unsigned DEFAULT NULL COMMENT 'Se este registro foi importado, esta coluna armazena a id de origem',
  `tabela_importado` varchar(50) DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL COMMENT 'oracle / postgres',
  `fantasia` varchar(300) DEFAULT NULL COMMENT 'Nome Fantasia',
  `cpf_cnpj` varchar(20) DEFAULT NULL COMMENT 'CPF ou CNPJ',
  `telefone` varchar(20) DEFAULT NULL COMMENT 'Telefone',
  `fax` varchar(20) DEFAULT NULL COMMENT 'Fax',
  `status` int(10) unsigned DEFAULT NULL COMMENT 'Ativo ou Inativo',
  `id_pai` int(10) unsigned DEFAULT NULL COMMENT 'Pai',
  `site` varchar(200) DEFAULT NULL,
  `template_html` varchar(200) DEFAULT NULL,
  `login` varchar(30) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL COMMENT 'Entidade, Sub Entidade, Setor',
  `id_modelo_email` int(11) DEFAULT NULL,
  `modulos_email` varchar(30) DEFAULT NULL,
  `mostra_mensuracao` smallint(6) DEFAULT '1',
  `id_regiao` int(11) DEFAULT NULL,
  `label_classes` varchar(150) DEFAULT NULL COMMENT 'Classes area do cliente',
  `mostra_relatorio` smallint(6) DEFAULT NULL COMMENT 'Link Relatorio Area Cliente',
  `id_monitoramento_scup` varchar(30) DEFAULT NULL,
  `mostra_so_prioridade` smallint(6) DEFAULT '0',
  `online_calculo_valor_banner` double(18,2) DEFAULT NULL,
  `online_calculo_largura_banner` smallint(6) DEFAULT NULL,
  `online_calculo_altura_banner` smallint(6) DEFAULT NULL,
  `online_calculo_valor_caractere` double(18,2) DEFAULT NULL,
  `data_ultima_edicao_dicionario` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_registro_importado` (`id_registro_importado`,`tabela_importado`,`banco_importado`),
  KEY `ix_id_tipo` (`id_tipo`),
  KEY `tx_nome` (`nome`(255),`fantasia`(255)),
  KEY `ix_id_regiao` (`id_regiao`),
  KEY `ix_cliente_edicao_dicionario` (`data_ultima_edicao_dicionario`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci'  
COMMENT='Armazena os clientes de rádio/tv/jornal';




-- Copiando estrutura para tabela midiaclip_producao.dicionario_tags
CREATE TABLE IF NOT EXISTS `dicionario_tags` (
  `id` int(11) AUTO_INCREMENT COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'TAG',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `tipo` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_tipo_dicionario` (`tipo`),
  FULLTEXT KEY `dic_nome` (`nome`)
) ENGINE=MyISAM 
COLLATE='utf8mb4_general_ci'  ;


CREATE TABLE IF NOT EXISTS `emissora` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome da emissora',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano',
  `id_veiculo` int(11) DEFAULT NULL,
  `id_registro_importado` int(10) unsigned DEFAULT NULL COMMENT 'Se este registro foi importado, esta coluna armazena a id de origem',
  `tabela_importado` varchar(50) DEFAULT NULL,
  `id_exibido` int(11) DEFAULT NULL,
  `id_forma_cobranca` varchar(30) DEFAULT NULL,
  `preco_visualizacao` decimal(18,2) DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL,
  `sigla` varchar(20) DEFAULT NULL COMMENT 'Sigla',
  `id_praca` int(10) unsigned DEFAULT NULL COMMENT 'Praça',
  `preco_revista` longtext,
  `classificacao` varchar(10) DEFAULT NULL,
  `id_regiao` int(11) DEFAULT NULL,
  `uf` varchar(30) DEFAULT NULL,
  `com_stream` tinyint(4) DEFAULT '0',
  `url_stream_sd` varchar(300) DEFAULT NULL,
  `url_stream_hd` varchar(300) DEFAULT NULL,
  `audiencia` varchar(300) DEFAULT NULL,
  `site` varchar(300) DEFAULT NULL,
  `modelo_streaming` smallint(6) DEFAULT '1',
  `url_stream_sd2` varchar(300) DEFAULT NULL,
  `url_stream_hd2` varchar(300) DEFAULT NULL,
  `transcricao_qualidade` varchar(4) DEFAULT NULL,
  `transcricao_url` varchar(300) DEFAULT NULL,
  `transcricao_url2` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_veiculo` (`id_veiculo`),
  KEY `id_registro_importado` (`id_registro_importado`,`tabela_importado`,`banco_importado`),
  KEY `ix_id_regiao` (`id_regiao`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci'  ;






-- Copiando estrutura para tabela midiaclip_producao.materia_jornal
CREATE TABLE IF NOT EXISTS `materia_jornal` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id da matéria que faz parte ->tabela materia_radiotv_jornal',
  `id_editoria` int(10) unsigned DEFAULT NULL COMMENT 'Editoria',
  `id_jornalista` int(10) unsigned DEFAULT NULL COMMENT 'Jornalista / Colunista',
  `id_coluna` int(10) unsigned DEFAULT NULL COMMENT 'Coluna',
  `qtde_coluna` int(10) unsigned DEFAULT NULL COMMENT 'Quantidade de Coluna',
  `centimetragem` int(10) unsigned DEFAULT NULL COMMENT 'Centimetragem',
  `area` int(10) unsigned DEFAULT NULL COMMENT 'Área',
  `pagina` int(10) unsigned DEFAULT NULL COMMENT 'Página',
  `custo_pub` decimal(18,2) DEFAULT NULL COMMENT 'Custo publicação',
  `nr_registro_importado` varchar(30) DEFAULT NULL COMMENT 'Número do registro importado',
  `noticia` longtext COMMENT 'Texto da Notícia',
  `indexada` varbinary(0) DEFAULT NULL,
  `revista_tipo_cobranca` varchar(100) DEFAULT NULL,
  `revista_preco` varchar(30) DEFAULT NULL,
  `revista_multiplicar` int(11) DEFAULT NULL,
  `ultima_pagina` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci'  
COMMENT='Dados específicos quando a matéria é Jornal';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.materia_online
CREATE TABLE IF NOT EXISTS `materia_online` (
  `id` bigint(20) AUTO_INCREMENT COMMENT 'Id da matéria que faz parte ->tabela materia_radiotv_jornal',
  `id_editoria` int(10) unsigned DEFAULT NULL COMMENT 'Editoria',
  `id_coluna` int(10) unsigned DEFAULT NULL COMMENT 'Coluna',
  `id_jornalista` int(10) unsigned DEFAULT NULL COMMENT 'Jornalista / Colunista',
  `link` varchar(300) DEFAULT NULL COMMENT 'Link Original',
  `id_secao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB
COLLATE='utf8mb4_general_ci' 
 COMMENT='Matéria OnLine';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.materia_radiotv_jornal
CREATE TABLE IF NOT EXISTS `materia_radiotv_jornal` (
  `id` bigint(20) AUTO_INCREMENT COMMENT 'ID',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano',
  `titulo` varchar(300) DEFAULT NULL COMMENT 'Título',
  `sinopse` longtext COMMENT 'Sinopse',
  `texto` longtext COMMENT 'Texto da Notícia',
  `data_insert_materia` datetime DEFAULT NULL COMMENT 'Data de cadastro da matéria',
  `data_materia` datetime DEFAULT NULL COMMENT 'Data da Matéria',
  `hora_inicio` varchar(8) DEFAULT NULL COMMENT 'Hora Início',
  `hora_fim` varchar(8) DEFAULT NULL COMMENT 'Hora Fim',
  `duracao` varchar(8) DEFAULT NULL COMMENT 'Duração da matéria',
  `duracao_segundos` int(11) DEFAULT NULL COMMENT 'Duração',
  `id_praca` int(11) DEFAULT NULL COMMENT 'Praça',
  `id_veiculo` int(11) DEFAULT NULL COMMENT 'Veículo',
  `id_emissora` int(11) DEFAULT NULL COMMENT 'Emissora',
  `id_impacto` int(11) DEFAULT NULL COMMENT 'Impacto',
  `id_categoria` int(11) DEFAULT NULL COMMENT 'Categoria',
  `id_exibido` int(11) DEFAULT NULL COMMENT 'Exibição',
  `id_faixa_horaria` int(11) DEFAULT NULL COMMENT 'Faixa Horária',
  `valor_referencia` double DEFAULT NULL COMMENT 'Valor Referência',
  `id_modulo` int(11) DEFAULT NULL COMMENT 'Módulo do Sistema',
  `materia_enviada` datetime DEFAULT NULL COMMENT 'Matéria Enviada',
  `id_registro_importado` int(10) unsigned DEFAULT NULL COMMENT 'Se este registro foi importado, esta coluna armazena a id de origem',
  `tabela_importado` varchar(50) DEFAULT NULL,
  `alias_importado` varchar(30) DEFAULT NULL,
  `id_operador` int(10) unsigned DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL COMMENT 'postgres / oracle',
  `data_hora_materia` datetime DEFAULT NULL,
  `sinopse_html` longtext,
  `texto_html` longtext,
  `status_atual` int(11) DEFAULT NULL COMMENT 'Status atual da matéria',
  `cita_cliente` int(11) DEFAULT NULL COMMENT 'Indica se o cliente é citado ou não, 1 - Sim, 2 - Não',
  `tags` varchar(400) DEFAULT NULL,
  `quadrante` varchar(300) DEFAULT NULL,
  `id_classificacao` int(11) DEFAULT NULL,
  `classificacao` varchar(10) DEFAULT NULL,
  `classificacao_resultado` varchar(10) DEFAULT NULL,
  `nao_envia_email` tinyint(4) DEFAULT '0' COMMENT 'Se 1 - não deve enviar email',
  `destaque` varchar(3) DEFAULT NULL,
  `com_audio` tinyint(4) DEFAULT NULL,
  `capa` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_emissora` (`id_emissora`),
  KEY `id_exibido` (`id_exibido`),
  KEY `id_faixa_horaria` (`id_faixa_horaria`),
  KEY `id_impacto` (`id_impacto`),
  KEY `id_modulo` (`id_modulo`),
  KEY `id_modulo_2` (`id_modulo`,`data_materia`),
  KEY `id_praca` (`id_praca`),
  KEY `id_registro_importado` (`id_registro_importado`,`tabela_importado`,`banco_importado`),
  KEY `id_veiculo` (`id_veiculo`),
  KEY `ix_data_hora_materia` (`data_hora_materia`),
  KEY `ix_modulo_data_hora` (`data_hora_materia`,`id_modulo`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci' ;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.materia_radiotv_jornal_complemento
CREATE TABLE IF NOT EXISTS `materia_radiotv_jornal_complemento` (
  `id` bigint(20) AUTO_INCREMENT COMMENT 'ID',
  `hash_tags` text,
  `atores` text,
  `clientes_lista` text,
  `servidor` smallint(2) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano',
  `data_materia` datetime DEFAULT NULL COMMENT 'Data da Matéria',
  `id_modulo` int(11) DEFAULT NULL COMMENT 'Módulo do Sistema',
  PRIMARY KEY (`id`),
  KEY `ix_sequencia` (`sequencial`,`ano`,`servidor`),
  KEY `ix_data_materia` (`data_materia`,`id_modulo`)
)  ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci' COMMENT='Dados específicos quando a matéria é Radio/TV';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.materia_radio_tv
CREATE TABLE IF NOT EXISTS `materia_radio_tv` (
  `id` bigint(20) AUTO_INCREMENT COMMENT 'ID',
  `id_programa` int(10) unsigned DEFAULT NULL COMMENT 'Programa',
  `id_apresentador` int(10) unsigned DEFAULT NULL COMMENT 'Apresentador',
  `indicar_programa` smallint(5) unsigned DEFAULT NULL COMMENT 'Indicar programação (Sim/Não)',
  `fixar_programacao` smallint(5) unsigned DEFAULT NULL COMMENT 'Fixar programação (Sim/Não)',
  `nr_registro_importado` varchar(30) DEFAULT NULL COMMENT 'Número do registro importado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci'  
COMMENT='Dados específicos quando a matéria é Radio/TV';




-- Copiando estrutura para tabela midiaclip_producao.parameters_by_item
CREATE TABLE IF NOT EXISTS `parameters_by_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `code` varchar(100) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Parameter Code',
  `value` text COLLATE latin1_general_ci COMMENT 'Parameter Value',
  `title` varchar(300) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Parameter Title',
  `nome_tabela` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `id_registro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_registro_tabela` (`id_registro`,`nome_tabela`),
  KEY `ix_nome_tabela_code` (`nome_tabela`,`code`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci'  COMMENT='Application parameters by item';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.parametros_configuracao
CREATE TABLE IF NOT EXISTS `parametros_configuracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) DEFAULT NULL COMMENT 'Código do parâmetro',
  `valor` varchar(300) DEFAULT NULL COMMENT 'Valor do parâmetro',
  `titulo` varchar(300) DEFAULT NULL COMMENT 'Título do parâmetro',
  PRIMARY KEY (`id`),
  KEY `ix_codigo` (`codigo`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci' 
COMMENT='Aqui ficam configurações utilizadas pelo sistema.';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.programa
CREATE TABLE IF NOT EXISTS `programa` (
  `id` int(10) AUTO_INCREMENT COMMENT 'ID',
  `ano` smallint(5) unsigned DEFAULT NULL COMMENT 'Ano',
  `servidor` smallint(5) unsigned DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(10) unsigned DEFAULT NULL COMMENT 'Sequencial',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `hora_inicio` varchar(8) DEFAULT NULL COMMENT 'Hora Início',
  `hora_fim` varchar(8) DEFAULT NULL COMMENT 'Hora Fim',
  `hora_inicio_seg` int(11) DEFAULT NULL COMMENT 'Hora Início Segundos',
  `hora_fim_seg` int(11) DEFAULT NULL COMMENT 'Hora Fim Segundos',
  `classificacao` varchar(2) DEFAULT NULL COMMENT 'Classificação',
  `id_meio_comunicacao` int(10) unsigned DEFAULT NULL COMMENT 'Meio Comunicação',
  `destaque` smallint(5) unsigned DEFAULT NULL COMMENT 'Destaque',
  `custo_pub` double unsigned DEFAULT NULL COMMENT 'Custo de Publicação (R$)',
  `id_registro_importado` int(10) unsigned DEFAULT NULL,
  `tabela_importado` varchar(50) DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL,
  `duracao_sem_comercial` varchar(8) DEFAULT NULL,
  `duracao_sem_comercial_seg` int(11) DEFAULT NULL,
  `transcricao_ativar` smallint(6) DEFAULT '0',
  `transcricao_tempo_extra_inicio` varchar(8) DEFAULT NULL,
  `transcricao_tempo_extra_fim` varchar(8) DEFAULT NULL,
  `transcricao_prioridade` varchar(20) DEFAULT NULL,
  `transcricao_prioridade_persistente` varchar(20) DEFAULT NULL,
  `transcricao_dias` text,
  `transcricao_tempo_fim_seg` int(11) DEFAULT NULL,
  `transcricao_tempo_inicio_seg` int(11) DEFAULT NULL,
  `descr_facil` text,
  PRIMARY KEY (`id`),
  KEY `id_registro_importado` (`id_registro_importado`,`tabela_importado`,`banco_importado`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci' ;



-- Copiando estrutura para tabela midiaclip_producao.temp_search
CREATE TABLE IF NOT EXISTS `temp_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificador` varchar(30) DEFAULT NULL,
  `texto` longtext,
  PRIMARY KEY (`id`),
  KEY `temp_search_texto` (`texto`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.tipo_cadastro_basico
CREATE TABLE IF NOT EXISTS `tipo_cadastro_basico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(300) DEFAULT NULL COMMENT 'Descrição do tipo de cadastro básico',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci' ;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.tipo_cadastro_fixo
CREATE TABLE IF NOT EXISTS `tipo_cadastro_fixo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) DEFAULT NULL COMMENT 'Descrição',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci' ;


-- Copiando estrutura para tabela midiaclip_producao.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ano` smallint(6) DEFAULT NULL,
  `servidor` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `senha` varchar(300) DEFAULT NULL,
  `tipo` varchar(300) DEFAULT NULL,
  `nome` varchar(300) DEFAULT NULL,
  `id_registro_importado` int(11) DEFAULT NULL,
  `tabela_importado` varchar(50) DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL,
  `ativo` smallint(6) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `id_grade_horario` int(11) DEFAULT NULL,
  `id_grade_fim_de_semana` int(10) unsigned DEFAULT NULL,
  `funcao` varchar(300) DEFAULT NULL,
  `carteira_profissional` varchar(300) DEFAULT NULL,
  `data_admissao` datetime DEFAULT NULL,
  `estrutura_organizacional` varchar(300) DEFAULT NULL,
  `envia_email_ponto` smallint(6) DEFAULT '0',
  `id_empresa_ponto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
COLLATE='utf8mb4_general_ci';


CREATE TABLE `servidor_transcricao` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
	`url` VARCHAR(300) NULL DEFAULT NULL,
	`nome` VARCHAR(300) NULL DEFAULT NULL,
	`licencas` SMALLINT(6) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COMMENT='Servidor de Transcrição'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;



