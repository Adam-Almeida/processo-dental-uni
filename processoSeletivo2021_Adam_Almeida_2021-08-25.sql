# ************************************************************
# Sequel Ace SQL dump
# Versão 3038
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Servidor: localhost (MySQL 5.7.26)
# Banco de Dados: processoSeletivo2021_Adam_Almeida
# Tempo de geração: 2021-08-25 23:50:03 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump de tabela dentistas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dentistas`;

CREATE TABLE `dentistas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cro` varchar(11) NOT NULL,
  `cro_uf` char(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `dentistas` WRITE;
/*!40000 ALTER TABLE `dentistas` DISABLE KEYS */;

INSERT INTO `dentistas` (`id`, `name`, `email`, `cro`, `cro_uf`, `created_at`, `updated_at`)
VALUES
	(1,'Adam','adam@agsf.com','11','pr','2021-08-25 11:54:54',NULL),
	(7,'Isadora Doronko','isadora@doronko.com','23456787654','PR','2021-08-25 12:31:45',NULL),
	(68,'Lael V. Mejia','a.auctor@mattisCraseget.co.uk','36349889000','PR','2021-08-24 10:31:18',NULL),
	(69,'Dara Y. Payne','sapien@malesuadavelvenenatis.net','19173075000','MG','2021-08-24 10:31:18',NULL),
	(70,'Rajah O. Kline','ultricies@nonenim.com','7785483000','MG','2021-08-24 10:31:18',NULL),
	(71,'Sylvia Iasca Barron','morbi.tristique@Fuscefeugiat.org','26003618000','PE','2021-08-25 16:39:09','2021-08-25 16:39:09'),
	(72,'Lavinia V. Dillards','laoreet@eu.com','24639148000','BA','2021-08-25 18:00:46','2021-08-25 18:00:46'),
	(73,'Zelda Q. Fry','neque.sed.sem@nuncac.co.uk','20845619000','SP','2021-08-24 10:31:18',NULL),
	(74,'Sonya I. Travis','arcu.imperdiet.ullamcorper@Donec.ca','13074220000','MG','2021-08-24 10:31:18',NULL),
	(75,'Zeus R. Reeves22','sed@acmattisvelit.co.uk','49865494000','SP','2021-08-25 20:10:11','2021-08-25 20:10:11'),
	(76,'Ila R. Reid','dignissim@Aeneaneget.edu','15484630004','SP','2021-08-24 10:31:18',NULL),
	(77,'Renee F. Stanley','luctus@Vivamusnisi.edu','49488470001','SP','2021-08-24 10:31:18',NULL),
	(78,'Ali C. Lyons','neque.@lobortismauris.com','11300032799','SC','2021-08-24 21:00:06','2021-08-24 21:00:06'),
	(79,'Anika O. Cannon2','dui.semper.et@Nullam.ca','16072200077','RJ','2021-08-25 20:16:51','2021-08-25 20:16:51'),
	(80,'Russell G. Wolf','elementum.dui.quis@sem.org','34285400041','BA','2021-08-24 10:31:18',NULL),
	(81,'Mira P. Mcclain','gravida.Praesent.eu@morbitristique.ca','17870000150','RS','2021-08-24 10:31:18',NULL),
	(82,'Sacha A. Riley','Maecenas.malesuada@non.co.uk','17534800075','MG','2021-08-24 10:31:18',NULL),
	(83,'Chancellor M. Morrow','est.ac.facilisis@vitaenibhDonec.org','19790002761','PB','2021-08-24 10:31:18',NULL),
	(84,'Kylie E. Gregory','laoreet.ipsum@velitegestas.co.uk','38259900042','SP','2021-08-24 10:31:18',NULL),
	(85,'Helen V. Solis','in@faucibus.ca','34480400063','BA','2021-08-24 10:31:18',NULL),
	(86,'Zachery U. Hale','pulvinar@dolortempus.ca','38809200032','SP','2021-08-24 10:31:18',NULL),
	(87,'Bernard Y. Tanner','Fusce.mollis.Duis@ut.co.uk','31220000557','RJ','2021-08-24 10:31:18',NULL),
	(88,'Trevor K. Harding','lobortis@maurisutmi.edu','19965940003','SP','2021-08-24 10:31:18',NULL),
	(89,'Azalia M. Alford','Nulla@pedemalesuadavel.com','18150500067','MG','2021-08-24 10:31:18',NULL),
	(90,'Rhea C. Morin','neque.Nullam@Aliquamerat.net','22815100086','CE','2021-08-24 10:31:18',NULL),
	(91,'Adam X. Lott','tellus@Sedmalesuadaaugue.ca','15369400063','RS','2021-08-24 10:31:18',NULL),
	(92,'Dana S. Lewis','lacinia.mattis.Integer@velitdui.net','46842500005','SC','2021-08-24 10:31:18',NULL),
	(93,'Ima P. Thomas','blandit.congue@eumetusIn.com','45691800048','RJ','2021-08-24 10:31:18',NULL),
	(94,'Jolie I. Dotson','Proin.eget.odio@loremeu.co.uk','24310002722','SP','2021-08-24 10:31:18',NULL),
	(95,'Genevieve E. Price','at@Fuscealiquet.co.uk','26389000083','CE','2021-08-24 10:31:18',NULL),
	(96,'Ashton A. Garrett','risus.Duis.a@magnaPraesentinterdum.com','36490003304','GO','2021-08-24 10:31:18',NULL),
	(97,'Amber I. Mercer','ac.mattis@orciquis.com','36015000782','SP','2021-08-24 10:31:18',NULL),
	(98,'Addison U. Dotson','Integer@aliquetsem.ca','38493000620','SP','2021-08-24 10:31:18',NULL),
	(99,'Hall V. Gomez','elementum.purus@sociis.edu','8558000111','RS','2021-08-24 10:31:18',NULL),
	(100,'Hyatt K. Simmons','malesuada@maurisblandit.net','21000003344','CE','2021-08-24 10:31:18',NULL),
	(101,'Stuart G. Kelley','Donec@libero.ca','37181754000','BA','2021-08-24 10:31:18',NULL),
	(102,'Kareem D. Booth','Aliquam.vulputate.ullamcorper@cursus.ca','40000108735','SP','2021-08-24 10:31:18',NULL),
	(103,'Gannon Q. Pollard','malesuada@Duisvolutpatnunc.edu','31950009660','RS','2021-08-24 21:00:18','2021-08-24 21:00:18'),
	(104,'Jasper O. Hansen','velit.Cras.lorem@liberoettristique.ca','10053600066','SP','2021-08-24 10:31:18',NULL),
	(105,'Melvin F. Hester','ornare@neceleifend.co.uk','6290000803','SP','2021-08-24 10:31:18',NULL),
	(106,'Brenna Q. Merrill','vulputate.@turpisegestasFusce.edu','5200028333','RJ','2021-08-24 21:00:29','2021-08-24 21:00:29'),
	(107,'Zenaida O. Alvarado','cursus@blanditNamnulla.net','42683700009','SP','2021-08-24 10:31:18',NULL),
	(108,'Zachary G. Logan','interdum@non.co.uk','31446150000','PE','2021-08-24 10:31:18',NULL),
	(109,'August W. Chang','Aenean.egestas@Namnullamagna.com','45791000768','RJ','2021-08-24 10:31:18',NULL),
	(110,'Kibo E. Parks','ante@ac.com','8223100047','SP','2021-08-24 10:31:18',NULL),
	(111,'Glenna I. Gregory','aliquet.molestie@Vestibulumanteipsum.edu','39854000064','PA','2021-08-24 10:31:18',NULL),
	(112,'Colorado T. Huffman','morbi.tristique.senectus@primis.ca','35423300096','RS','2021-08-24 10:31:18',NULL),
	(113,'Rhoda A. Pace','magna.et.ipsum@sempertellus.net','48650008192','SP','2021-08-24 10:31:18',NULL),
	(114,'Frances D. Terry','luctus.et@lacusUt.ca','35780005982','RJ','2021-08-24 10:31:18',NULL),
	(115,'Xyla L. Hawkins','consequat.enim@Curabitur.net','42937000453','PB','2021-08-24 10:31:18',NULL),
	(116,'Ezra C. Irwin','Sed.et.libero@pedeetrisus.org','30204000324','RJ','2021-08-24 10:31:18',NULL),
	(117,'Virginia J. Dunlap','erat.eget.tincidunt@scelerisque.ca','9497000931','RJ','2021-08-24 10:31:18',NULL),
	(118,'Daquan M. Hebert','a.ultricies@ullamcorpernislarcu.net','14425830003','RJ','2021-08-24 21:00:42','2021-08-24 21:00:42'),
	(119,'Gil R. Head','ultricies.dignissim.lacus@mollisInteger.ca','22422600052','SP','2021-08-24 10:31:18',NULL),
	(120,'Whilemina J. Leblanc','diam.nunc@orcilobortis.net','5870400030','RJ','2021-08-24 10:31:18',NULL),
	(121,'Victor G. Wise','posuere.cubilia@egetodioAliquam.org','5264210000','SC','2021-08-24 10:31:18',NULL),
	(122,'Kendall U. Ayers','ad.litora@esttemporbibendum.co.uk','50766600085','PB','2021-08-24 10:31:18',NULL),
	(123,'Ezra K. Tucker','arcu@purus.org','44870003489','MA','2021-08-24 10:31:18',NULL),
	(124,'Austin U. Perez','ante.ipsum@nonlobortisquis.edu','7117000165','BA','2021-08-24 10:31:18',NULL),
	(125,'Baker A. Miranda','quis.diam.luctus@mattissemperdui.org','48660870006','SP','2021-08-24 10:31:18',NULL),
	(126,'Haley S. Dudley','Pellentesque@pellentesqueSed.edu','7025500081','SP','2021-08-24 10:31:18',NULL),
	(127,'Avram U. Parks','ultrices.mauris@tempuseu.co.uk','21410000695','SP','2021-08-24 10:31:18',NULL),
	(128,'Glenna T. Dickerson','faucibus@afacilisis.co.uk','50980003941','PE','2021-08-24 10:31:18',NULL),
	(129,'Catherine O. Little','eros.Proin@semper.com','25387900053','SP','2021-08-24 10:31:18',NULL),
	(130,'adam','adam@gmail.com','12345678902','PR','2021-08-24 19:39:35',NULL),
	(131,'adam','adam@gmail.com','12345678902','PR','2021-08-24 19:39:43',NULL),
	(146,'Adam','adam.designjuridico@gmail.com','99999999999','BA','2021-08-25 15:16:14',NULL),
	(147,'Adam','adam.designjuridico@gmail.com','12222222222','PR','2021-08-25 20:13:39',NULL),
	(148,'arquivopdf','adam.designjuridico@gmail.com','5555555555','PR','2021-08-25 20:14:08',NULL),
	(149,'arquivozip','adamoliveira@alunos.unicesumar.edu.br','2222222222','PR','2021-08-25 20:41:19',NULL);

/*!40000 ALTER TABLE `dentistas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump de tabela dentistas_especialidades
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dentistas_especialidades`;

CREATE TABLE `dentistas_especialidades` (
  `especialidade_id` int(11) DEFAULT NULL,
  `dentista_id` int(11) DEFAULT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `dentista_id` (`dentista_id`),
  KEY `especialidades_id` (`especialidade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `dentistas_especialidades` WRITE;
/*!40000 ALTER TABLE `dentistas_especialidades` DISABLE KEYS */;

INSERT INTO `dentistas_especialidades` (`especialidade_id`, `dentista_id`, `id`)
VALUES
	(7,72,5),
	(8,73,6),
	(10,75,8),
	(11,76,9),
	(12,77,10),
	(13,78,11),
	(15,80,13),
	(16,81,14),
	(17,82,15),
	(18,83,16),
	(6,84,17),
	(3,87,20),
	(4,88,21),
	(9,89,22),
	(17,90,23),
	(9,91,24),
	(9,92,25),
	(13,93,26),
	(16,94,27),
	(4,95,28),
	(14,96,29),
	(12,97,30),
	(2,98,31),
	(13,99,32),
	(14,101,34),
	(2,102,35),
	(16,103,36),
	(2,104,37),
	(11,105,38),
	(3,106,39),
	(11,107,40),
	(15,108,41),
	(2,109,42),
	(5,110,43),
	(2,111,44),
	(17,112,45),
	(6,113,46),
	(13,114,47),
	(14,115,48),
	(5,116,49),
	(11,117,50),
	(3,118,51),
	(7,119,52),
	(9,120,53),
	(9,121,54),
	(16,122,55),
	(7,123,56),
	(8,124,57),
	(10,125,58),
	(11,126,59),
	(12,146,62),
	(3,147,63),
	(3,148,64),
	(3,149,65);

/*!40000 ALTER TABLE `dentistas_especialidades` ENABLE KEYS */;
UNLOCK TABLES;


# Dump de tabela especialidades
# ------------------------------------------------------------

DROP TABLE IF EXISTS `especialidades`;

CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `especialidades` WRITE;
/*!40000 ALTER TABLE `especialidades` DISABLE KEYS */;

INSERT INTO `especialidades` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(3,'Disfunção Temporomandibular','2021-08-24 10:37:25',NULL),
	(5,'Estomatologia','2021-08-24 10:37:25',NULL),
	(6,'Radiologia Odontológica e Imaginologia','2021-08-24 10:37:25',NULL),
	(7,'Implantodontia','2021-08-24 10:37:25',NULL),
	(8,'Odontologia Legal','2021-08-24 10:37:25',NULL),
	(9,'Odontologia do Trabalho','2021-08-24 10:37:25',NULL),
	(10,'Odontogeriatria','2021-08-24 10:37:25',NULL),
	(11,'Odontopediatria','2021-08-24 10:37:25',NULL),
	(12,'Ortodontia','2021-08-24 10:37:25',NULL),
	(13,'Ortopedia Funcional dos Maxilares','2021-08-24 10:37:25',NULL),
	(14,'Patologia Bucal','2021-08-24 10:37:25',NULL),
	(15,'Periodontia','2021-08-24 10:37:25',NULL),
	(16,'Prótese Buco-Maxilo-Facial','2021-08-24 10:37:25',NULL),
	(17,'Prótese Dentária','2021-08-24 10:37:25',NULL);

/*!40000 ALTER TABLE `especialidades` ENABLE KEYS */;
UNLOCK TABLES;


# Dump de tabela users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`)
VALUES
	(1,'Adam','Almeida','adam.designjuridico@gmail.com','$2b$10$D4NdZc7uOGv7ugbCSzp/9On.Wrpq37nk5h5gi1xr1FrZgg.s5nAxy','2021-08-23 20:02:09','2021-08-23 20:04:41');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
