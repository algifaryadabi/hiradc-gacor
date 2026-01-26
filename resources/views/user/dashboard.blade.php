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
            z-index: 100;
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
            padding: 0;
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

        /* Responsive Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        /* Card Style */
        .drill-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: left;
            border: 1px solid transparent;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 140px;
            position: relative;
            overflow: hidden;
        }

        .drill-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-color: #ffe5e5;
        }

        .drill-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: #c41e3a;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .drill-card:hover::before {
            opacity: 1;
        }

        .drill-card-icon {
            width: 40px;
            height: 40px;
            background: #fff5f5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #c41e3a;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .drill-card h3 {
            font-size: 16px;
            color: #333;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .drill-card p {
            font-size: 13px;
            color: #666;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px;
            color: #999;
        }

        .empty-state i {
            font-size: 40px;
            margin-bottom: 15px;
        }

        /* Table Section */
        .table-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid #eee;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-header {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            background-color: #fbfbfb;
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
            padding: 15px 20px;
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
            padding: 15px 20px;
            font-size: 14px;
            color: #555;
            vertical-align: middle;
        }

        .status-pill {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
        }

        .status-pill.approved {
            background-color: #e8f5e9;
            color: #2e7d32;
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
        }

        .btn-action:hover {
            background: #a01830;
        }

        /* Modal */
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
                transform: translateY(0);
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

        /* Accordion Style */
        .accordion-container {
            max-width: 100%;
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
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        @include('user.partials.sidebar')

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
                <!-- Dynamic Content Container -->
                <div id="dynamicContent">
                    <!-- Javascript will render content here -->
                </div>
            </div>
        </main>
    </div>
    <!-- DETAIL MODAL -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Detail Form</h2><span class="close-btn" onclick="closeModal()">&times;
                </span>
            </div>
            <div class="modal-body">
                <!-- Data populated by JS -->
                <div class="section-title"><i class="fas fa-file-alt"></i>Informasi Form </div>
                <div class="info-row">
                    <div class="info-label">Judul Form:</div>
                    <div class="info-value" id="m_title"></div>
                </div>
                <!-- Add other fields as needed -->
                <div class="info-row">
                    <div class="info-label">Status:</div>
                    <div class="info-value"><span class="status-pill approved" id="m_status"></span></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Unit Kerja:</div>
                    <div class="info-value" id="m_unit"></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Penulis:</div>
                    <div class="info-value" id="m_author"></div>
                </div>
                <hr style="border: 0; border-top: 1px solid #eee; margin: 25px 0;">
                <div class="section-title green"><i class="fas fa-check-circle"></i>Informasi Persetujuan
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Publish:</div>
                    <div class="info-value" id="m_date"></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Disetujui Oleh:</div>
                    <div class="info-value" id="m_approver"></div>
                </div>
            </div>
        </div>
    </div>
    <script> // Data from Server
        const departments =
            @json($departemens)
            ;
        const units =
            @json($units)
            ;
        const documents =
            @json($documents)
            ;

        // State
        let currentLevel = 'dept'; // dept, unit, docs
        let selectedDept = null;
        let selectedUnit = null;

        document.addEventListener('DOMContentLoaded', () => {
            renderDepartments();
        });

        // ================= RENDER FUNCTIONS =================

        // Level 1: Departments (Accordion List)
        function renderDepartments() {
            currentLevel = 'dept';
            selectedDept = null;
            selectedUnit = null;
            updateBreadcrumb();

            const container = document.getElementById('dynamicContent');

            if (departments.length === 0) {
                container.innerHTML = `<div class="empty-state"><i class="fas fa-building"></i><p>Tidak ada departemen ditemukan.</p></div>`;
                return;
            }

            let html = '<div class="accordion-container">';
            
            // 1. Regular Departments (Excluding ID 0 and ID 93)
            const regularDepts = departments.filter(d => d.id_dept != 0 && d.id_dept != 93);

            regularDepts.forEach(dept => {
                // Pre-calculate units for this dept to check if empty
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

            // Toggle Logic
            const isShown = body.classList.contains('show');

            if (!isShown) {
                // Close others
                document.querySelectorAll('.accordion-body').forEach(el => el.classList.remove('show'));
                document.querySelectorAll('.accordion-header').forEach(el => el.classList.remove('active'));

                body.classList.add('show');
                header.classList.add('active');
            } else {
                body.classList.remove('show');
                header.classList.remove('active');
            }
        }

        // Helper to simulate selecting a department (for breadcrumb)
        function selectDepartment(id, name) {
            renderDepartments();
            // Expand the department
            setTimeout(() => {
                const body = document.getElementById(`dept-${id}`);
                if (body) {
                    body.classList.add('show');
                    body.previousElementSibling.classList.add('active');
                    // Scroll to it
                    body.parentElement.scrollIntoView({ behavior: 'smooth' });
                }
            }, 50);
        }

        // Level 3: Documents (Drill down from Accordion Unit click)
        function selectUnit(id, name, deptId) {
            // Find dept name if not already selected
            const dept = departments.find(d => d.id_dept == deptId);
            selectedDept = { id: deptId, name: dept ? dept.nama_dept : '-' };

            selectedUnit = { id, name };
            currentLevel = 'docs';
            updateBreadcrumb();

            const container = document.getElementById('dynamicContent');
            const unitDocs = documents.filter(doc => doc.unit_id == id);

            let html = `
                <div class="table-section">
                    <div class="table-header">
                        <h2>Dokumen Terpublikasi - ${name}</h2>
                         <button class="btn-action" style="background:#666;" onclick="selectDepartment(${deptId})"><i class="fas fa-arrow-left"></i> Kembali</button>
                    </div>
            `;

            if (unitDocs.length === 0) {
                html += `<div class="empty-state" style="padding: 30px;"><i class="fas fa-file-contract"></i><p>Belum ada dokumen yang dipublish dari Unit ini.</p></div>`;
            } else {
                html += `
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Judul Dokumen</th>
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
                    html += `
                        <tr>
                            <td>${doc.title}</td>
                            <td>${doc.category || '-'}</td>
                            <td>${doc.author}</td>
                            <td>${doc.date}</td>
                            <td><span class="status-pill approved">DISETUJUI</span></td>
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

        // ================= HELPERS =================

        function updateBreadcrumb() {
            const bc = document.getElementById('breadcrumb');
            let html = `<span class="breadcrumb-item" onclick="renderDepartments()">Home</span>`;

            if (currentLevel === 'unit' || currentLevel === 'docs') {
                // In accordion view, 'unit' level is visually same as home but expanded. 
                // But strictly speaking we just have Home > [optional Dept] > [Unit]
                // Since we use drill down for Docs, we can show Dept.

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
            document.getElementById('m_approver').innerText = doc.approver || '-';

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
</body>

</html>