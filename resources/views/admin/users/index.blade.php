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
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
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

        /* Logo & User styles handled by partials/sidebar.blade.php style injection or global */
        /* Since dashboard has styles, we should copy them here for consistency or use a layout file */
        /* For now I will include necessary Sidebar styles here to be safe */

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

        /* Controls */
        .controls {
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: var(--shadow-sm);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: white;
            color: var(--text-main);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* Filter Section */
        .filter-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            margin-bottom: 24px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            align-items: end;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-sub);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            color: var(--text-main);
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(91, 111, 216, 0.1);
        }

        /* Table */
        .table-container {
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            overflow-x: auto;
            /* Allow horizontal scroll */
            border: 1px solid var(--border);
            padding-bottom: 5px;
            /* Prevent scrollbar overlapping content */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
            /* Prevent wrapping */
        }

        th {
            background: #f8fafc;
            padding: 16px 24px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-sub);
            border-bottom: 1px solid var(--border);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
            color: var(--text-main);
            vertical-align: middle;
        }

        tr:hover {
            background: #f8fafc;
        }

        /* Status & Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
        }

        .badge-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Action Buttons */
        .action-btns {
            display: flex;
            gap: 6px;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-icon:hover {
            transform: translateY(-2px);
        }

        .btn-edit {
            background: var(--warning);
        }

        .btn-delete {
            background: var(--danger);
        }

        .btn-save {
            background: var(--success);
        }

        .btn-cancel {
            background: var(--secondary);
        }

        /* Inputs in Table */
        .input-text,
        .input-select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            min-width: 130px;
            /* Ensure inputs are usable */
        }

        .input-text:focus,
        .input-select:focus {
            border-color: var(--primary);
        }

        /* Pagination */
        .pagination {
            display: flex;
            padding-left: 0;
            list-style: none;
            gap: 4px;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: 8px;
            font-size: 14px;
            color: var(--text-main);
            background: white;
            border: 1px solid var(--border);
            text-decoration: none;
            transition: all 0.2s;
        }

        .page-item.active .page-link {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            font-weight: 600;
        }

        .page-link:hover:not(.active) {
            background: #f1f5f9;
        }

        .page-item.disabled .page-link {
            color: #94a3b8;
            pointer-events: none;
            background: #f8fafc;
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        @include('partials.sidebar')
    </aside>

    <main class="main-content">
        <div class="header">
            <div>
                <h1>Manajemen User</h1>
                <div style="font-size: 14px; color: #64748b; margin-top: 5px;">
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
        <div class="filter-card">
            <div class="filter-grid">
                <!-- Search Box -->
                <div style="grid-column: span 2;">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-search" style="color: var(--primary); margin-right: 5px;"></i> Cari User
                        </label>
                        <div style="position: relative;">
                            <input type="text" id="searchInput" class="form-control"
                                placeholder="Cari username, email, atau nama..." style="padding-left: 40px;"
                                oninput="handleFilter()">
                            <i class="fas fa-search"
                                style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                        </div>
                    </div>
                </div>

                <!-- Filter Unit -->
                <div class="form-group">
                    <label>
                        <i class="fas fa-building" style="color: var(--primary); margin-right: 5px;"></i> Unit
                    </label>
                    <select id="unitFilter" class="form-control" onchange="handleFilter()">
                        <option value="">Semua Unit</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id_unit }}">{{ $unit->nama_unit }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Departemen -->
                <div class="form-group">
                    <label>
                        <i class="fas fa-sitemap" style="color: var(--primary); margin-right: 5px;"></i> Departemen
                    </label>
                    <select id="deptFilter" class="form-control" onchange="handleFilter()">
                        <option value="">Semua Departemen</option>
                        @foreach($departemens as $dept)
                            <option value="{{ $dept->id_dept }}">{{ $dept->nama_dept }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Jabatan -->
                <div class="form-group">
                    <label>
                        <i class="fas fa-user-tie" style="color: var(--primary); margin-right: 5px;"></i> Jabatan
                    </label>
                    <select id="jabatanFilter" class="form-control" onchange="handleFilter()">
                        <option value="">Semua Jabatan</option>
                        @foreach($roleJabatans as $jabatan)
                            <option value="{{ $jabatan->id_role_jabatan }}">{{ $jabatan->nama_role_jabatan }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Reset Button -->
                <div style="display: flex; justify-content: flex-end;">
                    <button class="btn btn-secondary" onclick="resetFilters()" title="Reset Filter"
                        style="width: 100%; justify-content: center;">
                        <i class="fas fa-redo" style="font-size: 14px; color: var(--text-sub);"></i> <span
                            style="margin-left: 8px;">Reset</span>
                    </button>
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
        <div id="paginationContainer" class="pagination-container">
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

        function handleFilter() {
            const search = document.getElementById('searchInput').value;
            const unit = document.getElementById('unitFilter').value;
            const dept = document.getElementById('deptFilter').value;
            const jabatan = document.getElementById('jabatanFilter').value;

            // Build query params
            const params = new URLSearchParams();
            if (search) params.append('search', search);
            if (unit) params.append('unit_filter', unit);
            if (dept) params.append('dept_filter', dept);
            if (jabatan) params.append('jabatan_filter', jabatan);

            // Show loading state if needed, or just fetch
            // Using fetch to get filtered data

            fetch(`${window.location.pathname}?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    users = data.data ? data.data : data; // Handle pagination response
                    allUsers = [...users]; // Update local cache
                    renderTable();

                    // HIDE Pagination on Filter/AJAX load because we load ALL data
                    const paginationContainer = document.getElementById('paginationContainer');
                    if (paginationContainer) {
                        paginationContainer.style.display = 'none';
                    }

                    // Update URL without reload
                    const newUrl = `${window.location.pathname}?${params.toString()}`;
                    window.history.pushState({ path: newUrl }, '', newUrl);
                })
                .catch(err => console.error('Filter error:', err));
        }

        // Legacy support if needed, or alias
        function handleSearch() {
            handleFilter();
        }

        function handleUnitFilter() {
            handleFilter();
        }

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('unitFilter').value = '';
            document.getElementById('deptFilter').value = '';
            document.getElementById('jabatanFilter').value = '';
            handleFilter();
        }

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

            if (users.length === 0) {
                tbody.innerHTML = `<tr><td colspan="11" style="text-align:center; padding: 30px;">Tidak ada data user ditemukan</td></tr>`;
                return;
            }

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

        // ... rest of the functions (renderViewRow, etc) unchanged


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