<!DOCTYPE html>
<html>

<head>
    <title>HIRADC Document - {{ $document->judul_dokumen ?? 'Detail' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
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

        /* Simulated Logo */

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .main-table th,
        .main-table td {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }

        .main-table th {
            background-color: #eee;
            text-align: center;
            font-weight: bold;
        }

        .sub-header {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 11px;
        }

        .meta-info {
            margin-bottom: 15px;
        }

        .meta-info table {
            width: 100%;
        }

        .meta-info td {
            border: none;
            padding: 2px;
        }
    </style>
</head>

<body>

    <!-- DOCUMENT HEADER (ISO Style) -->
    <table class="header-table">
        <tr>
            <td width="20%" align="center">
                <div class="logo">PT SEMEN PADANG</div>
            </td>
            <td width="60%" align="center">
                <div class="title">HAZARD IDENTIFICATION, RISK ASSESSMENT AND DETERMINING CONTROL (HIRADC)</div>
            </td>
            <td width="20%">
                No. Dokumen: {{ $document->id }}/HIRADC/{{ date('Y') }}<br>
                Revisi: {{ $document->revision_number ?? 0 }}
            </td>
        </tr>
    </table>

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
                <td><strong>Direktorat</strong></td>
                <td>: {{ $document->direktorat->nama_dir ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Penulis</strong></td>
                <td>: {{ $document->user->nama_user ?? '-' }}</td>
                <td><strong>Tanggal</strong></td>
                <td>: {{ $document->created_at->format('d M Y') }}</td>
            </tr>
        </table>
    </div>

    <!-- HIRADC TABLE -->
    <table class="main-table">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Proses</th>
                <th rowspan="2">Kegiatan</th>
                <th rowspan="2">Lokasi</th>
                <th rowspan="2">Kondisi</th>
                <th rowspan="2">Bahaya</th>
                <th rowspan="2">Dampak</th>
                <th rowspan="2">Risiko Awal</th>
                <th rowspan="2">Pengendalian Existing</th>
                <th colspan="4">Penilaian Risiko</th>
                <th rowspan="2">Peraturan / Standar</th>
                <th rowspan="2">Pengendalian Lanjutan</th>
                <th colspan="4">Residual Risk</th>
            </tr>
            <tr>
                <th>P</th>
                <th>C</th>
                <th>Score</th>
                <th>Rating</th>
                <th>P</th>
                <th>C</th>
                <th>Score</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach($document->details as $item)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td>{{ $item->kolom2_proses }}</td>
                    <td>{{ $item->kolom2_kegiatan }}</td>
                    <td>{{ $item->kolom3_lokasi }}</td>
                    <td>{{ $item->kolom5_kondisi }}</td>
                    <td>
                        @if(is_array($item->kolom6_bahaya))
                            {{ implode(', ', $item->kolom6_bahaya['details'] ?? []) }}
                            @if(!empty($item->kolom6_bahaya['manual'])) <br>({{ $item->kolom6_bahaya['manual'] }}) @endif
                        @else
                            {{ $item->kolom6_bahaya }}
                        @endif
                    </td>
                    <td>{{ $item->kolom7_dampak }}</td>
                    <td>{{ $item->kolom9_risiko }}</td>
                    <td>{{ $item->kolom11_existing }}</td>

                    <!-- Initial Risk -->
                    <td align="center">{{ $item->kolom12_kemungkinan }}</td>
                    <td align="center">{{ $item->kolom13_konsekuensi }}</td>
                    <td align="center">{{ $item->kolom14_score }}</td>
                    <td align="center">{{ $item->kolom14_level }}</td>

                    <td>{{ $item->kolom15_regulasi }}</td>
                    <td>{{ $item->kolom18_tindak_lanjut }}</td>

                    <!-- Residual Risk -->
                    <td align="center">{{ $item->residual_kemungkinan }}</td>
                    <td align="center">{{ $item->residual_konsekuensi }}</td>
                    <td align="center">{{ $item->residual_score }}</td>
                    <td align="center">{{ $item->residual_level }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <div style="width: 100%; border-top: 1px dotted #ccc; margin-top: 20px; padding-top: 10px;">
        <small>Dicetak otomatis oleh Sistem Manajemen HIRADC PT Semen Padang pada {{ date('d M Y H:i') }}</small>
    </div>

</body>

</html>