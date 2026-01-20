<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Testing Model Data Retrieval ===\n\n";

try {
    echo "1. Testing Direktorat::all()\n";
    $direktorats = \App\Models\Direktorat::all();
    echo "   Result: " . $direktorats->count() . " records\n";
    if ($direktorats->count() > 0) {
        echo "   First record: " . json_encode($direktorats->first()->toArray()) . "\n";
    }
    
    echo "\n2. Testing Departemen::all()\n";
    $departemens = \App\Models\Departemen::all();
    echo "   Result: " . $departemens->count() . " records\n";
    if ($departemens->count() > 0) {
        echo "   First record: " . json_encode($departemens->first()->toArray()) . "\n";
    }
    
    echo "\n3. Testing Unit::all()\n";
    $units = \App\Models\Unit::all();
    echo "   Result: " . $units->count() . " records\n";
    
    echo "\n4. Testing Seksi::all()\n";
    $seksis = \App\Models\Seksi::all();
    echo "   Result: " . $seksis->count() . " records\n";
    
    echo "\n=== Testing json_encode ===\n";
    $json = json_encode($direktorats);
    echo "JSON length: " . strlen($json) . " characters\n";
    echo "First 200 chars: " . substr($json, 0, 200) . "...\n";
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
