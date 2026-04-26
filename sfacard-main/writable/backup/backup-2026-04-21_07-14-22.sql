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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,1234,0,'','2026-04-11 00:00:00'),(2,1234,0,'','2026-04-11 00:00:00'),(3,1234,0,'silahkan sudah dibenarkan','2026-04-11 00:00:00'),(4,1234,0,'silahkan sudah dibenarkan','2026-04-11 00:00:00'),(5,1234,0,'silahkan sudah dibenarkan','2026-04-11 00:00:00'),(6,1234,0,'fgdmjgfdm','2026-04-11 00:00:00'),(7,1,0,'dsba','2026-04-11 00:00:00'),(8,1,0,'sudah selesai terimakasih','2026-04-11 00:00:00'),(9,1234,0,'/ljliolo','2026-04-11 00:00:00'),(10,1,0,'terimakasih atas aspirasinya','2026-04-11 00:00:00'),(11,1,0,'terimakasih atas aspirasinya','2026-04-11 00:00:00'),(12,1,0,'','2026-04-11 00:00:00'),(13,5,0,'sudah [isan','2026-04-11 00:00:00'),(14,11,0,'swewrvv','2026-04-11 00:00:00'),(15,2,0,'hgjl,','2026-04-11 00:00:00'),(16,2,0,'hgjl,','2026-04-11 00:00:00'),(17,9,0,'sudahh','2026-04-11 00:00:00'),(18,6,0,'sudahhh','2026-04-11 00:00:00'),(19,7,0,'syudah','2026-04-11 00:00:00'),(20,6,0,'sudahhh','2026-04-11 00:00:00'),(21,6,0,'sudahhh','2026-04-11 00:00:00'),(22,5,0,'xngmjn','2026-04-11 00:00:00'),(23,12,0,'gcmmmmmm,mh','2026-04-11 00:00:00'),(24,13,0,'fxjmcd','2026-04-11 00:00:00'),(25,5,0,'\r\n=oo','2026-04-11 00:00:00'),(26,5,0,'\r\n=oo','2026-04-11 00:00:00'),(27,5,0,'sudahhh','2026-04-15 00:00:00'),(28,14,0,'sad','2026-04-15 00:00:00'),(29,5,0,'','2026-04-15 00:00:00'),(30,5,0,'terimakasih sudah dilaksanakan\r\n','0000-00-00 00:00:00'),(31,5,0,'ttt','0000-00-00 00:00:00'),(32,5,0,'dsbb','0000-00-00 00:00:00'),(33,18,0,'sudahh seleai','0000-00-00 00:00:00'),(34,5,0,'sudah yah','0000-00-00 00:00:00'),(35,15,0,'sudahh yah','0000-00-00 00:00:00'),(36,15,0,'jhg,','0000-00-00 00:00:00'),(37,19,0,'vdv','0000-00-00 00:00:00'),(38,24,0,'kjhl','0000-00-00 00:00:00'),(39,27,0,'guik,','0000-00-00 00:00:00'),(40,42,0,'y','0000-00-00 00:00:00'),(41,45,0,'terimksh\r\n','0000-00-00 00:00:00'),(42,43,0,'sudahh','0000-00-00 00:00:00'),(43,44,0,'dahh','0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifikasi`
--

LOCK TABLES `notifikasi` WRITE;
/*!40000 ALTER TABLE `notifikasi` DISABLE KEYS */;
INSERT INTO `notifikasi` VALUES (1,1234,'Ada pengaduan baru dari user','belum'),(2,1241,'Ada pengaduan baru dari user','belum'),(3,1239,'Status pengaduan anda telah diperbarui','belum'),(4,1234,'Ada pengaduan baru dari user','belum'),(5,1241,'Ada pengaduan baru dari user','belum'),(6,1241,'Ada pengaduan baru dari user','belum'),(7,1241,'Ada pengaduan baru dari user','belum'),(8,1241,'Ada pengaduan baru dari user','belum'),(9,1241,'Ada pengaduan baru dari user','belum'),(10,1234,'Ada pengaduan baru dari user','belum'),(11,1241,'Ada pengaduan baru dari user','belum'),(12,1234,'Ada pengaduan baru dari user','belum'),(13,1241,'Ada pengaduan baru dari user','belum'),(14,1234,'Ada pengaduan baru dari user','belum'),(15,1241,'Ada pengaduan baru dari user','belum'),(16,1234,'Ada pengaduan baru dari user','belum'),(17,1241,'Ada pengaduan baru dari user','belum'),(18,1234,'Ada pengaduan baru dari user','belum'),(19,1241,'Ada pengaduan baru dari user','belum'),(20,1234,'Ada pengaduan baru dari user','belum'),(21,1241,'Ada pengaduan baru dari user','belum'),(22,1242,'Status pengaduan anda telah diperbarui','belum'),(23,1242,'Status pengaduan anda telah diperbarui','belum');
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
  PRIMARY KEY (`id_pengaduan`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengaduan`
--

LOCK TABLES `pengaduan` WRITE;
/*!40000 ALTER TABLE `pengaduan` DISABLE KEYS */;
INSERT INTO `pengaduan` VALUES (19,1,1239,'pintu kelas','1776410319_64731b8078b5d8adcbb0.png','kelas 12','udah banyak rinyuh','2026-04-17','selesai'),(24,1,1240,'mauu apaa yakk','1776411009_f66fab567ab60f2863f9.jpg','sdfbhrfyhkm','ioghughuhi','2026-04-17','selesai'),(42,1,1239,'mauu apaa yakk','1776438310_741f70159d4305cb7898.jpg','toilet bawah','knnhlhilgf','2026-04-17','selesai'),(43,2,1239,'mauu apaa yakk','1776448359_8429bfc5a66dd34fa502.jpg','rgyer','etrhgeth','2026-04-18','selesai'),(44,1,1239,'mauu apaa yakk','1776448440_a156f55475cf439818b1.jpg','toilet bawah','iyfl','2026-04-18','selesai'),(45,4,1239,'hgm','1776475989_851e7d1b5da7cafe4432.jpg','gjdm','ghmxn','2026-04-18','selesai'),(46,2,1242,'mauu apaa yakk','1776650663_e5dc6381fc7e4b76a3f5.jpg','toilet bawah','wqcdwvc','2026-04-20','proses'),(47,1,1239,'mauu apaa yakk','1776659014_2f712d9782db816d4de0.png','toilet bawah','tjeanjargn','2026-04-20','menunggu'),(48,4,1242,'mau nonton','1776659920_1b34c5ffb7af8de061fe.png','ehbtdnhb','rawymntnyn','2026-04-20','menunggu'),(49,4,1239,'mauu apaa yakk','1776667022_aae26c552ca170fee08b.jpg','toilet bawah','c ghcgcghcgcg','2026-04-20','menunggu'),(50,1,1240,'mauu apaa yakk','1776671101_7b93400c76f9043c8f44.png','sdfbhrfyhkm','sagfdbgfdbfdb','2026-04-20','menunggu'),(51,1,1240,'mauu apaa yakk','1776671101_5db9d8863cc97147a79c.png','sdfbhrfyhkm','sagfdbgfdbfdb','2026-04-20','menunggu'),(52,2,1240,'mau nonton','1776738319_1a160074aea6dcb955d4.jpg','toilet bawah','rwgrehgte','2026-04-21','menunggu'),(53,2,1240,'mau nonton','1776738319_9557cc9faac3b07644fc.jpg','toilet bawah','rwgrehgte','2026-04-21','menunggu'),(54,1,1240,'mau nonton','1776738849_de50e0608b5c19953111.jpg','toilet bawah','fdghhfh','2026-04-21','menunggu'),(55,1,1240,'gfdjhng','1776739794_53ff5daf08dba3d523e6.jpg','fgnjhfnj','fgnjhfhnjh','2026-04-21','menunggu'),(56,1,1240,'mauu apaa yakk','1776743465_2e912cbd082d67048149.jpg','sdfbhrfyhkm','kufufufu','2026-04-21','menunggu');
/*!40000 ALTER TABLE `pengaduan` ENABLE KEYS */;
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
INSERT INTO `users` VALUES (1234,'Ayu Riska Diana S.Sos','ayuadmin','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','admin','1775615420_de54a2a3e3e805279d6a.jpg'),(1239,'Farhan Mubarok','farhanm','$2y$10$mnN2BtSu9iuzV7ycxeS35OOZMNR7slaABpLxqQO/LMc5bBF0YLc06','siswa','1775616549_db49d79c99502d9b1ab6.jpg'),(1240,'Muhammad Ridwan','ridwan','$2y$10$Db0xGfnmquJpYCIWzjoN9uQdUZsKMBkEWTST2B3gMU9VJN.UmBz8K','siswa','1776307369_ed14688ffd41d793383d.jpg'),(1241,'adel','dell','$2y$10$P5k8rKH4Tv/S8Q9YEpVQJOTPmKPZw5OvRc6LVg.AgQNhOxgD.BAe6','admin','1776441437_9c0467b0392b9a809eec.jpg'),(1242,'reza s.pd','eza','$2y$10$LZQltslf4DcTh5iogqU.l.H60IM1937oYnFJu4aSesFvbmwiRCp82','guru','1776650634_61ad1204dedb4e57e40f.jpg');
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

-- Dump completed on 2026-04-21 14:14:22
