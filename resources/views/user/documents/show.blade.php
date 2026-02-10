    <!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $document->kolom2_kegiatan }} | Detail HIRADC - PT Semen Padang</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #c41e3a;
            --primary-hover: #a01729;
            --primary-dark: #9a1829;
            --primary-light: #fef2f3;
            --secondary: #64748b;
            --bg-body: #f1f5f9;
            --sidebar-bg: #5b6fd8;
            --surface: #ffffff;
            --text-main: #0f172a;
            --text-sub: #64748b;
            --border: #e2e8f0;
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-colored: 0 10px 25px -5px rgba(196, 30, 58, 0.15);
            --header-bg: #1e293b;
            --header-text: #ffffff;
            --border-color: #e2e8f0;
            --border-radius: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg-body);
            background-image:
                radial-gradient(at 0% 0%, rgba(196, 30, 58, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--text-main);
            padding-bottom: 60px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
            max-width: 100vw;
        }

        .container {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            max-width: 100vw;
        }

        /* Sidebar - Consistent with other pages */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 50;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        .logo-section {
            padding: 32px 24px;
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
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.2) 50%, transparent 100%);
        }

        .logo-circle {
            width: 90px;
            height: 90px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
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
            font-size: 18px;
            font-weight: 700;
            color: white;
            margin-bottom: 4px;
            letter-spacing: -0.02em;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
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
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
        }

        .nav-menu::-webkit-scrollbar {
            width: 6px;
        }

        .nav-menu::-webkit-scrollbar-track {
            background: transparent;
        }

        .nav-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 9999px;
        }

        .nav-item {
            padding: 16px 24px;
            margin: 4px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            color: rgba(255, 255, 255, 0.85);
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            position: relative;
            border-radius: 12px;
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
            border-radius: 0 8px 8px 0;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 18px;
            transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-item:hover i {
            transform: scale(1.1);
        }

        .badge {
            position: absolute;
            right: 20px;
            background: #c41e3a;
            color: white;
            font-size: 10px;
            padding: 4px 8px;
            border-radius: 10px;
            font-weight: 600;
        }

        .user-info-bottom {
            padding: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            background: transparent;
            position: relative;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: white;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5b6fd8;
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 15px;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 2px;
        }

        .user-role {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
        }

        .logout-btn {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
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
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 24px 32px;
            max-width: 1200px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-sub);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
            padding: 8px 16px;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .btn-back:hover {
            color: var(--primary);
            background: rgba(196, 30, 58, 0.05);
        }

        /* Header Banner - Compact */
        .doc-banner {
            background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%);
            border-radius: var(--border-radius);
            padding: 24px 32px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .doc-banner::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent 0%, var(--primary) 50%, transparent 100%);
            opacity: 0.3;
        }

        .doc-banner-left h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 6px;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .doc-banner-left p {
            font-size: 13px;
            color: var(--text-sub);
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            font-weight: 500;
        }

        .doc-meta-badge {
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            color: #475569;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            letter-spacing: 0.025em;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-edit-programs {
            background: #ffffff;
            border: 1px solid #3b82f6;
            color: #3b82f6;
            padding: 10px 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-edit-programs:hover {
            background: #f0f9ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }

        /* Wizard - Compact */
        .wizard-container {
            background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%);
            border-radius: var(--border-radius);
            padding: 28px 32px;
            border: 1px solid var(--border);
            margin-bottom: 24px;
            box-shadow: var(--shadow-sm);
        }

        .wizard-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .wizard-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, #e2e8f0 0%, #cbd5e1 100%);
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
            width: 44px;
            height: 44px;
            background: white;
            border: 3px solid #cbd5e1;
            border-radius: 50%;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .step-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
            margin-top: 8px;
            letter-spacing: -0.01em;
        }

        /* Active State */
        .step-item.active .step-circle {
            border-color: var(--primary);
            background: var(--primary-light);
            color: var(--primary);
            box-shadow: 0 0 0 6px rgba(196, 30, 58, 0.1), 0 4px 12px rgba(196, 30, 58, 0.2);
            transform: scale(1.1);
        }

        .step-item.active .step-label {
            color: var(--primary);
            font-weight: 700;
        }

        /* Completed State */
        .step-item.completed .step-circle {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-color: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(196, 30, 58, 0.3);
        }

        .step-item.completed .step-label {
            color: var(--primary);
            font-weight: 600;
        }

        /* TABLE STYLES - Balanced Responsive */
        .hiradc-wrapper {
            overflow-x: auto;
            background: white;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            border-radius: var(--border-radius);
            margin-bottom: 32px;
            width: 100%;
            max-width: 100%;
            -webkit-overflow-scrolling: touch;
        }

        .excel-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            font-size: 11px;
            table-layout: auto;
        }

        .excel-table thead th {
            background: linear-gradient(to bottom, #1e293b 0%, #0f172a 100%);
            color: var(--header-text);
            padding: 8px 10px;
            border-right: 1px solid #334155;
            border-bottom: 1px solid #334155;
            text-align: center;
            vertical-align: middle;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.02em;
            line-height: 1.3;
            white-space: nowrap;
        }

        .excel-table thead tr:first-child th {
            background: linear-gradient(to bottom, #0f172a 0%, #020617 100%);
            border-bottom: 1px solid #334155;
            font-weight: 800;
            padding: 10px;
        }

        .excel-table tbody td {
            border-right: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            vertical-align: top;
            padding: 8px 10px;
            color: #0f172a;
            line-height: 1.4;
            font-weight: 500;
            transition: background 0.2s;
        }

        .excel-table tbody tr:hover {
            background: linear-gradient(to right, #fef2f3 0%, #ffffff 100%);
        }

        .excel-table tbody tr:last-child td {
            border-bottom: 2px solid var(--border-color);
        }

        .excel-table td:first-child,
        .excel-table th:first-child {
            border-left: none;
        }

        .excel-table td:last-child,
        .excel-table th:last-child {
            border-right: none;
        }

        /* Column Specific Widths - Readable */
        .excel-table th:nth-child(1),
        .excel-table td:nth-child(1) {
            width: 35px;
            min-width: 35px;
            max-width: 35px;
            text-align: center;
        }

        .excel-table th:nth-child(2),
        .excel-table td:nth-child(2) {
            min-width: 85px;
        }

        .excel-table th:nth-child(3),
        .excel-table td:nth-child(3) {
            min-width: 75px;
        }

        .excel-table th:nth-child(4),
        .excel-table td:nth-child(4) {
            min-width: 65px;
        }

        .excel-table th:nth-child(5),
        .excel-table td:nth-child(5) {
            min-width: 65px;
        }

        .col-no {
            text-align: center;
            font-weight: 700;
            color: var(--primary);
            background: #fef2f3 !important;
        }

        .col-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            font-weight: 700;
            color: #0f172a;
        }

        /* Borders */
        .section-border-right {
            border-right: 3px solid #94a3b8 !important;
        }

        /* Risk Logic */
        .risk-score-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-height: 60px;
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

        /* Lists */
        .ul-dense {
            padding-left: 18px;
            margin: 0;
        }

        .ul-dense li {
            margin-bottom: 6px;
            line-height: 1.5;
        }

        /* Timeline / Approval History - Compact */
        .timeline-card {
            background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%);
            border: 1px solid var(--border);
            border-radius: var(--border-radius);
            padding: 24px 28px;
            margin-bottom: 32px;
            box-shadow: var(--shadow-sm);
        }

        .timeline-header {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-main);
            letter-spacing: -0.01em;
        }

        .timeline-header i {
            color: var(--primary);
            font-size: 18px;
        }

        .timeline-item {
            position: relative;
            padding-left: 28px;
            margin-bottom: 20px;
            border-left: 3px solid #e2e8f0;
            transition: all 0.2s;
        }

        .timeline-item:hover {
            border-left-color: var(--primary);
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            left: -8px;
            top: 4px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #94a3b8;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.2s;
        }

        .timeline-item:hover .timeline-dot {
            transform: scale(1.2);
        }

        .timeline-active .timeline-dot {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: 3px solid white;
            box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.2), 0 4px 12px rgba(196, 30, 58, 0.3);
            width: 16px;
            height: 16px;
            left: -9px;
        }

        .timeline-date {
            font-size: 11px;
            color: #94a3b8;
            margin-bottom: 4px;
            font-weight: 600;
            letter-spacing: 0.025em;
        }

        .timeline-title {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
            letter-spacing: -0.01em;
        }

        .timeline-desc {
            font-size: 12px;
            color: #64748b;
            margin-top: 6px;
            background: white;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            line-height: 1.5;
            font-weight: 500;
        }

        /* PRINT STYLES */
        @media print {

            .sidebar,
            .btn-back,
            .btn-print,
            .user-info-bottom,
            .wizard-container,
            .timeline-card {
                display: none !important;
            }

            .main-content {
                margin-left: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
            }

            .container {
                padding: 0;
                display: block;
            }

            body {
                background: white;
                padding-bottom: 0;
            }

            .doc-banner {
                border: none;
                shadow: none;
                padding: 0;
                margin-bottom: 20px;
                border-bottom: 2px solid #000;
                padding-bottom: 20px;
                border-radius: 0;
            }

            .excel-table {
                font-size: 10px;
                width: 100% !important;
            }

            .excel-table th,
            .excel-table td {
                padding: 6px;
                border-color: #000 !important;
                border-width: 1px !important;
            }

            .excel-table th {
                background: #ddd !important;
                color: #000 !important;
                -webkit-print-color-adjust: exact;
            }

            .risk-badge {
                border: 1px solid #000;
                color: #000 !important;
                background: transparent !important;
            }

            .section-border-right {
                border-right: 2px solid #000 !important;
            }

            .hiradc-wrapper {
                border: none;
                box-shadow: none;
                overflow: visible;
            }

            /* Ensure Landscape Mode hint */
            @page {
                size: landscape;
                margin: 1cm;
            }
        }

        /* CUSTOM TABS styling */
        .page-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 1px;
        }

        .tab-btn {
            background: transparent;
            border: none;
            padding: 12px 24px;
            font-family: inherit;
            font-size: 15px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
            border-radius: 8px 8px 0 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tab-btn:hover {
            color: var(--primary);
            background: rgba(196, 30, 58, 0.05);
        }

        .tab-btn.active {
            color: var(--primary);
            background: white;
            border: 1px solid #e2e8f0;
            border-bottom-color: transparent;
            margin-bottom: -3px; /* Cover the bottom border */
            z-index: 2;
            box-shadow: 0 -4px 6px -1px rgba(0,0,0,0.05);
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 4px;
            background: white;
        }
        
        .tab-btn .badge-counter {
            background: #e2e8f0;
            color: #475569;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 99px;
            transition: all 0.2s;
        }
        
        .tab-btn.active .badge-counter {
            background: var(--primary-light);
            color: var(--primary);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <!-- Sidebar -->
        @include('user.partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <a href="{{ route('documents.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke
                Form Saya</a>

            <!-- Doc Header Banner -->
            <div class="doc-banner">
                <div class="doc-banner-left">
                    <h1>{{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</h1>
                    <p>
                        <span class="doc-meta-badge"><i class="fas fa-building"></i>
                            {{ $document->unit->nama_unit ?? '-' }}</span>

                        <span class="doc-meta-badge"><i class="far fa-clock"></i>
                            {{ $document->created_at->format('d M Y') }}</span>
                    </p>
                </div>
                <div class="action-buttons">
                    <!-- Edit Form Button (Styled Better) -->
                    @if(in_array($document->status, ['draft', 'pending_level1', 'revision']))
                        <a href="{{ route('documents.edit', $document->id) }}" class="btn-edit-programs" 
                           style="background: linear-gradient(135deg, #c41e3a 0%, #9f1239 100%); color: white; border: none; box-shadow: 0 4px 6px -1px rgba(196, 30, 58, 0.3);">
                            <i class="fas fa-edit"></i> Edit Form
                        </a>
                    @endif

                    <!-- Edit Program Kerja Button (Primary Action) -->
                    @if(in_array($document->status, ['draft', 'pending_level1', 'revision']) || ($document->pukProgram && $document->pukProgram->status == 'revision') || ($document->pmkProgram && $document->pmkProgram->status == 'revision'))
                        <a href="{{ route('documents.edit_programs', $document->id) }}" class="btn-edit-programs"
                           style="background: linear-gradient(135deg, #c41e3a 0%, #9f1239 100%); color: white; border: none; box-shadow: 0 4px 6px -1px rgba(196, 30, 58, 0.3);">
                            <i class="fas fa-tasks"></i> Edit Program Kerja
                        </a>
                    @endif
                </div>
            </div>

            <!-- Process Wizard -->
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
                        class="step-item {{ ($document->status == 'approved' || $document->status == 'published') ? 'completed' : ($document->current_level == 3 ? 'active' : '') }}">
                        <div class="step-circle">3</div>
                        <div class="step-label">Kepala Dept.</div>
                    </div>
                    <div
                        class="step-item {{ ($document->status == 'approved' || $document->status == 'published') ? 'completed active' : '' }}">
                        <div class="step-circle"><i class="fas fa-check"></i></div>
                        <div class="step-label">Selesai</div>
                    </div>
                </div>
                @if($document->status == 'revision')
                    <div
                        style="background: #fff7ed; color: #c2410c; padding: 15px; border-radius: 8px; margin-top: 25px; font-size: 14px; border:1px solid #fdba74; display: flex; align-items: start; gap: 12px;">
                        <i class="fas fa-exclamation-triangle" style="margin-top: 2px;"></i>
                        <div>
                            <strong>Form Perlu Revisi</strong>
                            <p style="margin-top: 4px; opacity: 0.9;">Approver telah mengembalikan form ini dengan
                                catatan tertentu. Silakan cek bagian "Riwayat Approval" di bawah, lalu klik tombol Edit
                                untuk memperbaiki. <br>
                                <span style="font-size:13px; color:#c2410c; margin-top:4px; display:inline-block;">
                                    <strong>Info:</strong> Tabel di bawah hanya menampilkan item dari kategori yang perlu
                                    direvisi. Kategori yang sudah disetujui disembunyikan.
                                </span>
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- TABS LOGIC & NAVIGATION -->
            @php
                // Fetch ALL programs (hasManyThrough)
                $pukPrograms = $document->pukPrograms;
                $pmkPrograms = $document->pmkPrograms;
                
                // Determine if we should show the Program Tab
                $hasPrograms = $pukPrograms->count() > 0 || $pmkPrograms->count() > 0;
            @endphp

            <div class="page-tabs">
                <button type="button" class="tab-btn active" onclick="openTab(event, 'tab-hiradc')">
                    <i class="fas fa-table"></i> HIRADC
                </button>
                @if($hasPrograms)
                <button type="button" class="tab-btn" onclick="openTab(event, 'tab-programs')">
                    <i class="fas fa-tasks"></i> Program Kerja
                    <span class="badge-counter">{{ $pukPrograms->count() + $pmkPrograms->count() }}</span>
                </button>
                @endif
            </div>

            <!-- TAB 1: HIRADC CONTENT -->
            <div id="tab-hiradc" class="tab-content active">
                
                <!-- Export Buttons (Moved from Header) -->
                @php
                    $user = Auth::user();
                    $canExport = ($user->id_unit == $document->id_unit) || in_array($user->id_unit, [55, 56]) || in_array($user->role_jabatan, [1, 2]);
                @endphp
                @if($canExport)
                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-bottom: 12px;">
                    <a href="{{ route('documents.export.detail.pdf', $document->id) }}" class="btn-print"
                        target="_blank"
                        style="background:#ef4444; color:white; border-color:#ef4444; text-decoration:none; font-size: 12px; padding: 6px 12px;">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                    <a href="{{ route('documents.export.detail.excel', $document->id) }}" class="btn-print"
                        target="_blank"
                        style="background:#22c55e; color:white; border-color:#22c55e; text-decoration:none; font-size: 12px; padding: 6px 12px;">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                </div>
                @endif

                <div class="hiradc-wrapper">
                <table class="excel-table">
                    <thead>
                        <!-- Header Row 1: Main Sections (BAGIAN 1-5) -->
                        <tr>
                            <th rowspan="2" style="width: 40px;">No</th>
                            <th colspan="4" class="section-border-right">BAGIAN 1: Identifikasi Aktivitas</th>
                            <th colspan="6" class="section-border-right">BAGIAN 2: Identifikasi</th>
                            <th colspan="5" class="section-border-right">BAGIAN 3: Pengendalian & Penilaian Awal</th>
                            <th colspan="3" class="section-border-right">BAGIAN 4: Legalitas & Signifikansi</th>
                            <th colspan="5">BAGIAN 5: Mitigasi Lanjutan</th>
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

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($document->details as $index => $item)
                            @php
                                $skip = false;
                                
                                // ONLY apply filtering logic if document is in revision mode
                                // For normal viewing (draft, pending, approved, published), show ALL details
                                if ($document->status == 'revision') {
                                    // Check which categories are locked (approved/published)
                                    $isSheLocked = ($document->status_she == 'approved' || $document->status_she == 'published');
                                    $isSecLocked = ($document->status_security == 'approved' || $document->status_security == 'published');
                                    
                                    // Check which categories are in revision
                                    $isSheRevision = ($document->status_she == 'revision');
                                    $isSecRevision = ($document->status_security == 'revision');
                                    
                                    // Priority 1: If a specific track is in revision, ONLY show that track
                                    if ($isSheRevision && !$isSecRevision) {
                                        // SHE is revising, Security is NOT revising
                                        // Show ONLY SHE categories (K3, KO, Lingkungan)
                                        if (!in_array($item->kategori, ['K3', 'KO', 'Lingkungan'])) {
                                            $skip = true;
                                        }
                                    } elseif ($isSecRevision && !$isSheRevision) {
                                        // Security is revising, SHE is NOT revising
                                        // Show ONLY Security category (Keamanan)
                                        if ($item->kategori != 'Keamanan') {
                                            $skip = true;
                                        }
                                    } elseif ($isSheRevision && $isSecRevision) {
                                        // Both are revising - show all items
                                        // No filtering needed
                                    } else {
                                        // Neither is revising - check for locked status
                                        if ($item->kategori == 'Keamanan' && $isSecLocked) {
                                            $skip = true;
                                        }
                                        if (in_array($item->kategori, ['K3', 'KO', 'Lingkungan']) && $isSheLocked) {
                                            $skip = true;
                                        }
                                    }
                                }
                                // If not in revision mode, show everything ($skip remains false)
                            @endphp
                            @if($skip) @continue @endif

                            <tr>
                                <td style="text-align:center; padding-top:20px; font-size:14px; color:#1e293b;">
                                    {{ $index + 1 }}
                                </td>
                                <!-- BAGIAN 1: Identifikasi Aktivitas -->
                                <!-- Kolom 2: Kegiatan -->
                                <td>
                                    <div class="cell-text">{{ $item->kolom2_kegiatan }}</div>
                                </td>
                                <!-- Kolom 3: Lokasi -->
                                <td>
                                    <div class="cell-text">{{ $item->kolom3_lokasi }}</div>
                                </td>
                                <!-- Kolom 4: Kategori -->
                                <td>
                                    <div class="cell-input"
                                        style="display:flex; align-items:center; justify-content:center;">
                                        <span class="doc-meta-badge" style="background:#e0e7ff; color:#3730a3;">
                                            {{ $item->kategori }}
                                        </span>
                                    </div>
                                </td>
                                <!-- Kolom 5: Kondisi -->
                                <td class="section-border-right">
                                    <div class="cell-input"
                                        style="display:flex; align-items:center; justify-content:center;">
                                        <span class="doc-meta-badge" style="background:#f1f5f9; color:#475569;">
                                            {{ $item->kolom5_kondisi }}
                                        </span>
                                    </div>
                                </td>

                                <!-- BAGIAN 2: Identifikasi -->

                                <!-- Kolom 6: Potensi Bahaya (K3/KO Only) -->
                                <td>
                                    @if($item->kategori == 'K3' || $item->kategori == 'KO')
                                        <div class="cell-checkbox-group">
                                            @php $bahayaDetails = $item->kolom6_bahaya['details'] ?? []; @endphp
                                            @foreach($bahayaDetails as $detail)
                                                <div class="cell-checkbox-item">
                                                    <i class="fas fa-exclamation-triangle"
                                                        style="color:#ef4444; font-size:10px; margin-top:3px;"></i>
                                                    <span>{{ $detail }}</span>
                                                </div>
                                            @endforeach
                                            @if(!empty($item->kolom6_bahaya['manual']))
                                                <div
                                                    style="font-size:13px; margin-top:8px; padding:6px; background:#fef2f2; border:1px dashed #f87171; border-radius:4px; color:#991b1b;">
                                                    <strong>Lainnya:</strong> {{ $item->kolom6_bahaya['manual'] }}
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div style="color:#94a3b8; text-align:center;">-</div>
                                    @endif
                                </td>

                                <!-- Kolom 7: Aspek Lingkungan (Lingkungan Only) -->
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
                                                    <i class="fas fa-leaf"
                                                        style="color:#22c55e; font-size:10px; margin-top:3px;"></i>
                                                    <span>{{ $aspek }}</span>
                                                </div>
                                            @endforeach
                                            @if(!empty($manual7))
                                                <div
                                                    style="font-size:13px; margin-top:8px; padding:6px; background:#f0fdf4; border:1px dashed #22c55e; border-radius:4px; color:#15803d;">
                                                    <strong>Lainnya:</strong> {{ $manual7 }}
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div style="color:#94a3b8; text-align:center;">-</div>
                                    @endif
                                </td>

                                <!-- Kolom 8: Ancaman Keamanan (Keamanan Only) -->
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
                                                    <i class="fas fa-shield-alt"
                                                        style="color:#dc2626; font-size:10px; margin-top:3px;"></i>
                                                    <span>{{ $threat }}</span>
                                                </div>
                                            @endforeach
                                            @if(!empty($manual8))
                                                <div
                                                    style="font-size:13px; margin-top:8px; padding:6px; background:#fef2f2; border:1px dashed #f87171; border-radius:4px; color:#991b1b;">
                                                    <strong>Lainnya:</strong> {{ $manual8 }}
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div style="color:#94a3b8; text-align:center;">-</div>
                                    @endif
                                </td>

                                <!-- Kolom 9a: RISIKO (K3/KO) -->
                                <td>
                                    @if($item->kategori == 'K3' || $item->kategori == 'KO')
                                        <div class="cell-text">{{ $item->kolom9_risiko_k3ko ?? $item->kolom9_risiko }}</div>
                                    @else
                                        <div style="color:#94a3b8; text-align:center;">-</div>
                                    @endif
                                </td>

                                <!-- Kolom 9b: DAMPAK (Lingkungan) -->
                                <td>
                                    @if($item->kategori == 'Lingkungan')
                                        <div class="cell-text">{{ $item->kolom9_dampak_lingkungan ?? $item->kolom9_risiko }}
                                        </div>
                                    @else
                                        <div style="color:#94a3b8; text-align:center;">-</div>
                                    @endif
                                </td>

                                <!-- Kolom 9c: CELAH (Keamanan) -->
                                <td class="section-border-right">
                                    @if($item->kategori == 'Keamanan')
                                        <div class="cell-text">{{ $item->kolom9_celah_keamanan ?? $item->kolom9_risiko }}</div>
                                    @else
                                        <div style="color:#94a3b8; text-align:center;">-</div>
                                    @endif
                                </td>

                                <!-- BAGIAN 3: Pengendalian & Penilaian -->
                                <!-- Kolom 10: Hirarki Pengendalian -->
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
                                <!-- Kolom 11: Pengendalian Existing -->
                                <td>
                                    <div class="cell-text">{{ $item->kolom11_existing }}</div>
                                </td>
                                <!-- Kolom 12-14: Penilaian Risiko Awal -->
                                <td class="risk-col" style="vertical-align:middle; text-align:center;">
                                    <div style="font-weight:800; font-size:16px;">{{ $item->kolom12_kemungkinan }}</div>
                                </td>
                                <td class="risk-col" style="vertical-align:middle; text-align:center;">
                                    <div style="font-weight:800; font-size:16px;">{{ $item->kolom13_konsekuensi }}</div>
                                </td>
                                <td class="risk-col section-border-right" style="vertical-align:middle;">
                                    <div class="risk-score-box">
                                        <div class="risk-val">{{ $item->kolom14_score }}</div>
                                        <div
                                            class="risk-badge {{ $item->kolom14_score >= 15 ? 'bg-high' : ($item->kolom14_score >= 8 ? 'bg-med' : 'bg-low') }}">
                                            {{ $item->kolom14_score >= 15 ? 'TINGGI' : ($item->kolom14_score >= 8 ? 'SEDANG' : 'RENDAH') }}
                                        </div>
                                    </div>
                                </td>

                                <!-- BAGIAN 4: Legalitas & Signifikansi -->
                                <!-- Kolom 15: Regulasi -->
                                <td>
                                    <div class="cell-text">{{ $item->kolom15_regulasi }}</div>
                                </td>
                                <!-- Kolom 16: Aspek Lingkungan Penting (Only for Lingkungan) -->
                                <td style="text-align:center; vertical-align:middle;">
                                    @if($item->kategori == 'Lingkungan' && $item->kolom16_aspek)
                                        <div class="doc-meta-badge"
                                            style="{{ $item->kolom16_aspek == 'P' ? 'background:#dbeafe; color:#1e40af;' : 'background:#f1f5f9; color:#64748b;' }}">
                                            {{ $item->kolom16_aspek }}
                                        </div>
                                    @else
                                        <div style="color:#94a3b8;">-</div>
                                    @endif
                                </td>
                                <!-- Kolom 17: Peluang & Risiko -->
                                <td class="section-border-right">
                                    <div class="risk-section">
                                        @if($item->kolom17_risiko)
                                            <div class="risk-label">RISIKO (-):</div>
                                            <div class="risk-text">{{ $item->kolom17_risiko }}</div>
                                        @endif
                                        @if($item->kolom17_peluang)
                                            <div class="risk-label"
                                                style="border-top:1px solid #e2e8f0; margin-top:6px; padding-top:6px;">
                                                PELUANG (+):</div>
                                            <div class="risk-text">{{ $item->kolom17_peluang }}</div>
                                        @endif
                                    </div>
                                </td>

                                <!-- BAGIAN 5: Mitigasi Lanjutan & Risiko Sisa -->
                                <!-- Kolom 18: Toleransi -->
                                <td style="text-align:center; vertical-align:middle;">
                                    <div class="doc-meta-badge"
                                        style="{{ $item->kolom18_toleransi == 'Ya' ? 'background:#dcfce7; color:#166534;' : 'background:#fee2e2; color:#991b1b;' }}">
                                        {{ $item->kolom18_toleransi == 'Ya' ? 'Ya' : 'Tidak' }}
                                    </div>
                                </td>
                                <!-- Kolom 19-22: Follow-up Risk (Only if Tolerance = Tidak) -->
                                @if($item->kolom18_toleransi == 'Tidak')
                                    <!-- Kolom 19: Pengendalian Lanjut -->
                                    <td>
                                        <div class="cell-text">{{ $item->kolom19_pengendalian_lanjut }}</div>
                                    </td>
                                    <!-- Kolom 20-22: Penilaian Risiko Lanjut -->
                                    <td class="risk-col" style="vertical-align:middle; text-align:center;">
                                        <div style="font-weight:800; font-size:16px;">{{ $item->kolom20_kemungkinan_lanjut }}
                                        </div>
                                    </td>
                                    <td class="risk-col" style="vertical-align:middle; text-align:center;">
                                        <div style="font-weight:800; font-size:16px;">{{ $item->kolom21_konsekuensi_lanjut }}
                                        </div>
                                    </td>
                                    <td class="risk-col" style="vertical-align:middle;">
                                        <div class="risk-score-box">
                                            <div class="risk-val">{{ $item->kolom22_tingkat_risiko_lanjut }}</div>
                                            @if($item->kolom22_tingkat_risiko_lanjut)
                                                <div
                                                    class="risk-badge {{ $item->kolom22_tingkat_risiko_lanjut >= 15 ? 'bg-high' : ($item->kolom22_tingkat_risiko_lanjut >= 8 ? 'bg-med' : 'bg-low') }}">
                                                    {{ $item->kolom22_level_lanjut }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                @else
                                    <!-- Empty cells when tolerance = Ya -->
                                    <td>
                                        <div style="color:#94a3b8; text-align:center;">-</div>
                                    </td>
                                    <td>
                                        <div style="color:#94a3b8; text-align:center;">-</div>
                                    </td>
                                    <td>
                                        <div style="color:#94a3b8; text-align:center;">-</div>
                                    </td>
                                    <td>
                                        <div style="color:#94a3b8; text-align:center;">-</div>
                                    </td>
                                @endif


                            </tr>
                        @empty
                            <!-- FALLBACK FOR LEGACY DATA (Single Row from Header) -->
                            <tr>
                                <td style="text-align:center;">1</td>
                                <td>{{ $document->kolom2_kegiatan }}</td>
                                <td>{{ $document->kolom3_lokasi }}</td>
                                <td class="section-border-right">
                                    @if($document->kolom5_kondisi == 'N') Normal
                                    @elseif($document->kolom5_kondisi == 'AN') Abnormal
                                    @else Emergency @endif
                                </td>
                                <td>
                                    <ul class="ul-dense">
                                        @foreach($document->kolom6_bahaya['details'] ?? [] as $d) <li>{{$d}}</li>
                                        @endforeach
                                        @foreach($document->kolom6_bahaya['aspects'] ?? [] as $d) <li>{{$d}}</li>
                                        @endforeach
                                        @if(!empty($document->kolom6_bahaya['manual']))
                                        <li>{{$document->kolom6_bahaya['manual']}}</li> @endif
                                    </ul>
                                </td>
                                <td>{{ $document->kolom7_dampak }}</td>
                                <td class="section-border-right">{{ $document->kolom9_risiko }}</td>
                                <td>
                                    <div style="margin-bottom:8px;">
                                        <strong>Hirarki:</strong><br>
                                        {{ implode(', ', $document->kolom10_pengendalian['hierarchy'] ?? []) }}
                                    </div>
                                    @if(!empty($document->kolom10_pengendalian['existing']))
                                        <div style="border-top:1px dashed #cbd5e1; padding-top:8px;">
                                            <strong style="color:#0f172a; font-size:11px;">EXISTING:</strong><br>
                                            {{ $document->kolom10_pengendalian['existing'] }}
                                        </div>
                                    @endif
                                </td>
                                <td class="section-border-right">{{ $document->kolom11_existing }}</td>
                                <td style="text-align:center;">{{ $document->kolom12_kemungkinan }}</td>
                                <td style="text-align:center;">{{ $document->kolom13_konsekuensi }}</td>
                                <td class="section-border-right">
                                    @php
                                        $sc = $document->kolom14_score;
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
                                    @endphp
                                    <div class="risk-score-box">
                                        <div class="risk-val">{{ $sc }}</div>
                                        <div class="risk-badge {{ $bg }}">{{ $lvl }}</div>
                                    </div>
                                </td>
                                <td>{{ $document->kolom15_regulasi }}</td>
                                <td class="section-border-right" style="text-align: center; font-weight: bold;">
                                    {{ $document->kolom16_aspek }}
                                </td>

                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            </div> <!-- End of tab-hiradc -->

            <!-- TAB 2: PROGRAM KERJA CONTENT -->
            <div id="tab-programs" class="tab-content" style="padding-top: 10px;">
                
                @if(!$hasPrograms)
                    <div style="text-align: center; padding: 40px; background: #f8fafc; border-radius: 12px; border: 2px dashed #e2e8f0; color: #64748b;">
                        <i class="fas fa-clipboard-list" style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;"></i>
                        <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 8px;">Tidak Ada Program Kerja</h3>
                        <p>Dokumen ini tidak memiliki item dengan risiko yang memerlukan Program Unit Kerja (PUK) atau Program Manajemen Korporat (PMK).</p>
                    </div>
                @endif
                
                @foreach($document->details as $detailIndex => $detail)
                    @php
                        $puk = $detail->pukProgram;
                        $pmk = $detail->pmkProgram;
                    @endphp

                    @if($puk || $pmk)
                    <div class="group-container" style="margin-bottom: 40px;">
                        <!-- Activity Header (Matches HIRADC Row) -->
                        <div style="background: #f1f5f9; padding: 12px 20px; border-radius: 8px; border-left: 4px solid #475569; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
                            <div style="background: #475569; color: white; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: 700; font-size: 12px;">
                                {{ $detailIndex + 1 }}
                            </div>
                            <div style="font-weight: 700; color: #334155; font-size: 15px;">
                                Kegiatan: <span style="font-weight: 600; color: #475569;">{{ $detail->kolom2_kegiatan }}</span>
                            </div>
                        </div>

                        <!-- PUK CARD -->
                        @if($puk)
                        <div class="content-card" style="margin-bottom: 30px; border-left: 4px solid #dc2626; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); margin-left: 20px;">
                            <div class="card-header" style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); color: white; padding: 15px 20px; border-radius: 12px 12px 0 0;">
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div>
                                            <div style="font-size: 16px; font-weight: 700;">PROGRAM UNIT KERJA (PUK)</div>
                                            <div style="font-size: 12px; opacity: 0.9;">{{ $puk->judul }}</div>
                                        </div>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <!-- Download Buttons -->
                                        <a href="{{ route('documents.export.puk.pdf', $document->id) }}" 
                                           class="btn btn-sm" 
                                           style="background-color: rgba(255,255,255,0.2); color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; display: inline-flex; align-items: center; gap: 6px; border: 1px solid rgba(255,255,255,0.3); transition: all 0.2s;"
                                           onmouseover="this.style.backgroundColor='rgba(255,255,255,0.3)'"
                                           onmouseout="this.style.backgroundColor='rgba(255,255,255,0.2)'">
                                            <i class="fas fa-file-pdf"></i> PDF
                                        </a>
                                        <a href="{{ route('documents.export.puk.excel', $document->id) }}" 
                                           class="btn btn-sm" 
                                           style="background-color: rgba(255,255,255,0.2); color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; display: inline-flex; align-items: center; gap: 6px; border: 1px solid rgba(255,255,255,0.3); transition: all 0.2s;"
                                           onmouseover="this.style.backgroundColor='rgba(255,255,255,0.3)'"
                                           onmouseout="this.style.backgroundColor='rgba(255,255,255,0.2)'">
                                            <i class="fas fa-file-excel"></i> Excel
                                        </a>
                                        <span style="background: rgba(255,255,255,0.2); padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600;">{{ $puk->status ?? 'Draft' }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="padding: 24px; background: #ffffff;">
                                <!-- Informasi Program -->
                                <div style="background: #f8fafc; padding: 20px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #e2e8f0;">
                                    <table style="width: 100%; font-size: 14px;">
                                        <tr>
                                            <td style="padding: 8px 0; width: 180px; font-weight: 600; color: #475569;">Judul Program</td>
                                            <td style="padding: 8px 0; color: #0f172a;">: <strong>{{ $puk->judul }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 600; color: #475569; vertical-align: top;">Tujuan</td>
                                            <td style="padding: 8px 0; color: #0f172a;">: {{ $puk->tujuan }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 600; color: #475569; vertical-align: top;">Sasaran</td>
                                            <td style="padding: 8px 0; color: #0f172a;">: {{ $puk->sasaran }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 600; color: #475569;">Penanggung Jawab</td>
                                            <td style="padding: 8px 0; color: #0f172a;">: {{ $puk->penanggung_jawab }}</td>
                                        </tr>
                                        @if($puk->uraian_revisi)
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 600; color: #475569; vertical-align: top;">Uraian Revisi</td>
                                            <td style="padding: 8px 0; color: #0f172a;">: {{ $puk->uraian_revisi }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>

                                <!-- Tabel Program Kerja -->
                                @if($puk->program_kerja && is_array($puk->program_kerja) && count($puk->program_kerja) > 0)
                                <div>
                                    <h4 style="font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 12px; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px;">
                                        <i class="fas fa-list-check" style="color: #dc2626; margin-right: 6px;"></i> Detail Kegiatan
                                    </h4>
                                    <div class="hiradc-wrapper" style="margin-bottom: 0;">
                                        <table class="excel-table" style="min-width: 100%;">
                                            <thead>
                                                <tr style="background: #1e293b; color: white;">
                                                    <th rowspan="2" style="width: 40px; text-align: center;">No</th>
                                                    <th rowspan="2" style="text-align: left;">Uraian Kegiatan</th>
                                                    <th rowspan="2" style="text-align: left; width: 120px;">Koordinator</th>
                                                    <th rowspan="2" style="text-align: left; width: 120px;">Pelaksana</th>
                                                    <th colspan="12" style="text-align: center;">Target (%)</th>

                                                </tr>
                                                <tr style="background: #334155; color: white;">
                                                    @for($m=1; $m<=12; $m++) <th style="text-align: center; width: 30px; font-size: 10px;">{{ $m }}</th> @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($puk->program_kerja as $itemIndex => $item)
                                                <tr>
                                                    <td style="text-align: center;">{{ $itemIndex + 1 }}</td>
                                                    <td>{{ $item['uraian'] ?? '-' }}</td>
                                                    <td>{{ $item['koordinator'] ?? '-' }}</td>
                                                    <td>{{ $item['pelaksana'] ?? '-' }}</td>
                                                    @php $targets = $item['target'] ?? []; @endphp
                                                    @for($m=0; $m<12; $m++)
                                                        <td style="text-align: center; font-size: 11px; background: {{ (isset($targets[$m]) && $targets[$m] != '') ? '#eff6ff' : 'transparent' }};">
                                                            {{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '' }}
                                                        </td>
                                                    @endfor

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- PMK PROGRAMS -->
                        @if($pmk)
                        <div class="content-card" style="margin-bottom: 30px; border-left: 4px solid #dc2626; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); margin-left: 20px;">
                            <div class="card-header" style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); color: white; padding: 15px 20px; border-radius: 12px 12px 0 0;">
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div>
                                            <div style="font-size: 16px; font-weight: 700;">PROGRAM MANAJEMEN KORPORAT (PMK)</div>
                                            <div style="font-size: 12px; opacity: 0.9;">{{ $pmk->judul }}</div>
                                        </div>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <!-- Download Buttons -->
                                        <a href="{{ route('documents.export.pmk.pdf', $document->id) }}" 
                                           class="btn btn-sm" 
                                           style="background-color: rgba(255,255,255,0.2); color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; display: inline-flex; align-items: center; gap: 6px; border: 1px solid rgba(255,255,255,0.3); transition: all 0.2s;"
                                           onmouseover="this.style.backgroundColor='rgba(255,255,255,0.3)'"
                                           onmouseout="this.style.backgroundColor='rgba(255,255,255,0.2)'">
                                            <i class="fas fa-file-pdf"></i> PDF
                                        </a>
                                        <a href="{{ route('documents.export.pmk.excel', $document->id) }}" 
                                           class="btn btn-sm" 
                                           style="background-color: rgba(255,255,255,0.2); color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; display: inline-flex; align-items: center; gap: 6px; border: 1px solid rgba(255,255,255,0.3); transition: all 0.2s;"
                                           onmouseover="this.style.backgroundColor='rgba(255,255,255,0.3)'"
                                           onmouseout="this.style.backgroundColor='rgba(255,255,255,0.2)'">
                                            <i class="fas fa-file-excel"></i> Excel
                                        </a>
                                        <span style="background: rgba(255,255,255,0.2); padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600;">{{ $pmk->status ?? 'Draft' }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="padding: 24px; background: #ffffff;">
                                <!-- Informasi Program -->
                                <div style="background: #faf5ff; padding: 20px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #e9d5ff;">
                                    <table style="width: 100%; font-size: 14px;">
                                        <tr>
                                            <td style="padding: 8px 0; width: 180px; font-weight: 600; color: #475569;">Judul Program</td>
                                            <td style="padding: 8px 0; color: #0f172a;">: <strong>{{ $pmk->judul }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 600; color: #475569; vertical-align: top;">Tujuan</td>
                                            <td style="padding: 8px 0; color: #0f172a;">: {{ $pmk->tujuan }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 600; color: #475569; vertical-align: top;">Sasaran</td>
                                            <td style="padding: 8px 0; color: #0f172a;">: {{ $pmk->sasaran }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 600; color: #475569;">Penanggung Jawab</td>
                                            <td style="padding: 8px 0; color: #0f172a;">: {{ $pmk->penanggung_jawab }}</td>
                                        </tr>
                                        @if($pmk->uraian_revisi)
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 600; color: #475569; vertical-align: top;">Uraian Revisi</td>
                                            <td style="padding: 8px 0; color: #0f172a;">: {{ $pmk->uraian_revisi }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>

                                <!-- Tabel Program Kerja -->
                                @if($pmk->program_kerja && is_array($pmk->program_kerja) && count($pmk->program_kerja) > 0)
                                <div>
                                    <h4 style="font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 12px; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px;">
                                        <i class="fas fa-list-check" style="color: #dc2626; margin-right: 6px;"></i> Detail Kegiatan
                                    </h4>
                                    <div class="hiradc-wrapper" style="margin-bottom: 0;">
                                        <table class="excel-table" style="min-width: 100%;">
                                            <thead>
                                                <tr style="background: #1e293b; color: white;">
                                                    <th rowspan="2" style="width: 40px; text-align: center;">No</th>
                                                    <th rowspan="2" style="text-align: left;">Uraian Kegiatan</th>
                                                    <th rowspan="2" style="text-align: left; width: 120px;">PIC</th>
                                                    <th colspan="12" style="text-align: center;">Target (%)</th>
                                                    <th rowspan="2" style="text-align: left; width: 120px;">Anggaran</th>
                                                </tr>
                                                <tr style="background: #334155; color: white;">
                                                    @for($m=1; $m<=12; $m++) <th style="text-align: center; width: 30px; font-size: 10px;">{{ $m }}</th> @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pmk->program_kerja as $itemIndex => $item)
                                                <tr>
                                                    <td style="text-align: center;">{{ $itemIndex + 1 }}</td>
                                                    <td>{{ $item['uraian'] ?? '-' }}</td>
                                                    <td>{{ (!empty($item['koordinator']) && $item['koordinator'] !== '-') ? $item['koordinator'] : ($item['pelaksana'] ?? $item['pic'] ?? '-') }}</td>
                                                    @php $targets = $item['target'] ?? []; @endphp
                                                    @for($m=0; $m<12; $m++)
                                                        <td style="text-align: center; font-size: 11px; background: {{ (isset($targets[$m]) && $targets[$m] != '') ? '#eff6ff' : 'transparent' }};">
                                                            {{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '' }}
                                                        </td>
                                                    @endfor
                                                    <td>{{ isset($item['anggaran']) ? 'Rp ' . number_format($item['anggaran'], 0, ',', '.') : '-' }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                    </div>
                    @endif
                @endforeach
            </div>
            
            <!-- Approval History -->
            <div class="timeline-card">
                <div class="timeline-header">
                    <i class="fas fa-history" style="color:var(--secondary);"></i> Riwayat Approval & Catatan
                </div>
                <div class="timeline">
                    @forelse($document->approvals->sortByDesc('created_at') as $log)
                        <div class="timeline-item timeline-active">
                            <div class="timeline-dot"></div>
                            <div class="timeline-date">{{ $log->created_at->format('d M Y, H:i') }}</div>
                            <div class="timeline-title">
                                @if($log->action == 'approved') <span style="color: #15803d;">Disetujui</span>
                                @elseif($log->action == 'revised') <span style="color: #b91c1c;">Revisi diminta</span>
                                @else {{ ucfirst($log->action) }} @endif
                                oleh {{ $log->approver->nama_user ?? 'System' }}
                            </div>
                            @if($log->catatan)
                                <div class="timeline-desc">"{{ $log->catatan }}"</div>
                            @endif
                        </div>
                    @empty
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-title" style="color:#94a3b8; font-weight:500;">Belum ada aktivitas
                                approval.</div>
                        </div>
                    @endforelse
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-date">{{ $document->created_at->format('d M Y, H:i') }}</div>
                        <div class="timeline-title">Form Dibuat</div>
                    </div>
                </div>
            </div>

            <!-- UNIFIED ACTION BUTTONS CARD (Draft & Revision) -->
            @php
                $isDraft = ($document->status == 'draft');
                $isRevision = ($document->status == 'revision' || $document->status_she == 'revision' || $document->status_security == 'revision');
                $canEdit = (Auth::id() == $document->created_by || Auth::id() == $document->id_user) && ($isDraft || $isRevision);
            @endphp

            @if($canEdit)
            <div class="action-card" id="action-section" style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 28px; margin-bottom: 32px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); margin-top: 32px;">
                <div style="margin-bottom: 24px;">
                    <h4 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 8px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-paper-plane" style="color: #c41e3a;"></i> Aksi Dokumen
                    </h4>
                    <p style="color: #64748b; font-size: 14px; line-height: 1.6;">
                        @if($isDraft)
                            Anda dapat menyimpan dokumen sebagai draft atau mengirimkannya ke Kepala Unit Kerja untuk proses approval.
                        @else
                            Setelah selesai memperbaiki data, silakan tulis catatan perbaikan dan kirimkan kembali ke Kepala Unit Kerja.
                        @endif
                    </p>
                </div>

                <form id="actionForm" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
                    @csrf
                    <input type="hidden" name="action_type" id="action_type" value="">
                    
                    <!-- Notes Textarea -->
                    <div>
                        <label for="submission_notes" style="display: block; font-size: 14px; font-weight: 600; color: #334155; margin-bottom: 8px;">
                            Catatan <span style="color: #ef4444;" id="required_indicator">(Wajib diisi untuk Submit/Revisi)</span>
                        </label>
                        {{-- Use different name for revision to match controller expectation --}}
                        <textarea 
                            name="{{ $isRevision ? 'revision_comment' : 'submission_notes' }}" 
                            id="submission_notes" 
                            rows="4"
                            placeholder="{{ $isRevision ? 'Jelaskan bagian mana saja yang telah diperbaiki...' : 'Tuliskan catatan atau keterangan tambahan mengenai dokumen ini...' }}"
                            oninput="validateNotes()"
                            style="width: 100%; padding: 14px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 14px; font-family: 'Plus Jakarta Sans', sans-serif; resize: vertical; transition: all 0.2s; line-height: 1.6;"
                            onfocus="this.style.borderColor='#c41e3a'; this.style.boxShadow='0 0 0 3px rgba(196, 30, 58, 0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'"
                        ></textarea>
                        <div id="notes_hint" style="font-size: 12px; color: #94a3b8; margin-top: 6px;">
                            <i class="fas fa-info-circle"></i> Catatan wajib diisi
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; gap: 12px; justify-content: flex-end; flex-wrap: wrap;">
                        <!-- Save Draft Button (Only for Draft) -->
                        @if($isDraft)
                        <button 
                            type="button" 
                            onclick="submitAction('draft')"
                            class="btn-draft"
                            style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 14px 28px; border-radius: 10px; font-weight: 700; font-size: 15px; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 12px -2px rgba(16, 185, 129, 0.4)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(16, 185, 129, 0.3)'"
                        >
                            <i class="fas fa-save"></i>
                            <span>Simpan Draft</span>
                        </button>
                        @endif

                        <!-- Submit Button -->
                        <button 
                            type="button" 
                            id="btn_submit"
                            onclick="submitAction('{{ $isRevision ? 'revision' : 'submit' }}')"
                            disabled
                            style="background: #94a3b8; color: white; border: none; padding: 14px 28px; border-radius: 10px; font-weight: 700; font-size: 15px; cursor: not-allowed; transition: all 0.2s; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 6px -1px rgba(148, 163, 184, 0.3);"
                        >
                            <i class="fas fa-paper-plane"></i>
                            <span>{{ $isRevision ? 'Kirim Revisi' : 'Submit ke Kepala Unit' }}</span>
                        </button>
                    </div>
                </form>
            </div>

            <script>
                // Scroll to action section if needed
                document.addEventListener('DOMContentLoaded', function() {
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('action_needed')) {
                        document.getElementById('action-section').scrollIntoView({ behavior: 'smooth' });
                    }
                });

                function validateNotes() {
                    const notes = document.getElementById('submission_notes').value.trim();
                    const submitBtn = document.getElementById('btn_submit');
                    const hint = document.getElementById('notes_hint');
                    
                    if (notes.length > 0) {
                        // Enable submit button
                        submitBtn.disabled = false;
                        submitBtn.style.background = 'linear-gradient(135deg, #c41e3a 0%, #a01729 100%)';
                        submitBtn.style.cursor = 'pointer';
                        submitBtn.style.boxShadow = '0 4px 6px -1px rgba(196, 30, 58, 0.3)';
                        submitBtn.onmouseover = function() {
                            this.style.transform = 'translateY(-2px)';
                            this.style.boxShadow = '0 6px 12px -2px rgba(196, 30, 58, 0.4)';
                        };
                        submitBtn.onmouseout = function() {
                            this.style.transform = 'translateY(0)';
                            this.style.boxShadow = '0 4px 6px -1px rgba(196, 30, 58, 0.3)';
                        };
                        hint.style.color = '#10b981';
                        hint.innerHTML = '<i class="fas fa-check-circle"></i> Catatan sudah cukup untuk submit';
                    } else {
                        // Disable submit button
                        submitBtn.disabled = true;
                        submitBtn.style.background = '#94a3b8';
                        submitBtn.style.cursor = 'not-allowed';
                        submitBtn.style.boxShadow = '0 4px 6px -1px rgba(148, 163, 184, 0.3)';
                        submitBtn.onmouseover = null;
                        submitBtn.onmouseout = null;
                        submitBtn.style.transform = 'translateY(0)';
                        hint.style.color = '#94a3b8';
                        hint.innerHTML = '<i class="fas fa-info-circle"></i> Catatan wajib diisi';
                    }
                }

                function submitAction(actionType) {
                    const notes = document.getElementById('submission_notes').value.trim();
                    const form = document.getElementById('actionForm');
                    
                    // Validation for submit/revision action
                    if ((actionType === 'submit' || actionType === 'revision') && notes.length === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Catatan Diperlukan',
                            text: 'Silakan isi catatan sebelum submit dokumen.',
                            confirmButtonColor: '#c41e3a'
                        });
                        return;
                    }
                    
                    // Set action type
                    document.getElementById('action_type').value = actionType;
                    
                    // Confirmation dialog text
                    let title, text, confirmText, icon;
                    
                    if (actionType === 'draft') {
                        title = 'Simpan sebagai Draft?';
                        text = 'Dokumen akan disimpan sebagai draft dan dapat diedit kembali.';
                        confirmText = 'Ya, Simpan';
                        icon = 'question';
                    } else if (actionType === 'revision') {
                        title = 'Kirim Revisi?';
                        text = 'Dokumen yang telah diperbaiki akan dikirim kembali ke Kepala Unit Kerja untuk diperiksa.';
                        confirmText = 'Ya, Kirim Revisi';
                        icon = 'info';
                    } else {
                        title = 'Submit ke Kepala Unit?';
                        text = 'Dokumen akan dikirim ke Kepala Unit Kerja untuk proses approval.';
                        confirmText = 'Ya, Submit';
                        icon = 'info';
                    }
                    
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        showCancelButton: true,
                        confirmButtonColor: actionType === 'draft' ? '#10b981' : '#c41e3a',
                        cancelButtonColor: '#94a3b8',
                        confirmButtonText: confirmText,
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Set form action based on type
                            if (actionType === 'draft') {
                                form.action = '{{ route("documents.update", $document->id) }}';
                                form.method = 'POST';
                                // Add method spoofing for PUT
                                let methodInput = document.createElement('input');
                                methodInput.type = 'hidden';
                                methodInput.name = '_method';
                                methodInput.value = 'PUT';
                                form.appendChild(methodInput);
                            } else if (actionType === 'revision') {
                                form.action = '{{ route("documents.submit_revision", $document->id) }}';
                                form.method = 'POST';
                            } else {
                                form.action = '{{ route("documents.submit", $document->id) }}';
                                form.method = 'POST';
                            }
                            
                            // Show loading
                            Swal.fire({
                                title: 'Memproses...',
                                text: 'Mohon tunggu sebentar',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            
                            // Submit form
                            form.submit();
                        }
                    });
                }
            </script>
            @endif

        </main>
    </div>
    <!-- Tab Switching Script (Restored) -->
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            
            // Hide all tab content
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove("active");
                tabcontent[i].style.display = "none";
            }
            
            // Remove active class from buttons
            tablinks = document.getElementsByClassName("tab-btn");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            
            // Show current tab and activate button
            var currentTab = document.getElementById(tabName);
            if (currentTab) {
                currentTab.style.display = "block";
                // Small timeout to allow display block to apply before adding class for animation
                setTimeout(() => currentTab.classList.add("active"), 10);
            }
            
            if (evt && evt.currentTarget) {
                evt.currentTarget.classList.add("active");
            }
        }
    </script>
</body>

</html>