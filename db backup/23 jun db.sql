/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.8.3-MariaDB : Database - tb_presensi_harry
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tb_presensi_harry` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `tb_presensi_harry`;

/*Table structure for table `tb_detail_presensi` */

DROP TABLE IF EXISTS `tb_detail_presensi`;

CREATE TABLE `tb_detail_presensi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `presensi_id` bigint(20) unsigned DEFAULT NULL,
  `nomor_cacah_krama_mipil` char(18) DEFAULT NULL,
  `uid_kartu` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `presensi_id` (`presensi_id`),
  CONSTRAINT `tb_detail_presensi_ibfk_1` FOREIGN KEY (`presensi_id`) REFERENCES `tb_presensi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_detail_presensi` */

insert  into `tb_detail_presensi`(`id`,`presensi_id`,`nomor_cacah_krama_mipil`,`uid_kartu`,`created_at`,`updated_at`,`deleted_at`) values 
(1,2,'123456','test','2022-06-23 10:19:58','2022-06-23 10:19:58',NULL),
(2,2,'1234','1234','2022-06-23 10:35:20','2022-06-23 10:35:20',NULL),
(3,2,'12345','1234567890','2022-06-23 10:59:32','2022-06-23 10:59:32',NULL),
(4,2,'123456','test','2022-06-23 10:59:41','2022-06-23 10:59:41',NULL),
(5,2,'12345','1234567890','2022-06-23 11:04:29','2022-06-23 11:04:29',NULL),
(6,2,'03250101311278001','test123','2022-06-23 11:06:36','2022-06-23 11:06:36',NULL),
(7,2,'03250101311278001','test123','2022-06-23 11:09:18','2022-06-23 11:09:18',NULL),
(8,2,'03250101311278001','test123','2022-06-23 11:09:37','2022-06-23 11:09:37',NULL);

/*Table structure for table `tb_m_kegiatan` */

DROP TABLE IF EXISTS `tb_m_kegiatan`;

CREATE TABLE `tb_m_kegiatan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_m_kegiatan` */

insert  into `tb_m_kegiatan`(`id`,`nama_kegiatan`,`keterangan`,`created_at`,`deleted_at`,`updated_at`) values 
(1,'duar','duar keterangannya anjay','2022-06-22 10:05:14',NULL,'2022-06-22 10:05:14');

/*Table structure for table `tb_presensi` */

DROP TABLE IF EXISTS `tb_presensi`;

CREATE TABLE `tb_presensi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kegiatan_id` int(10) unsigned DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tgl_open` date DEFAULT NULL,
  `tgl_close` date DEFAULT NULL,
  `is_open` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kegiatan_id` (`kegiatan_id`),
  CONSTRAINT `tb_presensi_ibfk_1` FOREIGN KEY (`kegiatan_id`) REFERENCES `tb_m_kegiatan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_presensi` */

insert  into `tb_presensi`(`id`,`kegiatan_id`,`keterangan`,`tgl_open`,`tgl_close`,`is_open`,`created_at`,`deleted_at`,`updated_at`) values 
(1,NULL,'test presensi 123','2022-01-30','2022-02-02',0,'2022-06-22 10:06:34',NULL,'2022-06-22 10:06:34'),
(2,1,'test presensi 2','2022-01-30','2022-02-02',1,'2022-06-22 10:07:13',NULL,'2022-06-22 10:07:13');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
