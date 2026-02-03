<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\User;
use App\Models\Document;
use App\Models\DocumentDetail;
use App\Models\PukProgram;
use App\Models\PmkProgram;
use App\Http\Controllers\ApprovalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Start Session for Auth (Native Check)
if (session_status() === PHP_SESSION_NONE)
    session_start();

// SETUP USERS
$kaUnit = User::where('role_jabatan', 3)->first(); // Kepala Unit
$kaDept = User::where('role_jabatan', 2)->first(); // Kepala Dept
$direktur = User::where('role_jabatan', 1)->first(); // Direktur

if (!$kaUnit || !$kaDept || !$direktur) {
    echo "ERROR: Missing required users for test.\n";
    exit;
}

echo "Testing Users:\n";
echo "- Ka Unit: {$kaUnit->nama_user} (Unit: {$kaUnit->id_unit})\n";
echo "- Ka Dept: {$kaDept->nama_user} (Dept: {$kaDept->id_dept})\n";
echo "- Direktur: {$direktur->nama_user} (Role: {$direktur->role_jabatan})\n";

// TEST 1: IS DIREKTUR HELPER
echo "\n--- TEST 1: isDirektur Helper ---\n";
echo "User {$direktur->nama_user} isDirektur? " . ($direktur->isDirektur() ? 'YES' : 'NO') . "\n";
echo "User {$kaUnit->nama_user} isDirektur? " . ($kaUnit->isDirektur() ? 'YES' : 'NO') . "\n";

// TEST 2: PUK APPROVAL
echo "\n--- TEST 2: PUK Approval ---\n";
$doc = Document::create([
    'id_user' => $kaUnit->id_user,
    'id_unit' => $kaUnit->id_unit,
    'judul_dokumen' => 'Test HIRADC for PUK',
    'status' => 'draft'
]);
$detail = DocumentDetail::create([
    'document_id' => $doc->id,
    'kategori' => 'K3',
    'kolom2_proses' => 'Test Process',
    'kolom2_kegiatan' => 'Test Activity',
    'kolom3_lokasi' => 'Test Location',
    'kolom5_kondisi' => 'Normal',
    'kolom6_bahaya' => json_encode([]),
    'kolom7_dampak' => 'Test Impact',
    'kolom9_risiko' => 'Test Risk', // Required
    'kolom10_pengendalian' => json_encode([]),
    'kolom11_existing' => 'Existing Control', // Required
    'kolom12_kemungkinan' => 3, // Required
    'kolom13_konsekuensi' => 3, // Required
    'kolom14_score' => 9,       // Required
    'kolom14_level' => 'Medium', // Required
    'kolom18_tindak_lanjut' => 'Follow up', // Required
    'residual_kemungkinan' => 2, // Required
    'residual_konsekuensi' => 2, // Required
    'residual_score' => 4,       // Required
    'residual_level' => 'Low'    // Required
]);
$puk = PukProgram::create([
    'document_detail_id' => $detail->id,
    'judul' => 'Test PUK',
    'status' => 'pending_unit',
    'created_by' => $kaUnit->id_user
]);

// Mock Auth
Auth::login($kaUnit);
$controller = new ApprovalController();
$req = new Request();

echo "Case A: Approved by Connect Ka Unit\n";
$response = $controller->approvePuk($req, $puk->id);
echo "Response: " . $response->getContent() . "\n";
$puk->refresh();
echo "PUK Status: {$puk->status}\n";

// TEST 3: PMK APPROVAL
echo "\n--- TEST 3: PMK Approval ---\n";
// Create PMK
$pmk = PmkProgram::create([
    'document_detail_id' => $detail->id,
    'judul' => 'Test PMK',
    'status' => 'pending_unit',
    'created_by' => $kaUnit->id_user
]);

// 3.1 Approve by Unit
echo "Step 1: Approve by Unit\n";
Auth::login($kaUnit);
$response = $controller->approvePmk($req, $pmk->id);
echo "Response: " . $response->getContent() . "\n";
$pmk->refresh();
echo "Status: {$pmk->status} (Expected: pending_dept)\n";

// 3.2 Approve by Dept (Mock Dept Match)
echo "Step 2: Approve by Dept\n";
// Ensure doc and user dept match
$doc->id_dept = $kaDept->id_dept;
$doc->save();

Auth::login($kaDept);
$response = $controller->approvePmk($req, $pmk->id);
echo "Response: " . $response->getContent() . "\n";
$pmk->refresh();
echo "Status: {$pmk->status} (Expected: pending_direksi)\n";

// 3.3 Approve by Direksi
echo "Step 3: Approve by Direksi\n";
// Ensure doc and user direktorat match
$doc->id_direktorat = $direktur->id_direktorat;
$doc->save();

Auth::login($direktur);
$response = $controller->approvePmk($req, $pmk->id);
echo "Response: " . $response->getContent() . "\n";
$pmk->refresh();
echo "Status: {$pmk->status} (Expected: approved)\n";

// Cleanup
$puk->delete();
$pmk->delete();
$detail->delete();
$doc->delete();
