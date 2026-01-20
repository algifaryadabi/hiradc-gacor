<?php

// Test script untuk memverifikasi data user
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing User Data ===\n\n";

try {
    $userCount = App\Models\User::count();
    echo "Total users in database: $userCount\n\n";
    
    if ($userCount > 0) {
        echo "Sample users (first 3):\n";
        $users = App\Models\User::with(['direktorat', 'departemen', 'unit', 'seksi', 'roleJabatan'])
            ->take(3)
            ->get();
        
        foreach ($users as $user) {
            echo "- ID: {$user->id_user}\n";
            echo "  Username: {$user->username}\n";
            echo "  Email: {$user->email_user}\n";
            echo "  Direktorat: " . ($user->direktorat ? $user->direktorat->nama_direktorat : 'NULL') . "\n";
            echo "  Departemen: " . ($user->departemen ? $user->departemen->nama_dept : 'NULL') . "\n";
            echo "  Unit: " . ($user->unit ? $user->unit->nama_unit : 'NULL') . "\n";
            echo "  Seksi: " . ($user->seksi ? $user->seksi->nama_seksi : 'NULL') . "\n";
            echo "  Role Jabatan: " . ($user->roleJabatan ? $user->roleJabatan->nama_role_jabatan : 'NULL') . "\n";
            echo "\n";
        }
        
        echo "\n=== Testing JSON Serialization ===\n";
        $jsonUsers = App\Models\User::with(['direktorat', 'departemen', 'unit', 'seksi', 'roleJabatan'])
            ->take(1)
            ->get();
        echo "JSON output sample:\n";
        echo json_encode($jsonUsers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        echo "\n";
    }
    
    echo "\n=== SUCCESS ===\n";
} catch (\Exception $e) {
    echo "\n=== ERROR ===\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
