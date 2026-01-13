<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

echo "=== Checking Test Users ===\n\n";

// Check user ABD RAHMAN (id=11) from SQL dump
$user = User::find(11);
if ($user) {
    echo "User: {$user->nama_user}\n";
    echo "  - role_jabatan: {$user->role_jabatan}\n";
    echo "  - id_unit: {$user->id_unit}\n";
    echo "  - id_dept: {$user->id_dept}\n";
    echo "  - getRoleName(): {$user->getRoleName()}\n";
    echo "  - Dashboard Route: {$user->getDashboardRoute()}\n\n";
}

// Check if we can change user 11 to be Kepala Unit Security for testing
echo "To test, you can update user manually in database:\n";
echo "UPDATE users SET role_jabatan=3, id_unit=55 WHERE id_user=11; -- Make Kepala Unit Security\n";
echo "UPDATE users SET role_jabatan=3, id_unit=56 WHERE id_user=18; -- Make Kepala Unit SHE\n";
