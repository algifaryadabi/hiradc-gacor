<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== CHECKING FOR ADMIN USERS ===\n\n";

// Find all users with role_user = 1
echo "1. Users with role_user = 1 (Admin):\n";
$admins = App\Models\User::where('role_user', 1)->get();

if ($admins->count() > 0) {
    foreach ($admins as $admin) {
        echo "   ✓ ID: {$admin->id_user} | Username: {$admin->username} | Name: {$admin->nama_user} | Email: {$admin->email_user}\n";
    }
} else {
    echo "   ✗ NO ADMIN USERS FOUND!\n";
}

echo "\n2. All users with their role_user values:\n";
$allUsers = App\Models\User::select('id_user', 'username', 'nama_user', 'email_user', 'role_user', 'role_jabatan', 'id_unit')
    ->orderBy('role_user')
    ->get();

foreach ($allUsers as $user) {
    $roleName = match((int)$user->role_user) {
        1 => 'ADMIN',
        2 => 'USER',
        3 => 'APPROVER',
        default => 'UNKNOWN'
    };
    
    echo "   ID: {$user->id_user} | {$user->username} | {$user->nama_user} | role_user: {$user->role_user} ({$roleName}) | role_jabatan: {$user->role_jabatan} | unit: {$user->id_unit}\n";
}

echo "\n3. Suggestion:\n";
echo "   To make user ANDRIA RUKMA an admin, run:\n";
echo "   UPDATE users SET role_user = 1 WHERE username = 'ANDRIA.RUKMA';\n";

echo "\n=== END CHECK ===\n";
