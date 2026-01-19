<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

try {
    echo "Checking Foreign Keys on 'users' table:\n";
    $fks = Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys('users');
    foreach ($fks as $fk) {
        echo "Name: " . $fk->getName() . " | Cols: " . implode(', ', $fk->getLocalColumns()) . "\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
