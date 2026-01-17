<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Dokumen Unit Pengelola - HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #c41e3a;
            --primary-hover: #a01729;
            --bg-body: #f1f5f9;
            --text-main: #1e293b;
            --text-sub: #64748b;
            --border: #e2e8f0;
            --white: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            padding: 0;
        }

        .layout-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background: var(--white);
            border-right: 1px solid var(--border);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 50;
        }

        .logo-section {
            padding: 24px;
            border-bottom: 1px solid var(--border);
            text-align: center;
        }

        .logo-circle {
            width: 64px;
            height: 64px;
            background: var(--white);
            border-radius: 50%;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .logo-circle img {
            max-width: 65%;
            height: auto;
        }

        .nav-menu {
            flex: 1;
            padding: 24px 16px;
            overflow-y: auto;
        }

        .nav-item {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            color: var(--text-sub);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s;
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
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.85);
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
            margin-left: 260px;
            flex: 1;
            padding: 32px 48px;
        }

        .header-content {
            margin-bottom: 32px;
        }

        .header-content h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .header-content p {
            color: var(--text-sub);
            font-size: 14px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--white);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            transition: 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .sc-pending .stat-icon {
            background: #fff7ed;
            color: #ea580c;
        }

        .sc-approved .stat-icon {
            background: #f0fdf4;
            color: #16a34a;
        }

        .sc-total .stat-icon {
            background: #eff6ff;
            color: #2563eb;
        }

        .stat-val {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
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
            gap: 16px;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
            flex: 1;
            max-width: 400px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            border-radius: 10px;
            border: 1px solid var(--border);
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        .search-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px #fff1f2;
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-sub);
        }

        .filter-group {
            display: flex;
            gap: 10px;
        }

        .filter-select {
            padding: 10px 16px;
            border-radius: 10px;
            border: 1px solid var(--border);
            font-size: 14px;
            outline: none;
            cursor: pointer;
            background: white;
            min-width: 150px;
        }

        /* Excel-like Table Styles */
        .table-container {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .excel-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .excel-table thead th {
            background: #f8fafc;
            color: var(--text-main);
            padding: 16px;
            border-bottom: 1px solid var(--border);
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.05em;
        }

        .excel-table tbody tr {
            transition: background 0.1s;
        }

        .excel-table tbody tr:hover {
            background: #f1f5f9;
        }

        .excel-table tbody td {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            color: var(--text-sub);
            vertical-align: middle;
        }

        .excel-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Badges */
        .cat-badge {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .cat-k3 {
            background: #fee2e2;
            color: #b91c1c;
        }

        .cat-ko {
            background: #ffedd5;
            color: #c2410c;
        }

        .cat-lingkungan {
            background: #dcfce7;
            color: #15803d;
        }

        .cat-keamanan {
            background: #e0f2fe;
            color: #0369a1;
        }

        .status-badge {
            font-size: 11px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .status-pending {
            background: #fff7ed;
            color: #ea580c;
        }

        .status-approved {
            background: #f0fdf4;
            color: #16a34a;
        }

        .status-revision {
            background: #fef2f2;
            color: #dc2626;
        }

        .btn-action {
            text-decoration: none;
            color: var(--primary);
            font-weight: 600;
            font-size: 12px;
            padding: 6px 12px;
            background: #fff1f2;
            border-radius: 6px;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-action:hover {
            background: var(--primary);
            color: white;
        }

        .empty-state {
            padding: 60px;
            text-align: center;
            color: var(--text-sub);
        }
    </style>
</head>

<body>
    <div class="layout-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System (Unit Pengelola)</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('unit_pengelola.dashboard') }}" class="nav-item"><i
                        class="fas fa-th-large"></i><span>Dashboard</span></a>
                <a href="{{ route('unit_pengelola.check_documents') }}" class="nav-item active"><i
                        class="fas fa-file-signature"></i><span>Cek Dokumen</span></a>
            </nav>
            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_user, 0, 2)) }}</div>
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->nama_user }}</div>
                        <div class="user-role">{{ Auth::user()->role_jabatan_name }}</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="fas fa-sign-out-alt"></i> Keluar</a>
                <form id="logout-form" style="display:none;" action="{{ route('logout') }}" method="POST">@csrf</form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header-content">
                <h1>Review & Verifikasi Dokumen</h1>
                <p>Verifikasi dokumen HIRADC yang masuk dari seluruh Unit Kerja.</p>
            </div>

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card sc-pending" onclick="filterByStat('Menunggu')">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <div class="stat-val" id="count-pending">0</div>
                        <div class="stat-label">Menunggu Verifikasi</div>
                    </div>
                </div>
                <div class="stat-card sc-approved" onclick="filterByStat('Disetujui')">
                    <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <div class="stat-val" id="count-approved">0</div>
                        <div class="stat-label">Telah Disetujui</div>
                    </div>
                </div>
                <div class="stat-card sc-total" onclick="filterByStat('Semua')">
                    <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                    <div>
                        <div class="stat-val" id="count-total">0</div>
                        <div class="stat-label">Total Dokumen</div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-bar">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari judul, unit, atau submitter..."
                        onkeyup="renderDocuments()">
                </div>
                <div class="filter-group">
                    <select class="filter-select" id="unitFilter" onchange="renderDocuments()">
                        <option value="All">Semua Unit</option>
                        @foreach($units as $u)
                            <option value="{{ $u->nama_unit }}">{{ $u->nama_unit }}</option>
                        @endforeach
                    </select>
                    <select class="filter-select" id="statusFilter" onchange="renderDocuments()">
                        <option value="All">Semua Status</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Publish">Publish</option>
                        <option value="Revisi">Revisi</option>
                    </select>
                </div>
            </div>

            <!-- Table Container -->
            <div class="table-container">
                <table class="excel-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Judul Kegiatan & Unit</th>
                            <th>Submitter</th>
                            <th>Status</th>
                            <th>Tanggal Submit</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="docList">
                        <!-- Populated by JS -->
                    </tbody>
                </table>
                <div id="emptyState" class="empty-state" style="display: none;">
                    <div style="font-size:48px; margin-bottom:16px; opacity:0.3;"><i class="fas fa-search"></i></div>
                    <h3>Tidak ada dokumen ditemukan</h3>
                    <p>Cobalah kata kunci lain atau ubah filter.</p>
                </div>
            </div>
        </main>
    </div>

    <!-- Data from Controller -->
    <script>
        const documentsData = @json($documentsData);

        function initStats() {
            const pending = documentsData.filter(d => d.status === 'Menunggu').length;
            const approved = documentsData.filter(d => ['Disetujui', 'Approved', 'Publish'].includes(d.status)).length;
            const total = documentsData.length;

            document.getElementById('count-pending').innerText = pending;
            document.getElementById('count-approved').innerText = approved;
            document.getElementById('count-total').innerText = total;
        }

        function filterByStat(status) {
            const filterSelect = document.getElementById('statusFilter');
            if (status === 'Semua') filterSelect.value = 'All';
            else filterSelect.value = status;
            renderDocuments();
        }

        function renderDocuments() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const unitFilter = document.getElementById('unitFilter').value;
            const tbody = document.getElementById('docList');
            const emptyState = document.getElementById('emptyState');

            tbody.innerHTML = '';

            const filtered = documentsData.filter(doc => {
                const matchSearch = (doc.title || '').toLowerCase().includes(search) ||
                    (doc.unit || '').toLowerCase().includes(search) ||
                    (doc.submitter || '').toLowerCase().includes(search);

                const matchStatus = statusFilter === 'All' || doc.status === statusFilter;
                const matchUnit = unitFilter === 'All' || doc.unit === unitFilter;

                return matchSearch && matchStatus && matchUnit;
            });

            if (filtered.length === 0) {
                emptyState.style.display = 'block';
                return;
            } else {
                emptyState.style.display = 'none';
            }

            filtered.forEach((doc, index) => {
                // Determine Status Color
                let statusClass = 'status-pending';
                let statusIcon = '<i class="fas fa-clock"></i>';

                if (doc.status === 'Disetujui' || doc.status === 'Approved' || doc.status === 'Publish') {
                    statusClass = 'status-approved';
                    statusIcon = '<i class="fas fa-check-circle"></i>';
                } else if (doc.status === 'Revisi') {
                    statusClass = 'status-revision';
                    statusIcon = '<i class="fas fa-undo"></i>';
                }



                const html = `
                    <tr>
                        <td style="text-align:center;">${index + 1}</td>
                        <td>
                            <div style="font-weight:600; color:var(--text-main); margin-bottom:2px;">${doc.title}</div>
                            <div style="font-size:12px; color:var(--text-sub);"><i class="fas fa-building" style="margin-right:4px;"></i> ${doc.unit}</div>
                        </td>
                         <td>
                            <div style="font-weight:500;">${doc.submitter}</div>
                            <div style="font-size:11px; color:var(--text-sub);">${doc.department}</div>
                        </td>
                        <td><span class="status-badge ${statusClass}">${statusIcon} ${doc.status}</span></td>
                        <td style="font-size:12px;">${doc.date_submit || '-'}</td>
                        <td style="text-align: right;">
                            <a href="${doc.viewUrl}" class="btn-action">
                                Review <i class="fas fa-arrow-right"></i>
                            </a>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', html);
            });
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            initStats();
            renderDocuments();
        });
    </script>
</body>

</html>