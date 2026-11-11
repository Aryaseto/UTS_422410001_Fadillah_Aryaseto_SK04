-- MySQL dump 10.13  Distrib 9.6.0, for macos14.8 (x86_64)
--
-- Host: localhost    Database: uts_sk04_pita_lestari
-- ------------------------------------------------------
-- Server version	9.6.0

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
-- Current Database: `uts_sk04_pita_lestari`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `uts_sk04_pita_lestari` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `uts_sk04_pita_lestari`;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_kondisi`
--

DROP TABLE IF EXISTS `detail_kondisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_kondisi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `koleksi_pita_id` bigint unsigned NOT NULL,
  `kondisi_awal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat_kerusakan` enum('ringan','sedang','berat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `detail_kondisi_koleksi_pita_id_unique` (`koleksi_pita_id`),
  CONSTRAINT `detail_kondisi_koleksi_pita_id_foreign` FOREIGN KEY (`koleksi_pita_id`) REFERENCES `koleksi_pita` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_kondisi`
--

LOCK TABLES `detail_kondisi` WRITE;
/*!40000 ALTER TABLE `detail_kondisi` DISABLE KEYS */;
INSERT INTO `detail_kondisi` VALUES (1,1,'Cangkang retak pada sudut kanan atas, pita masih tergulung rapi. Terdapat debu pada jendela kaset dan label tulisan tangan mulai pudar.','ringan','Label asli dipertahankan. Salinan digital digunakan untuk akses harian.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(2,2,'Pita mengeluarkan bau asam dan lengket saat dilepas dari reel. Jamur putih terlihat pada 30 sentimeter pertama. Reel logam berkarat ringan.','berat','Harus dipanggang sebelum diputar. Ruang kerja terpisah untuk mencegah kontaminasi spora.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(3,3,'Pita putus sekitar dua menit dari awal sisi A. Cangkang penyok dan pengunci tidak menutup rapat.','sedang','Sambungan lama perlu dibuka ulang sebelum dipindahkan ke rumah baru.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(4,4,'Pita tampak bersih, tetapi suara kanan lebih pelan. Diduga azimuth kepala baca bergeser setelah perpindahan ruang.','ringan','Kotak asli disimpan terpisah karena memuat catatan tangan produser.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(5,5,'Pita terlipat pada menit ketiga. Cangkang kotor oleh tanah kering, tetapi label masih terbaca.','sedang','Perlu transkripsi dan penandaan pembicara setelah digitalisasi.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(6,6,'Pita bersih dan gulungan stabil. Cangkang sedikit kusam, label masih lengkap.','ringan','Koleksi dalam kondisi baik, hanya perlu pembersihan rutin.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(7,7,'Tiga reel menunjukkan jamur aktif. Pita lengket dan beberapa lapisan menempel saat digulung. Reel plastik retak pada satu sisi.','berat','Tangani dengan sarung tangan dan masker. Pisahkan dari koleksi lain selama remediasi.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(8,8,'Pita putus di dua titik dan cangkang retak pada bagian engsel. Label ditulis dengan spidol pudar.','sedang','Gunakan cangkang donor bening agar label asli tetap terlihat.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(9,9,'Pita masih berputar normal. Suara latar mendengung, kemungkinan dari kabel mikrofon asli.','ringan','Dengung dapat dikurangi saat pemrosesan digital, bukan saat transfer.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(10,10,'Gambar bergaris pada 10 menit pertama. Cangkang berdebu dan label stiker terkelupas sebagian.','sedang','Bersihkan jalur pita sebelum mencoba pemutaran berikutnya.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(11,11,'Pita lengket dan mengeluarkan bau asam. Satu reel mengalami distorsi pada lapisan luar.','berat','Jangan diputar sebelum dipanggang. Catat setiap perubahan bentuk pita.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(12,12,'Pita bersih, cangkang utuh. Ada bekas staples pada label yang perlu diangkat hati-hati.','ringan','Staples diangkat agar tidak melukai pita saat kaset dibuka.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(13,13,'Pita berdebu dan drum pemutar mengeluarkan suara kasar. Gambar masih muncul, tetapi warna mulai pudar.','sedang','Gunakan mesin U-matic yang baru diservis untuk menghindari kerusakan tambahan.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(14,14,'Pita bersih, gulungan rapi, dan kotak asli masih utuh. Terdapat sedikit debu pada tepi reel.','ringan','Kotak asli menyimpan catatan transkripsi, jangan dipisahkan.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(15,15,'Pita macet pada track kedua. Pegas penekan sudah lemah dan lapisan graphit terkelupas.','berat','Bongkar kartrid dengan hati-hati, simpan urutan komponen dalam nampan.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(16,16,'Pita bersih dan cangkang utuh. Beberapa label perlu dilembar ulang karena tulisan memudar.','ringan','Buat indeks isi per kaset sebelum digitalisasi.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(17,17,'Pita dapat dibaca, tetapi muncul blok error pada menit kedelapan. Drum pemutar perlu dibersihkan.','sedang','Lakukan uji baca pada mesin cadangan sebelum transfer penuh.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(18,18,'Cangkang retak halus di bagian depan. Pita masih terbaca pada mesin DCC yang tersedia.','sedang','Mesin DCC terbatas, jadwalkan transfer dalam satu sesi.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(19,19,'Jamur terlihat pada dua kaset. Pita berdebu dan cangkang retak pada salah satu sisi.','berat','Pisahkan kaset berjamur. Jangan gunakan mesin yang sama tanpa pembersihan.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(20,20,'Pita bersih, leader tape lepas, cangkang utuh. Mesin pemutar memerlukan kalibrasi ulang.','ringan','Ganti leader sebelum menjalankan pita pada mesin.','2026-11-11 12:21:32','2026-11-11 12:21:32');
/*!40000 ALTER TABLE `detail_kondisi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_format`
--

DROP TABLE IF EXISTS `kategori_format`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori_format` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_format` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategori_format_nama_format_unique` (`nama_format`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_format`
--

LOCK TABLES `kategori_format` WRITE;
/*!40000 ALTER TABLE `kategori_format` DISABLE KEYS */;
INSERT INTO `kategori_format` VALUES (1,'Kaset Compact','Pita magnetik 1/8 inci di dalam cangkang plastik. Format rumah tangga paling umum pada 1970 sampai 1990-an, banyak dipakai untuk mixtape, dokumentasi keluarga, dan master demo.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(2,'Reel-to-Reel 1/4 inci','Pita gulungan terbuka berukuran 1/4 inci. Umum dipakai studio radio, arsip pemerintah, dan rekaman lapangan dengan durasi panjang.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(3,'Reel-to-Reel 1/2 inci','Pita gulungan lebar untuk rekaman multitrack dan master album. Memerlukan mesin dengan jalur pita khusus serta ruang penyimpanan bersuhu stabil.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(4,'Kartrid 8-Track','Kartrid dengan pita loop tanpa akhir, populer di mobil Amerika pada 1965 sampai 1980. Mekanisme pegas internal sering menjadi titik kerusakan.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(5,'Microcassette','Kaset mini untuk diktafon, wawancara lapangan, dan catatan rapat. Cangkang kecil membuat pita rentan terlipat saat mekanisme mesin kotor.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(6,'DAT (Digital Audio Tape)','Pita digital 4 mm untuk master dan arsip akhir 1980-an. Sinyal disimpan secara digital, tetapi mekanisme drum pemutar sangat sensitif terhadap debu.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(7,'DCC (Digital Compact Cassette)','Kaset digital yang masih kompatibel dengan pemutar analog. Produksi singkat pada 1990-an membuat suku cadang dan mesin pemutar kini langka.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(8,'Elcaset','Format pita 1/4 inci di dalam kaset besar, diproduksi singkat pada 1976 sampai 1980. Kualitas audio tinggi dengan populasi mesin yang sangat terbatas.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(9,'VHS','Pita video VHS yang menyimpan audio linier dan hi-fi. Sering menjadi satu-satunya salinan dokumentasi acara, siaran lokal, dan arsip keluarga.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(10,'U-matic','Kaset video profesional 3/4 inci untuk produksi siaran televisi. Cangkang besar dan jalur pita panjang membutuhkan pembersihan bertahap.','2026-11-11 12:21:31','2026-11-11 12:21:31');
/*!40000 ALTER TABLE `kategori_format` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `koleksi_pita`
--

DROP TABLE IF EXISTS `koleksi_pita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `koleksi_pita` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_koleksi` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_koleksi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_format_id` bigint unsigned NOT NULL,
  `tahun` year DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `koleksi_pita_kode_koleksi_unique` (`kode_koleksi`),
  KEY `koleksi_pita_kategori_format_id_foreign` (`kategori_format_id`),
  KEY `koleksi_pita_nama_koleksi_index` (`nama_koleksi`),
  CONSTRAINT `koleksi_pita_kategori_format_id_foreign` FOREIGN KEY (`kategori_format_id`) REFERENCES `kategori_format` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `koleksi_pita`
--

LOCK TABLES `koleksi_pita` WRITE;
/*!40000 ALTER TABLE `koleksi_pita` DISABLE KEYS */;
INSERT INTO `koleksi_pita` VALUES (1,'PL-001','Rekaman Gamelan Ki Nartosabdo, 1974',1,1974,'Rekaman latihan gamelan dari pendopo keluarga di Yogyakarta. Berisi tiga lagu lengkap dengan obrolan para pemain di sela latihan.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(2,'PL-002','Siaran RRI: Pidato Kemerdekaan 1966',2,1966,'Rekaman siaran radio upacara peringatan kemerdekaan. Terdapat bagian pidato, doa, dan laporan reporter lapangan.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(3,'PL-003','Demo Band Melati, 1982',1,1982,'Demo empat lagu milik grup musik kampus. Sisi B berisi versi akustik yang tidak pernah dirilis.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(4,'PL-004','Master Album Swami, 1991',3,1991,'Master dua belas lagu untuk album studio. Termasuk take alternatif dan catatan produser pada kotak reel.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(5,'PL-005','Catatan Lapangan Ekspedisi Kalimantan, 1988',5,1988,'Wawancara dengan warga dan perekaman suara hutan selama ekspedisi dua minggu. Sebagian wawancara menggunakan bahasa daerah.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(6,'PL-006','Koleksi Lagu Anak Bapak Soekito, 1979',1,1979,'Dua belas lagu anak yang dinyanyikan bersama murid sekolah dasar. Rekaman dilakukan di ruang kelas dengan perekam portabel.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(7,'PL-007','Rekaman Wayang Kulit Sriwedari, 1970',2,1970,'Pertunjukan wayang kulit semalam suntuk, terdiri dari enam reel. Rekaman mencakup iringan gamelan dan dialog dalang.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(8,'PL-008','Mixtape Jalanan Jakarta, 1994',1,1994,'Kompilasi lagu yang direkam dari radio dan dijual di pasar loak. Menyimpan jejak selera musik remaja kota pada 1990-an.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(9,'PL-009','Rapat Direksi Pabrik Gula, 1985',5,1985,'Rekaman rapat direksi membahas rencana perluasan pabrik. Berisi laporan produksi dan perdebatan mengenai lahan tebu.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(10,'PL-010','Konser Amal 1997',9,1997,'Rekaman konser amal di aula kota. Menampilkan enam penampil dan sambutan panitia.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(11,'PL-011','Master Iklan Radio 1980',3,1980,'Kumpulan jingle dan iklan radio untuk produk rumah tangga. Beberapa naskah iklan disimpan di kotak yang sama.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(12,'PL-012','Kaset Pelatihan Bahasa Inggris, 1983',1,1983,'Materi pelatihan bahasa Inggris untuk karyawan hotel. Terdiri dari dialog, latihan pengucapan, dan instruksi tutor.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(13,'PL-013','Dokumentasi Tari Bali, 1990',10,1990,'Dokumentasi lima tarian Bali untuk keperluan pelatihan sanggar. Termasuk wawancara dengan pelatih tari.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(14,'PL-014','Rekaman Fonetik Bahasa Daerah, 1978',2,1978,'Kumpulan rekaman fonetik dari enam penutur bahasa daerah. Setiap reel disertai catatan transkripsi tangan.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(15,'PL-015','Album Dangdut Orkes Kendedes, 1986',4,1986,'Album dangdut delapan lagu dalam format kartrid. Kotak plastik asli masih ada, tetapi engselnya patah.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(16,'PL-016','Khotbah dan Ceramah 1992',1,1992,'Kumpulan ceramah keagamaan yang direkam di komunitas. Terdapat sepuluh kaset dengan durasi rata-rata enam puluh menit.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(17,'PL-017','Soundtrack Film Dokumenter 1989',6,1989,'Master audio untuk film dokumenter lingkungan. Berisi musik latar, narasi, dan efek suara yang direkam terpisah.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(18,'PL-018','Rekaman Latihan Paduan Suara, 1995',7,1995,'Latihan paduan suara menjelang lomba nasional. Berisi aransemen vokal dan arahan pelatih.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(19,'PL-019','Arsip Berita TVRI 1993',10,1993,'Tiga kaset berita daerah yang mencakup liputan banjir, pasar tradisional, dan kegiatan sekolah.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(20,'PL-020','Demo Elcaset Proyek Eksperimental, 1979',8,1979,'Rekaman eksperimental dengan synthesizer dan rekaman lapangan. Merupakan satu-satunya salinan yang tersisa dari proyek tersebut.','2026-11-11 12:21:32','2026-11-11 12:21:32');
/*!40000 ALTER TABLE `koleksi_pita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `koleksi_tindakan`
--

DROP TABLE IF EXISTS `koleksi_tindakan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `koleksi_tindakan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `koleksi_pita_id` bigint unsigned NOT NULL,
  `tindakan_restorasi_id` bigint unsigned NOT NULL,
  `status` enum('rencana','proses','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rencana',
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `koleksi_tindakan_unik` (`koleksi_pita_id`,`tindakan_restorasi_id`),
  KEY `koleksi_tindakan_tindakan_restorasi_id_foreign` (`tindakan_restorasi_id`),
  KEY `koleksi_tindakan_status_index` (`status`),
  CONSTRAINT `koleksi_tindakan_koleksi_pita_id_foreign` FOREIGN KEY (`koleksi_pita_id`) REFERENCES `koleksi_pita` (`id`) ON DELETE CASCADE,
  CONSTRAINT `koleksi_tindakan_tindakan_restorasi_id_foreign` FOREIGN KEY (`tindakan_restorasi_id`) REFERENCES `tindakan_restorasi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `koleksi_tindakan`
--

LOCK TABLES `koleksi_tindakan` WRITE;
/*!40000 ALTER TABLE `koleksi_tindakan` DISABLE KEYS */;
INSERT INTO `koleksi_tindakan` VALUES (1,1,1,'selesai','2025-01-14','2025-01-14','Debu dibersihkan dengan kuas anti-statis.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(2,1,9,'selesai','2025-01-20','2025-01-20','Transfer 24-bit/96 kHz, level puncak -6 dB.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(3,2,8,'proses','2025-03-02',NULL,'Pembersihan bertahap, alat dipisahkan dari koleksi lain.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(4,2,6,'rencana',NULL,NULL,'Jadwalkan setelah remediasi selesai.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(5,2,9,'rencana',NULL,NULL,'Prioritas tinggi karena kondisi pita rapuh.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(6,3,3,'rencana',NULL,NULL,'Siapkan splicing tape 2 mm.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(7,3,4,'rencana',NULL,NULL,'Gunakan cangkang donor dengan warna serupa.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(8,4,2,'selesai','2024-11-08','2024-11-08','Head dan capstan dibersihkan sebelum uji putar.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(9,4,5,'selesai','2024-11-09','2024-11-09','Kanal kanan kembali sejajar.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(10,4,9,'selesai','2024-11-12','2024-11-15','Tiga sesi transfer, file per lagu dan file utuh.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(11,5,1,'proses','2025-04-11',NULL,'Cangkang dibersihkan lebih dulu, pita belum diputar.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(12,5,9,'rencana',NULL,NULL,'Gunakan mesin dengan tension rendah.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(13,6,1,'selesai','2025-02-01','2025-02-01','Pembersihan rutin sebelum penyimpanan.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(14,7,8,'proses','2025-01-05',NULL,'Dua dari tiga reel sudah dibersihkan.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(15,7,6,'rencana',NULL,NULL,'Suhu 54 derajat Celsius, durasi bertahap.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(16,7,9,'rencana',NULL,NULL,'Prioritas setelah pita stabil.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(17,8,3,'selesai','2024-12-02','2024-12-02','Dua sambungan dirapikan dengan jig.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(18,8,4,'selesai','2024-12-03','2024-12-03','Pita dipindahkan tanpa memotong gulungan.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(19,9,9,'selesai','2025-02-17','2025-02-17','Transfer apa adanya, tanpa filter.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(20,10,2,'selesai','2025-03-20','2025-03-20','Kepala video dan drum dibersihkan.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(21,10,9,'proses','2025-03-22',NULL,'Tangkap sinyal melalui capture card, cek drop frame.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(22,11,6,'rencana',NULL,NULL,'Jadwalkan dua siklus dengan pendinginan bertahap.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(23,11,9,'rencana',NULL,NULL,'Transfer setelah pita stabil maksimal 48 jam.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(24,12,1,'selesai','2025-01-28','2025-01-28','Debu dan staples dibersihkan.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(25,13,2,'proses','2025-04-02',NULL,'Pembersihan drum dilakukan bertahap.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(26,13,9,'rencana',NULL,NULL,'Siapkan perangkat capture komposit.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(27,14,1,'selesai','2024-10-14','2024-10-14','Debu tepi reel dibersihkan.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(28,14,9,'selesai','2024-10-18','2024-10-25','Enam reel ditransfer dan diberi metadata penutur.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(29,15,4,'rencana',NULL,NULL,'Cari donor kartrid dengan mekanisme serupa.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(30,15,3,'proses','2025-03-15',NULL,'Sambungan lama sedang diperiksa.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(31,16,9,'selesai','2025-02-20','2025-02-28','Sepuluh kaset ditransfer dan diberi nama sesuai tanggal ceramah.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(32,17,2,'proses','2025-04-06',NULL,'Drum dibersihkan, uji baca diulang.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(33,17,5,'rencana',NULL,NULL,'Periksa tracking setelah pembersihan.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(34,17,9,'rencana',NULL,NULL,'Gunakan dua kali pembacaan untuk pemulihan blok error.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(35,18,1,'selesai','2025-01-11','2025-01-11','Cangkang dibersihkan tanpa membuka unit.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(36,18,9,'selesai','2025-01-25','2025-01-25','Transfer berhasil, satu bagian perlu diulang.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(37,19,8,'rencana',NULL,NULL,'Siapkan ruang isolasi dan alat sekali pakai.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(38,19,2,'rencana',NULL,NULL,'Bersihkan mesin sebelum dan sesudah setiap kaset.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(39,20,10,'selesai','2025-02-05','2025-02-05','Leader baru dipasang dengan sambungan 45 derajat.','2026-11-11 12:21:32','2026-11-11 12:21:32'),(40,20,9,'selesai','2025-02-08','2025-02-09','Transfer dua sisi, file disimpan dalam dua lokasi.','2026-11-11 12:21:32','2026-11-11 12:21:32');
/*!40000 ALTER TABLE `koleksi_tindakan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_01_01_000001_create_kategori_format_table',1),(5,'2026_01_01_000002_create_koleksi_pita_table',1),(6,'2026_01_01_000003_create_detail_kondisi_table',1),(7,'2026_01_01_000004_create_tindakan_restorasi_table',1),(8,'2026_01_01_000005_create_koleksi_tindakan_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('0NyJYiwMEnXv9jD9dRRCOkKhI2WBMcFUKUK0lFYn',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoibVBEMmxGVUpvbHYwMUJTUGFMUWVJZG1kYW9qZEtkTUNqQWtMQW9mTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90aW5kYWthbi81L2VkaXQiO3M6NToicm91dGUiO3M6MTM6InRpbmRha2FuLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399729),('1qi2wboWcsTbXrymfWb0KCFJZcn66aAOglorFmgK',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoibGR4S0F1bVZZWHJXT3diV2dGUUFuclBpNVVYT2gwZFVDZnVibGNSayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzE3L2VkaXQiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('4p0jDmxBbfmUbHej78Wg3GoK35Amlz5Cu6UWOAOO',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSTZNN2tJSjQ0TG0zZ0pvUFVJQlQ0aHdqWFpqZkViTzdMZXVySlNFQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90aW5kYWthbi84L2VkaXQiO3M6NToicm91dGUiO3M6MTM6InRpbmRha2FuLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399729),('59qHriXrzMdmnJ3QIKdbOVpncb34FtOWDJ3oEwhf',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYjRGenpxWXlha1lHbDBabjZsR24wMDRNaFVucExoSjRrckxMOW5JUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzE4L2VkaXQiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('5YaAEfq6lSetBQZcoMdxbL2hcpzlfdpJfLZfLlqx',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUFDQVYyRzJKS0c3MG04OWRIbXpLbnRzbHZvNEFxR0JLbW1ac1ZsQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzExIjtzOjU6InJvdXRlIjtzOjEyOiJrb2xla3NpLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('7Pqdh5IWdUdTNWfoPM2RxEci8leSPNlv6Rt5qTzH',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiT2VKdnE0Vkk0SGlkdlNuTFU2bWE0eWJWOE9adXVNdngxcFk2ZmtFVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90aW5kYWthbi8xL2VkaXQiO3M6NToicm91dGUiO3M6MTM6InRpbmRha2FuLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399729),('831vifM6GdTpkCaXjYWt2RQW6tElPq8rpzuNkLj2',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiazNoQUFEN1hhSWpVd29iSUZpbk1RcXV1ckxWcmUzTlNXM0tpWmt2TSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaS8zL2VkaXQiO3M6NToicm91dGUiO3M6MTM6ImthdGVnb3JpLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('87c8HwJoAsAtAkdq5lNxIpxs4qFN6CFrLRBHR218',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaW11NU85T0tlaWU4NXN5REpINUlseEQzVDR6T0FGWkx6Q3VrV0VDNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzE2IjtzOjU6InJvdXRlIjtzOjEyOiJrb2xla3NpLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('8CjuyEVIgE3A0BHMrMJaVWabXPUOGeSBqPgyHeHe',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHBhc05XV0xZRHZVR3hJREd2Y252YmtOWVUzUERhTUtMVVFseml4YiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399727),('8cU7dvJOBWZ3CTsBOPXkbgZhaVv52FzmiLiFo9ns',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGM3Vm5nSUZkUjFjSHMwU3AxTUVPckxyS0FzM0FGbkxxcGEwSHJYQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90aW5kYWthbi85L2VkaXQiO3M6NToicm91dGUiO3M6MTM6InRpbmRha2FuLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399729),('8DQdrgAjUdY6kNCEnqOeswSb6mogWe6IM3RhKDk6',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiekRzMG9TS1IzTXB6RGliQlJKSjFFYzlmSFNNZWUyNnZ0RWpGeG1DYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90aW5kYWthbi80L2VkaXQiO3M6NToicm91dGUiO3M6MTM6InRpbmRha2FuLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399729),('8Q0qr5GFIMDFkPtYToiZfFFAJEFwKtsBOyvS7PSF',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRXUwZ045dXlFakF1dzdhNVE3WGxsRFhXQUdkYmlyZkM4TGV0SnR1YSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP3N0YXR1cz1wcm9zZXMiO3M6NToicm91dGUiO3M6MTM6ImtvbGVrc2kuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399727),('8yN3CU0LFiKkslHSqx6t0BHYX8qsh6DIFoxNU8lw',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoidXlHdGhMZ0VKeDRSUHBpTzdIdXdqU3NOa0lrenNXUnREVzVWZmp1OSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaS84L2VkaXQiO3M6NToicm91dGUiO3M6MTM6ImthdGVnb3JpLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('a1pWNRD2V9lmPSum3Pq0cHpAAxphIEYHh3jAJklM',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiREZYSUR3cnJuOUNDdnVWSVhpT0NYeWRSU0RyWHhDUVU5MDdxY2M2MiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP3BhZ2U9MiI7czo1OiJyb3V0ZSI7czoxMzoia29sZWtzaS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399728),('aaStwm1h0Lxmh5XVlOFjxGhFptXPX1X5ROyHnaBY',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNDlYUlZvTTE2Mk1SaDBxdERXOEFMWVp4YjR5TkJ0ZGZwVVBvRkxWTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794400649),('aHX4sG5ONKYY15AZn4DRqpNONQoHf6v4aHYw0Rrs',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoickF4SnVDTVQ4WjE0NEQ1aWhOMkRlNFpSYU45WUp4UEswRkRyc3FabCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzE0L2VkaXQiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('AsjRpXb1FCLHJ0y8Iay3szAgpGeqy0IkzGgSsqcC',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXd3dWFhOFk4TzNyeGhzZktxYlZEbU5KaUE5NzdsSU9TNW0wWHQxeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzEyIjtzOjU6InJvdXRlIjtzOjEyOiJrb2xla3NpLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('AYAEYKQR3h5HQ6gvLJw48ZUVwRv15Xgf28hZdqih',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiemFuUVZSMWRWckREYVlYdjBndUFGY0dDV0h5U09ZUVlXNlQ5RWZkOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP3BhZ2U9MyI7czo1OiJyb3V0ZSI7czoxMzoia29sZWtzaS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399728),('bAd9SEIbMxuG2kjVfGgF4acKNYKWcTePqEil15yS',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoid2daaFA0bXNsaXJJeE9lMnRrcVRvSFlXM0k0TEF0eDZLbnlFV0lNSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzQvZWRpdCI7czo1OiJyb3V0ZSI7czoxMjoia29sZWtzaS5lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794399730),('BkVGkAPEefvclfb6EmeKhfkDdrBp3gsuAKgs39vo',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkNNVFpjMEVQMHY1OHFBYUFkRllsTzN1WVN2OWY1SzdtbDc3ZnJUdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP2thdGVnb3JpPTUiO3M6NToicm91dGUiO3M6MTM6ImtvbGVrc2kuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('C6i3tas7QX4sq0Tnc9gBJUuNXQdHKjadxcT07LDK',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoicG5CSWlSZVZvSnE5U3BtNFBIVnJsTDV6VFNBMGlna01DT05yZU5qTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP2thdGVnb3JpPTkiO3M6NToicm91dGUiO3M6MTM6ImtvbGVrc2kuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('clTGlk3z6UEyJGuEC2vCJ9D17CsFlBJMrM9V2ewY',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiak1WR1BLWkxoMDE0YU96R283WFJVbE9rVFlCeDFQSzUxNEJnVzAwNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90aW5kYWthbi9jcmVhdGUiO3M6NToicm91dGUiO3M6MTU6InRpbmRha2FuLmNyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399728),('cSCXun0keqSChRCZ0o1RqGoUO7ix8BvuqdLEYjAG',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0lVNFFCSEVPeHY0ejZkRnlpMnFkZmZpczV1bjBCYzdINlpsYVZLayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP3BhZ2U9MSI7czo1OiJyb3V0ZSI7czoxMzoia29sZWtzaS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399730),('d1WgzH3qTFo47VBXzTgUmTaLNy0mIbyM2aKUNYls',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZnBRaldDczltN3haZmxwdGllb3FSMWQ1WkZKTWJ3RE5LWFZneFRtaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaS8xMC9lZGl0IjtzOjU6InJvdXRlIjtzOjEzOiJrYXRlZ29yaS5lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794399728),('DBatbAPJBcaXY6p4k0OME2jGfmgwC1zuUxERtFuM',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaExiWTNWeFppNVZYa3dXeGlGNTFGS1FqY0RKWUxIeWM2MFdEcGR5UyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzE4IjtzOjU6InJvdXRlIjtzOjEyOiJrb2xla3NpLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('dvMveFGOryAIydNznUUg9iuTW82CqYpvPBZfbqGS',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGFsdmg5VVVPUXhsblZtYzgxRUU3Mk5SN2V0U0pGbTV0dTNmNjk3NiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzE2L2VkaXQiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('eBQqwINMfAurXWe6SV2UsBzf7sihFuKo3nhNWuCr',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUk0zMjJGMGxueXRsMjJ3VG5rOGJaZmdsM050MGVPcW5SRXVRYXdTMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzMiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399730),('EIvdwwrOg1v93JlGMfzAAoK1jm9CJCQFtA9Nc5B7',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoidTVYZU5lSjI1cnlPTnhGczNlU1pTeTcyVXpZOXVwbEJiYXh1R1dQQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzkvZWRpdCI7czo1OiJyb3V0ZSI7czoxMjoia29sZWtzaS5lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794399730),('FR0ZSOvHY7Eaz2Yh0d36tzZCmdmlN9k1gnd0EyiK',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDZkdkh1SVpnZnhyeGgzT0QxNm9rTEJTdk55TWpZUVdONGdyejFveiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzYiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('gB2AvBDDiXND0yqDI8q7qHia5zzcMUUVotTwGinj',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUndjbjJYdWpnaGtmNzNjZnU2YzBKWTcwM1czdU9qaW4yTE43bEozRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzYvZWRpdCI7czo1OiJyb3V0ZSI7czoxMjoia29sZWtzaS5lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794399730),('gSUvu6IWP8Sy9qgHoJSi7nO3QTxqKgGSdmcCilQj',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmVKcnAydlhDbzZ4UFR2QzF1eWU1aXBCeG0xdkV5SkZPMzdVYVFnaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90aW5kYWthbiI7czo1OiJyb3V0ZSI7czoxNDoidGluZGFrYW4uaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399727),('GxQj1z5rvWOayTVbWAepiljQHtXtlSByTExsCl2C',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEthS2xRSUg5SEpqcmtFQWtMa2tQeEUxczFsYjRETnRXbjZ5aGRrdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpIjtzOjU6InJvdXRlIjtzOjEzOiJrb2xla3NpLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794400583),('h20jn8FC3bV0dJ2fPbrEZBbtmDCMV2lRJrgnyXYo',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSVgwbjNkbW9EeU9rQTNlRWU5RGhnQjVRQW5QR2RFc1VseFZuaXg1MCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzEwIjtzOjU6InJvdXRlIjtzOjEyOiJrb2xla3NpLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('h3I36nOuU8mSH6Cw1kp9FdTmSqSf7DK5xpDaLvCG',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoidm5IYUxaMGJhczhSZnF3VmROSmROSUJ4S0VwSTBnR2s4SVZoRVJiVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpIjtzOjU6InJvdXRlIjtzOjEzOiJrb2xla3NpLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794399727),('HnvY16RyTFotqRosfP3J7dWGpogZB08E7DsXgzi9',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicDhJUUswd0RwbHRjZjNheWNYRXhGOG1uclVERThUMDNXaU1hdks5QSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794400921),('HtuqgWhkLSXYbnCS9FBMLNAeGI094NugCpPXXVo8',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUmpKcjV4d3ZqUEZmOUM5NGtxV3c1bGxaeENLc2tzM2s4ZUloOURCWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzEwL2VkaXQiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('HXfRcXDXlxYo0YQXOpS5wCDlpNSyH7G1ENUNbo3u',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUU9uQjlYT2ZmWHpSMnNXRm12cWdYYWRiaHRrajVCM1FaVGlLUE1qWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP2thdGVnb3JpPTciO3M6NToicm91dGUiO3M6MTM6ImtvbGVrc2kuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('I2HWdBckh5V8M2ZZpNQTO1ujQefsfk7sQE0cYAWC',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVlZRVWdZTk5UZlZqMzYxcG5XcUR4a29uczVOZzZQSEx2VVhiUGVFSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP2thdGVnb3JpPTEiO3M6NToicm91dGUiO3M6MTM6ImtvbGVrc2kuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('IaG0gau5odDSJdbOcTEecetdEAEBz8M6YdZPcdAY',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoib05BT0RVM1o3ZExzamc5SXlDR1FPNVo5S1lTSTU0SDFVeVN6eHd2NyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaS82L2VkaXQiO3M6NToicm91dGUiO3M6MTM6ImthdGVnb3JpLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('iifbNO4zJuzsy8zao2WxhUibgUeai9Pkb6mrXdz2',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoibXN5Y05JVm9renpXOWNwRXdibWN6Y3VaTWtjSXVER2NTSW9FVjlJViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzIwIjtzOjU6InJvdXRlIjtzOjEyOiJrb2xla3NpLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('J3gDWWZxm8Cs0m1F6FMRyOOXrcgtqYcJfmeTIzqQ',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUtPcXB0Um4wMTJUV05yc256N3FNakNHUGM5dDlIRXo5WUFtd3FBTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzE5IjtzOjU6InJvdXRlIjtzOjEyOiJrb2xla3NpLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('j6gXiHHHzEQbXSVMgG1biIROinZOXJ2VrDWvqTN9',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiakxNdXF3YUFla2VkUll3OEVsMENVWE5DOGdvbXc2RmxWSXpPdFBMdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaS80L2VkaXQiO3M6NToicm91dGUiO3M6MTM6ImthdGVnb3JpLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('jHmEbPPp6sTvr1caiy1fIF5fBz92qc0SBEXXtwzx',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTk05ZWh0a1B4MzJPeWMxaGlyWFd4OU9iaDJQdkpxekxFTWV2Y2M2RCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP2thdGVnb3JpPTQiO3M6NToicm91dGUiO3M6MTM6ImtvbGVrc2kuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('JPT4JxTncNTcRRnwfccXE7dagxGIYz9BQ24cjoV1',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTFNBOEpXckVBcWlzdUd2RVlQZkFmcERCVWVRVE95dEI0Vkk3UFllMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP2thdGVnb3JpPTIiO3M6NToicm91dGUiO3M6MTM6ImtvbGVrc2kuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('kEiG8ZydcyaF9ElyOi322jltjJeeqfHxnQOgawM4',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTlhsYWFnQlFLdmhucGMyMkN5YmhGbUxrRFNyOEcyc3lrcVNoV21IVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP2thdGVnb3JpPTMiO3M6NToicm91dGUiO3M6MTM6ImtvbGVrc2kuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('kPtRHaokbrtJ6qpUcZ3bXY6ytXmHKGGRpxTTS65y',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiREN1a0dKWm1hNVdocGlPZVhuUGg1ZkhpUmJUejR2SzBWWW9mUTFGOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399727),('lYlHnwF2oLILFluPXqaDATKtLRRC1nd5JqA0M18B',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWE41d3JwbndJd0drd3YwSm1zbXYzUDdJSlVod0xiTGdxNkI3R1VxcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzEzL2VkaXQiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('m7jAckndHatv9JZ71QEbx7AmvpT4Q7IdIt1uTh9X',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoieDU4dW92cURkbmpVc0hGQ2I4ZzBqbDJuZDNyTFh2VnhLVFB0cHdwUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzciO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399728),('MiAASx7ONfhYGGFYAQ82wORKZbx0v66aFP7bxaWp',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkllRmZkY2ZQV2pxeENSa1hja1ZuVk4zeEJUNXBqR2xHNHNUUXNGVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzEvZWRpdCI7czo1OiJyb3V0ZSI7czoxMjoia29sZWtzaS5lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794399729),('MJTOHf4PSu68wTGeJD7LuNnF7N7Ewa3ccbkcvCpV',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmtmTHNxU2dpRTJJTkx0czlTN0ROUUVuZWxrRlpOWXdGQkt0eE1PdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaS81L2VkaXQiO3M6NToicm91dGUiO3M6MTM6ImthdGVnb3JpLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('MzVuhqtc5aT1um7CdxTa3vVqnbOrALNV2f89A79D',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkZDd3dFTnBuZkx1ZnBsVXY4ZGhrcXFwQThzQU9acURJUUtOZHVwayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzkiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('n0oFj6u2EqpoM10Ia9GL1rus3DtY2nodGMt9wS5l',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoieXpQb2tFdDZxVmVWQ2JtR1o2SW9hT09SMzVWV0syNTlIUk5SRnd1YiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpL2NyZWF0ZSI7czo1OiJyb3V0ZSI7czoxNDoia29sZWtzaS5jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399727),('N1ImqMsn9IwF8evfGkoaSIAfLNP7XaWreqgoXgYP',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGJaQVJyTEpycWpib0tqZ0wxaTVyRHFsN2NpSXF6Mk9VNFJMN1VodyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzUvZWRpdCI7czo1OiJyb3V0ZSI7czoxMjoia29sZWtzaS5lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794399730),('n80Ug7v8vKPlIdVamQN5x0NNzz6OOx0S7PTgGWqb',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmRMMmMzVzdZaUUwSkV5aHFFRUd1WkF4eEZtUExNSEVoVWNqdXRiYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90aW5kYWthbi8xMC9lZGl0IjtzOjU6InJvdXRlIjtzOjEzOiJ0aW5kYWthbi5lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794399729),('njs6KHxsCKLDtvkFxzQOjXW261qno4OH5tFUihgr',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVJQTlZCc0ZYWjBVbkxCbWJDUVprRE9WTmg5czdVU3F0ZjVDUHZoSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzQiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399730),('nw1AkXRWn4NXcHrZz9fzQdQtEwIuooGjgQgzIUZD',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmpJVVk0V3ZtZnNtUVhVRDRYR0FleTdjakM5NnlTaUlPN3ZLY1ZWOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzIvZWRpdCI7czo1OiJyb3V0ZSI7czoxMjoia29sZWtzaS5lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794399730),('obgsTh7J62oVJiTn2k4CfvcmrlK0nB7RK5jqoi9c',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmlQeUJOS0I0V2ZtVjh6ZzF3bXBoQ29adW1xTm1kUkRpV2JVaFM2WSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzIiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('oDuinLG1V9ewwnzKZVFwqqWpe0zooK9mUzIOmi9r',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoieU42WGhtTTJhcnBVaHhEem5PWW9tbUh2bDdCRUZTMERZRkRtb3Z6RyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzgvZWRpdCI7czo1OiJyb3V0ZSI7czoxMjoia29sZWtzaS5lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794399730),('pgaJ3lOG8woYv6QAs8fuRdGajyKU7TFyJeKQBfti',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1RtUEJMVzhwak9WcG40bjI2SDVLaVBUVm1CMndPdzE5NjRoUzl6YyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzE0IjtzOjU6InJvdXRlIjtzOjEyOiJrb2xla3NpLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('q3l1RpTMAf6Wd8tNN3d5n7JsTpESkM1EdOkc0ibj',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTVVCSmJhdjdzNFJmQXE2Vkw5YWVhUWl5VXlBRHZwUU5yUHZaWVVteiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzMvZWRpdCI7czo1OiJyb3V0ZSI7czoxMjoia29sZWtzaS5lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794399730),('q3sEOqpMRFZNCxWLry6sXUVP0TY9idTVSwkZsSnI',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1g1QlhBTUlEUWdmcEJTRDRoR0ZVY2ZNN2FLVW9nelFkM0hLTzJUaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzIwL2VkaXQiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('QSNBXLh9pwG02nNCOLekH2Nj6uKbEvcFNWIzxLB8',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUk0waU9xNm53THUyMVREbjdndzkxVTRXd2RuTHlwaEtqZm1aN0dRSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzE1IjtzOjU6InJvdXRlIjtzOjEyOiJrb2xla3NpLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399727),('QtNodTq900ZUwNsMWEpWaxmXaegaebvmyZrAJQNF',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmlza05mM0dPbmV3am1tdkZjbEwxQ1lwUU5CVjBTOFIxdWh2SklnQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90aW5kYWthbi83L2VkaXQiO3M6NToicm91dGUiO3M6MTM6InRpbmRha2FuLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399729),('r1KaTCwAGmwD0dFnUQNxuDKQ8Y9KatoPu1Txr61z',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGt6eEMzU2h1dkN6WnRoVEl1WUJ4dlUzYklxQlBBN2NVOWU1N1Z0TyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP2thdGVnb3JpPTgiO3M6NToicm91dGUiO3M6MTM6ImtvbGVrc2kuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('r9tXHd3MhOnbDKzTHam4kPuwEMrCuHgBgIpXAaUZ',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHVITW00Y21oWlRLZ2kzMmphQklCaG9uVmUzQlVlWXpoeUZydmRGRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzExL2VkaXQiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('Rr29IrGdHWZoHBs66b2Z2A0UhAHNqSD1kOfRNnkB',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSERCTWNHUEFnWVlkQm1uZmFEc3FSUnpQMmIzMFo5a0ZnaGtVSkpPViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzE5L2VkaXQiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('s0BBbP0tuKkGg1GyZ1In33zcYICgIoX039mxgoQa',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUx2UDNiMWVha1FGMTVib3ZGanp5RXMwSWNraHVoRjZxTll3MVg2NyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzgiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('SD5qlEy4u9xA6JACQN3MPlMEL84ysxjOBujfJNox',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMW5welVKTFN0YTkxa2xwT0hpNWJBeVdoOHNxUFhpRTMyRnJUT2ZuNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90aW5kYWthbi82L2VkaXQiO3M6NToicm91dGUiO3M6MTM6InRpbmRha2FuLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399729),('SiWFBLSkYrlLzapWuJHHEjzzn2LnKXC6cdIlJjOt',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoidWVXREo2YnRFQlVOaXl2b0VuVXBTZzltaDNtVUduNllFSEZVU1pTZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90aW5kYWthbi8yL2VkaXQiO3M6NToicm91dGUiO3M6MTM6InRpbmRha2FuLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399729),('tRpHpuEjtZFuWeLQOWlehoih7ttzq17D0CpqiCdB',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzd4N0VMQmYzNWQ1MnFuTlhaZFdjV3BYZmtHalVueXFTTlI4YzRHdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzcvZWRpdCI7czo1OiJyb3V0ZSI7czoxMjoia29sZWtzaS5lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794399729),('u2YoKhKb7bDro1LC9ahiF92REMw6K7h7nf8jLIU0',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTFwQXB5MUpVRnRHczh2bFNlWnpvbmhOOTdDb3FZWnBqS1hab251dCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaS85L2VkaXQiO3M6NToicm91dGUiO3M6MTM6ImthdGVnb3JpLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('UHr6fJzokisnrwbSsaaxztgkcwCAyr55AguVbw5Y',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTnlRUjBvOW5jdnpWNE1GM2N0cUNSTUd6YVVJSVF2MXFURktVdkkycyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzEiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399727),('UqRmFSev1kygVztI8AX8UkJV9dS8JbwmaH81CMNL',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDhGWmVUWE9WTmNPSFZNenI5QU96eGl0aXZUdUpwRTUxamV1bldNUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaS9jcmVhdGUiO3M6NToicm91dGUiO3M6MTU6ImthdGVnb3JpLmNyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399728),('v36rCnzWRiUksEYqPi663QtcjUiHGNjPFsBWKucn',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFQxcmpOS04zZHRwUTdVdW85YTlSbk5zV1hWZjlybjNSN0p5WnVTYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzE3IjtzOjU6InJvdXRlIjtzOjEyOiJrb2xla3NpLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399727),('VmWiNx41SIRlwlJ3KO6xjxFKSQ9T2WFV1XoWfC6C',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoidVlNSDhScW1VclhQZ1I5V0JZSWI3UUs1OWNyQUszSzNvekNaMElJcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzUiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('VQ7kWSDsupjGdkMV2KjgXZSwUdfizQvXtwCcLJJx',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoib2dvM2RIYjhpSmNTRmtLUVBVcHZqdFNqbGI0b2lNamMwaVpSdmZMbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP2thdGVnb3JpPTYiO3M6NToicm91dGUiO3M6MTM6ImtvbGVrc2kuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('vxraVxBZcSMnHpZTZTNiaTbiYTbeNvR8kMxiMVUd',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoieFE4cHRpT2w0M2liZnd6aWVOMXQ5azJ6NlI5UFd4ajg5ZkpraDFkWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzEzIjtzOjU6InJvdXRlIjtzOjEyOiJrb2xla3NpLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399727),('W9UR43HWJLSsNAvvTlnGGj6WFq1Gr8IdSquDp76n',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFBXVHlBbjJoa0hveHBJVzNkZDREQlFsNkNTNUp5WHBHMW4zQkVMaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90aW5kYWthbi8zL2VkaXQiO3M6NToicm91dGUiO3M6MTM6InRpbmRha2FuLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399729),('WApSKlV043nfjCBhxey7eqoYjWGKBT5UG1yGHBtt',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTHNzeUZUQVhWOURFTlVoQ0xYYXVMMlZCcnJQVFAyanBwNGh0UU1SWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaSI7czo1OiJyb3V0ZSI7czoxNDoia2F0ZWdvcmkuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399727),('WweXFu1AHTtkmczO1MG8BePUzMUnHRc5B0klSrfu',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFI3Y1lGVmtLZzdKTkxFS2h3Wnk4V08xODFKRGRlUmQxemRyTmhhaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP3RpbmdrYXQ9YmVyYXQiO3M6NToicm91dGUiO3M6MTM6ImtvbGVrc2kuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399727),('YfYIioACApvTAcKMODAeITA6gkXm6EZlxsu4y0im',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVYzcTdYeGlyZlo4SVhCM0tpTncyVmxROEhmYnJFY3NWeE4yN2JGRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaS83L2VkaXQiO3M6NToicm91dGUiO3M6MTM6ImthdGVnb3JpLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('ypr3MxmvPl53hQx8bz0lLqBlY1kLz8Gxg7HPhpWO',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR29xRFpMQ3lrbFZWYXlyaW1yelFudnVmVGlRbWN4a3FFenZESmFociI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzEyL2VkaXQiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('zqyY4Y3b6GkZEa3NNKTflPmhEI2y2p8xfhQTvbt0',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMkttTGlzOHdqVWRENjJuUzhER2VBTlMyMUtTUjBmQ2FicGV3OWhRSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpP2thdGVnb3JpPTEwIjtzOjU6InJvdXRlIjtzOjEzOiJrb2xla3NpLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794399728),('zSo9ME6H3WbSF0dbYltpYgZrByFnrwlqinPFTrnQ',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkFwRndCUFlrWGtoOFlpUUxua2llTmo4NU5neEUyREpvdkx4eXR3SCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb2xla3NpLzE1L2VkaXQiO3M6NToicm91dGUiO3M6MTI6ImtvbGVrc2kuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794399729),('zuqKWk59GhWRmGGE5cNIzdwlPWZ79nSTlrZRrcSh',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR3pnTE5MSVFYeVlhcGN5MUxJSnozN3lLRHg4NWZLUTJPOUh3WFNVZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaS8xL2VkaXQiO3M6NToicm91dGUiO3M6MTM6ImthdGVnb3JpLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728),('ZWq3yNeLS2vBXtYc83BDBKSM5GfKqoYUDjXZhljl',NULL,'127.0.0.1','Python-urllib/3.14','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSnUxakY3ZlB6V1dxSEg1U3lNV3VwOU4zRGZRVUY1Wm51eTdWSFk1OSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXRlZ29yaS8yL2VkaXQiO3M6NToicm91dGUiO3M6MTM6ImthdGVnb3JpLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1794399728);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tindakan_restorasi`
--

DROP TABLE IF EXISTS `tindakan_restorasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tindakan_restorasi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_tindakan` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tindakan_restorasi_nama_tindakan_unique` (`nama_tindakan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tindakan_restorasi`
--

LOCK TABLES `tindakan_restorasi` WRITE;
/*!40000 ALTER TABLE `tindakan_restorasi` DISABLE KEYS */;
INSERT INTO `tindakan_restorasi` VALUES (1,'Pembersihan kering','Menyapu debu dan partikel lepas dari permukaan pita serta cangkang menggunakan kain microfiber dan kuas anti-statis.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(2,'Pembersihan kepala dan jalur pita','Membersihkan head, capstan, pinch roller, dan guide pada mesin pemutar sebelum pita dijalankan.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(3,'Perbaikan sambungan','Menyambung kembali pita yang putus dengan splicing tape dan jig agar sudut potongan tetap lurus.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(4,'Penggantian rumah kaset','Memindahkan pita ke cangkang baru ketika rumah lama retak, berubah bentuk, atau pengunciannya tidak lagi rapat.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(5,'Penyetelan azimuth','Menyelaraskan kemiringan kepala baca agar sudut pita sesuai standar dan respons frekuensi kembali seimbang.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(6,'Pemanggangan pita','Pemanasan terkontrol pada suhu rendah untuk mengurangi lengket akibat hidrolisis sebelum proses transfer.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(7,'Relubrikasi pita','Mengaplikasikan pelumas khusus pada pita yang kering agar gesekan dan kehilangan sinyal berkurang.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(8,'Remediasi jamur','Membersihkan spora jamur dengan prosedur aman, alat terpisah, dan ventilasi memadai untuk melindungi koleksi lain.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(9,'Digitalisasi','Transfer sinyal analog ke berkas digital 24-bit/96 kHz dengan pencatatan tingkat gain dan perangkat yang digunakan.','2026-11-11 12:21:31','2026-11-11 12:21:31'),(10,'Penggantian leader tape','Mengganti pita penuntun di awal dan akhir gulungan agar pita tidak tertarik langsung oleh reel atau capstan.','2026-11-11 12:21:31','2026-11-11 12:21:31');
/*!40000 ALTER TABLE `tindakan_restorasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'uts_sk04_pita_lestari'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-11 19:44:22
