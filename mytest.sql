-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.19 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para mytest
CREATE DATABASE IF NOT EXISTS `mytest` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mytest`;

-- Copiando estrutura para tabela mytest.myt_usr
CREATE TABLE IF NOT EXISTS `myt_usr` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_nome` varchar(255) NOT NULL DEFAULT '0',
  `usr_usuario` varchar(50) NOT NULL DEFAULT '0',
  `usr_email` varchar(100) NOT NULL DEFAULT '0',
  `usr_senha` varchar(50) NOT NULL DEFAULT '0',
  `usr_status` int(1) NOT NULL DEFAULT '0',
  `usr_foto` varchar(500) NOT NULL DEFAULT '0',
  `usr_hash` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `usr_usuario` (`usr_usuario`),
  UNIQUE KEY `usr_email` (`usr_email`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mytest.myt_usr: 0 rows
DELETE FROM `myt_usr`;
/*!40000 ALTER TABLE `myt_usr` DISABLE KEYS */;
/*!40000 ALTER TABLE `myt_usr` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
