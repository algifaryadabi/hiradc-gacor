<?php
// Test Master Data API endpoint
$url = 'http://127.0.0.1:8000/admin/master/matriks';
$data = [
    'kemungkinan' => 3,
    'konsekuensi' => 4,
    'score' => 12,
    'level' => 'Tinggi',
    'warna' => '#2196F3',
    'program_mitigasi' => 'Program Unit Kerja atau Program Manajemen'
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response:\n";
echo $response;
echo "\n";
