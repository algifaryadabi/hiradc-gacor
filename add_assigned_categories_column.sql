-- Add assigned_categories column to users table

ALTER TABLE `users` 
ADD COLUMN `assigned_categories` JSON NULL AFTER `is_verifier`;

SELECT 'assigned_categories column added successfully' as status;
