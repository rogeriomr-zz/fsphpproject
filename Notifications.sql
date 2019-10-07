# ************************************************************
# Sequel Pro SQL dump
# Versão 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.37-MariaDB)
# Base de Dados: fullstackphp
# Tempo de Geração: 2019-02-11 19:10:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump da tabela notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `view` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;

INSERT INTO `notifications` (`id`, `image`, `title`, `link`, `view`, `created_at`, `updated_at`)
VALUES
	(1,'https://www.localhost/fsphpproject/themes/cafeadm/assets/images/notify.jpg','Robson V. Leite assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphpproject/admin/control/subscription/4',0,'2019-02-11 08:53:35','2019-02-11 17:10:25'),
	(2,'https://www.localhost/fsphpproject/themes/cafeadm/assets/images/notify.jpg','Eleno Santos assinou o plano PRO de R$ 50,00/ano','https://www.localhost/fsphpproject/admin/control/subscription/5',0,'2019-02-11 08:53:49','2019-02-11 17:10:25'),
	(3,'https://www.localhost/fsphpproject/themes/cafeadm/assets/images/notify.jpg','Alexandre Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphpproject/admin/control/subscription/6',0,'2019-02-11 09:44:59','2019-02-11 17:10:26'),
	(4,'https://www.localhost/fsphpproject/themes/cafeadm/assets/images/notify.jpg','Willian Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphpproject/admin/control/subscription/7',0,'2019-02-11 09:44:59','2019-02-11 17:10:26'),
	(5,'https://www.localhost/fsphpproject/themes/cafeadm/assets/images/notify.jpg','Eduardo Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphpproject/admin/control/subscription/8',0,'2019-02-11 08:53:35','2019-02-11 17:10:26'),
	(6,'https://www.localhost/fsphpproject/themes/cafeadm/assets/images/notify.jpg','Mateus Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphpproject/admin/control/subscription/4',0,'2019-02-11 09:44:59','2019-02-11 17:10:26'),
	(7,'https://www.localhost/fsphpproject/themes/cafeadm/assets/images/notify.jpg','Felipe Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphpproject/admin/control/subscription/5',0,'2019-02-11 08:53:35','2019-02-11 17:10:26'),
	(8,'https://www.localhost/fsphpproject/themes/cafeadm/assets/images/notify.jpg','Elton Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphpproject/admin/control/subscription/6',0,'2019-02-11 09:44:59','2019-02-11 17:10:27'),
	(9,'https://www.localhost/fsphpproject/themes/cafeadm/assets/images/notify.jpg','Roddrigo Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphpproject/admin/control/subscription/7',0,'2019-02-11 09:44:59','2019-02-11 17:10:27'),
	(10,'https://www.localhost/fsphpproject/themes/cafeadm/assets/images/notify.jpg','Fernanda Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphpproject/admin/control/subscription/8',0,'2019-02-11 09:44:59','2019-02-11 17:10:27'),
	(11,'https://www.localhost/fsphpproject/themes/cafeadm/assets/images/notify.jpg','Bia Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphpproject/admin/control/subscription/4',0,'2019-02-11 08:53:35','2019-02-11 17:10:27'),
	(12,'https://www.localhost/fsphpproject/themes/cafeadm/assets/images/notify.jpg','Maria Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphpproject/admin/control/subscription/5',0,'2019-02-11 08:53:35','2019-02-11 17:10:27');

/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
