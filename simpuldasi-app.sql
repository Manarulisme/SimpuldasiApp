/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE='' */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

USE `balm4691_simpuldasi-app`;


/* =========================================================
   TABLE: cache
   ========================================================= */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   TABLE: cache_locks
   ========================================================= */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   TABLE: data_bmd
   ========================================================= */

DROP TABLE IF EXISTS `data_bmd`;

CREATE TABLE `data_bmd` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_data` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_barang` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_perolehan` year DEFAULT NULL,
  `sumber_dana` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kondisi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `google_sync_status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `google_synced_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_bmd_id_data_unique` (`id_data`)
) ENGINE=InnoDB
AUTO_INCREMENT=16
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   DATA: data_bmd
   ========================================================= */

INSERT INTO `data_bmd`
(
  `id`,
  `id_data`,
  `nama_barang`,
  `type`,
  `tahun_perolehan`,
  `sumber_dana`,
  `kondisi`,
  `keterangan`,
  `google_sync_status`,
  `google_synced_at`,
  `created_at`,
  `updated_at`
)
VALUES
(
  1,
  'BMD-001',
  'Meja Kerja',
  'Sarana',
  2025,
  'BOS',
  'Baik',
  'Meja kerja pegawai dalam kondisi baik.',
  'pending',
  NULL,
  '2026-09-16 21:42:06',
  '2026-09-16 21:42:06'
),
(
  2,
  'BMD-002',
  'Kursi Kerja',
  'Sarana',
  2025,
  'BOS',
  'Baik',
  'Kursi kerja untuk ruang pelayanan.',
  'pending',
  NULL,
  '2026-09-16 21:42:06',
  '2026-09-16 21:42:06'
),
(
  3,
  'BMD-003',
  'Laptop',
  'Peralatan Elektronik',
  2024,
  'APBD',
  'Baik',
  'Laptop untuk kebutuhan administrasi kelurahan.',
  'pending',
  NULL,
  '2026-09-16 21:42:06',
  '2026-09-16 21:42:06'
),
(
  4,
  'BMD-004',
  'Printer',
  'Peralatan Elektronik',
  2024,
  'APBD',
  'Cukup Baik',
  'Printer masih dapat digunakan dengan baik.',
  'pending',
  NULL,
  '2026-09-16 21:42:06',
  '2026-09-16 21:42:06'
),
(
  5,
  'BMD-005',
  'Lemari Arsip',
  'Sarana',
  2023,
  'APBD',
  'Baik',
  'Lemari untuk penyimpanan dokumen dan arsip.',
  'pending',
  NULL,
  '2026-09-16 21:42:06',
  '2026-09-16 21:42:06'
),
(
  6,
  'BMD-006',
  'AC Split',
  'Peralatan Elektronik',
  2022,
  'APBD',
  'Cukup Baik',
  'AC ruang pelayanan, masih berfungsi.',
  'pending',
  NULL,
  '2026-09-16 21:42:06',
  '2026-09-16 21:42:06'
),
(
  7,
  'BMD-007',
  'Komputer Desktop',
  'Peralatan Elektronik',
  2023,
  'BOS',
  'Baik',
  'Komputer untuk administrasi dan pengolahan data.',
  'pending',
  NULL,
  '2026-09-16 21:42:06',
  '2026-09-16 21:42:06'
),
(
  8,
  'BMD-008',
  'Proyektor',
  'Peralatan Elektronik',
  2021,
  'Hibah',
  'Cukup Baik',
  'Digunakan untuk kegiatan rapat dan sosialisasi.',
  'pending',
  NULL,
  '2026-09-16 21:42:06',
  '2026-09-16 21:42:06'
),
(
  9,
  'BMD-009',
  'Rak Dokumen',
  'Sarana',
  2020,
  'APBD',
  'Rusak Ringan',
  'Beberapa bagian rak mengalami kerusakan ringan.',
  'pending',
  NULL,
  '2026-09-16 21:42:06',
  '2026-09-16 21:42:06'
),
(
  10,
  'BMD-010',
  'Kipas Angin',
  'Peralatan Elektronik',
  2020,
  'Lainnya',
  'Rusak Berat',
  'Kipas tidak dapat digunakan dan membutuhkan penggantian.',
  'pending',
  NULL,
  '2026-09-16 21:42:06',
  '2026-09-16 21:42:06'
),
(
  13,
  'BMD-021222',
  'Meja Lipat',
  'Sarana Prasaranaaaaa',
  2025,
  'Dana Kelurahan',
  'Baik',
  'mantap',
  'synced',
  '2026-09-17 00:58:20',
  '2026-09-16 21:56:20',
  '2026-09-17 00:58:20'
),
(
  15,
  'BMD-61',
  'Kursi Goyang',
  'Media Film',
  2023,
  'APBD',
  'Baik',
  'mantaap',
  'synced',
  '2026-09-17 00:57:29',
  '2026-09-17 00:57:27',
  '2026-09-17 00:57:29'
);


/* =========================================================
   TABLE: data_posyandu
   ========================================================= */

DROP TABLE IF EXISTS `data_posyandu`;

CREATE TABLE `data_posyandu` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_data` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `rw` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah_kader` int NOT NULL DEFAULT 0,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `google_sync_status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `google_synced_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_posyandu_id_data_unique` (`id_data`)
) ENGINE=InnoDB
AUTO_INCREMENT=23
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   DATA: data_posyandu
   ========================================================= */

INSERT INTO `data_posyandu`
(
  `id`,
  `id_data`,
  `jenis`,
  `nama`,
  `rw`,
  `jumlah_kader`,
  `keterangan`,
  `google_sync_status`,
  `google_synced_at`,
  `created_at`,
  `updated_at`
)
VALUES
(
  1,
  'PSY-001',
  'Posyandu',
  'Posyandu Melati',
  '01',
  8,
  'Posyandu balita dan ibu hamil',
  'pending',
  NULL,
  '2026-09-16 22:48:48',
  '2026-09-16 22:48:48'
),
(
  2,
  'PSY-002',
  'Posyandu',
  'Posyandu Mawar',
  '02',
  7,
  'Pelayanan kesehatan balita',
  'pending',
  NULL,
  '2026-09-16 22:48:48',
  '2026-09-16 22:48:48'
),
(
  3,
  'PSY-003',
  'Posyandu',
  'Posyandu Kenanga',
  '03',
  9,
  'Posyandu balita dan lansia',
  'pending',
  NULL,
  '2026-09-16 22:48:48',
  '2026-09-16 22:48:48'
),
(
  4,
  'PBD-001',
  'Posbindu',
  'Posbindu Sehat Bersama',
  '04',
  6,
  'Pemeriksaan kesehatan masyarakat usia produktif dan lansia',
  'pending',
  NULL,
  '2026-09-16 22:48:48',
  '2026-09-16 22:48:48'
),
(
  5,
  'PBD-002',
  'Posbindu',
  'Posbindu Binong Sehat',
  '05',
  5,
  'Pemantauan tekanan darah, gula darah, dan kesehatan lansia',
  'pending',
  NULL,
  '2026-09-16 22:48:48',
  '2026-09-16 22:48:48'
),
(
  6,
  'posyandu-0222',
  'Posyandu',
  'Mawar Mekar',
  '07',
  9,
  'mantaap',
  'synced',
  '2026-09-16 23:14:19',
  '2026-09-16 23:14:16',
  '2026-09-16 23:14:19'
),
(
  7,
  'Posyandu-21212',
  'Posyandu',
  'Posyandu Ceria',
  '08',
  9,
  'mantap',
  'synced',
  '2026-09-16 23:18:44',
  '2026-09-16 23:18:42',
  '2026-09-16 23:18:44'
),
(
  8,
  'DK-03333',
  'Posyandu',
  'Posyandu Elsa',
  '02',
  10,
  'manyaappp',
  'failed',
  NULL,
  '2026-09-16 23:32:01',
  '2026-09-16 23:32:01'
),
(
  9,
  'Posyandu-2111',
  'Posyandu',
  'Posyandu Huda',
  '07',
  6,
  'mantaappp',
  'failed',
  NULL,
  '2026-09-16 23:33:35',
  '2026-09-16 23:33:36'
),
(
  10,
  'Posyandu-222',
  'Posyandu',
  'Posyandu Syifa',
  '02',
  7,
  'mantaap',
  'failed',
  NULL,
  '2026-09-16 23:36:09',
  '2026-09-16 23:36:09'
),
(
  11,
  'Posyandu-212122',
  'Posyandu',
  'Posyandu Merdeka',
  '07',
  9,
  'mantaap',
  'failed',
  NULL,
  '2026-09-17 00:43:47',
  '2026-09-17 00:43:48'
),
(
  12,
  'Posyandu-21211',
  'Posyandu',
  'Posyandu Keren',
  '08',
  10,
  'mantaaap',
  'failed',
  NULL,
  '2026-09-17 00:46:33',
  '2026-09-17 00:46:34'
),
(
  13,
  'psy-099',
  'Posyandu',
  'Posyandu Elsa Tania',
  '07',
  8,
  'mantaap',
  'failed',
  NULL,
  '2026-09-17 00:51:44',
  '2026-09-17 00:51:46'
),
(
  14,
  'PSY-22',
  'Posyandu',
  'Posyandu Kita',
  '02',
  7,
  'tes koneksi',
  'failed',
  NULL,
  '2026-09-17 01:01:28',
  '2026-09-17 01:01:30'
),
(
  15,
  'PSY-40',
  'Posyandu',
  'Posyandu Kaka',
  '02',
  8,
  'cek koneksi',
  'failed',
  NULL,
  '2026-09-17 01:06:05',
  '2026-09-17 01:06:07'
),
(
  16,
  'PSY-212',
  'Posyandu',
  'Posyandu Mama',
  '02',
  8,
  'cek koneksi',
  'failed',
  NULL,
  '2026-09-17 01:11:25',
  '2026-09-17 01:11:25'
),
(
  17,
  'PSY-41',
  'Posyandu',
  'Posyandu Coba',
  '03',
  8,
  'Test Google Sheet',
  'failed',
  NULL,
  '2026-09-17 01:12:50',
  '2026-09-17 01:12:50'
),
(
  18,
  'PSY-51',
  'Posyandu',
  'Posyandu Lika',
  '08',
  6,
  'tes koneksi posyandu',
  'failed',
  NULL,
  '2026-09-17 01:17:50',
  '2026-09-17 01:17:53'
),
(
  19,
  'PSY-42',
  'Posyandu',
  'Posyandu Dalim',
  '09',
  8,
  'tes koneksi',
  'failed',
  NULL,
  '2026-09-17 01:19:30',
  '2026-09-17 01:19:32'
),
(
  20,
  'PSY-43',
  'Posyandu',
  'Posyandu Hayu',
  '08',
  8,
  'Cek koneksi',
  'failed',
  NULL,
  '2026-09-17 01:24:42',
  '2026-09-17 01:24:45'
),
(
  21,
  'PSY-44',
  'Posyandu',
  'Posyandu Wow',
  '08',
  8,
  'Cek koneksi',
  'synced',
  '2026-09-17 00:30:16',
  '2026-09-17 00:30:04',
  '2026-09-17 00:30:16'
),
(
  22,
  'PSY-45',
  'Posyandu',
  'Posyandu Wew',
  '08',
  8,
  'Cek koneksi',
  'failed',
  NULL,
  '2026-09-17 00:35:12',
  '2026-09-17 00:43:59'
);


/* =========================================================
   TABLE: data_umum_kepegawaian
   ========================================================= */

DROP TABLE IF EXISTS `data_umum_kepegawaian`;

CREATE TABLE `data_umum_kepegawaian` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jenis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `golongan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `pangkat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `google_sync_status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `google_synced_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=17
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   DATA: data_umum_kepegawaian
   ========================================================= */

INSERT INTO `data_umum_kepegawaian`
(
  `id`,
  `jenis`,
  `nomor`,
  `nama`,
  `golongan`,
  `pangkat`,
  `jabatan`,
  `keterangan`,
  `google_sync_status`,
  `google_synced_at`,
  `created_at`,
  `updated_at`
)
VALUES
(
  2,
  'ASN',
  '19780512 200501 1 001',
  'Ahmad Hidayat',
  'III/d',
  'Pembina Tk. I',
  'Lurah',
  NULL,
  'pending',
  NULL,
  '2026-09-15 14:48:56',
  '2026-09-15 14:48:56'
),
(
  3,
  'ASN',
  '19820415 200701 2 002',
  'Siti Rahmawati',
  'III/c',
  'Penata',
  'Sekretaris Kelurahan',
  NULL,
  'pending',
  NULL,
  '2026-09-15 14:48:56',
  '2026-09-15 14:48:56'
),
(
  4,
  'ASN',
  '19870622 201001 1 003',
  'Budi Santoso',
  'III/b',
  'Penata Muda Tk. I',
  'Kasi Pemerintahan',
  NULL,
  'pending',
  NULL,
  '2026-09-15 14:48:56',
  '2026-09-15 14:48:56'
),
(
  5,
  'ASN',
  '19900318 201502 2 004',
  'Dewi Lestari',
  'III/a',
  'Penata Muda',
  'Kasi Pelayanan',
  NULL,
  'pending',
  NULL,
  '2026-09-15 14:48:56',
  '2026-09-15 14:48:56'
),
(
  6,
  'PPPK',
  '19940527 202301 1 005',
  'Rudi Hermawan',
  'IX',
  'Ahli Pertama',
  'Staf Pelayanan',
  NULL,
  'pending',
  NULL,
  '2026-09-15 14:48:56',
  '2026-09-15 14:48:56'
),
(
  7,
  'ASN',
  '3212233332',
  'Manarul Huda',
  'IV/b',
  'Penata Komputer',
  'Kepala Divisi Teknik',
  'Pegawai Spesialis Komputer',
  'pending',
  NULL,
  '2026-09-15 14:52:36',
  '2026-09-15 14:52:36'
),
(
  8,
  'ASN',
  '2322122222',
  'Elsa Tania Putri',
  'IV/c',
  'Penata Administrasi',
  'Kepala Kasi',
  'Admin Spesialis',
  'failed',
  NULL,
  '2026-09-15 15:22:49',
  '2026-09-15 15:22:56'
),
(
  9,
  'ASN',
  '3212131233',
  'Hudasan',
  'IV/c',
  'Penata Komputer',
  'Spesialis Teknisi',
  'Pegawai Baru 2026',
  'failed',
  NULL,
  '2026-09-15 15:48:45',
  '2026-09-15 15:48:45'
),
(
  10,
  'ASN',
  '32132123123',
  'Huda Manarul',
  'IV/a',
  'Penata Komputer',
  'Spesialis Jaringan',
  'Pegawai baru 2026',
  'failed',
  NULL,
  '2026-09-15 15:54:26',
  '2026-09-15 15:54:26'
),
(
  11,
  'ASN',
  '3212333333',
  'Hagi Zhafira',
  'IV/b',
  'Dokter Desa',
  'Kepala Dokter',
  'Dokter baru 2026',
  'failed',
  NULL,
  '2026-09-15 16:05:03',
  '2026-09-15 16:05:03'
),
(
  12,
  'ASN',
  '321232323',
  'Elsa Tania',
  'IV/c',
  'Penata Administrasi',
  'Kabag Umum',
  'Pegawai 2026',
  'synced',
  '2026-09-15 16:46:41',
  '2026-09-15 16:46:37',
  '2026-09-15 16:46:41'
),
(
  15,
  'PPPK',
  '33333333333',
  'Arif Munirrrrrr',
  'IV/d',
  'Kepala Kepemudaan',
  'Kepala Linmas Senior',
  'Pegawai 2026',
  'synced',
  '2026-09-17 01:00:04',
  '2026-09-15 17:01:24',
  '2026-09-17 01:00:04'
);


/* =========================================================
   TABLE: failed_jobs
   ========================================================= */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index`
    (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   TABLE: job_batches
   ========================================================= */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_general_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   TABLE: jobs
   ========================================================= */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   TABLE: migrations
   ========================================================= */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=11
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   DATA: migrations
   ========================================================= */

INSERT INTO `migrations`
(
  `id`,
  `migration`,
  `batch`
)
VALUES
(
  1,
  '0001_01_01_000000_create_users_table',
  1
),
(
  2,
  '0001_01_01_000001_create_cache_table',
  1
),
(
  3,
  '0001_01_01_000002_create_jobs_table',
  1
),
(
  4,
  '2026_09_14_151423_create_data_umum_kepegawaian_table',
  2
),
(
  5,
  '2026_09_15_145738_add_google_sync_columns_to_data_umum_kepegawaian_table',
  3
),
(
  6,
  '2026_09_16_203859_create_data_bmd_table',
  4
),
(
  7,
  '2026_09_16_205516_add_id_data_to_data_bmd_table',
  5
),
(
  8,
  '2026_09_16_205858_create_data_bmd_table',
  6
),
(
  9,
  '2026_09_16_211312_create_data_bmd_table',
  7
),
(
  10,
  '2026_09_16_222406_create_data_posyandu_table',
  8
);


/* =========================================================
   TABLE: password_reset_tokens
   ========================================================= */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   TABLE: sessions
   ========================================================= */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   TABLE: users
   ========================================================= */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB
AUTO_INCREMENT=4
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   DATA: users
   ========================================================= */

INSERT INTO `users`
(
  `id`,
  `name`,
  `email`,
  `email_verified_at`,
  `password`,
  `remember_token`,
  `created_at`,
  `updated_at`
)
VALUES
(
  1,
  'Admin Kelurahan',
  'admin@kelurahan.test',
  NULL,
  '$2y$12$ExP43i3zUItqexzkYtVYxO.Lj9cQZAuIsRFrgdNs3vzdKvsYNsTAC',
  'oZYvboOrC7u6vHa6wiKm9s4A53EC4tWTjKU2U0NPxj6jmzjMpYUKdSEBcXk7',
  '2026-09-14 14:46:33',
  '2026-09-14 14:46:33'
),
(
  2,
  'Test User',
  'test@example.com',
  '2026-09-15 14:48:09',
  '$2y$12$TsOr38gTy9f14DjLsy4Qx.WGM1T1Xr0b/d1HB10gYvSu5GuFl.XIa',
  'hHJXmf33nY',
  '2026-09-15 14:48:09',
  '2026-09-15 14:48:09'
);


/* =========================================================
   RESTORE MYSQL SETTINGS
   ========================================================= */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
