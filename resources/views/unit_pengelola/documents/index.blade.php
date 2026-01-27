<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox Dokumen - Unit Pengelola</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #c41e3a;
            --primary-hover: #a01830;
            --bg-body: #f5f5f5;
            --surface: #ffffff;
            --text-main: #333;
            --text-sub: #666;
            --border: #e0e0e0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
        }

        /* Sidebar - Original Dashboard Style */
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
        .container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 30px 40px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .page-subtitle {
            font-size: 14px;
            color: #666;
        }

        /* Stats Cards - Synced with Dashboard */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card.active {
            border-color: #c41e3a;
            background: #fff5f5;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .stat-info {
            display: flex;
            flex-direction: column;
        }

        .stat-label {
            font-size: 10px;
            color: #888;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 20px;
            font-weight: 700;
            color: #333;
        }

        .icon-blue {
            background: #e3f2fd;
            color: #1976d2;
        }

        .icon-orange {
            background: #fff3e0;
            color: #f57c00;
        }

        .icon-red {
            background: #ffebee;
            color: #d32f2f;
        }

        .icon-green {
            background: #e8f5e9;
            color: #388e3c;
        }

        .icon-purple {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        /* Staff Assignment Card */
        .staff-selection-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 2px dashed #3b82f6;
        }

        .staff-selection-card h4 {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .staff-selection-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .staff-selection-grid label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #666;
            margin-bottom: 6px;
        }

        .staff-selection-grid select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .staff-info-text {
            font-size: 12px;
            color: #666;
            margin-top: 10px;
            font-style: italic;
        }

        /* Modern Document Card List */
        .doc-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .doc-item {
            background: white;
            border-radius: 12px;
            padding: 20px;
            display: grid;
            grid-template-columns: auto 1fr auto auto;
            align-items: center;
            gap: 20px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .doc-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }

        .doc-date-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px;
            background: #f8fafc;
            border-radius: 8px;
            min-width: 60px;
            border: 1px solid #e0e0e0;
        }

        .doc-day {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            line-height: 1;
        }

        .doc-month {
            font-size: 10px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .doc-info {
            min-width: 0;
            /* Prevent overflow */
        }

        .doc-title {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            margin-bottom: 6px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .doc-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .meta-pill {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #666;
            font-weight: 500;
        }

        .badge-status {
            padding: 5px 12px;
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #d1fae5;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }

        .badge-status::before {
            content: '';
            width: 6px;
            height: 6px;
            background: currentColor;
            border-radius: 50%;
        }

        .btn-review {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: white;
            color: #333;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-review:hover {
            background: #333;
            color: white;
            border-color: #333;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background: white;
            border-radius: 12px;
            border: 1px dashed #e0e0e0;
        }

        .empty-icon {
            font-size: 40px;
            color: #cbd5e1;
            margin-bottom: 15px;
        }

        /* Save Preferences Button */
        .btn-save-preferences:hover {
            background: #059669 !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3);
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle">
                    <img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP">
                </div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System</div>
            </div>

            <nav class="nav-menu">
                <a href="{{ route('unit_pengelola.dashboard') }}" class="nav-item">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('unit_pengelola.documents.index') }}" class="nav-item active">
                    <i class="fas fa-file-alt"></i> <!-- Original Icon -->
                    <span>Inbox Dokumen</span>
                </a>
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
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Inbox Disposisi</h1>
                <p class="page-subtitle">Daftar dokumen yang telah disetujui Kepala Unit Kerja dan perlu tindak lanjut.
                </p>
            </div>

            @php
                // Categorize documents
                $allDocs = $documents;
                $userUnit = Auth::user()->id_unit;

                $disposisiDocs = $documents->filter(function ($d) use ($userUnit) {
                    $st = ($userUnit == 55) ? $d->status_security : (($userUnit == 56) ? $d->status_she : $d->level2_status);
                    return $d->current_level == 2 && ($st == 'pending_head' || empty($st));
                });

                $dalamReviewDocs = $documents->filter(function ($d) use ($userUnit) {
                    $st = ($userUnit == 55) ? $d->status_security : (($userUnit == 56) ? $d->status_she : $d->level2_status);
                    return in_array($st, ['assigned_review', 'assigned_approval']);
                });

                $keputusanAkhirDocs = $documents->filter(function ($d) use ($userUnit) {
                    $st = ($userUnit == 55) ? $d->status_security : (($userUnit == 56) ? $d->status_she : $d->level2_status);
                    return $st == 'returned_to_head' || $st == 'staff_verified';
                });

                $approveDocs = $documents->filter(function ($d) use ($userUnit) {
                    $st = ($userUnit == 55) ? $d->status_security : (($userUnit == 56) ? $d->status_she : $d->level2_status);
                    return $st == 'approved' || $st == 'published' || $d->current_level > 2;
                });

                // Get staff for disposition
                // Staff Reviewer: role_jabatan 5 (Band IV) and 6 (Band V)
                $staffReviewers = \App\Models\User::where('id_unit', Auth::user()->id_unit)
                    ->whereIn('role_jabatan', [5, 6])
                    ->get();

                // Staff Verifikator: role_jabatan 4 (Band III)
                $staffApprovers = \App\Models\User::where('id_unit', Auth::user()->id_unit)
                    ->where('role_jabatan', 4)
                    ->get();
            @endphp

            <!-- Stats Summary -->
            <div class="stats-grid">
                <div class="stat-card active" onclick="selectCategory('semua', this)">
                    <div class="stat-icon icon-blue"><i class="fas fa-file-alt"></i></div>
                    <div class="stat-info">
                        <span class="stat-label">Semua</span>
                        <span class="stat-value">{{ $documents->count() }}</span>
                    </div>
                </div>
                <div class="stat-card" onclick="selectCategory('disposisi', this)">
                    <div class="stat-icon icon-red"><i class="fas fa-file-import"></i></div>
                    <div class="stat-info">
                        <span class="stat-label">Disposisi</span>
                        <span class="stat-value">{{ $disposisiDocs->count() }}</span>
                    </div>
                </div>
                <div class="stat-card" onclick="selectCategory('dalam_review_staff', this)">
                    <div class="stat-icon icon-purple"><i class="fas fa-user-clock"></i></div>
                    <div class="stat-info">
                        <span class="stat-label">Diperiksa Staff</span>
                        <span class="stat-value">{{ $dalamReviewDocs->count() }}</span>
                    </div>
                </div>
                <div class="stat-card" onclick="selectCategory('keputusan_akhir', this)">
                    <div class="stat-icon icon-orange"><i class="fas fa-clock"></i></div>
                    <div class="stat-info">
                        <span class="stat-label">Keputusan Akhir</span>
                        <span class="stat-value">{{ $keputusanAkhirDocs->count() }}</span>
                    </div>
                </div>
                <div class="stat-card" onclick="selectCategory('approve', this)">
                    <div class="stat-icon icon-green"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-info">
                        <span class="stat-label">Approve</span>
                        <span class="stat-value">{{ $approveDocs->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Disposition Card (Inline) - Shows when there are pending documents -->
            @if($disposisiDocs->count() > 0)
                <div class="staff-selection-card" style="margin-bottom: 25px;">
                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                        <i class="fas fa-paper-plane" style="color:#3b82f6; font-size:18px;"></i>
                        <h4 style="margin:0; font-size:16px; font-weight:700; color:#333;">Disposisi Dokumen ke Staff</h4>
                    </div>
                    <p style="font-size:13px; color:#666; margin-bottom:20px;">
                        Pilih staff untuk mereview dan memverifikasi dokumen yang masuk. Anda dapat memilih staff yang sama
                        untuk semua dokumen pending.
                    </p>

                    <form id="bulkDispositionForm" method="POST" action="">
                        @csrf
                        <input type="hidden" name="document_ids" id="document_ids" value="">

                        <div class="staff-selection-grid">
                            <div>
                                <label>Staff Reviewer (Band IV/V)</label>
                                <select name="reviewer_id" id="bulk_reviewer_id" required>
                                    <option value="">-- Pilih Reviewer --</option>
                                    @foreach($staffReviewers as $s)
                                        <option value="{{ $s->id_user }}">{{ $s->nama_user }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label>Staff Verifikator (Band III)</label>
                                <select name="approver_id" id="bulk_approver_id" required>
                                    <option value="">-- Pilih Verifikator --</option>
                                    @foreach($staffApprovers as $s)
                                        <option value="{{ $s->id_user }}">{{ $s->nama_user }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div style="margin-top:20px; display:flex; justify-content:space-between; align-items:center;">
                            <span style="font-size:13px; color:#666;">
                                <i class="fas fa-info-circle"></i>
                                Klik tombol "Kirim" pada dokumen untuk mendisposisikan
                            </span>
                            <button type="button" onclick="saveStaffPreferences()" class="btn-save-preferences"
                                style="padding:8px 16px; background:#10b981; color:white; border:none; border-radius:6px; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:6px; transition:all 0.2s;">
                                <i class="fas fa-save"></i>
                                Simpan Pilihan
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- Success Message Container -->
            <div id="saveSuccessMessage"
                style="display:none; margin-bottom:20px; padding:12px 20px; background:#dcfce7; border-left:4px solid #10b981; border-radius:6px; color:#166534; font-size:14px; font-weight:500;">
                <i class="fas fa-check-circle"></i> Pilihan staff berhasil disimpan!
            </div>

            <!-- Document List Container -->

            <div class="doc-list">
                @foreach($documents as $doc)
                    @php
                        // Determine Unit Specific Status
                        $currentStatus = $doc->level2_status; // Default
                        $userUnit = Auth::user()->id_unit;
                        if ($userUnit == 55) {
                            $currentStatus = $doc->status_security;
                        } elseif ($userUnit == 56) {
                            $currentStatus = $doc->status_she;
                        }

                        // Categorize documents using $currentStatus
                        $docCategory = 'semua';

                        // 1. Disposisi (Fresh)
                        if ($doc->current_level == 2 && ($currentStatus == 'pending_head' || empty($currentStatus))) {
                            $docCategory = 'disposisi';
                        }
                        // 2. Dalam Review Staff (Assigned)
                        elseif (in_array($currentStatus, ['assigned_review', 'assigned_approval'])) {
                            $docCategory = 'dalam_review_staff';
                        }
                        // 3. Keputusan Akhir (Verified by Staff)
                        elseif ($currentStatus == 'returned_to_head' || $currentStatus == 'staff_verified') {
                            $docCategory = 'keputusan_akhir';
                        }
                        // 4. Approved (Finalized)
                        elseif ($currentStatus == 'approved' || $doc->current_level > 2) {
                            $docCategory = 'approve';
                        }

                        // Determine status label
                        $statusLabel = 'Menunggu Disposisi';
                        if ($docCategory == 'dalam_review_staff') {
                            $statusLabel = 'Lagi Diperiksa Staff';
                        } elseif ($docCategory == 'keputusan_akhir') {
                            $statusLabel = 'Siap Keputusan Akhir';
                        } elseif ($docCategory == 'approve') {
                            $statusLabel = 'Approved / Published';
                        }
                    @endphp

                    <div class="doc-item" data-category="{{ $docCategory }}" data-doc-id="{{ $doc->id }}"
                        style="display: grid;">
                        <!-- Date Box -->
                        <div class="doc-date-box">
                            <span class="doc-day">{{ $doc->created_at->format('d') }}</span>
                            <span class="doc-month">{{ $doc->created_at->format('M Y') }}</span>
                        </div>

                        <!-- Info -->
                        <div class="doc-info">
                            <h3 class="doc-title">{{ $doc->judul_dokumen ?? $doc->kolom2_kegiatan }}</h3>
                            <div class="doc-meta">
                                <span class="meta-pill"><i class="fas fa-building"></i>
                                    {{ $doc->unit->nama_unit ?? '-' }}</span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <span class="badge-status"
                                style="{{ $docCategory == 'approve' ? 'background:#dcfce7; color:#166534;' : ($docCategory == 'disposisi' ? 'background:#fee2e2; color:#991b1b;' : 'background:#e0f2fe; color:#0369a1;') }}">
                                {{ $statusLabel }}
                            </span>
                        </div>

                        <!-- Action -->
                        <div style="display: flex; gap: 8px;">
                            @if($docCategory == 'disposisi')
                                <a href="{{ route('unit_pengelola.review', $doc->id) }}" class="btn-review"
                                    style="background: #6b7280;">
                                    <span>Tindak Lanjut</span>
                                    <i class="fas fa-eye" style="font-size:11px;"></i>
                                </a>
                                <button onclick="sendToStaff({{ $doc->id }})" class="btn-review"
                                    style="background: #3b82f6; border: none; cursor: pointer; color:white;">
                                    <span>Kirim</span>
                                    <i class="fas fa-paper-plane" style="font-size:11px;"></i>
                                </button>
                            @elseif($docCategory == 'approve')
                                <a href="{{ route('unit_pengelola.review', $doc->id) }}" class="btn-review"
                                    style="background: #10b981; color:white;">
                                    <span>Lihat</span>
                                    <i class="fas fa-eye" style="font-size:11px;"></i>
                                </a>
                            @else
                                <a href="{{ route('unit_pengelola.review', $doc->id) }}" class="btn-review">
                                    <span>Tindak Lanjut</span>
                                    <i class="fas fa-arrow-right" style="font-size:11px;"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach

                <!-- Persistent Empty State (Hidden by default, shown by JS filter) -->
                <div class="empty-state"
                    style="display:none; flex-direction:column; align-items:center; justify-content:center; padding:50px;">
                    <i class="fas fa-filter empty-icon" style="font-size:40px; color:#cbd5e1; margin-bottom:15px;"></i>
                    <h3 style="font-size:18px; font-weight:600; color:#333; margin-bottom:8px;">Tidak ada dokumen di
                        kategori ini</h3>
                    <p style="color:#666;">Silakan pilih kategori lain.</p>
                </div>

                @if($documents->isEmpty())
                    <!-- Initial Empty State if NO docs at all in database for this level -->
                    <div class="initial-empty-state" style="text-align:center; padding:50px;">
                        <i class="fas fa-inbox" style="font-size:40px; color:#cbd5e1; margin-bottom:15px;"></i>
                        <h3>Inbox Kosong</h3>
                        <p>Belum ada dokumen yang perlu diproses.</p>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

    <script>
            // Category filtering
            function selectCategory(category, element) {
                // Update active state
                document.querySelectorAll('.stat-card').forEach(card => {
                    card.classList.remove('active');
                });
                element.classList.add('active');

                // Filter documents
                const allDocs = document.querySelectorAll('.doc-item');
                let count = 0;

                allDocs.forEach(doc => {
                    const docCategory = doc.getAttribute('data-category');
                    if (category === 'semua' || docCategory === category) {
                        doc.style.display = 'grid';
                        count++;
                    } else {
                        doc.style.display = 'none';
                    }
                });

                // Update empty state visibility
                const emptyState = document.querySelector('.empty-state');
                const initialEmpty = document.querySelector('.initial-empty-state');

                // Only show filter empty state if initial empty state is NOT present (meaning we have docs but filtered out)
                if (emptyState && !initialEmpty) {
                    emptyState.style.display = count === 0 ? 'flex' : 'none';
                }
            }

        // --- DISPOSITION INLINE CARD LOGIC ---
        function sendToStaff(documentId) {
            // Get selected staff from the inline form
            const reviewerId = document.getElementById('bulk_reviewer_id').value;
            const approverId = document.getElementById('bulk_approver_id').value;

            if (!reviewerId || !approverId) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Staff',
                    text: 'Silakan pilih Reviewer dan Verifikator terlebih dahulu di form atas.',
                    confirmButtonColor: '#c41e3a'
                });
                return;
            }

            // Create a temporary form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/unit-pengelola/documents/' + documentId + '/disposition';

            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            // Add reviewer_id
            const reviewerInput = document.createElement('input');
            reviewerInput.type = 'hidden';
            reviewerInput.name = 'reviewer_id';
            reviewerInput.value = reviewerId;
            form.appendChild(reviewerInput);

            // Add approver_id
            const approverInput = document.createElement('input');
            approverInput.type = 'hidden';
            approverInput.name = 'approver_id';
            approverInput.value = approverId;
            form.appendChild(approverInput);

            // Save to localStorage for next time
            localStorage.setItem('last_reviewer_id', reviewerId);
            localStorage.setItem('last_approver_id', approverId);

            // Submit form
            document.body.appendChild(form);
            form.submit();
        }

        // Save staff preferences
        function saveStaffPreferences() {
            const reviewerId = document.getElementById('bulk_reviewer_id').value;
            const approverId = document.getElementById('bulk_approver_id').value;

            if (!reviewerId || !approverId) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilihan Belum Lengkap',
                    text: 'Silakan pilih Reviewer dan Verifikator terlebih dahulu.',
                    confirmButtonColor: '#c41e3a'
                });
                return;
            }

            // Save to localStorage
            localStorage.setItem('last_reviewer_id', reviewerId);
            localStorage.setItem('last_approver_id', approverId);

            // Get staff names for display
            const reviewerSelect = document.getElementById('bulk_reviewer_id');
            const approverSelect = document.getElementById('bulk_approver_id');
            const reviewerName = reviewerSelect.options[reviewerSelect.selectedIndex].text;
            const approverName = approverSelect.options[approverSelect.selectedIndex].text;

            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Pilihan Tersimpan!',
                html: `<div style="text-align:left; font-size:14px;">
                    <p><strong>Reviewer:</strong> ${reviewerName}</p>
                    <p><strong>Verifikator:</strong> ${approverName}</p>
                    <p style="margin-top:10px; color:#666;">Pilihan ini akan digunakan untuk disposisi dokumen selanjutnya.</p>
                </div>`,
                confirmButtonColor: '#10b981',
                timer: 3000
            });
        }

        // Load saved staff assignment on page load
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize default view (Semua)
            const activeCard = document.querySelector('.stat-card.active');
            if (activeCard) {
                // Determine category from onclick attribute to match filter behavior
                // onclick="selectCategory('semua', this)"
                const onclickVal = activeCard.getAttribute('onclick');
                const match = onclickVal.match(/'([^']+)'/);
                if (match) {
                    selectCategory(match[1], activeCard);
                } else {
                    selectCategory('semua', activeCard);
                }
            }

            // Load previous staff selections from localStorage
            const savedReviewer = localStorage.getItem('last_reviewer_id');
            const savedApprover = localStorage.getItem('last_approver_id');

            const reviewerSelect = document.getElementById('bulk_reviewer_id');
            const approverSelect = document.getElementById('bulk_approver_id');

            if (savedReviewer && reviewerSelect) {
                reviewerSelect.value = savedReviewer;
            }
            if (savedApprover && approverSelect) {
                approverSelect.value = savedApprover;
            }
        });
    </script>
</body>

</html>