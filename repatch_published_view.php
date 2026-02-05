<?php

$targetFile = 'd:\AAA\hiradc-gacor\resources\views\documents\published_detail.blade.php';
$patchFile = 'd:\AAA\hiradc-gacor\puk_patch_published_v2.blade.php';

if (!file_exists($targetFile)) {
    die("Target file not found: $targetFile\n");
}

if (!file_exists($patchFile)) {
    die("Patch file not found: $patchFile\n");
}

$content = file_get_contents($targetFile);
$patch = file_get_contents($patchFile);

$startMarker = '<!-- PROGRESS PROGRAM TABLES (PUK & PMK) - INSERTED VIA PATCH -->';
$endMarker = '<!-- END PROGRESS PROGRAM TABLES -->';

$startPos = strpos($content, $startMarker);
$endPos = strpos($content, $endMarker);

if ($startPos === false || $endPos === false) {
    die("Error: Could not find existing patch markers in target file. Maybe it wasn't patched properly?\n");
}

// Calculate length of the block to replace
$endPos += strlen($endMarker);
$length = $endPos - $startPos;

// Replace the block
$newContent = substr_replace($content, $patch, $startPos, $length);

file_put_contents($targetFile, $newContent);

echo "Successfully RE-patched published_detail.blade.php with V2 content.\n";
