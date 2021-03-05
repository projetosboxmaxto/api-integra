-- --------------------------------------------------------
-- Servidor:                     rafaeldatabase
-- Versão do servidor:           5.5.16-log - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela midiaclip_integrador.arquivos
CREATE TABLE IF NOT EXISTS `arquivos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela midiaclip_integrador.arquivos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `arquivos` DISABLE KEYS */;
/*!40000 ALTER TABLE `arquivos` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.associacao_cadastros
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
  KEY `ix_classificacao_tabela_pai_pai` (`classificacao`(191),`tabela_pai`,`id_pai`),
  KEY `ix_busca_filho` (`id_filho`,`classificacao`(191)),
  KEY `ix_data_referencia` (`data_referencia`),
  KEY `ix_busca_filho_table` (`id_filho`,`tabela_filho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Faz associação em vários cadastros do sistema';

-- Copiando dados para a tabela midiaclip_integrador.associacao_cadastros: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `associacao_cadastros` DISABLE KEYS */;
/*!40000 ALTER TABLE `associacao_cadastros` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.associacao_materia_radiotv_jornal
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela midiaclip_integrador.associacao_materia_radiotv_jornal: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `associacao_materia_radiotv_jornal` DISABLE KEYS */;
/*!40000 ALTER TABLE `associacao_materia_radiotv_jornal` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.avaliacao_impacto
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela midiaclip_integrador.avaliacao_impacto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `avaliacao_impacto` DISABLE KEYS */;
/*!40000 ALTER TABLE `avaliacao_impacto` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.cadastro_basico
CREATE TABLE IF NOT EXISTS `cadastro_basico` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela midiaclip_integrador.cadastro_basico: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cadastro_basico` DISABLE KEYS */;
/*!40000 ALTER TABLE `cadastro_basico` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.cadastro_fixo
CREATE TABLE IF NOT EXISTS `cadastro_fixo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL COMMENT 'Descrição',
  `id_tipo_cadastro_fixo` int(11) DEFAULT NULL COMMENT 'Tipo de Cadastro Fixo',
  `campo2` varchar(30) DEFAULT NULL,
  `campo1` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_cadastro_fixo` (`id_tipo_cadastro_fixo`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela midiaclip_integrador.cadastro_fixo: ~39 rows (aproximadamente)
/*!40000 ALTER TABLE `cadastro_fixo` DISABLE KEYS */;
INSERT INTO `cadastro_fixo` (`id`, `descricao`, `id_tipo_cadastro_fixo`, `campo2`, `campo1`) VALUES
	(1, 'Entretenimento', 1, NULL, '1'),
	(2, 'Eleições', 1, NULL, '2'),
	(3, 'Áudio / Vídeo', 1, NULL, '3'),
	(4, 'Impresso', 1, NULL, '4'),
	(5, 'Contagem Publicitária', 1, NULL, '6'),
	(6, 'Relatório', 1, NULL, '7'),
	(7, 'Cliente', 2, NULL, NULL),
	(8, 'Patrocinador', 2, NULL, NULL),
	(9, 'Artistas / Bandas', 2, NULL, NULL),
	(10, 'Blocos / Trio', 2, NULL, NULL),
	(11, 'Camarotes', 2, NULL, NULL),
	(12, 'Música', 2, NULL, NULL),
	(13, 'TV', 3, NULL, NULL),
	(14, 'RÁDIO', 3, NULL, NULL),
	(15, 'INTERNET', 3, NULL, NULL),
	(17, 'IMPRESSO', 3, NULL, NULL),
	(18, 'SUPERVISOR', 4, NULL, NULL),
	(19, 'USUÁRIO', 4, NULL, NULL),
	(20, 'Personalidade', 2, NULL, NULL),
	(21, 'Cliente', 5, NULL, NULL),
	(22, 'Sub-Cliente', 5, NULL, NULL),
	(23, 'Setor', 5, NULL, NULL),
	(24, 'DVD', 6, NULL, NULL),
	(25, 'Backup', 6, NULL, NULL),
	(26, 'Bruto', 7, NULL, NULL),
	(27, 'Editado', 7, NULL, NULL),
	(28, 'Rádio', 8, NULL, NULL),
	(29, 'TV', 8, NULL, NULL),
	(30, 'Boa', 9, NULL, NULL),
	(31, 'Normal', 9, NULL, NULL),
	(32, 'Baixa', 9, NULL, NULL),
	(33, 'Ruim', 9, NULL, NULL),
	(37, 'ADMINISTRADOR', 4, NULL, NULL),
	(38, 'DVD / BACKUP', 4, NULL, NULL),
	(39, 'Áudio', 999, NULL, NULL),
	(40, 'On-Line', 1, NULL, '5'),
	(41, 'Horário Eleitoral', 10, NULL, NULL),
	(42, 'Propaganda', 10, NULL, NULL),
	(43, 'REVISTA', 3, NULL, NULL);
/*!40000 ALTER TABLE `cadastro_fixo` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.chaves
CREATE TABLE IF NOT EXISTS `chaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tabela` varchar(300) DEFAULT NULL COMMENT 'Nome da tabela na qual o incrementador vai ser lançado.',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano em que o registro será cadastrado.',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Indica qual é o servidor ao qual pertence essa pk.',
  `sequencial` int(11) DEFAULT NULL COMMENT 'indica qual é o sequencial atual deste registro, nesta tabela deste servidor e deste ano ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Esta tabela vai conter as chaves primárias utilizadasno sist';

-- Copiando dados para a tabela midiaclip_integrador.chaves: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `chaves` DISABLE KEYS */;
/*!40000 ALTER TABLE `chaves` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
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
  KEY `tx_nome` (`nome`(191),`fantasia`(191)),
  KEY `ix_id_regiao` (`id_regiao`),
  KEY `ix_cliente_edicao_dicionario` (`data_ultima_edicao_dicionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Armazena os clientes de rádio/tv/jornal';

-- Copiando dados para a tabela midiaclip_integrador.cliente: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.dicionario_tags
CREATE TABLE IF NOT EXISTS `dicionario_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'TAG',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `tipo` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_tipo_dicionario` (`tipo`),
  FULLTEXT KEY `dic_nome` (`nome`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela midiaclip_integrador.dicionario_tags: 0 rows
/*!40000 ALTER TABLE `dicionario_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `dicionario_tags` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.emissora
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela midiaclip_integrador.emissora: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `emissora` DISABLE KEYS */;
/*!40000 ALTER TABLE `emissora` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.materia_jornal
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Dados específicos quando a matéria é Jornal';

-- Copiando dados para a tabela midiaclip_integrador.materia_jornal: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `materia_jornal` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia_jornal` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.materia_online
CREATE TABLE IF NOT EXISTS `materia_online` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id da matéria que faz parte ->tabela materia_radiotv_jornal',
  `id_editoria` int(10) unsigned DEFAULT NULL COMMENT 'Editoria',
  `id_coluna` int(10) unsigned DEFAULT NULL COMMENT 'Coluna',
  `id_jornalista` int(10) unsigned DEFAULT NULL COMMENT 'Jornalista / Colunista',
  `link` varchar(300) DEFAULT NULL COMMENT 'Link Original',
  `id_secao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Matéria OnLine';

-- Copiando dados para a tabela midiaclip_integrador.materia_online: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `materia_online` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia_online` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.materia_radiotv_jornal
CREATE TABLE IF NOT EXISTS `materia_radiotv_jornal` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela midiaclip_integrador.materia_radiotv_jornal: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `materia_radiotv_jornal` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia_radiotv_jornal` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.materia_radiotv_jornal_complemento
CREATE TABLE IF NOT EXISTS `materia_radiotv_jornal_complemento` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Dados específicos quando a matéria é Radio/TV';

-- Copiando dados para a tabela midiaclip_integrador.materia_radiotv_jornal_complemento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `materia_radiotv_jornal_complemento` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia_radiotv_jornal_complemento` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.materia_radio_tv
CREATE TABLE IF NOT EXISTS `materia_radio_tv` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_programa` int(10) unsigned DEFAULT NULL COMMENT 'Programa',
  `id_apresentador` int(10) unsigned DEFAULT NULL COMMENT 'Apresentador',
  `indicar_programa` smallint(5) unsigned DEFAULT NULL COMMENT 'Indicar programação (Sim/Não)',
  `fixar_programacao` smallint(5) unsigned DEFAULT NULL COMMENT 'Fixar programação (Sim/Não)',
  `nr_registro_importado` varchar(30) DEFAULT NULL COMMENT 'Número do registro importado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Dados específicos quando a matéria é Radio/TV';

-- Copiando dados para a tabela midiaclip_integrador.materia_radio_tv: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `materia_radio_tv` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia_radio_tv` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela midiaclip_integrador.migrations: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
	(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
	(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
	(6, '2016_06_01_000004_create_oauth_clients_table', 1),
	(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela midiaclip_integrador.oauth_access_tokens: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('51dccb80421dd3ac8563627da811c1c6561745d89430d85bda465225ced5498769726becea670398', 1, 1, 'access_token', '[]', 0, '2020-02-17 18:52:14', '2020-02-17 18:52:14', '2021-02-17 18:52:14'),
	('5571a219ae176295613d6fa2fc879d14d2b5e3e93d5dca39cdb8451ed16d9a501ca4cdff303daa84', 1, 1, 'access_token', '[]', 0, '2020-02-17 18:50:45', '2020-02-17 18:50:45', '2021-02-17 18:50:45');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela midiaclip_integrador.oauth_auth_codes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela midiaclip_integrador.oauth_clients: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Laravel Personal Access Client', 'UpuPppf0ttAPSHhWSPOG2Jifn7alw3XYuG34x81w', 'http://localhost', 1, 0, 0, '2020-02-17 18:50:37', '2020-02-17 18:50:37'),
	(2, NULL, 'Laravel Password Grant Client', 'qQjSgi1QCyjICUJCh6J6v9J1jLL1Z8tQDaYHp4lr', 'http://localhost', 0, 1, 0, '2020-02-17 18:50:38', '2020-02-17 18:50:38');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.oauth_personal_access_clients
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela midiaclip_integrador.oauth_personal_access_clients: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2020-02-17 18:50:38', '2020-02-17 18:50:38');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela midiaclip_integrador.oauth_refresh_tokens: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.parameters_by_item
CREATE TABLE IF NOT EXISTS `parameters_by_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `code` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Parameter Code',
  `value` text CHARACTER SET latin1 COLLATE latin1_general_ci COMMENT 'Parameter Value',
  `title` varchar(300) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Parameter Title',
  `nome_tabela` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_registro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_registro_tabela` (`id_registro`,`nome_tabela`),
  KEY `ix_nome_tabela_code` (`nome_tabela`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Application parameters by item';

-- Copiando dados para a tabela midiaclip_integrador.parameters_by_item: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `parameters_by_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `parameters_by_item` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.parametros_configuracao
CREATE TABLE IF NOT EXISTS `parametros_configuracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) DEFAULT NULL COMMENT 'Código do parâmetro',
  `valor` varchar(300) DEFAULT NULL COMMENT 'Valor do parâmetro',
  `titulo` varchar(300) DEFAULT NULL COMMENT 'Título do parâmetro',
  PRIMARY KEY (`id`),
  KEY `ix_codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Aqui ficam configurações utilizadas pelo sistema.';

-- Copiando dados para a tabela midiaclip_integrador.parametros_configuracao: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `parametros_configuracao` DISABLE KEYS */;
/*!40000 ALTER TABLE `parametros_configuracao` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela midiaclip_integrador.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.programa
CREATE TABLE IF NOT EXISTS `programa` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
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
  `id_emissora` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_registro_importado` (`id_registro_importado`,`tabela_importado`,`banco_importado`),
  KEY `ix_id_emissora` (`id_emissora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela midiaclip_integrador.programa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `programa` DISABLE KEYS */;
/*!40000 ALTER TABLE `programa` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.temp_search
CREATE TABLE IF NOT EXISTS `temp_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificador` varchar(30) DEFAULT NULL,
  `texto` longtext,
  PRIMARY KEY (`id`),
  KEY `temp_search_texto` (`texto`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela midiaclip_integrador.temp_search: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `temp_search` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_search` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.tipo_cadastro_basico
CREATE TABLE IF NOT EXISTS `tipo_cadastro_basico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(300) DEFAULT NULL COMMENT 'Descrição do tipo de cadastro básico',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela midiaclip_integrador.tipo_cadastro_basico: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_cadastro_basico` DISABLE KEYS */;
INSERT INTO `tipo_cadastro_basico` (`id`, `descricao`) VALUES
	(1, 'Categoria'),
	(2, 'Exibição'),
	(3, 'Impacto'),
	(4, 'Praça'),
	(5, 'Faixa Horária'),
	(6, 'Circuito'),
	(7, 'Tipo de Blocos / Trio'),
	(8, 'Evento'),
	(9, 'Bloco'),
	(10, 'Cargo'),
	(11, 'Coligação'),
	(12, 'Posição TRE'),
	(13, 'Relevância'),
	(14, 'LIXO ou TEMPORÁRIO'),
	(15, 'Região');
/*!40000 ALTER TABLE `tipo_cadastro_basico` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.tipo_cadastro_fixo
CREATE TABLE IF NOT EXISTS `tipo_cadastro_fixo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) DEFAULT NULL COMMENT 'Descrição',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela midiaclip_integrador.tipo_cadastro_fixo: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_cadastro_fixo` DISABLE KEYS */;
INSERT INTO `tipo_cadastro_fixo` (`id`, `descricao`) VALUES
	(1, 'Módulo do Sistema'),
	(2, 'Tipo de Entidade'),
	(3, 'Veículo'),
	(4, 'Perfil de Acesso'),
	(5, 'Hierarquia Cliente'),
	(6, 'Tipo de DVD'),
	(7, 'Formato DVD'),
	(8, 'Mídia'),
	(9, 'Qualidade'),
	(10, 'Tipo Matéria Eleição');
/*!40000 ALTER TABLE `tipo_cadastro_fixo` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` text COLLATE utf8mb4_unicode_ci,
  `remember_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela midiaclip_integrador.users: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `access_token`, `remember_token`, `created_at`, `updated_at`, `api_token`) VALUES
	(1, 'Administrator', 'admin@admin.com', NULL, '$2y$10$bwx/gqjNCzkV56qq7Q.ruebtljWQiX9Z37tvchUrkCliNmBnVxP1W', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjUxZGNjYjgwNDIxZGQzYWM4NTYzNjI3ZGE4MTFjMWM2NTYxNzQ1ZDg5NDMwZDg1YmRhNDY1MjI1Y2VkNTQ5ODc2OTcyNmJlY2VhNjcwMzk4In0.eyJhdWQiOiIxIiwianRpIjoiNTFkY2NiODA0MjFkZDNhYzg1NjM2MjdkYTgxMWMxYzY1NjE3NDVkODk0MzBkODViZGE0NjUyMjVjZWQ1NDk4NzY5NzI2YmVjZWE2NzAzOTgiLCJpYXQiOjE1ODE5NjU1MzUsIm5iZiI6MTU4MTk2NTUzNSwiZXhwIjoxNjEzNTg3OTM0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.c7R9aRc0kdC3leyqTjx254RHZIwOE5BHmLYSoM-WCyoQRxNkvv0-Dd0ljiK_pdBzAks1T9POuxTa_J6iTotTwB88caP43PxGHTpLEajoiG_j1KW2IOv8HHQjoihDy8IVR_efS8JeHRsgh-af08N3MlDYtU3SPLfFtbr3VVqVoWeHfnI014RvX7sXGCmDXYIHCC9ClEaaf3OW93DtZIkVV80AX7BipZiOTZhW6T9mRKKvIws6EACgx31yFOEnkRSHTwpUacyK5F5bte2cFLNO7SxtVzNKw6Mawbnux5GGYNB23NDpJx_x4n0-yPTDa-ZFlslyQph3C184vRu0nwwYvlrV46QExNSYNo7551zdCTPZgj09-6fiGr7qSrhXUorL2j_fvOZBwSEwGiglTwjcZaTy14f2VDhvkAMWTpk4JSbhcdDwLso8bdfaTfAdVTchTXYeJ2r2woujYbdJeCw6jxHINOYRtiGL2F1ULgY5v9At35qj62kHvjlrG703XMU41d5foVDgouNaTKzS9c0oZf9SybbzQmN8JlFsn69DLRCcEAzRHl7_jqP_tK4LwbFkY8Da_y_-avv8bnZmxAIivtUfI92ON1s5fnJklXOw3MnutCX12r6Zi_mUPaLREP_P-38GMT_m0cAWd-oitL2PLepYzKcJXZ1NyMVMmkY-6oY', NULL, '2020-02-14 13:38:56', '2020-02-17 18:52:15', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjUxZGNjYjgwNDIxZGQzYWM4NTYzNjI3ZGE4MTFjMWM2NTYxNzQ1ZDg5NDMwZDg1YmRhNDY1MjI1Y2VkNTQ5ODc2OTcyNmJlY2VhNjcwMzk4In0.eyJhdWQiOiIxIiwianRpIjoiNTFkY2NiODA0MjFkZDNhYzg1NjM2MjdkYTgxMWMxYzY1NjE3NDVkODk0MzBkODViZGE0NjUyMjVjZWQ1NDk4NzY5NzI2YmVjZWE2NzAzOTgiLCJpYXQiOjE1ODE5NjU1MzUsIm5iZiI6MTU4MTk2NTUzNSwiZXhwIjoxNjEzNTg3OTM0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.c7R9aRc0kdC3leyqTjx254RHZIwOE5BHmLYSoM-WCyoQRxNkvv0-Dd0ljiK_pdBzAks1T9POuxTa_J6iTotTwB88caP43PxGHTpLEajoiG_j1KW2IOv8HHQjoihDy8IVR_efS8JeHRsgh-af08N3MlDYtU3SPLfFtbr3VVqVoWeHfnI014RvX7sXGCmDXYIHCC9ClEaaf3OW93DtZIkVV80AX7BipZiOTZhW6T9mRKKvIws6EACgx31yFOEnkRSHTwpUacyK5F5bte2cFLNO7SxtVzNKw6Mawbnux5GGYNB23NDpJx_x4n0-yPTDa-ZFlslyQph3C184vRu0nwwYvlrV46QExNSYNo7551zdCTPZgj09-6fiGr7qSrhXUorL2j_fvOZBwSEwGiglTwjcZaTy14f2VDhvkAMWTpk4JSbhcdDwLso8bdfaTfAdVTchTXYeJ2r2woujYbdJeCw6jxHINOYRtiGL2F1ULgY5v9At35qj62kHvjlrG703XMU41d5foVDgouNaTKzS9c0oZf9SybbzQmN8JlFsn69DLRCcEAzRHl7_jqP_tK4LwbFkY8Da_y_-avv8bnZmxAIivtUfI92ON1s5fnJklXOw3MnutCX12r6Zi_mUPaLREP_P-38GMT_m0cAWd-oitL2PLepYzKcJXZ1NyMVMmkY-6oY');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Copiando estrutura para tabela midiaclip_integrador.usuario
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `classes_cliente` (
	`id` BIGINT(20) AUTO_INCREMENT ,
	`nome` VARCHAR(300) NULL DEFAULT NULL COMMENT 'Nome',
	`id_cliente` INT(11) NULL DEFAULT NULL COMMENT 'Id do Cliente, Dono da classe',
	`servidor` SMALLINT(6) NULL DEFAULT NULL,
	`ano` SMALLINT(6) NULL DEFAULT NULL,
	`sequencial` INT(11) NULL DEFAULT NULL,
	`id_pai` BIGINT(20) NULL DEFAULT NULL COMMENT 'Indica quem é a categoria pai',
	`nivel` VARCHAR(30) NULL DEFAULT NULL COMMENT 'Nível da categoria',
	`ordem` VARCHAR(50) NULL DEFAULT NULL,
	`status` SMALLINT(6) NULL DEFAULT '1',
	PRIMARY KEY (`id`),
	INDEX `ix_cliente` (`id_cliente`)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;


CREATE TABLE `jornalista_apresentador` (
	`id` INT(11) AUTO_INCREMENT NOT NULL COMMENT 'ID',
	`nome` VARCHAR(300) NULL DEFAULT NULL COMMENT 'Nome',
	`servidor` SMALLINT(6) NULL DEFAULT NULL,
	`ano` SMALLINT(6) NULL DEFAULT NULL,
	`sequencial` INT(11) NULL DEFAULT NULL,
	`id_registro_importado` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'Se este registro foi importado, esta coluna armazena a id de origem',
	`tabela_importado` VARCHAR(50) NULL DEFAULT NULL,
	`banco_importado` VARCHAR(50) NULL DEFAULT NULL COMMENT 'oracle / postgres',
	`login` VARCHAR(30) NULL DEFAULT NULL,
	`senha` VARCHAR(30) NULL DEFAULT NULL,
	`tipo` INT(11) NULL DEFAULT NULL COMMENT 'Apresentador / Jornalista',
	`tx_veiculo` LONGTEXT NULL,
	`tx_exibicao` LONGTEXT NULL,
	`tx_programa` LONGTEXT NULL,
	`influenciador` SMALLINT(6) NULL DEFAULT NULL,
	`nota` SMALLINT(6) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	index ix_registro_importado ( id_registro_importado,  tabela_importado )
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;





-- Copiando dados para a tabela midiaclip_integrador.usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;


-- Copiando estrutura para view midiaclip_integrador.vw_login_acesso
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `vw_login_acesso` 
) ENGINE=MyISAM;


-- Copiando estrutura para view midiaclip_integrador.vw_login_acesso
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `vw_login_acesso`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` VIEW `vw_login_acesso` AS select `email_cliente`.`id` AS `id`,`email_cliente`.`email` AS `email`,`email_cliente`.`id_cliente` AS `id_cliente`,`email_cliente`.`contato_email` 

AS `nome`,
`email_cliente`.`senha` AS `senha`,`email_cliente`.`email` AS `login`,`email_cliente`.`status` AS `status`,'C' AS `cadastro_tipo`,'3,40,4' AS 

`modulos`,
 cliente.id_monitoramento_scup
 from `email_cliente` 
 left join cliente on cliente.id = email_cliente.id_cliente


union select `login_cliente`.`id` AS `id`,`login_cliente`.`email` AS `email`,NULL AS `id_cliente`,`login_cliente`.`nome` AS 

`nome`,`login_cliente`.`senha` AS `senha`,`login_cliente`.`login` AS `login`,ifnull(`login_cliente`.`status`,1) AS `status`,'L' AS 

`cadastro_tipo`,`login_cliente`.`modulos` AS `modulos` 
,login_cliente.id_monitoramento_scup
from `login_cliente` ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
