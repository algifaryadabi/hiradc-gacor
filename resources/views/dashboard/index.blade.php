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

        /* New Dashboard Styles */
        .top-filters {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .filter-card label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .select-wrapper select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            background-color: white;
            cursor: pointer;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .cat-card {
            background: white;
            padding: 30px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: left;
            border: 1px solid transparent;
            height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .cat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .cat-card.active {
            border-color: #c41e3a;
            background: #ffe5e5;
        }

        .cat-card h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .cat-card h2 {
            font-size: 20px;
            color: #333;
            font-weight: 700;
        }

        .table-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow: hidden;
            border: 1px solid #eee;
        }

        .table-header {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            background-color: #fbfbfb;
        }
        
        .table-header h2 {
            font-size: 16px; 
            font-weight: 700;
            color: #333;
            letter-spacing: 0.5px;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table thead {
            background: #fff;
            border-bottom: 2px solid #f0f0f0;
        }

        .custom-table th {
            padding: 18px 25px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #888;
            letter-spacing: 0.5px;
        }

        .custom-table tbody tr {
            border-bottom: 1px solid #f9f9f9;
            transition: all 0.2s;
        }

        .custom-table tbody tr:hover {
            background: #f8f9fa;
        }

        .custom-table td {
            padding: 18px 25px;
            font-size: 14px;
            color: #555;
            vertical-align: middle;
        }
        
        .custom-table td strong {
            color: #333;
            font-weight: 600;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
        }
        
        /* Category specific badges */
        .badge-K3 { background: #e3f2fd; color: #1976d2; }
        .badge-KO { background: #e8f5e9; color: #388e3c; }
        .badge-Lingkungan { background: #f3e5f5; color: #7b1fa2; }
        .badge-Keamanan { background: #fff3e0; color: #f57c00; }

        .btn-filter-toggle {
            padding: 8px 16px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
        }

        /* Keep existing generic styles */
        .btn-action {
             padding: 8px 18px;
             background: #c41e3a; 
             color: white;
             border-radius: 6px;
             text-decoration: none;
             font-size: 12px;
             font-weight: 500;
             transition: background 0.2s;
        }
        
        .btn-action:hover {
            background: #a01729;
            box-shadow: 0 2px 4px rgba(196, 30, 58, 0.2);
        }
    /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal-container {
            background: white;
            width: 100%;
            max-width: 700px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transform: translateY(20px);
            transition: transform 0.3s ease;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
        }

        .modal-overlay.active .modal-container {
            transform: translateY(0);
        }

        .modal-header {
            padding: 20px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
        }

        .btn-close {
            background: none;
            border: none;
            font-size: 20px;
            color: #999;
            cursor: pointer;
            transition: color 0.2s;
        }

        .btn-close:hover {
            color: #333;
        }

        .modal-body {
            padding: 30px;
            max-height: 70vh;
            overflow-y: auto;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 700;
            color: #c41e3a;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ffe5e5;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 150px 1fr;
            margin-bottom: 15px;
            align-items: flex-start;
        }

        .detail-label {
            font-size: 13px;
            color: #777;
            font-weight: 500;
        }

        .detail-value {
            font-size: 14px;
            color: #333;
            font-weight: 600;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }
        
        .status-approved { background: #e8f5e9; color: #2e7d32; }
        .text-risk-high { color: #d32f2f; }
        .text-risk-medium { color: #f57c00; }
        .text-risk-low { color: #388e3c; }

    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle">
                    <!-- Placeholder or real logo -->
                    <img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP">
                </div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System</div>
            </div>

            <nav class="nav-menu">
                <a href="{{ route('dashboard') }}" class="nav-item active">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('documents.index') }}" class="nav-item">
                    <i class="fas fa-folder-open"></i>
    <span>Dokumen Saya</span>
    <span class="badge">9</span>
</a>
<a href="{{ route('documents.create') }}" class="nav-item">
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
                <!-- Logout via Form/Link -->
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
                <h1>Dashboard</h1>
                <div class="header-actions">
                    <!-- Button removed -->
                </div>
            </div>

            <div class="content-area">
                <!-- Top Section: Dropdowns Removed -->


                <!-- Middle Section: Category Cards -->
                <div class="category-grid">
                    <div class="cat-card" onclick="selectCategory('K3', this)">
                        <h3>Dokumen</h3>
                        <h2>K3</h2>
                    </div>
                    <div class="cat-card" onclick="selectCategory('KO', this)">
                        <h3>Dokumen</h3>
                        <h2>KO</h2>
                    </div>
                    <div class="cat-card" onclick="selectCategory('Lingkungan', this)">
                        <h3>Dokumen</h3>
                        <h2>Lingkungan</h2>
                    </div>
                    <div class="cat-card" onclick="selectCategory('Keamanan', this)">
                        <h3>Dokumen</h3>
                        <h2>Keamanan</h2>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="table-section">
                    <div class="table-header">
                        <h2>Laporan Terpublikasi</h2>
                    </div>

                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th style="width: 40%">Judul Laporan</th>
                                <th style="width: 15%">Kategori</th>
                                <th style="width: 20%">Tanggal Publish</th>
                                <th style="width: 15%">Penulis</th>
                                <th style="width: 10%">Aksi</th>
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

    <!-- Detail Modal -->
    <div class="modal-overlay" id="detailModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="modal-title">Detail Dokumen</h3>
                <button class="btn-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Data populated by JS -->
                <div class="section-title">
                    <i class="fas fa-file-alt"></i> Informasi Dokumen
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Judul Dokumen:</div>
                    <div class="detail-value" id="modalTitle"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value"><span class="status-badge status-approved">DISETUJUI</span></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Kategori:</div>
                    <div class="detail-value" id="modalCategory"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Unit Kerja:</div>
                    <div class="detail-value" id="modalUnit"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Tanggal Terbit:</div>
                    <div class="detail-value" id="modalDate"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Penulis:</div>
                    <div class="detail-value" id="modalAuthor"></div>
                </div>
                 <div class="detail-row">
                    <div class="detail-label">Tingkat Risiko:</div>
                    <div class="detail-value" id="modalRisk"></div>
                </div>

                <!-- Approval Info (Optional Context) -->
                 <div class="section-title" style="margin-top: 30px; border-color: #e8f5e9; color: #2e7d32;">
                    <i class="fas fa-check-circle"></i> Informasi Persetujuan
                </div>
                <div style="background: #f1f8e9; padding: 15px; border-radius: 8px; border-left: 4px solid #2e7d32; font-size: 13px; color: #33691e;">
                    <i class="fas fa-check"></i> <strong>Disetujui oleh Kepala Departemen</strong> pada <span id="modalApproveDate"></span><br>
                    "Dokumen telah memenuhi standar K3L dan siap untuk dipublikasikan."
                </div>

            </div>
        </div>
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
                risk: 'Tinggi',
                riskClass: 'text-risk-high',
                approveDate: '14 Des 2025'
            },
            {
                title: 'Analisis Dampak Limbah Pabrik',
                category: 'Lingkungan',
                unit: 'Produksi',
                date: '12 Des 2025',
                author: 'Siti Nurhaliza',
                risk: 'Sedang',
                riskClass: 'text-risk-medium',
                approveDate: '11 Des 2025'
            },
            {
                title: 'Evaluasi Keamanan Sistem Informasi',
                category: 'Keamanan',
                unit: 'IT',
                date: '10 Des 2025',
                author: 'Budi Santoso',
                risk: 'Rendah',
                riskClass: 'text-risk-low',
                approveDate: '09 Des 2025'
            },
            {
                title: 'Prosedur Keselamatan Operasional Gudang',
                category: 'KO',
                unit: 'Operasional',
                date: '28 Nov 2025',
                author: 'Dewi Lestari',
                risk: 'Tinggi',
                riskClass: 'text-risk-high',
                approveDate: '27 Nov 2025'
            },
            {
                title: 'Identifikasi Bahaya Ruang Kerja Maintenance',
                category: 'K3',
                unit: 'Maintenance',
                date: '20 Nov 2025',
                author: 'Eko Prasetyo',
                risk: 'Tinggi',
                riskClass: 'text-risk-high',
                approveDate: '19 Nov 2025'
            },
            {
                title: 'Penilaian Risiko Bahan Kimia Laboratorium',
                category: 'K3',
                unit: 'QC',
                date: '05 Jan 2026',
                author: 'Rina Wijaya',
                risk: 'Ekstrem',
                riskClass: 'text-risk-high',
                approveDate: '04 Jan 2026'
            },
            {
                title: 'Analisis Keamanan Akses Gedung',
                category: 'Keamanan',
                unit: 'Security',
                date: '08 Jan 2026',
                author: 'Agus Setiawan',
                risk: 'Sedang',
                riskClass: 'text-risk-medium',
                approveDate: '07 Jan 2026'
            }
        ];

        let activeCategory = '';

        function selectCategory(category, element) {
            document.querySelectorAll('.cat-card').forEach(card => card.classList.remove('active'));
            if (activeCategory === category) {
                activeCategory = '';
            } else {
                activeCategory = category;
                element.classList.add('active');
            }
            filterDocuments();
        }

        function renderTable(data) {
            const tbody = document.getElementById('tableBody');

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #999;">
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
                    <td><span class="badge-status badge-${doc.category}">${doc.category}</span></td>
                    <td>${doc.date}</td>
                    <td>${doc.author}</td>
                    <td>
                        <button class="btn-action" onclick="openModal(${index})">
                            <i class="fas fa-eye"></i> Detail
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function filterDocuments() {
            let filtered = publishedDocuments.filter(doc => {
                const matchCategory = !activeCategory || doc.category === activeCategory;
                return matchCategory;
            });
            renderTable(filtered);
        }

        // Modal Logic
        function openModal(index) {
            const doc = publishedDocuments[index]; // Note: index needs to be mapped correctly if filtered, but for now simple indexing on filtered view might be tricky.
            // Better to pass the object or ID. simpler here is to find it in the filtered list or just use the global if index refers to filtered.
            // Wait, renderTable uses the passed data. If I filter, the index in map refers to the index in the *filtered* array.
            // But publishedDocuments is the source. 
            // Since we are mocking, let's just cheat and assume the index passed works for now or pass the object properties in real app.
            // A better way for Mock:
            
            // Re-finding key logic not necessary for simple mock if we just re-render properly. 
            // But 'index' in renderTable map is 0..N of filtered. 
            // So we need to look up in the currently rendered data.
            
            // Let's store currentData
            const currentData = (!activeCategory) ? publishedDocuments : publishedDocuments.filter(d => d.category === activeCategory);
            const selectedDoc = currentData[index];

            document.getElementById('modalTitle').innerText = selectedDoc.title;
            document.getElementById('modalCategory').innerText = selectedDoc.category;
            document.getElementById('modalUnit').innerText = selectedDoc.unit;
            document.getElementById('modalDate').innerText = selectedDoc.date;
            document.getElementById('modalAuthor').innerText = selectedDoc.author;
            
            const riskEl = document.getElementById('modalRisk');
            riskEl.innerText = selectedDoc.risk;
            riskEl.className = 'detail-value ' + selectedDoc.riskClass;

            document.getElementById('modalApproveDate').innerText = selectedDoc.approveDate;

            const modal = document.getElementById('detailModal');
            modal.classList.add('active');
        }

        function closeModal() {
            document.getElementById('detailModal').classList.remove('active');
        }

        // Close on outside click
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Initial render
        renderTable(publishedDocuments);
    
    </script>
</body>

</html>