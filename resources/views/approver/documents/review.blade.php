<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen - HIRADC</title>
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
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 32px 48px;
            max-width: 1400px;
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

        /* PROFESSIONAL ENTERPRISE HIRADC TABLE */
        :root {
            --header-bg: #1e293b;
            --header-text: #ffffff;
            --border-color: #cbd5e1;
            --row-hover: #f1f5f9;
            --risk-section-bg: #ffffff;
            --input-bg: #f8fafc;
        }

        .hiradc-wrapper {
            overflow-x: auto;
            overflow-y: auto;
            max-height: calc(100vh - 250px);
            width: 100%;
            background: white;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 100px;
            position: relative;
        }

        .excel-table {
            width: max-content;
            min-width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            font-size: 13px;
            color: #1e293b;
            table-layout: auto;
        }

        /* --- HEADERS --- */
        .excel-table thead {
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .excel-table thead th {
            background: var(--header-bg);
            color: var(--header-text);
            padding: 10px 12px;
            border-right: 1px solid #334155;
            border-bottom: 1px solid #334155;
            text-align: center;
            vertical-align: middle;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .excel-table thead tr:first-child th {
            background: #0f172a;
            /* Darker Top Header */
            font-size: 13px;
            border-bottom: 1px solid #334155;
        }

        /* Sticky First Column Header */
        .excel-table thead th:first-child {
            position: sticky;
            left: 0;
            z-index: 52;
            border-right: 2px solid #475569;
        }

        /* --- BODY --- */
        .excel-table tbody td {
            border-right: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            background: white;
            vertical-align: top;
            padding: 0;
            transition: background 0.1s;
        }

        /* Sticky First Column Body */
        .excel-table tbody td:first-child {
            position: sticky;
            left: 0;
            background: #f8fafc;
            z-index: 40;
            border-right: 2px solid #94a3b8;
            /* Stronger separation */
            text-align: center;
            vertical-align: top;
            padding-top: 15px;
            font-weight: 700;
            color: #64748b;
        }

        .excel-table tbody td:first-child:hover {
            background: #f1f5f9;
        }

        /* --- INPUT STYLING --- */
        /* Inputs fill the cell but look cleaner */
        .cell-textarea,
        .cell-input,
        .cell-select {
            width: 100%;
            min-width: 220px;
            height: 100%;
            min-height: 100px;
            border: none;
            padding: 12px 14px;
            /* Comfortable padding */
            font-family: inherit;
            font-size: 13px;
            line-height: 1.5;
            color: #334155;
            background: transparent;
            resize: none;
            outline: none;
        }

        .cell-textarea:focus,
        .cell-input:focus,
        .cell-select:focus {
            background: #fce7f3;
            /* Very subtle highlight on focus */
            box-shadow: inset 0 0 0 2px #db2777;
            /* Pink/Red focus ring for visibility */
            color: #be185d;
        }

        /* --- SECTIONS & GROUPS --- */
        /* Alternate Section Backgrounds for readability */
        .group-risk {
            background-color: #fdf2f8 !important;
        }

        /* Pinkish tint for Risk */
        .group-control {
            background-color: #f0f9ff !important;
        }

        /* Blue tint for Control */

        /* Thick Borders between Groups */
        .excel-table th.section-border-right,
        .excel-table td.section-border-right {
            border-right: 3px solid #94a3b8 !important;
            /* Visible Separation */
        }

        /* --- RISK COLUMNS (L, S, R) --- */
        .risk-col {
            width: 50px;
            text-align: center;
            background: #fff;
            vertical-align: top;
            padding: 5px !important;
        }

        .risk-select {
            width: 100%;
            padding: 8px 2px;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            text-align: center;
            font-weight: 700;
            color: #334155;
            cursor: pointer;
            background-color: #fff;
            appearance: none;
            font-size: 14px;
        }

        .risk-select:focus {
            border-color: #db2777;
            box-shadow: 0 0 0 2px rgba(219, 39, 119, 0.2);
        }

        /* --- WIDGETS --- */
        .cell-checkbox-group {
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 280px;
        }

        .cell-checkbox-item {
            display: flex;
            gap: 10px;
            font-size: 13px;
            align-items: flex-start;
            line-height: 1.4;
            color: #334155;
        }

        .cell-checkbox-item input {
            margin-top: 3px;
            accent-color: #db2777;
        }

        /* Footer */
        .review-footer {
            position: fixed;
            bottom: 20px;
            left: 270px;
            right: 20px;
            width: auto;
            max-width: calc(100vw - 290px);
            background: #1e293b;
            color: white;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .notes-section {
            flex: 1;
            min-width: 0;
        }

        .notes-input {
            background: #334155;
            border: 1px solid #475569;
            color: white;
            width: 100%;
            padding: 10px 15px;
            border-radius: 6px;
        }

        .notes-input::placeholder {
            color: #94a3b8;
        }

        .action-btns .btn {
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-revise {
            background: #ef4444;
            color: white;
            margin-right: 10px;
        }

        .btn-approve {
            background: #22c55e;
            color: white;
        }

        /* Risk Badge */
        .risk-score-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100px;
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

        /* ===== RESPONSIVE IMPROVEMENTS ===== */
        /* Ensure layout stability during zoom and device resize */

        /* Large screens (1600px and below) */
        @media (max-width: 1600px) {
            .hiradc-wrapper {
                max-height: calc(100vh - 300px);
            }

            .excel-table {
                font-size: 12px;
            }

            .cell-textarea,
            .cell-input {
                min-width: 180px;
                font-size: 12px;
                padding: 10px 12px;
            }

            .review-footer {
                padding: 12px 20px;
                left: 280px;
                right: 20px;
            }
        }

        /* Medium screens (1366px and below) */
        @media (max-width: 1366px) {
            .main-content {
                padding: 24px 32px;
            }

            .excel-table {
                font-size: 11px;
            }

            .cell-textarea,
            .cell-input {
                min-width: 160px;
                min-height: 80px;
            }

            .review-footer {
                padding: 10px 16px;
                left: 280px;
                right: 16px;
            }

            .notes-input {
                font-size: 13px;
            }
        }

        /* Small screens (1024px and below) */
        @media (max-width: 1024px) {
            .sidebar {
                width: 220px;
            }

            .main-content {
                margin-left: 220px;
                padding: 20px 24px;
            }

            .review-footer {
                left: 240px;
                right: 16px;
                width: auto;
                flex-direction: column;
                gap: 12px;
                align-items: stretch;
            }

            .notes-section {
                width: 100%;
            }

            .action-btns {
                width: 100%;
                display: flex;
                justify-content: flex-end;
                gap: 10px;
            }
        }

        /* Zoom stability - prevent text scaling issues */
        @media (min-resolution: 1.25dppx) {
            body {
                -webkit-text-size-adjust: 100%;
                text-size-adjust: 100%;
            }

            .excel-table {
                transform-origin: top left;
            }
        }

        /* Prevent layout shift during zoom */
        * {
            box-sizing: border-box;
            min-width: 0;
            min-height: 0;
        }

        /* Ensure modal is always centered and responsive */
        #editModal .modal-content {
            margin: 2vh auto;
            max-height: 96vh;
            width: 90%;
            max-width: min(900px, 90vw);
        }

        /* Ensure wrapper doesn't overflow */
        .hiradc-wrapper {
            position: relative;
            width: 100%;
            max-width: 100%;
        }

        /* Ensure footer adapts to viewport */
        @media (max-width: 768px) {
            .review-footer {
                left: 20px;
                right: 20px;
                width: calc(100% - 40px);
                bottom: 10px;
            }

            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
                padding: 16px;
            }
        }

        /* === TIMELINE / HISTORY CARD === */
        .timeline-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 24px;
            margin-bottom: 30px;
            border: 1px solid #e2e8f0;
        }

        .timeline-header {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #1e293b;
        }

        .timeline-header i {
            color: var(--primary-color);
        }

        .timeline-item {
            position: relative;
            padding-left: 32px;
            margin-bottom: 24px;
            border-left: 2px solid #e2e8f0;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
            border-left-color: transparent;
        }

        .timeline-dot {
            position: absolute;
            left: -6px;
            top: 2px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #94a3b8;
            border: 2px solid white;
        }

        .timeline-active .timeline-dot {
            background: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.2);
            width: 12px;
            height: 12px;
            left: -7px;
        }

        .timeline-created .timeline-dot {
            background: #3b82f6;
        }

        .timeline-approved .timeline-dot {
            background: #22c55e;
        }

        .timeline-revised .timeline-dot {
            background: #f59e0b;
        }

        .timeline-published .timeline-dot {
            background: #8b5cf6;
        }

        .timeline-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 6px;
        }

        .timeline-action {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
        }

        .timeline-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-created {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-revised {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-published {
            background: #ede9fe;
            color: #5b21b6;
        }

        .timeline-user {
            font-size: 13px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .timeline-user i {
            font-size: 12px;
        }

        .timeline-date {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 4px;
        }

        .timeline-comment {
            font-size: 13px;
            color: #475569;
            margin-top: 8px;
            background: #f8fafc;
            padding: 10px 12px;
            border-radius: 6px;
            border-left: 3px solid #cbd5e1;
            font-style: italic;
        }

        .timeline-empty {
            text-align: center;
            padding: 40px;
            color: #94a3b8;
            font-size: 14px;
        }

        /* === WIZARD / PROGRESS BAR === */
        .wizard-container {
            background: white;
            border-radius: 12px;
            padding: 30px;
            border: 1px solid #e2e8f0;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .wizard-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .wizard-steps::before {
            content: '';
            position: absolute;
            top: 18px;
            left: 0;
            right: 0;
            height: 3px;
            background: #e2e8f0;
            z-index: 1;
            border-radius: 10px;
        }

        .step-item {
            position: relative;
            z-index: 2;
            text-align: center;
            flex: 1;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            background: white;
            border: 3px solid #cbd5e1;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s;
        }

        .step-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
            margin-top: 8px;
        }

        /* Active State */
        .step-item.active .step-circle {
            border-color: var(--primary-color);
            background: #fff1f2;
            color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(196, 30, 58, 0.1);
        }

        .step-item.active .step-label {
            color: var(--primary-color);
            font-weight: 700;
        }

        /* Completed State */
        .step-item.completed .step-circle {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .step-item.completed .step-label {
            color: var(--primary-color);
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System (Approver)</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('approver.dashboard') }}" class="nav-item"><i
                        class="fas fa-th-large"></i><span>Dashboard</span></a>
                <a href="{{ route('approver.check_documents') }}" class="nav-item active"><i
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
            <div class="page-header">
                <div class="header-title">
                    <h1>Review & Edit Dokumen</h1>
                    <p>Periksa, edit jika perlu, dan setujui atau minta revisi.</p>
                </div>
                <a href="{{ route('approver.check_documents') }}" class="btn-back"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
            </div>

            <!-- Header Card (Summary) -->
            <div class="doc-card">
                <div class="doc-header" style="justify-content: flex-start; gap: 30px;">
                    <div>
                        <div class="doc-title-label">Judul Dokumen</div>
                        <div class="doc-title-value">{{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</div>
                    </div>

                    <div>
                        <div class="doc-title-label">Unit / Seksi</div>
                        <div class="doc-title-value" style="font-size:16px;">{{ $document->unit->nama_unit ?? '-' }} /
                            {{ $document->seksi->nama_seksi ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Wizard -->
            <div class="wizard-container">
                <div class="wizard-steps">
                    <div class="step-item {{ $document->current_level >= 1 ? 'completed' : 'active' }}">
                        <div class="step-circle"><i class="fas fa-file-signature"></i></div>
                        <div class="step-label">Draft & Submit</div>
                    </div>
                    <div
                        class="step-item {{ $document->current_level > 1 ? 'completed' : ($document->current_level == 1 ? 'active' : '') }}">
                        <div class="step-circle">1</div>
                        <div class="step-label">Kepala Unit</div>
                    </div>
                    <div
                        class="step-item {{ $document->current_level > 2 ? 'completed' : ($document->current_level == 2 ? 'active' : '') }}">
                        <div class="step-circle">2</div>
                        <div class="step-label">Unit Pengelola</div>
                    </div>
                    <div
                        class="step-item {{ $document->status == 'approved' ? 'completed' : ($document->current_level == 3 ? 'active' : '') }}">
                        <div class="step-circle">3</div>
                        <div class="step-label">Kepala Dept.</div>
                    </div>
                    <div class="step-item {{ $document->status == 'approved' ? 'completed active' : '' }}">
                        <div class="step-circle"><i class="fas fa-check"></i></div>
                        <div class="step-label">Selesai</div>
                    </div>
                </div>
                @if($document->status == 'revision')
                    <div
                        style="background: #fff7ed; color: #c2410c; padding: 15px; border-radius: 8px; margin-top: 25px; font-size: 14px; border:1px solid #fdba74; display: flex; align-items: start; gap: 12px;">
                        <i class="fas fa-exclamation-triangle" style="margin-top: 2px;"></i>
                        <div>
                            <strong>Dokumen Perlu Revisi</strong>
                            <p style="margin-top: 4px; opacity: 0.9;">Dokumen ini dikembalikan dengan catatan tertentu.
                                Silakan cek bagian "Riwayat Approval" di bawah untuk detail.</p>
                        </div>
                    </div>
                @endif
            </div>

            <form id="reviewForm" method="POST" action="">
                @csrf
                <input type="hidden" name="action" id="action_input">
                <input type="hidden" name="catatan" id="catatan_input_form">
                <input type="hidden" name="kategori" value="{{ $document->kategori }}">

                <div class="hiradc-wrapper">
                    <table class="excel-table">
                        <thead>
                            <!-- Header Row 1: Groups -->
                            <tr>
                                <th rowspan="2" style="width: 50px;">No</th>
                                <th colspan="5" class="section-border-right">Kegiatan & Situasi</th>
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
                                <th style="width: 150px;">Pihak Berkepentingan</th>
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
                            @php
                                // Determine Allowed Categories for Unit Pengelola (Level 2)
                                $allowedCats = ['K3', 'KO', 'Lingkungan', 'Keamanan']; // Default All
                                $userUnitName = strtoupper(Auth::user()->unit->nama_unit ?? '');
                                $userRole = Auth::user()->id_role_jabatan; // Assumed Role ID for check

                                // Logic: If User is likely SHE or Security Unit Pengelola
                                // And Document is at Level 2 (or we just filter for their view regardless of level?)
                                // User request implies this is their "View".

                                if (str_contains($userUnitName, 'SHE') || str_contains($userUnitName, 'SAFETY')) {
                                    $allowedCats = ['K3', 'KO', 'Lingkungan'];
                                } elseif (str_contains($userUnitName, 'KEAMANAN') || str_contains($userUnitName, 'SECURITY')) {
                                    $allowedCats = ['Keamanan'];
                                }
                            @endphp

                            @foreach($document->details as $index => $item)
                                @if(!in_array($item->kategori, $allowedCats))
                                    @continue
                                @endif
                                <tr>
                                    <td style="text-align:center; padding-top:20px; font-size:14px; color:#1e293b;">
                                        {{ $index + 1 }}
                                        @if($document->canBeApprovedBy(Auth::user()))
                                            <div style="margin-top:5px;">
                                                <button type="button" class="btn-sm"
                                                    style="background:none; border:none; color:#f59e0b; cursor:pointer;"
                                                    onclick="openEditModal({{ json_encode($item) }})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                    <!-- Kegiatan -->
                                    <td>
                                        <textarea class="cell-textarea auto-grow"
                                            readonly>{{ $item->kolom2_kegiatan }}</textarea>
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
                                        <textarea class="cell-textarea auto-grow"
                                            readonly>{{ $item->kolom3_lokasi }}</textarea>
                                    </td>
                                    <!-- Pihak -->
                                    <td>
                                        <textarea class="cell-textarea auto-grow"
                                            readonly>{{ $item->kolom4_pihak }}</textarea>
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
                                        <textarea class="cell-textarea auto-grow"
                                            readonly>{{ $item->kolom7_dampak }}</textarea>
                                    </td>
                                    <!-- Risiko & Peluang -->
                                    <td class="section-border-right">
                                        <div class="risk-section">
                                            <div class="risk-label">IDENTIFIKASI:</div>
                                            <div class="risk-text">{{ $item->kolom9_risiko }}</div>
                                            <div class="risk-label" style="border-top:1px solid #e2e8f0; margin-top:8px;">
                                                RISIKO (-):</div>
                                            <div class="risk-text">{{ $item->kolom17_risiko }}</div>
                                            <div class="risk-label" style="border-top:1px solid #e2e8f0; margin-top:8px;">
                                                PELUANG (+):</div>
                                            <div class="risk-text">{{ $item->kolom17_peluang }}</div>
                                        </div>
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
                                        <textarea class="cell-textarea auto-grow"
                                            readonly>{{ $item->kolom11_existing }}</textarea>
                                    </td>
                                    <!-- RISK INITIAL -->
                                    <td class="risk-col section-border-right"
                                        style="vertical-align:middle; text-align:center;">
                                        <div style="font-weight:800; font-size:16px;">{{ $item->kolom12_kemungkinan }}</div>
                                    </td>
                                    <td class="risk-col section-border-right"
                                        style="vertical-align:middle; text-align:center;">
                                        <div style="font-weight:800; font-size:16px;">{{ $item->kolom13_konsekuensi }}</div>
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
                                        <textarea class="cell-textarea auto-grow"
                                            readonly>{{ $item->kolom15_regulasi }}</textarea>
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
                                        <textarea class="cell-textarea auto-grow"
                                            readonly>{{ $item->kolom18_tindak_lanjut }}</textarea>
                                    </td>
                                    <!-- RISK RESIDUAL -->
                                    <td class="risk-col section-border-right"
                                        style="vertical-align:middle; text-align:center;">
                                        <div style="font-weight:800; font-size:16px;">{{ $item->residual_kemungkinan }}
                                        </div>
                                    </td>
                                    <td class="risk-col section-border-right"
                                        style="vertical-align:middle; text-align:center;">
                                        <div style="font-weight:800; font-size:16px;">{{ $item->residual_konsekuensi }}
                                        </div>
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

            </form>

            <!-- Riwayat Approval & Status Form -->
            <div class="timeline-card">
                <div class="timeline-header">
                    <i class="fas fa-history"></i>
                    Riwayat Approval & Status Form
                </div>

                @php
                    $allHistory = collect();

                    // 1. Created
                    $allHistory->push([
                        'type' => 'created',
                        'action' => 'Form Dibuat',
                        'user' => $document->user->nama_user ?? $document->user->username,
                        'date' => $document->created_at,
                        'comment' => null
                    ]);

                    // 2. Approvals - Filter duplicates
                    $uniqueApprovals = $document->approvals->unique(function ($approval) {
                        return $approval->level . '-' . $approval->action . '-' . $approval->id_approver . '-' . $approval->created_at->format('Y-m-d H:i:s');
                    });

                    foreach ($uniqueApprovals as $approval) {
                        $levelName = match ($approval->level) {
                            1 => 'Kepala Unit Kerja',
                            2 => 'Unit Pengelola',
                            3 => 'Kepala Departemen',
                            default => 'Level ' . $approval->level
                        };

                        $allHistory->push([
                            'type' => $approval->action == 'approved' ? 'approved' : 'revised',
                            'action' => $approval->action == 'approved'
                                ? "Disetujui oleh $levelName"
                                : "Dikembalikan untuk Revisi oleh $levelName",
                            'user' => $approval->approver->nama_user ?? $approval->approver->username,
                            'date' => $approval->created_at,
                            'comment' => $approval->catatan
                        ]);
                    }

                    // 3. Published
                    if ($document->status == 'approved' && $document->published_at) {
                        $allHistory->push([
                            'type' => 'published',
                            'action' => 'Form Dipublikasi',
                            'user' => 'System',
                            'date' => $document->published_at,
                            'comment' => null
                        ]);
                    }

                    // Sort by date
                    $allHistory = $allHistory->sortBy('date');
                @endphp

                @if($allHistory->count() > 0)
                    @foreach($allHistory as $index => $history)
                        <div class="timeline-item timeline-{{ $history['type'] }} {{ $loop->last ? 'timeline-active' : '' }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-meta">
                                <span class="timeline-action">{{ $history['action'] }}</span>
                                <span class="timeline-badge badge-{{ $history['type'] }}">
                                    {{ strtoupper($history['type']) }}
                                </span>
                            </div>
                            <div class="timeline-user">
                                <i class="fas fa-user"></i>
                                {{ $history['user'] }}
                            </div>
                            <div class="timeline-date">
                                <i class="fas fa-clock"></i>
                                {{ $history['date']->format('d M Y, H:i') }} WIB
                                ({{ $history['date']->diffForHumans() }})
                            </div>
                            @if($history['comment'])
                                <div class="timeline-comment">
                                    <i class="fas fa-comment-dots"></i> "{{ $history['comment'] }}"
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="timeline-empty">
                        <i class="fas fa-inbox" style="font-size: 32px; margin-bottom: 10px; display: block;"></i>
                        Belum ada riwayat approval
                    </div>
                @endif
            </div>
        </main>

        <!-- Footer -->
        <div class="review-footer">
            <div style="flex:1; margin-right:20px;">
                @php
                    $latestNote = $document->approvals()
                        ->where('catatan', '!=', '')
                        ->whereNotNull('catatan')
                        ->latest()
                        ->value('catatan');
                @endphp
                <input type="text" class="notes-input" id="notes" placeholder="Catatan Review (Wajib jika Revisi)..."
                    value="{{ $latestNote ?? '' }}" @if(!$document->canBeApprovedBy(Auth::user())) readonly disabled
                    style="opacity: 0.6; cursor: not-allowed;" @endif>
            </div>
            <div class="action-btns">
                @if($document->canBeApprovedBy(Auth::user()))
                    <!-- (Global Edit Removed) -->
                    <button type="button" class="btn btn-revise" onclick="confirmAction('revise')">
                        <i class="fas fa-undo"></i> Revisi
                    </button>
                    <button type="button" class="btn btn-approve" onclick="confirmAction('approve')">
                        <i class="fas fa-check"></i> Approve
                    </button>
                @else
                    <span style="opacity:0.7; font-weight:600; color:#fff;">View Only Mode</span>
                @endif
            </div>
        </div>
    </div>

    <!-- EDIT ITEM MODAL -->
    <div id="editModal" class="modal-overlay"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
        <div class="modal-content"
            style="background:white; padding:20px; width:80%; max-width:900px; max-height:90vh; overflow-y:auto; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
            <div
                style="display:flex; justify-content:space-between; margin-bottom:20px; border-bottom:1px solid #eee; padding-bottom:10px;">
                <h3 style="margin:0;">Edit Detail Item</h3>
                <button onclick="closeEditModal()"
                    style="background:none; border:none; font-size:24px; cursor:pointer;">&times;</button>
            </div>

            <form id="editItemForm">
                <input type="hidden" id="edit_id">
                <div id="modal-form-body">
                    <div style="text-align:center; padding:50px;">
                        <i class="fas fa-spinner fa-spin" style="font-size:30px; color:#ccc;"></i>
                        <p>Memuat Form...</p>
                    </div>
                </div>

                <div style="margin-top:20px; text-align:right;">
                    <button type="button" onclick="closeEditModal()" class="btn"
                        style="margin-right:10px; padding:10px 20px; background:#e2e8f0; border:none; border-radius:4px; cursor:pointer;">Batal</button>
                    <button type="button" onclick="saveEditItem()" class="btn"
                        style="background:#0f172a; color:#fff; padding:10px 20px; border:none; border-radius:4px; cursor:pointer;">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const routeApprove = "{{ route('approver.approve', $document->id) }}";
        const routeRevise = "{{ route('approver.revise', $document->id) }}";

        // Auto-Grow Textareas
        document.querySelectorAll('.auto-grow').forEach(el => {
            el.style.height = 'auto'; // Reset 
            el.style.height = Math.max(el.scrollHeight, 100) + 'px';
            el.addEventListener('input', function () {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
        // Trigger once on load
        window.addEventListener('load', () => {
            document.querySelectorAll('.auto-grow').forEach(el => {
                el.style.height = 'auto';
                el.style.height = (el.scrollHeight) + 'px';
            });
        });

        function openEditModal(item) {
            const id = item.id;
            document.getElementById('edit_id').value = id;
            document.getElementById('editModal').style.display = 'flex';

            // Show Spinner
            document.getElementById('modal-form-body').innerHTML = `
                 <div style="text-align:center; padding:50px;">
                    <i class="fas fa-spinner fa-spin" style="font-size:30px; color:#ccc;"></i>
                    <p>Memuat Form...</p>
                 </div>
            `;

            // Fetch Form HTML
            fetch(`/approver/documents/get-item-html/${id}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('modal-form-body').innerHTML = data.html;
                    } else {
                        document.getElementById('modal-form-body').innerHTML = '<p class="text-danger">Gagal memuat form.</p>';
                    }
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function saveEditItem() {
            const id = document.getElementById('edit_id').value;
            const form = document.getElementById('editItemForm');

            // Collect Form Data Manually to handle naming structure edit_item[ID][field] -> map to simple params for Controller?
            // OR Controller should accept the exact naming.
            // My Controller updateDetail expects: category, kolom2_kegiatan, etc.
            // But the partial uses names like edit_item[123][kolom2_kegiatan].
            // I should use FormData and parse it or standard serialize.

            // Use FormData API
            const formData = new FormData(form);
            const payload = {};

            // Very hacky parse: "edit_item[102][kolom2_kegiatan]" -> "kolom2_kegiatan"
            for (let [key, value] of formData.entries()) {
                if (key.includes('[') && key.includes(']')) {
                    // Extract field name: edit_item[102][FIELD_NAME]
                    const parts = key.split('][');
                    if (parts.length > 1) {
                        let fieldName = parts[1].replace(']', '');

                        // Handle Arrays (checkboxes) e.g. kolom6_bahaya[]
                        if (fieldName.includes('[]')) {
                            fieldName = fieldName.replace('[]', '');
                            if (!payload[fieldName]) payload[fieldName] = [];
                            payload[fieldName].push(value);
                        } else {
                            payload[fieldName] = value;
                        }
                    }
                }
            }

            // Add other missing fields manually if needed, or rely on above parser.
            // Also need Token
            payload['_token'] = "{{ csrf_token() }}";

            // If manual hazards were merged, check controller handling.
            // Controller updateDetail expects: kolom6_bahaya which is ARRAY.
            // My partial sends array checks.

            fetch(`/approver/documents/update-detail/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify(payload)
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Sukses', 'Data berhasil diupdate', 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(err => {
                    Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                });
        }

        // --- Helper JS for Injected Form ---
        function updateConditions(select) {
            // Logic to update condition dropdown if needed. 
            // In partial, I used PHP logic to pre-fill.
            // If user changes Category, Condition options should change.
            // Simple version:
            const cat = select.value;
            // Find sibling select
            // This is hard because partial structure.
            // Let's assume user won't change category often in Approver Mode.
            // Or implement global logic later.
        }

        function calculateSimpleRisk(select, isResidual = false) {
            // Find parent container
            const container = select.closest(isResidual ? 'div[style*="background:#f0fdf4"]' : 'div[style*="background:#f8fafc"]');

            const lInput = container.querySelector(isResidual ? 'select[name*="residual_kemungkinan"]' : 'select[name*="kolom12_kemungkinan"]');
            const sInput = container.querySelector(isResidual ? 'select[name*="residual_konsekuensi"]' : 'select[name*="kolom13_konsekuensi"]');

            const l = parseInt(lInput.value) || 0;
            const s = parseInt(sInput.value) || 0;
            const score = l * s;

            // Update UI
            const scoreDisplay = container.querySelector(isResidual ? '.display-res-score' : '.display-score');
            if (scoreDisplay) scoreDisplay.textContent = score;

            // Update Hidden Input
            const scoreInput = container.querySelector(isResidual ? '.input-res-score' : '.input-score');
            if (scoreInput) scoreInput.value = score;
        }

        function confirmAction(type) {
            const notes = document.getElementById('notes').value.trim();
            if (type === 'revise' && notes.length < 5) {
                Swal.fire({ icon: 'warning', title: 'Catatan Wajib', text: 'Untuk revisi, wajib memberikan catatan saran.' });
                return;
            }

            Swal.fire({
                title: type === 'approve' ? 'Setujui Dokumen?' : 'Kembalikan Revisi?',
                text: type === 'approve' ? 'Dokumen akan dilanjutkan ke Approval berikutnya.' : 'Dokumen akan dikembalikan ke pembuat.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                confirmButtonColor: type === 'approve' ? '#0f172a' : '#ef4444'
            }).then((res) => {
                if (res.isConfirmed) {
                    document.getElementById('catatan_input_form').value = notes;
                    document.getElementById('reviewForm').action = type === 'approve' ? routeApprove : routeRevise;
                    document.getElementById('action_input').value = type;
                    document.getElementById('reviewForm').submit();
                }
            });
        }
    </script>

    <!-- Flash Messages -->
    @if(session('success'))
        <script>Swal.fire({ icon: 'success', title: 'Berhasil', text: "{{ session('success') }}", timer: 2000 });</script>
    @endif
    @if($errors->any())
        <script>Swal.fire({ icon: 'error', title: 'Error', html: `<ul>@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>` });</script>
    @endif
</body>

</html>