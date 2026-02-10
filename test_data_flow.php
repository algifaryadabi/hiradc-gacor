<?php
/**
 * Test Script: Direct Database to View Test
 * This will show exactly what data is being passed to the view
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Document;

$documentId = $argv[1] ?? 46;

echo "=== Testing Document #{$documentId} Data Flow ===\n\n";

$document = Document::find($documentId);

if (!$document) {
    echo "❌ Document not found!\n";
    exit(1);
}

echo "1. Document loaded: ✅\n";
echo "   ID: {$document->id}\n";
echo "   Judul: {$document->judul_dokumen}\n\n";

echo "2. Loading details WITHOUT eager load:\n";
$detailsLazy = $document->details;
echo "   Count: {$detailsLazy->count()}\n";
if ($detailsLazy->count() > 0) {
    echo "   ✅ Details accessible via lazy loading\n";
} else {
    echo "   ❌ No details found via lazy loading!\n";
}

echo "\n3. Loading details WITH eager load:\n";
$document->load(['details']);
$detailsEager = $document->details;
echo "   Count: {$detailsEager->count()}\n";
if ($detailsEager->count() > 0) {
    echo "   ✅ Details accessible via eager loading\n";
    foreach ($detailsEager as $idx => $detail) {
        echo "   Detail #{$idx + 1}:\n";
        echo "     - ID: {$detail->id}\n";
        echo "     - Kegiatan: {$detail->kolom2_kegiatan}\n";
        echo "     - Kategori: {$detail->kategori}\n";
    }
} else {
    echo "   ❌ No details found via eager loading!\n";
}

echo "\n4. Checking Document model relationships:\n";
$reflection = new ReflectionClass($document);
$methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
$hasDetailsMethod = false;
foreach ($methods as $method) {
    if ($method->name === 'details') {
        $hasDetailsMethod = true;
        break;
    }
}

if ($hasDetailsMethod) {
    echo "   ✅ 'details' relationship method exists\n";
} else {
    echo "   ❌ 'details' relationship method NOT found!\n";
}

echo "\n5. Testing in controller context:\n";
$document2 = Document::find($documentId);
$document2->load([
    'details',
    'details.pukProgram',
    'details.pmkProgram',
    'pmkProgram',
    'pukProgram',
    'user',
    'unit',
    'departemen',
    'direktorat'
]);

echo "   Details count after controller-style load: {$document2->details->count()}\n";
if ($document2->details->count() > 0) {
    echo "   ✅ This is what controller should pass to view\n";
} else {
    echo "   ❌ Problem with controller load!\n";
}

echo "\n=== Test Complete ===\n";
