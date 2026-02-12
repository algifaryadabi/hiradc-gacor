<?php
// Execute revision schema SQL
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Adding revision tracking schema...\n\n";

try {
    // Step 1: Create Document Histories Table
    echo "Creating tr_document_histories table...\n";
    DB::statement("
        CREATE TABLE IF NOT EXISTS `tr_document_histories` (
          `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
          `document_id` bigint(20) UNSIGNED NOT NULL,
          `revision_number` int(11) NOT NULL DEFAULT 0,
          `revision_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `archived_by` int(11) DEFAULT NULL,
          `snapshot_data` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `archived_at` timestamp NOT NULL DEFAULT current_timestamp(),
          `created_at` timestamp NULL DEFAULT NULL,
          `updated_at` timestamp NULL DEFAULT NULL,
          PRIMARY KEY (`id`),
          KEY `tr_document_histories_document_id_foreign` (`document_id`),
          KEY `tr_document_histories_archived_by_foreign` (`archived_by`),
          CONSTRAINT `tr_document_histories_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
          CONSTRAINT `tr_document_histories_archived_by_foreign` FOREIGN KEY (`archived_by`) REFERENCES `users` (`id_user`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✓ Table created successfully\n\n";

    // Step 2: Add Revision Columns to Documents Table
    echo "Adding revision columns to documents table...\n";

    DB::statement("ALTER TABLE `documents` ADD COLUMN `revision_number` INT NOT NULL DEFAULT 0 AFTER `status`");
    echo "✓ Added revision_number\n";

    DB::statement("ALTER TABLE `documents` ADD COLUMN `revision_reason` TEXT NULL AFTER `revision_number`");
    echo "✓ Added revision_reason\n";

    DB::statement("ALTER TABLE `documents` ADD COLUMN `last_review_date` DATE NULL AFTER `published_at`");
    echo "✓ Added last_review_date\n";

    DB::statement("ALTER TABLE `documents` ADD COLUMN `is_need_evaluation` TINYINT(1) NOT NULL DEFAULT 0 AFTER `last_review_date`");
    echo "✓ Added is_need_evaluation\n\n";

    // Step 3: Update last_review_date for existing published documents
    echo "Updating last_review_date for existing published documents...\n";
    $updated = DB::table('documents')
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->update(['last_review_date' => DB::raw('DATE(published_at)')]);
    echo "✓ Updated {$updated} documents\n\n";

    echo "✅ Revision Schema Added Successfully!\n";

} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    if (strpos($e->getMessage(), 'Duplicate column') !== false) {
        echo "ℹ️  Column already exists - skipping\n";
    }
}
