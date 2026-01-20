<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Form - HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #c41e3a;
            --primary-light: #fff1f2;
            --bg-body: #f8fafc;
            --surface: #ffffff;
            --text-main: #0f172a;
            --text-sub: #64748b;
            --border: #e2e8f0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            padding: 30px;
        }

        .container {
            display: flex;
            min-height: 100vh;
            max-width: none;
            margin: 0;
            background: transparent;
            box-shadow: none;
            padding: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: white;
            border-right: 1px solid #e0e0e0;
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 50;
        }

        .logo-section {
            padding: 30px 20px;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
        }

        .logo-circle {
            width: 70px;
            height: 70px;
            background: #fff;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo-circle img {
            max-width: 80%;
            max-height: 80%;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 700;
            color: #c41e3a;
            margin-bottom: 3px;
        }

        .logo-subtext {
            font-size: 12px;
            color: #999;
            font-style: italic;
        }

        .nav-menu {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .nav-item {
            padding: 15px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #666;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            position: relative;
        }

        .nav-item:hover {
            background: #fff5f5;
            color: #c41e3a;
        }

        .nav-item.active {
            background: #ffe5e5;
            color: #c41e3a;
            border-left: 3px solid #c41e3a;
            font-weight: 500;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }
        
        .badge {
            position: absolute;
            right: 20px;
            background: #c41e3a;
            color: white;
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 10px;
            font-weight: 600;
        }

        .user-info-bottom {
            padding: 20px;
            border-top: 2px solid #e0e0e0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-weight: 700;
            font-size: 16px;
            flex-shrink: 0;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 2px;
        }

        .logout-btn {
            width: 100%;
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 30px;
            width: calc(100% - 250px);
        }

        .summary-card {
            max-width: 1800px;
            margin: 0 auto;
            background: var(--surface);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            padding: 24px;
        }

        .header-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 24px;
            border-bottom: 2px solid var(--border);
            padding-bottom: 16px;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--primary);
        }

        .page-title p {
            color: var(--text-sub);
            font-size: 14px;
            margin-top: 4px;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .filter-group {
            display: flex;
            gap: 8px;
            align-items: center;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 8px;
        }

        .filter-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            margin: 0 8px;
        }

        .filter-link {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s;
        }

        .filter-link:hover {
            background: #e2e8f0;
        }

        .filter-link.active {
            background: white;
            color: var(--primary);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .btn-outline {
            background: white;
            border-color: #cbd5e1;
            color: #475569;
        }

        .btn-outline:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: #a01729;
        }

        /* TABLE */
        .table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 8px;
        }

        .excel-table {
            width: max-content;
            min-width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 11px;
        }

        /* Headers */
        .excel-table thead th {
            background: #1e293b;
            color: white;
            padding: 10px;
            border-right: 1px solid #475569;
            border-bottom: 1px solid #475569;
            text-align: center;
            font-weight: 600;
            text-transform: uppercase;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .excel-table thead tr:first-child th {
            z-index: 20;
            background: #0f172a;
        }

        .excel-table tbody td {
            vertical-align: top;
            padding: 8px;
            border-right: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            color: #334155;
        }

        .section-border-right {
            border-right: 2px solid #94a3b8 !important;
        }

        .doc-sep {
            border-top: 3px solid #94a3b8;
        }

        /* Status Badges */
        .status-badge {
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
            text-transform: uppercase;
            display: inline-block;
        }

        .st-approved {
            background: #dcfce7;
            color: #166534;
        }

        .st-pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .st-revision {
            background: #fee2e2;
            color: #991b1b;
        }

        .st-draft {
            background: #f1f5f9;
            color: #475569;
        }

        /* Risk Badges */
        .risk-badge {
            font-size: 10px;
            padding: 1px 6px;
            border-radius: 10px;
            font-weight: 700;
            color: white;
            display: inline-block;
            min-width: 30px;
            text-align: center;
        }

        .bg-low {
            background: #16a34a;
        }

        .bg-med {
            background: #ca8a04;
        }

        .bg-high {
            background: #dc2626;
        }

        .ul-dense {
            padding-left: 14px;
            margin: 0;
        }

        .ul-dense li {
            margin-bottom: 2px;
        }

        /* PRINT STYLES */
        .print-header {
            display: none;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .print-logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .print-logo {
            width: 60px;
            height: auto;
        }

        .print-info h2 {
            font-size: 16px;
            margin: 0;
            text-transform: uppercase;
            font-weight: 800;
            color: black;
        }

        .print-info h3 {
            font-size: 12px;
            margin: 2px 0 0 0;
            font-weight: 600;
            color: #333;
        }

        .print-info p {
            font-size: 10px;
            margin: 2px 0 0 0;
            color: #555;
        }

        .print-meta {
            margin-top: 10px;
            display: flex;
            gap: 20px;
            font-size: 9px;
        }

        @media print {
            @page {
                size: landscape;
                margin: 0.5cm;
            }

            .sidebar { display: none !important; }

            .main-content {
                margin-left: 0 !important; 
                padding: 0 !important; 
                width: 100% !important; 
                flex: none !important;
            }
            
            .summary-card { 
                box-shadow: none !important; 
                border: none !important; 
                padding: 0 !important; 
                margin: 0 !important; 
                max-width: 100% !important;
                background: white !important;
            }

            body {
                background: white;
                padding: 0;
                -webkit-print-color-adjust: exact;
                font-family: 'Times New Roman', serif;
            }

            .no-print,
            .header-section {
                display: none !important;
            }

            .container {
                display: block !important; /* Reset flex */
                box-shadow: none;
                border: none;
                padding: 0;
                margin: 0;
                max-width: 100%;
                width: 100%;
            }

            .table-wrapper {
                border: none;
                overflow: visible;
            }

            .print-header {
                display: block;
            }

            .excel-table {
                width: 100%;
                font-size: 7.5pt;
                border-collapse: collapse;
            }

            .excel-table th {
                background: #e5e5e5 !important;
                color: #000 !important;
                border: 1px solid #000 !important;
                padding: 4px;
                position: static;
            }

            .excel-table td {
                border: 1px solid #000 !important;
                padding: 4px;
                color: #000 !important;
            }

            .section-border-right {
                border-right: 2px solid #000 !important;
            }

            .risk-badge {
                border: 1px solid #000;
                color: #000 !important;
                background: transparent !important;
                font-weight: bold;
            }

            .doc-sep {
                border-top: 2px solid #000;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        @include('user.partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="summary-card">
                <!-- Print Header -->
        <div class="print-header">
            <div class="print-logo-container">
                <img src="{{ asset('images/logo-semen-padang.png') }}" class="print-logo" alt="Logo">
                <div class="print-info">
                    <h2>PT SEMEN PADANG</h2>
                    <h3>REKAPITULASI FORM HIRADC</h3>
                    <p style="text-transform:uppercase; font-weight:bold; font-size:11px; margin-top:4px;">PROSES
                        BISNIS: {{ $unitProbis }}</p>
                    <p>Unit Kerja: {{ Auth::user()->unit_or_dept_name }} • Dicetak: {{ now()->format('d M Y H:i') }}</p>
                </div>
            </div>
            <div class="print-meta">
                <span><strong>Probis:</strong> {{ $unitProbis }}</span>
                <span><strong>Filter Kategori:</strong>
                    {{ request('kategori') == 'all' || !request('kategori') ? 'SEMUA' : request('kategori') }}</span>
                <span><strong>Filter Status:</strong>
                    {{ request('status') == 'all' || !request('status') ? 'SEMUA' : strtoupper(request('status')) }}</span>
                <span><strong>Dicetak Oleh:</strong> {{ Auth::user()->nama_user }}</span>
            </div>
        </div>

        <!-- Web Header -->
        <div class="header-section no-print">
            <div class="header-top">
                <div class="page-title">
                    <div
                        style="font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px;">
                        PROSES BISNIS: {{ $unitProbis }}</div>
                    <h1>Rekapitulasi Form HIRADC</h1>
                    <p>Tabel Master Seluruh Form • {{ Auth::user()->unit_or_dept_name }}</p>
                </div>
                <div class="actions">
                    <a href="javascript:window.print()" class="btn btn-primary"><i class="fas fa-print"></i> Cetak /
                        PDF</a>
                    <a href="{{ route('documents.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i>
                        Kembali</a>
                </div>
            </div>

            <div class="toolbar">
                <div class="filter-group">
                    <span class="filter-label">Kategori</span>
                    <a href="{{ route('documents.summary', array_merge(request()->all(), ['kategori' => 'all'])) }}"
                        class="filter-link {{ !request('kategori') || request('kategori') == 'all' ? 'active' : '' }}">Semua</a>
                    <a href="{{ route('documents.summary', array_merge(request()->all(), ['kategori' => 'K3'])) }}"
                        class="filter-link {{ request('kategori') == 'K3' ? 'active' : '' }}">K3</a>
                    <a href="{{ route('documents.summary', array_merge(request()->all(), ['kategori' => 'Lingkungan'])) }}"
                        class="filter-link {{ request('kategori') == 'Lingkungan' ? 'active' : '' }}">Lingkungan</a>
                    <a href="{{ route('documents.summary', array_merge(request()->all(), ['kategori' => 'Keamanan'])) }}"
                        class="filter-link {{ request('kategori') == 'Keamanan' ? 'active' : '' }}">Keamanan</a>
                </div>

                <div class="filter-group">
                    <span class="filter-label">Status</span>
                    <a href="{{ route('documents.summary', array_merge(request()->all(), ['status' => 'all'])) }}"
                        class="filter-link {{ !request('status') || request('status') == 'all' ? 'active' : '' }}">Semua</a>
                    <a href="{{ route('documents.summary', array_merge(request()->all(), ['status' => 'draft'])) }}"
                        class="filter-link {{ request('status') == 'draft' ? 'active' : '' }}">Draft</a>
                    <a href="{{ route('documents.summary', array_merge(request()->all(), ['status' => 'pending'])) }}"
                        class="filter-link {{ request('status') == 'pending' ? 'active' : '' }}">Menunggu</a>
                    <a href="{{ route('documents.summary', array_merge(request()->all(), ['status' => 'revision'])) }}"
                        class="filter-link {{ request('status') == 'revision' ? 'active' : '' }}">Revisi</a>
                    <a href="{{ route('documents.summary', array_merge(request()->all(), ['status' => 'approved'])) }}"
                        class="filter-link {{ request('status') == 'approved' ? 'active' : '' }}">Final</a>
                </div>
            </div>
        </div>

        <div class="table-wrapper">
            <table class="excel-table">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 30px;">No</th>
                        <th colspan="5" class="section-border-right">Informasi Form</th>
                        <th colspan="3" class="section-border-right">Kegiatan & Situasi</th>
                        <th colspan="3" class="section-border-right">Identifikasi Bahaya & Risiko</th>
                        <th colspan="2" class="section-border-right">Pengendalian</th>
                        <th colspan="3" class="section-border-right">Risiko Awal</th>
                        <th rowspan="2" style="width: 120px;" class="section-border-right">Peraturan</th>
                        <th rowspan="2" style="width: 50px;" class="section-border-right">Penting</th>
                        <th colspan="4">Tindak Lanjut & Risiko Sisa</th>
                    </tr>
                    <tr>
                        <th style="width: 70px;">Status</th>
                        <th style="width: 60px;">Tgl</th>
                        <th style="width: 150px;">Judul Form</th>
                        <th style="width: 50px;">Kat</th>
                        <th style="width: 80px;" class="section-border-right">Unit</th>

                        <th style="width: 140px;">Kegiatan</th>
                        <th style="width: 80px;">Lokasi</th>
                        <th style="width: 50px;" class="section-border-right">Kondisi</th>

                        <th style="width: 180px;">Bahaya</th>
                        <th style="width: 130px;">Dampak</th>
                        <th style="width: 130px;" class="section-border-right">Risiko & Peluang</th>

                        <th style="width: 180px;">Hirarki & Kontrol</th>
                        <th style="width: 140px;" class="section-border-right">Existing</th>

                        <th style="width: 25px;">L</th>
                        <th style="width: 25px;">S</th>
                        <th style="width: 40px;" class="section-border-right">Sc</th>

                        <th style="width: 150px;">Tindak Lanjut</th>
                        <th style="width: 25px;">L</th>
                        <th style="width: 25px;">S</th>
                        <th style="width: 40px;">Sc</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $doc)
                        @php
                            $rowClass = "doc-sep";

                            $statusLabel = 'DRAFT';
                            $statusClass = 'st-draft';
                            if ($doc->status == 'approved') {
                                $statusLabel = 'FINAL';
                                $statusClass = 'st-approved';
                            }
                            if (str_contains($doc->status, 'pending')) {
                                $statusLabel = 'PENDING';
                                $statusClass = 'st-pending';
                            }
                            if ($doc->status == 'revision') {
                                $statusLabel = 'REVISI';
                                $statusClass = 'st-revision';
                            }

                            // Risk Logic
                            $sc = $doc->kolom14_score;
                            $lvl = 'LOW';
                            $bg = 'bg-low';
                            if ($sc > 4 && $sc <= 12) {
                                $lvl = 'MED';
                                $bg = 'bg-med';
                            }
                            if ($sc > 12) {
                                $lvl = 'HIGH';
                                $bg = 'bg-high';
                            }

                            $r_sc = $doc->residual_score;
                            $r_lvl = 'LOW';
                            $r_bg = 'bg-low';
                            if ($r_sc > 4 && $r_sc <= 12) {
                                $r_lvl = 'MED';
                                $r_bg = 'bg-med';
                            }
                            if ($r_sc > 12) {
                                $r_lvl = 'HIGH';
                                $r_bg = 'bg-high';
                            }
                        @endphp
                        <tr class="{{ $loop->first ? '' : 'doc-sep' }}">
                            <td style="text-align:center; font-weight:bold;">{{ $loop->iteration }}</td>
                            <td><span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span></td>
                            <td>{{ $doc->created_at->format('d/m/y') }}</td>
                            <td><span style="font-weight:600; color:#1e293b;">{{ $doc->judul_dokumen ?? '-' }}</span></td>
                            <td>{{ $doc->kategori }}</td>
                            <td class="section-border-right">{{ $doc->unit->nama_unit ?? '-' }}</td>

                            <td><b>{{ $doc->kolom2_kegiatan }}</b></td>
                            <td>{{ $doc->kolom3_lokasi }}</td>
                            <td class="section-border-right" style="text-align:center;">{{ $doc->kolom5_kondisi }}</td>

                            <td>
                                <ul class="ul-dense">
                                    @foreach($doc->kolom6_bahaya['details'] ?? [] as $d) <li>{{$d}}</li> @endforeach
                                    @if(!empty($doc->kolom6_bahaya['manual']))
                                    <li>{{$doc->kolom6_bahaya['manual']}}</li> @endif
                                </ul>
                            </td>
                            <td>{{ $doc->kolom7_dampak }}</td>
                            <td class="section-border-right">
                                <span style="display:block; font-weight:700; margin-bottom:4px;">Identifikasi:</span>
                                {{ $doc->kolom9_risiko }}
                                @if($doc->kolom17_risiko)
                                    <div style="margin-top:6px; padding-top:4px; border-top:1px dashed #cbd5e1;">
                                        <span style="color:#ef4444; font-weight:800; font-size:10px; display:block;">RISIKO
                                            NEGATIF:</span>
                                        {{ $doc->kolom17_risiko }}
                                    </div>
                                @endif
                                @if($doc->kolom17_peluang)
                                    <div style="margin-top:6px; padding-top:4px; border-top:1px dashed #cbd5e1;">
                                        <span style="color:#166534; font-weight:800; font-size:10px; display:block;">PELUANG
                                            POSITIF:</span>
                                        {{ $doc->kolom17_peluang }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                <div>{{ implode(', ', $doc->kolom10_pengendalian['hierarchy'] ?? []) }}</div>
                                @if(!empty($doc->kolom10_pengendalian['new_controls']))
                                    <div style="margin-top:4px; font-size:10px; color:#555;">
                                        @foreach($doc->kolom10_pengendalian['new_controls'] as $nc)
                                            <div>- {{ $nc['type'] ?? '' }}: {{ $nc['desc'] ?? '' }}</div>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="section-border-right">{{ $doc->kolom11_existing }}</td>

                            <td style="text-align:center;">{{ $doc->kolom12_kemungkinan }}</td>
                            <td style="text-align:center;">{{ $doc->kolom13_konsekuensi }}</td>
                            <td class="section-border-right" style="text-align:center;">
                                <div class="risk-badge {{ $bg }}">{{ $sc }}</div>
                            </td>

                            <!-- Peraturan (15) -->
                            <td class="section-border-right">{{ $doc->kolom15_regulasi }}</td>

                            <!-- Penting (16) -->
                            <td class="section-border-right" style="text-align:center;">
                                @if($doc->kolom16_aspek == 'P') <span style="font-weight:bold; color:#ef4444;">P</span>
                                @elseif($doc->kolom16_aspek == 'TP') <span style="color:#64748b;">TP</span>
                                @else - @endif
                            </td>

                            <!-- Tindak Lanjut (18) -->
                            <td>{{ $doc->kolom18_tindak_lanjut }}</td>

                            <!-- Residual Risk -->
                            <td style="text-align:center;">{{ $doc->residual_kemungkinan }}</td>
                            <td style="text-align:center;">{{ $doc->residual_konsekuensi }}</td>
                            <td style="text-align:center;">
                                @if($r_sc)
                                    <div class="risk-badge {{ $r_bg }}">{{ $r_sc }}</div>
                                @else - @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="16" style="text-align:center; padding: 40px; color: #94a3b8;">
                                Tidak ada form ditemukan dengan filter ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="legend-section"
            style="margin-top: 15px; font-size: 11px; color: #334155; border-top: 1px solid #e2e8f0; padding-top: 10px;">
            <strong>Keterangan Singkatan:</strong>
            <ul style="list-style: none; padding: 0; margin: 5px 0 0 0; display: flex; gap: 20px;">
                <li><strong>L (Likelihood)</strong>: Kemungkinan Terjadi</li>
                <li><strong>S (Severity)</strong>: Keparahan / Konsekuensi</li>
                <li><strong>SC (Score)</strong>: Nilai Risiko (L × S)</li>
            </ul>
        </div>
    </div>
        </div>
    </main>
    </div>
</body>

</html>