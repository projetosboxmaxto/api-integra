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

-- Copiando estrutura para tabela midiaclip_transcricao.agrupamento_notificacoes
CREATE TABLE IF NOT EXISTS `agrupamento_notificacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dia` int(11) DEFAULT NULL,
  `id_programa` int(11) DEFAULT NULL,
  `id_emissora` int(11) DEFAULT NULL,
  `palavras` longtext,
  `clientes` longtext,
  `hora_inicio_seg` int(11) DEFAULT NULL,
  `hora_fim_seg` int(11) DEFAULT NULL,
  `tempo_seg` int(11) DEFAULT NULL,
  `json` longtext,
  `data` datetime DEFAULT NULL,
  `hora_inicio` varchar(8) DEFAULT NULL,
  `hora_fim` varchar(8) DEFAULT NULL,
  `id_evento_arquivo` int(11) DEFAULT NULL,
  `tempo_fim_seg` int(11) DEFAULT NULL,
  `tempo` varchar(8) DEFAULT NULL,
  `tempo_fim` varchar(8) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `palavras_backup` longtext,
  PRIMARY KEY (`id`),
  KEY `ix_data` (`data`),
  KEY `ix_id_programa` (`data`,`id_programa`),
  KEY `ix_id_emissora` (`data`,`id_emissora`),
  KEY `ix_id_evento_arquivo` (`id_evento_arquivo`),
  FULLTEXT KEY `fx_clientes` (`palavras`,`clientes`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.boxnet_emissoras_editoria
CREATE TABLE IF NOT EXISTS `boxnet_emissoras_editoria` (
  `id` double DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `idmidia` double DEFAULT NULL,
  `midia` varchar(255) DEFAULT NULL,
  `codigomidia` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `codigoestado` varchar(255) DEFAULT NULL,
  `grupoestado` varchar(255) DEFAULT NULL,
  `codigopais` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.boxnet_jornalista_apresentador
CREATE TABLE IF NOT EXISTS `boxnet_jornalista_apresentador` (
  `id_boxnet` double DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `exibição` varchar(255) DEFAULT NULL,
  `veículo_s_` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.cache_apresentador
CREATE TABLE IF NOT EXISTS `cache_apresentador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_programa` int(11) DEFAULT NULL,
  `id_apresentador` int(11) DEFAULT NULL,
  `id_operador` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_data` (`data`,`id_operador`,`id_programa`),
  KEY `ix_id_programa` (`data`,`id_programa`),
  KEY `ix_data2` (`data`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.cliente_configuracao
CREATE TABLE IF NOT EXISTS `cliente_configuracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) DEFAULT NULL,
  `consulta_comum` tinyint(4) DEFAULT NULL,
  `consulta_elastic` tinyint(4) DEFAULT NULL,
  `loaded_praca` tinyint(4) DEFAULT NULL,
  `praca_json` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_created_at` (`created_at`),
  KEY `ix_id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.elastic_queries
CREATE TABLE IF NOT EXISTS `elastic_queries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `titulo` varchar(300) DEFAULT NULL,
  `querie` longtext,
  `ativo` smallint(6) DEFAULT '0',
  `data` datetime DEFAULT NULL,
  `id_praca` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_cliente` (`id_cliente`),
  KEY `ix_praca` (`id_praca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.eventos
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `id_programa` int(11) DEFAULT NULL,
  `id_emissora` int(11) DEFAULT NULL,
  `hora_inicio` varchar(8) DEFAULT NULL,
  `hora_fim` varchar(8) DEFAULT NULL,
  `hora_inicio_seg` int(11) DEFAULT NULL,
  `hora_fim_seg` int(11) DEFAULT NULL,
  `duracao` varchar(8) DEFAULT NULL,
  `duracao_seg` int(11) DEFAULT NULL,
  `tempo_realizado_minutos` int(11) DEFAULT NULL,
  `tempo_total_minutos` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT 'pai',
  `id_operador` int(11) DEFAULT NULL,
  `id_evento_pai` int(11) DEFAULT NULL,
  `nome_projeto` varchar(100) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `bloqueado_por` varchar(100) DEFAULT NULL,
  `data_status_change` datetime DEFAULT NULL,
  `bloqueado_por_id` int(11) DEFAULT NULL,
  `ajusta_pasta` smallint(6) DEFAULT '0',
  `tipo_hora` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_data` (`data`),
  KEY `ix_id_programa` (`id_programa`),
  KEY `ix_data_programa` (`data`,`id_programa`),
  KEY `ix_id_programa_dia` (`id_programa`,`dia`),
  KEY `ix_dia` (`dia`),
  KEY `ix_data_status_change` (`data_status_change`),
  KEY `ix_emissora` (`id_emissora`),
  KEY `ix_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.eventos_arquivos
CREATE TABLE IF NOT EXISTS `eventos_arquivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` text,
  `nome` varchar(300) DEFAULT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `tempo_realizado_minutos` float DEFAULT NULL,
  `hora_inicio` varchar(8) DEFAULT NULL,
  `hora_inicio_seg` int(11) DEFAULT NULL,
  `inserted_at` datetime DEFAULT NULL,
  `texto` longtext,
  `json` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `meta_dados` text,
  `id_materia_radiotv_jornal` bigint(20) DEFAULT NULL,
  `com_temp_search` tinyint(4) DEFAULT '0',
  `titulo` varchar(100) DEFAULT NULL,
  `status` smallint(6) DEFAULT '1',
  `bloqueado_por_id` int(11) DEFAULT NULL,
  `com_elastic_search` smallint(6) DEFAULT '0',
  `meta_dados_elastic` text,
  PRIMARY KEY (`id`),
  KEY `ix_id_evento` (`id_evento`),
  KEY `ix_id_materia_radiotv_jornal` (`id_materia_radiotv_jornal`),
  KEY `ix_com_temp_search` (`com_temp_search`),
  KEY `ix_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.eventos_arquivos_clientes
CREATE TABLE IF NOT EXISTS `eventos_arquivos_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `id_evento_arquivo` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `cita_diretamente` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_evento` (`id_evento`),
  KEY `ix_data` (`data`),
  KEY `ix_id_evento_arquivo` (`id_evento_arquivo`),
  KEY `ix_id_evento_arquivo_id_cliente` (`id_evento_arquivo`,`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.eventos_arquivos_palavras
CREATE TABLE IF NOT EXISTS `eventos_arquivos_palavras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `id_evento_arquivo` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `cita_diretamente` smallint(6) DEFAULT NULL,
  `palavra` varchar(300) DEFAULT NULL,
  `tempo` varchar(30) DEFAULT NULL,
  `tempo_seg` decimal(14,3) DEFAULT NULL,
  `id_dicionario_tag` int(11) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `operador` varchar(300) DEFAULT NULL,
  `id_operador` bigint(20) DEFAULT NULL,
  `id_materia_radiotv_jornal` bigint(20) DEFAULT NULL,
  `trecho` text,
  `id_notificacao_agrupamento` int(11) DEFAULT NULL,
  `indexed` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_evento` (`id_evento`),
  KEY `ix_data` (`data`),
  KEY `ix_id_evento_arquivo` (`id_evento_arquivo`),
  KEY `ix_id_evento_arquivo_id_cliente` (`id_evento_arquivo`,`id_cliente`),
  KEY `ix_id_notificacao_agrupamento` (`id_notificacao_agrupamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.eventos_clientes
CREATE TABLE IF NOT EXISTS `eventos_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `id_eventos` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `cita_diretamente` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_data` (`data`),
  KEY `ix_data_cliente` (`data`,`id_cliente`),
  KEY `ix_id_eventos` (`id_eventos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.fila_atividade
CREATE TABLE IF NOT EXISTS `fila_atividade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evento` int(11) DEFAULT NULL,
  `id_evento_arquivo` int(11) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_evento` (`id_evento`),
  KEY `ix_id_evento_arquivo` (`id_evento_arquivo`),
  KEY `ix_created_at` (`created_at`),
  KEY `ix_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.log
CREATE TABLE IF NOT EXISTS `log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `data_inicio` datetime DEFAULT NULL COMMENT 'Data em que o operador começou a ação (cadastro, edição, exclusão)',
  `data_fim` datetime DEFAULT NULL COMMENT 'Data final em que ele acabou de fazer a ação',
  `tempo` int(11) DEFAULT NULL COMMENT 'tempo que levou, o intervalo, em segundos da data inicio e da data final',
  `texto` text COMMENT 'Descrição do log',
  `tabela` varchar(40) DEFAULT NULL COMMENT 'Ação executada',
  `registro_id` bigint(20) DEFAULT NULL COMMENT 'Registro associado',
  `operador_id` int(11) DEFAULT NULL COMMENT 'Operador responsável pela ação',
  `nome_operador` varchar(300) DEFAULT NULL COMMENT 'Nome do operador responsável pela ação',
  `tipo` varchar(4) DEFAULT NULL COMMENT 'Tipo de Log',
  `titulo` varchar(300) DEFAULT NULL COMMENT 'Título da ação executada',
  PRIMARY KEY (`id`),
  KEY `inx_log_localiza` (`registro_id`,`tabela`),
  KEY `inx_log_data_inicio` (`data_inicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.materia_rascunho
CREATE TABLE IF NOT EXISTS `materia_rascunho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_projeto` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `titulo` text,
  `cliente_list` text,
  `ids_arquivos` text,
  `dados_materia` longtext,
  `id_programa` int(11) DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `id_operador` int(11) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `id_materia_radiotv_jornal` bigint(20) DEFAULT NULL COMMENT 'ID matéria no sistema midiaclip',
  `id_evento_arquivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_data` (`data`),
  KEY `ix_id_projeto` (`id_projeto`),
  KEY `ix_id_operador` (`id_operador`),
  KEY `ix_data_cadastro` (`data_cadastro`),
  KEY `ix_evento_arquivo` (`id_evento_arquivo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.palavras_chave
CREATE TABLE IF NOT EXISTS `palavras_chave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `palavra` varchar(300) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `id_praca` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_cliente` (`id_cliente`),
  KEY `ix_praca` (`id_praca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.projeto
CREATE TABLE IF NOT EXISTS `projeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `id_operador` int(11) DEFAULT NULL,
  `arquivos` text,
  `meta_dados` text,
  `path` varchar(300) DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_data` (`data`),
  KEY `ix_id_evento` (`id_evento`),
  KEY `ix_id_operador` (`id_operador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.projeto_arquivos
CREATE TABLE IF NOT EXISTS `projeto_arquivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `id_projeto` int(11) DEFAULT NULL,
  `id_operador` int(11) DEFAULT NULL,
  `arquivo` varchar(300) DEFAULT NULL,
  `meta_dados` text,
  `path` varchar(300) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_data` (`data`),
  KEY `ix_id_projeto` (`id_projeto`),
  KEY `ix_id_operador` (`id_operador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.search_queries
CREATE TABLE IF NOT EXISTS `search_queries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `titulo` varchar(300) DEFAULT NULL,
  `querie` longtext,
  `ativo` smallint(6) DEFAULT '0',
  `data` datetime DEFAULT NULL,
  `id_praca` int(11) DEFAULT NULL,
  `exclusao` text,
  PRIMARY KEY (`id`),
  KEY `ix_id_cliente` (`id_cliente`),
  KEY `ix_praca` (`id_praca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_transcricao.temp_search
CREATE TABLE IF NOT EXISTS `temp_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evento_arquivo` int(11) DEFAULT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `texto` longtext,
  `json` longtext,
  `em_uso` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ix_id_evento` (`id_evento`),
  KEY `ix_id_evento_arquivo` (`id_evento_arquivo`),
  FULLTEXT KEY `texto` (`texto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
