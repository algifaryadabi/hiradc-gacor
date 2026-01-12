<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Dokumen - Unit Pengelola</title>
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
            background: #f8f9fa;
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: white;
            border-right: 1px solid #eee;
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 10;
        }

        .logo-section {
            padding: 30px 20px;
            text-align: center;
        }

        .nav-menu {
            flex: 1;
            padding: 20px 0;
        }

        .nav-item {
            padding: 12px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #555;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            border-left: 4px solid transparent;
        }

        .nav-item:hover {
            background: #feebeb;
            color: #c41e3a;
        }

        .nav-item.active {
            background: #feebeb;
            color: #c41e3a;
            border-left-color: #c41e3a;
            font-weight: 600;
        }

        .user-section {
            padding: 20px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            margin-top: auto;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px;
            border-radius: 6px;
            text-align: center;
            display: block;
            text-decoration: none;
            font-size: 12px;
            margin-top: 10px;
        }

        /* Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 30px 40px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #2d3436;
        }

        /* Summary Cards */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            border: 1px solid #f0f0f0;
            text-align: center;
        }

        .card-label {
            font-size: 13px;
            color: #666;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .card-value {
            font-size: 32px;
            font-weight: 700;
            color: #333;
        }

        /* Filters */
        .filter-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            align-items: center;
        }

        .tab-btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            color: #555;
            background: #eee;
        }

        .tab-btn.active {
            background: #d0d0d0;
            color: #333;
        }

        /* Grey status as per image default? OR maybe match theme? Image shows greyish active tab */
        .search-select {
            margin-left: auto;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 13px;
        }

        /* Table */
        .table-wrapper {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid #f0f0f0;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th {
            background: #c41e3a;
            color: white;
            padding: 15px 25px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            border-bottom: 1px solid #b71c1c;
        }

        .custom-table td {
            padding: 15px 25px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
            color: #333;
            vertical-align: middle;
        }

        .custom-table tr:hover td {
            background: #fafafa;
        }

        .status-text {
            font-weight: 700;
            font-size: 13px;
        }

        .status-waiting {
            color: #f57c00;
        }

        /* Orange for Menunggu */
        .status-approved {
            color: #2e7d32;
        }

        /* Green for Disetujui */

        .btn-view {
            padding: 8px 18px;
            background: #c41e3a;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .btn-view:hover {
            background: #a01830;
        }
    </style>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo-section">
                <img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP" style="width: 50px; margin-bottom:5px;">
                <div style="font-weight:700; color:#c41e3a; font-size:14px;">PT Semen Padang</div>
                <div style="font-size:11px; color:#888;">HIRADC System</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('unit_pengelola.dashboard') }}" class="nav-item"><i class="fas fa-th-large"></i>
                    Dashboard</a>
                <a href="#" class="nav-item active"><i class="fas fa-file-contract"></i> Cek Dokumen</a>
            </nav>
            <div class="user-section">
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
                    <div
                        style="width:35px; height:35px; background:white; color:#2575fc; border-radius:50%; display:flex; justify-content:center; align-items:center; font-weight:bold;">
                        UP</div>
                    <div>
                        <div style="font-size:13px; font-weight:600;">Staff UP</div>
                        <div class="user-role" style="font-size:10px; opacity:0.8;">Unit Pengelola SHE</div>
                    </div>
                </div>

                <!-- ROLE SWITCHER -->
                <div style="margin-bottom: 10px; padding: 5px; background: rgba(0,0,0,0.1); border-radius: 4px;">
                    <label style="font-size: 10px; opacity:0.8; display:block; margin-bottom: 3px;">Simulasi
                        Role:</label>
                    <select id="roleSwitcher" onchange="switchRole(this.value)"
                        style="width: 100%; padding: 4px; font-size: 11px; border: none; border-radius: 3px; color:#333;">
                        <option value="SHE">SHE (K3/KO/Env)</option>
                        <option value="Keamanan">Keamanan</option>
                    </select>
                </div>

                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
        </aside>

        <main class="main-content">
            <h1 class="page-title">Cek Dokumen</h1>

            <div class="summary-cards" style="grid-template-columns: repeat(2, 1fr);">
                <div class="card">
                    <div class="card-label">Menunggu</div>
                    <div class="card-value" id="count-waiting">0</div>
                </div>
                <div class="card">
                    <div class="card-label">Disetujui</div>
                    <div class="card-value" id="count-approved">0</div>
                </div>
            </div>

            <div class="filter-tabs">
                <button class="tab-btn active" onclick="filterStatus('all')">Semua</button>
                <button class="tab-btn" onclick="filterStatus('waiting')">Menunggu</button>
                <button class="tab-btn" onclick="filterStatus('approved')">Disetujui</button>

                <select class="search-select" onchange="filterCategory(this.value)">
                    <option value="all">Semua Kategori</option>
                    <option value="K3">K3</option>
                    <option value="KO">KO</option>
                    <option value="Lingkungan">Lingkungan</option>
                    <option value="Pengamanan">Pengamanan</option>
                </select>
            </div>

            <div class="table-wrapper">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Unit Penginput</th>
                            <th>Kategori</th>
                            <th>Tanggal Submit</th>
                            <th>Status Terakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- JS populated -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- DETAIL MODAL -->
    <div id="detailModal" class="modal"
        style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; overflow:auto; background-color:rgba(0,0,0,0.5);">
        <div class="modal-content"
            style="background-color:#fefefe; margin:5% auto; padding:0; border:1px solid #888; width:600px; border-radius:12px; position:relative; animation:slideDown 0.3s ease-out;">
            <div class="modal-header"
                style="padding:20px 30px; border-bottom:1px solid #eee; display:flex; justify-content:space-between; align-items:center;">
                <h2 style="font-size:18px; font-weight:700; color:#333; margin:0;">Detail Dokumen</h2>
                <span onclick="closeModal()"
                    style="color:#aaa; font-size:24px; font-weight:bold; cursor:pointer;">&times;</span>
            </div>
            <div class="modal-body" style="padding:30px;">
                <!-- Content same as dashboard -->
                <div
                    style="font-size:14px; font-weight:700; color:#c41e3a; margin-bottom:20px; display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-file-alt"></i> Informasi Dokumen
                </div>

                <div class="info-row" style="display:flex; margin-bottom:15px;">
                    <div style="width:140px; font-size:14px; color:#888; font-weight:500;">Judul Dokumen:</div>
                    <div id="m_title" style="flex:1; font-size:14px; color:#333; font-weight:600;"></div>
                </div>
                <div class="info-row" style="display:flex; margin-bottom:15px;">
                    <div style="width:140px; font-size:14px; color:#888; font-weight:500;">Status:</div>
                    <div style="flex:1;"><span id="m_status"
                            style="background-color:#e8f5e9; color:#2e7d32; padding:4px 12px; border-radius:15px; font-size:12px; font-weight:700; text-transform:uppercase;"></span>
                    </div>
                </div>
                <div class="info-row" style="display:flex; margin-bottom:15px;">
                    <div style="width:140px; font-size:14px; color:#888; font-weight:500;">Kategori:</div>
                    <div id="m_category" style="flex:1; font-size:14px; color:#333; font-weight:600;"></div>
                </div>
                <div class="info-row" style="display:flex; margin-bottom:15px;">
                    <div style="width:140px; font-size:14px; color:#888; font-weight:500;">Unit Penginput:</div>
                    <div id="m_unit" style="flex:1; font-size:14px; color:#333; font-weight:600;"></div>
                </div>
                <div class="info-row" style="display:flex; margin-bottom:15px;">
                    <div style="width:140px; font-size:14px; color:#888; font-weight:500;">Tanggal:</div>
                    <div id="m_date" style="flex:1; font-size:14px; color:#333; font-weight:600;"></div>
                </div>

                <hr style="border:0; border-top:1px solid #eee; margin:25px 0;">

                <div
                    style="font-size:14px; font-weight:700; color:#2e7d32; margin-bottom:20px; display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-check-circle"></i> Status Proses
                </div>

                <div style="background-color:#f1f8e9; border-left:4px solid #2e7d32; padding:15px; border-radius:4px;">
                    <div style="font-size:13px; color:#33691e; line-height:1.5;" id="m_notes">
                        <!-- Dynamic notes -->
                    </div>
                </div>

                <div style="margin-top:20px; text-align:right;" id="action_container">
                    <!-- Action buttons if needed, e.g. Link to Verify -->
                    <a href="{{ route('unit_pengelola.review') }}" class="btn-view" style="display:none;"
                        id="btn_verify_modal">Lanjut Verifikasi</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // MASTER CONFIG FOR SIMULATION
        // Read from Storage or Default to 'SHE'
        const currentUserRole = localStorage.getItem('up_role') || 'SHE'; 


        // Mock Data
        const documents = [
            {
                id: 1,
                unit: 'Unit Produksi A',
                title: 'Penilaian Risiko Unit A',
                category: 'K3',
                date: '18-10-2025',
                status: 'waiting',
                status_text: 'Menunggu Verifikasi',
                notes: 'Menunggu tindak lanjut dari Unit Pengelola.'
            },
            {
                id: 2,
                unit: 'Unit Lingkungan',
                title: 'Laporan Lingkungan B3',
                category: 'Lingkungan',
                date: '18-10-2025',
                status: 'waiting',
                status_text: 'Menunggu Verifikasi',
                notes: 'Dokumen baru diajukan, perlu verifikasi.'
            },
            {
                id: 3,
                unit: 'Unit Keamanan',
                title: 'Audit Keamanan Post 2',
                category: 'Pengamanan', // Matches option value
                date: '15-10-2025',
                status: 'approved',
                status_text: 'Disetujui (Ke KD)',
                notes: 'Disetujui dan diteruskan ke Kepala Departemen.'
            },
            {
                id: 4,
                unit: 'Unit K3',
                title: 'Evaluasi K3 Tahunan',
                category: 'K3',
                date: '10-10-2025',
                status: 'approved',
                status_text: 'Disetujui (Ke KD)',
                notes: 'Sudah diverifikasi dan disetujui.'
            },
            {
                id: 5,
                unit: 'Unit Operasi',
                title: 'Laporan Operasional Mesin X',
                category: 'KO',
                date: '09-10-2025',
                status: 'approved',
                status_text: 'Disetujui (Ke KD)',
                notes: 'Laporan valid. Disetujui.'
            }
        ];

        let currentStatus = 'all';
        let currentCategory = 'all';

        document.addEventListener('DOMContentLoaded', () => {
            updateUserProfile();
            renderTable();
            updateCounts();
        });

        function updateUserProfile() {
            const roleEl = document.querySelector('.user-role'); // Assuming class exists sidebar
            if (roleEl) {
                roleEl.textContent = currentUserRole === 'SHE' ? 'Unit Pengelola SHE' : 'Unit Pengelola Keamanan';
            }
        }

        function filterByRole(docs) {
            return docs.filter(d => {
                if (currentUserRole === 'SHE') {
                    return ['K3', 'KO', 'Lingkungan'].includes(d.category);
                } else if (currentUserRole === 'Keamanan') {
                    return ['Keamanan', 'Pengamanan'].includes(d.category);
                }
                return true;
            });
        }

        function updateCounts() {
            // Apply Role Filter first
            const roleDocs = filterByRole(documents);

            const waiting = roleDocs.filter(d => d.status === 'waiting').length;
            const approved = roleDocs.filter(d => d.status === 'approved').length;

            document.getElementById('count-waiting').textContent = waiting;
            document.getElementById('count-approved').textContent = approved;
        }

        function filterStatus(status) {
            currentStatus = status;

            // Update Tab UI
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
                if (btn.textContent.toLowerCase() === (status === 'all' ? 'semua' : (status === 'waiting' ? 'menunggu' : 'disetujui'))) {
                    btn.classList.add('active');
                }
            });

            renderTable();
        }

        function filterCategory(category) {
            currentCategory = category;
            renderTable();
        }

        function renderTable() {
            const tbody = document.getElementById('tableBody');
            tbody.innerHTML = '';

            // 1. Filter by Role
            let filtered = filterByRole(documents);

            // 2. Filter by Status & Category UI controls
            filtered = filtered.filter(doc => {
                if (currentStatus !== 'all' && doc.status !== currentStatus) return false;
                if (currentCategory !== 'all' && doc.category !== currentCategory) return false;
                return true;
            });

            if (filtered.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" style="text-align:center; padding:20px; color:#999;">Tidak ada dokumen yang ditemukan.</td></tr>';
                return;
            }

            filtered.forEach(doc => {
                const statusClass = doc.status === 'waiting' ? 'status-waiting' : 'status-approved';
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td><strong>${doc.unit}</strong></td>
                    <td>${doc.category}</td>
                    <td>${doc.date}</td>
                    <td><span class="status-text ${statusClass}">${doc.status_text}</span></td>
                    <td><button onclick="openDetailModal(${doc.id})" class="btn-view" style="border:none; cursor:pointer;">View</button></td>
                `;
                tbody.appendChild(tr);
            });
        }

        // Modal Logic
        function openDetailModal(id) {
            const doc = documents.find(d => d.id === id);
            if (!doc) return;

            document.getElementById('m_title').textContent = doc.title;
            document.getElementById('m_status').textContent = doc.status_text;
            document.getElementById('m_category').textContent = doc.category;
            document.getElementById('m_unit').textContent = doc.unit;
            document.getElementById('m_date').textContent = doc.date;
            document.getElementById('m_notes').textContent = doc.notes;

            // Show/Hide Verify Button in Modal if needed
            const btnVerify = document.getElementById('btn_verify_modal');
            if (doc.status === 'waiting') {
                btnVerify.style.display = 'inline-block';
            } else {
                btnVerify.style.display = 'none';
            }

            document.getElementById('detailModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('detailModal').style.display = 'none';
        }

        window.onclick = function (event) {
            const modal = document.getElementById('detailModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
    </script>

    <script>
        // Role Switcher Logic
        document.addEventListener('DOMContentLoaded', () => {
            const switcher = document.getElementById('roleSwitcher');
            if (switcher) switcher.value = currentUserRole;
        });

        function switchRole(role) {
            localStorage.setItem('up_role', role);
            window.location.reload();
        }
    </script>
    </script>
    
    <script>
        // Role Switcher Logic
        document.addEventListener('DOMContentLoaded', () => {
             const switcher = document.getElementById('roleSwitcher');
             if(switcher) switcher.value = currentUserRole;
        });

        function switchRole(role) {
            localStorage.setItem('up_role', role);
            window.location.reload();
        }
    </script>
</body>

</html>