<!DOCTYPE html>
<html>
<head>
    <title>HIRADC Document - {{ $document->judul_dokumen ?? 'Detail' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 6px; /* Reduced for 27 columns */
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: middle;
        }
        .title {
            font-weight: bold;
            font-size: 14px;
            text-align: center;
        }
        .logo {
            font-size: 16px;
            font-weight: bold;
            color: teal;
        }
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: auto;
        }
        .main-table th, .main-table td {
            border: 1px solid #000;
            padding: 3px;
            vertical-align: top;
            word-wrap: break-word;
        }
        .main-table th {
            background-color: #eee;
            text-align: center;
            font-weight: bold;
            vertical-align: middle;
        }
        .meta-info {
            margin-bottom: 15px;
            font-size: 9px;
        }
        .meta-info table {
            width: 100%;
        }
        .meta-info td {
            border: none;
            padding: 2px;
            vertical-align: top;
        }
        
        /* Risk Level Colors */
        .level-low { background-color: #16a34a; color: #ffffff; }
        .level-medium { background-color: #ca8a04; color: #000000; }
        .level-high { background-color: #dc2626; color: #ffffff; }
        /* Watermark */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1000;
            opacity: 0.1;
            width: 35%;
            text-align: center;
        }

        .watermark img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="watermark">
        <img src="{{ public_path('images/logo-semen-padang-watermark.png') }}" alt="Watermark">
    </div>

    <!-- DOCUMENT HEADER -->
    <table class="header-table">
        <tr>
            <td width="20%" align="center">
                <div class="logo">PT SEMEN PADANG</div>
            </td>
            <td width="60%" align="center">
                <div class="title">HAZARD IDENTIFICATION, RISK ASSESSMENT AND DETERMINING CONTROL (HIRADC)</div>
            </td>
            <td width="20%">
                No. Dokumen: {{ str_pad($document->id, 3, '0', STR_PAD_LEFT) }}/HIRADC/{{ date('Y') }}<br>
                Revisi: {{ $document->revision_number ?? 0 }}
            </td>
        </tr>
    </table>

    <!-- METADATA -->
    <div class="meta-info">
        <table>
            <tr>
                <td width="15%"><strong>Judul Dokumen</strong></td>
                <td width="35%">: {{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</td>
                <td width="15%"><strong>Unit Kerja</strong></td>
                <td width="35%">: {{ $document->unit->nama_unit ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Departemen</strong></td>
                <td>: {{ $document->departemen->nama_dept ?? '-' }}</td>
                <td><strong>Proses Bisnis</strong></td>
                <td>: {{ $document->unit->probis->nama_probis ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Penulis</strong></td>
                <td>: {{ $document->user->nama_user ?? '-' }}</td>
                <td><strong>Tanggal</strong></td>
                <td>: {{ $document->created_at->format('d M Y') }}</td>
            </tr>
            @if(isset($latestRevision) && $latestRevision)
            <tr>
                <td><strong>Uraian Revisi</strong></td>
                <td colspan="3">: {{ $latestRevision }}</td>
            </tr>
            @endif
        </table>
    </div>

    <!-- MAIN TABLE (27 Columns) -->
    <table class="main-table">
        <thead>
            <tr>
                <th rowspan="2" width="2%">No</th>
                <!-- BAGIAN 1: Identifikasi Aktivitas -->
                <th colspan="4">BAGIAN 1: Identifikasi Aktivitas</th>
                <!-- BAGIAN 2: Identifikasi -->
                <th colspan="6">BAGIAN 2: Identifikasi</th>
                <!-- BAGIAN 3: Pengendalian & Penilaian Awal -->
                <th colspan="5">BAGIAN 3: Pengendalian &amp; Penilaian Awal</th>
                <!-- BAGIAN 4: Legalitas & Signifikansi -->
                <th colspan="3">BAGIAN 4: Legalitas &amp; Signifikansi</th>
                <!-- BAGIAN 5: Mitigasi Lanjutan & Risiko Sisa -->
                <th colspan="8">BAGIAN 5: Mitigasi Lanjutan &amp; Risiko Sisa</th>
            </tr>
            <tr>
                <!-- BAGIAN 1 -->
                <th width="5%">Proses/Kegiatan<br>(Kol 2)</th>
                <th width="5%">Lokasi<br>(Kol 3)</th>
                <th width="4%">Kategori<br>(Kol 4)</th>
                <th width="4%">Kondisi<br>(Kol 5)</th>
                
                <!-- BAGIAN 2 -->
                <th width="8%">Potensi Bahaya<br>(Kol 6)</th>
                <th width="5%">Aspek Lingkungan<br>(Kol 7)</th>
                <th width="5%">Ancaman Keamanan<br>(Kol 8)</th>
                <th width="4%">RISIKO (K3/KO)<br>(Kol 9)</th>
                <th width="4%">DAMPAK (Lingk)<br>(Kol 9)</th>
                <th width="4%">CELAH (Keamanan)<br>(Kol 9)</th>

                <!-- BAGIAN 3 -->
                <th width="6%">Hirarki Pengendalian<br>(Kol 10)</th>
                <th width="6%">Pengendalian Existing<br>(Kol 11)</th>
                <th width="2%">L<br>(Kol 12)</th>
                <th width="2%">S<br>(Kol 13)</th>
                <th width="3%">Level<br>(Kol 14)</th>

                <!-- BAGIAN 4 -->
                <th width="5%">Regulasi<br>(Kol 15)</th>
                <th width="4%">Aspek Penting<br>(Kol 16)</th>
                <th width="4%">Peluang &amp; Risiko<br>(Kol 17)</th>

                <!-- BAGIAN 5 -->
                <th width="3%">Toleransi<br>(Kol 18)</th>
                <th width="6%">Pengendalian Lanjut<br>(Kol 19)</th>
                <th width="2%">L<br>(Kol 20)</th>
                <th width="2%">S<br>(Kol 21)</th>
                <th width="3%">Level<br>(Kol 22)</th>
                <th width="2%">Res L</th>
                <th width="2%">Res S</th>
                <th width="3%">Res Level</th>
            </tr>
        </thead>
        <tbody>
            @foreach($document->details as $item)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                
                <!-- BAGIAN 1 -->
                <td>{{ $item->kolom2_kegiatan }}</td> 
                <td>{{ $item->kolom3_lokasi }}</td>
                <td align="center">{{ $item->kategori }}</td>
                <td align="center">{{ $item->kolom5_kondisi }}</td>

                <!-- BAGIAN 2 -->
                <td>
                    @if(in_array($item->kategori, ['K3', 'KO']))
                        @php 
                            $bahaya = $item->kolom6_bahaya['details'] ?? [];
                            if (!is_array($bahaya)) $bahaya = [$bahaya];
                        @endphp
                        {{ implode(', ', $bahaya) }}
                        @if(!empty($item->kolom6_bahaya['manual'])) 
                            <br>(Lainnya: {{ $item->kolom6_bahaya['manual'] }})
                        @endif
                    @else - @endif
                </td>
                <td>
                    @if($item->kategori == 'Lingkungan')
                        @php $aspek = $item->kolom7_aspek_lingkungan['details'] ?? []; @endphp
                        {{ implode(', ', $aspek) }}
                        @if(!empty($item->kolom7_aspek_lingkungan['manual'])) 
                            <br>(Lainnya: {{ $item->kolom7_aspek_lingkungan['manual'] }})
                        @endif
                    @else - @endif
                </td>
                <td>
                    @if($item->kategori == 'Keamanan')
                        @php $ancaman = $item->kolom8_ancaman['details'] ?? []; @endphp
                        {{ implode(', ', $ancaman) }}
                        @if(!empty($item->kolom8_ancaman['manual'])) 
                            <br>(Lainnya: {{ $item->kolom8_ancaman['manual'] }})
                        @endif
                    @else - @endif
                </td>

                <!-- Kol 9 -->
                <td>{{ in_array($item->kategori, ['K3', 'KO']) ? ($item->kolom9_risiko_k3ko ?? $item->kolom9_risiko) : '-' }}</td>
                <td>{{ ($item->kategori == 'Lingkungan') ? ($item->kolom9_dampak_lingkungan ?? $item->kolom9_risiko) : '-' }}</td>
                <td>{{ ($item->kategori == 'Keamanan') ? ($item->kolom9_celah_keamanan ?? $item->kolom9_risiko) : '-' }}</td>

                <!-- BAGIAN 3 -->
                <td>
                    @php $hs = $item->kolom10_pengendalian['hierarchy'] ?? []; @endphp
                    {{ implode(', ', $hs) }}
                </td>
                <td>{{ $item->kolom11_existing }}</td>
                <td align="center">{{ $item->kolom12_kemungkinan }}</td>
                <td align="center">{{ $item->kolom13_konsekuensi }}</td>
                
                @php
                    $score = $item->kolom14_score;
                    $class = 'level-low';
                    $lvl = 'RENDAH';
                    if ($score >= 15) { $class = 'level-high'; $lvl = 'TINGGI'; }
                    elseif ($score >= 8) { $class = 'level-medium'; $lvl = 'SEDANG'; }
                @endphp
                <td align="center" class="{{ $class }}">
                    {{ $lvl }} ({{ $score }})
                </td>

                <!-- BAGIAN 4 -->
                <td>{{ $item->kolom15_regulasi }}</td>
                <td align="center">{{ ($item->kategori == 'Lingkungan') ? ($item->kolom16_aspek ?? '-') : '-' }}</td>
                <td>
                    @if($item->kolom17_risiko) <div>R: {{ $item->kolom17_risiko }}</div> @endif
                    @if($item->kolom17_peluang) <div>P: {{ $item->kolom17_peluang }}</div> @endif
                </td>

                <!-- BAGIAN 5 -->
                <td align="center">{{ $item->kolom18_toleransi == 'Ya' ? 'Ya' : 'Tidak' }}</td>

                @if($item->kolom18_toleransi == 'Tidak')
                    <td>{{ $item->kolom19_pengendalian_lanjut }}</td>
                    <td align="center">{{ $item->kolom20_kemungkinan_lanjut }}</td>
                    <td align="center">{{ $item->kolom21_konsekuensi_lanjut }}</td>
                    
                    @php
                        $scoreL = $item->kolom22_tingkat_risiko_lanjut;
                        $classL = 'level-low';
                        $lvlL = 'RENDAH';
                        if ($scoreL >= 15) { $classL = 'level-high'; $lvlL = 'TINGGI'; }
                        elseif ($scoreL >= 8) { $classL = 'level-medium'; $lvlL = 'SEDANG'; }
                    @endphp
                    <td align="center" class="{{ $classL }}">
                        {{ $lvlL }} ({{ $scoreL }})
                    </td>
                @else
                    <td align="center">-</td>
                    <td align="center">-</td>
                    <td align="center">-</td>
                    <td align="center">-</td>
                @endif

                <!-- Residual -->
                <td align="center">{{ $item->residual_kemungkinan }}</td>
                <td align="center">{{ $item->residual_konsekuensi }}</td>
                @php
                    $scoreRes = $item->residual_score;
                    $classRes = 'level-low';
                    $lvlRes = 'RENDAH';
                    if ($scoreRes >= 15) { $classRes = 'level-high'; $lvlRes = 'TINGGI'; }
                    elseif ($scoreRes >= 8) { $classRes = 'level-medium'; $lvlRes = 'SEDANG'; }
                @endphp
                <td align="center" class="{{ $classRes }}">
                    {{ $lvlRes }} ({{ $scoreRes }})
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    
    {{-- PUK and PMK Programs sections removed as per user request (HIRADC Form Only) --}}
    
    {{-- Revision History (If Available) --}}
    @if(isset($histories) && count($histories) > 0)
        <div style="page-break-inside: avoid;">
            <p class="title" style="text-align: left; font-size:10px; margin-bottom:5px;">RIWAYAT REVISI DOKUMEN</p>
            <table class="main-table" style="font-size: 8px;">
                <thead>
                    <tr>
                        <th width="10%">Rev No.</th>
                        <th width="20%">Tanggal Arsip</th>
                        <th width="20%">Diarsipkan Oleh</th>
                        <th width="50%">Keterangan Revisi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                        <tr>
                            <td align="center">{{ $history->revision_number }}</td>
                            <td align="center">{{ $history->archived_at ? \Carbon\Carbon::parse($history->archived_at)->format('d M Y H:i') : '-' }}</td>
                            <td align="center">{{ $history->archivedBy->nama_user ?? '-' }}</td>
                            <td>{{ $history->revision_reason ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <br>
    <div style="width: 100%; border-top: 1px dotted #ccc; margin-top: 20px; padding-top: 10px;">
        <small>Dicetak otomatis oleh {{ auth()->user()->nama_user ?? 'User' }} pada {{ date('d M Y H:i') }}</small>
    </div>

</body>
</html>