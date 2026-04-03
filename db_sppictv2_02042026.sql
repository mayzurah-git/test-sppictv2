-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_sppict
CREATE DATABASE IF NOT EXISTS `db_sppict` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_sppict`;

-- Dumping structure for table db_sppict.agencies
DROP TABLE IF EXISTS `agencies`;
CREATE TABLE IF NOT EXISTS `agencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `agency_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `agencies_agency_code_unique` (`agency_code`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.agencies: ~40 rows (approximately)
INSERT INTO `agencies` (`id`, `agency_name`, `agency_code`, `created_at`, `updated_at`) VALUES
	(42, 'Jabatan Hal Ehwal Agama Islam Negeri Sembilan', 'JHEAINS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(43, 'Jabatan Kerja Raya Negeri Sembilan', 'JKRNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(44, 'Jabatan Kehakiman Syariah Negeri Sembilan', 'JKSNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(45, 'Jabatan Pengairan dan Saliran Negeri Sembilan', 'JPS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(46, 'Jabatan Pendakwaan Syariah Negeri Sembilan', 'JPeNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(47, 'Jabatan Mufti Kerajaan Negeri Sembilan', 'MuftiNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(48, 'PLANMalaysia@Negeri Sembilan', 'PLANNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(49, 'Jabatan Perhutanan Negeri Sembilan', 'HutanNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(50, 'Jabatan Perkhidmatan Veterinar Negeri Sembilan', 'VeterinarNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(51, 'Jabatan Pertanian Negeri Sembilan', 'PertanianNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(52, 'Lembaga Muzium Negeri Sembilan', 'LMNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(53, 'Lembaga Pelancongan Negeri Sembilan', 'LPNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(54, 'Majlis Agama Negeri Sembilan', 'MAINS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(55, 'Majlis Bandaraya Seremban', 'MBS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(56, 'Majlis Daerah Jelebu', 'MDJ', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(57, 'Majlis Daerah Rembau', 'MDR', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(58, 'Majlis Daerah Kuala Pilah', 'MDKP', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(59, 'Majlis Daerah Tampin', 'MDT', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(60, 'Majlis Perbandaran Jempol', 'MPJ', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(61, 'Majlis Perbandaran Port Dickson', 'MPPD', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(62, 'Pejabat Daerah dan Tanah Jelebu', 'PDTJel', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(63, 'Pejabat Daerah dan Tanah Jempol', 'PDTJ', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(64, 'Pejabat Daerah dan Tanah Kuala Pilah', 'PDTKP', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(65, 'Pejabat Daerah dan Tanah Rembau', 'PDTR', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(66, 'Pejabat Daerah dan Tanah Tampin', 'PDTT', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(67, 'Pejabat Daerah dan Tanah Port Dickson', 'PDTPD', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(68, 'Pejabat Daerah dan Tanah Seremban', 'PDTS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(69, 'Pejabat Daerah Kecil dan Tanah Gemas', 'PDTKG', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(70, 'Pejabat Kewangan Negeri', 'PKN', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(71, 'Pejabat Menteri Besar Negeri Sembilan', 'PMBNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(72, 'Pejabat Tanah dan Galian Negeri Sembilan', 'PTGNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(73, 'Perbadanan Kemajuan Negeri Sembilan', 'PKNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(74, 'Bahagian Dewan Undangan Negeri Sembilan', 'BDUN', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(75, 'Unit Pengurusan Bangunan dan Aset', 'UPBA', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(76, 'Unit Perancang Ekonomi Negeri', 'UPEN', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(77, 'Yayasan Negeri Sembilan', 'YNS', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(78, 'Badan Kawal Selia Air', 'BKSA', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(79, 'Bahagian Khidmat Pengurusan', 'BKP', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(80, 'Bahagian Perumahan', 'BHP', '2026-02-15 18:38:10', '2026-02-15 18:38:10'),
	(81, 'Bahagian Teknologi Maklumat', 'BTM', '2026-02-15 18:38:10', '2026-02-15 18:38:10');

-- Dumping structure for table db_sppict.audit_logs
DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint unsigned NOT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_logs_user_id_foreign` (`user_id`),
  KEY `audit_logs_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.audit_logs: ~26 rows (approximately)
INSERT INTO `audit_logs` (`id`, `user_id`, `event`, `auditable_type`, `auditable_id`, `old_values`, `new_values`, `url`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
	(1, 8, 'created', 'App\\Models\\ProjectDetail', 6, NULL, '{"id": 6, "quantity": "1", "unit_cost": "10000", "created_at": "2026-03-09T07:43:42.000000Z", "project_id": 9, "total_cost": 10000, "updated_at": "2026-03-09T07:43:42.000000Z", "project_category": "Penyelenggaraan", "technical_specification": "<ol><li>speks A</li><li>speks B</li><li>speks C</li></ol>"}', 'http://test-sppictv2.test/projects/9/details', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-08 23:43:42', '2026-03-08 23:43:42'),
	(2, 8, 'deleted', 'App\\Models\\ProjectDetail', 6, '{"id": 6, "quantity": 1, "unit_cost": "10000.00", "created_at": "2026-03-09T07:43:42.000000Z", "project_id": 9, "total_cost": "10000.00", "updated_at": "2026-03-09T07:43:42.000000Z", "project_category": "Penyelenggaraan", "technical_specification": "<ol><li>speks A</li><li>speks B</li><li>speks C</li></ol>"}', NULL, 'http://test-sppictv2.test/projects/9/details/6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-08 23:43:59', '2026-03-08 23:43:59'),
	(3, 8, 'updated', 'App\\Models\\Project', 2, '{"scope": "<div>skop 1<br>skop 2<br>skop 3</div>", "objective": "<div>obj a<br>obj b<br>obj c</div>", "updated_at": "2026-03-09T08:04:49.000000Z", "funding_source": "bajet mengurus", "approval_reference": "Surat Kelulusan : BTM-100/1/210", "implementation_period": "20 bulan"}', '{"scope": "<div>skop 1<br>skop 2<br>skop 3</div>", "objective": "<div>obj a<br>obj b<br>obj c</div>", "updated_at": "2026-03-09 08:04:49", "funding_source": "bajet mengurus", "approval_reference": "Surat Kelulusan : BTM-100/1/210", "implementation_period": "20 bulan"}', 'http://test-sppictv2.test/projects/2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-09 00:04:49', '2026-03-09 00:04:49'),
	(4, 8, 'created', 'App\\Models\\ProjectDetail', 7, NULL, '{"id": 7, "quantity": "1", "unit_cost": "100000", "created_at": "2026-03-09T08:05:23.000000Z", "project_id": 2, "total_cost": 100000, "updated_at": "2026-03-09T08:05:23.000000Z", "project_category": "Peningkatan Sistem", "technical_specification": "<div>speks 1<br>speks 2<br>speks 3</div>"}', 'http://test-sppictv2.test/projects/2/details', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-09 00:05:23', '2026-03-09 00:05:23'),
	(5, 8, 'updated', 'App\\Models\\ProjectDetail', 4, '{"total_cost": 45000, "updated_at": "2026-03-10T05:40:44.000000Z", "technical_specification": "<div>teknikal 4<br>teknikal 5</div>"}', '{"total_cost": 45000, "updated_at": "2026-03-10 05:40:44", "technical_specification": "<div>teknikal 4<br>teknikal 5</div>"}', 'http://test-sppictv2.test/projects/9/details/4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-09 21:40:44', '2026-03-09 21:40:44'),
	(6, 8, 'officer_updated', 'App\\Models\\Project', 9, '{"updated_at": "2026-03-10T06:26:56.000000Z", "officer_name": "Test Pengguna", "officer_email": "pengguna@test.com", "officer_phone": "0121111111", "officer_position": "Pegawai Teknologi Maklumat"}', '{"updated_at": "2026-03-10 06:26:56", "officer_name": "Test Pengguna", "officer_email": "pengguna@test.com", "officer_phone": "0121111111", "officer_position": "Pegawai Teknologi Maklumat"}', 'http://test-sppictv2.test/projects/9/officer', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-09 22:26:56', '2026-03-09 22:26:56'),
	(7, 8, 'officer_updated', 'App\\Models\\Project', 9, '{"updated_at": "2026-03-10T06:27:29.000000Z", "application_status": "Baru"}', '{"updated_at": "2026-03-10 06:27:29", "application_status": "Baru"}', 'http://test-sppictv2.test/projects/9/officer', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-03-09 22:27:29', '2026-03-09 22:27:29'),
	(8, 8, 'updated', 'App\\Models\\Project', 2, '{"scope": "<ul><li>skop 1</li><li>skop 2</li><li>skop 3</li></ul>", "objective": "<ul><li>obj a</li><li>obj b</li><li>obj c</li></ul>", "updated_at": "2026-03-11T02:01:09.000000Z"}', '{"scope": "<ul><li>skop 1</li><li>skop 2</li><li>skop 3</li></ul>", "objective": "<ul><li>obj a</li><li>obj b</li><li>obj c</li></ul>", "updated_at": "2026-03-11 02:01:09"}', 'http://test-sppictv2.test/projects/2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-10 18:01:09', '2026-03-10 18:01:09'),
	(9, 8, 'created', 'App\\Models\\ProjectDetail', 8, NULL, '{"id": 8, "quantity": "1", "unit_cost": "25000", "created_at": "2026-03-11T02:01:51.000000Z", "project_id": 2, "total_cost": 25000, "updated_at": "2026-03-11T02:01:51.000000Z", "project_category": "Penambahbaikan Peralatan", "technical_specification": "<div>spesifikasi 1<br>spesifikasi 2</div>"}', 'http://test-sppictv2.test/projects/2/details', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-10 18:01:51', '2026-03-10 18:01:51'),
	(10, 8, 'updated', 'App\\Models\\ProjectDetail', 5, '{"quantity": "4", "total_cost": 48000, "updated_at": "2026-03-11T02:06:10.000000Z", "technical_specification": "<div>speks a speks b speks c</div>"}', '{"quantity": "4", "total_cost": 48000, "updated_at": "2026-03-11 02:06:10", "technical_specification": "<div>speks a speks b speks c</div>"}', 'http://test-sppictv2.test/projects/7/details/5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-10 18:06:10', '2026-03-10 18:06:10'),
	(11, 8, 'created', 'App\\Models\\ProjectDetail', 9, NULL, '{"id": 9, "quantity": "1", "unit_cost": "200000", "created_at": "2026-03-11T02:06:52.000000Z", "project_id": 7, "total_cost": 200000, "updated_at": "2026-03-11T02:06:52.000000Z", "project_category": "Peluasan Sistem / Projek", "technical_specification": "<div>test spesifikasi<br>test spesifikasi</div>"}', 'http://test-sppictv2.test/projects/7/details', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-10 18:06:52', '2026-03-10 18:06:52'),
	(12, 8, 'created', 'App\\Models\\ProjectDetail', 10, NULL, '{"id": 10, "quantity": "1", "unit_cost": "2000", "created_at": "2026-03-11T02:07:21.000000Z", "project_id": 7, "total_cost": 2000, "updated_at": "2026-03-11T02:07:21.000000Z", "project_category": "Khidmat Perunding ICT", "technical_specification": "<div>test lagi</div>"}', 'http://test-sppictv2.test/projects/7/details', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-10 18:07:21', '2026-03-10 18:07:21'),
	(13, 8, 'officer_updated', 'App\\Models\\Project', 7, '{"updated_at": "2026-03-11T02:08:04.000000Z", "officer_name": "Test Pengguna", "officer_email": "pengguna@test.com", "officer_phone": "0121111111", "officer_position": "Pegawai Teknologi Maklumat"}', '{"updated_at": "2026-03-11 02:08:04", "officer_name": "Test Pengguna", "officer_email": "pengguna@test.com", "officer_phone": "0121111111", "officer_position": "Pegawai Teknologi Maklumat"}', 'http://test-sppictv2.test/projects/7/officer', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-10 18:08:04', '2026-03-10 18:08:04'),
	(14, 8, 'officer_updated', 'App\\Models\\Project', 7, '{"updated_at": "2026-03-11T02:08:12.000000Z", "application_status": "Hantar - Tunggu Semakan Urus Setia"}', '{"updated_at": "2026-03-11 02:08:12", "application_status": "Hantar - Tunggu Semakan Urus Setia"}', 'http://test-sppictv2.test/projects/7/officer', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-10 18:08:12', '2026-03-10 18:08:12'),
	(15, 8, 'officer_updated', 'App\\Models\\Project', 9, '{"updated_at": "2026-03-11T03:10:49.000000Z", "application_status": "Hantar - Tunggu Semakan Urus Setia"}', '{"updated_at": "2026-03-11 03:10:49", "application_status": "Hantar - Tunggu Semakan Urus Setia"}', 'http://test-sppictv2.test/projects/9/officer', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-10 19:10:49', '2026-03-10 19:10:49'),
	(16, 6, 'deleted', 'App\\Models\\Project', 6, '{"id": 6, "scope": "skop 1\\r\\nskop 2\\r\\nskop 3", "status": "Perancangan", "end_date": null, "agency_id": 42, "objective": "obj 1\\r\\nobj 2\\r\\nobj 3", "created_at": "2026-02-23T06:51:17.000000Z", "created_by": 8, "start_date": null, "updated_at": "2026-02-23T06:51:17.000000Z", "description": null, "officer_name": null, "project_code": "JHEAINS/2026/004", "officer_email": null, "officer_phone": null, "project_title": "test lagi", "proposal_file": null, "funding_source": "bajet mengurus", "officer_position": null, "urusetia_remarks": null, "presentation_file": null, "application_status": "Draf", "approval_reference": "Surat Kelulusan : JHEAINS-100/1/200", "implementation_period": "12 bulan", "estimated_department_cost": "150000.00"}', NULL, 'http://test-sppictv2.test/projects/6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-10 20:36:13', '2026-03-10 20:36:13'),
	(17, 6, 'deleted', 'App\\Models\\Project', 3, '{"id": 3, "scope": "skop 1\\r\\nskop 2", "status": "Perancangan", "end_date": null, "agency_id": 42, "objective": "1. objektif \\r\\n2. objektif", "created_at": "2026-02-23T06:39:56.000000Z", "created_by": 8, "start_date": null, "updated_at": "2026-02-23T06:39:56.000000Z", "description": null, "officer_name": null, "project_code": "JHEAINS/2026/001", "officer_email": null, "officer_phone": null, "project_title": "test lagi", "proposal_file": null, "funding_source": "bajet mengurus", "officer_position": null, "urusetia_remarks": null, "presentation_file": null, "application_status": "Draf", "approval_reference": "Surat Kelulusan : JHEAINS-100/1/200", "implementation_period": "12 bulan", "estimated_department_cost": "150000.00"}', NULL, 'http://test-sppictv2.test/projects/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-10 20:36:26', '2026-03-10 20:36:26'),
	(18, 6, 'deleted', 'App\\Models\\Project', 8, '{"id": 8, "scope": "skop 1\\r\\nskop 2\\r\\nskop 3", "status": "Perancangan", "end_date": null, "agency_id": 53, "objective": "obj 1\\r\\nobj 2\\r\\nobj 3", "created_at": "2026-02-23T07:54:55.000000Z", "created_by": 6, "start_date": null, "updated_at": "2026-02-23T07:54:55.000000Z", "description": null, "officer_name": null, "project_code": "LPNS/2026/001", "officer_email": null, "officer_phone": null, "project_title": "naik taraf portal pelancongan", "proposal_file": null, "funding_source": "bajet mengurus", "officer_position": null, "urusetia_remarks": null, "presentation_file": null, "application_status": "Draf", "approval_reference": "Surat Kelulusan : LPNS-100/1/001", "implementation_period": "6 bulan", "estimated_department_cost": "115000.00"}', NULL, 'http://test-sppictv2.test/projects/8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-10 20:36:35', '2026-03-10 20:36:35'),
	(19, 6, 'created', 'App\\Models\\Meeting', 1, NULL, '{"id": 1, "date": "2026-04-15T00:00:00.000000Z", "time": "09:30", "year": "2026", "title": "PRA-JTICTNS", "venue": "Bilik Mesyuarat BTM", "agenda": "<ol><li>Kata Alu-Aluan Pengerusi.</li><li>Pengesahan Minit Mesyuarat JTICTNS Bil. 5/2025.</li><li>Perkara-perkara Berbangkit.</li><li>Pembentangan</li><li>Hal-hal Lain.</li><li>Penangguhan Mesyuarat.</li></ol><div><br></div>", "status": "Aktif", "created_at": "2026-03-12T06:20:17.000000Z", "updated_at": "2026-03-12T06:20:17.000000Z", "minutes_file": "meetings/tPjUyXqwOmrRL7rFeEMbTquzJ7dhhIbUUkwXPvay.pdf", "meeting_number": "2", "project_update_deadline": "2026-04-10T00:00:00.000000Z"}', 'http://test-sppictv2.test/meetings', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-11 22:20:17', '2026-03-11 22:20:17'),
	(20, 6, 'updated', 'App\\Models\\Project', 2, '{"updated_at": "2026-03-31T07:13:53.000000Z", "project_title": "test 2"}', '{"updated_at": "2026-03-31 07:13:53", "project_title": "test 2"}', 'http://test-sppictv2.test/projects/2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-30 23:13:53', '2026-03-30 23:13:53'),
	(21, 6, 'officer_updated', 'App\\Models\\Project', 2, '{"updated_at": "2026-03-31T07:14:12.000000Z", "officer_name": "Test Urus Setia", "officer_email": "urusetia@test.com", "officer_phone": "0121111111", "officer_position": "Pegawai Teknologi Maklumat"}', '{"updated_at": "2026-03-31 07:14:12", "officer_name": "Test Urus Setia", "officer_email": "urusetia@test.com", "officer_phone": "0121111111", "officer_position": "Pegawai Teknologi Maklumat"}', 'http://test-sppictv2.test/projects/2/officer', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-30 23:14:12', '2026-03-30 23:14:12'),
	(22, 6, 'officer_updated', 'App\\Models\\Project', 2, '{"updated_at": "2026-03-31T07:14:26.000000Z", "application_status": "Hantar - Tunggu Semakan Urus Setia"}', '{"updated_at": "2026-03-31 07:14:26", "application_status": "Hantar - Tunggu Semakan Urus Setia"}', 'http://test-sppictv2.test/projects/2/officer', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-30 23:14:26', '2026-03-30 23:14:26'),
	(23, 6, 'created', 'App\\Models\\Meeting', 2, NULL, '{"id": 2, "date": "2026-04-14T00:00:00.000000Z", "time": "09:30", "year": "2026", "title": "JTICTNS", "venue": "Bilik Mesyuarat BTM", "agenda": "<ul><li>Kata Alu-Aluan Pengerusi.</li><li>Pengesahan Minit Mesyuarat JTICTNS Bil. 1/2026</li><li>Perkara-perkara Berbangkit.</li><li>Pembentangan</li><li>Hal-hal Lain.</li><li>Penangguhan Mesyuarat.</li></ul>", "status": "Aktif", "created_at": "2026-04-01T01:24:36.000000Z", "updated_at": "2026-04-01T01:24:36.000000Z", "minutes_file": "meetings/UaCsRahpFSlJUR0B6xRONGKEsmhonN4UhRJTmWvd.pdf", "meeting_number": "2", "project_update_deadline": "2026-04-03T00:00:00.000000Z"}', 'http://test-sppictv2.test/meetings', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-31 17:24:36', '2026-03-31 17:24:36'),
	(24, 6, 'created', 'App\\Models\\Meeting', 3, NULL, '{"id": 3, "date": "2026-04-14T00:00:00.000000Z", "time": "09:30", "year": "2026", "title": "JTICTNS", "venue": "Bilik Mesyuarat BTM", "agenda": "<ul><li>Kata Alu-Aluan Pengerusi.</li><li>Pengesahan Minit Mesyuarat JTICTNS Bil. 1/2026</li><li>Perkara-perkara Berbangkit.</li><li>Pembentangan</li><li>Hal-hal Lain.</li><li>Penangguhan Mesyuarat.</li></ul>", "status": "Aktif", "created_at": "2026-04-01T01:25:36.000000Z", "updated_at": "2026-04-01T01:25:36.000000Z", "minutes_file": "meetings/uYjviTqx4nwAkDpnTUsH2TR0w7J5vpCFxvRyMyFE.pdf", "meeting_number": "2", "project_update_deadline": "2026-04-03T00:00:00.000000Z"}', 'http://test-sppictv2.test/meetings', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-31 17:25:36', '2026-03-31 17:25:36'),
	(25, 6, 'created', 'App\\Models\\Meeting', 4, NULL, '{"id": 4, "date": "2026-04-07T00:00:00.000000Z", "time": "09:30", "year": "2026", "title": "PRA-JTICTNS", "venue": "Bilik Mesyuarat BTM", "agenda": "<div>Kata Alu-Aluan Pengerusi.<br>Pengesahan Minit Mesyuarat PRA JTICTNS Bil. 1/2026<br>Perkara-perkara Berbangkit.<br>Pembentangan<br>Hal-hal Lain.<br>Penangguhan Mesyuarat.</div>", "status": "Aktif", "created_at": "2026-04-01T02:00:23.000000Z", "updated_at": "2026-04-01T02:00:23.000000Z", "meeting_number": "2", "project_update_deadline": "2026-04-03T00:00:00.000000Z"}', 'http://test-sppictv2.test/meetings', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-31 18:00:23', '2026-03-31 18:00:23'),
	(26, 6, 'created', 'App\\Models\\Meeting', 5, NULL, '{"id": 5, "date": "2026-04-07T00:00:00.000000Z", "time": "09:30", "year": "2026", "title": "PRA-JTICTNS", "venue": "Bilik Mesyuarat BTM", "agenda": "<div>Kata Alu-Aluan Pengerusi.<br>Pengesahan Minit Mesyuarat PRA JTICTNS Bil. 1/2026<br>Perkara-perkara Berbangkit.<br>Pembentangan<br>Hal-hal Lain.<br>Penangguhan Mesyuarat.</div>", "status": "Aktif", "created_at": "2026-04-01T02:01:37.000000Z", "updated_at": "2026-04-01T02:01:37.000000Z", "meeting_number": "2", "project_update_deadline": "2026-04-03T00:00:00.000000Z"}', 'http://test-sppictv2.test/meetings', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-31 18:01:37', '2026-03-31 18:01:37'),
	(27, 6, 'status_updated', 'App\\Models\\Project', 9, '{"application_status": "Lengkap"}', '{"application_status": "Lengkap"}', 'http://test-sppictv2.test/projects/9/status', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-04-01 20:22:30', '2026-04-01 20:22:30'),
	(28, 6, 'status_updated', 'App\\Models\\Project', 9, '{"urusetia_remarks": "Kertas cadangan dan slide projek adalah lengkap"}', '{"urusetia_remarks": "Kertas cadangan dan slide projek adalah lengkap"}', 'http://test-sppictv2.test/projects/9/status', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-04-01 22:13:07', '2026-04-01 22:13:07');

-- Dumping structure for table db_sppict.cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.cache: ~0 rows (approximately)

-- Dumping structure for table db_sppict.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.cache_locks: ~0 rows (approximately)

-- Dumping structure for table db_sppict.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table db_sppict.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.jobs: ~0 rows (approximately)

-- Dumping structure for table db_sppict.job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.job_batches: ~0 rows (approximately)

-- Dumping structure for table db_sppict.meetings
DROP TABLE IF EXISTS `meetings`;
CREATE TABLE IF NOT EXISTS `meetings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` enum('PRA-JTICTNS','JTICTNS','JPICTNS') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_number` enum('1','2','3','4','5','6') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak Aktif',
  `project_update_deadline` date NOT NULL,
  `minutes_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agenda` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.meetings: ~2 rows (approximately)
INSERT INTO `meetings` (`id`, `title`, `meeting_number`, `year`, `date`, `time`, `venue`, `status`, `project_update_deadline`, `minutes_file`, `agenda`, `created_at`, `updated_at`) VALUES
	(3, 'JTICTNS', '2', '2026', '2026-04-14', '09:30:00', 'Bilik Mesyuarat BTM', 'Aktif', '2026-04-03', 'meetings/uYjviTqx4nwAkDpnTUsH2TR0w7J5vpCFxvRyMyFE.pdf', '<ul><li>Kata Alu-Aluan Pengerusi.</li><li>Pengesahan Minit Mesyuarat JTICTNS Bil. 1/2026</li><li>Perkara-perkara Berbangkit.</li><li>Pembentangan</li><li>Hal-hal Lain.</li><li>Penangguhan Mesyuarat.</li></ul>', '2026-03-31 17:25:36', '2026-03-31 17:25:36'),
	(5, 'PRA-JTICTNS', '2', '2026', '2026-04-07', '09:30:00', 'Bilik Mesyuarat BTM', 'Aktif', '2026-04-03', NULL, '<div>Kata Alu-Aluan Pengerusi.<br>Pengesahan Minit Mesyuarat PRA JTICTNS Bil. 1/2026<br>Perkara-perkara Berbangkit.<br>Pembentangan<br>Hal-hal Lain.<br>Penangguhan Mesyuarat.</div>', '2026-03-31 18:01:37', '2026-03-31 18:01:37');

-- Dumping structure for table db_sppict.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.migrations: ~17 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_02_12_080828_create_roles_table', 2),
	(5, '2026_02_12_083632_create_agencies_table', 3),
	(6, '2026_02_16_024118_add_role_and_agency_to_users_table', 4),
	(7, '2026_02_20_034145_create_projects_table', 5),
	(8, '2026_02_20_034616_modify_project_cost_column_in_projects_table', 6),
	(9, '2024_05_23_100000_add_project_category_to_projects_table', 7),
	(10, '2024_05_24_100000_drop_project_category_from_projects_table', 8),
	(11, '2026_02_23_061734_add_phase1_fields_to_projects_table', 9),
	(12, '2026_02_23_082355_create_project_details_table', 10),
	(13, '2026_02_24_060945_add_documents_to_projects_table', 11),
	(14, '2023_10_27_000000_create_audit_logs_table', 12),
	(15, '2026_03_10_000000_add_officer_contact_to_projects_table', 13),
	(16, '2026_03_11_034617_add_urusetia_remarks_to_projects_table', 14),
	(17, '2024_03_28_000001_create_meetings_table', 15),
	(18, '2026_03_12_000000_create_positions_table', 16),
	(19, '2026_04_02_031155_add_meeting_id_to_projects_table', 17);

-- Dumping structure for table db_sppict.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table db_sppict.positions
DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `position_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.positions: ~34 rows (approximately)
INSERT INTO `positions` (`id`, `position_name`, `created_at`, `updated_at`) VALUES
	(1, 'Akauntan', '2026-03-30 20:55:11', '2026-03-30 20:55:11'),
	(2, 'Juruteknik Komputer', '2026-03-30 20:55:11', '2026-03-30 20:55:11'),
	(3, 'Jurutera (Awam)', '2026-03-30 20:55:11', '2026-03-30 20:55:11'),
	(4, 'Ketua Pembantu Tadbir', '2026-03-30 20:55:11', '2026-03-30 20:55:11'),
	(5, 'Pegawai Belia dan Sukan', '2026-03-30 20:55:11', '2026-03-30 20:55:11'),
	(6, 'Pegawai Khas', '2026-03-30 20:55:11', '2026-03-30 20:55:11'),
	(7, 'Pegawai Khidmat Pelanggan', '2026-03-30 20:55:11', '2026-03-30 20:55:11'),
	(8, 'Pegawai Perancang Bandar dan Desa', '2026-03-30 20:55:11', '2026-03-30 20:55:11'),
	(9, 'Pegawai Pertanian', '2026-03-30 20:55:11', '2026-03-30 20:55:11'),
	(10, 'Pegawai Psikologi', '2026-03-30 20:55:11', '2026-03-30 20:55:11'),
	(11, 'Pegawai Syariah', '2026-03-30 20:55:11', '2026-03-30 20:55:11'),
	(12, 'Pegawai Tadbir', '2026-03-30 20:55:11', '2026-03-30 20:55:11'),
	(13, 'Pegawai Tadbir dan Diplomatik', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(14, 'Pegawai Teknologi Maklumat', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(15, 'Pegawai Tugas-tugas Khas', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(16, 'Pegawai Veterinar', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(17, 'Pelukis Pelan', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(18, 'Penolong Akauntan', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(19, 'Penolong Bendahari Negeri', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(20, 'Penolong Jurutera', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(21, 'Penolong Kurator', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(22, 'Penolong Pegawai Belia dan Sukan', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(23, 'Penolong Pegawai Hal Ehwal Islam', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(24, 'Penolong Pegawai Perancang Bandar dan Desa', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(25, 'Penolong Pegawai Pertanian', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(26, 'Penolong Pegawai Psikologi', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(27, 'Penolong Pegawai Tadbir', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(28, 'Penolong Pegawai Tanah', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(29, 'Penolong Pegawai Teknologi Maklumat', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(30, 'Penolong Pegawai Veterinar', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(31, 'Penolong Pemelihara Hutan', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(32, 'Renjer Hutan', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(33, 'Setiausaha Pejabat', '2026-03-30 20:55:12', '2026-03-30 20:55:12'),
	(34, 'Timbalan Bendahari Negeri', '2026-03-30 20:55:12', '2026-03-30 20:55:12');

-- Dumping structure for table db_sppict.projects
DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `estimated_department_cost` decimal(15,2) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `agency_id` bigint unsigned NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `officer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `officer_position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `officer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `officer_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Perancangan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `objective` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `scope` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `implementation_period` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funding_source` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Draf',
  `urusetia_remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `proposal_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentation_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projects_project_code_unique` (`project_code`),
  KEY `projects_agency_id_foreign` (`agency_id`),
  KEY `projects_created_by_foreign` (`created_by`),
  KEY `projects_meeting_id_foreign` (`meeting_id`),
  CONSTRAINT `projects_agency_id_foreign` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `projects_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `projects_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.projects: ~5 rows (approximately)
INSERT INTO `projects` (`id`, `project_title`, `project_code`, `description`, `estimated_department_cost`, `start_date`, `end_date`, `agency_id`, `created_by`, `officer_name`, `officer_position`, `officer_email`, `officer_phone`, `status`, `created_at`, `updated_at`, `objective`, `scope`, `implementation_period`, `funding_source`, `approval_reference`, `application_status`, `urusetia_remarks`, `proposal_file`, `presentation_file`, `meeting_id`) VALUES
	(2, 'test 2', 'BTM/2026/001', NULL, 125000.00, NULL, NULL, 81, 6, 'Test Urus Setia', 'Pegawai Teknologi Maklumat', 'urusetia@test.com', '0121111111', 'Perancangan', '2026-02-22 18:15:55', '2026-03-30 23:14:26', '<ul><li>obj a</li><li>obj b</li><li>obj c</li></ul>', '<ul><li>skop 1</li><li>skop 2</li><li>skop 3</li></ul>', '20 bulan', 'bajet mengurus', 'Surat Kelulusan : BTM-100/1/210', 'Hantar - Tunggu Semakan Urus Setia', NULL, 'documents/2/kBWtw7JK4iYdDm2yMyrqtXwNBR14GoHVcvHg2hlr.pdf', 'documents/2/xsb64OxzUN41q0LiLR1DYgspXuZwQiOBeuA1GUfC.pdf', NULL),
	(4, 'test lagi', 'JHEAINS/2026/002', NULL, 150000.00, NULL, NULL, 42, 8, NULL, NULL, NULL, NULL, 'Perancangan', '2026-02-22 22:41:42', '2026-02-22 22:41:42', 'obj 1\r\nobj 2\r\nobj 3', 'skop 1\r\nskop 2\r\nskop 3', '12 bulan', 'bajet mengurus', 'Surat Kelulusan : JHEAINS-100/1/200', 'Draf', NULL, NULL, NULL, NULL),
	(5, 'test lagi', 'JHEAINS/2026/003', NULL, 150000.00, NULL, NULL, 42, 8, NULL, NULL, NULL, NULL, 'Perancangan', '2026-02-22 22:44:27', '2026-02-22 22:44:27', 'obj 1\r\nobj 2\r\nobj 3', 'skop 1\r\nskop 2\r\nskop 3', '12 bulan', 'bajet mengurus', 'Surat Kelulusan : JHEAINS-100/1/200', 'Draf', NULL, NULL, NULL, NULL),
	(7, 'test BTM', 'BTM/2026/002', NULL, 250000.00, NULL, NULL, 81, 8, 'Test Pengguna', 'Pegawai Teknologi Maklumat', 'pengguna@test.com', '0121111111', 'Perancangan', '2026-02-22 23:48:31', '2026-03-10 18:08:12', 'obj 1\r\nobj 2\r\nobj 3', 'skop 1\r\nskop 2\r\nskop 3', '12 bulan', 'bajet mengurus', 'Surat Kelulusan : BTM-100/1/200', 'Hantar - Tunggu Semakan Urus Setia', NULL, 'documents/7/Nwx9NNXscBieEWXhIPC19R9hox9TvmVJIM89LV9t.pdf', 'documents/7/mgDOZAYUWeljHKmc8bIowLpkF6CB0oREKMjSHu1c.pdf', NULL),
	(9, 'cubaan', 'BTM/2026/003', NULL, 545000.00, NULL, NULL, 81, 8, 'Test Pengguna', 'Pegawai Teknologi Maklumat', 'pengguna@test.com', '0121111111', 'Perancangan', '2026-02-23 17:21:31', '2026-04-01 22:13:07', '<ul><li>objektif 1</li><li>objektif 2</li><li>objektif 3</li></ul>', '<div>skop 1 skop 2 skop 3</div>', '24 bulan', 'bajet mengurus', 'Surat Kelulusan : BTM-100/1/202', 'Lengkap', 'Kertas cadangan dan slide projek adalah lengkap', 'documents/9/12dj1DYbsud6wr5pMrP3addwQSOTZV8WKSv4FpNH.pdf', 'documents/9/urgYDTfZqPbH0H50qlBR2Zba0hmpnBaPngA2dne0.pdf', NULL);

-- Dumping structure for table db_sppict.project_details
DROP TABLE IF EXISTS `project_details`;
CREATE TABLE IF NOT EXISTS `project_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `project_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `technical_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `unit_cost` decimal(15,2) NOT NULL,
  `total_cost` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_details_project_id_foreign` (`project_id`),
  CONSTRAINT `project_details_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.project_details: ~8 rows (approximately)
INSERT INTO `project_details` (`id`, `project_id`, `project_category`, `technical_specification`, `quantity`, `unit_cost`, `total_cost`, `created_at`, `updated_at`) VALUES
	(1, 9, 'Penambahbaikan Peralatan', 'teknikal 1', 20, 15000.00, 300000.00, '2026-02-23 19:00:27', '2026-02-23 20:37:47'),
	(2, 9, 'Peningkatan Sistem', 'teknikal 1\r\nteknikal 2', 1, 200000.00, 200000.00, '2026-02-23 20:38:49', '2026-02-23 20:38:49'),
	(4, 9, 'Khidmat Perunding ICT', '<div>teknikal 4<br>teknikal 5</div>', 1, 45000.00, 45000.00, '2026-02-23 21:01:42', '2026-03-09 21:40:44'),
	(5, 7, 'Penambahbaikan Peralatan', '<div>speks a speks b speks c</div>', 4, 12000.00, 48000.00, '2026-03-04 22:23:51', '2026-03-10 18:06:10'),
	(7, 2, 'Peningkatan Sistem', '<div>speks 1<br>speks 2<br>speks 3</div>', 1, 100000.00, 100000.00, '2026-03-09 00:05:23', '2026-03-09 00:05:23'),
	(8, 2, 'Penambahbaikan Peralatan', '<div>spesifikasi 1<br>spesifikasi 2</div>', 1, 25000.00, 25000.00, '2026-03-10 18:01:51', '2026-03-10 18:01:51'),
	(9, 7, 'Peluasan Sistem / Projek', '<div>test spesifikasi<br>test spesifikasi</div>', 1, 200000.00, 200000.00, '2026-03-10 18:06:52', '2026-03-10 18:06:52'),
	(10, 7, 'Khidmat Perunding ICT', '<div>test lagi</div>', 1, 2000.00, 2000.00, '2026-03-10 18:07:21', '2026-03-10 18:07:21');

-- Dumping structure for table db_sppict.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.roles: ~4 rows (approximately)
INSERT INTO `roles` (`id`, `role_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Pengguna Biasa', 'Pemohon projek ICT dari jabatan atau agensi', '2026-02-12 00:22:30', '2026-02-12 00:22:30'),
	(2, 'Urus Setia', 'Urus setia / pentadbir sistem', '2026-02-12 00:22:30', '2026-02-12 00:22:30'),
	(3, 'Pengurusan', 'Ahli Jawatankuasa Pra JTICT / JTICT / JPICT', '2026-02-12 00:22:30', '2026-02-12 00:22:30'),
	(4, 'Superadmin', 'Pembangun dan pentadbir tertinggi sistem', '2026-02-12 00:22:30', '2026-02-12 00:22:30');

-- Dumping structure for table db_sppict.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('uXQFJPnNPVJGnGA8zkXJd9DvUh5zBf6rnf3Nmzau', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTjlDaE1QaVFOdEdXTU1OU3JmNzFrZHBYaHh0bFR1bEN0aWRqMU1ZTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly90ZXN0LXNwcGljdHYyLnRlc3QvcHJvamVjdHMvNy9wcmludCI7czo1OiJyb3V0ZSI7czoxNDoicHJvamVjdHMucHJpbnQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo4O30=', 1775118146);

-- Dumping structure for table db_sppict.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `agency_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_agency_id_foreign` (`agency_id`),
  CONSTRAINT `users_agency_id_foreign` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sppict.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `agency_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(3, 1, 81, 'Test Pengguna', 'test@demo.com', NULL, '$2y$12$MEEaWxcHrC/SZ6UJWuf6ju21eh2/PTfWUx9ICXTeBeTmM7dqqy0uO', NULL, '2026-02-15 20:46:49', '2026-02-15 20:46:49'),
	(5, 4, 81, 'Test Superadmin', 'superadmin@test.com', NULL, '$2y$12$gdnwO/.q6vy9ttgQ5bMNzuch7TYTwhoE2l1daORTzTs1vl9X/WIvS', NULL, '2026-02-16 00:33:27', '2026-02-16 00:33:27'),
	(6, 2, 81, 'Test Urus Setia', 'urusetia@test.com', NULL, '$2y$12$Em2WTT2RIAOHc5BrCtymG.QpXJKtDeAPlzGJiPf2y3lOlvFdROnpS', NULL, '2026-02-16 00:35:42', '2026-02-16 00:35:42'),
	(7, 3, 81, 'Test Pengurusan', 'pengurusan@test.com', NULL, '$2y$12$RkU42W7kYqr.4Z6la9N8VORIRMrmn3RA9r5yu9Cos9Sq78kzZaj2u', NULL, '2026-02-16 00:36:43', '2026-02-16 00:36:43'),
	(8, 1, 81, 'Test Pengguna', 'pengguna@test.com', NULL, '$2y$12$yDY6QTpd7mGiYYHFH8Q2aeACfk/4lNK/79S1UdRmYoepomZmEcuGG', NULL, '2026-02-16 00:37:44', '2026-02-16 00:37:44');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
