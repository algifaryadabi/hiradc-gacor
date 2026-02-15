<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

try {
    if (!Schema::hasColumn('users', 'assigned_categories')) {
        Schema::table('users', function (Blueprint $table) {
            $table->json('assigned_categories')->nullable();
        });
        echo "SUCCESS: Column added.\n";
    } else {
        echo "Column already exists.\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
