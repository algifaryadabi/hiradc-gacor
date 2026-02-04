-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 04, 2026 at 02:15 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hiradc`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_processes`
--

CREATE TABLE `business_processes` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_probis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_probis` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_processes`
--

INSERT INTO `business_processes` (`id`, `nama_probis`, `kode_probis`, `created_at`, `updated_at`) VALUES
(1, 'Audit', 'AUD', NULL, NULL),
(2, 'Business Development', 'BDV', NULL, NULL),
(3, 'Business Process Management', 'BPM', NULL, NULL),
(4, 'Project Management', 'COE', NULL, NULL),
(5, 'Communication', 'COM', NULL, NULL),
(6, 'Sustainable Responsibilities', 'CSR', NULL, NULL),
(7, 'Distribution & Transportation', 'DIT', NULL, NULL),
(8, 'Accounting And Finance Include Capex', 'FNC', NULL, NULL),
(9, 'General Affair & Security', 'GAS', NULL, NULL),
(10, 'Governance, Risk And Compliance', 'GRC', NULL, NULL),
(11, 'Human Capital Management', 'HCM', NULL, NULL),
(12, 'Information & Communication Technology', 'ICT', NULL, NULL),
(13, 'Innovation Management', 'INO', NULL, NULL),
(14, 'Knowledge Management', 'KMN', NULL, NULL),
(15, 'Performance Management', 'KPI', NULL, NULL),
(16, 'Legal', 'LGL', NULL, NULL),
(17, 'Marketing, Sales & Crm', 'MKT', NULL, NULL),
(18, 'Maintenance Productive Asset', 'MTC', NULL, NULL),
(19, 'Optimalization Non Productive Asset', 'OAS', NULL, NULL),
(20, 'Portfolio Management', 'PFM', NULL, NULL),
(21, 'Project Management (Non Physical Project)', 'PMT', NULL, NULL),
(22, 'Production', 'PRD', NULL, NULL),
(23, 'Procurement And Inventory', 'PRO', NULL, NULL),
(24, 'Quality Management', 'QCA', NULL, NULL),
(25, 'Research & Development', 'RND', NULL, NULL),
(26, 'Safety, Health And Environment Management', 'SHE', NULL, NULL),
(27, 'Management System', 'SYM', NULL, NULL),
(28, 'Vission, Mission & Strategic Planning', 'VMS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `can_create_documents`
--

CREATE TABLE `can_create_documents` (
  `id_create_documents` tinyint NOT NULL,
  `pic` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_aktif` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `can_create_documents`
--

INSERT INTO `can_create_documents` (`id_create_documents`, `pic`, `deskripsi`, `created_at`, `updated_at`, `status_aktif`) VALUES
(0, 'Tidak', 'Tidak bertanggung jawab atas form', '2026-01-17 13:31:17', '2026-01-17 13:31:17', 1),
(1, 'Ya', 'Bertanggung jawab atas form', '2026-01-17 13:31:17', '2026-01-17 13:31:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_dept` int NOT NULL,
  `id_direktorat` int NOT NULL,
  `nama_dept` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status_aktif` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id_dept`, `id_direktorat`, `nama_dept`, `deskripsi`, `status_aktif`, `created_at`, `updated_at`) VALUES
(0, 1, 'Unassigned / Non-Dept', NULL, 1, '2026-01-12 01:44:26', '2026-01-12 01:44:26'),
(1, 1, 'Corporate Secretary', NULL, 1, '2026-01-09 08:43:16', '2026-01-12 01:39:21'),
(2, 2, 'Department of BIP Production', NULL, 1, '2026-01-09 08:41:15', '2026-01-12 01:39:21'),
(3, 2, 'Department of Cement Prod', NULL, 1, '2026-01-09 08:43:16', '2026-01-12 01:39:21'),
(4, 2, 'Department of Clinker Prod', NULL, 1, '2026-01-09 08:41:15', '2026-01-12 01:39:21'),
(5, 3, 'Department of Financial', NULL, 1, '2026-01-09 08:43:16', '2026-01-12 01:39:21'),
(6, 3, 'Department of Human Capital', NULL, 1, '2026-01-09 08:41:15', '2026-01-12 01:39:21'),
(7, 2, 'Department of Maint', NULL, 1, '2026-01-09 08:41:15', '2026-01-12 01:39:21'),
(8, 1, 'Department of Marketing Plan and Develop', NULL, 1, '2026-01-09 08:43:16', '2026-01-12 01:39:21'),
(9, 2, 'Department of Mining & Raw Mtrl Mgt', NULL, 1, '2026-01-09 08:41:15', '2026-01-12 01:39:21'),
(10, 2, 'Department of Prod Planning & Ctrl', NULL, 1, '2026-01-09 08:41:15', '2026-01-12 01:39:21'),
(11, 2, 'Department of Project Mgt Office', NULL, 1, '2026-01-09 08:41:15', '2026-01-12 01:39:21'),
(12, 1, 'Department of Sales', NULL, 1, '2026-01-09 08:41:15', '2026-01-12 01:39:21'),
(13, 1, 'Internal Audit', NULL, 1, '2026-01-09 08:41:15', '2026-01-12 01:39:21'),
(14, 3, 'Non Cement Incubation Business', NULL, 1, '2026-01-09 08:41:15', '2026-01-12 01:39:21'),
(15, 3, 'Department of Portofolio', NULL, 1, '2026-01-12 01:39:21', '2026-01-29 02:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `direktorat`
--

CREATE TABLE `direktorat` (
  `id_direktorat` int NOT NULL,
  `nama_direktorat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status_aktif` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `direktorat`
--

INSERT INTO `direktorat` (`id_direktorat`, `nama_direktorat`, `deskripsi`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 'President Directorate', NULL, 1, '2026-01-09 08:41:15', '2026-01-09 09:02:09'),
(2, 'Operation Directorate', NULL, 1, '2026-01-09 08:41:15', '2026-01-09 09:02:18'),
(3, 'Finance Directorate', NULL, 1, '2026-01-09 08:41:15', '2026-01-09 09:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` int UNSIGNED NOT NULL,
  `assigned_staff_id` bigint UNSIGNED DEFAULT NULL,
  `assigned_by` bigint UNSIGNED DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `id_direktorat` int UNSIGNED DEFAULT NULL,
  `id_dept` int UNSIGNED DEFAULT NULL,
  `id_unit` int UNSIGNED DEFAULT NULL,
  `id_seksi` int UNSIGNED DEFAULT NULL,
  `kategori` enum('K3','KO','Lingkungan','Keamanan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'K3',
  `judul_dokumen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `status_she` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `she_current_approver_id` bigint UNSIGNED DEFAULT NULL,
  `she_reviewer_id` bigint UNSIGNED DEFAULT NULL,
  `she_verificator_id` bigint UNSIGNED DEFAULT NULL,
  `she_approved_at` timestamp NULL DEFAULT NULL,
  `status_security` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_current_approver_id` bigint UNSIGNED DEFAULT NULL,
  `security_reviewer_id` bigint UNSIGNED DEFAULT NULL,
  `security_verificator_id` bigint UNSIGNED DEFAULT NULL,
  `security_approved_at` timestamp NULL DEFAULT NULL,
  `level2_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level2_reviewer_id` bigint UNSIGNED DEFAULT NULL,
  `level2_approver_id` bigint UNSIGNED DEFAULT NULL,
  `level2_assignment_date` timestamp NULL DEFAULT NULL,
  `compliance_checklist` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `compliance_checklist_she` json DEFAULT NULL,
  `compliance_checklist_security` json DEFAULT NULL,
  `current_level` int NOT NULL DEFAULT '0',
  `kolom2_proses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kolom2_kegiatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom3_lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kolom5_kondisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kolom6_bahaya` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom9_risiko` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom10_pengendalian` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `kolom11_existing` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom12_kemungkinan` int DEFAULT NULL,
  `kolom13_konsekuensi` int DEFAULT NULL,
  `kolom14_score` int DEFAULT NULL,
  `kolom14_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kolom15_regulasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom16_aspek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kolom17_risiko` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom17_peluang` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `residual_kemungkinan` int DEFAULT NULL,
  `residual_konsekuensi` int DEFAULT NULL,
  `residual_score` int DEFAULT NULL,
  `residual_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `id_user`, `assigned_staff_id`, `assigned_by`, `assigned_at`, `id_direktorat`, `id_dept`, `id_unit`, `id_seksi`, `kategori`, `judul_dokumen`, `status`, `status_she`, `she_current_approver_id`, `she_reviewer_id`, `she_verificator_id`, `she_approved_at`, `status_security`, `security_current_approver_id`, `security_reviewer_id`, `security_verificator_id`, `security_approved_at`, `level2_status`, `level2_reviewer_id`, `level2_approver_id`, `level2_assignment_date`, `compliance_checklist`, `compliance_checklist_she`, `compliance_checklist_security`, `current_level`, `kolom2_proses`, `kolom2_kegiatan`, `kolom3_lokasi`, `kolom5_kondisi`, `kolom6_bahaya`, `kolom9_risiko`, `kolom10_pengendalian`, `kolom11_existing`, `kolom12_kemungkinan`, `kolom13_konsekuensi`, `kolom14_score`, `kolom14_level`, `kolom15_regulasi`, `kolom16_aspek`, `kolom17_risiko`, `kolom17_peluang`, `residual_kemungkinan`, `residual_konsekuensi`, `residual_score`, `residual_level`, `published_at`, `created_at`, `updated_at`) VALUES
(14, 15, NULL, NULL, NULL, 2, 9, 48, 23, 'K3', 'Identifikasi dan Penetapan Mitigasi Risiko Pengamanan', 'draft', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Maintenance Productive Asset', 'juh', '-', 'Rutin', '{\"type\":\"\",\"kategori\":null,\"details\":[],\"manual\":\"\",\"aspects\":[],\"threats\":[]}', '-', '{\"hierarchy\":[],\"new_controls\":[]}', '-', 1, 1, 0, NULL, NULL, 'TP', NULL, NULL, 1, 1, 0, NULL, NULL, '2026-02-04 01:50:29', '2026-02-04 01:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `document_approvals`
--

CREATE TABLE `document_approvals` (
  `id` bigint UNSIGNED NOT NULL,
  `document_id` int UNSIGNED NOT NULL,
  `level` int NOT NULL,
  `approver_id` int UNSIGNED NOT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `changes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_details`
--

CREATE TABLE `document_details` (
  `id` bigint UNSIGNED NOT NULL,
  `document_id` bigint UNSIGNED NOT NULL,
  `kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kolom2_proses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kolom2_kegiatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kolom3_lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kolom4_pihak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kolom5_kondisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kolom6_bahaya` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `kolom7_aspek_lingkungan` json DEFAULT NULL,
  `kolom8_ancaman` json DEFAULT NULL,
  `kolom9_risiko_k3ko` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom9_dampak_lingkungan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom9_celah_keamanan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `bahaya_manual` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom9_risiko` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kolom10_pengendalian` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom11_existing` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kolom12_kemungkinan` int NOT NULL,
  `kolom13_konsekuensi` int NOT NULL,
  `kolom14_score` int NOT NULL,
  `kolom14_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kolom15_regulasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom16_aspek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kolom17_risiko` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom17_peluang` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom18_toleransi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ya',
  `kolom19_pengendalian_lanjut` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kolom20_kemungkinan_lanjut` int DEFAULT NULL,
  `kolom21_konsekuensi_lanjut` int DEFAULT NULL,
  `kolom22_tingkat_risiko_lanjut` int DEFAULT NULL,
  `kolom22_level_lanjut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residual_kemungkinan` int NOT NULL,
  `residual_konsekuensi` int NOT NULL,
  `residual_score` int NOT NULL,
  `residual_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_details`
--

INSERT INTO `document_details` (`id`, `document_id`, `kategori`, `kolom2_proses`, `kolom2_kegiatan`, `kolom3_lokasi`, `kolom4_pihak`, `kolom5_kondisi`, `kolom6_bahaya`, `kolom7_aspek_lingkungan`, `kolom8_ancaman`, `kolom9_risiko_k3ko`, `kolom9_dampak_lingkungan`, `kolom9_celah_keamanan`, `bahaya_manual`, `kolom9_risiko`, `kolom10_pengendalian`, `kolom11_existing`, `kolom12_kemungkinan`, `kolom13_konsekuensi`, `kolom14_score`, `kolom14_level`, `kolom15_regulasi`, `kolom16_aspek`, `kolom17_risiko`, `kolom17_peluang`, `kolom18_toleransi`, `kolom19_pengendalian_lanjut`, `kolom20_kemungkinan_lanjut`, `kolom21_konsekuensi_lanjut`, `kolom22_tingkat_risiko_lanjut`, `kolom22_level_lanjut`, `residual_kemungkinan`, `residual_konsekuensi`, `residual_score`, `residual_level`, `created_at`, `updated_at`) VALUES
(22, 14, 'K3', 'Maintenance Productive Asset', 'juh', '-', NULL, 'Rutin', '{\"kategori\":null,\"details\":[],\"manual\":\"\"}', '{\"manual\": \"\", \"details\": []}', '{\"manual\": \"\", \"details\": []}', NULL, NULL, NULL, NULL, '-', '{\"hierarchy\":[],\"existing\":null}', '-', 1, 1, 0, 'Rendah', NULL, 'TP', NULL, NULL, 'Ya', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 'Rendah', '2026-02-04 01:50:29', '2026-02-04 01:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `foto_user`
--

CREATE TABLE `foto_user` (
  `id_foto` int NOT NULL,
  `nama_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `path_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ukuran_file` int DEFAULT NULL,
  `tipe_file` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_01_12_100000_create_documents_table', 1),
(2, '2026_01_12_100001_create_document_approvals_table', 2),
(3, '2026_01_15_072209_create_business_processes_table', 3),
(4, '2026_01_15_072229_add_id_probis_to_unit_table', 4),
(5, '2026_01_15_072819_add_id_probis_to_seksi_table', 5),
(6, '2026_01_16_190935_create_document_details_table', 6),
(7, '2026_01_16_201252_add_judul_dokumen_to_documents_table', 7),
(8, '2026_01_17_122000_add_level2_columns_safe', 8),
(9, '2026_01_17_202512_create_can_create_document_table', 999),
(10, '2026_01_17_203129_add_can_create_document_to_users_table', 999),
(11, '2014_10_12_100000_create_password_reset_tokens_table', 1000),
(12, '2026_01_21_073942_add_follow_up_columns_to_document_details_table', 1001),
(13, '2026_01_21_081559_add_conditional_fields_to_document_details_table', 1002),
(14, '2026_01_21_083405_remove_obsolete_columns_from_documents_table', 1003),
(15, '2026_01_21_083826_update_kolom7_dampak_nullable_in_document_details', 1004),
(16, '2026_01_22_023937_split_kolom9_into_separate_fields', 1005),
(17, '2026_01_26_152716_add_workflow_columns_to_documents_table', 1006),
(18, '2026_01_28_014418_add_split_compliance_checklist_to_documents_table', 1007),
(19, '2026_02_03_155257_create_puk_programs_table', 1008),
(20, '2026_02_03_155300_create_pmk_programs_table', 1009);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmk_programs`
--

CREATE TABLE `pmk_programs` (
  `id` bigint UNSIGNED NOT NULL,
  `document_detail_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sasaran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penanggung_jawab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian_revisi` text COLLATE utf8mb4_unicode_ci,
  `program_kerja` json NOT NULL,
  `status` enum('draft','pending_kepala_unit','pending_kepala_dept','pending_direksi','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `approved_by_kepala_unit` bigint UNSIGNED DEFAULT NULL,
  `approved_by_kepala_dept` bigint UNSIGNED DEFAULT NULL,
  `approved_by_direksi` bigint UNSIGNED DEFAULT NULL,
  `unit_approval_at` timestamp NULL DEFAULT NULL,
  `dept_approval_at` timestamp NULL DEFAULT NULL,
  `direksi_approval_at` timestamp NULL DEFAULT NULL,
  `rejection_note` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `puk_programs`
--

CREATE TABLE `puk_programs` (
  `id` bigint UNSIGNED NOT NULL,
  `document_detail_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sasaran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penanggung_jawab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian_revisi` text COLLATE utf8mb4_unicode_ci,
  `program_kerja` json NOT NULL,
  `status` enum('draft','pending_kepala_unit','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `approved_by_kepala_unit` bigint UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejection_note` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_jabatan`
--

CREATE TABLE `role_jabatan` (
  `id_role_jabatan` int NOT NULL,
  `nama_role_jabatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `level_jabatan` int DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_jabatan`
--

INSERT INTO `role_jabatan` (`id_role_jabatan`, `nama_role_jabatan`, `deskripsi`, `level_jabatan`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 'Director\n', 'Direktur', 0, 1, '2026-01-09 08:36:52', '2026-01-12 01:29:03'),
(2, 'General Manager', 'Band I', 1, 1, '2026-01-09 08:36:52', '2026-01-12 01:31:30'),
(3, 'Senior Manager', 'Band II', 2, 1, '2026-01-09 08:36:52', '2026-01-12 01:31:36'),
(4, 'Manager', 'Band III', 3, 1, '2026-01-09 08:36:52', '2026-01-12 01:31:39'),
(5, 'Supervisor', 'Band IV', 4, 1, '2026-01-09 08:36:52', '2026-01-12 01:31:47'),
(6, 'Associate', 'Band V', 5, 1, '2026-01-09 08:36:52', '2026-01-12 01:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id_role_user` int NOT NULL,
  `nama_role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `status_aktif` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id_role_user`, `nama_role`, `deskripsi`, `permissions`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Akses penuh ke seluruh sistem', NULL, 1, '2026-01-09 08:36:52', '2026-01-09 09:01:10'),
(2, 'User', 'Akses administratif terbatas', NULL, 1, '2026-01-09 08:36:52', '2026-01-09 09:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `seksi`
--

CREATE TABLE `seksi` (
  `id_seksi` int NOT NULL,
  `id_unit` int NOT NULL,
  `id_probis` bigint UNSIGNED DEFAULT NULL,
  `nama_seksi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status_aktif` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seksi`
--

INSERT INTO `seksi` (`id_seksi`, `id_unit`, `id_probis`, `nama_seksi`, `deskripsi`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 32, 18, 'Group of Monitoring Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(2, 11, NULL, 'Group of Plan & Eval of Bulk Cem Clin Lo', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(3, 41, NULL, 'Group of Planner WHRPG & Utility', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(4, 17, 18, 'Grup of Monitoring Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(5, 39, 22, 'Section of Aceh Packing Plant', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(6, 51, 17, 'Section of Area Sales Aceh', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(7, 50, 17, 'Section of Area Sales Bengkulu', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(8, 50, 17, 'Section of Area Sales Riau Daratan 1', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(9, 50, 17, 'Section of Area Sales Riau Daratan 2', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(10, 51, 17, 'Section of Area Sales Riau Kepulauan', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(11, 50, 17, 'Section of Area Sales Sumbar', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(12, 52, 17, 'Section of Area Sales Sumut 1', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(13, 52, 17, 'Section of Area Sales Sumut 2', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(14, 7, 22, 'Section of Bag Prod', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(15, 7, 22, 'Section of Bag Prod Planning & QA', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(16, 39, 22, 'Section of Bengkulu Packing Plant', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(17, 53, 23, 'Section of Channel Process', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(18, 43, NULL, 'Section of Cleaning', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(19, 21, NULL, 'Section of Construction', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(20, 48, 18, 'Section of Conveyor Mech Maint', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(21, 48, 22, 'Section of Crusher & Conveyor Operation', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(22, 48, 18, 'Section of Crusher Mech Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(23, 48, 18, 'Section of Crusher& Conveyor Elins Maint', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(24, 38, NULL, 'Section of Distribution support', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(25, 35, 22, 'Section of Drilling,Blasting&Mining Serv', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(26, 16, 18, 'Section of Dumai Plant Maint', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(27, 16, 22, 'Section of Dumai Plant Production', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(28, 41, NULL, 'Section of electricity distribution', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(29, 21, 18, 'Section of Elins Workshop', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(30, 21, 18, 'Section of Engineering Workshop', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(31, 19, 18, 'Section of EPDC 2-3-5Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(32, 19, 18, 'Section of EPDC 4-6 Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(33, 21, 18, 'Section of Fabrication', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(34, 15, 8, 'Section of Financial & GA', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(35, 17, 18, 'Section of FM 2-3-5 Elins Maint', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(36, 32, 18, 'Section of FM 2-3-5 Mech Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(37, 11, 22, 'Section of FM 2-3-5 Operation', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(38, 18, 18, 'Section of FM 4-6 Elins Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(39, 33, 18, 'Section of FM 4-6 Mech Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(40, 11, 22, 'Section of FM 4-6 Operation', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(41, 43, 7, 'Section of Heavy Eq & Coal Transport', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(42, 17, 18, 'Section of Indarung Packer Elins Maint', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(43, 32, 18, 'Section of Indarung Packer Mech Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(44, 11, 22, 'Section of Indarung Packer Operation', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(45, 17, 18, 'Section of KCM 2-3-5 Elins Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(46, 32, 18, 'Section of KCM 2-3-5 Mech Maint', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(47, 18, 18, 'Section of KCM 4-6 Elins Maint', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(48, 33, 18, 'Section of KCM 4-6 Mech Maint', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(49, 39, 22, 'Section of Lampung Packing Plant', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(50, 38, 7, 'Section of Land Transportation', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(51, 35, NULL, 'Section of Loading & Hauling', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(52, 35, 18, 'Section of Mining Heavy Eq Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(53, 21, NULL, 'Section of Plan & Control', NULL, 1, '2026-01-09 08:43:16', '2026-01-12 01:53:21'),
(54, 27, NULL, 'Section of Plan & Eval', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(55, 53, 22, 'Section of Planning & Evaluation', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(56, 41, NULL, 'Section of Power Plant', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(57, 21, 24, 'Section of Quality Control', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(58, 13, 22, 'Section of RKC 4 Operation', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(59, 12, 22, 'Section of RKC 5 Operation', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(60, 13, 22, 'Section of RKC 6 Operation', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(61, 17, 18, 'Section of RM 2-3-5 Elins Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(62, 32, 18, 'Section of RM 2-3-5 Mech Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(63, 18, 18, 'Section of RM 4-6 Elins Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(64, 33, 18, 'Section of RM 4-6 Mech Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(65, 38, 7, 'Section of Sea & BulkTransportation', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(66, 18, 18, 'Section of Teluk Bayur Elins Maint', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(67, 33, 18, 'Section of Teluk Bayur Maintenance', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(68, 39, 22, 'Section of Teluk Bayur Packing Plant', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(69, 27, 7, 'Section of Transportation', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(70, 41, NULL, 'Section of Utility', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(71, 1, NULL, 'Section Technical & Customer Support', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(72, 56, 26, 'Staf of Health', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(73, 42, 17, 'Staf of Marketing Intelligent', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(74, 42, 23, 'Staf of Pricing & Promotion', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(75, 49, 17, 'Staf of Sales Bulk', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(76, 2, NULL, 'Staff of AFR', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(77, 22, NULL, 'Staff of AP / AR Mgt', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(78, 0, NULL, 'Staff of Asset Mgt', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(79, 8, 18, 'Staff of BIP Mech Production', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(80, 9, 22, 'Staff of BIP Production', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(81, 40, NULL, 'Staff of Budgeting', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(82, 10, NULL, 'Staff of Capex', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(83, 43, NULL, 'Staff of Coal Mixing & Bulk Material', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(84, 14, 5, 'Staff of Communication', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(85, 6, 8, 'Staff of Cost Accounting', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(86, 20, NULL, 'Staff of Energy Management', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(87, 57, NULL, 'Staff of Engineering', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(88, 56, 26, 'Staff of Environment', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(89, 20, 23, 'Staff of Eval Process & Energy', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:40:24'),
(90, 6, 8, 'Staff of Financial Accounting', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(91, 44, NULL, 'Staff of General Plant Services', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(92, 23, NULL, 'Staff of Gnrl Facility', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(93, 24, 10, 'Staff of GRC & Internal Control', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(94, 25, NULL, 'Staff of HC Plan Organization & Policy', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(95, 14, NULL, 'Staff of Institutional Relation', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(96, 40, NULL, 'Staff of Insurance', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(97, 3, 1, 'Staff of Internal Audit', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:40:24'),
(98, 28, NULL, 'Staff of KM & Innovation', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(99, 28, 11, 'Staff of Learning & People Development', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(100, 29, 16, 'Staff of Legal', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(101, 30, 18, 'Staff of Maint Inspection', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(102, 30, 18, 'Staff of Maint Planning & Eval', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(103, 31, 17, 'Staff of Marketing & Sales Non Cement', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(104, 34, NULL, 'Staff of Mgt System', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(105, 36, 22, 'Staff of Mining HSE & Reclamation', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(106, 36, 22, 'Staff of Mining Planning & Monitoring', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(107, 4, 22, 'Staff of Non Cement Incubation Business', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(108, 37, 22, 'Staff of Non Cement Production', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(109, 56, 26, 'Staff of Occupational Safety', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(110, 26, NULL, 'Staff of Outsourcing Management', NULL, 1, '2026-01-09 08:43:16', '2026-01-12 01:53:21'),
(111, 45, NULL, 'Staff of Overhaul Mgt', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(112, 40, NULL, 'Staff of Performance Eval', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(113, 26, 11, 'Staff of Personnel', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(114, 26, 11, 'Staff of Personnel Relation', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(115, 30, NULL, 'Staff of PGO', NULL, 1, '2026-01-09 08:43:16', '2026-01-12 01:53:21'),
(116, 0, NULL, 'Staff of Portofolio', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(117, 9, 22, 'Staff of Product Application', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(118, 44, 22, 'Staff of Production Planning', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:40:24'),
(119, 15, 23, 'Staff of Program TJSL BUMN', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(120, 45, 23, 'Staff of Project Execution', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(121, 45, 23, 'Staff of Project Execution (Civil)', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(122, 45, 18, 'Staff of Project Execution (Elins)', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(123, 45, 18, 'Staff of Project Execution (Mechanical)', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(124, 47, 24, 'Staff of QA', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(125, 46, NULL, 'Staff of Qual Ctrl', NULL, 1, '2026-01-09 08:43:16', '2026-01-12 01:53:21'),
(126, 29, 16, 'Staff of Regulation&Legal Administration', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(127, 54, NULL, 'Staff of SCM Infrastructur Port Managemen', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(128, 14, 23, 'Staff of Secretariat & Protocol', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(129, 55, 9, 'Staff of Security', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(130, 58, 22, 'Staff of SP Planning', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(131, 25, 11, 'Staff of Talent & Employee Performance', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:49:57'),
(132, 40, NULL, 'Staff of Tax', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(133, 22, NULL, 'Staff of Treasury', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(134, 15, 23, 'Staff of UMK Funding Program', NULL, 1, '2026-01-12 01:53:21', '2026-01-15 00:40:24'),
(135, 6, NULL, 'Staff of Verification', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(136, 59, 23, 'Staff of Warehouse', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:49:57'),
(137, 5, NULL, 'TPM Officer', NULL, 1, '2026-01-12 01:53:21', '2026-01-12 01:53:21'),
(138, 0, NULL, 'Unassigned / Non-Seksi', NULL, 1, '2026-01-13 03:16:38', '2026-01-13 03:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id_unit` int NOT NULL,
  `id_probis` bigint UNSIGNED DEFAULT NULL,
  `id_dept` int NOT NULL,
  `nama_unit` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_unit` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status_aktif` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id_unit`, `id_probis`, `id_dept`, `nama_unit`, `kode_unit`, `deskripsi`, `status_aktif`, `created_at`, `updated_at`) VALUES
(0, 0, 0, 'Unassigned / Non-Unit', 'NON-UNIT', NULL, 1, '2026-01-12 01:53:01', '2026-01-15 07:25:58'),
(1, NULL, 12, 'Section Technical & Customer Support', 'TCS', NULL, 1, '2026-01-12 01:44:35', '2026-01-12 01:49:54'),
(2, 2, 10, 'Staff of AFR', 'AFR', NULL, 1, '2026-01-12 01:44:35', '2026-01-22 07:32:57'),
(3, 1, 13, 'Staff of Internal Audit', 'IA', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:40:24'),
(4, 22, 14, 'Staff of Non Cement Incubation Business', 'NCIB', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 07:59:23'),
(5, NULL, 11, 'TPM Officer', 'TPM', NULL, 1, '2026-01-12 01:44:35', '2026-01-12 01:49:54'),
(6, 8, 5, 'Unit of Accounting', 'ACCT', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(7, NULL, 3, 'Unit of Bag Plant', 'BAG', NULL, 1, '2026-01-12 01:44:35', '2026-01-12 01:49:54'),
(8, 22, 2, 'Unit of BIP Mech Production&Tech Support', 'BIP-MCH', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:40:24'),
(9, 22, 2, 'Unit of BIP Production & Application', 'BIP-PRD', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:40:24'),
(10, NULL, 11, 'Unit of Capex', 'CAPEX', NULL, 1, '2026-01-12 01:44:35', '2026-01-12 01:49:54'),
(11, 22, 3, 'Unit of Cement Prod', 'CMT-PRD', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(12, 22, 4, 'Unit of Clinker 1 Prod', 'CLINK-1', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(13, 22, 4, 'Unit of Clinker 2 Prod', 'CLINK-2', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(14, 5, 1, 'Unit of Communication & Secretariat', 'COMSEC', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:40:24'),
(15, 6, 1, 'Unit of CSR', 'CSR', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:40:24'),
(16, NULL, 3, 'Unit of Dumai Plant', 'DUMAI', NULL, 1, '2026-01-09 08:43:16', '2026-01-12 01:49:54'),
(17, 18, 7, 'Unit of Elins Maint 1', 'ELINS-1', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(18, 18, 7, 'Unit of Elins Maint 2', 'ELINS-2', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(19, 18, 7, 'Unit of EPDC maint', 'EPDC', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(20, 23, 10, 'Unit of Eval Process & Energy', 'EVAL-PE', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:40:24'),
(21, NULL, 14, 'Unit of Fabrication & Construction', 'FAB-CON', NULL, 1, '2026-01-09 08:43:16', '2026-01-12 01:49:54'),
(22, 8, 5, 'Unit of Financial', 'FIN', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(23, NULL, 11, 'Unit of Gnrl Facility', 'GEN-FAC', NULL, 1, '2026-01-12 01:44:35', '2026-01-12 01:49:54'),
(24, 10, 0, 'Unit of GRC & Internal Control', 'GRC', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:40:24'),
(25, NULL, 6, 'Unit of HC Plan and Develop Organization', 'HC-OD', NULL, 1, '2026-01-12 01:44:35', '2026-01-12 01:49:54'),
(26, 11, 6, 'Unit of Human Capital Operational', 'HC-OPS', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(27, 7, 3, 'Unit of Interplant Logistic', 'LOG-INT', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(28, 11, 6, 'Unit of Learning & People Development', 'LPD', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(29, 16, 1, 'Unit of Legal', 'LEGAL', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:40:24'),
(30, 18, 7, 'Unit of Maint Reliability', 'MNT-REL', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(31, 17, 14, 'Unit of Marketing & Sales Non Cement', 'MKT-NC', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(32, 18, 7, 'Unit of Mech Maint 1', 'MECH-1', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(33, 18, 7, 'Unit of Mech Maint 2', 'MECH-2', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(34, 18, 0, 'Unit of Mgt System', 'MGT-SYS', NULL, 1, '2026-01-12 01:44:35', '2026-01-21 08:28:51'),
(35, 22, 9, 'Unit of Mining Operation', 'MIN-OPS', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(36, 22, 9, 'Unit of Mining Planning & Monitoring', 'MIN-PLN', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(37, 22, 14, 'Unit of Non Cement Production', 'NC-PROD', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:40:24'),
(38, 7, 12, 'Unit of Outbound Logistic', 'LOG-OUT', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(39, 22, 3, 'Unit of Packing Plant', 'PACKING', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(40, NULL, 5, 'Unit of Performance & Budgeting', 'PRF-BUD', NULL, 1, '2026-01-12 01:44:35', '2026-01-12 01:49:54'),
(41, NULL, 9, 'Unit of Power & Utility', 'PWR-UTL', NULL, 1, '2026-01-12 01:44:35', '2026-01-12 01:49:54'),
(42, 23, 8, 'Unit of Pricing & Promotion', 'PRC-PRO', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:40:24'),
(43, 22, 10, 'Unit of Prod Supporting', 'PRD-SUP', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(44, 22, 10, 'Unit of Production Planning', 'PRD-PLN', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:40:24'),
(45, 23, 11, 'Unit of Project Mgt', 'PMO', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:40:24'),
(46, NULL, 10, 'Unit of Qual Ctrl', 'QC', NULL, 1, '2026-01-09 08:43:16', '2026-01-12 01:49:54'),
(47, 24, 0, 'Unit of Quality Assurance', 'QA', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(48, 22, 9, 'Unit of Raw Material Prod', 'RM-PROD', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(49, 17, 12, 'Unit of Sales Bulk', 'SLS-BLK', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(50, 17, 12, 'Unit of Sales Central Sumatera', 'SLS-CS', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(51, 17, 12, 'Unit of Sales Northern Sumatera 1', 'SLS-NS1', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(52, 17, 12, 'Unit of Sales Northern Sumatera 2', 'SLS-NS2', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(53, 17, 8, 'Unit of Sales Planning & Evaluation', 'SLS-PLN', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:46:53'),
(54, NULL, 3, 'Unit of SCM Infrastructur Port Managemen', 'SCM-PRT', NULL, 1, '2026-01-12 01:44:35', '2026-01-12 01:49:54'),
(55, 9, 1, 'Unit of Security', 'SEC', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(56, 26, 0, 'Unit of SHE', 'SHE', NULL, 1, '2026-01-12 01:44:35', '2026-01-15 00:40:24'),
(57, NULL, 11, 'Unit of Site Engineering', 'SIT-ENG', NULL, 1, '2026-01-12 01:44:35', '2026-01-12 01:49:54'),
(58, NULL, 11, 'Unit of Spare Part Plan', 'SP-PLAN', NULL, 1, '2026-01-12 01:44:35', '2026-01-12 01:49:54'),
(59, 23, 0, 'Unit of Warehouse', 'WH', NULL, 1, '2026-01-09 08:43:16', '2026-01-15 00:46:53'),
(60, NULL, 15, 'Staff of Portofolio', NULL, NULL, 1, '2026-01-29 02:18:05', '2026-01-29 02:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_direktorat` int NOT NULL,
  `id_dept` int NOT NULL,
  `id_unit` int NOT NULL,
  `id_seksi` int NOT NULL,
  `role_jabatan` int NOT NULL,
  `can_create_documents` tinyint DEFAULT '0',
  `is_reviewer` tinyint(1) DEFAULT '0',
  `is_verifier` tinyint(1) DEFAULT '0',
  `foto_user` int DEFAULT NULL,
  `role_user` int NOT NULL,
  `user_aktif` int NOT NULL DEFAULT '1',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `nama_user`, `email_user`, `password`, `id_direktorat`, `id_dept`, `id_unit`, `id_seksi`, `role_jabatan`, `can_create_documents`, `is_reviewer`, `is_verifier`, `foto_user`, `role_user`, `user_aktif`, `last_login`, `created_at`, `updated_at`) VALUES
(11, 'ABD.RAHMAN3140', 'ABD RAHMAN', 'ABD.RAHMAN3140@SIG.ID', '$2y$12$uqL.sYY89nEIhtFhgGtzBO/qGYqSzQ5fxemgUeySEldgP7ZoQLVoC', 1, 1, 55, 129, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(12, 'ABDEL.BAKRI', 'ABDEL BAKRI, ST.', 'ABDEL.BAKRI@SIG.ID', '$2y$12$biFvB13byULZ0CjvwtL6iOwpDOOORtvbSti3wsrgPZuE3ye.uviOS', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(13, 'ABDI.BUTSINATA', 'ABDI BUTSINATA, ST.', 'ABDI.BUTSINATA@SIG.ID', '$2y$12$ql7kwn8gmdL5gHWy7rBYC.3RRkkGr3fU8IcODxfX6/neDkM9ds3CC', 2, 7, 30, 101, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(14, 'ABDI.DARMA', 'ABDI DARMA, ST.', 'ABDI.DARMA@SIG.ID', '$2y$12$Uva9uq2X8OPEn6giYNo76eoVpyF93JdOAI0jNoMXL1.nhTM5BdDBq', 3, 14, 21, 53, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(15, 'ABDIANTO', 'ABDIANTO, AMD.', 'ABDIANTO@SIG.ID', '$2y$12$KIB1c6pkMj8HeDTvhyMZcOTC4nQj4z//xBI9dkMbqduxpxPrV3j.G', 2, 9, 48, 23, 5, 1, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(16, 'ABDUL.HADI3674', 'ABDUL HADI', 'ABDUL.HADI3674@SIG.ID', '$2y$12$guqNI1sN5.Vf7vjyS1otluAo84Z7vF6saX/bZjXDGA0EAyP7hyD/i', 2, 3, 11, 37, 5, 1, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(17, 'ABDUL.HAFIZ', 'ABDUL HAFIZ', 'ABDUL.HAFIZ@SIG.ID', '$2y$12$RAQM/QSCU./KCcaGhmzkzeOOPz6VQO7n4LrEL1pMBf3HsZYVPhgWu', 2, 7, 18, 47, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(18, 'ABRIADI', 'ABRIADI', 'ABRIADI@SIG.ID', '$2y$12$/SM/XYiLQXUdY30HRZjZCeKGiD3shHWEHgaVz4oRCmEL1rghn034e', 1, 1, 55, 129, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(19, 'ACHIARMAN', 'ACHIARMAN, SE., MM.', 'ACHIARMAN@SIG.ID', '$2y$12$3wS0H0zjy8t6S5YvsfCp2uOG5t/o9vUqTa8hoZxOqwyD4/9YyEE/W', 1, 13, 3, 97, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(20, 'ACHMAD.MUSTAQIM', 'ACHMAD MUSTAQIM', 'ACHMAD.MUSTAQIM@SIG.ID', '$2y$12$3unAJdl8bpFqVxmpAG9tce1WvWy97rnBYKeocoOggBX9dq7DEElai', 2, 3, 16, 26, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(21, 'ACHMAD.OHANA', 'ACHMAD TAUFAN OHANA, ST.', 'ACHMAD.OHANA@SIG.ID', '$2y$12$MpD2hx8mL6qUjy4ZG.RAb.k2H183ecrWOntQ6jC/acJ/AQgUb9Tfy', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(22, 'ACI.MUNIR', 'ACI LESTA TRIADI MUNIR, S.Si.', 'ACI.MUNIR@SIG.ID', '$2y$12$DzeBRVswTXCnTiLVfzOQwenG98Ll08nZ0Vw3dt/AVG3F.ImmcNaWy', 2, 0, 47, 124, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(23, 'ADDINU.PUTRA', 'ADDINU EKA PUTRA, SH.', 'ADDINU.PUTRA@SIG.ID', '$2y$12$yLet2Sh.vQUBJeUgsqeDVuH4WgOfawY4bUZnAG0jTQZDEPhDcxgdC', 2, 9, 48, 20, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(24, 'ADE.BUSTANANDA', 'ADE BUSTANANDA, AMD.', 'ADE.BUSTANANDA@SIG.ID', '$2y$12$Izrq46yBfp0cue9gGr.1W.Fdk.XLC2k5RqbOvY1Eold3ukuQezRzm', 2, 10, 20, 89, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(25, 'ADE.CENDRA', 'ADE CENDRA', 'ADE.CENDRA@SIG.ID', '$2y$12$aSXeX3K4/QwnLBN3ff86Oe7g16lIvarnjjr0tWxRpFzNSaNOI8HAq', 3, 6, 26, 110, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(26, 'ADE.ERMADI', 'ADE ERMADI, ST.', 'ADE.ERMADI@SIG.ID', '$2y$12$JebKPE2lFeesZYlR3M7eq.43NmliQxalZd0WJbrBOitKC5j.lxjVK', 2, 7, 17, 42, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(27, 'ADE.HARYADI', 'ADE HARYADI', 'ADE.HARYADI@SIG.ID', '$2y$12$nM67lhZAyvEfk7HRu6/FSO5oMh6OgkFYkaGVcv4V//GJzbzG7RIyy', 3, 0, 59, 136, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(28, 'ADE.PUTRA', 'ADE IKA PUTRA', 'ADE.PUTRA@SIG.ID', '$2y$12$LTEJFBybjt7yuTWFIwH6XubOFIZ2r4v7eDI/3b1G6eR1KzvZzMSHG', 2, 10, 20, 89, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(29, 'ADE.JAYA', 'ADE JAYA PUTRA', 'ADE.JAYA@SIG.ID', '$2y$12$gQIavG8SvYLN1cymCdeyieg.L8KWqvo5caRsPqMl.PvKS./vTlNAC', 2, 10, 43, 41, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(30, 'ADE.MULIANDA', 'ADE MULIANDA', 'ADE.MULIANDA@SIG.ID', '$2y$12$0ALsyukUPSjz1Kr75x7MXeG28Itq0oQSEaiUT2x/PW/1ihE/Fw9KW', 2, 7, 33, 48, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(31, 'ADE.SIF', 'ADE SIF', 'ADE.SIF@SIG.ID', '$2y$12$rmyzQnjHDb6Nh1tCj9KsDe3rAvxSVxGb.8GPWmLoTAnAEjUFGVQ1K', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(32, 'ADE.SYAPUTRA', 'ADE SYAPUTRA', 'ADE.SYAPUTRA@SIG.ID', '$2y$12$rWjv5LOsaHjFsoLAmPrrfeubDNpvmCRWwBLfiOGzClDCabUn/VoLu', 2, 7, 32, 46, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(33, 'ADE.VEBRIA', 'ADE VEBRIA, SE.', 'ADE.VEBRIA@SIG.ID', '$2y$12$uSxd2ZNqUKAE4qmsiAxfLOVmpUFr5dKEWdU5P9HgpTkAO4DjtOc6m', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(34, 'ADEK.SARI', 'ADEK PURNAMA SARI', 'ADEK.SARI@SIG.ID', '$2y$12$mxcg3QS4jT6mLVO64/x22uKVm3NTRqIQQxROyIOcBhDlktgBPUTte', 2, 10, 44, 118, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(35, 'ADEL.WARMAN', 'ADEL WARMAN', 'ADEL.WARMAN@SIG.ID', '$2y$12$lkcHmNKlY3hyp5JE2vwfeetzl8OwsJdorgGPcTTwDOXo1Q8h7UxF2', 2, 11, 45, 123, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(36, 'ADENIL.MUZARWI', 'ADENIL MUZARWI', 'ADENIL.MUZARWI@SIG.ID', '$2y$12$/6PaqbnruIyKble/bWcAIu81ynLoiO.tkCU2TWwGB2PW4JK6MIA9a', 2, 7, 17, 35, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(37, 'ADHI.SUPANGAT', 'ADHI SUPANGAT', 'ADHI.SUPANGAT@SIG.ID', '$2y$12$89kyIrQKmLPyDz1iOFoW5..uI7QVMMZWj3.tWDi020noft1tdiBS6', 1, 12, 38, 65, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(38, 'ADI.ASMARA', 'ADI ASMARA', 'ADI.ASMARA@SIG.ID', '$2y$12$GTOOFjk32SeFrZ494BJacuvB6AxUPQL7AOhfpGUWZHNpA8VfmPKbC', 2, 10, 46, 125, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(39, 'ADI.ISMANTO', 'ADI ISMANTO', 'ADI.ISMANTO@SIG.ID', '$2y$12$Zwm7zmB.Qa0cIljYg93pdePqLKVpWA54.6SvqhYXbHXqb13Sop9eO', 2, 11, 45, 120, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(40, 'ADI.MUKHANIS', 'ADI MUKHANIS', 'ADI.MUKHANIS@SIG.ID', '$2y$12$JVnnHwoo4cAjdN0MjwlV8u41fNehhuBJ1QXWpY6imwvTWjuSuaSMy', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(41, 'ADI.OKTAFIAN', 'ADI OKTAFIAN. ST', 'ADI.OKTAFIAN@SIG.ID', '$2y$12$CMo5xEKHLJM5.Ot25EtIdOnxPR3MnnS00csfrTOMH01LQTcX4X.CO', 2, 10, 2, 76, 4, 1, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-26 20:31:41'),
(42, 'ADI.PRAMAYUL', 'ADI PRAMAYUL', 'ADI.PRAMAYUL@SIG.ID', '$2y$12$EH.DtV0NgxL.O5YUPABPTO8u4iW31wLHmibN89ztdZ9NAqs6BvEnS', 2, 9, 41, 56, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(43, 'ADRI.KHAIR', 'ADRI KHAIR K, S.Si.', 'ADRI.KHAIR@SIG.ID', '$2y$12$yl4EFF589ZvTOMcbbLzCWuBC2Bam2wnRIslighbRNxR.abGYf8PWO', 3, 14, 21, 53, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(44, 'ADRIL', 'ADRIL', 'ADRIL@SIG.ID', '$2y$12$Yqk96gyEgwnR836E2AHNKuPv3OvmEfpG2rdYYAvOyrkXg8Iqv0VSC', 2, 3, 54, 127, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(45, 'AFIF.AULIA', 'AFIF AULIA', 'AFIF.AULIA@SIG.ID', '$2y$12$ewdQHPfaEKD3iTttToNRbOHtI0Lq84AyAp8knV0/IZoHa8WeKTsHC', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(46, 'AFINO.FEBRIAN', 'AFINO FEBRIAN', 'AFINO.FEBRIAN@SIG.ID', '$2y$12$URufH9xv7TMkOOBMdgDFDuX9EE.FQa1EHxowFB8bX19TtH0JtAqzy', 2, 9, 48, 20, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(47, 'AFRAN.RAMADHANA', 'AFRAN RAMADHANA', 'AFRAN.RAMADHANA@SIG.ID', '$2y$12$41syCdcU65MVQcFMfMQzP.6a1CDVcrpqsJXlDkREP6dkyUZ6lCqi6', 2, 9, 36, 106, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(48, 'AFRI.JONI', 'AFRI JONI', 'AFRI.JONI@SIG.ID', '$2y$12$UJnx4A.TeXqYbN9PG6VCOOPCpdPL5EUxSF/p1jc5HNR1DAQyDYpt6', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(49, 'AFRI.MAWARDI', 'AFRI MAWARDI', 'AFRI.MAWARDI@SIG.ID', '$2y$12$yys6.KY1DjeyLvj1s.QFeui1RV.2Wyb0vze2vuOc4c6aUPE2hlgn6', 2, 0, 47, 124, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(50, 'AFRIADI.LAOLY', 'AFRIADI LAOLY', 'AFRIADI.LAOLY@SIG.ID', '$2y$12$xSypuTv8eL47TNa0afn7/OKAgzK3Bk5VjKJttVy/LaztTJYqjBvNW', 2, 9, 41, 28, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(51, 'AFRIANTO.RAMADANI', 'AFRIANTO RAMADANI', 'AFRIANTO.RAMADANI@SIG.ID', '$2y$12$5V7i7ceqN0HTbWv0hg1Wk.N2XIVf7zCfXf7ielpTQJVJDSb9b5yay', 2, 10, 2, 76, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-26 20:31:41'),
(52, 'AFRINAL', 'AFRINAL', 'AFRINAL@SIG.ID', '$2y$12$eLC3nIq.S3eKuzmIapZ11O8RuGSEpV2pEP4Tgwd2n1sEKREvl53w2', 3, 6, 28, 99, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(53, 'AFRIWAN', 'AFRIWAN', 'AFRIWAN@SIG.ID', '$2y$12$MBqTbs4Bw0jw5/g7mUWtyukCes7foEOCR5hM2ZQv43CIFqtzP.xWS', 2, 11, 45, 120, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(54, 'AFRIYANTO', 'AFRIYANTO', 'AFRIYANTO@SIG.ID', '$2y$12$F1PjmaBdfKwUr2OtJxYL5Os3AHVYl1HXgRUKFiS8l6Jat171I5gl6', 2, 9, 48, 21, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(55, 'AFRIZAL.3393', 'AFRIZAL', 'AFRIZAL.3393@SIG.ID', '$2y$12$/pnIQo6WfE6BUz8p1ptrXuc.g42DI4hZNcdVp8bv17wSEixkhXZ7O', 2, 7, 17, 61, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(59, 'AGRIAN.PEBY', 'AGRIAN PEBY, ST.', 'AGRIAN.PEBY@SIG.ID', '$2y$12$O0rIiuefPvHj4rA8he4LQO5N3jyZ.G8KJC52Mp4XUIMIweaN9xX6S', 2, 10, 44, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(60, 'AGUM.ALHAKIM', 'AGUM ALHAKIM', 'AGUM.ALHAKIM@SIG.ID', '$2y$12$4R/wvLPapqNS14/XsTMc9OnblsO5h/RZOJPJsqsiovr1PPyNb9jf2', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(61, 'AGUNG.PRASETIYO', 'AGUNG JOKO PRASETIYO', 'AGUNG.PRASETIYO@SIG.ID', '$2y$12$D79Zr6UmJTVOSc9Rf8cmzeqbwdxfJlfCKmat8eWVW2OpsNJkfZO02', 1, 1, 14, 128, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(62, 'AGUNG.RAMADHAN', 'AGUNG RAMADHAN', 'AGUNG.RAMADHAN@SIG.ID', '$2y$12$C8ub42L5xX.SbYGGVb/b4eJoRqABjbZ0M0QMIJkYWUSiqePSzEbPG', 1, 12, 38, 24, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(63, 'AGUS.MAULANA', 'AGUS MAULANA, ST.', 'AGUS.MAULANA@SIG.ID', '$2y$12$phui4DoH6b/ghdR0J.2.u.xXlP8/fUp3eZq3TnDyf026NHGyKjPgG', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(64, 'AGUSRIZAL', 'AGUSRIZAL', 'AGUSRIZAL@SIG.ID', '$2y$12$nHKgFZ4yXGWD9NZc/O11HeGJXCLr/iHmbUxzbV7kesxzKNWm0b3Ta', 2, 7, 32, 36, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(65, 'AHMAD.DHANY', 'AHMAD DHANY, ST.', 'AHMAD.DHANY@SIG.ID', '$2y$12$1VYLPemlvL4SpzuU/cQ.MepdbjCwEb8vkkpXufr80DCdAo.GM9Po2', 2, 3, 16, 26, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(66, 'AHMAD.HAFIZ', 'AHMAD HAFIZ', 'AHMAD.HAFIZ@SIG.ID', '$2y$12$OX20dSw/Osuje5Xq9YU6y.fY1dq48Krp6OH9NmYa8rZOb6Opc3VRG', 1, 12, 38, 24, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(67, 'AHMAD.ILHAM', 'AHMAD ILHAM', 'AHMAD.ILHAM@SIG.ID', '$2y$12$OjWtrR8nJCmHdDBYC97auuDV4rhAg/qj98hTN2bQA1fz1ttpw1Ykm', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(68, 'AHMAD.SAIFULLAH', 'AHMAD SAIFULLAH', 'AHMAD.SAIFULLAH@SIG.ID', '$2y$12$rDsfKPFs7obxmyF1nYgESeAoxLwc5m.6qq.oUpCgA5kXMb57cSxzK', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(69, 'AHMAD.JAYA', 'AHMAD TRIKEN JAYA', 'AHMAD.JAYA@SIG.ID', '$2y$12$MyBSRWEIocABwypCKBCHxeli0ieOAT2uuFoXaCSM8SKwk8C7eZNSS', 2, 7, 17, 42, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(70, 'AHMAD.ZIAMUDDIN', 'AHMAD ZIAMUDDIN SIREGAR', 'AHMAD.ZIAMUDDIN@SIG.ID', '$2y$12$1Nu8xKXnF379Su.oO3ZD7.c5AlspCoY9yT/gILLgKlsmvsdxNbBXG', 2, 7, 18, 47, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(71, 'AIDIL.ISWANDI', 'AIDIL ISWANDI', 'AIDIL.ISWANDI@SIG.ID', '$2y$12$mT7qF9bKpqppu/CydkHlU.Yfm.atYBhpphmIFMo.IK4gbPApHaUBu', 2, 3, 16, 27, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(72, 'AISYAH.NUR', 'AISYAH NUR, SE.', 'AISYAH.NUR@SIG.ID', '$2y$12$E4HKeOUOrX7sFSK9WikSsu6MojsihyD.RNn8AGCf9AoUHIJN6/4SG', 1, 13, 3, 97, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(73, 'AKBAR.RAHMADIAN', 'AKBAR RAHMADIAN', 'AKBAR.RAHMADIAN@SIG.ID', '$2y$12$fiNKmJPjerA9/8BFiFRub.3p5hUQjH9C37GlHDDx3SDqOlfDviGWm', 2, 9, 48, 23, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(74, 'AKBAR.RIVALDHI', 'AKBAR RIVALDHI, S.M.', 'AKBAR.RIVALDHI@SIG.ID', '$2y$12$bM0AFnCogGEz21IdRnTAfOvS6j2/5yqOb7HWHzBqQErG0yYn.FYku', 2, 3, 16, 26, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(75, 'AKHIRMAN.ARIF', 'AKHIRMAN ARIF', 'AKHIRMAN.ARIF@SIG.ID', '$2y$12$eG1xPOwAAc0wmAYwYwel5esYIxLxs5Hp7v/s7a1aR3fHTtUyIdT7q', 2, 10, 20, 89, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(76, 'AKHMAD.BASTARI', 'AKHMAD BASTARI, ST.', 'AKHMAD.BASTARI@SIG.ID', '$2y$12$V1z/b3xNfklfS/N1vo9xGOXryw5dl22Z.eN.DY44eyUICAOyGSoEu', 3, 0, 59, 136, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(77, 'AKHRILMAN.HASAN', 'AKHRILMAN HASAN', 'AKHRILMAN.HASAN@SIG.ID', '$2y$12$vp/kCUvmeBROn.vHkyMlyOrYV6RBlAd5jdW1FHZfbuDWdI0MAkLiC', 2, 2, 9, 80, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(78, 'AKMAL.4444124', 'AKMAL', 'AKMAL.4444124@SIG.ID', '$2y$12$3sDXAHpICTDcE8O3hJ9yFuqTJZZGZlqbr1okVu602c0cN/0nnPAfG', 2, 7, 18, 47, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(80, 'AKMAL.NURHAKIM', 'AKMAL NURHAKIM', 'AKMAL.NURHAKIM@SIG.ID', '$2y$12$m6vcPt3dOPH2lM15BSj1MOZRh2xjlFUp/R2B5XCmX6nGPeSTzkpI2', 2, 9, 35, 25, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(81, 'AKMAL.3181', 'AKMAL, S. Mn, MM.', 'AKMAL.3181@SIG.ID', '$2y$12$OA/FDBjOs8VT/orfELJuDuL2QQAWn6FFtnW3vBz9qmEZfH8/vTvPa', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(82, 'AKMAR.SETIADI', 'AKMAR SETIADI', 'AKMAR.SETIADI@SIG.ID', '$2y$12$EDKRWy6i/xXM16jBsNzrxeAhoTGNefoYBXkqG51QE9SlHQfPjaiHy', 2, 10, 44, 118, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(83, 'AL.HARIS', 'AL HARIS', 'AL.HARIS@SIG.ID', '$2y$12$eaxdNjUHn/RxMBzZ6FfD7uuikjXqJBFLnjSnYy8rF4hSSToCJO31a', 2, 11, 23, 92, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(84, 'AL.MUTAKIR', 'AL MUTAKIR', 'AL.MUTAKIR@SIG.ID', '$2y$12$kYLGVp3iSjVKn917h0h7E.gmOx48J7Wy5fUp6Sh4iEQzkPnoM4TS6', 2, 7, 32, 62, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(85, 'ALBANI', 'ALBANI, ST.', 'ALBANI@SIG.ID', '$2y$12$pMmi5hw5AyHW.C8uj1hbL.WqC7rcWPtVXRjn95KuQP0Cc6vDUn5cO', 2, 7, 17, 45, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(86, 'ALBERTHO.SONANDA', 'ALBERTHO SONANDA', 'ALBERTHO.SONANDA@SIG.ID', '$2y$12$hgBWrHnqFATkjTgxxDegueVgmq.nmMZr8IgdRFyyMSEP.P68f31Ya', 2, 7, 33, 39, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(87, 'ALDIWARMAN', 'ALDIWARMAN, ST.', 'ALDIWARMAN@SIG.ID', '$2y$12$OmjuzXuzZ/Xm62G2iiZEKeUgk/W4mZHPmJ8ixg8aKotB928qk47de', 2, 9, 41, 70, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(88, 'ALDRI.SONNI', 'ALDRI SONNI, ST.', 'ALDRI.SONNI@SIG.ID', '$2y$12$PvjZuve6p97Mk.EwQoooB.lJnjP9QSSCfb7nLLBzDbgWWbBbJIIoe', 2, 3, 27, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(89, 'ALEX.ALAMSYAH', 'ALEX ALAMSYAH, S.Pd.', 'ALEX.ALAMSYAH@SIG.ID', '$2y$12$YthU8C5sj/lUU.qMdwoGWewW6Jy/izlmrDWCO9g46o3x.3ctsZMfK', 2, 2, 8, 79, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(90, 'ALEX.PARGA', 'ALEX PARGA', 'ALEX.PARGA@SIG.ID', '$2y$12$zxsbY0jKqf/ioeSBGzyrhOy5DyymIsBl2c6wixtDpk3vB0UCZ.zx6', 2, 9, 41, 28, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(91, 'ALEX.AFRIANTO', 'ALEX SANDER AFRIANTO', 'ALEX.AFRIANTO@SIG.ID', '$2y$12$dU9ZnqX.a3aNy.lJC1DxgOjtWrnoFd7Ni74EaoQQzumQeFiaybjmu', 2, 7, 18, 38, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(92, 'ALEXANDER.DIRGANTARA', 'ALEXANDER DIRGANTARA, S. Kom, SE', 'ALEXANDER.DIRGANTARA@SIG.ID', '$2y$12$u.fb/aeQ8nipkvT2yyNdKu2I/yMDHmfTZJQ0W72ef8D30QUB8sPba', 3, 5, 40, 112, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(93, 'ALFEIN.RAHMAD', 'ALFEIN RAHMAD, ST.', 'ALFEIN.RAHMAD@SIG.ID', '$2y$12$GdaEJQYyDq.1fVR9DiXgl.Owc8ngiQV/nGfTrRvxvLfT4hOHv16ZO', 2, 4, 12, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(94, 'ALFET.ILYAS', 'ALFET SIO ILYAS', 'ALFET.ILYAS@SIG.ID', '$2y$12$Pv4JWrCVHK/y6gEQjcN5Q.wiF/9K5YLVJxyEV5Bo3XqjQ/jJirZmK', 2, 9, 41, 56, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(95, 'ALFIANDO', 'ALFIANDO', 'ALFIANDO@SIG.ID', '$2y$12$ny.FX5Cpb9TFxiYvfPDf6eTRRUBZeWXws0TnRM29zJuJRfH1m69/C', 2, 7, 33, 67, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(96, 'ALFIANSYAH.PUTRA', 'ALFIANSYAH PUTRA, S.Si.', 'ALFIANSYAH.PUTRA@SIG.ID', '$2y$12$2C.7RKkdWAuea2kR9NSkm.Y/K5WjPkU6cEyvguk4XMB5HhciwA5Qa', 2, 10, 46, 125, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(97, 'ALFRED.RUSLI', 'ALFRED RUSLI, ST.', 'ALFRED.RUSLI@SIG.ID', '$2y$12$h3REIEerGXFAce.WFolmuu0l2n/WEWlHGUAeiVn4YZLBu7hTIT.Ua', 1, 1, 15, 134, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 21:14:44'),
(98, 'ALGAZALI', 'ALGAZALI, ST.', 'ALGAZALI@SIG.ID', '$2y$12$oth2vTAARJWyEjdxxoY/oOSXMi9H/GrSgbYKaPPyDQoikCC.V2XZ2', 2, 10, 20, 89, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(99, 'ALI.AKBAR', 'ALI AKBAR', 'ALI.AKBAR@SIG.ID', '$2y$12$7MXrhYo6wIC11xfhmTPIneSHZGHEFw8XcabnsQJ2yH/Ikb9rMX4sS', 3, 0, 59, 136, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(100, 'ALIF.YUZA', 'ALIF YUZA, S.TP', 'ALIF.YUZA@SIG.ID', '$2y$12$fxcIj6agVzxvt8XmDC1JT.4O4vqq72CircpVPbWJT8wKJqjK9zq.q', 2, 0, 56, 88, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(101, 'ALIT.SEMBODO', 'ALIT SEMBODO, ST.', 'ALIT.SEMBODO@SIG.ID', '$2y$12$zYTZBeNvpVdMp/.9hNg4LuEzrxvpgYp6.sNV7nrffPiLZOaLuh.nW', 2, 7, 18, 47, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(102, 'ALIYA.MAHARANI', 'ALIYA PUTRI RACHMA MAHARANI', 'ALIYA.MAHARANI@SIG.ID', '$2y$12$HBSXIwbw07CNmeGVdkYrnOd1Mm7QhGk0W5aqLSq1DZNCOX/AR2wUm', 3, 6, 28, 99, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(103, 'ALJASMON', 'ALJASMON', 'ALJASMON@SIG.ID', '$2y$12$XF4hjvdSZtLgKntYH8stLuJIGoc2e8arFFCO.CIwaNOU0atMWb15W', 2, 3, 54, 127, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(104, 'ALMAHDI', 'ALMAHDI', 'ALMAHDI@SIG.ID', '$2y$12$uHUtWDNSAn.g0XGNIww7f.BJFAjGgovVFbjMH1CG1hXsMrqb5xqYW', 2, 9, 48, 22, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(105, 'ALMISBACHALFIF.IDRAT', 'ALMISBACHALFIF IDRAT', 'ALMISBACHALFIF.IDRAT@SIG.ID', '$2y$12$sA1x/npfrqeHrt4OrBgxQOywUf1j6poVmLm2k9Z4rLG/BXuiA8f36', 2, 11, 45, 121, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(106, 'AMIR.HAMZAH', 'AMIR HAMZAH', 'AMIR.HAMZAH@SIG.ID', '$2y$12$YbCjvX8BQfBDzAJQpNFQaubhZ6yYJCYR6nlAqGT1UGe581MP3gUGO', 3, 6, 26, 114, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(107, 'AMRI.NASUTION', 'AMRI YUSRAN NASUTION', 'AMRI.NASUTION@SIG.ID', '$2y$12$6kS5PF7tHpxlfB/RlOMUbeOWB3dz0gzWNbBOhXxpgl4j3v9Vnjx5a', 1, 1, 55, 129, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(108, 'AMRIL.NURMAN', 'AMRIL NURMAN', 'AMRIL.NURMAN@SIG.ID', '$2y$12$fHYggsb4tM73OzfuzbhMk.UZ8iagQNnX3n7dJwRkm54WK.GlqSuOS', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(109, 'AMRIZAL.3243', 'AMRIZAL', 'AMRIZAL.3243@SIG.ID', '$2y$12$tX7Va6sB7UxBFMy5Y4RpauDg6mANy8R4P2RmXnv3hgEcusm0HIwoG', 2, 7, 32, 43, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(111, 'AMRULLAH', 'AMRULLAH', 'AMRULLAH@SIG.ID', '$2y$12$uXcfRuVFRj4HdYbmV95et.FGAaR9cl.FY/7iHyWF3xvvcfAdSn/Ky', 1, 12, 50, 11, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(112, 'AMRULLAH.RANGKUTI', 'AMRULLAH RANGKUTI, ST.', 'AMRULLAH.RANGKUTI@SIG.ID', '$2y$12$EGO8GISa0KleTTcCUZpuyuLSZf8/unRj3mDTCwhY0tJqJDJnCoPBa', 2, 0, 56, 88, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(113, 'AMY.MARTHA', 'AMY LA MARTHA', 'AMY.MARTHA@SIG.ID', '$2y$12$ZqwUvd3jA51PM5FT81op6OBK.9P1StgboO0sfLRYc9b7c4FmER0X.', 3, 5, 6, 90, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(114, 'AN.HARIZAL', 'AN HARIZAL', 'AN.HARIZAL@SIG.ID', '$2y$12$qkYGzdfTldzYGz/h5pDi5eXUgeuJoZQH022WsB4eFfxAy8ZYyxm2S', 2, 7, 30, 101, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(115, 'ANDA.KHARISMA', 'ANDA KHARISMA', 'ANDA.KHARISMA@SIG.ID', '$2y$12$Wc3FbfEMDapvkZm6g.CYk.NmPxDdnXG9UOdWVpXjA0iAtdtVAQDha', 2, 11, 57, 87, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(116, 'ANDHIKA.WIJAYA', 'ANDHIKA MADANG WIJAYA', 'ANDHIKA.WIJAYA@SIG.ID', '$2y$12$aejSn/KSEEW3YnyrMOcFwusI3BkIL6Ocnf/IG1s4XMOy1znLQrkTK', 2, 10, 20, 89, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(117, 'ANDHIKA.RIO', 'ANDHIKA RIO, ST.', 'ANDHIKA.RIO@SIG.ID', '$2y$12$ds6QNwgM1qLAUB.JGUuhp.qwHAUcYF4TtqmBuW6dRjFGbjIIps3Pe', 2, 7, 30, 115, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(118, 'ANDI.PUTRA', 'ANDI PUTRA', 'ANDI.PUTRA@SIG.ID', '$2y$12$i9Ubwc6O/yK8LoJDG9tOAeQPSOKcpHNdQzDNbgX3ju7OFDqi/fH5q', 2, 3, 39, 68, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(119, 'ANDI.PUTRA7517', 'ANDI PUTRA, ST.', 'ANDI.PUTRA7517@SIG.ID', '$2y$12$AbpYccldy.NB2bGf8qPmsOmqVa6elQ8yagn6d4DnejIXrsPowSCsK', 2, 7, 32, 62, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(120, 'ANDRA.NOVENDRI', 'ANDRA NOVENDRI, ST., MM.', 'ANDRA.NOVENDRI@SIG.ID', '$2y$12$pUqHooW3AEcfXTG9emg/YOdb1UraWz6tXeig9R8SvE9IjU3qi/Dz2', 2, 11, 57, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(121, 'ANDRE.OKTARIA', 'ANDRE HERU OKTARIA', 'ANDRE.OKTARIA@SIG.ID', '$2y$12$uG/rqYfwrRHe3d8wN12VXuyVhGrwGv4yN/47lby2/iUzgbOIEoAK2', 2, 10, 46, 125, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(122, 'ANDRE.INDRAGANI', 'ANDRE INDRAGANI', 'ANDRE.INDRAGANI@SIG.ID', '$2y$12$bGJXRhXjxaqdvaVQBLW1aehwayhIVGwh3JvP5K/R1znGpswUkFecG', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(123, 'ANDRE.RIANDA', 'ANDRE PRICO RIANDA, SE.', 'ANDRE.RIANDA@SIG.ID', '$2y$12$5C9rvIiml16DH1ydECYeEux3iR.097dt.uVIvm0O7cu85uYuzuPPO', 2, 9, 35, 52, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(124, 'ANDRI.ADRINAL7502', 'ANDRI ADRINAL', 'ANDRI.ADRINAL7502@SIG.ID', '$2y$12$oAds8UEPvMCeYiI2Pdkite93XjCnQuJzF3RYGNCT6a1.cqt5uEXQS', 2, 9, 48, 20, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(125, 'ANDRI.DAVICI', 'ANDRI JULIANDA DAVICI', 'ANDRI.DAVICI@SIG.ID', '$2y$12$e/v3MJVVVXFdYxKBT5fuKunJLFIeQ8z1iEHQFBumsmYfRxKZV2bHq', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(126, 'ANDRI.NALDI', 'ANDRI NALDI', 'ANDRI.NALDI@SIG.ID', '$2y$12$Unj8JSymtKvhBSZMX5gqmem/fCrXG01lV6WMFOMlSGcI/lJ7goxJO', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(127, 'ANDRI.SUMARLI', 'ANDRI SUMARLI', 'ANDRI.SUMARLI@SIG.ID', '$2y$12$EC1Az9l22.esYzAe.Pk1W.gAHNXqfoaVMAkSfFyzQRa9QayhOihYm', 2, 10, 44, 91, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(128, 'ANDRI.ZULHELMI', 'ANDRI ZULHELMI', 'ANDRI.ZULHELMI@SIG.ID', '$2y$12$tHVo9yMBl1m1ZNoAFuY/KuvXTLiyCrRLsvzwaxpPfWwK3lcIGf61.', 1, 12, 38, 24, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(129, 'ANDRIA.RUKMA', 'ANDRIA RUKMA', 'ANDRIA.RUKMA@SIG.ID', '$2y$12$fd3myinJYX5iCcWvcn.19.LCM9v6601l4uElHVm2Q4TsCwzPqjhwa', 2, 9, 48, 21, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(130, 'ANDRIAS.MAHENDRA', 'ANDRIAS ZAHDI MAHENDRA L, ST.', 'ANDRIAS.MAHENDRA@SIG.ID', '$2y$12$xUAb9vz0jDD4rITRhRjmIeiagmqgVQJv8pdzt.mdQQsaVokK7KVfC', 2, 11, 58, 130, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(131, 'ANDRIKO.PUTRA', 'ANDRIKO PUTRA', 'ANDRIKO.PUTRA@SIG.ID', '$2y$12$Lgx4NKG6yi/PcQTj34BO2e5A4Dv/l72/XRnhHk0/YukoMhEs94MuW', 2, 10, 46, 125, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(132, 'ANDRINALDI', 'ANDRINALDI', 'ANDRINALDI@SIG.ID', '$2y$12$Rmw5.D2aJP5lmliJwIqpNuCc.87hC6XeUMGKWCFOeXoWU.yL3PZJW', 2, 9, 48, 20, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(133, 'ANDY.DANA', 'ANDY RIVA DANA, DR.', 'ANDY.DANA@SIG.ID', '$2y$12$t5QgVILlrWqF//PY2nBSGuSfHCKQ/X6I9XtGraPOjIc/hTxdMV0vG', 2, 0, 56, 72, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(134, 'ANGGA.PUTRA', 'ANGGA DWI PERMANA PUTRA, ST.', 'ANGGA.PUTRA@SIG.ID', '$2y$12$VWxLkioBBiHFS2JxBUPf2uf6HM7We8K1lzWclzsjLrzasVqG0HcvG', 2, 7, 18, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(135, 'ANGGA.HIDAYAT', 'ANGGA FIKRI HIDAYAT', 'ANGGA.HIDAYAT@SIG.ID', '$2y$12$OIVLYlvdvtWbNs05hw1.Q.ukFuvLThY3t/Ic1UVRU9oHrKNnoUZJ.', 3, 5, 22, 77, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(136, 'ANGGA.FULAMDANA', 'ANGGA FULAMDANA', 'ANGGA.FULAMDANA@SIG.ID', '$2y$12$fHEw4KTfq8/qpnfy9akKj.sWAP2n/xZ1vsiKgY2fxOeAHk3I.PLWi', 2, 3, 11, 37, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(137, 'ANGGA.HANDIKA', 'ANGGA HANDIKA', 'ANGGA.HANDIKA@SIG.ID', '$2y$12$oLTXjeeSOkRbNdyiRghPceoGyxn0wBUz2gFtrFz.eATdBWvrt72YS', 2, 9, 48, 23, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(138, 'ANGGA.PERMANA', 'ANGGA PERMANA PUTRA', 'ANGGA.PERMANA@SIG.ID', '$2y$12$aOb3taqqGHMagjtQq5hrPuL78cdkiNOIsfXLSGHJuRKWxcHmpsT4O', 2, 7, 30, 101, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(139, 'ANGGA.RIZANO', 'ANGGA RIZANO, S.S', 'ANGGA.RIZANO@SIG.ID', '$2y$12$uY4ddiGfNdNlRdItdR2R6OAV1cF.uimGbfgc2eIGvCtFlFhwIyiNu', 2, 3, 11, 44, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(140, 'ANGGI.SEPTIANDIKA', 'ANGGI SEPTIANDIKA', 'ANGGI.SEPTIANDIKA@SIG.ID', '$2y$12$FgXFpNhHkThbjkZ79RrwnOYTvXGHIiunOkIl5phNtGA4Vb8tp8pHm', 2, 9, 35, 25, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(141, 'ANHAR', 'ANHAR', 'ANHAR@SIG.ID', '$2y$12$/Axrfm2.dd9v20/rIYXTE.7Yz4kJOSHAwP91cdR9hYd9mgBczk8n6', 1, 12, 52, 13, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(142, 'ANKA.STEFANO', 'ANKA STEFANO, ST.', 'ANKA.STEFANO@SIG.ID', '$2y$12$PHnnxBc/b8z0UCa6cKvk8uS86XEJ1QrJZFTYei.NK6sCN1l55ftoe', 1, 8, 53, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(143, 'ANRI.HAYANTO', 'ANRI HAYANTO', 'ANRI.HAYANTO@SIG.ID', '$2y$12$3WVkMp3aR.NI6ydgLZ3qT.6NVF3q5KcDvO.PcHLTJbYL7x1zajwzK', 3, 5, 22, 133, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(144, 'ANTON.PUTRA', 'ANTON RAHMA PUTRA', 'ANTON.PUTRA@SIG.ID', '$2y$12$MMuwDq8qFb7S9e8D71JKhed9hmfkSGDjqgVV5EBq9zzeBOSY7qmK.', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(145, 'ANTON.WIJAYA5487', 'ANTON WIJAYA', 'ANTON.WIJAYA5487@SIG.ID', '$2y$12$4ulo.iqOy06VU2ntPKh5iutd75m86RA9zjG.n7xs1.soAA.BDTl3.', 2, 7, 18, 66, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(146, 'ANTON.WIJAYA', 'ANTON WIJAYA, SE.', 'ANTON.WIJAYA@SIG.ID', '$2y$12$LOlg1c6ufgWcAuZ09UrmUuL3yCmK1kQkTebdVWLfNlYJu5Vq.Wzgi', 2, 0, 56, 109, 5, 0, 1, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(147, 'ANUGRAH.TRIANTONO', 'ANUGRAH TRIANTONO', 'ANUGRAH.TRIANTONO@SIG.ID', '$2y$12$1a0Z1EAVdorzu.E0b5K3nOggJNAQx.PQLxQoemoz387JY2MouXeVy', 2, 7, 30, 115, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(148, 'APRI.KURNIAWAN', 'APRI KURNIAWAN', 'APRI.KURNIAWAN@SIG.ID', '$2y$12$IJ8T18EYSLJpzLanYBt90Ohtz8Jezme1aQwTBIwrCw9HzwLuihwKy', 2, 7, 33, 39, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(149, 'APRINAL', 'APRINAL', 'APRINAL@SIG.ID', '$2y$12$XRGiqc5FImRTIi5KtWDvMe0Fpa9h7fuAx5Nh9uCeHNENPwoKGpeQm', 2, 3, 11, 44, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(150, 'APRISON.IRSYAM', 'APRISON IRSYAM, SE., Akt., CFP., QWP., M', 'APRISON.IRSYAM@SIG.ID', '$2y$12$Es12JU/Jexppjvcap2cv6u0cyTJmQ1HfmZ3d3Muejee4vPQoaQoBG', 3, 15, 0, 116, 2, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(151, 'APRIYAL', 'APRIYAL, ST.', 'APRIYAL@SIG.ID', '$2y$12$kKHrz8s9qUlkKhjmlno2.eWoSdYf5R9RKGDh2tMeOsLUA0G6AO1Vu', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(152, 'ARAHIM', 'ARAHIM', 'ARAHIM@SIG.ID', '$2y$12$/69DgXrexQhycUlSt..mQeH91l/4irqtAHxsISaZ8PEj6UEmsOiFG', 2, 3, 11, 37, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(153, 'ARDENI', 'ARDENI', 'ARDENI@SIG.ID', '$2y$12$RqycTuIuc7E.JUhaExg8m.OEucPhmhQt7hgNlbHSwKdw5wbEuaPqO', 2, 3, 54, 127, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(154, 'ARDIAN.PUTRA', 'ARDIAN PUTRA', 'ARDIAN.PUTRA@SIG.ID', '$2y$12$nEvkXTidsPg2LhKB5NEej.eAL7GvZ2/FoF0/RTGmOECDmLlGhQTMa', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(155, 'ARDIANSYAH.5788', 'ARDIANSYAH, ST.', 'ARDIANSYAH.5788@SIG.ID', '$2y$12$XAxeNPXeITmiuVgNmTJpHu0Q755435RcAnjQPWCW7ZsCivMW3xuH2', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(156, 'ARDISTAL', 'ARDISTAL, ST.', 'ARDISTAL@SIG.ID', '$2y$12$Zav3ZXbXFFhMoDNsoKnDEeQ3F669EeSBeXl9vJKZRAjH7/AuB9sIK', 2, 2, 9, 117, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(157, 'ARFAN.PUTRA', 'ARFAN ASMARA PUTRA', 'ARFAN.PUTRA@SIG.ID', '$2y$12$9QqMXSP5rnJwxTLrLv/NkeLBxEE8/B2LX9A.MyI0oLOyZla1Ebl3y', 1, 8, 42, 73, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(158, 'ARI.MULIA', 'ARI MULIA', 'ARI.MULIA@SIG.ID', '$2y$12$HNveYpLkNh90zOPZ.OHV4e6cgxP0nt35YnvLdnvOMdNxqRLYjLMyq', 2, 7, 30, 101, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(159, 'ARI.UTAMA', 'ARI SATRIA UTAMA', 'ARI.UTAMA@SIG.ID', '$2y$12$p8Eo8BhOrjiiR966QlyWTeuWlheEnPDE6f1rAZEnrgrxeD761Lem6', 2, 9, 48, 22, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(160, 'ARI.SISWANTO', 'ARI SISWANTO', 'ARI.SISWANTO@SIG.ID', '$2y$12$p7KDePxgXONAgcaHChaTeeqqgTJEuD3jMblcPjLJGEqb4dK/zTw6m', 2, 10, 20, 89, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(161, 'ARI.CIPTA', 'ARI SURYA CIPTA', 'ARI.CIPTA@SIG.ID', '$2y$12$f/DgLC3tjjbW02oX0/4J5ePGcE8iTSBitSv6kUxVW70yO6UI.DqWG', 1, 1, 14, 84, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(162, 'ARIANO.SAPUTRA', 'ARIANO SAPUTRA', 'ARIANO.SAPUTRA@SIG.ID', '$2y$12$xPhYGljLAHRnzlnDRJmOMu/C4xQ4My7UZo6Hcg3PeXWHkj8aNG4/m', 2, 3, 27, 69, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(163, 'ARIANSYAH.PUTRA', 'ARIANSYAH PUTRA, S.Kom.', 'ARIANSYAH.PUTRA@SIG.ID', '$2y$12$QtoABrgvpi3Zrj0ZVqNHNes2HbDuHrqUY54N.1JjbZ8Vci.zP96oq', 2, 10, 44, 118, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(164, 'ARIE.RONALDO', 'ARIE RONALDO ALBERTHA, MT., BCMCP', 'ARIE.RONALDO@SIG.ID', '$2y$12$EzdrZ9PVuzZXDTsY13m4TOQPpNonHvMsiPyJMU73C79VQChPCxQ6O', 3, 0, 34, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 21:24:50'),
(165, 'ARIE.WISMAN', 'ARIE SISWANTO WISMAN', 'ARIE.WISMAN@SIG.ID', '$2y$12$kVqqL4aglpj8/sKJD0yZcuF1ASra35V0Iim5behuh90V4ZKoSXaZu', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(166, 'ARIEF.LAKSANANDO', 'ARIEF LAKSANANDO', 'ARIEF.LAKSANANDO@SIG.ID', '$2y$12$CSV5Rk9prgk7wbDqNPSNjuw7ovZv8KxiSFNVVokQLzJvgddUI3dsm', 2, 7, 33, 39, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(167, 'ARIEF.RAHMAN', 'ARIEF RAHMAN', 'ARIEF.RAHMAN@SIG.ID', '$2y$12$SkxIsfc/9KuSd2VktAroYegIyCfqntMoY6UdoBWWOdvfkELY1XvFW', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(168, 'ARIEF.DASRIL', 'ARIEF RAHMAN DASRIL, ST., MM., IWE.', 'ARIEF.DASRIL@SIG.ID', '$2y$12$PGMZLag74HBK6760Gr5YbuJzSoMr4KB4PMPMdc6IJyKxRKptSOfGi', 2, 7, 33, 39, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(169, 'ARIF.CAHYADI', 'ARIF CAHYADI', 'ARIF.CAHYADI@SIG.ID', '$2y$12$xIWC.PBFojshehZFSzGqz.tZmbRc8YLR8UHw3yBU1zIt5JjL9NM8y', 2, 7, 17, 42, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(170, 'ARIF.KURNIAWAN3682', 'ARIF KURNIAWAN', 'ARIF.KURNIAWAN3682@SIG.ID', '$2y$12$yfYpMUd2JhH/X2XosY2N2uGYOFTAlsIHRgBDBmEtGWsGYnc6noCjW', 2, 9, 48, 23, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(171, 'ARIO.AMRAN', 'ARIO SUMORI AMRAN', 'ARIO.AMRAN@SIG.ID', '$2y$12$5XtJo2/rZeVpYx1ItfyZ4Oc1xgDiv4R1ikP6.PzwBmZuJYpVGZvIy', 2, 9, 41, 56, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(172, 'ARISMAN.AGUS', 'ARISMAN AGUS', 'ARISMAN.AGUS@SIG.ID', '$2y$12$QUsWo.XvD7z8WOwO8.gI5ObyPu9y5fCpFHXVQF4sN31rdn1jLmVrC', 2, 9, 48, 22, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(173, 'ARISTO', 'ARISTO', 'ARISTO@SIG.ID', '$2y$12$K4OmYhOxYrsd8FuBE3KiheI63rgQeZDRMUWCGZ/KeyQcFmLuco1am', 3, 5, 40, 81, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(174, 'ARIYAN.TRISNO', 'ARIYAN TRISNO, ST.', 'ARIYAN.TRISNO@SIG.ID', '$2y$12$6lH9MJCCdJyAr2wD.kU7Je9MqnHOSWcR.7evNT17QRF7pBwZ7y78a', 1, 13, 3, 97, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(175, 'ARIZAL.6773', 'ARIZAL', 'ARIZAL.6773@SIG.ID', '$2y$12$29sAJwi7JDOer3N4L/XnDu5q40JqHkslBr2LurLary6VP0uF0sHvi', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(176, 'ARIZAL.PUTRA', 'ARIZAL PUTRA, SE.', 'ARIZAL.PUTRA@SIG.ID', '$2y$12$2LNhxSbINGBwGEM0MvAwlO0BqhfW5pDyJZvhkP51XsL/fAJleaeYq', 1, 13, 3, 97, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(177, 'ARJUMAIDI', 'ARJUMAIDI', 'ARJUMAIDI@SIG.ID', '$2y$12$255CxJhGtJvp3bC/C0IxOODg3pPQzX/BxqNUtotu3DGuS8tsDe3/6', 2, 7, 18, 63, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(178, 'ARLEN.RISDIAN', 'ARLEN RISDIAN', 'ARLEN.RISDIAN@SIG.ID', '$2y$12$0hpeHoHs/RYGJ6WVleWOluCaUhDXLUY7.Te3ITJCwaqB7cR1NGgD6', 2, 7, 33, 39, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(179, 'ARMAINI', 'ARMAINI', 'ARMAINI@SIG.ID', '$2y$12$hLvUuZn2ON8iQ9yX1cxQdeptlUMD7qoBxUgQiyZ5nx9ONDul/SuPq', 2, 3, 11, 37, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(180, 'ARMANTO', 'ARMANTO', 'ARMANTO@SIG.ID', '$2y$12$NdXzb2yWvZPfS3MevKu7ner1nvW6x/0xi88TFr.VSS.z03whMZmHK', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(181, 'ARMEN.JUNAIDI', 'ARMEN JUNAIDI, ST.', 'ARMEN.JUNAIDI@SIG.ID', '$2y$12$LV12BgQ/VOBhlZhR/lHu1OFhrV4pd2vfupbOQyTRuBCSXTI1LsaOC', 2, 3, 27, 69, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(182, 'ARMUNANTO', 'ARMUNANTO', 'ARMUNANTO@SIG.ID', '$2y$12$tgy1HdRiisu8ZgryZ69xfO1zvVsjUI6hYRTWu2GWif2jemLh1WGPe', 2, 9, 35, 25, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(183, 'ARRI.GAMY', 'ARRI KURNIAWAN GAMY, ST.', 'ARRI.GAMY@SIG.ID', '$2y$12$9/cH/jX5N1a1VPfrSyd.5OkLM65IAoGezNG/uuJaylq5hyfF1NU1G', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(184, 'ARRIJALU.NISA', 'ARRIJALU QAUMIN NISA', 'ARRIJALU.NISA@SIG.ID', '$2y$12$Tt8ET3cFTGXRF6CNNYMTyuZLUXlKsB/BuyDe3cxR6uEctKZR0eH3q', 2, 11, 57, 87, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(185, 'ARRIS.ANDRA', 'ARRIS ANDRA', 'ARRIS.ANDRA@SIG.ID', '$2y$12$v02Iev4Lluak5myJHqmH3OUOknyEFn62IdebcQ/qGf1GOqBVzB.lO', 2, 11, 23, 92, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(186, 'ARRY.ADRYANTO', 'ARRY ADRYANTO, ST.', 'ARRY.ADRYANTO@SIG.ID', '$2y$12$nafmDyd5nLAjn.jSoD1kYOD2QMmo/DcftfOtVW2iscsoEBmNopmH2', 2, 7, 17, 45, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(187, 'ARTAFRI', 'ARTAFRI', 'ARTAFRI@SIG.ID', '$2y$12$4dx7JvPdODe4U1gprtJ1POKG3OVTpJU8uih0fft/o8tRF5TGj4HwO', 2, 2, 9, 80, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(188, 'ARTIS.MUZARBI', 'ARTIS MUZARBI', 'ARTIS.MUZARBI@SIG.ID', '$2y$12$Y/RsaHwRHio5YMBIBJjhEeNdag8kOQbvUmCsNrde2CaIy/9kz1lWW', 2, 11, 58, 130, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(189, 'ASEP.SUPRIATNA', 'ASEP SUPRIATNA', 'ASEP.SUPRIATNA@SIG.ID', '$2y$12$sMLkuuco9xsjzENTMI9hu.y.38FTyzpq5YvN7KhoIubMMMVmtbJc.', 2, 9, 35, 25, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(190, 'ASHANUL.FAJRI', 'ASHANUL FAJRI', 'ASHANUL.FAJRI@SIG.ID', '$2y$12$ig5mq0yMSY6apJ4C9Xa69Ooq3N/4P/AfrVuKXd7lX2P.SJTvPldAm', 2, 9, 36, 105, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(191, 'ASRI.FEBRI', 'ASRI FEBRI', 'ASRI.FEBRI@SIG.ID', '$2y$12$3RL6M.UjJsPN9whqOfn5ku7mleYlLDTSWwOhyCeelKFNzJzqtO2Wy', 2, 7, 18, 66, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(192, 'ASRIL.3066', 'ASRIL', 'ASRIL.3066@SIG.ID', '$2y$12$31RIRyPrDph5t09RdCmdcuN.47ugyYfAf2MTCqyf1cclJiOvkcivC', 2, 11, 5, 137, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(193, 'ASRIL.JONI', 'ASRIL JONI, ST.', 'ASRIL.JONI@SIG.ID', '$2y$12$gWrrvBQFHOhpwLbbsRGZfuzHcCUDz5w2pHpH2bMT2evPPMQGw/8u.', 2, 3, 11, 44, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(194, 'ASRINING.SARI', 'ASRINING SARI, ST.', 'ASRINING.SARI@SIG.ID', '$2y$12$tmNC1ku0jwJASgUyRaTzy.QT/Iruj.qqpOBjALGUrmfAeWIbJELJG', 2, 0, 56, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(195, 'ASTRID.SUDIRMAN', 'ASTRID OLIVIANA SUDIRMAN', 'ASTRID.SUDIRMAN@SIG.ID', '$2y$12$/HW9inQEUDdgSMQX.P/9e.SyHuA4RszKdZAcyQBYt6ouwexvnEw26', 2, 11, 23, 92, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(196, 'ASVINNA.YOLANDA', 'ASVINNA YOLANDA', 'ASVINNA.YOLANDA@SIG.ID', '$2y$12$wSbYzdLEwwbCA.6yfFcnVui2Gt1K1JWMFkGsakvp68ppsTtSMkOPa', 2, 11, 5, 137, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(197, 'ATHARI.PUTRA', 'ATHARI ADI PUTRA, SE.', 'ATHARI.PUTRA@SIG.ID', '$2y$12$WOmVuJJXURa3.nWloVAIBu1L5rK0uo8v/tTfa92OISFTGwYIk4Qbq', 3, 15, 0, 116, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(198, 'ATRI.REZA', 'ATRI REZA, S.Psi.', 'ATRI.REZA@SIG.ID', '$2y$12$Y5xbpKPe.yUCBdZ0PGmrQOvXaZAC72xq7hWQ79jM0HyMuWT0hH1tW', 2, 10, 46, 125, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(199, 'AULIA.ABDI', 'AULIA ABDI', 'AULIA.ABDI@SIG.ID', '$2y$12$LrXBWJ9NffSM2uBOc1N7IuYzqz/ytb1dnQRdYe.iouPDGVARToO8W', 2, 3, 39, 16, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(200, 'AULIA.FAUTHRISNO', 'AULIA EKADANA FAUTHRISNO, Ir., ST.', 'AULIA.FAUTHRISNO@SIG.ID', '$2y$12$F28seqcjNNxLxhGhAmeDEelDVwZChs7R0jcgalzKJzA6EqkkJXdOG', 2, 11, 57, 87, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(201, 'AULIA.YUNAS', 'AULIA KURNIA YUNAS, AMD.', 'AULIA.YUNAS@SIG.ID', '$2y$12$UtNNruswKILZYoU/pkH51.emLNj4JVAtwjAs584CmLDJcG8xVmOay', 1, 13, 3, 97, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(202, 'AULIA.RAHMAN7544', 'AULIA RAHMAN', 'AULIA.RAHMAN7544@SIG.ID', '$2y$12$vKZLzU56tKVG7OkVQ6YKieLp8VCsyitUpExyZ0Q8IJiZ8BAI1Iv/O', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(203, 'AWEL.ADHAR', 'AWEL ADHAR', 'AWEL.ADHAR@SIG.ID', '$2y$12$0PYwJpYUr9FYw.pIlsztlevPjOj6sB9T6NR1xz79OjvS/jt9F9Nbe', 2, 7, 33, 67, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(204, 'AYURE.RATU', 'AYURE SWASTI RATU', 'AYURE.RATU@SIG.ID', '$2y$12$IAdmTQnKiboqLQbnXEoBS.j1nCTaJC0VPpE9BM6q6K15mT5COYLx.', 1, 1, 14, 128, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(205, 'AZE.SYAMARA', 'AZE SYAMARA', 'AZE.SYAMARA@SIG.ID', '$2y$12$mP3bxCyPd4pCyQFyjWfw/eE7OJ7WMZetSF9mRYBtZG51nsdpoV/Xu', 2, 9, 36, 105, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(206, 'AZET.PUTRA', 'AZET PUTRA', 'AZET.PUTRA@SIG.ID', '$2y$12$CiR.rCXSqtRM5zwsv4lRROS8ej3kC6m68GHHU6ImB02QuEtXGAhxi', 2, 11, 58, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(207, 'AZMI.DARWIS', 'AZMI DARWIS', 'AZMI.DARWIS@SIG.ID', '$2y$12$RYp3CW/kTQnNr7FoX5Sg6u4O9joETcBLPioJGgbJRYXPRMTy0jxhW', 2, 3, 11, 44, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(208, 'AZWAR.BAKRI', 'AZWAR BAKRI', 'AZWAR.BAKRI@SIG.ID', '$2y$12$dwjxjbLxpk3pr0BSStOrSe8icCmVmo3gmHNE7dKXxvgjGlYN7C9oi', 2, 9, 48, 20, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(209, 'BAHAGIA.PERNANDES', 'BAHAGIA PERNANDES', 'BAHAGIA.PERNANDES@SIG.ID', '$2y$12$.IqXzZJR/khn6LpE2mFJquJzeWe8UXQSw.Apl4pwVaat/NkCOMzsC', 2, 0, 56, 88, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(210, 'BAHRAIN.SINAGA', 'BAHRAIN BORU SINAGA', 'BAHRAIN.SINAGA@SIG.ID', '$2y$12$jd2cAVp/MbC6ENOPykXsauU4jAp4EQVr5vNQMMLomwSEqxyK2w0Ue', 3, 6, 28, 99, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(211, 'BAKTI.DARMAGUNA', 'BAKTI DARMAGUNA', 'BAKTI.DARMAGUNA@SIG.ID', '$2y$12$979mNXe2hWc0MeOHg3R6L.IS34kfU74In/PIlFU3nvDxbRSU7vciC', 2, 11, 23, 92, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(212, 'BAMBANG.AGUSTIANTO', 'BAMBANG AGUSTIANTO', 'BAMBANG.AGUSTIANTO@SIG.ID', '$2y$12$BX7Fqa45oKn4vC5wwIK1vO5/MGF.cjz6J8avVpe2tJexRvNO9vZqW', 2, 9, 36, 105, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(213, 'BAMBANG.WAHYUDI', 'BAMBANG WAHYUDI', 'BAMBANG.WAHYUDI@SIG.ID', '$2y$12$BGU/bL6Tq7pi/8NB/wLXYOOoRsNPfXOLzERXSlZiXST/CeWPZa5hO', 2, 7, 33, 48, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(214, 'BAROKAH', 'BAROKAH', 'BAROKAH@SIG.ID', '$2y$12$bsNjNTmiRL4KwAzzkP7EoeZI93IavMXYejsPNIaJBiICVMVPM.X6u', 1, 1, 14, 128, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(215, 'BASRIZAL', 'BASRIZAL', 'BASRIZAL@SIG.ID', '$2y$12$wd8.MbDe/T43xsqyPyx3gOzmqqnoJ42uM/ZLvECcWVtuXOPKpRhTe', 2, 9, 36, 106, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(216, 'BAYU.PUTRA4444086', 'BAYU PUTRA', 'BAYU.PUTRA4444086@SIG.ID', '$2y$12$OFBmtm92bE6XbkxnLygHgOvMhGAKdhH5h1UY9Nk6.bVnsoH09lflS', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(217, 'BELLY.BENRO', 'BELLY BENRO, ST.', 'BELLY.BENRO@SIG.ID', '$2y$12$gWMCP/qtSRwbyiD8QtnCo.NTetBaweQhYgT9M4JOwbcaSI6FB6qH6', 2, 7, 33, 67, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(218, 'BENI.SAKTI', 'BENI ALDI SAKTI', 'BENI.SAKTI@SIG.ID', '$2y$12$v7nSOTxwPliJIIDzxRSuderAXJQLBhSZiqpjQF/YzJP/WovD/OWJm', 3, 0, 59, 136, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(219, 'BENIDIKTUS.SALIM', 'BENIDIKTUS ANDREAN SALIM', 'BENIDIKTUS.SALIM@SIG.ID', '$2y$12$6DcPVsw9NhvnEOip9nrDAuNwns71za2YF5lGhaYcs3c.19yOnE68S', 1, 12, 50, 11, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(220, 'BENNY.AFRIZAL', 'BENNY AFRIZAL', 'BENNY.AFRIZAL@SIG.ID', '$2y$12$ghKiWCErUp1wcLyC.UdDNOZYucLW.hMfzbO8.K9MGA6M2IhC0ycUi', 2, 9, 48, 23, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(221, 'BENNY.ARIANTO', 'BENNY ARIANTO, ST.', 'BENNY.ARIANTO@SIG.ID', '$2y$12$qR2ZGv0rV.DrkAj24N7WfeXwu6vjqCxsi5NaETEglrMuUlnBEeDum', 2, 7, 32, 43, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(222, 'BENNY.PUTRA', 'BENNY DWI PUTRA, ST.', 'BENNY.PUTRA@SIG.ID', '$2y$12$zpsABp0lZxkStr/J35NGBu3aEkgnfmVlYIMYTf8QYYUjK5PBaY076', 2, 7, 30, 101, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(223, 'BENNY.SETIAWAN', 'BENNY SETIAWAN', 'BENNY.SETIAWAN@SIG.ID', '$2y$12$TlizogW8z9LwulwMnQYnte/29C7cJnZG0F0j.Cnl4rR5dSauU1mpe', 1, 1, 29, 100, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(224, 'BENY.AGUSRA', 'BENY AGUSRA', 'BENY.AGUSRA@SIG.ID', '$2y$12$Sk8UWmv4Gn089s2mKfAyu.IIs7HZ7G.fJ881xxdVH6uyqSx8ruvhC', 2, 3, 16, 27, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(225, 'BENY.NASRI', 'BENY NASRI', 'BENY.NASRI@SIG.ID', '$2y$12$HmYXg6pfV7AOK0Z255nbS.0YOVfoFotVF/dTKWo9vtBB7erIaxy6W', 2, 10, 43, 83, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(226, 'BERAIS', 'BERAIS', 'BERAIS@SIG.ID', '$2y$12$Kw2c5U2rbKgETV543l6sC.qvkYXvSKo.6yHuEwtLJTQOAlEud42GS', 3, 14, 21, 33, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(227, 'BERNAST.TANAMAL', 'BERNAST TANAMAL', 'BERNAST.TANAMAL@SIG.ID', '$2y$12$57ZnhxRbXeQvrvoS6PY/X.k.iYlshntc0twCpRY4EPp3ArPM4cDsG', 2, 3, 11, 37, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(228, 'BERRY.PRATAMA', 'BERRY PRATAMA, AMD.', 'BERRY.PRATAMA@SIG.ID', '$2y$12$.EXHxTtX1jRqil/eSrBUcu5YtAdj.Ayc43SrRXEUW2f1wAvLlr.bu', 2, 7, 33, 64, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(229, 'BERRY.SYAMTARIKO', 'BERRY SYAMTARIKO, ST.', 'BERRY.SYAMTARIKO@SIG.ID', '$2y$12$FJfiC0CYvbU2en.iZ6YUSOAZM5vwUxxjEsojwleFKFecVHLJ5y9cy', 2, 3, 11, 44, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(230, 'BERTY.AGAMMURA', 'BERTY AGAMMURA, SE.', 'BERTY.AGAMMURA@SIG.ID', '$2y$12$CLrgCxmiRal53YTHGNrrbuAitCHCSeikPirWK8fvXg8fknC/BKlLy', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(231, 'BERVA.LINDO', 'BERVA LINDO, ST.', 'BERVA.LINDO@SIG.ID', '$2y$12$bxH4THidH36/vOO/D0nOBu6mz3T//OMbfkyV5YOl3F9xZAs91npbO', 2, 9, 36, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(232, 'BETA.JAYA', 'BETA ALEX PUTRA JAYA', 'BETA.JAYA@SIG.ID', '$2y$12$RqppyKz68ygGrBBZ1SLJ9.GuaUwYB14Tb0DNsug8zVGDMUPIicgDi', 2, 3, 11, 44, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(233, 'BIMA.PRAKASA', 'BIMA LOVRINO PRAKASA', 'BIMA.PRAKASA@SIG.ID', '$2y$12$e5fwibA63lM/pnBn4AdzzufGp.pfCmSDPmkCPiRBXqiJo90a6HSee', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(234, 'BINTSAR.TAMPUBOLON', 'BINTSAR PARULLIAN TAMPUBOLON', 'BINTSAR.TAMPUBOLON@SIG.ID', '$2y$12$OCUaNelK8GQgoEP7ou6IXO3yAn3q4vuOVUhpkBP3U8CrMPP99dvl6', 2, 9, 48, 23, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(235, 'BOBBI.OKTOBERI', 'BOBBI ASARRI OKTOBERI, AMD.', 'BOBBI.OKTOBERI@SIG.ID', '$2y$12$gv9uGE8jPHvL4tZ3oJw.UOqwfZVcrqWdxX8mT74h5o.ruMzXYWBN.', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(236, 'BOBBY.OSRA', 'BOBBY PUTRA OSRA', 'BOBBY.OSRA@SIG.ID', '$2y$12$/U.k6nelreHrXTcyQRkLUezoR8dSrmq8bE53YnOWJqWdjU2kDDT9C', 1, 1, 14, 95, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(237, 'BOBBY.LATI', 'BOBBY SUHARLAH LATI', 'BOBBY.LATI@SIG.ID', '$2y$12$aJhWMTKr3AMoGTn60/kmJO7Ya/9GC2SVHn/sx/DaKiPy8YM5Hz6mK', 3, 14, 4, 107, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(238, 'BOBBY.WIRDHANA', 'BOBBY WIRDHANA', 'BOBBY.WIRDHANA@SIG.ID', '$2y$12$w8H/7SwSIE8.IiS3/dvQleLMjt7r4d5IjACh6J2WUwLYqKg60e2uK', 2, 7, 33, 67, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(239, 'BRAM.DHANIEL', 'BRAM DHANIEL, ST.', 'BRAM.DHANIEL@SIG.ID', '$2y$12$PzRrh9ttiFXKZy1dFfQ71.SXd3yFktIqU75llNyQXXFRTEIia7fB6', 2, 10, 20, 89, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(240, 'BUDI.CHANDRA', 'BUDI CHANDRA', 'BUDI.CHANDRA@SIG.ID', '$2y$12$iRFvVNz4FCQ1QZPb/YRJ6eravcuCV3yKYwhCOQNQagOrd7iPpihAS', 2, 7, 33, 39, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(241, 'BUDI.CITRA', 'BUDI CITRA', 'BUDI.CITRA@SIG.ID', '$2y$12$Sqf8y2qO7nI6EmvBfN1OteH/gC5vPI/ZayJCeObJGzLZZWSr4x6rm', 2, 11, 5, 137, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(242, 'BUDI.HARTANTO', 'BUDI HARTANTO', 'BUDI.HARTANTO@SIG.ID', '$2y$12$chKXr.jSiiWkVCLNKwNH1eNGRLpVNjpFxS7OCfkvTdtUt7ifQE9Cm', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(243, 'BUDI.KHAIRA', 'BUDI KHAIRA M', 'BUDI.KHAIRA@SIG.ID', '$2y$12$UbNB7hXa9GiVkyULDJklSOJ6Ig5lp0VpQVctLiagQkgUDMARavrM.', 2, 9, 35, 52, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(244, 'BUDI.KURNIA', 'BUDI KURNIA', 'BUDI.KURNIA@SIG.ID', '$2y$12$//QDdzfo1XXhOYRZWEALNOT4uBNp3A02fy7d6Ef6udi70cKRyn7PW', 3, 0, 59, 136, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18');
INSERT INTO `users` (`id_user`, `username`, `nama_user`, `email_user`, `password`, `id_direktorat`, `id_dept`, `id_unit`, `id_seksi`, `role_jabatan`, `can_create_documents`, `is_reviewer`, `is_verifier`, `foto_user`, `role_user`, `user_aktif`, `last_login`, `created_at`, `updated_at`) VALUES
(245, 'BUDI.PUTRA', 'BUDI PUTRA', 'BUDI.PUTRA@SIG.ID', '$2y$12$7zOFDC00yZoqoRVb3zW/qOZ9J89SraKOg4XbYzyhWqgCuy3UtOgW.', 2, 9, 35, 52, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(246, 'BUDI.RAHMAD', 'BUDI RAHMAD, ST.', 'BUDI.RAHMAD@SIG.ID', '$2y$12$Smj3U51ymrIFT9LYnP9q8ekJwYDxzsUeYXkratL08q1MAY5D1S72W', 2, 7, 18, 47, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(247, 'BURMATIAS', 'BURMATIAS', 'BURMATIAS@SIG.ID', '$2y$12$da/VS1REc08tQVsgfq/5nOUgzMe..JyI9k1cCpl18ZV3j3Mchz2YG', 2, 10, 44, 91, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(248, 'BUYUNG.ISMU', 'BUYUNG ISMU', 'BUYUNG.ISMU@SIG.ID', '$2y$12$YDBX3ccSX5dBCS6z0plyOe9OYog2x2YsMAiIS/shDqFCRijlVGb8m', 1, 12, 38, 50, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(249, 'CANDRA.FAUZI', 'CANDRA FAUZI', 'CANDRA.FAUZI@SIG.ID', '$2y$12$zV.sLec.zE.SgMhR9oecjuERkR9tT4B45fJ0Wfh1rMLMinOSQY25S', 2, 9, 48, 23, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(250, 'CANDRA.PURNOMO', 'CANDRA PURNOMO', 'CANDRA.PURNOMO@SIG.ID', '$2y$12$HFkWWLYYB34yaV8Oz3KzZudbL.f5wwZjSX6DsjqiEyJalMSNYBa/6', 2, 7, 17, 35, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(251, 'CEGA.MUSLIM', 'CEGA MUSLIM, S.M.', 'CEGA.MUSLIM@SIG.ID', '$2y$12$siM2bf0chlkSZkA1s1OJJOtOzCZdEBdDM0HzjgpcNzUAAi/kUKoFG', 2, 3, 11, 44, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(252, 'CHAIRUL.AMRI7527', 'CHAIRUL AMRI', 'CHAIRUL.AMRI7527@SIG.ID', '$2y$12$hErs31fC5lVs0/BKze6bFOeYVFgO4IY/vRQExIasrvuZ95OtoTsxO', 1, 12, 38, 65, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(253, 'CHOERUL.AFFANDI', 'CHOERUL AFFANDI', 'CHOERUL.AFFANDI@SIG.ID', '$2y$12$AhKkx9k3Z69OlGK.MlI7F.DWwf0v.OZ2dnGlDeggwpM/nQ9Wl/srK', 2, 3, 54, 127, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(254, 'DAFIT.ZULKIFLI', 'DAFIT ZULKIFLI', 'DAFIT.ZULKIFLI@SIG.ID', '$2y$12$XZ8KbJ6BmdGe/a4oiZYMV.Xoxkxlu/ealg71DpzH3bZfyOM/icFXu', 2, 9, 48, 20, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(255, 'DAHARMAN', 'DAHARMAN', 'DAHARMAN@SIG.ID', '$2y$12$PUrCDNFhsetXklMiwpJiiu.QXnzLUMMEabXsjMRYoElytONCCd4wq', 2, 7, 30, 115, 5, 1, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(256, 'DAINURI', 'DAINURI, SE., MM.', 'DAINURI@SIG.ID', '$2y$12$GGC5oF.129EfWRxwsTGzs.7M42KWIoN2HtuEJ9Yuii3BmCZO293Q.', 1, 12, 38, 24, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(257, 'DALISURYA.PUTRA', 'DALISURYA ANDIOKTIA PUTRA', 'DALISURYA.PUTRA@SIG.ID', '$2y$12$ac/gH.s6JIyWkfuDLVx3nOcy/o2bl3u70PRANduOjtUvHPjNqXDAK', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(258, 'DANI.PUTRA', 'DANI DARMA PUTRA, ST.', 'DANI.PUTRA@SIG.ID', '$2y$12$DcDd1/g4bmnCMgFAScslLuLliVX415hfhrzy8UzKU/7pS3bYSZRWG', 2, 7, 30, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(259, 'DANNY.SATRIA', 'DANNY SATRIA', 'DANNY.SATRIA@SIG.ID', '$2y$12$zjUmo5ZRfRlSnepeLxouNu6xUerer7qNmHtQspNVozUPZ/6qxAh9y', 2, 3, 11, 44, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(260, 'DARMAWEL', 'DARMAWEL', 'DARMAWEL@SIG.ID', '$2y$12$Hldg5x/b/.99KjUa0fgcF.bqviiJGUGwm97YeI.OtqRNklmbq4eOS', 2, 11, 45, 120, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(261, 'DARWAS', 'DARWAS, ST.', 'DARWAS@SIG.ID', '$2y$12$UiNrH1jyz2ZHZIQTLX/wQuA5kLAFAbNWnALlUD2DlNqfwD/u3faXG', 2, 0, 47, 124, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(262, 'DASKI.WANDI', 'DASKI WANDI, ST.', 'DASKI.WANDI@SIG.ID', '$2y$12$i57qoIdx.kV317F7bf1bdOUqecPXWlluWU/dPqj5xS5GagY3xEH3O', 2, 7, 17, 61, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(263, 'DASRIZAL.ASRUL', 'DASRIZAL ASRUL', 'DASRIZAL.ASRUL@SIG.ID', '$2y$12$kbis6Uzf.nAwpONBfS.YQ.0Avox9tGa/ydfyAr7QtbRNQ80KcqBtK', 2, 7, 17, 42, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(264, 'DAVID.APRIYAN', 'DAVID APRIYAN', 'DAVID.APRIYAN@SIG.ID', '$2y$12$SOwAARVeyCoPzX/NilqTOedCr8tYu0qjzA/KIac8ap/VL1//tEPKS', 2, 10, 46, 125, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(265, 'DAVID.MUCHTAR', 'DAVID MUCHTAR', 'DAVID.MUCHTAR@SIG.ID', '$2y$12$2PiB30mxXQMZd7.uPZWiQeEDP.UmWxeza/yKFw4CSqv54a/VXdoWe', 1, 12, 38, 24, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(266, 'DAVID.SAPUTRA', 'DAVID SAPUTRA', 'DAVID.SAPUTRA@SIG.ID', '$2y$12$oUzFodHwLIUqdYdU6Ys.3uN20Rme/1DievBQTk9fYOW7obCcq2WoO', 2, 3, 39, 16, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(267, 'DEBI.SYAHPUTRA', 'DEBI SYAHPUTRA, S.Kom.', 'DEBI.SYAHPUTRA@SIG.ID', '$2y$12$i8BG4BaBkEOGUE5h4jOBFenIh9GjPwoj.cYa5EhBaL8nSwXv5VITu', 1, 8, 42, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(268, 'DECKY.ALATAS', 'DECKY ALATAS', 'DECKY.ALATAS@SIG.ID', '$2y$12$HgXJsjDDnMVn9kMUCoIIEui7oRpPOBVZp/SJKP1LzGc9QQtsY8CD6', 3, 15, 0, 78, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(269, 'DEDDY.DARIS', 'DEDDY M DARIS S. Kom M. Kom', 'DEDDY.DARIS@SIG.ID', '$2y$12$yE4IVSjeG.WhsrMCDuzV2ugo/fj/XtHAA01v7SWUoR5njyci9GVbe', 2, 7, 18, 4, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(270, 'DEDE.PUTRA', 'DEDE SEPTIKA PUTRA, SE', 'DEDE.PUTRA@SIG.ID', '$2y$12$RIAGRcTEAFLfiJ0B86tFLu4TvrtsaLtZyIfna5pvdOr0Wn3hyvTLy', 3, 5, 40, 112, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(271, 'DEDE.WAHYUDI', 'DEDE WAHYUDI', 'DEDE.WAHYUDI@SIG.ID', '$2y$12$9czA1ku3udm927mTwrd.6eOVtExtc0fgv10fHjm30RHmbnDAODt.m', 2, 7, 18, 47, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(272, 'DEDI.YUSRIZAL', 'DEDI ADRIANTO YUSRIZAL', 'DEDI.YUSRIZAL@SIG.ID', '$2y$12$9Af/.FNx8FyNvUTc6l6za.WwLzKCQUnU6wpz27WdXlbAafWUZ9ZVu', 2, 10, 46, 125, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(273, 'DEDI.CHANDRA', 'DEDI CHANDRA', 'DEDI.CHANDRA@SIG.ID', '$2y$12$tPXnWYmmriTc8h25W2sWOuVnTLf2AP3erSd5hk2CE66bcUs/RaWM.', 2, 7, 18, 38, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(274, 'DEDI.HANAFI', 'DEDI HANAFI, ST', 'DEDI.HANAFI@SIG.ID', '$2y$12$Ok0Ml6tz7K.wPOXa4cn4POKU./zjrB.lPoabwfXwyMj9YZ7ahxgRa', 2, 11, 58, 130, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(275, 'DEDI.KURNIA', 'DEDI KURNIA', 'DEDI.KURNIA@SIG.ID', '$2y$12$2zYuv2.hvaB5hPaP/sT5kOao.LwJdj7Sf6/zHEdJ3Be1U0GU9lWT2', 2, 7, 32, 43, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(276, 'DEDI.SILABAN', 'DEDI MEIER SILABAN', 'DEDI.SILABAN@SIG.ID', '$2y$12$Nx8te2XIEg/xEnYFvFk3wexpEWPQ4Ga24j9YOeNeRfZhut2kSjk9u', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(277, 'DEDI.SIDIQ', 'DEDI MUHAMAD SIDIQ, ST., Ir.', 'DEDI.SIDIQ@SIG.ID', '$2y$12$Ysilo02V6kxe3qz8ptlTAOONc5BAI65nteB3nh5MZ2Gx4eIguWBsq', 2, 9, 0, 0, 2, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(278, 'DEDI.SUHENDRI', 'DEDI SUHENDRI', 'DEDI.SUHENDRI@SIG.ID', '$2y$12$bV8v4ThBvGHwZojzCGjmz.luAqJbOCn7d/fGEXaU/N9.t3mqxZroK', 2, 9, 41, 56, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(279, 'DEFRI', 'DEFRI', 'DEFRI@SIG.ID', '$2y$12$Hnqx/DBgvrZ3GgeDxujZCeBFYGF0jqkhDZnfs8CrJJAYLOBrXJw1u', 2, 9, 35, 25, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(280, 'DEFRI.BARLI', 'DEFRI BARLI', 'DEFRI.BARLI@SIG.ID', '$2y$12$O36FwTWiaTbdbpAdSHJYXOkQtG8Ex.T55xmH0VqWUPE1HmuiXgW8G', 1, 12, 38, 50, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(281, 'DEFRIZAL.ZED', 'DEFRIZAL ZED', 'DEFRIZAL.ZED@SIG.ID', '$2y$12$bqi.G7VPyGsf6iQ2KvO3Ue8i8q9xLIM6zovlycwvDL7ed0CpB9P1W', 2, 9, 48, 22, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(282, 'DEKI.HAMDANI', 'DEKI NURKHA HAMDANI', 'DEKI.HAMDANI@SIG.ID', '$2y$12$7JPniqzO4J6KN9jj/327fuErFjkL7Z0WKAOz8UeoRMN/c0VsHvADK', 2, 7, 18, 63, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(283, 'DELFI.NOFRIYENTI', 'DELFI NOFRIYENTI, S.Pd.', 'DELFI.NOFRIYENTI@SIG.ID', '$2y$12$Bq5yOcVG4RD2/pwm0t7mm.3n4g82FK1.eq3mSt3MdcVHDmwIZBVhq', 2, 0, 47, 124, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(284, 'DELFI.SYUKHRI', 'DELFI SYUKHRI, ST.', 'DELFI.SYUKHRI@SIG.ID', '$2y$12$B1PjnBiPyZq9Y3oaO7Qej.j7hie0B.8WNneMjydo9x594sAauy6GO', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(285, 'DELVIYOLDI', 'DELVIYOLDI', 'DELVIYOLDI@SIG.ID', '$2y$12$nt5aw9K0xirBiX.PhlqDsOZrRpJRAZPqjkUi5IIPWzIZy5tZtUtmO', 2, 7, 30, 115, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(286, 'DENI.ZEN', 'DENI ZEN, ST.', 'DENI.ZEN@SIG.ID', '$2y$12$amrHr1gHrMCy.kCcCcbln.WQeogz5f939m7ybG0O4h7uEOzTLVNc6', 2, 11, 23, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(287, 'DENNY.CHANDRA', 'DENNY CHANDRA, ST.', 'DENNY.CHANDRA@SIG.ID', '$2y$12$7TfJibmZggo0sHv9CvZyreZJtFwhQCzcUi73lMo/3Pn8wZaCQ6Lfe', 2, 11, 57, 87, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(288, 'DENY.HILMAN', 'DENY HILMAN', 'DENY.HILMAN@SIG.ID', '$2y$12$o8bCZRRgTfLXSKnVM/guXuPTDYNfo5rDdgUrTWzWBXepSd52UOxGG', 1, 13, 3, 97, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(289, 'DEPI.PUTRA', 'DEPI PUTRA, ST', 'DEPI.PUTRA@SIG.ID', '$2y$12$a8aYyj4dnPw9.zs/JR09SetD4K7rukTGqIOZxLnea8l1.Z9PmOyWG', 2, 0, 47, 124, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(290, 'DERI.AFIANTO', 'DERI AFIANTO', 'DERI.AFIANTO@SIG.ID', '$2y$12$uzoYyj0W2FIvI3owAU8EI.Wrf4a2wKXA3ystJVn/n80zE7PmQsn4K', 2, 3, 7, 14, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(291, 'DERI.PUTRA', 'DERI YUNI PUTRA', 'DERI.PUTRA@SIG.ID', '$2y$12$QWXgC/WzbTukzlvN27XQO.IBj8hSSR1X.s7Rt1wLfwtWGOyRU12KO', 2, 9, 48, 21, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(292, 'DERY.KURNIAWAN', 'DERY KURNIAWAN P, ST., CPLM', 'DERY.KURNIAWAN@SIG.ID', '$2y$12$MzJrqp4hOHl/MKx8K1qRfuPwcnKXZpcWni5EJzLsFKZVMC3BnB7KW', 2, 11, 58, 130, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(293, 'DERY.SUWANDI', 'DERY SUWANDI', 'DERY.SUWANDI@SIG.ID', '$2y$12$OqmbzGrNfy8Zx.BMkFqgBeBomqM.Ydf5ZKdOfSiz4UhgpHHsL8FIG', 2, 7, 17, 45, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(294, 'DESFIRMAN', 'DESFIRMAN', 'DESFIRMAN@SIG.ID', '$2y$12$BK5OtoTprLeXAj4X2NDc4ugQDct2BJXJpY2h9mN2H0NA2UT5lT7cm', 2, 9, 48, 21, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(295, 'DESI.YANTI', 'DESI SRI YANTI', 'DESI.YANTI@SIG.ID', '$2y$12$0sxq0A8NDlRjkIzB5l5ce.eJIq7ZiXt/nwep4R9iD5JJWFZXt4cTS', 1, 1, 15, 34, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(296, 'DESMAN.JARAS', 'DESMAN JARAS', 'DESMAN.JARAS@SIG.ID', '$2y$12$qJc/wtztLhlT2ecfu0Ocy.XqOrt9yW8cxlQZUwpY1F24qnI7x2l9K', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(297, 'DESRIANTO', 'DESRIANTO', 'DESRIANTO@SIG.ID', '$2y$12$e5jHVdC4vg03.8yrotb5VeS0Vi36.Ayy/nozzJfdo9B/aNZqdcE8.', 2, 7, 17, 61, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(298, 'DESRINAL.RIVAI', 'DESRINAL RIVAI, SE., Akt.', 'DESRINAL.RIVAI@SIG.ID', '$2y$12$5xjWNdaqUPK9x8tggR4bredewukCRN4ebas44hwUtlpxv0flC5Zl.', 3, 15, 0, 78, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(299, 'DESRIZAL', 'DESRIZAL', 'DESRIZAL@SIG.ID', '$2y$12$5GjoeFOBsbJuaRnMmRij/uMVlqK/0xGim5TfnDTOPVoaJpAFMyTxq', 2, 7, 30, 115, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(300, 'DEVID.DWIPA', 'DEVID DWIPA', 'DEVID.DWIPA@SIG.ID', '$2y$12$xctZqT6nTC.x.ONMD2uvJOlUaJ2mroX0D.dpnjA4Vsr91ZoiYCEzu', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(301, 'DEVILITO', 'DEVILITO, ST.', 'DEVILITO@SIG.ID', '$2y$12$goOSCyKJZ.SFczoOfrJMhudrH7HIcnQ5nYgiEvrxmpZQwPBw1HnRa', 2, 10, 43, 83, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(302, 'DEVIN.TRIWINATA', 'DEVIN TRIWINATA, SE.', 'DEVIN.TRIWINATA@SIG.ID', '$2y$12$dHFsx8tpu3bG45b.ufxet.Oxp1t86eIVqsVsTg1GOWKsdu3RS8XUO', 1, 12, 49, 75, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(303, 'DEVY.SULASTA', 'DEVY SULASTA', 'DEVY.SULASTA@SIG.ID', '$2y$12$E0TRVLSiKYeBaPP8javmBeYKn17k6..Dig.XHo/sw2c79xeeKkwOW', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(304, 'DEWI.SARI', 'DEWI YULIA SARI', 'DEWI.SARI@SIG.ID', '$2y$12$a7AfYPycZvlthmlNDbzMb.07KxXqGha77gKyCRcPqFBbA4BSfBW5O', 3, 15, 0, 116, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(305, 'DEZI.LOVENDRA', 'DEZI YULI LOVENDRA, ST.', 'DEZI.LOVENDRA@SIG.ID', '$2y$12$Xc1HQ0a80FAqW8D23Lvg2OT6dv1m5bB125w4prtk9y873cSrclu0e', 3, 14, 21, 57, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(306, 'DHIO.ARIDHARMA', 'DHIO ARIDHARMA', 'DHIO.ARIDHARMA@SIG.ID', '$2y$12$e7Gx/f56QIkDYTTGAcqua.dAo6Jm9RWtys0Juy/GEG99g/bQuwVlu', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(307, 'DHONY.TAHAR', 'DHONY TAHAR', 'DHONY.TAHAR@SIG.ID', '$2y$12$YIrdrw2u/GGRPy/3rW.ZH.kNGiPEn0W0AfclKauPSmengyNlHAHRu', 2, 7, 19, 32, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(308, 'DIAN.PRASETYAWAN', 'DIAN EKA PRASETYAWAN, ST.', 'DIAN.PRASETYAWAN@SIG.ID', '$2y$12$zjZ8x1j.A3rsrbM9zbRRzOnEiMX/EEsQM.8ATgBP/s2cFD.MYDlf.', 2, 11, 58, 130, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(309, 'DIAN.HANDRIKO', 'DIAN HANDRIKO', 'DIAN.HANDRIKO@SIG.ID', '$2y$12$sb50B3P5f1PhQua6T80z5.9RLzdLR94ESFA1YtgtArsE4es9asYfe', 2, 9, 48, 21, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(310, 'DIAN.WAHYUDI', 'DIAN WAHYUDI, ST.', 'DIAN.WAHYUDI@SIG.ID', '$2y$12$iPFtoDZ3rq963vHGfpdH4OleBZD2L1kHCiyKMl01QOVQ9ssexIsya', 2, 11, 45, 123, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(311, 'DIANA.ERAWATI', 'DIANA ERAWATI', 'DIANA.ERAWATI@SIG.ID', '$2y$12$8EHzYJ33OqM5KutW2XE7r.Z4B/RxuejvOa7BMvGVeUoMXnSTOvL7q', 1, 1, 14, 128, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(312, 'DICKY.GUSRIADI', 'DICKY GUSRIADI', 'DICKY.GUSRIADI@SIG.ID', '$2y$12$qV2WCX4hxEPsnoEY.Rhwv.sG.cfsw8cFWdsrQuJwuy2pnz8XHYctS', 2, 10, 43, 83, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(313, 'DIDA.EFFENDI', 'DIDA EFFENDI', 'DIDA.EFFENDI@SIG.ID', '$2y$12$rtJ6xxT/OaSnS/DBKpYhC.jcTouEElvNxUWu56/zadFaWZamJuFUO', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(314, 'DIDI.KURNIADI', 'DIDI KURNIADI', 'DIDI.KURNIADI@SIG.ID', '$2y$12$za/OqXMn8A8C4bCYfqwIK.imZEHo01RWlgcon1mZl1pJ3qltVZ81q', 2, 7, 33, 48, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(315, 'DIDI.KURNIAWAN', 'DIDI KURNIAWAN', 'DIDI.KURNIAWAN@SIG.ID', '$2y$12$enYEUd6ncjuMBtWh99VEYOyBjpWaOvjXKkQpKYtfJVlHtFE3QL/iS', 2, 9, 48, 23, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(316, 'DIDY.PRAWIRA', 'DIDY PRAWIRA', 'DIDY.PRAWIRA@SIG.ID', '$2y$12$8Sfg8tDaSoqXmo/GXMdK2.QxcO65UoAFFAbY/uasZiPn0qyk2MDwe', 2, 7, 32, 62, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(317, 'DIKO.SUSANTO', 'DIKO SUSANTO', 'DIKO.SUSANTO@SIG.ID', '$2y$12$WT5bKNysYeB0f9mCQIWvoONuwkt.KcMCu7fmcxVFHDQcXgeKtnERW', 2, 9, 36, 105, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(318, 'DINA.ARMIDYA', 'DINA ARMIDYA, SE.', 'DINA.ARMIDYA@SIG.ID', '$2y$12$83/4JfbkoNefsvyz8Ai3D.gAFFUGCjtxs0za.4dTs0b9aI0z1AJGm', 1, 1, 14, 84, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(319, 'DINAN.ISLAMI', 'DINAN ISLAMI', 'DINAN.ISLAMI@SIG.ID', '$2y$12$3SXuWfBP6GfFPs629sW0Duxt12WXIeRiUXqxvKNOp7UF9NwpMXMXe', 3, 6, 26, 113, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(320, 'DION.PERDANA', 'DION WYASTA PERDANA', 'DION.PERDANA@SIG.ID', '$2y$12$8TmP8m/fnUyLO08RlSY2yuvmNz2q4Pa63dLLAkN2uHyu05ld3jiFK', 1, 1, 15, 119, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(321, 'DOAN.TRIMORA', 'DOAN CARLO TRIMORA, S.M.', 'DOAN.TRIMORA@SIG.ID', '$2y$12$1H1jNJYmjBJRz17/zBK4PemkHpcKiqGqFOH2m83pnJ6MjTUmOotGi', 1, 12, 52, 12, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(322, 'DOCHE.DELSON', 'DOCHE DELSON, ST.', 'DOCHE.DELSON@SIG.ID', '$2y$12$9l0mqFx0Hl8Sx3LjMrHoV.EQleqg2WTgXnz6PvwnVD04pkLCztqZa', 2, 10, 20, 89, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(323, 'DODI.HENDRIKO', 'DODI HENDRIKO', 'DODI.HENDRIKO@SIG.ID', '$2y$12$Xlpgs9XfToX9U42on4.bn.Kvk0rPbJ7cNMRM8lJNaxvPFjD9tYLP.', 2, 7, 30, 101, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(324, 'DODI.LIDRA', 'DODI MASTERY LIDRA, ST.', 'DODI.LIDRA@SIG.ID', '$2y$12$8GCgA4xwgzuq3DhQd8BLUurHBC4MV.ZAQMgpXw8W.3NF5kTx6Mm5K', 3, 14, 21, 53, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(325, 'DODI.SUPRIADI', 'DODI SUPRIADI', 'DODI.SUPRIADI@SIG.ID', '$2y$12$zfXBsxXTMdeYjvcoiFi3XuR2rnhAtRoZPDpHxjCcs3RNUOSbGNe4S', 1, 1, 55, 129, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(326, 'DODOI.WINDRA', 'DODOI WINDRA', 'DODOI.WINDRA@SIG.ID', '$2y$12$VPAaklRcc684DmvByTLWBef0djyGhhzj5kWfk3JOAEQyY7AsTgru.', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(327, 'DODY.AFRIADY', 'DODY AFRIADY', 'DODY.AFRIADY@SIG.ID', '$2y$12$L2LY2wQ7vcazoVpt5DS3aOYtLcqwpYwV34CNc7QLGazju3epfeJ0q', 2, 9, 35, 51, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(328, 'DODY.ANDRI', 'DODY ANDRI', 'DODY.ANDRI@SIG.ID', '$2y$12$IPpLDVUNx6RWcxOYbka0su9LY0wCmTqiVfI.A732ecmYyCfVoznPi', 1, 13, 3, 97, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(329, 'DODY.SUNATA', 'DODY SUNATA, ST.', 'DODY.SUNATA@SIG.ID', '$2y$12$GiLMSgYmznSIXETM3MU9buwICtoweh.KLHAMnu5GVS7X3Ee5wVSQi', 3, 15, 0, 116, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(330, 'DOMI.SANDRA', 'DOMI SANDRA', 'DOMI.SANDRA@SIG.ID', '$2y$12$aWKRpyV0Quk174XZlaNca.fmDVJlpv8fzy62mm/ykgsEAbHGOxIoa', 1, 12, 50, 9, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(331, 'DONALD.LUMBANRAJA', 'DONALD T LUMBANRAJA', 'DONALD.LUMBANRAJA@SIG.ID', '$2y$12$Z7jGLiH6V0MfMa5RL//tyu/92mpNxNGkf1J7UqxJ2KESDlo.bee76', 1, 12, 38, 24, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(332, 'DONI.AZANI', 'DONI AZANI', 'DONI.AZANI@SIG.ID', '$2y$12$GPdITRYHHIfmIAg8TeJEJOZg.9JhPBGwdHS4txWVxuGZ9Cg5HR.s.', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(333, 'DONI.DARWIS', 'DONI DARWIS, SE.', 'DONI.DARWIS@SIG.ID', '$2y$12$6lHGbeDAPRpTnitL2S4BEuo9fo2pNYyrigysEqJrbIhTKpCpuFM0y', 2, 3, 39, 68, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(334, 'DONI.MAIZWAR', 'DONI MAIZWAR, ST.', 'DONI.MAIZWAR@SIG.ID', '$2y$12$.4BhVsjsSF2qA6mkt91ZiuTOzgjipibevq6CCgOMn8MSMk9Flvdqi', 2, 2, 9, 117, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(335, 'DONI.SUHARTO', 'DONI SUHARTO', 'DONI.SUHARTO@SIG.ID', '$2y$12$maW5TbStNtEJTtyITVyeb./mAV5lalMrh.wspB68S0Ia6cWjkH1qq', 2, 3, 7, 15, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(336, 'DONI.YULWANDRI', 'DONI YULWANDRI', 'DONI.YULWANDRI@SIG.ID', '$2y$12$i8ad5SOQbE87fCh2cHUV2uA5wVdxgrWNehVzEyPZyVi0zvPtgdckW', 2, 11, 23, 92, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(337, 'DONNA.WIDYASTUTI', 'DONNA WIDYASTUTI, S.Si.', 'DONNA.WIDYASTUTI@SIG.ID', '$2y$12$C.ahYl12QaVh2eKnSzVVvOC/cR4ZMFbZN3l/O7pX.jb0bvLlKAZvG', 3, 6, 26, 114, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(338, 'DONNA.YOLANDA', 'DONNA YOLANDA', 'DONNA.YOLANDA@SIG.ID', '$2y$12$iQZj0f/A3mCtWlUHA7rjkuNGP5GE7gx1arNfU6OLZ6v6qQNmzasKa', 3, 0, 34, 104, 6, 1, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 21:24:50'),
(339, 'DONNI.ANDIKA', 'DONNI ANDIKA', 'DONNI.ANDIKA@SIG.ID', '$2y$12$GdYI56I1wku6UjzB2tt99ePJGOQEIWIagcuoiFtqBgrxOOT.YnoEm', 1, 12, 38, 24, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(340, 'DONNY.IDHAM', 'DONNY ASWIN IDHAM, ST.', 'DONNY.IDHAM@SIG.ID', '$2y$12$vQMf4I9sUoA27ymQ4j1FieD9d6V.Ac06FEL.w2UYKRKgeXbHD9cbu', 1, 12, 49, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(341, 'DONRIZAL', 'DONRIZAL', 'DONRIZAL@SIG.ID', '$2y$12$ujmImbY5kQ6wftGxRs6aje/cELJnczjF7oPGvUXjUOr3xhGzf0Qsm', 2, 10, 43, 18, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(342, 'DONY.MULIA', 'DONY PUTRA MULIA, ST.', 'DONY.MULIA@SIG.ID', '$2y$12$61iq5KX4Kz8yDIAOLm8ZJOErby3LXrb8LSU75g5Lhl.fvYf8xerYO', 2, 7, 18, 38, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(343, 'DORAN.DAMANIK', 'DORAN FRINS BODE DAMANIK, ST.', 'DORAN.DAMANIK@SIG.ID', '$2y$12$QBK6Z0MeOLVAIJ2iWW9yie6VHu.lRjhuqQ2ts3n.v6MWHFJsSgrL.', 2, 3, 16, 27, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(344, 'DORI.FEBRIANTO', 'DORI FEBRIANTO, ST.', 'DORI.FEBRIANTO@SIG.ID', '$2y$12$bg/gM4O37muhi3XHvKJwqexRdrQxcYQjO80swv93l.dqxQodrgRtW', 2, 7, 18, 38, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(345, 'DORISMAN.PUTRA', 'DORISMAN EKA PUTRA', 'DORISMAN.PUTRA@SIG.ID', '$2y$12$G6dvNttAix1UnrVyhy0UWO6HagaKqDrv9dbsgqaLz0bv7IOu2yxzS', 2, 3, 54, 127, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(346, 'DSHAAF', 'DSHAAF', 'DSHAAF@SIG.ID', '$2y$12$gWP7aR2Vlv0.avx5egweNOSJKvWEY9yiTTVEhtu.4icvY9eSw65ge', 2, 11, 23, 92, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(347, 'DWI.ANDIKA', 'DWI ANDIKA, SH', 'DWI.ANDIKA@SIG.ID', '$2y$12$m8a0dDwNPj70AjxxCX5SnOwIfrPMDb7BF22B8C1XVPfZ4i2iGP5RO', 2, 4, 13, 58, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(348, 'DWI.SUKMANADI', 'DWI SUKMANADI', 'DWI.SUKMANADI@SIG.ID', '$2y$12$NTuEU6nMaxvTYbofmkpceudrYAAzt9DvkRxsgWPzSTmp2GaynK5z6', 2, 7, 17, 42, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(349, 'DWITA.LESTARI', 'DWITA SURYANI LESTARI, ST., MT.', 'DWITA.LESTARI@SIG.ID', '$2y$12$iRhOvZjRzGeIjtHm2XNWJOuBz7OKIjeGgqqRuWk1KR8pcgssoFby.', 2, 11, 57, 87, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(350, 'EDI.FAHRIZAL', 'EDI FAHRIZAL, SE.', 'EDI.FAHRIZAL@SIG.ID', '$2y$12$uBgdc/vIJjKuP0JFbT6hn.jrnIWNF9NGOsSnZ76lat62.NWH2vUzq', 1, 1, 14, 95, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(351, 'EDI.KURNIAWAN', 'EDI KURNIAWAN, ST.', 'EDI.KURNIAWAN@SIG.ID', '$2y$12$oLnNE7omAI0ZiolH9Zlm.udfM1zPFKTiX6ap5iCpAAZZ8ABoAM1ym', 2, 7, 18, 38, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(352, 'EDI.ADHA', 'EDI ZULHAJRI ADHA', 'EDI.ADHA@SIG.ID', '$2y$12$009.n10cjM3.tm6UrudIO.Kebjmowf7651hoMuFusM70rPUus2YVO', 2, 7, 32, 36, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(353, 'EDIA.UTAMA', 'EDIA SURYA UTAMA', 'EDIA.UTAMA@SIG.ID', '$2y$12$zbpCHY213.P2JRFaicCmfeLeAhJVxiocLxnt9hMb51ucTKpJSS.H.', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(354, 'EDIWANTO.MALSI', 'EDIWANTO MALSI', 'EDIWANTO.MALSI@SIG.ID', '$2y$12$v1UtPuuvlGLzZVgkSKZR/ej/xoymknDNslvVNgi/p0ApcrNoZxxd6', 2, 7, 32, 46, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(355, 'EDO.FEBRIANTO', 'EDO FEBRIANTO', 'EDO.FEBRIANTO@SIG.ID', '$2y$12$A7JY3SXw7DfRmxQ6XpAW3OYdwy1DFVThIPUa77XzvvCzvX0h93SJK', 2, 9, 36, 106, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(356, 'EDWARD', 'EDWARD', 'EDWARD@SIG.ID', '$2y$12$lFsdZOrHuzpS5mJGidQ56ON5oquIxnwYRq8nFbXXujPqxWn2MdRDW', 2, 7, 17, 61, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(357, 'EDWIN.3152', 'EDWIN, SE., Akt.', 'EDWIN.3152@SIG.ID', '$2y$12$8wGa.URVtM3XJz6aSuvXwO.4gMY1MV8t1t3Jvx.6RIGVXIoQvmf4S', 3, 5, 40, 112, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(358, 'EDY.SURYANTO', 'EDY SURYANTO', 'EDY.SURYANTO@SIG.ID', '$2y$12$34GrtzZ0FBP0XqB2cDC0EuOoiEwV.hErt5WghgNFlMO2f3sfiFlHO', 2, 9, 48, 22, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(359, 'EFFENDI', 'EFFENDI', 'EFFENDI@SIG.ID', '$2y$12$w3GD7qb9liQfm2JThGerA.UHj.3UEzN9eZw84JRdmcH8sXrKztqnG', 2, 3, 11, 44, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(360, 'EGA.YANITRA', 'EGA GIOVANNI YANITRA, ST.', 'EGA.YANITRA@SIG.ID', '$2y$12$UZfxVOr1bfSHIo4iUgjFGunNyFgVVudgjzZcuX46GYX2pJy18IKmO', 2, 7, 17, 45, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(361, 'EGA.RENALDO', 'EGA RENALDO', 'EGA.RENALDO@SIG.ID', '$2y$12$snqosuwUBTcjltU7kDKfo.sH02BKMFhDQJFiVdzlc8VX0Fj92puXG', 2, 7, 33, 39, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(362, 'EKA.PUTRA', 'EKA PUTRA', 'EKA.PUTRA@SIG.ID', '$2y$12$WQAFMfyQDvXZvrXPe1pLt.HeydhXEt7PH1igFzUd2HomEB48E9Wt.', 2, 9, 35, 52, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(363, 'EKA.SYAHRAVI', 'EKA SYAHRAVI', 'EKA.SYAHRAVI@SIG.ID', '$2y$12$/XvqD10/9kTZD5lIuN29X.8fwancwSG1yirZ0bO5WxMKyP6Jae8Ye', 2, 9, 35, 51, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(364, 'EKI.DESRIZAL', 'EKI DESRIZAL', 'EKI.DESRIZAL@SIG.ID', '$2y$12$GWfHF6PjsftL6.DQXMLAd.ofVi9W/wElStNoSmTDSpVMRGGmmoC.W', 2, 7, 30, 102, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(365, 'EKO.MARTHA', 'EKO AD MARTHA, ST.', 'EKO.MARTHA@SIG.ID', '$2y$12$XKu439v4yawXyQD41ZzgJ.wsRF/WzCsyEh.f0QsKupVPdB29O5d0O', 2, 2, 8, 79, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(366, 'EKO.HARDIYANTO', 'EKO HARDIYANTO', 'EKO.HARDIYANTO@SIG.ID', '$2y$12$JzjKQ74l8Gz3tnx/1aClXe6oc7e76iJuBXJ83mLzWwpvxRKvrYmIC', 2, 3, 39, 68, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(367, 'EKO.PRABOWO', 'EKO PRABOWO', 'EKO.PRABOWO@SIG.ID', '$2y$12$3.WzyOQZIMsWwqJ9cykDvuOecoES4vQD9AyXY9u45hLWBoP1.lwLK', 2, 11, 58, 130, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(368, 'EKO.PUTRA', 'EKO PUTRA', 'EKO.PUTRA@SIG.ID', '$2y$12$w5LIh6hIHV24wbEqIbhMXu0eLIM93WXXilIjmpp8/z3gmyTXOSb6G', 2, 7, 32, 36, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(369, 'EKO.HARAHAP', 'EKO SAPUTRA HARAHAP', 'EKO.HARAHAP@SIG.ID', '$2y$12$3mu1.krERlr7nsH3nLAiMuyzNg5i10gA4y.t9cHgqgUgheidc7PDC', 2, 3, 27, 69, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(370, 'EKO.ADIWIBOWO', 'EKO SARWO ADIWIBOWO', 'EKO.ADIWIBOWO@SIG.ID', '$2y$12$P6mzhVTIouC1I9gau5bJ7.L4/gOfxTaU.ypp7OHTRfF4rGKFVGrWG', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(371, 'EKO.SAPUTRA', 'EKO TRI SAPUTRA', 'EKO.SAPUTRA@SIG.ID', '$2y$12$DWrnr6WuEyKVLEilV/4r2uG7sS0o9fP..v2yDsJJhFO2w6NblmSJW', 2, 7, 30, 101, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(372, 'EL.FIRMANSYAH', 'EL FIRMANSYAH', 'EL.FIRMANSYAH@SIG.ID', '$2y$12$DS9amd06OySAUeDA3tpU.unhv6xtCymHiK7470ZwI/LKVDhfUoo66', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(373, 'ELDIS.MURENDA', 'ELDIS MURENDA', 'ELDIS.MURENDA@SIG.ID', '$2y$12$a7qEHLWWFzSfP/MpFE2xue4SmNjGry6LxlWOZsnFnkNEPOci71Pn2', 2, 3, 16, 27, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(374, 'ELMAS.DOPRI', 'ELMAS DOPRI', 'ELMAS.DOPRI@SIG.ID', '$2y$12$9rY0oDCssS7pKMYoB3R3AOhR/8BQ45GFFzpPPbpZE.paO.fVrgZ4e', 2, 0, 47, 124, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(375, 'ELSA', 'ELSA', 'ELSA@SIG.ID', '$2y$12$jZ0R8hGaoYd/R9QwELBvSOYSBOWwRyL.dYiG2FC4pBY2zCpziK.vG', 3, 5, 22, 133, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(376, 'ELVIES.ANTHONY', 'ELVIES ANTHONY, ST.', 'ELVIES.ANTHONY@SIG.ID', '$2y$12$zx1Bv/9dM.4AqZp6lFZveu.j6.Y8qmeGbwchdE.KeOa6woIvEUwh6', 2, 7, 18, 47, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(377, 'EMIL.EFIRSON', 'EMIL EFIRSON', 'EMIL.EFIRSON@SIG.ID', '$2y$12$cSMwaBcaQNm/IClOyhlPhuBM5MuDe5NGZRwyg8kTtq9z/8lB0QHMC', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(378, 'EMIL.RIDHA', 'EMIL RIDHA, ST.', 'EMIL.RIDHA@SIG.ID', '$2y$12$UyiNjqmS5DANyBKLBU89ouTW0KVN73q92HRitXQ4mmru7Jq3VkS4i', 3, 14, 37, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(379, 'ENDI.ALTA', 'ENDI ALTA, Ir., ST., MT., IPM.', 'ENDI.ALTA@SIG.ID', '$2y$12$RfKEf9oj9xldZ51wUTw6XeUilEvLoJwXk/Zdl0Xzs/FeymXydBb4G', 2, 7, 32, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(380, 'ENDRAYANTO', 'ENDRAYANTO, SE., MM.', 'ENDRAYANTO@SIG.ID', '$2y$12$tzD0cQRSSdJaaJx2QxC94OmPYPNdDl/KjQywvOlV4Z.lNBKDmhGGy', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(381, 'ENDRI.NOVAL', 'ENDRI NOVAL', 'ENDRI.NOVAL@SIG.ID', '$2y$12$m4wZqi9kd67.cZSlclukvuDv3pI2a5m18M1aaEndxZFNZruA8N.cy', 2, 7, 33, 67, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(382, 'ENRIZALDI', 'ENRIZALDI', 'ENRIZALDI@SIG.ID', '$2y$12$BuLAJ83Lui89Z/eBeQLz5.lhFOcj8j7m9CJyFkDODgvn.ZyA2NxdS', 2, 3, 39, 49, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(383, 'ERADANTES.PUTERA', 'ERADANTES EKA PUTERA', 'ERADANTES.PUTERA@SIG.ID', '$2y$12$i1zrA2ZWDVkwq1JLSPtazOLCLs6UIKJPfa3Ibva3QvxhT33WSFWp.', 2, 10, 43, 41, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(384, 'ERICK.RINALDO', 'ERICK RINALDO', 'ERICK.RINALDO@SIG.ID', '$2y$12$0FvfleEGyCQFQDmQBtPQDupd2hi.2k0e6udVs0A7DA13tfnQ.7vMe', 2, 9, 48, 20, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(385, 'ERICK.YULIANDRA', 'ERICK YULIANDRA', 'ERICK.YULIANDRA@SIG.ID', '$2y$12$Iton/5i0b8/.pBGazk1PRerCVMI3WGjUYWRs0gOW16sLQwz4EMiia', 2, 7, 33, 48, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(386, 'ERIJON', 'ERIJON', 'ERIJON@SIG.ID', '$2y$12$pC1a8/S7GT./ApZCdS9hfeyjGwBUpzSE7iBCG1J.wSJg4KZegeicK', 2, 7, 32, 46, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(387, 'ERIK.PRADIPTA', 'ERIK PRADIPTA', 'ERIK.PRADIPTA@SIG.ID', '$2y$12$csrM0LHDmrE.Ef4/X4ODT.TULtzCgYAhozjjiPkntUKBhLbCzWZuy', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(388, 'ERMANDA', 'ERMANDA', 'ERMANDA@SIG.ID', '$2y$12$94E8ztV1AjbB7/tBRNQdlOoPDJ6XwFC27cJJri509V5BV0ShNLxli', 2, 9, 35, 25, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(389, 'ERWAN.AHYANI', 'ERWAN AHYANI', 'ERWAN.AHYANI@SIG.ID', '$2y$12$gZEAoUCTKO.95NP/y0/RTuqSsHV0zTGfRcMFNu69a40Q9/P9mdHIC', 1, 12, 51, 6, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(390, 'ERWIN.5803', 'ERWIN', 'ERWIN.5803@SIG.ID', '$2y$12$fKJdz9p9hVq6ANN736f0geq37CzMWYUSlkEwneRHniDoNnqRwgFli', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(391, 'ERWIN.MAYUNDA', 'ERWIN MAYUNDA, S.Pd.', 'ERWIN.MAYUNDA@SIG.ID', '$2y$12$C03kMyoTcq.HqsyUpZGwouDgpIbO8v/ottXwyK7tnrkB0E8TCM6Sm', 2, 4, 12, 59, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(392, 'ESRON.TARIGAN', 'ESRON TARIGAN, ST., MM.', 'ESRON.TARIGAN@SIG.ID', '$2y$12$b4L.ivH45WPU9WlWaT/yJOibhQo4wMSRPjoXRnxN6h0RI3VPhz4Zq', 2, 7, 17, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(393, 'EVA.FITRIANI', 'EVA FITRIANI', 'EVA.FITRIANI@SIG.ID', '$2y$12$oQalzUCPxCvKG8hHTsYJAeJD/1pR7b2joS4kRGxEgzC8FyworSgbO', 3, 0, 24, 93, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(394, 'EVIT.ARORA', 'EVIT ARORA', 'EVIT.ARORA@SIG.ID', '$2y$12$YKctpViANnlD1QePHpWbK.vX36esJnm61UNDR5K0XFsE..FDTitwi', 2, 11, 45, 122, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(395, 'EVO.ASRAF', 'EVO ASRAF', 'EVO.ASRAF@SIG.ID', '$2y$12$GjdO.H/HfrB/9fp6.B9ZG.Pzo1ii4of13JQAa7BDJRtRTYPAzXARa', 2, 11, 57, 87, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(396, 'EWIN.SAPRIANTO', 'EWIN SAPRIANTO', 'EWIN.SAPRIANTO@SIG.ID', '$2y$12$NhC4lYrQWZHCgOGBKCHYBuNr94HkzQvzlXEXUf8y/F.zm1d66s9G.', 2, 9, 36, 106, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(397, 'FADHLAN.MAULANA', 'FADHLAN MAULANA', 'FADHLAN.MAULANA@SIG.ID', '$2y$12$r3D6chOpPE9HxWlW6UGIlelme4..vuvQxQ8u/1DBsbokfCPBOspI6', 1, 1, 14, 128, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(398, 'FADLI.FANI', 'FADLI FANI', 'FADLI.FANI@SIG.ID', '$2y$12$s8N1BF0xYzvDZajpCu3TEed28BCTU5dZTsHm9FuY/zrKwt./3eowa', 2, 7, 33, 64, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(399, 'FADLY.GUSRIL', 'FADLY GUSRIL, ST., MT.', 'FADLY.GUSRIL@SIG.ID', '$2y$12$J4NhJPZ6zFRVd3OlBhEl9.uHrcpKJF8IRHNQWLhFDn8Xr3uyqMbbS', 2, 11, 23, 92, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(400, 'FAIZ.RAMADANI', 'FAIZ RAMADANI, ST.', 'FAIZ.RAMADANI@SIG.ID', '$2y$12$JGl4UeBFq78kx.5gOLHAH.EwDs2scQ4Lpz5EKuKfAErLEtdeokGK.', 2, 11, 57, 87, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(401, 'FAJAR.RAHMADONI', 'FAJAR RAHMADONI, ST.', 'FAJAR.RAHMADONI@SIG.ID', '$2y$12$wciZXlqVXO1biYFec/l9YeDl7J3kSIVfk7FnX5uD39mCGYgOXK3Zq', 1, 1, 15, 119, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(402, 'FAJRI.RAHMAT', 'FAJRI ARFA RAHMAT', 'FAJRI.RAHMAT@SIG.ID', '$2y$12$yOclEdM35XsFFKPDM5Z3G.iCA9Sl9QkqU1etl5gbf1l2PstL6Hhju', 2, 4, 12, 59, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(403, 'FAJRI.HAKIM', 'FAJRI HAKIM', 'FAJRI.HAKIM@SIG.ID', '$2y$12$SDY7oRNJ4h7v.j/1CA8hYelJB9FpBYGcGZM6fPSP1ar5c7YA2fck6', 2, 7, 18, 38, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(404, 'FAJRI.YANDA', 'FAJRI YANDA', 'FAJRI.YANDA@SIG.ID', '$2y$12$RsqMpxEBQi73JtiSjiwT/.H9LpPPp/qyWCxD2xyq8riKs.1Ixg07G', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(405, 'FAJRY.KURNIAWAN', 'FAJRY KURNIAWAN, S.Pd.', 'FAJRY.KURNIAWAN@SIG.ID', '$2y$12$rZeNXgj72V6CfEDKk4x6yu02oBJ3dgzs6FYRDBFyE85yoSCnlQClC', 2, 9, 36, 106, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(406, 'FAKHRIZAL', 'FAKHRIZAL', 'FAKHRIZAL@SIG.ID', '$2y$12$r5GAWtvqPblM5euLIwk01.BmW6ps.Kmjl5dy6fLxkgF610Nj8KQk2', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(407, 'FAKHROZI.RIZKY', 'FAKHROZI AHMAD RIZKY', 'FAKHROZI.RIZKY@SIG.ID', '$2y$12$u5fYL.LWXSyRI6nJkuAAv.YZX3LrR/EXuSdKFyxczZPsAPiMIs30O', 2, 10, 20, 86, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(408, 'FAMELA.CHANDRA', 'FAMELA CHANDRA', 'FAMELA.CHANDRA@SIG.ID', '$2y$12$NAtkc5jdPsYag8XtVyKH2O1CXXq92sYR3BvJBQuJC9p5L29cEV.me', 3, 5, 6, 135, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(409, 'FANDI.FUADIE', 'FANDI FUADIE, ST.', 'FANDI.FUADIE@SIG.ID', '$2y$12$L5wl7e1ElSi1eknIFPDppuzAig0anIXhZqQS95ee1HTLMdCR33QJa', 2, 7, 18, 63, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(410, 'FANDI.RAHMANDA', 'FANDI RAHMANDA, ST.', 'FANDI.RAHMANDA@SIG.ID', '$2y$12$FkMLloQoQGJ5rAjvlOcgVebLkxXeRgJ3jY.wkNCTNFCU2PCafwJAC', 2, 7, 18, 63, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(411, 'FANNY.FAISAL', 'FANNY FAISAL, SE., MM.', 'FANNY.FAISAL@SIG.ID', '$2y$12$tBL5IIQ7BSntSDejswj4v.P9y1yt155k0PVnClpVq30P7SfJbzJoW', 3, 6, 26, 113, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(412, 'FARDIANTO', 'FARDIANTO', 'FARDIANTO@SIG.ID', '$2y$12$cEcfnDBPoL.1I5ZaL6AhOOhbwI4uS7pezItbI3t1SBYqnpdpliSSC', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(413, 'FARIDA', 'FARIDA', 'FARIDA@SIG.ID', '$2y$12$W2Ae2XDcZIDAPzMQTqpNzOrGM2nJQKJPLEiQ2yUjgHh8PnIDsXvQW', 3, 0, 34, 104, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 21:24:50'),
(414, 'FARIDH.HUSNI', 'FARIDH HUSNI', 'FARIDH.HUSNI@SIG.ID', '$2y$12$7zgnylLGsWo589rvEVvNDeZ14P24SqyUqoMf.Wy8EXDv7zSOBPegu', 2, 7, 33, 67, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(415, 'FARIS.PUTRA', 'FARIS HADI PUTRA', 'FARIS.PUTRA@SIG.ID', '$2y$12$DCaZVj2ckcRWWXjI7o2/teDB3dsFu2ct2ED26KQj./fqJ0Gxt0mfG', 3, 6, 28, 99, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(416, 'FATHUL.MAUSIL', 'FATHUL MAUSIL', 'FATHUL.MAUSIL@SIG.ID', '$2y$12$hzFhiwzQTQ/0MEqo0BwOq..WuVORhuRsEEsMwAq/25cwLxPzt3CZG', 2, 7, 30, 115, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(417, 'FAUZAL', 'FAUZAL', 'FAUZAL@SIG.ID', '$2y$12$5fXbNzCp/FJkIICdO8m5Au8XL7n.ZvGQFdYQ7qhcPpKrBTdv2ZLqa', 3, 5, 22, 77, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(418, 'FAUZAN.SULLIR', 'FAUZAN', 'FAUZAN.SULLIR@SIG.ID', '$2y$12$A5vf9EsLyquWmVQMzKbOHO7Ax2bJ9KhuZzOYTbLylLertku56tuQO', 2, 10, 46, 125, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(419, 'FAUZAN.ARINALDI', 'FAUZAN ARINALDI', 'FAUZAN.ARINALDI@SIG.ID', '$2y$12$17UG3z7oku2DRbSNLbOQR.3zkWJMJ1M8oLlteccx4POejUf7l.G12', 2, 3, 7, 14, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(420, 'FAUZI.HANURA', 'FAUZI HANURA, AMD.', 'FAUZI.HANURA@SIG.ID', '$2y$12$EAiQaye97TXUC.tAfJ6BfOg1zmnFjzVRueYyrx2rG2JrQxR7SZIfu', 2, 10, 46, 125, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(421, 'FAUZIAH.WULANDARI', 'FAUZIAH WULANDARI', 'FAUZIAH.WULANDARI@SIG.ID', '$2y$12$8DF3q8TarL8KmX2Duh4ive2aicmW3etIvoXJG.VoV0r2cZ1kjGarK', 1, 13, 3, 97, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(422, 'FAUZUL.AZIS', 'FAUZUL AZIS S, ST.', 'FAUZUL.AZIS@SIG.ID', '$2y$12$LsBv9ZCTQNb8SEEJjBP7hectZ4UrwYmKGx1elfXlalwo031Q5GdeO', 3, 6, 26, 110, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(423, 'FEBBIE.IRAWADHY', 'FEBBIE YOLANDA IRAWADHY', 'FEBBIE.IRAWADHY@SIG.ID', '$2y$12$JKDR/LsizRyUVDuNkLLPZ.ULk.PcMMAYDkOMiJJsYttIK7s5tXcfq', 2, 10, 44, 91, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(424, 'FEBBY.ZEINDRA', 'FEBBY ARIEF ZEINDRA, SE., MM.', 'FEBBY.ZEINDRA@SIG.ID', '$2y$12$FPApKNIzZDtcQL.wRxryiO7SqIdUHtFyTOjZpdHnB8CU5ALR9Cnwy', 3, 5, 40, 112, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(425, 'FEBBY.RAHMADANI', 'FEBBY RAHMADANI', 'FEBBY.RAHMADANI@SIG.ID', '$2y$12$v.n/KyUBHY27BWYg0aYo2.rR0HFFAyeWy0KzfXLqjCKnk105iNZo2', 1, 13, 3, 97, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(426, 'FEBRI.MAULANA', 'FEBRI MAULANA, S.Si.', 'FEBRI.MAULANA@SIG.ID', '$2y$12$omHEJobWS3bg8RVHcknDG.OtYO.7FgZXWt/4yPT2bGdfJMiHNKobG', 2, 0, 47, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(427, 'FEBRIANTO', 'FEBRIANTO, ST.', 'FEBRIANTO@SIG.ID', '$2y$12$2CKFQFBhBmnhH02hI.3B.uNO3ZMiWMK7ZLN5imIb4hLWkKrvPjGrS', 2, 9, 36, 105, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(428, 'FEBRIANSYAH.D', 'FEBRIYANSYAH', 'FEBRIANSYAH.D@SIG.ID', '$2y$12$tnVKnP16Y80L1t59rjJoWeuYxcsQzcFgXCuXDZGDNBS4WzZChvVZi', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(429, 'FEBRIZON', 'FEBRIZON', 'FEBRIZON@SIG.ID', '$2y$12$BEDipfp4MM4NBmWHGfRwd.mck62VeFZ6L6jWOMcvPUlNrNQ2qm986', 1, 1, 14, 84, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(430, 'FEDLY.RAESA', 'FEDLY RAESA', 'FEDLY.RAESA@SIG.ID', '$2y$12$Mo7VcsUpvfIJrjidH2mD7ebUZTP8QUQpsAafVxDX1GPkn/kWDJItm', 3, 5, 22, 77, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(431, 'FEDRICO.ANDRI', 'FEDRICO ANDRI', 'FEDRICO.ANDRI@SIG.ID', '$2y$12$KBVsBwHcjXppIozZDqPt1.TmK65p7JYudzxOFyhK1ID2VbOnrIER6', 2, 7, 32, 46, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(432, 'FENRA.RIO', 'FENRA RIO', 'FENRA.RIO@SIG.ID', '$2y$12$75zS4wk/adpEqsCGQq5Hu.0PDkuG.rahsCFM1EsEzAtTMwiHExx8K', 3, 14, 21, 30, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(433, 'FERDI.NIKO', 'FERDI NIKO, SE.', 'FERDI.NIKO@SIG.ID', '$2y$12$47vNfCzMBz0yEuJe.XOxNe15/9fzYjA40BhkVpemlTJy5g.wQFfbG', 3, 0, 59, 136, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(434, 'FERDIANTO', 'FERDIANTO', 'FERDIANTO@SIG.ID', '$2y$12$.MSoaV/VJRhJS/dHbPhcPOAJjfRaU4sEByz7kJzjir54r1bC8rVey', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(435, 'FERDY.DINARDO', 'FERDY DINARDO, ST.', 'FERDY.DINARDO@SIG.ID', '$2y$12$uj/7aqJot8J8imzgRgrIC.lUGtOg.IOSGMBDxOplHjvuBNlTHY0Pa', 2, 0, 56, 88, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(436, 'FERDYAN.WINANDA', 'FERDYAN MARTHA WINANDA', 'FERDYAN.WINANDA@SIG.ID', '$2y$12$cv5W5S.yrfxFyuB02xfCqubeVV0st95xvKl706DxfRg0avPDjnfu.', 2, 9, 41, 28, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(437, 'FERI.WIBOWO', 'FERI WIBOWO', 'FERI.WIBOWO@SIG.ID', '$2y$12$r0OLx48bRoZLLKtMfOHq/ed7QIf7N5mkVmXAKGKQolg85RrYIUbJO', 1, 8, 53, 55, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(438, 'FERINALDI', 'FERINALDI', 'FERINALDI@SIG.ID', '$2y$12$sG6fderpTwvH64q13cBkm.Jusay68kjBN.vOjQmYmy9AAQrmzQESS', 2, 10, 44, 91, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(439, 'FERIS.NOVEL', 'FERIS NOVEL', 'FERIS.NOVEL@SIG.ID', '$2y$12$avQSys/WpjlNtywe/D.nWOeyjY.Nhp2KG17vKxwmazg7ApO6QDSki', 2, 7, 18, 38, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(440, 'FERIWARMAN', 'FERIWARMAN', 'FERIWARMAN@SIG.ID', '$2y$12$aoBhxRDuU2RI6NyShh05seMwTmAUaeMIz07OwodYdRlvaa6e3H2fe', 2, 7, 32, 46, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(441, 'FERIZAL', 'FERIZAL', 'FERIZAL@SIG.ID', '$2y$12$tvaZXWMJd1Px.vkEkSHXKOhmRWPLGe8cXABaE1QyO9gXmcQV4ign6', 3, 5, 40, 81, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(443, 'FERNANDA.PUTRA', 'FERNANDA EKA PUTRA, S.Kom.', 'FERNANDA.PUTRA@SIG.ID', '$2y$12$YGPgdJxeeQltHNg7gnT4ceXinCnk1xyvCoA32QEzgI1erqMIOufLq', 2, 0, 56, 109, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(444, 'FERNANDO.COSTA', 'FERNANDO DA COSTA', 'FERNANDO.COSTA@SIG.ID', '$2y$12$LsrSGSlJfjSgPeHfJfAab.y9Z5dPUrqeKp3.aZVffJNInCWtQefIK', 2, 3, 11, 44, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(445, 'FERRY.ANWAR', 'FERRY ANWAR', 'FERRY.ANWAR@SIG.ID', '$2y$12$91IzCbQfw4//448Vic4dx.GJiGfgYQLcLTfHGiHkHd3yLqA//h1z.', 2, 4, 12, 59, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(446, 'FERRY.FERDINAN', 'FERRY FERDINAN', 'FERRY.FERDINAN@SIG.ID', '$2y$12$MmbqBiz3Ns/CUspV7A4ZqeSeiDqsAHEp.p6Pmc9BtaECt8pz/VUMq', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(447, 'FERRY.FUADI', 'FERRY FUADI, S.Kom.', 'FERRY.FUADI@SIG.ID', '$2y$12$s7/Fs.57NyAUI6JQIEzld.SFsee7Q7Y1tuhr368IyCs4fR0ThcWPa', 1, 13, 3, 97, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(448, 'FERY.SARVINO', 'FERY SARVINO, Ir., ST., MT., IPM.', 'FERY.SARVINO@SIG.ID', '$2y$12$u1dZ39EK3Ei3vaFJXhCl4.9.AOwq8LdCWDqkOUGqeQMivdq5rx4iG', 2, 11, 0, 0, 2, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(449, 'FHAJRI.ANANDYA', 'FHAJRI ANANDYA, ST', 'FHAJRI.ANANDYA@SIG.ID', '$2y$12$yzbDn1MEMTHzk5K.fORTkOpOjU3uC7VwICjfO1dzT.2dfX5ZjmsJS', 2, 11, 57, 87, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(450, 'FICHESY.INDRA', 'FICHESY INDRA', 'FICHESY.INDRA@SIG.ID', '$2y$12$w2sihg9VYxkQEmPRqm3iHODrow/WR21xEpLrDuDDrx60rkoKcMpqe', 3, 14, 21, 53, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(451, 'FIDE.ALAM', 'FIDE FIKO ALAM', 'FIDE.ALAM@SIG.ID', '$2y$12$MzLCIzNHJxkjaaYKXIKdKeGq7JOb33W5GBMJJ1x88LmM5oCog209a', 1, 8, 42, 74, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(452, 'FIDRIA.SAPUTRA', 'FIDRIA SAPUTRA', 'FIDRIA.SAPUTRA@SIG.ID', '$2y$12$WFru1kwY9XKPdN2Z6mPaGuH/iljLzjuxr9W8/CBRd3HcuyZagI4YS', 2, 7, 32, 1, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(453, 'FIKRI.ALFATHONI', 'FIKRI ALFATHONI', 'FIKRI.ALFATHONI@SIG.ID', '$2y$12$0MX9X0qoU6AjbEXiTUm.K.8QgcAJVB66YWfqgQH7GMoEn24zNob9W', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(454, 'FIONA.INDRIANI', 'FIONA INDRIANI', 'FIONA.INDRIANI@SIG.ID', '$2y$12$JPF9S5C7Kvtyo4ggvOOaqe5rWkUhpfBHQc8eh8uYd2RYk3vFbYmnK', 2, 0, 56, 72, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(455, 'FIRDAUS.LENIN', 'FIRDAUS', 'FIRDAUS.LENIN@SIG.ID', '$2y$12$7vD9NUpp31SUBR1.pbyi9u3u9A8CubcW8HWBScFL7el1iXzNYZBMC', 3, 14, 21, 33, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(457, 'FIRDAUS.GAFAR', 'FIRDAUS GAFAR, ST.', 'FIRDAUS.GAFAR@SIG.ID', '$2y$12$/wSc7TyM.sr/5eOK.cpNoOmT.G7Z9ewFS63MD0yTA1oF1t4X.xqmC', 3, 0, 59, 136, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(458, 'FIRDAUS.HASNUR', 'FIRDAUS HASNUR', 'FIRDAUS.HASNUR@SIG.ID', '$2y$12$yITecMrfafn88zpQobIkc.gyQN8eGwsOigo93DTLIcWqS9eVB.Rxu', 3, 0, 59, 136, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(459, 'FIRDAUS.RAHMADANA', 'FIRDAUS RAHMADANA', 'FIRDAUS.RAHMADANA@SIG.ID', '$2y$12$96Isezwn8U5Na0RGuxJmuuMbpjfTXP.pvfYgfQ1m3yAEC8rCzimtq', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(460, 'FIRDAUS.HULU', 'FIRDAUS YAMIFATI HULU', 'FIRDAUS.HULU@SIG.ID', '$2y$12$wQGplb3ihNR23ObOygBRJu9oMOFaN0LPdar1KaoihfWT3s5Es./te', 2, 3, 7, 15, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(461, 'FIRMA.DORA', 'FIRMA DORA', 'FIRMA.DORA@SIG.ID', '$2y$12$pCRuMKFiNfptUQLNTfo4Ne0ewoM/nfNuHfAyRbSaa1Gpn53e/8SPW', 1, 12, 38, 65, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(462, 'FIRMA.YUDI', 'FIRMA YUDI', 'FIRMA.YUDI@SIG.ID', '$2y$12$6PrYCZ4qao7z3tyQAlgm.OObkjI3YmZqma/b5KomjDoQjUWmNcWMu', 1, 1, 15, 119, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(463, 'FIRMANSYAH.5564', 'FIRMANSYAH', 'FIRMANSYAH.5564@SIG.ID', '$2y$12$fcta9YL6dDaKG/a4EQp08OLYRRAmNvnEX89Eu9O90rw/ZA25Sb8Zy', 1, 8, 53, 17, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(464, 'FITRI.RAMELIA', 'FITRI RAMELIA', 'FITRI.RAMELIA@SIG.ID', '$2y$12$hQ/FiM4MSbG59cFaqPu4ZeW2fN29t4RuDWrqZBND7GlI.HWK41Up6', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(465, 'FITRI.WATI', 'FITRI WATI', 'FITRI.WATI@SIG.ID', '$2y$12$d9YsDNQnMgi.yQ2.pFvHqOI4ITvSH.LS4MUQa20RA39QZDi3R1Sa6', 1, 1, 14, 128, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(466, 'FRAN.ZAPUTRA', 'FRAN LENDRO ZAPUTRA', 'FRAN.ZAPUTRA@SIG.ID', '$2y$12$PsvhL0DjxE0yawKkMVLhJeoMc27wvRY2CNHZBMwzDf2.3wYANiGjG', 2, 9, 36, 105, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(467, 'FRANSISKO', 'FRANSISKO', 'FRANSISKO@SIG.ID', '$2y$12$f9qoxFvNy8y4kUiSq3Mpye9ziq2aEUeT1Tow1IU.ZuCu2jfm0Xe1C', 2, 9, 36, 105, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(468, 'FREDI.JONAFRI', 'FREDI JONAFRI', 'FREDI.JONAFRI@SIG.ID', '$2y$12$o2fcIoJ.I1Y9ZBMZLG77WuF8eDGKuzV9.VIm3IPZl1v.gSgb93gUK', 3, 0, 24, 93, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(469, 'FREZI.YULILHAMRI', 'FREZI YULILHAMRI', 'FREZI.YULILHAMRI@SIG.ID', '$2y$12$rQkARcO2fx66d3E6JYwad.Mz4ooFScFZ/f/m2DL5SR8AFbgJ34.eK', 2, 3, 11, 44, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(470, 'FRIMATEDDY.SYAFENDRA', 'FRIMATEDDY SYAFENDRA', 'FRIMATEDDY.SYAFENDRA@SIG.ID', '$2y$12$eLnVZMtEjaSfhl6/EjIIL.gEzYL2wXvx957i1EK/S4qteyPoVqctm', 1, 1, 14, 128, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(471, 'FRISCHA.WIJAYANTI', 'FRISCHA WIJAYANTI', 'FRISCHA.WIJAYANTI@SIG.ID', '$2y$12$vAtZA6jUrouVLr2rUrzn9ebLkicgsNuUwXppYlF48npzn7aH0smR2', 1, 8, 42, 74, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(472, 'FUAD.AHMAD7510', 'FUAD AHMAD', 'FUAD.AHMAD7510@SIG.ID', '$2y$12$a3mKUdg4Y.YBThY.HNE33.Ec6YcxGTYgjZ4SClWZ7ECXW1FeRCsmu', 2, 11, 23, 92, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(473, 'FUAD.SANDRO', 'FUAD REZA ALES SANDRO', 'FUAD.SANDRO@SIG.ID', '$2y$12$4eovanVsLmcUc/Sj9aWSnO/8Gxdezl0BRGg5FtkEKMTLSMZ9W47fO', 2, 7, 32, 43, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(474, 'FUADDY.FITRA', 'FUADDY AL FITRA', 'FUADDY.FITRA@SIG.ID', '$2y$12$sQN/9ulHeEIFC.sB8HIaD.JQ/IGUE8ytXEUduzi2nY7bg.fvypzAC', 2, 11, 45, 111, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(475, 'FURQAN.MAKARIM', 'FURQAN FIRMAN MAKARIM', 'FURQAN.MAKARIM@SIG.ID', '$2y$12$wVeswCuI69eQj6IbwNU61eUw7vANK8DtkS3sCTgcIeS0gxzLZhSqu', 1, 8, 53, 55, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10');
INSERT INTO `users` (`id_user`, `username`, `nama_user`, `email_user`, `password`, `id_direktorat`, `id_dept`, `id_unit`, `id_seksi`, `role_jabatan`, `can_create_documents`, `is_reviewer`, `is_verifier`, `foto_user`, `role_user`, `user_aktif`, `last_login`, `created_at`, `updated_at`) VALUES
(476, 'FYOL.LANRY', 'FYOL LANRY', 'FYOL.LANRY@SIG.ID', '$2y$12$isabfABD9BUE772LOMwjO.h9z4dKgxCV2R8g3ZWthrTvkuj.p8MxK', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(477, 'GISTA.PUSKA', 'GISTA HENDRIO PUSKA', 'GISTA.PUSKA@SIG.ID', '$2y$12$HJ8tecW.6dPlzCSOHW8CB.kUEOtY6.jrXwRku.sg0Rv2sY7JyttNy', 2, 9, 35, 51, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(478, 'GITA.FAHLEVI', 'GITA REZA FAHLEVI', 'GITA.FAHLEVI@SIG.ID', '$2y$12$R1lk9ZulgtHSbnVB.ohldO1n.wdezcPjMIkoktRmTl5JO2g145kQ6', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(479, 'GITO.HARITS', 'GITO HARITS, ST.', 'GITO.HARITS@SIG.ID', '$2y$12$ssRGriIBu9kXctHWUeuRPuP/sxOiu3Vbcu769dEn05uQqqr1VkQLK', 2, 2, 9, 80, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(480, 'GUSMAN', 'GUSMAN', 'GUSMAN@SIG.ID', '$2y$12$XGo.lnCx8VyRTv2QjK1GgOCGQC5e/eGAhvKK71cvakdNefvACwopq', 2, 7, 33, 64, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(481, 'GUSMAWARDI', 'GUSMAWARDI', 'GUSMAWARDI@SIG.ID', '$2y$12$pA0LziUuwH2ZOoDnHPSPnOtqCayJTwyYrh4ijbhicwjR06GQAPC5i', 2, 11, 10, 82, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(482, 'GUSNAR.RAMDANI', 'GUSNAR RAMDANI, SE.', 'GUSNAR.RAMDANI@SIG.ID', '$2y$12$m5jCclJ6GZbsi9W62K90p.esnHPkT9X0LZyHJWvBi/I4YGh.udaCS', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(483, 'GUSWANDI7516', 'GUSWANDI', 'GUSWANDI7516@SIG.ID', '$2y$12$0k1Hbmr4EjpA8MjM.6wqpuhlZLgnMvtBYF/MHNFwlTUt5gpubcAxG', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(484, 'GUSWANDI', 'GUSWANDI, ST.', 'GUSWANDI@SIG.ID', '$2y$12$cfDub6cmSX612GMuqOIlTeZIhaikEp9x78kaIf4Zv0ukTVhk.Jcee', 2, 10, 43, 18, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(485, 'HAFIZHAH', 'HAFIZHAH', 'HAFIZHAH@SIG.ID', '$2y$12$kQt5Wm6ECiOE5nmIv.l7qOObUMCzpeUg.0HSg6Q6KhzHwaeppPpBi', 3, 5, 40, 132, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(486, 'HAFNIL', 'HAFNIL', 'HAFNIL@SIG.ID', '$2y$12$xdFmIXpnm/Dzo6ig5sapDum4B2iJTsizBhI6DKjbDt2dygzH.xQGO', 2, 9, 36, 105, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(487, 'HALVIKA.PADMA', 'HALVIKA PADMA', 'HALVIKA.PADMA@SIG.ID', '$2y$12$gWzc8zWJr9C4IsLjN4oP3uo4Dw.Ol9rmCopzNVKmyemz9d5QpnEw2', 2, 3, 11, 37, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(488, 'HAMDAN.HANADHI', 'HAMDAN HANADHI', 'HAMDAN.HANADHI@SIG.ID', '$2y$12$HZHtFVLfOXO3fcpMyeoc3ugLVj9IRBWTT/IFzkkwpdZJbYaPV38lS', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(489, 'HAMDI.AYUSSA', 'HAMDI AYUSSA, ST.', 'HAMDI.AYUSSA@SIG.ID', '$2y$12$RhyvWxPl2yzAV3sMkOUMNuXHpbz3u/YVEUowfyGdApW31IbC3b3Tm', 3, 0, 59, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(490, 'HANGGA.ARIEF', 'HANGGA MAREY ARIEF', 'HANGGA.ARIEF@SIG.ID', '$2y$12$ljiu7yE9iDvNfd/Ecwb4FOdWu3wQJsTQiEVWkeTn7BuECjjnXqpAC', 2, 10, 44, 91, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(491, 'HANIF.MERIZAL', 'HANIF MERIZAL', 'HANIF.MERIZAL@SIG.ID', '$2y$12$H6J74QaAaddL38u/SMEhTOL9/9RqrrczYG/SufcWJzyLybkPT2IDm', 2, 9, 36, 106, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(492, 'HARI.KHAIRUN', 'HARI KHAIRUN SH., SE., MM.', 'HARI.KHAIRUN@SIG.ID', '$2y$12$ZVY/9/Jndia0MiRAmBTWVeMdh1GXrT5d2wxJulA8YliejtlLAtH8K', 1, 12, 52, 12, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(493, 'HARI.SAFUTRA', 'HARI SAFUTRA', 'HARI.SAFUTRA@SIG.ID', '$2y$12$vw1V4ljHG28dUR/Y1xgCJuyXj4TB/1r8Xeihljb1OoA43SSmVBqnm', 2, 10, 46, 125, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(494, 'HARI.PURNAMA', 'HARI SURYA PURNAMA', 'HARI.PURNAMA@SIG.ID', '$2y$12$xZYyIU5lTP8tZ/qZ/wUZNuH0AAkj.nffkGi4bphwQwHt0SDkdnTtO', 2, 10, 46, 125, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(495, 'HARIA.PUTRA', 'HARIA PUTRA', 'HARIA.PUTRA@SIG.ID', '$2y$12$o1GQHb2hkbhEVrILIfB6RuustR276xgbZmlM6vhR7iS4jvsYwn45i', 1, 1, 14, 84, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(496, 'HARIS.BUDIMAN', 'HARIS BUDIMAN', 'HARIS.BUDIMAN@SIG.ID', '$2y$12$gT1wIStsR/TbovSg8wo.D.H4fZG1xGmyii5tbEBZGFJJ.h4NOEKSS', 2, 10, 2, 76, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-26 20:31:41'),
(497, 'HARIYANDA.A', 'HARIYANDA ADILESTAMAN', 'HARIYANDA.A@SIG.ID', '$2y$12$SDb00wGVtGSdlHSRy9WyKuJ3/g..CNw7gdBRGGS3bn3V1opOpIzQS', 2, 3, 11, 37, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(498, 'HARMEN.5577', 'HARMEN, ST.', 'HARMEN.5577@SIG.ID', '$2y$12$cOq61Rl8btG70ja6IYYib.HDVsi2L14m0A26HuYy3IMMrYr/a1Kja', 2, 7, 17, 61, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(499, 'HARMONI', 'HARMONI', 'HARMONI@SIG.ID', '$2y$12$Ayjiaea1yKPk5SayBqJMcOuJ3Wy6QUjjJBwh3aEwiNyUEiVppDMwe', 2, 9, 48, 21, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(500, 'HARRI.KURNIAWAN', 'HARRI KURNIAWAN, ST', 'HARRI.KURNIAWAN@SIG.ID', '$2y$12$zkCneIramTKObiDDAlDkNeZWlSsPKBYDm/C6wl9hK8kCiGBf1yywS', 2, 9, 41, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(501, 'HARRY.ZAMZIBAR', 'HARRY FAJRI ZAMZIBAR, ST.', 'HARRY.ZAMZIBAR@SIG.ID', '$2y$12$G9.XOC8cgwgjb2LGfT3bDOwne7eIpKfqSnsJ6Sn.jav7/9OBgYLW6', 2, 11, 45, 111, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(502, 'HARTO', 'HARTO', 'HARTO@SIG.ID', '$2y$12$oyxSEzOOhPipc3ZoBU2qY./LKV7rMpW5yBVIE.aoZxdX2/FxXjjAm', 2, 7, 17, 61, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(503, 'HARWAN', 'HARWAN', 'HARWAN@SIG.ID', '$2y$12$5XPI6B.vLvMSOgaCvg2.FugJMKqZFpMLswnbWgR2FyX0GsyJbK1Bm', 2, 11, 45, 123, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(504, 'HARY.PUTRA', 'HARY PUTRA', 'HARY.PUTRA@SIG.ID', '$2y$12$S7h51.SckXh0OjV5GLZZ7eyMZsVzZ9QQffy.6ZSNXOgH7hcimZGC.', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(505, 'HASFI.RAFIQ', 'HASFI RAFIQ, ST.', 'HASFI.RAFIQ@SIG.ID', '$2y$12$y.SxUv1abroA.wpCPb3lQexY2QbYhjmN3.1wNY3Wp.J/0vZF0FGYe', 3, 14, 4, 107, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(506, 'HAYATUL.AMALUDDIN', 'HAYATUL AMALUDDIN', 'HAYATUL.AMALUDDIN@SIG.ID', '$2y$12$z9L5e2yBoA2JEkJmPpv/3O5reQTGYzLrkLhTteG0q7UZ63S2dFjNS', 2, 7, 32, 36, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(507, 'HAYATUL.MUTTAQIN', 'HAYATUL MUTTAQIN, SE.', 'HAYATUL.MUTTAQIN@SIG.ID', '$2y$12$Bt1MWIwO2rwVWYPBZn8TLu5wVNYHHM31AFrGEVunCKC4ZKKaQqO8a', 2, 9, 41, 28, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(508, 'HELFANTRI', 'HELFANTRI', 'HELFANTRI@SIG.ID', '$2y$12$QVspS8Yg.UL23/eZPNpDc.WnYNmGH9/y7.SJ2BhLhQn3innSOtTnu', 2, 9, 41, 70, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(509, 'HELMIZAR', 'HELMIZAR', 'HELMIZAR@SIG.ID', '$2y$12$qOJY/7Eh2iFH2z.ENHYgzOooC11wAAHWqTzDHm6yj/YM114c43D0G', 2, 3, 11, 37, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(510, 'HENDKY.PERMANA', 'HENDKY PERMANA', 'HENDKY.PERMANA@SIG.ID', '$2y$12$hA98wKRqNiFU.UzHBU48u.Nooohid8p73ISI2taKSJDMPDMRON1Sa', 2, 4, 13, 60, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(511, 'HENDRA.3318', 'HENDRA', 'HENDRA.3318@SIG.ID', '$2y$12$gGc6hnObr7rQFHRQ9/hXx.w1oq1tSjDUcv2NrBlNSDvOhAGeK4qE.', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(512, 'HENDRA.AGUSMAN', 'HENDRA AGUSMAN', 'HENDRA.AGUSMAN@SIG.ID', '$2y$12$EYOzB6dVi8fnywGgcgxCfuGxrsoVhscTvZcR86a0YQ6P1US4eSYIe', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(513, 'HENDRA.BAYU', 'HENDRA BAYU, ST.', 'HENDRA.BAYU@SIG.ID', '$2y$12$BPMMO1u26IsO/GgDuFSQvefgLFW79PFunftIrFHMO.C0LgMjH8OBG', 2, 7, 0, 0, 2, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(514, 'HENDRA.GUNAWAN', 'HENDRA GUNAWAN', 'HENDRA.GUNAWAN@SIG.ID', '$2y$12$9FhjiZHC4ypT0Hxn3.cHuu03kOZ0Tpz9wG4LDHnxF2BYZL1Q5X.yG', 2, 7, 17, 42, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(515, 'HENDRA.KUSUMA', 'HENDRA KUSUMA', 'HENDRA.KUSUMA@SIG.ID', '$2y$12$d77pq13ZGEcWRVrv6pMQxeyxNDMiYIkrAKWtiOHFMaP/6A0XJwLIi', 3, 0, 34, 104, 5, 0, 0, 0, NULL, 1, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 21:24:50'),
(516, 'HENDRA.SYAHRIZANA', 'HENDRA SYAHRIZANA', 'HENDRA.SYAHRIZANA@SIG.ID', '$2y$12$7X6qEcUXyr7IrCMaSzrFb.UH0VVnUdxBHPNB/.oZ5TQcJpU4wriuC', 2, 0, 47, 124, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(517, 'HENDRA.WAYAN', 'HENDRA WAYAN', 'HENDRA.WAYAN@SIG.ID', '$2y$12$KhoNyt/ZUeVeGAVl0aZnze.fuoRPuoR.Cx2XTC6tMVm1062EHakBG', 2, 9, 36, 105, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(518, 'HENDRA.YUDI', 'HENDRA YUDI, ST.', 'HENDRA.YUDI@SIG.ID', '$2y$12$RZR1DACxByYPu8DVerpWJeiJ7t4Oe68upn0lcu3TY/l1yX6GAzXFq', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(519, 'HENDRATMO', 'HENDRATMO, SH', 'HENDRATMO@SIG.ID', '$2y$12$GzTrEb5ALPFk7OZvfUYSdu3uj8Oc9mrrxfywVuqwdpz9yg9z3fK0e', 1, 1, 55, 129, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(520, 'HENDRI.3059', 'HENDRI', 'HENDRI.3059@SIG.ID', '$2y$12$5I808CQIwazqtrK72mbkBOh96eLAggjayRMvMA6J7QaIiJWZUCRg2', 2, 10, 44, 91, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(521, 'HENDRI.AWALUDDIN', 'HENDRI AWALUDDIN', 'HENDRI.AWALUDDIN@SIG.ID', '$2y$12$CmbU/ZxyrZJpugLrpFDTa.iyC.mHZjpF0pbqh8weIksmU3I7TUYxG', 2, 7, 18, 63, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(522, 'HENDRI.PRIPARIS', 'HENDRI PRIPARIS, ST.', 'HENDRI.PRIPARIS@SIG.ID', '$2y$12$D1slRYFlgh5rVf97CBtySOo97B.xbovPRxOkMTFnK3yqKSnBGSwF2', 2, 9, 35, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(523, 'HENDRI.RISMAN', 'HENDRI RISMAN', 'HENDRI.RISMAN@SIG.ID', '$2y$12$XMKA2wp9v/7ldOKDGhjPO.jC6nBQ48QNSGKRa8ljA7ULTuWJFtclO', 2, 3, 7, 15, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(524, 'HENDRI.SAPUTRA', 'HENDRI SAPUTRA', 'HENDRI.SAPUTRA@SIG.ID', '$2y$12$DwuuK5NQn2sFCj4PmXXEc.awWWanx402q9wfbq72fDF8ly6k9OtsC', 2, 2, 8, 79, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(525, 'HENDRI.SATRIA', 'HENDRI SATRIA', 'HENDRI.SATRIA@SIG.ID', '$2y$12$tA3YwWijAmkefAXpMnYxpenA/ZGelL94dckuN6eCuvWeM8eDrcMca', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(526, 'HENDRI.WEKING', 'HENDRI YANUS WEKING', 'HENDRI.WEKING@SIG.ID', '$2y$12$6FB9TV.68uTqNj0V/suW5OQdgzoqWq2CdYOLVirZ1Fe1ee6mzNjrq', 2, 7, 30, 115, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(527, 'HENDRI.ZALIUS', 'HENDRI ZALIUS', 'HENDRI.ZALIUS@SIG.ID', '$2y$12$YwgdXf65qp8OH.V1GMH6iu2AJW/MhphYYp6Ea1GU3/J9B/4CPon9q', 2, 7, 32, 36, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(528, 'HENDRIANTO', 'HENDRIANTO, ST.', 'HENDRIANTO@SIG.ID', '$2y$12$mo1alwfiR2BV57sN.vPy4eA0Sh8/.XlLWFxkK9xjUhPZ23P/Q/hAa', 3, 0, 59, 136, 4, 1, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(529, 'HENDRIK.ROZA', 'HENDRIK DELA ROZA', 'HENDRIK.ROZA@SIG.ID', '$2y$12$Nu2k1vJdUIyPRKZwNlEkwuS/hutv7aOY8Xjhtnz2mmuBtDgWXwqOO', 1, 1, 14, 128, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(530, 'HENDRIO.HARMEL', 'HENDRIO HARMEL, ST., MT.', 'HENDRIO.HARMEL@SIG.ID', '$2y$12$JMiB58Ifvbe2b9ZI3gxEg./AnaXee9rDxx9g/urmfSXDF4uAZ7O66', 2, 10, 0, 0, 2, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(531, 'HENDRIZAL', 'HENDRIZAL', 'HENDRIZAL@SIG.ID', '$2y$12$ZaXu6h6QF6E1m7G7ks2MjeGikuSPFzftAEb16zZw.RnGknRwEQp.a', 2, 7, 30, 101, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(532, 'HENDRY.SURYA', 'HENDRY SURYA', 'HENDRY.SURYA@SIG.ID', '$2y$12$TcyhvNB4r3.IgsTGBv32ieD9F.wBoa5YVuMOutGo6DJV8uKKoIZ0O', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(533, 'HENGKI.IRAWAN', 'HENGKI IRAWAN', 'HENGKI.IRAWAN@SIG.ID', '$2y$12$do8gsIJ1qyOS6Fa1XkCxEeAMHcG6ogRds01vx90I.goKZIjmN/D.C', 3, 0, 59, 136, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(534, 'HENGKI.JUNAIDI', 'HENGKI JUNAIDI', 'HENGKI.JUNAIDI@SIG.ID', '$2y$12$P2XFOrinPjGDtWqVGS1/HOnVdKH4VlKv2GHlEqPKwiILV9zQgupii', 2, 3, 16, 27, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(535, 'HENGKI.SAPUTRA', 'HENGKI SAPUTRA', 'HENGKI.SAPUTRA@SIG.ID', '$2y$12$uaWfa6AkdrYRwW4IIKTkXerUwxpufVO/NbxxgiHmrGjpOl3yh8cpi', 2, 7, 33, 64, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(536, 'HENGKI.SASTRA', 'HENGKI SASTRA PUTRA', 'HENGKI.SASTRA@SIG.ID', '$2y$12$O2Px9pDpRMrzO0LH48r7RuyfJyrNk5awHUI0NBSTGp7tVoQUf5wGG', 2, 7, 33, 67, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(537, 'HENGKI.SURYADI', 'HENGKI SURYADI', 'HENGKI.SURYADI@SIG.ID', '$2y$12$L5OM3ZnvmEfR5p8t62sdZuA5N5JFr6KbVSgnaoDi0G5mP3cnU1nGK', 2, 7, 17, 35, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(538, 'HENGKI.PUTRA', 'HENGKI YAMA PUTRA', 'HENGKI.PUTRA@SIG.ID', '$2y$12$2LobopmExSqvSNvGlt3m/.tt8n1LFfK500zF/duzhEQZYd63.VpCu', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(539, 'HERA.DWIASTUTI', 'HERA DWIASTUTI', 'HERA.DWIASTUTI@SIG.ID', '$2y$12$tOQwriatBLXLJ202Dt0n8OZx8TzUjQkqZDrUie7zqmJtpeM6pA2fK', 2, 10, 2, 76, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-26 20:31:41'),
(540, 'HERIYANTO', 'HERIYANTO, ST.', 'HERIYANTO@SIG.ID', '$2y$12$s3Kz5QFEHi4ddpA8aaethuERvIwooco2sT0WNODNUpwpxyJznshYu', 2, 10, 43, 83, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(541, 'HERJUN.PRABOWO', 'HERJUN PRABOWO', 'HERJUN.PRABOWO@SIG.ID', '$2y$12$sRC7h2GACzYlFPP2mU5T2.21y/5yZ7Th7rK7EIyKP3PERKNV2LtLC', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(542, 'HERKA.VERNANDA', 'HERKA VERNANDA', 'HERKA.VERNANDA@SIG.ID', '$2y$12$wXV0j3PikRdtOO3Jv1j8jezKnnXai8MmkJxADG6hbG7loJ9zU4T9e', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(543, 'HERLAN', 'HERLAN', 'HERLAN@SIG.ID', '$2y$12$IVhpZk6TC/YKVd3Jppajo.2rG5mGLFFRj9KUU2/0mBC3nPkT7jgCS', 2, 9, 41, 70, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(544, 'HERLIN.VIONA', 'HERLIN VIONA', 'HERLIN.VIONA@SIG.ID', '$2y$12$yr0ZQVRPRxCKdIcFeugP0OCvkAJ21OKG6t8Pdkr.Kc2amY5Ffgqom', 3, 5, 6, 135, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(545, 'HERMAN.3126', 'HERMAN', 'HERMAN.3126@SIG.ID', '$2y$12$tjxNwyOL8nYXkB0qu4TV8OMNI0B1y2C.fuxBmVBtgquDTT28a68qC', 3, 6, 28, 99, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(546, 'HERMANDA.PUTRA', 'HERMANDA EKA PUTRA', 'HERMANDA.PUTRA@SIG.ID', '$2y$12$sf9KWUM7T46eLKABamc4fuLCJExU9Fdf8KEAY1xIV100k.t18S7LK', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(547, 'HERNES', 'HERNES, ST.', 'HERNES@SIG.ID', '$2y$12$yBQ1EkBSRKErOn5rx/.FV.MDEDxBSa/xDuRCgP3oiG6ZMKJmEV0Bi', 2, 11, 5, 137, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(548, 'HERU.SAPUTRA', 'HERU ERTA SAPUTRA', 'HERU.SAPUTRA@SIG.ID', '$2y$12$OCJsrm.c6SBWjwghhAOkWOD1kq8oJh2qOPuaTNGntEzjv0ELesS/C', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(549, 'HERU.SHALLY', 'HERU NURUDIN SHALLY, ST.', 'HERU.SHALLY@SIG.ID', '$2y$12$F/pfitl3hDiIvtymxwGdXubLWZI.eBqaTB1qb70EoGGzsrTznzPOa', 2, 9, 36, 106, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(550, 'HERU.PUTRA', 'HERU PERDANA PUTRA', 'HERU.PUTRA@SIG.ID', '$2y$12$2Yx9G42SzIR7KvlEQuZ.VuwdPiFs5YZ7ovPrr0PkXV5GLXE7UVnYq', 2, 3, 54, 127, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(551, 'HESTY.SARI', 'HESTY FITRIA SARI', 'HESTY.SARI@SIG.ID', '$2y$12$g2mLiPCO2wlx7ohfKplumOW7M30vITyDeeHk86cT366Hv4UXWqWXe', 3, 6, 25, 131, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(552, 'HETLER.NAINGGOLAN', 'HETLER FREDDY NAINGGOLAN', 'HETLER.NAINGGOLAN@SIG.ID', '$2y$12$rLXvQMWPhDydsOgbME6KkeN4bZNQweLVxxFrN8xRCWz6ijQldyU.a', 2, 7, 19, 31, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(553, 'HIDAYATIL.KURNIA', 'HIDAYATIL KURNIA', 'HIDAYATIL.KURNIA@SIG.ID', '$2y$12$drx5QU90HsiNQQr0rvzrE.0Dcm8bnOcEQYbwVK/BtXxMIJ3Sr7K2G', 1, 1, 14, 128, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(554, 'HIPTOP.KHAIRUL', 'HIPTOP KHAIRUL, ST.', 'HIPTOP.KHAIRUL@SIG.ID', '$2y$12$V/ooyPkaTrrXXNTCtySPeuAUi2ASBC8YwuN/o2Ak9eEoGM7JZWjpS', 2, 7, 30, 102, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(555, 'HISKO.ARITIVON', 'HISKO ARITIVON', 'HISKO.ARITIVON@SIG.ID', '$2y$12$QvLMDwr9Kf6jWGQ5jPW36ufXiFrzke1cqLlpb1fW/jEj2YC33pB66', 1, 1, 29, 126, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(556, 'HUSAINI', 'HUSAINI', 'HUSAINI@SIG.ID', '$2y$12$0ZDK3OxjXNGJsRoC9sCaROYJh2LvGjdPweqhfrv1ybr5TYgtEFwmW', 2, 3, 39, 5, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(557, 'IBNUL.GHUFRON', 'IBNUL GHUFRON', 'IBNUL.GHUFRON@SIG.ID', '$2y$12$5YYYnm4.haFCmyofPDOSDuaHnhkqlZ8lC5HjuN5wEYfNWQkKrUWQS', 2, 7, 33, 48, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(558, 'IBRAHIM.HANIF', 'IBRAHIM HANIF, SE.', 'IBRAHIM.HANIF@SIG.ID', '$2y$12$c1m/sR1XDcEGg0ZtvGNXuO0pObqhGvcWMbHsw6Cqk14cFJta.9FM2', 1, 12, 38, 65, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(559, 'IBRAR', 'IBRAR, ST.', 'IBRAR@SIG.ID', '$2y$12$Q3D/8dl.BgvSaJieUMICu.isWCRQUEwrmLkBNgD3JpnNFTEJePwBe', 2, 7, 17, 61, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(560, 'ICHSAN.PUTRA', 'ICHSAN ZUSYA PUTRA', 'ICHSAN.PUTRA@SIG.ID', '$2y$12$8/WkiwR1MAEhQiCWIRTiGOW.VhX4UQKLBA0hrRevExXTQchpK11Eq', 2, 9, 35, 52, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(561, 'IDRIS.4444245', 'IDRIS', 'IDRIS.4444245@SIG.ID', '$2y$12$i/2sFRhMG8GNzOUobA0JSemW5EN.mH5HAgaQvvZuDG7/9nxA.STAq', 2, 7, 32, 36, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(562, 'IDRIS', 'IDRIS, S.Sos.', 'IDRIS@SIG.ID', '$2y$12$M43GMogt8H4qto7Ti/jE8OAw9LD6E4SVTWtE4cZPbIPML2Gq7Dr1a', 1, 1, 15, 0, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(563, 'IFFAH.ILHAMI', 'IFFAH ILHAMI, ST.', 'IFFAH.ILHAMI@SIG.ID', '$2y$12$HdbXYvEDIBEwL2wd0SKJNO6Tq1QJfh9hTF8GYrBkJo99ngisrCJXG', 2, 7, 18, 63, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(564, 'IFFAN.TRI', 'IFFAN TRI FEBRIADI', 'IFFAN.TRI@SIG.ID', '$2y$12$MsonB9UBxgXJwbSjLYD30u5ZtCuPqvJmy2kQzzpFcS0AgmWHA76M2', 1, 12, 38, 24, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(565, 'IFRAN.IFRIANDA', 'IFRAN IFRIANDA', 'IFRAN.IFRIANDA@SIG.ID', '$2y$12$OO2sNUtBz9R8RIkA/1uaHe.EWqrj5bYNUAXRuPkJNh/ySm1lt2w8W', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(566, 'IFZAL', 'IFZAL, ST.', 'IFZAL@SIG.ID', '$2y$12$JYQPYiWtSN.cvmoqFzrfb.hHiTcLDcpE/ygrn2Ba8AJDjpbogWpQm', 3, 14, 21, 57, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(567, 'IHSAN.ALHADI', 'IHSAN ALHADI', 'IHSAN.ALHADI@SIG.ID', '$2y$12$DpugO/bkjRqTwEXFAMN.ye..SqpG7aB7T3nGYwEs4cXt3tpVKks/i', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(568, 'IKA.FITRIANI', 'IKA FITRIANI', 'IKA.FITRIANI@SIG.ID', '$2y$12$cDS28oscTejICa2FPZ3WQ.s8VhmEBzaNzZzzcm73e0/KRr7lOcmMK', 3, 5, 40, 132, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(569, 'IKE.WIYANA', 'IKE EVY WIYANA, S.Si.', 'IKE.WIYANA@SIG.ID', '$2y$12$FcVOHb3PyS96b9vHCzx96uA.r.caZkbf57XbIJ12H0hMrPWpJX9oS', 2, 10, 46, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(570, 'IKHSAN.KAMIL', 'IKHSAN KAMIL', 'IKHSAN.KAMIL@SIG.ID', '$2y$12$ZKEKGKRi32FfPaE1/WI5/epaZ8pw2JWyqPm9Hqpu3/6V6PJXB3pPa', 2, 7, 17, 42, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(571, 'IKHSAN.PURNAMA', 'IKHSAN PURNAMA, ST., MT.', 'IKHSAN.PURNAMA@SIG.ID', '$2y$12$IhzUiYpoqvBPXHnSuGRN1ezEd7LChmJG/Ng8MgpOuxNjGI8mpnbqG', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(572, 'IKHSAN.SETIAWAN', 'IKHSAN SETIAWAN, ST.', 'IKHSAN.SETIAWAN@SIG.ID', '$2y$12$oWYxBctxg5O4t5d2HOl1xemICsHKKnFY8n6bnh1mbR6M/mlQHQ1v.', 3, 14, 21, 29, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(573, 'IKHWANUL.FAJRI', 'IKHWANUL FAJRI', 'IKHWANUL.FAJRI@SIG.ID', '$2y$12$MlT70DX6ieuyk72III6ykOX0DpJ5/QpNgzhiRZtuzSdgTp72SkV5K', 2, 3, 16, 27, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(574, 'ILHAM.AHMAD', 'ILHAM AHMAD, ST.', 'ILHAM.AHMAD@SIG.ID', '$2y$12$4.39bE4wSXChVEBZZWqmDuBvM5w13SBRO70TUCmXl79P8yqhY4n6u', 2, 11, 23, 92, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(575, 'ILHAM.AKBAR', 'ILHAM AKBAR, ST.', 'ILHAM.AKBAR@SIG.ID', '$2y$12$ZCWCszOph4mXxq1neGDPXeg6o38fSBQr50vVhVAIDeb/pwla8Wvii', 1, 1, 14, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(576, 'ILHAM.JUHENDRA', 'ILHAM JUHENDRA', 'ILHAM.JUHENDRA@SIG.ID', '$2y$12$EexYIxJ/dcFgVV8EGvA.ku1wj9gsuwFEOTymsQjx6nvF0FmHaJJ9e', 2, 7, 17, 45, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(577, 'ILHAM.MUZAKI', 'ILHAM MUZAKI', 'ILHAM.MUZAKI@SIG.ID', '$2y$12$bksyonYagfL7bhS3tENfuuHwOvpvZ4qEyjAxQtZMoUV3FQSJepy02', 2, 7, 32, 46, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(578, 'ILHAM.REDHA', 'ILHAM REDHA, AMD.', 'ILHAM.REDHA@SIG.ID', '$2y$12$eEoaj.Y1wHIRf2aHha.YrOcDxHx5viffiK8JleqIINU6Vq9jFSj2O', 2, 7, 33, 48, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(579, 'ILHAM.SHANI', 'ILHAM SHANI', 'ILHAM.SHANI@SIG.ID', '$2y$12$82TBxre4DLyC2Uk.dP9RsOEnQHT7QlMuCf.OsTyzzpfOjUCHQMNL6', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(580, 'ILHAM.WAHYUNI', 'ILHAM WAHYUNI, ST.', 'ILHAM.WAHYUNI@SIG.ID', '$2y$12$BDKp5HzaiVsZcGel6pVEVO4YdiZe2N.f2u2GO3py42yv0xUo9by4e', 2, 0, 47, 124, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(581, 'ILVI.WALDEVRI', 'ILVI WALDEVRI', 'ILVI.WALDEVRI@SIG.ID', '$2y$12$S/jySrBrqOp1RuCVyhml1ODps9Lx8AmZZkQGv1Tp.DIyYtS9/VPHK', 2, 0, 56, 109, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(582, 'ILYAS.3241', 'ILYAS', 'ILYAS.3241@SIG.ID', '$2y$12$Q.oaBlkvipw/lVrl31UlgO9Cgvqjbokz9BWzGHVx5mbU234sDE45W', 2, 9, 35, 25, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(583, 'IMAM.ARIFANDI', 'IMAM ARIFANDI', 'IMAM.ARIFANDI@SIG.ID', '$2y$12$7dPNwSHhVW4gwvI2c/jXCOf74Jz434nWYn7IOJyoMLvHzL8ELWuJS', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(584, 'IMRAN.3464', 'IMRAN', 'IMRAN.3464@SIG.ID', '$2y$12$1SEylmKBMB.ovQYY9Eg1meWA6UyliJYmD3ZmXrPHElsTo/puzfkKq', 2, 9, 41, 70, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(585, 'IMRISAL', 'IMRISAL', 'IMRISAL@SIG.ID', '$2y$12$bq3dfaREBSeQrjFhvSlCEuNauIjy5JU222im0ouYsxWvCRrrLSe6O', 2, 0, 56, 109, 4, 0, 0, 1, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(586, 'INDRA.5603', 'INDRA', 'INDRA.5603@SIG.ID', '$2y$12$ECBznJvuakfi19FXRhNY1ONO/D2seqZv7JVE8MHLJhln5CbSdfyLy', 3, 5, 6, 90, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(588, 'INDRA.BAHAR', 'INDRA BAHAR', 'INDRA.BAHAR@SIG.ID', '$2y$12$TzdHlbBhP88BzYNWPGb6TeYnIA304rJKQS..zVwzR9/sTHM8dpUuu', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(589, 'INDRA.FARIZAL', 'INDRA FARIZAL', 'INDRA.FARIZAL@SIG.ID', '$2y$12$/.FnUV5Byizl17HWXE6f1uNocDETCOhx5iV8d96CqSSDEuQOMn1qe', 2, 7, 33, 67, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(590, 'INDRA.NASRUN', 'INDRA NASRUN', 'INDRA.NASRUN@SIG.ID', '$2y$12$gtGgT3/q7HBiUJWbldMdmuywfMCzE7wIhlomdPY9yZON9SiQ/DB2K', 3, 0, 59, 136, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(591, 'INDRA.NOFIANDI', 'INDRA NOFIANDI', 'INDRA.NOFIANDI@SIG.ID', '$2y$12$lXwefwQUNv3895wTOximJO0ECcgJyZPB6gh/m5ZNtePJMetsSWeVK', 1, 13, 3, 97, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(592, 'INDRA.PUTRA3355', 'INDRA PUTRA', 'INDRA.PUTRA3355@SIG.ID', '$2y$12$YsWZ7yFxnIdYnEDUeYyVe.pzVOwYwFR/FIyAcC7ygxKxeXQsCIuQm', 2, 9, 35, 25, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(593, 'INDRIA.HAPSARI', 'INDRIA HAPSARI, ST.', 'INDRIA.HAPSARI@SIG.ID', '$2y$12$veVNphHZDI5SR4EHoIY9xelp59aEfADIZCmX.xUrRBHz.89eDfoR2', 2, 0, 56, 88, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(594, 'INDRIZAL', 'INDRIZAL', 'INDRIZAL@SIG.ID', '$2y$12$2fiVh4t3H8cmhr29kRXcbenJMO.LzdoM6RzeSjnp1203PDsNGI2d.', 2, 7, 32, 62, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(595, 'INTAN.LESTARI', 'INTAN LESTARI, SE.', 'INTAN.LESTARI@SIG.ID', '$2y$12$gI5Wgv9udfNnrFRqJwikeehBGDIdKS6b6bJrMLITwmy8G3eGAFuNm', 1, 8, 42, 74, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(596, 'IPENRIZAL.S', 'IPENRIZAL S', 'IPENRIZAL.S@SIG.ID', '$2y$12$Y21QiwNHQ/PoHt/pPue4W.uH1pjXt2mYTwS.BPWMJZUPTh4T5C8lm', 2, 9, 35, 52, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(597, 'IQBAL.HILMAN', 'IQBAL HILMAN', 'IQBAL.HILMAN@SIG.ID', '$2y$12$DCB/Bd9oKoYJuelJZ7J5yu7sdJWayFopQsXJYvkw130Pit9lqI5zu', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(598, 'IREF.MALIZAR', 'IREF MALIZAR', 'IREF.MALIZAR@SIG.ID', '$2y$12$us3IZMXGGfecCF3TV3qX8ueAf9HgyMSfGmPCQkocsAD5Dbc90iKLW', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(599, 'IRFIANTO.PUTRA', 'IRFIANTO NUSA PUTRA', 'IRFIANTO.PUTRA@SIG.ID', '$2y$12$EEzmFoH1HFDB/oztztDUKeYd.BJQzmc4Q/bnGpwPD12Iv7kAhomY.', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(600, 'IRSON', 'IRSON', 'IRSON@SIG.ID', '$2y$12$U.cWbNbWHxBjcH44C7Piuu9Lwx1M49oP.HdptRN3xEm2eXIczenmO', 2, 7, 19, 32, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(601, 'IRSYADULHALIM', 'IRSYADULHALIM', 'IRSYADULHALIM@SIG.ID', '$2y$12$V2GRj9nGyPQJ9YgTzAXa7.Z5Z0cQrzkiTpReRPMWdK7sQQLE2xtky', 2, 9, 35, 25, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(602, 'IRSYADUNNAS', 'IRSYADUNNAS', 'IRSYADUNNAS@SIG.ID', '$2y$12$OWmlNF13tFyi7YZLVJNXs.lHHHlVfQMGhRTdR4wGbXKdKOAP.QrpO', 2, 7, 17, 45, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(603, 'IRVAN', 'IRVAN', 'IRVAN@SIG.ID', '$2y$12$pcfq6QAv7p4HLgAvmCNtzOsjhed10fVwAK6gKDEPTPy0s/9iRN/lS', 2, 11, 23, 92, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(604, 'IRWAN.NUGROHO', 'IRWAN ADI NUGROHO, ST.', 'IRWAN.NUGROHO@SIG.ID', '$2y$12$XUvNA4I/qkzJPyvjFnVkkuTeBkcueuGKhbkxOCuU.MSej/8swqA0K', 2, 11, 23, 92, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(605, 'IRWAN.PUTRA', 'IRWAN KARTADI PUTRA, ST.', 'IRWAN.PUTRA@SIG.ID', '$2y$12$4GgrN/hn6QkGuMT1qE.2Lur241IbRg.bGjGg442RxItRBu4zdQVzm', 2, 7, 33, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(606, 'IRWANDI.3227', 'IRWANDI', 'IRWANDI.3227@SIG.ID', '$2y$12$ElcG71vRQ0tmOuqXXiZzyOBZBMe0SDL.KU4JyC3nVlKNK9nQtlTzm', 2, 9, 41, 28, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(607, 'IRWANDI.YUSANDRA', 'IRWANDI YUSANDRA', 'IRWANDI.YUSANDRA@SIG.ID', '$2y$12$S9coBlct.Cf5wmBvV.QcReKZfcmV98qmm8PY/fSrUA3j6u7Wdz1iu', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(608, 'IRWANDI.3636', 'IRWANDI, ST.', 'IRWANDI.3636@SIG.ID', '$2y$12$35RWclT1KVW8.sNUFVjp1eCeCR.8pk1jPFHCsWPDfN.6IOdPlimm.', 2, 9, 41, 56, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(609, 'ISAK.MUZAMMIL', 'ISAK MUZAMMIL, ST.', 'ISAK.MUZAMMIL@SIG.ID', '$2y$12$fBV5mYJi1hAQAZ9tXpjY0e68ht8KlOQa2wD/WUKQ1V0GQ1o5iGDrW', 2, 10, 20, 89, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(610, 'ISKA.PURWANDA', 'ISKA PURWANDA', 'ISKA.PURWANDA@SIG.ID', '$2y$12$z5QasNn6wauuSZusfTG5l.46H7/G8m4bH3DU4NlYguEOn3BahJ7lS', 2, 11, 23, 92, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(611, 'ISKANDAR.TAQWA', 'ISKANDAR SAMUDRA TAQWA, ST.', 'ISKANDAR.TAQWA@SIG.ID', '$2y$12$fSkexjHVAwpkArtauA4IGOyxoflggT6eX4nx4uCeuJjvR9ZrXL39e', 3, 6, 0, 0, 2, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(612, 'ISMAN', 'ISMAN', 'ISMAN@SIG.ID', '$2y$12$eLg86KvegjYNV/8.qvrExO08vaT2U0/Rfyrzqyw444mfbv/kAQkFm', 2, 10, 43, 83, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(613, 'ISMAR.ADRIANI', 'ISMAR ADRIANI', 'ISMAR.ADRIANI@SIG.ID', '$2y$12$.AFtP/aX1/By7fSPJGVjruwtfJC39tvHTev6MOkq/vSqOb35L2b/u', 2, 7, 32, 62, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(614, 'ISMED', 'ISMED', 'ISMED@SIG.ID', '$2y$12$OjdAyKl18HtIgC5RDbs5.O7Z5NBGPhlPr5TM8la3GPAL/iVhs5/j6', 2, 9, 41, 28, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(615, 'ISNAIDI', 'ISNAIDI', 'ISNAIDI@SIG.ID', '$2y$12$IVnZYYztqkQirvOqZ/tYwuyTtsW3vlQ3KWBp0SmdSyLCBJHMNbtYC', 2, 7, 32, 62, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(616, 'IVAN.RICHARDO', 'IVAN RICHARDO', 'IVAN.RICHARDO@SIG.ID', '$2y$12$bRlJo/5q9FGpmNYGdwUXUu7pTmg8aMVw2Un.H8bItad9KM41.28v6', 3, 0, 24, 93, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(617, 'IVAN.ROSANDY', 'IVAN ROSANDY', 'IVAN.ROSANDY@SIG.ID', '$2y$12$da5dmsZF.F3MUymJhKKoMO.U/YjzbeYrl1f9QQ03QOCikuIBj3HNu', 2, 11, 57, 87, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(618, 'IZNIL.ZUHEIMI', 'IZNIL ZUHEIMI', 'IZNIL.ZUHEIMI@SIG.ID', '$2y$12$raI1W9tT5UzkkvOM0ccp8eVcP9Pt4jiL79TVGPFStySPxyIhTc4my', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(619, 'JAFRIADI', 'JAFRIADI', 'JAFRIADI@SIG.ID', '$2y$12$xVe5FRQ2Qg52gNiF3KnJw.DeW0mFmGjLuk6tP/Aw83qUBFN2nFoba', 3, 14, 21, 30, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(620, 'JAMALUDDIN.NZR', 'JAMALUDDIN, S.Kom.', 'JAMALUDDIN.NZR@SIG.ID', '$2y$12$Zjr4ruES.WCOvf8EvqK1au.oPm8Jo/zVK3va.qB3dm6rs17oZWnnm', 1, 13, 3, 97, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(621, 'JAMILUS', 'JAMILUS', 'JAMILUS@SIG.ID', '$2y$12$4D4v6C57dEwj2U24yBFVIeIa1Ao58AtYTATlcvK2.AkeN9cceUAXC', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(622, 'JANEDI', 'JANEDI', 'JANEDI@SIG.ID', '$2y$12$rvnixD2p7iBvioGSAVVmiOQZvZde7ic/Kro4CeTT1p8EpeUMQDYkq', 2, 7, 32, 1, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(623, 'JANUMARINOS', 'JANUMARINOS, SE.', 'JANUMARINOS@SIG.ID', '$2y$12$svcIQONlqQuMFs3zuvdbheqO5mFa0PdhEagp.woobXZVcnU1Duhhy', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(624, 'JANWARMAN', 'JANWARMAN', 'JANWARMAN@SIG.ID', '$2y$12$lR1oDlv0/sIcy8h8QItWyuacC.8IwGOwm5s7eva4zHOUuFxVtCr66', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(625, 'JASRIADI', 'JASRIADI, ST.', 'JASRIADI@SIG.ID', '$2y$12$fC.tWieyN7yJ8v5t7OCW7O0braKVambvhEJYLT8Ok5M/exhfUtq.a', 2, 3, 54, 127, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(626, 'JEFRI.ANTONI3386', 'JEFRI ANTONI', 'JEFRI.ANTONI3386@SIG.ID', '$2y$12$OI8JGKZe5jzFK/DiefYBC.aDfTnbFIgdR9GKASyFMXAF4EM0DkCFK', 2, 0, 56, 109, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(627, 'JEFRI.ANTONI', 'JEFRI ANTONI, SE., MM.', 'JEFRI.ANTONI@SIG.ID', '$2y$12$vmmAAbAMOgJvNyqJfaQtzuDs/.VB8Fq4lBDUnlDxINPumSI2Df3HW', 3, 0, 24, 93, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(628, 'JEFRIMAIRIZAL', 'JEFRI MAIRIZAL', 'JEFRIMAIRIZAL@SIG.ID', '$2y$12$5W.xejCaqgg6DcK3cUAq1.Yw4Ovk.FaaunfIrMb3RkEynDb1DKXEi', 3, 14, 37, 108, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(629, 'JEFRY.SUMARLI', 'JEFRY SUMARLI', 'JEFRY.SUMARLI@SIG.ID', '$2y$12$q4qqU.8T4CEbFfCcQSDde.NUY0w5uPpiLhQ2iNXnHXXLgqSceAvyi', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(630, 'JEN.RIADI', 'JEN RIADI, S.Si.', 'JEN.RIADI@SIG.ID', '$2y$12$ZELJteuaYBKx3WemswQeWuozOc69Wmmegfo9p2IgiohGAzesj9mxO', 1, 8, 42, 74, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(631, 'JESRIWAL', 'JESRIWAL, SE.', 'JESRIWAL@SIG.ID', '$2y$12$GZGvxVNbtYBbj1kIowsuN.nn3o.b84UImPoBwXvpd4D4l76H98gEq', 2, 0, 56, 109, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(632, 'JHIM.REDI', 'JHIM REDI, ST., MM.', 'JHIM.REDI@SIG.ID', '$2y$12$MZK3OyDzM1k0s9KyY8rmb.W2Cp4BYzAfl0iG3sMiSJgVvjiuA9ZPu', 2, 10, 46, 125, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(633, 'JHON.NIKO', 'JHON NIKO', 'JHON.NIKO@SIG.ID', '$2y$12$sJyz.6OBinHEU6uzvtht/.c8k.CgLwHF8fB9GakDHFxBQHNIEMsVa', 2, 7, 18, 63, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(634, 'JHON.RAMADONY', 'JHON RAMADONY, ST.', 'JHON.RAMADONY@SIG.ID', '$2y$12$fELsKnKHOPzt4eKgbRe7g.Qj2EEW/SiPgTv9VnDHpXU6TsUT1oHDK', 3, 0, 34, 104, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 21:24:50'),
(635, 'JHONNY.FAIZAL', 'JHONNY FAIZAL', 'JHONNY.FAIZAL@SIG.ID', '$2y$12$ZtHmAPQ48WOX//di2PejN.kApoQ7a9HFTUoQgOFao7NvDW82ae0B6', 2, 9, 41, 70, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(636, 'JHONNY.MANIK', 'JHONNY WAN OF MANIK', 'JHONNY.MANIK@SIG.ID', '$2y$12$P6SET5Sw3idBOeX03QI3D.mH8xMW/RSPZHITToBULJfafI47Bubtu', 2, 9, 48, 23, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(637, 'JHOVI.HAVIL', 'JHOVI HAVIL', 'JHOVI.HAVIL@SIG.ID', '$2y$12$8ef.vPKkGFc6jA5mIZyygesP/03JWJkMf3LBD/9XivVNqv0dmr6QK', 2, 3, 11, 37, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(638, 'JIMMY.CHANDRA', 'JIMMY CHANDRA EDUARD ORAH', 'JIMMY.CHANDRA@SIG.ID', '$2y$12$m2nKty3IJSooPZ.5j96ktuf1FY1HtkAgA.VNs86jDY4xkp9bmzEv.', 1, 1, 15, 119, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(639, 'JIMMY.MUHARMAN', 'JIMMY MUHARMAN', 'JIMMY.MUHARMAN@SIG.ID', '$2y$12$IGLKYGb.X0CD.Wegz3FnjuPdAZGTkbOhUArNfDPrruKde8IxMDKzW', 2, 9, 35, 52, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(640, 'JOHARJO', 'JOHARJO', 'JOHARJO@SIG.ID', '$2y$12$8nKDEbf.uJL4NtJhHAYm6unW970k6bn2xwcS0rjBuAqsKG3Z9Olca', 2, 9, 36, 105, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(641, 'JOHN.NURDIN', 'JOHN FITZGERALD NURDIN', 'JOHN.NURDIN@SIG.ID', '$2y$12$ZXhKsI1iqqN/UHgs.Nh24.uNpKZalJXhmOiVpS/oo14xWMYjW93fa', 3, 5, 6, 135, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(642, 'JOHNY.SYAM', 'JOHNY SYAM, SE.', 'JOHNY.SYAM@SIG.ID', '$2y$12$6M5Znq1GPcqOYB7/eF./GORUjy.XvnNm7Kg.JjovKcaDBt081QluS', 3, 5, 22, 133, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(643, 'JOKO.SULISTYANTO', 'JOKO SULISTYANTO', 'JOKO.SULISTYANTO@SIG.ID', '$2y$12$gufMTm3yzGxec5jeV8QoW.Z0/OUSV3oRcPKrB1Z6eCC.AhRePb1eq', 2, 10, 20, 89, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(644, 'JON.REFEL', 'JON REFEL', 'JON.REFEL@SIG.ID', '$2y$12$V4rkiYUTBmSBG4ViqqSMSOo54YFeSa6ZKhy68tkz1XY/W4z1IKb86', 2, 7, 30, 115, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(645, 'JONI.HERMAN', 'JONI HERMAN, ST.', 'JONI.HERMAN@SIG.ID', '$2y$12$OaKhULON0eleXW0wBhxtZe.Um7LRGvYCVxUu4jwXnFUY9aItKdIJW', 2, 7, 30, 101, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(646, 'JONI.PUTRA', 'JONI INDA PUTRA, ST.', 'JONI.PUTRA@SIG.ID', '$2y$12$0Wt6lRtO28ZNBC0vQFg6/u4h2ERagz7ux4M7n6J3im/yuts6Xs86K', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(647, 'JONI.SOPRIYANTO', 'JONI SOPRIYANTO', 'JONI.SOPRIYANTO@SIG.ID', '$2y$12$5r.R5SzUThV0QIBWMMlW2eZDkw2T79aS8B.IhXxNhM.azK24hdNpS', 2, 9, 36, 105, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(648, 'JONI.SULNARDI', 'JONI SULNARDI', 'JONI.SULNARDI@SIG.ID', '$2y$12$0iN5zRdJwxX0kW4LI/rq0ubHQ7Z86MFiZohdq/IgcMvfnF7XdI0zq', 2, 9, 36, 106, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(649, 'JONNEIDI', 'JONNEIDI', 'JONNEIDI@SIG.ID', '$2y$12$EuzhP93sfL514Lc.M/Yj.uMI1z.0lklJ.zVBRDDKn5.j6t3qfNho2', 2, 3, 54, 127, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(650, 'JONRIZAL', 'JONRIZAL, ST.', 'JONRIZAL@SIG.ID', '$2y$12$VqU7zi54zWdoctVoPcSMW.aXSflMlXYxOZaFu5JbCFP65afRfhMlq', 2, 10, 46, 125, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(651, 'JONSON.SINAGA', 'JONSON SINAGA', 'JONSON.SINAGA@SIG.ID', '$2y$12$R1ujd0FbU4qyrei7VvoYV.bGjv9Ay9KtPjHBjiIc7Iz7naE0MUwTi', 2, 3, 27, 69, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(652, 'JOSE.APRIL', 'JOSE APRIL', 'JOSE.APRIL@SIG.ID', '$2y$12$J.eNZXXwPl6fAHIu/aeJLuWLge2q0fZrjC1oyHpsbKpAK6h3pxE1S', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(653, 'JUFRI.NALDI', 'JUFRI NALDI', 'JUFRI.NALDI@SIG.ID', '$2y$12$0.DJND/NsyGlntxKyYO.regPGvfN5jwj7xcic9z6NTNY6A3lAca0O', 2, 9, 35, 25, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(654, 'JUFRIAL.3265', 'JUFRIAL', 'JUFRIAL.3265@SIG.ID', '$2y$12$HngLw/4wlbToovQCgryqE.7ODXahxom2RyRx9qtHNHm3dJRNoPfq6', 2, 3, 39, 68, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(655, 'JUFRIANTON', 'JUFRIANTON', 'JUFRIANTON@SIG.ID', '$2y$12$1do43tlHNRObEwYeeFBzpefVy0PP4hALBD64yslzyqqX7AmTAmCUu', 2, 10, 20, 86, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(656, 'JULI.ARWAN', 'JULI ARWAN', 'JULI.ARWAN@SIG.ID', '$2y$12$3fNpzSBqUUvrFDRmjYjO5ugykBLiJxUDL3eQoJ.0qa1.JktzkPFYO', 2, 7, 32, 36, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(657, 'JULI.FERNANDO', 'JULI FERNANDO', 'JULI.FERNANDO@SIG.ID', '$2y$12$hgYDAIAx5kCwM1mrCCde1uCBrBqfzsmfPP87oRiEEsnqien6YUe.u', 1, 13, 3, 97, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(658, 'JULIE.IRDO', 'JULIE IRDO', 'JULIE.IRDO@SIG.ID', '$2y$12$dkT6PBHnAxNRRDeBU4/YOOkuMqcz2o6BfOz5l6UvbO4GzDmG4rfW6', 2, 7, 33, 4, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(659, 'JUMARDO.AKBAR', 'JUMARDO AKBAR', 'JUMARDO.AKBAR@SIG.ID', '$2y$12$6wZ/l//FjoK54x5btxrlTeGhQnBiVMjQTdKWKvM8pAHnHcgWOuYCC', 2, 9, 36, 106, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(660, 'JUMRA', 'JUMRA', 'JUMRA@SIG.ID', '$2y$12$BchRAZXV0HZSlcX04jgZZenFsXVOkSIRoJ3plDeN/eFZz9mEWEevq', 2, 11, 45, 120, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(661, 'JUNAIDI.3326', 'JUNAIDI', 'JUNAIDI.3326@SIG.ID', '$2y$12$PgBNeZqPMuF0Y2GoF.Ju/u/XHmiHI9NXlypbcaVEuv7T9j/YiiZrq', 2, 10, 46, 125, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(663, 'JUNAIDI.N', 'JUNAIDI N', 'JUNAIDI.N@SIG.ID', '$2y$12$n/Cg7ATNnw.qLNSknwRMhufqTpmhQEYmdpS0RZZXjjx8KXWxbq07e', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(664, 'JUNAIDI.5619', 'JUNAIDI, SH.', 'JUNAIDI.5619@SIG.ID', '$2y$12$PNN20jSR.tr1YDThdHMsQet7dWBdJmby9q1EzoqNShzfT6CXfWP2a', 2, 3, 39, 49, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(665, 'JUNALDO', 'JUNALDO, ST.', 'JUNALDO@SIG.ID', '$2y$12$Vmq6gE7l4WBzMSntCxAMAeNTBR6i4fL5TMzyeu4R3mty/4sYF74Qq', 2, 10, 43, 83, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(666, 'JUSRIAL', 'JUSRIAL', 'JUSRIAL@SIG.ID', '$2y$12$HCm7zhhZoaEPi/l4yYPgEOtykeP3K46eFuTufToTFs2VJQ1TiOB6a', 2, 7, 33, 39, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(667, 'KARDINAL.MARTIN', 'KARDINAL MARTIN', 'KARDINAL.MARTIN@SIG.ID', '$2y$12$jpfYLf1z7mql.B25GKyhz.G95JBNR5WFUMmf2URyS/pfAfyYxMKY.', 2, 4, 13, 58, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(668, 'KAREL.AQUARDO', 'KAREL AQUARDO', 'KAREL.AQUARDO@SIG.ID', '$2y$12$FvtU/56JNyHmEOGC.8oQCePiyoq.ybCojSh1nEozsKj6YZGqvms4C', 1, 12, 38, 24, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(669, 'KHAIRIAL.AZHAR', 'KHAIRIAL AZHAR, ST.', 'KHAIRIAL.AZHAR@SIG.ID', '$2y$12$NWJf0IpzenfJ4qiAS6nqO.dlCt5BgQGU4HXQxkUW9r2qw0A44OyeG', 2, 7, 17, 45, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(670, 'KHAIRIL.LUBIS', 'KHAIRIL HUDA LUBIS', 'KHAIRIL.LUBIS@SIG.ID', '$2y$12$M5TVmPmA4rSyikCIiqGYGuMZlg8Y9K84vA5Vh4bu9qJuIWPaXSPYW', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(671, 'KHAIRUL.FIKRI', 'KHAIRUL FIKRI', 'KHAIRUL.FIKRI@SIG.ID', '$2y$12$6A7Ttpf6H1wgTzNs8Sbhdeoj69YeEVsY8hc0NMAkMlopnFQpRPJta', 2, 10, 44, 118, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(672, 'KHIDMI', 'KHIDMI', 'KHIDMI@SIG.ID', '$2y$12$aJXEiOV.evDaVmo4NkEjFePDHu0awA1fp3sQZrGDLTlWfQhgi/Aia', 2, 10, 46, 125, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(673, 'KHRISTIAN.SONATHA', 'KHRISTIAN SONATHA, SE.', 'KHRISTIAN.SONATHA@SIG.ID', '$2y$12$OcCFZxwwrCCda2cpfnRUfOVRYL6XZlkctebs1lpd2kQL6XYCfhXQu', 3, 0, 59, 136, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(674, 'KIKI.DARMAWAN', 'KIKI DARMAWAN', 'KIKI.DARMAWAN@SIG.ID', '$2y$12$3WIDwRy8DKy9aIwtLXpxAept0DsYcnPjajxSDRYAoQ861VIQVjVP6', 2, 7, 30, 115, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(675, 'KIKI.WARLANSYAH', 'KIKI WARLANSYAH, ST.', 'KIKI.WARLANSYAH@SIG.ID', '$2y$12$R70B7Hl72eQKjUCXP4.Py.6sQgQt6AFHdKJel0eX/BQM8XwT9EvPC', 3, 6, 26, 114, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(676, 'AKIB.FIRMANSYAH', 'KM AKIB FIRMANSYAH, ST.', 'AKIB.FIRMANSYAH@SIG.ID', '$2y$12$J7Wk28oBkVCIqopjIvVnLuG0ln/Pp/K6fyQaa3v9KZG0HH/5GjWcS', 2, 11, 57, 87, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(677, 'KUSNAEDI.PRATAMA', 'KUSNAEDI RAKA PRATAMA', 'KUSNAEDI.PRATAMA@SIG.ID', '$2y$12$3LOUj.CzYiCqE5tz4dAWluMMBn9TFyO9SrvDn8AxdQaTKRzPcpyWa', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(678, 'LEGIWAN', 'LEGIWAN', 'LEGIWAN@SIG.ID', '$2y$12$VJuumadgHgyInJOBmPaUzOcfIcc3AuTTreUixKgYd8O6/yC5SpiEK', 2, 10, 46, 125, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(679, 'LEODY.CORTIS', 'LEODY RINANDO CORTIS', 'LEODY.CORTIS@SIG.ID', '$2y$12$NRSh0fBRorUruCyQSPGPp.heI.IYRcyOESNmjNEhpWHL1ZBnlaK4q', 2, 11, 45, 120, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(680, 'LEOZATIUSFRI', 'LEOZATIUSFRI', 'LEOZATIUSFRI@SIG.ID', '$2y$12$hlPNQhbtxoEja9345pZSSO1He8yft.8BpfI1CXPkzHzW4BZ/5LX.m', 1, 1, 15, 119, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(681, 'LIDYA.LIZA', 'LIDYA ROSA LIZA', 'LIDYA.LIZA@SIG.ID', '$2y$12$3bcCQVWnZkRCxA1ohAGBw.ypARdO3ZReR45RBsNXtjjwJRXEx.fOC', 2, 0, 56, 109, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(682, 'LIDYA.ANGGRAINI', 'LIDYA ROSI ANGGRAINI, SE.', 'LIDYA.ANGGRAINI@SIG.ID', '$2y$12$0xo4rl0kyAqDroRG4ky2COYROKL.JnvvWQu2exsEkMZDaNT4yk7.W', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(683, 'LILY.JULIYATI', 'LILY JULIYATI', 'LILY.JULIYATI@SIG.ID', '$2y$12$9vovqUIMMADX8HjgwTMen.ouVJ9meumlahBxmyZ.He5u7pTai48K6', 3, 6, 26, 110, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(684, 'LIZA.DRAMENDRA', 'LIZA DRAMENDRA', 'LIZA.DRAMENDRA@SIG.ID', '$2y$12$e54oi2ip4NSGp6s5V6FIuucmyJ7mG1cSb51SPzxgy/nu1KfiKiUNa', 3, 5, 6, 135, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(685, 'LUKMAN.5627', 'LUKMAN', 'LUKMAN.5627@SIG.ID', '$2y$12$5KV1NTXjDBOSuHn7OrHHUOgnERdSP9WESzB82QarmDoilgfRIJGGa', 2, 9, 35, 51, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(686, 'ADI.PUTRA', 'M ADI PUTRA', 'ADI.PUTRA@SIG.ID', '$2y$12$SqvM8Zxi6Z/RM2nEgd0vTe/9u6qcrmaHO5i5ys8XnoOa5z6MSKpbi', 2, 9, 48, 22, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(687, 'AHMED.ZAKI', 'M AHMED ZAKI', 'AHMED.ZAKI@SIG.ID', '$2y$12$1bckagxfOGh4DpaNY2W7NeeLrmzJX6DlxwMBZ5ZBzFJymjYKZKoQ6', 2, 7, 18, 47, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(688, 'ANDEKA.FRANDALA', 'M ANDEKA FRANDALA, ST.', 'ANDEKA.FRANDALA@SIG.ID', '$2y$12$akCtC5zD70CcGJI4KkM9BOCBpjcgwM3LpYPqhizquWxAgxqo0p0f6', 2, 0, 56, 88, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(689, 'FADLI.NAZAR', 'M FADLI NAZAR', 'FADLI.NAZAR@SIG.ID', '$2y$12$xvEh3T5DNO7EACvj6sZEuuiWF2Y/WIe0Ccigi/7.DqGIMMgDw527u', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(690, 'FAUZAN.AKBAR', 'M FAUZAN AKBAR', 'FAUZAN.AKBAR@SIG.ID', '$2y$12$RX09FAQnJLfOsIoDPsBBI.dQ/FLkGzWC8Qc8qfj7zZhA9F1.CVA82', 2, 7, 18, 63, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(691, 'M.TAMRIN7499', 'M HUSNI TAMRIN', 'M.TAMRIN7499@SIG.ID', '$2y$12$68rbrtIhgsDMnOlwZBQslu0y0pSDSlZPmVZ2NcbHnD2C8qHdQbs02', 1, 12, 50, 8, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(692, 'IRWAN.PRASETYO', 'M IRWAN PRASETYO, ST.', 'IRWAN.PRASETYO@SIG.ID', '$2y$12$8it4dsHZdIQGkg098QNgqOyN6CTA/TbZoy39NK4vN3ErgIiGjIj0u', 3, 0, 24, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(693, 'M.SYAFRIL', 'M SYAFRIL', 'M.SYAFRIL@SIG.ID', '$2y$12$G3KJUaEYgIPy6Gkd33C14OCLpmJZDeYHD/nyCo.DSwQAhE2TUr.zi', 2, 10, 46, 125, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(694, 'M.TORIK', 'M TORIK', 'M.TORIK@SIG.ID', '$2y$12$dtjHEE7krdTUmjwvZaX1.uUk7wsg3uNaI6YOR98CfdLzb8oM4xo4u', 2, 7, 18, 63, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(695, 'M.UDRIZAL', 'M UDRIZAL', 'M.UDRIZAL@SIG.ID', '$2y$12$J7ZcYTkBdbVF8kY.a5JBXuCNyZgXTC.DnJ0lf9aWUJbX7N.gxb9jG', 2, 7, 19, 31, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(696, 'MAIFIDRA', 'MAIFIDRA', 'MAIFIDRA@SIG.ID', '$2y$12$ooB0TP3MxhRCB7LbDibztOCDU7RX80A6xI5zdb2nm6rIV1OfVccNC', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(697, 'MAISON.ISKANDAR', 'MAISON ISKANDAR', 'MAISON.ISKANDAR@SIG.ID', '$2y$12$68Q21FSABmqaGGj4U3VHpurzIMJ5p44ZqmqbUzVcorx.j4ZgTwGrK', 2, 3, 11, 44, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(698, 'MAMAN.ABDURAHMAN', 'MAMAN ABDURAHMAN', 'MAMAN.ABDURAHMAN@SIG.ID', '$2y$12$yFiRDTyih8GiulB4IFg66O8kzJNcIYKqCneG5dSTX9ERYNBeBPESy', 3, 6, 28, 98, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(699, 'MAMAN.WAHYUDI', 'MAMAN WAHYUDI', 'MAMAN.WAHYUDI@SIG.ID', '$2y$12$dDS8NSGpxH6huwqXN2sJz.1dPZ7G4yW0uw3pXm3kDingBpx4IJmOq', 2, 7, 19, 31, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(700, 'MARDIAL.ELBEM', 'MARDIAL ELBEM', 'MARDIAL.ELBEM@SIG.ID', '$2y$12$1WNbOz35f9MlCRZoJcpVgeq7tt5QIH2IGKD.IghXuAcL/u/kJaGM2', 2, 11, 45, 120, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(701, 'MARDIANTO', 'MARDIANTO', 'MARDIANTO@SIG.ID', '$2y$12$pfhqNhyUnu3aaW2F1g6B5.ltwtpY1C.yMFLHevwxe./bFYPp/lkAG', 2, 9, 36, 105, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(702, 'MAREZA.HARLAN', 'MAREZA HARLAN, SE., Ak., MM, CA.', 'MAREZA.HARLAN@SIG.ID', '$2y$12$ykw95wMzfqn4FBiTBkQ0j.fiVQzNjc7VF9X7UGKsuNNx7RHoYIMbW', 1, 13, 0, 0, 2, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(703, 'MARJUKI', 'MARJUKI', 'MARJUKI@SIG.ID', '$2y$12$zkTt0YC4JG03CO3twAP9dOKvVcXIEXZhGafx4KL71DvlwffNTAjE.', 2, 11, 57, 87, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(704, 'MARLIUSMAN', 'MARLIUSMAN', 'MARLIUSMAN@SIG.ID', '$2y$12$gIlin27VuZGl51rMvOl5CO3crC/dFYZGb30cf/dc90rj6EVGkdv9y', 2, 9, 48, 23, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(705, 'MARSUDI', 'MARSUDI', 'MARSUDI@SIG.ID', '$2y$12$4u1Oxkktg0ov8Nt8mlZ2HOybscv34ESbsIVesbAbmeWbSBjd81OBm', 2, 9, 36, 105, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(706, 'MARTINUS.ZALDI', 'MARTINUS ZALDI, SE.', 'MARTINUS.ZALDI@SIG.ID', '$2y$12$WXodigaumfvwrK1RJp94s.1zOmZqTwCoZa1THH6JlKouuaHbIUJNm', 3, 5, 6, 90, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(707, 'MARTONO.3523', 'MARTONO, ST.', 'MARTONO.3523@SIG.ID', '$2y$12$RTFqCNGosInMv4//e2lT9.EuHtY8eSy3Op7IGVQM0zaD4u1vOf4QW', 2, 7, 18, 66, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(708, 'MARTOYO', 'MARTOYO', 'MARTOYO@SIG.ID', '$2y$12$1EbjozRtJzYugJriZq39HeKolj.Fuz/BXN0CK2Jd8rrJ42whT.x/e', 2, 9, 48, 21, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35');
INSERT INTO `users` (`id_user`, `username`, `nama_user`, `email_user`, `password`, `id_direktorat`, `id_dept`, `id_unit`, `id_seksi`, `role_jabatan`, `can_create_documents`, `is_reviewer`, `is_verifier`, `foto_user`, `role_user`, `user_aktif`, `last_login`, `created_at`, `updated_at`) VALUES
(709, 'MARTU.RIZAL', 'MARTU RIZAL', 'MARTU.RIZAL@SIG.ID', '$2y$12$qWM2jevRC/JQVqg7Xo0ItOS2lP6a0B0lwSYoDjzg0OQSmnu.gmcja', 2, 7, 17, 45, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(710, 'MARWAN.SYAHPUTRA', 'MARWAN SYAHPUTRA', 'MARWAN.SYAHPUTRA@SIG.ID', '$2y$12$0g.1RqV.2mygJihxB0jVheVM84YMs004XBfKgtpE2/lhDiMuUvmhS', 3, 5, 22, 77, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(711, 'MARWILIS', 'MARWILIS', 'MARWILIS@SIG.ID', '$2y$12$iSfAT4Dg8GZZe0nUQ32qyehD9NJWzaK0D9utO9TqVgUIjNS3lMTDu', 2, 9, 41, 28, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(712, 'MARZALI', 'MARZALI', 'MARZALI@SIG.ID', '$2y$12$9mY8INdML.q3HDJrde1rIe5xnYe5NuZxkg4aqte3WkJwH7XJmLuwq', 2, 9, 35, 51, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(713, 'MASRIZAL', 'MASRIZAL', 'MASRIZAL@SIG.ID', '$2y$12$iNLDR1YdPYsoFOECnTj9yO5mphui3upP6l8AmAPB7bUp9k348Fls6', 2, 10, 43, 83, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(714, 'MASRIZAL.KOM', 'MASRIZAL, SH MM M.Kom', 'MASRIZAL.KOM@SIG.ID', '$2y$12$YrYMrNW8At.K9QPeMVmkL.VTUIFqBNmMbBz0fG16I4QgBA6Ozr8Ym', 1, 1, 0, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(715, 'MASRUL.IDRIS', 'MASRUL IDRIS', 'MASRUL.IDRIS@SIG.ID', '$2y$12$qWF80d1LNKc5.ozLYrVGBOpjC0ynND1COkFpyH5M6R2VgV2FZuxlO', 2, 7, 32, 43, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(716, 'MAWARDI', 'MAWARDI', 'MAWARDI@SIG.ID', '$2y$12$GQIcIIwtd0UAdyu/5EfAFevfFgdz7KvReBOEue/Wzs3m5PpMTRpq2', 2, 3, 39, 68, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(717, 'MEDI.AGUSTI', 'MEDI AGUSTI, ST.', 'MEDI.AGUSTI@SIG.ID', '$2y$12$KD/aD1Jan/XnEcaWcx4/LuuTMY01kXo5H5hqEAffwYZwVySyyh4kq', 2, 11, 45, 122, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(718, 'MEDYAWARMAN', 'MEDYAWARMAN, ST.', 'MEDYAWARMAN@SIG.ID', '$2y$12$XuXfU0b0r9zq/gRattAFkO.QrUc1WapyWUe7VgmR.lLiVU2V0Ep7.', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(719, 'MEHMOOD', 'MEHMOOD', 'MEHMOOD@SIG.ID', '$2y$12$y5AliohmZoaPNDom4a94s.PmmgntjxfA84u/POdz1VVQM8ccC/Pma', 3, 14, 21, 29, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(720, 'MELKY', 'MELKY', 'MELKY@SIG.ID', '$2y$12$TqS5mlFbmrR9SDzBxXAibuipU.2aqsbXAxBYiZLg9v4/yIZuF.h.q', 2, 10, 43, 83, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(721, 'MENDI.HERYANTO', 'MENDI HERYANTO', 'MENDI.HERYANTO@SIG.ID', '$2y$12$sqC3qXqZK05VBHd4HQOU3.F7iuS00/.AOa0NdZS8uRcqSywdSWKC.', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(722, 'MENDRA.ASRIL', 'MENDRA YUSTISIA ASRIL', 'MENDRA.ASRIL@SIG.ID', '$2y$12$yZTgxQZMrfRxAgknzRWN0eJnFT6RoeIF8ZwzAaRB7rrTMHnXz9bqi', 2, 9, 36, 105, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(723, 'MERISA.PUTRI', 'MERISA PUTRI', 'MERISA.PUTRI@SIG.ID', '$2y$12$zKac4Y2tvN7JRtki4T2qH.tqWLxFdeeHN1CLZK0yM43kUUmkJ.Yu.', 1, 13, 3, 97, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(724, 'META.JALADARA', 'META EPSI JALADARA', 'META.JALADARA@SIG.ID', '$2y$12$f4rNKr/k8WXXL.3nxftab.FgAJ4wiGTcleQ1znVmbqm4MstSgc5v2', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(725, 'MHD.YAKIN', 'MHD  YAKIN, ST.', 'MHD.YAKIN@SIG.ID', '$2y$12$RAdKsn3.kWKeUZEdUGqAjeR3h25i1x7FKL9e0q1ovYAw3aXXUUWDa', 2, 9, 48, 22, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(726, 'MHD.GUSNAIDI', 'MHD GUSNAIDI, ST., MM.', 'MHD.GUSNAIDI@SIG.ID', '$2y$12$lqkIZ14He/xBICm5FmdCbun7FPq.2BOj4TiPUj75LbDhPhN3wpRnO', 3, 14, 21, 19, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(727, 'MICHAEL.LASWANDI', 'MICHAEL LASWANDI, SE.', 'MICHAEL.LASWANDI@SIG.ID', '$2y$12$iNlofYI8Yshs6aImb3qRYe.zWwMCG8/ZiEs3p3DCye30V8/4CWAoW', 1, 12, 38, 24, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(728, 'MICHAEL.YULISA', 'MICHAEL YULISA, S.Sos.', 'MICHAEL.YULISA@SIG.ID', '$2y$12$b7gkrx8cmUbPrrkqQAUkGugEsgxVJPjI2gwC0grR7KDOt5NtvCOk.', 2, 3, 27, 54, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(729, 'MICHEL.A', 'MICHEL AA , ST', 'MICHEL.A@SIG.ID', '$2y$12$F2Hki4JE4qaAzA0hrfdnEulSBNl3liFYvucOk9NuJRprcAGwSN1Bu', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(730, 'MICK.DONALD', 'MICK DONALD', 'MICK.DONALD@SIG.ID', '$2y$12$SiNIpXDagDyl73Q1pY1zFuV4lE9TlAeWnIU6IDdhViwjtH.SChptW', 2, 9, 41, 28, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(731, 'MIKEL.MUHAMMAD', 'MIKEL MUHAMMAD', 'MIKEL.MUHAMMAD@SIG.ID', '$2y$12$f.aujY.JelMi/jRKiKI4au2yhk96COjScpnOo/XAiuyMyQ3fIZszS', 1, 1, 14, 84, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(732, 'MCHOIRIL.ANAM', 'MOCH. CHOIRIL ANAM, ST.', 'MCHOIRIL.ANAM@SIG.ID', '$2y$12$jjOIMM6X/BaKTMKyx6WcEeRQSJEjnx2KEGrlM9paU3idplgw2iKnW', 2, 11, 57, 87, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(733, 'MOCHAMAD.YAMAN', 'MOCHAMAD YAMAN', 'MOCHAMAD.YAMAN@SIG.ID', '$2y$12$NmqbTRjgVfzu7Hc.6ECp/exAxQdOokkbc5pLweJxePZf2uAXWSw0e', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(734, 'MUCHLIS.4444083', 'MUCHLIS', 'MUCHLIS.4444083@SIG.ID', '$2y$12$zldCBNS5dEUxLVv1DITtM.j5zCYHwKDug7gGQQGNXBraWaSPiz27a', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(735, 'MUHAMMAD.AKBAR', 'MUHAMAD AKBAR', 'MUHAMMAD.AKBAR@SIG.ID', '$2y$12$l7sk7t48LRWTJP.q.gT6ZO3Ug.ud4dCy3Ch6zurxjvqTSYINS1vLe', 2, 7, 32, 43, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(736, 'MUHAMMAD.SONIKA', 'MUHAMMAD ABDUL GANIY SONIKA', 'MUHAMMAD.SONIKA@SIG.ID', '$2y$12$ruCdyR1bshvd7zDvV7slpuOZukopoR2VoaoGgXfIyQzMZy8vsUTAe', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(737, 'MUHAMMAD.AFIRDAL', 'MUHAMMAD AFIRDAL, ST.', 'MUHAMMAD.AFIRDAL@SIG.ID', '$2y$12$fn7FPYF/.F120VH8aZz4QeueFaJ7huVD.d7jfyP2cyOyxqfC8pBLq', 2, 7, 18, 66, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(738, 'MUHAMMAD.ASYARI', 'MUHAMMAD ARIEF ASYARI', 'MUHAMMAD.ASYARI@SIG.ID', '$2y$12$qmC64ogfgl1s5ObMpHtgBuJ/DgXXKXl/8KK.JVFIzfCVZwFgx5zJy', 2, 9, 35, 51, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(739, 'MUHAMMAD.ERFAN', 'MUHAMMAD ERFAN, ST.', 'MUHAMMAD.ERFAN@SIG.ID', '$2y$12$X6eJ2QhURlZhsIbgx9Yh6uY7vNJKfcpA4sxWT8sQpiV/vhUN3m1P.', 2, 3, 39, 68, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(740, 'MUHAMMAD.FADEL', 'MUHAMMAD FADEL, ST.', 'MUHAMMAD.FADEL@SIG.ID', '$2y$12$xs1ryEoCTkskVsL6PkFgkeEGplwSDZ7Ez2PjfGP8bfDtBMEcOzAiG', 2, 11, 57, 87, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(741, 'MUHAMMAD.FAUZI', 'MUHAMMAD FAUZI, SE.', 'MUHAMMAD.FAUZI@SIG.ID', '$2y$12$Z0M7sUOGnkLaSLKP6D/fXueJmL4pmAZ/R3ubjxbLsLlWqGsvVdcFW', 3, 14, 21, 53, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(742, 'MUHAMMAD.PERDANA', 'MUHAMMAD FIRDAUS PERDANA', 'MUHAMMAD.PERDANA@SIG.ID', '$2y$12$ltKMa.lnSBQ.XFHkGN6Yvuc16H5u1U1KZgDO71OkSL9GYKkQS0NxC', 2, 7, 18, 47, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(743, 'MUHAMMAD.IHKWAN', 'MUHAMMAD IHKWAN', 'MUHAMMAD.IHKWAN@SIG.ID', '$2y$12$5.Z4iMyeFKj9wMN80maEVeaQcjE2v5B4FFDO73hKfQ8/q4v0CMzIy', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(744, 'MUHAMMAD.IHSAN', 'MUHAMMAD IHSAN', 'MUHAMMAD.IHSAN@SIG.ID', '$2y$12$KIU5ddYNdIZFFMSuswDNpu748DAc81ssPfeQgtXqC4zapO8TdmvTS', 2, 11, 10, 82, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(745, 'MUHAMMAD.IKBAL', 'MUHAMMAD IKBAL', 'MUHAMMAD.IKBAL@SIG.ID', '$2y$12$UOue9U0xJECaOXpQEqkCV.Xs50EmlBZePymCVYtr8huUKMY4ZIT0e', 3, 14, 37, 108, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(746, 'MUHAMMAD.IKHLAS', 'MUHAMMAD IKHLAS, ST.', 'MUHAMMAD.IKHLAS@SIG.ID', '$2y$12$PLsj5rT5ISFkKT2CdHWoWOKELDF2ADu6PlfwLXdt56cyrKv7Vx2H6', 2, 3, 0, 0, 2, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(747, 'MUHAMMAD.IKHWAN', 'MUHAMMAD IKHWAN, ST.', 'MUHAMMAD.IKHWAN@SIG.ID', '$2y$12$qspQU5vVGTw/WUthknIVfuq7BnwN9flwPoi1lhiOxGzv9VmNDhSpm', 3, 5, 6, 135, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(748, 'MUHAMMAD.JAMIL', 'MUHAMMAD JAMIL', 'MUHAMMAD.JAMIL@SIG.ID', '$2y$12$61u01V8Yh.Sf.HkOXaw3pe0h7eh4iM5cCJB9wcA41BM8AIyqqrmDu', 2, 11, 45, 120, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(749, 'KHAIRUL.WARMAN', 'MUHAMMAD KHAIRUL WARMAN, S.M.', 'KHAIRUL.WARMAN@SIG.ID', '$2y$12$vI/jcanLLFQbdN9/y3pCsO7IUMJudoFwQQuyu42JWDAlbBXB3RLl6', 2, 7, 17, 61, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(750, 'MUHAMMAD.NUH', 'MUHAMMAD NABIL NUH', 'MUHAMMAD.NUH@SIG.ID', '$2y$12$VxGq3jUcN19CJWI4J3kTNu3B2kM090VgsjnhmlNe2VT.m2rRc6j3u', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(751, 'MUHAMMAD.ASRIL', 'MUHAMMAD RAHMAD ASRIL', 'MUHAMMAD.ASRIL@SIG.ID', '$2y$12$qSZXtuf4ZPerc/vkKttPLOqGSjX6N9AqkB6EFxyAFXHbAIdsxZUG6', 2, 3, 16, 27, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(752, 'REZA.NATIGORDO', 'MUHAMMAD REZA NATIGORDO, ST', 'REZA.NATIGORDO@SIG.ID', '$2y$12$Mp5IartbT6nErVopbT9V8OvFoA6.uO3TfSkUk2efmY6OF.lAX.N8.', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(753, 'MUHAMMAD.RIDWAN', 'MUHAMMAD RIDWAN', 'MUHAMMAD.RIDWAN@SIG.ID', '$2y$12$bgAdBYpvbP6.Cn3n28DdcuOBeC.pTNVVMHIi0tjFhaSuMbP8/CIei', 2, 3, 7, 14, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(754, 'MUHAMMAD.RIZKI', 'MUHAMMAD RIZKI, ST.', 'MUHAMMAD.RIZKI@SIG.ID', '$2y$12$j9gsGS.waIyl4gXEnItpmOiDsAlGbRJnVTAfTKk3ir3Gt8HmzbDem', 2, 7, 30, 101, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(755, 'MUHAMMAD.RUSDIANSYAH', 'MUHAMMAD RUSDIANSYAH PUTRA', 'MUHAMMAD.RUSDIANSYAH@SIG.ID', '$2y$12$9k4dSCD5mgzt1m3C4QyZ3.yPMMhGH81DSddLEULUNhQOkSwt3wuLm', 2, 7, 17, 4, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(756, 'MUHAMMAD.SALMAN', 'MUHAMMAD SALMAN', 'MUHAMMAD.SALMAN@SIG.ID', '$2y$12$2tN9WUUmi0WO7BZpPn501efx6nrY.o12mWnP6.7hpeUYOEuHuRLAa', 2, 7, 17, 42, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(757, 'MUHAMMAD.SYUKRI', 'MUHAMMAD SYUKRI, ST.', 'MUHAMMAD.SYUKRI@SIG.ID', '$2y$12$WK6KHzdDu4vAXt.Ua2rFHe0Jf.fabKhVkliFktsGMMieKdBwWYDmy', 2, 11, 10, 82, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(758, 'MUHAMMAD.ARIEF7493', 'MUHAMMAD THAHA ARIEF', 'MUHAMMAD.ARIEF7493@SIG.ID', '$2y$12$VPnpV1IAopO8Vkq18mto9uXsLr0dAdtR9NlmrGJu2btDnA9ezsfVa', 2, 7, 18, 63, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(759, 'MUHAMMAD.THARIQ', 'MUHAMMAD THARIQ, ST., MBA.', 'MUHAMMAD.THARIQ@SIG.ID', '$2y$12$Z2ux0yUKQ2fuXaDcHLxI1uELfVuXXPmqTUOod9thE1tjgvpzfb3O.', 2, 3, 11, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(760, 'MUHAMMAD.FARSHA', 'MUHAMMAD YOGIE FARSHA', 'MUHAMMAD.FARSHA@SIG.ID', '$2y$12$1UnKXfkXRVcXh8Ejx0tDjeB2MCiW0cx0zFWJesne7N4U0pNFRG2R6', 2, 7, 33, 64, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(761, 'MUHARDIMAN', 'MUHARDIMAN', 'MUHARDIMAN@SIG.ID', '$2y$12$z3Vb6zVSJa1J2QJMT8kYCOcdU12R9mPASNqtTq4aG85.E4fTRTz0G', 2, 7, 33, 67, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(762, 'MUHARMAN.B', 'MUHARMAN B', 'MUHARMAN.B@SIG.ID', '$2y$12$1KqJ3C.CCwH6SVsvGvt3RO9ELV/7b..4v3xdVt9IW33Hi3qBcy0AC', 2, 7, 32, 46, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(763, 'MUHARMANSYAH', 'MUHARMANSYAH, AMD.', 'MUHARMANSYAH@SIG.ID', '$2y$12$QW4I32bni2on0RKzur/.IuW5GAAhuWmkTFEuQfKRcgruTxz7wGZLW', 2, 7, 30, 101, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(764, 'MUKHDI.ROZI', 'MUKHDI ROZI', 'MUKHDI.ROZI@SIG.ID', '$2y$12$Om6au/SmU1xaDvqIpHNYQOt3/st/bN09UcWkPZv3PG7H5JdzLHaRW', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(765, 'MUKHLIS', 'MUKHLIS', 'MUKHLIS@SIG.ID', '$2y$12$wNaQxBaAoj8avy4otfYgkOTOywBbFVBVah9y6AS4ayYYcptitXIXu', 2, 3, 11, 44, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(766, 'MUKHRIAL', 'MUKHRIAL', 'MUKHRIAL@SIG.ID', '$2y$12$KBc7EeeIfLKZFtSCCoXBaeJ8DB2BUQBtzgKbeLm/0I9NSzUxtvjyG', 2, 9, 48, 21, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(767, 'MULYA.PUTRA', 'MULYA ANDHIKA PUTRA, ST., M.Env.Eng.', 'MULYA.PUTRA@SIG.ID', '$2y$12$/MBNqcxG4ynVdlv/xRXeuOHQ8OlBchtLlukLKNyiKXLvln7ueWCZW', 1, 1, 55, 129, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(768, 'MULYA.NURMANSYAH', 'MULYA CIPTA NURMANSYAH, ST., CPLM', 'MULYA.NURMANSYAH@SIG.ID', '$2y$12$ovQcZoEBqXFPBB45A/Hhhu.Hdb6x0kfpEB/u3vG0u8623Xhu7F.BO', 2, 11, 58, 130, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(769, 'MULYADI.474006', 'MULYADI', 'MULYADI.474006@SIG.ID', '$2y$12$S/97lSKcgtAy0.M5c/xwS.Rn5S0SWZ2GQ24Ds/NT1CgJ0fBCSwYCm', 3, 5, 40, 132, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(772, 'MUSMARDI', 'MUSMARDI', 'MUSMARDI@SIG.ID', '$2y$12$m8.8QVAWxpJupNr8Not9C.eROp6JZUgOqdlfu9cdays30olqwC67e', 3, 6, 28, 99, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(773, 'MUSMULYADI.BESMAN', 'MUSMULYADI BESTMAN', 'MUSMULYADI.BESMAN@SIG.ID', '$2y$12$wDMwRs0dSDLGAWjWXt/AMubS/.FCDV9xmpK1oCQSJGT/L2pg5MxfK', 2, 11, 45, 121, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(774, 'MUSPARI', 'MUSPARI', 'MUSPARI@SIG.ID', '$2y$12$hgZuEiNkSov46Cm9lAgnn.5L5SDT7A6GjKcKZPJvrYSdZVRqZElVC', 2, 7, 32, 36, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(775, 'MUSRIZAL', 'MUSRIZAL', 'MUSRIZAL@SIG.ID', '$2y$12$rPEPBy6P9DHBf40JlaozaeRMvtXTgnQo7vnNHQWOh7xhxnjg/XYTi', 2, 7, 33, 64, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(776, 'MUSYTAQIM.NASRA', 'MUSYTAQIM NASRA, ST., MT.', 'MUSYTAQIM.NASRA@SIG.ID', '$2y$12$tSGeKPTpGSybDHV7CrfJOetoixLuTtyHjWZa3FjtIdObVrHWXpA2a', 2, 10, 2, 76, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-26 20:31:41'),
(777, 'MUTIA.RAHMI', 'MUTIA RAHMI', 'MUTIA.RAHMI@SIG.ID', '$2y$12$QbjmKIam5oop/3mnsq5QU.cb6XtHWgC15CD0WWjkryMpi4WjxEngS', 1, 8, 53, 17, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(778, 'NADRY.HEROZA', 'NADRY HEROZA, ST., MT.', 'NADRY.HEROZA@SIG.ID', '$2y$12$.I6zU0j738ZfhJUkFTWSNet6g0RKZymL2eQ5GbbNdWk8GP91uQgci', 3, 14, 21, 57, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(779, 'NANDA.KURNIAWAN', 'NANDA KURNIAWAN, ST.', 'NANDA.KURNIAWAN@SIG.ID', '$2y$12$q5L6eFWr0kDbIYADefNr/uMQZSb0dLhYHVhmUZfLgcaWzXuFsrVPS', 1, 12, 50, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(780, 'NASRIONO', 'NASRIONO', 'NASRIONO@SIG.ID', '$2y$12$WzgTJ717KuYv44Tg5Hhmf.SRlOk6mWzSbOAnZmtUc9AbyUe3Bq2/i', 2, 11, 5, 137, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(781, 'NASRUL.3364', 'NASRUL', 'NASRUL.3364@SIG.ID', '$2y$12$yQqnrpsNjaIpYJ4d7t1W2uTJ4WEM3/zPNO8Kyp2BADItT0wXFVrTO', 2, 3, 54, 127, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(782, 'NASRUL.NASIR', 'NASRUL NASIR', 'NASRUL.NASIR@SIG.ID', '$2y$12$1cpWwkpEYprYABZxD2Z8kO9N4dfXPP2fPspalPP0ET7.NbXHQU5ju', 2, 7, 32, 46, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(783, 'NAZIRMAN', 'NAZIRMAN', 'NAZIRMAN@SIG.ID', '$2y$12$paDivkI8R46ABm6.I0tVROzp6yf0w0hlLSfQPkqbYyaPY/y8Tjy2m', 2, 9, 48, 20, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(784, 'NELVI.IRAWATI', 'NELVI IRAWATI S.Si, MT.', 'NELVI.IRAWATI@SIG.ID', '$2y$12$mViv698Ha6chrd2ujPW6X.HiW19GT/41PI.vUnV6a6xOBlgaxz5ES', 1, 13, 3, 97, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(785, 'NENENG.OKTAFIA', 'NENENG OKTAFIA, SE.', 'NENENG.OKTAFIA@SIG.ID', '$2y$12$/1R2ep3ScTAR4VSpek0iEeQIhEQsGYfELBtTphcmbh2Wsvfc1Q5w.', 2, 0, 56, 72, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(786, 'NICKY.ALVANDI', 'NICKY ALVANDI', 'NICKY.ALVANDI@SIG.ID', '$2y$12$yt8DEsY2nEeF2fWJBi3Cfedjs0K.Hwg17SNeWHcB506NhoLA1VYwe', 2, 9, 35, 51, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(787, 'NIKMATULLAH', 'NIKMATULLAH', 'NIKMATULLAH@SIG.ID', '$2y$12$72uQ9CoBJCYmiyAUHs0C9.6ZEj7zCL8shQVdWlaoielWR9j7sbCz.', 2, 7, 32, 62, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(788, 'NIKO.AZWAR', 'NIKO AZWAR', 'NIKO.AZWAR@SIG.ID', '$2y$12$.tvA476P/oiSbFnQejXzIeozqMMaTIk/en4jqWi26dBGenNwgU2bm', 2, 3, 16, 27, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(789, 'NIKO.KURNIAWAN', 'NIKO KURNIAWAN', 'NIKO.KURNIAWAN@SIG.ID', '$2y$12$naOxiwFJnbDBABBYTfq3ueU7e49lKnPEaBG49nT77aroe7ZU1EXR.', 2, 10, 46, 125, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(790, 'NIKO.PRATAMA', 'NIKO YURI PRATAMA', 'NIKO.PRATAMA@SIG.ID', '$2y$12$srsR46L3XHoLKyoNg/ipO.bKWnXaFLrK5XETkzr8V.XmgdCg8P2Yq', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(791, 'NILA.RENI', 'NILA PUSPA RENI', 'NILA.RENI@SIG.ID', '$2y$12$dGn1wAbten.TxGmB7W9pZ.rb7yGUxbWgsiGHoVjLQ6HN.r1BLc5Vy', 1, 1, 15, 34, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(792, 'NILVI.RAHMI', 'NILVI RAHMI', 'NILVI.RAHMI@SIG.ID', '$2y$12$1LedPV1nzzZfVvfmlbMEB.5bVKWFlEj/YSBBYh87Bde7D5PquiqnS', 3, 5, 6, 90, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(793, 'NISFA.NETRI', 'NISFA NETRI, ST.', 'NISFA.NETRI@SIG.ID', '$2y$12$PBp7637DpucYTAOmDAeyHuA2x8b.qUc4/95oSE0QLH4jgKF/jtB42', 3, 6, 28, 99, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(794, 'NOFRIZAL', 'NOFRIZAL', 'NOFRIZAL@SIG.ID', '$2y$12$GjT2NJE8A61PyXirKqxui.dM.ZTdT4KwusqTmRCcFYgzJr.vxg7VG', 2, 3, 39, 16, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(795, 'NOKI.ENDRISON', 'NOKI ENDRISON', 'NOKI.ENDRISON@SIG.ID', '$2y$12$X6qDoQa6Nxk2Cs9ltlqzP.F7M.5XtcmI69lsvIJsl0c5A8SpRG982', 2, 11, 45, 111, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(796, 'NOVENDRI.IDRUS', 'NOVENDRI IDRUS', 'NOVENDRI.IDRUS@SIG.ID', '$2y$12$kTDL8n5qQgqw1yAGG30z0eMTTv7rykrU9.PCDRJrFWU/YSFfA4KFC', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(797, 'NOVI.ANDRI', 'NOVI ANDRI', 'NOVI.ANDRI@SIG.ID', '$2y$12$zknqsrIF.xhPjEzqFLXf6OwH7wAu91yNoaJ0XsV5hKVH7LYLVgMqi', 2, 7, 30, 115, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(798, 'NOVI.BUSRI', 'NOVI BUSRI', 'NOVI.BUSRI@SIG.ID', '$2y$12$KclRs989h8WAaEGqvfos9es3xbTbEnfvmKS3qCOp7RWOK9K/sD9MC', 2, 7, 33, 64, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(799, 'NOVI.YENI', 'NOVI YENI, S.M.', 'NOVI.YENI@SIG.ID', '$2y$12$JICIVCXCymKgMUpemnjz1ubjaAR/B5mMMULbklQELvwlv9nqAFei6', 2, 3, 27, 54, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(800, 'NOVIA.HARMILAWATI', 'NOVIA HARMILAWATI, AM., KEB', 'NOVIA.HARMILAWATI@SIG.ID', '$2y$12$K5TzPK5fcwis6CWzcsP5eOVFZSR3ifGIGgGGs6jNwVvSB602cLZGG', 3, 6, 26, 114, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(801, 'NOVIAN.HELMI', 'NOVIAN HELMI, SE.', 'NOVIAN.HELMI@SIG.ID', '$2y$12$GiCgrkkeKdaoTCoghyIztudE2aOhN0jeYtno.TlszcI/ZvKMDmbse', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(802, 'NOVIAN.HENDRA', 'NOVIAN HENDRA', 'NOVIAN.HENDRA@SIG.ID', '$2y$12$gQugvD7W.aHFubEZQWMiOehZK1qRrzmktpWmpSbnEBSsgFcJOlAxe', 2, 10, 46, 125, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(803, 'NOVIAN.SISKA', 'NOVIAN SISKA', 'NOVIAN.SISKA@SIG.ID', '$2y$12$c.pxxkRTQRDoICVm8LI5..G/O7hUDFE/qs.ks828eXUoWI3nhr4Vy', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(804, 'NOVRIZAL', 'NOVRIZAL, AMD.', 'NOVRIZAL@SIG.ID', '$2y$12$jFPs/mFoIpKgHDxlulGh6ewxpOHNAIxiEXcDRkjPAYilp2u/OAWyu', 2, 9, 35, 25, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(805, 'NUR.ANITA', 'NUR ANITA RAHMAWATI, ST.', 'NUR.ANITA@SIG.ID', '$2y$12$hB.nCYSCl1kO6smgjhoEL.EMI1GmwrQBeSh9DZ5xEKi0N/7lZGKeO', 3, 6, 25, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(806, 'NURALIB', 'NURALIB, ST., MM.', 'NURALIB@SIG.ID', '$2y$12$YN1rnwlv2gElBD.0sN/QgOqAyWlUQRjC5jrOCXoHCQ6NisPud3PzG', 1, 13, 3, 97, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(807, 'NURFITRI.SAUFAYURA', 'NURFITRI SAUFAYURA, SE.', 'NURFITRI.SAUFAYURA@SIG.ID', '$2y$12$MBtxhCiHJRHj3A1Sqo1uUufQjT0z3Dzeiw14wj8XvHrYNuH9XzCxq', 2, 11, 23, 92, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(808, 'NURMA.NENGSIH', 'NURMA NENGSIH', 'NURMA.NENGSIH@SIG.ID', '$2y$12$1JWOavUZlIsncsP4NopoE.z8Bjr2S86yR5j2P93UpKZvm8mB0Zx76', 1, 13, 3, 97, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(809, 'NURMA.YANTI', 'NURMA YANTI, SE., Akt.', 'NURMA.YANTI@SIG.ID', '$2y$12$tyhkxu3Z1oe8Xqtv7DXH7OL5G0/uWabXGLrsxEl9L2UapgPs7EPNu', 1, 13, 3, 97, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(810, 'NURUL.ANNISA', 'NURUL ANNISA, SE', 'NURUL.ANNISA@SIG.ID', '$2y$12$wBghU./zw6M3OyDNeTMr2uPUX5Np3oBVeIWHnp5IGn5.xKpe2sH9C', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(811, 'NURWAN', 'NURWAN SP', 'NURWAN@SIG.ID', '$2y$12$xnasd2NJz0yT6f6ObJjInecjW5wv3L72NCm24oq/GrJCyHzW589Oa', 1, 1, 15, 119, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(812, 'OGIE.MARTADINATA', 'OGIE MARTADINATA', 'OGIE.MARTADINATA@SIG.ID', '$2y$12$1g.ZrT8bdyqmZk8Ss8XsjeBN1lDzyjShZO2cK9rn7SiYRQ.mBqM6.', 2, 7, 18, 47, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(813, 'OKKY.SAPUTRA', 'OKKY HARY SAPUTRA', 'OKKY.SAPUTRA@SIG.ID', '$2y$12$r/HAmwJDb9GbFDQ6ag6oZeRgVloE0Mkv/lgfu0bQsbPEZGHnWji.y', 3, 14, 31, 103, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(814, 'OKTARIZALNI.PUTRA', 'OKTARIZALNI PUTRA', 'OKTARIZALNI.PUTRA@SIG.ID', '$2y$12$dCOosXG44BnZoUCePOyBxOq9k84IqZiw6gKgFFL1VyPYsP85oj/U.', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(815, 'OKTAVERI', 'OKTAVERI', 'OKTAVERI@SIG.ID', '$2y$12$QQhG3tsvdZRXx07M1v9yJe0zqlOSzKhRftBd/D8.JrryXAVIjIg02', 1, 1, 14, 84, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(816, 'OLGA.NIRA', 'OLGA DE NIRA', 'OLGA.NIRA@SIG.ID', '$2y$12$hi1sy/2cikzzvsSHt5h1B.gjgfiY3qWqDvQLwO7gzavKKycE2xTCa', 3, 5, 6, 90, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(817, 'ONDRI.R', 'ONDRI R, ST.', 'ONDRI.R@SIG.ID', '$2y$12$bg/LOwMY5MZXuaO6NPq9z..EmzvTh1IjHKa8betslTg5hHppPQouq', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(818, 'ORIX.KARYA', 'ORIX BERY KARYA', 'ORIX.KARYA@SIG.ID', '$2y$12$dYqEBiRFySGZuW5WcgTGGO2CNu1RqDbJonzBRVuevrgSUauhtFi/u', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(819, 'OSKAR.HARIS', 'OSKAR HARIS', 'OSKAR.HARIS@SIG.ID', '$2y$12$NWW.JWOjMRN1kawcH7gUjuxD1vpRyQ.PQEsdpzqHMFAszfDacV.HG', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(820, 'OXIVIA', 'OXIVIA, SH.', 'OXIVIA@SIG.ID', '$2y$12$XoxPMYi7Qqu1frUzreAeyOqijv8Fp4S5.2PNDPk3Zwk/N7cgdvnnW', 1, 1, 29, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(821, 'PALMAN', 'PALMAN, ST.', 'PALMAN@SIG.ID', '$2y$12$5La2rfK6k5uTTqQfrNH73.18N6MLb2h5J0JqFpglkC8MolPXetOia', 2, 3, 39, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(822, 'PANJI.AGRAMA', 'PANJI DWI AGRAMA, SE.', 'PANJI.AGRAMA@SIG.ID', '$2y$12$v2xI9A.E4eSSIO/VZASw1u4hDc2HctG87yr7sLeaWy9SBXrgenKre', 2, 3, 54, 127, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(823, 'PARYONO', 'PARYONO', 'PARYONO@SIG.ID', '$2y$12$Q39f/utqXZWXm9i0smT8eeCQSe6p/Cs2bJD3/7gP/Z4riWYqd30vG', 3, 14, 21, 57, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(824, 'PAULO.ROSI', 'PAULO ROSI', 'PAULO.ROSI@SIG.ID', '$2y$12$VzYax47dRPHQfHCxkiJY0ezguTTeojPJaROeJn/Fdq2qZrtMkXVoe', 2, 7, 33, 64, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(825, 'PEBRIANTO', 'PEBRIANTO', 'PEBRIANTO@SIG.ID', '$2y$12$YVKgX24b6cWjbcGBEFePNOmyJRAvJhV4q5qnloSZiceSHh/9E.UDu', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(826, 'PINTO.BAPANDA', 'PINTO BAPANDA', 'PINTO.BAPANDA@SIG.ID', '$2y$12$DPVprcQcCK8z2ruOutPkt..3iZaH.kuSQfNofiLkpvU/jmAsdOrFy', 1, 12, 38, 24, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(827, 'POVIA', 'POVIA', 'POVIA@SIG.ID', '$2y$12$kItFulDibaBhfEbERqlsXu6.dp6k4nHNi/XtYDIKsQmtf/pe9gDr6', 3, 0, 34, 104, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 21:24:50'),
(828, 'PRAMITA.SICILLIA', 'PRAMITA SICILIA', 'PRAMITA.SICILLIA@SIG.ID', '$2y$12$1YCy9Of8e5DsP8GAYF5NuOsj9/IqdveDeAnCZUpQyULIglk4RhV6K', 2, 10, 44, 118, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(829, 'PRIMA.YUAFRIZA', 'PRIMA YUAFRIZA', 'PRIMA.YUAFRIZA@SIG.ID', '$2y$12$inb104GkXwA.vm6kHALCquFT4mQwRMkYbzqSbKyhpKu99Gbs6aEw2', 3, 15, 0, 78, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(830, 'PRINALDI', 'PRINALDI', 'PRINALDI@SIG.ID', '$2y$12$YDlREuDHWHw4gX3gmPXuveaegnmF.H7/JQuJCgz3HOE9ocklcjPaG', 2, 9, 41, 28, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(831, 'PULI.MUHKLISIN', 'PULI MUHKLISIN', 'PULI.MUHKLISIN@SIG.ID', '$2y$12$esj0ZcCPflFt4UNwlacbTubam3TynEygC6s8vfZxQNdYVHTTIvdwK', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(832, 'PUPUT.DIANA', 'PUPUT DIANA', 'PUPUT.DIANA@SIG.ID', '$2y$12$W7z3rKLlpy5B.fglumhYG.aPNNB/M1Zw5t196HskiqKQX6.Yo.FfW', 1, 1, 29, 100, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(833, 'PUTRI.PALUPI', 'PUTRI PALUPI, ST.', 'PUTRI.PALUPI@SIG.ID', '$2y$12$rwavSV.9g1bLIoI2WQM6V.wquS7v2ptvSMF0apJ6tAUmQkK1AnI5O', 2, 11, 57, 87, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(834, 'RAFKI.BUDIMAN', 'RAFKI BUDIMAN', 'RAFKI.BUDIMAN@SIG.ID', '$2y$12$PZPLnMhJ2gYap.jX55HwRez3MB5eMebdg7OxO8UvQBEWgQzhINsNC', 2, 7, 17, 45, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(835, 'RAFKIE.AULYA', 'RAFKIE AULYA, ST.', 'RAFKIE.AULYA@SIG.ID', '$2y$12$D1GWXISi6LxYzYQiGg46fu4tnzCACLADwM3xMWrND8wwfd0W5c9O2', 2, 3, 7, 14, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(836, 'RAFRIZAL', 'RAFRIZAL', 'RAFRIZAL@SIG.ID', '$2y$12$nQMsxxc0M.KUe5R/xPaAe.GuWoeQJtbwtrGDhBVXXDhpZyTiEM5Y2', 2, 3, 39, 68, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(837, 'RAFSANJANI.CHARLI', 'RAFSANJANI CHARLI, ST.', 'RAFSANJANI.CHARLI@SIG.ID', '$2y$12$1joPTA9G9q6c4E4sty8NnOMtJ8eHVFMkbDf.6ZNyZZrFwk1haCSbe', 2, 11, 45, 121, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(838, 'RAGIL.SUKMANA', 'RAGIL SUKMANA', 'RAGIL.SUKMANA@SIG.ID', '$2y$12$2d1aDugiozdN8RDNH/LqRuBP9gFG7Yl9c9QcLQoNbxbST5cGRpUAm', 1, 12, 52, 13, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(839, 'RAHIM.RAZAKI', 'RAHIM RAZAKI', 'RAHIM.RAZAKI@SIG.ID', '$2y$12$Wvnozzp15aNlZMUZbFpjD.3H2VHXc3ObkxMtPNsfF.YTnTkjnbGBG', 2, 3, 39, 5, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(840, 'RAHMAD.ARDIANTO', 'RAHMAD ARDIANTO', 'RAHMAD.ARDIANTO@SIG.ID', '$2y$12$beuy/5bmZyd6oXpyDn0kS.8LRDzj.2Jx9wvZP./cSnKVA14b.JW9y', 2, 7, 17, 35, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(841, 'RAHMAD.HENDRAWAN', 'RAHMAD HENDRAWAN', 'RAHMAD.HENDRAWAN@SIG.ID', '$2y$12$TSW5ay3Kq2pQEJyql.IR0.OJySwVA/39/HaU.FvHjJKBxkwy.rgX2', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(842, 'RAHMAD.HIDAYAT7522', 'RAHMAD HIDAYAT', 'RAHMAD.HIDAYAT7522@SIG.ID', '$2y$12$YhTwSKv/eZXPjm1kGMLnauJ53mEw424RO5YsSvefGPOcGwtnMU/j6', 2, 10, 46, 125, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(844, 'RAHMAD.PUTRA', 'RAHMAD PUTRA', 'RAHMAD.PUTRA@SIG.ID', '$2y$12$UJqY4TidUY5M2XIw.yuTV.kz1by.FwmLZzZO/vvUnUafAa6d6iSRO', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(845, 'RAHMAN.PUTRA', 'RAHMAN ETIKA PUTRA, S.Kom.', 'RAHMAN.PUTRA@SIG.ID', '$2y$12$eaCvdy/AhAHZL20KtWumU.l/aXw7AFdbcqumsQBmUpWNj0IS1V2om', 2, 10, 44, 118, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(846, 'RAHMAN.IKHLAS', 'RAHMAN IKHLAS, ST.', 'RAHMAN.IKHLAS@SIG.ID', '$2y$12$/mF7mD2Lp0h664iqnvYLje1Xb5ofeVtEkSXctzgxQnl8PaMuGtnMm', 2, 11, 45, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(847, 'RAHMAN.SATRIA', 'RAHMAN SATRIA', 'RAHMAN.SATRIA@SIG.ID', '$2y$12$xORT9cabDFZOypoxeH0KF.7B.VfYxtJIiWz8JW3d9xf2pn.WbJHCO', 2, 11, 23, 92, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(848, 'RAHMAN.SUJANA', 'RAHMAN SUJANA, ST.', 'RAHMAN.SUJANA@SIG.ID', '$2y$12$UsiuHNfPmqSPnzcehgi.rO1wBbHTdWMfd1ZLdLtHPtf.TSlc3eXua', 2, 4, 13, 60, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(849, 'RAHMAT.DINATA', 'RAHMAT DINATA', 'RAHMAT.DINATA@SIG.ID', '$2y$12$Uxqx8DHXqyy5AMmHxxuKveOC0Un5s2I7KqXV33AJb3ke5LITYWm1u', 1, 12, 38, 50, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(850, 'RAHMAT.NOVRIYAN', 'RAHMAT NOVRIYAN, SE., Akt., CA.', 'RAHMAT.NOVRIYAN@SIG.ID', '$2y$12$p1t7Sy2BRFdXRddTjcnjlOsWb4Zp0MDajC/gKKAjreT3hoJMmGvey', 3, 5, 6, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(851, 'RAHMI.MUTIA', 'RAHMI MUTIA', 'RAHMI.MUTIA@SIG.ID', '$2y$12$e7Ukj66vPMD0qyET69Mz5.MDyehvPj1TGD22Y2YidOS5.ytk5euV.', 3, 5, 40, 112, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(852, 'RAMA.SANOTO', 'RAMA SANOTO', 'RAMA.SANOTO@SIG.ID', '$2y$12$4wOTe9dEc.M2Ta8Fd4PNXOIHcGZeXEdQ7PtuQz248RvyklKKtqq3C', 2, 3, 16, 26, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(853, 'RAMADHANI.EFENDI', 'RAMADHANI EFENDI', 'RAMADHANI.EFENDI@SIG.ID', '$2y$12$5E2Cp..K/Udefdbn4NABMey1ve2x9Dku53BFdd.Jnojs6JrWdz63a', 2, 3, 16, 27, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(854, 'RANDI.DALVIANDRE', 'RANDI DALVIANDRE', 'RANDI.DALVIANDRE@SIG.ID', '$2y$12$XKb6EyW4nbmRx9JQozsAaeAYJMntM/QaCNyR5X6sgNIH2cRj7nKPS', 3, 0, 34, 104, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 21:24:50'),
(855, 'RANDI.SAPUTRA', 'RANDI SAPUTRA, S.M.', 'RANDI.SAPUTRA@SIG.ID', '$2y$12$sPgaHeE5dbk2khsoG1RS8Of8NGbh3I1m85t4Q5gbE2f1venT1epR2', 2, 10, 43, 41, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(856, 'RANDI.TRINANDA', 'RANDI TRINANDA', 'RANDI.TRINANDA@SIG.ID', '$2y$12$R2iuiOyd7gc0Pm4HgXqnceHSHz4zO1.Q1PD/JVoNZhfHRFYnlKXTi', 3, 14, 21, 53, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(857, 'RANDY.WIRMAN', 'RANDY SURYA WIRMAN', 'RANDY.WIRMAN@SIG.ID', '$2y$12$j6MBMYTPHYmpzBYDhJrKgeFrif.7C65UOX4TP1AMRu2bo9zfqqCIq', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(858, 'RANGGA.LOEIS', 'RANGGA LOEIS', 'RANGGA.LOEIS@SIG.ID', '$2y$12$S/ThCCPyjFu6g.mXj0HlPe6fwYs3KPFU24OETfcVR0kfUJoFJnmaK', 3, 14, 31, 103, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(859, 'RATHOMI.ANDIKA', 'RATHOMI ANDIKA', 'RATHOMI.ANDIKA@SIG.ID', '$2y$12$mHu4uJeutd9337VSIKbnkenUlkBMcX0N5zInS7p363zjPOyW3gMBG', 2, 3, 11, 37, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(860, 'RAUSYAN.FIKRI', 'RAUSYAN FIKRI, ST.', 'RAUSYAN.FIKRI@SIG.ID', '$2y$12$j03vbNOCVB5yiIVhHTzCrOqPkqEdHcJYPqJeWuJbv4XwdZppRrdYm', 2, 11, 10, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(861, 'RAVIKO.MAAR', 'RAVIKO MAAR', 'RAVIKO.MAAR@SIG.ID', '$2y$12$ZaD5MQnyIi5guh4pz7MK7uX/cUp1ihGncZxgd0IqOupSqtZb3Hbbi', 1, 1, 14, 128, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(862, 'RAYNALDO.NUNYAI', 'RAYNALDO HAYARA NUNYAI', 'RAYNALDO.NUNYAI@SIG.ID', '$2y$12$kirkKq3r73GxYgj4r1oH.ul9lCUmXieutzqcmeMOz5bkOheIwpeEe', 1, 1, 29, 126, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(863, 'REBY.ABRIAN', 'REBY ABRIAN', 'REBY.ABRIAN@SIG.ID', '$2y$12$kWZK6B6IlPSoiCkKqlh7y.ZaLEK/RBn82rgtOebF2WFbIG1F/Olsu', 2, 10, 43, 83, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(864, 'REFFIWATI', 'REFFIWATI, SE.', 'REFFIWATI@SIG.ID', '$2y$12$OcQtWRQZJf2/QZmN9S8qQeRI4v2aEEyr.pcj9fNZdQIeCFU/s/0eW', 1, 8, 53, 17, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(865, 'REFI.RISKO', 'REFI RISKO, SE', 'REFI.RISKO@SIG.ID', '$2y$12$fX9MkBaIg5mtBvpwNlbC8uU4wh08LxHo/Ab0Up7/UDd/NslXQFlS2', 1, 12, 38, 24, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(866, 'REFKI', 'REFKI, ST', 'REFKI@SIG.ID', '$2y$12$Lo0QUnGBVTEnXSNtekRhAObAYqTUzJ4pblGt1ywemIRvUnw6MrY6y', 2, 9, 48, 21, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(867, 'REGI.PUTRA', 'REGI ENDA PRIMA PUTRA', 'REGI.PUTRA@SIG.ID', '$2y$12$TPezLPI232LiTk.vTbbtLuYr.OOXwI.W143RGM/igjFCgL35HFM5a', 2, 7, 32, 36, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(868, 'RENDY.FAHLEVI', 'RENDY FAHLEVI, ST.', 'RENDY.FAHLEVI@SIG.ID', '$2y$12$Iq05IGqOYZscJaqKFoIkOOxqDxmjSIH9pQ/X7BrtniSRdeu7t68PW', 2, 2, 8, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(869, 'RENDY.HIDAYAT', 'RENDY HIDAYAT', 'RENDY.HIDAYAT@SIG.ID', '$2y$12$6dIITkkv2NHlM4ehlq5tcu2Oow7UQq3gGbhUVnL/TuEQAyPx5yz0.', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(870, 'RENI.RAHMADHANI', 'RENI SARI RAHMADHANI, ST.', 'RENI.RAHMADHANI@SIG.ID', '$2y$12$KuZLFJwGZd0i4OvVs1rt.eLe/9h07gzrA44EpTwlAQQDMeRDiU9g6', 3, 0, 34, 104, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 21:24:50'),
(871, 'RENO.GUSTI', 'RENO HARYANTO GUSTI', 'RENO.GUSTI@SIG.ID', '$2y$12$r7b8CSTH83ljtaqzTGC1VOR0B26mKUtHHzTjCsuER3zdG41BYSWqS', 3, 5, 40, 132, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(872, 'RENO.ZAPUTRA', 'RENO ZAPUTRA', 'RENO.ZAPUTRA@SIG.ID', '$2y$12$dRM4D7IJ3Sa3Qg36irg0UeQZmMHcKw.2XJEo96BG2SfB7x1u31/Fy', 2, 3, 11, 44, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(873, 'RESMADEWITA', 'RESMADEWITA, SE.', 'RESMADEWITA@SIG.ID', '$2y$12$RD8bHSQs9f6cO1hnGgOY.enxHsJC5gih4enkzEigZl.Pap1v3EAH6', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(874, 'RESTY.NOER', 'RESTY NOER', 'RESTY.NOER@SIG.ID', '$2y$12$ktbUpKYvS3vHOYdh.EJeZ.rZmCJNScyaQWEzP7qHDPm/SdG2DIe7C', 1, 1, 14, 128, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(875, 'RESY.WARDIA', 'RESY WARDIA', 'RESY.WARDIA@SIG.ID', '$2y$12$98mu5pILvIPXq1.cEYETXuij4hZ58cyheK5wn.YWLuZrRNpBx.Jfa', 2, 3, 54, 127, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(876, 'REVELINO.PUTRA', 'REVELINO ANDY PUTRA, SE.', 'REVELINO.PUTRA@SIG.ID', '$2y$12$QWHC7SnaaoCJZKECRY7cmuDvDNIohtE1PlXsi9GexjTLKYmOz.Hwq', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(877, 'REZA.MUCHTAR', 'REZA MUCHTAR', 'REZA.MUCHTAR@SIG.ID', '$2y$12$zDpbaHWZ.lY190OfnfObIeIHdkB2Jl3qmVQq7FsBkNKX0sIGD9mie', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(878, 'REZHA.ARNALDY', 'REZHA ARNALDY', 'REZHA.ARNALDY@SIG.ID', '$2y$12$LrJkhmNabBohPVVgEd81AuTY44oez2h1Ql2bAqSG.5bkhQa3/6kn2', 2, 9, 48, 20, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(879, 'REZY.ADAM', 'REZY MELANO ADAM', 'REZY.ADAM@SIG.ID', '$2y$12$FQspCqQFqPpon68iEocLseQe3imVNYL9psdEkwX/Cuo.92iI5/SAu', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(880, 'RICARD', 'RICARD', 'RICARD@SIG.ID', '$2y$12$uGwJgJZxPaksSQg1PEPN6.b01q9x/dVAyvcWUXYh3tbjDJkaQvw1.', 2, 9, 35, 51, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(881, 'RICKO.FURGANI', 'RICKO OKTA FURGANI', 'RICKO.FURGANI@SIG.ID', '$2y$12$wZvbF6z4zP0T6AbqGw9YtOiSljnFrtW2vikAFpsynbxWHKpOxw5LK', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(882, 'RICKY.AMRANUS', 'RICKY AMRANUS', 'RICKY.AMRANUS@SIG.ID', '$2y$12$rE1uwKAwjR2mgbXoVGOc9eA54PiiQ0RV9fg2cfbBDWddYzt4tCA0W', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(883, 'RICKY.APRINALDO', 'RICKY APRINALDO, ST., Ir.', 'RICKY.APRINALDO@SIG.ID', '$2y$12$T6h33yUo27uLPVd0n4NgduvuV/CsEwOMltELJ1kd/lEqD821GpLES', 2, 9, 48, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(884, 'RICKY.SYAHPUTRA', 'RICKY EDI SYAHPUTRA', 'RICKY.SYAHPUTRA@SIG.ID', '$2y$12$PdRdeIIJBOjduSzN.KXhY.IK5zBJcnpDiHfk2hUZfaAMPDaQwPeNG', 2, 9, 48, 20, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(885, 'RICKY.KURNIAWAN', 'RICKY KURNIAWAN, ST.', 'RICKY.KURNIAWAN@SIG.ID', '$2y$12$tg4w96bJ/zVhs80hBTxMPOWHmoTu.6bHSND8Jw.eSDQtxobMyn02W', 2, 0, 56, 109, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(886, 'RICKY.ANGGARA', 'RICKY PRASETYO ANGGARA', 'RICKY.ANGGARA@SIG.ID', '$2y$12$i2QjKiZGh6/adbR1.2Bu/uITLYTNwhKaLgMafVIONMOJbMa/cBwVS', 2, 7, 30, 101, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(887, 'RICKY.MAHYUDIN', 'RICKY PUTRA MAHYUDIN, SE', 'RICKY.MAHYUDIN@SIG.ID', '$2y$12$3VZpU7TirbM0sCmL7NyIz.9rEBMvr7Mi9nbJbwvTJOO95CdLQ05hK', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(888, 'RICO.PRASETIA', 'RICO PRASETIA', 'RICO.PRASETIA@SIG.ID', '$2y$12$7v1m46rY37.rYPTUEU.ETuCFfauGvOK7J.BKL.KXzbDf2I6/1fob.', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(889, 'RICOYAN.UTAMA', 'RICOYAN PUTRA UTAMA', 'RICOYAN.UTAMA@SIG.ID', '$2y$12$opq2pkokJFt3s2VwjpibjOQqo4g4UqZ9I.lYOzQ0CCjgFJLGb5hYK', 2, 9, 35, 51, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(890, 'RIDHO.ALTERNOFSINT', 'RIDHO ALTERNOFSINT', 'RIDHO.ALTERNOFSINT@SIG.ID', '$2y$12$qrFT/fnPHIcUsnVzc9y/Ru7NH4.Qw3I8tfSael0GFKIlZTe6Y/lWm', 3, 6, 26, 114, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(891, 'RIDHO.ARISANDI', 'RIDHO ARISANDI', 'RIDHO.ARISANDI@SIG.ID', '$2y$12$oI0DHbsLEyZz4NpHjwNN2OR0dN.w19ZmRgvFGdxFMGyaPCA.8vcvu', 2, 7, 30, 115, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(892, 'RIDHO.FAJAR', 'RIDHO FAJAR', 'RIDHO.FAJAR@SIG.ID', '$2y$12$.SqYsSzJPiIoLEK5dJrXDuOxta8N6dAD8c.UTXGlJrB6u8ZlYjvfO', 2, 10, 43, 41, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(893, 'RIDHO.PERMANA', 'RIDHO PERMANA, S.Ak', 'RIDHO.PERMANA@SIG.ID', '$2y$12$V2oMXCOn8ricr/rag9LyLOsjnaTCgU02/g1yADWrCZ34NfWk90xZO', 3, 5, 6, 90, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(894, 'RIDO.ANDESTA', 'RIDO ANDESTA', 'RIDO.ANDESTA@SIG.ID', '$2y$12$EVBQxHWxKMbRLSMkKhCEDew3DGfA6uGo0tGBZorUUJV83oLvMloqO', 2, 2, 9, 117, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(895, 'RIDO.SAPUTRA', 'RIDO SAPUTRA', 'RIDO.SAPUTRA@SIG.ID', '$2y$12$/9ptzSQNUaSSO8l0WpX6N.JzsXhgfsgEIQVCVlZruqbWjak0ZJH0a', 2, 3, 39, 16, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(896, 'RIDWAN.3402', 'RIDWAN', 'RIDWAN.3402@SIG.ID', '$2y$12$D..hpYWTC43d8yBdSSLnFeU2Skj1cGH.fSdX5aGBeX/RiSJm1zPVm', 2, 7, 32, 43, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(899, 'RIDWAN.MUCHTAR', 'RIDWAN MUCHTAR, ST., MM.', 'RIDWAN.MUCHTAR@SIG.ID', '$2y$12$dRCARjRhn8D0TnORw4hVqeJYnkQBkBkRUBWZbQL6295UYjIJ3SBgG', 3, 14, 0, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(900, 'RIEZALTS', 'RIEZALTS', 'RIEZALTS@SIG.ID', '$2y$12$in8ONrj6xTBY68HIhcHybeguQ0wPG6Bev3uP6yMIknoxfOypjrJFO', 2, 9, 41, 28, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(901, 'RIHAN.FERNANDO', 'RIHAN FERNANDO', 'RIHAN.FERNANDO@SIG.ID', '$2y$12$.CHHs1OyKmRz5xXXaj9WnORG7VAK/RU9dA./F7gwTSQ1rawLfHzgK', 2, 9, 48, 20, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(902, 'RIJAL.AMRAN', 'RIJAL IVANTRI AMRAN, ST.', 'RIJAL.AMRAN@SIG.ID', '$2y$12$nyA2RLhMBbHpeZAnvow7dO8LgE9ug.2r4Ga8ESRruEUgDxM2vQzS.', 2, 9, 35, 52, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(903, 'RIKA.HANDAYANI', 'RIKA HANDAYANI', 'RIKA.HANDAYANI@SIG.ID', '$2y$12$VzOhzJ6vHDIIdlBAK.uFkewkxOe8A7p9wPAgzBYKiO43RJ6an/IIe', 2, 11, 23, 92, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(904, 'RIKA.RACHMAN', 'RIKA RACHMAN, SE.', 'RIKA.RACHMAN@SIG.ID', '$2y$12$YGIQ4cw21MYAcmAA9urWn.gqgMDQhsoYU3v9yFoo0GpNlcrZXufgK', 2, 0, 56, 88, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(905, 'RIKAWARNI', 'RIKAWARNI, ST.', 'RIKAWARNI@SIG.ID', '$2y$12$015D3x2savSxL2EHCXCj/Oy.zwdssIwBhaKCRP8Q8huDsUy0XA9v.', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(906, 'RIKI.PUTRA', 'RIKI REGA PUTRA', 'RIKI.PUTRA@SIG.ID', '$2y$12$3hjxmeU95UWl.7S68DCNpe/UZ/dk6x3zRk0Ts8FIdeaiA0/HXfL2O', 2, 2, 8, 79, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(907, 'RIKI.SAPUTRA', 'RIKI SAPUTRA, ST.', 'RIKI.SAPUTRA@SIG.ID', '$2y$12$uZUtsT6eA/xT2Y1y5wDZUucgcGDkksktvNn2MwMiOJC.fNRgnk9B.', 2, 7, 18, 66, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(908, 'RIKI.ZUHENDRA', 'RIKI ZUHENDRA', 'RIKI.ZUHENDRA@SIG.ID', '$2y$12$MXJiJyNy/0pxSZQy0ik4Hez.tcZy2MAZt05FKYGYdIjiutdZfZtCe', 2, 7, 18, 38, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(909, 'RIKO.DARMANTO', 'RIKO DARMANTO', 'RIKO.DARMANTO@SIG.ID', '$2y$12$9QGoi.Nuk.47bds3GDCke.uufu1fQrkJFJgNUdpbSOsAB8PlaXmSK', 2, 7, 19, 31, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(910, 'RIKY.SYAMSIR', 'RIKY SYAMSIR', 'RIKY.SYAMSIR@SIG.ID', '$2y$12$Z2RsAtROh3ErRV9WEgPnNezBK2o6wWBKmcNSEHBF4S19PwX5Ek/Pa', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(911, 'RIKY.SYURYADINATA', 'RIKY SYURYA DINATA', 'RIKY.SYURYADINATA@SIG.ID', '$2y$12$zcrFoqiJTD/HBqJTnIYHIOrtqUFZrSvXa.hS30B2/6GlXYToRXL7W', 2, 7, 30, 115, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(912, 'RINALDI.SIHOMBING', 'RINALDI GUNAWAN SIHOMBING, ST', 'RINALDI.SIHOMBING@SIG.ID', '$2y$12$0mOK8MH3Muy20Tjvj6U1ROJLbROrN0FNc3XeVM0tHRpHpnR3H3yLi', 2, 7, 32, 62, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(913, 'RINALDI.3262', 'RINALDI, SE.', 'RINALDI.3262@SIG.ID', '$2y$12$AEK3AAZJullfNyag9MoaIO4X4et0vP9/NV2u8e9NOKe6RMVulzdHe', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(915, 'RINALDO.SAPUTRA', 'RINALDO SAPUTRA', 'RINALDO.SAPUTRA@SIG.ID', '$2y$12$Vvef9Dsa9h907LIemB6ZXuUZYWGnWIzS9m0N3Uj1X4JuYulUfDT8C', 2, 3, 27, 69, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(916, 'RINI.YANTI', 'RINI ADRI YANTI, S.Psi., MM.', 'RINI.YANTI@SIG.ID', '$2y$12$03p5RwyZdbU6bfCZsfD3yOZiWX/wXg178XsWVO65/xMYUvVk6kdd.', 3, 6, 28, 99, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(917, 'RINI.UTARI', 'RINI UTARI', 'RINI.UTARI@SIG.ID', '$2y$12$2USwsoLYtj3iQvUUtQ2oNuo30IHT6h00TSooZv5Ip43Jyvpq3HZ/C', 2, 0, 56, 109, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(918, 'RINNI.SYAFNITA', 'RINNI SYAFNITA, SE.', 'RINNI.SYAFNITA@SIG.ID', '$2y$12$oDDeRRL8eN4tCjgwuthMz.PbMi7d9svuTIhDBJMUreXeCk61okLMi', 3, 0, 34, 104, 4, 0, 0, 0, NULL, 1, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 21:24:50'),
(919, 'RIO.SAPUTRA', 'RIO ANDI SAPUTRA', 'RIO.SAPUTRA@SIG.ID', '$2y$12$Rre4CM13vT/ZNU7df5CosuRdU0qBAGsE9IghdO0FTyH4EyGupEUvy', 2, 7, 33, 64, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(920, 'RIO.FAHMA', 'RIO FAHMA', 'RIO.FAHMA@SIG.ID', '$2y$12$gITYyDRF1E7SMUCOFOOMqe8Fs2cyfJL3bnjD68.Zq5H5K5WRIlkci', 3, 0, 34, 104, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 21:24:50'),
(921, 'RIO.MAYKANDRA', 'RIO MAYKANDRA', 'RIO.MAYKANDRA@SIG.ID', '$2y$12$Z0uyRYY/dEN0ZATGz8OaG.A.IU7AY8xWyokT5F2lay6riKeoVfq7q', 2, 3, 54, 127, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(922, 'RIPOS.MARDONA', 'RIPOS MARDONA', 'RIPOS.MARDONA@SIG.ID', '$2y$12$VLSZu5fdhqeqen2poDWD4e/QJRrR5U5iJ/ZQwgv9FpUu8EHSpmvuS', 2, 9, 36, 106, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(923, 'RIRI.HARFENDA', 'RIRI HARFENDA', 'RIRI.HARFENDA@SIG.ID', '$2y$12$adakov1cG9Vig86g0IGbHeGnoV2PlrRWs7Gay/HVhTkRXHiMjNsk2', 2, 10, 43, 83, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(924, 'RISA.PRIMAYANI', 'RISA RIZKI PRIMAYANI, SE., MM.', 'RISA.PRIMAYANI@SIG.ID', '$2y$12$NSYEeZhTRfa.rdqIfyvSnuEM18Gg0oijqu3HTZnth1AYN9QTR4YhG', 3, 0, 24, 93, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(925, 'RISE.SANJEZ', 'RISE SANJEZ', 'RISE.SANJEZ@SIG.ID', '$2y$12$bruOXIlmdWI4.JdFI0OLrOBw16UBHUSUUDaJ4Ye7YWEr6Dh5S7ZbS', 3, 14, 31, 103, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(926, 'RISKA.APRODITYA', 'RISKA APRODITYA, ST.', 'RISKA.APRODITYA@SIG.ID', '$2y$12$QshkGfbyZyyT920Bjk7RP.xk3csYXRZBk/UGQR4u1xwndM/XIptiW', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(927, 'RIYAN.HERMAWAN', 'RIYAN HERMAWAN', 'RIYAN.HERMAWAN@SIG.ID', '$2y$12$amHMuv194tesyhBqZ80kr.CDmX0nzDAbcHRJD2m5u11Rs3.eqeb/S', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(928, 'RIZAL.AMIN', 'RIZAL AMIN', 'RIZAL.AMIN@SIG.ID', '$2y$12$O7qXETKkF3H70us6aZZcze4ivM674NFE.GfzHpoyRtEiABHGNePf6', 2, 7, 33, 39, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(929, 'RIZKI.APRINANDA', 'RIZKI APRINANDA, S. Kom', 'RIZKI.APRINANDA@SIG.ID', '$2y$12$VN4lMULn4LMzbEsNCO6qHeK8vdJqe6ii5pmID.Yfofd5/9c9dIhDe', 2, 3, 11, 44, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(930, 'RIZKI.HIDAYAT', 'RIZKI HIDAYAT', 'RIZKI.HIDAYAT@SIG.ID', '$2y$12$Bkm64lGlc4cIVGqOn02UduB.ziRLxu22QZt6BsfFKgK86rKsHUID6', 3, 5, 40, 112, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(931, 'RIZKI.SENTOSA', 'RIZKI SENTOSA, ST.', 'RIZKI.SENTOSA@SIG.ID', '$2y$12$DUTZYf1uc1JGZh1Kk9hoPeq7rcFftJFqZqqB8Oc52/YY.ihklqXBu', 2, 7, 30, 115, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(932, 'RIZKY.ERNALDI', 'RIZKY DWI ERNALDI', 'RIZKY.ERNALDI@SIG.ID', '$2y$12$BSDnZcL.YC.doHnBiFias.Bf8AfecjxkvF.d5NuoOwMMq1v/ofHrC', 2, 9, 41, 3, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(933, 'RIZKY.FEBRIO', 'RIZKY FEBRIO', 'RIZKY.FEBRIO@SIG.ID', '$2y$12$Uc68r/RceInd5NaaFQZFIOVvoWPw6BXOm9kBjX0KweFRL6dWjvgF2', 2, 7, 18, 38, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(934, 'RIZKY.NOVANDRA', 'RIZKY NOVANDRA, SE.', 'RIZKY.NOVANDRA@SIG.ID', '$2y$12$ZYernGdmKrKFnmI.ZiAaGOFn4BLqId3d1BykKoUMjnKS.Etxr2cC2', 2, 3, 27, 54, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(935, 'ROBBY.HANDAYA', 'ROBBY HANDAYA', 'ROBBY.HANDAYA@SIG.ID', '$2y$12$R832PUaH7VS36MV7tLcpuOpHxnpTbMHjwCa5BpETp43x9YAQt0JZm', 2, 0, 56, 109, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(936, 'ROBBY.KAROHAN', 'ROBBY PERDANA KAROHAN', 'ROBBY.KAROHAN@SIG.ID', '$2y$12$bbqKLLZ2SK3j5D6.I/KVh.Ym/0TG65rwkRJqyB5ZjgNiaWqzzEfEu', 2, 10, 43, 83, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(937, 'ROBBY.SAPUTRA', 'ROBBY SAPUTRA, S.M.', 'ROBBY.SAPUTRA@SIG.ID', '$2y$12$OMkYVsJsGRAB/2Lhj4fLOeaJI1tI/bbqgGR7/iRbukyQd5lzy6tA6', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(938, 'ROBBY.SUHERI', 'ROBBY SUHERI', 'ROBBY.SUHERI@SIG.ID', '$2y$12$UE81dO5QaXTL2i4tOabmvepd8Zz1vndSY004qBauZRSFw0ZvZMf..', 2, 7, 33, 67, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(939, 'ROBBY.WIRZA', 'ROBBY WIRZA, ST.', 'ROBBY.WIRZA@SIG.ID', '$2y$12$oc/HfNWm9cxNb1cDMogtn.pWd8fz6llP0AsQyep7OXQXWm8c450Cu', 2, 7, 18, 4, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(940, 'ROBIE.SUKANDA', 'ROBIE BRILLIANDO SUKANDA, SH., MKn., CLA', 'ROBIE.SUKANDA@SIG.ID', '$2y$12$sSbx1vsVoJGwI7YNn7hNCuwD3FGYlm1DbL/9m7lrZB.nZJQt2FshC', 1, 1, 29, 126, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(941, 'ROBY.EDRIAN', 'ROBY EDRIAN', 'ROBY.EDRIAN@SIG.ID', '$2y$12$RxuL6VDcAp5UpTXam3cqNehrtvQs6HoIG667LViJTwmP3c.YiVS0i', 2, 7, 30, 102, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21');
INSERT INTO `users` (`id_user`, `username`, `nama_user`, `email_user`, `password`, `id_direktorat`, `id_dept`, `id_unit`, `id_seksi`, `role_jabatan`, `can_create_documents`, `is_reviewer`, `is_verifier`, `foto_user`, `role_user`, `user_aktif`, `last_login`, `created_at`, `updated_at`) VALUES
(942, 'ROBY.JENGRI', 'ROBY JENGRI', 'ROBY.JENGRI@SIG.ID', '$2y$12$jLXnHLqcj/79KbnnxhaATOfsIta1ZS5TksmWbN9ZkCpHOQ9mcl9V2', 2, 9, 35, 25, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(943, 'ROCKY.JUNAIDI', 'ROCKY EDOS JUNAIDI', 'ROCKY.JUNAIDI@SIG.ID', '$2y$12$jzHrR486139YNamsQAnEUuIrhLnZRDPYDeeB7emCJpfD58oOb7HHy', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(944, 'ROCKY.LADIMO', 'ROCKY LADIMO, SE., MM.', 'ROCKY.LADIMO@SIG.ID', '$2y$12$qQAw2/uOND6GSLJndKoNveR53eMd0NYUX2hl/CcS4wgmcDlZmdorG', 3, 5, 6, 135, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(945, 'ROLI.PORI', 'ROLI GUSMAN PORI', 'ROLI.PORI@SIG.ID', '$2y$12$4n6W0VkSvhQGbKnp1.o0qOPrcEcaK98dsGXnKq8fUQDO.ce5sM30u', 2, 10, 44, 91, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(946, 'ROMI.ANDRIA', 'ROMI ANDRIA, SE.', 'ROMI.ANDRIA@SIG.ID', '$2y$12$4/HvdhiOD.h4dvWWA585ZOZ0vdE7pchjwqgZRO5QXK5FkrbX4TZL.', 2, 3, 11, 37, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(947, 'ROMI.MASRUL', 'ROMI MASRUL', 'ROMI.MASRUL@SIG.ID', '$2y$12$JMM0.BKf/ayCHdPbLAuQhuMBZUGcUjSFGA/Yrsg/XXOEImnxBI.9u', 2, 10, 43, 83, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(948, 'ROMI.MASYUTI', 'ROMI MASYUTI', 'ROMI.MASYUTI@SIG.ID', '$2y$12$kqUd44yREzwUuKX9RKOC8.TxGQS6KbD1UB.grQd0N0WWLMI3v5pgm', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(949, 'ROMI.RAHMAN', 'ROMI RAHMAN, SE., MM., QIA.', 'ROMI.RAHMAN@SIG.ID', '$2y$12$LKar18D6xxnK/T0O6dt6SurWQ1hS/cTjf0DyCHcI1XCTVdRQG86r6', 1, 13, 3, 97, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(950, 'RONAL', 'RONAL', 'RONAL@SIG.ID', '$2y$12$Ej0lQf.U8cCezoUahNx5Fuouonmd0cDZMgEm2sPX3GZ62J0j0A8EW', 1, 8, 53, 55, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(951, 'RONALDI.NAZWAR', 'RONALDI NAZWAR', 'RONALDI.NAZWAR@SIG.ID', '$2y$12$zGcf6xtNZejXf4qtKPdCiuVlfrJ3PKDdf/xAIqaV0eZXNh/u62Sca', 2, 9, 35, 51, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(952, 'RONCE.OKNANDES', 'RONCE OKNANDES', 'RONCE.OKNANDES@SIG.ID', '$2y$12$GTCHT79iEu3.rD67S18j3eUTxSuHxbwwHn07/dPaEO.5xH8vzHYrW', 2, 10, 46, 125, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(953, 'RONI.CHANDRA', 'RONI CHANDRA', 'RONI.CHANDRA@SIG.ID', '$2y$12$tvxjYLuf.Fh9sHy5fnPCoOKpkjrJBrp8QEQnz3ZP3IdYjM4kDcG1i', 2, 0, 56, 109, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(954, 'RONI.HERMANTO', 'RONI HERMANTO', 'RONI.HERMANTO@SIG.ID', '$2y$12$elepZg1VrgaFu.GDG7ZlcuUNR1uCvN1v55J8MkMKLtkT8lARtjOdW', 2, 10, 43, 41, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(955, 'RONI.IRAWAN', 'RONI IRAWAN, ST.', 'RONI.IRAWAN@SIG.ID', '$2y$12$0G5tEf9hdqP3rR/UXwpo6OHyGfJlnkbiQCvXxmwdr7cf8wfoiq1ne', 2, 11, 57, 87, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(956, 'RONI.PUTRA', 'RONI PUTRA', 'RONI.PUTRA@SIG.ID', '$2y$12$TTu9Ie2476RBsKZE8T/Jr.3bFgDGEFKGwXZw6kFKtHACEdtMTnJLu', 1, 1, 15, 34, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(957, 'RONNY.KUSWARA', 'RONNY KUSWARA', 'RONNY.KUSWARA@SIG.ID', '$2y$12$GWILFh5pszHWErEWQr095.4mGTgi3dXRymGt84QO7C/0u7n8.3Rya', 3, 14, 21, 30, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(958, 'ROSELINA.ROSLAN', 'ROSELINA ROSLAN, AMD.', 'ROSELINA.ROSLAN@SIG.ID', '$2y$12$W.9FX59rsgrQdi2d26K5ReDNnq.gkLh9lVGU9wt4gxJISd/PWbEaG', 3, 6, 26, 113, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(959, 'ROSSI.KURNIAWAN', 'ROSSI KURNIAWAN, ST.', 'ROSSI.KURNIAWAN@SIG.ID', '$2y$12$YC8bnYb/4NHIeF8s8Hea7.GuYGKWlmeOioYAU0bnlV.DBjrbohZoa', 2, 7, 18, 66, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(960, 'ROSTIKA.BUDI', 'ROSTIKA BUDI', 'ROSTIKA.BUDI@SIG.ID', '$2y$12$Gjrjtvkg9K16luZm2R/P9utCXqZqcqafAU1OP/e2Me.h5u5zOv6wS', 2, 3, 7, 14, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(961, 'ROY.FRISANO', 'ROY FRISANO', 'ROY.FRISANO@SIG.ID', '$2y$12$Re3iukqjmquvYs8XosXdj.ZhmzzAzOuOLyggkyfhwdp6E75.HFTYO', 2, 4, 13, 60, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(962, 'ROY.HARDYANTO', 'ROY HARDYANTO, SE.', 'ROY.HARDYANTO@SIG.ID', '$2y$12$dZPSVh1.DUGqswJseX/1Uu3hKp5QUHOnlzhsrBr1RWrs/vxHNWoJ2', 3, 5, 6, 135, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(963, 'RUDI.ANTONI', 'RUDI ANTONI', 'RUDI.ANTONI@SIG.ID', '$2y$12$80bXpvO1KKTy7iP1/XCv6.FuNtBy8eu5TDMonQHTlbCSTTF1ZLRoK', 2, 7, 18, 38, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(964, 'RUDI.ASMI', 'RUDI ASMI', 'RUDI.ASMI@SIG.ID', '$2y$12$38XIev/pQaYsyxocQkWzWOSsgwAjgPVEA6Y2NlLaLV3pL2gSob.7y', 2, 7, 19, 32, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(965, 'RUDI.HANDOKO', 'RUDI HANDOKO, ST.', 'RUDI.HANDOKO@SIG.ID', '$2y$12$TJQxZd7vr1NHT.HYGwAwQO6tveHhN4J0D6gm0skzRhvaV5ykmLm2q', 3, 14, 21, 30, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(966, 'RUDI.NOFIANDRI', 'RUDI NOVIANDRI', 'RUDI.NOFIANDRI@SIG.ID', '$2y$12$FrZk5vgECtiQLCVVqnGZ0OM5590YH.z3T0IGgV7yQBhD.jfqdry4m', 2, 3, 11, 40, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(967, 'RUDI.ZULKARNAIN', 'RUDI ZULKARNAIN', 'RUDI.ZULKARNAIN@SIG.ID', '$2y$12$f7jkqYOpPdl2y8YLySA5beL7kpUpr6VTeW5k0HtHhQIhcuN1GWr3C', 2, 7, 33, 48, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(968, 'RUDWA.IRGA', 'RUDWA IRGA, A. Md', 'RUDWA.IRGA@SIG.ID', '$2y$12$eF.jD1.uQBpNBA0sBx4tcuZBKzPprNuqHdUO84aycc6QptC7KJypq', 2, 7, 18, 38, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(969, 'RUDY.ERVAN', 'RUDY ERVAN', 'RUDY.ERVAN@SIG.ID', '$2y$12$D0XDV8y.4yhgav4tIcAgWuQtbdP3SHCHihU5t0UmkjAbjfgpmeoIO', 2, 10, 46, 125, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(970, 'RUKI.JULMAN', 'RUKI TRI JULMAN', 'RUKI.JULMAN@SIG.ID', '$2y$12$MoLQ.dzgKrj2GxRdc7CCTunT2.YVudt28F1CWqYHh83hbqQzbP4ae', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(971, 'RUKY.HENDRA', 'RUKY HENDRA, SE., Akt., MM.', 'RUKY.HENDRA@SIG.ID', '$2y$12$BvpQ5tV3oA4cJS03L8ge9eYysq9fSPNV8013JNJMnbiiPKyEoBTHu', 3, 5, 22, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(972, 'RULI.RAHMADI', 'RULI RAHMADI, S.Kom.', 'RULI.RAHMADI@SIG.ID', '$2y$12$ZXv3HYCURaLkPwNiq1UmWeGWPQJzxrbFppR1aX9F5E35grq6NafpC', 3, 6, 26, 113, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(973, 'RUSMAWIZA', 'RUSMAWIZA', 'RUSMAWIZA@SIG.ID', '$2y$12$HQlwt1iuGlZmopMznqPwBOsQeqDTnEH9TatVCiCy9DExAzJtunbtC', 2, 11, 58, 130, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(974, 'RUSTAM.3079', 'RUSTAM', 'RUSTAM.3079@SIG.ID', '$2y$12$RofnClhmH4k7DFE0wm4HQuUnR.V8cA68br.2oewwIKx25OhwmV06i', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(975, 'RYAN.PUTRA5727', 'RYAN ANDIKA PUTRA', 'RYAN.PUTRA5727@SIG.ID', '$2y$12$Fvq0c.3uTAGa1awnufAwpuCwXhiHmEQ8xf9WorbW/kmyeiafr2Zce', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(976, 'RYAN.SAPUTRA', 'RYAN EKA SAPUTRA', 'RYAN.SAPUTRA@SIG.ID', '$2y$12$pP.6xbjqBIQpjwAZ762g1OZX1JnSxF4tIs6graRbFvKFlEFFD3J4K', 1, 12, 50, 7, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(977, 'RYAN.PUTRA5728', 'RYAN IRAMANA PUTRA', 'RYAN.PUTRA5728@SIG.ID', '$2y$12$tDggozyACi6PaAX/YogmOuXFU0P8wuX3PcNp8OX3SGdpCKR1ngafG', 2, 11, 45, 120, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(978, 'RYANDA.ZAIM', 'RYANDA LUTHFI ZAIM', 'RYANDA.ZAIM@SIG.ID', '$2y$12$Py5CcYU8fTXduuN78eh9G.l0503OrCs7g.1JlEUQUVg/297ww2USK', 2, 10, 20, 89, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(979, 'RYCKO.SAPUTRA', 'RYCKO SAPUTRA', 'RYCKO.SAPUTRA@SIG.ID', '$2y$12$bO9bhEIpKEJqPRj3Ns9hMOeJlo78DyDvlb3M7ZLjnnOZzJit4YWPy', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(980, 'SABRIMEN', 'SABRIMEN', 'SABRIMEN@SIG.ID', '$2y$12$e/l0NaEwmDUvKiL9JuEgDu2QRe4K/7izsmptQVzZMSN07BSml3vq.', 2, 7, 33, 48, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(981, 'SADRI.HEDUSMAN', 'SADRI HEDUSMAN', 'SADRI.HEDUSMAN@SIG.ID', '$2y$12$fuXBW7Hjq6M9vL9myJu31uegwSAMFueyn1FlyF37xUkC/QNWw5tTS', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(982, 'SAFRINA.ASMARANI', 'SAFRINA ASMARANI', 'SAFRINA.ASMARANI@SIG.ID', '$2y$12$IqI/Czpc7QpjBRrVBY1eYelDZTAE6hRRnsO3VoZuVSnu7bELMb0c.', 2, 11, 10, 82, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(983, 'SALAHUDDIN.AYU', 'SALAHUDDIN AL AYU', 'SALAHUDDIN.AYU@SIG.ID', '$2y$12$RDjw4k1Wq5U/0ctVg.W1R.7qruxBW4T1/Ls8L28iC8gpFBO7Yu42i', 2, 11, 58, 130, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(984, 'SALMAN.ALFARISYI', 'SALMAN ALFARISYI', 'SALMAN.ALFARISYI@SIG.ID', '$2y$12$tO8na7hqw0wOqrHzWpH/C.RHChtnQ27nszNpI13TmwyzUVB9La2VK', 2, 7, 32, 36, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(985, 'SALMOND.PILIMA', 'SALMOND PILIMA', 'SALMOND.PILIMA@SIG.ID', '$2y$12$S8I8BSY/PosMEd1vsT43RuBSCz4XBus3Z0kiHLmP/J8nqr26K6L8G', 2, 7, 18, 66, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(986, 'SANDI.PUTRA', 'SANDI PUTRA', 'SANDI.PUTRA@SIG.ID', '$2y$12$qpJd.jF3RUxdLPqcqaRmy.oR4J/6UlSSKzPv5I5yGgJV9PIAUDX2y', 2, 7, 17, 45, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(987, 'SANDRI.YAZID', 'SANDRI YAZID, SE.', 'SANDRI.YAZID@SIG.ID', '$2y$12$mNfl.N4KXeFBY2xwIXEnx.PA3rxDjPimHi5Ufeb3dzMzapHiYhskK', 3, 5, 6, 90, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(988, 'SANTORO', 'SANTORO, ST., Ir.', 'SANTORO@SIG.ID', '$2y$12$pq5NL1e2Sl.hqoDNUUqvPuEgJvP0axCTSw2uzkYzVerRDo7CYsZc.', 2, 7, 19, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(989, 'SAPARUDIN', 'SAPARUDIN', 'SAPARUDIN@SIG.ID', '$2y$12$w7ts7kbd42xNsq.kZpcmneEax/mmceM3lksIXaStED8.V35JJ34q.', 2, 10, 43, 83, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(990, 'SARDINAL', 'SARDINAL, ST.', 'SARDINAL@SIG.ID', '$2y$12$IZfZWoMcUwe9zUyCe4PB1OnO6kmS/3gnYYtJ7uZ9zFbR4MQl6rYr2', 2, 7, 17, 35, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(991, 'SARI.MADONA', 'SARI MADONA, ST.', 'SARI.MADONA@SIG.ID', '$2y$12$wWlwvAbqbOlGb5OLbQoAGe7zC4OZm33JS2lK1LV3jVcwtVSJ9OdlO', 2, 11, 10, 82, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(992, 'SARI.RAMADHANI', 'SARI RAMADHANI, SE.', 'SARI.RAMADHANI@SIG.ID', '$2y$12$/Y/DTVNE1nN3ATqjcnLqmeD1HaQPqD9UaeHUUbL6j7RhE4GyKQEX.', 1, 8, 0, 0, 2, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(993, 'SARI.SYUKRINA', 'SARI SYUKRINA, S.Ak.', 'SARI.SYUKRINA@SIG.ID', '$2y$12$cTFBhOb2FY5fzwJIB.1qA.qCEU1rAJWitstBANhrVtT1eGwYMxq/K', 1, 12, 38, 24, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(994, 'SARMAN.DURMALAY', 'SARMAN DURMALAY, ST.', 'SARMAN.DURMALAY@SIG.ID', '$2y$12$OtyWvYZhvlLxg0SI28Yg9uR283qErsztZzsVtsl7YzrpS/4WyfV9C', 2, 10, 2, 76, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-26 20:31:41'),
(995, 'SATRIA.BUANA', 'SATRIA BUANA', 'SATRIA.BUANA@SIG.ID', '$2y$12$ZBA0671L0zjhzaRb1jROZ.YznWxx9jmFPvbOLF0ZigbBkgbVzpoLu', 2, 0, 56, 109, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(996, 'SATRIA.KUSUMA', 'SATRIA KUSUMA', 'SATRIA.KUSUMA@SIG.ID', '$2y$12$FCuhqlk4qVEOzp0sNwasve7IpnelAD/8biBLbzWWJ/az9OPcI63wm', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(997, 'SATRIA.WIWI', 'SATRIA WIWI, ST.', 'SATRIA.WIWI@SIG.ID', '$2y$12$kpfTNwr8lPnSNCi8wC90XeGlgH1aVVnoeHa.8ZWGVY8F.FI01S1/q', 2, 3, 54, 127, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(998, 'SAWONO', 'SAWONO', 'SAWONO@SIG.ID', '$2y$12$13mfz8PGTD1QHnLw8KdvNO.1jHflcz9szb4xXAYwLRhwby5HS0nri', 2, 9, 48, 21, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(999, 'SEIVEN.RAHMAN', 'SEIVEN RAHMAN', 'SEIVEN.RAHMAN@SIG.ID', '$2y$12$UP5bjs.zdFFgfKNNh7ZhOOHLDAVaE/yqV1rU0/7JP43Y8poiXwKDK', 2, 4, 13, 58, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1000, 'SEPRIADI', 'SEPRIADI, ST', 'SEPRIADI@SIG.ID', '$2y$12$cH6PZuoSENU2TrpZaLb7rutoNwvPOA4C6h14q/KQIc84lC6kZzKB.', 2, 7, 17, 45, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1001, 'SEPTI.PUTRI', 'SEPTI EKA PUTRI, ST.', 'SEPTI.PUTRI@SIG.ID', '$2y$12$dZ21ar7OMxkzY47Z8MpjHugijEW/v7z5sq.EiM8nFI1Q0SGky9/pe', 3, 6, 26, 110, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1002, 'SETIANI.DWININGTYAS', 'SETIANI DWININGTYAS', 'SETIANI.DWININGTYAS@SIG.ID', '$2y$12$LbnKAfcKwtK/gGud6YzUNexz/CbL2AuZ2cnz57VpkwtvgmrnnCs5W', 2, 11, 57, 87, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1003, 'SHARMEN.ASMAN', 'SHARMEN ASMAN', 'SHARMEN.ASMAN@SIG.ID', '$2y$12$nB7qqAalT9XNMj0upECLpuoudDHEA9L4HD9e94WwoeHVzccByHS1.', 2, 9, 35, 52, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1004, 'SILVIA.MEGASARI', 'SILVIA MEGASARI A', 'SILVIA.MEGASARI@SIG.ID', '$2y$12$5rP7plULLmsAsBmn.iGBSeTPB5pGGYkBhxN9BvmJNwxjeDgDKVaAi', 3, 5, 6, 85, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1005, 'SIRJON.ASRI', 'SIRJON ASRI, ST', 'SIRJON.ASRI@SIG.ID', '$2y$12$dFiWzVtAMvG9jfLXra4BWOUggnRbn2Q3o6OyINPTQdxkRD/iQZ2w6', 2, 3, 16, 27, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1006, 'SISKA.ANGELVA', 'SISKA ANGELVA', 'SISKA.ANGELVA@SIG.ID', '$2y$12$O0/Hjy.Anadn9NILusrbV.mfGz93Fm2RMcBp5oHYWIZEWliUmW3w2', 3, 6, 26, 114, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1007, 'SISKA.SORAYA', 'SISKA AYU SORAYA, SE.', 'SISKA.SORAYA@SIG.ID', '$2y$12$1u9uGyzZLg8wwmfjAxEtreVOyvpVBFcqre97ZH4DQKdGRxfDIfAZO', 3, 6, 28, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1008, 'SISRI.YANI', 'SISRI HANDA YANI, S.Si.', 'SISRI.YANI@SIG.ID', '$2y$12$s6oW1AwbRFkuk1td7dvMGO5t5CEoDCBufTg.SkMkuwll1v81MU8wW', 2, 0, 47, 124, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1009, 'SIUS', 'SIUS', 'SIUS@SIG.ID', '$2y$12$fwLSx52jZdv2d8vmgyUFS.yRax/fP4.skeSNcsFcG5yLVdQ02jIdu', 2, 3, 54, 127, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1010, 'SLAMET.SUNARTO', 'SLAMET SUNARTO, S.Kom.', 'SLAMET.SUNARTO@SIG.ID', '$2y$12$jwfVT6flUK0OyjdeHfGP5OrH2G3JjCB2Mm5k/Qfi9OF1IzWKjG/6O', 3, 15, 0, 78, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1011, 'SOHKIP', 'SOHKIP', 'SOHKIP@SIG.ID', '$2y$12$hhkHWg/.3bhd.C1zgDIX3u9FNz.TV5lBHfuxhNDX6Ck1ugA/ncAc.', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1012, 'SONI.ARIYANTO', 'SONI ARIYANTO', 'SONI.ARIYANTO@SIG.ID', '$2y$12$PWIh.YH.e02kfTpBW.Xj9eXDm2v/iq8/9VH73i99x2zyJXV9fBnkq', 2, 0, 47, 124, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1013, 'SONNY.HANDRA', 'SONNY HANDRA, ST.', 'SONNY.HANDRA@SIG.ID', '$2y$12$.B2LHgBowdq0N0/AAblrK.m7KmRZ.vrEsD47lnOgZytnmINTfcBeq', 2, 3, 27, 69, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1014, 'SPRESDO.AMDEYENDRA', 'SPRESDO ASKA AMDEYENDRA', 'SPRESDO.AMDEYENDRA@SIG.ID', '$2y$12$xvbUbI0JYMsRPfH4pMU78eL9Qqsba.Oq3B8hY0CgLqxCJwTPOU1eS', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1015, 'SRI.HARTATI', 'SRI HARTATI', 'SRI.HARTATI@SIG.ID', '$2y$12$8/tBmNgWGwNHj98w3XOMl./cDrqUHmvdqefAFys3y.dw8y7pZj0ai', 1, 8, 53, 17, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1016, 'STIVANO.HARDI', 'STIVANO HARDI', 'STIVANO.HARDI@SIG.ID', '$2y$12$S6rfvOfoSRCP5Q6/gAPITexA.SusLz1gMUVC2yNbICDjxBD1Hl2ba', 3, 14, 21, 30, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1017, 'SUBANDIYO', 'SUBANDIYO', 'SUBANDIYO@SIG.ID', '$2y$12$isAYt4LTBQPOZMrfPYBC0Oe1M8HRyzWzXABC3vCf9Y0sJnX7LnnJi', 2, 10, 43, 18, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1018, 'SUBRIANTO', 'SUBRIANTO, SH.', 'SUBRIANTO@SIG.ID', '$2y$12$rBNesyFuk5up04OPvy9upes984IaJdW5rXTKCNPEL59SClczaTRTS', 1, 1, 55, 129, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1019, 'SUCI.RAHMAYANI', 'SUCI RAHMAYANI', 'SUCI.RAHMAYANI@SIG.ID', '$2y$12$a2eHYlXQbNPAw3TA8WlJa.5BzG0hs7PCk6C8jxEC5DjWq.KLq6.IS', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(1020, 'SUHANDINATA', 'SUHANDINATA, SE.', 'SUHANDINATA@SIG.ID', '$2y$12$iUL1yneCSUu0NPqHBeXjqO5qkgZ4TrO.KhisJ5lU98cV4Ytayn5wu', 1, 8, 42, 73, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1021, 'SUHENDRI', 'SUHENDRI', 'SUHENDRI@SIG.ID', '$2y$12$oOaArgUr5622TKDzqZ9TceOW303vAm3BbgNkX34hAdbgEi5nmM0hm', 2, 10, 46, 125, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1022, 'SUHERDIAN.SARIANJA', 'SUHERDIAN SEPTA SARIANJA, ST., MM.', 'SUHERDIAN.SARIANJA@SIG.ID', '$2y$12$/GMdXq5eve1DSW0K56NGnOBgq.ih781DzDWN9GBYcR3T.eRmoQ/BS', 3, 0, 34, 104, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 21:24:50'),
(1023, 'SUHERIAL.ANDIKA', 'SUHERIAL ANDIKA PUTRA, ST.', 'SUHERIAL.ANDIKA@SIG.ID', '$2y$12$nVBLEvy1VMq7yvY1m.NWvOOsgND5n8kpMkKaHN1vHPOiNbZ73kXtK', 2, 11, 10, 82, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1024, 'SUJARMADI', 'SUJARMADI, ST.', 'SUJARMADI@SIG.ID', '$2y$12$egrx0uJ/TubFs6EVCZtX4ODELK4.h3lTAyaqrlsOeqHu8M1kHL.p.', 2, 3, 16, 27, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1025, 'SUKRI.3371', 'SUKRI', 'SUKRI.3371@SIG.ID', '$2y$12$0.5R7uwa1e4jQewiSFD6YunJoUOqWd3QjIBfh368lYpUScnjlllWe', 2, 7, 33, 67, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1026, 'SUNOTO.3410', 'SUNOTO', 'SUNOTO.3410@SIG.ID', '$2y$12$fKYHN219DBuEr/mYVuosEeXKYh11RJNd88CYtYVrbNJuD5aQ3VH7m', 2, 7, 19, 32, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1027, 'SUPRIADI.3129', 'SUPRIADI, ST.', 'SUPRIADI.3129@SIG.ID', '$2y$12$rD8ya4JMIohOnsKp3Tt1gOaW1/PWD5qxeo7.Xy.e910EfkfIdwhKy', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1028, 'SURI.KURNIA', 'SURI KURNIA', 'SURI.KURNIA@SIG.ID', '$2y$12$phPyd4k931HPzI324qtOsel2V.3YP3BfUSGe98imBolehNLTQmU4q', 3, 6, 25, 131, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1029, 'SURYA.ADIWINATA', 'SURYA ADIWINATA, ST.', 'SURYA.ADIWINATA@SIG.ID', '$2y$12$cpPp.G6oJgWerBU0f7Ee6eFIq8wSKWEAJdY3wD4inzdTeon93q4z.', 2, 11, 23, 92, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1030, 'SURYADI.WIZAR', 'SURYADI WIZAR, ST., MM.', 'SURYADI.WIZAR@SIG.ID', '$2y$12$r9/0MPPXz8x.ksEJmb7ieO9.jgeniaYoySMGcBcX.aD98hiAlClbu', 1, 12, 38, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1031, 'SURYAT.HANDOKO', 'SURYAT HANDOKO, ST., MT.', 'SURYAT.HANDOKO@SIG.ID', '$2y$12$YXFi.LOveTyCg1/kzZRLLuPeJ4mmuVxll4vWx9R6mDHQf6M3UTZt2', 2, 10, 43, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1032, 'SUSENO.NUGROHO', 'SUSENO NUGROHO', 'SUSENO.NUGROHO@SIG.ID', '$2y$12$n89PTpOZi97K.l.xZKv22uNlxDPTzvnxrs62uiMLdOHRfYDKEpsS.', 2, 0, 47, 124, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1033, 'SUSILAWATY', 'SUSILAWATY', 'SUSILAWATY@SIG.ID', '$2y$12$7DAlkPe3Bn2dEoKLdQ1E7.7XJEG8Ux5F6fg3etAiax3LH1.dVWkWK', 2, 0, 56, 72, 4, 1, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(1034, 'SUTAN.IQBAL', 'SUTAN MUHAMMAD IQBAL', 'SUTAN.IQBAL@SIG.ID', '$2y$12$cjqdc1huTcYYjNCJCFweDepUKeSaIAkzPkCIiPRvSxb5nIkNtqw3W', 3, 0, 59, 136, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(1035, 'SWILLYANOF', 'SWILLYANOF', 'SWILLYANOF@SIG.ID', '$2y$12$v2BZYTF.Tu.rrIRkqeVwvOFG0O3Onv9u28RlW/DVtRm68UMMQc0uu', 2, 2, 8, 79, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1036, 'SYAFRI.DONI', 'SYAFRI DONI', 'SYAFRI.DONI@SIG.ID', '$2y$12$XL0rqX182SxKzTOzRfBsCed6S80IhlSEEe5xqWreb4gyl0XG5gFli', 1, 12, 38, 24, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1037, 'SYAFRIADI.3179', 'SYAFRIADI', 'SYAFRIADI.3179@SIG.ID', '$2y$12$k92MYrs.yuO4ye1rLRbDHe1SKRdJu/OrkYEigfe8Z2bYIw.1hCOlS', 2, 7, 33, 39, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1039, 'SYAFRIADO', 'SYAFRIADO, ST.', 'SYAFRIADO@SIG.ID', '$2y$12$5x6X1mZRwA.hz5fG6cwZAeL0feTNf/TgddBA6DUu/H/p2vz4qeetq', 2, 3, 7, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1040, 'SYAFRIKA.DENDRA', 'SYAFRIKA MAI DENDRA', 'SYAFRIKA.DENDRA@SIG.ID', '$2y$12$lBueZPneMNqtH3OnEnpzPetNLU/cd2MDVcw2HBGAjI869.CZ3jBTi', 2, 10, 46, 125, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1041, 'SYAFRIL.3149', 'SYAFRIL', 'SYAFRIL.3149@SIG.ID', '$2y$12$5Cl5LMVlwYf2fsahhr1XYeuYeJByDt6V0FBrCnoRa2FkM2j20Udhm', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(1042, 'SYAFRIL.A', 'SYAFRIL A', 'SYAFRIL.A@SIG.ID', '$2y$12$tmVgFr4PqXJyMDWMEzuqNO8v/DwU9K77Js1IUr9tUYyKSiXGgSjla', 2, 9, 48, 23, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(1043, 'SYAFRIN', 'SYAFRIN', 'SYAFRIN@SIG.ID', '$2y$12$21IO8HUsZ7ttZa1dy9E8f.9c3YQDSwwrDdECO8ZX8Pzl5F2owIUuO', 3, 14, 21, 29, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1044, 'SYAFRIYAL', 'SYAFRIYAL', 'SYAFRIYAL@SIG.ID', '$2y$12$Ome0x6dBBKkoddGxoE/nDO.u9E03OYjSCy.MFhfRvk/8AUnaD7yxO', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(1045, 'SYAHRIL.EFENDI', 'SYAHRIL EFENDI', 'SYAHRIL.EFENDI@SIG.ID', '$2y$12$wEEk45K4611vdOiS4HlR.eK6be5mujzpDjgNCyzCXlBIl9xR80EQe', 2, 10, 43, 18, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1046, 'SYAHRUL.MUBARAK', 'SYAHRUL MUBARAK', 'SYAHRUL.MUBARAK@SIG.ID', '$2y$12$Vdsrz7BUNTNA/2cOiD4XmekLosFjVoTbBRvujW5Rhq/G.vxdqd1Yq', 2, 7, 30, 115, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1047, 'SYAIFUL.PUTRA', 'SYAIFUL PUTRA, A.Md', 'SYAIFUL.PUTRA@SIG.ID', '$2y$12$DDNq97xaMJP5bXjmCcWCZOY0iIEKXMKbi.cr3PPmIKxo5rI3rNgD.', 2, 7, 30, 115, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1048, 'SYAMSU.RIZAL', 'SYAMSU RIZAL, ST.', 'SYAMSU.RIZAL@SIG.ID', '$2y$12$Xxna8WPhOQrMAkVVjD9AgOIMbglP2cqx3h.v7YMuwnQxzDQXNcqom', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1049, 'SYAMSUL.ARBI', 'SYAMSUL ARBI', 'SYAMSUL.ARBI@SIG.ID', '$2y$12$ESKCKFsILTJhRW6yGgR/e.7yMBXJu88m62hJFoeE7C6JVSHT7ZjnC', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1050, 'SYAMSUR.RIJAL', 'SYAMSUR RIJAL, ST., MT.', 'SYAMSUR.RIJAL@SIG.ID', '$2y$12$F1mNX0XYSGxQQGnbTT7Y7eqMW.LdVINgIsaC81b2SS5egYqRmlYwS', 2, 4, 0, 0, 2, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1051, 'SYERWAN.FATONI', 'SYERWAN FATONI', 'SYERWAN.FATONI@SIG.ID', '$2y$12$NspH2BdXHyuIKbWl4B17suEM8RoqT2eTgCLTK.KwncrE6QdzfA912', 2, 9, 35, 52, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1052, 'SYOFIAN.B', 'SYOFIAN B', 'SYOFIAN.B@SIG.ID', '$2y$12$HCO91oiQPQITvx6yd8MlvuC03bqCkpUzxTgXbxhkKJymUKGY1Dj/u', 2, 9, 35, 51, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1053, 'SYOVIANTI.IRSYAM', 'SYOVIANTI IRSYAM, SE.', 'SYOVIANTI.IRSYAM@SIG.ID', '$2y$12$IdNkoIStjzAVNJeXkn.1bOA3w0wWMMya2AahdsHoxdfHJRnxyJj52', 3, 5, 22, 77, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1054, 'TARMIZI.3547', 'TARMIZI', 'TARMIZI.3547@SIG.ID', '$2y$12$7ztk2cs1boJ6Y8126fjNlu9tpE6dHyyHdQZ.VyIFUk2OO1Aa25Bey', 2, 7, 17, 4, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1055, 'TASWIN', 'TASWIN', 'TASWIN@SIG.ID', '$2y$12$bny9Ylf2BuVPvavqOXEjJ.GN1JDQam5yal7vWowUKRZUlS5WdvMfK', 2, 7, 30, 102, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1056, 'TATA.SPD', 'TATA, S. Pd, SE', 'TATA.SPD@SIG.ID', '$2y$12$guBJ/x.Wu9f77Jds2OEjs.9dhLMqLxzOoZDMUng9bgy6adAd491m.', 2, 3, 54, 127, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1057, 'TAUFIQ.HAMDAN', 'TAUFIQ HIDAYAT HAMDAN', 'TAUFIQ.HAMDAN@SIG.ID', '$2y$12$QC3OaZrpLmHyVvlva6UFk.VZlgxgYhd210sX7B9iKSPogMv8pbPba', 2, 9, 41, 56, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1058, 'TAUFIT', 'TAUFIT', 'TAUFIT@SIG.ID', '$2y$12$TpqGmGcYM/QfWBiJTH21/OhMyFLXcsbFzC/NIAdSkHW3IyDSaBomu', 2, 9, 35, 25, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1059, 'TEDDY.ELDWIN', 'TEDDY ELDWIN, S.Sos.', 'TEDDY.ELDWIN@SIG.ID', '$2y$12$T62g1bALjEaGt7Cek6KuP.gw3GnXTq6rCPqkL.eEiDj2ZQhQZDLm.', 2, 11, 23, 92, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1060, 'TEGUH.SOVIYANTO', 'TEGUH SOVIYANTO, ST.', 'TEGUH.SOVIYANTO@SIG.ID', '$2y$12$dy/4etuFERBbLZmXykZGNOc/UqPk7NQP2AnJnUOn9iaYvP.LvXSrq', 2, 3, 16, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1061, 'TELLI.ANGGELINA', 'TELLI MERIZA ANGGELINA', 'TELLI.ANGGELINA@SIG.ID', '$2y$12$xlEXm2YfKQviH3ha/ggC1OnMOmMiM.k.b/q1m6xZuAw74Wu2aPR3W', 2, 0, 56, 72, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(1062, 'THOMY.HAMPRIYANDY', 'THOMY HAMPRI YANDY, S.Kom.', 'THOMY.HAMPRIYANDY@SIG.ID', '$2y$12$lqJZ6Te3JabCz/6hFYgXDewhismGbe0lPM/HUWYlhgRWntv8nW4Ji', 2, 11, 5, 137, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1063, 'THOMY.HARIS', 'THOMY HARYADI HARIS', 'THOMY.HARIS@SIG.ID', '$2y$12$zs2pjNraosqrXHQixwe4HuuJSUBuAOiJ5YCIovG/0mKxsyFiDzzMW', 2, 7, 33, 67, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1064, 'TIGRIS.RAMADHAN', 'TIGRIS PANTHERA RAHMAT R', 'TIGRIS.RAMADHAN@SIG.ID', '$2y$12$mMWNT9KieDMEuRcgHk.M/uYadIvMXfaxLIvsisi0BLXu6zrqlvWYG', 1, 1, 29, 100, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1065, 'TITUT.ERYANTO', 'TITUT ERYANTO, ST., MT.', 'TITUT.ERYANTO@SIG.ID', '$2y$12$0xutWihmx3GCgJIHcIZ5Y.p0Um7vsBUotnCN1uKwlW.2iVVqI2tDu', 2, 10, 20, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1066, 'TONI.KASWARA', 'TONI KASWARA', 'TONI.KASWARA@SIG.ID', '$2y$12$E1Y0FbBx8ssLwqRIuBStw.z/DIDPAx1hMK7JfNKH2Wd0e6tY7fdaK', 2, 7, 17, 42, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1067, 'TONNY.ELTER', 'TONNY ELTER', 'TONNY.ELTER@SIG.ID', '$2y$12$CgDQxBaKYvJLhn34I.FRmuv7ppWtRl2PKZhug/Flap61SCKHLJAom', 2, 7, 30, 102, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1068, 'TOTO.SETYONO', 'TOTO SETYONO', 'TOTO.SETYONO@SIG.ID', '$2y$12$IWvwlqhkYJtrvPos0EFY6.6xZhFrUbVqYH.CiSatYIKkV3MwG6TFC', 2, 9, 41, 70, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1069, 'TRI.PUTRA', 'TRI DAYA JAKA PUTRA', 'TRI.PUTRA@SIG.ID', '$2y$12$jNWJlvUiggd1ZGo9ngNz9.tsigzNZAJdS3C1goy.DOHSmtoBbh7rS', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1070, 'TRI.MAIZON', 'TRI MAIZON', 'TRI.MAIZON@SIG.ID', '$2y$12$Wncx7sjSpvd5rAEPhvx/HuLLxLHfs1ZkJZUj6io0R7JAWh6X7Scw2', 2, 10, 44, 91, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1071, 'TRI.SUDARNO', 'TRI SUDARNO', 'TRI.SUDARNO@SIG.ID', '$2y$12$KpMoJOrnsjOYt37KM5JDmeQfAS42UOKHJOWzWyzt8XBgAtj1sftxO', 2, 0, 56, 109, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(1072, 'TRIE.AULYA', 'TRIE RISZKI AULYA S, ST.', 'TRIE.AULYA@SIG.ID', '$2y$12$n0VHMMVxAGO0LJgix9DNkOBwLlMSOYSCVUDGRH66AvHRXBWvQDTX6', 2, 9, 41, 28, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1073, 'TRISNA.YOLANDA', 'TRISNA YOLANDA, S.Kom.', 'TRISNA.YOLANDA@SIG.ID', '$2y$12$bP4T27yXM/X.aolqgyKXD.OmNFKpz7J8I410rE7kZ0jNkeNPTr8w.', 3, 6, 26, 114, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1074, 'TRISNO.NELSON', 'TRISNO NELSON, SE.', 'TRISNO.NELSON@SIG.ID', '$2y$12$xCcPUj6HwMItibbK02hmLuv4voqrwtRXvsutSn0ZvWazL5F1s07Fa', 3, 5, 6, 135, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1075, 'UJANG.FRIATNA', 'UJANG FRIATNA, ST.', 'UJANG.FRIATNA@SIG.ID', '$2y$12$5N/5DrOfLA4mq/mfhUE4nuPf07X4mydJSRtvH/qHU.FG76VjgO4nS', 2, 4, 13, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1076, 'ULFATMI', 'ULFATMI, SE.', 'ULFATMI@SIG.ID', '$2y$12$TJ.MQcW9SXbvHyJWcAz4x.ybKhcDzI45clC/vazlXdtTL/Mb7JLRy', 1, 13, 3, 97, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1077, 'ULKAMRI', 'ULKAMRI, ST.', 'ULKAMRI@SIG.ID', '$2y$12$b9mH7GftQpvVAadJRfSNluoOKDxdmfguBb9/SKWtvcW8ZPwcGoux.', 3, 14, 31, 103, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1078, 'ULMULYADI', 'ULMULYADI', 'ULMULYADI@SIG.ID', '$2y$12$gEstVYpwL42IKGgOBDpTQOqChiwGL/kT0EBcclNkQfcCXXSEHd5cK', 2, 7, 33, 64, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1079, 'USMAN.EFFENDI', 'USMAN EFFENDI', 'USMAN.EFFENDI@SIG.ID', '$2y$12$Oh5HDX9xtUXQ.UHMQIV.Oug.hndXdq8k62/bTl8tOPBQzBcRFPoDC', 2, 7, 18, 63, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1080, 'UTARI.HANDAYANI', 'UTARI HANDAYANI', 'UTARI.HANDAYANI@SIG.ID', '$2y$12$4nm87BZHjDlNR9vTj2Wti.0NQuNoBIUOC85gNjPsDg6K8w4eaJ75C', 2, 10, 44, 91, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1081, 'VANNI.VAMELLA', 'VANNI VAMELLA NAINGGOLAN', 'VANNI.VAMELLA@SIG.ID', '$2y$12$DLA/ShFmsCEvV/AXjF/Lv.plxF2qDHC9wLBfnHLOPG9xi1MkagQvG', 1, 12, 51, 10, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1082, 'VARDIMIR.A', 'VARDIMIR A', 'VARDIMIR.A@SIG.ID', '$2y$12$vz2lwS2EeUo7b2dp3hqWwOnCNy5xeeCP3MjhaqbiTsd08SlHX8K0y', 2, 9, 41, 56, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1083, 'VERA.OKTAVIA', 'VERA OKTAVIA, SE.', 'VERA.OKTAVIA@SIG.ID', '$2y$12$8brM4pAL6u9mVpMNS/GvoOeR8LCy80ZToLae8DIzSllN2k/LQOH2C', 1, 8, 42, 74, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1084, 'VERA', 'VERA, SE.', 'VERA@SIG.ID', '$2y$12$8LyMohNaZikn9HFEOKFCF.mgSPw4Vnj7tcbqbkFCSm0hVhrVmdgju', 1, 13, 3, 97, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1085, 'VERDY.GUSMAN', 'VERDY RADINAL GUSMAN, ST.', 'VERDY.GUSMAN@SIG.ID', '$2y$12$x4ajPYqNSK5OPN7amdbOQeP7f1WNnYZQspuwubHAQ2rxfj/Tkq6li', 3, 6, 26, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1086, 'VICBY.AULIA', 'VICBY AULIA', 'VICBY.AULIA@SIG.ID', '$2y$12$ZMfQoUDaUicdy8fTYg/.DeFNWH4lAgCEU.J1UAmSeqbOYTIBKeI7i', 2, 9, 35, 25, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1087, 'VIRA', 'VIRA, SE.', 'VIRA@SIG.ID', '$2y$12$aYXnuVUSxGhijMaak9IFkeNlEYehqG5iJdFOIvBx./KKLYEI1KtIe', 2, 0, 56, 109, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 02:13:47'),
(1088, 'VISCHA.AZWAR', 'VISCHA DIPAMA MEYOSI AZWAR', 'VISCHA.AZWAR@SIG.ID', '$2y$12$gorGQYkyq3G.vRjPxQNg2.5ZMM9h.or4bAx/Pzg0H9v1ODTJT1Xue', 3, 5, 22, 133, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1089, 'WAHDINI', 'WAHDINI', 'WAHDINI@SIG.ID', '$2y$12$vGnIKnxCLWTQzPlDJB75..31TRU67tCyVyS26E92XT7xLVQpj0Lq6', 2, 11, 45, 123, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1090, 'WAHYU.PUTRA', 'WAHYU ARISAL PUTRA, ST', 'WAHYU.PUTRA@SIG.ID', '$2y$12$ygbmU1b3vqAKJOxoA3H1uOEyGu.Omxbxdkz7DTCMzENrHQ46K5v8K', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1091, 'WAHYU.HIDAYAT5757', 'WAHYU HIDAYAT, ST.', 'WAHYU.HIDAYAT5757@SIG.ID', '$2y$12$B8EbfemuNM5Pjbb.FIO8XuvjrVICsFDfoWhcTJC.Zp8Xamr87tq1i', 2, 7, 33, 67, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1092, 'WAHYU.KURNIAWAN', 'WAHYU KURNIAWAN', 'WAHYU.KURNIAWAN@SIG.ID', '$2y$12$6mjFRpJNb9uPpTdhgBouYeEHLJk/BN3un.vPrUyXPBGzt2tOJtgUi', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1093, 'WAHYU.STUDIAWAN', 'WAHYU STUDIAWAN', 'WAHYU.STUDIAWAN@SIG.ID', '$2y$12$MBP.LFXmnea6SEpR.YhwMeQUzNZclL4gxdfq48wVWGsxlNTqdP.1q', 2, 7, 32, 46, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1094, 'WAHYUDI.4444325', 'WAHYUDI', 'WAHYUDI.4444325@SIG.ID', '$2y$12$IzJLAhnEpMiVQH8stVehNeQlSJOMnJCx2A7rIVX0AAD9zJedLUHaC', 2, 7, 33, 39, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1096, 'WAHYUDI.CANRA', 'WAHYUDI KARTIKA CANRA', 'WAHYUDI.CANRA@SIG.ID', '$2y$12$HRoso4VY49ktgH26mAURVOsPBftPy3b9IFRLocFACNrlsf7NsE/oS', 1, 12, 50, 11, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1097, 'WAHYUDI.8278', 'WAHYUDI, SH.', 'WAHYUDI.8278@SIG.ID', '$2y$12$bcuhImVE9NkErO6zvmwvWu3VGXKsV5jbp1ynDYQ25NQxh43IXe/im', 1, 1, 55, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1098, 'WAN.SETIAWAN', 'WAN SETIAWAN, ST.', 'WAN.SETIAWAN@SIG.ID', '$2y$12$fzNj9VkTqlg4RjsgSdPm4ucv4XuddamzSXaFqSCIDEsLdMeoRZzF.', 3, 6, 28, 98, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1099, 'WANDI.HASRI', 'WANDI HASRI', 'WANDI.HASRI@SIG.ID', '$2y$12$n/CQLEntbhFqWwlSBLCELOrhlaDrStSu46/gBb/OUUDwYafF7TkXu', 3, 6, 26, 113, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1100, 'WANSOL.PANAS', 'WANSOL PANAS', 'WANSOL.PANAS@SIG.ID', '$2y$12$/.37mO3EKJO4hfqjRlmuh.KpDhTH2D8kLUcI0yg8WwXEIhvdnL//K', 3, 14, 37, 108, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1101, 'WARDI.3164', 'WARDI', 'WARDI.3164@SIG.ID', '$2y$12$WA7T08cs3GpXo/yaR66RieRWdm9TsSm93Qj3BxZd4.BkFM7dfH9O.', 2, 9, 48, 21, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(1102, 'WAWAN.PRASETYO', 'WAWAN PRASETYO', 'WAWAN.PRASETYO@SIG.ID', '$2y$12$427lst.rXRDDblVuW/tEl.4zkT/kqkMTyVgW3C8NEHJDLIZOLT3vK', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1103, 'WEMPI.KURNIAWAN', 'WEMPI KURNIAWAN, ST.', 'WEMPI.KURNIAWAN@SIG.ID', '$2y$12$L6.Bbuz9/ajXzpO94zu2pOO0j4oVUlRIL0DH5Nwbv2Lse6GeOfSLS', 1, 13, 3, 97, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1104, 'WENDRA.CHRIZTIAN', 'WENDRA CHRIZTIAN, S.Kom.', 'WENDRA.CHRIZTIAN@SIG.ID', '$2y$12$.HyVt5Z/F6fYcMmHDfE6jOgLo4I.MOBcO.TvqQCtVUQ0rn.wGMuDi', 3, 6, 25, 94, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1105, 'WENDRISMAN', 'WENDRISMAN', 'WENDRISMAN@SIG.ID', '$2y$12$yvedmPWYxFzFj4VQsroZCuJ5WgKz0mrl2HEqjse7CuleVFAFgW./u', 2, 9, 35, 25, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1106, 'WERI.SASTRA', 'WERI SASTRA', 'WERI.SASTRA@SIG.ID', '$2y$12$xprWShMjK1xIlsIQqYRDQOxcFsfmYoptBJZvIRBWpipam10TCqc7i', 2, 10, 44, 91, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1107, 'WERY.FRIMA', 'WERY FRIMA', 'WERY.FRIMA@SIG.ID', '$2y$12$yv6pezjTkPOaXzVkoYL0LOgoPBv5kAkNgnrDQHnDmvto6PLNDIA4i', 2, 3, 11, 2, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(1108, 'WEY.APPEL', 'WEY AKHDIAT APPEL, ST.', 'WEY.APPEL@SIG.ID', '$2y$12$ihvVRqn8B79H4t1VD/sZ4uLcZk5dPF3TPzncacqeZKQ40n39mPXQ2', 2, 11, 45, 121, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1109, 'WILLIE.ANTHONI', 'WILLIE ANTHONI, ST.', 'WILLIE.ANTHONI@SIG.ID', '$2y$12$ltCqjkPW3zEV/2ZlFjMn3.BHHvwBeThcWWeXUr/h37DdU7/zfGKJm', 1, 1, 55, 129, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1110, 'WILLY.ADAM', 'WILLY ADAM', 'WILLY.ADAM@SIG.ID', '$2y$12$Iir5bcCwda6aJhEXP0Y8u.Z2MnEywjhiQ4FXYTSCNOpYlQCnMb/OG', 2, 9, 41, 56, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1111, 'WILMAN.ISNAINI', 'WILMAN ISNAINI, ST.', 'WILMAN.ISNAINI@SIG.ID', '$2y$12$unqJ1it9aG4EiX0S.OlKbOv7eutBicG73sMB6LjngdQvEXgkt4Bv.', 2, 11, 45, 120, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1112, 'WILY.JABAR', 'WILY WARNEL JABAR', 'WILY.JABAR@SIG.ID', '$2y$12$0LnnBq77OzuX6CnjlSWd.utdKv1Ia3kGSiSbt3mFX1Dax9674ucyu', 2, 7, 18, 47, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1113, 'WIN.BERNADINO', 'WIN BERNADINO, ST.', 'WIN.BERNADINO@SIG.ID', '$2y$12$QH1V1RnbyzX33GJv0mKTtOm.1wkD0f8gBi55Zp1T08p7fmE4dtwK.', 1, 1, 0, 0, 2, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1114, 'WIRADANA.DJUFRI', 'WIRADANA DJUFRI, ST., MM., IWE.', 'WIRADANA.DJUFRI@SIG.ID', '$2y$12$1bEoMoNhbDmdWg9xGC25i.SV35VS3m69KJlufw4Vc7XBj4nkggs2i', 3, 14, 21, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1115, 'WISMALDI', 'WISMALDI', 'WISMALDI@SIG.ID', '$2y$12$Zq7heTjdQ5kU6BNXjJcxE.O5yfZHMio8r7tUKWX0qhPSiLGjE/cWu', 2, 10, 20, 89, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1116, 'WITRAZONI', 'WITRAZONI, ST.', 'WITRAZONI@SIG.ID', '$2y$12$.2ReWPujPVyieU44XFZl9O43.8CmGLSIhijJIErQ5MJt144dFFyge', 2, 7, 33, 48, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1117, 'YADI.ISMONDRA', 'YADI ISMONDRA, ST.', 'YADI.ISMONDRA@SIG.ID', '$2y$12$3Eoe6ucpLxCu0KnmiwJWUOY2XdDfCnr/sxO93oAjexnDrhZGgnl/2', 2, 9, 35, 25, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1118, 'YALDI', 'YALDI', 'YALDI@SIG.ID', '$2y$12$gCSEKy2E0sW.YLqml41fk.6l4E7JqJqSYBhdmVACF.CDBFfWwJVSq', 1, 1, 14, 95, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1119, 'YANDRA.FERI', 'YANDRA FERI', 'YANDRA.FERI@SIG.ID', '$2y$12$OOcdS6gj0KdcfyjHlyjyIOOcqoabTgau/bB5oOGEfcTYLYsit6YzS', 1, 12, 50, 7, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1120, 'YANDRI.FERDIYAN', 'YANDRI FERDIYAN, ST.', 'YANDRI.FERDIYAN@SIG.ID', '$2y$12$N238POlp/ovXikdQPJQeZOh1bt5Xge9k9mUzZxx8JJ3EUHtkBuExS', 2, 7, 18, 66, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1121, 'YANDRI.SAPUTRA', 'YANDRI SAPUTRA', 'YANDRI.SAPUTRA@SIG.ID', '$2y$12$i8drdqth5Ufai38Ibbgy.OVtf2Eo0T3.0cvqvSpw74fQOHzHx580y', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1122, 'YANDRIL', 'YANDRIL', 'YANDRIL@SIG.ID', '$2y$12$qL9P5VCzstgJUYCdH5DUKOD/FxIj8gJpg7a.8nIF5vS05PZyEvIle', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1123, 'YANISALDI', 'YANISALDI', 'YANISALDI@SIG.ID', '$2y$12$NyuvShfWyr9aZSOPOQs7l.c/busSu2Ik5zIbn2CxYhyflSJvjXWKq', 2, 10, 43, 83, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1124, 'YANTANAMAL', 'YANTANAMAL', 'YANTANAMAL@SIG.ID', '$2y$12$ug0EzSRn.Il2IA/CPLff7.7EIRyJqIYFsCIk8VNgPzeq34RW86nk6', 3, 0, 59, 136, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(1125, 'YANTRI.WENDI', 'YANTRI WENDI, SE.', 'YANTRI.WENDI@SIG.ID', '$2y$12$kL678u6zXRJwuu6A35O4w.yyiLXxr4bpBEMI4DsKkyBUcibdB4hK2', 3, 14, 31, 103, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1126, 'YANUAR.ALFIAN', 'YANUAR ALFIAN', 'YANUAR.ALFIAN@SIG.ID', '$2y$12$pNSLZ7RfHloZ5la0AmJRT.XgXVgFT7s7xofpy.TXIKel2KLFdFW.a', 2, 11, 45, 123, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1127, 'YANUARDI.6615', 'YANUARDI, Ir., ST., IPM., CRP.', 'YANUARDI.6615@SIG.ID', '$2y$12$Hp0fSVXnvxFj/WSd2tZVW.LdDIm6fDSZ9ose1nAuEcgLg3TUT6ghC', 2, 7, 30, 102, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1128, 'YARNIS', 'YARNIS', 'YARNIS@SIG.ID', '$2y$12$.38M2Y4yLcxC1U52l.V9Hu.H86cwugEaTKQHWJ4Vovl1dWdFjzOyS', 3, 5, 6, 135, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1129, 'YARTONI.MAISON', 'YARTONI MAISON', 'YARTONI.MAISON@SIG.ID', '$2y$12$FhhQK7AtwhlPLXYzBc6wOOML1SokX4HJ8O/wbTZE9OxiH52xCsRB2', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1130, 'YASNELLY.SASTRAWATI', 'YASNELI SASTRAWATI YUSUF, SE.', 'YASNELLY.SASTRAWATI@SIG.ID', '$2y$12$CNy91yvjvQ.urC7cP1BdW.fsuRlsD7QKWmkXsJJHtBIOYUxDz1jqq', 3, 5, 6, 135, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1131, 'YASRIZAL.3166', 'YASRIZAL', 'YASRIZAL.3166@SIG.ID', '$2y$12$WWPliurE8TkeLHWexZZbMuXAul8U5z5DkESxrWL3hzguf7bf.S88S', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1133, 'YEFRI.YENDIKA', 'YEFRI YENDIKA, ST.', 'YEFRI.YENDIKA@SIG.ID', '$2y$12$JN9UShH/CSSx84W2CHGwXerKmV68O36olvEJbQlqsww.dZm9sw6YS', 2, 3, 39, 68, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1134, 'YELMI.PUTRA', 'YELMI ARYA PUTRA, ST.', 'YELMI.PUTRA@SIG.ID', '$2y$12$YENflqqJDpDljuxULJIZhuFCiydlPJLuUGro7wWZt3XQ.uem8Xhb6', 2, 2, 9, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1135, 'YENDI.NOVRI', 'YENDI NOVRI, S.Pt.', 'YENDI.NOVRI@SIG.ID', '$2y$12$xJmbuL9IyuImeaQBpSe8sO2BzvCc0r4ytr8FVI3pkQ2hr7fXDEIEu', 2, 2, 9, 80, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1136, 'YENDRA.ABADI', 'YENDRA ABADI, ST.', 'YENDRA.ABADI@SIG.ID', '$2y$12$4ejcDLLHfz0iHaau.Qhox.wRU.PEhPOu54J4qdRaRHjQHAyRiPoQi', 1, 12, 1, 71, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1137, 'YENNI.YEFRITA', 'YENNI YEFRITA', 'YENNI.YEFRITA@SIG.ID', '$2y$12$vQEhlJjUz5ZUp5B56q3W4.i1En1PdJsm/JSzIsAQXWsSLCi4vs1ZG', 2, 11, 23, 92, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1138, 'YEVERSON', 'YEVERSON', 'YEVERSON@SIG.ID', '$2y$12$nKG.uQ5MsT6ifxPjbDiTQ.exMYjFGSbOnLQLyeN0Usa6S6oILJXJq', 2, 7, 30, 115, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1139, 'YOGA.HAMNIKA', 'YOGA HAMNIKA', 'YOGA.HAMNIKA@SIG.ID', '$2y$12$.ALKAt/mP/fKZUE2Mrx9J.xVBNmEYP/SeP4XJ.CEHBtRH2oPxzsbK', 2, 9, 41, 28, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1140, 'YOGI.GUBTA', 'YOGI PERSADA GUBTA, SE., MM.', 'YOGI.GUBTA@SIG.ID', '$2y$12$vz75EVBheo1raShxNeYtgO8i4hnuYJW.LamvZ2Ij2rDr0gRo5cIoG', 1, 12, 38, 24, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1141, 'YOGI.SUPRIZARTO', 'YOGI SUPRIZARTO', 'YOGI.SUPRIZARTO@SIG.ID', '$2y$12$K0gBVl0QUflwR2EOIYetw.r4xbLRXI6XzH0Of2JxzhY39A2nVzt9u', 2, 10, 43, 83, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1142, 'YOHANNES', 'YOHANNES', 'YOHANNES@SIG.ID', '$2y$12$98RbnlBHBdgSUX/i00ceceTSzolr1kkcEb1BjPA.WhDkZYd/TTQFC', 2, 9, 36, 106, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1143, 'YOKE.GISKARD', 'YOKE GISKARD, ST.', 'YOKE.GISKARD@SIG.ID', '$2y$12$M1jxT2tTZJrkwiC83ZSwYOK5UVx1UYk.WNFfszDq532RKajMd50L6', 2, 11, 57, 87, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1144, 'YOLLI.PUTRA', 'YOLLI DWI PUTRA', 'YOLLI.PUTRA@SIG.ID', '$2y$12$NeD19HyxOYNj0D0sPYhmM.ULQq/lcOVhiCcSO0gSrR8fF5RU4HgMq', 2, 7, 30, 115, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1145, 'YONISMA.PUTRA', 'YONISMA PUTRA, ST.', 'YONISMA.PUTRA@SIG.ID', '$2y$12$czouk.dqIAEEHSwkZbPgHuRp6Q3yMP3a3tbvgHeTIrb5sWdS8LUAa', 2, 3, 54, 127, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1146, 'YOPI.ALEXANDRITO', 'YOPI ALEXANDRITO', 'YOPI.ALEXANDRITO@SIG.ID', '$2y$12$rFP/b/QzutMOrcb6HDT9Te.PAEYMn6xGM4IghaOdmzCYh6nFxSg/K', 3, 14, 21, 29, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1147, 'YOSEP.MARTA', 'YOSEP MARTA', 'YOSEP.MARTA@SIG.ID', '$2y$12$AdTXLxnZbmV71k049Y8o7eGGJBJIZPhBVSnMVd/tmGPCS.Vbz4HJi', 1, 12, 38, 50, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1148, 'YOSSI.DIENITA', 'YOSSI DIENITA', 'YOSSI.DIENITA@SIG.ID', '$2y$12$LO6IEFvaKbCcMV2WHDfJQ.cm13h8zLPz34EzXHSCUpphNnKFeaF16', 2, 11, 58, 130, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1149, 'YOZA.HASTUTI', 'YOZA RENO HASTUTI', 'YOZA.HASTUTI@SIG.ID', '$2y$12$8r1PouL8hG4UnvmKfPRXkeCDNdGxznLZcAeGLDTIW.Izu7pQuZaYm', 3, 5, 22, 133, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1150, 'YUDA.WANDIRA', 'YUDA ADE WANDIRA', 'YUDA.WANDIRA@SIG.ID', '$2y$12$FSvYQUUKzLy0knlTCnyLkuNA816NUIQ.SHUm8pJVbNg/w1Xdrwu6C', 2, 7, 32, 36, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1151, 'YUDHI.PERMANA', 'YUDHI PERMANA, ST.', 'YUDHI.PERMANA@SIG.ID', '$2y$12$iOuZrxCdrxotOyGXbmGlIu/48qWgibK917ZZCHe2nn73e4Rho6Fg2', 1, 1, 29, 126, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1152, 'YUDHISTIRA.FANNY', 'YUDHISTIRA FANNY, ST., MM.', 'YUDHISTIRA.FANNY@SIG.ID', '$2y$12$R5IV0mJV1QM9RJxBxCxIUO235dgBv8/Lagtz2SvoktFI7fVb/Evj6', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1153, 'YUDISTIA.PRATAMA', 'YUDISTIA HADI PRATAMA', 'YUDISTIA.PRATAMA@SIG.ID', '$2y$12$JM54u3TCMAIBPXtyZHJY9eg7KLSxORN4.p9zLIY5zj39yCCZrEs8G', 2, 7, 30, 101, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1154, 'YUHARDES', 'YUHARDES', 'YUHARDES@SIG.ID', '$2y$12$ZK.1KT4YLWSCvOxzVY76QeNjsQScMFOT1byEw3.6CGt7BwQhwfUbm', 2, 7, 30, 102, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 20:35:21'),
(1155, 'YUHARZI.FAUZI', 'YUHARZI FAUZI', 'YUHARZI.FAUZI@SIG.ID', '$2y$12$cdtyE0VUeDhMSM09lw6ZaOsxANpd4kG4QLQtAph5mQ3lrTEiRCBhS', 2, 7, 32, 62, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1156, 'YUL.EMRIZAL', 'YUL EMRIZAL', 'YUL.EMRIZAL@SIG.ID', '$2y$12$S7mLPdMPu5AIbkJtZdrXB.RFmt0mGb52WbwnGFQC/QGKVIpW9eWre', 2, 2, 9, 80, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1157, 'YULHELMUS', 'YULHELMUS', 'YULHELMUS@SIG.ID', '$2y$12$hlsB1VuR./ko0Nj2KYQw6epkfQPpCQPP7B2fJkJ6ZizrZoemEMNU.', 1, 1, 15, 134, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1158, 'YULHENDRI', 'YULHENDRI, S.M.', 'YULHENDRI@SIG.ID', '$2y$12$rnq7ZTKGA2mRRpx4KDgxW.w1MTo.7h1Xojfb2iPSo8SgYQoyH0cXq', 2, 4, 13, 58, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1159, 'YULI.ADRI', 'YULI ADRI, ST.', 'YULI.ADRI@SIG.ID', '$2y$12$QfxyDw6v/dGzRLVit2NHG.B4xKussv78lc1oFZLZBRgq3zwC5/xQG', 2, 7, 33, 67, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1160, 'YULI.ANANTO', 'YULI ANANTO', 'YULI.ANANTO@SIG.ID', '$2y$12$mH11k40WVUWWTUfsomLXf.1vFlRBjTmTySIePXqRhdNhr7/R5ykUW', 2, 7, 33, 67, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1161, 'YULIA.HIDAYATI', 'YULIA HIDAYATI, SE., Akt.', 'YULIA.HIDAYATI@SIG.ID', '$2y$12$clQbyckLCYjLt3zc.yUk7.4mrpq2x60WTBcxqQtOmu8w3pv7EfodK', 3, 5, 40, 0, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1162, 'YULIANDRI', 'YULIANDRI', 'YULIANDRI@SIG.ID', '$2y$12$ZDPycCntywa.TzISQGETYOWrCC59o6U5xOjkPYYB24Bb5no9cx02u', 2, 9, 48, 21, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(1163, 'YULLY.ILLAHI', 'YULLY KURNIA ILLAHI', 'YULLY.ILLAHI@SIG.ID', '$2y$12$RiSQVeB3FEV.oIsv9nFJC.6R2.zPBtvDkxQXsjZ.0E57PzDXpYTz2', 2, 7, 33, 39, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1164, 'YULMIDAWATI', 'YULMIDAWATI', 'YULMIDAWATI@SIG.ID', '$2y$12$PNUBlkF65WcfEah.ja0NSulL9uAr3XQ8VsngMXAZXALN4UlJiU1.e', 1, 12, 1, 71, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1165, 'YULMULYADI', 'YULMULYADI', 'YULMULYADI@SIG.ID', '$2y$12$c8McHvpSmbwxrf1.5p3w1evt2ae33WLtPFN86UyPbj9OW7beIjmw2', 2, 10, 2, 76, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-26 20:31:41'),
(1166, 'YUNDI.ANDESA', 'YUNDI ANDESA', 'YUNDI.ANDESA@SIG.ID', '$2y$12$bDAFsoduRP4Wo5.1n6qXQ.tTczFaJhK0OUQqpRHw/46YjkeRdKKeO', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(1167, 'YUSARDI', 'YUSARDI', 'YUSARDI@SIG.ID', '$2y$12$ILu/AbhvsbSDKdG9I7PfveZOz0qvKByqYkPjTg0NGmR.pepLZVOy6', 1, 12, 38, 24, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1168, 'YUSRAN.AGUSTIN', 'YUSRAN AGUSTIN', 'YUSRAN.AGUSTIN@SIG.ID', '$2y$12$NqSsfmCqySkLRRpehneHC.XaeIBuCbVpf4PIdP42mOcYzLo.aTPR2', 2, 11, 45, 111, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1169, 'YUSRI', 'YUSRI', 'YUSRI@SIG.ID', '$2y$12$DF.W/4KIHEaX5YDo5N3BZ.N0SEBEshcGwJBjdL7.EE8gnI3HQmr7q', 2, 7, 33, 64, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1170, 'YUSRIPAL', 'YUSRIPAL', 'YUSRIPAL@SIG.ID', '$2y$12$OFzdDhCmSMT.dN8sH7oAaeXYUjRBpl66Qu4RkoqiIkwBLqLhnjdPG', 3, 0, 59, 136, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(1171, 'ZAIFUL', 'ZAIFUL', 'ZAIFUL@SIG.ID', '$2y$12$JebBZYI0vbxMGvKNXOHZzereGrauOyOUp2cHB/YBh1f7A9v9PcKtm', 2, 3, 39, 68, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1172, 'ZAMRIS', 'ZAMRIS, ST.', 'ZAMRIS@SIG.ID', '$2y$12$mgo40..9Mtk72AnHYbQpSegh8xrsi2..ahb6YZd8ct5OdaisjcMh.', 3, 6, 28, 99, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10');
INSERT INTO `users` (`id_user`, `username`, `nama_user`, `email_user`, `password`, `id_direktorat`, `id_dept`, `id_unit`, `id_seksi`, `role_jabatan`, `can_create_documents`, `is_reviewer`, `is_verifier`, `foto_user`, `role_user`, `user_aktif`, `last_login`, `created_at`, `updated_at`) VALUES
(1173, 'ZEFANYA.MANGUNSONG', 'ZEFANYA MARANATHA MANGUNSONG', 'ZEFANYA.MANGUNSONG@SIG.ID', '$2y$12$u4pNUNUoAGSIe2Z4i/jlJubMr.i//n6aGGHGZ.7AkfvBGhSaCUp2q', 2, 10, 20, 89, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1174, 'ZEINIAL', 'ZEINIAL', 'ZEINIAL@SIG.ID', '$2y$12$9ZhY.eWnR8Fr6JfcBkHjnOMXdq69i4tUVlz7FHPf3egS9FKntkWEO', 2, 3, 11, 40, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(1175, 'ZIKRA', 'ZIKRA', 'ZIKRA@SIG.ID', '$2y$12$UQTEHoPnvQ18DT290ULIDO0.w5NxN1ur54PUxEvjI9tM9Ph2emBjW', 3, 14, 21, 29, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1176, 'ZUHENDRI', 'ZUHENDRI, ST.', 'ZUHENDRI@SIG.ID', '$2y$12$uUpnPGH3uvERw7yTAzQ6O.6scB4xRBi28vSYPAbpNgI20VRQd2fT6', 2, 11, 45, 120, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1177, 'ZUL.ADLI', 'ZUL ADLI', 'ZUL.ADLI@SIG.ID', '$2y$12$RC2KCX.wzEokGaXpvW8Chuqw4/DLWCjRA14ierLJ8LLi1.AJ1jWXe', 3, 5, 40, 96, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1178, 'ZUL.ARMEN', 'ZUL ARMEN', 'ZUL.ARMEN@SIG.ID', '$2y$12$4DOhefHaOdPeLlOvjZ0Ltep/OHmmkCkxVuwmfq1RPF0zhzFbaioCG', 2, 3, 11, 44, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(1179, 'ZULHENDRI', 'ZUL HENDRI', 'ZULHENDRI@SIG.ID', '$2y$12$6XRshfR4my/G4esuFd6ZH.qljRcktlkI5hMq5AOJUvof82ZhGfMka', 2, 0, 47, 124, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1180, 'ZULFADHLY', 'ZULFADHLY', 'ZULFADHLY@SIG.ID', '$2y$12$p/c0B8XBgKy8GF6avcHFMuINbhe//OYyI1AWmwhd4TOfIcC59qjKK', 2, 11, 45, 123, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1181, 'ZULFADHLY.SAPUTRA', 'ZULFADHLY SAPUTRA', 'ZULFADHLY.SAPUTRA@SIG.ID', '$2y$12$EgjbwwPlIRF8qkauzRp1dOt09EqIU/sr4VqtfPRtsyOvtUu/YazJu', 2, 9, 48, 23, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-02-03 09:03:35'),
(1182, 'ZULFAHMI.3268', 'ZULFAHMI', 'ZULFAHMI.3268@SIG.ID', '$2y$12$fTyW420X30cjMLtqeoRSMu3yRM.Orz4TA88MuXvSDtapWncb7g4o2', 2, 3, 11, 40, 4, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 18:25:55'),
(1183, 'ZULFAHMI.AMRI', 'ZULFAHMI AMRI, ST.', 'ZULFAHMI.AMRI@SIG.ID', '$2y$12$EU/WKsLjca/84astgClNt.WeaYb/OYKRPOrNZYIF0SFNyqS.AGAbu', 2, 7, 17, 61, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1184, 'ZULFIKAR.M', 'ZULFIKAR M', 'ZULFIKAR.M@SIG.ID', '$2y$12$HnMo1o/Yb61.GFUBsO/oQ.Z7wzRp.a6DMVI5iaZrG5W94jenIpPSe', 3, 14, 21, 57, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1185, 'ZULFIKAR.4444332', 'ZULFIKAR, ST', 'ZULFIKAR.4444332@SIG.ID', '$2y$12$rVWiHYTqCTqBo9sUPXGgwOXQKhhjqTN9lknb4aG356l0Xan5CS9m2', 2, 2, 9, 80, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1186, 'ZULFINAL', 'ZULFINAL', 'ZULFINAL@SIG.ID', '$2y$12$p6tq2bPgzdEWJx52L.vej.cV2g6F19DhIm9KWuVOst0g1jxuZImjW', 2, 7, 33, 48, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1187, 'ZULHAM.ERYPIKO', 'ZULHAM ERYPIKO', 'ZULHAM.ERYPIKO@SIG.ID', '$2y$12$r9dgUDTp225V.XWghIZKX.VzTguIG1dll6BECUc6ZKSRI6J6eWfCW', 2, 7, 33, 67, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1188, 'ZULHENDRA', 'ZULHENDRA', 'ZULHENDRA@SIG.ID', '$2y$12$FQ0Ei5dg7CRcllUC4FQ8/uF5GD.z/U2qlhQ8oZR1Rn1gVaV0IdQi.', 2, 9, 35, 25, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1189, 'ZULHENDRA.RAIS', 'ZULHENDRA RAIS, SH.', 'ZULHENDRA.RAIS@SIG.ID', '$2y$12$/IoJkPvzdi7wBw6Z/UhzBuTy30RQDSZweWWh8PkmE/PIElCEPrSIu', 1, 1, 29, 100, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1190, 'ZULHERMAN', 'ZULHERMAN', 'ZULHERMAN@SIG.ID', '$2y$12$JnPxyAeC6tSAnhrioVvsLuzeRwEJcukoxksJ5HPszBAw7Ia50Hb2O', 2, 4, 12, 59, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1191, 'ZULKARNAEN', 'ZULKARNAEN, ST.', 'ZULKARNAEN@SIG.ID', '$2y$12$rram9ZtE3OOy.xAb4IzHX.RikRK5GEsNGiGp814AZFX1z6rHWBjNq', 1, 13, 3, 97, 3, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1192, 'ZULKARNAIN.4444334', 'ZULKARNAIN', 'ZULKARNAIN.4444334@SIG.ID', '$2y$12$/NB.dvZFAHFVzY1UdEvEHOqmGodOKWsYZC2hTITrqgzR10vOqookS', 2, 3, 39, 5, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1193, 'ZULMAYEDI', 'ZULMAYEDI', 'ZULMAYEDI@SIG.ID', '$2y$12$1G84721m3QQPshcVfuztk.VduDvH.xschWXDdEc92ox.cqsJpfJc.', 3, 0, 59, 136, 6, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-29 00:13:18'),
(1194, 'ZULNAIDI', 'ZULNAIDI', 'ZULNAIDI@SIG.ID', '$2y$12$GLuPyRBTkyo19b6THt8MjeOqQfI.s7Ny1axcorV6jA5/e2A5qQTUm', 2, 9, 41, 28, 5, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1195, 'PRI.AKBAR', 'PRI GUSTARI AKBAR', 'PRI.GUSTARI@SIG.ID', '$2y$12$Gk5ZOOSjzsBg6rU4oBwtd.qnjCVSmw5IEOykg/l5FjDf6ZYEvfJvu', 1, 0, 0, 0, 1, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1196, 'ANDRIA.DELFA', 'ANDRIA DELFA', 'ANDRIA.DELFA@SIG.ID', '$2y$12$dp/Jte5k7N7Kuy.vXHQ2recGYkMh8vZuv6vhYBq7NqiN1kUxRt6ya', 2, 0, 0, 0, 1, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10'),
(1197, 'ISKANDAR.LUBIS', 'ISKANDAR Z. LUBIS', 'ISKANDAR.LUBIS@SIG.ID', '$2y$12$PRUcp8sEG35nDx2HseQFP.cqbeIzbkYOq68vW8hADpvGHWCQkeRGi', 3, 0, 0, 0, 1, 0, 0, 0, NULL, 2, 1, NULL, '2026-01-20 06:15:10', '2026-01-20 06:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_aktif_status`
--

CREATE TABLE `user_aktif_status` (
  `id_status` int NOT NULL,
  `nama_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_aktif_status`
--

INSERT INTO `user_aktif_status` (`id_status`, `nama_status`, `deskripsi`) VALUES
(1, 'Aktif', 'User aktif dan dapat login'),
(2, 'Tidak Aktif', 'User tidak aktif, tidak dapat login');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_processes`
--
ALTER TABLE `business_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `can_create_documents`
--
ALTER TABLE `can_create_documents`
  ADD PRIMARY KEY (`id_create_documents`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_dept`),
  ADD KEY `id_direktorat` (`id_direktorat`);

--
-- Indexes for table `direktorat`
--
ALTER TABLE `direktorat`
  ADD PRIMARY KEY (`id_direktorat`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_id_user_index` (`id_user`),
  ADD KEY `documents_status_index` (`status`);

--
-- Indexes for table `document_approvals`
--
ALTER TABLE `document_approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_approvals_document_id_index` (`document_id`),
  ADD KEY `document_approvals_approver_id_index` (`approver_id`);

--
-- Indexes for table `document_details`
--
ALTER TABLE `document_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_details_document_id_foreign` (`document_id`);

--
-- Indexes for table `foto_user`
--
ALTER TABLE `foto_user`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pmk_programs`
--
ALTER TABLE `pmk_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmk_programs_document_detail_id_foreign` (`document_detail_id`);

--
-- Indexes for table `puk_programs`
--
ALTER TABLE `puk_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `puk_programs_document_detail_id_foreign` (`document_detail_id`);

--
-- Indexes for table `role_jabatan`
--
ALTER TABLE `role_jabatan`
  ADD PRIMARY KEY (`id_role_jabatan`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id_role_user`);

--
-- Indexes for table `seksi`
--
ALTER TABLE `seksi`
  ADD PRIMARY KEY (`id_seksi`),
  ADD KEY `id_unit` (`id_unit`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`),
  ADD KEY `id_dept` (`id_dept`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email_user` (`email_user`),
  ADD KEY `role_jabatan` (`role_jabatan`),
  ADD KEY `foto_user` (`foto_user`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_email` (`email_user`),
  ADD KEY `idx_direktorat` (`id_direktorat`),
  ADD KEY `idx_dept` (`id_dept`),
  ADD KEY `idx_unit` (`id_unit`),
  ADD KEY `idx_seksi` (`id_seksi`),
  ADD KEY `idx_role_user` (`role_user`),
  ADD KEY `idx_user_aktif` (`user_aktif`),
  ADD KEY `users_can_create_documents_foreign` (`can_create_documents`);

--
-- Indexes for table `user_aktif_status`
--
ALTER TABLE `user_aktif_status`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_processes`
--
ALTER TABLE `business_processes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_dept` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `direktorat`
--
ALTER TABLE `direktorat`
  MODIFY `id_direktorat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `document_approvals`
--
ALTER TABLE `document_approvals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `document_details`
--
ALTER TABLE `document_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `foto_user`
--
ALTER TABLE `foto_user`
  MODIFY `id_foto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pmk_programs`
--
ALTER TABLE `pmk_programs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `puk_programs`
--
ALTER TABLE `puk_programs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_jabatan`
--
ALTER TABLE `role_jabatan`
  MODIFY `id_role_jabatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id_role_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seksi`
--
ALTER TABLE `seksi`
  MODIFY `id_seksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1199;

--
-- AUTO_INCREMENT for table `user_aktif_status`
--
ALTER TABLE `user_aktif_status`
  MODIFY `id_status` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `departemen`
--
ALTER TABLE `departemen`
  ADD CONSTRAINT `departemen_ibfk_1` FOREIGN KEY (`id_direktorat`) REFERENCES `direktorat` (`id_direktorat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `document_details`
--
ALTER TABLE `document_details`
  ADD CONSTRAINT `document_details_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pmk_programs`
--
ALTER TABLE `pmk_programs`
  ADD CONSTRAINT `pmk_programs_document_detail_id_foreign` FOREIGN KEY (`document_detail_id`) REFERENCES `document_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `puk_programs`
--
ALTER TABLE `puk_programs`
  ADD CONSTRAINT `puk_programs_document_detail_id_foreign` FOREIGN KEY (`document_detail_id`) REFERENCES `document_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seksi`
--
ALTER TABLE `seksi`
  ADD CONSTRAINT `seksi_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unit`
--
ALTER TABLE `unit`
  ADD CONSTRAINT `unit_ibfk_1` FOREIGN KEY (`id_dept`) REFERENCES `departemen` (`id_dept`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

