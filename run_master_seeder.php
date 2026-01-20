<?php
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Seeding master data...\n\n";
    
    // 1. Seed Kemungkinan
    echo "Seeding Kemungkinan...\n";
    $kemungkinan = [
        ['level' => 1, 'nama' => 'Sangat Jarang', 'deskripsi' => 'Hampir tidak pernah terjadi', 'frekuensi' => '< 1 kali/tahun'],
        ['level' => 2, 'nama' => 'Jarang', 'deskripsi' => 'Jarang terjadi', 'frekuensi' => '1-2 kali/tahun'],
        ['level' => 3, 'nama' => 'Kadang-kadang', 'deskripsi' => 'Terjadi sesekali', 'frekuensi' => '3-5 kali/tahun'],
        ['level' => 4, 'nama' => 'Sering', 'deskripsi' => 'Sering terjadi', 'frekuensi' => '6-10 kali/tahun'],
        ['level' => 5, 'nama' => 'Sangat Sering', 'deskripsi' => 'Hampir selalu terjadi', 'frekuensi' => '> 10 kali/tahun'],
    ];
    foreach ($kemungkinan as $item) {
        DB::table('master_kemungkinan')->insert(array_merge($item, ['created_at' => now(), 'updated_at' => now()]));
    }
    echo "✓ Kemungkinan seeded (5 rows)\n";

    // 2. Seed Konsekuensi K3
    echo "Seeding Konsekuensi K3...\n";
    $konsekuensiK3 = [
        ['level' => 1, 'nama' => 'P3K', 'deskripsi' => 'Luka ringan, tidak perlu istirahat', 'dampak' => 'Pertolongan Pertama Pada Kecelakaan'],
        ['level' => 2, 'nama' => 'Perawatan Medis', 'deskripsi' => 'Memerlukan perawatan dokter', 'dampak' => 'Medical Treatment'],
        ['level' => 3, 'nama' => 'Hilang Hari Kerja', 'deskripsi' => 'Cedera sedang, perlu istirahat', 'dampak' => 'Lost Time Injury (LTI)'],
        ['level' => 4, 'nama' => 'Cacat Permanen', 'deskripsi' => 'Cedera berat, cacat tetap', 'dampak' => 'Permanent Disability'],
        ['level' => 5, 'nama' => 'Fatality', 'deskripsi' => 'Kematian', 'dampak' => 'Kematian 1 orang atau lebih'],
    ];
    foreach ($konsekuensiK3 as $item) {
        DB::table('master_konsekuensi_k3')->insert(array_merge($item, ['created_at' => now(), 'updated_at' => now()]));
    }
    echo "✓ Konsekuensi K3 seeded (5 rows)\n";

    // 3. Seed Konsekuensi Lingkungan
    echo "Seeding Konsekuensi Lingkungan...\n";
    $konsekuensiLingkungan = [
        ['level' => 1, 'nama' => 'Sangat Kecil', 'deskripsi' => 'Dampak minimal, mudah dipulihkan', 'dampak' => 'Tidak ada dampak signifikan'],
        ['level' => 2, 'nama' => 'Kecil', 'deskripsi' => 'Dampak terbatas, pemulihan cepat', 'dampak' => 'Pencemaran lokal, mudah diatasi'],
        ['level' => 3, 'nama' => 'Sedang', 'deskripsi' => 'Dampak moderat, perlu penanganan', 'dampak' => 'Pencemaran area terbatas'],
        ['level' => 4, 'nama' => 'Besar', 'deskripsi' => 'Dampak signifikan, pemulihan lama', 'dampak' => 'Pencemaran luas, butuh remediasi'],
        ['level' => 5, 'nama' => 'Sangat Besar', 'deskripsi' => 'Dampak masif, kerusakan permanen', 'dampak' => 'Kerusakan ekosistem permanen'],
    ];
    foreach ($konsekuensiLingkungan as $item) {
        DB::table('master_konsekuensi_lingkungan')->insert(array_merge($item, ['created_at' => now(), 'updated_at' => now()]));
    }
    echo "✓ Konsekuensi Lingkungan seeded (5 rows)\n";

    // 4. Seed Konsekuensi Keamanan
    echo "Seeding Konsekuensi Keamanan...\n";
    $konsekuensiKeamanan = [
        ['level' => 1, 'nama' => 'Gangguan Minor', 'deskripsi' => 'Gangguan kecil, tidak material', 'dampak' => 'Kerugian < Rp 10 juta'],
        ['level' => 2, 'nama' => 'Gangguan Sedang', 'deskripsi' => 'Gangguan operasional ringan', 'dampak' => 'Kerugian Rp 10-50 juta'],
        ['level' => 3, 'nama' => 'Gangguan Signifikan', 'deskripsi' => 'Gangguan operasional moderat', 'dampak' => 'Kerugian Rp 50-100 juta'],
        ['level' => 4, 'nama' => 'Gangguan Serius', 'deskripsi' => 'Gangguan operasional berat', 'dampak' => 'Kerugian Rp 100-500 juta'],
        ['level' => 5, 'nama' => 'Gangguan Kritis', 'deskripsi' => 'Sabotase/kerugian masif', 'dampak' => 'Kerugian > Rp 500 juta'],
    ];
    foreach ($konsekuensiKeamanan as $item) {
        DB::table('master_konsekuensi_keamanan')->insert(array_merge($item, ['created_at' => now(), 'updated_at' => now()]));
    }
    echo "✓ Konsekuensi Keamanan seeded (5 rows)\n";

    // 5. Seed Matriks Risiko
    echo "Seeding Matriks Risiko...\n";
    for ($kemungkinan = 1; $kemungkinan <= 5; $kemungkinan++) {
        for ($konsekuensi = 1; $konsekuensi <= 5; $konsekuensi++) {
            $score = $kemungkinan * $konsekuensi;
            
            if ($score <= 3) {
                $level = 'RENDAH';
                $warna = '#4CAF50';
            } elseif ($score <= 8) {
                $level = 'SEDANG';
                $warna = '#FFEB3B';
            } elseif ($score <= 15) {
                $level = 'TINGGI';
                $warna = '#FF9800';
            } else {
                $level = 'SANGAT TINGGI';
                $warna = '#F44336';
            }
            
            DB::table('master_matriks_risiko')->insert([
                'kemungkinan' => $kemungkinan,
                'konsekuensi' => $konsekuensi,
                'score' => $score,
                'level' => $level,
                'warna' => $warna,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
    echo "✓ Matriks Risiko seeded (25 rows)\n";

    echo "\n✅ All master data seeded successfully!\n";

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
