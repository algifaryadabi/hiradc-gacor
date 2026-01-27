<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f6f9;
            margin: 0;
            display: flex; /* Flex layout directly on body like admin/users */
        }

        /* Sidebar from admin/users */
        .sidebar {
            width: 250px;
            background: white;
            height: 100vh;
            position: fixed;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            z-index: 10;
        }

        .logo-section {
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .logo-section img {
            width: 50px;
            margin-bottom: 10px;
        }

        .nav-menu {
            padding: 20px 0;
            flex: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: #555;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-item i {
            width: 25px;
            text-align: center;
            margin-right: 10px;
        }

        .nav-item:hover,
        .nav-item.active {
            background: #fee2e2;
            color: #c41e3a;
            border-left: 4px solid #c41e3a;
        }

        .user-section {
            padding: 20px;
            border-top: 1px solid #eee;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .logout-btn {
            display: block;
            text-align: center;
            padding: 10px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
            margin: 0;
        }

        /* Accordion Styles (from unit-pengelola) */
        .accordion-container { max-width: 100%; margin-top: 20px; }
        .accordion-item { background: white; border: 1px solid #e0e0e0; border-radius: 8px; margin-bottom: 10px; overflow: hidden; transition: all 0.3s; }
        .accordion-item:hover { box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); }
        .accordion-header { padding: 15px 20px; cursor: pointer; display: flex; align-items: center; justify-content: space-between; background: #fff; transition: background 0.2s; }
        .accordion-header:hover { background: #f8f9fa; }
        .accordion-header.active { background: #f0f7ff; border-bottom: 1px solid #e0e0e0; }
        .dept-info { display: flex; align-items: center; gap: 15px; }
        .dept-icon { width: 36px; height: 36px; background: #e3f2fd; color: #1565c0; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 16px; }
        .dept-name { font-weight: 600; color: #333; font-size: 15px; }
        .accordion-icon { color: #999; transition: transform 0.3s; }
        .accordion-header.active .accordion-icon { transform: rotate(180deg); color: #1565c0; }
        .accordion-body { display: none; background: #fafafa; border-top: 1px solid #f0f0f0; }
        .accordion-body.show { display: block; animation: slideDown 0.3s ease-out; }
        .unit-list { list-style: none; padding: 0; margin: 0; }
        .unit-item { padding: 12px 20px 12px 60px; border-bottom: 1px solid #eee; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-size: 14px; color: #555; transition: all 0.2s; }
        .unit-item:last-child { border-bottom: none; }
        .unit-item:hover { background: #fff; color: #c41e3a; padding-left: 65px; }
        .unit-item i { opacity: 0; transition: opacity 0.2s; }
        .unit-item:hover i { opacity: 1; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Breadcrumb */
        .breadcrumb { display: flex; align-items: center; gap: 10px; margin-bottom: 25px; font-size: 14px; color: #666; }
        .breadcrumb-item { cursor: pointer; transition: color 0.2s; }
        .breadcrumb-item:hover { color: #c41e3a; text-decoration: underline; }
        .breadcrumb-item.active { font-weight: 600; color: #333; cursor: default; text-decoration: none; }
        .breadcrumb-separator { color: #ccc; font-size: 12px; }

         /* Table Section */
        .table-section { background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); overflow: hidden; border: 1px solid #eee; animation: fadeIn 0.3s ease-out; margin-top: 20px;}
        .table-header { padding: 20px 25px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; background-color: #fbfbfb; }
        .btn-action { padding: 6px 14px; background: #c41e3a; color: white; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 500; transition: background 0.2s; cursor: pointer; display: inline-block;}
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
                <div style="font-size: 14px; color: #666; margin-top: 5px;">
                    Navigasi Dokumen per Unit Kerja
                </div>
            </div>
            <!-- User Profile removed from header since it is in sidebar user-section now -->
        </div>

        <div class="content-area" style="padding: 0;"> <!-- Remove padding here if handled by main-content -->

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
                     <div class="table-header" style="flex-wrap: wrap; gap: 10px;">
                         <div>
                             <h2 style="margin-bottom:5px;">Dokumen Terpublikasi - ${name}</h2>
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
                     <table class="custom-table" style="width:100%; border-collapse: collapse;">
                         <thead style="background:#fff; border-bottom:2px solid #f0f0f0;">
                             <tr>
                                 <th style="padding:15px; text-align:left;">Judul Dokumen</th>
                                 <th style="padding:15px; text-align:left;">Unit Pengelola</th>
                                 <th style="padding:15px; text-align:left;">Penulis</th>
                                 <th style="padding:15px; text-align:left;">Tanggal</th>
                                 <th style="padding:15px; text-align:left;">Status</th>
                                 <th style="padding:15px; text-align:left;">Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                 `;
 
                 unitDocs.forEach(doc => {
                     // Category Badge Color
                     let catColor = '#e0e0e0';
                     let catText = '#333';
                     if(doc.category == 'SHE') { catColor = '#dcfce7'; catText = '#166534'; }
                     else if(doc.category == 'Security') { catColor = '#e0f2fe'; catText = '#075985'; }
 
                     html += `
                         <tr style="border-bottom:1px solid #eee;">
                             <td style="padding:15px;">${doc.title}</td>
                             <td style="padding:15px;"><span class="status-pill" style="background:${catColor}; color:${catText};">${doc.category || '-'}</span></td>
                             <td style="padding:15px;">${doc.author}</td>
                             <td style="padding:15px;">${doc.date}</td>
                             <td style="padding:15px;"><span class="status-pill" style="background:#e8f5e9; color:#2e7d32; padding:4px 12px; border-radius:15px; font-size:11px; font-weight:700;">DISETUJUI</span></td>
                             <td style="padding:15px;">
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
    </script>
</body>

</html>