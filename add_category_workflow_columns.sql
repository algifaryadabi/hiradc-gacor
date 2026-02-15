-- SQL Script untuk Menambahkan Workflow Paralel Per Kategori
-- Import script ini ke phpMyAdmin untuk menambahkan kolom baru

-- Tambahkan kolom status per kategori
ALTER TABLE `documents` ADD COLUMN `status_k3` VARCHAR(255) NULL;
ALTER TABLE `documents` ADD COLUMN `status_ko` VARCHAR(255) NULL;
ALTER TABLE `documents` ADD COLUMN `status_lingkungan` VARCHAR(255) NULL;

-- Tambahkan kolom reviewer per kategori
ALTER TABLE `documents` ADD COLUMN `k3_reviewer_id` BIGINT UNSIGNED NULL;
ALTER TABLE `documents` ADD COLUMN `ko_reviewer_id` BIGINT UNSIGNED NULL;
ALTER TABLE `documents` ADD COLUMN `lingkungan_reviewer_id` BIGINT UNSIGNED NULL;

-- Tambahkan kolom verificator per kategori
ALTER TABLE `documents` ADD COLUMN `k3_verificator_id` BIGINT UNSIGNED NULL;
ALTER TABLE `documents` ADD COLUMN `ko_verificator_id` BIGINT UNSIGNED NULL;
ALTER TABLE `documents` ADD COLUMN `lingkungan_verificator_id` BIGINT UNSIGNED NULL;

-- Tambahkan kolom compliance checklist per kategori
ALTER TABLE `documents` ADD COLUMN `compliance_checklist_k3` JSON NULL;
ALTER TABLE `documents` ADD COLUMN `compliance_checklist_ko` JSON NULL;
ALTER TABLE `documents` ADD COLUMN `compliance_checklist_lingkungan` JSON NULL;

-- Tambahkan kolom timestamp per kategori
ALTER TABLE `documents` ADD COLUMN `k3_approved_at` TIMESTAMP NULL;
ALTER TABLE `documents` ADD COLUMN `ko_approved_at` TIMESTAMP NULL;
ALTER TABLE `documents` ADD COLUMN `lingkungan_approved_at` TIMESTAMP NULL;

-- Selesai!
SELECT 'Kolom workflow paralel per kategori berhasil ditambahkan!' AS status;
