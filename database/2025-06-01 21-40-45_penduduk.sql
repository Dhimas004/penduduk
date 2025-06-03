/*
SQLyog Ultimate
MySQL - 10.4.22-MariaDB : Database - penduduk
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`penduduk` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `penduduk`;

/*Table structure for table `data_transaksi` */

DROP TABLE IF EXISTS `data_transaksi`;

CREATE TABLE `data_transaksi` (
  `idKas` int(11) NOT NULL AUTO_INCREMENT,
  `idWarga` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'kas',
  `status_persetujuan` int(1) NOT NULL,
  `tanggal_persetujuan` datetime DEFAULT NULL,
  `user_id_persetujuan` int(11) NOT NULL,
  `alasan_penolakan` text NOT NULL,
  `buktiPembayaran` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idKas`)
) ENGINE=InnoDB AUTO_INCREMENT=40000003 DEFAULT CHARSET=utf8mb4;

/*Data for the table `data_transaksi` */

insert  into `data_transaksi`(`idKas`,`idWarga`,`keterangan`,`tanggal`,`jumlah`,`jenis`,`status`,`status_persetujuan`,`tanggal_persetujuan`,`user_id_persetujuan`,`alasan_penolakan`,`buktiPembayaran`,`created_at`,`updated_at`) values 
(30000001,0,'Beli Printer L5190','2021-07-01','3750000','keluar','kas',0,NULL,0,'','','2025-05-06 18:38:11','2025-05-06 18:38:11'),
(30000004,0,'pembelian dispenser','2021-07-04','560000','keluar','kas',0,NULL,0,'','','2025-05-06 18:38:11','2025-05-06 18:38:11'),
(30000005,0,'pembelian atk','2021-07-04','100000','keluar','kas',0,NULL,0,'','','2025-05-06 18:38:11','2025-05-06 18:38:11'),
(30000006,0,'Lomba agustus','2021-07-14','3000000','keluar','kas',0,NULL,0,'','','2025-05-06 18:38:11','2025-05-06 18:38:11'),
(30000008,0,'testing','2025-05-14','2000','masuk','kas',0,NULL,0,'','','2025-05-14 21:11:30','2025-05-14 21:11:30'),
(30000009,7,'asd','2025-05-14','10000','masuk','kas',0,NULL,0,'','bcb173d328d6db6838553037abadf2e4.png','2025-05-14 21:27:31','2025-05-14 21:27:31'),
(40000001,6,'','2025-05-06','50000','masuk','sampah',1,'2025-06-01 15:23:00',3,'','','2025-05-06 20:45:10','2025-05-06 20:45:10'),
(40000002,7,'Pembayaran Sampah','2025-06-01','50000','masuk','sampah',1,'2025-06-01 15:24:43',3,'','','2025-06-01 20:23:30','2025-06-01 20:23:30');

/*Table structure for table `data_warga` */

DROP TABLE IF EXISTS `data_warga`;

CREATE TABLE `data_warga` (
  `idWarga` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jekel` varchar(20) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `rt_rw` varchar(7) NOT NULL,
  `status_perkawinan` varchar(20) NOT NULL,
  `nama_pasangan` varchar(100) NOT NULL,
  `nama_anak_1` varchar(100) NOT NULL,
  `nama_anak_2` varchar(100) NOT NULL,
  `nama_anak_3` varchar(100) NOT NULL,
  `nama_anak_4` varchar(100) NOT NULL,
  `nama_anak_5` varchar(100) NOT NULL,
  PRIMARY KEY (`idWarga`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `data_warga` */

insert  into `data_warga`(`idWarga`,`nik`,`nama`,`jekel`,`tempat_lahir`,`tanggal_lahir`,`alamat`,`rt_rw`,`status_perkawinan`,`nama_pasangan`,`nama_anak_1`,`nama_anak_2`,`nama_anak_3`,`nama_anak_4`,`nama_anak_5`) values 
(1,'111222333444556','Yohan Riki','laki-laki','Pati','1996-10-16','Cilincing, Jakarta Utara','','belum_menikah','','','','','asd',''),
(3,'222333111444555','Ahmad Sidiq','laki-laki','Semarang','1995-02-10','bekasi utara','1','belum_menikah','','','','','',''),
(4,'1112221113334444','Echa Jesica','perempuan','Yogyakarta','2000-02-16','bekasi utara','','','','','','','',''),
(5,'111222111222444','Rudi Hidayat','laki-laki','Pati','1999-06-09','Jakarta Utara','','','','','','','',''),
(6,'333222111444555','Elisabet','perempuan','Semarang','2001-06-07','Jakarta Utara','','','','','','','','');

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`role`) values 
(1,'Ketua RT'),
(4,'Warga'),
(5,'Bendahara');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL,
  `img` varchar(50) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `idWarga` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`user_id`,`user`,`username`,`password`,`img`,`is_active`,`role_id`,`email`,`idWarga`) values 
(3,'RT','rt','$2y$10$SAg1rT/oQ.ce4HkqWqCycuBenzL9D3seQYp.4WKRrEx3rdPspDun2','admin.png',1,1,'admin@admin.com',''),
(6,'Warga','warga','$2y$10$JJxyV8r7h67EE08ULbyGqOeElezM2hf5eq6ijGdpyaiw5KmyRC0OW','avatar.png',1,4,'','7'),
(8,'Bendahara','bendahara','$2y$10$h3eoodnsRoDBctLNZXc5e.LJqSIOF1JvWxRXLncbH57xdn2b1kq.W','avatar.png',1,5,'','Pilih ...');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
