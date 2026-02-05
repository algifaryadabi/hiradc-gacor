<?php

$targetFile = 'd:\AAA\hiradc-gacor\resources\views\user\documents\show.blade.php';
$replacementFile = 'd:\AAA\hiradc-gacor\puk_replacement.blade.php';

$content = file_get_contents($targetFile);
$replacement = file_get_contents($replacementFile);

$startMarker = '<!-- PROGRESS PROGRAM TABLES (PUK & PMK) -->';
$endMarker = '<!-- Approval History -->';

$startPos = strpos($content, $startMarker);
$endPos = strpos($content, $endMarker);

if ($startPos === false || $endPos === false) {
    die("Error: Could not find markers.\nStart: " . ($startPos === false ? 'Not Found' : 'Found') . "\nEnd: " . ($endPos === false ? 'Not Found' : 'Found') . "\n");
}

// Keep the start marker, replace everything else up to end marker
$newContent = substr($content, 0, $startPos) . $replacement . "\n\n            " . substr($content, $endPos);

file_put_contents($targetFile, $newContent);

echo "Successfully patched show.blade.php\n";
