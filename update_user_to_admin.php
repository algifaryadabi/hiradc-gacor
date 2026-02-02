<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== UPDATE USER TO ADMIN ===\n\n";

// Find user
$user = App\Models\User::where('username', 'ANDRIA.RUKMA')->first();

if (!$user) {
    echo "❌ User ANDRIA.RUKMA not found!\n";
    exit(1);
}

echo "User found:\n";
echo "  ID: {$user->id_user}\n";
echo "  Name: {$user->nama_user}\n";
echo "  Email: {$user->email_user}\n";
echo "  Current role_user: {$user->role_user}\n\n";

// Update to admin
echo "Updating role_user to 1 (Admin)...\n";
$user->role_user = 1;
$user->save();

echo "✓ Update successful!\n\n";

// Verify
$user->refresh();
echo "Verification:\n";
echo "  role_user: {$user->role_user}\n";
echo "  getRoleName(): {$user->getRoleName()}\n";
echo "  getDashboardRoute(): {$user->getDashboardRoute()}\n";
echo "  isAdmin(): " . ($user->isAdmin() ? 'TRUE' : 'FALSE') . "\n\n";

if ($user->isAdmin()) {
    echo "✓✓✓ SUCCESS! User is now an admin.\n";
    echo "\nNext steps:\n";
    echo "1. Logout from the current session\n";
    echo "2. Login again with ANDRIA.RUKMA credentials\n";
    echo "3. You should see the admin dashboard\n";
} else {
    echo "❌ Something went wrong. User is not recognized as admin.\n";
}

echo "\n=== END ===\n";
