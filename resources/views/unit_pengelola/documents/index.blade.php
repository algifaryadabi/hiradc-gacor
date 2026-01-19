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

        /* Category Filter Cards */
        .category-filters {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
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
                $disposisiDocs = $documents->filter(fn($d) => $d->current_level == 2 && $d->status == 'pending_level2' && is_null($d->level2_status));
                $dalamReviewDocs = $documents->filter(fn($d) => in_array($d->level2_status, ['assigned_review', 'assigned_approval']));
                $keputusanAkhirDocs = $documents->filter(fn($d) => $d->level2_status == 'returned_to_head' || $d->level2_status == 'staff_verified');
                $approveDocs = $documents->filter(fn($d) => $d->level2_status == 'approved' || ($d->current_level > 2 && $d->status != 'pending_level2'));

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

            <!-- Category Filter Cards -->
            <div class="category-filters">
                <div class="category-card active" onclick="selectCategory('semua', this)">
                    <h3>Semua</h3>
                    <div class="count">{{ $allDocs->count() }}</div>
                </div>
                <div class="category-card" onclick="selectCategory('disposisi', this)">
                    <h3>Disposisi</h3>
                    <div class="count">{{ $disposisiDocs->count() }}</div>
                </div>
                <div class="category-card" onclick="selectCategory('keputusan_akhir', this)">
                    <h3>Keputusan Akhir</h3>
                    <div class="count">{{ $keputusanAkhirDocs->count() }}</div>
                </div>
                <div class="category-card" onclick="selectCategory('approve', this)">
                    <h3>Approve</h3>
                    <div class="count">{{ $approveDocs->count() }}</div>
                </div>
            </div>

            <!-- Staff Assignment Card -->
            <div class="staff-selection-card" id="staffCard" style="display: none;">
                <h4><i class="fas fa-users"></i> Tetapkan Staff untuk Disposisi</h4>
                <form id="staffAssignmentForm">
                    <div class="staff-selection-grid">
                        <div>
                            <label>Staff Reviewer (Band IV/V)</label>
                            <select id="default_reviewer_id" name="reviewer_id">
                                <option value="">-- Pilih Reviewer --</option>
                                @foreach($staffReviewers as $s)
                                    <option value="{{ $s->id_user }}">{{ $s->nama_user }} - {{ $s->role_jabatan_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>Staff Verifikator (Band III)</label>
                            <select id="default_approver_id" name="approver_id">
                                <option value="">-- Pilih Verifikator --</option>
                                @foreach($staffApprovers as $s)
                                    <option value="{{ $s->id_user }}">{{ $s->nama_user }} - {{ $s->role_jabatan_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <p class="staff-info-text">
                        <i class="fas fa-info-circle"></i> Pilih staff terlebih dahulu, kemudian klik "Kirim" pada
                        setiap dokumen untuk mendisposisikan.
                    </p>
                    <div style="margin-top: 15px; text-align: right;">
                        <button type="button" onclick="updateStaffAssignment()"
                            style="padding: 10px 20px; background: #3b82f6; color: white; border: none; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer;">
                            <i class="fas fa-check"></i> Update
                        </button>
                    </div>
                </form>
            </div>

            <!-- Document List Container -->

            <div class="doc-list">
                @forelse($documents as $doc)
                    @php
                        // Determine document category
                        $docCategory = 'semua';
                        if ($doc->current_level == 2 && $doc->status == 'pending_level2' && is_null($doc->level2_status)) {
                            $docCategory = 'disposisi';
                        } elseif (in_array($doc->level2_status, ['assigned_review', 'assigned_approval'])) {
                            $docCategory = 'dalam_review';
                        } elseif ($doc->level2_status == 'returned_to_head' || $doc->level2_status == 'staff_verified') {
                            $docCategory = 'keputusan_akhir';
                        } elseif ($doc->level2_status == 'approved' || ($doc->current_level > 2 && $doc->status != 'pending_level2')) {
                            $docCategory = 'approve';
                        }

                        // Determine status label
                        $statusLabel = 'Menunggu Disposisi';
                        if ($docCategory == 'dalam_review') {
                            $statusLabel = 'Dalam Review';
                        } elseif ($docCategory == 'keputusan_akhir') {
                            $statusLabel = 'Keputusan Akhir';
                        } elseif ($docCategory == 'approve') {
                            $statusLabel = 'Approved';
                        }
                    @endphp

                    <div class="doc-item" data-category="{{ $docCategory }}" data-doc-id="{{ $doc->id }}">
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
                            <span class="badge-status">
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
                                    style="background: #3b82f6; border: none; cursor: pointer;">
                                    <span>Kirim</span>
                                    <i class="fas fa-paper-plane" style="font-size:11px;"></i>
                                </button>
                            @else
                                <a href="{{ route('unit_pengelola.review', $doc->id) }}" class="btn-review">
                                    <span>Tindak Lanjut</span>
                                    <i class="fas fa-arrow-right" style="font-size:11px;"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-clipboard-check empty-icon"></i>
                        <h3 style="font-size:18px; font-weight:600; color:#333; margin-bottom:8px;">Semua Bersih!</h3>
                        <p style="color:#666;">Tidak ada dokumen baru yang perlu didisposisikan saat ini.</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                document.querySelectorAll('.category-card').forEach(card => {
                    card.classList.remove('active');
                });
                element.classList.add('active');


                // Show/hide staff card for Disposisi category
                const staffCard = document.getElementById('staffCard');
                if (category === 'disposisi') {
                    staffCard.style.display = 'block';
                } else {
                    staffCard.style.display = 'none';
                }

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

        // Update staff assignment
        function updateStaffAssignment() {
            const reviewerId = document.getElementById('default_reviewer_id').value;
            const approverId = document.getElementById('default_approver_id').value;

            if (!reviewerId || !approverId) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilihan Tidak Lengkap',
                    text: 'Mohon pilih Staff Reviewer dan Verifikator.',
                    confirmButtonColor: '#3b82f6'
                });
                return;
            }

            // Save to localStorage
            localStorage.setItem('default_reviewer_id', reviewerId);
            localStorage.setItem('default_approver_id', approverId);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Staff default untuk disposisi telah diperbarui.',
                confirmButtonColor: '#3b82f6',
                timer: 2000
            });
        }

        // Send document to staff
        function sendToStaff(documentId) {
            const reviewerId = document.getElementById('default_reviewer_id').value;
            const approverId = document.getElementById('default_approver_id').value;

            if (!reviewerId || !approverId) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Staff Belum Dipilih',
                    text: 'Mohon pilih Staff Reviewer dan Verifikator terlebih dahulu, lalu klik tombol "Update".',
                    confirmButtonColor: '#3b82f6'
                });
                return;
            }

            Swal.fire({
                title: 'Kirim Dokumen?',
                text: 'Dokumen akan dikirim ke staff yang dipilih.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Kirim',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create form and submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/unit-pengelola/documents/' + documentId + '/disposition';

                    // CSRF Token
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);

                    // Reviewer ID
                    const reviewerInput = document.createElement('input');
                    reviewerInput.type = 'hidden';
                    reviewerInput.name = 'reviewer_id';
                    reviewerInput.value = reviewerId;
                    form.appendChild(reviewerInput);

                    // Approver ID
                    const approverInput = document.createElement('input');
                    approverInput.type = 'hidden';
                    approverInput.name = 'approver_id';
                    approverInput.value = approverId;
                    form.appendChild(approverInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Load saved staff assignment on page load
        document.addEventListener('DOMContentLoaded', function () {
            const savedReviewerId = localStorage.getItem('default_reviewer_id');
            const savedApproverId = localStorage.getItem('default_approver_id');

            if (savedReviewerId) {
                document.getElementById('default_reviewer_id').value = savedReviewerId;
            }
            if (savedApproverId) {
                document.getElementById('default_approver_id').value = savedApproverId;
            }

            // Initialize default view (Disposisi)
            const activeCard = document.querySelector('.category-card.active');
            if (activeCard) {
                selectCategory('disposisi', activeCard);
            }
        });
    </script>
</body>

</html>