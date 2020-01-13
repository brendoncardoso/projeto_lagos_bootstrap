-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.37-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              10.2.0.5769
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para lagosrio_sistema
CREATE DATABASE IF NOT EXISTS `lagosrio_sistema` /*!40100 DEFAULT CHARACTER SET utf32 */;
USE `lagosrio_sistema`;

-- Copiando estrutura para tabela lagosrio_sistema.cargos
CREATE TABLE IF NOT EXISTS `cargos` (
  `id_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `id_nivel` int(11) NOT NULL DEFAULT '0',
  `cargo` varchar(120) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cargo`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.cms
CREATE TABLE IF NOT EXISTS `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_historia` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.cms_img_noticia
CREATE TABLE IF NOT EXISTS `cms_img_noticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_noticia` int(11) NOT NULL,
  `img_noticia` longtext NOT NULL,
  `img_extesao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_noticia` (`id_noticia`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.cms_logo
CREATE TABLE IF NOT EXISTS `cms_logo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_logo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_logo` (`id_logo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.cms_slides
CREATE TABLE IF NOT EXISTS `cms_slides` (
  `id_img` int(11) NOT NULL AUTO_INCREMENT,
  `extensao` text NOT NULL,
  `nome_imagem` text NOT NULL,
  PRIMARY KEY (`id_img`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.compras
CREATE TABLE IF NOT EXISTS `compras` (
  `id_compra` int(10) NOT NULL AUTO_INCREMENT,
  `id_unidade` int(10) DEFAULT NULL,
  `numero` varchar(255) CHARACTER SET latin1 NOT NULL,
  `proc_adm` varchar(255) CHARACTER SET latin1 NOT NULL,
  `licenciatorio` varchar(255) CHARACTER SET latin1 NOT NULL,
  `data_ini` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  `edital` varchar(250) CHARACTER SET latin1 NOT NULL,
  `observacao` text,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 - aberto, 0 - fechado',
  PRIMARY KEY (`id_compra`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.curriculos
CREATE TABLE IF NOT EXISTS `curriculos` (
  `id_curriculo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) DEFAULT NULL,
  `telefone` bigint(20) unsigned DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `cargo` int(11) unsigned DEFAULT NULL,
  `id_unidade` int(11) unsigned DEFAULT NULL,
  `arquivo_curriculo` varchar(250) DEFAULT NULL,
  `data_reg` date DEFAULT NULL,
  `data_alterada` date DEFAULT NULL,
  PRIMARY KEY (`id_curriculo`)
) ENGINE=MyISAM AUTO_INCREMENT=21181 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.editalpessoal
CREATE TABLE IF NOT EXISTS `editalpessoal` (
  `id_editalpessoal` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_unidade` int(10) unsigned NOT NULL DEFAULT '0',
  `num_edital` varchar(150) NOT NULL,
  `num_proc_adm` varchar(150) CHARACTER SET latin1 NOT NULL,
  `data_ini` datetime NOT NULL,
  `data_fim` datetime NOT NULL,
  `observacao` text CHARACTER SET latin1 NOT NULL,
  `edital` varchar(200) NOT NULL,
  `anexos` int(5) unsigned NOT NULL DEFAULT '0',
  `prorrogado` int(1) unsigned NOT NULL DEFAULT '0',
  `antigo` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_editalpessoal`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.editalpessoal_cargos
CREATE TABLE IF NOT EXISTS `editalpessoal_cargos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_edital` int(10) unsigned NOT NULL,
  `id_cargo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1065 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.edital_prorrogacoes
CREATE TABLE IF NOT EXISTS `edital_prorrogacoes` (
  `id_prorrogacao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_pessoal` int(10) unsigned DEFAULT NULL,
  `id_compras` int(10) unsigned DEFAULT NULL,
  `data_fim_ant` datetime DEFAULT NULL COMMENT 'data fim original',
  `data_fim` datetime NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_prorrogacao`),
  KEY `id_pessoal` (`id_pessoal`),
  KEY `id_compras` (`id_compras`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `id_edital` int(11) NOT NULL DEFAULT '0',
  `nome` varchar(250) NOT NULL DEFAULT '',
  `razao` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `cnpj` varchar(18) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `im` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `ie` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `email` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.empresas_prestador
CREATE TABLE IF NOT EXISTS `empresas_prestador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_empresa` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf32;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.escala
CREATE TABLE IF NOT EXISTS `escala` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_unidade` int(11) unsigned NOT NULL,
  `nome_unidade` varchar(100) NOT NULL,
  `setor` varchar(30) NOT NULL,
  `dia_da_semana` varchar(20) NOT NULL,
  `carga_horaria` varchar(20) NOT NULL,
  `mes` tinyint(2) NOT NULL,
  `ano` year(4) NOT NULL,
  `profissional` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `unidade_id` (`id_unidade`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.fale_conosco
CREATE TABLE IF NOT EXISTS `fale_conosco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(500) NOT NULL,
  `data_nascimento` varchar(10) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.fale_conosco_mensagens
CREATE TABLE IF NOT EXISTS `fale_conosco_mensagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(500) NOT NULL,
  `mensagem` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.niveis
CREATE TABLE IF NOT EXISTS `niveis` (
  `id_nivel` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  PRIMARY KEY (`id_nivel`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.noticias
CREATE TABLE IF NOT EXISTS `noticias` (
  `id_noticia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) NOT NULL,
  `subtitulo` varchar(250) DEFAULT NULL,
  `texto` longtext NOT NULL,
  `data` datetime NOT NULL,
  `fonte` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `status_img` tinyint(1) NOT NULL DEFAULT '0',
  `prioridade` int(11) NOT NULL,
  PRIMARY KEY (`id_noticia`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.ouvidoria
CREATE TABLE IF NOT EXISTS `ouvidoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(500) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.ouvidoria_mensagem
CREATE TABLE IF NOT EXISTS `ouvidoria_mensagem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(500) NOT NULL,
  `assunto` varchar(500) NOT NULL,
  `mensagem` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.pasta
CREATE TABLE IF NOT EXISTS `pasta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(500) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0=desativado, 1=ativado, 2=uso',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf32;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.pessoa
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id_pessoa` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_edital` int(11) unsigned NOT NULL DEFAULT '0',
  `id_cargo` int(11) unsigned NOT NULL DEFAULT '0',
  `id_unidade` int(11) unsigned NOT NULL DEFAULT '0',
  `id_nivel` int(11) unsigned NOT NULL DEFAULT '0',
  `nome` varchar(120) NOT NULL DEFAULT '',
  `telefone` varchar(14) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `anexo` varchar(120) NOT NULL DEFAULT '',
  `data` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deficiente` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_pessoa`)
) ENGINE=MyISAM AUTO_INCREMENT=82398 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.pessoa_cargo
CREATE TABLE IF NOT EXISTS `pessoa_cargo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(10) unsigned NOT NULL,
  `id_cargo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69255 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.ponto
CREATE TABLE IF NOT EXISTS `ponto` (
  `id_ponto` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_unidade` int(11) unsigned NOT NULL,
  `competencia` date NOT NULL,
  `enviado_em` datetime NOT NULL,
  `enviado_por` int(11) unsigned DEFAULT NULL,
  `nome_arquivo` varchar(250) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_ponto`)
) ENGINE=MyISAM AUTO_INCREMENT=1175 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.prestacao_categoria1
CREATE TABLE IF NOT EXISTS `prestacao_categoria1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pasta` int(11) NOT NULL DEFAULT '0',
  `arquivo` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_pasta` (`id_pasta`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf32;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.prestacao_categoria2
CREATE TABLE IF NOT EXISTS `prestacao_categoria2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pasta` int(11) NOT NULL DEFAULT '0',
  `nome_arquivo` varchar(200) NOT NULL,
  `arquivo` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_pasta` (`id_pasta`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf32;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.prestacao_categoria3
CREATE TABLE IF NOT EXISTS `prestacao_categoria3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pasta` int(11) NOT NULL DEFAULT '0',
  `id_unidade` int(11) NOT NULL DEFAULT '0',
  `id_empresa` int(11) NOT NULL DEFAULT '0',
  `nome_arquivo` varchar(200) NOT NULL,
  `arquivo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pasta` (`id_pasta`),
  KEY `id_unidade` (`id_unidade`),
  KEY `id_empresa` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf32;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.relatorio
CREATE TABLE IF NOT EXISTS `relatorio` (
  `id_execucao` int(11) NOT NULL AUTO_INCREMENT,
  `id_unidade` int(11) NOT NULL DEFAULT '0',
  `mes` int(2) NOT NULL DEFAULT '0',
  `ano` int(4) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `tipo` int(2) NOT NULL COMMENT '1 = Execução, 2 = Anual',
  `subtipo` int(2) NOT NULL COMMENT '1 = Relatório, 2 = Balancete, 3 = Inventário',
  PRIMARY KEY (`id_execucao`)
) ENGINE=MyISAM AUTO_INCREMENT=1066 DEFAULT CHARSET=latin1 COMMENT='Tabela criada para exibição dos relatórios de execução dentro do Portal de Transparência no site.';

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.unidades
CREATE TABLE IF NOT EXISTS `unidades` (
  `id_unidade` int(11) NOT NULL AUTO_INCREMENT,
  `cod_unidade` varchar(50) DEFAULT NULL,
  `nome` varchar(150) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `endereco` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `bairro` varchar(200) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `cidade` varchar(150) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `uf` char(2) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `cep` char(9) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `unidade_padrao` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0',
  `diretorio` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_unidade`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.unidades_cargos
CREATE TABLE IF NOT EXISTS `unidades_cargos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_unidade` int(10) unsigned NOT NULL,
  `id_cargo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_unidade` (`id_unidade`),
  KEY `id_cargo` (`id_cargo`)
) ENGINE=MyISAM AUTO_INCREMENT=623 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.upa_usuarios
CREATE TABLE IF NOT EXISTS `upa_usuarios` (
  `id_upa_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_unidade` int(10) unsigned NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cpf` bigint(11) unsigned zerofill NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_upa_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela lagosrio_sistema.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usu_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_unidade` int(11) unsigned NOT NULL,
  `login` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `senha` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `setor` smallint(1) unsigned NOT NULL DEFAULT '1',
  `status` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`usu_id`),
  KEY `id_unidade` (`id_unidade`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
