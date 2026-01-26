<?php

use Illuminate\Support\Facades\DB;
use App\Models\Document;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Checking connection to database: " . config('database.connections.mysql.database') . "\n";
    DB::connection()->getPdo();
    echo "Connection successful.\n";

    if (Schema::hasTable('documents')) {
        echo "Table 'documents' exists.\n";
        $doc = DB::table('documents')->find(70);
        if ($doc) {
            echo "Document ID 70 found.\n";
        } else {
            echo "Document ID 70 NOT found.\n";
            $count = DB::table('documents')->count();
            echo "Total documents in table: $count\n";
        }
    } else {
        echo "Table 'documents' DOES NOT EXIST.\n";
    }
} catch (\Exception $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}
