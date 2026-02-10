<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
        }
        
        .cover-section {
            text-align: center;
            padding: 40px 20px;
            background: #f8fafc;
            border: 2px solid #3b82f6;
            margin-bottom: 20px;
        }
        
        .cover-title {
            font-size: 18pt;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 10px;
        }
        
        .cover-subtitle {
            font-size: 14pt;
            font-weight: bold;
            color: #334155;
            margin-bottom: 20px;
        }
        
        .cover-info {
            margin: 20px 0;
        }
        
        .signature-row {
            display: table;
            width: 100%;
            margin-top: 30px;
        }
        
        .signature-cell {
            display: table-cell;
            width: 50%;
            text-align: center;
            padding: 10px;
        }
        
        .info-section {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .info-table td {
            padding: 8px 0;
            vertical-align: top;
        }
        
        .info-table td:first-child {
            width: 180px;
            font-weight: bold;
            color: #475569;
        }
        
        .section-header {
            background: #3b82f6;
            color: white;
            padding: 10px 15px;
            font-weight: bold;
            font-size: 11pt;
            margin: 20px 0 10px 0;
        }
        
        table.program-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
        }
        
        table.program-table th {
            background-color: #1e293b;
            color: white;
            padding: 8px 5px;
            text-align: center;
            border: 1px solid #000;
            font-weight: bold;
        }
        
        table.program-table td {
            padding: 6px 5px;
            border: 1px solid #475569;
            vertical-align: middle;
        }
        
        .target-header {
            background-color: #334155;
            color: white;
        }
        
        .target-cell {
            background: #eff6ff;
            text-align: center;
            font-weight: bold;
            color: #1e40af;
        }
        
        .number-cell {
            text-align: center;
            font-weight: bold;
            background: #f1f5f9;
        }
    </style>
</head>
<body>
    @php
        $kaSeksi = $document->user;
        $kaUnit = $PMKProgram->approvedBy;
        $unitName = $document->unit ? $document->unit->nama_unit : '-';
        $tanggal = $PMKProgram->approved_at ? $PMKProgram->approved_at->locale('id')->isoFormat('D MMMM YYYY') : now()->locale('id')->isoFormat('D MMMM YYYY');
        $kaSeksiJabatan = $kaSeksi && $kaSeksi->roleJabatan ? $kaSeksi->roleJabatan->nama_role_jabatan : 'Ka. Seksi';
        $kaUnitJabatan = $kaUnit && $kaUnit->roleJabatan ? $kaUnit->roleJabatan->nama_role_jabatan : 'Ka. Unit';
    @endphp

    <!-- COVER -->
    <div class="cover-section">
        <div class="cover-title">Program Manajemen Korporat (PMK)</div>
        <div class="cover-subtitle">K3/KO/LINGKUNGAN/PENGAMANAN*</div>
        <div class="cover-info">
            <strong>Unit:</strong> {{ $unitName }}<br>
            <strong>Tanggal:</strong> Padang, {{ $tanggal }}
        </div>
        <div class="signature-row">
            <div class="signature-cell">
                <strong>Disiapkan oleh</strong><br><br><br>
                <strong>{{ $kaSeksi ? $kaSeksi->nama_user : '-' }}</strong><br>
                {{ $kaSeksiJabatan }}
            </div>
            <div class="signature-cell">
                <strong>Disahkan oleh</strong><br><br><br>
                <strong>{{ $kaUnit ? $kaUnit->nama_user : '-' }}</strong><br>
                {{ $kaUnitJabatan }}
            </div>
        </div>
        <div style="margin-top: 20px; font-style: italic; color: #64748b;">*bila tidak ada maka coret</div>
    </div>

    <!-- INFO -->
    <div class="info-section">
        <table class="info-table">
            <tr>
                <td>Judul Program</td>
                <td>: <strong>{{ $PMKProgram->judul }}</strong></td>
            </tr>
            <tr>
                <td>Tujuan</td>
                <td>: {{ $PMKProgram->tujuan }}</td>
            </tr>
            <tr>
                <td>Sasaran</td>
                <td>: {{ $PMKProgram->sasaran }}</td>
            </tr>
            <tr>
                <td>Penanggung Jawab</td>
                <td>: <strong>{{ $PMKProgram->penanggung_jawab }}</strong></td>
            </tr>
            <tr>
                <td>Uraian Revisi</td>
                <td>: {{ $PMKProgram->uraian_revisi ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <!-- TABLE -->
    <div class="section-header">PROGRAM KERJA</div>

    @if($PMKProgram->program_kerja && is_array($PMKProgram->program_kerja) && count($PMKProgram->program_kerja) > 0)
    <table class="program-table">
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">URAIAN KEGIATAN</th>
                <th rowspan="2">KOORDINATOR</th>
                <th rowspan="2">PELAKSANA</th>
                <th colspan="12">TARGET (%)</th>
                <th rowspan="2">ANGGARAN</th>
            </tr>
            <tr class="target-header">
                @for($m=1; $m<=12; $m++)
                    <th>{{ $m }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach($PMKProgram->program_kerja as $index => $item)
            <tr>
                <td class="number-cell">{{ $index + 1 }}</td>
                <td>{{ $item['uraian'] ?? '-' }}</td>
                <td>{{ $item['koordinator'] ?? '-' }}</td>
                <td>{{ $item['pelaksana'] ?? '-' }}</td>
                @php $targets = $item['target'] ?? []; @endphp
                @for($m=0; $m<12; $m++)
                    @if(isset($targets[$m]) && $targets[$m] !== '' && $targets[$m] !== null)
                        <td class="target-cell">{{ $targets[$m] }}</td>
                    @else
                        <td style="text-align: center; color: #94a3b8;">-</td>
                    @endif
                @endfor
                <td style="text-align: right; font-weight: bold; color: #059669;">
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
    @else
    <div style="padding: 15px; text-align: center; color: #64748b; font-style: italic; background: #f8fafc;">
        Belum ada detail program kerja
    </div>
    @endif
</body>
</html>
