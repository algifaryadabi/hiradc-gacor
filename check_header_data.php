<?php
use App\Models\Document;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$doc = Document::where('status', 'approved')->orWhere('status', 'published')->has('details', '=', 0)->first();

if ($doc) {
    echo "Found Valid Target Doc ID: " . $doc->id . "\n";
    echo "Kegiatan (Header): " . $doc->kolom2_kegiatan . "\n";
    echo "Lokasi (Header): " . $doc->kolom3_lokasi . "\n";
    echo "Details Count: " . $doc->details()->count() . "\n";

    // Check all relevant columns
    $cols = ['kolom2_kegiatan', 'kolom3_lokasi', 'kolom5_kondisi', 'kolom7_dampak', 'kolom9_risiko', 'kolom12_kemungkinan', 'kolom13_konsekuensi', 'kolom14_score'];
    foreach ($cols as $c) {
        echo "$c: " . ($doc->$c ?? 'NULL') . "\n";
    }

} else {
    echo "No approved doc with 0 details found.\n";
}
