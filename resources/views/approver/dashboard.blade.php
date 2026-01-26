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

    
        /* ADD Accordion Styles */
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
    <div class="container">
        <!-- Sidebar -->
        @include('approver.partials.sidebar')

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
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('documents.export.pdf') }}" target="_blank" style="padding: 8px 12px; background: #c41e3a; color: white; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: flex; align-items: center;">
                            <i class="fas fa-file-pdf" style="margin-right: 6px;"></i> Export PDF
                        </a>
                        <a href="{{ route('documents.export.excel') }}" target="_blank" style="padding: 8px 12px; background: #2e7d32; color: white; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: flex; align-items: center;">
                            <i class="fas fa-file-excel" style="margin-right: 6px;"></i> Export Excel
                        </a>
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



                <!-- Dynamic Content (Accordion) -->
                <div id="dynamicContent"></div>
            </div>
        </main>
    </div>




    <script>
        @php
             // Prepare data for JS
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
        
        // Initial Documents (Limited)
        let documents = @json($publishedDocuments); 

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

            let html = '<div class="accordion-container">';
            
            // 1. Render Regular Departments (Excluding ID 0 "Unassigned" and ID 93 "Departemen 3")
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

            // 2. Render Unassigned Units (ID 0) directly
            const unassignedDept = departments.find(d => d.id_dept == 0);
            if (unassignedDept) {
                // Filter out ID 0 (Unassigned / Non-Unit)
                const directUnits = units.filter(u => u.id_dept == 0 && u.id_unit != 0);
                
                if (directUnits.length > 0) {
                    // Optional: Add a separator header if needed, but request said "alongside"
                    
                    directUnits.forEach(unit => {
                        html += `
                            <div class="accordion-item" onclick="selectUnit(${unit.id_unit}, '${unit.nama_unit.replace(/'/g, "\\'")}', 0)" style="cursor:pointer;">
                                <div class="accordion-header"> <!-- No toggle functionality needed here, clicking calls selectUnit -->
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
            fetch(`{{ route('approver.dashboard.data') }}?unit_id=${id}`)
                .then(response => response.json())
                .then(data => {
                    documents = data; // Update local documents cache
                    renderDocumentsTable(name, deptId, data);
                })
                .catch(error => {
                    console.error('Error fetching docs:', error);
                    container.innerHTML = `<div style="text-align: center; padding: 20px; color: red;">Gagal memuat dokumen. Silakan coba lagi.</div>`;
                });
        }

        function renderDocumentsTable(unitName, deptId, docs) {
            const container = document.getElementById('dynamicContent');
            
            let html = `
                <div class="table-section">
                    <div class="table-header">
                        <h2>Dokumen Terpublikasi - ${unitName}</h2>
                         <button class="btn-action" style="background:#666;" onclick="selectDepartment(${deptId})"><i class="fas fa-arrow-left"></i> Kembali</button>
                    </div>
            `;

            if (docs.length === 0) {
                 html += `<div style="text-align: center; padding: 40px; color: #999;"><i class="fas fa-folder-open" style="font-size:30px; margin-bottom:10px;"></i><p>Belum ada dokumen yang dipublish dari Unit ini.</p></div>`;
            } else {
                html += `
                    <table class="custom-table" style="width:100%; border-collapse: collapse;">
                        <thead style="background:#fff; border-bottom:2px solid #f0f0f0;">
                            <tr>
                                <th style="padding:15px; text-align:left;">Judul Dokumen</th>
                                <th style="padding:15px; text-align:left;">Kategori</th>
                                <th style="padding:15px; text-align:left;">Penulis</th>
                                <th style="padding:15px; text-align:left;">Tanggal</th>
                                <th style="padding:15px; text-align:left;">Status</th>
                                <th style="padding:15px; text-align:left;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                docs.forEach(doc => {
                    html += `
                        <tr style="border-bottom:1px solid #eee;">
                            <td style="padding:15px;">${doc.title}</td>
                            <td style="padding:15px;">${doc.category || '-'}</td>
                            <td style="padding:15px;">${doc.author}</td>
                            <td style="padding:15px;">${doc.date}</td>
                            <td style="padding:15px;"><span class="status-pill" style="background:#e8f5e9; color:#2e7d32; padding:4px 12px; border-radius:15px; font-size:11px; font-weight:700;">DISETUJUI</span></td>
                            <td style="padding:15px;">
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

        // PIC Update Functions
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
</body>

</html>