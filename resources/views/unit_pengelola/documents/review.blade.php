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
        /* Base styles from Approver View */
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

        /* Sidebar Styles (Assuming included or standard) */
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
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
            color: #666;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            position: relative;
            transition: all 0.3s ease;
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
            /* Extra bottom padding for footer */
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

        /* Document Card */
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

        /* PROFESSIONAL ENTERPRISE HIRADC TABLE from Approver View */
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
            margin-bottom: 40px;
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
            white-space: nowrap;
        }

        .excel-table thead tr:first-child th {
            background: #0f172a;
            font-size: 13px;
            border-bottom: 1px solid #334155;
        }

        .excel-table thead tr:first-child th:first-child {
            position: sticky;
            left: 0;
            z-index: 52;
            border-right: 2px solid #475569;
        }

        .excel-table tbody td {
            border-right: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            background: white;
            vertical-align: top;
            padding: 0;
            transition: background 0.1s;
        }

        .excel-table tbody td:first-child {
            position: sticky;
            left: 0;
            background: #f8fafc;
            z-index: 40;
            border-right: 2px solid #94a3b8;
            text-align: center;
            vertical-align: top;
            padding-top: 15px;
            font-weight: 700;
            color: #64748b;
        }

        .excel-table tbody td:first-child:hover {
            background: #f1f5f9;
        }

        .cell-text,
        .cell-input {
            width: 100%;
            padding: 12px 14px;
            font-family: inherit;
            font-size: 13px;
            line-height: 1.5;
            color: #334155;
            background: transparent;
            min-height: 50px;
        }

        .section-border-right {
            border-right: 3px solid #94a3b8 !important;
        }

        .risk-col {
            width: 50px;
            text-align: center;
            background: #fff;
            vertical-align: top;
            padding: 5px !important;
        }

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

        .cell-checkbox-group {
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 250px;
        }

        .cell-checkbox-item {
            display: flex;
            gap: 10px;
            font-size: 13px;
            align-items: flex-start;
            line-height: 1.4;
            color: #334155;
        }

        /* Wizard */
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

        .step-item.active .step-circle {
            border-color: var(--primary);
            background: #fff1f2;
            color: var(--primary);
            box-shadow: 0 0 0 4px rgba(196, 30, 58, 0.1);
        }

        .step-item.active .step-label {
            color: var(--primary);
            font-weight: 700;
        }

        .step-item.completed .step-circle {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        /* Footer (Unit Pengelola Specific) */
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
            flex-direction: column;
            gap: 20px;
        }

        .notes-area {
            flex: 1;
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
            background: #f8fafc;
        }

        .action-btns {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn {
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-approve {
            background: #16a34a;
            color: white;
        }

        .btn-revise {
            background: #dc2626;
            color: white;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            font-size: 14px;
        }

        .alert {
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .alert-info {
            background: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }

        .alert-warning {
            background: #fefce8;
            color: #854d0e;
            border: 1px solid #fef9c3;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        /* Timeline Modern */
        .timeline-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            padding: 30px;
            margin-top: 40px;
            margin-bottom: 120px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .timeline-header {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .timeline-container {
            position: relative;
            padding-left: 10px;
        }

        /* Vertical Line */
        .timeline-container::before {
            content: '';
            position: absolute;
            left: 24px; /* Align with icon center */
            top: 10px;
            bottom: 20px;
            width: 2px;
            background: #e2e8f0;
            z-index: 0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            display: flex;
            gap: 20px;
            z-index: 1;
        }

        .tm-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #f1f5f9;
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            box-shadow: 0 0 0 4px #f8fafc;
            color: #64748b;
            flex-shrink: 0;
            position: relative;
            left: -2px; /* Fine tune alignment */
        }

        /* Color Variants */
        .timeline-item.tm-green .tm-icon { background: #dcfce7; color: #166534; box-shadow: 0 0 0 4px #f0fdf4; }
        .timeline-item.tm-red .tm-icon { background: #fee2e2; color: #991b1b; box-shadow: 0 0 0 4px #fef2f2; }
        .timeline-item.tm-blue .tm-icon { background: #dbeafe; color: #1e40af; box-shadow: 0 0 0 4px #eff6ff; }
        .timeline-item.tm-purple .tm-icon { background: #f3e8ff; color: #6b21a8; box-shadow: 0 0 0 4px #faf5ff; }

        .tm-content {
            background: #f8fafc;
            padding: 15px 20px;
            border-radius: 12px;
            flex: 1;
            border: 1px solid #f1f5f9;
        }

        .tm-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tm-user {
            font-weight: 700;
            color: #334155;
            font-size: 14px;
        }

        .tm-badge {
            font-size: 10px;
            text-transform: uppercase;
            padding: 2px 8px;
            border-radius: 99px;
            background: #e2e8f0;
            color: #64748b;
            font-weight: 600;
        }

        .tm-date {
            font-size: 12px;
            color: #94a3b8;
        }

        .tm-status {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #475569;
        }
        .timeline-item.tm-green .tm-status { color: #166534; }
        .timeline-item.tm-red .tm-status { color: #991b1b; }
        .timeline-item.tm-teal { border-left-color: #14b8a6; background: #f0fdfa; }
        .timeline-item.tm-teal .tm-status { color: #0d9488; }
        .timeline-item.tm-indigo { border-left-color: #6366f1; background: #eef2ff; }
        .timeline-item.tm-indigo .tm-status { color: #4338ca; }

        .tm-comment {
            font-size: 13px;
            color: #64748b;
            font-style: italic;
            background: white;
            padding: 10px;
            border-radius: 8px;
            border-left: 3px solid #cbd5e1;
        }
        .timeline-item.tm-red .tm-comment { border-left-color: #f87171; }
        .timeline-item.tm-green .tm-comment { border-left-color: #4ade80; }

        /* Modal */
        #editModal .modal-content {
            margin: 2vh auto;
            max-height: 96vh;
            width: 90%;
            max-width: min(900px, 90vw);
        }
    </style>
</head>

<body>
    @php
        $user = Auth::user();
        $isHead = $user->isUnitPengelola();
        // Parallel Workflow Logic: Determine Context based on User Unit
        if ($user->id_unit == 55) { // Security
            $currentStatus = $document->status_security;
            $currentReviewerId = $document->security_reviewer_id;
            $currentApproverId = $document->security_verificator_id;
        } elseif ($user->id_unit == 56) { // SHE
            $currentStatus = $document->status_she;
            $currentReviewerId = $document->she_reviewer_id;
            $currentApproverId = $document->she_verificator_id;
        } else {
            // Fallback
            $currentStatus = $document->level2_status;
            $currentReviewerId = $document->level2_reviewer_id;
            $currentApproverId = $document->level2_approver_id;
        }

        // Global Status fallback if unit status is empty (e.g. before disposition)
        if (empty($currentStatus) && $document->current_level == 2) {
             // If Head, they need to see it as pending to dispose
             // If Staff, they might not see it yet unless in Pool
             $currentStatus = 'pending_head'; 
        }

        $status = $currentStatus;

        // Reviewer Logic
        $isReviewer = ($currentReviewerId == $user->id_user) || 
                      (empty($currentReviewerId) && in_array($user->role_jabatan, [5, 6]));

        // Approver Logic (Relaxed for Unit Pengelola)
        $isStaffApprover = ($user->role_jabatan == 4) && 
                           in_array($user->id_unit, [55, 56]);

        $isApprover = ($currentApproverId == $user->id_user) || 
                      ($isStaffApprover && $status == 'assigned_approval');

        $canEdit = ($isHead && $document->current_level == 2 && ($status == 'returned_to_head' || $status == 'staff_verified' || $status == 'pending_head')) ||
            ($isReviewer && $status == 'assigned_review') ||
            ($isApprover && $status == 'assigned_approval');
    @endphp

    <div class="container">
        <!-- Sidebar Inclusion -->
        @include('unit_pengelola.partials.sidebar')

        <main class="main-content">
            <div class="page-header">
                <div class="header-title">
                    <h1>Review Dokumen (Unit Pengelola)</h1>
                    <p>
                        @if($isHead) Mode Kepala Unit Pengelola
                        @elseif($isReviewer) Mode Staff Reviewer
                        @elseif($isApprover) Mode Staff Verifikator
                        @else Mode View Only
                        @endif
                    </p>
                </div>
                <!-- Logic for Back button differs slightly per role, defaulting to dashboard -->
                <div style="display:flex; gap:10px;">
                    <a href="{{ route('documents.export.detail.excel', $document->id) }}" class="btn" style="background-color:#107c41; color:white;">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                    <a href="{{ route('unit_pengelola.dashboard') }}" class="btn-back"><i class="fas fa-arrow-left"></i>
                        Kembali</a>
                </div>
            </div>

            <!-- Doc Card -->
            <div class="doc-card">
                <div class="doc-header" style="justify-content: flex-start; gap: 30px;">
                    <div>
                        <div class="doc-title-label">Judul Form</div>
                        <div class="doc-title-value">{{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</div>
                    </div>
                </div>
            </div>

            <!-- Wizard -->
            <div class="wizard-container">
                <div class="wizard-steps">
                    <div class="step-item completed">
                        <div class="step-circle"><i class="fas fa-file-signature"></i></div>
                        <div class="step-label">Draft</div>
                    </div>
                    <div class="step-item completed">
                        <div class="step-circle">1</div>
                        <div class="step-label">Kepala Unit</div>
                    </div>
                    <div class="step-item active">
                        <div class="step-circle">2</div>
                        <div class="step-label">Unit Pengelola</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">3</div>
                        <div class="step-label">Kepala Dept.</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle"><i class="fas fa-check"></i></div>
                        <div class="step-label">Selesai</div>
                    </div>
                </div>
            </div>

            <!-- TABLE (New Structure) -->
            <div class="hiradc-wrapper">
                <table class="excel-table">
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 40px;">No</th>
                            <th colspan="4" class="section-border-right">BAGIAN 1: Identifikasi Aktivitas</th>
                            <th colspan="6" class="section-border-right">BAGIAN 2: Identifikasi</th>
                            <th colspan="5" class="section-border-right">BAGIAN 3: Pengendalian & Penilaian Awal</th>
                            <th colspan="3" class="section-border-right">BAGIAN 4: Legalitas & Signifikansi</th>
                            <th colspan="8">BAGIAN 5: Mitigasi Lanjutan & Risiko Sisa</th>
                        </tr>
                        <tr>
                            <th style="width: 180px;">Proses/Kegiatan<br><small>(Kol 2)</small></th>
                            <th style="width: 120px;">Lokasi<br><small>(Kol 3)</small></th>
                            <th style="width: 80px;">Kategori<br><small>(Kol 4)</small></th>
                            <th style="width: 90px;" class="section-border-right">Kondisi<br><small>(Kol 5)</small></th>
                            <th style="width: 150px;">Potensi Bahaya<br><small>(Kol 6)</small></th>
                            <th style="width: 150px;">Aspek Lingkungan<br><small>(Kol 7)</small></th>
                            <th style="width: 150px;">Ancaman Keamanan<br><small>(Kol 8)</small></th>
                            <th style="width: 150px;">RISIKO (K3/KO)<br><small>(Kol 9)</small></th>
                            <th style="width: 150px;">DAMPAK (Lingk)<br><small>(Kol 9)</small></th>
                            <th style="width: 150px;" class="section-border-right">CELAH (Keamanan)<br><small>(Kol
                                    9)</small></th>
                            <th style="width: 250px;">Hirarki Pengendalian<br><small>(Kol 10)</small></th>
                            <th style="width: 250px;">Pengendalian Existing<br><small>(Kol 11)</small></th>
                            <th style="width: 50px;">L<br><small>(Kol 12)</small></th>
                            <th style="width: 50px;">S<br><small>(Kol 13)</small></th>
                            <th style="width: 80px;" class="section-border-right">Level<br><small>(Kol 14)</small></th>
                            <th style="width: 200px;">Regulasi<br><small>(Kol 15)</small></th>
                            <th style="width: 80px;">Aspek Penting<br><small>(Kol 16)</small></th>
                            <th style="width: 200px;" class="section-border-right">Peluang & Risiko<br><small>(Kol
                                    17)</small></th>
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
                        @forelse($filteredDetails ?? $document->details as $index => $item)
                            <tr>
                                <td style="text-align:center; padding-top:20px; font-size:14px; color:#1e293b;">
                                    {{ $index + 1 }}
                                    @if($canEdit)
                                        <div style="margin-top:5px;">
                                            <button type="button" class="btn-sm"
                                                style="background:none; border:none; color:#f59e0b; cursor:pointer;"
                                                onclick="openEditModal({{ json_encode($item) }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    @endif
                                </td>
                                <!-- Kolom 2-5 -->
                                <td>
                                    <div class="cell-text">{{ $item->kolom2_kegiatan }}</div>
                                </td>
                                <td>
                                    <div class="cell-text">{{ $item->kolom3_lokasi }}</div>
                                </td>
                                <td>
                                    <div class="cell-text">{{ $item->kategori }}</div>
                                </td>
                                <td class="section-border-right">
                                    <div class="cell-text">{{ $item->kolom5_kondisi }}</div>
                                </td>

                                <!-- Kolom 6 (Bahaya - K3/KO) -->
                                <td>
                                    @if(in_array($item->kategori, ['K3', 'KO']))
                                        @php $bahaya = $item->kolom6_bahaya['details'] ?? [];
                                        $manualB = $item->kolom6_bahaya['manual'] ?? ''; @endphp
                                        <div class="cell-checkbox-group">
                                            @foreach($bahaya as $b) <div class="cell-checkbox-item"><i
                                            class="fas fa-exclamation-triangle"></i> {{ $b }}</div> @endforeach
                                            @if($manualB)
                                            <div style="font-size:12px; color:#991b1b;">Lainnya: {{ $manualB }}</div> @endif
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>

                                <!-- Kolom 7 (Aspek - Lingkungan) -->
                                <td>
                                    @if($item->kategori == 'Lingkungan')
                                        @php $aspek = $item->kolom7_aspek_lingkungan['details'] ?? [];
                                        $manualA = $item->kolom7_aspek_lingkungan['manual'] ?? ''; @endphp
                                        <div class="cell-checkbox-group">
                                            @foreach($aspek as $a) <div class="cell-checkbox-item"><i class="fas fa-leaf"></i>
                                            {{ $a }}</div> @endforeach
                                            @if($manualA)
                                            <div style="font-size:12px; color:#166534;">Lainnya: {{ $manualA }}</div> @endif
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>

                                <!-- Kolom 8 (Ancaman - Keamanan) -->
                                <td>
                                    @if($item->kategori == 'Keamanan')
                                        @php $ancaman = $item->kolom8_ancaman['details'] ?? [];
                                        $manualAn = $item->kolom8_ancaman['manual'] ?? ''; @endphp
                                        <div class="cell-checkbox-group">
                                            @foreach($ancaman as $an) <div class="cell-checkbox-item"><i
                                            class="fas fa-shield-alt"></i> {{ $an }}</div> @endforeach
                                            @if($manualAn)
                                            <div style="font-size:12px; color:#991b1b;">Lainnya: {{ $manualAn }}</div> @endif
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>

                                <!-- Kolom 9 (Risiko - K3/KO) -->
                                <td>
                                    @if(in_array($item->kategori, ['K3', 'KO']))
                                        {{ $item->kolom9_risiko }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <!-- Kolom 9 (Dampak - Lingkungan) -->
                                <td>
                                    @if($item->kategori == 'Lingkungan')
                                        {{ $item->kolom9_dampak_lingkungan ?? '-' }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <!-- Kolom 9 (Celah - Keamanan) -->
                                <td class="section-border-right">
                                    @if($item->kategori == 'Keamanan')
                                        {{ $item->kolom9_celah_keamanan ?? '-' }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <!-- Kolom 10-14 -->
                                <td>
                                    @php $hierarchy = $item->kolom10_pengendalian['hierarchy'] ?? []; @endphp
                                    <div class="cell-checkbox-group">
                                        @foreach($hierarchy as $h) <div>- {{ $h }}</div> @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="cell-text">{{ $item->kolom11_existing }}</div>
                                </td>
                                <td class="risk-col">
                                    <div style="font-weight:800;">{{ $item->kolom12_kemungkinan }}</div>
                                </td>
                                <td class="risk-col">
                                    <div style="font-weight:800;">{{ $item->kolom13_konsekuensi }}</div>
                                </td>
                                <td class="risk-col section-border-right">
                                    <span
                                        class="risk-badge {{ $item->kolom14_score >= 15 ? 'bg-high' : ($item->kolom14_score >= 8 ? 'bg-med' : 'bg-low') }}">
                                        {{ $item->kolom14_score }}
                                    </span>
                                </td>

                                <!-- Kolom 15-17 -->
                                <td>
                                    <div class="cell-text">{{ $item->kolom15_regulasi }}</div>
                                </td>
                                <td style="text-align:center;">{{ $item->kolom16_aspek ?? '-' }}</td>
                                <td class="section-border-right">
                                    @if($item->kolom17_risiko)
                                    <div>(-) {{ $item->kolom17_risiko }}</div> @endif
                                    @if($item->kolom17_peluang)
                                    <div>(+) {{ $item->kolom17_peluang }}</div> @endif
                                </td>

                                <!-- Kolom 18-22 -->
                                <td style="text-align:center;">
                                    <span class="doc-meta-badge"
                                        style="{{ $item->kolom18_toleransi == 'Ya' ? 'background:#dcfce7;color:#166534;' : 'background:#fee2e2;color:#991b1b;' }}">
                                        {{ $item->kolom18_toleransi }}
                                    </span>
                                </td>
                                <td>{{ $item->kolom19_pengendalian_lanjut }}</td>
                                <td class="risk-col">{{ $item->kolom20_kemungkinan_lanjut }}</td>
                                <td class="risk-col">{{ $item->kolom21_konsekuensi_lanjut }}</td>
                                <td class="risk-col">
                                    <span
                                        class="risk-badge {{ $item->kolom22_tingkat_risiko_lanjut >= 15 ? 'bg-high' : ($item->kolom22_tingkat_risiko_lanjut >= 8 ? 'bg-med' : 'bg-low') }}">
                                        {{ $item->kolom22_tingkat_risiko_lanjut ?? '-' }}
                                    </span>
                                </td>
                                <td class="risk-col">{{ $item->residual_kemungkinan }}</td>
                                <td class="risk-col">{{ $item->residual_konsekuensi }}</td>
                                <td class="risk-col">
                                    <span
                                        class="risk-badge {{ $item->residual_score >= 15 ? 'bg-high' : ($item->residual_score >= 8 ? 'bg-med' : 'bg-low') }}">
                                        {{ $item->residual_score ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="26" style="text-align:center; padding:20px;">Tidak ada data detail.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- COMPLIANCE CHECKLIST -->
            <!-- Logic: Show if Head (Level 2) OR Reviewer/Approver active -->
            @php
                $showChecklist = ($isHead && $document->current_level == 2) ||
                                 ($isReviewer && $status == 'assigned_review') || 
                                 ($isApprover && $status == 'assigned_approval');
            @endphp

            @if($showChecklist)
                <div class="doc-card" style="margin-top: 30px;">
                    <div class="card-header-slim" style="display:flex; justify-content:space-between; align-items:center;">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <i class="fas fa-clipboard-check"></i>
                            <h2>Tabel Kesesuaian (Compliance Checklist)</h2>
                        </div>
                        @if(!$isHead)
                        <button type="button" onclick="toggleComplianceEdit()" class="btn-sm" style="background:none; border:none; cursor:pointer; color:#f59e0b; font-size:16px;" title="Edit Checklist">
                            <i class="fas fa-edit"></i>
                        </button>
                        @endif
                    </div>
                    <div class="doc-body">
                        <div style="overflow-x: auto;">
                            <!-- Simple Table Structure, Logic Handled by JS below -->
                            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                                <thead style="background: #1e293b; color: white;">
                                    <tr>
                                        <th style="padding:12px;">No</th>
                                        <th style="padding:12px;">Kriteria</th>
                                        <th style="padding:12px;">Kesesuaian</th>
                                        <th style="padding:12px;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $criteriaList = [
                                            ['key' => 'format', 'label' => 'Standar Format'],
                                            ['key' => 'numbering', 'label' => 'Penomoran Dokumen'],
                                            ['key' => 'revision', 'label' => 'Kemutakhiran Nomor Revisi'],
                                            ['key' => 'approval', 'label' => 'Approval Dokumen'],
                                            ['key' => 'identification_coverage', 'label' => 'Ident. mencakup semua proses'],
                                            ['key' => 'condition_coverage', 'label' => 'Ident. mencakup semua kondisi (R/NR/E)'],
                                            ['key' => 'mitigation', 'label' => 'Kesesuaian Program Mitigasi']
                                        ];
                                        $existing = $document->compliance_checklist ? json_decode($document->compliance_checklist, true) : [];
                                    @endphp
                                    @foreach($criteriaList as $idx => $c)
                                        @php
                                            $s = $existing[$c['key']]['status'] ?? '';
                                            $n = $existing[$c['key']]['note'] ?? '';
                                            $disabled = 'disabled'; 
                                            // Initially disabled (Global Edit Off)
                                            $noteDisabled = 'disabled';
                                            $noteStyle = 'background:#f1f5f9;cursor:not-allowed;'; 
                                            
                                            // Enable for Head of Unit Pengelola (Always Editable) OR Staff Verifikator
                                            // Staff Verifikator (isApprover) can edit when they toggle the button
                                            
                                            // LOGIC FIX: Explicitly allow Head to edit if status is suitable
                                            $headCanEdit = ($isHead && $document->current_level == 2 && ($status == 'staff_verified' || $status == 'returned_to_head'));
                                            $staffCanEdit = ($isApprover && $status == 'assigned_approval');

                                            if ($headCanEdit || $staffCanEdit) {
                                                if ($headCanEdit) {
                                                    // Head: Enabled by default
                                                    $disabled = '';
                                                    if ($s == 'NOK' || $s == 'Tdk Penting') {
                                                        $noteDisabled = '';
                                                        $noteStyle = 'background:white;cursor:text;';
                                                    }
                                                } 
                                                // Staff: Still relies on JS toggle, but we set base condition here if needed
                                                // (The JS toggleComplianceEdit simply removes 'disabled' attribute, so start disabled is fine for staff)
                                            }
                                        @endphp
                                        <tr style="border-bottom:1px solid #e2e8f0;">
                                            <td style="padding:12px; text-align:center;">{{ $idx + 1 }}</td>
                                            <td style="padding:12px;">{{ $c['label'] }}</td>
                                            <td style="padding:12px;">
                                                <select name="compliance_checklist[{{ $c['key'] }}][status]"
                                                    id="status_{{ $c['key'] }}" class="compliance-status form-control" {{ $disabled }}
                                                    onchange="toggleNoteField('{{ $c['key'] }}')">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="OK" {{ $s == 'OK' ? 'selected' : '' }}>OK</option>
                                                    <option value="NOK" {{ $s == 'NOK' ? 'selected' : '' }}>NOK</option>
                                                    <option value="Tdk Penting" {{ $s == 'Tdk Penting' ? 'selected' : '' }}>Tdk
                                                        Penting</option>
                                                </select>
                                            </td>
                                            <td style="padding:12px;">
                                                <input type="text" name="compliance_checklist[{{ $c['key'] }}][note]"
                                                    id="note_{{ $c['key'] }}" value="{{ $n }}"
                                                    class="compliance-note form-control" {{ $noteDisabled }} style="{{ $noteStyle }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <!-- TIMELINE -->
            <div class="timeline-card">
                <div class="timeline-header">
                    <i class="fas fa-history" style="color:var(--primary);"></i> 
                    <span>Riwayat Proses</span>
                </div>
                
                <div class="timeline-container">
                @php
                    // Filter Duplicates based on action and created_at (minute precision)
                    $uniqueHistory = $document->approvals->unique(function ($item) {
                        return $item->action . $item->created_at->format('YmdHi');
                    });
                @endphp
                @foreach($uniqueHistory as $hist)
                    @php
                        $action = strtolower($hist->action);
                        $colorClass = 'tm-blue';
                        $icon = 'fa-info-circle';
                        $label = ucfirst($hist->action);

                        if ($action == 'published') {
                            $colorClass = 'tm-green';
                            $icon = 'fa-globe';
                        } elseif ($action == 'approved') {
                            $colorClass = 'tm-green';
                            $icon = 'fa-check-circle';
                        } elseif ($action == 'verified') {
                            $colorClass = 'tm-teal'; // Distinct color
                            $icon = 'fa-check-double';
                        } elseif ($action == 'reviewed') {
                            $colorClass = 'tm-indigo'; // Distinct color
                            $icon = 'fa-glasses';
                        } elseif (in_array($action, ['revision', 'revise', 'returned'])) {
                            $colorClass = 'tm-red';
                            $icon = 'fa-undo';
                        } elseif ($action == 'disposition') {
                            $colorClass = 'tm-purple';
                            $icon = 'fa-share';
                        }
                    @endphp
                    <div class="timeline-item {{ $colorClass }}">
                        <div class="tm-icon">
                            <i class="fas {{ $icon }}"></i>
                        </div>
                        <div class="tm-content">
                            <div class="tm-header">
                                <span class="tm-user">{{ $hist->approver->nama_user ?? 'System' }}</span>
                                <span class="tm-badge">{{ $hist->level }}</span>
                                <span class="tm-date">{{ $hist->created_at->format('d M Y, H:i') }} WIB</span>
                            </div>
                            <div class="tm-status">{{ $label }}</div>
                            @if($hist->catatan)
                                <div class="tm-comment">
                                    <i class="fas fa-quote-left"></i> {{ $hist->catatan }}
                                </div> 
                            @endif
                        </div>
                    </div>
                @endforeach
                </div>
            </div>

            <!-- Global Toast/Alert Helper -->
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: "{{ session('success') }}",
                            timer: 3000,
                            showConfirmButton: false
                        });
                    });
                </script>
            @endif
            @if(session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: "{{ session('error') }}",
                        });
                    });
                </script>
            @endif




        </main>

        <!-- FOOTER ACTIONS -->
        <div class="review-footer">
            {{-- DEBUG --}}
            {{-- @php dd('Status:', $status, 'Unit:', $user->id_unit, 'SHE Status:', $document->status_she, 'Sec Status:', $document->status_security); @endphp --}}
            
            {{-- 1. KEPALA UNIT PENGELOLA --}}
            @if($isHead && $document->current_level == 2)
                @if($status == 'returned_to_head' || $status == 'staff_verified')
                    <!-- Final Approval by Head -->
                    <form id="headApproveForm" method="POST" action="{{ route('unit_pengelola.approve', $document->id) }}"
                        style="width:100%; display:flex; justify-content: flex-end; gap:15px;">
                        @csrf
                        <!-- Input catatan removed from UI, handled by JS Prompt for Revision -->
                        <div class="action-btns">
                            <button type="button" class="btn btn-revise" onclick="submitHeadAction('revise')">Revisi</button>
                            <button type="button" class="btn btn-approve" onclick="submitHeadAction('approve')">Approve</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-info" style="width:100%; margin:0; text-align:center;">
                        <i class="fas fa-clock"></i> Menunggu pemeriksaan oleh Reviewer/Verifikator Staff.
                    </div>
                @endif

                {{-- 2. STAFF REVIEWER --}}
            @elseif($isReviewer && $status == 'assigned_review')
                <form id="staffActionForm" method="POST" action="{{ route('unit_pengelola.submit_review', $document->id) }}"
                    style="width:100%; display:flex; gap:15px;">
                    @csrf
                    <!-- Compliance Data Injected via JS -->
                    <input type="hidden" name="compliance_checklist" id="compliance_checklist_input">
                    <div class="notes-area">
                        <textarea name="catatan" class="notes-input" placeholder="Catatan Review..."></textarea>
                    </div>
                    <div class="action-btns">
                        <button type="button" class="btn btn-approve" onclick="submitStaffAction()">Selesai Review</button>
                    </div>
                </form>

                {{-- 3. STAFF VERIFIKATOR --}}
            @elseif($isApprover && $status == 'assigned_approval')
                <form id="staffActionForm" method="POST" action="{{ route('unit_pengelola.verify', $document->id) }}"
                    style="width:100%; display:flex; gap:15px;">
                    @csrf
                    <!-- Inject Compliance Data (Required for submitStaffAction) -->
                    <input type="hidden" name="compliance_checklist" id="compliance_checklist_input">
                    <div class="notes-area">
                        <textarea name="catatan" class="notes-input" placeholder="Catatan Verifikasi..."></textarea>
                    </div>
                    <div class="action-btns">
                        <button type="button" class="btn btn-approve" onclick="submitStaffAction()">Verifikasi</button>
                    </div>
                </form>
            @else
                <div style="width:100%; text-align:center; color:#94a3b8;">Mode View Only</div>
            @endif
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

    <!-- SCRIPTS -->
    <script>
        // --- 1. Edit Modal Logic ---
        function openEditModal(item) {
            const id = item.id;
            document.getElementById('edit_id').value = id;
            document.getElementById('editModal').style.display = 'flex';

            // Fetch Form
            fetch(`/approver/documents/get-item-html/${id}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('modal-form-body').innerHTML = data.html;
                        // Re-initialize any listeners if needed
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
            const formData = new FormData(form);
            const payload = {};

            // Parse edit_item[ID][field] -> field
            for (let [key, value] of formData.entries()) {
                if (key.includes('[') && key.includes(']')) {
                    const parts = key.split('][');
                    if (parts.length > 1) {
                        let fieldName = parts[1].replace(']', '');
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
            payload['_token'] = "{{ csrf_token() }}";

            fetch(`/approver/documents/update-detail/${id}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                body: JSON.stringify(payload)
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Sukses', 'Data berhasil diupdate', 'success').then(() => location.reload());
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(err => Swal.fire('Error', err.message, 'error'));
        }

        // --- 2. Unit Pengelola Actions ---
        function submitHeadAction(type) {
            // Inject Compliance Data
            const checklistJson = collectComplianceData();
            
            // Create Hidden Input if it doesn't exist
            const form = document.getElementById('headApproveForm');
            let input = form.querySelector('input[name="compliance_checklist"]');
            if (!input) {
                input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'compliance_checklist';
                form.appendChild(input);
            }
            input.value = checklistJson;

            if (type === 'revise') {
                form.action = "{{ route('unit_pengelola.revise', $document->id) }}";
                
                Swal.fire({
                    title: 'Catatan Revisi',
                    input: 'textarea',
                    inputLabel: 'Masukkan alasan revisi:',
                    inputPlaceholder: 'Tulis catatan disini...',
                    inputAttributes: {
                        'aria-label': 'Tulis catatan disini'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Kirim Revisi',
                    cancelButtonText: 'Batal',
                    inputValidator: (value) => {
                        if (!value || value.length < 5) {
                            return 'Catatan wajib diisi minimal 5 karakter!'
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create/Update hidden input for catatan
                        let input = form.querySelector('input[name="catatan"]');
                        if (!input) {
                            input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'catatan';
                            form.appendChild(input);
                        }
                        input.value = result.value;
                        form.submit();
                    }
                });
            } else {
                // Approve
                Swal.fire({
                    title: 'Approve Dokumen?',
                    text: "Dokumen akan dipublikasikan/diteruskan.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Approve',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                         // Optional: Add empty note if needed, or backend handles null
                        form.submit();
                    }
                });
            }
        }

        function collectComplianceData() {
            const checklist = {};
            document.querySelectorAll('select[name^="compliance_checklist"]').forEach(select => {
                const name = select.getAttribute('name');
                const match = name.match(/\[(.*?)\]\[status\]/);
                if (match) {
                    const key = match[1];
                    if (!checklist[key]) checklist[key] = {};
                    checklist[key]['status'] = select.value;
                }
            });
            document.querySelectorAll('input[name^="compliance_checklist"]').forEach(input => {
                const name = input.getAttribute('name');
                const match = name.match(/\[(.*?)\]\[note\]/);
                if (match) {
                    const key = match[1];
                    if (!checklist[key]) checklist[key] = {};
                    checklist[key]['note'] = input.value;
                }
            });
            return JSON.stringify(checklist);
        }

        function submitStaffAction() {
            // Inject Compliance Data
            const checklistJson = collectComplianceData();
            document.getElementById('compliance_checklist_input').value = checklistJson;

            const form = document.getElementById('staffActionForm');
            Swal.fire({
                title: 'Submit?',
                text: 'Pastikan data sudah benar.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Submit'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        // --- Helper JS for Injected Form (adapted for Modal) ---
        const categories = {
            'K3': { label: 'K3', conditions: ['Rutin', 'Non-Rutin', 'Emergency'] },
            'KO': { label: 'KO', conditions: ['Rutin', 'Non-Rutin', 'Emergency'] },
            'Lingkungan': { label: 'Lingkungan', conditions: ['Normal', 'Abnormal', 'Emergency'] },
            'Keamanan': { label: 'Keamanan', conditions: ['Emergency'] }
        };

        function updateConditions(select) {
            const form = select.closest('form');
            const condSelect = form.querySelector('.condition-select');
            const cat = select.value;

            // Get all conditional field sections
            const k3KoField = form.querySelector('.k3-ko-field');
            const lingkunganField = form.querySelector('.lingkungan-field');
            const keamananField = form.querySelector('.keamanan-field');
            const lingkunganOnlyField = form.querySelector('.lingkungan-only-field');

            // Columns 9 variants
            const kolom9K3KO = form.querySelector('.kolom9-k3ko-field');
            const kolom9Lingkungan = form.querySelector('.kolom9-lingkungan-field');
            const kolom9Keamanan = form.querySelector('.kolom9-keamanan-field');

            // 1. Reset Conditions Options
            condSelect.innerHTML = '<option value="">-- Pilih --</option>';
            if (categories[cat]) {
                categories[cat].conditions.forEach(c => {
                    const opt = document.createElement('option');
                    opt.value = c;
                    opt.textContent = c;
                    condSelect.appendChild(opt);
                });
            }

            // 2. Hide All
            if (k3KoField) k3KoField.style.display = 'none';
            if (lingkunganField) lingkunganField.style.display = 'none';
            if (keamananField) keamananField.style.display = 'none';
            if (lingkunganOnlyField) lingkunganOnlyField.style.display = 'none';

            if (kolom9K3KO) kolom9K3KO.style.display = 'none';
            if (kolom9Lingkungan) kolom9Lingkungan.style.display = 'none';
            if (kolom9Keamanan) kolom9Keamanan.style.display = 'none';

            // 3. Show Specific
            if (cat === 'K3' || cat === 'KO') {
                if (k3KoField) k3KoField.style.display = 'block';
                if (kolom9K3KO) kolom9K3KO.style.display = 'block';
            } else if (cat === 'Lingkungan') {
                if (lingkunganField) lingkunganField.style.display = 'block';
                if (lingkunganOnlyField) lingkunganOnlyField.style.display = 'block';
                if (kolom9Lingkungan) kolom9Lingkungan.style.display = 'block';
            } else if (cat === 'Keamanan') {
                if (keamananField) keamananField.style.display = 'block';
                if (kolom9Keamanan) kolom9Keamanan.style.display = 'block';
            }
        }

        function calculateSimpleRisk(select, isResidual = false) {
            const container = select.closest('.risk-container'); // Need to add this class to container
            if (!container) return;

            const likelihood = parseInt(container.querySelector(isResidual ? '.res-likelihood' : '.likelihood').value) || 0;
            const severity = parseInt(container.querySelector(isResidual ? '.res-severity' : '.severity').value) || 0;

            const score = likelihood * severity;

            const scoreEl = container.querySelector('.display-score');
            const inputScore = container.querySelector(isResidual ? '.input-res-score' : '.input-score');

            if (scoreEl) scoreEl.textContent = score || '-';
            if (inputScore) inputScore.value = score;

            // Level Logic
            let level = 'LOW';
            let bg = '#10b981';
            if (score >= 15) { level = 'HIGH'; bg = '#dc2626'; }
            else if (score >= 8) { level = 'MED'; bg = '#f59e0b'; }

            // Update Badge background
            const badge = container.querySelector('.risk-badge-box');
            if (badge) {
                badge.style.background = bg;
                badge.textContent = level;
            }
        }

        let isComplianceEditing = false;

        function toggleComplianceEdit() {
            isComplianceEditing = !isComplianceEditing;
            
            const dropDowns = document.querySelectorAll('.compliance-status');
            dropDowns.forEach(el => {
                // Toggle Dropdown
                if (isComplianceEditing) el.removeAttribute('disabled');
                else el.setAttribute('disabled', 'disabled');

                // Trigger Note Field Update based on current value
                const id = el.id;
                if(id && id.startsWith('status_')) {
                    const key = id.replace('status_', '');
                    toggleNoteField(key);
                }
            });

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: isComplianceEditing ? 'info' : 'warning',
                title: isComplianceEditing ? 'Mode Edit Aktif' : 'Mode Edit Non-Aktif',
                showConfirmButton: false,
                timer: 1500
            });
        }

        function toggleNoteField(key) {
            const statusSelect = document.getElementById('status_' + key);
            const noteInput = document.getElementById('note_' + key);
            
            if (!statusSelect || !noteInput) return;

            // 1. If Global Edit Mode is OFF -> ALWAYS DISABLE
            if (!isComplianceEditing) {
                noteInput.setAttribute('disabled', 'disabled');
                noteInput.style.background = '#f1f5f9';
                noteInput.style.cursor = 'not-allowed';
                return;
            }

            // 2. If Global Edit Mode is ON -> Check Dropdown Value
            const val = statusSelect.value;
            if (val === 'NOK' || val === 'Tdk Penting') {
                noteInput.removeAttribute('disabled');
                noteInput.style.background = 'white';
                noteInput.style.cursor = 'text';
            } else {
                noteInput.setAttribute('disabled', 'disabled');
                noteInput.style.background = '#f1f5f9';
                noteInput.style.cursor = 'not-allowed';
                noteInput.value = ''; // Auto clear when OK/Empty
            }
        }
    </script>
</body>

</html>