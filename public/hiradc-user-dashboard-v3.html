<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HIRADC System</title>
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

        /* Sidebar */
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
            background: #000;
            border-radius: 50%;
            margin: 0 auto 15px;
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

        .badge {
            position: absolute;
            right: 20px;
            background: #c41e3a;
            color: white;
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 10px;
            font-weight: 600;
        }

        /* User Info at Bottom */
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .btn-primary {
            padding: 10px 20px;
            background: #c41e3a;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            background: #a01729;
            transform: translateY(-1px);
        }

        .content-area {
            padding: 30px 40px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #c41e3a;
        }

        .stat-card h3 {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: 700;
            color: #333;
        }

        .stat-card .change {
            font-size: 12px;
            color: #4caf50;
            margin-top: 5px;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 25px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-group label {
            font-size: 13px;
            font-weight: 600;
            color: #333;
        }

        .filter-input {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
        }

        .filter-input:focus {
            outline: none;
            border-color: #c41e3a;
        }

        /* Table */
        .table-section {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .table-header {
            padding: 20px 25px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #c41e3a;
            color: white;
        }

        th {
            padding: 15px 20px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
        }

        tbody tr {
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: #f9f9f9;
        }

        td {
            padding: 18px 20px;
            font-size: 14px;
            color: #666;
        }

        .badge-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-published {
            background: #d4edda;
            color: #155724;
        }

        .btn-action {
            padding: 6px 16px;
            background: #c41e3a;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-action:hover {
            background: #a01729;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle"></div>
                <div class="logo-text">HIRADC</div>
                <div class="logo-subtext">System</div>
            </div>

            <nav class="nav-menu">
                <a href="hiradc-user-dashboard-v3.html" class="nav-item active">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
                <a href="hiradc-my-documents-v2.html" class="nav-item">
                    <i class="fas fa-folder-open"></i>
                    <span>Dokumen Saya</span>
                    <span class="badge">5</span>
                </a>
                <a href="hiradc-form-complete.html" class="nav-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>Buat Dokumen Baru</span>
                </a>
            </nav>

            <!-- User Info at Bottom -->
            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">JD</div>
                    <div class="user-details">
                        <div class="user-name">John Doe</div>
                        <div class="user-role">Staff Unit Kerja</div>
                    </div>
                </div>
                <button class="logout-btn" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    Keluar
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Dashboard</h1>
                <div class="header-actions">
                    <a href="hiradc-form-complete.html" class="btn-primary">
                        <i class="fas fa-plus"></i>
                        Buat Dokumen Baru
                    </a>
                </div>
            </div>

            <div class="content-area">
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Total Dokumen Saya</h3>
                        <div class="number">9</div>
                        <div class="change">+2 bulan ini</div>
                    </div>
                    <div class="stat-card">
                        <h3>Perlu Revisi</h3>
                        <div class="number">2</div>
                        <div class="change" style="color: #ff9800;">Segera perbaiki</div>
                    </div>
                    <div class="stat-card">
                        <h3>Disetujui</h3>
                        <div class="number">7</div>
                        <div class="change">78% approval rate</div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="filter-section">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label>Kategori Dokumen</label>
                            <select class="filter-input" id="filterKategori" onchange="filterDocuments()">
                                <option value="">Semua Kategori</option>
                                <option value="K3">K3</option>
                                <option value="KO">KO</option>
                                <option value="Lingkungan">Lingkungan</option>
                                <option value="Keamanan">Keamanan</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Unit Kerja</label>
                            <select class="filter-input" id="filterUnit" onchange="filterDocuments()">
                                <option value="">Semua Unit</option>
                                <option value="Produksi">Produksi</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="QC">Quality Control</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Bulan</label>
                            <select class="filter-input" id="filterBulan" onchange="filterDocuments()">
                                <option value="">Semua Bulan</option>
                                <option value="2026-01">Januari 2026</option>
                                <option value="2025-12">Desember 2025</option>
                                <option value="2025-11">November 2025</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Cari</label>
                            <input type="text" class="filter-input" id="filterSearch" placeholder="Cari judul..."
                                onkeyup="filterDocuments()">
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="table-section">
                    <div class="table-header">
                        <h2>Dokumen Risiko Terpublikasi</h2>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Judul Dokumen</th>
                                <th>Kategori</th>
                                <th>Unit Kerja</th>
                                <th>Tanggal Publish</th>
                                <th>Penulis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- Data will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Sample published documents data
        const publishedDocuments = [
            {
                title: 'Penilaian Risiko Penggunaan Mesin Produksi A',
                category: 'K3',
                unit: 'Produksi',
                date: '15 Des 2025',
                author: 'Ahmad Rizki',
                month: '2025-12'
            },
            {
                title: 'Analisis Dampak Limbah Pabrik',
                category: 'Lingkungan',
                unit: 'Produksi',
                date: '12 Des 2025',
                author: 'Siti Nurhaliza',
                month: '2025-12'
            },
            {
                title: 'Evaluasi Keamanan Sistem Informasi',
                category: 'Keamanan',
                unit: 'IT',
                date: '10 Des 2025',
                author: 'Budi Santoso',
                month: '2025-12'
            },
            {
                title: 'Prosedur Keselamatan Operasional Gudang',
                category: 'KO',
                unit: 'Operasional',
                date: '28 Nov 2025',
                author: 'Dewi Lestari',
                month: '2025-11'
            },
            {
                title: 'Identifikasi Bahaya Ruang Kerja Maintenance',
                category: 'K3',
                unit: 'Maintenance',
                date: '20 Nov 2025',
                author: 'Eko Prasetyo',
                month: '2025-11'
            },
            {
                title: 'Penilaian Risiko Bahan Kimia Laboratorium',
                category: 'K3',
                unit: 'QC',
                date: '05 Jan 2026',
                author: 'Rina Wijaya',
                month: '2026-01'
            },
            {
                title: 'Analisis Keamanan Akses Gedung',
                category: 'Keamanan',
                unit: 'Security',
                date: '08 Jan 2026',
                author: 'Agus Setiawan',
                month: '2026-01'
            }
        ];

        function renderTable(data) {
            const tbody = document.getElementById('tableBody');

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #999;">
                            <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 15px; display: block; opacity: 0.5;"></i>
                            Tidak ada dokumen yang ditemukan
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = data.map((doc, index) => `
                <tr>
                    <td><strong>${doc.title}</strong></td>
                    <td><span class="badge-status badge-published">${doc.category}</span></td>
                    <td>${doc.unit}</td>
                    <td>${doc.date}</td>
                    <td>${doc.author}</td>
                    <td>
                        <a href="hiradc-document-detail-v2.html" class="btn-action">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
            `).join('');
        }

        function filterDocuments() {
            const kategori = document.getElementById('filterKategori').value;
            const unit = document.getElementById('filterUnit').value;
            const bulan = document.getElementById('filterBulan').value;
            const search = document.getElementById('filterSearch').value.toLowerCase();

            let filtered = publishedDocuments.filter(doc => {
                const matchKategori = !kategori || doc.category === kategori;
                const matchUnit = !unit || doc.unit === unit;
                const matchBulan = !bulan || doc.month === bulan;
                const matchSearch = !search || doc.title.toLowerCase().includes(search);

                return matchKategori && matchUnit && matchBulan && matchSearch;
            });

            renderTable(filtered);
        }

        function logout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                alert('Anda telah keluar dari sistem');
                // In real app, redirect to login page
            }
        }

        // Initial render
        renderTable(publishedDocuments);
    </script>
</body>

</html>