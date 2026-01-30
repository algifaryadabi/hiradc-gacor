<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Approver | HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* ========================================
           DESIGN SYSTEM - CSS CUSTOM PROPERTIES
           ======================================== */
        :root {
            /* Brand Colors - PT Semen Padang */
            --primary: #c41e3a;
            --primary-dark: #9a1829;
            --primary-light: #e63950;
            --primary-50: #fef2f3;
            --primary-100: #fce7e9;
            --primary-200: #f9d0d4;
            --primary-600: #c41e3a;

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

            /* Semantic Colors */
            --success: #10b981;
            --success-light: #d1fae5;
            --warning: #f59e0b;
            --warning-light: #fef3c7;
            --error: #ef4444;
            --error-light: #fee2e2;
            --info: #3b82f6;
            --info-light: #dbeafe;

            /* Surface & Background */
            --bg-body: #f1f5f9;
            --surface: #ffffff;
            --surface-hover: #f9fafb;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
            --border-radius: 16px;

            /* Typography */
            --font-sans: 'Plus Jakarta Sans', sans-serif;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --text-tertiary: #9ca3af;
            --text-inverse: #ffffff;

            /* Shadows */
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            --shadow-colored: 0 10px 25px -5px rgba(196, 30, 58, 0.15);

            /* Spacing */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;

            /* Radius */
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-full: 9999px;
            
            /* Legacy Compat */
             --sidebar-bg: #5b6fd8; 
        }

        /* Base Styles */
        * { margin: 0; padding: 0; box-sizing: border-box; outline: none; }
        body {
            font-family: var(--font-sans);
            background: var(--bg-body);
            background-image:
                radial-gradient(at 0% 0%, rgba(196, 30, 58, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container { display: flex; min-height: 100vh; }

        /* Sidebar - Reference Design */
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
        
        .logo-section { padding: var(--space-8) var(--space-6); border-bottom: 1px solid rgba(255, 255, 255, 0.15); text-align: center; position: relative; }
        .logo-section::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.3) 50%, transparent 100%); }
        .logo-circle { width: 90px; height: 90px; margin: 0 auto var(--space-5); background: transparent; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s; }
        .logo-circle:hover { transform: scale(1.05); }
        .logo-circle img { max-width: 100%; max-height: 100%; object-fit: contain; filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.15)); }
        .logo-text { font-size: 1.125rem; font-weight: 700; color: white; margin-bottom: var(--space-1); text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15); }
        .logo-subtext { font-size: 0.75rem; color: rgba(255, 255, 255, 0.9); font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; }
        
        .nav-menu { flex: 1; padding: var(--space-6) 0; overflow-y: auto; scrollbar-width: thin; scrollbar-color: var(--gray-300) transparent; }
        
        .nav-item { padding: var(--space-4) var(--space-6); margin: var(--space-1) var(--space-4); display: flex; align-items: center; gap: var(--space-3); color: rgba(255,255,255,0.85); font-weight: 500; text-decoration: none; border-radius: var(--radius-lg); transition: all 0.2s; font-size: 0.9375rem; position: relative; }
        .nav-item:hover { background: rgba(255,255,255,0.15); color: white; transform: translateX(4px); }
        .nav-item.active { background: rgba(255,255,255,0.25); color: white; font-weight: 600; box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
        .nav-item.active::before { content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 4px; height: 60%; background: white; border-radius: 0 4px 4px 0; }
        .nav-item i { width: 24px; text-align: center; font-size: 1.125rem; }
        
        .badge { background: #ef4444; color: white; font-size: 0.65rem; padding: 2px 8px; border-radius: 99px; font-weight: 700; margin-left: auto; }

        .user-info-bottom { padding: var(--space-6); border-top: 1px solid rgba(255,255,255,0.15); background: transparent; }
        .user-profile { display: flex; align-items: center; gap: var(--space-3); margin-bottom: var(--space-4); }
        .user-avatar { width: 48px; height: 48px; background: var(--surface); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #667eea; font-weight: 700; font-size: 1.125rem; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border: 2px solid rgba(255,255,255,0.2); flex-shrink: 0; }
        .user-details { flex: 1; min-width: 0; }
        .user-name { font-weight: 600; font-size: 0.9375rem; color: white; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 2px; }
        .user-role { font-size: 0.75rem; color: rgba(255,255,255,0.85); }
        .logout-btn { width: 100%; padding: var(--space-3); background: rgba(255,255,255,0.15); color: white; border: 1px solid rgba(255,255,255,0.25); border-radius: var(--radius-lg); font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none; backdrop-filter: blur(10px); }
        .logout-btn:hover { background: rgba(255,255,255,0.25); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.2); }

        /* Main Content */
        .main-content { flex: 1; margin-left: 280px; padding: 0; background: var(--bg-body); }
        .header { background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%); padding: var(--space-8) var(--space-10); border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; box-shadow: var(--shadow-sm); position: sticky; top: 0; z-index: 50; backdrop-filter: blur(8px); }
        .header h1 { font-size: 1.875rem; font-weight: 800; color: var(--text-primary); letter-spacing: -0.02em; }
        .header::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent 0%, var(--primary) 50%, transparent 100%); opacity: 0.3; }

        .content-area { padding: var(--space-10); max-width: 1600px; margin: 0 auto; }

        /* Breadcrumb */
        .breadcrumb { display: flex; align-items: center; gap: 10px; margin-bottom: var(--space-6); font-size: 0.875rem; color: var(--text-secondary); }
        .breadcrumb-item { cursor: pointer; transition: color 0.2s; font-weight: 500; }
        .breadcrumb-item:hover { color: var(--primary); }
        .breadcrumb-item.active { font-weight: 600; color: var(--text-primary); cursor: default; }
        .breadcrumb-separator { color: var(--gray-300); font-size: 0.75rem; }

        /* Stats Cards (New Addition) */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: var(--space-6); margin-bottom: var(--space-8); }
        .stat-card { background: var(--surface); padding: var(--space-6); border-radius: var(--radius-xl); box-shadow: var(--shadow-sm); display: flex; align-items: center; gap: var(--space-4); border: 1px solid var(--border); transition: all 0.2s; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: var(--primary-200); }
        .stat-icon { width: 56px; height: 56px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; background: var(--gray-50); color: var(--gray-500); }
        .stat-info h3 { font-size: 0.875rem; color: var(--text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; }
        .stat-info .value { font-size: 1.75rem; font-weight: 800; color: var(--text-primary); line-height: 1; }
        .stat-icon.primary { background: var(--primary-50); color: var(--primary); }
        .stat-icon.warning { background: var(--warning-light); color: var(--warning); }
        .stat-icon.success { background: var(--success-light); color: var(--success); }

        /* Clean PIC Card */
        .pic-card { background: var(--surface); padding: var(--space-8); border-radius: var(--radius-xl); box-shadow: var(--shadow-colored); border: 1px solid var(--primary-100); margin-bottom: var(--space-8); position: relative; overflow: hidden; }
        .pic-card::before { content: ''; position: absolute; top:0; left:0; width: 4px; height: 100%; background: var(--primary); }
        .pic-header { display: flex; align-items: center; gap: var(--space-3); margin-bottom: var(--space-6); }
        .pic-header i { font-size: 1.5rem; color: var(--primary); }
        .pic-header h3 { font-size: 1.25rem; font-weight: 700; color: var(--text-primary); }
        
        /* Modern Select & Button */
        .form-control { padding: 10px 16px; border: 1px solid var(--border); border-radius: var(--radius-lg); font-size: 0.9375rem; width: 100%; font-family: var(--font-sans); transition: all 0.2s; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-50); }
        .btn-primary { padding: 10px 24px; background: var(--primary); color: white; border: none; border-radius: var(--radius-lg); font-weight: 600; cursor: pointer; transition: all 0.2s; font-family: var(--font-sans); }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(196, 30, 58, 0.2); }

        /* Accordion Styles - Refined */
        .accordion-container { margin-top: var(--space-6); display: flex; flex-direction: column; gap: var(--space-3); }
        .accordion-item { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-xl); overflow: hidden; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: var(--shadow-xs); }
        .accordion-item:hover { box-shadow: var(--shadow-md); border-color: var(--primary-200); transform: translateY(-2px); }
        .accordion-header { padding: var(--space-5) var(--space-6); cursor: pointer; display: flex; align-items: center; justify-content: space-between; background: var(--surface); transition: background 0.2s; }
        .accordion-header:hover { background: var(--gray-50); }
        .accordion-header.active { background: var(--primary-50); border-bottom: 1px solid var(--primary-100); }
        
        .dept-info { display: flex; align-items: center; gap: var(--space-4); }
        .dept-icon { width: 40px; height: 40px; background: var(--info-light); color: var(--info); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.125rem; }
        .dept-name { font-weight: 700; color: var(--text-primary); font-size: 1rem; }
        .accordion-header.active .dept-icon { background: white; color: var(--primary); }
        .accordion-header.active .dept-name { color: var(--primary-dark); }
        
        .accordion-icon { color: var(--text-tertiary); transition: transform 0.3s; }
        .accordion-header.active .accordion-icon { transform: rotate(180deg); color: var(--primary); }
        
        .accordion-body { display: none; background: var(--gray-50); border-top: 1px solid var(--border); }
        .accordion-body.show { display: block; animation: slideDown 0.3s ease-out; }
        
        .unit-list { list-style: none; padding: 0; margin: 0; }
        .unit-item { padding: var(--space-4) var(--space-6); padding-left: 80px; border-bottom: 1px solid var(--border-light); cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-size: 0.9375rem; color: var(--text-secondary); transition: all 0.2s; font-weight: 500; }
        .unit-item:last-child { border-bottom: none; }
        .unit-item:hover { background: white; color: var(--primary); padding-left: 85px; }
        .unit-item i { opacity: 0; transition: opacity 0.2s; color: var(--primary); }
        .unit-item:hover i { opacity: 1; transform: translateX(4px); }
        
        /* Table Styles - Twin Code */
        .table-section { background: var(--surface); border-radius: var(--radius-xl); box-shadow: var(--shadow-sm); overflow: hidden; border: 1px solid var(--border); margin-top: var(--space-6); animation: fadeIn 0.4s ease-out; }
        .table-header { padding: var(--space-6); display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border); background: linear-gradient(to bottom, var(--surface), var(--gray-50)); }
        .table-header h2 { font-size: 1.125rem; font-weight: 700; color: var(--text-primary); }
        
        .custom-table { width: 100%; border-collapse: collapse; }
        .custom-table thead { background: var(--gray-50); border-bottom: 2px solid var(--border); }
        .custom-table th { padding: var(--space-4) var(--space-6); text-align: left; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.05em; }
        .custom-table td { padding: var(--space-4) var(--space-6); font-size: 0.9375rem; color: var(--text-primary); border-bottom: 1px solid var(--border-light); vertical-align: middle; }
        .custom-table tr:hover { background: var(--surface-hover); }
        
        .status-pill { padding: 4px 12px; border-radius: 99px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; display: inline-flex; align-items: center; }
        .btn-action { padding: 6px 14px; background: var(--primary); color: white; border-radius: 6px; text-decoration: none; font-size: 0.75rem; font-weight: 600; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-action:hover { background: var(--primary-dark); transform: translateY(-1px); }
        .btn-secondary { background: var(--surface); color: var(--text-secondary); border: 1px solid var(--border); }
        .btn-secondary:hover { background: var(--gray-50); color: var(--text-primary); border-color: var(--gray-300); }

        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        @include('approver.partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Dashboard Approver</h1>
            </div>

            <div class="content-area">
                <!-- Breadcrumb -->
                <div class="breadcrumb" id="breadcrumb">
                    <span class="breadcrumb-item active" onclick="resetView()">Home</span>
                </div>

                <!-- Stats Grid (Added) -->
                <!-- Stats Grid Removed as per request -->

                <!-- PIC Card (Only for Kepala Unit) -->
                 @if(isset($currentPIC) || isset($staffList))
                    @if(Auth::user()->role_jabatan == 3)
                    <div class="pic-card">
                        <div class="pic-header">
                            <i class="fas fa-user-shield"></i>
                            <h3>Akses Pembuatan Form (PIC)</h3>
                        </div>
                        
                        <div style="margin-bottom: 24px; padding: 16px; background: var(--primary-50); border-radius: var(--radius-lg); border: 1px solid var(--primary-200); display: flex; align-items: center; gap: 12px;">
                            <div style="font-weight: 600; color: var(--primary-dark);">PIC Saat Ini:</div>
                            <span id="currentPICName" style="font-size: 1.125rem; font-weight: 800; color: var(--primary);">
                                {{ $currentPIC ? $currentPIC->nama_user : 'Belum ada PIC yang ditugaskan' }}
                            </span>
                        </div>
                        
                        <div style="display: flex; gap: 15px; align-items: flex-end; max-width: 600px;">
                            <div style="flex: 1;">
                                <label style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px;">
                                    Pilih Staff Baru
                                </label>
                                <select id="picDropdown" class="form-control">
                                    <option value="">-- Pilih Staff --</option>
                                    @foreach($staffList as $staff)
                                        <option value="{{ $staff->id_user }}" {{ $currentPIC && $currentPIC->id_user == $staff->id_user ? 'selected' : '' }}>
                                            {{ $staff->nama_user }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button onclick="updatePIC(event)" class="btn-primary">
                                <i class="fas fa-save" style="margin-right: 6px;"></i> Update PIC
                            </button>
                        </div>
                    </div>
                    @endif
                @endif

                <!-- Dynamic Content (Accordion) -->
                <div id="dynamicContent"></div>
            </div>
        </main>
    </div>

    <!-- Scripts (Using existing logic but updated styling) -->
    <script>
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

        const departments = @json($departmentsData);
        const units = @json($unitsData);
        let documents = @json($publishedDocuments); 

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
                 container.innerHTML = `<div class="empty-state"><i class="fas fa-building"></i><p>Tidak ada departemen ditemukan.</p></div>`;
                 return;
            }

            let html = '<div class="accordion-container">';
            
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
                        // FIX: Escape Names properly
                        html += `
                            <li class="unit-item" onclick="selectUnit(${unit.id_unit}, '${unit.nama_unit.replace(/'/g, "\\'")}', ${dept.id_dept})">
                                <span>${unit.nama_unit}</span>
                                <i class="fas fa-arrow-right"></i>
                            </li>
                        `;
                    });
                } else {
                    html += `<li class="unit-item" style="color: var(--text-tertiary); cursor: default;">Tidak ada Unit Kerja</li>`;
                }

                html += `</ul></div></div>`;
            });

            // Unassigned
            const unassignedDept = departments.find(d => d.id_dept == 0);
            if (unassignedDept) {
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
                if(body) {
                    body.classList.add('show');
                    body.previousElementSibling.classList.add('active');
                    body.parentElement.scrollIntoView({behavior: 'smooth'});
                }
            }, 50);
        }

        function selectUnit(id, name, deptId) {
            const dept = departments.find(d => d.id_dept == deptId);
            selectedDept = { id: deptId, name: dept ? dept.nama_dept : '-' };
            selectedUnit = { id, name };
            currentLevel = 'docs';
            updateBreadcrumb();

            const container = document.getElementById('dynamicContent');
            container.innerHTML = `<div style="text-align: center; padding: 50px;"><i class="fas fa-spinner fa-spin" style="font-size: 30px; color: var(--primary);"></i><br><br>Memuat dokumen...</div>`;

            fetch(`{{ route('approver.dashboard.data') }}?unit_id=${id}`)
                .then(response => response.json())
                .then(data => {
                    documents = data;
                    renderDocumentsTable(name, deptId, data);
                })
                .catch(error => {
                    console.error('Error fetching docs:', error);
                    container.innerHTML = `<div style="text-align: center; padding: 20px; color: red;">Gagal memuat dokumen. Silakan coba lagi.</div>`;
                });
        }

        function renderDocumentsTable(unitName, deptId, rawDocs, filterCategory = 'ALL') {
            const container = document.getElementById('dynamicContent');
            
            let docs = [];
            if (Array.isArray(rawDocs)) {
                rawDocs.forEach(doc => {
                    if (doc.category && doc.category.includes(',')) {
                        const cats = doc.category.split(',').map(c => c.trim());
                        cats.forEach(c => { docs.push({ ...doc, category: c }); });
                    } else {
                        docs.push(doc);
                    }
                });
            }

            if (filterCategory !== 'ALL') {
                docs = docs.filter(doc => doc.category === filterCategory);
            }

            const categories = ['SHE', 'Security'];

            let html = `
                <div class="table-section">
                    <div class="table-header">
                        <div>
                            <h2>Dokumen Terpublikasi</h2>
                            <div style="font-size:0.875rem; color:var(--text-secondary); margin-top:4px;">${unitName}</div>
                        </div>
                         <div style="display:flex; gap:10px; align-items:center;">
                            <select onchange="renderDocumentsTable('${unitName.replace(/'/g, "\\'")}', ${deptId}, documents, this.value)" class="form-control" style="width:auto; padding:6px 12px; font-size:0.875rem;">
                                <option value="ALL" ${filterCategory === 'ALL' ? 'selected' : ''}>Semua Kategori</option>
                                ${categories.map(c => `<option value="${c}" ${filterCategory === c ? 'selected' : ''}>${c}</option>`).join('')}
                            </select>
                            <button class="btn-action btn-secondary" onclick="selectDepartment(${deptId})"><i class="fas fa-arrow-left"></i> Kembali</button>
                        </div>
                    </div>
            `;

            if (docs.length === 0) {
                 html += `<div style="text-align: center; padding: 60px; color: var(--text-tertiary);"><i class="fas fa-folder-open" style="font-size:48px; margin-bottom:15px; opacity:0.5;"></i><p>Belum ada dokumen untuk kategori <b>${filterCategory}</b>.</p></div>`;
            } else {
                html += `
                    <div style="overflow-x:auto;">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Judul Dokumen</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                docs.forEach(doc => {
                    let catColor, catText;
                    if(doc.category == 'SHE') { catColor = '#dcfce7'; catText = '#166534'; }
                    else if(doc.category == 'Security') { catColor = '#e0f2fe'; catText = '#075985'; }
                    else { catColor = '#f3f4f6'; catText = '#374151'; }

                    html += `
                        <tr>
                            <td style="font-weight:600;">${doc.title}</td>
                            <td><span class="status-pill" style="background:${catColor}; color:${catText};">${doc.category || '-'}</span></td>
                            <td>${doc.author}</td>
                            <td style="font-size:0.875rem; color:var(--text-secondary);">${doc.date}</td>
                            <td><span class="status-pill" style="background:#ecfdf5; color:#047857;">DISETUJUI</span></td>
                            <td style="text-align:center;">
                                <a href="/documents/${doc.id}/published?filter=${doc.category}" class="btn-action">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    `;
                });

                html += `</tbody></table></div>`;
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

        function updatePIC(e) {
            const staffId = document.getElementById('picDropdown').value;
            
            if (!staffId) {
                Swal.fire({ icon:'warning', title:'Perhatian', text:'Silakan pilih staff terlebih dahulu', confirmButtonColor: '#c41e3a' });
                return;
            }

            if(e && e.target) { e.target.disabled = true; e.target.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...'; }

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
                if(e && e.target) { e.target.disabled = false; e.target.innerHTML = '<i class="fas fa-save" style="margin-right: 6px;"></i> Update PIC'; }
                
                if (data.success) {
                    document.getElementById('currentPICName').textContent = data.staff_name;
                    Swal.fire({ icon: 'success', title: 'PIC Updated', text: `${data.staff_name} sekarang memiliki akses pembuatan form.`, confirmButtonColor: '#c41e3a' });
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: data.message, confirmButtonColor: '#c41e3a' });
                }
            })
            .catch(error => {
                if(e && e.target) { e.target.disabled = false; e.target.innerHTML = '<i class="fas fa-save" style="margin-right: 6px;"></i> Update PIC'; }
                console.error('Error:', error);
                Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan sistem.', confirmButtonColor: '#c41e3a' });
            });
        }
    </script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
</body>
</html>