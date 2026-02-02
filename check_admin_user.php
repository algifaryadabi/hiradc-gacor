<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== DIAGNOSTIC: Admin User Check ===\n\n";

// 1. Check table structure
echo "1. Checking 'users' table structure:\n";
$columns = DB::select('SHOW COLUMNS FROM users');
echo "Columns: ";
foreach($columns as $col) {
    echo $col->Field . ", ";
}
echo "\n\n";

// 2. Find user ANDRIA DELFA
echo "2. Looking for user 'ANDRIA DELFA':\n";
$user = App\Models\User::where('nama_user', 'LIKE', '%ANDRIA%')
    ->orWhere('username', 'LIKE', '%ANDRIA%')
    ->first();

if ($user) {
    echo "✓ User Found!\n";
    echo "   ID: " . $user->id_user . "\n";
    echo "   Username: " . $user->username . "\n";
    echo "   Nama: " . $user->nama_user . "\n";
    echo "   Email: " . $user->email_user . "\n";
    echo "   role_user: " . ($user->role_user ?? 'NULL') . "\n";
    echo "   id_role_user: " . ($user->id_role_user ?? 'NULL') . "\n";
    echo "   role_jabatan: " . ($user->role_jabatan ?? 'NULL') . "\n";
    echo "   id_unit: " . ($user->id_unit ?? 'NULL') . "\n";
    echo "   user_aktif: " . ($user->user_aktif ?? 'NULL') . "\n";
    echo "\n";
    
    echo "3. Testing role detection methods:\n";
    echo "   getRoleName(): " . $user->getRoleName() . "\n";
    echo "   getDashboardRoute(): " . $user->getDashboardRoute() . "\n";
    echo "   isAdmin(): " . ($user->isAdmin() ? 'TRUE' : 'FALSE') . "\n";
    echo "   isActive(): " . ($user->isActive() ? 'TRUE' : 'FALSE') . "\n";
    echo "\n";
    
    // 4. Check raw database value
    echo "4. Raw database check:\n";
    $rawUser = DB::table('users')->where('id_user', $user->id_user)->first();
    echo "   Raw role_user from DB: " . ($rawUser->role_user ?? 'NULL') . " (type: " . gettype($rawUser->role_user ?? null) . ")\n";
    echo "   Raw id_role_user from DB: " . ($rawUser->id_role_user ?? 'NULL') . " (type: " . gettype($rawUser->id_role_user ?? null) . ")\n";
    echo "\n";
    
    // 5. Test the condition
    echo "5. Testing admin condition:\n";
    $roleUser = $user->role_user ?? $user->id_role_user;
    echo "   \$user->role_user ?? \$user->id_role_user = " . ($roleUser ?? 'NULL') . "\n";
    echo "   Is it == 1? " . (($roleUser == 1) ? 'YES' : 'NO') . "\n";
    echo "   Is it === 1? " . (($roleUser === 1) ? 'YES' : 'NO') . "\n";
    echo "   Is it === '1'? " . (($roleUser === '1') ? 'YES' : 'NO') . "\n";
    echo "\n";
    
} else {
    echo "✗ User NOT found!\n\n";
    
    echo "All users in database:\n";
    $allUsers = App\Models\User::select('id_user', 'username', 'nama_user', 'role_user', 'id_role_user')->get();
    foreach($allUsers as $u) {
        echo "   ID: {$u->id_user} | Username: {$u->username} | Name: {$u->nama_user} | role_user: " . ($u->role_user ?? 'NULL') . " | id_role_user: " . ($u->id_role_user ?? 'NULL') . "\n";
    }
}

echo "\n=== END DIAGNOSTIC ===\n";
