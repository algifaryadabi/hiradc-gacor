<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export Excel</title>
    <style>
        /* Add basic styling to ensure border visibility in Excel if needed */
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<table>
    <thead>
        <!-- HEADER SECTION -->
        <tr>
            <th colspan="27" style="font-weight: bold; font-size: 14pt; text-align: center; height: 30px; vertical-align: middle;">HAZARD IDENTIFICATION, RISK ASSESSMENT AND DETERMINING CONTROL (HIRADC)</th>
        </tr>
        <tr>
            <th colspan="27" style="font-weight: bold; font-size: 12pt; text-align: center; height: 25px; vertical-align: middle;">PT SEMEN PADANG</th>
        </tr>
        <tr>
            <th colspan="27"></th>
        </tr>
        
        <!-- METADATA -->
        <tr>
            <td colspan="4" style="font-weight: bold;">Judul Dokumen</td>
            <td colspan="10">: {{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</td>
            <td colspan="4" style="font-weight: bold;">No Dokumen</td>
            <td colspan="9">: {{ $document->dcoument_number ?? $document->id }}/HIRADC/{{ date('Y') }}</td>
        </tr>
        <tr>
            <td colspan="4" style="font-weight: bold;">Unit Kerja</td>
            <td colspan="10">: {{ $document->unit->nama_unit ?? '-' }}</td>
            <td colspan="4" style="font-weight: bold;">Revisi</td>
            <td colspan="9">: {{ $document->revision_number ?? 0 }}</td>
        </tr>
        <tr>
            <td colspan="4" style="font-weight: bold;">Departemen</td>
            <td colspan="10">: {{ $document->departemen->nama_dept ?? '-' }}</td>
            <td colspan="4" style="font-weight: bold;">Tanggal</td>
            <td colspan="9">: {{ $document->created_at->format('d F Y') }}</td>
        </tr>
        <tr>
            <td colspan="4" style="font-weight: bold;">Proses Bisnis</td>
            <!-- Accessing via Unit -> Probis relationship -->
            <td colspan="10">: {{ $document->unit->probis->nama_probis ?? '-' }}</td>
            <td colspan="13"></td>
        </tr>
        <tr>
            <td colspan="27"></td>
        </tr>

        <!-- TABLE HEADERS -->
        <tr style="background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #000000;">
            <th rowspan="2" style="border: 1px solid #000000; vertical-align: middle; width: 5px;">No</th>
            <!-- BAGIAN 1: Identifikasi Aktivitas -->
            <th colspan="4" style="border: 1px solid #000000; text-align: center;">BAGIAN 1: Identifikasi Aktivitas</th>
            <!-- BAGIAN 2: Identifikasi -->
            <th colspan="6" style="border: 1px solid #000000; text-align: center;">BAGIAN 2: Identifikasi</th>
            <!-- BAGIAN 3: Pengendalian & Penilaian Awal -->
            <th colspan="5" style="border: 1px solid #000000; text-align: center;">BAGIAN 3: Pengendalian &amp; Penilaian Awal</th>
            <!-- BAGIAN 4: Legalitas & Signifikansi -->
            <th colspan="3" style="border: 1px solid #000000; text-align: center;">BAGIAN 4: Legalitas &amp; Signifikansi</th>
            <!-- BAGIAN 5: Mitigasi Lanjutan & Risiko Sisa -->
            <th colspan="8" style="border: 1px solid #000000; text-align: center;">BAGIAN 5: Mitigasi Lanjutan &amp; Risiko Sisa</th>
        </tr>
        <tr style="background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #000000;">
            <!-- BAGIAN 1 -->
            <th style="border: 1px solid #000000; vertical-align: middle;">Proses/Kegiatan<br>(Kol 2)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Lokasi<br>(Kol 3)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Kategori<br>(Kol 4)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Kondisi<br>(Kol 5)</th>
            
            <!-- BAGIAN 2 -->
            <th style="border: 1px solid #000000; vertical-align: middle;">Potensi Bahaya<br>(Kol 6)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Aspek Lingkungan<br>(Kol 7)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Ancaman Keamanan<br>(Kol 8)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">RISIKO (K3/KO)<br>(Kol 9)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">DAMPAK (Lingk)<br>(Kol 9)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">CELAH (Keamanan)<br>(Kol 9)</th>

            <!-- BAGIAN 3 -->
            <th style="border: 1px solid #000000; vertical-align: middle;">Hirarki Pengendalian<br>(Kol 10)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Pengendalian Existing<br>(Kol 11)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">L<br>(Kol 12)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">S<br>(Kol 13)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Level<br>(Kol 14)</th>

            <!-- BAGIAN 4 -->
            <th style="border: 1px solid #000000; vertical-align: middle;">Regulasi<br>(Kol 15)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Aspek Penting<br>(Kol 16)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Peluang &amp; Risiko<br>(Kol 17)</th>

            <!-- BAGIAN 5 -->
            <th style="border: 1px solid #000000; vertical-align: middle;">Toleransi<br>(Kol 18)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Pengendalian Lanjut<br>(Kol 19)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">L<br>(Kol 20)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">S<br>(Kol 21)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Level<br>(Kol 22)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Residual L</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Residual S</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">Residual Level</th>
        </tr>
    </thead>
    <tbody>
        @foreach($document->details as $item)
        <tr>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $loop->iteration }}</td>
            
            <!-- BAGIAN 1 -->
            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom2_kegiatan }}</td> <!-- Kol 2: Kegiatan (Using kegiatan as main process based on view) -->
            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom3_lokasi }}</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kategori }}</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kolom5_kondisi }}</td>

            <!-- BAGIAN 2 -->
            <!-- Kol 6: Potensi Bahaya -->
            <td style="border: 1px solid #000000; vertical-align: top;">
                @if(in_array($item->kategori, ['K3', 'KO']))
                    @php 
                        $bahaya = $item->kolom6_bahaya['details'] ?? [];
                        if (!is_array($bahaya)) $bahaya = [$bahaya]; // Legacy handling
                    @endphp
                    {{ implode(', ', $bahaya) }}
                    @if(!empty($item->kolom6_bahaya['manual'])) 
                        (Lainnya: {{ $item->kolom6_bahaya['manual'] }})
                    @endif
                @else - @endif
            </td>

            <!-- Kol 7: Aspek Lingkungan -->
            <td style="border: 1px solid #000000; vertical-align: top;">
                @if($item->kategori == 'Lingkungan')
                    @php 
                        $aspek = $item->kolom7_aspek_lingkungan['details'] ?? []; 
                    @endphp
                    {{ implode(', ', $aspek) }}
                    @if(!empty($item->kolom7_aspek_lingkungan['manual'])) 
                        (Lainnya: {{ $item->kolom7_aspek_lingkungan['manual'] }})
                    @endif
                @else - @endif
            </td>

            <!-- Kol 8: Ancaman Keamanan -->
            <td style="border: 1px solid #000000; vertical-align: top;">
                @if($item->kategori == 'Keamanan')
                    @php 
                        $ancaman = $item->kolom8_ancaman['details'] ?? []; 
                    @endphp
                    {{ implode(', ', $ancaman) }}
                    @if(!empty($item->kolom8_ancaman['manual'])) 
                        (Lainnya: {{ $item->kolom8_ancaman['manual'] }})
                    @endif
                @else - @endif
            </td>

            <!-- Kol 9: Risiko/Dampak/Celah -->
            <td style="border: 1px solid #000000; vertical-align: top;">
                {{ in_array($item->kategori, ['K3', 'KO']) ? ($item->kolom9_risiko_k3ko ?? $item->kolom9_risiko) : '-' }}
            </td>
            <td style="border: 1px solid #000000; vertical-align: top;">
                {{ ($item->kategori == 'Lingkungan') ? ($item->kolom9_dampak_lingkungan ?? $item->kolom9_risiko) : '-' }}
            </td>
            <td style="border: 1px solid #000000; vertical-align: top;">
                {{ ($item->kategori == 'Keamanan') ? ($item->kolom9_celah_keamanan ?? $item->kolom9_risiko) : '-' }}
            </td>

            <!-- BAGIAN 3 -->
            <!-- Kol 10: Hirarki -->
            <td style="border: 1px solid #000000; vertical-align: top;">
                @php $hs = $item->kolom10_pengendalian['hierarchy'] ?? []; @endphp
                {{ implode(', ', $hs) }}
            </td>
            <!-- Kol 11: Existing -->
            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom11_existing }}</td>
            
            <!-- Risk Initial -->
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kolom12_kemungkinan }}</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kolom13_konsekuensi }}</td>
            
            @php
                $bg = '#ffffff'; $text = '#000000';
                $score = $item->kolom14_score;
                $lvl = ''; 
                // Logic based on view
                if ($score >= 15) { $lvl = 'TINGGI'; $bg = '#dc2626'; $text = '#ffffff'; }
                elseif ($score >= 8) { $lvl = 'SEDANG'; $bg = '#ca8a04'; $text = '#000000'; }
                else { $lvl = 'RENDAH'; $bg = '#16a34a'; $text = '#ffffff'; } // Default low green
            @endphp
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top; background-color: {{ $bg }}; color: {{ $text }};">
                {{ $lvl }} ({{ $score }})
            </td>

            <!-- BAGIAN 4 -->
            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom15_regulasi }}</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">
                {{ ($item->kategori == 'Lingkungan') ? ($item->kolom16_aspek ?? '-') : '-' }}
            </td>
            <td style="border: 1px solid #000000; vertical-align: top;">
                @if($item->kolom17_risiko) <div>Risiko: {{ $item->kolom17_risiko }}</div> @endif
                @if($item->kolom17_peluang) <div>Peluang: {{ $item->kolom17_peluang }}</div> @endif
            </td>

            <!-- BAGIAN 5 -->
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">
                {{ $item->kolom18_toleransi == 'Ya' ? 'Ya' : 'Tidak' }}
            </td>

            @if($item->kolom18_toleransi == 'Tidak')
                <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom19_pengendalian_lanjut }}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kolom20_kemungkinan_lanjut }}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kolom21_konsekuensi_lanjut }}</td>
                
                @php
                    $bgL = '#ffffff'; $textL = '#000000';
                    $scoreL = $item->kolom22_tingkat_risiko_lanjut;
                    $lvlL = '';
                    if ($scoreL >= 15) { $lvlL = 'TINGGI'; $bgL = '#dc2626'; $textL = '#ffffff'; }
                    elseif ($scoreL >= 8) { $lvlL = 'SEDANG'; $bgL = '#ca8a04'; $textL = '#000000'; }
                    elseif ($scoreL > 0) { $lvlL = 'RENDAH'; $bgL = '#16a34a'; $textL = '#ffffff'; }
                @endphp
                <td style="border: 1px solid #000000; text-align: center; vertical-align: top; background-color: {{ $bgL }}; color: {{ $textL }};">
                    {{ $lvlL }} {{ $scoreL ? "($scoreL)" : '' }}
                </td>
            @else
                <td style="border: 1px solid #000000; text-align: center;">-</td>
                <td style="border: 1px solid #000000; text-align: center;">-</td>
                <td style="border: 1px solid #000000; text-align: center;">-</td>
                <td style="border: 1px solid #000000; text-align: center;">-</td>
            @endif

            <!-- Residual Risk -->
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->residual_kemungkinan }}</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->residual_konsekuensi }}</td>
            
            @php
                $bgRes = '#ffffff'; $textRes = '#000000';
                $scoreRes = $item->residual_score;
                $lvlRes = '';
                if ($scoreRes >= 15) { $lvlRes = 'TINGGI'; $bgRes = '#dc2626'; $textRes = '#ffffff'; }
                elseif ($scoreRes >= 8) { $lvlRes = 'SEDANG'; $bgRes = '#ca8a04'; $textRes = '#000000'; }
                else { $lvlRes = 'RENDAH'; $bgRes = '#16a34a'; $textRes = '#ffffff'; }
            @endphp
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top; background-color: {{ $bgRes }}; color: {{ $textRes }};">
                {{ $lvlRes }} ({{ $scoreRes }})
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
