CREATE DATABASE  IF NOT EXISTS `etg` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `etg`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: etg2
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cadastro_checklist`
--

DROP TABLE IF EXISTS `cadastro_checklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cadastro_checklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cadastro_checklist`
--

LOCK TABLES `cadastro_checklist` WRITE;
/*!40000 ALTER TABLE `cadastro_checklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `cadastro_checklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cadastro_perfil`
--

DROP TABLE IF EXISTS `cadastro_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cadastro_perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `gerenciar_checklist` enum('0','1') DEFAULT NULL,
  `gerenciar_salas` enum('0','1') DEFAULT NULL,
  `gerenciar_usuarios` enum('0','1') DEFAULT NULL,
  `gerenciar_perfis` enum('0','1') DEFAULT NULL,
  `gerenciar_notificacoes` enum('0','1') DEFAULT NULL,
  `gerenciar_recados` enum('0','1') DEFAULT NULL,
  `realizar_acao_corretiva` enum('0','1') DEFAULT NULL,
  `realizar_checklist` enum('0','1') DEFAULT NULL,
  `gerenciar_perguntas` enum('0','1') DEFAULT NULL,
  `ver_relatorios` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cadastro_perfil`
--

LOCK TABLES `cadastro_perfil` WRITE;
/*!40000 ALTER TABLE `cadastro_perfil` DISABLE KEYS */;
INSERT INTO `cadastro_perfil` VALUES (1,'ADM','1','1','1','1','1','1','1','1','1','1');
/*!40000 ALTER TABLE `cadastro_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cadastro_pergunta`
--

DROP TABLE IF EXISTS `cadastro_pergunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cadastro_pergunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text NOT NULL,
  `tipo` enum('0','1','2') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cadastro_pergunta`
--

LOCK TABLES `cadastro_pergunta` WRITE;
/*!40000 ALTER TABLE `cadastro_pergunta` DISABLE KEYS */;
/*!40000 ALTER TABLE `cadastro_pergunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cadastro_sala`
--

DROP TABLE IF EXISTS `cadastro_sala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cadastro_sala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `cor_itens` varchar(45) DEFAULT NULL,
  `img_sala` varchar(80) DEFAULT 'imagempadrao.jpg',
  `descricao` text DEFAULT NULL,
  `status` enum('A','L','B','D') DEFAULT 'L',
  `horarios` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`horarios`)),
  `id_check` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_salas_checklist1_idx` (`id_check`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cadastro_sala`
--

LOCK TABLES `cadastro_sala` WRITE;
/*!40000 ALTER TABLE `cadastro_sala` DISABLE KEYS */;
/*!40000 ALTER TABLE `cadastro_sala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cadastro_usuario`
--

DROP TABLE IF EXISTS `cadastro_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cadastro_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `matricula` char(9) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `foto` text DEFAULT _utf8mb4'profile.png',
  PRIMARY KEY (`id`),
  KEY `fk_perfil_funcionarios_cargo1_idx` (`id_perfil`),
  CONSTRAINT `fk_perfil_funcionarios_cargo1` FOREIGN KEY (`id_perfil`) REFERENCES `cadastro_perfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cadastro_usuario`
--

LOCK TABLES `cadastro_usuario` WRITE;
/*!40000 ALTER TABLE `cadastro_usuario` DISABLE KEYS */;
INSERT INTO `cadastro_usuario` VALUES (1,'Administrador','adm@gmail.com','1','123',1,'profile.png');
/*!40000 ALTER TABLE `cadastro_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `check_aberta`
--

DROP TABLE IF EXISTS `check_aberta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `check_aberta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_reg` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reg_check_aberto_reg_check1_idx` (`id_reg`),
  CONSTRAINT `fk_reg_check_aberto_reg_check1` FOREIGN KEY (`id_reg`) REFERENCES `responder_check` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `check_aberta`
--

LOCK TABLES `check_aberta` WRITE;
/*!40000 ALTER TABLE `check_aberta` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_aberta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `check_concluidas`
--

DROP TABLE IF EXISTS `check_concluidas`;
/*!50001 DROP VIEW IF EXISTS `check_concluidas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `check_concluidas` AS SELECT 
 1 AS `id_responder`,
 1 AS `data_abertura`,
 1 AS `data_fechamento`,
 1 AS `conf_logis`,
 1 AS `nome`,
 1 AS `nome_sala`,
 1 AS `img_sala`,
 1 AS `cor`,
 1 AS `codigo`,
 1 AS `nome_docente`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `checklist_respondidas`
--

DROP TABLE IF EXISTS `checklist_respondidas`;
/*!50001 DROP VIEW IF EXISTS `checklist_respondidas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `checklist_respondidas` AS SELECT 
 1 AS `id_user`,
 1 AS `nome_user`,
 1 AS `id_check`,
 1 AS `nome_check`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `conf_logistica`
--

DROP TABLE IF EXISTS `conf_logistica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conf_logistica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prof` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `houve_NC` enum('s','n') NOT NULL DEFAULT 'n',
  `data_vizu` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_conf_logistica_perfil_funcionarios1_idx` (`id_prof`),
  KEY `fk_conf_logistica_reg_check1_idx` (`id_registro`),
  CONSTRAINT `fk_conf_logistica_perfil_funcionarios1` FOREIGN KEY (`id_prof`) REFERENCES `cadastro_usuario` (`id`),
  CONSTRAINT `fk_conf_logistica_reg_check1` FOREIGN KEY (`id_registro`) REFERENCES `responder_check` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf_logistica`
--

LOCK TABLES `conf_logistica` WRITE;
/*!40000 ALTER TABLE `conf_logistica` DISABLE KEYS */;
/*!40000 ALTER TABLE `conf_logistica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `nc_user_logistica`
--

DROP TABLE IF EXISTS `nc_user_logistica`;
/*!50001 DROP VIEW IF EXISTS `nc_user_logistica`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `nc_user_logistica` AS SELECT 
 1 AS `id_responder_check`,
 1 AS `id_user`,
 1 AS `nome_logistica`,
 1 AS `id_responsavel`,
 1 AS `nome_docente`,
 1 AS `id_pergunta`,
 1 AS `img1`,
 1 AS `img2`,
 1 AS `img3`,
 1 AS `desc_nc`,
 1 AS `desc_pergunta`,
 1 AS `data_abertura`,
 1 AS `data_fechamento`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `notificacao`
--

DROP TABLE IF EXISTS `notificacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_remetente` int(11) NOT NULL,
  `id_destinatario` int(11) NOT NULL,
  `texto` varchar(250) NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `visualizado` enum('0','1') DEFAULT NULL,
  `marcado` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_notificacao_perfil_funcionarios1_idx` (`id_remetente`),
  KEY `fk_notificacao_perfil_funcionarios2_idx` (`id_destinatario`),
  CONSTRAINT `fk_notificacao_perfil_funcionarios1` FOREIGN KEY (`id_remetente`) REFERENCES `cadastro_usuario` (`id`),
  CONSTRAINT `fk_notificacao_perfil_funcionarios2` FOREIGN KEY (`id_destinatario`) REFERENCES `cadastro_usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacao`
--

LOCK TABLES `notificacao` WRITE;
/*!40000 ALTER TABLE `notificacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `perfil_do_user`
--

DROP TABLE IF EXISTS `perfil_do_user`;
/*!50001 DROP VIEW IF EXISTS `perfil_do_user`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `perfil_do_user` AS SELECT 
 1 AS `id_user`,
 1 AS `gerenciar_usuarios`,
 1 AS `realizar_acao_corretiva`,
 1 AS `realizar_checklist`,
 1 AS `gerenciar_salas`,
 1 AS `gerenciar_checklist`,
 1 AS `gerenciar_recados`,
 1 AS `gerenciar_notificacoes`,
 1 AS `gerenciar_perfis`,
 1 AS `gerenciar_perguntas`,
 1 AS `relatorios`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `perguntas_da_sala`
--

DROP TABLE IF EXISTS `perguntas_da_sala`;
/*!50001 DROP VIEW IF EXISTS `perguntas_da_sala`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `perguntas_da_sala` AS SELECT 
 1 AS `id_sala`,
 1 AS `id_pergunta`,
 1 AS `pergunta`,
 1 AS `tipo`,
 1 AS `nome_check`,
 1 AS `nome_sala`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `quantidade_nc_user`
--

DROP TABLE IF EXISTS `quantidade_nc_user`;
/*!50001 DROP VIEW IF EXISTS `quantidade_nc_user`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `quantidade_nc_user` AS SELECT 
 1 AS `id`,
 1 AS `id_user`,
 1 AS `nome`,
 1 AS `id_sala`,
 1 AS `nome_sala`,
 1 AS `data_abertura`,
 1 AS `data_fechamento`,
 1 AS `id_checklist`,
 1 AS `nome_check`,
 1 AS `qnt_nc`,
 1 AS `qnt_c`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `quem_abriu`
--

DROP TABLE IF EXISTS `quem_abriu`;
/*!50001 DROP VIEW IF EXISTS `quem_abriu`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `quem_abriu` AS SELECT 
 1 AS `id`,
 1 AS `nome`,
 1 AS `codigo`,
 1 AS `cor_itens`,
 1 AS `img_sala`,
 1 AS `descricao`,
 1 AS `status`,
 1 AS `horarios`,
 1 AS `id_check`,
 1 AS `responsavel`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `recados`
--

DROP TABLE IF EXISTS `recados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_autor` int(11) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `data_add` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_recados_perfil_funcionarios1_idx` (`id_autor`),
  CONSTRAINT `fk_recados_perfil_funcionarios1` FOREIGN KEY (`id_autor`) REFERENCES `cadastro_usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recados`
--

LOCK TABLES `recados` WRITE;
/*!40000 ALTER TABLE `recados` DISABLE KEYS */;
/*!40000 ALTER TABLE `recados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reg_block`
--

DROP TABLE IF EXISTS `reg_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reg_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sala` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `data_bloqueio` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_reg_block_salas1_idx` (`id_sala`),
  CONSTRAINT `fk_reg_block_salas1` FOREIGN KEY (`id_sala`) REFERENCES `cadastro_sala` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reg_block`
--

LOCK TABLES `reg_block` WRITE;
/*!40000 ALTER TABLE `reg_block` DISABLE KEYS */;
/*!40000 ALTER TABLE `reg_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reg_correcao`
--

DROP TABLE IF EXISTS `reg_correcao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reg_correcao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_NC_id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `img1` varchar(45) NOT NULL,
  `img2` varchar(45) DEFAULT NULL,
  `img3` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reg_correcao_reg_NC1_idx` (`reg_NC_id`),
  CONSTRAINT `fk_reg_correcao_reg_NC1` FOREIGN KEY (`reg_NC_id`) REFERENCES `reg_nc` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reg_correcao`
--

LOCK TABLES `reg_correcao` WRITE;
/*!40000 ALTER TABLE `reg_correcao` DISABLE KEYS */;
/*!40000 ALTER TABLE `reg_correcao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reg_nc`
--

DROP TABLE IF EXISTS `reg_nc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reg_nc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_realiza` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pergu` int(11) NOT NULL,
  `descricao_NC` text NOT NULL,
  `img1` varchar(45) NOT NULL,
  `img2` varchar(45) DEFAULT NULL,
  `img3` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reg_NC_reg_check1_idx` (`id_realiza`),
  KEY `fk_reg_NC_pergunta1_idx` (`id_pergu`),
  KEY `fk_reg_NC_usuarios1_idx` (`id_user`),
  CONSTRAINT `fk_reg_NC_pergunta1` FOREIGN KEY (`id_pergu`) REFERENCES `cadastro_pergunta` (`id`),
  CONSTRAINT `fk_reg_NC_reg_check1` FOREIGN KEY (`id_realiza`) REFERENCES `responder_check` (`id`),
  CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `cadastro_usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reg_nc`
--

LOCK TABLES `reg_nc` WRITE;
/*!40000 ALTER TABLE `reg_nc` DISABLE KEYS */;
/*!40000 ALTER TABLE `reg_nc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relacao_pergunta_checklist`
--

DROP TABLE IF EXISTS `relacao_pergunta_checklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relacao_pergunta_checklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_check` int(11) NOT NULL,
  `id_pergunta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_checklist_has_perguntas_perguntas1_idx` (`id_pergunta`),
  KEY `fk_checklist_has_perguntas_checklist1_idx` (`id_check`),
  CONSTRAINT `fk_checklist_has_perguntas_checklist1` FOREIGN KEY (`id_check`) REFERENCES `cadastro_checklist` (`id`),
  CONSTRAINT `fk_checklist_has_perguntas_perguntas1` FOREIGN KEY (`id_pergunta`) REFERENCES `cadastro_pergunta` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relacao_pergunta_checklist`
--

LOCK TABLES `relacao_pergunta_checklist` WRITE;
/*!40000 ALTER TABLE `relacao_pergunta_checklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `relacao_pergunta_checklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `relatorio`
--

DROP TABLE IF EXISTS `relatorio`;
/*!50001 DROP VIEW IF EXISTS `relatorio`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `relatorio` AS SELECT 
 1 AS `id_nc`,
 1 AS `nome_reg_nc`,
 1 AS `id_pergunta`,
 1 AS `id_aula`,
 1 AS `data_abertura`,
 1 AS `data_fechamento`,
 1 AS `nome_responsavel`,
 1 AS `nome_sala`,
 1 AS `img_sala`,
 1 AS `status`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `responder_check`
--

DROP TABLE IF EXISTS `responder_check`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `responder_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `data_abertura` timestamp NULL DEFAULT current_timestamp(),
  `data_fechamento` timestamp NULL DEFAULT current_timestamp(),
  `conf_logis` enum('s','n','p') DEFAULT 'n',
  `id_checklist` int(11) DEFAULT NULL,
  `observacao` varchar(254) DEFAULT NULL,
  `observacao_pos` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_realiza_check_perfil_funcionarios1_idx` (`id_usuario`),
  KEY `fk_realiza_check_salas1_idx` (`id_sala`),
  CONSTRAINT `fk_realiza_check_perfil_funcionarios1` FOREIGN KEY (`id_usuario`) REFERENCES `cadastro_usuario` (`id`),
  CONSTRAINT `fk_realiza_check_salas1` FOREIGN KEY (`id_sala`) REFERENCES `cadastro_sala` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responder_check`
--

LOCK TABLES `responder_check` WRITE;
/*!40000 ALTER TABLE `responder_check` DISABLE KEYS */;
/*!40000 ALTER TABLE `responder_check` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50003 TRIGGER `reg_check_AFTER_INSERT` AFTER INSERT ON `responder_check` FOR EACH ROW BEGIN
	insert into check_aberta values(default,new.id);
    update cadastro_sala set `status` = 'a' where cadastro_sala.id = new.id_sala;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary view structure for view `salas_encerradas_docente`
--

DROP TABLE IF EXISTS `salas_encerradas_docente`;
/*!50001 DROP VIEW IF EXISTS `salas_encerradas_docente`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `salas_encerradas_docente` AS SELECT 
 1 AS `id_user`,
 1 AS `nome`,
 1 AS `id_aula`,
 1 AS `id_checklist`,
 1 AS `data_abertura`,
 1 AS `data_fechamento`,
 1 AS `nome_sala`,
 1 AS `img_sala`,
 1 AS `conf_logis`,
 1 AS `qnt_nc`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `user_relatorio`
--

DROP TABLE IF EXISTS `user_relatorio`;
/*!50001 DROP VIEW IF EXISTS `user_relatorio`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `user_relatorio` AS SELECT 
 1 AS `id`,
 1 AS `nome`,
 1 AS `quantidade`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'etg2'
--

--
-- Dumping routines for database 'etg2'
--

--
-- Final view structure for view `check_concluidas`
--

/*!50001 DROP VIEW IF EXISTS `check_concluidas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50001 VIEW `check_concluidas` AS select `responder_check`.`id` AS `id_responder`,`responder_check`.`data_abertura` AS `data_abertura`,`responder_check`.`data_fechamento` AS `data_fechamento`,`responder_check`.`conf_logis` AS `conf_logis`,`cadastro_usuario`.`nome` AS `nome`,`cadastro_sala`.`nome` AS `nome_sala`,`cadastro_sala`.`img_sala` AS `img_sala`,`cadastro_sala`.`cor_itens` AS `cor`,`cadastro_sala`.`codigo` AS `codigo`,`cadastro_usuario`.`nome` AS `nome_docente` from ((`responder_check` join `cadastro_sala` on(`responder_check`.`id_sala` = `cadastro_sala`.`id`)) join `cadastro_usuario` on(`responder_check`.`id_usuario` = `cadastro_usuario`.`id`)) order by `responder_check`.`conf_logis` desc,`responder_check`.`data_fechamento` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `checklist_respondidas`
--

/*!50001 DROP VIEW IF EXISTS `checklist_respondidas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50001 VIEW `checklist_respondidas` AS select distinct `cadastro_usuario`.`id` AS `id_user`,`cadastro_usuario`.`nome` AS `nome_user`,`cadastro_checklist`.`id` AS `id_check`,`cadastro_checklist`.`nome` AS `nome_check` from ((`cadastro_usuario` join `responder_check` on(`responder_check`.`id_usuario` = `cadastro_usuario`.`id`)) join `cadastro_checklist` on(`cadastro_checklist`.`id` = `responder_check`.`id_checklist`)) where `responder_check`.`data_fechamento` is not null */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `nc_user_logistica`
--

/*!50001 DROP VIEW IF EXISTS `nc_user_logistica`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50001 VIEW `nc_user_logistica` AS select `responder_check`.`id` AS `id_responder_check`,`reg_nc`.`id_user` AS `id_user`,`cad_user3`.`nome` AS `nome_logistica`,`cad_user1`.`id` AS `id_responsavel`,`cad_user1`.`nome` AS `nome_docente`,`cad_perg`.`id` AS `id_pergunta`,`reg_nc`.`img1` AS `img1`,`reg_nc`.`img2` AS `img2`,`reg_nc`.`img3` AS `img3`,`reg_nc`.`descricao_NC` AS `desc_nc`,`cad_perg`.`descricao` AS `desc_pergunta`,`responder_check`.`data_abertura` AS `data_abertura`,`responder_check`.`data_fechamento` AS `data_fechamento` from ((((((`responder_check` join `reg_nc` on(`reg_nc`.`id_realiza` = `responder_check`.`id`)) join `reg_correcao` on(`reg_correcao`.`reg_NC_id` = `reg_nc`.`id`)) join `cadastro_usuario` `cad_user1` on(`cad_user1`.`id` = `responder_check`.`id_usuario`)) join `cadastro_usuario` `cad_user2` on(`cad_user2`.`id` = `reg_correcao`.`id_usuario`)) join `cadastro_pergunta` `cad_perg` on(`cad_perg`.`id` = `reg_nc`.`id_pergu`)) join `cadastro_usuario` `cad_user3` on(`cad_user3`.`id` = `reg_nc`.`id_user`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `perfil_do_user`
--

/*!50001 DROP VIEW IF EXISTS `perfil_do_user`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50001 VIEW `perfil_do_user` AS select `cadastro_usuario`.`id` AS `id_user`,`cadastro_perfil`.`gerenciar_usuarios` AS `gerenciar_usuarios`,`cadastro_perfil`.`realizar_acao_corretiva` AS `realizar_acao_corretiva`,`cadastro_perfil`.`realizar_checklist` AS `realizar_checklist`,`cadastro_perfil`.`gerenciar_salas` AS `gerenciar_salas`,`cadastro_perfil`.`gerenciar_checklist` AS `gerenciar_checklist`,`cadastro_perfil`.`gerenciar_recados` AS `gerenciar_recados`,`cadastro_perfil`.`gerenciar_notificacoes` AS `gerenciar_notificacoes`,`cadastro_perfil`.`gerenciar_perfis` AS `gerenciar_perfis`,`cadastro_perfil`.`gerenciar_perguntas` AS `gerenciar_perguntas`,`cadastro_perfil`.`ver_relatorios` AS `relatorios` from (`cadastro_usuario` join `cadastro_perfil` on(`cadastro_perfil`.`id` = `cadastro_usuario`.`id_perfil`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `perguntas_da_sala`
--

/*!50001 DROP VIEW IF EXISTS `perguntas_da_sala`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50001 VIEW `perguntas_da_sala` AS select `cadastro_sala`.`id` AS `id_sala`,`cadastro_pergunta`.`id` AS `id_pergunta`,`cadastro_pergunta`.`descricao` AS `pergunta`,`cadastro_pergunta`.`tipo` AS `tipo`,`cadastro_checklist`.`nome` AS `nome_check`,`cadastro_sala`.`nome` AS `nome_sala` from (((`cadastro_pergunta` join `relacao_pergunta_checklist` on(`cadastro_pergunta`.`id` = `relacao_pergunta_checklist`.`id_pergunta`)) join `cadastro_checklist` on(`relacao_pergunta_checklist`.`id_check` = `cadastro_checklist`.`id`)) join `cadastro_sala` on(`cadastro_checklist`.`id` = `cadastro_sala`.`id_check`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `quantidade_nc_user`
--

/*!50001 DROP VIEW IF EXISTS `quantidade_nc_user`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50001 VIEW `quantidade_nc_user` AS select `responder_check`.`id` AS `id`,`responder_check`.`id_usuario` AS `id_user`,`cadastro_usuario`.`nome` AS `nome`,`responder_check`.`id_sala` AS `id_sala`,`cadastro_sala`.`nome` AS `nome_sala`,`responder_check`.`data_abertura` AS `data_abertura`,`responder_check`.`data_fechamento` AS `data_fechamento`,`responder_check`.`id_checklist` AS `id_checklist`,`cadastro_checklist`.`nome` AS `nome_check`,count(`reg_nc`.`id`) AS `qnt_nc`,count(`reg_correcao`.`id`) AS `qnt_c` from (((((`responder_check` join `cadastro_sala` on(`responder_check`.`id_sala` = `cadastro_sala`.`id`)) join `cadastro_checklist` on(`cadastro_checklist`.`id` = `responder_check`.`id_checklist`)) join `cadastro_usuario` on(`cadastro_usuario`.`id` = `responder_check`.`id_usuario`)) left join `reg_nc` on(`reg_nc`.`id_realiza` = `responder_check`.`id`)) left join `reg_correcao` on(`reg_correcao`.`reg_NC_id` = `reg_nc`.`id`)) where `responder_check`.`data_fechamento` is not null group by `responder_check`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `quem_abriu`
--

/*!50001 DROP VIEW IF EXISTS `quem_abriu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50001 VIEW `quem_abriu` AS select `cadastro_sala`.`id` AS `id`,`cadastro_sala`.`nome` AS `nome`,`cadastro_sala`.`codigo` AS `codigo`,`cadastro_sala`.`cor_itens` AS `cor_itens`,`cadastro_sala`.`img_sala` AS `img_sala`,`cadastro_sala`.`descricao` AS `descricao`,`cadastro_sala`.`status` AS `status`,`cadastro_sala`.`horarios` AS `horarios`,`cadastro_sala`.`id_check` AS `id_check`,`responder_check`.`id_usuario` AS `responsavel` from (`cadastro_sala` left join `responder_check` on(`cadastro_sala`.`id` = `responder_check`.`id_sala` and `responder_check`.`data_fechamento` is null)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `relatorio`
--

/*!50001 DROP VIEW IF EXISTS `relatorio`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50001 VIEW `relatorio` AS select `reg_nc`.`id` AS `id_nc`,`user_nc`.`nome` AS `nome_reg_nc`,`reg_nc`.`id_pergu` AS `id_pergunta`,`responder_check`.`id` AS `id_aula`,`responder_check`.`data_abertura` AS `data_abertura`,`responder_check`.`data_fechamento` AS `data_fechamento`,`cadastro_usuario`.`nome` AS `nome_responsavel`,`cadastro_sala`.`nome` AS `nome_sala`,`cadastro_sala`.`img_sala` AS `img_sala`,`cadastro_sala`.`status` AS `status` from (((`responder_check` left join (`reg_nc` join `cadastro_usuario` `user_nc` on(`reg_nc`.`id_user` = `user_nc`.`id`)) on(`responder_check`.`id` = `reg_nc`.`id_realiza`)) join `cadastro_usuario` on(`responder_check`.`id_usuario` = `cadastro_usuario`.`id`)) join `cadastro_sala` on(`cadastro_sala`.`id` = `responder_check`.`id_sala`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `salas_encerradas_docente`
--

/*!50001 DROP VIEW IF EXISTS `salas_encerradas_docente`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50001 VIEW `salas_encerradas_docente` AS select `cadastro_usuario`.`id` AS `id_user`,`cadastro_usuario`.`nome` AS `nome`,`responder_check`.`id` AS `id_aula`,`responder_check`.`id_checklist` AS `id_checklist`,`responder_check`.`data_abertura` AS `data_abertura`,`responder_check`.`data_fechamento` AS `data_fechamento`,`cadastro_sala`.`nome` AS `nome_sala`,`cadastro_sala`.`img_sala` AS `img_sala`,`responder_check`.`conf_logis` AS `conf_logis`,count(`reg_nc`.`id`) AS `qnt_nc` from (((`cadastro_usuario` join `responder_check` on(`responder_check`.`id_usuario` = `cadastro_usuario`.`id`)) left join `reg_nc` on(`reg_nc`.`id_realiza` = `responder_check`.`id`)) join `cadastro_sala` on(`responder_check`.`id_sala` = `cadastro_sala`.`id`)) where `responder_check`.`data_fechamento` is not null group by `responder_check`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `user_relatorio`
--

/*!50001 DROP VIEW IF EXISTS `user_relatorio`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50001 VIEW `user_relatorio` AS select `cadastro_usuario`.`id` AS `id`,`cadastro_usuario`.`nome` AS `nome`,count(`responder_check`.`id_usuario`) AS `quantidade` from (`cadastro_usuario` join `responder_check` on(`cadastro_usuario`.`id` = `responder_check`.`id_usuario`)) where `responder_check`.`data_fechamento` is not null group by `cadastro_usuario`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-11 21:46:26
