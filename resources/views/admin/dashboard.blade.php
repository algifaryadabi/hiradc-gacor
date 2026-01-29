<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #5b6fd8;
            --primary-dark: #4759c5;
            --secondary: #64748b;
            --bg-body: #f8fafc;
            --surface: #ffffff;
            --text-main: #1e293b;
            --text-sub: #64748b;
            --border: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        * {
            box-sizing: border-box;
            outline: none;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            display: flex;
        }

        /* Sidebar - Twin Design */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #5b6fd8 0%, #4759c5 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 4px 0 24px rgba(91, 111, 216, 0.15);
        }

        .logo-section {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
        }

        .logo-circle {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            background: transparent;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .logo-text {
            color: white;
            font-weight: 700;
            font-size: 1.125rem;
            margin-bottom: 0.25rem;
        }

        .logo-subtext {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.875rem;
        }

        .nav-menu {
            padding: 1.5rem 1rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 0.75rem;
            transition: all 0.2s;
            font-weight: 500;
        }

        .nav-item:hover,
        .nav-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(4px);
        }

        .nav-item.active {
            background: white;
            color: var(--primary);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.125rem;
        }

        .user-info {
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
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 700;
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
        }

        .logout-btn {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
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
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 40px;
            width: calc(100% - 280px);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.5px;
            margin: 0;
        }

        /* Stats Widgets */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: #f1f5f9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--secondary);
            margin-bottom: 16px;
        }

        .stat-card.primary .stat-icon { background: #e0e7ff; color: #4f46e5; }
        .stat-card.success .stat-icon { background: #dcfce7; color: #16a34a; }
        .stat-card.warning .stat-icon { background: #fef9c3; color: #ca8a04; }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-sub);
            font-weight: 500;
        }

        /* Existing Components Styling Update */
        .accordion-container {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            background: white;
            margin-top: 24px;
        }
        
        .accordion-item {
            border: none;
            border-bottom: 1px solid var(--border);
            border-radius: 0;
            margin: 0;
        }
        
        .accordion-header {
            padding: 20px 24px;
        }
        
        .accordion-header:hover {
            background: #f8fafc;
        }
        
        .accordion-header.active {
            background: #f1f5f9;
        }
        
        .dept-icon {
            border-radius: 10px;
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 6px rgba(91, 111, 216, 0.2);
        }
        
        .dept-name {
            font-size: 16px;
        }
        
        .unit-item {
            padding: 16px 24px 16px 76px;
        }
        
        .unit-item:hover {
            background: #f8fafc;
            color: var(--primary);
            padding-left: 80px;
        }
        
        .breadcrumb {
            background: white;
            padding: 12px 20px;
            border-radius: 99px;
            border: 1px solid var(--border);
            display: inline-flex;
            box-shadow: var(--shadow-sm);
        }
        
        .breadcrumb-item:hover {
            color: var(--primary);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: var(--primary);
            font-weight: 700;
        }
        
        .table-section {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            background: white;
        }
        
        .table-header {
            background: #f8fafc;
            padding: 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .table-header h3 {
            margin: 0;
            font-size: 18px;
            color: var(--text-main);
        }

        .btn-action {
            background: var(--primary);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            box-shadow: 0 2px 4px rgba(91, 111, 216, 0.2);
        }
        
        .btn-action:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }
    </style>
    </style>
</head>

<body>

    <aside class="sidebar">
        @include('admin.partials.sidebar')
    </aside>

    <main class="main-content">
        <div class="header">
            <div>
                <h1>Dashboard Admin</h1>
                <div style="font-size: 14px; color: #64748b; margin-top: 5px;">
                    Selamat datang kembali, {{ Auth::user()->nama_user }}
                </div>
            </div>
            
            <div id="breadcrumb">
                <!-- Breadcrumb will be rendered here by JS -->
            </div>
        </div>

        <!-- Stats Widgets -->
        <div class="stats-grid">
            <div class="stat-card primary">
                <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                <div class="stat-value">{{ $totalDocuments ?? 0 }}</div>
                <div class="stat-label">Total Dokumen</div>
            </div>
            <div class="stat-card success">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-value">{{ $publishedDocuments ?? 0 }}</div>
                <div class="stat-label">Terpublikasi</div>
            </div>
            <div class="stat-card warning">
                <div class="stat-icon"><i class="fas fa-building"></i></div>
                <div class="stat-value">{{ $departemens->count() ?? 0 }}</div>
                <div class="stat-label">Departemen</div>
            </div>
            <div class="stat-card" style="border-bottom: 4px solid #0ea5e9;">
                <div class="stat-icon" style="background: #e0f2fe; color: #0284c7;"><i class="fas fa-layer-group"></i></div>
                <div class="stat-value">{{ $units->count() ?? 0 }}</div>
                <div class="stat-label">Unit Kerja</div>
            </div>
        </div>

        <!-- All Published Documents Table -->
        <div class="table-section" style="margin-bottom: 40px;">
            <div class="table-header">
                <h3>Semua Dokumen Terpublikasi</h3>
                <div style="font-size: 13px; color: #64748b;">
                    Total: {{ $documents->count() }} Dokumen
                </div>
            </div>
            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse: collapse;">
                    <thead style="background:#f8fafc; border-bottom:1px solid #e2e8f0;">
                        <tr>
                            <th style="padding:16px 24px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase;">Judul ID</th>
                            <th style="padding:16px 24px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase;">Judul Dokumen</th>
                            <th style="padding:16px 24px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase;">Unit Kerja</th>
                            <th style="padding:16px 24px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase;">Kategori</th>
                            <th style="padding:16px 24px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase;">Tanggal</th>
                            <th style="padding:16px 24px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($documents as $doc)
                        <tr style="border-bottom:1px solid #f1f5f9; transition:background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                            <td style="padding:16px 24px; color:#64748b; font-size:12px;">#{{ $doc['id'] }}</td>
                            <td style="padding:16px 24px; font-weight:500; color:#334155;">{{ $doc['title'] }}</td>
                            <td style="padding:16px 24px;">{{ $doc['unit'] }}</td>
                            <td style="padding:16px 24px;">
                                <span style="background: {{ ($doc['category'] == 'SHE') ? '#dcfce7' : '#e0f2fe' }}; 
                                             color: {{ ($doc['category'] == 'SHE') ? '#166534' : '#075985' }}; 
                                             padding:4px 10px; border-radius:99px; font-size:11px; font-weight:600;">
                                    {{ $doc['category'] ?? '-' }}
                                </span>
                            </td>
                            <td style="padding:16px 24px; color:#64748b;">{{ $doc['date'] }}</td>
                            <td style="padding:16px 24px;">
                                <div class="action-btns" style="display:flex; gap:6px;">
                                    <a href="/documents/{{ $doc['id'] }}/published?filter={{ $doc['category'] }}" class="btn-icon" style="background:#3b82f6; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px; color:white; text-decoration:none;" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn-icon" style="background:#ef4444; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px; color:white; text-decoration:none;" title="Download PDF"><i class="fas fa-file-pdf"></i></a>
                                    <a href="#" class="btn-icon" style="background:#10b981; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px; color:white; text-decoration:none;" title="Download Excel"><i class="fas fa-file-excel"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="padding:40px; text-align:center; color:#94a3b8;">Tidak ada dokumen terpublikasi saat ini</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination if available -->
            @if(method_exists($documents, 'links'))
            <div style="padding: 16px 24px; border-top: 1px solid #e2e8f0;">
                {{ $documents->links('pagination::bootstrap-4') }}
            </div>
            @endif
        </div>

        <div class="content-area"> 
            <!-- Dynamic Content (Accordion) -->
            <div id="dynamicContent"></div>
        </div>
    </main>

    <!-- DETAIL MODAL REMOVED -->

    <script>
        @php
            // Preparing data for JS
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

        // Processed Data
        const departments = @json($departmentsData);
        const units = @json($unitsData);
        // Initial documents (if passed)
        const initialDocs = @json($documents ?? []);
        let documents = [...initialDocs];

        // State
        let currentLevel = 'dept';
        let selectedDept = null;
        let selectedUnit = null;

       document.addEventListener('DOMContentLoaded', () => {
             // Init with departments
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

let html = '<div class="accordion-container">';
            
            // 1. Regular Departments
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

            // 2. Unassigned Units (if any)
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
                co nst body = document.getElementById(`dept-${id}`);
                if(body) {
                    body.classList.add('show');
                    body.previousElementSibling.classLi st.add('active');
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
           
             // Show Loading
            container.innerHTML = `<div style="text-align: center; padding: 50px;"><i class="fas fa-spinner fa-spin" style="font-size: 30px; color: #c41e3a;"></i><br><br>Memuat dokumen...</div>`;

            // FETCH DATA via AJAX
            // Requires route: admin.dashboard.data
            fetch(`{{ route('admin.dashboard.data') }}?unit_id=${id}`)
                .then(response => response.json())
                .then(data => {
                    // Update global documents for modal lookup
                    data.forEach(newDoc => {
                        if (!documents.some(d => d.id === newDoc.id)) {
                            documents.push(newDoc);
                        }
});
                    
                    // After fetching, render the documents with the new function
                    renderUnitDocs(id, name, deptId, 'ALL');
                })
                .catch(error => {
                    console.error('Error fetching docs:', error);
                    container.innerHTML = `<div style="text-align: center; padding: 20px; color: red;">Gagal memuat dokumen. Silakan coba lagi.</div>`;
                });
        }

        function updateBreadcrumb() {
            const bc = document.getElementById('breadcrumb');
            let html = `<div class="breadcrumb">`; // Added wrapper with class
            html += `<span class="breadcrumb-item" onclick="renderDepartments()"><i class="fas fa-home"></i> Home</span>`;

            if (currentLevel === 'unit' || currentLevel === 'docs') {
                 if (selectedDept) {
                     html += `
                        <span class="breadcrumb-separator"><i class="fas fa-chevron-right"></i></span>
                        <span class="breadcrumb-item" onclick="selectDepartment(${selectedDept.id}, '${selectedDept.name.replace(/'/g, "\\'")}')">
                            <i class="fas fa-building" style="margin-right:5px; opacity:0.7;"></i> ${selectedDept.name}
                        </span>
                    `;
                 }
            }

            if (currentLevel === 'docs' && selectedUnit) {
                html += `
                    <span class="breadcrumb-separator"><i class="fas fa-chevron-right"></i></span>
                    <span class="breadcrumb-item active">
                        <i class="fas fa-layer-group" style="margin-right:5px; opacity:0.7;"></i> ${selectedUnit.name}
                    </span>
                `;
            }
            html += `</div>`; // Close wrapper
            bc.innerHTML = html;
        }

        function renderUnitDocs(id, name, deptId, filterCategory = 'ALL') {
             const container = document.getElementById('dynamicContent');
             const rawDocs = documents.filter(doc => doc.unit_id == id);
 
             // SPLIT MULTI-CATEGORY DOCS
             let unitDocs = [];
             if (Array.isArray(rawDocs)) {
                 rawDocs.forEach(doc => {
                     if (doc.category && doc.category.includes(',')) {
                         const cats = doc.category.split(',').map(c => c.trim());
                         cats.forEach(c => {
                             unitDocs.push({ ...doc, category: c });
                         });
                     } else {
                         unitDocs.push(doc);
                     }
                 });
             }
 
             // FILTER
             if (filterCategory !== 'ALL') {
                 unitDocs = unitDocs.filter(doc => doc.category === filterCategory);
             }
 
             // Categories available for filter
             const categories = ['SHE', 'Security'];
 
             let html = `
                 <div class="table-section">
                     <div class="table-header">
                         <div>
                             <h2 style="margin:0 0 5px 0; font-size:18px;">Dokumen Terpublikasi - ${name}</h2>
                             <div style="font-size:13px; color:#64748b;">Menampilkan kategori: <b>${filterCategory}</b></div>
                         </div>
                         <div style="display:flex; gap:12px; align-items:center;">
                             <select onchange="renderUnitDocs(${id}, '${name.replace(/'/g, "\\'")}', ${deptId}, this.value)" 
                                style="padding:8px 16px; border-radius:8px; border:1px solid #e2e8f0; font-size:13px; color:#1e293b; cursor:pointer; background:white; outline:none;">
                                 <option value="ALL" ${filterCategory === 'ALL' ? 'selected' : ''}>Semua Kategori</option>
                                 ${categories.map(c => `<option value="${c}" ${filterCategory === c ? 'selected' : ''}>${c}</option>`).join('')}
                             </select>
                             <button class="btn-action" style="background:#f1f5f9; color:#475569; border:1px solid #e2e8f0; box-shadow:none;" onclick="selectDepartment(${deptId})">
                                <i class="fas fa-arrow-left"></i> Kembali
                             </button>
                         </div>
                     </div>
             `;
 
             if (unitDocs.length === 0) {
                 html += `
                     <div style="text-align: center; padding: 60px 20px; color: #94a3b8;">
                         <div style="background:#f1f5f9; width:60px; height:60px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                            <i class="fas fa-filter" style="font-size:24px; color:#cbd5e1;"></i>
                         </div>
                         <p style="margin:0;">Tidak ada dokumen terpublikasi untuk kategori ini.</p>
                     </div>`;
             } else {
                 html += `
                     <div style="overflow-x:auto;">
                     <table style="width:100%; border-collapse: collapse;">
                         <thead style="background:#f8fafc; border-bottom:1px solid #e2e8f0;">
                             <tr>
                                 <th style="padding:16px 24px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.5px;">Judul Dokumen</th>
                                 <th style="padding:16px 24px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.5px;">Kategori</th>
                                 <th style="padding:16px 24px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.5px;">Penulis</th>
                                 <th style="padding:16px 24px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.5px;">Tanggal</th>
                                 <th style="padding:16px 24px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.5px;">Status</th>
                                 <th style="padding:16px 24px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.5px;">Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                 `;
 
                 unitDocs.forEach(doc => {
                     // Category Badge Color
                     let catColor = '#f1f5f9';
                     let catText = '#475569';
                     if(doc.category == 'SHE') { catColor = '#dcfce7'; catText = '#166534'; }
                     else if(doc.category == 'Security') { catColor = '#e0f2fe'; catText = '#075985'; }
 
                     html += `
                         <tr style="border-bottom:1px solid #f1f5f9; transition:background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                             <td style="padding:16px 24px; font-weight:500; color:#334155;">${doc.title}</td>
                             <td style="padding:16px 24px;"><span style="background:${catColor}; color:${catText}; padding:4px 10px; border-radius:99px; font-size:11px; font-weight:600;">${doc.category || '-'}</span></td>
                             <td style="padding:16px 24px; color:#64748b;">${doc.author}</td>
                             <td style="padding:16px 24px; color:#64748b;">${doc.date}</td>
                             <td style="padding:16px 24px;"><span style="background:#dcfce7; color:#166534; padding:4px 10px; border-radius:99px; font-size:11px; font-weight:700;">DISETUJUI</span></td>
                             <td style="padding:16px 24px;">
                                 <a href="/documents/${doc.id}/published?filter=${doc.category}" class="btn-action" style="text-decoration:none; display:inline-flex; align-items:center; gap:6px;">
                                     <i class="fas fa-eye"></i> Detail
                                 </a>
                             </td>
                         </tr>
                     `;
                 });
 
                 html += `</tbody></table></div>`;
             }
             
             html += `</div></div>`; // Close Header and container
             container.innerHTML = html;
         }

        function resetView() {
            renderDepartments();
        }
    </script>
</body>

</html>