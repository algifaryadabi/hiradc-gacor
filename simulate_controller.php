<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Simulating Controller Call ===\n\n";

try {
    $users = \App\Models\User::with(['direktorat', 'departemen', 'unit', 'seksi'])->get();
    $direktorats = \App\Models\Direktorat::all();
    $departemens = \App\Models\Departemen::all(); 
    $units = \App\Models\Unit::all();
    $seksis = \App\Models\Seksi::all();
    
    echo "SUCCESS! Data retrieved:\n";
    echo "- Users: " . $users->count() . "\n";
    echo "- Direktorats: " . $direktorats->count() . "\n";
    echo "- Departemens: " . $departemens->count() . "\n";
    echo "- Units: " . $units->count() . "\n";
    echo "- Seksis: " . $seksis->count() . "\n";
    
    echo "\n=== Testing json_encode (like in view) ===\n";
    $json_dir = json_encode($direktorats);
    $json_dept = json_encode($departemens);
    
    echo "Direktorats JSON length: " . strlen($json_dir) . " chars\n";
    echo "Departemens JSON length: " . strlen($json_dept) . " chars\n";
    
    echo "\nFirst direktorat in JSON:\n";
    echo substr($json_dir, 0, 300) . "...\n";
    
} catch (\Exception $e) {
    echo "ERROR in try block: " . $e->getMessage() . "\n";
    echo "This means controller would return empty arrays!\n";
}
