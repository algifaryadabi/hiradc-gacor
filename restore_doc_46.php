<?php
use App\Models\Document;
use App\Models\DocumentDetail;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$docId = 46;
$doc = Document::find($docId);

if (!$doc) {
    echo "Document $docId NOT FOUND.\n";
    exit;
}

echo "Restoring Detail for Doc $docId...\n";

try {
    DocumentDetail::create([
        'document_id' => $docId,
        'kolom2_proses' => 'Restored Process',
        'kolom2_kegiatan' => 'Restored Activity ' . date('H:i:s'),
        'kolom3_lokasi' => 'Test Location',
        'kolom4_pihak' => 'Internal', // Added required field
        'kategori' => 'K3',
        'kolom5_kondisi' => 'Rutin',
        'kolom6_bahaya' => ['details' => ['Bahaya Fisik'], 'type' => 'unsafe_condition'],
        'kolom7_dampak' => 'Dampak Test',
        'kolom9_risiko' => 'Risiko Test',
        'kolom10_pengendalian' => ['hierarchy' => ['Eliminasi']],
        'kolom11_existing' => 'Existing Control Test', // Added required field
        'kolom12_kemungkinan' => 3,
        'kolom13_konsekuensi' => 3,
        'kolom14_score' => 9,
        'kolom14_level' => 'Risk Level',
        'kolom15_regulasi' => 'Regulasi Test',
        'kolom16_aspek' => 'P',
        'kolom17_risiko' => 'Risiko',
        'kolom17_peluang' => 'Peluang',
        'kolom18_tindak_lanjut' => 'Monitoring',
        'kolom18_toleransi' => 'Ya', // Added required field
        'residual_kemungkinan' => 2,
        'residual_konsekuensi' => 2,
        'residual_score' => 4,
        'residual_level' => 'Low', // Added required field
    ]);
    echo "Detail Created. Count: " . DocumentDetail::where('document_id', $docId)->count() . "\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
