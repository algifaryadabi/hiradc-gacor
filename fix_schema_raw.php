<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    echo "Starting RAW SQL schema fix...\n";

    // 1. RENAME TABLE (if needed)
    if (Schema::hasTable('can_create_document') && !Schema::hasTable('can_create_documents')) {
        DB::statement('RENAME TABLE can_create_document TO can_create_documents');
        echo "Renamed table -> can_create_documents\n";
    }

    // 2. RENAME REFERENCE COLUMN
    if (Schema::hasTable('can_create_documents')) {
        if (Schema::hasColumn('can_create_documents', 'id_can_create_document')) {
            DB::statement('ALTER TABLE can_create_documents CHANGE COLUMN id_can_create_document id_create_documents TINYINT');
            echo "Renamed ref column -> id_create_documents\n";
        }
    }

    // 3. FIX USERS TABLE
    if (Schema::hasTable('users')) {
        // Try to drop FK blindly (common name)
        try {
            DB::statement('ALTER TABLE users DROP FOREIGN KEY users_can_create_document_foreign');
            echo "Dropped FK users_can_create_document_foreign\n";
        } catch (\Exception $e) {
            // maybe it's can_create_document_foreign
            try {
                DB::statement('ALTER TABLE users DROP FOREIGN KEY can_create_document_foreign');
                echo "Dropped FK can_create_document_foreign\n";
            } catch (\Exception $z) {
                echo "Could not drop FK (might not exist): " . $z->getMessage() . "\n";
            }
        }

        // Rename Column
        if (Schema::hasColumn('users', 'can_create_document') && !Schema::hasColumn('users', 'can_create_documents')) {
            DB::statement('ALTER TABLE users CHANGE COLUMN can_create_document can_create_documents TINYINT DEFAULT 0');
            echo "Renamed user column -> can_create_documents\n";
        }

        // Add FK back
        try {
            DB::statement('ALTER TABLE users ADD CONSTRAINT users_can_create_documents_foreign FOREIGN KEY (can_create_documents) REFERENCES can_create_documents(id_create_documents)');
            echo "Added new FK constraint.\n";
        } catch (\Exception $e) {
            echo "Failed adding FK: " . $e->getMessage() . "\n";
        }
    }

    echo "Done.\n";
} catch (\Exception $e) {
    echo "FATAL ERROR: " . $e->getMessage() . "\n";
}
