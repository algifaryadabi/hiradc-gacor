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

        .logo-text {
            font-size: 16px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -0.02em;
        }

        .logo-subtext {
            font-size: 11px;
            color: var(--text-sub);
            font-weight: 500;
            margin-top: 2px;
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
            overflow: auto;
            max-height: 85vh;
            background: white;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 60px;
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
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            max-width: 900px;
            background: #1e293b;
            /* Dark Footer */
            color: white;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

            </form>
        </main>

        <!-- Footer -->
        <div class="review-footer">
            <div style="flex:1; margin-right:20px;">
                <input type="text" class="notes-input" id="notes" placeholder="Catatan Review (Wajib jika Revisi)...">
            </div>
            <div class="action-btns">
                @if($document->canBeApprovedBy(Auth::user()))
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