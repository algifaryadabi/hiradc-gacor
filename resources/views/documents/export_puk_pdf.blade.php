<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Unit Kerja (PUK)</title>
    <style>
        @page {
            margin: 15mm 10mm;
            size: A4 landscape;
        }
        
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            font-size: 9pt;
            line-height: 1.3;
            color: #1a1a1a;
        }

        /* Cover Page */
        .cover-page {
            page-break-after: always;
            text-align: center;
            padding-top: 60px;
            position: relative;
        }

        .logo-container {
            margin: 0 auto 25px;
        }

        .logo {
            width: 90px;
            height: 90px;
        }

        .cover-title {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 8px;
            text-transform: uppercase;
            color: #1e40af;
            letter-spacing: 1px;
        }

        .cover-subtitle {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 40px;
            color: #334155;
        }

        .cover-info {
            margin: 60px 0;
            font-size: 11pt;
        }

        .cover-info-item {
            margin: 10px 0;
            font-weight: 500;
        }

        .signature-section {
            display: table;
            width: 100%;
            margin-top: 80px;
        }

        .signature-box {
            display: table-cell;
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 0 30px;
        }

        .signature-label {
            font-weight: bold;
            margin-bottom: 90px;
            font-size: 11pt;
        }

        .signature-name {
            font-weight: bold;
            border-top: 2px solid #000;
            padding-top: 8px;
            display: inline-block;
            min-width: 220px;
            font-size: 11pt;
        }

        .signature-title {
            font-size: 10pt;
            margin-top: 5px;
            color: #475569;
        }

        /* Content Page */
        .content-page {
            padding: 5px 0;
        }

        .info-section {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 6px 0;
            vertical-align: top;
            border: none;
        }

        .info-table td:first-child {
            width: 150px;
            font-weight: 600;
            color: #475569;
        }

        .info-table td:nth-child(2) {
            width: 15px;
            color: #64748b;
        }

        .info-table td:last-child {
            color: #0f172a;
        }

        .section-header {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            margin: 15px 0 10px 0;
            font-size: 11pt;
            font-weight: bold;
        }

        /* Table */
        .table-container {
            width: 100%;
            overflow: visible;
        }

        table.program-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 7.5pt;
            margin: 10px auto;
        }

        table.program-table th {
            background-color: #1e293b;
            color: white;
            padding: 8px 4px;
            text-align: center;
            border: 1px solid #0f172a;
            font-weight: bold;
            font-size: 7.5pt;
        }

        table.program-table td {
            padding: 6px 4px;
            border: 1px solid #475569;
            vertical-align: middle;
            font-size: 7.5pt;
        }

        table.program-table td.center {
            text-align: center;
        }

        table.program-table td.number {
            text-align: center;
            font-weight: bold;
            background: #f1f5f9;
        }

        .target-header {
            background-color: #334155 !important;
            color: white;
            font-size: 7pt;
        }

        .target-cell {
            background: #eff6ff;
            text-align: center;
            font-weight: 600;
            color: #1e40af;
        }

        .empty-cell {
            text-align: center;
            color: #94a3b8;
        }

        .anggaran-cell {
            text-align: right;
            font-weight: 600;
            color: #059669;
            font-size: 7pt;
        }
    </style>
</head>
<body>
    @php
        use App\Models\User;
        
        // Get Kepala Seksi: User with role_jabatan = 4 (Kepala Seksi) from submitter's seksi
        $kaSeksi = null;
        $kaSeksiJabatan = 'Ka. Seksi';
        if ($document->user && $document->user->id_seksi) {
            $kaSeksi = User::where('id_seksi', $document->user->id_seksi)
                           ->where('role_jabatan', 4)
                           ->where('user_aktif', 1)
                           ->with('roleJabatan')
                           ->first();
            if ($kaSeksi && $kaSeksi->roleJabatan) {
                $kaSeksiJabatan = $kaSeksi->roleJabatan->nama_role_jabatan;
            }
        }
        
        // Get Kepala Unit: User with role_jabatan = 3 (Kepala Unit) from document's unit
        $kaUnit = null;
        $kaUnitJabatan = 'Ka. Unit';
        if ($document->id_unit) {
            $kaUnit = User::where('id_unit', $document->id_unit)
                          ->where('role_jabatan', 3)
                          ->where('user_aktif', 1)
                          ->with('roleJabatan')
                          ->first();
            if ($kaUnit && $kaUnit->roleJabatan) {
                $kaUnitJabatan = $kaUnit->roleJabatan->nama_role_jabatan;
            }
        }
        
        $unitName = $document->unit ? $document->unit->nama_unit : '-';
        $tanggal = $pukProgram->approved_at ? $pukProgram->approved_at->locale('id')->isoFormat('D MMMM YYYY') : now()->locale('id')->isoFormat('D MMMM YYYY');
    @endphp

    <!-- COVER PAGE -->
    <div class="cover-page">
        <div class="logo-container">
            <img src="{{ public_path('images/logo-semen-padang.png') }}" alt="Logo PT Semen Padang" class="logo">
        </div>
        
        <div class="cover-title">PROGRAM UNIT KERJA (PUK)</div>
        <div class="cover-subtitle">K3/KO/LINGKUNGAN/PENGAMANAN</div>

        <div class="cover-info">
            <div class="cover-info-item"><strong>Unit:</strong> {{ $unitName }}</div>
            <div class="cover-info-item"><strong>Tanggal:</strong> Padang, {{ $tanggal }}</div>
        </div>

        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-label">Disiapkan oleh</div>
                <div class="signature-name">{{ $kaSeksi ? $kaSeksi->nama_user : '........................' }}</div>
                <div class="signature-title">{{ $kaSeksiJabatan }}</div>
            </div>
            <div class="signature-box">
                <div class="signature-label">Disahkan oleh</div>
                <div class="signature-name">{{ $kaUnit ? $kaUnit->nama_user : '........................' }}</div>
                <div class="signature-title">{{ $kaUnitJabatan }}</div>
            </div>
        </div>
    </div>

    <!-- CONTENT PAGE -->
    <div class="content-page">
        <!-- Program Information -->
        <div class="info-section">
            <table class="info-table">
                <tr>
                    <td>Judul Program</td>
                    <td>:</td>
                    <td><strong>{{ $pukProgram->judul }}</strong></td>
                </tr>
                <tr>
                    <td>Tujuan</td>
                    <td>:</td>
                    <td>{{ $pukProgram->tujuan }}</td>
                </tr>
                <tr>
                    <td>Sasaran</td>
                    <td>:</td>
                    <td>{{ $pukProgram->sasaran }}</td>
                </tr>
                <tr>
                    <td>Penanggung Jawab</td>
                    <td>:</td>
                    <td><strong>{{ $pukProgram->penanggung_jawab }}</strong></td>
                </tr>
                @if($pukProgram->uraian_revisi)
                <tr>
                    <td>Uraian Revisi</td>
                    <td>:</td>
                    <td>{{ $pukProgram->uraian_revisi }}</td>
                </tr>
                @endif
            </table>
        </div>

        <!-- Program Kerja Table -->
        <div class="section-header">
            Detail Kegiatan
        </div>

        @if($pukProgram->program_kerja && is_array($pukProgram->program_kerja) && count($pukProgram->program_kerja) > 0)
        <div class="table-container">
            <table class="program-table">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 25px;">NO</th>
                        <th rowspan="2" style="width: 140px;">URAIAN KEGIATAN</th>
                        <th rowspan="2" style="width: 70px;">KOORDINATOR</th>
                        <th rowspan="2" style="width: 70px;">PELAKSANA</th>
                        <th colspan="12">TARGET (%)</th>
                        <th rowspan="2" style="width: 70px;">ANGGARAN</th>
                    </tr>
                    <tr class="target-header">
                        @for($m=1; $m<=12; $m++)
                            <th style="width: 22px;">{{ $m }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($pukProgram->program_kerja as $index => $item)
                    <tr>
                        <td class="number">{{ $index + 1 }}</td>
                        <td>{{ $item['uraian'] ?? '-' }}</td>
                        <td>{{ $item['koordinator'] ?? '-' }}</td>
                        <td>{{ $item['pelaksana'] ?? '-' }}</td>
                        @php
                            $targets = $item['target'] ?? [];
                        @endphp
                        @for($m=0; $m<12; $m++)
                            @if(isset($targets[$m]) && $targets[$m] !== '' && $targets[$m] !== null)
                                <td class="target-cell">{{ $targets[$m] }}</td>
                            @else
                                <td class="empty-cell">-</td>
                            @endif
                        @endfor
                        <td class="anggaran-cell">
                            @if(isset($item['anggaran']) && $item['anggaran'])
                                Rp {{ number_format($item['anggaran'], 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div style="padding: 15px; text-align: center; color: #64748b; font-style: italic; background: #f8fafc; border-radius: 6px;">
            Belum ada detail program kerja
        </div>
        @endif
    </div>
</body>
</html>
