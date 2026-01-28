<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Form - HIRADC System</title>
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
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
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
            -webkit-font-smoothing: antialiased;
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
            z-index: 100;
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

        /* User Info */
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
            margin-left: 250px;
            padding: 32px 48px;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-header h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.03em;
        }

        .page-header p {
            font-size: 14px;
            color: var(--text-sub);
            margin-top: 4px;
        }

        /* Summary Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }



        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .icon-orange {
            background: #fff7ed;
            color: #ea580c;
        }

        .icon-green {
            background: #f0fdf4;
            color: #16a34a;
        }

        .icon-red {
            background: #fef2f2;
            color: #dc2626;
        }

        .icon-blue {
            background: #eff6ff;
            color: #2563eb;
        }

        .stat-info h3 {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-info p {
            font-size: 13px;
            color: var(--text-sub);
            font-weight: 500;
        }

        /* Filters */
        .filters-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .tabs {
            display: flex;
            gap: 8px;
            background: #e2e8f0;
            padding: 4px;
            border-radius: 12px;
        }

        .tab-btn {
            padding: 8px 20px;
            border-radius: 8px;
            border: none;
            background: transparent;
            color: var(--text-sub);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .tab-btn.active {
            background: white;
            color: var(--text-main);
            box-shadow: var(--shadow-sm);
        }

        .tab-btn:hover:not(.active) {
            color: var(--text-main);
        }

        .category-select {
            padding: 10px 16px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: white;
            color: var(--text-main);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            outline: none;
        }

        /* Document List Grid */
        .doc-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .doc-item {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
            padding: 20px 24px;
            display: grid;
            grid-template-columns: 2fr 1.5fr 1fr 1.2fr 1fr auto;
            align-items: center;
            gap: 20px;
            transition: all 0.2s;
        }

        .doc-item:hover {
            border-color: var(--primary);
            transform: translateX(4px);
            box-shadow: var(--shadow-md);
        }

        .doc-main {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .doc-unit {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-main);
        }

        .doc-dept {
            font-size: 12px;
            color: var(--text-sub);
            background: #f8fafc;
            padding: 2px 6px;
            border-radius: 4px;
            display: inline-block;
            width: fit-content;
        }

        .doc-meta {
            display: flex;
            flex-direction: column;
            font-size: 13px;
        }

        .meta-label {
            font-size: 11px;
            color: var(--text-sub);
            font-weight: 500;
            margin-bottom: 2px;
        }

        .meta-value {
            font-weight: 600;
            color: var(--text-main);
        }

        /* Badges */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-align: center;
            display: inline-block;
        }

        .status-menunggu {
            background: #fff7ed;
            color: #ea580c;
            border: 1px solid #ffedd5;
        }

        .status-disetujui {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #dcfce7;
        }

        .status-revisi {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fee2e2;
        }

        .status-diproses {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid var(--border);
            color: var(--text-sub);
            transition: 0.2s;
            text-decoration: none;
        }

        .btn-action:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .empty-state {
            text-align: center;
            padding: 60px;
            background: white;
            border-radius: 16px;
            border: 1px dashed var(--border);
        }

        .empty-icon {
            font-size: 48px;
            color: #cbd5e1;
            margin-bottom: 16px;
        }

        .empty-text {
            font-size: 14px;
            color: var(--text-sub);
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        @include('approver.partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h1>Review Form Masuk</h1>
                    <p>Kelola persetujuan form HIRADC dari unit kerja Anda.</p>
                </div>

                <!-- NEW: Staff Delegation Dropdown (Only for Kepala Unit - role_jabatan = 3) -->
                @if(Auth::user()->role_jabatan == 3 && isset($staffList) && $staffList->count() > 0)
                    <div style="min-width: 300px;">
                        <label
                            style="display: block; font-size: 12px; color: var(--text-sub); margin-bottom: 8px; font-weight: 600;">
                            <i class="fas fa-user-tag"></i> Delegasikan ke Staff <span
                                style="color: var(--primary);">*</span>
                        </label>
                        <select id="assignStaffDropdown" class="category-select" style="width: 100%;"
                            onchange="assignStaff(this.value)">
                            <option value="">-- Pilih Staff --</option>
                            @foreach($staffList as $staff)
                                <option value="{{ $staff->id_user }}">
                                    {{ $staff->nama_user }}
                                    ({{ $staff->role_jabatan == 4 ? 'Manager' : ($staff->role_jabatan == 5 ? 'Supervisor' : 'Associate') }})
                                </option>
                            @endforeach
                        </select>
                        <small style="display: block; margin-top: 4px; font-size: 11px; color: var(--text-sub);">
                            <i class="fas fa-info-circle"></i> Pilih staff yang bertanggung jawab untuk form
                        </small>
                    </div>
                @endif
            </div>

            <!-- Stats Grid -->
            <!-- Stats Grid -->
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon icon-orange"><i class="fas fa-hourglass-half"></i></div>
                    <div class="stat-info">
                        <h3 id="count-waiting">0</h3>
                        <p>Menunggu Review</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-green"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-info">
                        <h3 id="count-approved">0</h3>
                        <p>Telah Disetujui</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-red"><i class="fas fa-undo-alt"></i></div>
                    <div class="stat-info">
                        <h3 id="count-revision">0</h3>
                        <p>Perlu Revisi</p>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-bar">
                <div class="tabs">
                    <button class="tab-btn active" onclick="filterData('Semua', this)">Semua</button>
                    <button class="tab-btn" onclick="filterData('Menunggu', this)">Menunggu</button>
                    <button class="tab-btn" onclick="filterData('Disetujui', this)">Disetujui</button>
                    <button class="tab-btn" onclick="filterData('Revisi', this)">Revisi</button>
                </div>
            </div>

            <!-- Document List -->
            <div id="documentList" class="doc-list">
                <!-- Javascript will populate this -->
            </div>

        </main>
    </div>

    <script>
        const documents = @json($documentsData);
        let activeStatusFilter = 'Semua';

        function renderDocumentList() {
            const container = document.getElementById('documentList');
            let filtered = documents;

            console.log('Rendering list. Filter:', activeStatusFilter);
            console.log('Total documents:', documents.length);

            // Filter logic
            if (activeStatusFilter !== 'Semua') {
                if (activeStatusFilter === 'Menunggu') {
                    filtered = documents.filter(d => d.status.includes('Menunggu'));
                } else if (activeStatusFilter === 'Disetujui') {
                    filtered = documents.filter(d => d.status === 'Disetujui');
                } else if (activeStatusFilter === 'Revisi') {
                    filtered = documents.filter(d => d.status === 'Revisi');
                }
            }

            console.log('Filtered count:', filtered.length);

            let html = '';
            if (filtered.length === 0) {
                html = `
                    <div class="empty-state">
                        <div class="empty-icon"><i class="far fa-folder-open"></i></div>
                        <div class="empty-text">Tidak ada form yang ditemukan untuk filter ini.</div>
                        <div style="font-size:12px; color:#94a3b8; margin-top:8px;">Total Data: ${documents.length}, Filter: ${activeStatusFilter}</div>
                    </div>
                `;
            } else {
                filtered.forEach(doc => {
                    let btnIcon = 'fa-eye';
                    let tooltip = 'Lihat Detail';
                    if (doc.status.includes('Menunggu')) {
                        btnIcon = 'fa-pen-fancy';
                        tooltip = 'Review Sekarang';
                    }

                    // Badge Color Determination
                    let badgeClass = 'status-menunggu'; // Default orange
                    if (doc.status === 'Disetujui') badgeClass = 'status-disetujui'; // Green
                    if (doc.status === 'Revisi') badgeClass = 'status-revisi'; // Red
                    if (doc.status.includes('Final')) badgeClass = 'status-diproses'; // Blue/Process

                    html += `
                    <div class="doc-item">
                        <div class="doc-main">
                            <div class="doc-unit">${doc.unit}</div>
                            <div class="doc-dept"><i class="fas fa-building" style="margin-right:4px;"></i>${doc.department}</div>
                            <div style="font-size:15px; font-weight:700; color:#334155; margin-top:4px;">${doc.title}</div>
                        </div>
                        
                        <div class="doc-meta">
                            <div class="meta-label">Submitter</div>
                            <div class="meta-value"><i class="far fa-user" style="margin-right:4px; color:#94a3b8;"></i>${doc.submitter}</div>
                        </div>

                        <div class="doc-meta">
                            <div class="meta-label">Waktu Submit</div>
                            <div class="meta-value">${doc.date_submit}</div>
                            <div style="font-size:11px; color:#64748b;">${doc.time_submit}</div>
                        </div>

                        <div class="status-badge ${badgeClass}">
                            ${doc.status}
                        </div>

                        <a href="${doc.viewUrl}" class="btn-action" title="${tooltip}">
                            <i class="fas ${btnIcon}"></i>
                        </a>
                    </div>
                    `;
                });
            }
            container.innerHTML = html;
        }

        function filterData(status, btn) {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            activeStatusFilter = status;
            renderDocumentList();
        }

        function updateCounts() {
            const waiting = documents.filter(d => d.status.includes('Menunggu')).length;
            const approved = documents.filter(d => d.status === 'Disetujui').length;
            const revision = documents.filter(d => d.status === 'Revisi').length;

            document.getElementById('count-waiting').textContent = waiting;
            document.getElementById('count-approved').textContent = approved;
            document.getElementById('count-revision').textContent = revision;
        }

        // Initialize
        updateCounts();
        renderDocumentList();
    </script>
    <!-- Flash Messages (SweetAlert) -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK',
                confirmButtonColor: '#c41e3a'
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}",
                confirmButtonText: 'OK',
                confirmButtonColor: '#c41e3a'
            });
        </script>
    @endif

</body>

</html>