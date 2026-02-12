<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Direksi | HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* ========================================
           DESIGN SYSTEM - CSS CUSTOM PROPERTIES
           ======================================== */
        :root {
            /* Brand Colors */
            --primary: #c41e3a;
            --primary-dark: #9a1829;
            --primary-light: #e63950;
            --primary-50: #fef2f3;

            /* Neutral Palette */
            --gray-50: #fafafa;
            --gray-100: #f5f5f5;
            --gray-200: #e5e5e5;
            --gray-300: #d4d4d4;
            --gray-400: #a3a3a3;
            --gray-500: #737373;
            --gray-600: #525252;
            --gray-700: #404040;
            --gray-800: #262626;
            --gray-900: #171717;

            /* Surface & Background */
            --bg-body: #f1f5f9;
            --surface: #ffffff;
            --surface-hover: #f9fafb;
            --border: #e2e8f0;

            /* Shadows */
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);

            /* Spacing */
            --space-4: 1rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;

            /* Border Radius */
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;

            /* Fonts */
            --font-sans: 'Plus Jakarta Sans', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-sans);
            background: var(--bg-body);
            background-image:
                radial-gradient(at 0% 0%, rgba(196, 30, 58, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--gray-900);
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - Twin Design */
        .sidebar {
            width: 280px;
            background: #5b6fd8;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: var(--shadow-md);
        }

        .logo-section {
            padding: var(--space-8) var(--space-6);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
            position: relative;
        }

        .logo-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.3) 50%, transparent 100%);
        }

        .logo-circle {
            width: 90px;
            height: 90px;
            margin: 0 auto 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .logo-circle:hover {
            transform: scale(1.05);
        }

        .logo-circle img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.125rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
            letter-spacing: -0.02em;
        }

        .logo-subtext {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .nav-menu {
            flex: 1;
            padding: 1.5rem 0;
            overflow-y: auto;
        }

        .nav-item {
            padding: 1rem 1.5rem;
            margin: 0.25rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9375rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 0.75rem;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(4px);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.125rem;
        }

        .user-info-bottom {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5b6fd8;
            font-weight: 700;
            font-size: 1.125rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9375rem;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
        }

        .logout-btn {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 0;
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%);
            padding: var(--space-8) var(--space-10);
            border-bottom: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .header h1 {
            font-size: 1.875rem;
            font-weight: 800;
            color: var(--gray-900);
            letter-spacing: -0.02em;
            margin-bottom: 0.25rem;
        }

        .header-subtitle {
            font-size: 0.875rem;
            color: var(--gray-500);
            font-weight: 500;
        }

        .content-area {
            padding: var(--space-10);
            max-width: 1600px;
        }

        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: var(--radius-xl);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-icon.blue {
            background: #eff6ff;
            color: #2563eb;
        }

        .stat-icon.green {
            background: #f0fdf4;
            color: #16a34a;
        }

        .stat-icon.orange {
            background: #fff7ed;
            color: #ea580c;
        }

        .stat-icon.purple {
            background: #faf5ff;
            color: #9333ea;
        }

        .stat-content {
            flex: 1;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--gray-900);
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--gray-500);
            font-weight: 500;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .breadcrumb-item {
            color: var(--gray-600);
            cursor: pointer;
            transition: color 0.2s;
            font-weight: 500;
        }

        .breadcrumb-item:hover {
            color: var(--primary);
        }

        .breadcrumb-item.active {
            color: var(--gray-900);
            font-weight: 600;
            cursor: default;
        }

        .breadcrumb-separator {
            color: var(--gray-300);
            font-size: 0.75rem;
        }

        /* Accordion */
        .accordion-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .accordion-item {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: var(--shadow-sm);
        }

        .accordion-item:hover {
            box-shadow: var(--shadow-md);
        }

        .accordion-header {
            padding: 1.25rem 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background 0.2s;
        }

        .accordion-header:hover {
            background: var(--gray-50);
        }

        .accordion-header.active {
            background: #f0f7ff;
            border-bottom: 1px solid var(--border);
        }

        .dept-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .dept-icon {
            width: 40px;
            height: 40px;
            background: #e3f2fd;
            color: #1565c0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.125rem;
        }

        .dept-name {
            font-weight: 600;
            color: var(--gray-900);
            font-size: 1rem;
        }

        .accordion-icon {
            color: var(--gray-400);
            transition: transform 0.3s;
            font-size: 1.125rem;
        }

        .accordion-header.active .accordion-icon {
            transform: rotate(180deg);
            color: #1565c0;
        }

        .accordion-body {
            display: none;
            background: var(--gray-50);
        }

        .accordion-body.show {
            display: block;
            animation: slideDown 0.3s ease-out;
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

        .unit-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .unit-item {
            padding: 1rem 1.5rem 1rem 4rem;
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9375rem;
            color: var(--gray-700);
            transition: all 0.2s;
        }

        .unit-item:last-child {
            border-bottom: none;
        }

        .unit-item:hover {
            background: white;
            color: var(--primary);
            padding-left: 4.5rem;
        }

        .unit-item i {
            opacity: 0;
            transition: opacity 0.2s;
        }

        .unit-item:hover i {
            opacity: 1;
            /* transform: translateX(4px); */
        }

        /* Table Section */
        .table-section {
            background: white;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            border: 1px solid var(--border);
            margin-bottom: 2rem;
        }

        .table-header {
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
            background: var(--gray-50);
        }

        .table-header h2 {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 1rem 2rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-100);
        }

        th {
            background: var(--gray-50);
            font-weight: 600;
            color: var(--gray-600);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            font-size: 0.9375rem;
            color: var(--gray-700);
        }

        tr:hover {
            background: var(--surface-hover);
        }

        .status-pill {
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }

        .btn-action {
            padding: 0.5rem 1rem;
            background: var(--primary);
            color: white;
            border-radius: 0.5rem;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
        }

        .btn-action:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--gray-400);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            font-size: 0.875rem;
            color: var(--gray-500);
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Dashboard Direktur</h1>
                <div class="header-subtitle">{{ Carbon\Carbon::now()->format('l, d F Y') }}</div>
            </div>

            <div class="content-area">
                <!-- Statistics -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value" id="stat-depts">0</div>
                            <div class="stat-label">Total Departemen</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon green">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value" id="stat-units">0</div>
                            <div class="stat-label">Total Unit Kerja</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon orange">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value" id="stat-pending">0</div>
                            <div class="stat-label">Review PMK Pending</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value" id="stat-published">0</div>
                            <div class="stat-label">PMK Terpublikasi</div>
                        </div>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <div class="breadcrumb" id="breadcrumb">
                    <span class="breadcrumb-item active" onclick="resetView()">Home</span>
                </div>

                <!-- Dynamic Content -->
                <div id="dynamicContent"></div>
            </div>
        </main>
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

        $documentsList = $publishedData->map(fn($d) => [
            'id' => $d->id,
            'title' => $d->judul_dokumen ?? $d->kolom2_kegiatan,
            'unit_id' => $d->id_unit,
            'category' => $d->hasPmk() ? 'PMK' : 'HIRADC',
            'author' => $d->user->nama_user ?? 'Unknown',
            'date' => $d->published_at ? \Carbon\Carbon::parse($d->published_at)->format('d M Y') : '-',
        ]);

        $pendingList = $pendingData->map(fn($d) => [
            'id' => $d->id,
            'title' => $d->judul_dokumen ?? $d->kolom2_kegiatan,
            'unit' => $d->unit->nama_unit ?? '-',
            'date' => $d->updated_at->format('d M Y'),
            'status' => 'Menunggu Review'
        ]);
    @endphp

    <script>
        const departments = @json($departmentsData);
        const units = @json($unitsData);
        const documents = @json($documentsList);
        const pendingDocs = @json($pendingList);

        let currentLevel = 'dept';
        let selectedDept = null;
        let selectedUnit = null;

        document.addEventListener('DOMContentLoaded', () => {
            updateStats();
            renderDepartments();
        });

        function updateStats() {
            const regularDepts = departments.filter(d => d.id_dept != 0 && d.id_dept != 93);
            document.getElementById('stat-depts').textContent = regularDepts.length;
            document.getElementById('stat-units').textContent = units.length;
            document.getElementById('stat-pending').textContent = pendingDocs.length;
            document.getElementById('stat-published').textContent = documents.length;
        }

        function renderDepartments() {
            currentLevel = 'dept';
            selectedDept = null;
            selectedUnit = null;
            updateBreadcrumb();

            const container = document.getElementById('dynamicContent');
            let html = '';

            // Pending Documents Section
            if (pendingDocs.length > 0) {
                html += `
                    <div class="table-section" style="border-left: 4px solid #f59e0b;">
                        <div class="table-header" style="background: #fff8e1;">
                            <h2 style="color: #b45309;"><i class="fas fa-clock"></i> Dokumen PMK Menunggu Approval</h2>
                        </div>
                        <table>
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
                    let badgeColor = '#ffedd5';
                    let textColor = '#9a3412';

                    // Direksi View uses simple link
                    const reviewUrl = `/direksi/documents/${doc.id}/review`;

                    html += `
                        <tr>
                            <td>${doc.title}</td>
                            <td>${doc.unit}</td>
                            <td>${doc.date}</td>
                            <td>
                                <span class="status-pill" style="background:${badgeColor}; color:${textColor};">
                                    ${doc.status}
                                </span>
                            </td>
                            <td>
                                <a href="${reviewUrl}" class="btn-action" style="background:#f59e0b;">
                                    <i class="fas fa-signature"></i> Review
                                </a>
                            </td>
                        </tr>
                    `;
                });

                html += `</tbody></table></div>`;
            }

            // Published Documents Accordion
            html += '<h3 style="margin-bottom:1.5rem; color:var(--gray-900); font-size:1.25rem; font-weight:700;">Arsip Dokumen Terpublikasi (Seluruh Unit)</h3>';
            html += '<div class="accordion-container">';

            const regularDepts = departments.filter(d => d.id_dept != 0 && d.id_dept != 93);

            regularDepts.forEach(dept => {
                const deptUnits = units.filter(u => u.id_dept == dept.id_dept);

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

                if (deptUnits.length > 0) {
                    deptUnits.forEach(unit => {
                        html += `
                            <li class="unit-item" onclick="selectUnit(${unit.id_unit}, '${unit.nama_unit.replace(/'/g, "\\'")}', ${dept.id_dept})">
                                <span>${unit.nama_unit}</span>
                                <i class="fas fa-arrow-right"></i>
                            </li>
                        `;
                    });
                } else {
                    html += `<li class="unit-item" style="color: var(--gray-400); cursor: default;">Tidak ada Unit Kerja</li>`;
                }

                html += `</ul></div></div>`;
            });

            // Unassigned Units
            const unassignedDept = departments.find(d => d.id_dept == 0);
            if (unassignedDept) {
                const directUnits = units.filter(u => u.id_dept == 0 && u.id_unit != 0);
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

            html += '</div>';
            container.innerHTML = html;
        }

        function toggleDepartment(id) {
            const body = document.getElementById(`dept-${id}`);
            if (!body) return;
            const header = body.previousElementSibling;

            const isShown = body.classList.contains('show');

            document.querySelectorAll('.accordion-body').forEach(el => el.classList.remove('show'));
            document.querySelectorAll('.accordion-header').forEach(el => el.classList.remove('active'));

            if (!isShown) {
                body.classList.add('show');
                header.classList.add('active');
            }
        }

        function selectUnit(id, name, deptId) {
            const dept = departments.find(d => d.id_dept == deptId);
            selectedDept = { id: deptId, name: dept ? dept.nama_dept : '-' };
            selectedUnit = { id, name };
            currentLevel = 'docs';
            updateBreadcrumb();
            renderUnitDocs(id, name, deptId, 'ALL');
        }

        function renderUnitDocs(id, name, deptId, filterCategory) {
            const container = document.getElementById('dynamicContent');
            const rawDocs = documents.filter(doc => doc.unit_id == id);

            let unitDocs = [];
            rawDocs.forEach(doc => {
                unitDocs.push(doc);
            });

            // Filter logic (If category needed, but for Direksi it's PMK, maybe broad view)
            if (filterCategory !== 'ALL') {
                unitDocs = unitDocs.filter(doc => doc.category === filterCategory);
            }

            const categories = ['PMK', 'SHE', 'Security'];

            let html = `
                <div class="table-section">
                    <div class="table-header" style="flex-wrap: wrap; gap: 1rem;">
                        <div>
                            <h2 style="margin-bottom:0.25rem;">Laporan Terpublikasi - ${name}</h2>
                            <div style="font-size:0.875rem; color:var(--gray-500);">Menampilkan kategori: <b>${filterCategory}</b></div>
                        </div>
                        <div style="display:flex; gap:0.75rem; align-items:center;">
                            <select onchange="renderUnitDocs(${id}, '${name.replace(/'/g, "\\'")}', ${deptId}, this.value)" style="padding:0.5rem 1rem; border-radius:0.5rem; border:1px solid var(--border); font-size:0.875rem; cursor:pointer; font-family:inherit;">
                                <option value="ALL" ${filterCategory === 'ALL' ? 'selected' : ''}>Semua Kategori</option>
                                ${categories.map(c => `<option value="${c}" ${filterCategory === c ? 'selected' : ''}>${c}</option>`).join('')}
                            </select>
                            <button class="btn-action" style="background:var(--gray-600);" onclick="renderDepartments()"><i class="fas fa-arrow-left"></i> Kembali</button>
                        </div>
                    </div>
            `;

            if (unitDocs.length === 0) {
                html += `
                    <div class="empty-state">
                        <i class="fas fa-filter"></i>
                        <h3>Tidak ada dokumen</h3>
                        <p>Tidak ada dokumen terpublikasi untuk kategori <b>${filterCategory}</b>.</p>
                    </div>`;
            } else {
                html += `
                    <table>
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
                    let catColor = '#dcfce7';
                    let catText = '#166534'; // Green default for PMK/Approved

                    html += `
                        <tr>
                            <td>${doc.title}</td>
                            <td><span class="status-pill" style="background:${catColor}; color:${catText};">${doc.category || '-'}</span></td>
                            <td>${doc.author}</td>
                            <td>${doc.date}</td>
                            <td><span class="status-pill" style="background:#e8f5e9; color:#2e7d32;">DISETUJUI</span></td>
                            <td>
                                <a href="/documents/${doc.id}/published" class="btn-action">
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
                        <span class="breadcrumb-item" onclick="renderDepartments()">
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
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK',
                confirmButtonColor: '#16a34a'
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
                confirmButtonColor: '#ef4444'
            });
        </script>
    @endif

</body>

</html>