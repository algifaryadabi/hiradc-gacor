<?php
/**
 * Test Script: Verify Refined Approver Logic
 */

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Document;

echo "=== Refined Approver Logic Test ===\n\n";

// 1. Mock Objects (In-memory verification logic)
// Creates a user and checks the new helper methods

$gm = new User(['id_user' => 101, 'role_jabatan' => 2, 'id_dept' => 10, 'nama_user' => 'GM Test']);
$sm = new User(['id_user' => 102, 'role_jabatan' => 3, 'id_unit' => 20, 'id_dept' => 10, 'nama_user' => 'SM Test']);
$mgr = new User(['id_user' => 103, 'role_jabatan' => 4, 'id_seksi' => 30, 'id_unit' => 20, 'nama_user' => 'Manager Test']);
$user = new User(['id_user' => 104, 'role_jabatan' => 6, 'id_seksi' => 30, 'id_unit' => 20, 'nama_user' => 'Staff Test']);

echo "1. Testing User Helpers:\n";
echo "   GM (Role 2) isKepalaDepartemen? " . ($gm->isKepalaDepartemen() ? 'YES' : 'NO') . "\n";
echo "   SM (Role 3) isKepalaUnit? " . ($sm->isKepalaUnit() ? 'YES' : 'NO') . "\n";
echo "   Mgr (Role 4) isKepalaSeksi? " . ($mgr->isKepalaSeksi() ? 'YES' : 'NO') . "\n";
echo "   Staff (Role 6) isKepalaSeksi? " . ($user->isKepalaSeksi() ? 'YES' : 'NO') . "\n";
echo "\n";

// 2. Testing Approval Logic Mock
// Document from Unit 20, Dept 10
$doc = new Document([
    'id' => 999,
    'id_unit' => 20,
    'id_dept' => 10,
    'kategori' => 'K3',
    'status' => 'pending_level1',
    'current_level' => 1
]);

echo "2. Testing Approval match:\n";
echo "   Document Context: Unit=20, Dept=10, Level=1 (Kepala Unit).\n";
echo "   - Can SM (Unit 20) approve? ";
$canApprove = $doc->canBeApprovedBy($sm);
echo ($canApprove ? "YES (Correct)" : "NO (Failed)") . "\n";

echo "   - Can GM (Dept 10) approve at Level 1? ";
$canApprove = $doc->canBeApprovedBy($gm);
echo ($canApprove ? "YES (Wrong)" : "NO (Correct)") . "\n";

// Simulate Level 3
$doc->current_level = 3;
$doc->status = 'pending_level3';
echo "\n   Context: Level 3 (Kepala Dept).\n";
echo "   - Can GM (Dept 10) approve? ";
$canApprove = $doc->canBeApprovedBy($gm);
echo ($canApprove ? "YES (Correct)" : "NO (Failed)") . "\n";

echo "   - Can GM from Dept 11 approve? ";
$gmOther = new User(['id_user' => 199, 'role_jabatan' => 2, 'id_dept' => 11]);
$canApprove = $doc->canBeApprovedBy($gmOther);
echo ($canApprove ? "YES (Wrong)" : "NO (Correct)") . "\n";

echo "\nVerification complete.\n";
