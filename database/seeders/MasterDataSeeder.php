<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Kemungkinan (Likelihood)
        $kemungkinan = [
            ['level' => 1, 'nama' => 'Sangat Jarang', 'deskripsi' => 'Hampir tidak pernah terjadi', 'frekuensi' => '< 1 kali/tahun'],
            ['level' => 2, 'nama' => 'Jarang', 'deskripsi' => 'Jarang terjadi', 'frekuensi' => '1-2 kali/tahun'],
            ['level' => 3, 'nama' => 'Kadang-kadang', 'deskripsi' => 'Terjadi sesekali', 'frekuensi' => '3-5 kali/tahun'],
            ['level' => 4, 'nama' => 'Sering', 'deskripsi' => 'Sering terjadi', 'frekuensi' => '6-10 kali/tahun'],
            ['level' => 5, 'nama' => 'Sangat Sering', 'deskripsi' => 'Hampir selalu terjadi', 'frekuensi' => '> 10 kali/tahun'],
        ];

        foreach ($kemungkinan as $item) {
            DB::table('master_kemungkinan')->insert(array_merge($item, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }

        // 2. Seed Konsekuensi K3
        $konsekuensiK3 = [
            ['level' => 1, 'nama' => 'P3K', 'deskripsi' => 'Luka ringan, tidak perlu istirahat', 'dampak' => 'Pertolongan Pertama Pada Kecelakaan'],
            ['level' => 2, 'nama' => 'Perawatan Medis', 'deskripsi' => 'Memerlukan perawatan dokter', 'dampak' => 'Medical Treatment'],
            ['level' => 3, 'nama' => 'Hilang Hari Kerja', 'deskripsi' => 'Cedera sedang, perlu istirahat', 'dampak' => 'Lost Time Injury (LTI)'],
            ['level' => 4, 'nama' => 'Cacat Permanen', 'deskripsi' => 'Cedera berat, cacat tetap', 'dampak' => 'Permanent Disability'],
            ['level' => 5, 'nama' => 'Fatality', 'deskripsi' => 'Kematian', 'dampak' => 'Kematian 1 orang atau lebih'],
        ];

        foreach ($konsekuensiK3 as $item) {
            DB::table('master_konsekuensi_k3')->insert(array_merge($item, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }

        // 3. Seed Konsekuensi Lingkungan
        $konsekuensiLingkungan = [
            ['level' => 1, 'nama' => 'Sangat Kecil', 'deskripsi' => 'Dampak minimal, mudah dipulihkan', 'dampak' => 'Tidak ada dampak signifikan'],
            ['level' => 2, 'nama' => 'Kecil', 'deskripsi' => 'Dampak terbatas, pemulihan cepat', 'dampak' => 'Pencemaran lokal, mudah diatasi'],
            ['level' => 3, 'nama' => 'Sedang', 'deskripsi' => 'Dampak moderat, perlu penanganan', 'dampak' => 'Pencemaran area terbatas'],
            ['level' => 4, 'nama' => 'Besar', 'deskripsi' => 'Dampak signifikan, pemulihan lama', 'dampak' => 'Pencemaran luas, butuh remediasi'],
            ['level' => 5, 'nama' => 'Sangat Besar', 'deskripsi' => 'Dampak masif, kerusakan permanen', 'dampak' => 'Kerusakan ekosistem permanen'],
        ];

        foreach ($konsekuensiLingkungan as $item) {
            DB::table('master_konsekuensi_lingkungan')->insert(array_merge($item, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }

        // 4. Seed Konsekuensi Keamanan
        $konsekuensiKeamanan = [
            ['level' => 1, 'nama' => 'Gangguan Minor', 'deskripsi' => 'Gangguan kecil, tidak material', 'dampak' => 'Kerugian < Rp 10 juta'],
            ['level' => 2, 'nama' => 'Gangguan Sedang', 'deskripsi' => 'Gangguan operasional ringan', 'dampak' => 'Kerugian Rp 10-50 juta'],
            ['level' => 3, 'nama' => 'Gangguan Signifikan', 'deskripsi' => 'Gangguan operasional moderat', 'dampak' => 'Kerugian Rp 50-100 juta'],
            ['level' => 4, 'nama' => 'Gangguan Serius', 'deskripsi' => 'Gangguan operasional berat', 'dampak' => 'Kerugian Rp 100-500 juta'],
            ['level' => 5, 'nama' => 'Gangguan Kritis', 'deskripsi' => 'Sabotase/kerugian masif', 'dampak' => 'Kerugian > Rp 500 juta'],
        ];

        foreach ($konsekuensiKeamanan as $item) {
            DB::table('master_konsekuensi_keamanan')->insert(array_merge($item, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }

        // 5. Seed Matriks Risiko (5x5 = 25 rows)
        $matriksRisiko = [];
        for ($kemungkinan = 1; $kemungkinan <= 5; $kemungkinan++) {
            for ($konsekuensi = 1; $konsekuensi <= 5; $konsekuensi++) {
                $score = $kemungkinan * $konsekuensi;
                
                // Determine risk level based on score
                if ($score <= 3) {
                    $level = 'RENDAH';
                    $warna = '#4CAF50'; // Green
                } elseif ($score <= 8) {
                    $level = 'SEDANG';
                    $warna = '#FFEB3B'; // Yellow
                } elseif ($score <= 15) {
                    $level = 'TINGGI';
                    $warna = '#FF9800'; // Orange
                } else {
                    $level = 'SANGAT TINGGI';
                    $warna = '#F44336'; // Red
                }
                
                $matriksRisiko[] = [
                    'kemungkinan' => $kemungkinan,
                    'konsekuensi' => $konsekuensi,
                    'score' => $score,
                    'level' => $level,
                    'warna' => $warna,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        DB::table('master_matriks_risiko')->insert($matriksRisiko);
    }
}
