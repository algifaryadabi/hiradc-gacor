<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen Direktur | HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Reuse styles from Kepala Departemen for consistency */
        :root {
            --primary: #c41e3a;
            /* Semen Padang Red */
            --primary-dark: #9a1829;
            --primary-light: #e63950;
            --bg-body: #f1f5f9;
            --surface: #ffffff;
            --text-main: #0f172a;
            --text-sub: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            padding-bottom: 120px;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: #5b6fd8;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .logo-section {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
        }

        .logo-circle {
            width: 90px;
            height: 90px;
            margin: 0 auto 1.25rem;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-circle img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.125rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
        }

        .logo-subtext {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .nav-menu {
            flex: 1;
            padding: 1.5rem 0;
            overflow-y: auto;
        }

        .nav-item {
            padding: 1rem 1.5rem;
            margin: 0.25rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            border-radius: 0.75rem;
            transition: all 0.2s;
            font-weight: 500;
            font-size: 0.9375rem;
        }

        .nav-item:hover,
        .nav-item.active {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            font-weight: 600;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.125rem;
        }

        .user-info-bottom {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5b6fd8;
            font-weight: 700;
            font-size: 1.125rem;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9375rem;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
        }

        .logout-btn {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 32px 48px;
            min-height: 100vh;
        }

        .back-nav {
            margin-bottom: 32px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--text-sub);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            padding: 8px 16px;
            background: white;
            border-radius: 100px;
            border: 1px solid var(--border);
            transition: all 0.2s;
        }

        .back-link:hover {
            color: var(--text-main);
            border-color: var(--text-sub);
            transform: translateX(-4px);
        }

        /* Doc Card */
        .doc-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .doc-header {
            padding: 20px 24px;
            background: #f8fafc;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .doc-body {
            padding: 24px;
        }

        .doc-title-block {
            background: white;
            border-radius: 16px 16px 0 0;
            border: 1px solid var(--border);
            border-bottom: none;
            padding: 20px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .doc-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-sub);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }

        .doc-main-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1.4;
        }

        /* Tables */
        .table-wrapper {
            background: white;
            border: 1px solid var(--border);
            border-top: none;
            border-radius: 0 0 20px 20px;
            overflow-x: auto;
        }

        .excel-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .excel-table th {
            background: #0f172a;
            color: white;
            padding: 10px;
            border: 1px solid #334155;
            text-align: center;
            font-weight: 700;
            text-transform: uppercase;
        }

        .excel-table td {
            padding: 10px;
            border: 1px solid var(--border);
            color: var(--text-main);
            vertical-align: top;
        }

        .hiradc-table {
            width: 100%;
            border-collapse: separate;
            font-size: 14px;
            min-width: 2200px;
        }

        .hiradc-table th {
            background: #1e293b;
            color: white;
            padding: 12px 14px;
            text-align: left;
            position: sticky;
            top: 0;
            z-index: 10;
            border-right: 1px solid #334155;
            border-bottom: 1px solid #334155;
            white-space: nowrap;
        }

        .hiradc-table td {
            padding: 14px;
            border-bottom: 1px solid var(--border);
            border-right: 1px solid var(--border);
        }

        /* Action Bar */
        .action-bar {
            position: fixed;
            bottom: 0;
            left: 280px;
            right: 0;
            background: linear-gradient(to top, #ffffff 0%, #fefefe 100%);
            padding: 24px 48px;
            border-top: 2px solid var(--border);
            box-shadow: 0 -8px 32px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: flex-end;
            gap: 24px;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .note-input-wrapper {
            flex: 1;
        }

        .note-input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 14px;
            font-family: inherit;
            resize: vertical;
            transition: all 0.2s;
            background: #fafafa;
        }

        .note-input:focus {
            border-color: #5b6fd8;
            background: white;
            box-shadow: 0 0 0 3px rgba(91, 111, 216, 0.1);
        }

        .btn-action {
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            color: white;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-approve {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        }

        .btn-approve:hover {
            background: linear-gradient(135deg, #15803d 0%, #166534 100%);
        }

        .btn-reject {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .btn-reject:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }

        /* Helpers */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .info-table td {
            padding: 8px 12px;
            vertical-align: top;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-label {
            font-weight: 600;
            color: #475569;
            width: 180px;
        }

        /* Passport Card (Simplified) */
        .passport-card {
            background: white;
            border-radius: 16px;
            padding: 20px 28px;
            border: 1px solid var(--border);
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .pp-profile {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .pp-avatar {
            width: 56px;
            height: 56px;
            background: #e0e7ff;
            color: #3730a3;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 20px;
        }

        .pp-status {
            padding: 8px 20px;
            border-radius: 100px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #f59e0b;
        }

        /* Tabs Styling */
        .page-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 0;
        }

        .tab-btn {
            background: none;
            border: none;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-sub);
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tab-btn:hover {
            color: var(--primary);
            background: rgba(196, 30, 58, 0.05);
            border-radius: 8px 8px 0 0;
        }

        .tab-btn.active {
            color: var(--primary);
            border-bottom: 2px solid var(--primary);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
            display: block;
        }

        .badge-count {
            background: var(--primary);
            color: white;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 100px;
            min-width: 18px;
            text-align: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <main class="main-content">
        <div class="back-nav">
            <a href="{{ route('direksi.dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Document Info Card -->
        <div class="passport-card">
            <div class="pp-profile">
                <div class="pp-avatar">
                    {{ optional($document->user)->nama_user ? strtoupper(substr($document->user->nama_user, 0, 2)) : 'U' }}
                </div>
                <div>
                    <h2 style="font-size:18px; font-weight:700;">
                        {{ optional($document->user)->nama_user ?? 'Unknown User' }}</h2>
                    <p style="font-size:13px; color:var(--text-sub);">{{ optional($document->unit)->nama_unit }}</p>
                </div>
            </div>
            <div class="pp-status">
                Menunggu Approval Direksi
            </div>
        </div>

        @php
            $puk = $document->pukProgram;
            $pmk = $document->pmkProgram;
            // Direktur only reviews PMK, so count only PMK
            $programCount = $pmk ? 1 : 0;
        @endphp

        <!-- Tab Navigation -->
        <div class="page-tabs">
            <button type="button" class="tab-btn active" onclick="openTab(event, 'tab-hiradc')">
                <i class="fas fa-table"></i> HIRADC
            </button>
            <button type="button" class="tab-btn" onclick="openTab(event, 'tab-programs')">
                <i class="fas fa-tasks"></i> Program Kerja
                @if($programCount > 0)
                    <span class="badge-count">{{ $programCount }}</span>
                @endif
            </button>
        </div>

        <!-- Review Form Wrapper -->
        <form id="reviewForm" method="POST" action="">
            @csrf


            <!-- Tab Content: HIRADC -->
            <div id="tab-hiradc" class="tab-content active">
                <!-- HIRADC Document Title -->
                <div class="doc-title-block">
                    <div>
                        <div class="doc-label">Judul Dokumen HIRADC</div>
                        <div class="doc-main-title">{{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span class="doc-label"
                            style="background:var(--primary); color:white; padding:4px 10px; border-radius:20px;">HIRADC
                            + PMK</span>

                        {{-- Export Buttons --}}
                        <div style="display: flex; gap: 8px;">
                            {{-- HIRADC Detail Export --}}
                            <a href="{{ route('documents.export.detail.pdf', $document->id) }}" target="_blank"
                                style="padding: 8px 14px; background: #ef4444; color: white; border-radius: 8px; text-decoration: none; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;"
                                onmouseover="this.style.background='#dc2626'"
                                onmouseout="this.style.background='#ef4444'">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                            <a href="{{ route('documents.export.detail.excel', $document->id) }}" target="_blank"
                                style="padding: 8px 14px; background: #22c55e; color: white; border-radius: 8px; text-decoration: none; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;"
                                onmouseover="this.style.background='#16a34a'"
                                onmouseout="this.style.background='#22c55e'">
                                <i class="fas fa-file-excel"></i> Excel
                            </a>
                        </div>
                    </div>
                </div>

                <!-- HIRADC Table (Simplified View for Context) -->
                <div class="table-wrapper">
                    <table class="hiradc-table">
                        <thead>
                            <!-- Header Row 1: Main Sections (BAGIAN 1-5) -->
                            <tr>
                                <th rowspan="2" style="width: 40px;">No</th>
                                <th colspan="4" class="section-border-right">BAGIAN 1: Identifikasi Aktivitas</th>
                                <th colspan="6" class="section-border-right">BAGIAN 2: Identifikasi</th>
                                <th colspan="5" class="section-border-right">BAGIAN 3: Pengendalian & Penilaian Awal
                                </th>
                                <th colspan="3" class="section-border-right">BAGIAN 4: Legalitas & Signifikansi</th>
                                <th colspan="5">BAGIAN 5: Mitigasi Lanjutan</th>
                            </tr>
                            <!-- Header Row 2: Column Details -->
                            <tr>
                                <!-- BAGIAN 1 (Kolom 2-5) -->
                                <th style="width: 180px;">Proses/Kegiatan<br><small>(Kol 2)</small></th>
                                <th style="width: 120px;">Lokasi<br><small>(Kol 3)</small></th>
                                <th style="width: 80px;">Kategori<br><small>(Kol 4)</small></th>
                                <th style="width: 90px;" class="section-border-right">Kondisi<br><small>(Kol 5)</small>
                                </th>

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
                                <th style="width: 80px;" class="section-border-right">Level<br><small>(Kol 14)</small>
                                </th>

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
                            @foreach($document->details as $index => $item)
                                <tr>
                                    <td style="text-align:center;">{{ $loop->iteration }}</td>

                                    <!-- BAGIAN 1: Identifikasi Aktivitas -->
                                    <td>{{ $item->kolom2_kegiatan }}</td>
                                    <td>{{ $item->kolom3_lokasi }}</td>
                                    <td style="text-align:center;">
                                        <span
                                            style="background:#e0e7ff; color:#3730a3; padding:4px 8px; border-radius:6px; font-size:11px; font-weight:700;">
                                            {{ $item->kategori }}
                                        </span>
                                    </td>
                                    <td class="section-border-right" style="text-align:center;">
                                        <span
                                            style="background:#f1f5f9; color:#475569; padding:4px 8px; border-radius:6px; font-size:11px; font-weight:700;">
                                            {{ $item->kolom5_kondisi }}
                                        </span>
                                    </td>

                                    <!-- BAGIAN 2: Identifikasi -->
                                    <td>
                                        @if($item->kategori == 'K3' || $item->kategori == 'KO')
                                            @php $bahayaDetails = $item->kolom6_bahaya['details'] ?? []; @endphp
                                            {{ implode(', ', $bahayaDetails) }}
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->kategori == 'Lingkungan')
                                            @php
                                                $col7 = $item->kolom7_aspek_lingkungan ?? [];
                                                $details7 = $col7['details'] ?? [];
                                               @endphp
                                            {{ implode(', ', $details7) }}
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->kategori == 'Keamanan')
                                            @php
                                                $col8 = $item->kolom8_ancaman ?? [];
                                                $details8 = $col8['details'] ?? [];
                                               @endphp
                                            {{ implode(', ', $details8) }}
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->kategori == 'K3' || $item->kategori == 'KO')
                                            {{ $item->kolom9_risiko }}
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->kategori == 'Lingkungan')
                                            {{ $item->kolom9_risiko }}
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>
                                    <td class="section-border-right">
                                        @if($item->kategori == 'Keamanan')
                                            {{ $item->kolom9_risiko }}
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>

                                    <!-- BAGIAN 3: Pengendalian & Penilaian Awal -->
                                    <td>
                                        @php $hs = $item->kolom10_pengendalian['hierarchy'] ?? []; @endphp
                                        {{ implode(', ', $hs) }}
                                    </td>
                                    <td>{{ $item->kolom11_existing }}</td>
                                    <td style="text-align:center; font-weight:bold;">{{ $item->kolom12_kemungkinan }}</td>
                                    <td style="text-align:center; font-weight:bold;">{{ $item->kolom13_konsekuensi }}</td>
                                    <td class="section-border-right" style="text-align:center;">
                                        <div style="font-weight:800; font-size:16px;">{{ $item->kolom14_score }}</div>
                                        <div
                                            style="font-size:10px; padding:2px 6px; border-radius:8px; margin-top:4px; font-weight:700; color:white; display:inline-block; {{ $item->kolom14_score >= 15 ? 'background:#dc2626;' : ($item->kolom14_score >= 8 ? 'background:#ca8a04;' : 'background:#16a34a;') }}">
                                            {{ $item->kolom14_score >= 15 ? 'TINGGI' : ($item->kolom14_score >= 8 ? 'SEDANG' : 'RENDAH') }}
                                        </div>
                                    </td>

                                    <!-- BAGIAN 4: Legalitas & Signifikansi -->
                                    <td>{{ $item->kolom15_regulasi }}</td>
                                    <td style="text-align:center;">
                                        @if($item->kategori == 'Lingkungan' && $item->kolom16_aspek)
                                            <span
                                                style="{{ $item->kolom16_aspek == 'P' ? 'background:#dbeafe; color:#1e40af;' : 'background:#f1f5f9; color:#64748b;' }} padding:4px 8px; border-radius:6px; font-size:11px; font-weight:700;">
                                                {{ $item->kolom16_aspek }}
                                            </span>
                                        @else
                                            <div style="color:#94a3b8;">-</div>
                                        @endif
                                    </td>
                                    <td class="section-border-right">
                                        @if($item->kolom17_risiko)
                                            <div><strong>RISIKO (-):</strong> {{ $item->kolom17_risiko }}</div>
                                        @endif
                                        @if($item->kolom17_peluang)
                                            <div style="margin-top:6px;"><strong>PELUANG (+):</strong>
                                                {{ $item->kolom17_peluang }}</div>
                                        @endif
                                    </td>

                                    <!-- BAGIAN 5: Mitigasi Lanjutan -->
                                    <td style="text-align:center;">
                                        <span
                                            style="{{ $item->kolom18_toleransi == 'Ya' ? 'background:#dcfce7; color:#166534;' : 'background:#fee2e2; color:#991b1b;' }} padding:4px 8px; border-radius:6px; font-size:11px; font-weight:700;">
                                            {{ $item->kolom18_toleransi == 'Ya' ? 'Ya' : 'Tidak' }}
                                        </span>
                                    </td>
                                    @if($item->kolom18_toleransi == 'Tidak')
                                        <td>{{ $item->kolom19_pengendalian_lanjut }}</td>
                                        <td style="text-align:center; font-weight:bold;">{{ $item->kolom20_kemungkinan_lanjut }}
                                        </td>
                                        <td style="text-align:center; font-weight:bold;">{{ $item->kolom21_konsekuensi_lanjut }}
                                        </td>
                                        <td style="text-align:center;">
                                            <div style="font-weight:800; font-size:16px;">
                                                {{ $item->kolom22_tingkat_risiko_lanjut }}</div>
                                            @if($item->kolom22_tingkat_risiko_lanjut)
                                                <div
                                                    style="font-size:10px; padding:2px 6px; border-radius:8px; margin-top:4px; font-weight:700; color:white; display:inline-block; {{ $item->kolom22_tingkat_risiko_lanjut >= 15 ? 'background:#dc2626;' : ($item->kolom22_tingkat_risiko_lanjut >= 8 ? 'background:#ca8a04;' : 'background:#16a34a;') }}">
                                                    {{ $item->kolom22_tingkat_risiko_lanjut >= 15 ? 'TINGGI' : ($item->kolom22_tingkat_risiko_lanjut >= 8 ? 'SEDANG' : 'RENDAH') }}
                                                </div>
                                            @endif
                                        </td>
                                    @else
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
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Riwayat Approval -->
                <div class="doc-card" style="margin-top: 32px; border-left: 5px solid #3b82f6;">
                    <div class="doc-header">
                        <i class="fas fa-history" style="color: #3b82f6; font-size: 20px;"></i>
                        <h2 style="margin:0; font-size:18px; color:#1e293b;">Riwayat Approval</h2>
                    </div>
                    <div class="doc-body">
                        @php
                            // Get all approvals with proper eager loading
                            $approvals = $document->approvals()->with(['approver.unit', 'approver.departemen'])->orderBy('created_at', 'desc')->get();
                        @endphp

                        @if($approvals && $approvals->count() > 0)
                            <div style="position: relative; padding-left: 40px;">
                                <!-- Timeline Line -->
                                <div
                                    style="position: absolute; left: 15px; top: 0; bottom: 0; width: 2px; background: #e2e8f0;">
                                </div>

                                @foreach($approvals as $approval)
                                    @php
                                        $approver = $approval->approver;
                                        $approverName = $approver->nama_user ?? $approver->nama_lengkap ?? 'Unknown';
                                        $approverUnit = $approver->unit->nama_unit ?? ($approver->departemen->nama_dept ?? '-');
                                        $approverJabatan = $approver->jabatan ?? $approver->role_jabatan_name ?? '-';

                                        // Determine action color and label
                                        $actionColor = '#f59e0b';
                                        $actionBg = '#fef3c7';
                                        $actionText = '#92400e';
                                        $actionLabel = strtoupper($approval->action);

                                        if ($approval->action == 'approved') {
                                            $actionColor = '#22c55e';
                                            $actionBg = '#dcfce7';
                                            $actionText = '#166534';
                                            $actionLabel = 'APPROVED';
                                        } elseif ($approval->action == 'rejected' || $approval->action == 'revision') {
                                            $actionColor = '#ef4444';
                                            $actionBg = '#fee2e2';
                                            $actionText = '#991b1b';
                                            $actionLabel = $approval->action == 'rejected' ? 'REJECTED' : 'REVISI';
                                        } elseif ($approval->action == 'reviewed') {
                                            $actionColor = '#3b82f6';
                                            $actionBg = '#dbeafe';
                                            $actionText = '#1e40af';
                                            $actionLabel = 'REVIEWED';
                                        } elseif ($approval->action == 'disposition') {
                                            $actionColor = '#f59e0b';
                                            $actionBg = '#fef3c7';
                                            $actionText = '#92400e';
                                            $actionLabel = 'DISPOSITION';
                                        }
                                    @endphp
                                    <div style="position: relative; margin-bottom: 24px;">
                                        <!-- Timeline Dot -->
                                        <div
                                            style="position: absolute; left: -25px; width: 12px; height: 12px; border-radius: 50%; background: {{ $actionColor }}; border: 3px solid white; box-shadow: 0 0 0 2px #e2e8f0;">
                                        </div>

                                        <div
                                            style="background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                            <div
                                                style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 700; color: #1e293b; font-size: 14px;">
                                                        {{ $approverName }}</div>
                                                    <div style="font-size: 12px; color: #64748b; margin-top: 2px;">
                                                        {{ $approverJabatan }}</div>
                                                    <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">
                                                        <i class="fas fa-building"
                                                            style="margin-right: 4px;"></i>{{ $approverUnit }}
                                                    </div>
                                                </div>
                                                <div style="text-align: right;">
                                                    <span
                                                        style="padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; background: {{ $actionBg }}; color: {{ $actionText }};">
                                                        {{ $actionLabel }}
                                                    </span>
                                                    <div style="font-size: 11px; color: #94a3b8; margin-top: 4px;">
                                                        <i class="fas fa-clock"
                                                            style="margin-right: 4px;"></i>{{ $approval->created_at->format('d M Y, H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                            @if($approval->catatan)
                                                <div
                                                    style="margin-top: 12px; padding: 12px; background: white; border-radius: 6px; border-left: 3px solid {{ $actionColor }};">
                                                    <div
                                                        style="font-size: 11px; color: #64748b; font-weight: 600; margin-bottom: 4px;">
                                                        CATATAN:</div>
                                                    <div style="font-size: 13px; color: #334155; line-height: 1.5;">
                                                        {{ $approval->catatan }}</div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div style="text-align: center; padding: 40px; color: #94a3b8;">
                                <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;"></i>
                                <div style="font-size: 14px; font-weight: 600;">Belum ada riwayat approval</div>
                            </div>
                        @endif
                    </div>
                </div>

            </div><!-- End tab-hiradc -->

            <!-- Tab Content: Program Kerja -->
            <div id="tab-programs" class="tab-content">

                <!-- PMK Section -->
                @php $pmk = $document->pmkProgram; @endphp
                @if($pmk)
                    <div class="doc-card" style="margin-top: 32px; border-left: 5px solid #dc2626;">
                        <div class="doc-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <i class="fas fa-project-diagram" style="color: #dc2626; font-size: 20px;"></i>
                                <h2 style="margin:0; font-size:18px; color:#1e293b;">Review Program Manajemen Korporat (PMK)
                                </h2>
                            </div>

                            <!-- PMK Export Buttons -->
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('documents.export.pmk.pdf', $document->id) }}" target="_blank"
                                    style="padding: 8px 16px; background: #ef4444; color: white; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;"
                                    onmouseover="this.style.background='#dc2626'"
                                    onmouseout="this.style.background='#ef4444'">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                                <a href="{{ route('documents.export.pmk.excel', $document->id) }}" target="_blank"
                                    style="padding: 8px 16px; background: #22c55e; color: white; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;"
                                    onmouseover="this.style.background='#16a34a'"
                                    onmouseout="this.style.background='#22c55e'">
                                    <i class="fas fa-file-excel"></i> Excel
                                </a>
                            </div>
                        </div>

                        <div class="doc-body">
                            <div
                                style="background: #faf5ff; padding: 16px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #e9d5ff;">
                                <table class="info-table">
                                    <tr>
                                        <td class="info-label">Judul Program</td>
                                        <td class="info-value">: {{ $pmk->judul }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Tujuan</td>
                                        <td class="info-value">: {{ $pmk->tujuan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Sasaran</td>
                                        <td class="info-value">: {{ $pmk->sasaran }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Penanggung Jawab</td>
                                        <td class="info-value">: {{ $pmk->penanggung_jawab }}</td>
                                    </tr>
                                    @if($pmk->uraian_revisi)
                                        <tr>
                                            <td class="info-label">Uraian Revisi</td>
                                            <td class="info-value">: {{ $pmk->uraian_revisi }}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>

                            @if($pmk->program_kerja && is_array($pmk->program_kerja))
                                <h4 style="font-size:15px; font-weight:700; color:#0f172a; margin-bottom: 12px;">Detail Program
                                    Kerja:</h4>
                                <div class="table-wrapper" style="border-radius: 8px;">
                                    <table class="excel-table">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Uraian Kegiatan</th>
                                                <th rowspan="2">PIC</th>
                                                <th colspan="12">Target (%)</th>
                                                <th rowspan="2">Anggaran</th>
                                            </tr>
                                            <tr>
                                                @for($m = 1; $m <= 12; $m++)
                                                <th>{{ $m }}</th> @endfor
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pmk->program_kerja as $idx => $prog)
                                                <tr>
                                                    <td style="text-align:center;">{{ $idx + 1 }}</td>
                                                    <td>{{ $prog['uraian'] ?? '-' }}</td>
                                                    <td>{{ $prog['pic'] ?? '-' }}</td>
                                                    @for($m = 0; $m < 12; $m++)
                                                        <td style="text-align:center;">{{ $prog['target'][$m] ?? '-' }}</td>
                                                    @endfor
                                                    <td>{{ isset($prog['anggaran']) ? 'Rp ' . number_format($prog['anggaran'], 0, ',', '.') : '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Riwayat Approval -->
                <div class="doc-card" style="margin-top: 32px; border-left: 5px solid #3b82f6;">
                    <div class="doc-header">
                        <i class="fas fa-history" style="color: #3b82f6; font-size: 20px;"></i>
                        <h2 style="margin:0; font-size:18px; color:#1e293b;">Riwayat Approval</h2>
                    </div>
                    <div class="doc-body">
                        @php
                            // Get all approvals with proper eager loading
                            $approvals = $document->approvals()->with(['approver.unit', 'approver.departemen'])->orderBy('created_at', 'desc')->get();
                        @endphp

                        @if($approvals && $approvals->count() > 0)
                            <div style="position: relative; padding-left: 40px;">
                                <!-- Timeline Line -->
                                <div
                                    style="position: absolute; left: 15px; top: 0; bottom: 0; width: 2px; background: #e2e8f0;">
                                </div>

                                @foreach($approvals as $approval)
                                    @php
                                        $approver = $approval->approver;
                                        $approverName = $approver->nama_user ?? $approver->nama_lengkap ?? 'Unknown';
                                        $approverUnit = $approver->unit->nama_unit ?? ($approver->departemen->nama_dept ?? '-');
                                        $approverJabatan = $approver->jabatan ?? $approver->role_jabatan_name ?? '-';

                                        // Determine action color and label
                                        $actionColor = '#f59e0b';
                                        $actionBg = '#fef3c7';
                                        $actionText = '#92400e';
                                        $actionLabel = strtoupper($approval->action);

                                        if ($approval->action == 'approved') {
                                            $actionColor = '#22c55e';
                                            $actionBg = '#dcfce7';
                                            $actionText = '#166534';
                                            $actionLabel = 'APPROVED';
                                        } elseif ($approval->action == 'rejected' || $approval->action == 'revision') {
                                            $actionColor = '#ef4444';
                                            $actionBg = '#fee2e2';
                                            $actionText = '#991b1b';
                                            $actionLabel = $approval->action == 'rejected' ? 'REJECTED' : 'REVISI';
                                        } elseif ($approval->action == 'reviewed') {
                                            $actionColor = '#3b82f6';
                                            $actionBg = '#dbeafe';
                                            $actionText = '#1e40af';
                                            $actionLabel = 'REVIEWED';
                                        } elseif ($approval->action == 'disposition') {
                                            $actionColor = '#f59e0b';
                                            $actionBg = '#fef3c7';
                                            $actionText = '#92400e';
                                            $actionLabel = 'DISPOSITION';
                                        }
                                    @endphp
                                    <div style="position: relative; margin-bottom: 24px;">
                                        <!-- Timeline Dot -->
                                        <div
                                            style="position: absolute; left: -25px; width: 12px; height: 12px; border-radius: 50%; background: {{ $actionColor }}; border: 3px solid white; box-shadow: 0 0 0 2px #e2e8f0;">
                                        </div>

                                        <div
                                            style="background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                            <div
                                                style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 700; color: #1e293b; font-size: 14px;">
                                                        {{ $approverName }}</div>
                                                    <div style="font-size: 12px; color: #64748b; margin-top: 2px;">
                                                        {{ $approverJabatan }}</div>
                                                    <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">
                                                        <i class="fas fa-building"
                                                            style="margin-right: 4px;"></i>{{ $approverUnit }}
                                                    </div>
                                                </div>
                                                <div style="text-align: right;">
                                                    <span
                                                        style="padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; background: {{ $actionBg }}; color: {{ $actionText }};">
                                                        {{ $actionLabel }}
                                                    </span>
                                                    <div style="font-size: 11px; color: #94a3b8; margin-top: 4px;">
                                                        <i class="fas fa-clock"
                                                            style="margin-right: 4px;"></i>{{ $approval->created_at->format('d M Y, H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                            @if($approval->catatan)
                                                <div
                                                    style="margin-top: 12px; padding: 12px; background: white; border-radius: 6px; border-left: 3px solid {{ $actionColor }};">
                                                    <div
                                                        style="font-size: 11px; color: #64748b; font-weight: 600; margin-bottom: 4px;">
                                                        CATATAN:</div>
                                                    <div style="font-size: 13px; color: #334155; line-height: 1.5;">
                                                        {{ $approval->catatan }}</div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div style="text-align: center; padding: 40px; color: #94a3b8;">
                                <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;"></i>
                                <div style="font-size: 14px; font-weight: 600;">Belum ada riwayat approval</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            </div><!-- End tab-programs -->

            <!-- Action Bar -->
            <div class="action-bar">
                <div class="note-input-wrapper" style="flex:1;">
                    <label style="font-size:13px; font-weight:700; color:#1e293b; display:block; margin-bottom:8px;">
                        <i class="fas fa-sticky-note" style="margin-right: 6px; color: #64748b;"></i>
                        Catatan Approval
                    </label>
                    <textarea name="catatan" class="note-input"
                        placeholder="Tambahkan catatan untuk approval atau revisi (opsional)..."
                        style="min-height: 80px;"></textarea>
                </div>
                <div style="display:flex; gap:12px; align-items: flex-end;">
                    @if(isset($pmk) && in_array($pmk->status, ['draft', 'pending_direksi']))
                        <button type="button" class="btn-action"
                            style="background: linear-gradient(135deg, #db2777 0%, #be185d 100%);"
                            onclick="submitPmkRevision()">
                            <i class="fas fa-file-contract"></i> Revisi PMK
                        </button>
                    @endif

                    <button type="button" class="btn-action btn-reject" onclick="submitDecision('reject')">
                        <i class="fas fa-undo"></i> Revisi
                    </button>
                    <button type="button" class="btn-action btn-approve" onclick="submitDecision('approve')">
                        <i class="fas fa-check-circle"></i> Publish
                    </button>
                </div>
            </div>
        </form>
    </main>

    <script>
        function submitPmkRevision() {
            const form = document.getElementById('reviewForm');
            const note = document.querySelector('textarea[name="catatan"]').value;

            if (!note.trim()) {
                Swal.fire('Error', 'Harap isi catatan revisi PMK.', 'error');
                return;
            }

            Swal.fire({
                title: 'Revisi PMK?',
                text: 'Program Manajemen Korporat akan dikembalikan ke User untuk revisi.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#be185d',
                confirmButtonText: 'Ya, Revisi PMK'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.action = "{{ route('pmk.request_revision', $pmk->id ?? 0) }}";
                    form.submit();
                }
            });
        }

        function submitDecision(action) {
            const form = document.getElementById('reviewForm');
            const note = document.querySelector('textarea[name="catatan"]').value;

            if (action === 'reject' && !note.trim()) {
                Swal.fire('Error', 'Harap isi catatan jika menolak dokumen.', 'error');
                return;
            }

            let title = action === 'approve' ? 'Publish Dokumen?' : 'Tolak Dokumen?';
            let text = action === 'approve'
                ? 'Dokumen akan dipublikasikan ke seluruh user.'
                : 'Dokumen akan dikembalikan ke Unit Kerja untuk revisi.';
            let confirmBtn = action === 'approve' ? 'Ya, Publish' : 'Ya, Tolak';
            let confirmColor = action === 'approve' ? '#16a34a' : '#ef4444';

            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: confirmColor,
                cancelButtonColor: '#3085d6',
                confirmButtonText: confirmBtn
            }).then((result) => {
                if (result.isConfirmed) {
                    // Set action URL dynamically
                    if (action === 'approve') {
                        form.action = "{{ route('direksi.approve', $document->id) }}";
                    } else {
                        form.action = "{{ route('direksi.revise', $document->id) }}";
                    }
                    form.submit();
                }
            });
        }

        // Tab switching function
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
                tabcontent[i].classList.remove('active');
            }
            tablinks = document.getElementsByClassName("tab-btn");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            document.getElementById(tabName).classList.add('active');
            evt.currentTarget.className += " active";
        }
    </script>
</body>

</html>