<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Dokumen Terpublikasi - HIRADC</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            padding-bottom: 60px;
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

        /* Standardized Main Content */
        .main-content {
            margin-left: 250px;
            padding: 32px 48px;
            min-height: 100vh;
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
        }

        /* Wizard Styles */
        .wizard-container {
            background: white;
            padding: 30px;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            margin-bottom: 32px;
        }

        .wizard-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .wizard-steps::before {
            content: '';
            position: absolute;
            top: 25px;
            left: 50px;
            right: 50px;
            height: 2px;
            background: #e2e8f0;
            z-index: 0;
        }

        .step-item {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .step-circle {
            width: 50px;
            height: 50px;
            background: white;
            border: 2px solid #cbd5e1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #64748b;
            transition: all 0.3s;
        }

        .step-label {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
        }

        .step-item.completed .step-circle {
            border-color: var(--primary);
            background: var(--primary);
            color: white;
        }

        .step-item.active .step-circle {
            border-color: var(--primary);
            color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light);
        }

        .step-item.completed .step-label,
        .step-item.active .step-label {
            color: var(--text-main);
        }

        /* Excel Table Styles */
        .hiradc-wrapper {
            overflow-x: auto;
            width: 100%;
            background: white;
            border: 1px solid #cbd5e1;
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

        .excel-table th {
            background: #1e293b;
            color: white;
            padding: 12px;
            border-right: 1px solid #334155;
            border-bottom: 1px solid #334155;
            text-align: center;
            white-space: nowrap;
        }

        .excel-table thead tr:first-child th {
            background: #0f172a;
        }

        .excel-table td {
            padding: 12px;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }

        /* Timeline Remake */
        .history-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            padding: 30px;
            margin-top: 24px;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 5px;
            top: 0;
            bottom: 0;
            background: #e2e8f0;
            width: 2px;
        }

        .timeline-item {
            position: relative;
            padding-left: 30px;
            padding-bottom: 30px;
        }

        .timeline-dot {
            position: absolute;
            left: -4px;
            top: 5px;
            width: 12px;
            height: 12px;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 50%;
        }

        /* Hide redundant user section from included sidebars */
        .sidebar .user-section { 
            display: none !important; 
        }
        
        /* Sidebar Logo & Menu Fix */
        .logo-section {
            padding: 30px 20px;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
        }
        /* Fix for includes sidebars that have direct img without .logo-circle */
        .logo-section > img {
            width: 50px;
            height: auto;
            margin-bottom: 10px;
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
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .logo-circle img {
            max-width: 80% !important;
            max-height: 80% !important;
            height: auto !important;
            width: auto !important;
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
            color: #666;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
        }
        .nav-item:hover { background: #fff5f5; color: #c41e3a; }
        .nav-item.active { background: #ffe5e5; color: #c41e3a; border-left: 3px solid #c41e3a; }
        .nav-item i { width: 20px; text-align: center; }

        /* User Info Bottom */
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

        @media print {
            .sidebar, .btn-back { display: none !important; }
            .main-content { margin-left: 0 !important; }
        }
    </style>
</head>

<body>
    <div class="layout-container">
        <!-- Dynamic Sidebar -->
        @php
            $currentUser = Auth::user();
            $roleName = $currentUser->getRoleName();
        @endphp

        <aside class="sidebar">
            @php $role = auth()->user()->getRoleName(); @endphp
            
            @if($role == 'approver')
                @include('approver.partials.sidebar')
            @elseif($role == 'user')
                @include('user.partials.sidebar')
            @elseif($role == 'admin')
                @include('admin.partials.sidebar')
            @else
                {{-- Fallback sidebar for Unit Pengelola, Kepala Departemen, and others --}}
                <div class="logo-section">
                    <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
                    <div class="logo-text">PT Semen Padang</div>
                    <div class="logo-subtext">HIRADC System</div>
                </div>

                <nav class="nav-menu">
                    @if($role == 'unit_pengelola')
                        <a href="{{ route('unit_pengelola.dashboard') }}" class="nav-item">
                            <i class="fas fa-th-large"></i><span>Dashboard</span>
                        </a>
                        <a href="{{ route('unit_pengelola.documents.index') }}" class="nav-item">
                            <i class="fas fa-file-alt"></i><span>Inbox Dokumen</span>
                        </a>
                    @elseif($role == 'kepala_departemen')
                        <a href="{{ route('kepala_departemen.dashboard') }}" class="nav-item">
                            <i class="fas fa-th-large"></i><span>Dashboard</span>
                        </a>
                        <a href="{{ route('kepala_departemen.check_documents') }}" class="nav-item">
                            <i class="fas fa-file-contract"></i><span>Review Dokumen</span>
                        </a>
                    @else
                        <a href="{{ route(auth()->user()->getDashboardRoute()) }}" class="nav-item active">
                            <i class="fas fa-th-large"></i><span>Dashboard</span>
                        </a>
                    @endif
                </nav>
            @endif

            {{-- User Info Section (for all roles) --}}
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
                    onclick="event.preventDefault(); document.getElementById('logout-form-published').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    Keluar
                </a>
                <form id="logout-form-published" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <div class="header-title">
                    <h1>Detail Form HIRADC</h1>
                    <p>Melihat detail form yang telah dipublikasikan.</p>
                </div>
                <a href="{{ route(auth()->user()->getDashboardRoute()) }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <!-- Progress Wizard -->
            <div class="wizard-container">
                <div class="wizard-steps">
                    <div class="step-item {{ $document->current_level >= 1 ? 'completed' : 'active' }}">
                        <div class="step-circle"><i class="fas fa-file-signature"></i></div>
                        <div class="step-label">Draft & Submit</div>
                    </div>
                    <div class="step-item {{ $document->current_level > 1 ? 'completed' : ($document->current_level == 1 ? 'active' : '') }}">
                        <div class="step-circle">1</div>
                        <div class="step-label">Kepala Unit</div>
                    </div>
                    <div class="step-item {{ $document->current_level > 2 ? 'completed' : ($document->current_level == 2 ? 'active' : '') }}">
                        <div class="step-circle">2</div>
                        <div class="step-label">Unit Pengelola</div>
                    </div>
                    <div class="step-item {{ ($document->status == 'approved' || $document->status == 'published') ? 'completed' : ($document->current_level == 3 ? 'active' : '') }}">
                        <div class="step-circle">3</div>
                        <div class="step-label">Kepala Dept.</div>
                    </div>
                    <div class="step-item {{ ($document->status == 'approved' || $document->status == 'published') ? 'completed active' : '' }}">
                        <div class="step-circle"><i class="fas fa-check"></i></div>
                        <div class="step-label">Selesai</div>
                    </div>
                </div>
            </div>

            <!-- Header Card (Summary) -->
            <div class="doc-card">
                <div class="doc-header" style="background: #f8fafc; padding: 20px 32px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <div class="doc-title-label">Judul Form</div>
                        <div class="doc-title-value" style="font-size: 20px; font-weight: 800; color: #1e293b;">{{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</div>
                    </div>
                    <div style="background: #10b981; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">
                        TERPUBLIKASI
                    </div>
                </div>
                <div style="padding: 24px 32px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px;">
                    <div>
                        <div class="doc-title-label">Unit Kerja</div>
                        <div style="font-weight: 700; color: #1e293b;">{{ $document->unit->nama_unit ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="doc-title-label">Seksi</div>
                        <div style="font-weight: 700; color: #1e293b;">{{ $document->seksi->nama_seksi ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="doc-title-label">Penulis</div>
                        <div style="font-weight: 700; color: #1e293b;">{{ $document->user->nama_user ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="doc-title-label">Tanggal Publish</div>
                        <div style="font-weight: 700; color: #1e293b;">{{ $document->published_at ? $document->published_at->format('d M Y') : '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="hiradc-wrapper">
                <table class="excel-table">
                    <thead>
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
                            <th style="width: 60px;">R</th>
                            <th style="width: 80px;">Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($document->details as $index => $item)
                            @php 
                                $bahaya = is_array($item->kolom6_bahaya) ? $item->kolom6_bahaya : [];
                                $pengendalian = is_array($item->kolom10_pengendalian) ? $item->kolom10_pengendalian : [];
                                $bahayaList = $bahaya['details'] ?? [];
                                $hierarchyList = $pengendalian['hierarchy'] ?? [];
                                
                                $initialScore = $item->kolom14_score;
                                $initialColor = $initialScore >= 15 ? '#ef4444' : ($initialScore >= 8 ? '#f59e0b' : '#10b981');
                                $initialLevelText = $initialScore >= 15 ? 'HIGH' : ($initialScore >= 8 ? 'MED' : 'LOW');

                                $residualScore = $item->residual_score;
                                $residualColor = $residualScore >= 15 ? '#ef4444' : ($residualScore >= 8 ? '#f59e0b' : '#10b981');
                                $residualLevelText = $residualScore >= 15 ? 'HIGH' : ($residualScore >= 8 ? 'MED' : 'LOW');
                            @endphp
                            <tr>
                                <td style="text-align:center;">{{ $index + 1 }}</td>
                                <td>{{ $item->kolom2_kegiatan }}</td>
                                <td><span style="background:#f1f5f9; padding:2px 6px; border-radius:4px; font-weight:600; font-size:11px;">{{ $item->kategori }}</span></td>
                                <td>{{ $item->kolom3_lokasi }}</td>

                                <td class="section-border-right">{{ $item->kolom5_kondisi }}</td>
                                <td>
                                    <strong>{{ $bahaya['type'] ?? '-' }}</strong>
                                    <ul style="padding-left:15px; margin-top:5px;">
                                        @foreach($bahayaList as $d) <li>{{ $d }}</li> @endforeach
                                    </ul>
                                </td>
                                <td>{{ $item->kolom7_dampak }}</td>
                                <td class="section-border-right">
                                    @if($item->kolom17_risiko) <div style="color:#ef4444;"><i class="fas fa-minus-circle"></i> {{ $item->kolom17_risiko }}</div> @endif
                                    @if($item->kolom17_peluang) <div style="color:#10b981;"><i class="fas fa-plus-circle"></i> {{ $item->kolom17_peluang }}</div> @endif
                                </td>
                                <td>
                                    <div style="display:flex; flex-wrap:wrap; gap:4px;">
                                        @foreach($hierarchyList as $h) 
                                            <span style="background:#eff6ff; color:#1d4ed8; padding:2px 6px; border-radius:4px; font-size:11px; border:1px solid #dbeafe;">{{ $h }}</span> 
                                        @endforeach
                                    </div>
                                </td>
                                <td class="section-border-right">{{ $item->kolom11_existing }}</td>
                                <td style="text-align:center;">{{ $item->kolom12_kemungkinan }}</td>
                                <td style="text-align:center;">{{ $item->kolom13_konsekuensi }}</td>
                                <td class="section-border-right" style="text-align:center;">
                                    <div style="background:{{ $initialColor }}; color:white; padding:2px 8px; border-radius:4px; font-weight:700; font-size:11px;">{{ $initialLevelText }}</div>
                                </td>
                                <td>{{ $item->kolom15_regulasi }}</td>
                                <td class="section-border-right" style="text-align:center; font-weight:700;">{{ $item->kolom16_aspek_penting ? 'PENTING' : 'TP' }}</td>
                                <td>{{ $item->kolom18_tindak_lanjut }}</td>
                                <td style="text-align:center;">{{ $item->residual_kemungkinan }}</td>
                                <td style="text-align:center;">{{ $item->residual_konsekuensi }}</td>
                                <td style="text-align:center;">{{ $item->residual_score }}</td>
                                <td style="text-align:center;">
                                    <div style="background:{{ $residualColor }}; color:white; padding:2px 8px; border-radius:4px; font-weight:700; font-size:11px;">{{ $residualLevelText }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



            <!-- History Section -->
            <div class="history-card">
                <div class="section-heading">
                    <i class="fas fa-history" style="color:var(--primary);"></i>
                    Riwayat Persetujuan & Publikasi
                </div>

                <div class="timeline">
                    @php
                        $createdEvent = (object) [
                            'created_at' => $document->created_at,
                            'approver' => $document->user,
                            'action' => 'created',
                            'catatan' => 'Form baru diajukan',
                            'is_first' => true
                        ];
                        $allHistory = collect([$createdEvent])->merge($document->approvals->sortBy('created_at'));
                        $displayHistory = $allHistory->sortByDesc('created_at')->values();
                    @endphp

                    @forelse($displayHistory as $index => $log)
                        @php
                            $isFirst = $index === 0;
                            $actionLabel = 'Aksi Tidak Diketahui';
                            $actionColor = '#94a3b8';
                            $icon = 'fa-circle';

                            switch($log->action) {
                                case 'created': $actionLabel = 'Form Dibuat'; $actionColor = '#3b82f6'; $icon = 'fa-file-medical'; break;
                                case 'approved': 
                                    $actionLabel = ($log->level == 3 || $document->status == 'published') ? 'Dipublikasikan' : 'Disetujui'; 
                                    $actionColor = '#10b981'; $icon = 'fa-check-circle'; break;
                                case 'revision': $actionLabel = 'Dikembalikan untuk Revisi'; $actionColor = '#ef4444'; $icon = 'fa-undo'; break;
                                case 'disposition': $actionLabel = 'Didisposisi ke Staff'; $actionColor = '#f59e0b'; $icon = 'fa-user-clock'; break;
                                case 'reviewed': $actionLabel = 'Direview oleh Staff'; $actionColor = '#8b5cf6'; $icon = 'fa-glasses'; break;
                                case 'verified': $actionLabel = 'Diverifikasi oleh Staff'; $actionColor = '#06b6d4'; $icon = 'fa-clipboard-check'; break;
                            }
                        @endphp

                        <div class="timeline-item {{ $isFirst ? 'active' : '' }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-date">{{ $log->created_at->format('d M Y, H:i') }} WIB</div>
                            <div class="timeline-content">
                                <div class="timeline-user">
                                    {{ optional($log->approver)->nama_user ?? 'System' }} 
                                    <span style="font-weight:400; color:var(--text-sub); font-size: 13px;">
                                        • {{ optional($log->approver)->role_jabatan_name ?? ($log->action == 'created' ? 'Submitter' : '-') }}
                                    </span>
                                </div>
                                <div class="timeline-action">
                                    <span style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; background:{{ $actionColor }}15; color:{{ $actionColor }}; border-radius:100px; font-weight:700; font-size:12px; border:1px solid {{ $actionColor }}30;">
                                        <i class="fas {{ $icon }}"></i> {{ $actionLabel }}
                                    </span>
                                </div>
                                @if($log->catatan)
                                <div style="margin-top:12px; padding:12px; background:white; border-radius:8px; border:1px solid var(--border); color:var(--text-main); font-size:13.5px; line-height: 1.5; font-style: italic;">
                                    "{{ $log->catatan }}"
                                </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div style="padding: 20px; color:var(--text-sub);">Belum ada riwayat.</div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</body>
</html>
