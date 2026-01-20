<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "DB_CONNECTION: " . config('database.default') . "\n";
echo "DB_DATABASE: " . config('database.connections.mysql.database') . "\n";
echo "DB_HOST: " . config('database.connections.mysql.host') . "\n";
echo "User Table Columns: " . implode(',', \Illuminate\Support\Facades\Schema::getColumnListing('users')) . "\n";
