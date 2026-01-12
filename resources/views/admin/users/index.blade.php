<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - Admin HIRADC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
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

        /* Hidden File Input */
        #fileInput {
            display: none;
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="logo-section">
            <img src="{{ asset('images/logo-semen-padang.png') }}" alt="Logo">
            <div style="font-weight: 700; color: #c41e3a;">PT Semen Padang</div>
            <div style="font-size: 12px; color: #888;">Admin System</div>
        </div>
        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item active">
                <i class="fas fa-users"></i> Manajemen User
            </a>
            <a href="{{ route('admin.master') }}" class="nav-item">
                <i class="fas fa-database"></i> Data Master
            </a>
        </nav>
    </aside>

    <main class="main-content">
        <div class="header">
            <h1>Manajemen User</h1>
            <div class="controls">
                <button class="btn btn-primary" onclick="addUserRow()">
                    <i class="fas fa-plus"></i> Tambah User
                </button>
                <button class="btn btn-success" onclick="document.getElementById('fileInput').click()">
                    <i class="fas fa-file-csv"></i> Upload CSV/XL
                </button>
                <input type="file" id="fileInput" accept=".csv, .xlsx, .xls" onchange="handleFileUpload(this)">
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th width="12%">Username</th>
                        <th width="15%">Email</th>
                        <th width="12%">Direktorat</th>
                        <th width="12%">Departemen</th>
                        <th width="12%">Unit</th>
                        <th width="12%">Seksi</th>
                        <th width="10%">Role User</th>
                        <th width="8%">Aktif</th>
                        <th width="7%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <!-- Data will be populated by JS -->
                </tbody>
            </table>
        </div>
    </main>

    <script>
        // MOCK DATA
        let users = [
            { id: 1, username: 'ahmad.rizki', email: 'ahmad@semenpadang.co.id', dir: 'Operasi', dept: 'Produksi', unit: 'Produksi IV', seksi: '-', role: 'User', active: true },
            { id: 2, username: 'budi.santoso', email: 'budi@semenpadang.co.id', dir: 'Keuangan', dept: 'Akuntansi', unit: '-', seksi: '-', role: 'Approver', active: true },
            { id: 3, username: 'admin.she', email: 'she@semenpadang.co.id', dir: '-', dept: '-', unit: '-', seksi: '-', role: 'Unit Pengelola', active: true },
        ];

        // MOCK OPTIONS
        const opts = {
            roles: ['User', 'Approver', 'Unit Pengelola', 'Kepala Departemen', 'Admin'],
            dirs: ['Operasi', 'Keuangan', 'SDM', 'Pemasaran'],
            depts: ['Produksi', 'Akuntansi', 'HC', 'Sales'],
            units: ['Produksi IV', 'Gudang', 'Rekrutmen', 'Area Barat'],
            seksi: ['-', 'Shift A', 'Shift B']
        };

        const tbody = document.getElementById('userTableBody');

        function renderTable() {
            tbody.innerHTML = '';
            users.forEach(user => {
                const tr = document.createElement('tr');
                tr.dataset.id = user.id;

                if (user.isEditing) {
                    tr.innerHTML = renderEditRow(user);
                } else {
                    tr.innerHTML = renderViewRow(user);
                }
                tbody.appendChild(tr);
            });
        }

        function renderViewRow(user) {
            return `
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>${user.dir}</td>
                <td>${user.dept}</td>
                <td>${user.unit}</td>
                <td>${user.seksi}</td>
                <td><span style="font-weight:600; color:#444;">${user.role}</span></td>
                <td><span class="${user.active ? 'badge-active' : 'badge-inactive'}">${user.active ? 'Ya' : 'Tidak'}</span></td>
                <td>
                    <div class="action-btns">
                        <button class="btn-icon btn-edit" onclick="toggleEdit(${user.id})"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn-icon btn-delete" onclick="confirmDelete(${user.id})"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            `;
        }

        function renderEditRow(user) {
            return `
                <td><input type="text" class="input-text" id="edit_username_${user.id}" value="${user.username}"></td>
                <td><input type="email" class="input-text" id="edit_email_${user.id}" value="${user.email}"></td>
                <td>${makeSelect(opts.dirs, user.dir, `edit_dir_${user.id}`)}</td>
                <td>${makeSelect(opts.depts, user.dept, `edit_dept_${user.id}`)}</td>
                <td>${makeSelect(opts.units, user.unit, `edit_unit_${user.id}`)}</td>
                <td>${makeSelect(opts.seksi, user.seksi, `edit_seksi_${user.id}`)}</td>
                <td>${makeSelect(opts.roles, user.role, `edit_role_${user.id}`)}</td>
                <td>
                    <select class="input-select" id="edit_active_${user.id}">
                        <option value="true" ${user.active ? 'selected' : ''}>Ya</option>
                        <option value="false" ${!user.active ? 'selected' : ''}>Tidak</option>
                    </select>
                </td>
                <td>
                    <div class="action-btns">
                        <button class="btn-icon btn-save" onclick="saveUser(${user.id})"><i class="fas fa-save"></i></button>
                    </div>
                </td>
            `;
        }

        function makeSelect(options, current, id) {
            let html = `<select class="input-select" id="${id}">`;
            options.forEach(opt => {
                const sel = opt === current ? 'selected' : '';
                html += `<option value="${opt}" ${sel}>${opt}</option>`;
            });
            html += `</select>`;
            return html;
        }

        // --- ACTIONS ---

        function addUserRow() {
            // Check if already adding
            if (users.find(u => u.id === 'NEW')) return;

            const newUser = {
                id: 'NEW',
                username: '',
                email: '',
                dir: opts.dirs[0],
                dept: opts.depts[0],
                unit: opts.units[0],
                seksi: opts.seksi[0],
                role: 'User',
                active: true,
                isEditing: true
            };

            users.unshift(newUser);
            renderTable();
        }

        function toggleEdit(id) {
            const user = users.find(u => u.id === id);
            if (user) {
                user.isEditing = true;
                renderTable();
            }
        }

        function saveUser(id) {
            const user = users.find(u => u.id === id);
            if (!user) return;

            // Collect Data
            user.username = document.getElementById(`edit_username_${id}`).value;
            user.email = document.getElementById(`edit_email_${id}`).value;
            user.dir = document.getElementById(`edit_dir_${id}`).value;
            user.dept = document.getElementById(`edit_dept_${id}`).value;
            user.unit = document.getElementById(`edit_unit_${id}`).value;
            user.seksi = document.getElementById(`edit_seksi_${id}`).value;
            user.role = document.getElementById(`edit_role_${id}`).value;
            user.active = document.getElementById(`edit_active_${id}`).value === 'true';
            user.isEditing = false;

            if (user.id === 'NEW') {
                user.id = Date.now(); // Generate Real ID
                Swal.fire('Berhasil', 'User baru berhasil ditambahkan!', 'success');
            } else {
                Swal.fire('Terupdate', 'Data user berhasil diperbarui.', 'success');
            }

            renderTable();
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus User?',
                text: "Apakah anda yakin menghapus user ini untuk selamanya?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    users = users.filter(u => u.id !== id);
                    renderTable();
                    Swal.fire(
                        'Terhapus!',
                        'User telah dihapus dari sistem.',
                        'success'
                    )
                }
            })
        }

        function handleFileUpload(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Show Loading
                Swal.fire({
                    title: 'Mengupload...',
                    text: `Memproses file ${file.name}`,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    timer: 1500
                }).then(() => {
                    // Mock Success
                    Swal.fire({
                        icon: 'success',
                        title: 'Import Berhasil!',
                        text: 'Data dari CSV/XL telah berhasil disimpan ke database.'
                    });

                    // Add mock bulk data
                    users.push({ id: 88, username: 'import.user1', email: 'imp1@semenpadang.co.id', dir: 'Impor', dept: 'Impor', unit: '-', seksi: '-', role: 'User', active: true });
                    users.push({ id: 89, username: 'import.user2', email: 'imp2@semenpadang.co.id', dir: 'Impor', dept: 'Impor', unit: '-', seksi: '-', role: 'User', active: true });
                    renderTable();
                });

                // Reset input
                input.value = '';
            }
        }

        // Initialize
        renderTable();
    </script>
</body>

</html>