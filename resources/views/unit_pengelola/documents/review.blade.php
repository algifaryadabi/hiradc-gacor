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
            width: 260px;
            background: var(--surface);
            border-right: 1px solid var(--border);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 50;
        }

        .logo-section {
            padding: 24px;
            border-bottom: 1px solid var(--border);
            text-align: center;
        }

        .logo-circle {
            width: 64px;
            height: 64px;
            background: white;
            border-radius: 50%;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
        }

        .logo-circle img {
            max-width: 65%;
        }

        .nav-menu {
            flex: 1;
            padding: 24px 16px;
            overflow-y: auto;
        }

        .nav-item {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--text-sub);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 4px;
        }

        .nav-item:hover,
        .nav-item.active {
            background: var(--primary-light);
            color: var(--primary);
        }

        .nav-item.active {
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
            margin-left: 260px;
            padding: 32px 48px;
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
            left: 260px;
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
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
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
            <!-- Doc Header Banner -->
            <div class="doc-banner" style="background: white; border-radius: 12px; padding: 24px 30px; border: 1px solid var(--border); box-shadow: var(--shadow-sm); margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
                <div class="doc-banner-left">
                    <h1 style="font-size: 24px; font-weight: 800; color: var(--text-main); margin-bottom: 4px;">{{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</h1>
                    <p style="font-size: 14px; color: var(--text-sub); display: flex; align-items: center; gap: 10px;">
                        <span class="doc-meta-badge" style="background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;"><i class="fas fa-building"></i> {{ $document->unit->nama_unit ?? '-' }}</span>

                        <span class="doc-meta-badge" style="background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;"><i class="far fa-clock"></i> {{ $document->created_at->format('d M Y') }}</span>
                    </p>
                </div>
                <a href="{{ route('unit_pengelola.check_documents') }}" class="btn-back" style="display:flex; align-items:center; gap:8px; text-decoration:none; color:var(--text-sub); font-weight:600;"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>

            <!-- Table Layout Implementation -->
            <!-- Table Layout Implementation -->
            <!-- Form for Approval -->
            <form id="approveForm" method="POST" action="{{ route('unit_pengelola.approve', ['document' => $document->id]) }}">
                @csrf
                <input type="hidden" name="catatan" id="catatan_input_approve">
            </form>

            <!-- Form for Revision -->
            <form id="reviseForm" method="POST" action="{{ route('unit_pengelola.revise', ['document' => $document->id]) }}">
                @csrf
                <input type="hidden" name="catatan" id="catatan_input_revise">
            </form>
            
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
                                <tr>
                                    <td style="text-align:center; padding-top:20px; font-size:14px; color:#1e293b;">
                                        {{ $index + 1 }}
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


    <!-- Compliance Checklist Moved Here -->

                <!-- Card: KESESUAIAN (Compliance Checklist) -->


                <input type="hidden" name="compliance_checklist" id="compliance_checklist_input">

                <!-- Footer Action -->
                <!-- Footer Action for Unit Pengelola Workflow -->
                <div class="review-footer" style="flex-direction:column; gap:10px;">
                    
                    @php
                        $user = Auth::user();
                        $isHead = $user->isUnitPengelola();
                        $isReviewer = ($document->level2_reviewer_id == $user->id_user);
                        $isApprover = ($document->level2_approver_id == $user->id_user);
                        $status = $document->level2_status;
                    @endphp

                    {{-- 1. KEPALA UNIT PENGELOLA --}}
                    @if($isHead && $document->current_level == 2)

                            @if(!$status) <!-- Pending Disposition -->
                                   <div style="background:#f1f5f9; padding:15px; border-radius:8px; width:100%;">
                                        <h4 style="margin-top:0; font-size:14px; font-weight:700; color:#1e293b;">DISPOSISI DOKUMEN</h4>
                                        <div style="display:flex; gap:15px; margin-bottom:15px;">
                                            <div style="flex:1;">
                                                <label style="font-size:12px; font-weight:600;">Pilih Staff Reviewer (Band IV/V)</label>
                                                <select name="reviewer_id" class="form-control" required style="width:100%;">
                                                    <option value="">-- Pilih Reviewer --</option>
                                                    @foreach($staffReviewers ?? [] as $s)
                                                        <option value="{{ $s->id_user }}">{{ $s->nama_user }} - {{ $s->role_jabatan_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div style="flex:1;">
                                                <label style="font-size:12px; font-weight:600;">Pilih Staff Verifikator (Band III)</label>
                                                <select name="approver_id" class="form-control" required style="width:100%;">
                                                    <option value="">-- Pilih Approver --</option>
                                                    @foreach($staffApprovers ?? [] as $s)
                                                        <option value="{{ $s->id_user }}">{{ $s->nama_user }} - {{ $s->role_jabatan_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div style="display:flex; justify-content:flex-end;">
                                            <button type="button" class="btn btn-approve" onclick="submitDisposition()" style="background:#3b82f6;">
                                                <i class="fas fa-paper-plane"></i> Disposisikan
                                            </button>
                                        </div>
                                   </div>

                            @elseif($status == 'returned_to_head') <!-- Final Approval -->
                                 <div style="width:100%; margin-bottom:10px;">
                                    <div class="alert alert-success">Dokumen telah diverifikasi oleh Staff. Silakan review final.</div>
                                 </div>
                                 <div class="notes-area" style="width:100%;">
                                    <label><i class="fas fa-comment-alt"></i> Catatan</label>
                                    <input type="text" id="catatan_input_ui" class="notes-input" placeholder="Tuliskan catatan...">
                                </div>
                                <div class="action-btns" style="justify-content:flex-end; width:100%;">
                                    <button type="button" class="btn btn-revise" onclick="confirmAction('revise')"><i class="fas fa-undo"></i> Revisi</button>
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
                                 <div class="alert alert-warning">Anda ditugaskan me-review dokumen ini. Silakan edit jika perlu.</div>
                                 
                                 <div style="margin:10px 0;">
                                    <label style="font-size:12px; font-weight:600; color:#475569; margin-bottom:5px; display:block;">Catatan Review (Opsional)</label>
                                    <textarea name="catatan" class="form-control" rows="2" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px;" placeholder="Tuliskan catatan review..."></textarea>
                                 </div>
                                 <div class="action-btns" style="justify-content:flex-end;">
                                     <button type="button" class="btn btn-approve" onclick="submitStaffAction('submit-review')" style="background:#f59e0b;">
                                         <i class="fas fa-check"></i> Selesai Review & Teruskan
                                     </button>
                                 </div>
                             </div>

                        {{-- 3. STAFF APPROVER --}}
                    @elseif($isApprover && $status == 'assigned_approval')
                            <div style="width:100%;">
                                 <div class="alert alert-warning">Anda ditugaskan memverifikasi dokumen ini.</div>

                                 <div style="margin:10px 0;">
                                    <label style="font-size:12px; font-weight:600; color:#475569; margin-bottom:5px; display:block;">Catatan Verifikasi (Opsional)</label>
                                    <textarea name="catatan" class="form-control" rows="2" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px;" placeholder="Tuliskan catatan verifikasi..."></textarea>
                                 </div>
                                 <div class="action-btns" style="justify-content:flex-end;">
                                     <button type="button" class="btn btn-approve" onclick="submitStaffAction('verify')" style="background:#166534;">
                                         <i class="fas fa-check-double"></i> Verifikasi & Kembalikan
                                     </button>
                                 </div>
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
            <!-- End Wrapper Div -->

            <!-- HISTORY LOG SECTION -->
            @if($document->approvals->where('level', 2)->count() > 0)
            <div class="history-section" style="margin-top:40px; border-top:1px solid #e2e8f0; padding-top:20px;">
                <h3 style="font-size:16px; font-weight:700; color:#1e293b; margin-bottom:15px;">Riwayat Aktivitas Staff</h3>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama User</th>
                            <th>Aksi</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($document->approvals->where('level', 2) as $log)
                            <tr>
                                <td style="padding:12px;">{{ $log->created_at->format('d M Y H:i') }}</td>
                                <td style="padding:12px;">{{ $log->approver->nama_user ?? '-' }}</td>
                                <td style="padding:12px;">
                                    <span class="status-pill" style="
                                        background: {{ $log->action == 'reviewed' ? '#fff7ed' : ($log->action == 'verified' ? '#f0fdf4' : '#f1f5f9') }};
                                        color: {{ $log->action == 'reviewed' ? '#c2410c' : ($log->action == 'verified' ? '#15803d' : '#475569') }};
                                    ">
                                        {{ ucfirst($log->action) }}
                                    </span>
                                </td>
                                <td style="padding:12px;">{{ $log->catatan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </main>
    </div>

    <script>
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
                            if(!form) throw new Error('Approve Form Not Found');
                            document.getElementById('catatan_input_approve').value = notes;
                            console.log('Submitting Approve Form to: ' + form.action);
                            form.submit();
                        } else {
                            const form = document.getElementById('reviseForm');
                            if(!form) throw new Error('Revise Form Not Found');
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
            const form = document.getElementById('reviewForm');
            // Basic validation for selects
            const reviewer = form.querySelector('select[name="reviewer_id"]').value;
            const approver = form.querySelector('select[name="approver_id"]').value;
            
            if(!reviewer || !approver) {
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

        function submitStaffAction(type) {
             const form = document.getElementById('reviewForm');
             let title = 'Submit Review?';
             let route = '';

             if(type == 'submit-review') {
                 title = 'Selesai Review & Teruskan?';
                 route = "{{ route('unit_pengelola.submit_review', $document->id) }}";
             } else if(type == 'verify') {
                 title = 'Verifikasi & Kembalikan ke Kepala?';
                 route = "{{ route('unit_pengelola.verify', $document->id) }}";
             }

             Swal.fire({
                title: title,
                text: 'Pastikan penilaian risiko sudah sesuai.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Submit'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.action = route;
                    form.submit();
                }
            });
        }


    </script>
</body>
</html>