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
        /* ========================================
           DESIGN SYSTEM - CSS CUSTOM PROPERTIES
           ======================================== */
        :root {
            /* Brand Colors - PT Semen Padang */
            --primary: #c41e3a;
            --primary-dark: #9a1829;
            --primary-light: #e63950;
            --primary-50: #fef2f3;
            --primary-100: #fce7e9;
            --primary-200: #f9d0d4;
            --primary-600: #c41e3a;

            /* Neutral Palette */
            --gray-50: #fafafa;
            --gray-100: #f5f5f5;
            --gray-200: #e5e5e5;
            --gray-300: #d4d4d4;
            --gray-400: #a3a3a3;
            --gray-500: #737373;
            --gray-600: #525252;
            --gray-700: #404040;
            --gray-800: #262626;
            --gray-900: #171717;

            /* Semantic Colors */
            --success: #10b981;
            --success-light: #d1fae5;
            --warning: #f59e0b;
            --warning-light: #fef3c7;
            --error: #ef4444;
            --error-light: #fee2e2;
            --info: #3b82f6;
            --info-light: #dbeafe;

            /* Surface & Background - Enhanced */
            --bg-body: #f1f5f9;
            --surface: #ffffff;
            --surface-hover: #f9fafb;
            --surface-elevated: #ffffff;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
            --border-radius: 16px; /* Added for compatibility */

            /* Text Colors */
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --text-tertiary: #9ca3af;
            --text-inverse: #ffffff;
            --text-main: #0f172a; /* Legacy compat */
            --text-sub: #64748b; /* Legacy compat */

            /* Shadows - Enhanced */
            --shadow-xs: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            --shadow-colored: 0 10px 25px -5px rgba(196, 30, 58, 0.15);
            
            --sidebar-bg: #5b6fd8; /* Legacy compat */
            --header-bg: #1e293b; /* Legacy compat */
            --header-text: #ffffff; /* Legacy compat */
            
            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-base: 200ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            
            /* Spacing (Added for Dashboard compatibility) */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;
            
            --radius-lg: 0.75rem;
            --radius-full: 9999px;
            --font-weight-bold: 700;
            --font-weight-semibold: 600;
            --font-weight-medium: 500;
        }

        /* ========================================
           BASE STYLES
           ======================================== */
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
            background-image:
                radial-gradient(at 0% 0%, rgba(196, 30, 58, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--text-main);
            padding-bottom: 60px;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            max-width: 100vw;
            min-height: 100vh;
        }

        .layout-container {
            display: flex;
            min-height: 100vh;
        }

        /* ========================================
           SIDEBAR - Enhanced Design (Matched to Dashboard)
           ======================================== */
        .sidebar {
            width: 280px;
            background: #5b6fd8;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: var(--shadow-md);
            /* font-family: 'Inter', sans-serif; REMOVED to match Dashboard */
        }

        .logo-section {
            padding: var(--space-8) var(--space-6);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
            background: transparent;
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
            margin: 0 auto var(--space-5);
            background: transparent; /* Changed from white to match dashboard if needed, or keep white? Dashboard says background: transparent but img inside? Dashboard code: .logo-circle { ... background: transparent ... } */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        /* Dashboard code had background: transparent. Published had background: white. */

        .logo-circle:hover {
            transform: scale(1.05);
        }

        .logo-circle img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.15));
        }

        .logo-text {
            font-size: 1.125rem;
            font-weight: 700; /* Dashboard uses 700 */
            color: white;
            margin-bottom: var(--space-1);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .logo-subtext {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600; /* Dashboard uses 600 */
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .nav-menu {
            flex: 1;
            padding: var(--space-6) 0;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--gray-300) transparent;
        }

        /* Nav Item - Exact Match from Dashboard */
        .nav-item {
            padding: var(--space-4) var(--space-6);
            margin: var(--space-1) var(--space-4);
            display: flex;
            align-items: center;
            gap: var(--space-3);
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            text-decoration: none;
            border-radius: var(--radius-lg);
            transition: all 0.2s;
            font-size: 0.9375rem;
            position: relative;
            border-left: 0; /* Clear previous border-left style */
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

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: white;
            border-radius: 0 4px 4px 0; /* Dashboard style */
        }

        .nav-item i {
            width: 24px; /* Dashboard uses 24px */
            text-align: center;
            font-size: 1.125rem;
        }

        .nav-item:hover i {
            transform: scale(1.1);
        }

        /* User Info - Exact Match */
        .user-info-bottom {
            padding: var(--space-6);
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            background: transparent;
            position: relative; /* Kept relative if needed, dashboard didn't specify */
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            margin-bottom: var(--space-4);
            position: relative; /* Kept relative */
            z-index: 1;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: var(--surface);
            border-radius: 50%; /* Dashboard used 50% mixed with radius-full, but 50% is safer */
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-weight: 700;
            font-size: 1.125rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600; /* Dashboard used 600 */
            font-size: 0.9375rem;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 2px;
        }
        
        .sidebar .user-name {
            font-weight: 600;
            font-size: 0.9375rem;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 2px;
        }

        .user-role {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500; /* Dashboard uses default? Let's keep 500 */
        }
        
        .sidebar .user-role {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
        }

        .logout-btn {
            width: 100%;
            padding: var(--space-3); /* Dashboard uses --space-3 only (no side padding specified separately) */
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: var(--radius-lg);
            font-size: 0.875rem;
            font-weight: 600; /* Dashboard uses 600 */
            cursor: pointer;
            transition: all 0.2s; /* Dashboard 0.2s */
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px; /* Dashboard uses 8px (space-2 is 0.5rem=8px) */
            text-decoration: none;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
        }
        
        .sidebar .logout-btn {
            width: 100%;
            padding: var(--space-3);
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: var(--radius-lg);
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.4); /* Dashboard style? */
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        
        .sidebar .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 40px;
            background: var(--bg-body);
            min-height: 100vh;
            max-width: 1200px;
        }

        .back-nav {
            margin-bottom: 32px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
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

        /* Doc Banner (Replacing Passport Card style for consistency) */
        .doc-banner {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 16px;
            padding: 24px 32px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .doc-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: var(--primary);
        }

        .doc-banner-left h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .doc-meta-badge {
            display: inline-flex; 
            align-items: center; 
            gap: 6px; 
            padding: 6px 12px;
            border-radius: 100px; 
            font-size: 12px; 
            font-weight: 600;
            background: #f1f5f9;
            color: var(--text-sub);
            border: 1px solid var(--border);
            margin-right: 8px;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        /* Table & Wrapper */
        .table-wrapper {
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            overflow-x: auto;
            margin-bottom: 40px;
        }

        .excel-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            font-size: 11px;
            table-layout: auto;
        }

        .excel-table th {
            background: linear-gradient(to bottom, #1e293b 0%, #0f172a 100%);
            color: var(--header-text);
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

        .section-border-right { border-right: 3px solid #94a3b8 !important; }

        /* Risk Logic */
        .risk-score-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        .risk-val { font-size: 14px; font-weight: 800; color: var(--text-main); }
        .risk-badge { 
            font-size: 10px; padding: 2px 8px; border-radius: 8px; margin-top: 4px; 
            font-weight: 700; color: white; text-transform: uppercase;
        }
        .bg-low { background: #16a34a; }
        .bg-med { background: #ca8a04; }
        .bg-high { background: #dc2626; }

        .cell-checkbox-group { display: flex; flex-direction: column; gap: 4px; }
        .cell-checkbox-item { display: flex; align-items: flex-start; gap: 6px; font-size: 11px; }
        
        /* Timeline / History */
        .history-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            padding: 32px;
            margin-top: 40px;
            box-shadow: var(--shadow-sm);
        }

        .timeline {
            position: relative;
            padding-left: 30px;
            margin-top: 20px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 0;
            bottom: 0;
            background: #e2e8f0;
            width: 2px;
        }

        .timeline-item {
            position: relative;
            padding-left: 30px;
            padding-bottom: 30px;
        }
        
        .timeline-item:last-child { padding-bottom: 0; }

        .timeline-dot {
            position: absolute;
            left: -2px;
            top: 0;
            width: 20px;
            height: 20px;
            background: white;
            border: 4px solid #e2e8f0;
            border-radius: 50%;
            z-index: 1;
        }
        
        .timeline-item.active .timeline-dot { border-color: var(--primary); }

        .timeline-content {
            background: #f8fafc;
            border: 1px solid var(--border);
            padding: 20px;
            border-radius: 12px;
            transition: all 0.2s;
        }
        
        .timeline-content:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: #cbd5e1;
        }

        .timeline-user { font-size: 14px; font-weight: 700; color: var(--text-main); margin-bottom: 2px; }
        .timeline-date { font-size: 11px; color: var(--text-light); font-weight: 500; margin-bottom: 8px; }
        .timeline-action { font-size: 13px; color: var(--text-sub); }

        @media print {
            .sidebar, .back-nav { display: none !important; }
            .main-content { margin-left: 0 !important; width: 100% !important; max-width: 100% !important; padding: 0 !important; }
            .excel-table { font-size: 9px; }
            .doc-banner { box-shadow: none; border: 1px solid #000; }
            .section-border-right { border-right: 2px solid #000 !important; }
            @page { size: landscape; margin: 1cm; }
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

        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="back-nav">
                <a href="{{ route(auth()->user()->getDashboardRoute()) }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>

            <!-- Doc Banner -->
            <div class="doc-banner">
                <div class="doc-banner-left">
                    <div style="font-size: 12px; font-weight: 600; color: var(--text-sub); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Judul Dokumen</div>
                    <h1>{{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</h1>
                    <div style="margin-top: 12px;">
                        <span class="doc-meta-badge">
                            <i class="far fa-user"></i> {{ optional($document->user)->nama_user ?? 'Unknown' }}
                        </span>
                        <span class="doc-meta-badge">
                            <i class="far fa-building"></i> {{ optional($document->unit)->nama_unit ?? 'Unit Unknown' }}
                        </span>
                        <span class="doc-meta-badge">
                            <i class="far fa-calendar-check"></i> {{ $document->published_at ? $document->published_at->format('d M Y') : '-' }}
                        </span>
                        <span class="doc-meta-badge" style="background: #ecfdf5; color: #059669; border-color: #10b981;">
                            <i class="fas fa-check-circle"></i> TERPUBLIKASI
                        </span>
                    </div>
                </div>
            </div>

            {{-- Export Buttons Above Table --}}
            <div style="margin-bottom: 20px; display: flex; justify-content: flex-end; gap: 12px;">
                <a href="{{ route('documents.export.detail.pdf', $document->id) }}" target="_blank" style="padding: 10px 20px; background: #c41e3a; color: white; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.2s; box-shadow: 0 2px 4px rgba(196, 30, 58, 0.2);" onmouseover="this.style.background='#9a1829'; this.style.boxShadow='0 4px 8px rgba(196, 30, 58, 0.3)'" onmouseout="this.style.background='#c41e3a'; this.style.boxShadow='0 2px 4px rgba(196, 30, 58, 0.2)'">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
                <a href="{{ route('documents.export.detail.excel', $document->id) }}" target="_blank" style="padding: 10px 20px; background: #10b981; color: white; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.2s; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);" onmouseover="this.style.background='#059669'; this.style.boxShadow='0 4px 8px rgba(16, 185, 129, 0.3)'" onmouseout="this.style.background='#10b981'; this.style.boxShadow='0 2px 4px rgba(16, 185, 129, 0.2)'">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
            </div>
            
            <div class="table-wrapper">
                @php
                    $showShe = $document->hasSheContent();
                    $showSec = $document->hasSecurityContent();
                    
                    // Colspan Calculation
                    $b2_colspan = 1; // Kondisi
                    if($showShe) $b2_colspan += 4; // Potensi(1) + Aspek(1) + Risiko(1) + Dampak(1)
                    if($showSec) $b2_colspan += 2; // Ancaman(1) + Celah(1)
                    // Note: Show blade calculates parts differently, but logic here is to show correct columns.
                    // Let's stick to the column structure of show.blade.
                @endphp
                <table class="excel-table">
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 40px;">No</th>
                            <th colspan="4" class="section-border-right">BAGIAN 1: Identifikasi Aktivitas</th>
                            <th colspan="{{ $showShe && $showSec ? 6 : ($showShe ? 4 : 2) }}" class="section-border-right">BAGIAN 2: Identifikasi & Risiko</th>
                            <th colspan="5" class="section-border-right">BAGIAN 3: Pengendalian & Penilaian Awal</th>
                            <th colspan="3" class="section-border-right">BAGIAN 4: Legalitas & Signifikansi</th>
                            <th colspan="8">BAGIAN 5: Mitigasi Lanjutan & Risiko Sisa</th>
                        </tr>
                        <tr>
                            <th style="width: 150px;">Proses/Kegiatan</th>
                            <th style="width: 100px;">Lokasi</th>
                            <th style="width: 80px;">Kategori</th>
                            <th style="width: 80px;" class="section-border-right">Kondisi</th>
                            
                            @if($showShe)
                                <th style="width: 120px;">Potensi Bahaya</th>
                                <th style="width: 120px;">Aspek Lingkungan</th>
                            @endif
                            
                            @if($showSec)
                                <th style="width: 120px;">Ancaman Keamanan</th>
                            @endif

                            @if($showShe)
                                <th style="width: 120px;">RISIKO (K3/KO)</th>
                                <th style="width: 120px;">DAMPAK (Lingk)</th>
                            @endif

                            @if($showSec)
                                <th style="width: 120px;" class="section-border-right">CELAH (Keam)</th>
                            @else
                                <!-- Close border on last visible column -->
                                @if($showShe)
                                <th style="width: 0; padding:0; border:none;" class="section-border-right"></th>
                                @endif
                            @endif

                            <th style="width: 200px;">Hirarki Pengendalian</th>
                            <th style="width: 200px;">Pengendalian Existing</th>
                            <th style="width: 40px;">L</th>
                            <th style="width: 40px;">S</th>
                            <th style="width: 60px;" class="section-border-right">Level</th>
                            
                            <th style="width: 150px;">Regulasi</th>
                            <th style="width: 70px;">Aspek Penting</th>
                            <th style="width: 150px;" class="section-border-right">Peluang & Risiko</th>
                            
                            <th style="width: 80px;">Toleransi</th>
                            <th style="width: 150px;">Pengendalian Lanjut</th>
                            <th style="width: 40px;">L</th>
                            <th style="width: 40px;">S</th>
                            <th style="width: 60px;">Level</th>
                            <th style="width: 40px;">Res L</th>
                            <th style="width: 40px;">Res S</th>
                            <th style="width: 60px;">Res Level</th>
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
                                
                                $isVisible = true;

                                if ($filter == 'SHE') {
                                    if ($isSecItem) $isVisible = false;
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
                                <span class="doc-meta-badge" style="background:#e0e7ff; color:#3730a3; border:none;">{{ $item->kategori }}</span>
                            </td>
                            <td class="section-border-right" style="text-align:center;">
                                <span class="doc-meta-badge" style="background:#f1f5f9; color:#475569; border:none;">{{ $item->kolom5_kondisi }}</span>
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
                                            @if(!empty($item->kolom6_bahaya['manual']))
                                                <div class="cell-checkbox-item">
                                                    <i class="fas fa-pen" style="color:#ef4444;"></i>
                                                    <span>{{ $item->kolom6_bahaya['manual'] }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @else - @endif
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
                                                <div class="cell-checkbox-item">
                                                    <i class="fas fa-pen" style="color:#22c55e;"></i>
                                                    <span>{{ $manual7 }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @else - @endif
                                </td>
                            @endif

                            @if($showSec)
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
                                                <div class="cell-checkbox-item">
                                                    <i class="fas fa-pen" style="color:#dc2626;"></i>
                                                    <span>{{ $manual8 }}</span>
                                                </div>
                                            @endif
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
                            @else
                                @if($showShe)
                                <td class="section-border-right" style="width:0; padding:0; border:none;"></td>
                                @endif
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
                            
                            <td style="text-align:center; font-weight:700;">{{ $item->kolom12_kemungkinan }}</td>
                            <td style="text-align:center; font-weight:700;">{{ $item->kolom13_konsekuensi }}</td>
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
                            <td style="text-align:center;">
                                @if($item->kolom16_aspek == 'P' && $item->kategori == 'Lingkungan')
                                    <span class="doc-meta-badge" style="background:#dbeafe; color:#1e40af; border:none;">P</span>
                                @elseif($item->kolom16_aspek == 'N' && $item->kategori == 'Lingkungan')
                                    <span class="doc-meta-badge" style="background:#f1f5f9; color:#64748b; border:none;">N</span>
                                @else - @endif
                            </td>
                            <td class="section-border-right">
                                @if($item->kolom17_risiko) <div><strong>(-)</strong> {{ $item->kolom17_risiko }}</div> @endif
                                @if($item->kolom17_peluang) <div style="margin-top:4px;"><strong>(+)</strong> {{ $item->kolom17_peluang }}</div> @endif
                            </td>

                            <!-- BAGIAN 5 -->
                            <td style="text-align:center;">
                                <span class="doc-meta-badge" style="{{ $item->kolom18_toleransi == 'Ya' ? 'background:#dcfce7; color:#166534;' : 'background:#fee2e2; color:#991b1b;' }} border:none;">
                                    {{ $item->kolom18_toleransi == 'Ya' ? 'Ya' : 'Tidak' }}
                                </span>
                            </td>

                            @if($item->kolom18_toleransi == 'Tidak')
                                <td>{{ $item->kolom19_pengendalian_lanjut }}</td>
                                <td style="text-align:center; font-weight:700;">{{ $item->kolom20_kemungkinan_lanjut }}</td>
                                <td style="text-align:center; font-weight:700;">{{ $item->kolom21_konsekuensi_lanjut }}</td>
                                <td>
                                    <div class="risk-score-box">
                                        <div class="risk-val">{{ $item->kolom22_tingkat_risiko_lanjut }}</div>
                                        @if($item->kolom22_tingkat_risiko_lanjut)
                                            <div class="risk-badge {{ $item->kolom22_tingkat_risiko_lanjut >= 15 ? 'bg-high' : ($item->kolom22_tingkat_risiko_lanjut >= 8 ? 'bg-med' : 'bg-low') }}">
                                                {{ $item->kolom22_level_lanjut }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            @else
                                <td>-</td><td>-</td><td>-</td><td>-</td>
                            @endif

                            <td style="text-align:center; font-weight:700;">{{ $item->residual_kemungkinan }}</td>
                            <td style="text-align:center; font-weight:700;">{{ $item->residual_konsekuensi }}</td>
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

            

<!-- PROGRESS PROGRAM TABLES (PUK & PMK) - INSERTED VIA PATCH -->
@php
    $puk = $document->pukProgram;
    $pmk = $document->pmkProgram;
@endphp

@if($puk)
<div class="history-card" style="margin-top: 40px; border-left: 5px solid #3b82f6; position: relative;">
    <div class="timeline-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div style="display: flex; align-items: center; gap: 10px; font-weight: 700; font-size: 16px; color: var(--text-main);">
            <i class="fas fa-tasks" style="color: #3b82f6;"></i> Program Unit Kerja (PUK)
        </div>
        <div style="display: flex; gap: 8px;">
            <a href="{{ route('documents.export.puk.pdf', $document->id) }}" target="_blank"
                style="padding: 6px 14px; background: #ef4444; color: white; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;"
                onmouseover="this.style.background='#dc2626'" 
                onmouseout="this.style.background='#ef4444'">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
            <a href="{{ route('documents.export.puk.excel', $document->id) }}" target="_blank"
                style="padding: 6px 14px; background: #22c55e; color: white; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;"
                onmouseover="this.style.background='#16a34a'" 
                onmouseout="this.style.background='#22c55e'">
                <i class="fas fa-file-excel"></i> Excel
            </a>
        </div>
    </div>

    <div style="background: #f8fafc; padding: 20px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #e2e8f0;">
        <table style="width: 100%; font-size: 14px; border-collapse: separate; border-spacing: 0 8px;">
            <tr>
                <td style="width: 180px; font-weight: 600; color: #64748b;">Judul Program</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $puk->judul }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600; color: #64748b;">Tujuan</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $puk->tujuan }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600; color: #64748b;">Sasaran</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $puk->sasaran }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600; color: #64748b;">Penanggung Jawab</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $puk->penanggung_jawab }}</td>
            </tr>
        </table>
    </div>

    @if($puk->program_kerja && is_array($puk->program_kerja) && count($puk->program_kerja) > 0)
        <div style="margin-bottom: 12px; font-weight: 700; color: #334155;">Detail Program Kerja:</div>
        <div class="table-wrapper" style="margin-bottom: 0;">
            <table class="excel-table" style="min-width: 1000px;">
                <thead>
                    <tr>
                         <th rowspan="2" style="width: 50px;">NO</th>
                         <th rowspan="2" style="min-width: 250px;">URAIAN KEGIATAN</th>
                         <th rowspan="2" style="min-width: 150px;">KOORD.</th>
                         <th rowspan="2" style="min-width: 150px;">PELAKSANA</th>
                         <th colspan="12" class="text-center">TARGET (%)</th>
                    </tr>
                    <tr>
                        @for($m=1; $m<=12; $m++)
                            <th style="width: 50px; text-align: center;">{{ $m }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($puk->program_kerja as $idx => $item)
                        <tr>
                            <td style="text-align: center;">{{ $idx + 1 }}</td>
                            <td>{{ $item['uraian'] ?? '-' }}</td>
                            <td>{{ $item['koordinator'] ?? '-' }}</td>
                            <td>{{ $item['pelaksana'] ?? '-' }}</td>
                            @php $targets = $item['target'] ?? []; @endphp
                            @for($m=0; $m<12; $m++)
                                <td style="text-align: center;">
                                    {{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '-' }}
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="font-style: italic; color: #94a3b8;">Tidak ada data program kerja.</div>
    @endif
</div>
@endif

@if($pmk)
<div class="history-card" style="margin-top: 40px; border-left: 5px solid #c026d3; position: relative;">
    <div class="timeline-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div style="display: flex; align-items: center; gap: 10px; font-weight: 700; font-size: 16px; color: var(--text-main);">
            <i class="fas fa-shield-virus" style="color: #c026d3;"></i> Program Manajemen Kesehatan (PMK)
        </div>
        <div style="display: flex; gap: 8px;">
            <a href="{{ route('documents.export.pmk.pdf', $document->id) }}" target="_blank"
                style="padding: 6px 14px; background: #ef4444; color: white; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;"
                onmouseover="this.style.background='#dc2626'" 
                onmouseout="this.style.background='#ef4444'">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
            <a href="{{ route('documents.export.pmk.excel', $document->id) }}" target="_blank"
                style="padding: 6px 14px; background: #22c55e; color: white; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;"
                onmouseover="this.style.background='#16a34a'" 
                onmouseout="this.style.background='#22c55e'">
                <i class="fas fa-file-excel"></i> Excel
            </a>
        </div>
    </div>

    <div style="background: #fdf4ff; padding: 20px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #f0abfc;">
        <table style="width: 100%; font-size: 14px; border-collapse: separate; border-spacing: 0 8px;">
            <tr>
                <td style="width: 180px; font-weight: 600; color: #86198f;">Judul Program</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $pmk->judul }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600; color: #86198f;">Tujuan</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $pmk->tujuan }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600; color: #86198f;">Sasaran</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $pmk->sasaran }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600; color: #86198f;">Penanggung Jawab</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $pmk->penanggung_jawab }}</td>
            </tr>
        </table>
    </div>

    @if($pmk->program_kerja && is_array($pmk->program_kerja) && count($pmk->program_kerja) > 0)
        <div style="margin-bottom: 12px; font-weight: 700; color: #334155;">Detail Program Kerja:</div>
        <div class="table-wrapper" style="margin-bottom: 0;">
            <table class="excel-table" style="min-width: 1000px;">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 50px;">NO</th>
                        <th rowspan="2" style="min-width: 200px;">URAIAN KEGIATAN</th>
                        <th rowspan="2" style="width: 150px;">PIC</th>
                        <th colspan="12" class="text-center">TARGET (%)</th>
                        <th rowspan="2" style="min-width: 150px;">ANGGARAN</th>
                    </tr>
                    <tr>
                        @for($m=1; $m<=12; $m++)
                            <th style="width: 50px; text-align: center;">{{ $m }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($pmk->program_kerja as $idx => $item)
                        <tr>
                            <td style="text-align: center;">{{ $idx + 1 }}</td>
                            <td>{{ $item['uraian'] ?? '-' }}</td>
                            <td>{{ $item['koordinator'] ?? '-' }}</td>
                            @php $targets = $item['target'] ?? []; @endphp
                            @for($m=0; $m<12; $m++)
                                <td style="text-align: center;">
                                    {{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '-' }}
                                </td>
                            @endfor
                            <td>
                                {{ isset($item['anggaran']) ? 'Rp ' . number_format($item['anggaran'], 0, ',', '.') : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="font-style: italic; color: #94a3b8;">Tidak ada data program kerja.</div>
    @endif
</div>
@endif
<!-- END PROGRESS PROGRAM TABLES -->



            <!-- Approval History -->
            <div class="history-card" style="margin-top: 40px; background: white; border-radius: 16px; border: 1px solid var(--border); padding: 32px; box-shadow: var(--shadow-sm);">
                <div class="timeline-header" style="display: flex; align-items: center; gap: 10px; margin-bottom: 24px; font-weight: 700; font-size: 16px; color: var(--text-main);">
                    <i class="fas fa-history" style="color: var(--primary);"></i> Riwayat Approval & Catatan
                </div>
                
                <div class="timeline" style="position: relative; padding-left: 30px; margin-top: 20px; border-left: 2px solid #e2e8f0;">
                    @php
                        // Filter Logic based on User Request (SHE/Security) and content
                        $filterParam = strtolower(request('filter'));
                        
                        // Fallback: If no filter param, try to detect from the content shown
                        // But usually published view shows everything merged.
                        // Ideally we respect the param if present.
                        
                        $filteredApprovals = $document->approvals->sortByDesc('created_at');

                        if ($filterParam == 'she') {
                            // Hide Security (ID 55)
                            $filteredApprovals = $filteredApprovals->filter(fn($l) => optional($l->approver)->id_unit != 55); 
                        } elseif ($filterParam == 'security') {
                            // Hide SHE (ID 56)
                            $filteredApprovals = $filteredApprovals->filter(fn($l) => optional($l->approver)->id_unit != 56);
                        }
                    @endphp

                    @forelse($filteredApprovals as $log)
                        <div class="timeline-item" style="position: relative; margin-bottom: 24px;">
                            <div class="timeline-dot" style="position: absolute; left: -38px; top: 4px; width: 14px; height: 14px; border-radius: 50%; background: var(--primary); border: 2px solid white; box-shadow: 0 0 0 1px var(--primary);"></div>
                            <div class="timeline-date" style="font-size: 12px; color: var(--text-sub); margin-bottom: 4px;">{{ $log->created_at->format('d M Y, H:i') }}</div>
                            <div class="timeline-title" style="font-size: 14px; font-weight: 600; color: var(--text-main);">
                                @if($log->action == 'approved') <span style="color: #15803d;">Disetujui</span>
                                @elseif($log->action == 'revised') <span style="color: #b91c1c;">Revisi diminta</span>
                                @elseif($log->action == 'published') <span style="color: #15803d;">Dipublikasi</span>
                                @else {{ ucfirst($log->action) }} @endif
                                @if($log->approver)
                                    oleh {{ $log->approver->nama_user }}
                                    @if($log->approver->unit)
                                        <span style="color: #94a3b8; font-weight: 400; font-size: 13px;">({{ $log->approver->unit->nama_unit }})</span>
                                    @endif
                                @else
                                    oleh System
                                @endif
                            </div>
                            @if($log->catatan)
                                <div class="timeline-desc" style="margin-top: 8px; padding: 12px; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; color: #475569; font-style: italic;">
                                    "{{ $log->catatan }}"
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="timeline-item" style="margin-bottom: 24px;">
                             <div class="timeline-title" style="color:#94a3b8; font-weight:500;">Belum ada aktivitas approval yang tercatat untuk filter ini.</div>
                        </div>
                    @endforelse

                    <!-- Created Log (Always relevant) -->
                    <div class="timeline-item" style="position: relative;">
                        <div class="timeline-dot" style="position: absolute; left: -38px; top: 4px; width: 14px; height: 14px; border-radius: 50%; background: #cbd5e1; border: 2px solid white; box-shadow: 0 0 0 1px #cbd5e1;"></div>
                        <div class="timeline-date" style="font-size: 12px; color: var(--text-sub); margin-bottom: 4px;">{{ $document->created_at->format('d M Y, H:i') }}</div>
                        <div class="timeline-title" style="font-size: 14px; font-weight: 600; color: var(--text-main);">Form Dibuat</div>
                        <div class="timeline-desc" style="font-size: 13px; color: var(--text-sub);">Oleh {{ $document->user->nama_user ?? 'Unknown' }}</div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>
</html>
