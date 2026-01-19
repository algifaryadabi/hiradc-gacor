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

echo "Document $docId Found. Status: " . $doc->status . ", Level: " . $doc->current_level . "\n";
echo "Attributes present in Document table (Fillable match): \n";
// print_r($doc->getAttributes());

$details = DocumentDetail::where('document_id', $docId)->get();
echo "Details Found: " . $details->count() . "\n";

if ($details->count() > 0) {
    echo "First Detail ID: " . $details->first()->id . "\n";
    echo "Kegiatan: " . $details->first()->kolom2_kegiatan . "\n";
} else {
    echo "NO DETAILS FOUND in DB!\n";
}

// Check if Document has columns like kolom2_kegiatan
$hasCol = Schema::hasColumn('documents', 'kolom2_kegiatan');
echo "Document table has 'kolom2_kegiatan'? " . ($hasCol ? 'YES' : 'NO') . "\n";
