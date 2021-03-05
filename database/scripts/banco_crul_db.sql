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

-- Copiando estrutura para tabela midiaclip_producao.arquivos
CREATE TABLE IF NOT EXISTS `arquivos` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.associacao_cadastros
CREATE TABLE IF NOT EXISTS `associacao_cadastros` (
  `id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'ID',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Faz associação em vários cadastros do sistema';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.associacao_materia
CREATE TABLE IF NOT EXISTS `associacao_materia` (
  `id` int(11) NOT NULL,
  `servidor` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL,
  `id_entidade` int(11) DEFAULT NULL,
  `id_tipo_entidade` int(11) DEFAULT NULL,
  `tempo_segundos` int(10) unsigned DEFAULT NULL,
  `tempo` varchar(5) DEFAULT NULL,
  `id_categoria` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_materia` (`id_materia`),
  KEY `id_entidade` (`id_entidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.associacao_materia_eleicao
CREATE TABLE IF NOT EXISTS `associacao_materia_eleicao` (
  `id` bigint(20) NOT NULL,
  `servidor` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `id_materia_eleicao` bigint(20) DEFAULT NULL,
  `id_entidade` int(11) DEFAULT NULL,
  `id_tipo_entidade` int(11) DEFAULT NULL,
  `id_categoria` int(10) unsigned DEFAULT NULL,
  `tabela_importado` varchar(50) DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL,
  `id_registro_importado` varchar(30) DEFAULT NULL,
  `classificacao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_materia` (`id_materia_eleicao`),
  KEY `id_entidade` (`id_entidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.associacao_materia_radiotv_jornal
CREATE TABLE IF NOT EXISTS `associacao_materia_radiotv_jornal` (
  `id` bigint(20) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.atores
CREATE TABLE IF NOT EXISTS `atores` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `atores_nome` (`nome`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.autorizacao_horaextra
CREATE TABLE IF NOT EXISTS `autorizacao_horaextra` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `tempo` varchar(8) DEFAULT NULL COMMENT 'Tempo Hora Extra',
  `tempo_seg` int(11) DEFAULT NULL,
  `responsavel` varchar(200) DEFAULT NULL COMMENT 'Responsavel',
  `id_responsavel` int(11) DEFAULT NULL COMMENT 'Responsavel',
  `data_envio_email` datetime DEFAULT NULL,
  `historico_envio_email` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Aut. Hora Extra';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.autorizacao_horaextra_usuario
CREATE TABLE IF NOT EXISTS `autorizacao_horaextra_usuario` (
  `id_autorizacao` int(11) NOT NULL COMMENT 'ID',
  `id_usuario` int(11) NOT NULL COMMENT 'ID',
  PRIMARY KEY (`id_autorizacao`,`id_usuario`),
  KEY `ix_autorizacao` (`id_autorizacao`),
  KEY `ix_usuario` (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Aut. Hora Extra Resp';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.avaliacao_impacto
CREATE TABLE IF NOT EXISTS `avaliacao_impacto` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.boxnet_export_jornalista
CREATE TABLE IF NOT EXISTS `boxnet_export_jornalista` (
  `idveiculobox` double DEFAULT NULL,
  `idjornalistabox` double DEFAULT NULL,
  `idprogramamd` double DEFAULT NULL,
  `idveiculomd` double DEFAULT NULL,
  `idjornalistamd` double DEFAULT NULL,
  `nomeveiculo` varchar(255) DEFAULT NULL,
  `midia` varchar(255) DEFAULT NULL,
  `nomejornalista` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `ix_jornalista` (`idjornalistamd`),
  KEY `ix_veiculo_jornalista` (`idveiculomd`,`idjornalistamd`),
  KEY `ix_programa_jornalista` (`idprogramamd`,`idjornalistamd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.boxnet_export_programa
CREATE TABLE IF NOT EXISTS `boxnet_export_programa` (
  `programa` varchar(255) DEFAULT NULL,
  `emissora` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `id_programa_midiaclip` double DEFAULT NULL,
  `id_emissora_midiaclip` double DEFAULT NULL,
  `id_emissora_boxnet` double DEFAULT NULL,
  `id_programa_boxnet` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `ix_programa_emissora` (`id_programa_midiaclip`,`id_emissora_midiaclip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.boxnet_integracao
CREATE TABLE IF NOT EXISTS `boxnet_integracao` (
  `id` double DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `idmidia` double DEFAULT NULL,
  `midia` varchar(255) DEFAULT NULL,
  `codigomidia` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `codigoestado` varchar(255) DEFAULT NULL,
  `grupoestado` varchar(255) DEFAULT NULL,
  `codigopais` varchar(255) DEFAULT NULL,
  `id_veiculo_midiaclip` double DEFAULT NULL,
  `id_programa_midiaclip` double DEFAULT NULL,
  `id_editoria_midiaclip` varchar(255) DEFAULT NULL,
  `id_secao_midiaclip` varchar(255) DEFAULT NULL,
  `tipo` varchar(300) DEFAULT 'programa',
  `id_jornalista` bigint(20) DEFAULT NULL,
  `idpk` int(11) NOT NULL AUTO_INCREMENT,
  `id_coluna_midiaclip` bigint(20) DEFAULT NULL,
  `id_cliente_midiaclip` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpk`),
  KEY `ix_programa` (`id_programa_midiaclip`),
  KEY `ix_veiculo_midiaclip` (`id_veiculo_midiaclip`),
  KEY `ix_boxnet` (`id`,`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.cadastro_basico
CREATE TABLE IF NOT EXISTS `cadastro_basico` (
  `id` int(11) NOT NULL COMMENT 'ID',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.campanha_eleicao
CREATE TABLE IF NOT EXISTS `campanha_eleicao` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano',
  `data_cadastro` datetime DEFAULT NULL COMMENT 'Data de cadastro da campanha',
  `titulo` varchar(300) DEFAULT NULL COMMENT 'Título da campanha',
  `obs` longtext COMMENT 'Observações',
  `id_coligacao` varchar(30) DEFAULT NULL COMMENT 'Coligação',
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.campanha_publicitaria
CREATE TABLE IF NOT EXISTS `campanha_publicitaria` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano',
  `data_cadastro` datetime DEFAULT NULL COMMENT 'Data de cadastro da campanha',
  `titulo` varchar(300) DEFAULT NULL COMMENT 'Título da campanha',
  `obs` longtext COMMENT 'Observações',
  `status` varchar(30) DEFAULT NULL,
  `duracao` varchar(8) DEFAULT NULL,
  `duracao_segundos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.chaves
CREATE TABLE IF NOT EXISTS `chaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tabela` varchar(300) DEFAULT NULL COMMENT 'Nome da tabela na qual o incrementador vai ser lançado.',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano em que o registro será cadastrado.',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Indica qual é o servidor ao qual pertence essa pk.',
  `sequencial` int(11) DEFAULT NULL COMMENT 'indica qual é o sequencial atual deste registro, nesta tabela deste servidor e deste ano ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Esta tabela vai conter as chaves primárias utilizadasno sist';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.classes_cliente
CREATE TABLE IF NOT EXISTS `classes_cliente` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `id_cliente` int(11) DEFAULT NULL COMMENT 'Id do Cliente, Dono da classe',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `id_pai` bigint(20) DEFAULT NULL COMMENT 'Indica quem é a categoria pai',
  `nivel` varchar(30) DEFAULT NULL COMMENT 'Nível da categoria',
  `ordem` varchar(50) DEFAULT NULL,
  `status` smallint(6) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ix_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.classificacao_opcao_resultado
CREATE TABLE IF NOT EXISTS `classificacao_opcao_resultado` (
  `id` int(11) NOT NULL DEFAULT '0' COMMENT 'ID',
  `letra` varchar(30) DEFAULT NULL COMMENT 'Letra da Classifição',
  `detalhes` varchar(300) DEFAULT NULL COMMENT 'Detalhes',
  `ano` smallint(5) unsigned DEFAULT NULL,
  `servidor` tinyint(3) unsigned DEFAULT NULL,
  `sequencial` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.classificacao_opcoes
CREATE TABLE IF NOT EXISTS `classificacao_opcoes` (
  `id` int(11) NOT NULL DEFAULT '0' COMMENT 'ID',
  `letra` varchar(30) DEFAULT NULL COMMENT 'Letra da Classifição',
  `detalhes` varchar(300) DEFAULT NULL COMMENT 'Detalhes',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano',
  `id_veiculo` int(11) DEFAULT NULL COMMENT 'Canal de Comunicação',
  `hora_inicio` varchar(50) DEFAULT NULL COMMENT 'Hora Início',
  `hora_fim` varchar(50) DEFAULT NULL COMMENT 'Hora Fim',
  PRIMARY KEY (`id`),
  KEY `id_veiculo` (`id_veiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL COMMENT 'ID',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Armazena os clientes de rádio/tv/jornal';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.cliente_configuracao
CREATE TABLE IF NOT EXISTS `cliente_configuracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `tipo` varchar(20) DEFAULT NULL,
  `texto` text,
  `ativo` smallint(6) DEFAULT NULL,
  `nome_tabela` varchar(50) DEFAULT NULL,
  `id_registro` int(11) DEFAULT NULL,
  `titulo` varchar(300) DEFAULT NULL,
  `semi_token` varchar(300) DEFAULT NULL,
  `token` varchar(300) DEFAULT NULL,
  `twitter` int(11) DEFAULT NULL,
  `user_twitter` varchar(300) DEFAULT NULL,
  `filtro_sql` text,
  `telegram` int(11) DEFAULT NULL,
  `telegram_chats_id` text,
  `disponibilizar` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_nome_tabela` (`id_registro`,`nome_tabela`),
  KEY `ix_ativo` (`ativo`,`twitter`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.cliente_emissora
CREATE TABLE IF NOT EXISTS `cliente_emissora` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_cliente` int(11) DEFAULT NULL,
  `id_emissora` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.cliente_prioridade_emissora
CREATE TABLE IF NOT EXISTS `cliente_prioridade_emissora` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `id_cliente` int(11) DEFAULT NULL COMMENT 'Id do Cliente, Dono da classe',
  `id_emissora` int(11) DEFAULT NULL COMMENT 'Id do Cliente, Dono da classe',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `prioridade` smallint(6) DEFAULT NULL COMMENT 'Nível de prioridade',
  PRIMARY KEY (`id`),
  KEY `ix_cliente` (`id_cliente`),
  KEY `ix_emissora` (`id_emissora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.coligacao_titulos
CREATE TABLE IF NOT EXISTS `coligacao_titulos` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `titulo` varchar(300) DEFAULT NULL COMMENT 'Título',
  `id_coligacao` int(11) DEFAULT NULL COMMENT 'Coligação',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.coluna
CREATE TABLE IF NOT EXISTS `coluna` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `id_registro_importado` int(10) unsigned DEFAULT NULL COMMENT 'Se este registro foi importado, esta coluna armazena a id de origem',
  `tabela_importado` varchar(50) DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL COMMENT 'oracle / postgres',
  `id_jornalista` int(11) DEFAULT NULL,
  `id_apresentador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.contagem_campanha
CREATE TABLE IF NOT EXISTS `contagem_campanha` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano',
  `data_cadastro` datetime DEFAULT NULL COMMENT 'Data de cadastro da campanha',
  `id_campanha` bigint(20) DEFAULT NULL,
  `id_veiculo` int(11) DEFAULT NULL,
  `id_emissora` bigint(20) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL COMMENT 'Data/hora de registro da campanha',
  `segundos_hora_registro` int(10) unsigned DEFAULT NULL COMMENT 'Hora de Registro da campanha / convertido em segundos',
  `valor_referencia` decimal(18,2) DEFAULT NULL,
  `id_operador` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.crawler
CREATE TABLE IF NOT EXISTS `crawler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sentiment` varchar(100) DEFAULT NULL,
  `permalink` varchar(500) DEFAULT NULL,
  `titulo` text,
  `description` text,
  `picture_post` varchar(500) DEFAULT NULL,
  `user_picture` varchar(500) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `social_network` varchar(300) DEFAULT NULL,
  `origin` varchar(50) DEFAULT NULL,
  `identificador` varchar(30) DEFAULT NULL,
  `id_social_network` bigint(20) DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `inserted_at` datetime DEFAULT NULL,
  `id_tag` bigint(20) DEFAULT NULL,
  `json_text` longtext,
  `user_url` varchar(250) DEFAULT NULL,
  `id_configuracao` int(11) DEFAULT NULL,
  `id_crawler_site` int(11) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_tag` (`id_tag`),
  KEY `ix_tag_data` (`id_tag`,`published_at`),
  KEY `ix_origin` (`id_social_network`,`origin`),
  KEY `ix_configuracao` (`id_configuracao`),
  KEY `ix_crawler_site` (`id_crawler_site`),
  KEY `ix_crawler_site_data_cadastro` (`id_crawler_site`,`data_cadastro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.crawler_cliente
CREATE TABLE IF NOT EXISTS `crawler_cliente` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_configuracao` int(10) unsigned DEFAULT NULL,
  `id_crawler` int(10) unsigned DEFAULT NULL,
  `id_cliente` int(10) unsigned DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `palavra_chave` text,
  `published_at` datetime DEFAULT NULL,
  `precisao` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ix_id_configuracao` (`id_configuracao`),
  KEY `ix_id_cliente_data` (`id_cliente`,`data`),
  KEY `ix_id_crawler_data` (`id_crawler`,`data`),
  KEY `ix_published` (`published_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.crawler_configuracao
CREATE TABLE IF NOT EXISTS `crawler_configuracao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(300) DEFAULT NULL,
  `palavras_chave` text,
  `com_twitter` tinyint(1) DEFAULT NULL,
  `com_site` tinyint(1) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `tudo` tinyint(4) DEFAULT NULL,
  `max_id_twitter` varchar(50) DEFAULT NULL,
  `todos` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.crawler_configuracao_associacao
CREATE TABLE IF NOT EXISTS `crawler_configuracao_associacao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_crawler_configuracao` int(11) DEFAULT NULL,
  `id_associacao` int(11) DEFAULT NULL,
  `tabela` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_associacao` (`id_associacao`),
  KEY `ix_id_crawler_configuracao` (`id_crawler_configuracao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.crawler_config_maxids
CREATE TABLE IF NOT EXISTS `crawler_config_maxids` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_crawler_configuracao` int(11) DEFAULT NULL,
  `palavra_chave` varchar(200) DEFAULT NULL,
  `max_id_twitter` varchar(40) DEFAULT NULL,
  `last_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_crawler_configuracao` (`id_crawler_configuracao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.crawler_historico
CREATE TABLE IF NOT EXISTS `crawler_historico` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `id_crawler_configuracao` int(11) DEFAULT NULL,
  `id_registro` int(11) DEFAULT NULL,
  `tabela` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_crawler_configuracao` (`id_crawler_configuracao`),
  KEY `id_crawler_configuracao` (`id_crawler_configuracao`,`id_registro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.crawler_sites
CREATE TABLE IF NOT EXISTS `crawler_sites` (
  `veiculo` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `periodicidade` varchar(255) DEFAULT NULL,
  `feed` varchar(400) DEFAULT NULL,
  `atom` varchar(400) DEFAULT NULL,
  `site` varchar(400) DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ultima_busca` datetime DEFAULT NULL,
  `possivel_feed` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.crawler_tmp
CREATE TABLE IF NOT EXISTS `crawler_tmp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sentiment` varchar(100) DEFAULT NULL,
  `permalink` varchar(500) DEFAULT NULL,
  `titulo` text,
  `description` text,
  `picture_post` varchar(500) DEFAULT NULL,
  `user_picture` varchar(500) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `social_network` varchar(300) DEFAULT NULL,
  `origin` varchar(50) DEFAULT NULL,
  `identificador` varchar(30) DEFAULT NULL,
  `id_social_network` bigint(20) DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `inserted_at` datetime DEFAULT NULL,
  `id_tag` bigint(20) DEFAULT NULL,
  `json_text` longtext,
  `user_url` varchar(250) DEFAULT NULL,
  `id_crawler_site` int(11) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_tag` (`id_tag`),
  KEY `ix_tag_data` (`id_tag`,`published_at`),
  KEY `ix_origin` (`id_social_network`,`origin`),
  KEY `id_crawler_site` (`id_crawler_site`),
  KEY `id_crawler_site_data_cadastro` (`id_crawler_site`,`data_cadastro`),
  FULLTEXT KEY `ix_consulta` (`titulo`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.dicionario_tags
CREATE TABLE IF NOT EXISTS `dicionario_tags` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'TAG',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `tipo` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_tipo_dicionario` (`tipo`),
  FULLTEXT KEY `dic_nome` (`nome`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.dvd_backup
CREATE TABLE IF NOT EXISTS `dvd_backup` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `conteudo` varchar(300) DEFAULT NULL COMMENT 'Conteúdo',
  `observacao` varchar(1000) DEFAULT NULL COMMENT 'Observação',
  `id_tipo` int(11) DEFAULT NULL COMMENT 'Tipo de DVD (Backup ou DVD) [6]',
  `id_emissora` int(11) DEFAULT NULL COMMENT 'Emissora',
  `id_formato` int(11) DEFAULT NULL COMMENT 'Formato [7]',
  `id_midia` int(11) DEFAULT NULL COMMENT 'Mídia [8]',
  `id_qualidade` int(11) DEFAULT NULL COMMENT 'Qualidade [9]',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL COMMENT 'Data',
  `data_inicio` datetime DEFAULT NULL COMMENT 'Data Início',
  `data_fim` datetime DEFAULT NULL COMMENT 'Data Fim',
  `id_registro_importado` int(10) unsigned DEFAULT NULL COMMENT 'ID antigo deste registro no outro sistema',
  `tabela_importado` varchar(100) DEFAULT NULL COMMENT 'Nome da tabela deste registro no sistema antigo',
  `banco_importado` varchar(50) DEFAULT NULL COMMENT '(oracle, postgres)',
  `alias_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `key_id_emissora` (`id_emissora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.editoria
CREATE TABLE IF NOT EXISTS `editoria` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID',
  `ano` smallint(5) unsigned DEFAULT NULL,
  `servidor` smallint(5) unsigned DEFAULT NULL,
  `sequencial` int(10) unsigned DEFAULT NULL,
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `custo_pub` decimal(18,2) DEFAULT NULL COMMENT 'Custo de Publicação (R$)',
  `id_registro_importado` int(10) unsigned DEFAULT NULL,
  `tabela_importado` varchar(50) DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.eleicao_candidato
CREATE TABLE IF NOT EXISTS `eleicao_candidato` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `sigla` varchar(300) DEFAULT NULL COMMENT 'Sigla do partido',
  `numero` int(11) DEFAULT NULL COMMENT 'Número do candidato',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome do candidato',
  `nome_urna` varchar(300) DEFAULT NULL COMMENT 'Nome para exibição da urna',
  `id_partido` int(11) DEFAULT NULL COMMENT 'Partido do candidato',
  `id_coligacao` int(11) DEFAULT NULL COMMENT 'Coligação do candidato',
  `id_praca` int(11) DEFAULT NULL COMMENT 'Praça do candidato',
  `id_cargo` int(11) DEFAULT NULL COMMENT 'Cargo',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_sequencial` (`servidor`,`ano`,`sequencial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.eleicao_coligacao
CREATE TABLE IF NOT EXISTS `eleicao_coligacao` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome da coligação',
  `id_praca` int(11) DEFAULT NULL COMMENT 'Praça',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_sequencial` (`servidor`,`ano`,`sequencial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.eleicao_horario_politico
CREATE TABLE IF NOT EXISTS `eleicao_horario_politico` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `data` date DEFAULT NULL COMMENT 'Data',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome do partido / Coligação',
  `ordem` varchar(20) DEFAULT NULL COMMENT 'Ordem da exibição',
  `id_praca` int(11) DEFAULT NULL COMMENT 'Praça da exibição',
  `id_veiculo` int(11) DEFAULT NULL COMMENT 'Veículo',
  `id_partido` int(11) DEFAULT NULL COMMENT 'Partido',
  `id_coligacao` int(11) DEFAULT NULL COMMENT 'Coligação',
  `tarde_hora_inicio` datetime DEFAULT NULL COMMENT 'Tarde - Hora Início',
  `tarde_hora_fim` datetime DEFAULT NULL COMMENT 'Tarde - Hora fim',
  `noite_hora_inicio` datetime DEFAULT NULL COMMENT 'Tarde - Hora Início',
  `noite_hora_fim` datetime DEFAULT NULL COMMENT 'Tarde - Hora fim',
  `duracao` varchar(30) DEFAULT NULL COMMENT 'Duração',
  `duracao_seg` int(11) DEFAULT NULL COMMENT 'Duração em segundos',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_sequencial` (`servidor`,`ano`,`sequencial`),
  KEY `ix_data` (`data`,`id_veiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.eleicao_insercao_diaria
CREATE TABLE IF NOT EXISTS `eleicao_insercao_diaria` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `data` date DEFAULT NULL COMMENT 'Data',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Sigla do partido',
  `ordem` varchar(20) DEFAULT NULL COMMENT 'Ordem da exibição',
  `posicao_tre` varchar(20) DEFAULT NULL COMMENT 'Posição do TRE',
  `id_praca` int(11) DEFAULT NULL COMMENT 'Praça da exibição',
  `id_veiculo` int(11) DEFAULT NULL COMMENT 'Veículo',
  `id_partido` int(11) DEFAULT NULL COMMENT 'Partido',
  `id_coligacao` int(11) DEFAULT NULL COMMENT 'Coligação',
  `id_cargo` int(11) DEFAULT NULL COMMENT 'Cargo',
  `id_bloco` int(11) DEFAULT NULL COMMENT 'Bloco',
  `duracao` varchar(30) DEFAULT NULL COMMENT 'Duração',
  `duracao_seg` int(11) DEFAULT NULL COMMENT 'Duração em segundos',
  `bloco_hora_inicio` datetime DEFAULT NULL COMMENT 'Bloco - Hora Início',
  `bloco_hora_fim` datetime DEFAULT NULL COMMENT 'Bloco - Hora fim',
  `correta` int(11) DEFAULT NULL COMMENT '1 - Sim, 0 - Não',
  `motivo_nao_correta` int(11) DEFAULT NULL COMMENT 'Motivo para não ter estado correta',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_sequencial` (`servidor`,`ano`,`sequencial`),
  KEY `ix_data` (`data`,`id_veiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.eleicao_partido
CREATE TABLE IF NOT EXISTS `eleicao_partido` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `sigla` varchar(300) DEFAULT NULL COMMENT 'Sigla do partido',
  `numero` int(11) DEFAULT NULL COMMENT 'Número do partido',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_sequencial` (`servidor`,`ano`,`sequencial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.email_avulso
CREATE TABLE IF NOT EXISTS `email_avulso` (
  `id` int(10) unsigned NOT NULL COMMENT 'Id do email avulso',
  `email` varchar(300) DEFAULT NULL COMMENT 'E-mail',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano',
  `id_registro_importado` int(10) unsigned DEFAULT NULL COMMENT 'Se este registro foi importado, esta coluna armazena a id de origem',
  `tabela_importado` varchar(50) DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL COMMENT 'postgres / oracle',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cadastro de email avulso';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.email_cliente
CREATE TABLE IF NOT EXISTS `email_cliente` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(300) DEFAULT NULL COMMENT 'Email',
  `id_cliente` int(10) unsigned DEFAULT NULL COMMENT 'Entidade',
  `contato_email` varchar(300) DEFAULT NULL COMMENT 'Contato',
  `unidade` varchar(20) DEFAULT NULL,
  `status` smallint(5) unsigned DEFAULT NULL COMMENT 'Ativo ou Inativo',
  `senha` varchar(30) DEFAULT NULL,
  `recebe_email` tinyint(4) DEFAULT '1',
  `ver_mensuracao` smallint(6) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ix_email` (`email`(255)),
  KEY `ix_id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.email_entidade
CREATE TABLE IF NOT EXISTS `email_entidade` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID',
  `email` varchar(300) DEFAULT NULL COMMENT 'Email',
  `id_entidade` int(10) unsigned DEFAULT NULL COMMENT 'Entidade',
  `contato_email` varchar(300) DEFAULT NULL COMMENT 'Contato',
  `status` smallint(5) unsigned DEFAULT NULL COMMENT 'Ativo ou Inativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.emissora
CREATE TABLE IF NOT EXISTS `emissora` (
  `id` int(11) NOT NULL DEFAULT '0' COMMENT 'ID',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.emissora_preco
CREATE TABLE IF NOT EXISTS `emissora_preco` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `id_emissora` int(11) DEFAULT NULL COMMENT 'Emissora',
  `hora_inicio` varchar(8) DEFAULT NULL COMMENT 'Hora inicial',
  `hora_fim` varchar(8) DEFAULT NULL COMMENT 'Hora Final',
  `dia_inicio` varchar(10) DEFAULT NULL COMMENT 'Dia inicial',
  `dia_fim` varchar(10) DEFAULT NULL COMMENT 'Dia Final',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `valor` decimal(18,2) DEFAULT NULL COMMENT 'Preço Hora',
  `ano` smallint(5) unsigned DEFAULT NULL,
  `sequencial` int(10) unsigned DEFAULT NULL,
  `ano_referencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_emissora` (`id_emissora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.empresa_ponto
CREATE TABLE IF NOT EXISTS `empresa_ponto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(300) DEFAULT NULL,
  `dados_html` text,
  `padrao` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.endereco
CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int(10) unsigned NOT NULL COMMENT 'ID',
  `ano` smallint(5) unsigned DEFAULT NULL COMMENT 'Ano',
  `servidor` smallint(5) unsigned DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(10) unsigned DEFAULT NULL COMMENT 'Sequencial',
  `id_estado` int(10) unsigned DEFAULT NULL COMMENT 'Estado',
  `id_municipio` int(10) unsigned DEFAULT NULL COMMENT 'Município',
  `cep` varchar(8) DEFAULT NULL COMMENT 'CEP',
  `endereco` varchar(300) DEFAULT NULL COMMENT 'Endereço',
  `complemento` varchar(300) DEFAULT NULL COMMENT 'Complemento',
  `bairro` varchar(300) DEFAULT NULL COMMENT 'Bairro',
  `id_cliente` int(10) unsigned DEFAULT NULL COMMENT 'Cliente',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.entidade
CREATE TABLE IF NOT EXISTS `entidade` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `id_registro_importado` int(10) unsigned DEFAULT NULL COMMENT 'Se este registro foi importado, esta coluna armazena a id de origem',
  `tabela_importado` varchar(50) DEFAULT NULL,
  `login` varchar(30) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.entidade_assoc_entidade
CREATE TABLE IF NOT EXISTS `entidade_assoc_entidade` (
  `id` int(11) NOT NULL,
  `id_entidade_pai` int(11) DEFAULT NULL,
  `id_entidade_filho` int(11) DEFAULT NULL,
  `id_tipo_entidade_pai` int(11) DEFAULT NULL,
  `id_tipo_entidade_filho` int(11) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano',
  PRIMARY KEY (`id`),
  KEY `id_entidade_pai` (`id_entidade_pai`),
  KEY `id_entidade_filho` (`id_entidade_filho`),
  KEY `id_tipo_entidade_pai` (`id_tipo_entidade_pai`),
  KEY `id_tipo_entidade_filho` (`id_tipo_entidade_filho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.entidade_tipo
CREATE TABLE IF NOT EXISTS `entidade_tipo` (
  `id` int(11) NOT NULL,
  `id_entidade` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT 'Status ( Ativo ou Inativo)',
  `servidor` smallint(5) unsigned DEFAULT NULL,
  `ano` smallint(5) unsigned DEFAULT NULL,
  `sequencial` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_entidade` (`id_entidade`),
  KEY `id_tipo` (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.envio_materia
CREATE TABLE IF NOT EXISTS `envio_materia` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Id',
  `id_materia` int(10) unsigned DEFAULT NULL COMMENT 'Id da matéria que faz parte ->tabela materia_radiotv_jornal',
  `data_envio` datetime DEFAULT NULL COMMENT 'Data / Hora do Envio',
  `email_avulso` longtext COMMENT 'Lista de emails avulsos para enviar',
  `seq` int(10) unsigned DEFAULT NULL COMMENT 'Sequencial de quantas vezes a matéria foi enviada',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Registro o envio por email das matérias';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.envio_materia_clientes
CREATE TABLE IF NOT EXISTS `envio_materia_clientes` (
  `id_materia` int(10) unsigned DEFAULT NULL COMMENT 'Id da matéria que faz parte ->tabela materia_radiotv_jornal',
  `id_envio` int(11) NOT NULL DEFAULT '0' COMMENT 'Id que faz parte da tabela envio_materia',
  `id_cliente` int(11) NOT NULL DEFAULT '0' COMMENT 'Id do cliente',
  `tipo_cliente` int(10) unsigned DEFAULT NULL COMMENT 'Indica qual é o tipo do cliente: Cliente -> SubCliente ou Setor',
  PRIMARY KEY (`id_envio`,`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Registra cada cliente no envio de email das materias';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.estado
CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `uf` varchar(2) DEFAULT NULL COMMENT 'UF',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.facebook_chat_ids
CREATE TABLE IF NOT EXISTS `facebook_chat_ids` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `chat_id` varchar(30) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_login_cliente` int(11) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `nome` varchar(300) DEFAULT NULL,
  `texto` text,
  `objeto_usuario` text,
  PRIMARY KEY (`id`),
  KEY `ix_cliente` (`id_cliente`),
  KEY `ix_id_login_cliente` (`id_login_cliente`),
  KEY `ix_chat_id` (`chat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.facebook_webhook_receveid
CREATE TABLE IF NOT EXISTS `facebook_webhook_receveid` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `texto` text,
  `headers` text,
  `lido` smallint(6) DEFAULT '0',
  `data_cadastro` datetime DEFAULT NULL,
  `objeto_usuario` text,
  PRIMARY KEY (`id`),
  KEY `ix_data_cadastro` (`data_cadastro`),
  KEY `ix_lido` (`lido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.filtro_temporario
CREATE TABLE IF NOT EXISTS `filtro_temporario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_cadastro` datetime DEFAULT NULL COMMENT 'Data de Cadastro do filtro',
  `filtro` longtext COMMENT 'Valor do Filtro',
  `usuario` varchar(300) DEFAULT NULL COMMENT 'Usuário que fez uso do mesmo',
  `url` varchar(300) DEFAULT NULL COMMENT 'URL / Quem pediu filtro',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.importacao_ids
CREATE TABLE IF NOT EXISTS `importacao_ids` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_registro_importado` int(11) DEFAULT NULL COMMENT 'Id do registro importado',
  `tabela_importado` varchar(300) DEFAULT NULL COMMENT 'Tabela que foi importada',
  `banco_importado` varchar(300) DEFAULT NULL COMMENT 'Banco que foi importado',
  `tabela_nova` varchar(300) DEFAULT NULL COMMENT 'Tabela onde o registro foi salvo',
  `id_nova_importada` int(11) DEFAULT NULL COMMENT 'Nova id do registro importado',
  PRIMARY KEY (`id`),
  KEY `id_registro_importado` (`id_registro_importado`,`tabela_importado`(255),`banco_importado`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.interacao_materia
CREATE TABLE IF NOT EXISTS `interacao_materia` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `interacao` varchar(50) NOT NULL COMMENT 'Tipo de Interação',
  `origem_interacao` varchar(50) DEFAULT NULL COMMENT 'Origem',
  `tabela_materia` varchar(50) DEFAULT NULL COMMENT 'Tabela Matéria',
  `id_materia` bigint(20) NOT NULL COMMENT 'ID da Matéria',
  `id_cliente_login` bigint(20) NOT NULL COMMENT 'Login de Acesso do Cliente',
  `data_cadastro` datetime DEFAULT NULL,
  `data_materia` datetime DEFAULT NULL,
  `chat_telegram_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_materia` (`id_materia`),
  KEY `ix_id_cliente_login` (`id_cliente_login`),
  KEY `ix_id_materia_cliente_login` (`id_materia`,`id_cliente_login`),
  KEY `ix_red_interacao` (`id_materia`,`id_cliente_login`,`interacao`,`tabela_materia`),
  KEY `ix_data_materia` (`data_materia`,`id_cliente_login`,`interacao`),
  KEY `ix_id_cliente_interacao` (`id_cliente_login`,`interacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.jornalista_apresentador
CREATE TABLE IF NOT EXISTS `jornalista_apresentador` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `id_registro_importado` int(10) unsigned DEFAULT NULL COMMENT 'Se este registro foi importado, esta coluna armazena a id de origem',
  `tabela_importado` varchar(50) DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL COMMENT 'oracle / postgres',
  `login` varchar(30) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL COMMENT 'Apresentador / Jornalista',
  `tx_veiculo` longtext,
  `tx_exibicao` longtext,
  `tx_programa` longtext,
  `influenciador` smallint(6) DEFAULT NULL,
  `nota` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.log
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.login_cliente
CREATE TABLE IF NOT EXISTS `login_cliente` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `login` varchar(50) DEFAULT NULL COMMENT 'Login',
  `senha` varchar(50) DEFAULT NULL COMMENT 'Senha',
  `tipo` varchar(30) DEFAULT NULL COMMENT 'Tipo (Cliente / Parceiro)',
  `ativo` smallint(6) DEFAULT NULL COMMENT 'Status (Ativo / Inativo)',
  `email` varchar(300) DEFAULT NULL COMMENT 'Email',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `modulos` varchar(300) DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT NULL,
  `idtablet` varchar(60) DEFAULT NULL,
  `agrupamento` varchar(40) DEFAULT NULL,
  `email_attc_msg` smallint(6) DEFAULT NULL,
  `cod_cliente` varchar(30) DEFAULT NULL,
  `nome_cliente` varchar(30) DEFAULT NULL,
  `layout_email` varchar(30) DEFAULT NULL,
  `id_exibido` int(11) DEFAULT NULL,
  `id_monitoramento_scup` varchar(30) DEFAULT NULL,
  `feed_configuravel` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.login_cliente_associacoes
CREATE TABLE IF NOT EXISTS `login_cliente_associacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `data_cadastro` datetime DEFAULT NULL COMMENT 'Data Cadastro',
  `id_registro_filho` bigint(20) DEFAULT NULL,
  `id_registro_pai` bigint(20) DEFAULT NULL,
  `id_login_cliente` bigint(20) DEFAULT NULL,
  `tabela_pai` varchar(50) DEFAULT NULL,
  `tabela_filho` varchar(50) DEFAULT NULL,
  `classificacao` varchar(50) DEFAULT NULL,
  `data_materia` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_data` (`data_cadastro`),
  KEY `id_login_cliente` (`id_login_cliente`),
  KEY `ix_classificacao_pai` (`id_registro_pai`,`classificacao`),
  KEY `ix_classificacao_filho` (`id_registro_filho`,`classificacao`),
  KEY `ix_data_cliente` (`id_login_cliente`,`data_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.login_cliente_newsletter
CREATE TABLE IF NOT EXISTS `login_cliente_newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `data` datetime DEFAULT NULL COMMENT 'Data',
  `data_cadastro` datetime DEFAULT NULL COMMENT 'Data Cadastro',
  `enviado` smallint(6) DEFAULT NULL,
  `id_login_cliente` int(11) DEFAULT NULL,
  `detalhes` text,
  `emails_enviado` text,
  `data_envio` datetime DEFAULT NULL COMMENT 'Data Envio',
  `sequencial` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_data` (`data`),
  KEY `ix_login_cliente` (`id_login_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.login_cliente_registros
CREATE TABLE IF NOT EXISTS `login_cliente_registros` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `data_cadastro` datetime DEFAULT NULL COMMENT 'Data Cadastro',
  `nome` varchar(300) DEFAULT NULL,
  `id_login_cliente` int(11) DEFAULT NULL,
  `detalhes` text,
  `tipo` varchar(20) DEFAULT NULL,
  `sequencial` smallint(6) DEFAULT NULL,
  `robo` smallint(6) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ix_data` (`data_cadastro`),
  KEY `ix_login_cliente` (`id_login_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.login_cliente_tablet
CREATE TABLE IF NOT EXISTS `login_cliente_tablet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL COMMENT 'ID DO cliente',
  `tablet` varchar(50) DEFAULT NULL COMMENT 'Identificador do equipamento',
  `chave` varchar(50) DEFAULT NULL COMMENT 'Chave para liberar o equipamento',
  `chave_inf` varchar(50) DEFAULT NULL COMMENT 'Chave Informada para a liberação',
  `status` tinyint(3) unsigned DEFAULT NULL COMMENT 'Status do equipamento',
  `idtablet` varchar(60) DEFAULT NULL,
  `campolivre` varchar(40) DEFAULT NULL COMMENT 'Campo extra - quebra galho',
  `data_cadastro` datetime DEFAULT NULL COMMENT 'Data de Cadastro',
  `modeltablet` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.login_cliente_whatsapp_pool
CREATE TABLE IF NOT EXISTS `login_cliente_whatsapp_pool` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_login_cliente` int(11) DEFAULT NULL,
  `id_materia` bigint(20) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `data_envio` datetime DEFAULT NULL,
  `contatos_envio` text,
  `data_materia` datetime DEFAULT NULL,
  `robo` smallint(6) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_materia` (`id_materia`),
  KEY `id_login_cliente` (`id_login_cliente`,`status`),
  KEY `ix_data_materia` (`data_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.login_cliente_whatsapp_pool_log
CREATE TABLE IF NOT EXISTS `login_cliente_whatsapp_pool_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_login_cliente` int(11) DEFAULT NULL,
  `id_materia` bigint(20) DEFAULT NULL,
  `id_pool` int(11) DEFAULT NULL,
  `id_login_cliente_registro` int(11) DEFAULT NULL,
  `data_envio` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_materia` (`id_materia`,`id_login_cliente_registro`),
  KEY `id_login_cliente` (`id_login_cliente`),
  KEY `ix_data_envio` (`data_envio`),
  KEY `ix_id_login_cliente_data_envio` (`data_envio`,`id_login_cliente_registro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.login_variaveis
CREATE TABLE IF NOT EXISTS `login_variaveis` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_registro` bigint(20) DEFAULT NULL,
  `id_tipo_registro` varchar(10) DEFAULT NULL,
  `nome_tabela` varchar(50) DEFAULT NULL,
  `code` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Parameter Code',
  `value` text CHARACTER SET latin1 COLLATE latin1_general_ci COMMENT 'Parameter Value',
  PRIMARY KEY (`id`),
  KEY `ix_nome_tabela` (`id_registro`,`nome_tabela`),
  KEY `ix_tipo_registro` (`id_registro`,`id_tipo_registro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.log_areacliente
CREATE TABLE IF NOT EXISTS `log_areacliente` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL COMMENT 'Data em que o operador começou a ação (cadastro, edição, exclusão)',
  `id_login` int(11) DEFAULT NULL,
  `tipo_login` varchar(2) DEFAULT NULL,
  `tipo_log` int(11) DEFAULT NULL,
  `descricao` text,
  `id_materia` bigint(20) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `json` text,
  PRIMARY KEY (`id`),
  KEY `inx_id_login` (`id_login`),
  KEY `inx_log_data` (`data`),
  KEY `inx_log_data_tipo` (`data`,`id_login`),
  KEY `ix_tipo_log` (`tipo_log`,`data`),
  KEY `ix_id_materia` (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.log_sincronizar
CREATE TABLE IF NOT EXISTS `log_sincronizar` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tabela` varchar(300) DEFAULT NULL COMMENT 'Tabela do sistema',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `chave` int(11) DEFAULT NULL COMMENT 'Última chave usada desta tabela',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano corrente usado na chave',
  `data` datetime DEFAULT NULL COMMENT 'Data em que foi atualizado a sincronização, na ultima vez.',
  PRIMARY KEY (`id`),
  KEY `ix_chave` (`tabela`(255),`chave`),
  KEY `ix_data` (`data`),
  KEY `ix_chave_ano` (`tabela`(255),`ano`,`chave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Idenfitica, nesta tabela os registros que foram recebidos pr';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.log_tarefador
CREATE TABLE IF NOT EXISTS `log_tarefador` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_tarefador` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `detalhes` longtext,
  PRIMARY KEY (`id`),
  KEY `inx_log_tarefador_localiza` (`id_tarefador`,`id_cliente`,`data`),
  KEY `inx_log_id_tarefador` (`id_tarefador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.log_uso
CREATE TABLE IF NOT EXISTS `log_uso` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL COMMENT 'Data da ação',
  `acao` varchar(30) DEFAULT NULL COMMENT 'E - Entrada, P - Pausa, V - Volta Pausa, S - Saída, E (expiraçao)',
  `id_usuario` int(11) DEFAULT NULL COMMENT 'ID do usuário',
  `nm_usuario` varchar(30) DEFAULT NULL COMMENT 'Nome do Usuário',
  `meu_tipo` varchar(1) DEFAULT NULL,
  `anterior_tipo` varchar(1) DEFAULT NULL,
  `diferenca_anterior_atual` int(11) DEFAULT NULL,
  `intervalo` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inx_loguso_data` (`data`),
  KEY `inx_loguso_idusuariodata` (`data`,`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.log_uso_resumo
CREATE TABLE IF NOT EXISTS `log_uso_resumo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL COMMENT 'Data da ação',
  `tempo` varchar(8) DEFAULT NULL COMMENT 'Tempo',
  `tempo_seg` int(11) DEFAULT NULL COMMENT 'Tempo Segundos',
  `id_usuario` int(11) DEFAULT NULL COMMENT 'ID do usuário',
  `nm_usuario` text COMMENT 'Nome do Usuário',
  `entrada1` datetime DEFAULT NULL,
  `entrada2` datetime DEFAULT NULL,
  `saida1` datetime DEFAULT NULL,
  `saida2` datetime DEFAULT NULL,
  `total_carga_seg` int(11) DEFAULT NULL,
  `total_carga` varchar(12) DEFAULT NULL,
  `inicio_busca` datetime DEFAULT NULL,
  `fim_busca` datetime DEFAULT NULL,
  `id_quadro_horario` int(11) DEFAULT NULL,
  `observacao` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'Trabalhado',
  `manual` smallint(6) DEFAULT '0',
  `ultima_edicao` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inx_loguso_resumo_data` (`data`),
  KEY `ix_id_usuario_data` (`id_usuario`,`data`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.log_utf8
CREATE TABLE IF NOT EXISTS `log_utf8` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `data_inicio` datetime DEFAULT NULL COMMENT 'Data em que o operador começou a ação (cadastro, edição, exclusão)',
  `data_fim` datetime DEFAULT NULL COMMENT 'Data final em que ele acabou de fazer a ação',
  `tempo` int(11) DEFAULT NULL COMMENT 'tempo que levou, o intervalo, em segundos da data inicio e da data final',
  `texto` longtext COMMENT 'Descrição do log',
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


-- Copiando estrutura para tabela midiaclip_producao.materia
CREATE TABLE IF NOT EXISTS `materia` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano',
  `titulo` varchar(300) DEFAULT NULL COMMENT 'Título',
  `resenha` longtext COMMENT 'Observações',
  `data_insert_materia` datetime DEFAULT NULL COMMENT 'Data de cadastro da matéria',
  `data_materia` datetime DEFAULT NULL COMMENT 'Data',
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
  `qtde_exibido` int(11) DEFAULT NULL COMMENT 'Qtde Exibição',
  `indexada` smallint(6) DEFAULT NULL COMMENT 'Indexada ?',
  `id_modulo` int(11) DEFAULT NULL COMMENT 'Módulo do Sistema',
  `id_circuito` int(11) DEFAULT NULL COMMENT 'Circuito',
  `id_registro_importado` int(10) unsigned DEFAULT NULL COMMENT 'Se este registro foi importado, esta coluna armazena a id de origem',
  `tabela_importado` varchar(50) DEFAULT NULL,
  `internet` smallint(5) unsigned DEFAULT '0' COMMENT 'Envia para a internet ?',
  `id_emissora_preco` int(10) unsigned DEFAULT NULL,
  `id_operador` int(10) unsigned DEFAULT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL COMMENT 'postgres / oracle',
  `id_classificacao` int(11) DEFAULT NULL,
  `classificacao` varchar(10) DEFAULT NULL,
  `classificacao_resultado` varchar(10) DEFAULT NULL,
  `data_hora_materia` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_emissora` (`id_emissora`),
  KEY `id_praca` (`id_praca`),
  KEY `id_veiculo` (`id_veiculo`),
  KEY `id_impacto` (`id_impacto`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_exibido` (`id_exibido`),
  KEY `id_faixa_horaria` (`id_faixa_horaria`),
  KEY `id_modulo` (`id_modulo`),
  KEY `fk_materia_circuito` (`id_circuito`),
  KEY `id_registro_importado` (`id_registro_importado`,`tabela_importado`,`banco_importado`),
  KEY `data_materia` (`data_materia`),
  KEY `ix_data_hora_materia` (`data_hora_materia`),
  CONSTRAINT `fk_materia_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `cadastro_basico` (`id`),
  CONSTRAINT `fk_materia_circuito` FOREIGN KEY (`id_circuito`) REFERENCES `cadastro_basico` (`id`),
  CONSTRAINT `fk_materia_exibicao` FOREIGN KEY (`id_exibido`) REFERENCES `cadastro_basico` (`id`),
  CONSTRAINT `fk_materia_faixa_horaria` FOREIGN KEY (`id_faixa_horaria`) REFERENCES `cadastro_basico` (`id`),
  CONSTRAINT `fk_materia_impacto` FOREIGN KEY (`id_impacto`) REFERENCES `cadastro_basico` (`id`),
  CONSTRAINT `fk_materia_praca` FOREIGN KEY (`id_praca`) REFERENCES `cadastro_basico` (`id`),
  CONSTRAINT `fk_veiculo_materia` FOREIGN KEY (`id_veiculo`) REFERENCES `cadastro_fixo` (`id`),
  CONSTRAINT `materia_fk` FOREIGN KEY (`id_emissora`) REFERENCES `emissora` (`id`),
  CONSTRAINT `materia_fk_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `cadastro_fixo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.materia_eleicao
CREATE TABLE IF NOT EXISTS `materia_eleicao` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `ano` smallint(6) DEFAULT NULL COMMENT 'Ano',
  `data_insert_materia` datetime DEFAULT NULL COMMENT 'Data de cadastro da matéria',
  `data_materia` datetime DEFAULT NULL COMMENT 'Data da Matéria',
  `hora_inicio` varchar(8) DEFAULT NULL COMMENT 'Hora Início',
  `hora_fim` varchar(8) DEFAULT NULL COMMENT 'Hora Fim',
  `duracao` varchar(8) DEFAULT NULL COMMENT 'Duração da matéria',
  `duracao_segundos` int(11) DEFAULT NULL COMMENT 'Duração',
  `id_bloco` int(11) DEFAULT NULL COMMENT 'Bloco',
  `id_cargo` int(11) DEFAULT NULL COMMENT 'Cargo',
  `id_coligacao` int(11) DEFAULT NULL COMMENT 'Coligação',
  `id_posicao_tre` int(11) DEFAULT NULL COMMENT 'Posição TRE',
  `titulo` varchar(300) DEFAULT NULL COMMENT 'Título',
  `obs` longtext COMMENT 'Observações',
  `degravacao` longtext COMMENT 'Degravação',
  `id_praca` int(11) DEFAULT NULL COMMENT 'Praça',
  `id_veiculo` int(11) DEFAULT NULL COMMENT 'Veículo',
  `id_emissora` int(11) DEFAULT NULL COMMENT 'Emissora',
  `id_relevancia` int(11) DEFAULT NULL COMMENT 'Reelevância',
  `id_faixa_horaria` int(11) DEFAULT NULL COMMENT 'Exibição',
  `audiencia` double DEFAULT NULL COMMENT 'Audiência',
  `valor_referencia` double DEFAULT NULL COMMENT 'Valor Referência',
  `id_modulo` int(11) DEFAULT NULL COMMENT 'Módulo do Sistema',
  `materia_enviada` datetime DEFAULT NULL COMMENT 'Matéria Enviada',
  `id_emissora_preco` int(11) DEFAULT NULL,
  `id_operador` bigint(20) DEFAULT NULL,
  `id_campanha` int(10) unsigned DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL COMMENT 'Propaganda / Hor Eleitoral',
  `obs_html` longtext,
  `degravacao_html` longtext,
  `status_atual` int(11) DEFAULT NULL COMMENT 'Status atual da matéria',
  `cita_cliente` int(11) DEFAULT NULL COMMENT 'Indica se o cliente é citado ou não, 1 - Sim, 2 - Não',
  `tags` varchar(400) DEFAULT NULL,
  `id_candidato` int(11) DEFAULT NULL COMMENT 'A id do candidato',
  `id_classificacao` int(11) DEFAULT NULL,
  `classificacao` varchar(10) DEFAULT NULL,
  `classificacao_resultado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_emissora` (`id_emissora`),
  KEY `id_praca` (`id_praca`),
  KEY `id_veiculo` (`id_veiculo`),
  KEY `id_faixa_horaria` (`id_faixa_horaria`),
  KEY `id_modulo_2` (`id_modulo`,`data_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.materia_indexador
CREATE TABLE IF NOT EXISTS `materia_indexador` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_materia` bigint(20) DEFAULT NULL,
  `materia_sequencial` int(11) DEFAULT NULL,
  `materia_ano` int(11) DEFAULT NULL,
  `materia_servidor` tinyint(4) DEFAULT NULL,
  `materia_tabela` varchar(50) DEFAULT NULL,
  `data_materia` datetime DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_indexador` bigint(20) DEFAULT NULL,
  `id_tipo_indexador` varchar(10) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `descricao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_sequencia` (`materia_sequencial`,`materia_ano`,`materia_servidor`),
  KEY `ix_indexador_data` (`id_cliente`,`id_indexador`,`data_materia`),
  KEY `ix_id_materia` (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Indexadores para buscar materias';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.materia_jornal
CREATE TABLE IF NOT EXISTS `materia_jornal` (
  `id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Id da matéria que faz parte ->tabela materia_radiotv_jornal',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Dados específicos quando a matéria é Jornal';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.materia_online
CREATE TABLE IF NOT EXISTS `materia_online` (
  `id` bigint(20) unsigned NOT NULL COMMENT 'Id da matéria que faz parte ->tabela materia_radiotv_jornal',
  `id_editoria` int(10) unsigned DEFAULT NULL COMMENT 'Editoria',
  `id_coluna` int(10) unsigned DEFAULT NULL COMMENT 'Coluna',
  `id_jornalista` int(10) unsigned DEFAULT NULL COMMENT 'Jornalista / Colunista',
  `link` varchar(300) DEFAULT NULL COMMENT 'Link Original',
  `id_secao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Matéria OnLine';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.materia_radiotv_jornal
CREATE TABLE IF NOT EXISTS `materia_radiotv_jornal` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
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
  KEY `ix_modulo_data_hora` (`data_hora_materia`,`id_modulo`),
  FULLTEXT KEY `fx_pesquisa` (`titulo`,`sinopse`,`texto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.materia_radiotv_jornal_complemento
CREATE TABLE IF NOT EXISTS `materia_radiotv_jornal_complemento` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Dados específicos quando a matéria é Radio/TV';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.materia_radio_tv
CREATE TABLE IF NOT EXISTS `materia_radio_tv` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
  `id_programa` int(10) unsigned DEFAULT NULL COMMENT 'Programa',
  `id_apresentador` int(10) unsigned DEFAULT NULL COMMENT 'Apresentador',
  `indicar_programa` smallint(5) unsigned DEFAULT NULL COMMENT 'Indicar programação (Sim/Não)',
  `fixar_programacao` smallint(5) unsigned DEFAULT NULL COMMENT 'Fixar programação (Sim/Não)',
  `nr_registro_importado` varchar(30) DEFAULT NULL COMMENT 'Número do registro importado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Dados específicos quando a matéria é Radio/TV';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.meio_comunicacao
CREATE TABLE IF NOT EXISTS `meio_comunicacao` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID',
  `ano` smallint(5) unsigned DEFAULT NULL COMMENT 'Ano',
  `sequencial` int(10) unsigned DEFAULT NULL COMMENT 'Sequencial',
  `servidor` varchar(300) DEFAULT NULL COMMENT 'Servidor',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `codigo` varchar(30) DEFAULT NULL COMMENT 'Código',
  `classificacao` varchar(2) DEFAULT NULL COMMENT 'Classificação',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.mensagem
CREATE TABLE IF NOT EXISTS `mensagem` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_remetente` int(10) unsigned DEFAULT NULL,
  `todos` smallint(5) unsigned DEFAULT NULL COMMENT '0 - Não, 1-Sim >> Indica se todos vao receber msg',
  `titulo` varchar(500) DEFAULT NULL,
  `texto` longtext,
  `data_saida` datetime DEFAULT NULL,
  `id_msg_origem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.mensagem_destino
CREATE TABLE IF NOT EXISTS `mensagem_destino` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_destinatario` int(10) unsigned DEFAULT NULL,
  `data_lida` datetime DEFAULT NULL,
  `id_mensagem` int(11) DEFAULT NULL,
  `nome_destinatario` varchar(300) DEFAULT NULL,
  `arquivada` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_destinatario` (`id_destinatario`),
  KEY `ix_id_mensagem` (`id_mensagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `funcionalidade` varchar(100) DEFAULT NULL COMMENT 'Funcionalidade',
  `pagina` varchar(50) DEFAULT NULL COMMENT 'Página que direcionará o menu',
  `id_item_pai` int(11) DEFAULT NULL COMMENT 'Item Pai (não obrigatório)',
  `nivel` varchar(50) DEFAULT NULL,
  `modulos` varchar(30) DEFAULT NULL COMMENT 'Módulos em que esse item pode aparece no sistema',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.modelo_email
CREATE TABLE IF NOT EXISTS `modelo_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_cadastro` datetime DEFAULT NULL,
  `titulo` varchar(300) DEFAULT NULL,
  `texto` longtext,
  `ano` smallint(5) unsigned DEFAULT NULL,
  `sequencial` int(10) unsigned DEFAULT NULL,
  `servidor` smallint(5) unsigned DEFAULT NULL,
  `texto2` longtext,
  `padrao` tinyint(3) unsigned DEFAULT NULL COMMENT '0 Não é padrão, 1 - É padrão',
  `id_veiculo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.municipio
CREATE TABLE IF NOT EXISTS `municipio` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID',
  `id_estado` int(10) unsigned DEFAULT NULL COMMENT 'Estado',
  `uf` varchar(2) DEFAULT NULL COMMENT 'UF',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `paises` text COLLATE latin1_general_ci,
  `emails` text COLLATE latin1_general_ci,
  `assinantes` text COLLATE latin1_general_ci,
  `texto` text COLLATE latin1_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Exportação de dados foi desmarcado.


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Application parameters by item';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.parametros_configuracao
CREATE TABLE IF NOT EXISTS `parametros_configuracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) DEFAULT NULL COMMENT 'Código do parâmetro',
  `valor` varchar(300) DEFAULT NULL COMMENT 'Valor do parâmetro',
  `titulo` varchar(300) DEFAULT NULL COMMENT 'Título do parâmetro',
  PRIMARY KEY (`id`),
  KEY `ix_codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Aqui ficam configurações utilizadas pelo sistema.';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.perfil_processos
CREATE TABLE IF NOT EXISTS `perfil_processos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_processo` int(11) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `acao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.preco_auxiliar
CREATE TABLE IF NOT EXISTS `preco_auxiliar` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
  `ano` smallint(5) unsigned DEFAULT NULL,
  `sequencial` int(10) unsigned DEFAULT NULL,
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `preco_txt` longtext COMMENT 'Preco',
  `valor` decimal(18,2) DEFAULT NULL COMMENT 'Preço - Valor',
  `id_registro_pai` bigint(20) DEFAULT NULL COMMENT 'Registro pai (Revista, Editoria)',
  `tipo_registro_pai` varchar(50) DEFAULT NULL COMMENT 'Tipo do registro pai: Revista, Editoria',
  PRIMARY KEY (`id`),
  KEY `inx_id_tipo` (`id_registro_pai`,`tipo_registro_pai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.programa
CREATE TABLE IF NOT EXISTS `programa` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.quadro_aviso
CREATE TABLE IF NOT EXISTS `quadro_aviso` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID',
  `ano` smallint(5) unsigned DEFAULT NULL,
  `servidor` smallint(5) unsigned DEFAULT NULL,
  `sequencial` int(10) unsigned DEFAULT NULL,
  `de_usuario_id` int(10) unsigned DEFAULT NULL,
  `para_usuario_id` int(10) unsigned DEFAULT NULL,
  `mensagem` longtext COMMENT 'MENSAGEM',
  `data_envio` datetime DEFAULT NULL COMMENT 'DATA_ENVIO',
  `id_registro_importado` int(10) unsigned DEFAULT NULL,
  `tabela_importado` varchar(50) DEFAULT NULL,
  `banco_importado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_importacao` (`id_registro_importado`,`tabela_importado`,`banco_importado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.quadro_horario
CREATE TABLE IF NOT EXISTS `quadro_horario` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `titulo` varchar(200) DEFAULT NULL COMMENT 'Título',
  `entrada1` varchar(8) DEFAULT NULL COMMENT 'Hora de Início turno1',
  `saida1` varchar(8) DEFAULT NULL COMMENT 'Saída turno1',
  `entrada2` varchar(8) DEFAULT NULL COMMENT 'Hora de Início turno2',
  `saida2` varchar(8) DEFAULT NULL COMMENT 'Saída turno2',
  `entrada_intervalo` varchar(8) DEFAULT NULL COMMENT 'Hora de Início Intervalo',
  `saida_intervalo` varchar(8) DEFAULT NULL COMMENT 'Hora Fim Intervalo',
  `entrada1_seg` int(11) DEFAULT NULL,
  `entrada2_seg` int(11) DEFAULT NULL,
  `saida1_seg` int(11) DEFAULT NULL,
  `saida2_seg` int(11) DEFAULT NULL,
  `entrada_intervalo_seg` int(11) DEFAULT NULL,
  `saida_intervalo_seg` int(11) DEFAULT NULL,
  `forma_contagem` varchar(30) NOT NULL COMMENT 'Forma de contagem sobre tempo',
  `tempo_sessao` smallint(6) DEFAULT NULL COMMENT 'Tempo Ses Max',
  `uso_maximo` varchar(8) DEFAULT NULL COMMENT 'Uso máximo no sistema',
  `tempo_total_seg` int(10) unsigned DEFAULT NULL,
  `tempo_tolerancia` varchar(30) DEFAULT NULL COMMENT 'Tolerância',
  `tolerancia_seg` int(10) unsigned DEFAULT NULL,
  `tempo_tolerancia_calculo` varchar(30) DEFAULT NULL,
  `tempo_tolerancia_calculo_seg` smallint(6) DEFAULT NULL,
  `forca_intervalo` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Quadro Horários';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.regioes_veiculo
CREATE TABLE IF NOT EXISTS `regioes_veiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uf` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nome` varchar(300) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.release_cliente
CREATE TABLE IF NOT EXISTS `release_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `id_login_cadastro` int(11) DEFAULT NULL,
  `id_tipo_usuario_cadastro` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `texto` text COLLATE utf8_unicode_ci,
  `titulo` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `obs` text COLLATE utf8_unicode_ci,
  `status` smallint(6) DEFAULT NULL,
  `numeracao` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `ids_clientes` text COLLATE utf8_unicode_ci,
  `assunto` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apelido` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_login` (`id_login_cadastro`),
  KEY `ix_data` (`data`),
  KEY `ix_sequencial_ano` (`sequencial`,`ano`),
  KEY `ix_sequencial_ano_login_cadastro` (`sequencial`,`id_login_cadastro`,`id_tipo_usuario_cadastro`,`ano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.release_cliente_associacao
CREATE TABLE IF NOT EXISTS `release_cliente_associacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_registro` bigint(20) DEFAULT NULL,
  `tabela` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_release` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_registro_tabela` (`tabela`,`id_registro`),
  KEY `id_release` (`id_release`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.secao
CREATE TABLE IF NOT EXISTS `secao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(300) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `servidor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.serializator
CREATE TABLE IF NOT EXISTS `serializator` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `data_cadastro` datetime DEFAULT NULL COMMENT 'Data de Cadastro do filtro',
  `data_value` longtext COMMENT 'Valor dos Dados',
  `data_type` varchar(300) DEFAULT NULL COMMENT 'Tipo do Valor',
  `variableName` varchar(300) DEFAULT NULL COMMENT 'Nome da variable',
  `pageGuid` varchar(400) DEFAULT NULL COMMENT 'pageGuid',
  `pageGuid2` varchar(5) DEFAULT NULL COMMENT 'pageGuid2',
  `user_name` varchar(300) DEFAULT NULL COMMENT 'Usuário que fez uso do mesmo',
  `id_user` int(11) DEFAULT NULL COMMENT 'ID do usuário',
  `url` varchar(300) DEFAULT NULL COMMENT 'URL / Quem pediu filtro',
  PRIMARY KEY (`id`),
  KEY `dt_filtro_temporario` (`data_cadastro`),
  KEY `ix_id_user_variable` (`id_user`,`variableName`,`data_cadastro`),
  KEY `ix_id_user` (`id_user`),
  KEY `ix_todos` (`id_user`,`variableName`,`url`,`pageGuid2`,`data_cadastro`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.server_ftp
CREATE TABLE IF NOT EXISTS `server_ftp` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
  `data_cadastro` datetime DEFAULT NULL COMMENT 'Data de cadastro do arquivo',
  `ano` smallint(5) unsigned DEFAULT NULL,
  `servidor` smallint(6) DEFAULT NULL COMMENT 'Servidor',
  `sequencial` int(11) DEFAULT NULL COMMENT 'Sequencial',
  `nome_servidor` varchar(100) DEFAULT NULL COMMENT 'Nome do Servidor',
  `ip_ftp` varchar(50) DEFAULT NULL COMMENT 'Ip do servidor',
  `user_ftp` varchar(50) DEFAULT NULL COMMENT 'Usuário FTP',
  `senha_ftp` varchar(50) DEFAULT NULL COMMENT 'Senha FTP',
  `porta_ftp` varchar(50) DEFAULT NULL COMMENT 'Porta FTP',
  `pasta_ftp` varchar(300) DEFAULT NULL COMMENT 'Pasta origem do FTP',
  PRIMARY KEY (`id`),
  KEY `id_materia` (`servidor`,`ano`,`sequencial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.servidor_transcricao
CREATE TABLE IF NOT EXISTS `servidor_transcricao` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `url` varchar(300) DEFAULT NULL,
  `nome` varchar(300) DEFAULT NULL,
  `licencas` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Servidor de Transcrição';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.sintese_descritiva
CREATE TABLE IF NOT EXISTS `sintese_descritiva` (
  `id` bigint(20) NOT NULL,
  `servidor` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `topico` varchar(300) DEFAULT NULL,
  `texto` longtext,
  `id_entidade` int(11) DEFAULT NULL,
  `id_tipo_entidade` int(11) DEFAULT NULL,
  `id_exibicao` int(11) DEFAULT NULL,
  `id_veiculo` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  `prioridade` int(10) unsigned DEFAULT NULL,
  `cadastrado_por` varchar(300) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inxdata_inicio` (`data_inicio`),
  KEY `inxdata_fim` (`data_fim`),
  KEY `id_entidade` (`id_entidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.tarefador
CREATE TABLE IF NOT EXISTS `tarefador` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nome` varchar(300) DEFAULT NULL COMMENT 'Nome',
  `data_cadastro` datetime DEFAULT NULL,
  `data_ultimo_envio` datetime DEFAULT NULL,
  `id_modulo` varchar(30) DEFAULT NULL,
  `EnviarPara` varchar(40) DEFAULT NULL,
  `p1` varchar(20) DEFAULT NULL,
  `p2` varchar(20) DEFAULT NULL,
  `p3` varchar(20) DEFAULT NULL,
  `p4` varchar(20) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `statusMat` varchar(20) DEFAULT NULL,
  `enviarPorEmail` varchar(20) DEFAULT NULL,
  `texto` varchar(300) DEFAULT NULL,
  `hora_inicio` varchar(8) DEFAULT NULL,
  `hora_inicio_seg` int(11) DEFAULT NULL,
  `hora_fim` varchar(8) DEFAULT NULL,
  `hora_fim_seg` int(11) DEFAULT NULL,
  `so_citacao_direta` smallint(6) DEFAULT NULL,
  `marcacao` varchar(10) DEFAULT NULL,
  `ativo` smallint(6) DEFAULT NULL,
  `hora_envio` varchar(8) DEFAULT NULL,
  `hora_envio_seg` int(11) DEFAULT NULL,
  `tarefa_envio_semana` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_cliente` (`id_cliente`),
  KEY `ix_id_cliente_hora_inicio_seg` (`id_cliente`,`hora_inicio_seg`),
  KEY `ix_cliente_data_fim_seg` (`hora_fim_seg`),
  KEY `ix_data_envio_seg` (`hora_envio_seg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tarefador Email';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.tb_estados
CREATE TABLE IF NOT EXISTS `tb_estados` (
  `id` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `uf` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nome` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `regioes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `regioes_id` (`regioes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.telegram_chat_ids
CREATE TABLE IF NOT EXISTS `telegram_chat_ids` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `chat_id` varchar(30) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `nome` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_cliente` (`id_cliente`),
  KEY `ix_chat_id` (`chat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.tipo_cadastro_fixo
CREATE TABLE IF NOT EXISTS `tipo_cadastro_fixo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) DEFAULT NULL COMMENT 'Descrição',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.triagem_dados
CREATE TABLE IF NOT EXISTS `triagem_dados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `origem` varchar(40) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `valor` text,
  `id_registro` bigint(20) DEFAULT NULL,
  `tabela` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_origem` (`origem`),
  KEY `ix_id_registro` (`id_registro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.triagem_materia
CREATE TABLE IF NOT EXISTS `triagem_materia` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dataconteudo` datetime DEFAULT NULL COMMENT 'Data Conteúdo',
  `titulo` varchar(500) DEFAULT NULL COMMENT 'TíTulo',
  `autor` varchar(300) DEFAULT NULL COMMENT 'Autor',
  `palavra` varchar(300) DEFAULT NULL COMMENT 'Palavra',
  `fonte` varchar(300) DEFAULT NULL COMMENT 'Fonte',
  `texto` text COMMENT 'Texto',
  `url` varchar(600) DEFAULT NULL COMMENT 'URL',
  `palavras` varchar(300) DEFAULT NULL COMMENT 'Palavras',
  `meio` varchar(300) DEFAULT NULL COMMENT 'Meio de Comunicação',
  `estado` varchar(100) DEFAULT NULL COMMENT 'Estado',
  `codigoveiculo` varchar(30) DEFAULT NULL COMMENT 'CodigoVeiculo',
  `uf` varchar(30) DEFAULT NULL COMMENT 'UF',
  `anexo` varchar(600) DEFAULT NULL COMMENT 'Anexo',
  `idioma` varchar(6) DEFAULT NULL COMMENT 'Idioma',
  `origem_materia` varchar(30) DEFAULT NULL COMMENT 'Origem desta materia',
  `dados_cruzados` text COMMENT 'Cruz de dados',
  `dados_cruzados_desc` text COMMENT 'Descrição cruzamento dados',
  `fase_triagem` int(11) DEFAULT NULL COMMENT 'Fase: 0,1',
  `serial` bigint(20) DEFAULT NULL,
  `metadata` text,
  `id_materia_radiotv_jornal` bigint(20) unsigned DEFAULT NULL,
  `id_modulo` int(10) unsigned DEFAULT NULL,
  `arquivo_importado` int(11) DEFAULT NULL,
  `serial_txt` varchar(30) DEFAULT NULL,
  `data_insert` datetime DEFAULT NULL,
  `json_serials` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_data_triagem` (`dataconteudo`),
  KEY `ix_serial` (`serial`,`origem_materia`),
  KEY `ix_materia_radiotv_jornal` (`id_materia_radiotv_jornal`),
  KEY `ix_triagem_materia_arquivo_importado` (`origem_materia`,`arquivo_importado`),
  KEY `ix_serial_txt` (`serial_txt`,`origem_materia`),
  KEY `ix_data_insert` (`data_insert`,`origem_materia`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.triagem_materia_arquivo
CREATE TABLE IF NOT EXISTS `triagem_materia_arquivo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ano` smallint(6) DEFAULT NULL,
  `mes` smallint(6) DEFAULT NULL,
  `id_triagem` int(11) DEFAULT NULL,
  `arquivo` text,
  `tipo` varchar(100) DEFAULT NULL,
  `duracao` varchar(200) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_id_triagem` (`id_triagem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.triagem_materia_bug
CREATE TABLE IF NOT EXISTS `triagem_materia_bug` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dataconteudo` datetime DEFAULT NULL COMMENT 'Data Conteúdo',
  `titulo` varchar(300) DEFAULT NULL COMMENT 'TíTulo',
  `autor` varchar(300) DEFAULT NULL COMMENT 'Autor',
  `palavra` varchar(300) DEFAULT NULL COMMENT 'Palavra',
  `fonte` varchar(300) DEFAULT NULL COMMENT 'Fonte',
  `texto` longtext COMMENT 'Texto',
  `url` varchar(300) DEFAULT NULL COMMENT 'URL',
  `palavras` varchar(300) DEFAULT NULL COMMENT 'Palavras',
  `meio` varchar(300) DEFAULT NULL COMMENT 'Meio de Comunicação',
  `estado` varchar(100) DEFAULT NULL COMMENT 'Estado',
  `codigoveiculo` varchar(30) DEFAULT NULL COMMENT 'CodigoVeiculo',
  `uf` varchar(30) DEFAULT NULL COMMENT 'UF',
  `anexo` varchar(300) DEFAULT NULL COMMENT 'Anexo',
  `idioma` varchar(6) DEFAULT NULL COMMENT 'Idioma',
  `origem_materia` varchar(30) DEFAULT NULL COMMENT 'Origem desta materia',
  `dados_cruzados` text COMMENT 'Cruz de dados',
  `dados_cruzados_desc` text COMMENT 'Descrição cruzamento dados',
  `fase_triagem` int(11) DEFAULT NULL COMMENT 'Fase: 0,1',
  `serial` bigint(20) DEFAULT NULL,
  `metadata` longtext COMMENT 'Texto',
  `id_materia_radiotv_jornal` bigint(20) unsigned DEFAULT NULL,
  `id_modulo` int(10) unsigned DEFAULT NULL,
  `arquivo_importado` int(11) DEFAULT NULL,
  `serial_txt` varchar(30) DEFAULT NULL,
  `data_insert` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_data_triagem` (`dataconteudo`),
  KEY `ix_serial` (`serial`,`origem_materia`),
  KEY `ix_materia_radiotv_jornal` (`id_materia_radiotv_jornal`),
  KEY `ix_triagem_materia_arquivo_importado` (`origem_materia`,`arquivo_importado`),
  KEY `ix_serial_txt` (`serial_txt`,`origem_materia`),
  KEY `ix_data_insert` (`data_insert`,`origem_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.triagem_materia_utf8
CREATE TABLE IF NOT EXISTS `triagem_materia_utf8` (
  `id` int(10) unsigned NOT NULL,
  `texto` longtext,
  `json` longtext,
  `json_extra` longtext,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_data` (`data_cadastro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.usuario_perfil
CREATE TABLE IF NOT EXISTS `usuario_perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela midiaclip_producao.usuario_tempo
CREATE TABLE IF NOT EXISTS `usuario_tempo` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `id_perfil` int(11) DEFAULT NULL COMMENT 'Perfil',
  `id_login_cliente` int(11) DEFAULT NULL COMMENT 'Login',
  `forma_contagem` varchar(30) NOT NULL COMMENT 'Forma de contagem sobre tempo',
  `hora_inicio` varchar(8) DEFAULT NULL COMMENT 'Hora de Início permitida',
  `hora_fim` varchar(8) DEFAULT NULL COMMENT 'Hora Fim permitida',
  `tempo_sessao` smallint(6) DEFAULT NULL COMMENT 'Tempo Ses Max',
  `uso_maximo` varchar(8) DEFAULT NULL COMMENT 'Uso máximo no sistema',
  `hora_inicio_seg` int(11) DEFAULT NULL,
  `hora_fim_seg` int(11) DEFAULT NULL,
  `uso_maximo_seg` int(11) DEFAULT NULL,
  `servidor` smallint(6) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `sequencial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Armazena dados sobre tempo';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para view midiaclip_producao.vw_login_acesso
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `vw_login_acesso` (
	`id` INT(11) UNSIGNED NOT NULL,
	`email` VARCHAR(300) NULL COLLATE 'utf8_general_ci',
	`id_cliente` INT(10) UNSIGNED NULL,
	`nome` VARCHAR(300) NULL COLLATE 'utf8_general_ci',
	`senha` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`login` VARCHAR(300) NULL COLLATE 'utf8_general_ci',
	`status` BIGINT(20) UNSIGNED NULL,
	`cadastro_tipo` VARCHAR(1) NOT NULL COLLATE 'utf8mb4_general_ci',
	`modulos` VARCHAR(300) NULL COLLATE 'utf8_general_ci',
	`id_monitoramento_scup` VARCHAR(30) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;


-- Copiando estrutura para view midiaclip_producao.vw_login_acesso
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
