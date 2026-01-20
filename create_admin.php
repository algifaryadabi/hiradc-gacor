<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Check if admin exists
    $admin = DB::table('users')->where('username', 'admin')->first();
    
    if ($admin) {
        echo "Admin user already exists!\n";
        echo "Username: admin\n";
        echo "Updating password to: admin123\n";
        
        DB::table('users')
            ->where('username', 'admin')
            ->update([
                'password' => Hash::make('admin123'),
                'updated_at' => now()
            ]);
        
        echo "✅ Password updated!\n";
    } else {
        echo "Creating new admin user...\n";
        
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'nama_user' => 'Administrator',
            'email_user' => 'admin@semenpadang.com',
            'role_user' => 'admin',
            'user_aktif' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        echo "✅ Admin user created!\n";
    }
    
    echo "\n=== LOGIN CREDENTIALS ===\n";
    echo "Username: admin\n";
    echo "Password: admin123\n";
    echo "========================\n";
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
