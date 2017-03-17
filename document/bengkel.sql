-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: bengkel
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbarang`
--

DROP TABLE IF EXISTS `tbarang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbarang` (
  `KodeBarang` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) NOT NULL,
  `HargaBeli` int(8) NOT NULL,
  `HargaJual` int(8) NOT NULL,
  `Stok` int(4) NOT NULL,
  `Satuan` varchar(50) NOT NULL,
  `KelompokAktiva` varchar(50) NOT NULL,
  PRIMARY KEY (`KodeBarang`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbarang`
--

LOCK TABLES `tbarang` WRITE;
/*!40000 ALTER TABLE `tbarang` DISABLE KEYS */;
INSERT INTO `tbarang` VALUES (27,'LEM FOX',250000,275000,3,'JELIGEN','AKTIVA LANCAR'),(28,'PAKU 2 IN',12000,12300,5,'DUS','AKTIVA LANCAR');
/*!40000 ALTER TABLE `tbarang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tpembelian`
--

DROP TABLE IF EXISTS `tpembelian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tpembelian` (
  `NoPembelian` int(4) NOT NULL,
  `Tanggal` date NOT NULL,
  `KodeToko` int(11) NOT NULL,
  `KodePengguna` int(3) NOT NULL,
  PRIMARY KEY (`NoPembelian`),
  KEY `fk_pembelian_toko` (`KodeToko`),
  KEY `fk_pembelian_pengguna` (`KodePengguna`),
  CONSTRAINT `fk_pembelian_pengguna` FOREIGN KEY (`KodePengguna`) REFERENCES `tpengguna` (`KodePengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pembelian_toko` FOREIGN KEY (`KodeToko`) REFERENCES `ttoko` (`KodeToko`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tpembelian`
--

LOCK TABLES `tpembelian` WRITE;
/*!40000 ALTER TABLE `tpembelian` DISABLE KEYS */;
/*!40000 ALTER TABLE `tpembelian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tpembeliandetail`
--

DROP TABLE IF EXISTS `tpembeliandetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tpembeliandetail` (
  `NoPembelian` int(4) NOT NULL,
  `KodeBarang` int(11) NOT NULL,
  `Jumlah` int(3) NOT NULL,
  `Harga` int(8) NOT NULL,
  KEY `fk_pembeliandetail_pembelian` (`NoPembelian`),
  KEY `fk_pembeliandetail_barang` (`KodeBarang`),
  CONSTRAINT `fk_pembelian_barang` FOREIGN KEY (`KodeBarang`) REFERENCES `tbarang` (`KodeBarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pembeliandetail_pembelian` FOREIGN KEY (`NoPembelian`) REFERENCES `tpembelian` (`NoPembelian`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tpembeliandetail`
--

LOCK TABLES `tpembeliandetail` WRITE;
/*!40000 ALTER TABLE `tpembeliandetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tpembeliandetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tpengguna`
--

DROP TABLE IF EXISTS `tpengguna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tpengguna` (
  `KodePengguna` int(3) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(100) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `NoTelp` varchar(15) NOT NULL,
  `Status` varchar(20) NOT NULL,
  PRIMARY KEY (`KodePengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tpengguna`
--

LOCK TABLES `tpengguna` WRITE;
/*!40000 ALTER TABLE `tpengguna` DISABLE KEYS */;
INSERT INTO `tpengguna` VALUES (1,'RONI IRAWAN','771991','RONI','085720446884','ADMINISTRATOR'),(2,'Yogi Prayoga','haresepisan','ogi','081654321987','USER');
/*!40000 ALTER TABLE `tpengguna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tpenjualan`
--

DROP TABLE IF EXISTS `tpenjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tpenjualan` (
  `NoPenjualan` int(4) NOT NULL,
  `Tanggal` date NOT NULL,
  `KodeSupplier` int(11) NOT NULL,
  `KodePengguna` int(3) NOT NULL,
  PRIMARY KEY (`NoPenjualan`),
  KEY `fk_supplier` (`KodeSupplier`),
  KEY `fk_penjualan_pengguna` (`KodePengguna`),
  CONSTRAINT `fk_penjualan_pengguna` FOREIGN KEY (`KodePengguna`) REFERENCES `tpengguna` (`KodePengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tpenjualan_ibfk_1` FOREIGN KEY (`KodeSupplier`) REFERENCES `tsupplier` (`KodeSupplier`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tpenjualan`
--

LOCK TABLES `tpenjualan` WRITE;
/*!40000 ALTER TABLE `tpenjualan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tpenjualan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tpenjualandetail`
--

DROP TABLE IF EXISTS `tpenjualandetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tpenjualandetail` (
  `NoPenjualan` int(4) NOT NULL,
  `KodeBarang` int(11) NOT NULL,
  `Jumlah` int(3) NOT NULL,
  `Harga` int(8) NOT NULL,
  KEY `fk_penjualan_penjualan` (`NoPenjualan`),
  KEY `fk_penjualan_barang` (`KodeBarang`),
  CONSTRAINT `fk_penjualan_barang` FOREIGN KEY (`KodeBarang`) REFERENCES `tbarang` (`KodeBarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_penjualan_penjualan` FOREIGN KEY (`NoPenjualan`) REFERENCES `tpenjualan` (`NoPenjualan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tpenjualandetail`
--

LOCK TABLES `tpenjualandetail` WRITE;
/*!40000 ALTER TABLE `tpenjualandetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tpenjualandetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tsupplier`
--

DROP TABLE IF EXISTS `tsupplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsupplier` (
  `KodeSupplier` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(100) NOT NULL,
  `Alamat` varchar(250) NOT NULL,
  `NoTelp1` varchar(15) NOT NULL,
  `NoTelp2` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`KodeSupplier`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tsupplier`
--

LOCK TABLES `tsupplier` WRITE;
/*!40000 ALTER TABLE `tsupplier` DISABLE KEYS */;
INSERT INTO `tsupplier` VALUES (1,'Abdul Fatah','Kp Cikamandilan RT 01 RW 10 Kel. Cibaduyut Kec. Cibaduyut Kota Bandung','085720111222','085720333444'),(2,'Abdul Karim','Kp. Cantilan RT 03 RW 09 Desa Jatisari Kec. Kutawaringin Kab. Bandung','081321444555','085720444321'),(3,'Doni','Kp. Cantilan RT 03 RW 09 Desa Jatisari Kec. Kutawaringin Kab. Bandung','081321444555','085720444321'),(4,'Iman','Kp. Heubeul Isuk RT 03 RW 09 Desa Pasir Jambu Kec. Pasir Jambu Kab. Bandung','081321444555','085720444321'),(6,'MAULANA DEQHI','CIGONDEWAH KALER RT 01 / 011 CIGONDEWAH KALER BANDUNG KULON','81321444555','85720444321'),(7,'HARYADI','GRIYA MITRA POSINDO BLOK G4 NO.12 RT.009 RW.026 KEL. CINUNUK KEC. CILEUYI BANDUNG JABAR','81321444555','85720444321'),(8,'TAUFIK KURNIAWAN','KOMPLEK PERMATA SINDANG PANON RT.001 RW.015 KEL. DESA SINDANG PANON KEC. KEC BANJARAN KAB BANDUNG JAWA BARAT','81321444555','85720444321'),(9,'INEU SUGIARTI','PERUM  G.I.B  BLOK B2 NO 12 RT.001 RW.010 KEL. BABAKAN PEUTEUY KEC. CICALENGKA BANDUNG JABAR','81321444555','85720444321'),(10,'SITI NURJANAH','GG.IBU ENGKIK 8D/94 KEL NYENGSERET KEC ASTANA ANYAR BANDUNG','81321444555','85720444321'),(11,'ROSTIANY','JLN MOH.TOHA GG.H.MUKTI RT/RW 01/03 KEL KARASAK KEC ASTANA ANYAR BANDUNG','81321444555','85720444321'),(12,'ADE SUHENDRA',' KP. KP JELEKONG RT.002 RW.002 KEL. DS JELEKONG KEC. KEC  BALEENDAH KAB BANDUNG JAWA BARAT','81321444555','85720444321'),(13,'AGUNG GUMILAR',' KP. SADANG GIRANG RT.002 RW.004 KEL. ANDIR KEC. BALEENDAH BANDUNG JABAR','81321444555','85720444321'),(14,'INDRA',' KP. KEBON SUUK WETAN RT.003 RW.009 KEL. CICALENGKA WETAN KEC. CICALENGKA BANDUNG JABAR','81321444555','85720444321'),(15,'TATI RAHMAYANTI ','JL. OTISTA GG. PESANTREN MUHAMADIYAH RT.03 RW.2 KEL. PELINDUNG HEWAN KEC. ASTANA ANYAR BANDUNG JAWA BARAT','81321444555','85720444321'),(16,'METI SUMIATI',' KP. CIODENG I RT.006 RW.003 KEL. ANDIR KEC. BALEENDAH BANDUNG JABAR','81321444555','85720444321'),(17,'EVEN SUWANDI','H KURDI V NO 218/201 RT.003 RW.001 KEL. KARASAK KEC. ASTANA ANYAR KOTA BANDUNG JAWA BARAT','81321444555','85720444321'),(18,'AHMAD YANI.','JLN.KARASAK BLOK 50 RT.05/002 KARASAK KEC.ASTANA ANYAR BANDUNG','81321444555','85720444321'),(19,'TAOPIQ NURDIANSYAH ','BBK CIPARAY GG.HASAN ALI RT.002 RW.001 KEL. KOPO KEC. BOJONG LOA KALER BANDUNG JAWA BARAT','81321444555','85720444321'),(20,'ERNI RISTIANI',' KP. KP GIRANG DEUKEUT RT.03 RW.09 KEL. BANJARAN KULON KEC. BANJARAN BANDUNG JAWA BARAT','81321444555','85720444321'),(22,'RONI IRAWAN','KOMP. ANGKASA MEKAR KAV. 6 CIBADUYUT BANDUNG','085720446884','085720446884'),(24,'YOGI','PANDEGLANG BANTEN','085321741325','085321741325');
/*!40000 ALTER TABLE `tsupplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ttoko`
--

DROP TABLE IF EXISTS `ttoko`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ttoko` (
  `KodeToko` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(100) NOT NULL,
  `Alamat` varchar(250) NOT NULL,
  `NoTelp` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`KodeToko`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ttoko`
--

LOCK TABLES `ttoko` WRITE;
/*!40000 ALTER TABLE `ttoko` DISABLE KEYS */;
INSERT INTO `ttoko` VALUES (1,'MITRA','JALAN CIBADUYUT RAYA NO. 125','022541879'),(2,'MULYA','JALAN CIBADUYUT RAYA NO. 220','022654874'),(3,'ANYAR','JALAN CIBADUYUT RAYA NO. 354','022453157'),(5,'KAWI MANDIRI','JALAN CIBADUYUT RAYA NO 98','022568987'),(6,'JAVA SEVEN','JALAN INDRAYASA NO. 69 CIBADUYUT BANDUNG','0225419484'),(7,'CBR SIX','JALAN CIBADUYUT RAYA NO. 6 BANDUNG','0225409294');
/*!40000 ALTER TABLE `ttoko` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-17 10:29:23
