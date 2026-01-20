<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Fixing role_user Data ===\n\n";

try {
    $roles = DB::table('role_user')->get();
    echo "Current Roles:\n";
    $existingIds = [];
    foreach ($roles as $role) {
        $existingIds[] = $role->id_role_user;
        echo "- ID: {$role->id_role_user}, Name: " . ($role->nama_role_user ?? $role->name ?? 'N/A') . "\n";
    }
    
    // Define required roles based on user mapping
    // 1: Admin
    // 2: User
    // 3: Approver
    // 4: Unit Pengelola / Kepala Unit
    // 5: Kepala Departemen
    
    $requiredRoles = [
        1 => 'Admin',
        2 => 'User',
        3 => 'Approver',
        4 => 'Unit Pengelola',
        5 => 'Kepala Departemen'
    ];
    
    echo "\nChecking missing roles...\n";
    
    foreach ($requiredRoles as $id => $name) {
        if (!in_array($id, $existingIds)) {
            echo "Inserting ID $id ($name)... ";
            
            // Check table columns to know what to insert
            $columns = DB::getSchemaBuilder()->getColumnListing('role_user');
            $insertData = ['id_role_user' => $id];
            
            if (in_array('nama_role_user', $columns)) {
                $insertData['nama_role_user'] = $name;
            } elseif (in_array('name', $columns)) {
                $insertData['name'] = $name;
            }
            
            // Add timestamps if exist
            if (in_array('created_at', $columns)) {
                $insertData['created_at'] = now();
                $insertData['updated_at'] = now();
            }
            
            DB::table('role_user')->insert($insertData);
            echo "DONE.\n";
        } else {
            echo "ID $id exists.\n";
        }
    }
    
    echo "\nVerifying...\n";
    $finalRoles = DB::table('role_user')->get();
    echo "Total Roles: " . $finalRoles->count() . "\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
