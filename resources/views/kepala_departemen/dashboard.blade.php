<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <a href="{{ route('kepala_departemen.dashboard') }}" class="nav-item active">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('kepala_departemen.check_documents') }}" class="nav-item">
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
                    <div class="user-avatar">{{ substr(Auth::user()->nama_user ?? Auth::user()->username, 0, 2) }}</div>
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->nama_user }}</div>
                        <div class="user-role">{{ Auth::user()->departemen->nama_dept ?? 'Kepala Departemen' }}</div>
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
        // Using publishedData from controller which looks like it has necessary fields
        // Note: JS logic expects 'unit_id', 'title', 'category' etc.
        // The controller transforms it to 'unit_id', 'title' etc. 
        // Controller publishedData mapping matches JS expectations broadly? 
        // Controller: 'title' => $doc->judul_dokumen, 'unit_id' => ... 
        const documents = @json($publishedData);
        // Add Pending Data
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

            // 0. Render Pending Documents (if any)
            if (pendingDocs.length > 0) {
                html += `
                    <div class="table-section" style="margin-bottom: 30px; border-left: 4px solid #f59e0b;">
                        <div class="table-header" style="background: #fff8e1;">
                            <h2 style="color: #b45309;"><i class="fas fa-clock"></i> Dokumen Menunggu Approval</h2>
                        </div>
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Judul Form</th>
                                    <th>Unit Kerja</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Status Approval</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                `;

                pendingDocs.forEach(doc => {
                    // Determine Badge Color based on Partial Status
                    let badgeColor = '#e0f2fe'; // blue
                    let textColor = '#0369a1';

                    if (doc.status.includes('SHE')) {
                        badgeColor = '#dcfce7'; // green-ish for SHE (Env)
                        textColor = '#166534';
                    } else if (doc.status.includes('Security')) {
                        badgeColor = '#fee2e2'; // red-ish for Security
                        textColor = '#991b1b';
                    }

                    // Build URL with query param to indicate focus? 
                    // Controller's edit/review method might need to know which part we are approving if we want to auto-scroll.
                    // For now, standard review link.
                    const reviewUrl = `/kepala-departemen/documents/${doc.id}/review`;

                    html += `
                        <tr>
                            <td>${doc.title}</td>
                            <td>${doc.unit}</td>
                            <td>${doc.date}</td>
                            <td>
                                <span class="status-pill" style="background:${badgeColor}; color:${textColor}; padding:4px 12px; border-radius:15px; font-size:11px; font-weight:700;">
                                    ${doc.status}
                                </span>
                            </td>
                            <td>
                                <a href="${reviewUrl}" class="btn-action" style="background:#f59e0b;">
                                    <i class="fas fa-signature"></i> Proses
                                </a>
                            </td>
                        </tr>
                    `;
                });

                html += `</tbody></table></div>`;
            }

            html += '<h3 style="margin-bottom:15px; color:#333; font-size:16px;">Arsip Dokumen Terpublikasi</h3>';
            html += '<div class="accordion-container">';

            // 1. Regular Departments (Excluding ID 0 and ID 93)
            const regularDepts = departments.filter(d => d.id_dept != 0 && d.id_dept != 93);

            regularDepts.forEach(dept => {
                const deptUnits = units.filter(u => u.id_dept == dept.id_dept);
                const unitCount = deptUnits.length;

                html += `
                    <div class="accordion-item">
                        <div class="accordion-header" onclick="toggleDepartment(${dept.id_dept})">
                            <div class="dept-info">
                                <div class="dept-icon"><i class="fas fa-building"></i></div>
                                <div class="dept-name">${dept.nama_dept}</div>
                            </div>
                            <div class="accordion-icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="accordion-body" id="dept-${dept.id_dept}">
                            <ul class="unit-list">
                `;

                if (unitCount > 0) {
                    deptUnits.forEach(unit => {
                        html += `
                            <li class="unit-item" onclick="selectUnit(${unit.id_unit}, '${unit.nama_unit.replace(/'/g, "\\'")}', ${dept.id_dept})">
                                <span>${unit.nama_unit}</span>
                                <i class="fas fa-arrow-right"></i>
                            </li>
                        `;
                    });
                } else {
                    html += `<li class="unit-item" style="color: #999; cursor: default;">Tidak ada Unit Kerja</li>`;
                }

                html += `
                            </ul>
                        </div>
                    </div>
                `;
            });

            // 2. Unassigned Units
            const unassignedDept = departments.find(d => d.id_dept == 0);
            if (unassignedDept) {
                // Filter out ID 0
                const directUnits = units.filter(u => u.id_dept == 0 && u.id_unit != 0);
                if (directUnits.length > 0) {

                    directUnits.forEach(unit => {
                        html += `
                            <div class="accordion-item" onclick="selectUnit(${unit.id_unit}, '${unit.nama_unit.replace(/'/g, "\\'")}', 0)" style="cursor:pointer;">
                                <div class="accordion-header">
                                    <div class="dept-info">
                                        <div class="dept-icon" style="background:#fce4ec; color:#c2185b;"><i class="fas fa-layer-group"></i></div>
                                        <div class="dept-name">${unit.nama_unit}</div>
                                    </div>
                                    <div class="accordion-icon"><i class="fas fa-arrow-right"></i></div>
                                </div>
                            </div>
                        `;
                    });
                }
            }

            html += '</div>';
            container.innerHTML = html;
        }

        function toggleDepartment(id) {
            const body = document.getElementById(`dept-${id}`);
            if (!body) return;
            const header = body.previousElementSibling;

            const isShown = body.classList.contains('show');

            // Close others
            document.querySelectorAll('.accordion-body').forEach(el => el.classList.remove('show'));
            document.querySelectorAll('.accordion-header').forEach(el => el.classList.remove('active'));

            if (!isShown) {
                body.classList.add('show');
                header.classList.add('active');
            }
        }

        function selectDepartment(id, name) {
            renderDepartments();
            setTimeout(() => {
                const body = document.getElementById(`dept-${id}`);
                if (body) {
                    body.classList.add('show');
                    body.previousElementSibling.classList.add('active');
                    body.parentElement.scrollIntoView({ behavior: 'smooth' });
                }
            }, 50);
        }

        function selectUnit(id, name, deptId) {
            const dept = departments.find(d => d.id_dept == deptId);
            selectedDept = { id: deptId, name: dept ? dept.nama_dept : '-' };
            selectedUnit = { id, name };
            currentLevel = 'docs';
            updateBreadcrumb();

            // Initial Render with 'ALL'
            renderUnitDocs(id, name, deptId, 'ALL');
        }

        function renderUnitDocs(id, name, deptId, filterCategory) {
            const container = document.getElementById('dynamicContent');
            const rawDocs = documents.filter(doc => doc.unit_id == id);

            // SPLIT MULTI-CATEGORY DOCS INTO SEPARATE ITEMS
            let unitDocs = [];
            rawDocs.forEach(doc => {
                if (doc.category && doc.category.includes(',')) {
                    // Split by comma
                    const cats = doc.category.split(',').map(c => c.trim());
                    cats.forEach(c => {
                        unitDocs.push({ ...doc, category: c }); // Create clone with single category
                    });
                } else {
                    unitDocs.push(doc);
                }
            });

            // Filter Logic
            if (filterCategory !== 'ALL') {
                unitDocs = unitDocs.filter(doc => doc.category === filterCategory);
            }

            // Categories available for filter
            const categories = ['SHE', 'Security'];

            let html = `
                <div class="table-section">
                    <div class="table-header" style="flex-wrap: wrap; gap: 10px;">
                        <div>
                            <h2 style="margin-bottom:5px;">Laporan Terpublikasi - ${name}</h2>
                            <div style="font-size:12px; color:#666;">Menampilkan kategori: <b>${filterCategory}</b></div>
                        </div>
                        <div style="display:flex; gap:10px; align-items:center;">
                            <select onchange="renderUnitDocs(${id}, '${name.replace(/'/g, "\\'")}', ${deptId}, this.value)" style="padding:6px 12px; border-radius:6px; border:1px solid #ddd; font-size:13px; color:#333; cursor:pointer;">
                                <option value="ALL" ${filterCategory === 'ALL' ? 'selected' : ''}>Semua Kategori</option>
                                ${categories.map(c => `<option value="${c}" ${filterCategory === c ? 'selected' : ''}>${c}</option>`).join('')}
                            </select>
                            <button class="btn-action" style="background:#666;" onclick="selectDepartment(${deptId})"><i class="fas fa-arrow-left"></i> Kembali</button>
                        </div>
                    </div>
            `;

            if (unitDocs.length === 0) {
                html += `
                    <div style="text-align: center; padding: 40px; color: #999;">
                        <i class="fas fa-filter" style="font-size:30px; margin-bottom:10px;"></i>
                        <p>Tidak ada dokumen terpublikasi untuk kategori <b>${filterCategory}</b>.</p>
                    </div>`;
            } else {
                html += `
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Judul Form</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Tanggal Publish</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                unitDocs.forEach(doc => {
                    // Category Badge Color
                    let catColor = '#e0e0e0';
                    let catText = '#333';
                    if (doc.category == 'K3') { catColor = '#fee2e2'; catText = '#991b1b'; } // Red-ish
                    else if (doc.category == 'Lingkungan') { catColor = '#dcfce7'; catText = '#166534'; } // Green
                    else if (doc.category == 'Keamanan') { catColor = '#e0f2fe'; catText = '#075985'; } // Blue
                    else if (doc.category == 'KO') { catColor = '#ffedd5'; catText = '#9a3412'; } // Orange

                    html += `
                        <tr>
                            <td>${doc.title}</td>
                            <td><span class="status-pill" style="background:${catColor}; color:${catText};">${doc.category || '-'}</span></td>
                            <td>${doc.author}</td>
                            <td>${doc.date}</td>
                            <td><span class="status-pill" style="background:#e8f5e9; color:#2e7d32; padding:4px 12px; border-radius:15px; font-size:11px; font-weight:700;">DISETUJUI</span></td>
                            <td>
                                <a href="/documents/${doc.id}/published?filter=${doc.category}" class="btn-action">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    `;
                });

                html += `</tbody></table>`;
            }

            html += `</div>`;
            container.innerHTML = html;
        }

        function updateBreadcrumb() {
            const bc = document.getElementById('breadcrumb');
            let html = `<span class="breadcrumb-item" onclick="renderDepartments()">Home</span>`;

            if (currentLevel === 'unit' || currentLevel === 'docs') {
                if (selectedDept) {
                    html += `
                        <span class="breadcrumb-separator"><i class="fas fa-chevron-right"></i></span>
                        <span class="breadcrumb-item" onclick="selectDepartment(${selectedDept.id}, '${selectedDept.name.replace(/'/g, "\\'")}')">
                            ${selectedDept.name}
                        </span>
                    `;
                }
            }

            if (currentLevel === 'docs' && selectedUnit) {
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

        // ================= MODAL =================
        const modal = document.getElementById('detailModal');

        function openDetail(id) {
            const doc = documents.find(d => d.id == id);
            if (doc) showDetail(doc);
        }

        function showDetail(doc) {
            document.getElementById('m_title').innerText = doc.title;
            document.getElementById('m_status').innerText = "DISETUJUI";
            document.getElementById('m_unit').innerText = selectedUnit ? selectedUnit.name : '-';
            document.getElementById('m_author').innerText = doc.author;
            document.getElementById('m_date').innerText = doc.date;
            document.getElementById('m_category').innerText = doc.category || '-';

            // Risk Level
            const riskEl = document.getElementById('m_risk');
            if (doc.risk_level) {
                riskEl.innerText = doc.risk_level;
                riskEl.parentElement.style.display = 'flex';
                if (doc.risk_level === 'Tinggi') {
                    riskEl.className = 'info-value risk-high';
                } else {
                    riskEl.className = 'info-value';
                }
            } else {
                riskEl.parentElement.style.display = 'none';
            }

            // Approval Info
            document.getElementById('m_approval_header').innerText = `Disetujui pada ${doc.approval_date || doc.date}`;
            document.getElementById('m_approval_note').innerText = doc.approval_note || '-';

            modal.style.display = 'block';
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                closeModal();
            }
        }
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