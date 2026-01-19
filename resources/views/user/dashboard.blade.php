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

        .content-area {
            padding: 30px 40px;
        }

        /* FILTERS */
        .filters-container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .filter-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .filter-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            color: #555;
            background-color: #fff;
            cursor: pointer;
        }

        .filter-group select:focus {
            outline: none;
            border-color: #c41e3a;
        }

        /* CARDS */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .cat-card {
            background: white;
            padding: 25px;
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
            margin-bottom: 8px;
            font-weight: 500;
        }

        .cat-card h2 {
            font-size: 20px;
            color: #333;
            font-weight: 700;
        }

        /* TABLE */
        .table-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
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

        .btn-filter-toggle {
            padding: 8px 16px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
        }

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

        .badge-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
        }

        /* MODAL STYLES */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            font-family: 'Inter', sans-serif;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 0;
            border: 1px solid #888;
            width: 600px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            position: relative;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 20px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .close-btn {
            color: #aaa;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close-btn:hover {
            color: #c41e3a;
        }

        .modal-body {
            padding: 30px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #c41e3a;
            /* Red color */
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title.green {
            color: #2e7d32;
        }

        .info-row {
            display: flex;
            margin-bottom: 15px;
            align-items: flex-start;
        }

        .info-label {
            width: 140px;
            font-size: 14px;
            color: #888;
            font-weight: 500;
        }

        .info-value {
            flex: 1;
            font-size: 14px;
            color: #333;
            font-weight: 600;
        }

        .risk-high {
            color: #c41e3a;
            font-weight: 700;
        }

        .status-pill {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .approval-box {
            background-color: #f1f8e9;
            /* Light green bg */
            border-left: 4px solid #2e7d32;
            padding: 15px;
            border-radius: 4px;
            margin-top: 10px;
        }

        .approval-text {
            font-size: 13px;
            color: #33691e;
            line-height: 1.5;
        }

        .approval-header {
            font-weight: 700;
            margin-bottom: 5px;
            color: #1b5e20;
            display: flex;
            align-items: center;
            gap: 8px;
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
                <a href="{{ route('user.dashboard') }}" class="nav-item active">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
                @if(Auth::user()->can_create_documents == 1)
                    <a href="{{ route('documents.index') }}" class="nav-item">
                        <i class="fas fa-folder-open"></i>
                        <span>Dokumen Saya</span>
                        @if(isset($revisionCount) && $revisionCount > 0)
                            <span class="badge">{{ $revisionCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('documents.create') }}" class="nav-item">
                        <i class="fas fa-plus-circle"></i>
                        <span>Buat Dokumen Baru</span>
                    </a>
                @endif
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
            <div class="header">
                <h1>Dashboard Utama</h1>
            </div>

            <div class="content-area">

                <!-- 4 FILTERS -->
                <div class="filters-container" style="grid-template-columns: repeat(4, 1fr);">
                    <div class="filter-group">
                        <label>Direktorat</label>
                        <select id="filter_directorate" onchange="filterDepartments()">
                            <option value="">-- Pilih Direktorat --</option>
                            @foreach($direktorats as $dir)
                                <option value="{{ $dir->id_direktorat }}">{{ $dir->nama_direktorat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Departemen</label>
                        <select id="filter_department" onchange="filterUnits()">
                            <option value="">-- Pilih Departemen --</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Unit Kerja</label>
                        <select id="filter_unit" onchange="filterSeksi()">
                            <option value="">-- Pilih Unit --</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Seksi</label>
                        <select id="filter_seksi" onchange="applyFilters()">
                            <option value="">-- Pilih Seksi --</option>
                        </select>
                    </div>
                </div>

                <!-- 4 SUMMARY CARDS -->
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

                <!-- TABLE -->
                <div class="table-section">
                    <div class="table-header">
                        <h2>Laporan Terpublikasi</h2>
                    </div>

                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th width="30%">Unit Penginput</th>
                                <th width="15%">Kategori</th>
                                <th width="20%">Disetujui Oleh</th>
                                <th width="15%">Tanggal Publish</th>
                                <th width="15%">Penulis</th>
                                <th width="5%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- JS Populated -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- DETAIL MODAL -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Detail Dokumen</h2>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <!-- Section 1 -->
                <div class="section-title">
                    <i class="fas fa-file-alt"></i> Informasi Dokumen
                </div>

                <div class="info-row">
                    <div class="info-label">Judul Dokumen:</div>
                    <div class="info-value" id="m_title"></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Status:</div>
                    <div class="info-value"><span class="status-pill" id="m_status"></span></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Kategori:</div>
                    <div class="info-value" id="m_category"></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Unit Kerja:</div>
                    <div class="info-value" id="m_unit"></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Terbit:</div>
                    <div class="info-value" id="m_date"></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Penulis:</div>
                    <div class="info-value" id="m_author"></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tingkat Risiko:</div>
                    <div class="info-value risk-high" id="m_risk"></div>
                </div>

                <hr style="border: 0; border-top: 1px solid #eee; margin: 25px 0;">

                <!-- Section 2 -->
                <div class="section-title green">
                    <i class="fas fa-check-circle"></i> Informasi Persetujuan
                </div>

                <div class="approval-box">
                    <div class="approval-header">
                        <i class="fas fa-check"></i> <span id="m_approval_header"></span>
                    </div>
                    <div class="approval-text" id="m_approval_note"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // MASTER DATA FROM DATABASE
        const directorates = @json($direktorats->map(fn($d) => ['id' => $d->id_direktorat, 'name' => $d->nama_direktorat]));

        const departments = @json($departemens->map(fn($d) => ['id' => $d->id_dept, 'dir_id' => $d->id_direktorat, 'name' => $d->nama_dept]));

        const units = @json($units->map(fn($u) => ['id' => $u->id_unit, 'dept_id' => $u->id_dept, 'name' => $u->nama_unit]));

        const seksis = @json($seksis->map(fn($s) => ['id' => $s->id_seksi, 'unit_id' => $s->id_unit, 'name' => $s->nama_seksi]));

        const documents = @json($documents);

        let activeCategory = '';

        document.addEventListener('DOMContentLoaded', () => {
            populateDirectorates();
            filterDepartments(); // Initialize Departments
            renderTable(); // Initial render
        });

        function populateDirectorates() {
            const select = document.getElementById('filter_directorate');
            select.innerHTML = '<option value="">-- Pilih Direktorat --</option>';
            directorates.forEach(d => {
                const opt = document.createElement('option');
                opt.value = d.id;
                opt.textContent = d.name;
                select.appendChild(opt);
            });
        }

        function filterDepartments() {
            const dirId = document.getElementById('filter_directorate').value;
            const deptSelect = document.getElementById('filter_department');
            // Reset is handled by re-populating. If logic was appending, we'd need to clear. 
            // innerHTML assignment clears it.

            deptSelect.innerHTML = '<option value="">-- Pilih Departemen --</option>';

            // Should units be reset here? Yes, because department list changes/resets
            // But we will call filterUnits right after to re-populate them based on empty dept (Show All) or selected dept
            // Just clearing it here might cause blink if filterUnits isn't fast, but it's JS so it's blocking/fast.

            let filteredDepts = departments;
            if (dirId) {
                filteredDepts = departments.filter(d => d.dir_id == dirId);
            }

            filteredDepts.forEach(d => {
                const opt = document.createElement('option');
                opt.value = d.id;
                opt.textContent = d.name;
                deptSelect.appendChild(opt);
            });

            filterUnits();
        }

        function filterUnits() {
            const deptId = document.getElementById('filter_department').value;
            const unitSelect = document.getElementById('filter_unit');

            unitSelect.innerHTML = '<option value="">-- Pilih Unit --</option>';

            let filteredUnits = units;
            if (deptId) {
                filteredUnits = units.filter(u => u.dept_id == deptId);
            }

            filteredUnits.forEach(u => {
                const opt = document.createElement('option');
                opt.value = u.id;
                opt.textContent = u.name;
                unitSelect.appendChild(opt);
            });
            // Reset seksi dropdown
            const seksiSelect = document.getElementById('filter_seksi');
            seksiSelect.innerHTML = '<option value="">-- Pilih Seksi --</option>';
        }

        function filterSeksi() {
            const unitId = document.getElementById('filter_unit').value;
            const seksiSelect = document.getElementById('filter_seksi');
            seksiSelect.innerHTML = '<option value="">-- Pilih Seksi --</option>';

            if (!unitId) return;

            seksis.filter(s => s.unit_id == unitId).forEach(s => {
                const opt = document.createElement('option');
                opt.value = s.id;
                opt.textContent = s.name;
                seksiSelect.appendChild(opt);
            });
            applyFilters();
        }

        function selectCategory(cat, el) {
            document.querySelectorAll('.cat-card').forEach(c => c.classList.remove('active'));
            if (activeCategory === cat) {
                activeCategory = '';
            } else {
                activeCategory = cat;
                el.classList.add('active');
            }
            applyFilters();
        }

        function applyFilters() {
            const dirId = document.getElementById('filter_directorate').value;
            const deptId = document.getElementById('filter_department').value;
            const unitId = document.getElementById('filter_unit').value;

            const filtered = documents.filter(doc => {
                let match = true;
                if (dirId && doc.dir_id != dirId) match = false;
                if (deptId && doc.dept_id != deptId) match = false;
                if (unitId && doc.unit_id != unitId) match = false;
                if (activeCategory && doc.category !== activeCategory) match = false;
                return match;
            });

            renderTable(filtered);
        }

        function renderTable(data = documents) {
            const tbody = document.getElementById('tableBody');
            const tableSection = document.querySelector('.table-section');

            // Always show table section
            tableSection.style.display = 'block';

            if (data.length === 0) {
                let mainText = 'Belum Ada Laporan Terpublikasi';
                let subText = 'Belum ada dokumen yang dipublikasikan.';

                if (activeCategory) {
                    subText = `Tidak ada dokumen ditemukan untuk kategori <strong>${activeCategory}</strong>.`;
                }

                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 60px 20px;">
                            <div style="margin-bottom: 20px;">
                                <i class="fas fa-folder-open" style="font-size: 64px; color: #ddd;"></i>
                            </div>
                            <h3 style="font-size: 18px; color: #666; margin-bottom: 10px; font-weight: 600;">
                                ${mainText}
                            </h3>
                            <p style="font-size: 14px; color: #999; margin: 0;">
                                ${subText}
                            </p>
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = data.map(doc => {
                const unit = units.find(u => u.id === doc.unit_id);
                const unitName = unit ? unit.name : '-';
                return `
                <tr>
                    <td><strong>${unitName}</strong></td>
                    <td><span class="badge-status" style="background: #eee;">${doc.category}</span></td>
                    <td style="color: #2e7d32; font-weight: 600;"><i class="fas fa-check-circle"></i> ${doc.approver}</td>
                    <td>${doc.date}</td>
                    <td>${doc.time || '-'}</td>
                    <td>${doc.author}</td>
                    <td><a href="/documents/${doc.id}/published" class="btn-action">Detail</a></td>
                </tr>
            `}).join('');
        }

        // MODAL FUNCTIONS
        function openDetailModal(id) {
            const doc = documents.find(d => d.id === id);
            if (!doc) return;

            const unit = units.find(u => u.id === doc.unit_id);
            const unitName = unit ? unit.name : '-';

            document.getElementById('m_title').innerText = doc.title;
            document.getElementById('m_status').innerText = doc.status;
            document.getElementById('m_category').innerText = doc.category;
            document.getElementById('m_unit').innerText = unitName; // Show Unit Name
            document.getElementById('m_date').innerText = doc.date;
            document.getElementById('m_author').innerText = doc.author;

            // Risk Level Styling
            const riskEl = document.getElementById('m_risk');
            riskEl.innerText = doc.risk_level;
            riskEl.className = 'info-value'; // Reset
            if (doc.risk_level === 'Tinggi') riskEl.classList.add('risk-high');

            // Approval Info
            // Extract the Approver Name part before the () if needed, or use full string. 
            // The image says: "Disetujui oleh Kepala Departemen pada [Date]"
            // But our data has "approver" containing name. Let's format it nicely.
            // Assumption: The approver string "Bpk. Ahmad (Ka. Dept Produksi)" implies role is in parens.
            // For now, let's just use "Kepala Departemen" generic text + date as requested in image, or use the real data.
            // The image text is: "Disetujui oleh Kepala Departemen pada 14 Des 2025"

            document.getElementById('m_approval_header').innerText = `Disetujui oleh Kepala Departemen pada ${doc.approval_date}`;
            document.getElementById('m_approval_note').innerText = doc.approval_note;

            document.getElementById('detailModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('detailModal').style.display = 'none';
        }

        // Close modal if clicked outside
        window.onclick = function (event) {
            const modal = document.getElementById('detailModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

    </script>
</body>

</html>