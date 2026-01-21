<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $document->kolom2_kegiatan }} - Detail HIRADC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --header-bg: #1e293b;
            --header-text: #ffffff;
            --border-color: #cbd5e1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            padding-bottom: 60px;
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
            z-index: 50;
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
            font-weight: 500;
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
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-weight: 700;
            font-size: 16px;
            flex-shrink: 0;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 2px;
        }

        .logout-btn {
            width: 100%;
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 32px 48px;
            max-width: 1600px;
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
        }

        .btn-back:hover {
            color: var(--primary);
        }

        /* Header Banner */
        .doc-banner {
            background: white;
            border-radius: 12px;
            padding: 24px 30px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .doc-banner-left h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .doc-banner-left p {
            font-size: 14px;
            color: var(--text-sub);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .doc-meta-badge {
            background: #e2e8f0;
            color: #475569;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-print {
            background: white;
            border: 1px solid #cbd5e1;
            color: #334155;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-print:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
        }

        /* Wizard */
        .wizard-container {
            background: white;
            border-radius: 12px;
            padding: 30px;
            border: 1px solid var(--border);
            margin-bottom: 30px;
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
            border-color: var(--primary);
            background: var(--primary-light);
            color: var(--primary);
            box-shadow: 0 0 0 4px rgba(196, 30, 58, 0.1);
        }

        .step-item.active .step-label {
            color: var(--primary);
            font-weight: 700;
        }

        /* Completed State */
        .step-item.completed .step-circle {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .step-item.completed .step-label {
            color: var(--primary);
        }

        /* TABLE STYLES (Read Only) */
        .hiradc-wrapper {
            overflow-x: auto;
            background: white;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
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
            background: var(--header-bg);
            color: var(--header-text);
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
            border-right: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            vertical-align: top;
            padding: 12px;
            color: #334155;
            line-height: 1.5;
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
            margin-bottom: 4px;
        }

        .timeline-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 40px;
        }

        .timeline-header {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .timeline-item {
            position: relative;
            padding-left: 24px;
            margin-bottom: 20px;
            border-left: 2px solid #e2e8f0;
        }

        .timeline-dot {
            position: absolute;
            left: -6px;
            top: 0;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #94a3b8;
        }

        .timeline-active .timeline-dot {
            background: var(--primary);
            border: 2px solid white;
            box-shadow: 0 0 0 2px var(--primary);
            width: 12px;
            height: 12px;
            left: -7px;
        }

        .timeline-date {
            font-size: 11px;
            color: #94a3b8;
            margin-bottom: 4px;
        }

        .timeline-title {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
        }

        .timeline-desc {
            font-size: 13px;
            color: #64748b;
            margin-top: 4px;
            background: #f8fafc;
            padding: 8px;
            border-radius: 6px;
            border: 1px dashed #cbd5e1;
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
                                untuk memperbaiki.</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Full HIRADC Table View -->
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
                        @forelse($document->details as $index => $item)
                            <tr>
                                <td style="text-align:center; padding-top:20px; font-size:14px; color:#1e293b;">
                                    {{ $index + 1 }}
                                </td>
                                <!-- Kegiatan -->
                                <td>
                                    <div class="cell-text">{{ $item->kolom2_kegiatan }}</div>
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
                                    <div class="cell-text">{{ $item->kolom3_lokasi }}</div>
                                </td>
                                <!-- Pihak -->
                                <td>
                                    <div class="cell-text">{{ $item->kolom4_pihak }}</div>
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
                                    <div class="cell-text">{{ $item->kolom7_dampak }}</div>
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
                                    <div class="cell-text">{{ $item->kolom11_existing }}</div>
                                </td>
                                <!-- RISK INITIAL -->
                                <td class="risk-col section-border-right" style="vertical-align:middle; text-align:center;">
                                    <div style="font-weight:800; font-size:16px;">{{ $item->kolom12_kemungkinan }}</div>
                                </td>
                                <td class="risk-col section-border-right" style="vertical-align:middle; text-align:center;">
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
                                    <div class="cell-text">{{ $item->kolom15_regulasi }}</div>
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
                                    <div class="cell-text">{{ $item->kolom18_tindak_lanjut }}</div>
                                </td>
                                <!-- RISK RESIDUAL -->
                                <td class="risk-col section-border-right" style="vertical-align:middle; text-align:center;">
                                    <div style="font-weight:800; font-size:16px;">{{ $item->residual_kemungkinan }}
                                    </div>
                                </td>
                                <td class="risk-col section-border-right" style="vertical-align:middle; text-align:center;">
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