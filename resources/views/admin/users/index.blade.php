<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen User - Admin HIRADC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f6f9;
            margin: 0;
            display: flex;
        }

        /* Layout */
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

        /* Controls */
        .controls {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }

        .btn-primary {
            background: #c41e3a;
            color: white;
        }

        .btn-primary:hover {
            background: #a01830;
        }

        .btn-secondary {
            background: #2f3542;
            color: white;
        }

        .btn-secondary:hover {
            background: #1e272e;
        }

        .btn-success {
            background: #27ae60;
            color: white;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        /* Table */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        th {
            background: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #666;
            border-bottom: 2px solid #eee;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: #333;
            vertical-align: middle;
        }

        tr:hover {
            background: #fafafa;
        }

        /* Inputs in Table */
        .input-text {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 13px;
        }

        .input-select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 13px;
            background: white;
        }

        .badge-active {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-inactive {
            background: #ffebee;
            color: #c62828;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .action-btns {
            display: flex;
            gap: 5px;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background: #f39c12;
        }

        .btn-delete {
            background: #e74c3c;
        }

        .btn-save {
            background: #27ae60;
        }

        .btn-cancel {
            background: #95a5a6;
        }

        /* Hidden File Input */
        #fileInput {
            display: none;
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
        }

        .page-item .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #c41e3a;
            background-color: #fff;
            border: 1px solid #dee2e6;
            text-decoration: none;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #c41e3a;
            border-color: #c41e3a;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: #dee2e6;
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        @include('admin.partials.sidebar')
    </aside>

    <main class="main-content">
        <div class="header">
            <div>
                <h1>Manajemen User</h1>
                <div style="font-size: 14px; color: #666; margin-top: 5px;">
                    Total User: <strong>{{ number_format($users->total()) }}</strong>
                </div>
            </div>
            <div class="controls">
                <button class="btn btn-primary" onclick="addUserRow()">
                    <i class="fas fa-plus"></i> Tambah User
                </button>
            </div>
        </div>

        <!-- Filter & Search Section -->
        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
            <!-- Search Box -->
            <div
                style="flex: 1; background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <label style="display: block; font-size: 13px; font-weight: 600; color: #666; margin-bottom: 8px;">
                    <i class="fas fa-search"></i> Cari User
                </label>
                <input type="text" id="searchInput" placeholder="Cari username, email, atau nama..."
                    style="width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;"
                    oninput="handleSearch()">
            </div>

            <!-- Filter Box -->
            <div
                style="flex: 1; background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <div style="display: flex; gap: 10px; align-items: flex-end;">
                    <div style="flex: 1;">
                        <label
                            style="display: block; font-size: 13px; font-weight: 600; color: #666; margin-bottom: 8px;">
                            <i class="fas fa-filter"></i> Filter Unit
                        </label>
                        <select id="unitFilter"
                            style="width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; background: white;"
                            onchange="handleUnitFilter()">
                            <option value="">-- Semua Unit --</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id_unit }}">{{ $unit->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-secondary" onclick="resetFilters()" title="Reset Filter"
                            style="height: 42px;">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th width="10%">Username</th>
                        <th width="13%">Email</th>
                        <th width="11%">Direktorat</th>
                        <th width="11%">Departemen</th>
                        <th width="11%">Unit</th>
                        <th width="11%">Seksi</th>
                        <th width="6%">PIC</th>
                        <th width="8%">Role Jabatan</th>
                        <th width="7%">Role User</th>
                        <th width="5%">Aktif</th>
                        <th width="7%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <!-- Data will be populated by JS -->
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </main>

    <script>
        // INIT DATA FROM SERVER (Fix for Pagination: use items())
        let users = {!! json_encode($users->items()) !!};
        let allUsers = [...users]; // Simpan semua users untuk filtering

        // MASTER DATA FOR DROPDOWNS
        const masterData = {
            roles: @json($roleUsers), // Array of role_user objects with id_role_user
            direktorats: {!! json_encode($direktorats) !!},
            departemens: {!! json_encode($departemens) !!},
            units: {!! json_encode($units) !!},
            seksis: {!! json_encode($seksis) !!},
            roleJabatans: @json($roleJabatans)
        };

        // Filter state
        // Server-side filtering is now used


        // DEBUG: Log data untuk troubleshooting
        console.log('=== MASTER DATA DEBUG ===');
        console.log('Direktorats:', masterData.direktorats);
        console.log('Departemens:', masterData.departemens);
        console.log('Units:', masterData.units);
        console.log('Seksis:', masterData.seksis);
        console.log('Role Users:', masterData.roles);
        console.log('Role Jabatans:', masterData.roleJabatans);
        console.log('Total Direktorat:', masterData.direktorats ? masterData.direktorats.length : 0);
        console.log('========================');

        const tbody = document.getElementById('userTableBody');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function renderTable() {
            tbody.innerHTML = '';
            users.forEach(user => {
                const tr = document.createElement('tr');
                tr.dataset.id = user.id_user || user.id || 'NEW';

                if (user.isEditing) {
                    tr.innerHTML = renderEditRow(user);
                    // initCascade tidak diperlukan karena dropdown sudah ter-populate di renderEditRow
                    // setTimeout(() => initCascade(user), 0);
                } else {
                    tr.innerHTML = renderViewRow(user);
                }
                tbody.appendChild(tr);
            });
        }

        function renderViewRow(user) {
            const dirName = user.direktorat ? user.direktorat.nama_direktorat : '-';
            const deptName = user.departemen ? user.departemen.nama_dept : '-';
            const unitName = user.unit ? user.unit.nama_unit : '-';
            const seksiName = user.seksi ? user.seksi.nama_seksi : '-';
            const active = (user.user_aktif == 1 || user.user_aktif == 'aktif');

            // Get role_user name from masterData
            const roleObj = masterData.roles.find(r => r.id_role_user == user.role_user);
            const roleDisplay = roleObj ? (roleObj.nama_role || roleObj.name || 'ID:' + user.role_user) : (user.role_user || '-');

            // Get role_jabatan name from relasi atau masterData
            let roleJabatanName = '-';

            // Debug: log user object untuk cek struktur data
            if (user.id_user === users[0]?.id_user) {
                console.log('Sample User data:', user);
                console.log('role_jabatan value:', user.role_jabatan);
                console.log('role_jabatan type:', typeof user.role_jabatan);
            }

            // Cek apakah ada relasi role_jabatan yang ter-load
            if (user.role_jabatan && typeof user.role_jabatan === 'object' && user.role_jabatan.nama_role_jabatan) {
                // Relasi ter-load sebagai object
                roleJabatanName = user.role_jabatan.nama_role_jabatan;
            } else if (user.role_jabatan && typeof user.role_jabatan === 'number') {
                // role_jabatan adalah ID, cari di masterData
                const roleJabatanObj = masterData.roleJabatans.find(r => r.id_role_jabatan == user.role_jabatan);
                roleJabatanName = roleJabatanObj ? roleJabatanObj.nama_role_jabatan : '-';
            }

            return `
                <td>${user.username}</td>
                <td>${user.email_user || user.email || '-'}</td>
                <td>${dirName}</td>
                <td>${deptName}</td>
                <td>${unitName}</td>
                <td>${seksiName}</td>
                <td><span class="${user.can_create_documents == 1 ? 'badge-active' : 'badge-inactive'}">${user.can_create_documents == 1 ? 'Ya' : 'Tidak'}</span></td>
                <td>${roleJabatanName}</td>
                <td><span style="font-weight:600; color:#444;">${roleDisplay}</span></td>
                <td><span class="${active ? 'badge-active' : 'badge-inactive'}">${active ? 'Ya' : 'Tidak'}</span></td>
                <td>
                    <div class="action-btns">
                        <button class="btn-icon btn-edit" onclick="toggleEdit(${user.id_user})"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn-icon btn-delete" onclick="confirmDelete(${user.id_user})"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            `;
        }

        function renderEditRow(user) {
            const id = user.id_user || 'NEW';

            // Direktorat options
            const dirOpts = masterData.direktorats.map(d =>
                `<option value="${d.id_direktorat}" ${user.id_direktorat == d.id_direktorat ? 'selected' : ''}>${d.nama_direktorat}</option>`
            ).join('');

            // Departemen options - filter berdasarkan direktorat user
            let deptOptsArr = [];
            if (user.id_direktorat) {
                deptOptsArr = masterData.departemens.filter(d => d.id_direktorat == user.id_direktorat);
            }
            // Fix: Ensure current value is included even if it mismatches directorate
            if (user.id_dept) {
                const current = masterData.departemens.find(d => d.id_dept == user.id_dept);
                if (current && !deptOptsArr.some(d => d.id_dept == current.id_dept)) {
                    deptOptsArr.push(current);
                }
            }
            const deptOpts = deptOptsArr.map(d =>
                `<option value="${d.id_dept}" ${user.id_dept == d.id_dept ? 'selected' : ''}>${d.nama_dept}</option>`
            ).join('');

            // Unit options - filter berdasarkan departemen user
            let unitOptsArr = [];
            if (user.id_dept) {
                unitOptsArr = masterData.units.filter(u => u.id_dept == user.id_dept);
            }
            // Fix: Ensure current value is included
            if (user.id_unit) {
                const current = masterData.units.find(u => u.id_unit == user.id_unit);
                if (current && !unitOptsArr.some(u => u.id_unit == current.id_unit)) {
                    unitOptsArr.push(current);
                }
            }
            const unitOpts = unitOptsArr.map(u =>
                `<option value="${u.id_unit}" ${user.id_unit == u.id_unit ? 'selected' : ''}>${u.nama_unit}</option>`
            ).join('');

            // Seksi options - filter berdasarkan unit user
            let seksiOptsArr = [];
            if (user.id_unit) {
                seksiOptsArr = masterData.seksis.filter(s => s.id_unit == user.id_unit);
            }
            // Fix: Ensure current value is included
            if (user.id_seksi) {
                const current = masterData.seksis.find(s => s.id_seksi == user.id_seksi);
                if (current && !seksiOptsArr.some(s => s.id_seksi == current.id_seksi)) {
                    seksiOptsArr.push(current);
                }
            }
            const seksiOpts = seksiOptsArr.map(s =>
                `<option value="${s.id_seksi}" ${user.id_seksi == s.id_seksi ? 'selected' : ''}>${s.nama_seksi}</option>`
            ).join('');

            // Extract role_jabatan ID (bisa object atau integer)
            let roleJabatanId = null;
            if (user.role_jabatan) {
                if (typeof user.role_jabatan === 'object' && user.role_jabatan.id_role_jabatan) {
                    roleJabatanId = user.role_jabatan.id_role_jabatan;
                } else if (typeof user.role_jabatan === 'number' || typeof user.role_jabatan === 'string') {
                    roleJabatanId = user.role_jabatan;
                }
            }

            // Role Jabatan options
            const roleJabatanOpts = masterData.roleJabatans.map(r =>
                `<option value="${r.id_role_jabatan}" ${roleJabatanId == r.id_role_jabatan ? 'selected' : ''}>${r.nama_role_jabatan}</option>`
            ).join('');

            // Role User options (ID integer)
            const roleOpts = masterData.roles.map(r =>
                `<option value="${r.id_role_user}" ${user.role_user == r.id_role_user ? 'selected' : ''}>${r.nama_role || r.name || 'Role ' + r.id_role_user}</option>`
            ).join('');

            return `
                <td><input type="text" class="input-text" id="e_username_${id}" value="${user.username || ''}" placeholder="Username" autocomplete="off">
                    ${id === 'NEW' ? '<div style="font-size:11px; color:#666; margin-top:5px">Default Pass: 123456</div>' : ''}
                </td>
                <td><input type="email" class="input-text" id="e_email_${id}" value="${user.email_user || user.email || ''}" placeholder="Email" autocomplete="off"></td>
                
                <td><select class="input-select" id="e_dir_${id}" onchange="handleDirChange('${id}')"><option value="">- Pilih -</option>${dirOpts}</select></td>
                <td><select class="input-select" id="e_dept_${id}" onchange="handleDeptChange('${id}')"><option value="">- Pilih -</option>${deptOpts}</select></td>
                <td><select class="input-select" id="e_unit_${id}" onchange="handleUnitChange('${id}')"><option value="">- Pilih -</option>${unitOpts}</select></td>
                <td><select class="input-select" id="e_seksi_${id}"><option value="">- Pilih -</option>${seksiOpts}</select></td>
                
                <td>
                    <select class="input-select" id="e_pic_${id}">
                        <option value="0" ${user.can_create_documents != 1 ? 'selected' : ''}>Tidak</option>
                        <option value="1" ${user.can_create_documents == 1 ? 'selected' : ''}>Ya</option>
                    </select>
                </td>
                
                <td><select class="input-select" id="e_role_jabatan_${id}" onchange="handleRoleJabatanChange('${id}')"><option value="">- Pilih -</option>${roleJabatanOpts}</select></td>
                <td><select class="input-select" id="e_role_${id}">${roleOpts}</select></td>
                <td>
                    <select class="input-select" id="e_active_${id}">
                        <option value="1" ${user.user_aktif == 1 ? 'selected' : ''}>Ya</option>
                        <option value="0" ${user.user_aktif == 0 ? 'selected' : ''}>Tidak</option>
                    </select>
                </td>
                <td>
                    <div class="action-btns">
                        <button class="btn-icon btn-save" onclick="saveUser('${id}')"><i class="fas fa-save"></i></button>
                        <button class="btn-icon btn-cancel" onclick="cancelEdit('${id}')"><i class="fas fa-times"></i></button>
                    </div>
                </td>
            `;
        }

        function addUserRow() {
            if (users.find(u => u.isEditing && (u.id_user === 'NEW' || !u.id_user))) return;

            const newUser = {
                id_user: null,
                username: '',
                email_user: '',
                role_user: 2, // Default to user (2)
                user_aktif: 1,
                isEditing: true
            };

            users.unshift(newUser);
            allUsers.unshift(newUser); // Tambahkan ke allUsers juga
            renderTable();
        }

        function toggleEdit(id) {
            const user = users.find(u => u.id_user == id);
            if (user) {
                user.isEditing = true;
                renderTable();
            }
        }

        function cancelEdit(id) {
            if (id === 'NEW' || !id || id === 'null') {
                users.shift();
                allUsers.shift(); // Hapus dari allUsers juga
            } else {
                const user = users.find(u => u.id_user == id);
                if (user) user.isEditing = false;
            }
            renderTable();
        }

        async function saveUser(id) {
            const isNew = (id === 'NEW' || !id || id === 'null');
            const prefix = isNew ? 'NEW' : id;

            const payload = {
                username: document.getElementById(`e_username_${prefix}`).value,
                email_user: document.getElementById(`e_email_${prefix}`).value,
                role_user: document.getElementById(`e_role_${prefix}`).value,
                role_jabatan: document.getElementById(`e_role_jabatan_${prefix}`).value || 6, // Default: Associate
                id_direktorat: document.getElementById(`e_dir_${prefix}`).value || null,
                id_dept: document.getElementById(`e_dept_${prefix}`).value || null,
                id_unit: document.getElementById(`e_unit_${prefix}`).value || null,
                id_seksi: document.getElementById(`e_seksi_${prefix}`).value || null,
                can_create_documents: document.getElementById(`e_pic_${prefix}`).value || 0,
                user_aktif: document.getElementById(`e_active_${prefix}`).value,
            };

            if (isNew) {
                // Password handled in backend (default 123456)
                // const pwd = document.getElementById(`e_password_NEW`).value;
                // if (!pwd) {
                //    Swal.fire('Error', 'Password wajib diisi untuk user baru', 'error');
                //    return;
                // }
                // payload.password = pwd;
            }

            try {
                Swal.showLoading();
                const url = isNew ? "{{ route('admin.users.store') }}" : `/admin/users/${id}`;
                const method = isNew ? 'POST' : 'PUT';

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(payload)
                });

                const text = await response.text();
                let result;
                try {
                    result = JSON.parse(text);
                } catch (e) {
                    throw new Error('Server response was not JSON: ' + text.substring(0, 100));
                }

                if (response.ok) {
                    Swal.fire('Berhasil', result.message, 'success');
                    if (isNew) {
                        users.shift();
                        users.unshift(result.user);
                        allUsers.shift();
                        allUsers.unshift(result.user); // Update allUsers juga
                    } else {
                        const idx = users.findIndex(u => u.id_user == id);
                        users[idx] = result.user;
                        const allIdx = allUsers.findIndex(u => u.id_user == id);
                        if (allIdx !== -1) allUsers[allIdx] = result.user; // Update allUsers juga
                    }
                    renderTable();
                } else {
                    let msg = result.message || 'Terjadi kesalahan';
                    if (result.errors) {
                        msg = Object.values(result.errors).flat().join('<br>');
                    }
                    Swal.fire('Gagal', msg, 'error');
                }

            } catch (error) {
                console.error('Save User Error:', error);
                Swal.fire('Error', 'Gagal: ' + error.message, 'error');
            }
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus User?',
                text: "Data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`/admin/users/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            }
                        });
                        if (response.ok) {
                            users = users.filter(u => u.id_user != id);
                            allUsers = allUsers.filter(u => u.id_user != id); // Hapus dari allUsers juga
                            renderTable();
                            Swal.fire('Terhapus!', 'User telah dihapus.', 'success');
                        } else {
                            Swal.fire('Gagal', 'Server error', 'error');
                        }
                    } catch (e) {
                        Swal.fire('Error', 'Network Error', 'error');
                    }
                }
            })
        }

        function initCascade(user) {
            const id = user.id_user || 'NEW';

            // Debug log
            console.log('initCascade called for user:', id, user);
            console.log('User data:', {
                id_direktorat: user.id_direktorat,
                id_dept: user.id_dept,
                id_unit: user.id_unit,
                id_seksi: user.id_seksi
            });

            // Populate dropdowns dengan data user
            if (user.id_direktorat) {
                handleDirChange(id, user.id_dept);
            }
            if (user.id_dept) {
                handleDeptChange(id, user.id_unit);
            }
            if (user.id_unit) {
                handleUnitChange(id, user.id_seksi);
            }
        }

        function handleDirChange(rowId, selectedDeptId = null) {
            const dirId = document.getElementById(`e_dir_${rowId}`).value;
            const deptSelect = document.getElementById(`e_dept_${rowId}`);
            const unitSelect = document.getElementById(`e_unit_${rowId}`);
            const seksiSelect = document.getElementById(`e_seksi_${rowId}`);

            // Preserve current values if not explicitly provided
            if (selectedDeptId === null) {
                selectedDeptId = deptSelect.value;
            }
            const currentUnitId = unitSelect.value;
            const currentSeksiId = seksiSelect.value;

            const filteredDepts = masterData.departemens.filter(d => d.id_direktorat == dirId);

            // Check if the preserved dept value is still valid
            const isDeptValid = filteredDepts.some(d => d.id_dept == selectedDeptId);
            const finalDeptId = isDeptValid ? selectedDeptId : '';

            deptSelect.innerHTML = '<option value="">- Pilih -</option>' +
                filteredDepts.map(d => `<option value="${d.id_dept}" ${d.id_dept == finalDeptId ? 'selected' : ''}>${d.nama_dept}</option>`).join('');

            // Cascade to child dropdowns with preserved values
            handleDeptChange(rowId, currentUnitId);
        }

        function handleDeptChange(rowId, selectedUnitId = null) {
            const deptId = document.getElementById(`e_dept_${rowId}`).value;
            const unitSelect = document.getElementById(`e_unit_${rowId}`);
            const seksiSelect = document.getElementById(`e_seksi_${rowId}`);

            // Preserve current values if not explicitly provided
            if (selectedUnitId === null) {
                selectedUnitId = unitSelect.value;
            }
            const currentSeksiId = seksiSelect.value;

            const filteredUnits = masterData.units.filter(u => u.id_dept == deptId);

            // Check if the preserved unit value is still valid
            const isUnitValid = filteredUnits.some(u => u.id_unit == selectedUnitId);
            const finalUnitId = isUnitValid ? selectedUnitId : '';

            unitSelect.innerHTML = '<option value="">- Pilih -</option>' +
                filteredUnits.map(u => `<option value="${u.id_unit}" ${u.id_unit == finalUnitId ? 'selected' : ''}>${u.nama_unit}</option>`).join('');

            // Cascade to child dropdown with preserved value
            handleUnitChange(rowId, currentSeksiId);
        }

        function handleUnitChange(rowId, selectedSeksiId = null) {
            const unitId = document.getElementById(`e_unit_${rowId}`).value;
            const seksiSelect = document.getElementById(`e_seksi_${rowId}`);

            // Preserve current value if not explicitly provided
            if (selectedSeksiId === null) {
                selectedSeksiId = seksiSelect.value;
            }

            const filteredSeksi = masterData.seksis.filter(s => s.id_unit == unitId);

            // Check if the preserved seksi value is still valid
            const isSeksiValid = filteredSeksi.some(s => s.id_seksi == selectedSeksiId);
            const finalSeksiId = isSeksiValid ? selectedSeksiId : '';

            seksiSelect.innerHTML = '<option value="">- Pilih -</option>' +
                filteredSeksi.map(s => `<option value="${s.id_seksi}" ${s.id_seksi == finalSeksiId ? 'selected' : ''}>${s.nama_seksi}</option>`).join('');
        }


        function handleRoleJabatanChange(rowId) {
            // Role User can be selected manually by admin for all role jabatan
            // No auto-assignment or locking
        }

        // ==================== FILTER & SEARCH FUNCTIONS ====================

        let debounceTimer;

        async function fetchUsers() {
            const search = document.getElementById('searchInput').value;
            const unit = document.getElementById('unitFilter').value;

            // If both empty, reload page to restore pagination state
            if (!search && !unit) {
                window.location.href = window.location.pathname;
                return;
            }

            const params = new URLSearchParams();
            if (search) params.append('search', search);
            if (unit) params.append('unit_filter', unit);

            try {
                // Show loading state if needed on table? 
                // tbody.innerHTML = '<tr><td colspan="11" class="text-center">Loading...</td></tr>';

                const response = await fetch(`${window.location.pathname}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    users = data;
                    allUsers = [...data]; // Sync allUsers with the new dataset
                    renderTable();

                    // Hide pagination if in search mode (optional, but usually searching returns a flat list here)
                    const pagination = document.querySelector('.pagination');
                    if (pagination) {
                        // If we are searching, we have a flat list, pagination links from Laravel might not be relevant 
                        // unless we update them too (which is hard via JSON). 
                        // The controller returns ALL rows for search, so no pagination needed.
                        if (search || unit) {
                            pagination.style.display = 'none';
                        } else {
                            // If we are back to empty (handled by reload above), it would show.
                        }
                    }
                }
            } catch (e) {
                console.error('Fetch Error:', e);
                Swal.fire('Error', 'Gagal memuat data pencarian', 'error');
            }
        }

        function handleSearch() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                fetchUsers();
            }, 500);
        }

        function handleUnitFilter() {
            fetchUsers();
        }

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('unitFilter').value = '';
            window.location.href = window.location.pathname;
        }

        // function applyFilters() was removed as we use server-side fetching now

        async function togglePIC(userId, newValue) {
            const user = allUsers.find(u => u.id_user == userId);
            if (!user) return;

            const isPIC = newValue == 1;
            const action = isPIC ? 'menandai' : 'menghapus penandaan';

            const result = await Swal.fire({
                title: `${isPIC ? 'Tandai' : 'Hapus'} sebagai PIC?`,
                html: `Apakah Anda yakin ingin ${action} <strong>${user.username}</strong> sebagai PIC (Person In Charge) untuk form HIRADC?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal'
            });

            if (!result.isConfirmed) {
                // Revert dropdown
                event.target.value = user.can_create_documents == 1 ? '1' : '0';
                return;
            }

            try {
                Swal.showLoading();

                // Update can_create_documents via API
                const response = await fetch(`/admin/users/${userId}/pic`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        can_create_documents: isPIC ? 1 : 0
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    // Update local data
                    user.can_create_documents = isPIC ? 1 : 0;
                    const allUserIndex = allUsers.findIndex(u => u.id_user == userId);
                    if (allUserIndex !== -1) allUsers[allUserIndex].can_create_documents = isPIC ? 1 : 0;

                    Swal.fire('Berhasil!', result.message, 'success');
                } else {
                    // Handle error (PIC duplikat)
                    Swal.fire('Gagal', result.message, 'error');
                    // Revert dropdown
                    event.target.value = user.can_create_documents == 1 ? '1' : '0';
                }
            } catch (error) {
                Swal.fire('Gagal', 'Terjadi kesalahan saat mengupdate status PIC', 'error');
                // Revert dropdown
                event.target.value = user.can_create_documents == 1 ? '1' : '0';
            }
        }

        function handleFileUpload(input) {
            Swal.fire('Info', 'Fitur upload CSV belum diimplementasikan di backend ini.', 'info');
        }

        renderTable();
    </script>
</body>

</html>