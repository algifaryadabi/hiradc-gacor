<!DOCTYPE html>
<html lang="id">

@php
    // Ensure filter variables are always defined
    $filter = $filter ?? 'ALL';
    $verifyingUnit = $verifyingUnit ?? '';
@endphp

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

        /* Sidebar - Twin Design */
        .sidebar {
            width: 280px;
            background: #5b6fd8;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        .logo-section {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
            position: relative;
        }

        .logo-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.3) 50%, transparent 100%);
        }

        .logo-circle {
            width: 90px;
            height: 90px;
            margin: 0 auto 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .logo-circle:hover {
            transform: scale(1.05);
        }

        .logo-circle img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.125rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
            letter-spacing: -0.02em;
        }

        .logo-subtext {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .nav-menu {
            flex: 1;
            padding: 1.5rem 0;
            overflow-y: auto;
        }

        .nav-item {
            padding: 1rem 1.5rem;
            margin: 0.25rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9375rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 0.75rem;
            position: relative;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(4px);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.125rem;
        }

        /* User Info at Bottom */
        .user-info-bottom {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5b6fd8;
            font-weight: 700;
            font-size: 1.125rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9375rem;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
        }

        .logout-btn {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
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

        /* Excel-Style Table (Reference Design) */
        .excel-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            font-size: 11px;
            table-layout: auto;
        }

        .excel-table th {
            background: linear-gradient(to bottom, #1e293b 0%, #0f172a 100%);
            color: white;
            padding: 10px;
            border-right: 1px solid #334155;
            border-bottom: 1px solid #334155;
            text-align: center;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.02em;
            line-height: 1.3;
            white-space: nowrap;
        }

        .excel-table td {
            padding: 10px;
            border-bottom: 1px solid var(--border);
            border-right: 1px solid var(--border);
            color: var(--text-main);
            vertical-align: top;
            line-height: 1.5;
            font-size: 11px;
            font-weight: 500;
        }

        .excel-table tbody tr:hover {
            background: linear-gradient(to right, #fef2f3 0%, #ffffff 100%);
        }

        .section-border-right {
            border-right: 3px solid #94a3b8 !important;
        }

        /* Legacy table support */
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

        /* Action Bar - Fixed positioning */
        .action-bar {
            position: fixed;
            bottom: 0;
            left: 280px; /* Updated to match sidebar width */
            right: 0;
            background: linear-gradient(to top, #ffffff 0%, #fefefe 100%);
            padding: 20px 48px;
            border-top: 1px solid var(--border);
            box-shadow: 0 -4px 20px rgba(0,0,0,0.08), 0 -1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 20px;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .note-input-wrapper {
            flex: 1;
            max-width: 600px;
        }

        .note-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-sub);
            margin-bottom: 8px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .note-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-size: 14px;
            font-family: inherit;
            color: var(--text-main);
            transition: all 0.2s;
            background: white;
            resize: vertical;
            min-height: 60px;
        }

        .note-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.1);
            outline: none;
        }

        .note-input::placeholder {
            color: #94a3b8;
            font-style: italic;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-action {
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .btn-approve {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
        }

        .btn-approve:hover {
            background: linear-gradient(135deg, #15803d 0%, #166534 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(22, 163, 74, 0.4);
        }

        .btn-reject {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-reject:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
        }

        .btn-revise {
            background: white;
            color: #f59e0b;
            border: 2px solid #f59e0b;
        }

        .btn-revise:hover {
            background: #fffbeb;
            transform: translateY(-2px);
        }
        
        .btn-disabled {
            background: #e2e8f0;
            color: #94a3b8;
            cursor: not-allowed;
            border: none;
            box-shadow: none;
        }

        .btn-disabled:hover {
            transform: none;
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

        /* Submitter Table Utilities */
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
        .cell-text { font-size: 13.5px; line-height: 1.5; color: var(--text-main); }
        
        .risk-section { display: flex; flex-direction: column; gap: 4px; }
        .risk-label { font-size: 10px; font-weight: 800; color: var(--text-sub); text-transform: uppercase; }
        .risk-text { font-size: 13px; color: var(--text-main); font-weight: 500; }
        
        .excel-table { width: max-content; min-width: 100%; border-collapse: separate; border-spacing: 0; }
        .excel-table th { background: #0f172a; color: white; padding: 12px; border-right: 1px solid #334155; border-bottom: 1px solid #334155; text-align: center; font-weight: 600; }
        .section-border-right { border-right: 3px solid #94a3b8 !important; }
        
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
                        @if(!empty($verifyingUnit))
                            <div style="margin-top: 8px; padding: 6px 12px; background: #eff6ff; border: 1px solid #3b82f6; border-radius: 6px; display: inline-block;">
                                <i class="fas fa-info-circle" style="color: #3b82f6;"></i>
                                <span style="font-size: 13px; color: #1e40af; font-weight: 600;">Verifikasi: {{ $verifyingUnit }}</span>
                            </div>
                        @endif
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
                    <table class="excel-table">
                        <thead>
                            <!-- Header Row 1: Main Sections (BAGIAN 1-5) -->
                            <tr>
                                <th rowspan="2" style="width: 40px;">No</th>
                                <th colspan="4" class="section-border-right">BAGIAN 1: Identifikasi Aktivitas</th>
                                <th colspan="6" class="section-border-right">BAGIAN 2: Identifikasi</th>
                                <th colspan="5" class="section-border-right">BAGIAN 3: Pengendalian & Penilaian Awal</th>
                                <th colspan="3" class="section-border-right">BAGIAN 4: Legalitas & Signifikansi</th>
                                <th colspan="8">BAGIAN 5: Mitigasi Lanjutan & Risiko Sisa</th>
                            </tr>
                            <!-- Header Row 2: Column Details -->
                            <tr>
                                <!-- BAGIAN 1 (Kolom 2-5) -->
                                <th style="width: 180px;">Proses/Kegiatan<br><small>(Kol 2)</small></th>
                                <th style="width: 120px;">Lokasi<br><small>(Kol 3)</small></th>
                                <th style="width: 80px;">Kategori<br><small>(Kol 4)</small></th>
                                <th style="width: 90px;" class="section-border-right">Kondisi<br><small>(Kol 5)</small></th>

                                <!-- BAGIAN 2 (Kolom 6-9) -->
                                <th style="width: 150px;">Potensi Bahaya<br><small>(Kol 6)</small></th>
                                <th style="width: 150px;">Aspek Lingkungan<br><small>(Kol 7)</small></th>
                                <th style="width: 150px;">Ancaman Keamanan<br><small>(Kol 8)</small></th>

                                <th style="width: 150px;">RISIKO (K3/KO)<br><small>(Kol 9)</small></th>
                                <th style="width: 150px;">DAMPAK (Lingk)<br><small>(Kol 9)</small></th>
                                <th style="width: 150px;" class="section-border-right">CELAH (Keamanan)<br><small>(Kol
                                        9)</small></th>

                                <!-- BAGIAN 3 (Kolom 10-14) -->
                                <th style="width: 250px;">Hirarki Pengendalian<br><small>(Kol 10)</small></th>
                                <th style="width: 250px;">Pengendalian Existing<br><small>(Kol 11)</small></th>
                                <th style="width: 50px;">L<br><small>(Kol 12)</small></th>
                                <th style="width: 50px;">S<br><small>(Kol 13)</small></th>
                                <th style="width: 80px;" class="section-border-right">Level<br><small>(Kol 14)</small></th>

                                <!-- BAGIAN 4 (Kolom 15-17) -->
                                <th style="width: 200px;">Regulasi<br><small>(Kol 15)</small></th>
                                <th style="width: 80px;">Aspek Penting<br><small>(Kol 16)</small></th>
                                <th style="width: 200px;" class="section-border-right">Peluang & Risiko<br><small>(Kol
                                        17)</small></th>

                                <!-- BAGIAN 5 (Kolom 18-22) -->
                                <th style="width: 100px;">Toleransi<br><small>(Kol 18)</small></th>
                                <th style="width: 200px;">Pengendalian Lanjut<br><small>(Kol 19)</small></th>
                                <th style="width: 50px;">L<br><small>(Kol 20)</small></th>
                                <th style="width: 50px;">S<br><small>(Kol 21)</small></th>
                                <th style="width: 80px;">Level<br><small>(Kol 22)</small></th>
                                <th style="width: 50px;">Residual L</th>
                                <th style="width: 50px;">Residual S</th>
                                <th style="width: 80px;">Residual Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Filter items based on filter parameter
                                $filteredDetails = $document->details;
                                if (isset($filter) && $filter == 'SHE') {
                                    $filteredDetails = $document->details->filter(function($item) {
                                        return in_array($item->kategori, ['K3', 'KO', 'Lingkungan']);
                                    });
                                } elseif (isset($filter) && $filter == 'Security') {
                                    $filteredDetails = $document->details->filter(function($item) {
                                        return $item->kategori == 'Keamanan';
                                    });
                                }
                            @endphp
                            @forelse($filteredDetails as $index => $item)
                                <tr>
                                    <td style="text-align:center; padding-top:20px; font-size:14px; color:#1e293b;">
                                        {{ $loop->iteration }}
                                    </td>
                                    <!-- BAGIAN 1: Identifikasi Aktivitas -->
                                    <td>
                                        <div class="cell-text">{{ $item->kolom2_kegiatan }}</div>
                                    </td>
                                    <td>
                                        <div class="cell-text">{{ $item->kolom3_lokasi }}</div>
                                    </td>
                                    <td>
                                        <div style="display:flex; align-items:center; justify-content:center;">
                                            <span class="doc-meta-badge" style="background:#e0e7ff; color:#3730a3;">
                                                {{ $item->kategori }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="section-border-right">
                                        <div style="display:flex; align-items:center; justify-content:center;">
                                            <span class="doc-meta-badge" style="background:#f1f5f9; color:#475569;">
                                                {{ $item->kolom5_kondisi }}
                                            </span>
                                        </div>
                                    </td>

                                    <!-- BAGIAN 2: Identifikasi -->
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
                                                @if(!empty($item->kolom6_bahaya['manual']))
                                                    <div style="font-size:13px; margin-top:8px; padding:6px; background:#fef2f2; border:1px dashed #f87171; border-radius:4px; color:#991b1b;">
                                                        <strong>Lainnya:</strong> {{ $item->kolom6_bahaya['manual'] }}
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>

                                    <td>
                                        @if($item->kategori == 'Lingkungan')
                                            <div class="cell-checkbox-group">
                                                @php
                                                    $col7 = $item->kolom7_aspek_lingkungan ?? [];
                                                    $details7 = $col7['details'] ?? ((is_array($col7) && !array_key_exists('details', $col7)) ? $col7 : []);
                                                    $manual7 = $col7['manual'] ?? '';
                                                @endphp
                                                @foreach($details7 as $aspek)
                                                    <div class="cell-checkbox-item">
                                                        <i class="fas fa-leaf" style="color:#22c55e;"></i>
                                                        <span>{{ $aspek }}</span>
                                                    </div>
                                                @endforeach
                                                @if(!empty($manual7))
                                                    <div style="font-size:13px; margin-top:8px; padding:6px; background:#f0fdf4; border:1px dashed #22c55e; border-radius:4px; color:#15803d;">
                                                        <strong>Lainnya:</strong> {{ $manual7 }}
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>

                                    <td>
                                        @if($item->kategori == 'Keamanan')
                                            <div class="cell-checkbox-group">
                                                @php
                                                    $col8 = $item->kolom8_ancaman ?? [];
                                                    $details8 = $col8['details'] ?? ((is_array($col8) && !array_key_exists('details', $col8)) ? $col8 : []);
                                                    $manual8 = $col8['manual'] ?? '';
                                                @endphp
                                                @foreach($details8 as $threat)
                                                    <div class="cell-checkbox-item">
                                                        <i class="fas fa-shield-alt" style="color:#dc2626;"></i>
                                                        <span>{{ $threat }}</span>
                                                    </div>
                                                @endforeach
                                                @if(!empty($manual8))
                                                    <div style="font-size:13px; margin-top:8px; padding:6px; background:#fef2f2; border:1px dashed #f87171; border-radius:4px; color:#991b1b;">
                                                        <strong>Lainnya:</strong> {{ $manual8 }}
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>

                                    <td>
                                        @if($item->kategori == 'K3' || $item->kategori == 'KO')
                                            <div class="cell-text">{{ $item->kolom9_risiko_k3ko ?? $item->kolom9_risiko }}</div>
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>

                                    <td>
                                        @if($item->kategori == 'Lingkungan')
                                            <div class="cell-text">{{ $item->kolom9_dampak_lingkungan ?? $item->kolom9_risiko }}</div>
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>

                                    <td class="section-border-right">
                                        @if($item->kategori == 'Keamanan')
                                            <div class="cell-text">{{ $item->kolom9_celah_keamanan ?? $item->kolom9_risiko }}</div>
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>

                                    <!-- BAGIAN 3: Pengendalian & Penilaian -->
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
                                    <td>
                                        <div class="cell-text">{{ $item->kolom11_existing }}</div>
                                    </td>
                                    <td style="vertical-align:middle; text-align:center;">
                                        <div style="font-weight:800; font-size:16px;">{{ $item->kolom12_kemungkinan }}</div>
                                    </td>
                                    <td style="vertical-align:middle; text-align:center;">
                                        <div style="font-weight:800; font-size:16px;">{{ $item->kolom13_konsekuensi }}</div>
                                    </td>
                                    <td class="section-border-right" style="vertical-align:middle;">
                                        <div class="risk-score-box">
                                            <div class="risk-val">{{ $item->kolom14_score }}</div>
                                            <div class="risk-badge {{ $item->kolom14_score >= 15 ? 'bg-high' : ($item->kolom14_score >= 8 ? 'bg-med' : 'bg-low') }}">
                                                {{ $item->kolom14_score >= 15 ? 'TINGGI' : ($item->kolom14_score >= 8 ? 'SEDANG' : 'RENDAH') }}
                                            </div>
                                        </div>
                                    </td>

                                    <!-- BAGIAN 4: Legalitas & Signifikansi -->
                                    <td>
                                        <div class="cell-text">{{ $item->kolom15_regulasi }}</div>
                                    </td>
                                    <td style="text-align:center; vertical-align:middle;">
                                        @if($item->kategori == 'Lingkungan' && $item->kolom16_aspek)
                                            <div class="doc-meta-badge" style="{{ $item->kolom16_aspek == 'P' ? 'background:#dbeafe; color:#1e40af;' : 'background:#f1f5f9; color:#64748b;' }}">
                                                {{ $item->kolom16_aspek }}
                                            </div>
                                        @else
                                            <div style="color:#94a3b8;">-</div>
                                        @endif
                                    </td>
                                    <td class="section-border-right">
                                        <div class="risk-section">
                                            @if($item->kolom17_risiko)
                                                <div class="risk-label">RISIKO (-):</div>
                                                <div class="risk-text">{{ $item->kolom17_risiko }}</div>
                                            @endif
                                            @if($item->kolom17_peluang)
                                                <div class="risk-label" style="border-top:1px solid #e2e8f0; margin-top:6px; padding-top:6px;">PELUANG (+):</div>
                                                <div class="risk-text">{{ $item->kolom17_peluang }}</div>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- BAGIAN 5: Mitigasi Lanjutan & Risiko Sisa -->
                                    <td style="text-align:center; vertical-align:middle;">
                                        <div class="doc-meta-badge" style="{{ $item->kolom18_toleransi == 'Ya' ? 'background:#dcfce7; color:#166534;' : 'background:#fee2e2; color:#991b1b;' }}">
                                            {{ $item->kolom18_toleransi }}
                                        </div>
                                    </td>
                                    @if($item->kolom18_toleransi == 'Tidak')
                                        <td><div class="cell-text">{{ $item->kolom19_pengendalian_lanjut }}</div></td>
                                        <td style="vertical-align:middle; text-align:center;">
                                            <div style="font-weight:800; font-size:16px;">{{ $item->kolom20_kemungkinan_lanjut }}</div>
                                        </td>
                                        <td style="vertical-align:middle; text-align:center;">
                                            <div style="font-weight:800; font-size:16px;">{{ $item->kolom21_konsekuensi_lanjut }}</div>
                                        </td>
                                        <td>
                                            <div class="risk-score-box">
                                                <div class="risk-val">{{ $item->kolom22_tingkat_risiko_lanjut }}</div>
                                                @if($item->kolom22_tingkat_risiko_lanjut)
                                                    <div class="risk-badge {{ $item->kolom22_tingkat_risiko_lanjut >= 15 ? 'bg-high' : ($item->kolom22_tingkat_risiko_lanjut >= 8 ? 'bg-med' : 'bg-low') }}">
                                                        {{ $item->kolom14_score >= 15 ? 'HIGH' : ($item->kolom14_score >= 8 ? 'MED' : 'LOW') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    @else
                                        <td><div style="color:#94a3b8; text-align:center;">-</div></td>
                                        <td><div style="color:#94a3b8; text-align:center;">-</div></td>
                                        <td><div style="color:#94a3b8; text-align:center;">-</div></td>
                                        <td><div style="color:#94a3b8; text-align:center;">-</div></td>
                                    @endif

                                    <td style="vertical-align:middle; text-align:center;">
                                        <div style="font-weight:800; font-size:16px;">{{ $item->residual_kemungkinan }}</div>
                                    </td>
                                    <td style="vertical-align:middle; text-align:center;">
                                        <div style="font-weight:800; font-size:16px;">{{ $item->residual_konsekuensi }}</div>
                                    </td>
                                    <td style="vertical-align:middle;">
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
                            @empty
                                <tr>
                                    <td colspan="27" style="text-align:center; padding:20px;">Tidak ada data detail.</td>
                                </tr>
                            @endforelse
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
                                        
                                        // Filter compliance based on filter parameter
                                        $complianceField = 'compliance_checklist';
                                        if (isset($filter) && $filter == 'SHE') {
                                            $complianceField = 'compliance_checklist_she';
                                        } elseif (isset($filter) && $filter == 'Security') {
                                            $complianceField = 'compliance_checklist_security';
                                        }
                                        
                                        $existingCompliance = $document->$complianceField ?? [];
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
                @php
                    // Show action buttons if:
                    // 1. Filter=SHE and status_she='approved' (SHE track ready)
                    // 2. Filter=Security and status_security='approved' (Security track ready)
                    // 3. Filter=ALL and status='pending_level3' (legacy/general)
                    $showActions = false;
                    if (isset($filter) && $filter == 'SHE' && $document->status_she == 'approved') {
                        $showActions = true;
                    } elseif (isset($filter) && $filter == 'Security' && $document->status_security == 'approved') {
                        $showActions = true;
                    } elseif ($document->status === 'pending_level3') {
                        $showActions = true;
                    }
                @endphp
                
                @if($showActions)
                <div class="action-bar">
                    <div class="note-input-wrapper">
                        <label class="note-label" for="catatan_ui">
                            <i class="fas fa-comment-dots"></i> Catatan Review
                        </label>
                        <textarea id="catatan_ui" class="note-input" placeholder="Tulis catatan (Opsional untuk Approve, Wajib untuk Revisi)..." rows="2"></textarea>
                    </div>
                    <div class="action-buttons">
                        <button type="button" class="btn-action btn-revise" onclick="submitAction('revise')">
                            <i class="fas fa-undo"></i> Minta Revisi
                        </button>
                        <button type="button" class="btn-action btn-approve" onclick="submitAction('approve')">
                            <i class="fas fa-check-circle"></i> Publikasikan
                        </button>
                    </div>
                </div>
                @else
                <div class="action-bar" style="justify-content:center;">
                    <button type="button" class="btn-action btn-disabled" disabled>
                        <i class="fas fa-lock"></i> Mode Read Only ({{ $statusLabel }})
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
                        
                        // Filter history based on filter parameter
                        if (isset($filter) && $filter == 'SHE') {
                            $allHistory = $allHistory->filter(function($log) {
                                if ($log->action == 'created' || $log->action == 'submitted') return true;
                                if ($log->level == 1) return true;
                                
                                $approverUnit = optional($log->approver)->id_unit;
                                if ($log->level == 2 || $log->level == 3) {
                                    // Only show if it's NOT the other unit (Security = 55)
                                    if ($approverUnit == 55) return false;
                                    return true;
                                }
                                return false;
                            });
                        } elseif (isset($filter) && $filter == 'Security') {
                            $allHistory = $allHistory->filter(function($log) {
                                if ($log->action == 'created' || $log->action == 'submitted') return true;
                                if ($log->level == 1) return true;

                                $approverUnit = optional($log->approver)->id_unit;
                                if ($log->level == 2 || $log->level == 3) {
                                    // Only show if it's NOT the other unit (SHE = 56)
                                    if ($approverUnit == 56) return false;
                                    return true;
                                }
                                return false;
                            });
                        }
                        
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
                                        @if(optional(optional($log->approver)->unit)->nama_unit)
                                            • {{ $log->approver->unit->nama_unit }}
                                        @endif
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
            
            // Add filter parameter to URL
            const filter = "{{ $filter ?? 'ALL' }}";
            const baseApproveUrl = "{{ route('kepala_departemen.publish', $document->id) }}";
            const baseReviseUrl = "{{ route('kepala_departemen.revise', $document->id) }}";
            
            const actionUrl = type === 'approve' 
                ? (filter !== 'ALL' ? baseApproveUrl + '?filter=' + filter : baseApproveUrl)
                : (filter !== 'ALL' ? baseReviseUrl + '?filter=' + filter : baseReviseUrl);

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
    @include('partials.alerts')
</body>
</html>