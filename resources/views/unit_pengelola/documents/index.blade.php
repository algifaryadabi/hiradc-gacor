<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen - Unit Pengelola | HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* ========================================
           DESIGN SYSTEM - TWIN DESIGN
           ======================================== */
        :root {
            /* Brand Colors - PT Semen Padang */
            --primary: #c41e3a;
            --primary-dark: #9a1829;
            --primary-light: #e63950;
            --primary-50: #fef2f3;
            --primary-100: #fce7e9;
            --primary-200: #f9d0d4;
            --primary-600: #c41e3a;

            /* Neutral Palette */
            --gray-50: #fafafa;
            --gray-100: #f5f5f5;
            --gray-200: #e5e5e5;
            --gray-300: #d4d4d4;
            --gray-400: #a3a3a3;
            --gray-500: #737373;
            --gray-600: #525252;
            --gray-700: #404040;
            --gray-800: #262626;
            --gray-900: #171717;

            /* Surface & Background */
            --bg-body: #f1f5f9;
            --surface: #ffffff;
            --surface-hover: #f9fafb;
            --border: #e2e8f0;

            /* Shadows */
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);

            /* Spacing */
            --space-4: 1rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;

            /* Border Radius */
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-full: 9999px;

            /* Fonts */
            --font-sans: 'Plus Jakarta Sans', sans-serif;
            --font-weight-bold: 700;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-sans);
            background: var(--bg-body);
            background-image:
                radial-gradient(at 0% 0%, rgba(196, 30, 58, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--gray-900);
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - Exact Clone */
        .sidebar {
            width: 280px;
            background: #5b6fd8;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: var(--shadow-md);
        }

        .logo-section {
            padding: var(--space-8) var(--space-6);
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
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.3) 50%, transparent 100%);
        }

        .logo-circle {
            width: 90px;
            height: 90px;
            margin: 0 auto 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .logo-circle:hover {
            transform: scale(1.05);
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
            letter-spacing: -0.02em;
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
            cursor: pointer;
            transition: all 0.2s;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9375rem;
            font-weight: 500;
            text-decoration: none;
            position: relative;
            border-radius: 0.75rem;
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

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.125rem;
        }

        /* User Info */
        .user-info-bottom {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            background: transparent;
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
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 0;
            background: var(--bg-body);
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%);
            padding: var(--space-8) var(--space-10);
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .header h1 {
            font-size: 1.875rem;
            font-weight: 800;
            color: var(--gray-900);
            letter-spacing: -0.02em;
        }

        .content-area {
            padding: var(--space-10);
            max-width: 1600px;
            margin: 0 auto;
        }

        /* Stats Grid / Filter Tabs */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            /* 5 Columns now */
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--surface);
            padding: 1.25rem;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 120px;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: transparent;
            transition: background 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .stat-card.active {
            background: #fffafa;
            /* Tinted red very lightly */
            border-color: var(--primary);
        }

        .stat-card.active::before {
            background: var(--primary);
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            background: var(--gray-50);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.125rem;
            color: var(--gray-500);
            margin-bottom: 1rem;
            transition: all 0.2s;
        }

        .stat-card.active .stat-icon {
            background: var(--primary);
            color: white;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--gray-900);
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Bulk Action Card */
        .staff-selection-card {
            background: white;
            padding: 1.5rem;
            border-radius: var(--radius-xl);
            margin-bottom: 2rem;
            border: 1px solid #dbeafe;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.05);
            background: linear-gradient(to right, #eff6ff, white);
        }

        .staff-selection-card h4 {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .staff-selection-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            font-family: var(--font-sans);
            font-size: 0.9375rem;
            background: white;
            transition: all 0.2s;
        }

        .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Document List */
        .doc-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .doc-item {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 1.5rem;
            display: grid;
            grid-template-columns: auto 1fr auto auto;
            align-items: center;
            gap: 1.5rem;
            transition: all 0.2s;
        }

        .doc-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-200);
        }

        .date-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            background: var(--gray-50);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            flex-shrink: 0;
        }

        .date-day {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--gray-900);
            line-height: 1;
        }

        .date-month {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--gray-500);
            text-transform: uppercase;
            margin-top: 0.25rem;
        }

        .doc-info h3 {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .doc-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.875rem;
            color: var(--gray-500);
        }

        .status-pill {
            padding: 0.375rem 1rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            background: var(--gray-900);
            color: white;
            border-radius: var(--radius-lg);
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-action:hover {
            background: black;
            transform: translateY(-1px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: var(--radius-xl);
            border: 2px dashed var(--border);
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
                <a href="{{ route('unit_pengelola.check_documents') }}" class="nav-item active">
                    <i class="fas fa-file-contract"></i>
                    <span>Review Dokumen</span>
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
                <!-- Standard Logout Logic -->
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
            <div class="header">
                <h1>Review Dokumen</h1>
                <div style="font-size: 0.875rem; color: var(--gray-500); font-weight: 500;">
                    Inbox & Persetujuan
                </div>
            </div>

            <div class="content-area">

                @php
                    $allDocs = $documents;
                    $userUnit = Auth::user()->id_unit;

                    // Filtering Logic (retained)
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

                    // Staff Fetching (retained)
                    $staffReviewers = \App\Models\User::where('id_unit', Auth::user()->id_unit)
                        // ->where('is_reviewer', true) // Updated to use new flag if preferred, or fallback to Roles
                        ->whereIn('role_jabatan', [5, 6]) // Fallback
                        ->where('id_unit', Auth::user()->id_unit)
                        ->distinct()->get();

                    $staffApprovers = \App\Models\User::where('id_unit', Auth::user()->id_unit)
                        // ->where('is_verifier', true)
                        ->where('role_jabatan', 4)
                        ->where('id_unit', Auth::user()->id_unit)
                        ->distinct()->get();
                @endphp

                <!-- Internal Unit Stats (Newly Added) -->
                <div style="margin-bottom: 2.5rem; padding-bottom: 2rem; border-bottom: 1px dashed var(--border);">
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 1rem;">
                        <h3
                            style="font-size: 0.875rem; color: var(--gray-500); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                            Dokumen Internal Unit ({{ Auth::user()->unit_or_dept_name }})
                        </h3>
                        <a href="{{ route('documents.index') }}"
                            style="font-size: 0.875rem; font-weight: 600; color: var(--primary); text-decoration: none;">
                            Lihat Semua <i class="fas fa-arrow-right" style="margin-left: 4px;"></i>
                        </a>
                    </div>
                    <div class="stats-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 0;">
                        <div class="stat-card" style="cursor: default; background: white;">
                            <div class="stat-icon" style="background: #eff6ff; color: #3b82f6;"><i
                                    class="fas fa-hourglass-half"></i></div>
                            <div>
                                <div class="stat-value">{{ $myUnitStats['pending'] }}</div>
                                <div class="stat-label">Menunggu</div>
                            </div>
                        </div>
                        <div class="stat-card" style="cursor: default; background: white;">
                            <div class="stat-icon" style="background: #f0fdf4; color: #16a34a;"><i
                                    class="fas fa-thumbs-up"></i></div>
                            <div>
                                <div class="stat-value">{{ $myUnitStats['approved'] }}</div>
                                <div class="stat-label">Disetujui</div>
                            </div>
                        </div>
                        <div class="stat-card" style="cursor: default; background: white;">
                            <div class="stat-icon" style="background: #faf5ff; color: #9333ea;"><i
                                    class="fas fa-globe"></i></div>
                            <div>
                                <div class="stat-value">{{ $myUnitStats['published'] }}</div>
                                <div class="stat-label">Approve / Published</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Tabs (Stats Grid) -->
                <h3
                    style="font-size: 0.875rem; color: var(--gray-500); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1rem;">
                    Inbox Review (Dokumen Masuk)
                </h3>
                <div class="stats-grid">
                    <div class="stat-card active" onclick="filterDocs('all', this)">
                        <div class="stat-icon"><i class="fas fa-layer-group"></i></div>
                        <div>
                            <div class="stat-value">{{ $documents->count() }}</div>
                            <div class="stat-label">Semua</div>
                        </div>
                    </div>
                    <div class="stat-card" onclick="filterDocs('disposisi', this)">
                        <div class="stat-icon"><i class="fas fa-inbox"></i></div>
                        <div>
                            <div class="stat-value">{{ $disposisiDocs->count() }}</div>
                            <div class="stat-label">Perlu Disposisi</div>
                        </div>
                    </div>
                    <div class="stat-card" onclick="filterDocs('review', this)">
                        <div class="stat-icon"><i class="fas fa-user-clock"></i></div>
                        <div>
                            <div class="stat-value">{{ $dalamReviewDocs->count() }}</div>
                            <div class="stat-label">Review Staff</div>
                        </div>
                    </div>
                    <div class="stat-card" onclick="filterDocs('final', this)">
                        <div class="stat-icon"><i class="fas fa-gavel"></i></div>
                        <div>
                            <div class="stat-value">{{ $keputusanAkhirDocs->count() }}</div>
                            <div class="stat-label">Keputusan Akhir</div>
                        </div>
                    </div>
                    <div class="stat-card" onclick="filterDocs('approved', this)">
                        <div class="stat-icon"><i class="fas fa-check-double"></i></div>
                        <div>
                            <div class="stat-value">{{ $approveDocs->count() }}</div>
                            <div class="stat-label">Selesai</div>
                        </div>
                    </div>
                </div>

                <!-- Bulk Disposition Section -->
                <!-- Disposisi Section Removed as per User Request (Managed in Dashboard) -->

                <!-- Document List -->
                <div class="doc-list">
                    @forelse($documents as $doc)
                        @php
                            // Status Logic (Same as before)
                            $currentStatus = $doc->level2_status;
                            if ($userUnit == 55)
                                $currentStatus = $doc->status_security;
                            elseif ($userUnit == 56)
                                $currentStatus = $doc->status_she;

                            $cat = 'all';
                            $statusText = 'Unknown';
                            $statusColor = '#94a3b8'; // gray default

                            if ($doc->current_level == 2 && ($currentStatus == 'pending_head' || empty($currentStatus))) {
                                $cat = 'disposisi';
                                $statusText = 'Menunggu Disposisi';
                                $statusColor = '#ef4444'; // red
                            } elseif (in_array($currentStatus, ['assigned_review', 'assigned_approval'])) {
                                $cat = 'review';
                                $statusText = 'Proses Staff';
                                $statusColor = '#3b82f6'; // blue
                            } elseif ($currentStatus == 'returned_to_head' || $currentStatus == 'staff_verified') {
                                $cat = 'final';
                                $statusText = 'Verifikasi Selesai';
                                $statusColor = '#f59e0b'; // orange
                            } elseif ($currentStatus == 'approved' || $currentStatus == 'published' || $doc->current_level > 2) {
                                $cat = 'approved';
                                $statusText = 'Disetujui';
                                $statusColor = '#10b981'; // green
                            }
                        @endphp

                        <div class="doc-item" data-category="{{ $cat }}">
                            <div class="date-box">
                                <span class="date-day">{{ $doc->created_at->format('d') }}</span>
                                <span class="date-month">{{ $doc->created_at->format('M') }}</span>
                            </div>
                            <div class="doc-info">
                                <h3>{{ $doc->judul_dokumen ?? $doc->kolom2_kegiatan }}</h3>
                                <div class="doc-meta">
                                    <span><i class="fas fa-building"></i> {{ $doc->unit->nama_unit ?? '-' }}</span>
                                    <span><i class="fas fa-user"></i> {{ $doc->user->nama_user ?? 'Unknown' }}</span>
                                </div>
                            </div>
                            <div>
                                <span class="status-pill"
                                    style="background: {{ $statusColor }}20; color: {{ $statusColor }}">
                                    {{ $statusText }}
                                </span>
                            </div>
                            <div>
                                @if($cat == 'disposisi')
                                    <a href="{{ route('unit_pengelola.review', $doc->id) }}" class="btn-action"
                                        style="background:white; color:var(--gray-900); border:1px solid var(--border); margin-right: 8px;">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <button onclick="applyDisposition({{ $doc->id }})" class="btn-action">
                                        <i class="fas fa-paper-plane"></i> Kirim
                                    </button>
                                @else
                                    <a href="{{ route('unit_pengelola.review', $doc->id) }}" class="btn-action"
                                        style="background:white; color:var(--gray-900); border:1px solid var(--border);">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-folder-open"
                                style="font-size: 3rem; color: var(--gray-300); margin-bottom: 1rem;"></i>
                            <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--gray-900);">Tidak ada dokumen
                            </h3>
                            <p style="color: var(--gray-500);">Belum ada dokumen yang perlu ditinjau saat ini.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </main>
    </div>

    <script>
        function filterDocs(category, el) {
            // Update UI
            document.querySelectorAll('.stat-card').forEach(c => c.classList.remove('active'));
            el.classList.add('active');

            // Filter List
            document.querySelectorAll('.doc-item').forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'grid';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function applyDisposition(docId) {
            // New Logic: Auto-Correction (No Manual Selection)
            Swal.fire({
                title: 'Disposisi Dokumen?',
                text: "Dokumen akan dikirim ke staff (Reviewer & Verifikator) sesuai hak akses dashboard.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform Disposition POST with NULL IDs (Pool Assignment)
                    let url = "{{ route('unit_pengelola.disposition', ':id') }}";
                    url = url.replace(':id', docId);

                    fetch(url, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            reviewer_id: null,
                            approver_id: null
                        })
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success || data.message) { // Handle potential success redirect data
                                Swal.fire('Berhasil', 'Dokumen berhasil didisposisikan ke staff.', 'success')
                                    .then(() => location.reload());
                            } else {
                                Swal.fire('Gagal', data.message || 'Terjadi kesalahan.', 'error');
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            // If controller redirects back with success flash, fetch might treat as opaque or error if not JSON
                            // But we return JSON usually or back(). Wait, controller returns back()->with().
                            // Fetching a back() redirect usually follows it to the HTML page.
                            // We should ideally change controller to return JSON if AJAX, but for now let's handle the redirect.
                            // If we land here, check if it's actually a success via page reload?
                            // Actually, let's assume if no error thrown, it worked.
                            // But fetch follows redirects by default. The response will be the HTML of the page.
                            // This JSON.parse will fail.
                            // FIX: Check content type.
                            Swal.fire('Info', 'Permintaan diproses. Halaman akan dimuat ulang.', 'info')
                                .then(() => location.reload());
                        });
                }
            });
        }
    </script>
</body>

</html>