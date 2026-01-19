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
            border-bottom: 2px solid #e0e0e0;
            text-align: center;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 2px solid #e0e0e0;
        }

        .logo-circle img {
            max-width: 70%;
        }

        .logo-text {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .logo-subtext {
            font-size: 11px;
            color: #999;
            font-weight: 500;
        }

        .nav-menu {
            flex: 1;
            padding: 20px 15px;
            overflow-y: auto;
        }

        .nav-item {
            padding: 12px 15px;
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
            margin-bottom: 5px;
        }

        .nav-item:hover,
        .nav-item.active {
            background: #fff1f2;
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
            margin-left: 250px;
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
                        class="fas fa-file-signature"></i><span>Inbox Dokumen</span></a>
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
                $reviewDocs = $documents->filter(fn($d) => $d->level2_status == 'assigned_review');
                $keputusanAkhirDocs = $documents->filter(fn($d) => $d->level2_status == 'assigned_approval');
                $approveDocs = $documents->filter(fn($d) => $d->level2_status == 'approved' || ($d->current_level > 2 && $d->status != 'pending_level2'));
            @endphp

            <!-- Category Filter Cards -->
            <div class="category-filters">
                @if(in_array(Auth::user()->role_jabatan, [5, 6]))
                    <!-- Review category only for Staff Reviewer (Band IV/V) -->
                    <div class="category-card active" onclick="selectCategory('review', this)">
                        <h3>Review</h3>
                        <div class="count">{{ $reviewDocs->count() }}</div>
                    </div>
                @endif

                @if(Auth::user()->role_jabatan == 4)
                    <!-- Keputusan Akhir category only for Staff Verifikator (Band III) -->
                    <div class="category-card active" onclick="selectCategory('keputusan_akhir', this)">
                        <h3>Keputusan Akhir</h3>
                        <div class="count">{{ $keputusanAkhirDocs->count() }}</div>
                    </div>
                @endif
            </div>

            <!-- Document List -->
            <div class="doc-list">
                @forelse($documents as $doc)
                    @php
                        // Determine category
                        $docCategory = 'semua';
                        $statusLabel = 'Menunggu Review';

                        if ($doc->level2_status == 'assigned_review') {
                            $docCategory = 'review';
                            $statusLabel = 'Menunggu Review';
                        } elseif ($doc->level2_status == 'assigned_approval') {
                            $docCategory = 'keputusan_akhir';
                            $statusLabel = 'Sedang Diverifikasi';
                        } elseif ($doc->level2_status == 'returned_to_head') {
                            $docCategory = 'keputusan_akhir';
                            $statusLabel = 'Keputusan Akhir';
                        } elseif ($doc->level2_status == 'approved' || ($doc->current_level > 2 && $doc->status != 'pending_level2')) {
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
        // Category filtering
        function selectCategory(category, element) {
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