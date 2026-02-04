-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 04, 2026 at 01:58 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16
-- FIXED: Replaced utf8mb4_0900_ai_ci with utf8mb4_unicode_ci for MySQL 5.7 compatibility

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
(14, 15, NULL, NULL, NULL, 2, 9, 48, 23, 'K3', 'Identifikasi dan Penetapan Mitigasi Risiko Pengamanan', 'draft', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Maintenance Productive Asset', 'juh', '-', 'Rutin', '{"type":"","kategori":null,"details":[],"manual":"","aspects":[],"threats":[]}', '-', '{"hierarchy":[],"new_controls":[]}', '-', 1, 1, 0, NULL, NULL, 'TP', NULL, NULL, 1, 1, 0, NULL, NULL, '2026-02-04 01:50:29', '2026-02-04 01:50:29');

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
(22, 14, 'K3', 'Maintenance Productive Asset', 'juh', '-', NULL, 'Rutin', '{"kategori":null,"details":[],"manual":""}', '{"manual": "", "details": []}', '{"manual": "", "details": []}', NULL, NULL, NULL, NULL, '-', '{"hierarchy":[],"existing":null}', '-', 1, 1, 0, 'Rendah', NULL, 'TP', NULL, NULL, 'Ya', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 'Rendah', '2026-02-04 01:50:29', '2026-02-04 01:50:29');

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
