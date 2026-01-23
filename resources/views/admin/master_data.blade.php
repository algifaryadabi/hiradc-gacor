<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Master Data - HIRADC System</title>
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
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .logo-section img {
            width: 50px !important;
            height: auto !important;
            max-width: 50px !important;
            max-height: 50px !important;
            margin-bottom: 10px;
        }

        .nav-menu {
            padding: 20px 0;
            flex: 1;
            overflow-y: auto;
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
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
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
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .content-area {
            padding: 30px 40px;
        }

        /* Tabs */
        .tabs-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .tabs-header {
            display: flex;
            border-bottom: 2px solid #f0f0f0;
            background: #fafafa;
        }

        .tab-btn {
            flex: 1;
            padding: 18px 20px;
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: #666;
            transition: all 0.3s;
            border-bottom: 3px solid transparent;
            position: relative;
        }

        .tab-btn:hover {
            background: #f5f5f5;
            color: #c41e3a;
        }

        .tab-btn.active {
            color: #c41e3a;
            background: white;
            border-bottom-color: #c41e3a;
        }

        .tab-content {
            display: none;
            padding: 30px;
        }

        .tab-content.active {
            display: block;
        }

        /* Table */
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: #333;
        }

        .btn-add {
            padding: 10px 20px;
            background: #c41e3a;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-add:hover {
            background: #a01629;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(196, 30, 58, 0.3);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .data-table thead {
            background: #f8f9fa;
        }

        .data-table th {
            padding: 15px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #666;
            border-bottom: 2px solid #e0e0e0;
        }

        .data-table td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
            color: #333;
        }

        .data-table tbody tr:hover {
            background: #f8f9fa;
        }

        .btn-edit,
        .btn-delete {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            margin-right: 5px;
        }

        .btn-edit {
            background: #3b82f6;
            color: white;
        }

        .btn-edit:hover {
            background: #2563eb;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        .badge-active {
            padding: 4px 10px;
            background: #10b981;
            color: white;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-inactive {
            padding: 4px 10px;
            background: #94a3b8;
            color: white;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
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
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 0;
            width: 500px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            animation: slideDown 0.3s;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 20px 30px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: #333;
        }

        .close-btn {
            color: #999;
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

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            color: #333;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #c41e3a;
        }

        .form-group .error {
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
            cursor: pointer;
        }

        .modal-footer {
            padding: 20px 30px;
            border-top: 1px solid #e0e0e0;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-cancel,
        .btn-submit {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-cancel {
            background: #e0e0e0;
            color: #666;
        }

        .btn-cancel:hover {
            background: #d0d0d0;
        }

        .btn-submit {
            background: #c41e3a;
            color: white;
        }

        .btn-submit:hover {
            background: #a01629;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            color: #ddd;
        }

        .empty-state h3 {
            font-size: 18px;
            color: #666;
            margin-bottom: 10px;
        }

        .empty-state p {
            font-size: 14px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            @include('admin.partials.sidebar')
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Manajemen Master Data</h1>
                <p>Kelola struktur organisasi: Direktorat, Departemen, Unit Kerja, dan Seksi</p>
            </div>

            <div class="content-area">
                <div class="tabs-container">
                    <!-- Tabs Header -->
                    <div class="tabs-header">
                        <button class="tab-btn active" onclick="switchTab('direktorat')">
                            <i class="fas fa-building"></i> Direktorat
                        </button>
                        <button class="tab-btn" onclick="switchTab('departemen')">
                            <i class="fas fa-sitemap"></i> Departemen
                        </button>
                        <button class="tab-btn" onclick="switchTab('unit')">
                            <i class="fas fa-users"></i> Unit Kerja
                        </button>
                        <button class="tab-btn" onclick="switchTab('seksi')">
                            <i class="fas fa-user-friends"></i> Seksi
                        </button>
                        <button class="tab-btn" onclick="switchTab('probis')">
                            <i class="fas fa-tasks"></i> Probis
                        </button>
                    </div>

                    <!-- Tab Content: Direktorat -->
                    <div id="tab-direktorat" class="tab-content active">
                        <div class="table-header">
                            <h3>Daftar Direktorat</h3>
                            <button class="btn-add" onclick="openModal('direktorat', 'add')">
                                <i class="fas fa-plus"></i> Tambah Direktorat
                            </button>
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="60%">Nama Direktorat</th>
                                    <th width="15%">Status</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="direktorat-tbody">
                                @forelse($direktorats as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $item->nama_direktorat }}</strong></td>
                                    <td>
                                        <span class="badge-{{ $item->status_aktif ? 'active' : 'inactive' }}">
                                            {{ $item->status_aktif ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn-edit" onclick='editDirektorat(@json($item))'>
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn-delete" onclick="deleteDirektorat({{ $item->id_direktorat }})">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <i class="fas fa-folder-open"></i>
                                            <h3>Belum Ada Data</h3>
                                            <p>Klik tombol "Tambah Direktorat" untuk menambahkan data baru</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Tab Content: Departemen -->
                    <div id="tab-departemen" class="tab-content">
                        <div class="table-header">
                            <h3>Daftar Departemen</h3>
                            <button class="btn-add" onclick="openModal('departemen', 'add')">
                                <i class="fas fa-plus"></i> Tambah Departemen
                            </button>
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="35%">Direktorat</th>
                                    <th width="40%">Nama Departemen</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="departemen-tbody">
                                @forelse($departemens as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->direktorat->nama_direktorat ?? '-' }}</td>
                                    <td><strong>{{ $item->nama_dept }}</strong></td>
                                    <td>
                                        <button class="btn-edit" onclick='editDepartemen(@json($item))'>
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn-delete" onclick="deleteDepartemen({{ $item->id_dept }})">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <i class="fas fa-folder-open"></i>
                                            <h3>Belum Ada Data</h3>
                                            <p>Klik tombol "Tambah Departemen" untuk menambahkan data baru</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Tab Content: Unit -->
                    <div id="tab-unit" class="tab-content">
                        <div class="table-header">
                            <h3>Daftar Unit Kerja</h3>
                            <button class="btn-add" onclick="openModal('unit', 'add')">
                                <i class="fas fa-plus"></i> Tambah Unit Kerja
                            </button>
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="30%">Departemen</th>
                                    <th width="35%">Nama Unit</th>
                                    <th width="15%">Probis</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="unit-tbody">
                                @forelse($units as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->departemen->nama_dept ?? '-' }}</td>
                                    <td><strong>{{ $item->nama_unit }}</strong></td>
                                    <td>
                                        <span class="badge-{{ $item->probis ? 'active' : 'inactive' }}" style="background: {{ $item->probis ? '#3b82f6' : '#e2e8f0'; }}; color: {{ $item->probis ? 'white' : '#64748b' }}">
                                            {{ $item->probis->kode_probis ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn-edit" onclick='editUnit(@json($item))'>
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn-delete" onclick="deleteUnit({{ $item->id_unit }})">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <i class="fas fa-folder-open"></i>
                                            <h3>Belum Ada Data</h3>
                                            <p>Klik tombol "Tambah Unit Kerja" untuk menambahkan data baru</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Tab Content: Seksi -->
                    <div id="tab-seksi" class="tab-content">
                        <div class="table-header">
                            <h3>Daftar Seksi</h3>
                            <button class="btn-add" onclick="openModal('seksi', 'add')">
                                <i class="fas fa-plus"></i> Tambah Seksi
                            </button>
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="35%">Unit Kerja</th>
                                    <th width="40%">Nama Seksi</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="seksi-tbody">
                                @forelse($seksis as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->unit->nama_unit ?? '-' }}</td>
                                    <td><strong>{{ $item->nama_seksi }}</strong></td>
                                    <td>
                                        <button class="btn-edit" onclick='editSeksi(@json($item))'>
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn-delete" onclick="deleteSeksi({{ $item->id_seksi }})">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <i class="fas fa-folder-open"></i>
                                            <h3>Belum Ada Data</h3>
                                            <p>Klik tombol "Tambah Seksi" untuk menambahkan data baru</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Tab Content: Probis -->
                    <div id="tab-probis" class="tab-content">
                        <div class="table-header">
                            <h3>Daftar Probis (Proses Bisnis)</h3>
                            <button class="btn-add" onclick="openModal('probis', 'add')">
                                <i class="fas fa-plus"></i> Tambah Probis
                            </button>
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Kode Probis</th>
                                    <th width="55%">Nama Probis</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="probis-tbody">
                                @forelse($probis as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $item->kode_probis }}</strong></td>
                                    <td>{{ $item->nama_probis }}</td>
                                    <td>
                                        <button class="btn-edit" onclick='editProbis(@json($item))'>
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn-delete" onclick="deleteProbis({{ $item->id }})">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <i class="fas fa-tasks"></i>
                                            <h3>Belum Ada Data</h3>
                                            <p>Klik tombol "Tambah Probis" untuk menambahkan data baru</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal for CRUD -->
    <div id="crudModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Tambah Data</h2>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form id="crudForm">
                    <input type="hidden" id="entityType">
                    <input type="hidden" id="entityId">
                    <input type="hidden" id="formMode">

                    <!-- Dynamic form fields will be inserted here -->
                    <div id="formFields"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="button" class="btn-submit" onclick="submitForm()">Simpan</button>
            </div>
        </div>
    </div>

    <script>
        // Data from backend
        const direktorats = @json($direktorats);
        const departemens = @json($departemens);
        const units = @json($units);
        const probisList = @json($probis); // Make available globally

        // Tab switching
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });

            // Show selected tab
            document.getElementById('tab-' + tabName).classList.add('active');
            event.target.closest('.tab-btn').classList.add('active');
        }

        // Modal functions
        function openModal(entityType, mode, data = null) {
            document.getElementById('crudModal').style.display = 'block';
            document.getElementById('entityType').value = entityType;
            document.getElementById('formMode').value = mode;

            const modalTitle = document.getElementById('modalTitle');
            const formFields = document.getElementById('formFields');

            // Clear previous form
            formFields.innerHTML = '';

            if (mode === 'add') {
                modalTitle.textContent = 'Tambah ' + getEntityLabel(entityType);
                document.getElementById('entityId').value = '';
            } else {
                modalTitle.textContent = 'Edit ' + getEntityLabel(entityType);
                document.getElementById('entityId').value = data.id;
            }

            // Build form based on entity type
            buildForm(entityType, mode, data);
        }

        function closeModal() {
            document.getElementById('crudModal').style.display = 'none';
            document.getElementById('crudForm').reset();
        }

        function getEntityLabel(entityType) {
            const labels = {
                'direktorat': 'Direktorat',
                'departemen': 'Departemen',
                'unit': 'Unit Kerja',
                'seksi': 'Seksi',
                'probis': 'Probis'
            };
            return labels[entityType] || entityType;
        }

        function buildForm(entityType, mode, data) {
            const formFields = document.getElementById('formFields');
            let html = '';

            // Probis Case
            if (entityType === 'probis') {
                html = `
                     <div class="form-group">
                        <label>Kode Probis <span style="color:red">*</span></label>
                        <input type="text" id="kode_probis" name="kode_probis" value="${data ? data.kode_probis : ''}" placeholder="Contoh: K3, HRD" required maxlength="10">
                    </div>
                    <div class="form-group">
                        <label>Nama Proses Bisnis <span style="color:red">*</span></label>
                        <input type="text" id="nama_probis" name="nama_probis" value="${data ? data.nama_probis : ''}" placeholder="Masukkan Nama Probis" required>
                    </div>
                `;
                formFields.innerHTML = html;
                return;
            }

            switch (entityType) {
                case 'direktorat':
                    html = `
                        <div class="form-group">
                            <label>Nama Direktorat <span style="color:red">*</span></label>
                            <input type="text" id="nama_direktorat" name="nama_direktorat" 
                                value="${data ? data.nama_direktorat : ''}" required>
                            <div class="error" id="error-nama_direktorat"></div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" id="status_aktif" name="status_aktif" 
                                    ${data ? (data.status_aktif ? 'checked' : '') : 'checked'}>
                                <label for="status_aktif" style="margin:0">Status Aktif</label>
                            </div>
                        </div>
                    `;
                    break;

                case 'departemen':
                    html = `
                        <div class="form-group">
                            <label>Direktorat <span style="color:red">*</span></label>
                            <select id="id_direktorat" name="id_direktorat" required>
                                <option value="">-- Pilih Direktorat --</option>
                                ${direktorats.map(d => `
                                    <option value="${d.id_direktorat}" 
                                        ${data && data.id_direktorat == d.id_direktorat ? 'selected' : ''}>
                                        ${d.nama_direktorat}
                                    </option>
                                `).join('')}
                            </select>
                            <div class="error" id="error-id_direktorat"></div>
                        </div>
                        <div class="form-group">
                            <label>Nama Departemen <span style="color:red">*</span></label>
                            <input type="text" id="nama_dept" name="nama_dept" 
                                value="${data ? data.nama_dept : ''}" required>
                            <div class="error" id="error-nama_dept"></div>
                        </div>
                    `;
                    break;

                case 'unit':
                     let deptOptions = '';
                     departemens.forEach(d => {
                        const selected = (data && data.id_dept == d.id_dept) ? 'selected' : '';
                        deptOptions += `<option value="${d.id_dept}" ${selected}>${d.nama_dept}</option>`;
                    });

                    // Add Probis Options
                    let probisOptions = '';
                    const probisList = @json($probis); // Pass global probis variable 
                    probisList.forEach(p => {
                        const selected = (data && data.id_probis == p.id) ? 'selected' : '';
                        probisOptions += `<option value="${p.id}" ${selected}>${p.kode_probis} - ${p.nama_probis}</option>`;
                    });

                    html = `
                        <div class="form-group">
                            <label>Departemen <span style="color:red">*</span></label>
                            <select id="id_dept" name="id_dept" required>
                                <option value="">-- Pilih Departemen --</option>
                                ${deptOptions}
                            </select>
                            <div class="error" id="error-id_dept"></div>
                        </div>
                        <div class="form-group">
                            <label>Nama Unit Kerja <span style="color:red">*</span></label>
                            <input type="text" id="nama_unit" name="nama_unit" 
                                value="${data ? data.nama_unit : ''}" required>
                            <div class="error" id="error-nama_unit"></div>
                        </div>
                        <div class="form-group">
                            <label>Probis (Opsional)</label>
                            <select id="id_probis" name="id_probis">
                                <option value="">-- Pilih Probis --</option>
                                ${probisOptions}
                            </select>
                        </div>
                    `;
                    break;

                case 'seksi':
                    html = `
                        <div class="form-group">
                            <label>Unit Kerja <span style="color:red">*</span></label>
                            <select id="id_unit" name="id_unit" required>
                                <option value="">-- Pilih Unit --</option>
                                ${units.map(u => `
                                    <option value="${u.id_unit}" 
                                        ${data && data.id_unit == u.id_unit ? 'selected' : ''}>
                                        ${u.nama_unit}
                                    </option>
                                `).join('')}
                            </select>
                            <div class="error" id="error-id_unit"></div>
                        </div>
                        <div class="form-group">
                            <label>Nama Seksi <span style="color:red">*</span></label>
                            <input type="text" id="nama_seksi" name="nama_seksi" 
                                value="${data ? data.nama_seksi : ''}" required>
                            <div class="error" id="error-nama_seksi"></div>
                        </div>
                    `;
                    break;
            }

            formFields.innerHTML = html;
        }

        // Submit form
        function submitForm() {
            // Clear previous errors
            document.querySelectorAll('.error').forEach(el => el.textContent = '');

            const entityType = document.getElementById('entityType').value;
            const formMode = document.getElementById('formMode').value;
            const entityId = document.getElementById('entityId').value;

            // Collect form data
            const formData = {};
            const form = document.getElementById('crudForm');
            const inputs = form.querySelectorAll('input, select');

            inputs.forEach(input => {
                if (input.type === 'checkbox') {
                    formData[input.name] = input.checked ? 1 : 0;
                } else if (input.name && input.id !== 'entityType' && input.id !== 'entityId' && input.id !== 'formMode') {
                    formData[input.name] = input.value;
                }
            });

            console.log('Form Data:', formData);

            // Determine URL and method
            let url, method;
            if (formMode === 'add') {
                url = `/admin/${entityType}`;
                method = 'POST';
            } else {
                url = `/admin/${entityType}/${entityId}`;
                method = 'PUT';
            }

            console.log('Request URL:', url);
            console.log('Request Method:', method);

            // Send AJAX request
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-HTTP-Method-Override': method === 'PUT' ? 'PUT' : 'POST'
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                console.log('Response Status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Response Data:', data);
                if (data.success) {
                    closeModal(); // Close modal first
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    // Display validation errors
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const errorEl = document.getElementById('error-' + key);
                            if (errorEl) {
                                errorEl.textContent = data.errors[key][0];
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan saat menyimpan data'
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat menyimpan data: ' + error.message
                });
            });
        }

        // Edit functions
        function editDirektorat(data) {
            openModal('direktorat', 'edit', {
                id: data.id_direktorat,
                nama_direktorat: data.nama_direktorat,
                status_aktif: data.status_aktif
            });
        }

        function editDepartemen(data) {
            openModal('departemen', 'edit', {
                id: data.id_dept,
                id_direktorat: data.id_direktorat,
                nama_dept: data.nama_dept
            });
        }

        function editUnit(data) {
            openModal('unit', 'edit', {
                id: data.id_unit,
                id_dept: data.id_dept,
                nama_unit: data.nama_unit,
                id_probis: data.id_probis // Pass probis ID
            });
        }

        function editSeksi(data) {
            openModal('seksi', 'edit', {
                id: data.id_seksi,
                id_unit: data.id_unit,
                nama_seksi: data.nama_seksi
            });
        }

        // Delete functions
        function deleteDirektorat(id) {
            confirmDelete('direktorat', id);
        }

        function deleteDepartemen(id) {
            confirmDelete('departemen', id);
        }

        function deleteUnit(id) {
            confirmDelete('unit', id);
        }

        function deleteSeksi(id) {
            confirmDelete('seksi', id);
        }

        function editProbis(data) {
            openModal('probis', 'edit', data);
        }

        function deleteProbis(id) {
            confirmDelete('probis', id);
        }

        function confirmDelete(entityType, id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#c41e3a',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/${entityType}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: data.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat menghapus data'
                        });
                    });
                }
            });
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('crudModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>

</html>
