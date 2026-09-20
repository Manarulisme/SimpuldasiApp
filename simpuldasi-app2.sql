/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - simpuldasi_app

---

*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
`key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
`expiration` bigint NOT NULL,
PRIMARY KEY (`key`),
KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
`key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`expiration` bigint NOT NULL,
PRIMARY KEY (`key`),
KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `data_anak_putus_sekolah` */

DROP TABLE IF EXISTS `data_anak_putus_sekolah`;

CREATE TABLE `data_anak_putus_sekolah` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`id_data` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`nik` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
`nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
`rw` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`usia` tinyint unsigned NOT NULL,
`jenjang_terakhir` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
`alasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`keterangan` text COLLATE utf8mb4_unicode_ci,
`google_sync_status` enum('pending','synced','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `data_anak_putus_sekolah_id_data_unique` (`id_data`),
UNIQUE KEY `data_anak_putus_sekolah_nik_unique` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_anak_putus_sekolah` */

insert into `data_anak_putus_sekolah`(`id`,`id_data`,`nik`,`nama`,`rw`,`usia`,`jenjang_terakhir`,`alasan`,`keterangan`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(1,'APS-001','3275011205140001','Andi Pratama','RW 04',14,'SD Kelas 6','Kondisi ekonomi keluarga','Anak berhenti sekolah karena keterbatasan ekonomi keluarga.','pending',NULL,'2026-09-19 00:09:45','2026-09-19 00:09:45'),
(2,'APS-002','3275014508120002','Siti Nurhaliza','RW 07',16,'SMP Kelas 8','Membantu orang tua bekerja','Anak berhenti sekolah untuk membantu perekonomian keluarga.','pending',NULL,'2026-09-19 00:09:45','2026-09-19 00:09:45'),
(6,'APS-01','32111111222','Elsa Tania Putri','04',17,'SD Kelas 2','Kurang Biaya','mantap','pending',NULL,'2026-09-19 00:12:51','2026-09-19 00:13:14'),
(7,'APS-054','3212344422','Zakaria Gassss','07',14,'SMP Kelas 8','Kurang Biaya','Perlu Perhatian','synced','2026-09-20 19:32:43','2026-09-20 19:27:59','2026-09-20 19:32:43');

/*Table structure for table `data_bmd` */

DROP TABLE IF EXISTS `data_bmd`;

CREATE TABLE `data_bmd` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`id_data` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`nama_barang` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
`type` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`tahun_perolehan` year DEFAULT NULL,
`sumber_dana` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`kondisi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`keterangan` text COLLATE utf8mb4_unicode_ci,
`google_sync_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `data_bmd_id_data_unique` (`id_data`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_bmd` */

insert into `data_bmd`(`id`,`id_data`,`nama_barang`,`type`,`tahun_perolehan`,`sumber_dana`,`kondisi`,`keterangan`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(4,'BMD-004','Printer','Peralatan Elektronik',2024,'APBD','Cukup Baik','Printer masih dapat digunakan dengan baik.','pending',NULL,'2026-09-16 21:42:06','2026-09-16 21:42:06'),
(5,'BMD-005','Lemari Arsip','Sarana',2023,'APBD','Baik','Lemari untuk penyimpanan dokumen dan arsip.','pending',NULL,'2026-09-16 21:42:06','2026-09-16 21:42:06'),
(6,'BMD-006','AC Split','Peralatan Elektronik',2022,'APBD','Cukup Baik','AC ruang pelayanan, masih berfungsi.','pending',NULL,'2026-09-16 21:42:06','2026-09-16 21:42:06'),
(7,'BMD-007','Komputer Desktop','Peralatan Elektronik',2023,'BOS','Baik','Komputer untuk administrasi dan pengolahan data.','pending',NULL,'2026-09-16 21:42:06','2026-09-16 21:42:06'),
(8,'BMD-008','Proyektor','Peralatan Elektronik',2021,'Hibah','Cukup Baik','Digunakan untuk kegiatan rapat dan sosialisasi.','pending',NULL,'2026-09-16 21:42:06','2026-09-16 21:42:06'),
(9,'BMD-009','Rak Dokumen','Sarana',2020,'APBD','Rusak Ringan','Beberapa bagian rak mengalami kerusakan ringan.','pending',NULL,'2026-09-16 21:42:06','2026-09-16 21:42:06'),
(10,'BMD-010','Kipas Angin','Peralatan Elektronik',2020,'Lainnya','Rusak Berat','Kipas tidak dapat digunakan dan membutuhkan penggantian.','pending',NULL,'2026-09-16 21:42:06','2026-09-16 21:42:06'),
(13,'BMD-021222','Meja Lipat','Sarana Prasaranaaaaa',2025,'Dana Kelurahan','Baik','mantap','synced','2026-09-17 00:58:20','2026-09-16 21:56:20','2026-09-17 00:58:20'),
(15,'BMD-61','Kursi Goyang','Media Film',2023,'APBD','Baik','mantaap','synced','2026-09-17 00:57:29','2026-09-17 00:57:27','2026-09-17 00:57:29'),
(16,'BMD-0212','Terminal','Sarana',2021,'APBD','Rusak Berat','perbaiki','failed',NULL,'2026-09-18 05:39:25','2026-09-18 05:39:25'),
(17,'BMD-5','HP','Vivo',2024,'APBD','Baik','Mantap','failed',NULL,'2026-09-18 05:52:44','2026-09-18 05:52:45'),
(18,'BMD-555','HP Admin','Advan',2023,'APBD','Baik','Layak Pakai','failed',NULL,'2026-09-18 06:01:08','2026-09-18 06:01:08'),
(19,'BMD-77','Tas Dokumen','Sarana',2026,'APBD','Baik','Layak Pakai','failed',NULL,'2026-09-18 06:03:32','2026-09-18 06:03:32'),
(20,'BMD-22','Buku Akuntan','Sarana',2026,'APBD','Baik','Mantap','failed',NULL,'2026-09-18 06:05:53','2026-09-18 06:05:53'),
(21,'BMD-99','HP Atasan','Samsung',2025,'APBD','Baik','Mantap','failed',NULL,'2026-09-18 06:16:53','2026-09-18 06:16:53'),
(22,'BMD 3','Meja Dapurrrrrrrrr','Sarana',2024,'APBD Kelurahan','Baik','mantap','synced','2026-09-19 23:37:33','2026-09-19 23:23:19','2026-09-19 23:37:33');

/*Table structure for table `data_buruan_sae` */

DROP TABLE IF EXISTS `data_buruan_sae`;

CREATE TABLE `data_buruan_sae` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`rw` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`jenis_tanaman` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`luas_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`google_sync_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_buruan_sae` */

insert into `data_buruan_sae`(`id`,`nama`,`lokasi`,`rw`,`jenis_tanaman`,`luas_area`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(1,'Buruan Sae RW 01','Kampung Binong','01','Cabai, Tomat, Kangkung','50 m²','pending',NULL,'2026-09-19 13:07:51','2026-09-19 13:07:51'),
(2,'Buruan Sae RW 02','Kampung Binong','02','Sawi, Bayam, Kangkung','40 m²','pending',NULL,'2026-09-19 13:07:51','2026-09-19 13:07:51'),
(3,'Buruan Sae RW 03','Kampung Binong','03','Cabai, Terong, Tomat','60 m²','pending',NULL,'2026-09-19 13:07:51','2026-09-19 13:07:51'),
(4,'Buruan Sae RW 04','Kampung Binong','04','Kangkung, Bayam, Sawi','35 m²','pending',NULL,'2026-09-19 13:07:51','2026-09-19 13:07:51'),
(5,'Buruan Sae RW 05','Kampung Binong','05','Cabai, Bawang, Tomat','45 m²','pending',NULL,'2026-09-19 13:07:51','2026-09-19 13:07:51'),
(6,'Buruan Sae RW 06','Kampung Binong','06','Pakcoy, Sawi, Bayam','55 m²','pending',NULL,'2026-09-19 13:07:51','2026-09-19 13:07:51'),
(8,'Buruan Sae RW 08','Kampung Binong','08','Terong, Sawi, Bayam','70 m²','pending',NULL,'2026-09-19 13:07:51','2026-09-19 13:07:51'),
(10,'Buruan Sae RW 10','Kampung Binong','10','Sawi, Pakcoy, Bayam','52 m²','pending',NULL,'2026-09-19 13:07:51','2026-09-19 13:07:51'),
(11,'Buruan Ujangggggg','Binong City Purwakarta','001','Tomat','50 m','pending',NULL,'2026-09-19 13:14:46','2026-09-19 13:14:55'),
(12,'Buruan Sae Pelita','Ujung Aspal Binong Utara','002','Pakis, Bonsai','100 m2','synced','2026-09-20 20:36:06','2026-09-20 20:36:04','2026-09-20 20:36:06');

/*Table structure for table `data_fasilitas_umum` */

DROP TABLE IF EXISTS `data_fasilitas_umum`;

CREATE TABLE `data_fasilitas_umum` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`jenis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`alamat` text COLLATE utf8mb4_unicode_ci,
`sumber_dana` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`google_sync_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_fasilitas_umum` */

insert into `data_fasilitas_umum`(`id`,`nama`,`lokasi`,`jenis`,`alamat`,`sumber_dana`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(1,'Posyandu Melati','RW 01','Kesehatan','Kp. Sukamaju RT 02','Dana Kelurahan','pending',NULL,'2026-09-19 13:48:24','2026-09-19 13:48:24'),
(2,'Lapangan Kelurahan','RW 02','Olahraga','Jl. Raya Kelurahan RT 01','APBD','pending',NULL,'2026-09-19 13:48:24','2026-09-19 13:48:24'),
(3,'Taman Bermain Anak','RW 03','Ruang Terbuka','Kp. Cibogo RT 03','Swadaya Masyarakat','pending',NULL,'2026-09-19 13:48:24','2026-09-19 13:48:24'),
(4,'Balai Warga','RW 04','Sosial','Kp. Sukajaya RT 05','Dana Desa','pending',NULL,'2026-09-19 13:48:24','2026-09-19 13:48:24'),
(5,'Perpustakaan Kelurahan','RW 05','Pendidikan','Kp. Babakan RT 01','APBD','pending',NULL,'2026-09-19 13:48:24','2026-09-19 13:48:24'),
(6,'Masjid Al-Ikhlas','RW 06','Keagamaan','Kp. Binong RT 02','Swadaya Masyarakat','pending',NULL,'2026-09-19 13:48:24','2026-09-19 13:48:24'),
(7,'PAUD Melati','RW 07','Pendidikan','Kp. Sukamukti RT 03','Dana Kelurahan','pending',NULL,'2026-09-19 13:48:24','2026-09-19 13:48:24'),
(9,'Taman Kelurahan','RW 09','Ruang Terbuka','Kp. Cibogo RT 06','APBD','pending',NULL,'2026-09-19 13:48:24','2026-09-19 13:48:24'),
(11,'Masjid Al-Basyarrrrrrrrr','Cibinong Utara','Keagamaan','kp. Cibinong mantap','Dana Desa','pending',NULL,'2026-09-19 13:52:41','2026-09-19 13:52:48'),
(12,'Musolah Al-Jami','RW 01','Keagamaan','Kp Daek Kel. Binong','Swadaya Masyarakat','synced','2026-09-20 21:15:10','2026-09-20 21:15:08','2026-09-20 21:15:10');

/*Table structure for table `data_kpm` */

DROP TABLE IF EXISTS `data_kpm`;

CREATE TABLE `data_kpm` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`id_data` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`nik` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
`nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
`rw` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`jenis_bantuan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
`desil` tinyint unsigned DEFAULT NULL,
`keterangan` text COLLATE utf8mb4_unicode_ci,
`google_sync_status` enum('pending','synced','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `data_kpm_id_data_unique` (`id_data`),
UNIQUE KEY `data_kpm_nik_unique` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_kpm` */

insert into `data_kpm`(`id`,`id_data`,`nik`,`nama`,`rw`,`jenis_bantuan`,`desil`,`keterangan`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(1,'KPM-001','3275014202850001','Rina Wulandari','05','PKH',2,'Penerima Program Keluarga Harapan.','pending',NULL,'2026-09-18 23:56:19','2026-09-18 23:56:19'),
(2,'KPM-002','3275011801780002','Agus Setiawan','03','BPNT',3,'Penerima bantuan pangan melalui program BPNT.','pending',NULL,'2026-09-18 23:56:19','2026-09-18 23:56:19'),
(3,'KPM-003','3275015606900003','Sulastri','08','PKH',1,'Penerima PKH berdasarkan data kesejahteraan sosial.','pending',NULL,'2026-09-18 23:56:19','2026-09-18 23:56:19'),
(4,'KPM-004','3275011205640004','Bambang Haryanto','02','Bantuan Pangan',4,'Penerima bantuan pangan.','pending',NULL,'2026-09-18 23:56:19','2026-09-18 23:56:19'),
(6,'KPM-00122','322223322333','Elsa Tania Putriiiii','04','PKH',5,'mantap','pending',NULL,'2026-09-18 23:58:37','2026-09-19 00:01:49'),
(7,'KPM-559','32773636636','Agus Harimurti','04','PKH',3,'Mantap','failed',NULL,'2026-09-20 15:13:50','2026-09-20 15:13:51'),
(8,'KPM-66','4242426262627','Bagus Baik','04','Bantuan Pangan',2,'mantap','failed',NULL,'2026-09-20 15:14:50','2026-09-20 15:14:51'),
(9,'KPM-55','321212744','Nurman Kamaru','04','BPNT',2,'Mantap','synced','2026-09-20 15:19:38','2026-09-20 15:19:36','2026-09-20 15:19:38');

/*Table structure for table `data_laporan_penduduk` */

DROP TABLE IF EXISTS `data_laporan_penduduk`;

CREATE TABLE `data_laporan_penduduk` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`bulan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`tahun` smallint unsigned DEFAULT NULL,
`jumlah_kk` int unsigned NOT NULL DEFAULT '0',
`jumlah_laki_laki` int unsigned NOT NULL DEFAULT '0',
`jumlah_perempuan` int unsigned NOT NULL DEFAULT '0',
`jumlah_kematian` int unsigned NOT NULL DEFAULT '0',
`jumlah_kelahiran` int unsigned NOT NULL DEFAULT '0',
`jumlah_pindah_datang` int unsigned NOT NULL DEFAULT '0',
`jumlah_pindah_keluar` int unsigned NOT NULL DEFAULT '0',
`penduduk_sementara` int unsigned NOT NULL DEFAULT '0',
`keterangan` text COLLATE utf8mb4_unicode_ci,
`google_sync_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_laporan_penduduk` */

insert into `data_laporan_penduduk`(`id`,`bulan`,`tahun`,`jumlah_kk`,`jumlah_laki_laki`,`jumlah_perempuan`,`jumlah_kematian`,`jumlah_kelahiran`,`jumlah_pindah_datang`,`jumlah_pindah_keluar`,`penduduk_sementara`,`keterangan`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(3,'Maret',2026,1265,2001,2027,7,17,14,11,4,'Laporan kependudukan bulan Maret 2026.','pending',NULL,'2026-09-19 17:15:30','2026-09-19 17:15:30'),
(4,'April',2026,1272,2008,2035,5,16,11,9,7,'Laporan kependudukan bulan April 2026.','pending',NULL,'2026-09-19 17:15:30','2026-09-19 17:15:30'),
(5,'Mei',2026,1280,2016,2043,9,18,15,12,5,'Laporan kependudukan bulan Mei 2026.','pending',NULL,'2026-09-19 17:15:30','2026-09-19 17:15:30'),
(6,'April',2026,2005,1005,1010,2,5,2,1,10,'mantap pisan','pending',NULL,'2026-09-19 17:20:34','2026-09-19 18:45:26'),
(7,'September',2026,200,100,100,3,5,5,2,4,'mantap','synced','2026-09-20 21:24:33','2026-09-20 21:24:31','2026-09-20 21:24:33');

/*Table structure for table `data_linmas` */

DROP TABLE IF EXISTS `data_linmas`;

CREATE TABLE `data_linmas` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`rw` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
`jumlah_linmas` int unsigned NOT NULL DEFAULT '0',
`nama` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`nik` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`alamat` text COLLATE utf8mb4_unicode_ci,
`pekerjaan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`jumlah_poskamling` int unsigned NOT NULL DEFAULT '0',
`titik_poskamling` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`keterangan` text COLLATE utf8mb4_unicode_ci,
`google_sync_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_linmas` */

insert into `data_linmas`(`id`,`rw`,`jumlah_linmas`,`nama`,`nik`,`alamat`,`pekerjaan`,`jumlah_poskamling`,`titik_poskamling`,`keterangan`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(2,'02',7,'Dedi Hermawan','3273010201800002','Jl. Binong Raya RT 02/RW 02','Karyawan Swasta',2,NULL,'Data Linmas RW 02','pending',NULL,'2026-09-19 17:46:30','2026-09-19 17:46:30'),
(3,'03',9,'Asep Supriatna','3273010301800003','Jl. Binong Raya RT 03/RW 03','Pedagang',3,NULL,'Data Linmas RW 03','pending',NULL,'2026-09-19 17:46:30','2026-09-19 17:46:30'),
(4,'04',8,'Agus Setiawan','3273010401800004','Jl. Binong Raya RT 04/RW 04','Wiraswasta',2,NULL,'Data Linmas RW 04','pending',NULL,'2026-09-19 17:46:30','2026-09-19 17:46:30'),
(5,'05',10,'Dadan Hidayat','3273010501800005','Jl. Binong Raya RT 05/RW 05','Karyawan Swasta',3,NULL,'Data Linmas RW 05','pending',NULL,'2026-09-19 17:46:30','2026-09-19 17:46:30'),
(6,'06',7,'Hendra Gunawan','3273010601800006','Jl. Binong Raya RT 01/RW 06','Petani',2,NULL,'Data Linmas RW 06','pending',NULL,'2026-09-19 17:46:30','2026-09-19 17:46:30'),
(7,'07',8,'Iwan Kurniawan','3273010701800007','Jl. Binong Raya RT 02/RW 07','Wiraswasta',2,NULL,'Data Linmas RW 07','pending',NULL,'2026-09-19 17:46:30','2026-09-19 17:46:30'),
(12,'01',4,'Budi Marwan','3212232321','Binong City','Wiraswasta',3,'Pod Kamling RW 01','mantap','pending',NULL,'2026-09-19 17:49:56','2026-09-19 20:01:45'),
(17,'01',8,'Budi Santoso','3273010101800001','Jl. Binong Raya RT 01/RW 01','Wiraswasta',2,NULL,'Data Linmas RW 01','pending',NULL,'2026-09-19 18:44:50','2026-09-19 19:02:06'),
(18,'RW 2',4,'Bakri Sah','32123323232','Binong Utara Binong','UMKM',2,'Pos Kamiling RW 2','mantap','synced','2026-09-20 21:43:18','2026-09-20 21:43:16','2026-09-20 21:43:18'),
(19,'RW 07',5,'Hilman Hadi','7384738473838','ujung binong','Karyawan Pabrik',3,'Pos Kamling RW 7','mantap','synced','2026-09-20 22:07:08','2026-09-20 22:07:05','2026-09-20 22:07:08');

/*Table structure for table `data_pkl` */

DROP TABLE IF EXISTS `data_pkl`;

CREATE TABLE `data_pkl` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`nama_pkl` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
`jenis_dagangan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
`lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`keterangan` text COLLATE utf8mb4_unicode_ci,
`google_sync_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` datetime DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_pkl` */

insert into `data_pkl`(`id`,`nama_pkl`,`jenis_dagangan`,`lokasi`,`keterangan`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(1,'Warung Bu Sitiwwww','Makanan','Jl. Raya Kelurahan','Menjual nasi dan lauk pauk','pending',NULL,'2026-09-19 20:11:22','2026-09-19 20:18:40'),
(2,'Es Teh Segar Pak Andi','Minuman','Dekat Lapangan Kelurahan','Menjual aneka minuman dingin','pending',NULL,'2026-09-19 20:11:22','2026-09-19 20:11:22'),
(6,'Bah Jamin','Minuman','Jl. Kelurahan','Es Kelapa Mantap','pending',NULL,'2026-09-19 20:19:13','2026-09-19 20:19:13'),
(7,'Warung Mba Eca','Makanan Ringan','Jl Binong Utara','mantaap','synced','2026-09-20 22:28:59','2026-09-20 22:28:57','2026-09-20 22:28:59');

/*Table structure for table `data_pohon` */

DROP TABLE IF EXISTS `data_pohon`;

CREATE TABLE `data_pohon` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`jenis_pohon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`lokasi` text COLLATE utf8mb4_unicode_ci,
`jumlah` int DEFAULT NULL,
`kondisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`google_sync_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_pohon` */

insert into `data_pohon`(`id`,`jenis_pohon`,`lokasi`,`jumlah`,`kondisi`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(1,'Pohon Mangga','Kp. Sukamaju RT 02',25,'Baik','pending',NULL,'2026-09-19 13:24:14','2026-09-19 13:24:14'),
(3,'Pohon Rambutan','Kp. Cibogo RT 03',32,'Cukup Baik','pending',NULL,'2026-09-19 13:24:14','2026-09-19 13:24:14'),
(5,'Pohon Mahoni','Kp. Sukajaya RT 05',20,'Perlu Perawatan','pending',NULL,'2026-09-19 13:24:14','2026-09-19 13:24:14'),
(7,'Pohon Trembesi','Jl. Lingkungan RW 06',12,'Cukup Baik','pending',NULL,'2026-09-19 13:24:14','2026-09-19 13:24:14'),
(8,'Pohon Pucuk Merah','Kp. Sukamukti RT 03',35,'Baik','pending',NULL,'2026-09-19 13:24:15','2026-09-19 13:24:15'),
(9,'Pohon Angsana','Kp. Cibogo RT 06',17,'Cukup Baik','pending',NULL,'2026-09-19 13:24:15','2026-09-19 13:24:15'),
(10,'Pohon Flamboyan','Jl. Raya Binong RT 07',10,'Perlu Perawatan','pending',NULL,'2026-09-19 13:24:15','2026-09-19 13:24:15'),
(11,'Pohon Manggaaaaaaaaaaaaaa','Kp. Sukamaju',21,'Baik','pending',NULL,'2026-09-19 13:38:56','2026-09-19 13:39:08'),
(12,'Pohon Jambuuuu','Kp. Sukamundur Binong',25,'Baik','synced','2026-09-20 21:08:28','2026-09-20 21:08:08','2026-09-20 21:08:28');

/*Table structure for table `data_posyandu` */

DROP TABLE IF EXISTS `data_posyandu`;

CREATE TABLE `data_posyandu` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`id_data` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`jenis` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
`nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
`rw` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`jumlah_kader` int NOT NULL DEFAULT '0',
`jumlah_balita` int NOT NULL DEFAULT '0',
`keterangan` text COLLATE utf8mb4_unicode_ci,
`google_sync_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `data_posyandu_id_data_unique` (`id_data`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_posyandu` */

insert into `data_posyandu`(`id`,`id_data`,`jenis`,`nama`,`rw`,`jumlah_kader`,`jumlah_balita`,`keterangan`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(1,'PSY-001','Posyandu','Posyandu Melati','01',8,0,'Posyandu balita dan ibu hamil','pending',NULL,'2026-09-16 22:48:48','2026-09-16 22:48:48'),
(2,'PSY-002','Posyandu','Posyandu Mawar','02',7,0,'Pelayanan kesehatan balita','pending',NULL,'2026-09-16 22:48:48','2026-09-16 22:48:48'),
(3,'PSY-003','Posyandu','Posyandu Kenanga','03',9,0,'Posyandu balita dan lansia','pending',NULL,'2026-09-16 22:48:48','2026-09-16 22:48:48'),
(4,'PBD-001','Posbindu','Posbindu Sehat Bersama','04',6,0,'Pemeriksaan kesehatan masyarakat usia produktif dan lansia','pending',NULL,'2026-09-16 22:48:48','2026-09-16 22:48:48'),
(6,'posyandu-0222','Posyandu','Mawar Mekar','07',9,0,'mantaap','synced','2026-09-16 23:14:19','2026-09-16 23:14:16','2026-09-16 23:14:19'),
(7,'Posyandu-21212','Posyandu','Posyandu Ceria','08',9,0,'mantap','synced','2026-09-16 23:18:44','2026-09-16 23:18:42','2026-09-16 23:18:44'),
(8,'DK-03333','Posyandu','Posyandu Elsa','02',10,0,'manyaappp','failed',NULL,'2026-09-16 23:32:01','2026-09-16 23:32:01'),
(9,'Posyandu-2111','Posyandu','Posyandu Huda','07',6,0,'mantaappp','failed',NULL,'2026-09-16 23:33:35','2026-09-16 23:33:36'),
(10,'Posyandu-222','Posyandu','Posyandu Syifa','02',7,0,'mantaap','failed',NULL,'2026-09-16 23:36:09','2026-09-16 23:36:09'),
(11,'Posyandu-212122','Posyandu','Posyandu Merdeka','07',9,0,'mantaap','failed',NULL,'2026-09-16 23:43:47','2026-09-16 23:43:48'),
(12,'Posyandu-21211','Posyandu','Posyandu Keren','08',10,0,'mantaaap','failed',NULL,'2026-09-16 23:46:33','2026-09-16 23:46:34'),
(13,'psy-099','Posyandu','Posyandu Elsa Tania','07',8,0,'mantaap','failed',NULL,'2026-09-16 23:51:44','2026-09-16 23:51:46'),
(14,'PSY-22','Posyandu','Posyandu Kita','02',7,0,'tes koneksi','failed',NULL,'2026-09-17 00:01:28','2026-09-17 00:01:30'),
(15,'PSY-40','Posyandu','Posyandu Kaka','02',8,0,'cek koneksi','failed',NULL,'2026-09-17 00:06:05','2026-09-17 00:06:07'),
(16,'PSY-212','Posyandu','Posyandu Mama','02',8,0,'cek koneksi','failed',NULL,'2026-09-17 00:11:25','2026-09-17 00:11:25'),
(17,'PSY-41','Posyandu','Posyandu Coba','03',8,0,'Test Google Sheet','failed',NULL,'2026-09-17 00:12:50','2026-09-17 00:12:50'),
(18,'PSY-51','Posyandu','Posyandu Lika','08',6,0,'tes koneksi posyandu','failed',NULL,'2026-09-17 00:17:50','2026-09-17 00:17:53'),
(19,'PSY-42','Posyandu','Posyandu Dalim','09',8,0,'tes koneksi','failed',NULL,'2026-09-17 00:19:30','2026-09-17 00:19:32'),
(20,'PSY-43','Posyandu','Posyandu Hayu','08',8,0,'Cek koneksi','failed',NULL,'2026-09-17 00:24:42','2026-09-17 00:24:45'),
(21,'PSY-44','Posyandu','Posyandu Wow','08',8,0,'Cek koneksi','synced','2026-09-17 00:30:16','2026-09-17 00:30:04','2026-09-17 00:30:16'),
(22,'PSY-45','Posyandu','Posyandu Wew','08',8,0,'Cek koneksi','failed',NULL,'2026-09-17 00:35:12','2026-09-17 00:43:59'),
(23,'PSY-69','Posbindu','Posbindu Cahaya Hati','05',3,2,'mantap','failed',NULL,'2026-09-18 21:57:54','2026-09-18 22:56:18'),
(24,'PSY-066','Posyandu','Posyandu Hagiaaa','04',4,6,'Mantap','synced','2026-09-20 14:12:39','2026-09-20 14:11:03','2026-09-20 14:12:39');

/*Table structure for table `data_rt_rw` */

DROP TABLE IF EXISTS `data_rt_rw`;

CREATE TABLE `data_rt_rw` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`nama_rt` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
`nomor_rt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
`nama_rw` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
`nomor_rw` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
`tanggal_mulai` date DEFAULT NULL,
`tanggal_berakhir` date DEFAULT NULL,
`google_sync_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_rt_rw` */

insert into `data_rt_rw`(`id`,`nama_rt`,`nomor_rt`,`nama_rw`,`nomor_rw`,`tanggal_mulai`,`tanggal_berakhir`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(1,'Budi Santoso','RT 02','Hendra Wijaya','RW 01','2025-01-01','2029-12-31','pending',NULL,'2026-09-19 19:17:20','2026-09-19 19:44:54'),
(2,'Ahmad Hidayat','RT 02','Hendra Wijaya','RW 01','2025-01-01','2029-12-31','pending',NULL,'2026-09-19 19:17:20','2026-09-19 19:17:20'),
(3,'Dedi Kurniawan','RT 03','Agus Setiawan','RW 02','2025-02-15','2030-02-14','pending',NULL,'2026-09-19 19:17:20','2026-09-19 19:17:20'),
(4,'Eko Prasetyo','RT 04','Agus Setiawan','RW 02','2025-02-15','2030-02-14','pending',NULL,'2026-09-19 19:17:20','2026-09-19 19:17:20'),
(5,'Rudi Hartono','RT 05','Hendra Wijaya','RW 01','2025-01-01','2029-12-31','pending',NULL,'2026-09-19 19:17:20','2026-09-19 19:17:20'),
(7,'Budi Raharjooooo','RT 04','Kusnandar','RW 02','2026-08-10','2029-08-10','pending',NULL,'2026-09-19 19:46:09','2026-09-19 19:47:56'),
(8,'Nur Kahmiiiii','01','Kuswantoooooo','02','2026-08-10','2030-08-10','synced','2026-09-20 22:18:12','2026-09-20 22:17:43','2026-09-20 22:18:12');

/*Table structure for table `data_rutilahu` */

DROP TABLE IF EXISTS `data_rutilahu`;

CREATE TABLE `data_rutilahu` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`nik` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`nama_kepala_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`alamat` text COLLATE utf8mb4_unicode_ci,
`rt` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`rw` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`kondisi_rumah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`tingkat_prioritas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`status_bantuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`google_sync_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_rutilahu` */

insert into `data_rutilahu`(`id`,`nik`,`nama_kepala_keluarga`,`alamat`,`rt`,`rw`,`kondisi_rumah`,`tingkat_prioritas`,`status_bantuan`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(1,'3273010101800001','Asep Supriatna','Jl. Binong Raya No. 12','001','001','Rusak','Tinggi','Belum Mendapatkan','pending',NULL,'2026-09-19 12:19:35','2026-09-19 12:19:35'),
(2,'3273010202750002','Dedi Mulyana','Kp. Binong RT 002 RW 001','002','001','Sedang','Sedang','Dalam Proses','pending',NULL,'2026-09-19 12:19:35','2026-09-19 12:19:35'),
(3,'3273010303680003','Ujang Hidayat','Kp. Sukamaju RT 003 RW 002','003','002','Rusak','Tinggi','Belum Mendapatkan','pending',NULL,'2026-09-19 12:19:35','2026-09-19 12:19:35'),
(4,'3273010401600004','Endang Sutisna','Jl. Raya Binong No. 25','004','002','Sedang','Sedang','Sudah Mendapatkan','pending',NULL,'2026-09-19 12:19:35','2026-09-19 12:19:35'),
(5,'3273010505550005','Rudi Hermawan','Kp. Cibodas RT 005 RW 003','005','003','Baik','Rendah','Sudah Mendapatkan','pending',NULL,'2026-09-19 12:19:35','2026-09-19 12:19:35'),
(6,'3273010606900006','Dadang Kurniawan','Kp. Binong RT 006 RW 003','006','003','Rusak','Tinggi','Dalam Proses','pending',NULL,'2026-09-19 12:19:35','2026-09-19 12:19:35'),
(7,'3273010701770007','Yayan Suryana','Jl. Sukamulya RT 007 RW 004','007','004','Sedang','Sedang','Belum Mendapatkan','pending',NULL,'2026-09-19 12:19:35','2026-09-19 12:19:35'),
(8,'3273010802820008','Wawan Gunawan','Kp. Cikadu RT 008 RW 004','008','004','Rusak','Tinggi','Belum Mendapatkan','pending',NULL,'2026-09-19 12:19:35','2026-09-19 12:19:35'),
(10,'3273011012670010','Cecep Ramdani','Jl. Mekarsari RT 010 RW 005','010','005','Sedang','Sedang','Dalam Proses','pending',NULL,'2026-09-19 12:19:35','2026-09-19 12:19:35'),
(11,'312121212','Asep Kadekkkkkk','Binong City Bandung','001','004','Rusak','Tinggi','Belum Mendapatkan','pending',NULL,'2026-09-19 12:40:04','2026-09-19 12:40:37'),
(12,'3223232323','Jajang Koala','Ujung Jalan Binong','002','002','Sedang','Tinggi','Dalam Proses','synced','2026-09-20 20:25:33','2026-09-20 20:25:30','2026-09-20 20:25:33');

/*Table structure for table `data_sekolah` */

DROP TABLE IF EXISTS `data_sekolah`;

CREATE TABLE `data_sekolah` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`id_data` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`nama_sekolah` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
`jenjang` enum('TK','SD','SMP','SMA','SMK') COLLATE utf8mb4_unicode_ci NOT NULL,
`alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
`jumlah_siswa` int unsigned NOT NULL DEFAULT '0',
`keterangan` text COLLATE utf8mb4_unicode_ci,
`google_sync_status` enum('pending','synced','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `data_sekolah_id_data_unique` (`id_data`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_sekolah` */

insert into `data_sekolah`(`id`,`id_data`,`nama_sekolah`,`jenjang`,`alamat`,`jumlah_siswa`,`keterangan`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(1,'SEK-001','SDN Binong 01','SD','Jl. Melati No. 1, Kelurahan Binong',245,'Sekolah dasar negeri di wilayah Kelurahan Binong.','pending',NULL,'2026-09-19 00:37:29','2026-09-19 00:37:29'),
(2,'SEK-002','SMPN Binong 02','SMP','Jl. Mawar No. 2, Kelurahan Binong',318,'Sekolah menengah pertama negeri di wilayah Kelurahan Binong.','pending',NULL,'2026-09-19 00:37:29','2026-09-19 00:37:29'),
(3,'SEK-003','SDN Binong 03','SD','Jl. Kenanga No. 3, Kelurahan Binong',198,'Sekolah dasar negeri di wilayah Kelurahan Binong.','pending',NULL,'2026-09-19 00:37:29','2026-09-19 00:37:29'),
(6,'Sek-00121314','SDN 12 Binong','SMP','Jl. Desa Bajak Laut',21212222,'saddd','pending',NULL,'2026-09-19 00:42:53','2026-09-19 00:44:28'),
(7,'SEK-033','SDN 22 Binong','SD','Jl. Melati Binong Utara',400,'mantap','synced','2026-09-20 19:43:30','2026-09-20 19:43:02','2026-09-20 19:43:30');

/*Table structure for table `data_stunting` */

DROP TABLE IF EXISTS `data_stunting`;

CREATE TABLE `data_stunting` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`nik` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
`nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
`tanggal_lahir` date NOT NULL,
`jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
`rw` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`status` enum('Normal','Berisiko','Stunting') COLLATE utf8mb4_unicode_ci NOT NULL,
`keterangan` text COLLATE utf8mb4_unicode_ci,
`google_sync_status` enum('pending','synced','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `data_stunting_nik_unique` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_stunting` */

insert into `data_stunting`(`id`,`nik`,`nama`,`tanggal_lahir`,`jenis_kelamin`,`rw`,`status`,`keterangan`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(2,'3275010202210002','Siti Aisyah','2021-02-20','Perempuan',NULL,'Berisiko','Perlu pemantauan pertumbuhan dan asupan gizi secara berkala.','pending',NULL,'2026-09-18 23:33:00','2026-09-18 23:33:00'),
(3,'3275010303190003','Rizky Maulana','2019-03-10','Laki-laki',NULL,'Stunting','Memerlukan pemantauan dan penanganan lebih lanjut.','pending',NULL,'2026-09-18 23:33:00','2026-09-18 23:33:00'),
(4,'3275010410220004','Nabila Putri','2022-04-25','Perempuan',NULL,'Normal','Kondisi anak dalam batas normal berdasarkan pemantauan.','pending',NULL,'2026-09-18 23:33:00','2026-09-18 23:33:00'),
(6,'321212','Hagia Zhafiraaa','2026-02-01','Perempuan',NULL,'Normal','mantap','pending',NULL,'2026-09-18 23:40:25','2026-09-20 14:46:53'),
(7,'3121212122','Hagia Zhafira Huda','2026-02-04','Perempuan','06','Normal','mantap','synced','2026-09-20 14:54:15','2026-09-20 14:54:13','2026-09-20 14:54:15');

/*Table structure for table `data_umkm` */

DROP TABLE IF EXISTS `data_umkm`;

CREATE TABLE `data_umkm` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`nama_pelaku_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`nik` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`no_kk` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`no_telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`nama_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`jenis_usaha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`alamat_usaha` text COLLATE utf8mb4_unicode_ci,
`kelurahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Binong',
`kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`kabupaten_kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`nib` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`izin_usaha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`produk_utama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`modal_usaha` decimal(15,2) DEFAULT NULL,
`omzet_bulanan` decimal(15,2) DEFAULT NULL,
`jumlah_tenaga_kerja` int unsigned DEFAULT NULL,
`skala_usaha` enum('Mikro','Kecil','Menengah') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`status_usaha` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
`keterangan` text COLLATE utf8mb4_unicode_ci,
`google_sync_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_umkm` */

insert into `data_umkm`(`id`,`nama_pelaku_usaha`,`nik`,`no_kk`,`no_telepon`,`nama_usaha`,`jenis_usaha`,`alamat_usaha`,`kelurahan`,`kecamatan`,`kabupaten_kota`,`nib`,`npwp`,`izin_usaha`,`produk_utama`,`modal_usaha`,`omzet_bulanan`,`jumlah_tenaga_kerja`,`skala_usaha`,`status_usaha`,`keterangan`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(2,'Budi Santoso','3273011202780003','3273011202780004','081323456781','Toko Sumber Rezeki','Perdagangan','Jl. Mawar No. 25, Kelurahan Binong','Binong','Batununggal','Kota Bandung','9120304567891','123456789012346','NIB','Sembako dan Kebutuhan Rumah Tangga',35000000.00,18000000.00,4,'Kecil','Aktif','Toko kebutuhan sehari-hari masyarakat.','pending',NULL,'2026-09-19 10:53:27','2026-09-19 10:53:27'),
(3,'Andi Wijaya','3273012303900005','3273012303900006','082145678901','Bengkel Maju Motor','Jasa','Jl. Kenanga No. 8, Kelurahan Binong','Binong','Batununggal','Kota Bandung','9120304567892','123456789012347','NIB','Servis Sepeda Motor',45000000.00,22000000.00,5,'Kecil','Aktif','Bengkel sepeda motor dan penjualan suku cadang.','pending',NULL,'2026-09-19 10:53:27','2026-09-19 10:53:27'),
(4,'Rina Lestari','3273015604920007','3273015604920008','085712345678','Butik Cantik Fashion','Fashion','Jl. Anggrek No. 17, Kelurahan Binong','Binong','Batununggal','Kota Bandung','9120304567893','123456789012348','NIB','Pakaian Wanita',28000000.00,14500000.00,3,'Kecil','Aktif','Produksi dan penjualan pakaian wanita.','pending',NULL,'2026-09-19 10:53:27','2026-09-19 10:53:27'),
(5,'Dedi Haryanto','3273011001750009','3273011001750010','081987654321','Tani Makmur','Pertanian','Jl. Flamboyan No. 5, Kelurahan Binong','Binong','Batununggal','Kota Bandung','9120304567894','123456789012349','NIB','Sayuran dan Tanaman Pangan',20000000.00,12000000.00,4,'Mikro','Aktif','Usaha pertanian dan pemasaran hasil panen.','pending',NULL,'2026-09-19 10:53:27','2026-09-19 10:53:27'),
(6,'Nurhayati','3273016502830011','3273016502830012','082234567890','Kue Bu Nuri','Kuliner','Jl. Dahlia No. 21, Kelurahan Binong','Binong','Batununggal','Kota Bandung','9120304567895',NULL,'NIB','Kue Tradisional dan Snack',10000000.00,6500000.00,2,'Mikro','Aktif','Produksi kue rumahan berdasarkan pesanan.','pending',NULL,'2026-09-19 10:53:27','2026-09-19 10:53:27'),
(7,'Agus Setiawan','3273011505860013','3273011505860014','081345678902','Percetakan Binong Jaya','Jasa','Jl. Cempaka No. 14, Kelurahan Binong','Binong','Batununggal','Kota Bandung','9120304567896','123456789012350','NIB','Percetakan dan Fotokopi',40000000.00,20000000.00,4,'Kecil','Aktif','Jasa percetakan, fotokopi, dan desain grafis.','pending',NULL,'2026-09-19 10:53:27','2026-09-19 10:53:27'),
(8,'Yuni Kartika','3273015707940015','3273015707940016','085612345679','Yuni Craft','Kerajinan','Jl. Teratai No. 9, Kelurahan Binong','Binong','Batununggal','Kota Bandung','9120304567897',NULL,'NIB','Kerajinan Dekorasi Rumah',12000000.00,7500000.00,2,'Mikro','Aktif','Produksi kerajinan dekorasi rumah.','pending',NULL,'2026-09-19 10:53:27','2026-09-19 10:53:27'),
(10,'Euis Komalasari','3273014203870019','3273014203870020','081223456781','Laundry Bersih Binong','Jasa','Jl. Mawar No. 41, Kelurahan Binong','Binong','Batununggal','Kota Bandung','9120304567899',NULL,'NIB','Laundry Kiloan',18000000.00,9500000.00,3,'Mikro','Aktif','Jasa laundry pakaian dan perlengkapan rumah tangga.','pending',NULL,'2026-09-19 10:53:27','2026-09-19 10:53:27'),
(11,'Elsa Tania','3212222111','232323232221','08334343333','Warung Neng Elsa 1','Kuliner','Jl. Industri Kp. Warung Buah, RT.03/RW.02, Hegarmanah, Kec. Babakancikao, Kabupaten Purwakarta, Jawa Barat 41151','Binong','Batununggal','Bandung','31212121212',NULL,NULL,'Makanan',1000000.00,400000.00,1,'Mikro','Aktif','mantap','pending',NULL,'2026-09-19 11:35:33','2026-09-19 11:52:41'),
(12,'Budi Gunawan','321223232','3212499559','087347384738','Warung Pojokkkk','Kuliner','Binong, Kec. Batununggal, Kota Bandung, Jawa Barat 40275','Binong','Batununggal','Kota Bandung','-','-','-','Makanan',1000000.00,200000.00,3,'Mikro','Aktif','mantap','synced','2026-09-20 19:59:40','2026-09-20 19:59:18','2026-09-20 19:59:40');

/*Table structure for table `data_umum_kepegawaian` */

DROP TABLE IF EXISTS `data_umum_kepegawaian`;

CREATE TABLE `data_umum_kepegawaian` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`jenis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`nomor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
`nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
`golongan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
`pangkat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
`jabatan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
`keterangan` text COLLATE utf8mb4_unicode_ci,
`google_sync_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`google_synced_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_umum_kepegawaian` */

insert into `data_umum_kepegawaian`(`id`,`jenis`,`nomor`,`nama`,`golongan`,`pangkat`,`jabatan`,`keterangan`,`google_sync_status`,`google_synced_at`,`created_at`,`updated_at`) values
(2,'ASN','19780512 200501 1 001','Ahmad Hidayat','III/d','Pembina Tk. I','Lurah',NULL,'pending',NULL,'2026-09-15 14:48:56','2026-09-15 14:48:56'),
(5,'ASN','19900318 201502 2 004','Dewi Lestari','III/a','Penata Muda','Kasi Pelayanan',NULL,'pending',NULL,'2026-09-15 14:48:56','2026-09-15 14:48:56'),
(6,'PPPK','19940527 202301 1 005','Rudi Hermawan','IX','Ahli Pertama','Staf Pelayanan',NULL,'pending',NULL,'2026-09-15 14:48:56','2026-09-15 14:48:56'),
(7,'ASN','3212233332','Manarul Huda','IV/b','Penata Komputer','Kepala Divisi Teknik','Pegawai Spesialis Komputer','pending',NULL,'2026-09-15 14:52:36','2026-09-15 14:52:36'),
(8,'ASN','2322122222','Elsa Tania Putri','IV/c','Penata Administrasi','Kepala Kasi','Admin Spesialis','failed',NULL,'2026-09-15 15:22:49','2026-09-15 15:22:56'),
(9,'ASN','3212131233','Hudasan','IV/c','Penata Komputer','Spesialis Teknisi','Pegawai Baru 2026','failed',NULL,'2026-09-15 15:48:45','2026-09-15 15:48:45'),
(10,'ASN','32132123123','Huda Manarul','IV/a','Penata Komputer','Spesialis Jaringan','Pegawai baru 2026','failed',NULL,'2026-09-15 15:54:26','2026-09-15 15:54:26'),
(11,'ASN','3212333333','Hagi Zhafira','IV/b','Dokter Desa','Kepala Dokter','Dokter baru 2026','failed',NULL,'2026-09-15 16:05:03','2026-09-15 16:05:03'),
(12,'ASN','321232323','Elsa Tania','IV/c','Penata Administrasi','Kabag Umum','Pegawai 2026','synced','2026-09-15 16:46:41','2026-09-15 16:46:37','2026-09-15 16:46:41'),
(15,'PPPK','33333333333','Arif Munirrrrrr','IV/d','Kepala Kepemudaan','Kepala Linmas Senior','Pegawai 2026','synced','2026-09-17 01:00:04','2026-09-15 17:01:24','2026-09-17 01:00:04'),
(17,'ASN','3211222','Baruang Mamat','II/a','Support','OB','Mantap','failed',NULL,'2026-09-18 05:37:58','2026-09-18 05:37:58'),
(19,'ASN','32222111','Elsa Tania Putri Huda','IV/d','Bagian Umum','Kepala Bagian','mantaap','synced','2026-09-19 23:03:36','2026-09-19 23:03:34','2026-09-19 23:03:36'),
(20,'ASN','3212132123','Nadia Djawaz Daraaa','III/b','Administrasi','Kepala Bagian','Mantap','synced','2026-09-19 23:32:42','2026-09-19 23:04:51','2026-09-19 23:32:42');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
`exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
`failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

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

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
`attempts` smallint unsigned NOT NULL,
`reserved_at` int unsigned DEFAULT NULL,
`available_at` int unsigned NOT NULL,
`created_at` int unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `laporan_bulanan` */

DROP TABLE IF EXISTS `laporan_bulanan`;

CREATE TABLE `laporan_bulanan` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`menu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
`judul_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`bulan` tinyint unsigned NOT NULL,
`tahun` smallint unsigned NOT NULL,
`nama_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`file_path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
`keterangan` text COLLATE utf8mb4_unicode_ci,
`generated_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `laporan_bulanan_menu_tahun_bulan_index` (`menu`,`tahun`,`bulan`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `laporan_bulanan` */

insert into `laporan_bulanan`(`id`,`menu`,`judul_laporan`,`bulan`,`tahun`,`nama_file`,`file_path`,`status`,`keterangan`,`generated_at`,`created_at`,`updated_at`) values
(1,'datartrw','Laporan Data RT & RW September 2026',9,2026,'laporan-datartrw-september-2026-1.pdf',NULL,'generated','Laporan dibuat melalui sistem administrasi Kelurahan Binong.','2026-09-19 20:53:52','2026-09-19 20:53:52','2026-09-19 20:53:52'),
(2,'datartrw','Laporan Data RT & RW September 2026',9,2026,'laporan-datartrw-september-2026-2.pdf',NULL,'generated','Laporan dibuat melalui sistem administrasi Kelurahan Binong.','2026-09-19 20:59:04','2026-09-19 20:59:04','2026-09-19 20:59:04'),
(3,'datartrw','Laporan Data RT & RW September 2026',9,2026,'laporan-datartrw-september-2026-3.pdf',NULL,'generated','Laporan dibuat melalui sistem administrasi Kelurahan Binong.','2026-09-19 20:59:39','2026-09-19 20:59:39','2026-09-19 20:59:39'),
(4,'datartrw','Laporan Data RT & RW September 2026',9,2026,'laporan-datartrw-september-2026-4.pdf',NULL,'generated','Laporan dibuat melalui sistem administrasi Kelurahan Binong.','2026-09-19 21:00:58','2026-09-19 21:00:58','2026-09-19 21:00:58'),
(5,'datartrw','Laporan Data RT & RW September 2026',9,2026,'laporan-datartrw-september-2026-5.pdf',NULL,'failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:04:48','2026-09-19 21:04:48','2026-09-19 21:04:49'),
(6,'datartrw','Laporan Data RT & RW September 2026',9,2026,'laporan-datartrw-september-2026-6.pdf',NULL,'failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:05:27','2026-09-19 21:05:27','2026-09-19 21:05:27'),
(7,'datapkl','Laporan Data PKL September 2026',9,2026,'laporan-datapkl-september-2026-7.pdf',NULL,'failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:09:50','2026-09-19 21:09:50','2026-09-19 21:09:50'),
(8,'datapkl','Laporan Data PKL September 2026',9,2026,'laporan-datapkl-september-2026-8.pdf',NULL,'failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:11:02','2026-09-19 21:11:02','2026-09-19 21:11:02'),
(9,'datartrw','Laporan Data RT & RW September 2026',9,2026,'laporan-datartrw-september-2026-9.pdf',NULL,'failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:13:49','2026-09-19 21:13:49','2026-09-19 21:13:49'),
(10,'datartrw','Laporan Data RT & RW September 2026',9,2026,'laporan-datartrw-september-2026-10.pdf',NULL,'failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:13:58','2026-09-19 21:13:58','2026-09-19 21:13:58'),
(11,'datartrw','Laporan Data RT & RW September 2026',9,2026,'laporan-datartrw-september-2026-11.pdf',NULL,'failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:14:54','2026-09-19 21:14:54','2026-09-19 21:14:54'),
(12,'datartrw','Laporan Data RT & RW September 2026',9,2026,'laporan-datartrw-september-2026-12.pdf',NULL,'failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:17:07','2026-09-19 21:17:07','2026-09-19 21:17:07'),
(13,'datapkl','Laporan Data PKL September 2026',9,2026,'laporan-datapkl-september-2026-13.pdf',NULL,'failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:17:35','2026-09-19 21:17:35','2026-09-19 21:17:36'),
(14,'datartrw','Laporan Data RT & RW September 2026',9,2026,'laporan-datartrw-september-2026-14.pdf',NULL,'failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:21:19','2026-09-19 21:21:19','2026-09-19 21:21:19'),
(15,'datartrw','Laporan Data RT & RW September 2026',9,2026,'laporan-datartrw-september-2026-15.pdf',NULL,'failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:28:34','2026-09-19 21:28:34','2026-09-19 21:28:34'),
(16,'datapkl','Laporan Data PKL September 2026',9,2026,'laporan-datapkl-september-2026-16.pdf',NULL,'failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:29:27','2026-09-19 21:29:27','2026-09-19 21:29:27'),
(17,'dataumkm','Data UMKM - September 2026',9,2026,'laporan-dataumkm-september-2026-17.pdf','laporan/laporan-dataumkm-september-2026-17.pdf','failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:42:26','2026-09-19 21:42:26','2026-09-19 21:42:26'),
(18,'dataumkm','Data UMKM - September 2026',9,2026,'laporan-dataumkm-september-2026-18.pdf','laporan/laporan-dataumkm-september-2026-18.pdf','failed','The PHP GD extension is required, but is not installed.','2026-09-19 21:42:33','2026-09-19 21:42:33','2026-09-19 21:42:33'),
(19,'dataumkm','Data UMKM - September 2026',9,2026,'laporan-dataumkm-september-2026-19.pdf','laporan/laporan-dataumkm-september-2026-19.pdf','generated','Laporan berhasil dibuat.','2026-09-19 21:45:01','2026-09-19 21:45:01','2026-09-19 21:45:01'),
(20,'dataumkm','Data UMKM - September 2026',9,2026,'laporan-dataumkm-september-2026-20.pdf','laporan/laporan-dataumkm-september-2026-20.pdf','generated','Laporan berhasil dibuat.','2026-09-19 21:48:32','2026-09-19 21:48:32','2026-09-19 21:48:32'),
(21,'dataumkm','Data UMKM - September 2026',9,2026,'laporan-dataumkm-september-2026-21.pdf','laporan/laporan-dataumkm-september-2026-21.pdf','generated','Laporan berhasil dibuat.','2026-09-19 21:50:35','2026-09-19 21:50:35','2026-09-19 21:50:35'),
(22,'dataumkm','Data UMKM - September 2026',9,2026,'laporan-dataumkm-september-2026-22.pdf','laporan/laporan-dataumkm-september-2026-22.pdf','generated','Laporan berhasil dibuat.','2026-09-19 21:51:57','2026-09-19 21:51:57','2026-09-19 21:51:57'),
(23,'datapkl','Data PKL - September 2026',9,2026,'laporan-datapkl-september-2026-23.pdf','laporan/laporan-datapkl-september-2026-23.pdf','generated','Laporan berhasil dibuat.','2026-09-20 22:30:08','2026-09-20 22:30:08','2026-09-20 22:30:08');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
`id` int unsigned NOT NULL AUTO_INCREMENT,
`migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`batch` int NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert into `migrations`(`id`,`migration`,`batch`) values
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_09_14_151423_create_data_umum_kepegawaian_table',2),
(5,'2026_09_15_145738_add_google_sync_columns_to_data_umum_kepegawaian_table',3),
(6,'2026_09_16_203859_create_data_bmd_table',4),
(7,'2026_09_16_205516_add_id_data_to_data_bmd_table',5),
(8,'2026_09_16_205858_create_data_bmd_table',6),
(9,'2026_09_16_211312_create_data_bmd_table',7),
(10,'2026_09_16_222406_create_data_posyandu_table',8),
(11,'2026_09_18_214505_add_jumlah_balita_to_data_posyandu_table',9),
(12,'2026_09_18_220237_add_jabatan_to_users_table',10),
(13,'2026_09_18_232807_create_data_stunting_table',11),
(14,'2026_09_18_234836_create_data_kpm_table',12),
(15,'2026_09_19_000543_create_data_anak_putus_sekolah_table',13),
(16,'2026_09_19_001855_create_data_sekolah_table',14),
(17,'2026_09_19_095705_create_data_umkm_table',15),
(18,'2026_09_19_104317_add_google_sync_fields_to_data_umkm_table',16),
(19,'2026_09_19_115625_create_data_rutilahu_table',17),
(20,'2026_09_19_130149_create_data_buruan_sae_table',18),
(21,'2026_09_19_131938_create_data_pohon_table',19),
(22,'2026_09_19_134541_create_data_fasilitas_umum_table',20),
(23,'2026_09_19_165656_create_data_laporan_penduduk_table',21),
(24,'2026_09_19_174054_create_data_linmas_table',22),
(25,'2026_09_19_191352_create_data_rt_rw_table`,23),
(26,'2026_09_19_195626_add_titik_poskamling_to_data_linmas_table',24),
(27,'2026_09_19_200756_create_data_pkl_table',25),
(28,'2026_09_19_202445_create_laporan_bulanan_table',26),
(29,'2026_09_20_143400_add_rw_to_data_stunting_table',27);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
`email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`created_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

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

/*Data for the table `sessions` */

insert into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values
('klUUJl3saQBwsPHxCDvoRNp58JBSb7r0yVCUcSxE',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:157.0) Gecko/20100101 Firefox/157.0','eyJfdG9rZW4iOiJlWFpKQjVBeVkyT0FSb01RYW91bVQ2N0pDb1VGRktzZDZRNVVCWlVNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXRhbGlubWFzXC8xOFwvZWRpdCIsInJvdXRlIjoiZGF0YWxpbm1hcy5lZGl0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1789916690),
('ZVwbPGjioViwRNHOjR9QukJZJ0FeBfm4PYSuRVc9',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJQN1BUZEQzZkVqZzFHck1TOEVpaG1kZFlpN2FSaGI2RWdaZVdhRXZWIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sYXBvcmFuIiwicm91dGUiOiJsYXBvcmFuLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwidXJsIjpbXSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9',1789918208);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`jabatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
`email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`email_verified_at` timestamp NULL DEFAULT NULL,
`password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert into `users`(`id`,`name`,`jabatan`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values
(1,'Admin Kelurahan','','[admin@kelurahan.test](mailto:admin@kelurahan.test)',NULL,'$2y$12$ExP43i3zUItqexzkYtVYxO.Lj9cQZAuIsRFrgdNs3vzdKvsYNsTAC','bSPqWrT07hPbPAck5w1m5vvAh9E4amJO2pJ6kHNVzTVGgbdfbgmdiHUINB1L','2026-09-14 14:46:33','2026-09-14 14:46:33'),
(2,'Test User','Lurah','[test@example.com](mailto:test@example.com)','2026-09-15 14:48:09','$2y$12$TsOr38gTy9f14DjLsy4Qx.WGM1T1Xr0b/d1HB10gYvSu5GuFl.XIa','hHJXmf33nY','2026-09-15 14:48:09','2026-09-18 22:51:25'),
(4,'Lurah','Lurah','[lurah@kelurahanbinong.id](mailto:lurah@kelurahanbinong.id)',NULL,'$2y$12$/2wWmSI4L5dfN3EU/Vx2I.F8dePbU1pFj9Wq9/4t26BDj1YaYbhoy',NULL,'2026-09-18 22:04:30','2026-09-18 22:04:30'),
(5,'Sekretaris Kelurahan','Sekretaris Kelurahan','[sekretaris@kelurahanbinong.id](mailto:sekretaris@kelurahanbinong.id)',NULL,'$2y$12$a5nJil8iEhosVbkkbEQ1quQH2ZuY2Foum6KkwkG52JluDL6sIGWh.',NULL,'2026-09-18 22:04:30','2026-09-18 22:04:30'),
(6,'Kasi Pemerintahan','Kasi Pemerintahan','[pemerintahan@kelurahanbinong.id](mailto:pemerintahan@kelurahanbinong.id)',NULL,'$2y$12$XD2M/lCSi1IOK3OZSNMWCOsa1CnTUfWgJImr5gtpoV0MqLhtgej2i',NULL,'2026-09-18 22:04:30','2026-09-18 22:04:30'),
(7,'Kasi Kesejahteraan Sosial','Kasi Kesejahteraan Sosial','[kessos@kelurahanbinong.id](mailto:kessos@kelurahanbinong.id)',NULL,'$2y$12$g8elCqHQXko6MX1mwRcXWOx8EbyiI2rkjJuZZNkqfPZ.11E0VKXYq',NULL,'2026-09-18 22:04:30','2026-09-18 22:04:30'),
(8,'Kasi Ekonomi Pembangunan','Kasi Ekonomi Pembangunan','[ekbang@kelurahanbinong.id](mailto:ekbang@kelurahanbinong.id)',NULL,'$2y$12$sO/Ivqbn6XRWhJ//yOWeG.RFiSrkZuJdaEiZ3a6GpOAphjZyS09oa',NULL,'2026-09-18 22:04:30','2026-09-18 22:51:04');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
