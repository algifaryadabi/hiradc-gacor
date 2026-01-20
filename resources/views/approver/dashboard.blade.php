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

        .filter-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f1f1;
            transition: transform 0.2s;
        }
        
        .filter-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .no-data-state {
            text-align: center;
            padding: 50px 20px;
            color: #94a3b8;
        }

        .no-data-icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: #cbd5e1;
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
        @include('approver.partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Dashboard Utama</h1>
            </div>

            <div class="content-area">

                <!-- 4 FILTERS (CARDS) -->
                <div class="filters-container" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; background: transparent; padding: 0; box-shadow: none;">
                    <div class="filter-group filter-card">
                        <label>Direktorat</label>
                        <select id="filter_directorate" onchange="filterDepartments()">
                            <option value="">-- Pilih Direktorat --</option>
                            <!-- JS Populated -->
                        </select>
                    </div>
                    <div class="filter-group filter-card">
                        <label>Departemen</label>
                        <select id="filter_department" onchange="filterUnits()">
                            <option value="">-- Pilih Departemen --</option>
                            <!-- JS Populated -->
                        </select>
                    </div>
                    <div class="filter-group filter-card">
                        <label>Kepala Unit Kerja</label>
                        <select id="filter_unit" onchange="filterSeksi()">
                            <option value="">-- Pilih Unit Kerja --</option>
                            <!-- JS Populated -->
                        </select>
                    </div>
                    <div class="filter-group filter-card">
                        <label>Seksi</label>
                        <select id="filter_seksi" onchange="applyFilters()">
                            <option value="">-- Pilih Seksi --</option>
                            <!-- JS Populated -->
                        </select>
                    </div>
                </div>



                <!-- CARD PIC (Only for Kepala Unit) -->
                @if(isset($currentPIC) || isset($staffList))
                @if(Auth::user()->role_jabatan == 3)
                <div class="pic-card" style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 30px;">
                    <h3 style="font-size: 16px; font-weight: 700; color: #333; margin-bottom: 20px;">
                        <i class="fas fa-user-check" style="color: #c41e3a; margin-right: 8px;"></i>
                        Akses Pembuatan Form (PIC)
                    </h3>
                    
                    <div style="margin-bottom: 15px;">
                        <strong style="color: #666;">PIC Saat Ini:</strong>
                        <span id="currentPICName" style="color: #c41e3a; font-weight: 600; margin-left: 8px;">
                            {{ $currentPIC ? $currentPIC->nama_user : 'Belum ada PIC yang ditugaskan' }}
                        </span>
                    </div>
                    
                    <div style="display: flex; gap: 15px; align-items: flex-end;">
                        <div style="flex: 1;">
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #333; margin-bottom: 8px;">
                                Pilih Staff
                            </label>
                            <select id="picDropdown" style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                                <option value="">-- Pilih Staff --</option>
                                @foreach($staffList as $staff)
                                    <option value="{{ $staff->id_user }}" {{ $currentPIC && $currentPIC->id_user == $staff->id_user ? 'selected' : '' }}>
                                        {{ $staff->nama_user }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button onclick="updatePIC(event)" style="padding: 10px 24px; background: #c41e3a; color: white; border: none; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer;">
                            Update
                        </button>
                    </div>
                </div>
                @endif
                @endif



                <!-- TABLE -->
                <div class="table-section">
                    <div class="table-header">
                        <h2>Form Terpublikasi</h2>
                        <div class="search-box" style="position: relative; width: 250px;">
                            <input type="text" id="tableSearch" placeholder="Cari form..." onkeyup="handleSearch(this.value)" 
                                style="width: 100%; padding: 8px 10px 8px 35px; border: 1px solid #ddd; border-radius: 6px; outline: none;">
                        </div>
                    </div>

                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th width="30%">Unit Penginput</th>
                                <th width="25%">Judul Form</th>
                                <th width="20%">Disetujui Oleh</th>
                                <th width="15%">Tanggal Publish</th>
                                <th width="10%">Waktu</th>
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
                <h2>Detail Form</h2>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <!-- Section 1 -->
                <div class="section-title">
                    <i class="fas fa-file-alt"></i> Informasi Form
                </div>

                <div class="info-row">
                    <div class="info-label">Judul Form:</div>
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
        @php
            // Prepare data for JS
            $directoratesData = $direktorats->map(fn($d) => [
                'id' => $d->id_direktorat,
                'name' => $d->nama_direktorat
            ]);

            $departmentsData = $departemens->map(fn($d) => [
                'id' => is_array($d) ? $d['id_dept'] : $d->id_dept,
                'dir_id' => is_array($d) ? $d['id_direktorat'] : $d->id_direktorat,
                'name' => is_array($d) ? $d['nama_dept'] : $d->nama_dept
            ]);

            $unitsData = $units->map(fn($u) => [
                'id' => is_array($u) ? $u['id_unit'] : $u->id_unit,
                'dept_id' => is_array($u) ? $u['id_dept'] : $u->id_dept,
                'name' => is_array($u) ? $u['nama_unit'] : $u->nama_unit
            ]);

            $documentsData = $publishedDocuments->map(function ($doc) {
                $lastApproval = $doc->approvals()->where('action', 'approved')->latest()->first();
                return [
                    'id' => $doc->id,
                    'title' => $doc->kolom2_kegiatan,
                    'document_title' => $doc->judul_dokumen,
                    'category' => $doc->kategori,
                    'date' => $doc->created_at->format('d M Y'),
                    'author' => $doc->user->nama_user ?? '-',
                    'approver' => $lastApproval ? ($lastApproval->approver->nama_user ?? '-') : '-',
                    'dir_id' => $doc->id_direktorat,
                    'dept_id' => $doc->id_dept,
                    'unit_id' => $doc->id_unit,
                    'seksi_id' => $doc->id_seksi,
                    'status' => 'DISETUJUI',
                    'risk_level' => $doc->risk_level,
                    'approval_date' => $doc->published_at ? $doc->published_at->format('d M Y') : '-',
                    'publish_time' => $doc->published_at ? $doc->published_at->format('H:i') . ' WIB' : '-',
                    'approval_note' => $lastApproval ? $lastApproval->catatan : '-'
                ];
            });



            $seksisData = $seksis->map(fn($s) => [
                'id' => $s->id_seksi,
                'unit_id' => $s->id_unit,
                'name' => $s->nama_seksi
            ]);
        @endphp


        // MASTER DATA
        const directorates = @json($directoratesData);

        const departments = @json($departmentsData);

        const units = @json($unitsData);

        const seksis = @json($seksisData);

        const documents = @json($documentsData);

        let activeCategory = '';
        let searchTerm = '';

        document.addEventListener('DOMContentLoaded', () => {
            populateDirectorates();
            filterDepartments();
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

            deptSelect.innerHTML = '<option value="">-- Pilih Departemen --</option>';

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

            unitSelect.innerHTML = '<option value="">-- Pilih Unit Kerja --</option>';

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
            filterSeksi();
        }

        function filterSeksi() {
            const unitId = document.getElementById('filter_unit').value;
            const seksiSelect = document.getElementById('filter_seksi');
            seksiSelect.innerHTML = '<option value="">-- Pilih Seksi --</option>';

            let filteredSeksis = seksis;
            if (unitId) {
                filteredSeksis = seksis.filter(s => s.unit_id == unitId);
            }

            filteredSeksis.forEach(s => {
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

        function handleSearch(value) {
            searchTerm = value;
            applyFilters();
        }

        function applyFilters() {
            const dirId = document.getElementById('filter_directorate').value;
            const deptId = document.getElementById('filter_department').value;
            const unitId = document.getElementById('filter_unit').value;
            const seksiId = document.getElementById('filter_seksi').value;

            const filtered = documents.filter(doc => {
                let match = true;
                if (dirId && doc.dir_id != dirId) match = false;
                if (deptId && doc.dept_id != deptId) match = false;
                if (unitId && doc.unit_id != unitId) match = false;
                if (seksiId && doc.seksi_id != seksiId) match = false;
                if (activeCategory && doc.category !== activeCategory) match = false;
                
                if (searchTerm) {
                    const term = searchTerm.toLowerCase();
                    const unit = units.find(u => u.id === doc.unit_id);
                    const unitName = unit ? unit.name.toLowerCase() : '';
                    
                    const searchableText = [
                        doc.title, 
                        doc.author, 
                        doc.approver,
                        unitName,
                        doc.category
                    ].map(s => s ? s.toLowerCase() : '').join(' ');
                    
                    if (!searchableText.includes(term)) match = false;
                }

                return match;
            });

            renderTable(filtered);
        }

        function renderTable(data = documents) {
            const tbody = document.getElementById('tableBody');
            const tableSection = document.querySelector('.table-section');

            if (data.length === 0) {
                // Show Empty State
                tableSection.style.display = 'block';
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6">
                            <div class="no-data-state">
                                <i class="fas fa-folder-open no-data-icon"></i>
                                <h3 style="font-size:16px; font-weight:700; color:#333;">Belum Ada Form Terpublikasi</h3>
                                <p style="font-size:13px; color:#64748b;">Belum ada form yang dipublikasikan saat ini.</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            tableSection.style.display = 'block';

            tbody.innerHTML = data.map(doc => {
                const unit = units.find(u => u.id === doc.unit_id);
                const unitName = unit ? unit.name : '-';
                return `
            <tr>
                <td><strong>${unitName}</strong></td>
                <td><span style="font-weight: 500; color: #333;">${doc.document_title || '-'}</span></td>
                <td style="color: #2e7d32; font-weight: 600;"><i class="fas fa-check-circle"></i> ${doc.approver}</td>
                <td>${doc.approval_date}</td>
                <td><span style="background:#f1f5f9; padding:2px 6px; border-radius:4px; font-size:12px; font-weight:600; color:#475569;">${doc.publish_time}</span></td>
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
            document.getElementById('m_unit').innerText = unitName;
            document.getElementById('m_date').innerText = doc.date;
            document.getElementById('m_author').innerText = doc.author;

            // Risk Level Styling
            const riskEl = document.getElementById('m_risk');
            riskEl.innerText = doc.risk_level;
            riskEl.className = 'info-value'; // Reset
            if (doc.risk_level === 'Tinggi') riskEl.classList.add('risk-high');

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

        function updatePIC(e) {
            const staffId = document.getElementById('picDropdown').value;
            
            if (!staffId) {
                alert('Silakan pilih staff terlebih dahulu');
                return;
            }

            // Disable button
            if(e && e.target) {
                e.target.disabled = true;
                e.target.textContent = 'Updating...';
            }

            fetch('{{ route("approver.update_pic") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ staff_id: staffId })
            })
            .then(response => response.json())
            .then(data => {
                if(e && e.target) {
                    e.target.disabled = false;
                    e.target.textContent = 'Update';
                }
                
                if (data.success) {
                    document.getElementById('currentPICName').textContent = data.staff_name;
                    alert(`✅ PIC berhasil diupdate!\n\n${data.staff_name} sekarang memiliki akses pembuatan form.`);
                } else {
                    alert(`❌ Gagal update PIC: ${data.message}`);
                }
            })
            .catch(error => {
                if(e && e.target) {
                    e.target.disabled = false;
                    e.target.textContent = 'Update';
                }
                console.error('Error:', error);
                alert('❌ Terjadi kesalahan. Silakan coba lagi.');
            });
        }
    </script>
    </script>
    <script>
        // Realtime Dashboard Polling
        const dashboardDataRoute = "{{ route('approver.dashboard.data') }}";

        setInterval(() => {
            fetch(dashboardDataRoute)
                .then(res => res.json())
                .then(data => {
                    // Update Global Data
                    documents = data;
                    // Re-apply filters to refresh table view without losing search/filter state
                    applyFilters();
                })
                .catch(err => console.error('Dashboard polling error:', err));
        }, 5000); // Update every 5 seconds
    </script>
</body>

</html>