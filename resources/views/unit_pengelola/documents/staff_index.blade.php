<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox Dokumen - Staff Unit Pengelola</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        /* Sidebar - Reference Design from Dashboard */
        .sidebar {
            width: 280px;
            background: #5b6fd8;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        .logo-section {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
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
            background: transparent;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
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
            font-size: 1.125rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
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
            scrollbar-width: thin;
            scrollbar-color: #d4d4d4 transparent;
        }

        .nav-item {
            padding: 1rem 1.5rem;
            margin: 0.25rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            text-decoration: none;
            border-radius: 0.75rem;
            transition: all 0.2s;
            font-size: 0.9375rem;
            position: relative;
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
            border-radius: 0 4px 4px 0;
        }

        .nav-item i {
            width: 24px;
            text-align: center;
            font-size: 1.125rem;
        }

        .badge {
            background: white;
            color: #c41e3a;
            font-size: 0.65rem;
            padding: 2px 8px;
            border-radius: 99px;
            font-weight: 700;
            margin-left: auto;
        }

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
            color: #667eea;
            font-weight: 700;
            font-size: 1.125rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.2);
            flex-shrink: 0;
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
            margin-bottom: 2px;
        }

        .user-role {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
        }

        .logout-btn {
            width: 100%;
            padding: 0.75rem;
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
            gap: 8px;
            text-decoration: none;
            backdrop-filter: blur(10px);
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 40px;
            min-height: 100vh;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .page-subtitle {
            font-size: 14px;
            color: var(--text-sub);
        }

        /* Category Filters */
        .category-filters {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .category-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .category-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .category-card.active {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .category-card h3 {
            font-size: 14px;
            font-weight: 600;
            color: #666;
            margin-bottom: 8px;
        }

        .category-card.active h3 {
            color: #3b82f6;
        }

        .category-card .count {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .category-card.active .count {
            color: #3b82f6;
        }

        /* Document List */
        .doc-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .doc-item {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 20px;
            display: grid;
            grid-template-columns: 60px 1fr auto auto;
            gap: 20px;
            align-items: center;
            transition: all 0.2s;
        }

        .doc-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-color: var(--primary);
        }

        .doc-date-box {
            text-align: center;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .doc-day {
            display: block;
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
        }

        .doc-month {
            display: block;
            font-size: 11px;
            color: var(--text-sub);
            text-transform: uppercase;
            margin-top: 4px;
        }

        .doc-info h3 {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .doc-meta {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .meta-pill {
            font-size: 12px;
            color: var(--text-sub);
            background: #f5f5f5;
            padding: 4px 10px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: #e0f2fe;
            color: #0369a1;
        }

        .btn-review {
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-review:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
            border: 2px dashed #e0e0e0;
        }

        .empty-state i {
            font-size: 48px;
            color: #ccc;
            margin-bottom: 15px;
        }

        .empty-state h3 {
            font-size: 18px;
            color: var(--text-sub);
            margin-bottom: 8px;
        }

        .empty-state p {
            color: #999;
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
                <div class="logo-subtext">HIRADC System</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('unit_pengelola.dashboard') }}" class="nav-item"><i
                        class="fas fa-th-large"></i><span>Dashboard</span></a>
                <a href="{{ route('unit_pengelola.staff.index') }}" class="nav-item active"><i
                        class="fas fa-file-contract"></i><span>Review Dokumen</span></a>
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
                <h1 class="page-title">Inbox Dokumen Review</h1>
                <p class="page-subtitle">Daftar dokumen yang telah didisposisikan kepada Anda dan perlu tindak lanjut.
                </p>
            </div>

            @php
                // Categorize documents
                $allDocs = $documents;
                $user = Auth::user();

                // Filter based on unit-specific status
                if ($user->id_unit == 55) {
                    // Security staff
                    $reviewDocs = $documents->filter(fn($d) => $d->status_security == 'assigned_review');
                    $keputusanAkhirDocs = $documents->filter(fn($d) => $d->status_security == 'assigned_approval');
                    $approveDocs = $documents->filter(fn($d) => in_array($d->status_security, ['approved', 'published']) || $d->current_level > 2);
                } elseif ($user->id_unit == 56) {
                    // SHE staff
                    $reviewDocs = $documents->filter(fn($d) => $d->status_she == 'assigned_review');
                    $keputusanAkhirDocs = $documents->filter(fn($d) => $d->status_she == 'assigned_approval');
                    $approveDocs = $documents->filter(fn($d) => in_array($d->status_she, ['approved', 'published']) || $d->current_level > 2);
                } else {
                    // Fallback to generic level2_status
                    $reviewDocs = $documents->filter(fn($d) => $d->level2_status == 'assigned_review');
                    $keputusanAkhirDocs = $documents->filter(fn($d) => $d->level2_status == 'assigned_approval');
                    $approveDocs = $documents->filter(fn($d) => $d->level2_status == 'approved' || ($d->current_level > 2 && $d->status != 'pending_level2'));
                }

                // Get ALL documents where this staff is assigned as reviewer OR verificator
                // This includes both pending and completed reviews/verifications
                if ($user->id_unit == 55) {
                    // Security staff
                    if ($user->role_jabatan == 4) { // Verifikator
                        $completedReviews = \App\Models\Document::where('security_verificator_id', $user->id_user)
                            ->where('current_level', '>=', 2)
                            ->orderBy('updated_at', 'desc')
                            ->get();
                    } else { // Reviewer
                        $completedReviews = \App\Models\Document::where('security_reviewer_id', $user->id_user)
                            ->where('current_level', '>=', 2)
                            ->orderBy('updated_at', 'desc')
                            ->get();
                    }

                } elseif ($user->id_unit == 56) {
                    // SHE staff
                    if ($user->role_jabatan == 4) { // Verifikator
                        $completedReviews = \App\Models\Document::where('she_verificator_id', $user->id_user)
                            ->where('current_level', '>=', 2)
                            ->orderBy('updated_at', 'desc')
                            ->get();
                    } else { // Reviewer
                        $completedReviews = \App\Models\Document::where('she_reviewer_id', $user->id_user)
                            ->where('current_level', '>=', 2)
                            ->orderBy('updated_at', 'desc')
                            ->get();
                    }
                } else {
                    $completedReviews = collect(); // Empty collection for other roles
                }

                // Separate into completed (not pending) for history display
                $historyReviews = $completedReviews->filter(function ($d) use ($user) {
                    if ($user->id_unit == 55) {
                        // For Verifikator: Check if approved/returned (not assigned_approval)
                        // For Reviewer: Check if passed review (not assigned_review)
                        if ($user->role_jabatan == 4) {
                            return $d->status_security != 'assigned_approval' && !empty($d->status_security) && $d->status_security != 'assigned_review';
                            // Logic: If status is 'assigned_review', it's active for reviewer, effectively 'past' for verificator? No.
                            // Verificator acts AFTER reviewer.
                            // If status is 'assigned_approval', it's PENDING for verificator.
                            // If status is 'staff_verified', 'returned_to_head', 'approved' -> COMPLETED by verificator.
                        } else {
                            return $d->status_security != 'assigned_review' && !empty($d->status_security);
                        }
                    } elseif ($user->id_unit == 56) {
                        if ($user->role_jabatan == 4) {
                            // Verifikator Logic
                            return $d->status_she != 'assigned_approval' && !empty($d->status_she) && $d->status_she != 'assigned_review';
                        } else {
                            return $d->status_she != 'assigned_review' && !empty($d->status_she);
                        }
                    }
                    return false;
                });
            @endphp

            <!-- Category Filter Cards -->
            <div class="category-filters">
                @if(in_array(Auth::user()->role_jabatan, [5, 6]))
                    <!-- Review category only for Staff Reviewer (Band IV/V) -->
                    <div class="category-card active" onclick="showMainDocList(); selectCategory('review', this)">
                        <h3>Review</h3>
                        <div class="count">{{ $reviewDocs->count() }}</div>
                    </div>

                    <!-- History Review Card -->
                    <div class="category-card" onclick="toggleHistoryCard()" style="border-color:#10b981; cursor:pointer;">
                        <h3 style="color:#10b981;"><i class="fas fa-history"></i> History Review</h3>
                        <div class="count" style="color:#10b981;">{{ $historyReviews->count() }}</div>
                    </div>
                @endif

                @if(Auth::user()->role_jabatan == 4)
                    <!-- Keputusan Akhir category only for Staff Verifikator (Band III) -->
                    <div class="category-card active" onclick="selectCategory('keputusan_akhir', this)">
                        <h3>Keputusan Akhir</h3>
                        <div class="count">{{ $keputusanAkhirDocs->count() }}</div>
                    </div>

                    <!-- History Review Card for Verifikator -->
                    <div class="category-card" onclick="toggleHistoryCard()" style="border-color:#10b981; cursor:pointer;">
                        <h3 style="color:#10b981;"><i class="fas fa-history"></i> History Verifikator</h3>
                        <div class="count" style="color:#10b981;">{{ $historyReviews->count() }}</div>
                    </div>
                @endif
            </div>

            <!-- History Review Expandable Section -->
            <div id="historyReviewSection" style="display:none; margin-bottom:30px;">
                <div style="background:white; border-radius:12px; padding:25px; border:2px solid #10b981;">
                    <div style="margin-bottom:20px;">
                        <h2 style="font-size:18px; font-weight:700; color:#10b981; margin:0;">
                            <i class="fas fa-history"></i>
                            @if(Auth::user()->role_jabatan == 4)
                                Riwayat Verifikasi
                            @else
                                Riwayat Review Dokumen
                            @endif
                        </h2>
                    </div>


                    @if($historyReviews->count() > 0)
                        <div style="display:flex; flex-direction:column; gap:12px;">
                            @foreach($historyReviews as $doc)
                                <div
                                    style="background:#f8f9fa; padding:15px; border-radius:8px; display:grid; grid-template-columns:60px 1fr auto; gap:15px; align-items:center;">
                                    <!-- Date -->
                                    <div style="text-align:center; padding:8px; background:white; border-radius:6px;">
                                        <div style="font-size:18px; font-weight:700; color:#10b981; line-height:1;">
                                            {{ $doc->updated_at->format('d') }}
                                        </div>
                                        <div style="font-size:10px; color:#666; text-transform:uppercase;">
                                            {{ $doc->updated_at->format('M Y') }}
                                        </div>
                                    </div>

                                    <!-- Info -->
                                    <div>
                                        <h4 style="font-size:14px; font-weight:600; color:#333; margin-bottom:5px;">
                                            {{ $doc->judul_dokumen ?? $doc->kolom2_kegiatan }}
                                        </h4>
                                        <div style="display:flex; gap:10px; flex-wrap:wrap;">
                                            <span
                                                style="font-size:11px; color:#666; background:#e5e7eb; padding:3px 8px; border-radius:12px;">
                                                <i class="fas fa-building"></i> {{ $doc->unit->nama_unit ?? '-' }}
                                            </span>
                                            <span
                                                style="font-size:11px; color:#059669; background:#d1fae5; padding:3px 8px; border-radius:12px; font-weight:600;">
                                                <i class="fas fa-check-circle"></i>
                                                @if(Auth::user()->role_jabatan == 4)
                                                    Selesai Diverifikasi
                                                @else
                                                    Selesai Direview
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Action -->
                                    <a href="{{ route('unit_pengelola.review', $doc->id) }}"
                                        style="padding:8px 16px; background:#10b981; color:white; border-radius:6px; font-weight:600; font-size:12px; text-decoration:none; display:flex; align-items:center; gap:6px;">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="text-align:center; padding:40px; color:#999;">
                            <i class="fas fa-inbox" style="font-size:40px; margin-bottom:10px; display:block;"></i>
                            <p>Belum ada riwayat review.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Document List -->
            <div class="doc-list">
                @forelse($documents as $doc)
                    @php
                        // Determine category based on unit-specific status
                        $docCategory = 'semua';
                        $statusLabel = 'Menunggu Review';

                        // Get unit-specific status
                        $currentStatus = $doc->level2_status; // Default
                        if ($user->id_unit == 55) {
                            $currentStatus = $doc->status_security;
                        } elseif ($user->id_unit == 56) {
                            $currentStatus = $doc->status_she;
                        }

                        if ($currentStatus == 'assigned_review') {
                            $docCategory = 'review';
                            $statusLabel = 'Menunggu Review';
                        } elseif ($currentStatus == 'assigned_approval') {
                            $docCategory = 'keputusan_akhir';
                            $statusLabel = 'Sedang Diverifikasi';
                        } elseif ($currentStatus == 'returned_to_head' || $currentStatus == 'staff_verified') {
                            $docCategory = 'keputusan_akhir';
                            $statusLabel = 'Keputusan Akhir';
                        } elseif ($currentStatus == 'approved' || $currentStatus == 'published' || $doc->current_level > 2) {
                            $docCategory = 'approve';
                            $statusLabel = 'Approved';
                        }
                    @endphp

                    <div class="doc-item" data-category="{{ $docCategory }}">
                        <!-- Date -->
                        <div class="doc-date-box">
                            <span class="doc-day">{{ $doc->created_at->format('d') }}</span>
                            <span class="doc-month">{{ $doc->created_at->format('M Y') }}</span>
                        </div>

                        <!-- Info -->
                        <div class="doc-info">
                            <h3>{{ $doc->judul_dokumen ?? $doc->kolom2_kegiatan }}</h3>
                            <div class="doc-meta">
                                <span class="meta-pill"><i class="fas fa-building"></i>
                                    {{ $doc->unit->nama_unit ?? '-' }}</span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <span class="badge-status">
                                {{ $statusLabel }}
                            </span>
                        </div>

                        <!-- Action -->
                        <div>
                            @if($docCategory == 'review')
                                <a href="{{ route('unit_pengelola.review', $doc->id) }}" class="btn-review">
                                    <span>Review</span>
                                    <i class="fas fa-edit" style="font-size:11px;"></i>
                                </a>
                            @else
                                <a href="{{ route('unit_pengelola.review', $doc->id) }}" class="btn-review"
                                    style="background: #6b7280;">
                                    <span>Lihat</span>
                                    <i class="fas fa-eye" style="font-size:11px;"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>Tidak Ada Dokumen</h3>
                        <p>Tidak ada dokumen yang perlu direview saat ini.</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>

    <script>
        // Toggle History Review Section
        function toggleHistoryCard() {
            console.log('toggleHistoryCard called');
            const historySection = document.getElementById('historyReviewSection');
            const mainDocList = document.querySelector('.doc-list');
            console.log('historySection:', historySection);
            console.log('mainDocList:', mainDocList);

            if (!historySection) {
                console.error('History section not found!');
                alert('Error: History section tidak ditemukan. Silakan refresh halaman.');
                return;
            }

            if (historySection.style.display === 'none' || historySection.style.display === '') {
                // Show history, hide main list
                historySection.style.display = 'block';
                if (mainDocList) mainDocList.style.display = 'none';
                console.log('Showing history section, hiding main doc list');
                // Scroll to history section
                setTimeout(() => {
                    historySection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
            } else {
                // Hide history, show main list
                historySection.style.display = 'none';
                if (mainDocList) mainDocList.style.display = 'flex';
                console.log('Hiding history section, showing main doc list');
            }
        }

        // Show main document list (hide history)
        function showMainDocList() {
            const historySection = document.getElementById('historyReviewSection');
            const mainDocList = document.querySelector('.doc-list');

            if (historySection) historySection.style.display = 'none';
            if (mainDocList) mainDocList.style.display = 'flex';
        }

        // Category filtering
        function selectCategory(category, element) {
            // Ensure main list is visible (in case History was open)
            showMainDocList();

            // Update active state
            document.querySelectorAll('.category-card').forEach(card => {
                card.classList.remove('active');
            });
            element.classList.add('active');

            // Filter documents
            const allDocs = document.querySelectorAll('.doc-item');
            allDocs.forEach(doc => {
                const docCategory = doc.getAttribute('data-category');
                if (category === 'semua' || docCategory === category) {
                    doc.style.display = 'grid';
                } else {
                    doc.style.display = 'none';
                }
            });

            // Update empty state visibility
            const visibleDocs = Array.from(allDocs).filter(doc => doc.style.display !== 'none');
            const emptyState = document.querySelector('.empty-state');
            if (emptyState) {
                emptyState.style.display = visibleDocs.length === 0 ? 'flex' : 'none';
            }
        }

        // Check for success session
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
            });
        @endif
    </script>
</body>

</html>