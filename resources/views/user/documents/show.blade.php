<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $document->kolom2_kegiatan }} | Detail HIRADC - PT Semen Padang</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .btn-print {
            background: white;
            border: 1px solid #e2e8f0;
            color: #0f172a;
            padding: 10px 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: -0.01em;
        }

        .btn-print:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
                    @if($document->status == 'revision' || $document->status == 'draft')
                        <a href="{{ route('documents.edit', $document->id) }}" class="btn-print"
                            style="background:var(--primary); color:white; border-color:var(--primary);">
                            <i class="fas fa-edit"></i> Edit Form
                        </a>
                    @endif

                    @php
                        $user = Auth::user();
                        // Export access: Originating Unit, SHE/Security Units (55,56), or Management (role 1,2)
                        $canExport = ($user->id_unit == $document->id_unit)
                            || in_array($user->id_unit, [55, 56])
                            || in_array($user->role_jabatan, [1, 2]);
                    @endphp

                    @if($canExport)
                        <a href="{{ route('documents.export.detail.pdf', $document->id) }}" class="btn-print"
                            target="_blank"
                            style="background:#ef4444; color:white; border-color:#ef4444; text-decoration:none;">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                        <a href="{{ route('documents.export.detail.excel', $document->id) }}" class="btn-print"
                            target="_blank"
                            style="background:#22c55e; color:white; border-color:#22c55e; text-decoration:none;">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                    @endif

                    <div style="width: 1px; height: 30px; background: #e2e8f0; margin: 0 5px;"></div>
                    <button onclick="window.print()" class="btn-print">
                        <i class="fas fa-print"></i> Print View
                    </button>
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

            <!-- Full HIRADC Table View -->
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
                        @forelse($document->details as $index => $item)
                            @php
                                // Logic Partial Revision View
                                $isRev = $document->status == 'revision';
                                $isSheLocked = $isRev && ($document->status_she == 'approved' || $document->status_she == 'published');
                                $isSecLocked = $isRev && ($document->status_security == 'approved' || $document->status_security == 'published');

                                $skip = false;
                                if ($item->kategori == 'Keamanan' && $isSecLocked)
                                    $skip = true;
                                if (in_array($item->kategori, ['K3', 'KO', 'Lingkungan']) && $isSheLocked)
                                    $skip = true;
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

                                <!-- Residual Risk (Always displayed) -->
                                <td class="risk-col" style="vertical-align:middle; text-align:center;">
                                    <div style="font-weight:800; font-size:16px;">{{ $item->residual_kemungkinan }}
                                    </div>
                                </td>
                                <td class="risk-col" style="vertical-align:middle; text-align:center;">
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
                                <td style="text-align:center;">{{ $document->residual_kemungkinan }}</td>
                                <td style="text-align:center;">{{ $document->residual_konsekuensi }}</td>
                                <td>
                                    @php
                                        $r_sc = $document->residual_score;
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
                                    <div class="risk-score-box">
                                        <div class="risk-val">{{ $r_sc }}</div>
                                        @if($r_sc)
                                        <div class="risk-badge {{ $r_bg }}">{{ $r_lvl }}</div> @else - @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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

        </main>
    </div>
</body>

</html>