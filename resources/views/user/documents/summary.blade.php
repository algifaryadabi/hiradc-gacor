<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Form - HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Palette Modern (Slate & Primary Red) */
            --primary: #c41e3a;
            --primary-hover: #a01729;
            --primary-light: #fff1f2;
            --primary-soft: #ffe4e6;
            
            --bg-body: #f1f5f9;
            --sidebar-bg: #5b6fd8;
            --surface: #ffffff;
            
            --text-main: #0f172a;
            --text-sub: #64748b;
            --text-light: #94a3b8;
            
            --border: #e2e8f0;
            --border-color: #e2e8f0;
            --border-radius: 16px;
            
            /* Modern Status Colors */
            --success: #10b981;
            --success-bg: #ecfdf5;
            --warning: #f59e0b;
            --warning-bg: #fffbeb;
            --danger: #ef4444;
            --danger-bg: #fef2f2;
            --info: #3b82f6;
            --info-bg: #eff6ff;

            --header-bg: #1e293b;
            --header-text: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            padding: 0;
            padding-bottom: 60px;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - Consistent Blue Design */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
            font-family: 'Inter', sans-serif;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .logo-section {
            padding: 32px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
            background: transparent;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .logo-circle img {
            max-width: 80%;
            max-height: 80%;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 700;
            color: white;
            margin-bottom: 4px;
        }

        .logo-subtext {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .nav-menu {
            flex: 1;
            padding: 24px 0;
            overflow-y: auto;
        }

        .nav-item {
            padding: 12px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .nav-item:hover { 
            background: rgba(255, 255, 255, 0.1); 
            color: white; 
        }
        
        .nav-item.active { 
            background: rgba(255, 255, 255, 0.15); 
            color: white; 
            border-left-color: white; 
        }

        .badge {
            margin-left: auto;
            background: #ef4444; 
            color: white; 
            font-size: 10px; 
            padding: 2px 8px; 
            border-radius: 10px; 
            font-weight: 700;
        }

        .user-info-bottom {
            padding: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(0, 0, 0, 0.1);
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sidebar-bg);
            font-weight: 700;
            font-size: 16px;
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
            padding: 10px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }
        
        .logout-btn:hover { background: rgba(255, 255, 255, 0.3); }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 40px;
            width: calc(100% - 280px);
            min-height: 100vh;
        }

        .summary-card {
            background: var(--surface);
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            padding: 32px;
            border: 1px solid var(--border);
        }

        .header-section {
            display: flex;
            flex-direction: column;
            gap: 24px;
            margin-bottom: 32px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 24px;
        }

        .header-top { display: flex; justify-content: space-between; align-items: flex-start; }

        .page-title h1 {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .page-title p {
            color: var(--text-sub);
            font-size: 14px;
            font-weight: 500;
        }

        .toolbar { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; }

        .filter-group {
            display: flex;
            gap: 4px;
            align-items: center;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .filter-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            margin: 0 10px;
            letter-spacing: 0.05em;
        }

        .filter-link {
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s;
        }

        .filter-link:hover { color: var(--text-main); background: #e2e8f0; }
        .filter-link.active {
            background: white;
            color: var(--primary);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .actions { display: flex; gap: 12px; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .btn-outline {
            background: white;
            border-color: var(--border);
            color: var(--text-main);
            box-shadow: var(--shadow-xs);
        }

        .btn-outline:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(196, 30, 58, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 10px -1px rgba(196, 30, 58, 0.3);
        }

        /* TABLE */
        .table-wrapper {
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden; /* Rounded corners */
            overflow-x: auto;
            box-shadow: var(--shadow-xs);
        }

        .excel-table {
            width: max-content;
            min-width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            font-size: 12px;
        }

        /* Headers */
        .excel-table thead th {
            background: linear-gradient(to bottom, #1e293b 0%, #0f172a 100%);
            color: white;
            padding: 12px 10px;
            border-right: 1px solid #334155;
            border-bottom: 1px solid #334155;
            text-align: center;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.02em;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .excel-table thead tr:first-child th {
            z-index: 20;
            background: linear-gradient(to bottom, #0f172a 0%, #020617 100%);
        }

        .excel-table tbody td {
            vertical-align: top;
            padding: 12px;
            border-right: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            color: var(--text-main);
            font-size: 12px;
            line-height: 1.5;
        }
        
        .excel-table tbody tr:hover td {
            background: #f8fafc;
        }

        .section-border-right { border-right: 3px solid #94a3b8 !important; }

        /* Status & Badges */
        .status-badge {
            font-size: 10px;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            display: inline-block;
        }

        .st-approved { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .st-pending { background: #fef9c3; color: #854d0e; border: 1px solid #fde047; }
        .st-revision { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .st-draft { background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }

        /* Risk Badges */
        .risk-badge {
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: 700;
            color: white;
            display: inline-block;
            min-width: 32px;
            text-align: center;
        }

        .bg-low { background: #16a34a; }
        .bg-med { background: #ca8a04; }
        .bg-high { background: #dc2626; }

        .ul-dense { padding-left: 16px; margin: 0; }
        .ul-dense li { margin-bottom: 4px; }

        /* PRINT STYLES */
        .print-header {
            display: none;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }

        .print-logo-container { display: flex; align-items: center; gap: 20px; }
        .print-logo { width: 70px; height: auto; }

        .print-info h2 { font-size: 18px; margin: 0; text-transform: uppercase; font-weight: 800; color: black; }
        .print-info h3 { font-size: 14px; margin: 4px 0 0 0; font-weight: 600; color: #333; }
        .print-info p { font-size: 11px; margin: 4px 0 0 0; color: #555; }

        .print-meta { margin-top: 15px; display: flex; gap: 24px; font-size: 10px; }

        @media print {
            @page {
                size: landscape;
                margin: 0.5cm;
            }

            .sidebar, .btn, .no-print, .toolbar { display: none !important; }

            .main-content {
                margin-left: 0 !important;
                padding: 0 !important;
                width: 100% !important;
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
                font-family: 'Times New Roman', serif;
                padding-bottom: 0;
            }

            .container { display: block !important; }

            .table-wrapper { border: none; overflow: visible; box-shadow: none; border-radius: 0; }

            .print-header { display: block; }
            .header-section { display: none; }

            .excel-table { width: 100%; font-size: 8pt; border-collapse: collapse; }

            .excel-table th {
                background: #e5e5e5 !important;
                color: #000 !important;
                border: 1px solid #000 !important;
                padding: 4px;
                position: static; /* Remove sticky */
            }

            .excel-table td {
                border: 1px solid #000 !important;
                padding: 4px;
                color: #000 !important;
            }

            .section-border-right { border-right: 2px solid #000 !important; }
            .risk-badge {
                border: 1px solid #000;
                color: #000 !important;
                background: transparent !important;
                font-weight: bold;
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
                            <p style="text-transform:uppercase; font-weight:bold; font-size:11px; margin-top:4px;">
                                PROSES BISNIS: {{ $unitProbis }}</p>
                            <p>Unit Kerja: {{ Auth::user()->unit_or_dept_name }} • Dicetak:
                                {{ now()->format('d M Y H:i') }}</p>
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
                            <div style="display:flex; align-items:center; gap:8px;">
                                <span style="font-size:12px; font-weight:700; color:var(--primary); text-transform:uppercase; letter-spacing:0.05em; background:var(--primary-light); padding:4px 8px; border-radius:6px;">
                                    Probis: {{ $unitProbis }}
                                </span>
                            </div>
                            <h1>Rekapitulasi Form HIRADC</h1>
                            <p>Tabel Master Seluruh Form • {{ Auth::user()->unit_or_dept_name }}</p>
                        </div>
                        <div class="actions">
                            <a href="javascript:window.print()" class="btn btn-primary">
                                <i class="fas fa-print"></i> Cetak / PDF
                            </a>
                            <a href="{{ route('documents.index') }}" class="btn btn-outline">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="toolbar">
                        <div class="filter-group">
                            <span class="filter-label">Kategori</span>
                            <a href="{{ route('documents.summary', array_merge(request()->all(), ['kategori' => 'all'])) }}"
                                class="filter-link {{ !request('kategori') || request('kategori') == 'all' ? 'active' : '' }}">Semua</a>
                            <a href="{{ route('documents.index', array_merge(request()->all(), ['kategori' => 'K3'])) }}"
                                class="filter-link {{ request('kategori') == 'K3' ? 'active' : '' }}">K3</a>
                            <a href="{{ route('documents.index', array_merge(request()->all(), ['kategori' => 'Lingkungan'])) }}"
                                class="filter-link {{ request('kategori') == 'Lingkungan' ? 'active' : '' }}">Lingkungan</a>
                            <a href="{{ route('documents.index', array_merge(request()->all(), ['kategori' => 'Keamanan'])) }}"
                                class="filter-link {{ request('kategori') == 'Keamanan' ? 'active' : '' }}">Keamanan</a>
                        </div>

                        <div class="filter-group">
                            <span class="filter-label">Status</span>
                            <a href="{{ route('documents.index', array_merge(request()->all(), ['status' => 'all'])) }}"
                                class="filter-link {{ !request('status') || request('status') == 'all' ? 'active' : '' }}">Semua</a>
                            <a href="{{ route('documents.index', array_merge(request()->all(), ['status' => 'draft'])) }}"
                                class="filter-link {{ request('status') == 'draft' ? 'active' : '' }}">Draft</a>
                            <a href="{{ route('documents.index', array_merge(request()->all(), ['status' => 'pending'])) }}"
                                class="filter-link {{ request('status') == 'pending' ? 'active' : '' }}">Menunggu</a>
                            <a href="{{ route('documents.index', array_merge(request()->all(), ['status' => 'revision'])) }}"
                                class="filter-link {{ request('status') == 'revision' ? 'active' : '' }}">Revisi</a>
                            <a href="{{ route('documents.index', array_merge(request()->all(), ['status' => 'approved'])) }}"
                                class="filter-link {{ request('status') == 'approved' ? 'active' : '' }}">Final</a>
                        </div>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="excel-table">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width: 40px;">No</th>
                                <th colspan="6" class="section-border-right">Informasi Form</th>
                                <th colspan="3" class="section-border-right">Kegiatan & Situasi</th>
                                <th colspan="3" class="section-border-right">Identifikasi Bahaya & Risiko</th>
                                <th colspan="2" class="section-border-right">Pengendalian</th>
                                <th colspan="3" class="section-border-right">Risiko Awal</th>
                                <th rowspan="2" style="width: 150px;" class="section-border-right">Peraturan</th>
                                <th rowspan="2" style="width: 60px;" class="section-border-right">Penting</th>
                                <th colspan="4">Tindak Lanjut & Risiko Sisa</th>
                            </tr>
                            <tr>
                                <th style="width: 90px;">Status</th>
                                <th style="width: 80px;">Tgl</th>
                                <th style="width: 180px;">Judul Form</th>
                                <th style="width: 60px;">Kat</th>
                                <th style="width: 100px;">Unit</th>
                                <th style="width: 80px;" class="section-border-right">Aksi</th>

                                <th style="width: 150px;">Kegiatan</th>
                                <th style="width: 100px;">Lokasi</th>
                                <th style="width: 60px;" class="section-border-right">Kondisi</th>

                                <th style="width: 180px;">Bahaya</th>
                                <th style="width: 130px;">Dampak</th>
                                <th style="width: 130px;" class="section-border-right">Risiko & Peluang</th>

                                <th style="width: 200px;">Hirarki & Kontrol</th>
                                <th style="width: 150px;" class="section-border-right">Existing</th>

                                <th style="width: 30px;">L</th>
                                <th style="width: 30px;">S</th>
                                <th style="width: 50px;" class="section-border-right">Sc</th>

                                <th style="width: 150px;">Tindak Lanjut</th>
                                <th style="width: 30px;">L</th>
                                <th style="width: 30px;">S</th>
                                <th style="width: 50px;">Sc</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($documents as $docRaw)
                                @php
                                    // Split Logic: Determine which "Virtual Rows" to generate
                                    $virtualRows = [];
                                    $hasShe = $docRaw->hasSheContent();
                                    $hasSec = $docRaw->hasSecurityContent();
                                    $reqCat = request('kategori');

                                    // Check SHE
                                    if ($hasShe && ($reqCat == 'all' || !$reqCat || in_array($reqCat, ['K3', 'Lingkungan']))) {
                                        $virtualRows[] = [
                                            'type' => 'SHE',
                                            'status_field' => 'status_she',
                                            'cats' => ['K3', 'KO', 'Lingkungan']
                                        ];
                                    }

                                    // Check Security
                                    if ($hasSec && ($reqCat == 'all' || !$reqCat || $reqCat == 'Keamanan')) {
                                        $virtualRows[] = [
                                            'type' => 'Security',
                                            'status_field' => 'status_security',
                                            'cats' => ['Keamanan']
                                        ];
                                    }

                                    // Fallback
                                    if (empty($virtualRows)) {
                                        $virtualRows[] = [
                                            'type' => $docRaw->kategori,
                                            'status_field' => 'status',
                                            'cats' => [] 
                                        ];
                                    }
                                @endphp

                                @foreach($virtualRows as $vRow)
                                    @php
                                        $doc = $docRaw; 
                                        $rowType = $vRow['type'];
                                        $specificStatus = $doc->{$vRow['status_field']} ?? $doc->status;
                                        if ($vRow['status_field'] == 'status') $specificStatus = $doc->status;

                                        // Map Status to Label/Class
                                        $statusLabel = 'DRAFT';
                                        $statusClass = 'st-draft';
                                        $s = $specificStatus;

                                        if ($s == 'approved' || $s == 'published') {
                                            $statusLabel = 'FINAL';
                                            $statusClass = 'st-approved';
                                        } elseif (str_contains($s, 'pending') || $s == 'pending_head') {
                                            $statusLabel = 'PENDING';
                                            $statusClass = 'st-pending';
                                        } elseif ($s == 'revision') {
                                            $statusLabel = 'REVISI';
                                            $statusClass = 'st-revision';
                                        } elseif ($s == 'draft') {
                                            $statusLabel = 'DRAFT';
                                            $statusClass = 'st-draft';
                                        } else {
                                            $statusLabel = strtoupper($s);
                                        }

                                        $targetCats = $vRow['cats'];
                                        $details = collect($doc->details);
                                        
                                        if (!empty($targetCats)) {
                                            $details = $details->filter(function($i) use ($targetCats) {
                                                return in_array($i->kategori, $targetCats);
                                            });
                                        }

                                        if ($details->isEmpty()) continue;
                                    @endphp

                                    @foreach($details as $index => $item)
                                    <tr>
                                        <td style="text-align:center;">{{ $loop->parent->parent->iteration }}.{{ $index + 1 }}</td>
                                        
                                        <!-- Doc Info -->
                                        @if($index == 0)
                                            <td rowspan="{{ $details->count() }}">
                                                <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                            </td>
                                            <td rowspan="{{ $details->count() }}">{{ $doc->created_at->format('d/m/y') }}</td>
                                            <td rowspan="{{ $details->count() }}">
                                                <div style="font-weight:700;">{{ $doc->judul_dokumen ?? $doc->kolom2_kegiatan }}</div>
                                                <div style="font-size:10px; color:var(--text-sub); margin-top:2px;">Ref: #{{ $doc->id }}</div>
                                            </td>
                                            <td rowspan="{{ $details->count() }}" style="text-align:center;">
                                                <span style="font-size:10px; font-weight:700; color:var(--primary); background:var(--primary-light); padding:2px 6px; border-radius:4px;">{{ $rowType }}</span>
                                            </td>
                                            <td rowspan="{{ $details->count() }}">{{ $doc->unit->nama_unit ?? '-' }}</td>
                                            <td rowspan="{{ $details->count() }}" class="section-border-right" style="text-align:center;">
                                                <div style="display:flex; flex-direction:column; gap:4px; align-items:center;">
                                                    <a href="{{ route('documents.show', $doc->id) }}" class="no-print" title="Lihat" style="color:var(--text-sub);"><i class="fas fa-eye"></i></a>
                                                    @if($doc->status != 'approved' && $doc->status != 'published')
                                                    <a href="{{ route('documents.edit', $doc->id) }}" class="no-print" title="Edit" style="color:var(--primary);"><i class="fas fa-pencil-alt"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                        @endif

                                        <!-- Item Details -->
                                        <td>{{ $item->kolom2_kegiatan }}</td>
                                        <td>{{ $item->kolom3_lokasi }}</td>
                                        <td class="section-border-right" style="text-align:center;">
                                            <span style="font-size:10px; background:#f1f5f9; padding:2px 4px; border-radius:4px;">{{ $item->kolom5_kondisi }}</span>
                                        </td>

                                        <td>
                                            <ul class="ul-dense">
                                                @if($item->kategori == 'K3' || $item->kategori == 'KO')
                                                    @foreach($item->kolom6_bahaya['details'] ?? [] as $bh) <li>{{ $bh }}</li> @endforeach
                                                    @if(!empty($item->kolom6_bahaya['manual'])) <li>{{ $item->kolom6_bahaya['manual'] }}</li> @endif
                                                @elseif($item->kategori == 'Lingkungan')
                                                    @foreach($item->kolom7_aspek_lingkungan['details'] ?? ($item->kolom7_aspek_lingkungan ?? []) as $asp) <li>{{ $asp }}</li> @endforeach
                                                @elseif($item->kategori == 'Keamanan')
                                                    @foreach($item->kolom8_ancaman['details'] ?? ($item->kolom8_ancaman ?? []) as $anc) <li>{{ $anc }}</li> @endforeach
                                                @endif
                                            </ul>
                                        </td>
                                        <td>
                                            {{ ($item->kategori == 'K3' || $item->kategori == 'KO') ? ($item->kolom9_risiko_k3ko ?? $item->kolom9_risiko) : 
                                               (($item->kategori == 'Lingkungan') ? ($item->kolom9_dampak_lingkungan ?? $item->kolom9_risiko) : '-') }}
                                        </td>
                                        <td class="section-border-right">
                                            @if($item->kolom17_risiko) <div><strong>(-)</strong> {{ $item->kolom17_risiko }}</div> @endif
                                            @if($item->kolom17_peluang) <div style="margin-top:2px;"><strong>(+)</strong> {{ $item->kolom17_peluang }}</div> @endif
                                        </td>

                                        <td>
                                            <ul class="ul-dense">
                                            @foreach($item->kolom10_pengendalian['hierarchy'] ?? [] as $h) <li>{{ $h }}</li> @endforeach
                                            </ul>
                                        </td>
                                        <td class="section-border-right">{{ $item->kolom11_existing }}</td>

                                        <td style="text-align:center;">{{ $item->kolom12_kemungkinan }}</td>
                                        <td style="text-align:center;">{{ $item->kolom13_konsekuensi }}</td>
                                        <td class="section-border-right" style="text-align:center;">
                                            <div class="risk-badge {{ $item->kolom14_score >= 15 ? 'bg-high' : ($item->kolom14_score >= 8 ? 'bg-med' : 'bg-low') }}">
                                                {{ $item->kolom14_score }}
                                            </div>
                                        </td>

                                        <td class="section-border-right">{{ $item->kolom15_regulasi }}</td>
                                        <td class="section-border-right" style="text-align:center;">
                                            {{ $item->kategori == 'Lingkungan' ? $item->kolom16_aspek : '-' }}
                                        </td>

                                        <td>
                                            @if($item->kolom18_toleransi == 'Tidak')
                                                {{ $item->kolom19_pengendalian_lanjut }}
                                            @else
                                                <span style="color:#94a3b8;">-</span>
                                            @endif
                                        </td>
                                        
                                        @if($item->kolom18_toleransi == 'Tidak')
                                            <td style="text-align:center;">{{ $item->kolom20_kemungkinan_lanjut }}</td>
                                            <td style="text-align:center;">{{ $item->kolom21_konsekuensi_lanjut }}</td>
                                            <td style="text-align:center;">
                                                <div class="risk-badge {{ $item->kolom22_tingkat_risiko_lanjut >= 15 ? 'bg-high' : ($item->kolom22_tingkat_risiko_lanjut >= 8 ? 'bg-med' : 'bg-low') }}">
                                                    {{ $item->kolom22_tingkat_risiko_lanjut }}
                                                </div>
                                            </td>
                                        @else
                                            <td style="text-align:center;">{{ $item->residual_kemungkinan }}</td>
                                            <td style="text-align:center;">{{ $item->residual_konsekuensi }}</td>
                                            <td style="text-align:center;">
                                                @if($item->residual_score)
                                                <div class="risk-badge {{ $item->residual_score >= 15 ? 'bg-high' : ($item->residual_score >= 8 ? 'bg-med' : 'bg-low') }}">
                                                    {{ $item->residual_score }}
                                                </div>
                                                @else - @endif
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="25" style="text-align:center; padding:30px;">
                                        <div style="font-size:16px; color:#94a3b8; font-weight:600;">Tidak ada data dokumen ditemukan.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>