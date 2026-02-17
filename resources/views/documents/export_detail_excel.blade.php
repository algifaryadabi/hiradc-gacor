<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Export Excel</title>
    <style>
        table, th, td {
            border: 1px solid #000000;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <table class="main-table">
    <thead>
        <!-- HEADER SECTION -->
        <tr>
            <th colspan="22" style="font-weight: bold; font-size: 14pt; text-align: center; height: 30px; vertical-align: middle;">HAZARD IDENTIFICATION, RISK ASSESSMENT AND DETERMINING CONTROL (HIRADC)</th>
        </tr>
        <tr>
            <th colspan="22" style="font-weight: bold; font-size: 12pt; text-align: center; height: 25px; vertical-align: middle;">PT SEMEN PADANG</th>
        </tr>
        <tr>
            <th colspan="22"></th>
        </tr>
        
        <!-- METADATA -->
        <tr>
            <td colspan="3" style="font-weight: bold;">Judul Dokumen</td>
            <td colspan="7">: {{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</td>
            <td colspan="3" style="font-weight: bold;">No Dokumen</td>
            <td colspan="9">: {{ str_pad($document->id, 3, '0', STR_PAD_LEFT) }}/HIRADC/{{ date('Y') }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Unit Kerja</td>
            <td colspan="7">: {{ $document->unit->nama_unit ?? '-' }}</td>
            <td colspan="3" style="font-weight: bold;">Revisi</td>
            <td colspan="9">: {{ $document->revision_number ?? 0 }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Departemen</td>
            <td colspan="7">: {{ $document->departemen->nama_dept ?? '-' }}</td>
            <td colspan="3" style="font-weight: bold;">Tanggal</td>
            <td colspan="9">: {{ $document->created_at->format('d F Y') }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Proses Bisnis</td>
            <td colspan="7">: {{ $document->unit->probis->nama_probis ?? '-' }}</td>
            <td colspan="12"></td>
        </tr>
        @if(isset($latestRevision) && $latestRevision)
        <tr>
            <td colspan="3" style="font-weight: bold;">Uraian Revisi</td>
            <td colspan="19">: {{ $latestRevision }}</td>
        </tr>
        @endif
        <tr>
            <td colspan="22"></td>
        </tr>

        <!-- Header Row 1: Main Sections -->
        <tr>
            <th rowspan="2" style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 5px;">No</th>
            <th colspan="4" style="border: 1px solid #000000; text-align: center;">BAGIAN 1: Identifikasi Aktivitas</th>
            <th colspan="3" style="border: 1px solid #000000; text-align: center;">BAGIAN 2: Identifikasi</th>
            <th colspan="6" style="border: 1px solid #000000; text-align: center;">BAGIAN 3: Pengendalian &amp; Penilaian Awal</th>
            <th colspan="3" style="border: 1px solid #000000; text-align: center;">BAGIAN 4: Legalitas &amp; Signifikansi</th>
            <th colspan="5" style="border: 1px solid #000000; text-align: center;">BAGIAN 5: Mitigasi Lanjutan</th>
        </tr>
        <!-- Header Row 2: Columns -->
        <tr>
            <!-- BAGIAN 1 (Kol 2-5) -->
            <th style="border: 1px solid #000000; vertical-align: middle;">PROSES BISNIS / KEGIATAN / ASET<br style="mso-data-placement:same-cell;" />(2)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">LOKASI<br style="mso-data-placement:same-cell;" />(3)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">KATEGORI<br style="mso-data-placement:same-cell;" />(4)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">KONDISI<br style="mso-data-placement:same-cell;" />(R/NR/N/TM/E)<br style="mso-data-placement:same-cell;" />(5)</th>
            
            <!-- BAGIAN 2: IDENTIFIKASI (Kol 6-8) -->
            <th style="border: 1px solid #000000; vertical-align: middle;">POTENSI BAHAYA<br style="mso-data-placement:same-cell;" />(6)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">ASPEK LINGKUNGAN<br style="mso-data-placement:same-cell;" />(7)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">ANCAMAN KEAMANAN<br style="mso-data-placement:same-cell;" />(8)</th>
            
            <!-- BAGIAN 3 (Kol 9-14) -->
            <th style="border: 1px solid #000000; vertical-align: middle;">RISIKO (K3/KO)<br style="mso-data-placement:same-cell;" />/DAMPAK LINGKUNGAN<br style="mso-data-placement:same-cell;" />/CELAH TIDAK AMAN<br style="mso-data-placement:same-cell;" />(9)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">HIRARKI PENGENDALIAN<br style="mso-data-placement:same-cell;" />(10)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">PENGENDALIAN EXISTING<br style="mso-data-placement:same-cell;" />(11)</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle;">L<br style="mso-data-placement:same-cell;" />(12)</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle;">S<br style="mso-data-placement:same-cell;" />(13)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">LEVEL<br style="mso-data-placement:same-cell;" />(14)</th>

            <!-- BAGIAN 4 (Kol 15-17) -->
            <th style="border: 1px solid #000000; vertical-align: middle;">PERATURAN<br style="mso-data-placement:same-cell;" />(15)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">ASPEK (P/TP)<br style="mso-data-placement:same-cell;" />(16)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">PELUANG &amp; RISIKO<br style="mso-data-placement:same-cell;" />(17)</th>

            <!-- BAGIAN 5 (Kol 18-22) -->
            <th style="border: 1px solid #000000; vertical-align: middle;">TOLERANSI<br style="mso-data-placement:same-cell;" />(18)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">PENGENDALIAN LANJUT<br style="mso-data-placement:same-cell;" />(19)</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle;">L<br style="mso-data-placement:same-cell;" />(20)</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle;">S<br style="mso-data-placement:same-cell;" />(21)</th>
            <th style="border: 1px solid #000000; vertical-align: middle;">LEVEL<br style="mso-data-placement:same-cell;" />(22)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($document->details as $index => $item)
            <tr>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $index + 1 }}</td>
                
                <!-- Kolom 2: PROSES BISNIS / KEGIATAN -->
                <td style="border: 1px solid #000000; vertical-align: top;">
                    <strong>{{ $item->kolom2_proses }}</strong>
                    @if($item->kolom2_kegiatan)
                        <br style="mso-data-placement:same-cell;" />kegiatan/aset : {{ $item->kolom2_kegiatan }}
                    @endif
                </td>

                <!-- Kolom 3: LOKASI -->
                <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom3_lokasi }}</td>

                <!-- Kolom 4: KATEGORI -->
                <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kategori }}</td>

                <!-- Kolom 5: KODNISI -->
                <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kolom5_kondisi }}</td>

            <!-- (6) POTENSI BAHAYA -->
            <td style="border: 1px solid #000000; vertical-align: top;">
                @if(in_array($item->kategori, ['K3', 'KO']))
                    @php 
                        $bahaya = $item->kolom6_bahaya['details'] ?? [];
                        if (!is_array($bahaya)) $bahaya = [$bahaya];
                    @endphp
                    {{ implode(', ', $bahaya) }}
                    @if(!empty($item->kolom6_bahaya['manual'])) 
                        <br style="mso-data-placement:same-cell;" />(Lainnya: {{ $item->kolom6_bahaya['manual'] }})
                    @endif
                @else - @endif
            </td>

            <!-- (7) ASPEK LINGKUNGAN -->
            <td style="border: 1px solid #000000; vertical-align: top;">
                @if($item->kategori == 'Lingkungan')
                    @php $aspek = $item->kolom7_aspek_lingkungan['details'] ?? []; @endphp
                    {{ implode(', ', $aspek) }}
                    @if(!empty($item->kolom7_aspek_lingkungan['manual'])) 
                        <br style="mso-data-placement:same-cell;" />(Lainnya: {{ $item->kolom7_aspek_lingkungan['manual'] }})
                    @endif
                @else - @endif
            </td>

            <!-- (8) ANCAMAN KEAMANAN -->
            <td style="border: 1px solid #000000; vertical-align: top;">
                @if($item->kategori == 'Keamanan')
                    @php $ancaman = $item->kolom8_ancaman['details'] ?? []; @endphp
                    {{ implode(', ', $ancaman) }}
                    @if(!empty($item->kolom8_ancaman['manual'])) 
                        <br style="mso-data-placement:same-cell;" />(Lainnya: {{ $item->kolom8_ancaman['manual'] }})
                    @endif
                @else - @endif
            </td>

            <!-- (9) RISIKO / DAMPAK / CELAH -->
            <td style="border: 1px solid #000000; vertical-align: top;">
                {{ $item->kolom9_risiko ?? $item->kolom9_risiko_k3ko ?? $item->kolom9_dampak_lingkungan ?? $item->kolom9_celah_keamanan ?? '-' }}
            </td>

            <!-- (10) PENGENDALIAN RISIKO -->
            <td style="border: 1px solid #000000; vertical-align: top;">
                @php $hs = $item->kolom10_pengendalian['hierarchy'] ?? []; @endphp
                {{ implode(', ', $hs) }}
            </td>

            <!-- (11) PENGENDALIAN EXISTING -->
            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom11_existing }}</td>

            <!-- (12) NILAI KEMUNGKINAN -->
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kolom12_kemungkinan }}</td>
            
            <!-- (13) NILAI KONSEKUENSI -->
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kolom13_konsekuensi }}</td>
            
            <!-- (14) TINGKAT RISIKO -->
            @php
                $bg = '#ffffff'; $text = '#000000';
                $score = $item->kolom14_score;
                $lvl = ''; 
                if ($score >= 15) { $lvl = 'TINGGI'; $bg = '#dc2626'; $text = '#ffffff'; }
                elseif ($score >= 8) { $lvl = 'SEDANG'; $bg = '#ca8a04'; $text = '#000000'; }
                else { $lvl = 'RENDAH'; $bg = '#16a34a'; $text = '#ffffff'; }
            @endphp
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top; background-color: {{ $bg }}; color: {{ $text }};">
                {{ $lvl }} ({{ $score }})
            </td>

            <!-- (15) REGULASI -->
            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom15_regulasi }}</td>
            
            <!-- (16) ASPEK PENTING -->
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">
                {{ ($item->kategori == 'Lingkungan') ? ($item->kolom16_aspek ?? '-') : '-' }}
            </td>
            
            <!-- (17) PELUANG & RISIKO -->
            <td style="border: 1px solid #000000; vertical-align: top;">
                @if($item->kolom17_risiko) R: {{ $item->kolom17_risiko }}<br style="mso-data-placement:same-cell;" /> @endif
                @if($item->kolom17_peluang) P: {{ $item->kolom17_peluang }} @endif
            </td>

            <!-- (18) TOLERANSI -->
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">
                {{ $item->kolom18_toleransi == 'Ya' ? 'Ya' : 'Tidak' }}
            </td>

            <!-- (19) PENGENDALIAN LANJUT -->
            @if($item->kolom18_toleransi == 'Tidak')
                <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom19_rencana ?? $item->kolom19_pengendalian_lanjut ?? '-' }}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kolom20_kemungkinan_lanjut }}</td>
                <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kolom21_konsekuensi_lanjut }}</td>
                
                @php
                    $bgL = '#ffffff'; $textL = '#000000';
                    $scoreL = $item->kolom22_tingkat_risiko_lanjut;
                    // Fallback
                    if (!$scoreL && $item->kolom22_level_lanjut) {
                         $scoreL = '-'; 
                         $lvlL = $item->kolom22_level_lanjut;
                    } else {
                        $lvlL = '';
                        if ($scoreL >= 15) { $lvlL = 'TINGGI'; $bgL = '#dc2626'; $textL = '#ffffff'; }
                        elseif ($scoreL >= 8) { $lvlL = 'SEDANG'; $bgL = '#ca8a04'; $textL = '#000000'; }
                        elseif ($scoreL > 0) { $lvlL = 'RENDAH'; $bgL = '#16a34a'; $textL = '#ffffff'; }
                    }
                @endphp
                <td style="border: 1px solid #000000; text-align: center; vertical-align: top; background-color: {{ $bgL }}; color: {{ $textL }};">
                    {{ $lvlL }} {{ is_numeric($scoreL) ? "($scoreL)" : '' }}
                </td>
            @else
                <td style="border: 1px solid #000000; text-align: center;">-</td>
                <td style="border: 1px solid #000000; text-align: center;">-</td>
                <td style="border: 1px solid #000000; text-align: center;">-</td>
                <td style="border: 1px solid #000000; text-align: center;">-</td>
            @endif
        </tr>
        @endforeach
    </tbody>
    </table>

@if(isset($histories) && count($histories) > 0)
    <br style="mso-data-placement:same-cell;" />
    <table>
        <tr>
            <td colspan="4" style="font-weight: bold; font-size: 12pt;">RIWAYAT REVISI DOKUMEN</td>
        </tr>
        <tr>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center;">Rev No.</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center;">Tanggal Arsip</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center;">Diarsipkan Oleh</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center;">Keterangan Revisi</th>
        </tr>
        @foreach($histories as $history)
            <tr>
                <td style="border: 1px solid #000000; text-align: center;">{{ $history->revision_number }}</td>
                <td style="border: 1px solid #000000; text-align: center;">{{ $history->archived_at ? \Carbon\Carbon::parse($history->archived_at)->format('d M Y H:i') : '-' }}</td>
                <td style="border: 1px solid #000000; text-align: center;">{{ $history->archivedBy->nama_user ?? '-' }}</td>
                <td style="border: 1px solid #000000;">{{ $history->revision_reason ?? '-' }}</td>
            </tr>
        @endforeach
    </table>
@endif
</body>
</html>
