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
            overflow: hidden; /* Ensure content stays inside */
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

        /* Filters Bar */
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
        }

        .view-toggles {
            display: flex;
            background: #e2e8f0;
            padding: 4px;
            border-radius: 8px;
        }

        .view-btn {
            padding: 6px 12px;
            border: none;
            background: transparent;
            border-radius: 6px;
            cursor: pointer;
            color: var(--text-sub);
        }

        .view-btn.active {
            background: white;
            color: var(--text-main);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* Document Grid */
        .documents-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 24px;
        }

        .documents-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .doc-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }

        .doc-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .dc-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .dc-cat {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 20px;
            letter-spacing: 0.5px;
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

        .dc-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 48px;
            line-height: 1.5;
        }

        .dc-meta {
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-size: 12px;
            color: var(--text-sub);
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .meta-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dc-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status-pill {
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            border-radius: 6px;
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

        .action-link {
            font-size: 13px;
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .empty-state {
            grid-column: 1 / -1;
            padding: 60px;
            text-align: center;
            color: var(--text-sub);
            background: white;
            border-radius: 12px;
            border: 2px dashed var(--border);
        }
    </style>
</head>

<body>
    <div class="layout-container">
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
                    <input type="text" id="searchInput" placeholder="Cari dokumen, subjek, atau unit kerja..."
                        onkeyup="renderDocuments()">
                </div>
                <div class="filter-group">
                    <select class="filter-select" id="statusFilter" onchange="renderDocuments()">
                        <option value="All">Semua Status</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Revisi">Revisi</option>
                    </select>
                </div>
            </div>

            <div class="documents-grid" id="docList">
                <!-- Populated by JS -->
            </div>
        </main>
    </div>

    <!-- Data from Controller -->
    <script>
        const documentsData = @json($documentsData);

        function initStats() {
            const pending = documentsData.filter(d => d.status === 'Menunggu').length;
            const approved = documentsData.filter(d => ['Disetujui', 'Approved'].includes(d.status)).length;
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
            const container = document.getElementById('docList');

            container.innerHTML = '';

            const filtered = documentsData.filter(doc => {
                const matchSearch = doc.title.toLowerCase().includes(search) ||
                    doc.unit.toLowerCase().includes(search) ||
                    doc.submitter.toLowerCase().includes(search);

                const matchStatus = statusFilter === 'All' || doc.status === statusFilter;

                return matchSearch && matchStatus;
            });

            if (filtered.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <div style="font-size:48px; margin-bottom:16px; opacity:0.3;"><i class="fas fa-search"></i></div>
                        <h3>Tidak ada dokumen ditemukan</h3>
                        <p>Cobalah kata kunci lain atau ubah filter status.</p>
                    </div>`;
                return;
            }

            filtered.forEach(doc => {
                // Determine Status Color
                let statusClass = 'status-pending';
                let statusIcon = '<i class="fas fa-clock"></i>';

                if (doc.status === 'Disetujui' || doc.status === 'Approved') {
                    statusClass = 'status-approved';
                    statusIcon = '<i class="fas fa-check-circle"></i>';
                } else if (doc.status === 'Revisi') {
                    statusClass = 'status-revision';
                    statusIcon = '<i class="fas fa-undo"></i>';
                }

                // Determine Category Color
                let catClass = 'cat-k3';
                if (doc.category === 'KO') catClass = 'cat-ko';
                else if (doc.category === 'Lingkungan') catClass = 'cat-lingkungan';
                else if (doc.category === 'Keamanan') catClass = 'cat-keamanan';

                const html = `
                    <a href="${doc.viewUrl}" class="doc-card">
                        <div class="dc-top">
                            <span class="dc-cat ${catClass}">${doc.category}</span>
                            <span style="font-size:11px; color:var(--text-sub);">${doc.date_submit}</span>
                        </div>
                        <div class="dc-title">${doc.title}</div>
                        <div class="dc-meta">
                            <div class="meta-row"><i class="fas fa-building" style="width:16px;"></i> ${doc.unit}</div>
                            <div class="meta-row"><i class="fas fa-user" style="width:16px;"></i> ${doc.submitter}</div>
                        </div>
                        <div class="dc-footer">
                            <div class="status-pill ${statusClass}">${statusIcon} ${doc.status}</div>
                            <div class="action-link">Review <i class="fas fa-arrow-right"></i></div>
                        </div>
                    </a>
                `;
                container.insertAdjacentHTML('beforeend', html);
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