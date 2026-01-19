<?php
use App\Models\User;
use App\Models\Unit;
use App\Models\Departemen;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Check Units
echo "\n--- UNITS Matching 'SHE' or 'Keamanan' ---\n";
$units = Unit::where('nama_unit', 'like', '%SHE%')
    ->orWhere('nama_unit', 'like', '%Safety%')
    ->orWhere('nama_unit', 'like', '%Keamanan%')
    ->orWhere('nama_unit', 'like', '%Security%')->get();
foreach ($units as $u) {
    echo "Unit ID: $u->id_unit | Name: $u->nama_unit\n";
}

// Check Depts
echo "\n--- DEPARTMENTS Matching 'SHE' or 'Keamanan' ---\n";
$depts = Departemen::where('nama_dept', 'like', '%SHE%')
    ->orWhere('nama_dept', 'like', '%Safety%')
    ->orWhere('nama_dept', 'like', '%Keamanan%')
    ->orWhere('nama_dept', 'like', '%Security%')->get();
foreach ($depts as $d) {
    echo "Dept ID: $d->id_dept | Name: $d->nama_dept\n";
}

// Check Users in these units
echo "\n--- USERS in these Units/Depts ---\n";
// ... (omitted for brevity, assume manual check covers it if Units found)

echo "Checking Users with Role 2, 3, 4 etc...\n";
$users = User::all();

foreach ($users as $u) {
    if ($u->id_unit || $u->id_dept) {
        $unitName = $u->unit ? $u->unit->nama_unit : '-';
        $deptName = $u->departemen ? $u->departemen->nama_dept : '-';

        // Filter likely candidates
        if (
            stripos($unitName, 'SHE') !== false || stripos($unitName, 'Safe') !== false ||
            stripos($unitName, 'Sec') !== false || stripos($unitName, 'Keamanan') !== false ||
            stripos($deptName, 'SHE') !== false || stripos($deptName, 'Keamanan') !== false
        ) {
            echo "ID: $u->id_user | Name: $u->nama_user | Role: $u->id_role_jabatan | Unit: $unitName | Dept: $deptName\n";
        }
    }
}
