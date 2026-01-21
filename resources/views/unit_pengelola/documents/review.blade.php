<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen (Unit Pengelola) - HIRADC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #c41e3a;
            --primary-light: #fff1f2;
            --secondary: #64748b;
            --bg-body: #f1f5f9;
            --surface: #ffffff;
            --text-main: #1e293b;
            --text-sub: #64748b;
            --border: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            padding-bottom: 120px;
        }

        .container {
            display: flex;
            min-height: 100vh;
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
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 13px;
            color: white;
        }

        .user-role {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.85);
            margin-top: 2px;
        }

        .logout-btn {
            width: 100%;
            padding: 8px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 32px 48px 150px 48px;
            /* Bottom padding to clear fixed footer */
            max-width: 1400px;
            margin-right: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 32px;
        }

        .header-title h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.03em;
            margin-bottom: 4px;
        }

        .header-title p {
            font-size: 14px;
            color: var(--text-sub);
        }

        .btn-back {
            padding: 8px 16px;
            border-radius: 6px;
            background: white;
            border: 1px solid var(--border);
            color: var(--text-main);
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: var(--bg-body);
            border-color: var(--text-sub);
        }

        /* Cards */
        .doc-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .doc-header {
            background: #f8fafc;
            padding: 20px 32px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .doc-title-label {
            font-size: 12px;
            color: var(--text-sub);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }

        .doc-title-value {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-main);
        }

        .doc-meta-badge {
            background: var(--primary-light);
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .card-header-slim {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border);
            background: #f8fafc;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-header-slim i {
            color: var(--primary);
        }

        .card-header-slim h2 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
        }

        .doc-body {
            padding: 24px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-sub);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-size: 14px;
            color: var(--text-main);
            background: white;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .read-only-mode .form-control {
            background: #f1f5f9;
            cursor: not-allowed;
        }

        /* Risk Matrix */
        .risk-result-box {
            background: #1f2937;
            color: white;
            padding: 16px;
            border-radius: 12px;
            text-align: center;
        }

        .risk-score {
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }

        .risk-level {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.2);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Action Footer */
        .review-footer {
            position: fixed;
            bottom: 0;
            left: 250px;
            right: 0;
            background: white;
            padding: 20px 48px;
            border-top: 1px solid var(--border);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.05);
            z-index: 100;
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .notes-area {
            flex: 1;
        }

        .notes-area label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 6px;
            display: block;
        }

        .notes-input {
            width: 100%;
            height: 80px;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-family: inherit;
            font-size: 14px;
            resize: none;
        }

        .notes-input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .action-btns {
            display: flex;
            gap: 12px;
            align-items: flex-end;
        }

        .btn {
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: transform 0.1s;
            display: flex;
            align-items: center;
            gap: 8px;
            height: 50px;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-approve {
            background: #16a34a;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2);
        }

        .btn-approve:hover {
            background: #15803d;
        }

        .btn-revise {
            background: #dc2626;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.2);
        }

        .btn-revise:hover {
            background: #b91c1c;
        }

        /* Checkboxes */
        .checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 12px;
        }

        .checkbox-card {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }

        .checkbox-card input {
            accent-color: var(--primary);
            transform: scale(1.1);
        }

        .hidden {
            display: none;
        }

        /* TABLE STYLES (Excel-like) */
        .hiradc-wrapper {
            overflow-x: auto;
            background: white;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            border-radius: 8px;
            margin-bottom: 40px;
        }

        .excel-table {
            width: max-content;
            min-width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 13px;
        }

        .excel-table thead th {
            background: #1e293b;
            color: #ffffff;
            padding: 12px;
            border-right: 1px solid #334155;
            border-bottom: 1px solid #334155;
            text-align: center;
            vertical-align: middle;
            font-weight: 600;
            text-transform: uppercase;
        }

        .excel-table thead tr:first-child th {
            background: #0f172a;
            border-bottom: 1px solid #334155;
        }

        .excel-table tbody td {
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
            padding: 12px;
            color: #334155;
            line-height: 1.5;
        }

        /* Borders */
        .section-border-right {
            border-right: 3px solid #94a3b8 !important;
        }

        /* Form Controls in Table */
        .excel-table .form-control {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            font-size: 12px;
            padding: 8px;
            min-width: 150px;
        }

        .excel-table textarea.form-control {
            min-height: 80px;
        }

        .excel-table select.form-control {
            min-width: 100px;
        }

        /* Risk Logic */
        .risk-score-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-height: 60px;
            padding: 10px;
            background: #f1f5f9;
            border-radius: 8px;
        }

        .risk-val {
            font-size: 18px;
            font-weight: 800;
            color: #1e293b;
        }

        .risk-badge {
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 10px;
            margin-top: 4px;
            font-weight: 700;
            color: white;
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

        .bg-high {
            background: #dc2626;
        }

        /* Toggle Edit Styles */
        .readonly-mode {
            background-color: transparent !important;
            border: 1px solid transparent !important;
            box-shadow: none !important;
            resize: none;
            cursor: default !important;
            color: #334155 !important;
            padding-left: 0 !important;
        }

        .readonly-mode:focus {
            outline: none !important;
            box-shadow: none !important;
            border-color: transparent !important;
        }

        .edit-mode {
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .btn-edit-row {
            background: none;
            border: none;
            cursor: pointer;
            color: #94a3b8;
            padding: 4px;
            font-size: 13px;
            margin-left: 4px;
            transition: color 0.2s;
        }

        .btn-edit-row:hover {
            color: #3b82f6;
        }

        .btn-editing {
            color: #ef4444 !important;
        }

        /* Timeline Styles */
        .history-card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
            padding: 24px;
            margin-top: 40px;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }

        .section-heading {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .timeline {
            position: relative;
            padding-left: 20px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 10px;
            bottom: 30px;
            width: 2px;
            background: #e2e8f0;
        }

        .timeline-item {
            position: relative;
            padding-left: 30px;
            margin-bottom: 32px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            left: 13px;
            top: 5px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: white;
            border: 4px solid #cbd5e1;
            z-index: 2;
        }

        .timeline-item.active .timeline-dot {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.2);
        }

        .timeline-date {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-sub);
            margin-bottom: 4px;
        }

        .timeline-content {
            background: #f8fafc;
            border-radius: 8px;
            padding: 16px;
            border: 1px solid var(--border);
        }

        .timeline-user {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .timeline-action {
            font-size: 13px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .timeline-note {
            font-size: 13px;
            color: var(--text-sub);
            font-style: italic;
            padding-top: 8px;
            border-top: 1px solid #e2e8f0;
            margin-top: 8px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
                overflow: hidden;
            }

            .sidebar .logo-text,
            .sidebar .logo-subtext,
            .sidebar .nav-item span,
            .sidebar .user-details,
            .sidebar .logout-btn {
                display: none;
            }

            .sidebar .user-info-bottom {
                padding: 10px;
            }

            .sidebar .logo-section {
                padding: 15px 5px;
            }

            .sidebar .nav-item {
                justify-content: center;
                padding: 15px;
            }

            .user-profile {
                justify-content: center;
                margin-bottom: 0;
            }

            .user-avatar {
                margin: 0;
            }

            .main-content {
                margin-left: 80px;
                padding: 24px;
            }

            .review-footer {
                left: 80px;
                padding: 15px 24px;
            }
        }

        /* Mobile Sidebar */
        @media (max-width: 768px) {
            .sidebar {
                display: flex;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1000;
                width: 250px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .sidebar .logo-text,
            .sidebar .logo-subtext,
            .sidebar .nav-item span,
            .sidebar .user-details,
            .sidebar .logout-btn {
                display: block;
                /* Restore content for mobile drawer */
            }

            .sidebar .nav-item {
                justify-content: flex-start;
            }

            .user-profile {
                justify-content: flex-start;
            }

            .toggle-sidebar-btn {
                display: flex !important;
            }
        }

        .toggle-sidebar-btn {
            display: none;
            background: white;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 20px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
        }

        /* Modal Edit Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: none;
            justify-content: center;
            align-items: flex-start;
            padding-top: 50px;
            overflow-y: auto;
        }

        .modal-content {
            background: white;
            width: 90%;
            max-width: 900px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            margin-bottom: 50px;
            animation: slideDown 0.3s ease;
            position: relative;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 20px 30px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            color: #94a3b8;
            cursor: pointer;
        }

        .modal-body {
            padding: 30px;
        }

        .modal-form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .modal-form-group {
            margin-bottom: 20px;
        }

        .modal-form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .modal-form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            background: #f9fafb;
        }

        .modal-form-control:focus {
            outline: none;
            border-color: #ef4444;
            background: white;
        }

        .modal-footer {
            padding: 20px 30px;
            border-top: 1px solid #f3f4f6;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            background: #f8fafc;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }
    </style>
</head>

<body>
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="logo-section">
                <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System (Unit Pengelola)</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('unit_pengelola.dashboard') }}" class="nav-item"><i
                        class="fas fa-th-large"></i><span>Dashboard</span></a>
                <a href="{{ route('unit_pengelola.check_documents') }}" class="nav-item active"><i
                        class="fas fa-file-signature"></i><span>Cek Dokumen</span></a>
            </nav>
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
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="fas fa-sign-out-alt"></i> Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Mobile Toggle -->
            <button class="toggle-sidebar-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars" style="font-size: 20px; color: var(--text-main);"></i>
            </button>

            <!-- Doc Header Banner -->
            <div class="doc-banner"
                style="display: flex; justify-content: space-between; align-items: start; background: white; border-radius: 12px; padding: 24px; border: 1px solid var(--border); box-shadow: var(--shadow-sm); margin-bottom: 30px;">
                <div class="doc-banner-left">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                        <h1 style="font-size: 24px; font-weight: 800; color: var(--text-main); margin: 0;">
                            {{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}
                        </h1>
                        <!-- History Dropdown Icon -->
                        <div style="position: relative;">
                            <button type="button" id="historyToggle"
                                onclick="var d = document.getElementById('historyDropdown'); if(d.style.display === 'none' || d.style.display === '') { var rect = this.getBoundingClientRect(); d.style.top = (rect.bottom + 5) + 'px'; d.style.left = rect.left + 'px'; d.style.display = 'block'; } else { d.style.display = 'none'; }"
                                style="background: #e2e8f0; border: none; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;"
                                onmouseover="this.style.background='#cbd5e1'"
                                onmouseout="this.style.background='#e2e8f0'">
                                <i class="fas fa-info-circle" style="color: #475569; font-size: 16px;"></i>
                            </button>
                            <!-- Dropdown History -->
                            <div id="historyDropdown"
                                style="display: none; position: fixed; background: white; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); width: 450px; max-height: 500px; overflow-y: auto; z-index: 9999;">
                                <div
                                    style="padding: 16px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; border-radius: 12px 12px 0 0;">
                                    <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: var(--text-main);">
                                        <i class="fas fa-history" style="color: var(--primary); margin-right: 8px;"></i>
                                        Riwayat Dokumen
                                    </h3>
                                </div>
                                <div style="padding: 16px;">
                                    @php
                                        $allLogs = collect();

                                        // 1. Created
                                        $allLogs->push([
                                            'action' => 'created',
                                            'approver' => $document->user,
                                            'created_at' => $document->created_at,
                                            'catatan' => null
                                        ]);

                                        // 2. Approvals
                                        foreach ($document->approvals as $approval) {
                                            $allLogs->push([
                                                'action' => $approval->action,
                                                'approver' => $approval->approver,
                                                'created_at' => $approval->created_at,
                                                'catatan' => $approval->catatan
                                            ]);
                                        }

                                        $allLogs = $allLogs->sortBy('created_at');
                                    @endphp

                                    @forelse($allLogs as $index => $log)
                                        @php
                                            $isFirst = $index === 0;
                                            switch ($log['action']) {
                                                case 'created':
                                                    $actionLabel = 'Form Dibuat';
                                                    $actionColor = '#10b981';
                                                    $icon = 'fa-file-alt';
                                                    break;
                                                case 'approved':
                                                    $actionLabel = 'Disetujui';
                                                    $actionColor = '#10b981';
                                                    $icon = 'fa-check-circle';
                                                    break;
                                                case 'revised':
                                                    $actionLabel = 'Dikembalikan untuk Revisi';
                                                    $actionColor = '#ef4444';
                                                    $icon = 'fa-undo';
                                                    break;
                                                case 'disposition':
                                                    $actionLabel = 'Didisposisi ke Staff';
                                                    $actionColor = '#f59e0b';
                                                    $icon = 'fa-user-clock';
                                                    break;
                                                case 'reviewed':
                                                    $actionLabel = 'Direview oleh Staff';
                                                    $actionColor = '#8b5cf6';
                                                    $icon = 'fa-glasses';
                                                    break;
                                                case 'verified':
                                                    $actionLabel = 'Diverifikasi oleh Staff';
                                                    $actionColor = '#06b6d4';
                                                    $icon = 'fa-clipboard-check';
                                                    break;
                                                default:
                                                    $actionLabel = ucfirst($log['action']);
                                                    $actionColor = '#64748b';
                                                    $icon = 'fa-circle';
                                            }
                                        @endphp

                                        <div
                                            style="padding: 12px; border-left: 3px solid {{ $actionColor }}; margin-bottom: 12px; background: #f8fafc; border-radius: 6px;">
                                            <div
                                                style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 6px;">
                                                <div style="font-weight: 600; color: {{ $actionColor }}; font-size: 13px;">
                                                    <i class="fas {{ $icon }}" style="margin-right: 6px;"></i>
                                                    {{ $actionLabel }}
                                                </div>
                                                <div style="font-size: 11px; color: #64748b;">
                                                    {{ $log['created_at']->format('d M Y, H:i') }} WIB
                                                </div>
                                            </div>
                                            <div style="font-size: 12px; color: #475569; margin-bottom: 4px;">
                                                <i class="fas fa-user" style="margin-right: 6px; font-size: 10px;"></i>
                                                {{ optional($log['approver'])->nama_user ?? 'System' }}
                                                <span style="color: #94a3b8;">•</span>
                                                {{ optional($log['approver'])->role_jabatan_name ?? 'Submitter' }}
                                            </div>
                                            @if($log['catatan'])
                                                <div
                                                    style="font-size: 12px; color: #64748b; font-style: italic; margin-top: 6px; padding: 8px; background: white; border-radius: 4px;">
                                                    "{{ $log['catatan'] }}"
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <div style="text-align: center; padding: 20px; color: #94a3b8; font-size: 13px;">
                                            Belum ada riwayat
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                        <span class="doc-meta-badge" style="background: #e2e8f0; color: #475569;"><i
                                class="fas fa-building"></i> {{ $document->unit->nama_unit ?? '-' }}</span>
                        <span class="doc-meta-badge" style="background: #e2e8f0; color: #475569;"><i
                                class="far fa-clock"></i> {{ $document->created_at->format('d M Y') }}</span>
                        <span class="doc-meta-badge" style="background: #dbeafe; color: #1e40af;"><i
                                class="fas fa-user"></i> {{ optional($document->user)->nama_user ?? 'Unknown' }}</span>
                    </div>
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <a href="{{ route('documents.export.detail.pdf', $document->id) }}" target="_blank"
                        style="padding: 8px 12px; background: #e74c3c; color: white; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: flex; align-items: center;">
                        <i class="fas fa-file-pdf" style="margin-right: 5px;"></i> PDF
                    </a>
                    <a href="{{ route('documents.export.detail.excel', $document->id) }}" target="_blank"
                        style="padding: 8px 12px; background: #27ae60; color: white; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: flex; align-items: center;">
                        <i class="fas fa-file-excel" style="margin-right: 5px;"></i> Excel
                    </a>
                    <a href="{{ route('unit_pengelola.check_documents') }}" class="btn-back"><i
                            class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>

            <!-- Table Layout Implementation -->
            <!-- Table Layout Implementation -->
            <!-- Form for Approval -->
            <form id="approveForm" method="POST"
                action="{{ route('unit_pengelola.approve', ['document' => $document->id]) }}">
                @csrf
                <input type="hidden" name="catatan" id="catatan_input_approve">
            </form>

            <!-- Form for Revision -->
            <form id="reviseForm" method="POST"
                action="{{ route('unit_pengelola.revise', ['document' => $document->id]) }}">
                @csrf
                <input type="hidden" name="catatan" id="catatan_input_revise">
            </form>

            <!-- Wrapper Div for Table (Outside Forms) -->
            @php
                $user = Auth::user();
                $status = $document->level2_status;
                $isHead = ($user->role_jabatan == 3); // Kepala Unit Pengelola
                $isReviewer = ($document->level2_reviewer_id == $user->id_user);
                $isApprover = ($document->level2_approver_id == $user->id_user);
                // Allow edit if reviewer (assigned) or approver (assigned) or explicitly active
                $isEditable = ($isReviewer && $status == 'assigned_review') || ($isApprover && $status == 'assigned_approval');
            @endphp
            <!-- Wrapper Div for Table (Outside Forms) -->
            <div class="hiradc-wrapper">
                <table class="excel-table">
                    <thead>
                        <!-- Header Row 1: Groups -->
                        <tr>
                            <th rowspan="2" style="width: 50px;">No</th>
                            <th colspan="4" class="section-border-right">Kegiatan & Situasi</th>
                            <th colspan="3" class="section-border-right">Identifikasi Bahaya & Risiko</th>
                            <th colspan="2" class="section-border-right">Pengendalian Risiko</th>
                            <th colspan="3" class="section-border-right">Penilaian Risiko Awal</th>
                            <th rowspan="2" style="width: 250px;">Peraturan / Regulasi</th>
                            <th rowspan="2" style="width: 100px;" class="section-border-right">Penting / TP</th>
                            <th colspan="5">Penilaian Risiko Sisa & Tindak Lanjut</th>
                        </tr>
                        <!-- Header Row 2: Columns -->
                        <tr>
                            <th style="width: 200px;">Kegiatan / Proses</th>
                            <th style="width: 100px;">Kategori</th>
                            <th style="width: 150px;">Lokasi</th>
                            <th style="width: 100px;" class="section-border-right">Kondisi</th>
                            <th style="width: 250px;">Potensi Bahaya</th>
                            <th style="width: 220px;">Dampak / Konsekuensi</th>
                            <th style="width: 220px;" class="section-border-right">Risiko & Peluang</th>
                            <th style="width: 300px;">Hirarki Pengendalian</th>
                            <th style="width: 250px;" class="section-border-right">Pengendalian Existing</th>
                            <th style="width: 60px;">L</th>
                            <th style="width: 60px;">S</th>
                            <th style="width: 80px;" class="section-border-right">Level</th>
                            <th style="width: 200px;">Tindak Lanjut</th>
                            <th style="width: 60px;">L</th>
                            <th style="width: 60px;">S</th>
                            <th style="width: 80px;">Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($document->details as $index => $item)
                            <tr data-json="{{ json_encode($item) }}">
                                <td style="text-align:center; padding-top:20px; font-size:14px; color:#1e293b;">
                                    {{ $index + 1 }}
                                    @if($isEditable)
                                        <button type="button" class="btn-edit-row" onclick="openEditModal(this, {{ $index }})"
                                            title="Edit Baris" style="display:block; margin: 4px auto;">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Hidden ID -->
                                        <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}"
                                            form="staffActionForm">
                                    @endif
                                </td>
                                <!-- Kegiatan -->
                                <td>
                                    <div class="display-val" data-col="kolom2_kegiatan">{{ $item->kolom2_kegiatan }}</div>
                                    @if($isEditable)
                                        <input type="hidden" name="items[{{ $index }}][kolom2_kegiatan]"
                                            value="{{ $item->kolom2_kegiatan }}" form="staffActionForm" class="input-val">
                                    @endif
                                </td>
                                <!-- Kategori -->
                                <td>
                                    <div class="cell-input"
                                        style="display:flex; align-items:center; justify-content:center;">
                                        <span class="doc-meta-badge" style="background:#e0e7ff; color:#3730a3;">
                                            {{ $item->kategori }}
                                        </span>
                                    </div>
                                </td>
                                <!-- Lokasi -->
                                <td>
                                    <div class="display-val" data-col="kolom3_lokasi">{{ $item->kolom3_lokasi }}</div>
                                    @if($isEditable)
                                        <input type="hidden" name="items[{{ $index }}][kolom3_lokasi]"
                                            value="{{ $item->kolom3_lokasi }}" form="staffActionForm" class="input-val">
                                    @endif
                                </td>
                                <!-- Kondisi -->
                                <td class="section-border-right">
                                    <div class="cell-input"
                                        style="display:flex; align-items:center; justify-content:center;">
                                        <span class="doc-meta-badge" style="background:#f1f5f9; color:#475569;">
                                            {{ $item->kolom5_kondisi == 'N' ? 'Normal' : ($item->kolom5_kondisi == 'AN' ? 'Abnormal' : 'Emergency') }}
                                        </span>
                                    </div>
                                </td>
                                <!-- Bahaya -->
                                <td>
                                    <div class="cell-checkbox-group">
                                        @if(!empty($item->kolom6_bahaya['manual']))
                                            <div
                                                style="font-size:13px; margin-bottom:8px; padding:6px; background:#fef2f2; border:1px dashed #f87171; border-radius:4px; color:#991b1b;">
                                                <strong>Lainnya:</strong> {{ $item->kolom6_bahaya['manual'] }}
                                            </div>
                                        @endif
                                        @php
                                            $bahayaDetails = [];
                                            if (!empty($item->kolom6_bahaya['details']))
                                                $bahayaDetails = array_merge($bahayaDetails, $item->kolom6_bahaya['details']);
                                            if (!empty($item->kolom6_bahaya['aspects']))
                                                $bahayaDetails = array_merge($bahayaDetails, $item->kolom6_bahaya['aspects']);
                                            if (!empty($item->kolom6_bahaya['threats']))
                                                $bahayaDetails = array_merge($bahayaDetails, $item->kolom6_bahaya['threats']);
                                        @endphp
                                        @foreach($bahayaDetails as $detail)
                                            <div class="cell-checkbox-item">
                                                <i class="fas fa-exclamation-triangle"
                                                    style="color:#ef4444; font-size:10px; margin-top:3px;"></i>
                                                <span>{{ $detail }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <!-- Dampak -->
                                <td>
                                    <div class="display-val" data-col="kolom7_dampak">{{ $item->kolom7_dampak }}</div>
                                    @if($isEditable)
                                        <input type="hidden" name="items[{{ $index }}][kolom7_dampak]"
                                            value="{{ $item->kolom7_dampak }}" form="staffActionForm" class="input-val">
                                    @endif
                                </td>
                                <!-- Risiko & Peluang -->
                                <td class="section-border-right">
                                <td class="section-border-right">
                                    <div class="risk-section">
                                        <div class="risk-label">IDENTIFIKASI:</div>
                                        <div class="risk-text display-val" data-col="kolom9_risiko">
                                            {{ $item->kolom9_risiko }}
                                        </div>
                                        <div class="risk-label" style="border-top:1px solid #e2e8f0; margin-top:8px;">RISIKO
                                            (-):</div>
                                        <div class="risk-text display-val" data-col="kolom17_risiko">
                                            {{ $item->kolom17_risiko }}
                                        </div>
                                        <div class="risk-label" style="border-top:1px solid #e2e8f0; margin-top:8px;">
                                            PELUANG (+):</div>
                                        <div class="risk-text display-val" data-col="kolom17_peluang">
                                            {{ $item->kolom17_peluang }}
                                        </div>
                                    </div>
                                    @if($isEditable)
                                        <input type="hidden" name="items[{{ $index }}][kolom9_risiko]"
                                            value="{{ $item->kolom9_risiko }}" form="staffActionForm" class="input-val">
                                        <input type="hidden" name="items[{{ $index }}][kolom17_risiko]"
                                            value="{{ $item->kolom17_risiko }}" form="staffActionForm" class="input-val">
                                        <input type="hidden" name="items[{{ $index }}][kolom17_peluang]"
                                            value="{{ $item->kolom17_peluang }}" form="staffActionForm" class="input-val">
                                    @endif
                                </td>
                                </td>
                                <!-- Pengendalian Hierarchy -->
                                <td>
                                    <div class="cell-checkbox-group">
                                        @php $hs = $item->kolom10_pengendalian['hierarchy'] ?? []; @endphp
                                        @foreach($hs as $h)
                                            <div class="cell-checkbox-item">
                                                <i class="fas fa-check-square" style="color:#10b981;"></i>
                                                <span style="font-weight:600;">{{ $h }}</span>
                                            </div>
                                        @endforeach
                                        @if(!empty($item->kolom10_pengendalian['new_controls']))
                                            <div style="margin-top:10px; padding-top:10px; border-top:1px dashed #cbd5e1;">
                                                <strong style="font-size:11px; color:#c2410c;">DETAIL PENGENDALIAN:</strong>
                                                @foreach($item->kolom10_pengendalian['new_controls'] as $ctrl)
                                                    <div style="font-size:12px; margin-top:4px;">
                                                        <span
                                                            style="background:#fff7ed; color:#c2410c; padding:2px 6px; border-radius:4px; font-size:10px; font-weight:700;">{{ $ctrl['type'] ?? 'Tipe?' }}</span>
                                                        <span style="color:#334155;">{{ $ctrl['desc'] ?? '-' }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <!-- Existing -->
                                <td class="section-border-right">
                                    <div class="display-val" data-col="kolom11_existing">{{ $item->kolom11_existing }}</div>
                                    @if($isEditable)
                                        <input type="hidden" name="items[{{ $index }}][kolom11_existing]"
                                            value="{{ $item->kolom11_existing }}" form="staffActionForm" class="input-val">
                                    @endif
                                </td>
                                <!-- RISK INITIAL -->
                                <td class="risk-col section-border-right" style="vertical-align:middle; text-align:center;">
                                    <div class="display-val" data-col="kolom12_kemungkinan"
                                        style="font-weight:800; font-size:16px;">{{ $item->kolom12_kemungkinan }}</div>
                                    @if($isEditable)
                                        <input type="hidden" name="items[{{ $index }}][kolom12_kemungkinan]"
                                            value="{{ $item->kolom12_kemungkinan }}" form="staffActionForm" class="input-val">
                                    @endif
                                </td>
                                <td class="risk-col section-border-right" style="vertical-align:middle; text-align:center;">
                                    <div class="display-val" data-col="kolom13_konsekuensi"
                                        style="font-weight:800; font-size:16px;">{{ $item->kolom13_konsekuensi }}</div>
                                    @if($isEditable)
                                        <input type="hidden" name="items[{{ $index }}][kolom13_konsekuensi]"
                                            value="{{ $item->kolom13_konsekuensi }}" form="staffActionForm" class="input-val">
                                    @endif
                                </td>
                                <td class="risk-col section-border-right" style="vertical-align:middle;">
                                    <div class="risk-score-box">
                                        <div class="risk-val">{{ $item->kolom14_score }}</div>
                                        <div
                                            class="risk-badge {{ $item->kolom14_score >= 15 ? 'bg-high' : ($item->kolom14_score >= 8 ? 'bg-med' : 'bg-low') }}">
                                            {{ $item->risk_level }}
                                        </div>
                                    </div>
                                </td>
                                <!-- Regulasi -->
                                <td class="section-border-right">
                                    <div class="display-val" data-col="kolom15_regulasi">{{ $item->kolom15_regulasi }}</div>
                                    @if($isEditable)
                                        <input type="hidden" name="items[{{ $index }}][kolom15_regulasi]"
                                            value="{{ $item->kolom15_regulasi }}" form="staffActionForm" class="input-val">
                                    @endif
                                </td>
                                <!-- Penting (Col 16) -->
                                <td class="section-border-right" style="text-align:center; vertical-align:middle;">
                                    <div class="doc-meta-badge"
                                        style="{{ $item->kolom16_aspek == 'P' ? 'background:#dbeafe; color:#1e40af;' : 'background:#f1f5f9; color:#64748b;' }}">
                                        {{ $item->kolom16_aspek }}
                                    </div>
                                </td>
                                <!-- Tindak Lanjut -->
                                <td>
                                    <div class="display-val" data-col="kolom18_tindak_lanjut">
                                        {{ $item->kolom18_tindak_lanjut }}
                                    </div>
                                    @if($isEditable)
                                        <input type="hidden" name="items[{{ $index }}][kolom18_tindak_lanjut]"
                                            value="{{ $item->kolom18_tindak_lanjut }}" form="staffActionForm" class="input-val">
                                    @endif
                                </td>
                                <!-- RISK RESIDUAL -->
                                <td class="risk-col section-border-right" style="vertical-align:middle; text-align:center;">
                                    <div class="display-val" data-col="residual_kemungkinan"
                                        style="font-weight:800; font-size:16px;">{{ $item->residual_kemungkinan }}</div>
                                    @if($isEditable)
                                        <input type="hidden" name="items[{{ $index }}][residual_kemungkinan]"
                                            value="{{ $item->residual_kemungkinan }}" form="staffActionForm" class="input-val">
                                    @endif
                                </td>
                                <td class="risk-col section-border-right" style="vertical-align:middle; text-align:center;">
                                    <div class="display-val" data-col="residual_konsekuensi"
                                        style="font-weight:800; font-size:16px;">{{ $item->residual_konsekuensi }}</div>
                                    @if($isEditable)
                                        <input type="hidden" name="items[{{ $index }}][residual_konsekuensi]"
                                            value="{{ $item->residual_konsekuensi }}" form="staffActionForm" class="input-val">
                                    @endif
                                </td>
                                <td class="risk-col" style="vertical-align:middle;">
                                    <div class="risk-score-box">
                                        <div class="risk-val">{{ $item->residual_score ?? '-' }}</div>
                                        @if($item->residual_score)
                                            <div
                                                class="risk-badge {{ $item->residual_score >= 15 ? 'bg-high' : ($item->residual_score >= 8 ? 'bg-med' : 'bg-low') }}">
                                                {{ $item->residual_score >= 15 ? 'HIGH' : ($item->residual_score >= 8 ? 'MED' : 'LOW') }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            @php
                $user = Auth::user();
                $isHead = $user->isUnitPengelola();
                $isReviewer = ($document->level2_reviewer_id == $user->id_user);
                $isApprover = ($document->level2_approver_id == $user->id_user);
                $status = $document->level2_status;
            @endphp

            <!-- Modal Edit Form -->
            <div id="editModal" class="modal-overlay">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fas fa-edit" style="color: #ef4444; margin-right:8px;"></i> Edit Data Review</h3>
                        <button class="modal-close" onclick="closeEditModal()">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="modal_index">

                        <!-- 1. Basic Info -->
                        <div class="modal-form-grid-2">
                            <div class="modal-form-group">
                                <label class="modal-form-label">Kegiatan</label>
                                <textarea id="modal_kegiatan" class="modal-form-control" rows="2"></textarea>
                            </div>
                            <div class="modal-form-group">
                                <label class="modal-form-label">Lokasi</label>
                                <textarea id="modal_lokasi" class="modal-form-control" rows="2"></textarea>
                            </div>
                        </div>

                        <!-- 2. Risk & Impact -->
                        <div class="modal-form-grid-2">
                            <div class="modal-form-group">
                                <label class="modal-form-label">Dampak / Konsekuensi</label>
                                <textarea id="modal_dampak" class="modal-form-control" rows="3"></textarea>
                            </div>
                            <div class="modal-form-group">
                                <label class="modal-form-label">Identifikasi Risiko</label>
                                <textarea id="modal_risiko_ident" class="modal-form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-form-grid-2">
                            <div class="modal-form-group">
                                <label class="modal-form-label">Risiko Negatif (-)</label>
                                <textarea id="modal_risiko_neg" class="modal-form-control" rows="2"></textarea>
                            </div>
                            <div class="modal-form-group">
                                <label class="modal-form-label">Peluang Positif (+)</label>
                                <textarea id="modal_risiko_pos" class="modal-form-control" rows="2"></textarea>
                            </div>
                        </div>

                        <hr style="border:0; border-top:1px solid #e2e8f0; margin: 20px 0;">

                        <!-- 3. Controls & Existing -->
                        <div class="modal-form-group">
                            <label class="modal-form-label">Existing Controls</label>
                            <textarea id="modal_existing" class="modal-form-control" rows="3"></textarea>
                        </div>

                        <!-- 4. Initial Risk Score -->
                        <div
                            style="background:#f8fafc; padding:15px; border-radius:8px; border:1px solid #e2e8f0; margin-bottom:20px;">
                            <div class="modal-form-label" style="margin-bottom:10px;">PENILAIAN RISIKO AWAL</div>
                            <div class="modal-form-grid-2">
                                <div class="modal-form-group">
                                    <label class="modal-form-label">Likelihood (L)</label>
                                    <select id="modal_initial_l" class="modal-form-control">
                                        <option value="1">1 - Sangat Jarang</option>
                                        <option value="2">2 - Jarang</option>
                                        <option value="3">3 - Kadang-kadang</option>
                                        <option value="4">4 - Sering</option>
                                        <option value="5">5 - Sangat Sering</option>
                                    </select>
                                </div>
                                <div class="modal-form-group">
                                    <label class="modal-form-label">Consequence (S)</label>
                                    <select id="modal_initial_s" class="modal-form-control">
                                        <option value="1">1 - Tidak Signifikan</option>
                                        <option value="2">2 - Minor</option>
                                        <option value="3">3 - Moderate</option>
                                        <option value="4">4 - Major</option>
                                        <option value="5">5 - Catastrophic</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Regulasi & Tindak Lanjut -->
                        <div class="modal-form-grid-2">
                            <div class="modal-form-group">
                                <label class="modal-form-label">Regulasi / Peraturan</label>
                                <textarea id="modal_regulasi" class="modal-form-control" rows="3"></textarea>
                            </div>
                            <div class="modal-form-group">
                                <label class="modal-form-label">Tindak Lanjut</label>
                                <textarea id="modal_tindaklanjut" class="modal-form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <!-- 6. Residual Risk Score -->
                        <div
                            style="background:#f0fdf4; padding:15px; border-radius:8px; border:1px solid #bbf7d0; margin-bottom:20px;">
                            <div class="modal-form-label" style="margin-bottom:10px; color:#15803d;">PENILAIAN RISIKO
                                SISA</div>
                            <div class="modal-form-grid-2">
                                <div class="modal-form-group">
                                    <label class="modal-form-label">Likelihood (L)</label>
                                    <select id="modal_residual_l" class="modal-form-control">
                                        <option value="1">1 - Sangat Jarang</option>
                                        <option value="2">2 - Jarang</option>
                                        <option value="3">3 - Kadang-kadang</option>
                                        <option value="4">4 - Sering</option>
                                        <option value="5">5 - Sangat Sering</option>
                                    </select>
                                </div>
                                <div class="modal-form-group">
                                    <label class="modal-form-label">Consequence (S)</label>
                                    <select id="modal_residual_s" class="modal-form-control">
                                        <option value="1">1 - Tidak Signifikan</option>
                                        <option value="2">2 - Minor</option>
                                        <option value="3">3 - Moderate</option>
                                        <option value="4">4 - Major</option>
                                        <option value="5">5 - Catastrophic</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="saveModalData()">Simpan
                            Perubahan</button>
                    </div>
                </div>
            </div>

            <!-- Compliance Checklist for Assigned Staff Only -->
            @if(($isReviewer && $status == 'assigned_review') || ($isApprover && $status == 'assigned_approval'))
                <div class="doc-card" style="margin-top: 30px;">
                    <div class="card-header-slim">
                        <i class="fas fa-clipboard-check"></i>
                        <h2>Tabel Kesesuaian (Compliance Checklist)</h2>
                    </div>
                    <div class="doc-body">
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; font-size: 13px; min-width: 600px;">
                                <thead>
                                    <tr style="background: #1e293b; color: white;">
                                        <th
                                            style="width: 40px; min-width: 40px; padding: 12px; text-align: center; border-right: 1px solid #334155;">
                                            No</th>
                                        <th style="min-width: 200px; padding: 12px; border-right: 1px solid #334155;">
                                            Kriteria</th>
                                        <th
                                            style="width: 150px; min-width: 150px; padding: 12px; text-align: center; border-right: 1px solid #334155;">
                                            Kesesuaian
                                            @if($isApprover)
                                                <button type="button" onclick="enableComplianceEdit()" title="Edit Checklist"
                                                    style="margin-left:5px; background:none; border:none; color:#ffffff; cursor:pointer;">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            @endif
                                        </th>
                                        <th style="min-width: 150px; padding: 12px;">Keterangan</th>
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

                                        // Load existing compliance data if available
                                        $existingCompliance = $document->compliance_checklist ? json_decode($document->compliance_checklist, true) : [];
                                    @endphp

                                    @foreach($complianceCriteria as $index => $criteria)
                                        @php
                                            $savedStatus = $existingCompliance[$criteria['key']]['status'] ?? '';
                                            $savedNote = $existingCompliance[$criteria['key']]['note'] ?? '';
                                            // Default: Disable if Approver (Verificator)
                                            $disabledAttr = $isApprover ? 'disabled' : '';
                                            $readOnlyAttr = $isApprover ? 'readonly' : '';
                                            $bgStyle = $isApprover ? 'background: #f1f5f9; cursor: not-allowed;' : 'background: white; cursor: pointer;';
                                            $bgInputStyle = $isApprover ? 'background: #f1f5f9; cursor: not-allowed;' : 'background: white; cursor: text;';
                                        @endphp
                                        <tr style="border-bottom: 1px solid #e2e8f0;">
                                            <td
                                                style="text-align: center; padding: 12px; border-right: 1px solid #e2e8f0; font-weight: 600; color: #64748b;">
                                                {{ $index + 1 }}
                                            </td>
                                            <td
                                                style="padding: 12px; border-right: 1px solid #e2e8f0; color: #334155; line-height: 1.5;">
                                                {{ $criteria['label'] }}
                                            </td>
                                            <td style="padding: 12px; border-right: 1px solid #e2e8f0;">
                                                <select name="compliance_checklist[{{ $criteria['key'] }}][status]"
                                                    id="status_{{ $criteria['key'] }}" class="compliance-status"
                                                    onchange="toggleNoteField('{{ $criteria['key'] }}')" {{ $disabledAttr }}
                                                    style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; font-weight: 600; color: #334155; {{ $bgStyle }} transition: all 0.2s;"
                                                    onfocus="this.style.borderColor='#c41e3a';"
                                                    onblur="this.style.borderColor='#cbd5e1';">
                                                    <option value="" {{ $savedStatus == '' ? 'selected' : '' }}
                                                        style="color: #94a3b8;">-- Pilih --</option>
                                                    <option value="OK" {{ $savedStatus == 'OK' ? 'selected' : '' }}
                                                        style="color: #10b981; font-weight: 600;">✓ OK</option>
                                                    <option value="NOK" {{ $savedStatus == 'NOK' ? 'selected' : '' }}
                                                        style="color: #ef4444; font-weight: 600;">✗ NOK</option>
                                                    <option value="Tdk Penting" {{ $savedStatus == 'Tdk Penting' ? 'selected' : '' }} style="color: #f59e0b; font-weight: 600;">⚠ Tdk Penting</option>
                                                </select>
                                            </td>
                                            <td style="padding: 12px;">
                                                <input type="text" name="compliance_checklist[{{ $criteria['key'] }}][note]"
                                                    id="note_{{ $criteria['key'] }}" class="compliance-note"
                                                    value="{{ $savedNote }}" {{ $readOnlyAttr }}
                                                    placeholder="Keterangan (opsional)"
                                                    style="width: 100%; padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 12px; color: #334155; {{ $bgInputStyle }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Reviewer Note for Verificator (Approver) -->
            @php
                $reviewerNote = '';
                $reviewerName = 'Reviewer';
                if ($isApprover && $document->level2_reviewer_id) {
                    $revAction = \App\Models\DocumentApproval::where('document_id', $document->id)
                        ->where('approver_id', $document->level2_reviewer_id)
                        ->where('level', 2)
                        ->orderBy('created_at', 'desc')
                        ->first();
                    $reviewerNote = $revAction ? $revAction->catatan : '';

                    $revUser = \App\Models\User::find($document->level2_reviewer_id);
                    if ($revUser)
                        $reviewerName = $revUser->nama_user;
                }
            @endphp

            @if($isApprover && $reviewerNote)
                <div class="card"
                    style="margin-bottom: 24px; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div class="card-header-slim" style="background:white; border-bottom:1px solid #e2e8f0;">
                        <i class="fas fa-comment-alt" style="color:#c2410c;"></i>
                        <h2 style="color:#7c2d12;">Komentar dari {{ $reviewerName }}</h2>
                    </div>
                    <div class="doc-body" style="padding: 20px;">
                        <textarea readonly
                            style="width:100%; border:none; resize:none; background:transparent; font-style:italic;">{{ $reviewerNote }}</textarea>
                    </div>
                </div>
            @endif

            <input type="hidden" name="compliance_checklist" id="compliance_checklist_input">

            <!-- Footer Action -->
            <!-- Footer Action for Unit Pengelola Workflow -->
            <div class="review-footer" style="flex-direction:column; gap:10px;">

                {{-- 1. KEPALA UNIT PENGELOLA --}}
                @if($isHead && $document->current_level == 2)

                    @if(!$status) <!-- Pending Disposition -->
                        <div style="background:#f1f5f9; padding:15px; border-radius:8px; width:100%;">
                            <h4 style="margin-top:0; font-size:14px; font-weight:700; color:#1e293b;">DISPOSISI DOKUMEN</h4>
                            <form id="dispositionForm" method="POST">
                                @csrf
                                <div style="display:flex; gap:15px; margin-bottom:15px;">
                                    <div style="flex:1;">
                                        <label style="font-size:12px; font-weight:600;">Pilih Staff Reviewer (Band IV/V)</label>
                                        <select name="reviewer_id" class="form-control" required style="width:100%;">
                                            <option value="">-- Pilih Reviewer --</option>
                                            @foreach($staffReviewers ?? [] as $s)
                                                <option value="{{ $s->id_user }}">{{ $s->nama_user }} - {{ $s->role_jabatan_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div style="flex:1;">
                                        <label style="font-size:12px; font-weight:600;">Pilih Staff Verifikator (Band
                                            III)</label>
                                        <select name="approver_id" class="form-control" required style="width:100%;">
                                            <option value="">-- Pilih Approver --</option>
                                            @foreach($staffApprovers ?? [] as $s)
                                                <option value="{{ $s->id_user }}">{{ $s->nama_user }} - {{ $s->role_jabatan_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div style="display:flex; justify-content:flex-end;">
                                    <button type="button" class="btn btn-approve" onclick="submitDisposition()"
                                        style="background:#3b82f6;">
                                        <i class="fas fa-paper-plane"></i> Disposisikan
                                    </button>
                                </div>
                            </form>
                        </div>

                    @elseif($status == 'returned_to_head' || $status == 'staff_verified') <!-- Final Approval -->
                        <div style="width:100%; margin-bottom:10px;">
                            <div class="alert alert-success">Dokumen telah diverifikasi oleh Staff. Silakan review final.</div>
                        </div>
                        <div class="notes-area" style="width:100%;">
                            <label><i class="fas fa-comment-alt"></i> Catatan</label>
                            <input type="text" id="catatan_input_ui" class="notes-input" placeholder="Tuliskan catatan...">
                        </div>
                        <div class="action-btns" style="justify-content:flex-end; width:100%;">
                            <button type="button" class="btn btn-revise" onclick="confirmAction('revise')"><i
                                    class="fas fa-undo"></i> Revisi</button>
                            <button type="button" class="btn btn-approve" onclick="confirmAction('approve')">
                                <i class="fas fa-check"></i>
                                @if($document->id_dept && $document->id_dept != 0)
                                    Approve & Teruskan Level 3
                                @else
                                    Approve & Publish
                                @endif
                            </button>
                        </div>

                    @else <!-- In Progress -->
                        <div class="alert alert-info" style="width:100%;">
                            <i class="fas fa-clock"></i> Dokumen sedang dalam proses Disposisi (Status: {{ $status }}).
                        </div>
                    @endif

                    {{-- 2. STAFF REVIEWER --}}
                @elseif($isReviewer && $status == 'assigned_review')
                    <div style="width:100%;">
                        <form id="staffActionForm" method="POST">
                            @csrf
                            <div class="alert alert-warning">Anda ditugaskan me-review dokumen ini. Silakan edit jika perlu.
                            </div>

                            <div style="margin:10px 0;">
                                <label
                                    style="font-size:12px; font-weight:600; color:#475569; margin-bottom:5px; display:block;">Catatan
                                    Review (Opsional)</label>
                                <textarea name="catatan" class="form-control" rows="2"
                                    style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px;"
                                    placeholder="Tuliskan catatan review..."></textarea>
                            </div>
                            <div class="action-btns" style="justify-content:flex-end;">
                                <button type="button" class="btn btn-approve" onclick="submitStaffAction('submit-review')"
                                    style="background:#f59e0b;">
                                    <i class="fas fa-check"></i> Selesai Review & Teruskan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- 3. STAFF APPROVER --}}
                @elseif($isApprover && $status == 'assigned_approval')
                    <div style="width:100%;">
                        <form id="staffActionForm" method="POST">
                            @csrf
                            <div class="alert alert-warning">Anda ditugaskan memverifikasi dokumen ini.</div>

                            <div style="margin:10px 0;">
                                <label
                                    style="font-size:12px; font-weight:600; color:#475569; margin-bottom:5px; display:block;">Catatan
                                    Verifikasi (Opsional)</label>
                                <textarea name="catatan" class="form-control" rows="2"
                                    style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px;"
                                    placeholder="Tuliskan catatan verifikasi..."></textarea>
                            </div>
                            <div class="action-btns" style="justify-content:flex-end;">
                                <button type="button" class="btn btn-approve" onclick="submitStaffAction('verify')"
                                    style="background:#166534;">
                                    <i class="fas fa-check-double"></i> Verifikasi & Kembalikan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- 4. DEFAULT / READ ONLY --}}
                @else
                    <div style="justify-content: center; display:flex;">
                        <button type="button" class="btn" style="background:#e2e8f0; color:#64748b; cursor:default;">
                            <i class="fas fa-lock"></i> Mode Read-Only (Status: {{ $document->status }})
                        </button>
                    </div>
                @endif
            </div>

    </div>
    </main>
    </div>

    <script>
        // History Dropdown Toggle Function
        function toggleHistory(event) {
            event.preventDefault();
            event.stopPropagation();

            const button = document.getElementById('historyToggle');
            const dropdown = document.getElementById('historyDropdown');

            if (dropdown && button) {
                if (dropdown.style.display === 'none') {
                    // Calculate position
                    const rect = button.getBoundingClientRect();
                    dropdown.style.top = (rect.bottom + 5) + 'px';
                    dropdown.style.left = rect.left + 'px';
                    dropdown.style.display = 'block';
                    console.log('Dropdown opened at:', dropdown.style.top, dropdown.style.left);
                } else {
                    dropdown.style.display = 'none';
                    console.log('Dropdown closed');
                }
            } else {
                console.error('Dropdown or button not found!', { dropdown, button });
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function (e) {
            const historyToggle = document.getElementById('historyToggle');
            const historyDropdown = document.getElementById('historyDropdown');

            if (historyToggle && historyDropdown) {
                if (!historyToggle.contains(e.target) && !historyDropdown.contains(e.target)) {
                    historyDropdown.style.display = 'none';
                }
            }
        });

        // Toggle Note Field based on Compliance Status
        function toggleNoteField(key) {
            const statusSelect = document.getElementById('status_' + key);
            const noteInput = document.getElementById('note_' + key);

            if (statusSelect && noteInput) {
                const selectedValue = statusSelect.value;

                if (selectedValue === 'NOK' || selectedValue === 'Tdk Penting') {
                    noteInput.disabled = false;
                    noteInput.style.background = 'white';
                    noteInput.style.cursor = 'text';
                } else {
                    noteInput.disabled = true;
                    noteInput.value = ''; // Clear the note when disabled
                    noteInput.style.background = '#f1f5f9';
                    noteInput.style.cursor = 'not-allowed';
                }
            }
        }

        function getLevel(s) {
            if (s <= 3) return { l: 'RENDAH', c: '#10b981' };
            if (s <= 9) return { l: 'SEDANG', c: '#f59e0b' };
            if (s <= 16) return { l: 'TINGGI', c: '#f97316' };
            return { l: 'EXTREME', c: '#ef4444' };
        }



        function confirmAction(type) {
            const notesEl = document.getElementById('catatan_input_ui');
            const notes = notesEl ? notesEl.value : '';

            // Validate Revisi Note
            if (type === 'revise' && (!notes || notes.trim().length < 5)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Catatan Diperlukan',
                    text: 'Mohon isi catatan revisi (minimal 5 karakter) untuk menjelaskan alasan pengembalian.',
                });
                return;
            }

            const title = type === 'approve' ? 'Setujui Dokumen?' : 'Minta Revisi?';
            const text = type === 'approve' ? 'Dokumen akan diteruskan ke tahap berikutnya.' : 'Dokumen akan dikembalikan ke pembuat (Level 0).';
            const confirmBtnText = type === 'approve' ? 'Ya, Setujui' : 'Ya, Revisi';
            const confirmBtnColor = type === 'approve' ? '#16a34a' : '#dc2626';

            Swal.fire({
                title: title,
                text: text,
                icon: type === 'approve' ? 'question' : 'warning',
                showCancelButton: true,
                confirmButtonColor: confirmBtnColor,
                cancelButtonColor: '#64748b',
                confirmButtonText: confirmBtnText
            }).then((result) => {
                if (result.isConfirmed) {
                    try {
                        console.log('User confirmed action: ' + type);
                        if (type === 'approve') {
                            const form = document.getElementById('approveForm');
                            if (!form) throw new Error('Approve Form Not Found');
                            document.getElementById('catatan_input_approve').value = notes;
                            console.log('Submitting Approve Form to: ' + form.action);
                            form.submit();
                        } else {
                            const form = document.getElementById('reviseForm');
                            if (!form) throw new Error('Revise Form Not Found');
                            document.getElementById('catatan_input_revise').value = notes;
                            console.log('Submitting Revise Form to: ' + form.action);
                            form.submit();
                        }
                    } catch (e) {
                        console.error('Submission Failed:', e);
                        Swal.fire('Error', 'Gagal mengirim form: ' + e.message, 'error');
                    }
                }
            });
        }
        function submitDisposition() {
            const form = document.getElementById('dispositionForm');
            // Basic validation for selects
            const reviewer = form.querySelector('select[name="reviewer_id"]').value;
            const approver = form.querySelector('select[name="approver_id"]').value;

            if (!reviewer || !approver) {
                Swal.fire('Error', 'Mohon pilih Reviewer dan Verifikator.', 'error');
                return;
            }

            Swal.fire({
                title: 'Disposisikan Dokumen?',
                text: 'Dokumen akan diteruskan ke Staff Reviewer.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Disposisi'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.action = "{{ route('unit_pengelola.disposition', $document->id) }}";
                    form.submit();
                }
            });
        }

        function collectComplianceData() {
            const checklist = {};
            // Iterate over all select inputs for compliance status
            document.querySelectorAll('select[name^="compliance_checklist"]').forEach(select => {
                const name = select.getAttribute('name');
                const match = name.match(/\[(.*?)\]\[status\]/);
                if (match) {
                    const key = match[1];
                    if (!checklist[key]) checklist[key] = {};
                    checklist[key]['status'] = select.value;
                }
            });

            // Iterate over all text inputs for compliance notes
            document.querySelectorAll('input[name^="compliance_checklist"]').forEach(input => {
                const name = input.getAttribute('name');
                const match = name.match(/\[(.*?)\]\[note\]/);
                if (match) {
                    const key = match[1];
                    if (!checklist[key]) checklist[key] = {};
                    checklist[key]['note'] = input.value;
                }
            });

            return checklist;
        }

        function submitStaffAction(type) {
            console.log('submitStaffAction called with type:', type);
            // NOTE: Fallback to reviewForm if staffActionForm not found (Robustness Fix)
            const form = document.getElementById('staffActionForm') || document.getElementById('reviewForm');

            if (!form) {
                console.error('Form not found! Checked staffActionForm and reviewForm.');
                Swal.fire('Error', 'Form tidak ditemukan. Silakan refresh halaman.', 'error');
                return;
            }

            let title = 'Submit Review?';
            let route = '';

            if (type == 'submit-review') {
                title = 'Selesai Review & Teruskan?';
                route = "{{ route('unit_pengelola.submit_review', $document->id) }}";
            } else if (type == 'verify') {
                title = 'Verifikasi & Kembalikan ke Kepala?';
                route = "{{ route('unit_pengelola.verify', $document->id) }}";
            }

            Swal.fire({
                title: title,
                text: 'Pastikan penilaian risiko sudah sesuai.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Submit',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    try {
                        console.log('Confirmed staff action: ' + type);

                        // Collect compliance checklist data (Crucial Logic retained)
                        const complianceData = collectComplianceData();

                        // Add hidden input for compliance checklist
                        let complianceInput = form.querySelector('input[name="compliance_checklist"]');
                        if (!complianceInput) {
                            complianceInput = document.createElement('input');
                            complianceInput.type = 'hidden';
                            complianceInput.name = 'compliance_checklist';
                            form.appendChild(complianceInput);
                        }
                        complianceInput.value = JSON.stringify(complianceData);

                        form.action = route;
                        form.submit();
                    } catch (e) {
                        console.error('Submission Failed:', e);
                        Swal.fire('Error', 'Gagal mengirim form: ' + e.message, 'error');
                    }
                }
            });
        }
        function toggleNoteField(key) {
            console.log('toggleNoteField called for:', key);
            const statusSelect = document.getElementById('status_' + key);
            const noteInput = document.getElementById('note_' + key);

            if (statusSelect && noteInput) {
                console.log('Status Value:', statusSelect.value);
                if (statusSelect.value === 'OK') {
                    noteInput.readOnly = true;  // Prevent typing
                    // noteInput.disabled = true; // Disabled might prevent form submission of old values, readOnly is safer for UX if we want to show it. But let's follow request.
                    // User said "tidak bisa menginputkan".
                    noteInput.style.backgroundColor = '#f1f5f9';
                    noteInput.style.pointerEvents = 'none'; // Prevent clicking
                    noteInput.style.color = '#94a3b8';
                    noteInput.placeholder = 'Tidak perlu keterangan';
                    noteInput.value = ''; // FORCE CLEAR value if OK
                } else {
                    noteInput.readOnly = false;
                    // noteInput.disabled = false;
                    noteInput.style.backgroundColor = 'white';
                    noteInput.style.pointerEvents = 'auto';
                    noteInput.style.color = '#334155';
                    noteInput.placeholder = 'Keterangan (opsional)';
                }
            } else {
                console.error('Element not found for key:', key);
            }
        }

        function toggleEditRow(btn) {
            const row = btn.closest('tr');
            // Select all interactive inputs within the row (Textareas and Inputs)
            // Exclude hidden inputs
            const inputs = row.querySelectorAll('textarea, input[type="text"], input[type="number"]');

            if (inputs.length === 0) return;

            // Check state based on the first input
            const isReadOnly = inputs[0].hasAttribute('readonly');

            inputs.forEach(input => {
                if (isReadOnly) {
                    // Unlock
                    input.removeAttribute('readonly');
                    input.classList.remove('readonly-mode');
                    input.classList.add('edit-mode');
                } else {
                    // Lock
                    input.setAttribute('readonly', true);
                    input.classList.remove('edit-mode');
                    input.classList.add('readonly-mode');
                }
            });

            // Update Icon
            const icon = btn.querySelector('i');
            if (isReadOnly) {
                // Was ReadOnly, Now Editable -> Show Close/Cancel Icon
                icon.classList.remove('fa-edit');
                icon.classList.add('fa-times');
                btn.classList.add('btn-editing');
                btn.title = "Tutup Mode Edit";
            } else {
                // Was Editable, Now ReadOnly -> Show Edit Icon
                icon.classList.remove('fa-times');
                icon.classList.add('fa-edit');
                btn.classList.remove('btn-editing');
                btn.title = "Edit Baris";
            }
        }

        // Initialize checklist fields on load & Bind Events
        document.addEventListener('DOMContentLoaded', function () {
            // Re-bind change events to ensure they work even if inline fails
            const selects = document.querySelectorAll('select[id^="status_"]');
            selects.forEach(select => {
                const id = select.id;
                const key = id.replace('status_', '');

                // Initial check
                toggleNoteField(key);

                // Add explicit listener
                select.addEventListener('change', function () {
                    toggleNoteField(key);
                });
            });
        });

        let currentEditIndex = -1;

        function openEditModal(btn, index) {
            currentEditIndex = index;
            // Get data from TR
            const tr = btn.closest('tr');
            if (!tr || !tr.dataset.json) {
                console.error('Row data not found'); return;
            }
            const data = JSON.parse(tr.dataset.json);

            // Populate Fields (with fallback to existing hidden inputs if updated)
            // Helper to get current value: try hidden input first, then data-json
            const getVal = (col) => {
                const hidden = document.querySelector(`input[name="items[${index}][${col}]"]`);
                return hidden ? hidden.value : (data[col] || '');
            };

            document.getElementById('modal_index').value = index;
            document.getElementById('modal_kegiatan').value = getVal('kolom2_kegiatan');
            document.getElementById('modal_lokasi').value = getVal('kolom3_lokasi');
            document.getElementById('modal_dampak').value = getVal('kolom7_dampak');
            document.getElementById('modal_risiko_ident').value = getVal('kolom9_risiko');
            document.getElementById('modal_risiko_neg').value = getVal('kolom17_risiko');
            document.getElementById('modal_risiko_pos').value = getVal('kolom17_peluang');
            document.getElementById('modal_existing').value = getVal('kolom11_existing');
            document.getElementById('modal_regulasi').value = getVal('kolom15_regulasi');
            document.getElementById('modal_tindaklanjut').value = getVal('kolom18_tindak_lanjut');

            document.getElementById('modal_initial_l').value = getVal('kolom12_kemungkinan') || 1;
            document.getElementById('modal_initial_s').value = getVal('kolom13_konsekuensi') || 1;
            document.getElementById('modal_residual_l').value = getVal('residual_kemungkinan') || 1;
            document.getElementById('modal_residual_s').value = getVal('residual_konsekuensi') || 1;

            // Show Modal
            document.getElementById('editModal').style.display = 'flex';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function saveModalData() {
            const idx = currentEditIndex;
            if (idx === -1) return;

            const updateField = (colName, val) => {
                // Update Hidden Input (For Submit)
                const input = document.querySelector(`input[name="items[${idx}][${colName}]"]`);
                if (input) input.value = val;

                // Update Display Text (For Preview)
                // We use querySelectorAll on rows to ensure valid index targeting
                const rows = document.querySelectorAll('.excel-table tbody tr');
                if (rows[idx]) {
                    const disp = rows[idx].querySelector(`.display-val[data-col="${colName}"]`) || rows[idx].querySelector(`.risk-text[data-col="${colName}"]`);
                    if (disp) disp.innerText = val;
                }
            };

            updateField('kolom2_kegiatan', document.getElementById('modal_kegiatan').value);
            updateField('kolom3_lokasi', document.getElementById('modal_lokasi').value);
            updateField('kolom7_dampak', document.getElementById('modal_dampak').value);
            updateField('kolom9_risiko', document.getElementById('modal_risiko_ident').value);
            updateField('kolom17_risiko', document.getElementById('modal_risiko_neg').value);
            updateField('kolom17_peluang', document.getElementById('modal_risiko_pos').value);
            updateField('kolom11_existing', document.getElementById('modal_existing').value);
            updateField('kolom15_regulasi', document.getElementById('modal_regulasi').value);
            updateField('kolom18_tindak_lanjut', document.getElementById('modal_tindaklanjut').value);

            const initL = document.getElementById('modal_initial_l').value;
            const initS = document.getElementById('modal_initial_s').value;
            updateField('kolom12_kemungkinan', initL);
            updateField('kolom13_konsekuensi', initS);

            const resL = document.getElementById('modal_residual_l').value;
            const resS = document.getElementById('modal_residual_s').value;
            updateField('residual_kemungkinan', resL);
            updateField('residual_konsekuensi', resS);

            closeEditModal();
            Swal.fire({
                toast: true, position: 'top-end', icon: 'success',
                title: 'Data Baris Diupdate (Simpan Permanen saat "Selesai Review")',
                showConfirmButton: false, timer: 3000
            });
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        function enableComplianceEdit() {
            // Select all inputs and selects in the compliance section
            const statuses = document.querySelectorAll('.compliance-status');
            const notes = document.querySelectorAll('.compliance-note');

            // Enable Statuses
            statuses.forEach(el => {
                el.disabled = false;
                el.style.background = 'white';
                el.style.cursor = 'pointer';
            });

            // Enable Notes
            notes.forEach(el => {
                el.readOnly = false;
                el.style.background = 'white';
                el.style.cursor = 'text';
            });

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'info',
                title: 'Checklist Dapat Diedit',
                showConfirmButton: false,
                timer: 2000
            });
        }
    </script>
</body>

</html>