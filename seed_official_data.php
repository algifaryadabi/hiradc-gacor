<?php
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "📊 Seeding official master data...\n\n";
    
    // 1. KEMUNGKINAN (5 rows)
    echo "Seeding Kemungkinan...\n";
    $kemungkinan = [
        [
            'level' => 5,
            'nama' => 'Hampir Pasti',
            'penjelasan' => 'Sering terjadi dan atau kejadiannya lebih dari 1 kali sebulan'
        ],
        [
            'level' => 4,
            'nama' => 'Kemungkinan Besar',
            'penjelasan' => 'Dapat terjadi dengan mudah dan atau minimal kejadiannya lebih dari 1 kali setahun hingga 1 kali sebulan'
        ],
        [
            'level' => 3,
            'nama' => 'Mungkin',
            'penjelasan' => 'Seharusnya terjadi dan atau minimal 1 kali per lima tahun hingga 1 kali per tahun'
        ],
        [
            'level' => 2,
            'nama' => 'Kemungkinan Kecil',
            'penjelasan' => 'Bisa terjadi pada suatu waktu dan atau 1 kali per sepuluh tahun'
        ],
        [
            'level' => 1,
            'nama' => 'Jarang Terjadi',
            'penjelasan' => 'Kemungkinan kecil terjadi dan atau periode kejadiannya lebih dari 1 kali persepuluh tahun'
        ],
    ];
    
    foreach ($kemungkinan as $item) {
        DB::table('master_kemungkinan')->insert(array_merge($item, [
            'created_at' => now(),
            'updated_at' => now()
        ]));
    }
    echo "✅ Kemungkinan seeded (5 rows)\n\n";
    
    // 2. KONSEKUENSI K3/KO (5 rows × 7 columns)
    echo "Seeding Konsekuensi K3/KO...\n";
    $konsekuensiK3 = [
        [
            'level' => 5,
            'konsekuensi_manusia' => 'Menyebabkan kematian',
            'financial' => 'Berdampak keuangan ≥ Rp. 10 M',
            'objective' => 'Kehilangan kesempatan produksi semen ≥ 35,000 ton/hari',
            'legal' => 'Pelanggaran peraturan yang berat berupa pencabutan izin operasional perusahaan sementara atau denda senilai ≥ Rp. 10 M',
            'biaya_program_mitigasi' => 'Biaya >Rp. 200 Juta',
            'reputasi' => 'Berdampak Signifikan bagi reputasi Perusahaan. Melibatkan pemberitaan di media massa dengan pangsa nasional (liputan utama)'
        ],
        [
            'level' => 4,
            'konsekuensi_manusia' => 'Cidera yang mengakibatkan cacat/hilangnya fungsi tubuh secara total',
            'financial' => 'Berdampak keuangan ≥ Rp. 5 M s.d < Rp. 10 M',
            'objective' => 'Kehilangan kesempatan produksi semen 25,000 ton s.d < 35,000 ton/hari',
            'legal' => 'Pelanggaran peraturan yang berat berupa pencabutan izin operasional perusahaan sementara atau denda senilai Rp. 5 M - Rp. 10 M',
            'biaya_program_mitigasi' => 'Biaya Rp. 100 Juta <Biaya<Rp. 200 Juta',
            'reputasi' => 'Berdampak serius bagi reputasi Perusahaan. Melibatkan pemberitaan di media massa dengan pangsa lokal (liputan utama)'
        ],
        [
            'level' => 3,
            'konsekuensi_manusia' => 'Memerlukan perawatan medis dan mengakibatkan hilangnya fungsi anggota tubuh untuk sementara waktu',
            'financial' => 'Berdampak keuangan ≥ Rp. 2.5 M s.d < Rp. 5 M',
            'objective' => 'Kehilangan kesempatan produksi semen ≥ 15,000 ton s.d < 25,000 ton/hari',
            'legal' => 'Pelanggaran peraturan yang serius atau berupa pencabutan izin operasi pengaduan pada pihak berwenang dengan kemungkinan putusan hukum berupa peringatan keras kepada perusahaan atau denda senilai Rp. 2.5 M - Rp. 10 M',
            'biaya_program_mitigasi' => 'Biaya Rp. 25 Juta<Biaya<Rp. 100 Juta',
            'reputasi' => 'Berdampak serius bagi reputasi Perusahaan. Melibatkan pemberitaan di media massa dengan pangsa lokal terbatas (liputan utama)'
        ],
        [
            'level' => 2,
            'konsekuensi_manusia' => 'Memerlukan perawatan P3K',
            'financial' => 'Berdampak keuangan ≥ Rp. 250 jt s.d < Rp. 2.5 M',
            'objective' => 'Kehilangan kesempatan produksi semen ≥ 350 ton s.d < 15,000 ton/hari',
            'legal' => 'Pelanggaran peraturan yang serius atau pengaduan pada pihak berwenang dengan kemungkinan putusan hukum berupa peringatan keras kepada perusahaan atau denda senilai Rp. 250 jt – Rp.2.5 M',
            'biaya_program_mitigasi' => 'Biaya Rp. 10 Juta<Biaya<Rp. 25 Juta',
            'reputasi' => 'Berdampak bagi reputasi Perusahaan. Melibatkan pemberitaan di media massa dengan pangsa lokal terbatas (bukan liputan utama)'
        ],
        [
            'level' => 1,
            'konsekuensi_manusia' => 'Tidak ada cidera',
            'financial' => 'Berdampak keuangan < Rp. 250 jt',
            'objective' => 'Kehilangan kesempatan produksi semen ≤ 350ton/hari',
            'legal' => 'Pelanggaran peraturan, isu hukum dan ketidakpatuhan ringan',
            'biaya_program_mitigasi' => 'Biaya < Rp. 10 Juta',
            'reputasi' => 'Berdampak bagi reputasi Perusahaan yang tidak tersebar luas dan tidak terdapat pemberitaan di media'
        ],
    ];
    
    foreach ($konsekuensiK3 as $item) {
        DB::table('master_konsekuensi_k3')->insert(array_merge($item, [
            'created_at' => now(),
            'updated_at' => now()
        ]));
    }
    echo "✅ Konsekuensi K3 seeded (5 rows)\n\n";
    
    // 3. KONSEKUENSI LINGKUNGAN (5 rows × 12 columns)
    echo "Seeding Konsekuensi Lingkungan...\n";
    $konsekuensiLingkungan = [
        [
            'level' => 5,
            'cakupan_lokasi' => 'Radius > 1 KM di Kota Padang',
            'lama_pemulihan' => '> 5 tahun',
            'lama_penyimpangan' => '> 50 %',
            'financial' => 'Berdampak keuangan ≥ Rp. 10 M',
            'objective' => 'Kehilangan kesempatan produksi semen ≥ 35,000 ton/hari',
            'legal' => 'Pelanggaran peraturan yang berat berupa pencabutan izin operasional perusahaan sementara atau denda senilai ≥ Rp. 10 M',
            'product_image' => 'CSI < 50 %',
            'konsekuensi_manusia' => 'Menimbulkan Pengusiran/ Penolakan iklim',
            'dampak_sosial' => 'Isu TK I / Nasional/Glo bal',
            'biaya_perbaikan' => 'Biaya >Rp. 200 Juta',
            'reputasi' => 'Berdampak Signifikan bagi reputasi Perusahaan. Melibatkan pemberitaan di media massa dengan pangsa nasional (liputan utama)'
        ],
        [
            'level' => 4,
            'cakupan_lokasi' => '200 m - 1 KM di Kec. Lubuk Kilangan',
            'lama_pemulihan' => '≤/d 5 tahun',
            'lama_penyimpangan' => '25 - 50 %',
            'financial' => 'Berdampak keuangan ≥ Rp. 5 M s.d < Rp. 10 M',
            'objective' => 'Kehilangan kesempatan produksi semen 25,000 ton s.d < 35,000 ton/hari',
            'legal' => 'Pelanggaran peraturan yang berat berupa pencabutan izin operasional perusahaan sementara atau denda senilai Rp. 5 M - Rp. 10 M',
            'product_image' => 'CSI 50 – 65 %',
            'konsekuensi_manusia' => 'Menimbulkan Pengusiran/ Penolakan',
            'dampak_sosial' => 'Isu TK I / Nasional/Glo bal',
            'biaya_perbaikan' => 'Biaya Rp. 100 Juta <Biaya<Rp. 200 Juta',
            'reputasi' => 'Berdampak serius bagi reputasi Perusahaan. Melibatkan pemberitaan di media massa dengan pangsa lokal (liputan utama)'
        ],
        [
            'level' => 3,
            'cakupan_lokasi' => 'Radius < 200 m di sekitar Timek Pabrik',
            'lama_pemulihan' => '≤/d 1 tahun',
            'lama_penyimpangan' => '16 % - 25 %',
            'financial' => 'Berdampak keuangan ≥ Rp. 2.5 M s.d < Rp. 5 M',
            'objective' => 'Kehilangan kesempatan produksi semen ≥ 15,000 ton s.d < 25,000 ton/hari',
            'legal' => 'Pelanggaran peraturan yang serius atau berupa pencabutan izin operasi pengaduan pada pihak berwenang dengan kemungkinan putusan hukum berupa peringatan keras kepada perusahaan atau denda senilai Rp. 2.5 M - Rp. 10 M',
            'product_image' => 'CSI 65 – 80 %',
            'konsekuensi_manusia' => 'Menimbulkan Pencemaran',
            'dampak_sosial' => 'Isu di TK II',
            'biaya_perbaikan' => 'Biaya Rp. 25 Juta<Biaya<Rp. 100 Juta',
            'reputasi' => 'Berdampak serius bagi reputasi Perusahaan. Melibatkan pemberitaan di media massa dengan pangsa lokal terbatas (liputan utama)'
        ],
        [
            'level' => 2,
            'cakupan_lokasi' => 'Di area pabrik',
            'lama_pemulihan' => '≤/d 1 bulan',
            'lama_penyimpangan' => '6 % - 15 %',
            'financial' => 'Berdampak keuangan ≥ Rp. 250 jt s.d < Rp. 2.5 M',
            'objective' => 'Kehilangan kesempatan produksi semen ≥ 350 ton s.d < 15,000 ton/hari',
            'legal' => 'Pelanggaran peraturan yang serius atau pengaduan pada pihak berwenang dengan kemungkinan putusan hukum berupa peringatan keras kepada perusahaan atau denda senilai Rp. 250 jt – Rp.2.5 M',
            'product_image' => 'CSI 80 – 95 %',
            'konsekuensi_manusia' => 'Adanya gangguan',
            'dampak_sosial' => 'Keluihan (1 s/d 5 kali setahun)',
            'biaya_perbaikan' => 'Biaya Rp. 10 Juta<Biaya<Rp. 25 Juta',
            'reputasi' => 'Berdampak bagi reputasi Perusahaan. Melibatkan pemberitaan di media massa dengan pangsa lokal terbatas (bukan liputan utama)'
        ],
        [
            'level' => 1,
            'cakupan_lokasi' => 'Ditempat kerja',
            'lama_pemulihan' => '≤/d 1 minggu',
            'lama_penyimpangan' => '≤ 5 %',
            'financial' => 'Berdampak keuangan < Rp. 250 jt',
            'objective' => 'Kehilangan kesempatan produksi semen ≤ 350ton/hari',
            'legal' => 'Pelanggaran peraturan, isu hukum dan ketidakpatuhan ringan',
            'product_image' => 'CSI > 95 %',
            'konsekuensi_manusia' => 'Tidak Ada Gangguan',
            'dampak_sosial' => 'Adanya keluhan (1 kali setahun)',
            'biaya_perbaikan' => 'Biaya < Rp. 10 Juta',
            'reputasi' => 'Berdampak bagi reputasi Perusahaan yang tidak tersebar luas dan tidak terdapat pemberitaan di media'
        ],
    ];
    
    foreach ($konsekuensiLingkungan as $item) {
        DB::table('master_konsekuensi_lingkungan')->insert(array_merge($item, [
            'created_at' => now(),
            'updated_at' => now()
        ]));
    }
    echo "✅ Konsekuensi Lingkungan seeded (5 rows)\n\n";
    
    // 4. KONSEKUENSI KEAMANAN (5 rows × 6 columns)
    echo "Seeding Konsekuensi Keamanan...\n";
    $konsekuensiKeamanan = [
        [
            'level' => 5,
            'konsekuensi_manusia' => 'Kematian',
            'financial' => 'Berdampak keuangan ≥ Rp. 10 M',
            'objective' => 'Kehilangan kesempatan produksi semen ≥ 35,000 ton/hari',
            'legal' => 'Pelanggaran peraturan yang berat berupa pencabutan izin operasional perusahaan sementara atau denda senilai ≥ Rp. 10 M',
            'biaya_program_mitigasi' => 'Biaya >Rp. 200 Juta',
            'reputasi' => 'Berdampak Signifikan bagi reputasi Perusahaan. Melibatkan pemberitaan di media massa dengan pangsa nasional (liputan utama)'
        ],
        [
            'level' => 4,
            'konsekuensi_manusia' => 'Cacat Permanen',
            'financial' => 'Berdampak keuangan ≥ Rp. 5 M s.d < Rp. 10 M',
            'objective' => 'Kehilangan kesempatan produksi semen 25,000 ton s.d < 35,000 ton/hari',
            'legal' => 'Pelanggaran peraturan yang berat berupa pencabutan izin operasional perusahaan sementara atau denda senilai Rp. 5 M - Rp. 10 M',
            'biaya_program_mitigasi' => 'Biaya Rp. 100 Juta <Biaya<Rp. 200 Juta',
            'reputasi' => 'Berdampak serius bagi reputasi Perusahaan. Melibatkan pemberitaan di media massa dengan pangsa lokal (liputan utama)'
        ],
        [
            'level' => 3,
            'konsekuensi_manusia' => 'Cidera',
            'financial' => 'Berdampak keuangan ≥ Rp. 2.5 M s.d < Rp. 5 M',
            'objective' => 'Kehilangan kesempatan produksi semen ≥ 15,000 ton s.d < 25,000 ton/hari',
            'legal' => 'Pelanggaran peraturan yang serius atau berupa pencabutan izin operasi pengaduan pada pihak berwenang dengan kemungkinan putusan hukum berupa peringatan keras kepada perusahaan atau denda senilai Rp. 2.5 M - Rp. 10 M',
            'biaya_program_mitigasi' => 'Biaya Rp. 25 Juta<Biaya<Rp. 100 Juta',
            'reputasi' => 'Berdampak serius bagi reputasi Perusahaan. Melibatkan pemberitaan di media massa dengan pangsa lokal terbatas (liputan utama)'
        ],
        [
            'level' => 2,
            'konsekuensi_manusia' => 'Stress',
            'financial' => 'Berdampak keuangan ≥ Rp. 250 jt s.d < Rp. 2.5 M',
            'objective' => 'Kehilangan kesempatan produksi semen ≥ 350 ton s.d < 15,000 ton/hari',
            'legal' => 'Pelanggaran peraturan yang serius atau pengaduan pada pihak berwenang dengan kemungkinan putusan hukum berupa peringatan keras kepada perusahaan atau denda senilai Rp. 250 jt – Rp.2.5 M',
            'biaya_program_mitigasi' => 'Biaya Rp. 10 Juta<Biaya<Rp. 25 Juta',
            'reputasi' => 'Berdampak bagi reputasi Perusahaan. Melibatkan pemberitaan di media massa dengan pangsa lokal terbatas (bukan liputan utama)'
        ],
        [
            'level' => 1,
            'konsekuensi_manusia' => 'Tidak ada gangguan',
            'financial' => 'Berdampak keuangan < Rp. 250 jt',
            'objective' => 'Kehilangan kesempatan produksi semen ≤ 350ton/hari',
            'legal' => 'Pelanggaran peraturan, isu hukum dan ketidakpatuhan ringan',
            'biaya_program_mitigasi' => 'Biaya < Rp. 10 Juta',
            'reputasi' => 'Berdampak bagi reputasi Perusahaan yang tidak tersebar luas dan tidak terdapat pemberitaan di media'
        ],
    ];
    
    foreach ($konsekuensiKeamanan as $item) {
        DB::table('master_konsekuensi_keamanan')->insert(array_merge($item, [
            'created_at' => now(),
            'updated_at' => now()
        ]));
    }
    echo "✅ Konsekuensi Keamanan seeded (5 rows)\n\n";
    
    // 5. MATRIKS RISIKO (25 rows)
    echo "Seeding Matriks Risiko...\n";
    
    // Mapping berdasarkan gambar matriks
    $matrixMapping = [
        // Kemungkinan 1
        [1, 1, 1, 'Rendah', '#4CAF50', 'Pengendalian Operasional'],
        [1, 2, 2, 'Rendah', '#4CAF50', 'Pengendalian Operasional'],
        [1, 3, 3, 'Rendah', '#4CAF50', 'Pengendalian Operasional'],
        [1, 4, 4, 'Rendah', '#4CAF50', 'Pengendalian Operasional'],
        [1, 5, 5, 'Sedang', '#FFEB3B', 'Pengendalian Operasional'],
        // Kemungkinan 2
        [2, 1, 2, 'Rendah', '#4CAF50', 'Pengendalian Operasional'],
        [2, 2, 4, 'Rendah', '#4CAF50', 'Pengendalian Operasional'],
        [2, 3, 6, 'Sedang', '#FFEB3B', 'Pengendalian Operasional'],
        [2, 4, 8, 'Sedang', '#FFEB3B', 'Pengendalian Operasional'],
        [2, 5, 10, 'Tinggi', '#2196F3', 'Program Unit Kerja atau Program Manajemen'],
        // Kemungkinan 3
        [3, 1, 3, 'Rendah', '#4CAF50', 'Pengendalian Operasional'],
        [3, 2, 6, 'Sedang', '#FFEB3B', 'Pengendalian Operasional'],
        [3, 3, 9, 'Sedang', '#FFEB3B', 'Pengendalian Operasional'],
        [3, 4, 12, 'Tinggi', '#2196F3', 'Program Unit Kerja atau Program Manajemen'],
        [3, 5, 15, 'Tinggi', '#2196F3', 'Program Unit Kerja atau Program Manajemen'],
        // Kemungkinan 4
        [4, 1, 4, 'Rendah', '#4CAF50', 'Pengendalian Operasional'],
        [4, 2, 8, 'Sedang', '#FFEB3B', 'Pengendalian Operasional'],
        [4, 3, 12, 'Tinggi', '#2196F3', 'Program Unit Kerja atau Program Manajemen'],
        [4, 4, 16, 'Tinggi', '#2196F3', 'Program Unit Kerja atau Program Manajemen'],
        [4, 5, 20, 'Sangat Tinggi', '#F44336', 'Program Manajemen'],
        // Kemungkinan 5
        [5, 1, 5, 'Sedang', '#FFEB3B', 'Pengendalian Operasional'],
        [5, 2, 10, 'Tinggi', '#2196F3', 'Program Unit Kerja atau Program Manajemen'],
        [5, 3, 15, 'Tinggi', '#2196F3', 'Program Unit Kerja atau Program Manajemen'],
        [5, 4, 20, 'Sangat Tinggi', '#F44336', 'Program Manajemen'],
        [5, 5, 25, 'Sangat Tinggi', '#F44336', 'Program Manajemen'],
    ];
    
    foreach ($matrixMapping as $row) {
        DB::table('master_matriks_risiko')->insert([
            'kemungkinan' => $row[0],
            'konsekuensi' => $row[1],
            'score' => $row[2],
            'level' => $row[3],
            'warna' => $row[4],
            'program_mitigasi' => $row[5],
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
    echo "✅ Matriks Risiko seeded (25 rows)\n\n";
    
    echo "🎉 ALL OFFICIAL DATA SEEDED SUCCESSFULLY!\n";
    echo "Total rows: 45 (5+5+5+5+25)\n";

} catch (\Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
