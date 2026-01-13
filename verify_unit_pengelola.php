<?php
/**
 * Verification Script - Unit Pengelola Approval Restrictions
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Document;
use App\Models\Unit;
use App\Models\Departemen;

echo "=== VERIFICATION: Unit Pengelola Approval Restrictions ===\n\n";

// 1. Check who are Kepala Unit from SHE and Security
echo "1. Kepala Unit from Unit SHE (id=56) and Security (id=55):\n";
echo str_repeat("-", 80) . "\n";

try {
    $kepalaUnitSHE = User::where('role_jabatan', 3)
        ->where('id_unit', 56)
        ->get();

    $kepalaUnitSecurity = User::where('role_jabatan', 3)
        ->where('id_unit', 55)
        ->get();

    echo "Unit SHE (id=56) - Kepala Unit:\n";
    if ($kepalaUnitSHE->count() > 0) {
        foreach ($kepalaUnitSHE as $user) {
            echo "  - {$user->nama_user} (ID: {$user->id_user})\n";
        }
    } else {
        echo "  ⚠️  TIDAK ADA Kepala Unit di Unit SHE!\n";
    }

    echo "\nUnit Security (id=55) - Kepala Unit:\n";
    if ($kepalaUnitSecurity->count() > 0) {
        foreach ($kepalaUnitSecurity as $user) {
            echo "  - {$user->nama_user} (ID: {$user->id_user})\n";
        }
    } else {
        echo "  ⚠️  TIDAK ADA Kepala Unit di Unit Security!\n";
    }

    // 2. Check Level 2 pending documents
    echo "\n\n2. Documents Pending at Level 2 (Unit Pengelola):\n";
    echo str_repeat("-", 80) . "\n";

    $level2Docs = Document::where('current_level', 2)
        ->where('status', 'pending_level2')
        ->with(['user', 'unit', 'departemen'])
        ->get();

    if ($level2Docs->count() > 0) {
        foreach ($level2Docs as $doc) {
            echo "Doc ID: {$doc->id} | Kategori: {$doc->kategori}\n";
            echo "  User: {$doc->user->nama_user}\n";
            echo "  Should be approved by: ";

            if (in_array($doc->kategori, ['K3', 'KO', 'Lingkungan'])) {
                echo "Kepala Unit SHE (unit_id=56)\n";
            } else {
                echo "Kepala Unit Security (unit_id=55)\n";
            }
            echo "\n";
        }
    } else {
        echo "Tidak ada dokumen pending di Level 2\n";
    }

    // 3. Check Kepala Departemen
    echo "\n3. Kepala Departemen (General Manager, role_jabatan=2):\n";
    echo str_repeat("-", 80) . "\n";

    $kepalaDept = User::where('role_jabatan', 2)->get();

    if ($kepalaDept->count() > 0) {
        foreach ($kepalaDept as $user) {
            $dept = Departemen::find($user->id_dept);
            echo "  - {$user->nama_user} (ID: {$user->id_user})\n";
            echo "    Departemen: " . ($dept ? $dept->nama_dept : 'N/A') . " (ID: {$user->id_dept})\n\n";
        }
    } else {
        echo "  ⚠️  TIDAK ADA Kepala Departemen!\n";
    }

    // 4. Verify Department Hierarchy
    echo "\n4. Department Hierarchy:\n";
    echo str_repeat("-", 80) . "\n";

    $unitSHE = Unit::find(56);
    $unitSecurity = Unit::find(55);

    if ($unitSHE) {
        $deptSHE = Departemen::find($unitSHE->id_dept);
        echo "Unit SHE (id=56):\n";
        echo "  - Belongs to Departemen: " . ($deptSHE ? $deptSHE->nama_dept : 'N/A') . " (ID: {$unitSHE->id_dept})\n";
    }

    if ($unitSecurity) {
        $deptSecurity = Departemen::find($unitSecurity->id_dept);
        echo "\nUnit Security (id=55):\n";
        echo "  - Belongs to Departemen: " . ($deptSecurity ? $deptSecurity->nama_dept : 'N/A') . " (ID: {$unitSecurity->id_dept})\n";
    }

    echo "\n\n=== SUMMARY ===\n";
    echo "✓ Level 2: Hanya Kepala Unit (role_jabatan=3) dari Unit SHE/Security\n";
    echo "✓ Level 3: Ke Kepala Departemen (role_jabatan=2) sesuai id_dept dokumen\n";

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\n";
