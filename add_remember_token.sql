-- Script untuk menambahkan kolom remember_token ke tabel users
-- Jalankan script ini di MySQL/phpMyAdmin

USE hiradc;

-- Cek apakah kolom remember_token sudah ada
-- Jika belum ada, tambahkan kolom tersebut
ALTER TABLE users 
ADD COLUMN IF NOT EXISTS remember_token VARCHAR(100) NULL 
AFTER password;

-- Verifikasi struktur tabel
DESCRIBE users;
