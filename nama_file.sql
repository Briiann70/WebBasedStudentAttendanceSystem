-- MySQL dump 10.13  Distrib 9.0.0, for Win64 (x86_64)
--
-- Host: localhost    Database: peminjaman_db
-- ------------------------------------------------------
-- Server version	9.0.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `absen`
--

DROP TABLE IF EXISTS `absen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `absen` (
  `id_absen` int NOT NULL AUTO_INCREMENT,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `id` int NOT NULL,
  `id_waktu_absen` int NOT NULL,
  `status` enum('Hadir','Tidak hadir','-') DEFAULT '-',
  PRIMARY KEY (`id_absen`),
  KEY `id` (`id`),
  KEY `id_waktu_absen` (`id_waktu_absen`),
  CONSTRAINT `absen_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`),
  CONSTRAINT `absen_ibfk_2` FOREIGN KEY (`id_waktu_absen`) REFERENCES `waktu_absen` (`id_waktu_absen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absen`
--

LOCK TABLES `absen` WRITE;
/*!40000 ALTER TABLE `absen` DISABLE KEYS */;
/*!40000 ALTER TABLE `absen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang`
--

LOCK TABLES `barang` WRITE;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` VALUES (1,'Mini Servo',75,'Dimension: 22mm x 11.5mm x 22.5mm Net Weight: 9 grams Operating speed:\r\n0.12second/ 60degree ( 4.8V no load)\r\nStall Torque (4.8V): 17.5oz\r\n/in (1kg/cm)\r\nTemperature range: -30 to\r\n+60\r\nDead band width: 7usec Operating voltage: 3.0V~7.2V\r\nFit for ALL kind of R/C Toys Coreless motor\r\n3 pole wure All nylon gear\r\nDual ball bearing Connector wire length\r\n','SensorSuara.jpg'),(2,'Flame sensor (Sensor Api)',78,'-	Supply Voltage: 3.3-5V\r\n-	Spectrum range: 760nm ~ 1100nm\r\n-	Detection angle: 0 - 60 degree\r\n-	Output: Digital\r\n-	Sensitivity: Adjustable: Yes\r\n-	Operating temperature: - 25 degrees Celsius ~ 85 degrees Celsius\r\n-	Size: 32 x 19mm\r\n-	Mounting hole: 2.0mm\r\n','FlameSensor.jpg'),(3,'Module Bluetooth HC05',79,'-	It is HC-05.\r\n-	Use the CSR mainstream bluetooth chip, bluetooth V2.0 protocol standards.\r\n-	Module working voltage\r\n3.3 V.\r\n-	Potter default rate of 9600, the user can be set up.\r\n-	The core module size : 28 mm x 15 mm x 2.35 mm.\r\n-	Working current: matching for 30 MA, matching the communication for 8 MA.\r\n-	Dormancy current: no dormancy.\r\n-	With computer and bluetooth bluetooth adapter, PDA, seamless connection equipment\r\n-	Commercial Series: Bluetooth module board Series\r\n-	With LED indicator light, use 150mA and 3.3V regulation chip.\r\n-	With foot for the Bluetooth\r\n-	Compatible with bluetooth master module\".slave module\"or master-slave(whole) module.\r\n-	Input voltage: 3.3~6V (5V Recomnded)\r\n- Size: 1.55cm*3.98cm\r\n','ModuleBluetooth_HC05.jpg'),(4,'     Arduino Mega 2560 R3',10,'?	Tegangan Operasianal 5V\r\n?	Tegangan Input (rekomendasi) 7-12V\r\n?	Tegangan Input (limit) 6-20V\r\n?	Pin Digital I/O	54\r\n(of which 15 provide PWM output)\r\n?	Pin Analog Input	16\r\n?	Arus DC per Pin I/O 20 mA\r\n?	Arus DC untuk Pin 3.3 V\r\n50 mA\r\n?	Memori Flash 256 KB of which 8 KB used by bootloader\r\n?	SRAM	8 KB\r\n?	EEPROM	4 KB\r\n?	Clock Speed 16 MHz\r\n?	LED_BUILTIN	13\r\n?	Panjang	101.52 mm\r\n?	Lebar	53.3 mm\r\n?	Berat	37 g\r\n','ArduinoMega2560R3.jpg'),(5,'Potensiometer B10K',80,'Impedance: kilo ohm Type: B Type Taper - linear Material: Carbon Film + Metal\r\nInterface: 3PIN\r\nShaft Length: -+15mm\r\n','PotensiometerB10K.jpg'),(6,'HC-SR04-Sensor Ultrasonik',80,'Tegangan: 5V DC Arus statis: < 2mA Level output: 5v - 0V\r\nSudut sensor: < 15 derajat Jarak yg bisa dideteksi: 2cm\r\n- 450cm (4.5m)\r\nTingkat keakuratan: up to\r\n0.3cm (3mm)\r\n','HC-SR04-SensorUltrasonik.jpg'),(7,' HDMI converter(macro) to VGA',18,'Support 1080p full hd HDMI Version 1.4\r\nCocok untuk melihat video\r\ndan audio HD\r\n','HDMIconverter(macro)toVGA.jpg'),(8,'Relay module 2 channel output optocoupler 5V 10A ch 250VAC',80,'2-Channel Relay breakout Power supply range from 5V~7.5V Onboard Photocoupler isolation Equiped with high-current relay, AC250V 10A ; DC30V\r\n10A. Relay Output\r\nIndicator LED\r\n','Relaymodule2channeloutputoptocoupler5V10Ach250VAC.jpg'),(9,'Sensor Suara',79,'There is a mounting screw hole 3mm\r\n>The use 5v DC power supply\r\n>With analog output\r\n>There are threshold level output flip\r\n>High sensitive\r\nmicrophone.\r\n>Builtin power LED indicator and comparator output LED indicator\r\n>Microphone sensitivity (1Khz): 52-48dB\r\n>Microphone Impedance: 2.2K\r\n>Microphone Frequency: 16-20Khz\r\n>Microphone S/N ratio:\r\n54dB\r\n','SensorSuara.jpg'),(10,'Dot Matrix 8x8',76,'Emitted Colour: Red. Type: common anode.\r\nLed Size: 3mm.\r\nPeak Wave Length (nm) : 625 ~ 630.\r\nForward Voltage (V) : 2.1 ~ 2.5.\r\nReverse Current (uA) : <= 20.\r\nMax Power Dissipation(PM): 40mW. Max Peak Forward Current(IFP): 100mA. Max Continuous Forward Current(IFM): 20mA. Lead Soldering\r\nTemperature : 260 Degree (<5Sec).\r\nOperating Temperature Range : -30 ~ +70 Degree. Preservative Temperature Range : -40 ~ +85 Degree. Size: 32mm X 32mm X\r\n8.0mm.\r\n','DotMartix8X8.jpg'),(13,'Module Bluetooth HC05',1,'bla','ArduinoMega2560R3.jpg');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course` (
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `semester` varchar(10) NOT NULL,
  PRIMARY KEY (`kode_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES ('1332105','Dasar Elektronika','5'),('1332205','Sistem Tertanam','4');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dosen`
--

DROP TABLE IF EXISTS `dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dosen` (
  `id_dosen` int NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `kode_mk` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_dosen`),
  KEY `fk_kode_mk` (`kode_mk`),
  CONSTRAINT `fk_kode_mk` FOREIGN KEY (`kode_mk`) REFERENCES `course` (`kode_mk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dosen`
--

LOCK TABLES `dosen` WRITE;
/*!40000 ALTER TABLE `dosen` DISABLE KEYS */;
INSERT INTO `dosen` VALUES (1,'dinding','1332105','dia','dia'),(31,'kasur','1332205','kasur','kasur');
/*!40000 ALTER TABLE `dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pinjambarang`
--

DROP TABLE IF EXISTS `pinjambarang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pinjambarang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_barang` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `lokasi_barang` text,
  `status` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pinjambarang`
--

LOCK TABLES `pinjambarang` WRITE;
/*!40000 ALTER TABLE `pinjambarang` DISABLE KEYS */;
INSERT INTO `pinjambarang` VALUES (1,1,2,5,'2021-04-04 12:42:47','2021-04-06 12:42:00','gudang','selesai'),(2,1,2,1,'2021-04-06 11:11:43','2021-04-23 11:16:00','ads','selesai'),(3,3,2,1,'2022-05-05 00:00:00','2022-05-31 00:00:00','IT DEL','approve'),(4,4,3,1,'2022-05-05 00:00:00','2022-06-01 00:00:00','IT DEL','approve'),(5,5,3,1,'2022-05-15 00:00:00','2022-05-31 00:00:00','del\r\n','approve'),(6,1,10,1,'2022-05-20 00:00:00','2022-05-31 00:00:00','Itdel','approve'),(7,9,10,1,'2022-05-20 00:00:00','2022-06-29 00:00:00','itdel','selesai'),(8,9,10,1,'2022-05-20 00:00:00','2022-06-29 00:00:00','itdel','menunggu'),(9,7,10,1,'2022-05-20 00:00:00','2022-07-29 00:00:00','ItDel','menunggu'),(10,10,10,4,'2022-05-20 00:00:00','2022-07-07 00:00:00','It Del','menunggu'),(21,8,11,1,'2022-06-12 00:00:00','2022-06-30 00:00:00','IT DEL','selesai');
/*!40000 ALTER TABLE `pinjambarang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ruangan`
--

DROP TABLE IF EXISTS `ruangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ruangan` (
  `id_ruangan` varchar(10) NOT NULL,
  `nama_ruangan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_ruangan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ruangan`
--

LOCK TABLES `ruangan` WRITE;
/*!40000 ALTER TABLE `ruangan` DISABLE KEYS */;
INSERT INTO `ruangan` VALUES ('1','513'),('2','514');
/*!40000 ALTER TABLE `ruangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `norfid` varchar(255) DEFAULT NULL,
  `angkatan` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin','admin','admin',NULL,NULL),(2,'user','user','user','user',NULL,NULL),(3,'Brian Daniel Napitupulu','ce321036','briiann70','user','DADAS123SA',2021),(7,'admin2','admin2','admin2','admin',NULL,NULL),(8,'admin2','admin3','admin3','admin',NULL,NULL),(9,'Jeremy Pardede','jeremy12','jeremy12','user','SDAJK213DAS',2022),(10,'Salmanso','salman12','salman12','user','SAD123SAD',2023),(11,'Brian','brian','brian','user','IOASD21312',2024),(13,'Dosen','dosen','dosen123','dosen',NULL,NULL),(14,'Asita Tambunan','asita','$2y$10$HtNbeg7RUKwNgzhq.G3fMOhUw5hek0SkhPZqwNOJS4oSoAWR/XT62',NULL,'NSDASNI21',2021),(15,'Kingkong','stanlly','$2y$10$Pn8FrSxsPb/VP2aP2ZSuQOswDs2HQ..RC1pyz9J1bhlUx19lL2tga',NULL,'PASDKDSA2',2024),(16,'Muliadi Simanjuntak','muliadi1','$2y$10$2KQnnER1c9tYApLi1yM0Keq1TE8gBMqBxNHVobYaumdlRqkMiFXam',NULL,'NKDAS123',2021);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `waktu_absen`
--

DROP TABLE IF EXISTS `waktu_absen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `waktu_absen` (
  `id_waktu_absen` int NOT NULL AUTO_INCREMENT,
  `waktu_mulai` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `kode_mk` varchar(10) DEFAULT NULL,
  `id_ruangan` varchar(10) DEFAULT NULL,
  `angkatan` int DEFAULT NULL,
  `id_dosen` int DEFAULT NULL,
  PRIMARY KEY (`id_waktu_absen`),
  KEY `kode_mk` (`kode_mk`),
  KEY `id_ruangan` (`id_ruangan`),
  KEY `idx_id_dosen` (`id_dosen`),
  CONSTRAINT `fk_id_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`),
  CONSTRAINT `waktu_absen_ibfk_1` FOREIGN KEY (`kode_mk`) REFERENCES `course` (`kode_mk`),
  CONSTRAINT `waktu_absen_ibfk_2` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `waktu_absen`
--

LOCK TABLES `waktu_absen` WRITE;
/*!40000 ALTER TABLE `waktu_absen` DISABLE KEYS */;
INSERT INTO `waktu_absen` VALUES (22,'2024-08-12 08:00:00','2024-08-12 08:00:00','1332105','1',NULL,NULL),(23,'2024-08-12 09:00:00','2024-08-12 09:00:00','1332105','1',NULL,NULL),(24,'2024-08-12 10:00:00','2024-08-12 10:00:00','1332105','1',NULL,NULL),(25,'2024-08-12 11:00:00','2024-08-12 11:00:00','1332105','1',NULL,NULL),(26,'2024-08-12 12:00:00','2024-08-12 12:00:00','1332105','1',NULL,NULL),(27,'2024-08-12 13:00:00','2024-08-12 13:00:00','1332105','1',NULL,NULL),(28,'2024-08-12 14:00:00','2024-08-12 14:00:00','1332105','1',NULL,NULL),(29,'2024-08-12 15:00:00','2024-08-12 15:00:00','1332105','1',NULL,NULL),(30,'2024-08-12 16:00:00','2024-08-12 16:00:00','1332105','1',NULL,NULL),(31,'2024-08-12 17:00:00','2024-08-12 17:00:00','1332105','1',NULL,NULL),(32,'2024-08-12 10:00:00','2024-08-12 12:00:00','1332105','1',NULL,NULL),(34,'2024-08-12 12:00:00','2024-08-12 14:00:00','1332105','1',NULL,NULL),(35,'2024-08-12 13:00:00','2024-08-12 15:00:00','1332105','1',NULL,NULL),(36,'2024-08-12 08:00:00','2024-08-12 10:00:00','1332105','2',NULL,NULL),(37,'2024-08-19 08:00:00','2024-08-19 10:00:00','1332105','2',NULL,NULL),(41,'2024-08-20 10:00:00','2024-08-20 12:00:00','1332105','2',2022,NULL),(42,'2024-08-27 10:00:00','2024-08-27 12:00:00','1332105','2',2022,NULL),(43,'2024-09-03 10:00:00','2024-09-03 12:00:00','1332105','2',2022,NULL),(44,'2024-08-12 15:00:00','2024-08-12 17:00:00','1332205','2',2021,NULL);
/*!40000 ALTER TABLE `waktu_absen` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-11  0:56:02
