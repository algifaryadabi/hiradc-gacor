<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Dokumen - HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar (Same as Dashboard) */
        .sidebar {
            width: 250px;
            background: white;
            border-right: 1px solid #e0e0e0;
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
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
        .main-content {
            flex: 1;
            margin-left: 250px;
        }

        .header {
            background: white;
            padding: 25px 40px;
            border-bottom: 1px solid #e0e0e0;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .content-area {
            padding: 30px 40px;
        }

        /* Summary Cards */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .summary-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            border: 1px solid #f0f0f0;
        }

        .summary-title {
            font-size: 14px;
            color: #666;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .summary-count {
            font-size: 32px;
            font-weight: 700;
            color: #333;
        }

        /* Create status specific colors for cards if needed, current design is simple white */

        /* Document Table Container */
        .doc-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            align-items: center;
        }

        .tab-btn {
            padding: 10px 25px;
            border-radius: 8px;
            background: #f5f5f5;
            color: #666;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .tab-btn:hover {
            background: #e0e0e0;
        }

        .tab-btn.active {
            background: #d8d8d8;
            color: #333;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Dropdown Filter */
        .category-filter {
            margin-left: auto;
            background: #e0e0e0;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            cursor: pointer;
            color: #333;
            font-weight: 600;
        }

        /* Table Header Red Styling */
        .table-header-red {
            background: #c41e3a;
            color: white;
            padding: 15px 25px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            font-weight: 600;
            font-size: 14px;
        }

        .table-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
            align-items: center;
            font-size: 14px;
            color: #333;
            transition: background 0.2s;
        }

        .table-row:hover {
            background: #f9f9f9;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Status Colors */
        .status-menunggu {
            color: #fd7e14;
            font-weight: 700;
        }

        .status-disetujui {
            color: #28a745;
            font-weight: 700;
        }

        .status-revisi {
            color: #dc3545;
            font-weight: 700;
        }

        .btn-view {
            background: #c41e3a;
            color: white;
            padding: 8px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 12px;
            display: inline-block;
            text-align: center;
        }

        .btn-view:hover {
            background: #a01729;
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
                <div class="logo-subtext">HIRADC System (Head Dept)</div>
            </div>

            <nav class="nav-menu">
                <a href="{{ route('kepala_departemen.dashboard') }}" class="nav-item">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('kepala_departemen.check_documents') }}" class="nav-item active">
                    <i class="fas fa-file-signature"></i>
                    <span>Validasi Dokumen</span>
                </a>

            </nav>

            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">KD</div>
                    <div class="user-details">
                        <div class="user-name">Bpk. Wijaya</div>
                        <div class="user-role">Kepala Departemen</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Validasi Dokumen</h1>
            </div>

            <div class="content-area">

                <!-- Summary Stats -->
                <div class="summary-cards" style="grid-template-columns: repeat(2, 1fr);">
                    <div class="summary-card">
                        <div class="summary-title">Menunggu</div>
                        <div class="summary-count" id="count-waiting">0</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-title">Disetujui</div>
                        <div class="summary-count" id="count-approved">0</div>
                    </div>
                </div>

                <!-- Tabs & Filters -->
                <div class="filter-tabs">
                    <button class="tab-btn active" onclick="filterData('Semua', this)">Semua</button>
                    <button class="tab-btn" onclick="filterData('Menunggu', this)">Menunggu</button>
                    <button class="tab-btn" onclick="filterData('Disetujui', this)">Disetujui</button>

                    <select class="category-filter" id="catFilter" onchange="filterByCategory()">
                        <option value="All">Semua Kategori</option>
                        <option value="K3">K3</option>
                        <option value="KO">KO</option>
                        <option value="Lingkungan">Lingkungan</option>
                        <option value="Keamanan">Pengamanan</option>
                    </select>
                </div>

                <!-- Table Header -->
                <div class="table-header-red">
                    <div>Unit Penginput</div>
                    <div>Kategori</div>
                    <div>Tanggal Submit</div>
                    <div>Status Terakhir</div>
                    <div style="text-align: center;">Aksi</div>
                </div>

                <!-- Table Content -->
                <div id="documentList">
                    <!-- Data will be populated here -->
                </div>

            </div>
        </main>
    </div>

    <script>
        const documents = [
            { id: 1, unit: 'Unit Produksi A', title: 'Penilaian Risiko Unit A', category: 'K3', date: '18-10-2025', status: 'Menunggu' },
            { id: 2, unit: 'Unit Lingkungan', title: 'Laporan Lingkungan B3', category: 'KO', date: '18-10-2025', status: 'Disetujui' },
            { id: 3, unit: 'Unit Keamanan', title: 'Audit Keamanan Post 2', category: 'Lingkungan', date: '18-10-2025', status: 'Disetujui' },
            { id: 4, unit: 'Unit Keamanan', title: 'Cek Operasional Forklift', category: 'Pengamanan', date: '18-10-2025', status: 'Menunggu' },
        ];

        let currentStatusFilter = 'Semua';

        function renderList() {
            const container = document.getElementById('documentList');
            const catFilter = document.getElementById('catFilter').value;

            let filtered = documents;

            // Filter by Status
            if (currentStatusFilter !== 'Semua') {
                filtered = filtered.filter(d => d.status === currentStatusFilter);
            }

            // Filter by Category
            if (catFilter !== 'All') {
                filtered = filtered.filter(d => d.category === catFilter || (catFilter === 'Keamanan' && d.category === 'Pengamanan'));
            }

            let html = '';
            if (filtered.length === 0) {
                html = '<div style="padding:20px; text-align:center; color:#999;">Tidak ada dokumen ditemukan.</div>';
            } else {
                filtered.forEach(doc => {
                    html += `
                    <div class="table-row">
                        <div><strong>${doc.unit}</strong></div>
                        <div>${doc.category}</div>
                        <div>${doc.date}</div>
                        <div class="status-${doc.status.toLowerCase()}">${doc.status}</div>
                        <div style="text-align: center;">
                            <a href="{{ route('kepala_departemen.review') }}?status=${doc.status}&id=${doc.id}" class="btn-view">Detail</a>
                        </div>
                    </div>
                    `;
                });
            }
            container.innerHTML = html;
        }

        function filterData(status, btn) {
            // Update active tab
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Render data
            currentStatusFilter = status;
            renderList();
        }

        function filterByCategory() {
            renderList();
        }

        function updateCounts() {
            const waiting = documents.filter(d => d.status === 'Menunggu').length;
            const approved = documents.filter(d => d.status === 'Disetujui').length;

            document.getElementById('count-waiting').textContent = waiting;
            document.getElementById('count-approved').textContent = approved;
        }

        // Initial Render
        updateCounts();
        renderList();

        // SweetAlert for Success Message
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#c41e3a'
            });
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>