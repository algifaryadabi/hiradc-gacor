<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

try {
    echo "Starting schema fix...\n";

    // 1. FIX TABLE NAME
    if (Schema::hasTable('can_create_document') && !Schema::hasTable('can_create_documents')) {
        Schema::rename('can_create_document', 'can_create_documents');
        echo "Renamed table 'can_create_document' -> 'can_create_documents'\n";
    }

    // 2. FIX REFERENCE COLUMN
    if (Schema::hasTable('can_create_documents')) {
        if (Schema::hasColumn('can_create_documents', 'id_can_create_document')) {
            Schema::table('can_create_documents', function (Blueprint $table) {
                $table->renameColumn('id_can_create_document', 'id_create_documents');
            });
            echo "Renamed ref column 'id_can_create_document' -> 'id_create_documents'\n";
        }
    }

    // 3. FIX USERS COLUMN (The main issue)
    if (Schema::hasTable('users')) {
        // Drop old FK if exists (try multiple standard names)
        $fks = ['users_can_create_document_foreign', 'can_create_document_foreign'];
        foreach ($fks as $fk) {
            try {
                Schema::table('users', function (Blueprint $table) use ($fk) {
                    $table->dropForeign($fk);
                });
                echo "Dropped FK '$fk'\n";
            } catch (\Exception $e) {
                // Ignore if not exists
            }
        }

        // Try array syntax (Laravel guesses name)
        try {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['can_create_document']);
            });
            echo "Dropped FK using array syntax ['can_create_document']\n";
        } catch (\Exception $e) {
            // Ignore
        }

        // Rename Column
        if (Schema::hasColumn('users', 'can_create_document') && !Schema::hasColumn('users', 'can_create_documents')) {
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('can_create_document', 'can_create_documents');
            });
            echo "Renamed user column 'can_create_document' -> 'can_create_documents'\n";
        } else {
            echo "User column rename check: Old exists? " . (Schema::hasColumn('users', 'can_create_document') ? 'YES' : 'NO') . ". New exists? " . (Schema::hasColumn('users', 'can_create_documents') ? 'YES' : 'NO') . "\n";
        }
    }

    // 4. RE-ESTABLISH FK
    try {
        if (Schema::hasColumn('users', 'can_create_documents')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreign('can_create_documents')
                    ->references('id_create_documents')
                    ->on('can_create_documents')
                    ->onDelete('restrict');
            });
            echo "Re-established Foreign Key.\n";
        }
    } catch (\Exception $e) {
        echo "FK re-establish error: " . $e->getMessage() . "\n";
    }

    echo "Fix complete.\n";

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
