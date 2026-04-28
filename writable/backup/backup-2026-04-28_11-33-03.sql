-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sfacard
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aspirasi`
--

DROP TABLE IF EXISTS `aspirasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aspirasi` (
  `id_aspirasi` int(10) NOT NULL,
  `kategori` enum('kerusakan','kinerja_guru','kebijakan_sekolah') NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id_aspirasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aspirasi`
--

LOCK TABLES `aspirasi` WRITE;
/*!40000 ALTER TABLE `aspirasi` DISABLE KEYS */;
INSERT INTO `aspirasi` VALUES (1,'kerusakan','wrgreg'),(2,'kinerja_guru','hfgkmtuhjkmjum'),(4,'kebijakan_sekolah','ertyhrthrhyh');
/*!40000 ALTER TABLE `aspirasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengaduan` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `isi_feedback` text NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id_feedback`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (54,72,0,'baik sedang dijallankan','0000-00-00 00:00:00'),(55,81,0,'iyya siap tunggu sedang proses','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifikasi`
--

DROP TABLE IF EXISTS `notifikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifikasi` (
  `id_notifikasi` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `pesan` text NOT NULL,
  `status` enum('belum','dibaca') NOT NULL,
  PRIMARY KEY (`id_notifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifikasi`
--

LOCK TABLES `notifikasi` WRITE;
/*!40000 ALTER TABLE `notifikasi` DISABLE KEYS */;
INSERT INTO `notifikasi` VALUES (2,1241,'Ada pengaduan baru dari user','dibaca'),(5,1241,'Ada pengaduan baru dari user','belum'),(6,1241,'Ada pengaduan baru dari user','belum'),(7,1241,'Ada pengaduan baru dari user','belum'),(8,1241,'Ada pengaduan baru dari user','belum'),(9,1241,'Ada pengaduan baru dari user','belum'),(11,1241,'Ada pengaduan baru dari user','belum'),(13,1241,'Ada pengaduan baru dari user','belum'),(15,1241,'Ada pengaduan baru dari user','belum'),(17,1241,'Ada pengaduan baru dari user','belum'),(19,1241,'Ada pengaduan baru dari user','belum'),(21,1241,'Ada pengaduan baru dari user','belum'),(22,1242,'Status pengaduan anda telah diperbarui','belum'),(23,1242,'Status pengaduan anda telah diperbarui','belum'),(29,1242,'Status pengaduan anda telah diperbarui','belum'),(37,1239,'Pengaduan Anda ditolak. Alasan: GJ',''),(38,1239,'Pengaduan Anda ditolak. Alasan: gj',''),(39,1239,'Pengaduan Anda ditolak. Alasan: mhon maap banget ini mah',''),(40,1234,'Pengaduan baru dari user: Farhan Mubarok',''),(41,1234,'Pengaduan baru dari user: Farhan Mubarok',''),(42,1234,'Pengaduan baru dari user: Farhan Mubarok',''),(43,1234,'Pengaduan baru dari user: Karisa Wulan Dini',''),(44,1234,'Pengaduan baru dari user: Farhan Mubarok',''),(45,1234,'Pengaduan baru dari user: Siti Kartika S.Kom',''),(46,1234,'Pengaduan baru dari user: Siti Humairoh Nurul Samsa','');
/*!40000 ALTER TABLE `notifikasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengaduan`
--

DROP TABLE IF EXISTS `pengaduan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengaduan` (
  `id_pengaduan` int(10) NOT NULL AUTO_INCREMENT,
  `id_aspirasi` int(10) DEFAULT NULL,
  `id_user` int(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `lokasi` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('menunggu','proses','selesai','ditolak') NOT NULL,
  `waktu_proses` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pengaduan`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengaduan`
--

LOCK TABLES `pengaduan` WRITE;
/*!40000 ALTER TABLE `pengaduan` DISABLE KEYS */;
INSERT INTO `pengaduan` VALUES (81,1,1247,'kaca kelas pecah','1777375466_4c5d856a87e1764dd20f.jpg','kelas 12','ada yang melempar batu orang tidak dikenal','2026-04-28','proses',NULL,NULL),(82,2,1239,'pembahasan materi ',NULL,'kelas 12','beda dengan pelajaran yang ada','2026-04-28','menunggu',NULL,NULL),(83,4,1245,'banyak siswa yang ingin terlibat dengan lomba',NULL,'Smk AL-Ma\'mun','pertimbangkan dengan diadakanya rapat','2026-04-28','menunggu',NULL,NULL),(84,4,1246,'MBG ',NULL,'kelas 12','mau sehari 2 kali','2026-04-28','ditolak',NULL,NULL);
/*!40000 ALTER TABLE `pengaduan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penolakan`
--

DROP TABLE IF EXISTS `penolakan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penolakan` (
  `id_penolakan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengaduan` int(11) NOT NULL,
  `alasan_penolakan` text NOT NULL,
  `tanggal_penolakan` datetime DEFAULT current_timestamp(),
  `id_admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_penolakan`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penolakan`
--

LOCK TABLES `penolakan` WRITE;
/*!40000 ALTER TABLE `penolakan` DISABLE KEYS */;
INSERT INTO `penolakan` VALUES (1,65,'Aspirasi ditolak oleh admin','2026-04-27 20:50:59',NULL),(2,65,'Aspirasi ditolak oleh admin','2026-04-27 20:51:03',NULL),(3,74,'Aspirasi ditolak oleh admin','2026-04-27 20:51:11',NULL),(4,65,'Aspirasi ditolak oleh admin','2026-04-27 20:58:31',NULL),(5,65,'Aspirasi ditolak oleh admin','2026-04-27 20:58:44',NULL),(6,65,'Aspirasi ditolak oleh admin','2026-04-27 21:05:18',NULL),(7,65,'Aspirasi ditolak oleh admin','2026-04-27 21:05:25',NULL),(8,65,'Aspirasi ditolak oleh admin','2026-04-27 21:05:38',NULL),(9,65,'Aspirasi ditolak oleh admin','2026-04-27 21:05:41',NULL),(10,65,'YFYUFY','2026-04-28 02:22:21',1234),(11,75,'tdk logis','2026-04-28 02:29:55',1234),(12,65,'ugugui','2026-04-28 03:44:13',1234),(13,65,'jhfhjfkju','2026-04-28 03:49:43',1234),(14,65,'gaje','2026-04-28 04:00:46',1234),(15,65,'p;lkhuj;','2026-04-28 04:04:24',1234),(16,65,'fgfdgd','2026-04-28 04:04:50',1234),(17,68,'GA JELAS','2026-04-28 04:16:47',1234),(18,65,'GJ','2026-04-28 06:00:33',1234),(19,67,'gj','2026-04-28 06:00:43',1234),(20,68,'mhon maap banget ini mah','2026-04-28 06:05:19',1234),(21,66,'fdgfdg','2026-04-28 11:16:49',1234),(22,84,'tidak bisa dikarenkan itu sudah dibagi rata satu satu persiswa','2026-04-28 11:32:25',1234);
/*!40000 ALTER TABLE `penolakan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progres_pengaduan`
--

DROP TABLE IF EXISTS `progres_pengaduan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `progres_pengaduan` (
  `id_progres` int(10) NOT NULL AUTO_INCREMENT,
  `id_pengaduan` int(10) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `progres` int(11) DEFAULT NULL,
  `tindakan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_progres`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progres_pengaduan`
--

LOCK TABLES `progres_pengaduan` WRITE;
/*!40000 ALTER TABLE `progres_pengaduan` DISABLE KEYS */;
INSERT INTO `progres_pengaduan` VALUES (1,57,'2026-04-22 13:40:51',50,'tjghmngh','1776840051_bba311b6e9bb2cd174ea.jpg',1),(2,57,'2026-04-23 01:02:42',55,'dgergeg','1776880962_f32587341b911a38fb69.jpg',500000),(3,60,'2026-04-23 01:09:43',50,'yrujyg','1776881383_35259a54141b34742d67.jpg',50000),(4,60,'2026-04-23 01:25:22',50,'ugg8gg','1776882322_81e57cef833b6d692c2b.jpg',50000),(5,60,'2026-04-23 01:28:17',58,'tryh',NULL,5000),(6,60,'2026-04-23 01:28:17',58,'tryh','1776882497_3c35d975e55134fc8355.jpg',5000),(7,60,'2026-04-22 18:41:06',50,'ttttgnm','1776883266_ce78e1442b75716b1567.jpg',50000),(8,60,'2026-04-23 03:01:52',50,'ydtdiyfyuf','1776913312_6be621da49a959eb6dd9.jpg',23000),(9,61,'2026-04-24 06:22:36',50,'pppp','1777011756_67602c49c19c4231661f.jpg',500000),(10,65,'2026-04-26 12:42:30',50,'sedang diperbaiki','1777207350_097fe6faa51375497635.jpg',1000000),(11,74,'2026-04-27 00:00:00',90,'Feedback: fytjyh',NULL,NULL),(12,65,'2026-04-27 11:03:54',100,'cghcv','1777287834_368f864d0e348ff75c95.jpg',500000),(13,67,'2026-04-27 11:15:08',50,'gtmkjg','1777288508_6a593175622fed35a654.jpg',50000),(14,68,'2026-04-27 11:35:51',20,'jhk','1777289751_6c3cd7c14df6de67b2dc.jpg',500000),(15,68,'2026-04-27 11:36:34',0,'',NULL,0),(16,68,'2026-04-27 11:36:34',0,'',NULL,0),(17,72,'2026-04-27 11:48:20',50,'ghgfh','1777290500_5d18c59947b2d83ff0f2.jpg',500000),(18,81,'2026-04-28 11:30:37',50,'sedang dikerjakan','1777375837_f5a66bdd8102a2727b5d.jpg',250000);
/*!40000 ALTER TABLE `progres_pengaduan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','guru','siswa','') NOT NULL,
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=1248 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1234,'Ayu Riska Diana S.Sos','ayuadmin','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','admin','1777356496_5903e3dae99aa517e784.jpg'),(1239,'Farhan Mubarok','farhanm','$2y$10$mnN2BtSu9iuzV7ycxeS35OOZMNR7slaABpLxqQO/LMc5bBF0YLc06','siswa','1775616549_db49d79c99502d9b1ab6.jpg'),(1242,'reza s.pd','eza','$2y$10$LZQltslf4DcTh5iogqU.l.H60IM1937oYnFJu4aSesFvbmwiRCp82','guru','1777351290_87e14fd2ea4ec5dcb741.jpg'),(1245,'Siti Kartika S.Kom','tikaw','$2y$10$kU2QVcqWzPHFEw6iWfMoruVOnnuvkFK./W.E1wbKJgLqHbnFNSspO','guru','1777294594_d7fb5bffc91f8fa16820.jpg'),(1246,'Siti Humairoh Nurul Samsa','Umay','$2y$10$7jAERwXxRCKq4SAynzRVgOioiHrpSEyzK6GjhSwk8yoDYTkqSd65m','siswa','1777294641_84074f899fe3dd347271.jpg'),(1247,'Karisa Wulan Dini','icaa','$2y$10$hV1QXQ9SOGd2RdmGvVX6d.Nh.JOW519YvuTZzKf/Hu2r4laAtn2k.','siswa','1777375397_72b80c080033a0775e67.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-28 18:33:04
