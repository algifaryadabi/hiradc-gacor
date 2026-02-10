<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Manajemen Korporat (PMK)</title>
    <style>
        @page {
            margin: 15mm 15mm;
            size: A4 landscape;
        }
        
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            font-size: 11pt;
            line-height: 1.3;
            color: #000;
        }

        /* Utility */
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }
        .page-break { page-break-after: always; }
        .w-100 { width: 100%; }

        /* COVER PAGE */
        .cover-container {
            position: relative;
            height: 90vh; /* Approximate height to center content effectively */
            text-align: center;
            padding-top: 40px;
        }

        .cover-title {
            font-size: 20pt;
            font-weight: bold;
            margin-bottom: 5px;
            margin-top: 60px;
            text-transform: uppercase;
        }

        .cover-unit {
            font-size: 16pt;
            font-weight: bold;
            margin-bottom: 40px;
            text-transform: uppercase;
        }

        .logo {
            width: 120px;
            height: auto;
            margin: 20px auto;
        }

        .cover-details {
            margin-top: 40px;
            font-size: 11pt;
            text-align: center;
            width: 100%;
        }

        .cover-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
        }

        /* SIGNATURE PAGE */
        .signature-title {
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            margin-bottom: 20px;
            text-decoration: underline;
        }
        
        .signature-table {
            width: 100%;
            margin-top: 100px;
            border-collapse: separate;
            border-spacing: 20px 0;
        }

        .signature-cell {
            width: 33%;
            text-align: center;
            vertical-align: top;
        }

        .sign-label {
            margin-bottom: 100px;
            font-weight: bold;
        }

        .sign-name {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 5px;
        }

        .sign-jabatan {
            
        }

        /* CONTENT PAGE */
        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 12pt;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 5px;
            vertical-align: top;
        }

        .info-label {
            width: 180px;
            font-weight: bold;
        }

        .info-colon {
            width: 20px;
            text-align: center;
        }

        /* Program Table */
        .program-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
        }

        .program-table th, .program-table td {
            border: 1px solid #000;
            padding: 4px;
        }

        .program-table th {
            background-color: #e2e8f0;
            text-align: center;
            font-weight: bold;
        }

        .bg-grey { background-color: #f1f5f9; }
        .text-right { text-align: right; }

    </style>
</head>
<body>
    @php
        // Determine Category Title
        $categoryTitle = 'KO.K3/LINGKUNGAN';
        if ($document->kategori === 'Keamanan' || $document->managing_unit === 'Security' || ($document->status_security != 'none')) {
            $categoryTitle = 'PENGAMANAN';
        }

        $unitName = $document->unit ? $document->unit->nama_unit : ($document->kolom3_lokasi ?? 'UNIT KERJA');
        $currentYear = date('Y');
        
        // Document Number Logic (Mock or Real)
        $docNo = "DOC-" . str_pad($document->id, 5, '0', STR_PAD_LEFT);
        $revision = "0"; // Default
        
        // Date formatting
        $date = now()->locale('id')->isoFormat('D MMMM YYYY');
    @endphp

    <!-- PAGE 1: COVER -->
    <div class="cover-container page-break">
        <div class="cover-title">PROGRAM MANAJEMEN {{ $categoryTitle }}</div>
        <div class="cover-unit">{{ strtoupper($unitName) }}</div>

        <img src="{{ public_path('images/logo-semen-padang.png') }}" alt="Logo" class="logo">

        <div class="cover-details">
            <table style="margin: 0 auto; border: none;">
                <tr>
                    <td style="padding: 2px 10px; text-align: left; width: 80px;">No. Dok.</td>
                    <td style="padding: 2px 5px; text-align: center; width: 10px;">:</td>
                    <td style="padding: 2px 10px; text-align: left;">{{ $docNo }}</td>
                </tr>
                <tr>
                    <td style="padding: 2px 10px; text-align: left;">Revisi</td>
                    <td style="padding: 2px 5px; text-align: center;">:</td>
                    <td style="padding: 2px 10px; text-align: left;">{{ $revision }}</td>
                </tr>
                <tr>
                    <td style="padding: 2px 10px; text-align: left;">Tanggal</td>
                    <td style="padding: 2px 5px; text-align: center;">:</td>
                    <td style="padding: 2px 10px; text-align: left;">{{ $date }}</td>
                </tr>
            </table>
        </div>

        <div class="cover-footer">
            PT SEMEN PADANG<br>
            TAHUN {{ $currentYear }}
        </div>
    </div>

    <!-- PAGE 2: SIGNATURES -->
    <div class="page-break">
        <div style="margin-top: 50px;">
            <div class="cover-title text-center">PROGRAM MANAJEMEN {{ $categoryTitle }}</div>
            <div class="cover-unit text-center">{{ strtoupper($unitName) }}</div>
        </div>

        <div style="margin-top: 150px; text-align: center;">Padang, {{ $date }}</div>

        <table class="signature-table">
            <tr>
                <td class="signature-cell">
                    <div class="sign-label">Disiapkan oleh</div>
                    <div class="sign-name uppercase">{{ $kaUnit ? $kaUnit->nama_user : '........................' }}</div>
                    <div class="sign-jabatan">{{ $kaUnit && $kaUnit->roleJabatan ? $kaUnit->roleJabatan->nama_role_jabatan : 'Kepala Unit' }}</div>
                </td>
                <td class="signature-cell">
                    <div class="sign-label">Disetujui oleh</div>
                    <div class="sign-name uppercase">{{ $kaDept ? $kaDept->nama_user : '........................' }}</div>
                    <div class="sign-jabatan">{{ $kaDept && $kaDept->roleJabatan ? $kaDept->roleJabatan->nama_role_jabatan : 'Kepala Departemen' }}</div>
                </td>
                <td class="signature-cell">
                    <div class="sign-label">Disahkan oleh</div>
                    <div class="sign-name uppercase">{{ $direktur ? $direktur->nama_user : '........................' }}</div>
                    <div class="sign-jabatan">Direktur</div> <!-- Usually just 'Direktur' or specific title -->
                </td>
            </tr>
        </table>
    </div>

    <!-- PAGE 3: CONTENT -->
    <div>
        <!-- Program Info -->
        <table class="info-table">
            <tr>
                <td class="info-label">1. Judul</td>
                <td class="info-colon">:</td>
                <td>{{ $pmkProgram->judul }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="font-style: italic; color: #555;">(Judul Program Manajemen)</td>
            </tr>
            
            <tr>
                <td class="info-label">2. Tujuan</td>
                <td class="info-colon">:</td>
                <td>{{ $pmkProgram->tujuan }}</td>
            </tr>
            
            <tr>
                <td class="info-label">3. Sasaran</td>
                <td class="info-colon">:</td>
                <td>{{ $pmkProgram->sasaran }}</td>
            </tr>
            
            <tr>
                <td class="info-label">4. Penanggung Jawab</td>
                <td class="info-colon">:</td>
                <td>{{ $pmkProgram->penanggung_jawab }}</td>
            </tr>
            
            <tr>
                <td class="info-label">5. Uraian Revisi</td>
                <td class="info-colon">:</td>
                <td>{{ $pmkProgram->uraian_revisi ?? '-' }}</td>
            </tr>
        </table>

        <div class="section-title">6. Program Kerja</div>
        <div style="font-style: italic; color: #555; margin-bottom: 10px;">
            (menjelaskan tentang Uraian kegiatan program skedul pelaksanaan, PIC, target dan anggaran program yang diisi pada tabel dibawah)
        </div>

        @if($pmkProgram->program_kerja && is_array($pmkProgram->program_kerja) && count($pmkProgram->program_kerja) > 0)
        <table class="program-table">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 30px;">No.</th>
                    <th rowspan="2">Uraian Kegiatan</th>
                    <th rowspan="2" style="width: 140px;">PIC</th>
                    <th colspan="12">Target (%)</th>
                    <th rowspan="2" style="width: 80px;">Anggaran</th>
                </tr>
                <tr>
                    @for($m=1; $m<=12; $m++)
                        <th style="width: 20px;">{{ $m }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach($pmkProgram->program_kerja as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item['uraian'] ?? '-' }}</td>
                    <td class="text-center">{{ (!empty($item['koordinator']) && $item['koordinator'] !== '-') ? $item['koordinator'] : ($item['pelaksana'] ?? $item['pic'] ?? '-') }}</td>
                    @php
                        $targets = $item['target'] ?? [];
                    @endphp
                    @for($m=0; $m<12; $m++)
                        <td class="text-center bg-grey">
                            {{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '' }}
                        </td>
                    @endfor
                    <td class="text-right">
                        {{ isset($item['anggaran']) && $item['anggaran'] ? number_format($item['anggaran'], 0, ',', '.') : '-' }}
                    </td>
                </tr>
                @endforeach
                <!-- Add empty rows if needed for styling, but dynamic is better -->
            </tbody>
        </table>
        @else
        <div style="padding: 20px; text-align: center; border: 1px solid #ccc; background: #f9f9f9;">
            Tidak ada data program kerja.
        </div>
        @endif
    </div>
</body>
</html>
