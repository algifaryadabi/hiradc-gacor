<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen - Kepala Departemen</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            /* Palette Modern (Slate & Primary Red) */
            --primary: #e11d48; /* Rose 600 */
            --primary-hover: #be123c; /* Rose 700 */
            --primary-light: #fff1f2; /* Rose 50 */
            --primary-soft: #ffe4e6; /* Rose 100 */
            
            --bg-body: #f8fafc; /* Slate 50 */
            --surface: #ffffff;
            
            --text-main: #0f172a; /* Slate 900 */
            --text-sub: #64748b; /* Slate 500 */
            --text-light: #94a3b8; /* Slate 400 */
            
            --border: #e2e8f0; /* Slate 200 */
            
            /* Modern Status Colors */
            --success: #10b981;
            --success-bg: #ecfdf5;
            --warning: #f59e0b;
            --warning-bg: #fffbeb;
            --danger: #ef4444;
            --danger-bg: #fef2f2;
            --info: #3b82f6;
            --info-bg: #eff6ff;
            
            /* Shadows for Depth */
            --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            padding-bottom: 120px;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
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
            font-family: 'Inter', sans-serif;
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
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        /* User Info at Bottom */
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
            margin-left: 250px;
            padding: 32px 48px;
            min-height: 100vh;
        }

        .back-nav {
            margin-bottom: 32px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--text-sub);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            padding: 8px 16px;
            background: white;
            border-radius: 100px;
            border: 1px solid var(--border);
            transition: all 0.2s;
            box-shadow: var(--shadow-xs);
        }

        .back-link:hover {
            color: var(--text-main);
            border-color: var(--text-sub);
            transform: translateX(-4px);
        }

        /* Cards */
        .passport-card {
            background: white;
            border-radius: 16px;
            padding: 20px 28px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            margin-bottom: 28px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 28px;
        }

        .pp-profile-group {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .pp-avatar-box {
            width: 56px;
            height: 56px;
            background: var(--bg-body);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: var(--text-main);
            font-size: 20px;
            border: 1px solid var(--border);
        }

        .pp-info h2 {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .pp-info p {
            font-size: 13px;
            color: var(--text-sub);
            font-weight: 500;
        }

        .pp-meta-group {
            display: flex;
            gap: 40px;
            border-left: 1px solid var(--border);
            border-right: 1px solid var(--border);
            padding: 0 40px;
        }

        .pp-stat-block {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .pp-stat-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-sub);
            font-weight: 600;
        }

        .pp-stat-value {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pp-status-badge {
            padding: 8px 20px;
            border-radius: 100px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .status-pending { background: var(--warning-bg); color: #d97706; border: 1px solid var(--warning); }
        .status-approved { background: var(--success-bg); color: #059669; border: 1px solid var(--success); }
        .status-revision { background: var(--danger-bg); color: #dc2626; border: 1px solid var(--danger); }

        /* Document Styling */
        .doc-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .card-header-slim {
            padding: 20px 24px;
            background: #f8fafc;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-header-slim h2 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
        }

        .card-header-slim i {
            color: var(--primary);
            font-size: 18px;
        }

        .doc-body {
            padding: 24px;
        }

        .doc-title-block {
            background: white;
            border-radius: 16px 16px 0 0;
            border: 1px solid var(--border);
            border-bottom: none;
            padding: 20px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .doc-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-sub);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }

        .doc-main-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1.4;
        }

        /* Modern Table */
        .table-wrapper {
            background: white;
            border: 1px solid var(--border);
            border-top: none;
            border-radius: 0 0 20px 20px;
            overflow-x: auto;
            position: relative;
            box-shadow: var(--shadow-lg);
        }

        .hiradc-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 14px;
            min-width: 2200px;
        }

        .hiradc-table th {
            background: #1e293b;
            color: white;
            padding: 12px 14px;
            font-weight: 600;
            text-align: left;
            position: sticky;
            top: 0;
            z-index: 10;
            border-right: 1px solid #334155;
            border-bottom: 1px solid #334155;
            white-space: nowrap;
        }
        
        .hiradc-table td {
            padding: 14px;
            border-bottom: 1px solid var(--border);
            border-right: 1px solid var(--border);
            color: var(--text-main);
            vertical-align: top;
            line-height: 1.5;
        }

        .hiradc-table tr:hover td {
            background: #f8fafc;
        }

        .section-divider {
            border-right: 4px solid #cbd5e1 !important;
        }

        /* Action Bar */
        .action-bar {
            position: fixed;
            bottom: 0;
            left: 250px;
            right: 0;
            background: white;
            padding: 18px 48px;
            border-top: 1px solid var(--border);
            box-shadow: 0 -4px 20px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 20px;
            z-index: 100;
        }

        .note-input-wrapper {
            flex: 1;
        }

        .note-input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid var(--border);
            font-family: inherit;
            font-size: 14px;
            background: var(--bg-body);
            transition: all 0.2s;
        }

        .note-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-soft);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-revise {
            background: white;
            color: var(--danger);
            border: 1px solid var(--danger);
        }

        .btn-revise:hover {
            background: var(--danger-bg);
            transform: translateY(-2px);
        }

        .btn-approve {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.4);
        }

        .btn-approve:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(225, 29, 72, 0.5);
        }
        
        .btn-disabled {
            background: #e2e8f0;
            color: #94a3b8;
            cursor: not-allowed;
            border: none;
            box-shadow: none;
        }

        /* Timeline Remake */
        .history-card {
            background: white;
            border-radius: 24px;
            border: 1px solid var(--border);
            padding: 40px;
            margin-top: 40px;
            box-shadow: var(--shadow-sm);
        }

        .timeline {
            position: relative;
            padding-left: 30px;
            margin-top: 30px;
        }

        .timeline::before {
            left: 5px;
            background: #e2e8f0;
            width: 3px;
        }

        .timeline-item {
            padding-left: 40px;
            padding-bottom: 40px;
        }

        .timeline-dot {
            left: -4px;
            width: 22px;
            height: 22px;
            border-width: 4px;
        }
        
        .timeline-content {
            background: #f8fafc;
            border: 1px solid var(--border);
            padding: 24px;
            border-radius: 16px;
            transition: transform 0.2s;
        }
        
        .timeline-content:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: #cbd5e1;
        }

    </style>
</head>

<body>
    <div class="layout-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('kepala_departemen.dashboard') }}" class="nav-item">
                    <i class="fas fa-th-large"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('kepala_departemen.check_documents') }}" class="nav-item active">
                    <i class="fas fa-file-signature"></i><span>Review Dokumen</span>
                </a>
            </nav>
            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">{{ substr(Auth::user()->nama_user ?? Auth::user()->username, 0, 2) }}</div>
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->nama_user }}</div>
                        <div class="user-role">{{ Auth::user()->departemen->nama_dept ?? 'Kepala Departemen' }}</div>
                        <div class="user-role" style="font-weight: normal; opacity: 0.8;">
                            {{ Auth::user()->unit_or_dept_name }} 
                        </div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="back-nav">
                <a href="{{ route('kepala_departemen.check_documents') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Dokumen
                </a>
            </div>

            <!-- Passport Card -->
            <div class="passport-card">
                <div class="pp-profile-group">
                    <div class="pp-avatar-box">
                        {{ optional($document->user)->nama_user ? strtoupper(substr($document->user->nama_user, 0, 2)) : 'U' }}
                    </div>
                    <div class="pp-info">
                        <h2>{{ optional($document->user)->nama_user ?? 'Unknown User' }}</h2>
                        <p>{{ optional($document->unit)->nama_unit ?? 'Unit Tidak Diketahui' }}</p>
                    </div>
                </div>

                <div class="pp-meta-group">
                    <div class="pp-stat-block">
                        <span class="pp-stat-label">Tanggal Submit</span>
                        <div class="pp-stat-value">
                            <i class="far fa-calendar-alt" style="color:var(--text-sub);"></i>
                            {{ $document->created_at->format('d M Y') }}
                        </div>
                    </div>
                    <div class="pp-stat-block">
                        <span class="pp-stat-label">Departemen</span>
                        <div class="pp-stat-value">
                            <i class="far fa-building" style="color:var(--text-sub);"></i>
                            {{ optional(optional($document->user)->departemen)->nama_dept ?? '-' }}
                        </div>
                    </div>
                </div>

                @php
                    $statusClass = 'status-pending';
                    $statusLabel = 'Menunggu';
                    if ($document->status == 'approved' || $document->status == 'published') {
                        $statusClass = 'status-approved';
                        $statusLabel = 'Disetujui';
                    } elseif ($document->status == 'revision') {
                        $statusClass = 'status-revision';
                        $statusLabel = 'Revisi';
                    }
                @endphp

                <div class="pp-status-badge {{ $statusClass }}">
                    {{ $statusLabel }}
                </div>
            </div>

            <!-- Document Content -->
            <form id="reviewForm" method="POST" action="">
                @csrf
                <input type="hidden" name="catatan" id="catatan_hidden">

                <div class="doc-title-block">
                    <div>
                        <div class="doc-label">Judul Dokumen</div>
                        <div class="doc-main-title">{{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</div>
                    </div>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <a href="{{ route('documents.export.detail.pdf', $document->id) }}" target="_blank" style="padding: 6px 12px; background: #e74c3c; color: white; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: flex; align-items: center;">
                            <i class="fas fa-file-pdf" style="margin-right: 5px;"></i> PDF
                        </a>
                        <a href="{{ route('documents.export.detail.excel', $document->id) }}" target="_blank" style="padding: 6px 12px; background: #27ae60; color: white; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: flex; align-items: center;">
                            <i class="fas fa-file-excel" style="margin-right: 5px;"></i> Excel
                        </a>
                        <div class="risk-pill" style="background:var(--primary); font-size:13px; padding:6px 12px;">
                            HIRADC
                        </div>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="hiradc-table">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width: 50px; text-align:center;">No</th>
                                <th colspan="4" class="section-divider" style="text-align:center;">Kegiatan & Situasi</th>
                                <th colspan="3" class="section-divider" style="text-align:center;">Identifikasi Bahaya & Risiko</th>
                                <th colspan="2" class="section-divider" style="text-align:center;">Pengendalian Risiko</th>
                                <th colspan="3" class="section-divider" style="text-align:center;">Penilaian Risiko Awal</th>
                                <th rowspan="2" class="section-divider" style="width: 250px;">Peraturan / Regulasi</th>
                                <th colspan="5">Penilaian Risiko Sisa</th>
                            </tr>
                            <tr>
                                <!-- Kegiatan -->
                                <th style="min-width: 200px;">Kegiatan</th>
                                <th style="min-width: 100px;">Kategori</th>
                                <th style="min-width: 150px;">Lokasi</th>
                                <th class="section-divider" style="min-width: 100px;">Kondisi</th>
                                
                                <!-- Identifikasi -->
                                <th style="min-width: 250px;">Potensi Bahaya</th>
                                <th style="min-width: 220px;">Dampak</th>
                                <th class="section-divider" style="min-width: 220px;">Risiko/Peluang</th>
                                
                                <!-- Pengendalian -->
                                <th style="min-width: 300px;">Hirarki Pengendalian</th>
                                <th class="section-divider" style="min-width: 250px;">Pengendalian Existing</th>
                                
                                <!-- Awal -->
                                <th style="width: 60px; text-align:center;">L</th>
                                <th style="width: 60px; text-align:center;">S</th>
                                <th class="section-divider" style="width: 100px; text-align:center;">Level</th>
                                
                                <!-- Sisa -->
                                <th style="min-width: 200px;">Tindak Lanjut</th>
                                <th style="width: 60px; text-align:center;">L</th>
                                <th style="width: 60px; text-align:center;">S</th>
                                <th style="width: 60px; text-align:center;">R</th>
                                <th style="width: 100px; text-align:center;">Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($document->details as $index => $item)
                                @php 
                                    $bahaya = is_array($item->kolom6_bahaya) ? $item->kolom6_bahaya : [];
                                    $pengendalian = is_array($item->kolom10_pengendalian) ? $item->kolom10_pengendalian : [];
                                    $bahayaList = $bahaya['details'] ?? [];
                                    $hierarchyList = $pengendalian['hierarchy'] ?? [];
                                    if (!is_array($bahayaList)) $bahayaList = [];
                                    if (!is_array($hierarchyList)) $hierarchyList = [];
                                    
                                    // Risk Color Logic
                                    $initialScore = $item->kolom14_score;
                                    $initialColor = $initialScore >= 15 ? '#ef4444' : ($initialScore >= 8 ? '#f59e0b' : '#10b981');
                                    $initialLevel = $initialScore >= 15 ? 'HIGH' : ($initialScore >= 8 ? 'MED' : 'LOW');

                                    $residualScore = $item->residual_score;
                                    $residualColor = $residualScore >= 15 ? '#ef4444' : ($residualScore >= 8 ? '#f59e0b' : '#10b981');
                                    $residualLevel = $residualScore >= 15 ? 'HIGH' : ($residualScore >= 8 ? 'MED' : 'LOW');
                                @endphp
                                <tr>
                                    <td style="text-align:center;">{{ $index + 1 }}</td>
                                    <td>{{ $item->kolom2_kegiatan }}</td>
                                    <td><span style="background:#f1f5f9; padding:2px 6px; border-radius:4px; font-weight:600; font-size:12px;">{{ $item->kategori }}</span></td>
                                    <td>{{ $item->kolom3_lokasi }}</td>
                                    <td class="section-divider">{{ $item->kolom5_kondisi }}</td>
                                    
                                    <td>
                                        <div style="font-weight:600; font-size:12px; color:var(--text-sub); margin-bottom:4px;">{{ $bahaya['type'] ?? '-' }}</div>
                                        <ul style="padding-left:16px; margin:0;">
                                            @foreach($bahayaList as $d) <li>{{ $d }}</li> @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $item->kolom7_dampak }}</td>
                                    <td class="section-divider">
                                        @if($item->kolom17_risiko) <div style="color:#ef4444; font-weight:500; margin-bottom:4px;"><i class="fas fa-minus-circle"></i> {{ $item->kolom17_risiko }}</div> @endif
                                        @if($item->kolom17_peluang) <div style="color:#10b981; font-weight:500;"><i class="fas fa-plus-circle"></i> {{ $item->kolom17_peluang }}</div> @endif
                                    </td>
                                    
                                    <td>
                                        <div style="display:flex; flex-wrap:wrap; gap:4px;">
                                            @foreach($hierarchyList as $h) 
                                                <span style="background:#eff6ff; color:#1d4ed8; padding:4px 8px; border-radius:6px; font-size:11px; font-weight:600; border:1px solid #dbeafe;">{{ $h }}</span> 
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="section-divider">{{ $item->kolom11_existing }}</td>
                                    
                                    <td style="text-align:center;">{{ $item->kolom12_kemungkinan }}</td>
                                    <td style="text-align:center;">{{ $item->kolom13_konsekuensi }}</td>
                                    <td class="section-divider" style="text-align:center;">
                                        <div class="risk-pill" style="background:{{ $initialColor }}">{{ $initialLevel }}</div>
                                    </td>
                                    
                                    <td class="section-divider">{{ $item->kolom15_regulasi }}</td>
                                    
                                    <td>{{ $item->kolom18_tindak_lanjut }}</td>
                                    <td style="text-align:center;">{{ $item->residual_kemungkinan }}</td>
                                    <td style="text-align:center;">{{ $item->residual_konsekuensi }}</td>
                                    <td style="text-align:center;">{{ $item->residual_score }}</td>
                                    <td style="text-align:center;">
                                        <div class="risk-pill" style="background:{{ $residualColor }}">{{ $residualLevel }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Compliance Checklist (Read Only) -->
                <div class="doc-card" style="margin-top: 40px;">
                    <div class="card-header-slim">
                        <i class="fas fa-clipboard-check"></i>
                        <h2>Tabel Kesesuaian (Compliance Checklist)</h2>
                    </div>
                    <div class="doc-body" style="padding: 0;">
                        <div class="table-wrapper" style="box-shadow: none; border: none; border-radius: 0;">
                            <table class="hiradc-table">
                                <thead>
                                    <tr>
                                        <th style="width: 60px; text-align: center;">No</th>
                                        <th style="min-width: 300px;">Kriteria</th>
                                        <th style="width: 200px; text-align: center;">Kesesuaian</th>
                                        <th style="min-width: 200px;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $complianceCriteria = [
                                             ['key' => 'format', 'label' => 'Standar Format'],
                                             ['key' => 'numbering', 'label' => 'Penomoran Dokumen'],
                                             ['key' => 'revision', 'label' => 'Kemutakhiran Nomor Revisi'],
                                             ['key' => 'approval', 'label' => 'Approval Dokumen'],
                                             ['key' => 'identification_coverage', 'label' => 'Ident. sdh mencakup semua proses bisnis/kegiatan/aset'],
                                             ['key' => 'condition_coverage', 'label' => 'Ident. sdh mencakup semua kondisi (R, NR, N, TN & E)'],
                                             ['key' => 'mitigation', 'label' => 'Kesesuaian Program Mitigasi']
                                        ];
                                        $existingCompliance = $document->compliance_checklist ? json_decode($document->compliance_checklist, true) : [];
                                    @endphp

                                    @foreach($complianceCriteria as $index => $criteria)
                                        @php
                                            $savedStatus = $existingCompliance[$criteria['key']]['status'] ?? '-';
                                            $savedNote = $existingCompliance[$criteria['key']]['note'] ?? '-';
                                            
                                            $badgeClass = 'background: #f1f5f9; color: #64748b;';
                                            $statusIcon = '';
                                            
                                            if ($savedStatus === 'OK') {
                                                $badgeClass = 'background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;';
                                                $statusIcon = '✓';
                                            } elseif ($savedStatus === 'NOK') {
                                                $badgeClass = 'background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;';
                                                $statusIcon = '✗';
                                            } elseif ($savedStatus === 'Tdk Penting') {
                                                $badgeClass = 'background: #fffbeb; color: #d97706; border: 1px solid #fde68a;';
                                                $statusIcon = '⚠';
                                            }
                                        @endphp
                                        <tr>
                                            <td style="text-align: center; color: var(--text-light); font-weight: 600;">
                                                {{ $index + 1 }}
                                            </td>
                                            <td style="font-weight: 600; color: var(--text-main);">
                                                {{ $criteria['label'] }}
                                            </td>
                                            <td style="text-align: center;">
                                                <span style="display: inline-block; padding: 6px 16px; border-radius: 100px; font-size: 13px; font-weight: 700; {{ $badgeClass }}">
                                                    {{ $statusIcon }} {{ $savedStatus }}
                                                </span>
                                            </td>
                                            <td style="color: var(--text-sub);">
                                                {{ $savedNote }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Sticky Action Bar -->
                @if($document->status === 'pending_level3')
                <div class="action-bar">
                    <div class="note-input-wrapper">
                        <input type="text" id="catatan_ui" class="note-input" placeholder="Tulis catatan (Opsional untuk Approve, Wajib untuk Revisi)...">
                    </div>
                    <button type="button" class="btn btn-revise" onclick="submitAction('revise')">
                        <i class="fas fa-undo"></i> Minta Revisi
                    </button>
                    <button type="button" class="btn btn-approve" onclick="submitAction('approve')">
                        <i class="fas fa-check"></i> Publikasikan Dokumen
                    </button>
                </div>
                @else
                <div class="action-bar" style="justify-content:center;">
                    <button type="button" class="btn btn-disabled" disabled>
                        <i class="fas fa-lock"></i> Mode Read Opsional ({{ $statusLabel }})
                    </button>
                </div>
                @endif
            </form>

            <!-- Approval History -->
            <div class="history-card">
                <div class="section-heading">
                    <i class="fas fa-history" style="color:var(--primary);"></i>
                    Riwayat Persetujuan
                </div>

                <div class="timeline">
                    {{-- 1. Create Event (Manual Injection) --}}
                    @php
                        $createdEvent = (object) [
                            'created_at' => $document->created_at,
                            'approver' => $document->user, // The creator
                            'action' => 'created',
                            'catatan' => 'Dokumen baru diajukan',
                            'is_first' => true
                        ];
                        
                        // Merge with actual approvals
                        $allHistory = collect([$createdEvent])->merge($document->approvals->sortBy('created_at'));
                        // Sort Descending for Timeline (Newest Top)
                        $displayHistory = $allHistory->sortByDesc('created_at')->values();
                    @endphp

                    @forelse($displayHistory as $index => $log)
                        @php
                            $isFirst = $index === 0;
                            $actionLabel = 'Aksi Tidak Diketahui';
                            $actionColor = 'var(--text-sub)';
                            $icon = 'fa-circle';

                            switch($log->action) {
                                case 'created':
                                    $actionLabel = 'Form Dibuat';
                                    $actionColor = '#3b82f6'; // Blue
                                    $icon = 'fa-file-medical';
                                    break;
                                case 'approved':
                                    $actionLabel = ($log->level == 3) ? 'Dipublikasikan' : 'Disetujui';
                                    $actionColor = '#10b981'; // Green
                                    $icon = 'fa-check-circle';
                                    break;
                                case 'revision':
                                    $actionLabel = 'Dikembalikan untuk Revisi';
                                    $actionColor = '#ef4444'; // Red
                                    $icon = 'fa-undo';
                                    break;
                                case 'disposition':
                                    $actionLabel = 'Didisposisi ke Staff';
                                    $actionColor = '#f59e0b'; // Orange
                                    $icon = 'fa-user-clock';
                                    break;
                                case 'reviewed':
                                    $actionLabel = 'Direview oleh Staff';
                                    $actionColor = '#8b5cf6'; // Violet
                                    $icon = 'fa-glasses';
                                    break;
                                case 'verified':
                                    $actionLabel = 'Diverifikasi oleh Staff';
                                    $actionColor = '#06b6d4'; // Cyan
                                    $icon = 'fa-clipboard-check';
                                    break;
                                default:
                                    $actionLabel = ucfirst($log->action);
                            }
                        @endphp

                        <div class="timeline-item {{ $isFirst ? 'active' : '' }}">
                            <div class="timeline-dot" style="{{ $isFirst ? 'border-color:'.$actionColor : '' }}"></div>
                            <div class="timeline-date">{{ $log->created_at->format('d M Y, H:i') }} WIB</div>
                            <div class="timeline-content">
                                <div class="timeline-user">
                                    {{ optional($log->approver)->nama_user ?? 'System' }} 
                                    <span style="font-weight:400; color:var(--text-sub);">
                                        • {{ optional($log->approver)->role_jabatan_name ? $log->approver->role_jabatan_name : ($log->action == 'created' ? 'Submitter' : '-') }}
                                    </span>
                                </div>
                                <div class="timeline-action">
                                    <span style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; background:{{ $actionColor }}15; color:{{ $actionColor }}; border-radius:100px; font-weight:700; font-size:12px; border:1px solid {{ $actionColor }}30;">
                                        <i class="fas {{ $icon }}"></i> {{ $actionLabel }}
                                    </span>
                                </div>
                                @if($log->catatan)
                                <div class="timeline-note" style="margin-top:12px; padding:12px; background:white; border-radius:8px; border:1px solid var(--border); color:var(--text-main); font-style:normal;">
                                    "{{ $log->catatan }}"
                                </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div style="padding-left:20px; color:var(--text-sub);">Belum ada riwayat.</div>
                    @endforelse
                </div>
            </div>

        </main>
    </div>

    <script>
        function submitAction(type) {
            const noteUI = document.getElementById('catatan_ui');
            const noteCommon = noteUI.value.trim();
            const form = document.getElementById('reviewForm');
            const noteHidden = document.getElementById('catatan_hidden');

            if (type === 'revise' && noteCommon.length < 5) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Catatan Diperlukan',
                    text: 'Untuk meminta revisi, Anda wajib memberikan catatan minimal 5 karakter.',
                    confirmButtonColor: '#c41e3a'
                });
                return;
            }

            const actionText = type === 'approve' ? 'Publikasikan' : 'Kembalikan untuk Revisi';
            const actionColor = type === 'approve' ? '#16a34a' : '#dc2626';
            const actionUrl = type === 'approve' 
                ? "{{ route('kepala_departemen.publish', $document->id) }}"
                : "{{ route('kepala_departemen.revise', $document->id) }}";

            Swal.fire({
                title: 'Konfirmasi',
                text: `Apakah Anda yakin ingin ${actionText} dokumen ini?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: actionColor,
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    noteHidden.value = noteCommon;
                    form.action = actionUrl;
                    form.submit();
                }
            });
        }
    </script>
</body>
</html>