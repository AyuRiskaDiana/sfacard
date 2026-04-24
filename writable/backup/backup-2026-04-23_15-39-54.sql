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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (2,1234,0,'','2026-04-11 00:00:00'),(3,1234,0,'silahkan sudah dibenarkan','2026-04-11 00:00:00'),(4,1234,0,'silahkan sudah dibenarkan','2026-04-11 00:00:00'),(5,1234,0,'silahkan sudah dibenarkan','2026-04-11 00:00:00'),(6,1234,0,'fgdmjgfdm','2026-04-11 00:00:00'),(7,1,0,'dsba','2026-04-11 00:00:00'),(8,1,0,'sudah selesai terimakasih','2026-04-11 00:00:00'),(9,1234,0,'/ljliolo','2026-04-11 00:00:00'),(10,1,0,'terimakasih atas aspirasinya','2026-04-11 00:00:00'),(11,1,0,'terimakasih atas aspirasinya','2026-04-11 00:00:00'),(12,1,0,'','2026-04-11 00:00:00'),(13,5,0,'sudah [isan','2026-04-11 00:00:00'),(14,11,0,'swewrvv','2026-04-11 00:00:00'),(15,2,0,'hgjl,','2026-04-11 00:00:00'),(16,2,0,'hgjl,','2026-04-11 00:00:00'),(17,9,0,'sudahh','2026-04-11 00:00:00'),(18,6,0,'sudahhh','2026-04-11 00:00:00'),(19,7,0,'syudah','2026-04-11 00:00:00'),(20,6,0,'sudahhh','2026-04-11 00:00:00'),(21,6,0,'sudahhh','2026-04-11 00:00:00'),(22,5,0,'xngmjn','2026-04-11 00:00:00'),(23,12,0,'gcmmmmmm,mh','2026-04-11 00:00:00'),(26,5,0,'\r\n=oo','2026-04-11 00:00:00'),(27,5,0,'sudahhh','2026-04-15 00:00:00'),(28,14,0,'sad','2026-04-15 00:00:00'),(29,5,0,'','2026-04-15 00:00:00'),(30,5,0,'terimakasih sudah dilaksanakan\r\n','0000-00-00 00:00:00'),(31,5,0,'ttt','0000-00-00 00:00:00'),(32,5,0,'dsbb','0000-00-00 00:00:00'),(33,18,0,'sudahh seleai','0000-00-00 00:00:00'),(34,5,0,'sudah yah','0000-00-00 00:00:00'),(35,15,0,'sudahh yah','0000-00-00 00:00:00'),(36,15,0,'jhg,','0000-00-00 00:00:00'),(37,19,0,'vdv','0000-00-00 00:00:00'),(38,24,0,'kjhl','0000-00-00 00:00:00'),(39,27,0,'guik,','0000-00-00 00:00:00'),(40,42,0,'y','0000-00-00 00:00:00'),(41,45,0,'terimksh\r\n','0000-00-00 00:00:00'),(42,43,0,'sudahh','0000-00-00 00:00:00'),(43,44,0,'dahh','0000-00-00 00:00:00'),(44,47,0,'dahhh sengg','0000-00-00 00:00:00'),(45,57,0,'yyyyy','0000-00-00 00:00:00'),(46,59,0,'mhkxghm','0000-00-00 00:00:00'),(47,58,0,'ghmjxgtm','0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifikasi`
--

LOCK TABLES `notifikasi` WRITE;
/*!40000 ALTER TABLE `notifikasi` DISABLE KEYS */;
INSERT INTO `notifikasi` VALUES (2,1241,'Ada pengaduan baru dari user','dibaca'),(3,1239,'Status pengaduan anda telah diperbarui','belum'),(5,1241,'Ada pengaduan baru dari user','belum'),(6,1241,'Ada pengaduan baru dari user','belum'),(7,1241,'Ada pengaduan baru dari user','belum'),(8,1241,'Ada pengaduan baru dari user','belum'),(9,1241,'Ada pengaduan baru dari user','belum'),(11,1241,'Ada pengaduan baru dari user','belum'),(13,1241,'Ada pengaduan baru dari user','belum'),(15,1241,'Ada pengaduan baru dari user','belum'),(17,1241,'Ada pengaduan baru dari user','belum'),(19,1241,'Ada pengaduan baru dari user','belum'),(21,1241,'Ada pengaduan baru dari user','belum'),(22,1242,'Status pengaduan anda telah diperbarui','belum'),(23,1242,'Status pengaduan anda telah diperbarui','belum'),(27,1239,'Status pengaduan anda telah diperbarui','belum'),(28,1239,'Status pengaduan anda telah diperbarui','belum'),(29,1242,'Status pengaduan anda telah diperbarui','belum'),(30,1239,'Status pengaduan anda telah diperbarui','belum');
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
  `status` enum('menunggu','proses','selesai','') NOT NULL,
  `waktu_proses` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pengaduan`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengaduan`
--

LOCK TABLES `pengaduan` WRITE;
/*!40000 ALTER TABLE `pengaduan` DISABLE KEYS */;
INSERT INTO `pengaduan` VALUES (57,1,1239,'kaca kelas pecah','1776791050_ed5b73290961acb32831.jpg','kelas 11','tadi anak anak berkelahi ','2026-04-22','selesai',NULL,NULL),(58,2,1242,'pembahasan materi ','1776791116_c2290e61a6b45f35b579.jpg','kelas 12','agak kurang mengertii','2026-04-22','selesai',NULL,NULL),(59,2,1239,'mauu apaa yakk','1776826394_8e2d100e7b829284dc6d.jpg','toilet bawah','ghcjhgccfhj','2026-04-22','selesai',NULL,NULL),(60,1,1239,'mauu apaa yakk','1776881348_91da48e0abba3efbfe04.jpg','toilet bawah','tehyrsjutyd','2026-05-23','selesai',NULL,NULL),(61,1,1239,'mauu apaa yakk','1776927190_3384a5ba02aa549acc7d.jpg','toilet bawah','aewgfrehg','2026-04-23','menunggu',NULL,NULL),(62,4,1239,'mauu apaa yakk',NULL,'toilet bawah','dgjykjmu','2026-04-23','menunggu',NULL,NULL),(63,1,1239,'mauu apaa yakk','1776927419_cc75c1adf04ae7987f15.jpg','sdfbhrfyhkm','dgerh','2026-04-23','menunggu',NULL,NULL);
/*!40000 ALTER TABLE `pengaduan` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progres_pengaduan`
--

LOCK TABLES `progres_pengaduan` WRITE;
/*!40000 ALTER TABLE `progres_pengaduan` DISABLE KEYS */;
INSERT INTO `progres_pengaduan` VALUES (1,57,'2026-04-22 13:40:51',50,'tjghmngh','1776840051_bba311b6e9bb2cd174ea.jpg',1),(2,57,'2026-04-23 01:02:42',55,'dgergeg','1776880962_f32587341b911a38fb69.jpg',500000),(3,60,'2026-04-23 01:09:43',50,'yrujyg','1776881383_35259a54141b34742d67.jpg',50000),(4,60,'2026-04-23 01:25:22',50,'ugg8gg','1776882322_81e57cef833b6d692c2b.jpg',50000),(5,60,'2026-04-23 01:28:17',58,'tryh',NULL,5000),(6,60,'2026-04-23 01:28:17',58,'tryh','1776882497_3c35d975e55134fc8355.jpg',5000),(7,60,'2026-04-22 18:41:06',50,'ttttgnm','1776883266_ce78e1442b75716b1567.jpg',50000),(8,60,'2026-04-23 03:01:52',50,'ydtdiyfyuf','1776913312_6be621da49a959eb6dd9.jpg',23000);
/*!40000 ALTER TABLE `progres_pengaduan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengaduan` int(11) DEFAULT NULL,
  `id_user` int(10) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_rating`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` VALUES (11,12,0,1000,'yaadsgdfb','2026-04-21 23:50:54'),(12,47,0,5,'','2026-04-21 23:57:02'),(13,45,0,5,'','2026-04-21 23:57:45'),(14,43,0,5,'','2026-04-21 23:57:53'),(15,24,0,4,'','2026-04-21 23:58:09'),(16,59,1239,5,'AWFDEAF','2026-04-22 10:50:26'),(17,57,1239,5,'rswgvergb','2026-04-22 10:50:33'),(18,58,1234,5,'terimakasih','2026-04-22 13:13:14');
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=1243 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1234,'Ayu Riska Diana S.Sos','ayuadmin','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','admin','1775615420_de54a2a3e3e805279d6a.jpg'),(1239,'Farhan Mubarok','farhanm','$2y$10$mnN2BtSu9iuzV7ycxeS35OOZMNR7slaABpLxqQO/LMc5bBF0YLc06','siswa','1775616549_db49d79c99502d9b1ab6.jpg'),(1242,'reza s.pd','eza','$2y$10$LZQltslf4DcTh5iogqU.l.H60IM1937oYnFJu4aSesFvbmwiRCp82','guru','1776650634_61ad1204dedb4e57e40f.jpg');
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

-- Dump completed on 2026-04-23 22:39:54
