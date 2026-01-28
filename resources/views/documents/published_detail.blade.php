<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Dokumen Terpublikasi - HIRADC</title>
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
            padding-bottom: 60px;
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
            z-index: 100;
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
            color: #666;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
        }

        .nav-item:hover { background: #fff5f5; color: #c41e3a; }
        .nav-item.active { background: #ffe5e5; color: #c41e3a; border-left: 3px solid #c41e3a; }
        .nav-item i { width: 20px; text-align: center; }

        /* User Info Bottom */
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

        /* Passport Card */
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

        .status-published { background: #ecfdf5; color: #059669; border: 1px solid #10b981; }

        /* Doc Content */
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
            margin-bottom: 40px;
        }

        .excel-table {
            width: max-content;
            min-width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .excel-table th {
            background: #0f172a;
            color: white;
            padding: 12px;
            border-right: 1px solid #334155;
            border-bottom: 1px solid #334155;
            text-align: center;
            font-weight: 600;
            font-size: 13px;
            white-space: nowrap;
        }

        .excel-table td {
            padding: 14px;
            border-bottom: 1px solid var(--border);
            border-right: 1px solid var(--border);
            color: var(--text-main);
            vertical-align: top;
            line-height: 1.5;
            font-size: 13.5px;
        }

        .section-border-right { border-right: 3px solid #94a3b8 !important; }

        /* Risk Scoring Boxes */
        .risk-score-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 50px;
        }
        .risk-val { font-size: 16px; font-weight: 800; color: var(--text-main); }
        .risk-badge { 
            font-size: 10px; padding: 2px 8px; border-radius: 10px; margin-top: 4px; 
            font-weight: 700; color: white; text-transform: uppercase;
        }
        .bg-low { background: #16a34a; }
        .bg-med { background: #ca8a04; }
        .bg-high { background: #dc2626; }

        .cell-checkbox-group { display: flex; flex-direction: column; gap: 4px; }
        .cell-checkbox-item { display: flex; align-items: flex-start; gap: 8px; font-size: 13px; }
        .cell-checkbox-item i { margin-top: 3px; font-size: 10px; }
        
        .doc-meta-badge {
            display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px;
            border-radius: 100px; font-size: 12px; font-weight: 700;
        }
        .risk-section { display: flex; flex-direction: column; gap: 4px; }
        .risk-label { font-size: 10px; font-weight: 800; color: var(--text-sub); text-transform: uppercase; }
        .risk-text { font-size: 13px; color: var(--text-main); font-weight: 500; }

        /* Compliance Checklist */
        .compliance-card {
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
        .card-header-slim h2 { font-size: 16px; font-weight: 700; color: var(--text-main); }
        .card-header-slim i { color: var(--primary); font-size: 18px; }

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
            content: '';
            position: absolute;
            left: 5px;
            top: 0;
            bottom: 0;
            background: #e2e8f0;
            width: 3px;
        }

        .timeline-item {
            position: relative;
            padding-left: 40px;
            padding-bottom: 40px;
        }

        .timeline-dot {
            position: absolute;
            left: -4px;
            top: 5px;
            width: 22px;
            height: 22px;
            background: white;
            border: 4px solid #e2e8f0;
            border-radius: 50%;
            z-index: 1;
        }
        
        .timeline-item.active .timeline-dot { border-color: var(--primary); }

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

        .timeline-date { font-size: 12px; font-weight: 600; color: var(--text-light); text-transform: uppercase; margin-bottom: 8px; }
        .timeline-user { font-size: 15px; font-weight: 700; color: var(--text-main); margin-bottom: 4px; }
        .timeline-action { margin-top: 8px; }

        @media print {
            .sidebar, .back-nav { display: none !important; }
            .main-content { margin-left: 0 !important; }
        }
    </style>
</head>

<body>
    <div class="layout-container">
        <!-- Dynamic Sidebar -->
        @php
            $currentUser = Auth::user();
            $role = $currentUser->getRoleName();
        @endphp

        <aside class="sidebar">
            @if($role == 'approver')
                @include('approver.partials.sidebar')
            @elseif($role == 'user')
                @include('user.partials.sidebar')
            @elseif($role == 'admin')
                @include('admin.partials.sidebar')
            @else
                {{-- Fallback sidebar for Unit Pengelola, Kepala Departemen, and others --}}
                <div class="logo-section">
                    <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
                    <div class="logo-text">PT Semen Padang</div>
                    <div class="logo-subtext">HIRADC System</div>
                </div>

                <nav class="nav-menu">
                    @if($role == 'unit_pengelola')
                        <a href="{{ route('unit_pengelola.dashboard') }}" class="nav-item">
                            <i class="fas fa-th-large"></i><span>Dashboard</span>
                        </a>
                        <a href="{{ route('unit_pengelola.documents.index') }}" class="nav-item">
                            <i class="fas fa-file-alt"></i><span>Inbox Dokumen</span>
                        </a>
                    @elseif($role == 'kepala_departemen')
                        <a href="{{ route('kepala_departemen.dashboard') }}" class="nav-item">
                            <i class="fas fa-th-large"></i><span>Dashboard</span>
                        </a>
                        <a href="{{ route('kepala_departemen.check_documents') }}" class="nav-item">
                            <i class="fas fa-file-contract"></i><span>Review Dokumen</span>
                        </a>
                    @else
                        <a href="{{ route(auth()->user()->getDashboardRoute()) }}" class="nav-item active">
                            <i class="fas fa-th-large"></i><span>Dashboard</span>
                        </a>
                    @endif
                </nav>
            @endif

            {{-- User Info Section --}}
            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->nama_user ?? Auth::user()->username, 0, 2)) }}
                    </div>
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->nama_user ?? Auth::user()->username }}</div>
                        <div class="user-role">{{ Auth::user()->role_jabatan_name }}</div>
                        <div class="user-role" style="font-weight: normal; opacity: 0.8;">
                            {{ Auth::user()->unit_or_dept_name }}
                        </div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form-published').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    Keluar
                </a>
                <form id="logout-form-published" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="back-nav">
                <a href="{{ route(auth()->user()->getDashboardRoute()) }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>

            <!-- Passport Card -->
            <div class="passport-card">
                <div class="pp-profile-group">
                    <div class="pp-avatar-box">
                        {{ optional($document->user)->nama_user ? strtoupper(substr($document->user->nama_user, 0, 2)) : 'U' }}
                    </div>
                    <div class="pp-info">
                        <h2>{{ optional($document->user)->nama_user ?? 'Unknown' }}</h2>
                        <p>{{ optional($document->unit)->nama_unit ?? 'Unit Tidak Diketahui' }}</p>
                    </div>
                </div>

                <div class="pp-meta-group">
                    <div class="pp-stat-block">
                        <span class="pp-stat-label">Tanggal Publish</span>
                        <div class="pp-stat-value">
                            <i class="far fa-calendar-check" style="color:var(--text-sub);"></i>
                            {{ $document->published_at ? $document->published_at->format('d M Y') : '-' }}
                        </div>
                    </div>
                    <div class="pp-stat-block">
                        <span class="pp-stat-label">Seksi</span>
                        <div class="pp-stat-value">
                            <i class="far fa-building" style="color:var(--text-sub);"></i>
                            {{ optional($document->seksi)->nama_seksi ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="pp-status-badge status-published">
                    TERPUBLIKASI
                </div>
            </div>

            <!-- Document Title Block -->
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
                </div>
            </div>

            <div class="table-wrapper">
                @php
                    $showShe = $document->hasSheContent();
                    $showSec = $document->hasSecurityContent();
                    
                    // Colspan Calculation
                    // Start with 1 (Kondisi)
                    $b2_colspan = 1; 
                    if($showShe) $b2_colspan += 4; // Potensi(1) + Aspek(1) + Risiko(1) + Dampak(1)
                    if($showSec) $b2_colspan += 2; // Ancaman(1) + Celah(1)
                @endphp
                <table class="excel-table">
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 40px;">No</th>
                            <th colspan="4" class="section-border-right">BAGIAN 1: Identifikasi Aktivitas</th>
                            <th colspan="{{ $b2_colspan }}" class="section-border-right">BAGIAN 2: Identifikasi & Risiko</th>
                            <th colspan="5" class="section-border-right">BAGIAN 3: Pengendalian & Penilaian Awal</th>
                            <th colspan="3" class="section-border-right">BAGIAN 4: Legalitas & Signifikansi</th>
                            <th colspan="8">BAGIAN 5: Mitigasi Lanjutan & Risiko Sisa</th>
                        </tr>
                        <tr>
                            <th style="width: 180px;">Proses/Kegiatan</th>
                            <th style="width: 120px;">Lokasi</th>
                            <th style="width: 80px;">Kategori</th>
                            <th style="width: 90px;" class="section-border-right">Kondisi</th>
                            
                            @if($showShe)
                                <th style="width: 150px;">Potensi Bahaya</th>
                                <th style="width: 150px;">Aspek Lingkungan</th>
                            @endif
                            
                            @if($showSec)
                                <th style="width: 150px;">Ancaman Keamanan</th>
                            @endif

                            @if($showShe)
                                <th style="width: 150px;">RISIKO (K3/KO)</th>
                                <th style="width: 150px;">DAMPAK (Lingk)</th>
                            @endif

                            @if($showSec)
                                <th style="width: 150px;" class="section-border-right">CELAH (Keam)</th>
                            @endif
                            <th style="width: 250px;">Hirarki Pengendalian</th>
                            <th style="width: 250px;">Pengendalian Existing</th>
                            <th style="width: 50px;">L</th>
                            <th style="width: 50px;">S</th>
                            <th style="width: 80px;" class="section-border-right">Level</th>
                            <th style="width: 200px;">Regulasi</th>
                            <th style="width: 80px;">Aspek Penting</th>
                            <th style="width: 200px;" class="section-border-right">Peluang & Risiko</th>
                            <th style="width: 100px;">Toleransi</th>
                            <th style="width: 200px;">Pengendalian Lanjut</th>
                            <th style="width: 50px;">L</th>
                            <th style="width: 50px;">S</th>
                            <th style="width: 80px;">Level</th>
                            <th style="width: 50px;">Residual L</th>
                            <th style="width: 50px;">Residual S</th>
                            <th style="width: 80px;">Residual Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $filter = request('filter'); // 'SHE', 'Security', or null
                        @endphp
                        @foreach($document->details as $index => $item)
                            @php
                                // Determining Visibility
                                $isSheItem = in_array($item->kategori, ['K3', 'KO', 'Lingkungan']);
                                $isSecItem = ($item->kategori == 'Keamanan');
                                
                                // Default visible
                                $isVisible = true;

                                if ($filter == 'SHE') {
                                    if ($isSecItem) $isVisible = false;
                                    // Make sure we only show SHE items (K3, KO, Lingkungan)
                                    // If item is 'General'? (Usually not). 
                                } elseif ($filter == 'Security') {
                                    if ($isSheItem) $isVisible = false;
                                }
                            @endphp

                            @if($isVisible)
                        <tr>
                            <td style="text-align:center;">{{ $index + 1 }}</td>
                            <td>{{ $item->kolom2_kegiatan }}</td>
                            <td>{{ $item->kolom3_lokasi }}</td>
                            <td style="text-align:center;">
                                <span class="doc-meta-badge" style="background:#e0e7ff; color:#3730a3;">{{ $item->kategori }}</span>
                            </td>
                            <td class="section-border-right" style="text-align:center;">
                                <span class="doc-meta-badge" style="background:#f1f5f9; color:#475569;">{{ $item->kolom5_kondisi }}</span>
                            </td>

                            <!-- BAGIAN 2 -->
                            @if($showShe)
                                <td>
                                    @if($item->kategori == 'K3' || $item->kategori == 'KO')
                                        <div class="cell-checkbox-group">
                                            @php $bahayaDetails = $item->kolom6_bahaya['details'] ?? []; @endphp
                                            @foreach($bahayaDetails as $detail)
                                                <div class="cell-checkbox-item">
                                                    <i class="fas fa-exclamation-triangle" style="color:#ef4444;"></i>
                                                    <span>{{ $detail }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else - @endif
                                </td>
                                <td>
                                    @if($item->kategori == 'Lingkungan')
                                        <div class="cell-checkbox-group">
                                            @php $col7 = $item->kolom7_aspek_lingkungan ?? []; 
                                                $details7 = $col7['details'] ?? []; @endphp
                                            @foreach($details7 as $aspek)
                                                <div class="cell-checkbox-item">
                                                    <i class="fas fa-leaf" style="color:#22c55e;"></i>
                                                    <span>{{ $aspek }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else - @endif
                                </td>
                            @endif

                            @if($showSec)
                                <td>
                                    @if($item->kategori == 'Keamanan')
                                        <div class="cell-checkbox-group">
                                            @php $col8 = $item->kolom8_ancaman ?? []; 
                                                $details8 = $col8['details'] ?? []; @endphp
                                            @foreach($details8 as $threat)
                                                <div class="cell-checkbox-item">
                                                    <i class="fas fa-shield-alt" style="color:#dc2626;"></i>
                                                    <span>{{ $threat }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else - @endif
                                </td>
                            @endif

                            @if($showShe)
                                <td>{{ ($item->kategori == 'K3' || $item->kategori == 'KO') ? ($item->kolom9_risiko_k3ko ?? $item->kolom9_risiko) : '-' }}</td>
                                <td>{{ ($item->kategori == 'Lingkungan') ? ($item->kolom9_dampak_lingkungan ?? $item->kolom9_risiko) : '-' }}</td>
                            @endif

                            @if($showSec)
                                <td class="section-border-right">{{ ($item->kategori == 'Keamanan') ? ($item->kolom9_celah_keamanan ?? $item->kolom9_risiko) : '-' }}</td>
                            @endif

                            <!-- BAGIAN 3 -->
                            <td>
                                <div class="cell-checkbox-group">
                                    @php $hs = $item->kolom10_pengendalian['hierarchy'] ?? []; @endphp
                                    @foreach($hs as $h)
                                        <div class="cell-checkbox-item">
                                            <i class="fas fa-check-square" style="color:#10b981;"></i>
                                            <span style="font-weight:600;">{{ $h }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $item->kolom11_existing }}</td>
                            <td style="text-align:center; font-weight:800;">{{ $item->kolom12_kemungkinan }}</td>
                            <td style="text-align:center; font-weight:800;">{{ $item->kolom13_konsekuensi }}</td>
                            <td class="section-border-right">
                                <div class="risk-score-box">
                                    <div class="risk-val">{{ $item->kolom14_score }}</div>
                                    <div class="risk-badge {{ $item->kolom14_score >= 15 ? 'bg-high' : ($item->kolom14_score >= 8 ? 'bg-med' : 'bg-low') }}">
                                        {{ $item->kolom14_score >= 15 ? 'TINGGI' : ($item->kolom14_score >= 8 ? 'SEDANG' : 'RENDAH') }}
                                    </div>
                                </div>
                            </td>

                            <!-- BAGIAN 4 -->
                            <td>{{ $item->kolom15_regulasi }}</td>
                            <td style="text-align:center;">{{ $item->kolom16_aspek ?? '-' }}</td>
                            <td class="section-border-right">
                                <div class="risk-section">
                                    @if($item->kolom17_risiko) <div class="risk-label">RISIKO (-):</div> <div class="risk-text">{{ $item->kolom17_risiko }}</div> @endif
                                    @if($item->kolom17_peluang) <div class="risk-label" style="border-top:1px solid #e2e8f0; margin-top:6px; padding-top:6px;">PELUANG (+):</div> <div class="risk-text">{{ $item->kolom17_peluang }}</div> @endif
                                </div>
                            </td>

                            <!-- BAGIAN 5 -->
                            <td style="text-align:center;">
                                <div class="doc-meta-badge" style="{{ $item->kolom18_toleransi == 'Ya' ? 'background:#dcfce7; color:#166534;' : 'background:#fee2e2; color:#991b1b;' }}">
                                    {{ $item->kolom18_toleransi }}
                                </div>
                            </td>
                            @if($item->kolom18_toleransi == 'Tidak')
                                <td>{{ $item->kolom19_pengendalian_lanjut }}</td>
                                <td style="text-align:center; font-weight:800;">{{ $item->kolom20_kemungkinan_lanjut }}</td>
                                <td style="text-align:center; font-weight:800;">{{ $item->kolom21_konsekuensi_lanjut }}</td>
                                <td>
                                    <div class="risk-score-box">
                                        <div class="risk-val">{{ $item->kolom22_tingkat_risiko_lanjut }}</div>
                                        @if($item->kolom22_tingkat_risiko_lanjut)
                                            <div class="risk-badge {{ $item->kolom22_tingkat_risiko_lanjut >= 15 ? 'bg-high' : ($item->kolom22_tingkat_risiko_lanjut >= 8 ? 'bg-med' : 'bg-low') }}">
                                                {{ $item->kolom22_tingkat_risiko_lanjut >= 15 ? 'HIGH' : ($item->kolom22_tingkat_risiko_lanjut >= 8 ? 'MED' : 'LOW') }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            @else
                                <td colspan="4" style="text-align:center; color:#94a3b8;">-</td>
                            @endif
                            <td style="text-align:center; font-weight:800;">{{ $item->residual_kemungkinan }}</td>
                            <td style="text-align:center; font-weight:800;">{{ $item->residual_konsekuensi }}</td>
                            <td>
                                <div class="risk-score-box">
                                    <div class="risk-val">{{ $item->residual_score ?? '-' }}</div>
                                    @if($item->residual_score)
                                        <div class="risk-badge {{ $item->residual_score >= 15 ? 'bg-high' : ($item->residual_score >= 8 ? 'bg-med' : 'bg-low') }}">
                                            {{ $item->residual_score >= 15 ? 'HIGH' : ($item->residual_score >= 8 ? 'MED' : 'LOW') }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Compliance Checklist -->
            @php
                 // Determine Primary Stream based on ACTUAL FILLED DATA first
                 // Then fallback to content flags.
                 // "tabel yang muncul hanya 1... tergantung keluaran she atau security"
                 
                 $fullChecklist = $document->compliance_checklist ?? [];
                 if (!is_array($fullChecklist)) $fullChecklist = json_decode($fullChecklist, true) ?? [];
                 
                 $hasSheData = !empty($fullChecklist['she']);
                 $hasSecData = !empty($fullChecklist['security']);
                 
                 $primaryStream = 'general';
                 
                 if ($hasSheData) {
                     $primaryStream = 'she';
                 } elseif ($hasSecData) {
                     $primaryStream = 'security';
                 } else {
                     // Fallback if neither has data (legacy or just created?)
                     // Use content flags
                     if ($showShe) $primaryStream = 'she';
                     elseif ($showSec) $primaryStream = 'security';
                 }
                 
                 $checklistData = $fullChecklist[$primaryStream] ?? $fullChecklist['general'] ?? [];
                 $label = ucfirst($primaryStream);
                 if ($primaryStream == 'she') $label = 'SHE';
            @endphp

            @if(!empty($checklistData) || in_array($primaryStream, ['she', 'security']))
            <div class="compliance-card">
                <div class="card-header-slim">
                    <i class="fas fa-clipboard-check"></i>
                    <h2>Tabel Kesesuaian ({{ $label }})</h2>
                </div>
                <div class="doc-body" style="padding: 0;">
                    <div class="table-wrapper" style="box-shadow: none; border: none; border-radius: 0; margin-bottom: 0;">
                        <table class="excel-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 60px; text-align: center;">No</th>
                                    <th style="text-align: left;">Kriteria</th>
                                    <th style="width: 200px; text-align: center;">Kesesuaian</th>
                                    <th style="min-width: 200px; text-align: left;">Keterangan</th>
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
                                @endphp

                                @foreach($complianceCriteria as $index => $criteria)
                                    @php
                                        $savedStatus = $checklistData[$criteria['key']]['status'] ?? '-';
                                        $savedNote = $checklistData[$criteria['key']]['note'] ?? '-';
                                        $badgeClass = 'background: #f1f5f9; color: #64748b;';
                                        if ($savedStatus === 'OK') $badgeClass = 'background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;';
                                        elseif ($savedStatus === 'NOK') $badgeClass = 'background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;';
                                    @endphp
                                    <tr>
                                        <td style="text-align: center; color: var(--text-light); font-weight: 600;">{{ $index + 1 }}</td>
                                        <td style="font-weight: 600; color: var(--text-main);">{{ $criteria['label'] }}</td>
                                        <td style="text-align: center;">
                                            <span style="display: inline-block; padding: 6px 16px; border-radius: 100px; font-size: 13px; font-weight: 700; {{ $badgeClass }}">
                                                {{ $savedStatus }}
                                            </span>
                                        </td>
                                        <td style="color: var(--text-sub);">{{ $savedNote }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- History Section -->
            <div class="history-card">
                <div class="card-header-slim" style="background: none; border: none; padding: 0; margin-bottom: 20px;">
                    <i class="fas fa-history"></i>
                    <h2>Riwayat Persetujuan & Publikasi</h2>
                </div>

                <div class="timeline">
                    @php
                        $createdEvent = (object) [
                            'created_at' => $document->created_at,
                            'approver' => $document->user,
                            'action' => 'created',
                            'catatan' => 'Form baru diajukan'
                        ];
                        $allHistory = collect([$createdEvent])->merge($document->approvals->sortBy('created_at'));
                        $displayHistory = $allHistory->sortByDesc('created_at')->values();
                    @endphp

                    @foreach($displayHistory as $index => $log)
                        @php
                            // FILTER LOGIC FOR PUBLISHED VIEW
                            // Filter irrelevant Unit Pengelola Staff actions depending on PRIMARY STREAM
                            $shouldHide = false;
                            $approverUnit = optional($log->approver)->id_unit;
                            
                            // Check Action type: only Review/Verification by UP Staff are filtered
                            // Head of UP actions (approved/published) are typically shared or we show them.
                            // User request: "tetapi untuk riwayat yang telah di isikan oleh staff unti pengelola nya"
                            
                            if (in_array($log->action, ['reviewed', 'verified', 'revision'])) {
                                if ($primaryStream == 'she') {
                                    // Hide Security Staff (55)
                                    if ($approverUnit == 55) $shouldHide = true;
                                } elseif ($primaryStream == 'security') {
                                    // Hide SHE Staff (56)
                                    if ($approverUnit == 56) $shouldHide = true;
                                }
                            }
                            
                            if ($shouldHide) continue;
                            
                            $actionLabel = 'Aksi'; $actionColor = '#94a3b8'; $icon = 'fa-circle';
                            switch($log->action) {
                                case 'created': $actionLabel = 'Form Dibuat'; $actionColor = '#3b82f6'; $icon = 'fa-file-medical'; break;
                                case 'approved': $actionLabel = ($log->level == 3 || $document->status == 'published') ? 'Dipublikasikan' : 'Disetujui'; $actionColor = '#10b981'; $icon = 'fa-check-circle'; break;
                                case 'revision': $actionLabel = 'Revisi'; $actionColor = '#ef4444'; $icon = 'fa-undo'; break;
                                case 'disposition': $actionLabel = 'Disposisi'; $actionColor = '#f59e0b'; $icon = 'fa-user-clock'; break;
                                case 'reviewed': $actionLabel = 'Review Staff'; $actionColor = '#8b5cf6'; $icon = 'fa-glasses'; break;
                                case 'verified': $actionLabel = 'Verifikasi'; $actionColor = '#06b6d4'; $icon = 'fa-clipboard-check'; break;
                            }
                        @endphp
                        <div class="timeline-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="timeline-dot" style="{{ $index === 0 ? 'border-color:'.$actionColor : '' }}"></div>
                            <div class="timeline-date">{{ $log->created_at->format('d M Y, H:i') }} WIB</div>
                            <div class="timeline-content">
                                <div class="timeline-user">
                                    {{ optional($log->approver)->nama_user ?? 'System' }} 
                                    <div style="font-weight:400; color:var(--text-sub); font-size: 12px; margin-top: 2px;">
                                        {{ optional($log->approver)->role_jabatan_name ?? ($log->action == 'created' ? 'Submitter' : '-') }}
                                        • {{ optional($log->approver)->unit_or_dept_name ?? '-' }}
                                    </div>
                                </div>
                                <div class="timeline-action">
                                    <span style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; background:{{ $actionColor }}15; color:{{ $actionColor }}; border-radius:100px; font-weight:700; font-size:12px; border:1px solid {{ $actionColor }}30;">
                                        <i class="fas {{ $icon }}"></i> {{ $actionLabel }}
                                    </span>
                                </div>
                                @if($log->catatan)
                                <div style="margin-top:12px; padding:12px; background:white; border-radius:8px; border:1px solid var(--border); color:var(--text-main); font-size:13.5px; font-style: italic;">
                                    "{{ $log->catatan }}"
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
</body>
</html>
