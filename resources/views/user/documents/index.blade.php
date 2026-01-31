<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Saya | HIRADC System - PT Semen Padang</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

            /* Spacing Scale */
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

            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            --radius-full: 9999px;

            /* Typography */
            --font-sans: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            --font-weight-normal: 400;
            --font-weight-medium: 500;
            --font-weight-semibold: 600;
            --font-weight-bold: 700;
            --font-weight-extrabold: 800;

            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-base: 200ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            
            --sidebar-bg: #5b6fd8; /* Legacy compat */
        }

        /* ========================================
           BASE STYLES
           ======================================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-sans);
            background: var(--bg-body);
            background-image:
                radial-gradient(at 0% 0%, rgba(196, 30, 58, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--text-primary);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* ========================================
           SIDEBAR - Enhanced Design
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
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-base);
        }

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
            font-weight: var(--font-weight-bold);
            color: white;
            margin-bottom: var(--space-1);
            letter-spacing: -0.02em;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .logo-subtext {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: var(--font-weight-semibold);
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

        .nav-menu::-webkit-scrollbar {
            width: 6px;
        }

        .nav-menu::-webkit-scrollbar-track {
            background: transparent;
        }

        .nav-menu::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: var(--radius-full);
        }

        .nav-item {
            padding: var(--space-4) var(--space-6);
            margin: var(--space-1) var(--space-4);
            display: flex;
            align-items: center;
            gap: var(--space-3);
            cursor: pointer;
            transition: all var(--transition-base);
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9375rem;
            font-weight: var(--font-weight-medium);
            text-decoration: none;
            position: relative;
            border-radius: var(--radius-lg);
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(4px);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            font-weight: var(--font-weight-semibold);
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
            border-radius: 0 var(--radius-md) var(--radius-md) 0;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.125rem;
            transition: transform var(--transition-base);
        }

        .nav-item:hover i {
            transform: scale(1.1);
        }

        .user-info-bottom {
            padding: var(--space-6);
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            background: transparent;
            position: relative;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            margin-bottom: var(--space-4);
            position: relative;
            z-index: 1;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: var(--surface);
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-weight: var(--font-weight-bold);
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
            font-weight: var(--font-weight-semibold);
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
            font-weight: var(--font-weight-medium);
        }

        .logout-btn {
            width: 100%;
            padding: var(--space-3) var(--space-4);
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: var(--radius-lg);
            font-size: 0.875rem;
            font-weight: var(--font-weight-semibold);
            cursor: pointer;
            transition: all var(--transition-base);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            text-decoration: none;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* ========================================
           MAIN CONTENT AREA
           ======================================== */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 0;
            background: var(--bg-body);
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%);
            padding: var(--space-8) var(--space-10);
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(8px);
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, var(--primary) 50%, transparent 100%);
            opacity: 0.3;
        }

        .header h1 {
            font-size: 1.875rem;
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
            letter-spacing: -0.02em;
        }

        .content-area {
            padding: var(--space-10);
            max-width: 1600px;
            margin: 0 auto;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--surface);
            padding: 24px;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.2s ease;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-card.active {
            border-color: var(--primary);
            background: var(--primary-light);
            box-shadow: var(--shadow-md);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .stat-info {
            display: flex;
            flex-direction: column;
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-sub);
            font-weight: 700;
            text-transform: uppercase;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-main);
        }

        /* Icon Colors */
        .icon-blue {
            background: #eff6ff;
            color: #3b82f6;
        }

        .icon-orange {
            background: #fff7ed;
            color: #f97316;
        }

        .icon-red {
            background: #fef2f2;
            color: #ef4444;
        }

        .icon-green {
            background: #ecfdf5;
            color: #10b981;
        }

        /* Toolbar */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            background: var(--surface);
            padding: 20px 24px;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
        }

        .search-box {
            position: relative;
            width: 320px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
            font-family: inherit;
        }

        .search-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 14px;
            color: #94a3b8;
        }

        .view-toggles {
            display: flex;
            gap: 10px;
        }

        .view-btn {
            background: #f1f5f9;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            color: var(--text-sub);
            transition: all 0.2s;
            font-weight: 600;
            font-size: 14px;
        }

        .view-btn.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 2px 4px rgba(196, 30, 58, 0.2);
        }

        .btn-create-new {
            background: var(--primary);
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(196, 30, 58, 0.2);
        }

        .btn-create-new:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        /* Grid View */
        .doc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 24px;
        }

        .doc-card {
            background: var(--surface);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow-sm);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--border);
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .doc-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.1);
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .cat-badge {
            font-size: 11px;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 700;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .cat-k3 {
            background: #eff6ff;
            color: #1e40af;
        }

        .cat-lingkungan {
            background: #ecfdf5;
            color: #15803d;
        }

        .cat-keamanan {
            background: #fff7ed;
            color: #c2410c;
        }

        .doc-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 10px;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .doc-meta {
            font-size: 13px;
            color: var(--text-sub);
            margin-bottom: 16px;
            display: flex;
            gap: 12px;
            flex-direction: column;
            font-weight: 500;
        }

        .doc-meta i {
            width: 16px;
            text-align: center;
        }

        .status-container {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }

        /* Status Pills */
        .status-pill {
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .st-draft {
            background: #f1f5f9;
            color: #475569;
        }

        .st-pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .st-revision {
            background: #fee2e2;
            color: #991b1b;
        }

        .st-approved {
            background: #dcfce7;
            color: #166534;
        }

        .view-link {
            color: var(--text-main);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: white;
            transition: all 0.2s;
        }

        .view-link:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Filter Section */
        .filter-section {
            padding: 24px 40px;
            background: white;
            border-bottom: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
        }

        .filter-select {
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            color: var(--text-main);
            min-width: 160px;
            outline: none;
            background: white;
            font-weight: 500;
            transition: all 0.2s;
        }

        .filter-select:focus {
            border-color: var(--primary);
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: 0.3s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.3s;
            border-radius: 50%;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        input:checked+.slider {
            background: var(--primary);
        }

        input:checked+.slider:before {
            transform: translateX(20px);
        }

        /* List View */
        .doc-table-container {
            display: none;
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .doc-table {
            width: 100%;
            border-collapse: collapse;
        }

        .doc-table th {
            background: #f8fafc;
            padding: 16px 24px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            color: var(--text-sub);
            text-transform: uppercase;
            border-bottom: 1px solid var(--border);
        }

        .doc-table td {
            padding: 16px 24px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: var(--text-main);
        }

        .doc-table tr:hover {
            background: #fafbfc;
        }

        .doc-table tr:last-child td {
            border-bottom: none;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-item {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
</head>

<body>

    @include('partials.alerts')

    <div class="container">
        <!-- Sidebar -->
        @include('user.partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Form Saya</h1>
                <div style="display:flex; gap:12px;">
                    <a href="{{ route('documents.summary') }}" class="view-btn"
                        style="text-decoration:none; display:flex; align-items:center; gap:8px; border:1px solid #e2e8f0; background:white;">
                        <i class="fas fa-table"></i> Lihat Rekapitulasi
                    </a>
                    <a href="{{ route('documents.create') }}" class="btn-create-new">
                        <i class="fas fa-plus"></i> Buat Form
                    </a>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <form action="{{ route('documents.index') }}" method="GET"
                    style="display:flex; gap:20px; align-items:flex-end; flex-wrap:wrap;">
                    <div style="display:flex; flex-direction:column; gap:6px;">
                        <label
                            style="font-size:11px; font-weight:700; color:#64748b; letter-spacing: 0.05em;">BULAN</label>
                        <select name="month" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Bulan</option>
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="display:flex; flex-direction:column; gap:6px;">
                        <label
                            style="font-size:11px; font-weight:700; color:#64748b; letter-spacing: 0.05em;">TAHUN</label>
                        <select name="year" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Tahun</option>
                            @foreach($years as $y)
                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="display:flex; flex-direction:column; gap:6px;">
                        <label
                            style="font-size:11px; font-weight:700; color:#64748b; letter-spacing: 0.05em;">STATUS</label>
                        <div style="display:flex; align-items:center; gap:10px; height: 38px;">
                            <label class="toggle-switch">
                                <input type="checkbox" name="status_filter" value="final" onchange="this.form.submit()"
                                    {{ request('status_filter') == 'final' ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                            <span style="font-size:13px; color:var(--text-main); font-weight:500;">Hanya Final /
                                Publish</span>
                        </div>
                    </div>

                    @if(request()->hasAny(['month', 'year', 'status_filter']))
                        <div style="padding-bottom:10px;">
                            <a href="{{ route('documents.index') }}"
                                style="font-size:13px; color:var(--primary); text-decoration:none; font-weight:600; display:flex; align-items:center; gap:6px;">
                                <i class="fas fa-times"></i> Reset Filter
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            <div class="content-area">

                <!-- Stats Summary -->
                <div class="stats-grid">
                    <div class="stat-card active" onclick="filterByStatus('all', this)">
                        <div class="stat-icon icon-blue"><i class="fas fa-file-alt"></i></div>
                        <div class="stat-info"><span class="stat-label">Total Form</span><span
                                class="stat-value">{{ $documents->count() }}</span></div>
                    </div>
                    <div class="stat-card" onclick="filterByStatus('pending', this)">
                        <div class="stat-icon icon-orange"><i class="fas fa-clock"></i></div>
                        <div class="stat-info"><span class="stat-label">Menunggu</span><span
                                class="stat-value">{{ $myPending->count() }}</span></div>
                    </div>
                    <div class="stat-card" onclick="filterByStatus('revision', this)">
                        <div class="stat-icon icon-red"><i class="fas fa-redo"></i></div>
                        <div class="stat-info"><span class="stat-label">Perlu Revisi</span><span
                                class="stat-value">{{ $myRevision->count() }}</span></div>
                    </div>
                    <div class="stat-card" onclick="filterByStatus('approved', this)">
                        <div class="stat-icon icon-green"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info"><span class="stat-label">Disetujui</span><span
                                class="stat-value">{{ $documents->filter(fn($d) => $d->status == 'approved')->count() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Toolbar -->
                <div class="toolbar">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Cari judul form..." onkeyup="filterContent()">
                    </div>
                    <div class="view-toggles">
                        <button class="view-btn active" id="btnGrid" onclick="switchView('grid')"><i
                                class="fas fa-th-large"></i> Grid</button>
                        <button class="view-btn" id="btnList" onclick="switchView('list')"><i class="fas fa-list"></i>
                            List</button>
                    </div>
                </div>

                <!-- Grid View -->
                <div class="doc-grid" id="gridView">
                    @foreach($documents as $doc)
                        @php
                            // Determine Contexts (Normal or Split Revision)
                            $contexts = [];
                            if ($doc->status == 'revision') {
                                if ($doc->status_she == 'revision') $contexts[] = 'she_rev';
                                if ($doc->status_security == 'revision') $contexts[] = 'sec_rev';
                                // Fallback if general revision
                                if (empty($contexts)) $contexts[] = 'general_rev';
                            } else {
                                $contexts[] = 'normal';
                            }
                        @endphp

                        @foreach($contexts as $ctx)
                            @php
                                $statusKey = 'draft';
                                if (in_array($doc->status, ['pending_level1', 'pending_level2', 'pending_level3'])) {
                                    $statusKey = 'pending';
                                } elseif ($doc->status == 'revision') {
                                    $statusKey = 'revision';
                                } elseif ($doc->status == 'approved' || $doc->status == 'published') {
                                    $statusKey = 'approved';
                                }

                                // Override Labels based on Context
                                $ctxLabel = '';
                                $ctxClass = ''; // Use for styling overrides?
                                if ($ctx == 'she_rev') {
                                    $ctxLabel = 'Revisi SHE';
                                } elseif ($ctx == 'sec_rev') {
                                    $ctxLabel = 'Revisi Security';
                                }
                            @endphp

                            <div class="doc-card animate-item searchable-item"
                                data-title="{{ strtolower($doc->kolom2_kegiatan) }}" data-status="{{ $statusKey }}">

                                <div class="card-top">
                                    <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                        <span
                                            style="font-size:11px; padding:6px 10px; border-radius:8px; background:#f8fafc; color:#64748b; font-weight:600; display:flex; align-items:center; gap:4px; border:1px solid #e2e8f0;">
                                            <i class="fas fa-building" style="font-size:10px;"></i>
                                            {{ Str::limit($doc->unit->nama_unit ?? '-', 15) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="doc-title" title="{{ $doc->judul_dokumen ?? $doc->kolom2_kegiatan }}">
                                    {{ $doc->judul_dokumen ?? $doc->kolom2_kegiatan ?? 'Tanpa Judul' }}
                                </div>

                                <div class="doc-meta">
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <i class="far fa-calendar-alt"></i> {{ $doc->created_at->format('d M Y') }}
                                        <span style="color:#e2e8f0;">|</span>
                                        <i class="far fa-clock"></i> {{ $doc->created_at->format('H:i') }}
                                    </div>
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <i class="far fa-user-circle"></i> {{ $doc->user->nama_user ?? 'Unknown' }}
                                    </div>
                                </div>

                                <div class="status-container">
                                    @php
                                        $step = 1;
                                        $waitingFor = 'Anda';
                                        $position = 'Submitter';

                                        if ($statusKey == 'pending') {
                                            if ($doc->current_level == 1) {
                                                $position = 'Kepala Unit';
                                                $waitingFor = 'Ka. Unit ' . ($doc->unit->nama_unit ?? '');
                                                $step = 2;
                                            } elseif ($doc->current_level == 2) {
                                                $position = 'Unit Pengelola';
                                                $waitingFor = ($doc->kategori == 'Keamanan') ? 'Unit Keamanan' : 'Unit SHE';
                                                $step = 2;
                                            } elseif ($doc->current_level == 3) {
                                                $position = 'Kepala Dept';
                                                $waitingFor = 'Ka. Dept ' . ($doc->user->departemen->nama_dept ?? '');
                                                $step = 3;
                                            }
                                        } elseif ($statusKey == 'revision') {
                                            $position = 'Draft';
                                            $waitingFor = 'Anda (Revisi)';
                                            $step = 1;
                                        } elseif ($statusKey == 'approved') {
                                            $position = 'Final';
                                            $waitingFor = '-';
                                            $step = 4;
                                        }
                                    @endphp

                                    <!-- Stepper -->
                                    <div
                                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; padding: 0 10px;">
                                        @foreach(['Draft', 'Unit', 'Dept', 'Final'] as $index => $label)
                                            @php $i = $index + 1;
                                                $isActive = ($i <= $step);
                                            $isCurrent = ($i == $step); @endphp
                                            <div
                                                style="display: flex; flex-direction: column; align-items: center; gap: 6px; position: relative; width: 25%;">
                                                @if($i > 1)
                                                    <div
                                                        style="position: absolute; left: -50%; top: 5px; width: 100%; height: 2px; background: {{ $isActive ? '#c41e3a' : '#eaeaea' }}; z-index: 0;">
                                                    </div>
                                                @endif
                                                <div
                                                    style="width:{{ $isCurrent ? '12px' : '10px' }}; height:{{ $isCurrent ? '12px' : '10px' }}; border-radius: 50%; background: {{ $isActive ? '#c41e3a' : '#e5e7eb' }}; z-index: 1; border: 2px solid white; box-shadow: 0 0 0 1px {{ $isActive ? '#c41e3a' : '#e5e7eb' }};">
                                                </div>
                                                <span
                                                    style="font-size: 10px; font-weight: {{ $isCurrent ? '700' : '500' }}; color: {{ $isActive ? '#0f172a' : '#9ca3af' }};">{{ $label }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Action -->
                                    <div style="display:flex; justify-content:space-between; align-items:center;">
                                        <div style="font-size: 11px; line-height: 1.4;">
                                            @if($statusKey == 'approved')
                                                <div style="color:#059669; font-weight:700;"><i class="fas fa-check-circle"></i>
                                                    Selesai</div>
                                            @elseif($statusKey == 'revision')
                                                <div style="color:#dc2626; font-weight:700;">
                                                    <i class="fas fa-exclamation-circle"></i> {{ $ctxLabel ?: 'Perlu Revisi' }}
                                                </div>
                                            @else
                                                <div style="color:#d97706; font-weight:700;"><i class="fas fa-spinner fa-spin"></i>
                                                    Proses</div>
                                            @endif
                                        </div>

                                    @php
                                        // Determine Filter Param for URL
                                        $filterParam = [];
                                        if ($statusKey == 'revision') {
                                            if ($ctx == 'she_rev') $filterParam['filter'] = 'she';
                                            if ($ctx == 'sec_rev') $filterParam['filter'] = 'security';
                                        }
                                    @endphp
                                    <a href="{{ route('documents.show', array_merge(['document' => $doc->id], $filterParam)) }}" class="view-link">
                                        {{ $statusKey == 'revision' ? 'Perbaiki' : 'Detail' }} <i
                                            class="fas fa-arrow-right"></i>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>

                <!-- List View (Table) -->
                <div class="doc-table-container" id="listView">
                    <table class="doc-table">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Judul Form</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $doc)
                                @php
                                    $statusKey = 'draft';
                                    if (in_array($doc->status, ['pending_level1', 'pending_level2', 'pending_level3'])) {
                                        $statusKey = 'pending';
                                    } elseif ($doc->status == 'revision') {
                                        $statusKey = 'revision';
                                    } elseif ($doc->status == 'approved') {
                                        $statusKey = 'approved';
                                    }
                                @endphp
                                <tr class="searchable-item" data-title="{{ strtolower($doc->kolom2_kegiatan) }}"
                                    data-status="{{ $statusKey }}">
                                    <td>
                                        <span
                                            class="cat-badge {{ $doc->kategori == 'K3' ? 'cat-k3' : ($doc->kategori == 'Lingkungan' ? 'cat-lingkungan' : 'cat-keamanan') }}">
                                            {{ $doc->kategori }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; color: #333;">
                                            {{ Str::limit($doc->judul_dokumen ?? $doc->kolom2_kegiatan, 50) }}</div>
                                    </td>
                                    <td>{{ $doc->created_at->format('d M Y') }}</td>
                                    <td>
                                        @php
                                            $stClass = 'st-draft';
                                            $stText = 'Draft';
                                            if ($statusKey == 'pending') {
                                                $stClass = 'st-pending';
                                                $stText = 'Menunggu';
                                            } elseif ($statusKey == 'revision') {
                                                $stClass = 'st-revision';
                                                $stText = 'Revisi';
                                            } elseif ($statusKey == 'approved') {
                                                $stClass = 'st-approved';
                                                $stText = 'Disetujui';
                                            }
                                        @endphp
                                        <span class="status-pill {{ $stClass }}">{{ $stText }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('documents.show', $doc->id) }}" class="view-link"
                                            style="border:none; padding:4px 0; background:transparent;">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>

    <script>
        let currentStatusFilter = 'all';

        function switchView(view) {
            const grid = document.getElementById('gridView');
            const list = document.getElementById('listView');
            const btnGrid = document.getElementById('btnGrid');
            const btnList = document.getElementById('btnList');

            if (view === 'grid') {
                grid.style.display = 'grid';
                list.style.display = 'none';
                btnGrid.classList.add('active');
                btnList.classList.remove('active');
            } else {
                grid.style.display = 'none';
                list.style.display = 'block';
                btnGrid.classList.remove('active');
                btnList.classList.add('active');
            }
        }

        function filterByStatus(status, card) {
            currentStatusFilter = status;
            document.querySelectorAll('.stat-card').forEach(c => c.classList.remove('active'));
            card.classList.add('active');
            filterContent();
        }

        function filterContent() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const items = document.querySelectorAll('.searchable-item');

            items.forEach(item => {
                const title = item.getAttribute('data-title');
                const status = item.getAttribute('data-status');
                const matchesSearch = title.includes(input);
                const matchesStatus = (currentStatusFilter === 'all') || (status === currentStatusFilter);

                if (matchesSearch && matchesStatus) {
                    item.style.display = item.classList.contains('doc-card') ? 'flex' : 'table-row';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>