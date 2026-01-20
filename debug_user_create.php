<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Debug User Creation ===\n";

// 1. Check Table Columns
echo "Checking 'users' table columns...\n";
$columns = Schema::getColumnListing('users');
echo "Columns: " . implode(', ', $columns) . "\n";

$hasTimestamps = in_array('created_at', $columns) && in_array('updated_at', $columns);
echo "Has Timestamps: " . ($hasTimestamps ? "YES" : "NO") . "\n";

// 2. Check Database Connection
echo "Database: " . config('database.connections.mysql.database') . "\n";

// 3. Try to Create User
echo "\nAttempting to create user...\n";

try {
    $userData = [
        'username' => 'debug_user_' . time(),
        'email_user' => 'debug_' . time() . '@test.com',
        'password' => bcrypt('password'),
        'role_user' => 2,
        'user_aktif' => 1,
        'nama_user' => 'Debug User'
    ];
    
    // Create new instance to check model settings
    $u = new User();
    echo "Model uses timestamps: " . ($u->timestamps ? "YES" : "NO") . "\n";
    
    // Force save
    $user = User::create($userData);
    
    echo "User created successfully with ID: " . $user->id_user . "\n";
    
    // Verify in DB directly
    $check = DB::table('users')->where('id_user', $user->id_user)->first();
    if ($check) {
        echo "VERIFICATION: User EXISTS in database.\n";
    } else {
        echo "VERIFICATION: User NOT FOUND in database via DB facade!\n";
    }
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    
    // If error is related to timestamps
    if (strpos($e->getMessage(), 'Unknown column \'updated_at\'') !== false) {
        echo "\nSUGGESTION: Add 'public \$timestamps = false;' to User model.\n";
    }
}
