/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.6.50-log : Database - heroku_c0bdc15965be352
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`heroku_c0bdc15965be352` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `heroku_c0bdc15965be352`;

/*Table structure for table `tb_detail_presensi` */

DROP TABLE IF EXISTS `tb_detail_presensi`;

CREATE TABLE `tb_detail_presensi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `presensi_id` bigint(20) unsigned DEFAULT NULL,
  `is_hadir` tinyint(1) DEFAULT '0',
  `nomor_cacah_krama_mipil` char(18) DEFAULT NULL,
  `uid_kartu` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `presensi_id` (`presensi_id`),
  CONSTRAINT `tb_detail_presensi_ibfk_1` FOREIGN KEY (`presensi_id`) REFERENCES `tb_presensi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_detail_presensi` */

insert  into `tb_detail_presensi`(`id`,`presensi_id`,`is_hadir`,`nomor_cacah_krama_mipil`,`uid_kartu`,`created_at`,`updated_at`,`deleted_at`) values 
(67,2,1,'03080301011222001','test12345','2022-06-23 16:14:12','2022-07-03 10:14:14',NULL),
(68,2,1,'03080301030610001','test123','2022-06-23 16:14:56','2022-06-23 16:14:56',NULL),
(71,8,0,'03080301311275001',NULL,'2022-07-03 09:38:42','2022-07-03 09:38:42',NULL),
(72,8,1,'03080301311278001','test12345','2022-07-03 09:38:42','2022-07-03 13:26:13',NULL),
(73,9,0,'03080301311275001',NULL,'2022-07-03 10:55:29','2022-07-03 10:55:29',NULL),
(74,8,1,'03080301311278002','test12345','2022-07-03 10:55:29','2022-07-03 14:43:32',NULL);

/*Table structure for table `tb_m_kegiatan` */

DROP TABLE IF EXISTS `tb_m_kegiatan`;

CREATE TABLE `tb_m_kegiatan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(160) DEFAULT NULL,
  `keterangan` text,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_m_kegiatan` */

insert  into `tb_m_kegiatan`(`id`,`nama_kegiatan`,`keterangan`,`created_at`,`deleted_at`,`updated_at`) values 
(1,'Kegiatan 1','Keterangan kegiatan misalnya','2022-06-22 10:05:14',NULL,'2022-06-22 10:05:14'),
(2,'test api kegiatan','keterangan test','2022-06-30 20:19:46',NULL,'2022-06-30 20:19:46'),
(3,'test edit','test','2022-06-30 20:23:37',NULL,'2022-06-30 20:32:54');

/*Table structure for table `tb_m_kode_presensi` */

DROP TABLE IF EXISTS `tb_m_kode_presensi`;

CREATE TABLE `tb_m_kode_presensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_presensi` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_m_kode_presensi` */

/*Table structure for table `tb_presensi` */

DROP TABLE IF EXISTS `tb_presensi`;

CREATE TABLE `tb_presensi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kegiatan_id` int(10) unsigned DEFAULT NULL,
  `kode_id` int(11) DEFAULT NULL,
  `nama_presensi` varchar(70) DEFAULT NULL,
  `keterangan` text,
  `kode_presensi` varchar(6) DEFAULT NULL,
  `tgl_open` datetime DEFAULT NULL,
  `tgl_close` datetime DEFAULT NULL,
  `is_open` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kegiatan_id` (`kegiatan_id`),
  KEY `kode_id` (`kode_id`),
  CONSTRAINT `tb_presensi_ibfk_1` FOREIGN KEY (`kegiatan_id`) REFERENCES `tb_m_kegiatan` (`id`),
  CONSTRAINT `tb_presensi_ibfk_2` FOREIGN KEY (`kode_id`) REFERENCES `tb_m_kode_presensi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_presensi` */

insert  into `tb_presensi`(`id`,`kegiatan_id`,`kode_id`,`nama_presensi`,`keterangan`,`kode_presensi`,`tgl_open`,`tgl_close`,`is_open`,`created_at`,`deleted_at`,`updated_at`) values 
(1,1,NULL,'Nama presensi 1','test presensi 123','abcd','2022-01-30 00:00:00','2022-02-02 00:00:00',0,'2022-06-22 10:06:34',NULL,'2022-06-22 10:06:34'),
(2,1,NULL,'nama presensi misalnya test','test presensi 2','abcd','2022-01-30 00:00:00','2022-02-02 00:00:00',1,'2022-06-22 10:07:13',NULL,'2022-06-22 10:07:13'),
(3,3,NULL,'test123','tetstet','12345','2022-07-01 00:00:00','2022-07-02 00:00:00',0,'2022-07-01 06:16:31',NULL,'2022-07-01 06:16:31'),
(4,3,NULL,'test',NULL,NULL,NULL,NULL,0,'2022-07-01 07:15:49',NULL,'2022-07-01 07:15:49'),
(5,1,NULL,'test krama','test','123456','2022-07-03 00:00:00','2022-07-03 00:00:00',0,'2022-07-03 09:37:43',NULL,'2022-07-03 09:37:43'),
(6,1,NULL,'test krama','test','123456','2022-07-03 00:00:00','2022-07-03 00:00:00',0,'2022-07-03 09:37:59',NULL,'2022-07-03 09:37:59'),
(7,1,NULL,'test krama','test','123456','2022-07-03 00:00:00','2022-07-03 00:00:00',0,'2022-07-03 09:38:14',NULL,'2022-07-03 09:38:14'),
(8,1,NULL,'test krama','test','123456','2022-07-03 22:00:00','2022-07-03 00:00:00',1,'2022-07-03 09:38:42',NULL,'2022-07-03 09:38:42'),
(9,1,NULL,'test with waktu','keterangan misalnya','123455','2022-07-03 22:00:00','2022-07-05 20:00:00',0,'2022-07-03 10:55:29',NULL,'2022-07-03 10:55:29');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
