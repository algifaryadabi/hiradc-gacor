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
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: left;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .category-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 6px;
            background: #e5e7eb;
            transition: background 0.3s;
        }

        .category-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .category-card h3 {
            font-size: 15px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .category-card .count {
            font-size: 32px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1;
        }

        /* Color Variants */
        .card-blue::before {
            background: #3b82f6;
        }

        .card-blue .count {
            color: #3b82f6;
        }

        .card-blue h3 i {
            color: #3b82f6;
        }

        .card-green::before {
            background: #10b981;
        }

        .card-green .count {
            color: #10b981;
        }

        .card-green h3 i {
            color: #10b981;
        }

        .card-blue.active {
            background: #eff6ff;
            border-color: #3b82f6;
        }

        .card-green.active {
            background: #ecfdf5;
            border-color: #10b981;
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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 80px 20px;
            background: white;
            border-radius: 16px;
            border: 2px dashed #cbd5e1;
            margin-top: 20px;
        }

        .empty-state i {
            font-size: 64px;
            color: #cbd5e1;
            margin-bottom: 24px;
        }

        .empty-state h3 {
            font-size: 20px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: #64748b;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Inbox Dokumen Review</h1>
                <p class="page-subtitle">Daftar dokumen yang telah didisposisikan kepada Anda dan perlu tindak lanjut.
                </p>
            </div>

            <!-- Category Filter Cards -->
            @php
                $user = Auth::user();
                // Determine roles based on user attributes or unit
                $isVerifierRole = ($user->is_verifier == 1);
                $isReviewerRole = ($user->is_reviewer == 1);

                // If role flags are not set, fallback to Unit logic?
                // Unit 55 (Security): Role 4 can be Reviewer ot Verify.
                // Unit 56 (SHE): Role 4 can be Reviewer or Verify.
                
                // FORCE HIDE INBOX REVIEW if user is NOT a Reviewer
                // OR if user IS a Verifier and NOT a Reviewer
                $showInboxCard = true;
                
                if ($isVerifierRole && !$isReviewerRole) {
                    $showInboxCard = false;
                }
                
                // Special case: If user has NO role flags but is in Unit 55/56 with Role 4?
                // Assume they are Reviewer by default?
                // Let's stick to the explicit flags for now.
                // If the user says "staf verifikator yang telah di tunjuk", they likely updated the user's role.
            @endphp

            <div class="category-filters" style="grid-template-columns: repeat({{ $showInboxCard ? 4 : 3 }}, 1fr);">
                <!-- Card 1: Inbox (Dari Kepala Unit) -->
                @if($showInboxCard)
                <a href="{{ route('unit_pengelola.staff.index', ['filter' => 'inbox']) }}" 
                   class="category-card card-blue {{ $filter == 'inbox' ? 'active' : '' }}" 
                   style="text-decoration: none;">
                    <div>
                        <h3><i class="fas fa-inbox"></i> Inbox Review <br><small style="font-size:10px; color:#64748b;">(Disposisi Baru)</small></h3>
                        <div class="count">{{ $countInbox }}</div>
                    </div>
                    <i class="fas fa-chevron-right" style="color:#bfdbfe; font-size:20px;"></i>
                </a>
                @endif

                <!-- Card 2: Hasil Verifikasi (Diterima Balik) -->
                <a href="{{ route('unit_pengelola.staff.index', ['filter' => 'returned']) }}" 
                   class="category-card card-blue {{ $filter == 'returned' ? 'active' : '' }}"
                   style="text-decoration: none;">
                    <div>
                        <h3><i class="fas fa-undo"></i> Hasil Verifikasi <br><small style="font-size:10px; color:#64748b;">(Diterima Balik)</small></h3>
                        <div class="count">{{ $countReturned }}</div>
                    </div>
                    <i class="fas fa-chevron-right" style="color:#bfdbfe; font-size:20px;"></i>
                </a>

                <!-- Card 3: Sedang Diverifikasi (Di Staff Verif) -->
                <a href="{{ route('unit_pengelola.staff.index', ['filter' => 'processing']) }}" 
                   class="category-card card-blue {{ $filter == 'processing' ? 'active' : '' }}"
                   style="text-decoration: none;">
                    <div>
                        <h3><i class="fas fa-paper-plane"></i> {{ $showInboxCard ? 'Sedang Di-Verif' : 'Inbox Verifikasi' }} <br><small style="font-size:10px; color:#64748b;">{{ $showInboxCard ? '(Di Staff Verif)' : '(Tugas Anda)' }}</small></h3>
                        <div class="count">{{ $countProcessing }}</div>
                    </div>
                    <i class="fas fa-chevron-right" style="color:#bfdbfe; font-size:20px;"></i>
                </a>

                <!-- Card 4: History -->
                <a href="{{ route('unit_pengelola.staff.index', ['filter' => 'history']) }}" 
                   class="category-card card-green {{ $filter == 'history' ? 'active' : '' }}"
                   style="text-decoration: none;">
                    <div>
                        <h3><i class="fas fa-history"></i> History Review <br><small style="font-size:10px; color:#64748b;">(Selesai)</small></h3>
                        <div class="count">{{ $countHistory }}</div>
                    </div>
                    <i class="fas fa-chevron-right" style="color:#bbf7d0; font-size:20px;"></i>
                </a>
            </div>



            <!-- Document List -->
            <div class="doc-list">
                @forelse($documents as $doc)
                    @php
                        // Simple Status Label based on Filter using Controller data
                        $statusLabel = 'Menunggu Review';
                        $statusClass = 'badge-status'; // default blue
                        $isActionable = false;

                        if($filter == 'inbox') {
                            $statusLabel = 'Menunggu Review';
                            $statusClass = 'badge-status'; 
                            $isActionable = true;
                        } elseif($filter == 'returned') {
                            $statusLabel = 'Hasil Verifikasi (Selesai)';
                            $statusClass = 'badge-status';
                            $isActionable = true;
                        } elseif($filter == 'processing') {
                            $statusLabel = 'Sedang Diverifikasi';
                            $statusClass = 'badge-status';
                            
                            // ACTIONABLE IF VERIFICATOR
                            // If I am a verificator and this doc is 'assigned_approval', I should act.
                            $user = Auth::user();
                            if (!$showInboxCard) { // Proxy for Verificator-only
                                // Check if any category is 'assigned_approval'
                                $cats = !empty($user->assigned_categories) ? (is_string($user->assigned_categories) ? json_decode($user->assigned_categories) : $user->assigned_categories) : [];
                                
                                $isMyTurn = false;
                                if ($user->id_unit == 55 && $doc->status_security == 'assigned_approval') $isMyTurn = true;
                                if ($user->id_unit == 56) {
                                    if (in_array($doc->status_k3, ['assigned_approval']) && (in_array('K3', $cats) || $user->id_user == $doc->k3_verificator_id)) $isMyTurn = true;
                                    if (in_array($doc->status_ko, ['assigned_approval']) && (in_array('KO', $cats) || $user->id_user == $doc->ko_verificator_id)) $isMyTurn = true;
                                    if (in_array($doc->status_lingkungan, ['assigned_approval']) && (in_array('Lingkungan', $cats) || $user->id_user == $doc->lingkungan_verificator_id)) $isMyTurn = true;
                                }

                                if($isMyTurn) {
                                    $isActionable = true;
                                    $statusLabel = 'Perlu Verifikasi';
                                }
                            }

                        } elseif($filter == 'history') {
                             $statusLabel = 'Selesai Direview';
                             $statusClass = 'badge-status'; 
                             $isActionable = false;
                        }
                    @endphp

                <div class="doc-item">
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


                            @if($isActionable)
                                <a href="{{ route('unit_pengelola.review', $doc->id) }}" class="btn-review">
                                    <span>{{ $showInboxCard ? 'Review' : 'Verifikasi' }}</span>
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