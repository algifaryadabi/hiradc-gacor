-- SQL Script to Drop role_user and user_aktif_status Tables
-- Run this manually in your MySQL/phpMyAdmin or database client

-- Drop role_user table
DROP TABLE IF EXISTS `role_user`;

-- Drop user_aktif_status table  
DROP TABLE IF EXISTS `user_aktif_status`;

-- Verify the tables are dropped
SHOW TABLES LIKE 'role_user';
SHOW TABLES LIKE 'user_aktif_status';

-- Expected result: Empty set (0 rows) for both queries above
