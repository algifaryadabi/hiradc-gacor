<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Checking status_aktif Column ===\n\n";

try {
    // Test 1: All direktorat
    $all = \App\Models\Direktorat::all();
    echo "1. Direktorat::all() = " . $all->count() . " records\n";
    
    // Test 2: With status_aktif = 1
    $active = \App\Models\Direktorat::where('status_aktif', 1)->get();
    echo "2. Direktorat::where('status_aktif', 1) = " . $active->count() . " records\n";
    
    // Test 3: Show sample data
    if ($all->count() > 0) {
        echo "\n3. Sample data (first 3 records):\n";
        foreach ($all->take(3) as $d) {
            echo "   - ID: {$d->id_direktorat}, Nama: {$d->nama_direktorat}, Status: " . ($d->status_aktif ?? 'NULL') . "\n";
        }
    }
    
    // Test 4: Check if column exists
    echo "\n4. Checking column existence:\n";
    $first = $all->first();
    if ($first) {
        $attributes = $first->getAttributes();
        echo "   Columns: " . implode(', ', array_keys($attributes)) . "\n";
        echo "   Has status_aktif: " . (array_key_exists('status_aktif', $attributes) ? 'YES' : 'NO') . "\n";
    }
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
