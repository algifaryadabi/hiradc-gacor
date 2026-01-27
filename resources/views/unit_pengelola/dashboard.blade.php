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
            transition: all 0.3s;
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


        /* ADD Accordion Styles */
        .accordion-container {
            max-width: 100%;
            margin-top: 20px;
        }

        .accordion-item {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 10px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .accordion-item:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .accordion-header {
            padding: 15px 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            transition: background 0.2s;
        }

        .accordion-header:hover {
            background: #f8f9fa;
        }

        .accordion-header.active {
            background: #f0f7ff;
            border-bottom: 1px solid #e0e0e0;
        }

        .dept-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .dept-icon {
            width: 36px;
            height: 36px;
            background: #e3f2fd;
            color: #1565c0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .dept-name {
            font-weight: 600;
            color: #333;
            font-size: 15px;
        }

        .accordion-icon {
            color: #999;
            transition: transform 0.3s;
        }

        .accordion-header.active .accordion-icon {
            transform: rotate(180deg);
            color: #1565c0;
        }

        .accordion-body {
            display: none;
            background: #fafafa;
            border-top: 1px solid #f0f0f0;
        }

        .accordion-body.show {
            display: block;
            animation: slideDown 0.3s ease-out;
        }

        .unit-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .unit-item {
            padding: 12px 20px 12px 60px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: #555;
            transition: all 0.2s;
        }

        .unit-item:last-child {
            border-bottom: none;
        }

        .unit-item:hover {
            background: #fff;
            color: #c41e3a;
            padding-left: 65px;
        }

        .unit-item i {
            opacity: 0;
            transition: opacity 0.2s;
        }

        .unit-item:hover i {
            opacity: 1;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
            font-size: 14px;
            color: #666;
        }

        .breadcrumb-item {
            cursor: pointer;
            transition: color 0.2s;
        }

        .breadcrumb-item:hover {
            color: #c41e3a;
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            font-weight: 600;
            color: #333;
            cursor: default;
            text-decoration: none;
        }

        .breadcrumb-separator {
            color: #ccc;
            font-size: 12px;
        }

        /* Table Section */
        .table-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid #eee;
            animation: fadeIn 0.3s ease-out;
            margin-top: 20px;
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
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px 25px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        th {
            background: #fafafa;
            font-weight: 600;
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            font-size: 14px;
            color: #333;
        }

        .badge-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .btn-action {
            padding: 6px 14px;
            background: #c41e3a;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            transition: background 0.2s;
            cursor: pointer;
            display: inline-block;
        }

        .btn-action:hover {
            background: #a01729;
        }

        /* Modal Styles */
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
                <a href="{{ route('unit_pengelola.dashboard') }}" class="nav-item active">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('unit_pengelola.check_documents') }}" class="nav-item">
                    <i class="fas fa-file-contract"></i>
                    <span>Review Dokumen</span>
                    @if(isset($pendingCount) && $pendingCount > 0)
                        <span class="badge"
                            style="background:#c41e3a; color:white; padding:2px 6px; border-radius:10px; font-size:10px; margin-left:auto;">{{ $pendingCount }}</span>
                    @endif
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
            <div class="header">
                <h1>Dashboard Unit Pengelola</h1>
            </div>

            <div class="content-area">
                <!-- Breadcrumb & Actions -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <div class="breadcrumb" id="breadcrumb" style="margin-bottom: 0;">
                        <span class="breadcrumb-item active" onclick="resetView()">Home</span>
                    </div>

                </div>

                <!-- Dynamic Content (Accordion) -->
                <div id="dynamicContent"></div>
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
                    <div class="info-label">Unit Pengelola:</div>
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

    @php
        $departmentsData = $departemens->map(fn($d) => [
            'id_dept' => is_array($d) ? $d['id_dept'] : $d->id_dept,
            'nama_dept' => is_array($d) ? $d['nama_dept'] : $d->nama_dept
        ]);
        $unitsData = $units->map(fn($u) => [
            'id_unit' => is_array($u) ? $u['id_unit'] : $u->id_unit,
            'id_dept' => is_array($u) ? $u['id_dept'] : $u->id_dept,
            'nama_unit' => is_array($u) ? $u['nama_unit'] : $u->nama_unit
        ]);
    @endphp

    <script>

        // Processed Data
        const departments = @json($departmentsData);
        const units = @json($unitsData);
        // Published Data for Browsing
        const documents = @json($publishedData);
        // Pending Actions for User
        const pendingDocs = @json($pendingData ?? []);

        // State
        let currentLevel = 'dept';
        let selectedDept = null;
        let selectedUnit = null;

        document.addEventListener('DOMContentLoaded', () => {
            renderDepartments();
        });

        function renderDepartments() {
            currentLevel = 'dept';
            selectedDept = null;
            selectedUnit = null;
            updateBreadcrumb();

            const container = document.getElementById('dynamicContent');

            if (departments.length === 0) {
                container.innerHTML = `<div style="text-align:center; padding:50px; color:#999;"><i class="fas fa-building" style="font-size:40px; margin-bottom:15px;"></i><p>Tidak ada departemen ditemukan.</p></div>`;
                return;
            }

            let html = '';


            // 1. Separate "Unassigned" and Regular Departments
            const unassignedDeptId = 0; // ID for "Unassigned / Non-Dept"
            const directUnits = units.filter(u => u.id_dept == unassignedDeptId);
            const regularDepts = departments.filter(d => d.id_dept != unassignedDeptId);

            html += `<div class="accordion-container">`;

            // A. Regular Departments
            regularDepts.forEach(dept => {
                const deptUnits = units.filter(u => u.id_dept == dept.id_dept);

                html += `
                    <div class="accordion-item">
                        <div class="accordion-header" onclick="toggleAccordion(this, '${dept.id_dept}')">
                            <div class="dept-info">
                                <div class="dept-icon"><i class="fas fa-building"></i></div>
                                <div class="dept-name">${dept.nama_dept}</div>
                            </div>
                            <i class="fas fa-chevron-down accordion-icon"></i>
                        </div>
                        <div class="accordion-body" id="body-${dept.id_dept}">
                            <ul class="unit-list">
                `;

                if (deptUnits.length === 0) {
                    html += `<li class="unit-item" style="color:#999; cursor:default;">Tidak ada unit</li>`;
                } else {
                    deptUnits.forEach(unit => {
                        html += `
                            <li class="unit-item" onclick="selectUnit('${unit.id_unit}', '${unit.nama_unit.replace(/'/g, "\\'")}', '${dept.nama_dept.replace(/'/g, "\\'")}', '${dept.id_dept}')">
                                <span>${unit.nama_unit}</span>
                                <i class="fas fa-arrow-right"></i>
                            </li>
                        `;
                    });
                }

                html += `
                            </ul>
                        </div>
                    </div>
                `;
            });

            // B. Direct Units (from Unassigned)
            directUnits.forEach(unit => {
                html += `
                    <div class="accordion-item">
                         <!-- Similar style to header but no drop icon and clickable to go to details directly -->
                        <div class="accordion-header" onclick="selectUnit('${unit.id_unit}', '${unit.nama_unit.replace(/'/g, "\\'")}', 'Unit', '${unassignedDeptId}')">
                            <div class="dept-info">
                                <div class="dept-icon" style="background:#f3e8ff; color:#7e22ce;"><i class="fas fa-layer-group"></i></div>
                                <div class="dept-name">${unit.nama_unit}</div>
                            </div>
                            <!-- Arrow right to indicate actionable -->
                            <i class="fas fa-arrow-right" style="color:#ccc; font-size:12px;"></i>
                        </div>
                    </div>
                `;
            });

            html += `</div>`;
            container.innerHTML = html;
        }

        function toggleAccordion(header, deptId) {
            const body = document.getElementById(`body-${deptId}`);
            const isActive = header.classList.contains('active');

            // Close all
            document.querySelectorAll('.accordion-header').forEach(h => h.classList.remove('active'));
            document.querySelectorAll('.accordion-body').forEach(b => b.classList.remove('show'));

            if (!isActive) {
                header.classList.add('active');
                body.classList.add('show');
            }
        }

        function selectUnit(unitId, unitName, deptName, deptId) {
            selectedDept = { id: deptId, name: deptName };
            selectedUnit = { id: unitId, name: unitName };
            currentLevel = 'unit';
            updateBreadcrumb();
            renderDocuments(unitId);
        }

        function renderDocuments(unitId) {
            // Need to fetch or filter documents for this unit.
            // Client-side filtering of 'documents' (publishedData)
            const unitDocs = documents.filter(d => d.unit_id == unitId);

            const container = document.getElementById('dynamicContent');

            let html = `
                <div class="table-section">
                    <div class="table-header">
                        <h2>Dokumen HIRADC: ${selectedUnit.name}</h2>
                    </div>
            `;

            if (unitDocs.length === 0) {
                html += `<div style="padding:40px; text-align:center; color:#999;">Belum ada dokumen yang dipublikasikan untuk unit ini.</div>`;
            } else {
                html += `
                    <table>
                        <thead>
                            <tr>
                                <th>Judul Dokumen</th>
                                <th>Unit Pengelola</th>
                                <th>Tanggal Approve</th>
                                <th>Disetujui Oleh</th>
                                <th>Risiko</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                unitDocs.forEach(doc => {
                    html += `
                        <tr>
                            <td>
                                <div style="font-weight:600;">${doc.title}</div>
                                <div style="font-size:12px; color:#888;">Penulis: ${doc.author}</div>
                            </td>
                            <td><span class="badge-status" style="background:${doc.category.includes('SHE') ? '#dcfce7;color:#166534' : '#fee2e2;color:#991b1b'}">${doc.category}</span></td>
                            <td>${doc.date}</td>
                            <td>${doc.approver}</td>
                            <td><span style="color:${doc.risk_level === 'High' ? '#dc2626' : (doc.risk_level === 'Medium' ? '#d97706' : '#16a34a')}; font-weight:700;">${doc.risk_level}</span></td>
                            <td>
                                <button class="btn-action" onclick="showDetail(${doc.id})">Lihat</button>
                            </td>
                        </tr>
                    `;
                });

                html += `</tbody></table>`;
            }

            html += `</div>`;
            container.innerHTML = html;
        }

        // Breadcrumb Logic
        function updateBreadcrumb() {
            const bc = document.getElementById('breadcrumb');
            let html = `<span class="breadcrumb-item ${currentLevel === 'dept' ? 'active' : ''}" onclick="resetView()">Home</span>`;

            if (selectedDept) {
                html += `
                    <span class="breadcrumb-separator"><i class="fas fa-chevron-right"></i></span>
                    <span class="breadcrumb-item" onclick="resetView()">${selectedDept.name}</span>
                `;
            }

            if (selectedUnit) {
                html += `
                    <span class="breadcrumb-separator"><i class="fas fa-chevron-right"></i></span>
                    <span class="breadcrumb-item active">${selectedUnit.name}</span>
                `;
            }

            bc.innerHTML = html;
        }

        function resetView() {
            renderDepartments();
        }

        // Modal Logic
        function showDetail(id) {
            const doc = documents.find(d => d.id == id);
            if (!doc) return;

            document.getElementById('m_title').textContent = doc.title;
            document.getElementById('m_status').textContent = doc.status;
            document.getElementById('m_category').textContent = doc.category;
            document.getElementById('m_unit').textContent = doc.unit;
            document.getElementById('m_date').textContent = doc.date;
            document.getElementById('m_author').textContent = doc.author;
            document.getElementById('m_risk').textContent = doc.risk_level;

            // Risk Color
            const riskEl = document.getElementById('m_risk');
            if (doc.risk_level === 'High') riskEl.style.color = '#dc2626';
            else if (doc.risk_level === 'Medium') riskEl.style.color = '#d97706';
            else riskEl.style.color = '#16a34a';

            document.getElementById('m_approval_header').textContent = "Disetujui Oleh: " + doc.approver + " (" + doc.approval_date + ")";
            document.getElementById('m_approval_note').textContent = doc.approval_note || "Tidak ada catatan.";

            document.getElementById('detailModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('detailModal').style.display = 'none';
        }

        window.onclick = function (event) {
            const modal = document.getElementById('detailModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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