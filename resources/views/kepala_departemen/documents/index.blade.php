<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen - Kepala Departemen</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #c41e3a;
            --primary-light: #fff1f2;
            --primary-hover: #a01830;
            --bg-body: #f8fafc;
            --surface: #ffffff;
            --text-main: #1e293b;
            --text-sub: #64748b;
            --border: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
        }

        /* Sidebar - Twin Design */
        .sidebar {
            width: 280px;
            background: #5b6fd8;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        .logo-section {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
            position: relative;
        }

        .logo-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.3) 50%, transparent 100%);
        }

        .logo-circle {
            width: 90px;
            height: 90px;
            margin: 0 auto 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .logo-circle:hover {
            transform: scale(1.05);
        }

        .logo-circle img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.125rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
            letter-spacing: -0.02em;
        }

        .logo-subtext {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .nav-menu {
            flex: 1;
            padding: 1.5rem 0;
            overflow-y: auto;
        }

        .nav-item {
            padding: 1rem 1.5rem;
            margin: 0.25rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9375rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 0.75rem;
            position: relative;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(4px);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.125rem;
        }

        .user-info-bottom {
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
            width: 48px;
            height: 48px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5b6fd8;
            font-weight: 700;
            font-size: 1.125rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
            font-weight: 500;
        }

        .logout-btn {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
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
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 40px 48px;
        }

        .header-content {
            margin-bottom: 32px;
        }

        .header-content h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 8px;
            letter-spacing: -0.03em;
        }

        .header-content p {
            color: var(--text-sub);
            font-size: 14px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--surface);
            padding: 20px;
            border-radius: 16px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: #cbd5e1;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        /* Stat Variants */
        .sc-pending .stat-icon {
            background: #fff7ed;
            color: #ea580c;
        }

        .sc-approved .stat-icon {
            background: #f0fdf4;
            color: #16a34a;
        }

        .sc-revision .stat-icon {
            background: #fef2f2;
            color: #dc2626;
        }

        .sc-total .stat-icon {
            background: #eff6ff;
            color: #2563eb;
        }

        .stat-val {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1.2;
        }

        .stat-label {
            font-size: 13px;
            color: var(--text-sub);
            font-weight: 500;
        }

        /* Filters Bar */
        .filters-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            gap: 16px;
        }

        .search-box {
            position: relative;
            flex: 1;
            max-width: 380px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 16px 12px 42px;
            border-radius: 12px;
            border: 1px solid var(--border);
            font-size: 14px;
            font-family: inherit;
            transition: all 0.2s;
            background: var(--surface);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-sub);
            font-size: 14px;
        }

        .view-toggles {
            display: flex;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 10px;
            gap: 4px;
        }

        .view-btn {
            padding: 8px 16px;
            border: none;
            background: transparent;
            border-radius: 8px;
            cursor: pointer;
            color: var(--text-sub);
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
            font-family: inherit;
        }

        .view-btn.active {
            background: var(--surface);
            color: var(--text-main);
            box-shadow: var(--shadow-sm);
        }

        .view-btn:hover:not(.active) {
            color: var(--text-main);
        }

        /* Modern Document List */
        .doc-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .doc-item {
            background: var(--surface);
            border-radius: 16px;
            padding: 20px;
            display: grid;
            grid-template-columns: auto 1fr auto auto;
            align-items: center;
            gap: 24px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .doc-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: #cbd5e1;
        }

        .doc-date-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid var(--border);
            color: var(--text-main);
        }

        .doc-day {
            font-size: 20px;
            font-weight: 800;
            line-height: 1;
        }

        .doc-month {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-sub);
            text-transform: uppercase;
        }

        .doc-info {
            display: flex;
            flex-direction: column;
            gap: 6px;
            min-width: 0;
        }

        .doc-header-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2px;
        }

        .doc-unit-badge {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #3b82f6;
            background: #eff6ff;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .doc-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .doc-submitter {
            font-size: 13px;
            color: var(--text-sub);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Risk Badges */
        .risk-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .risk-high {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fee2e2;
        }

        .risk-med {
            background: #fff7ed;
            color: #ea580c;
            border: 1px solid #ffedd5;
        }

        .risk-low {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #dcfce7;
        }

        /* Status Pills */
        .status-pill {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .status-pending {
            background: #fff7ed;
            color: #d97706;
            border: 1px solid #ffedd5;
        }

        .status-approved {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #dcfce7;
        }

        .status-revision {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fee2e2;
        }

        .btn-action {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            /** Square with rounded corners like mobile view button? Or pill? Keeping it clean icon button or review button */
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-sub);
            background: transparent;
            border: 1px solid transparent;
            transition: all 0.2s;
        }

        .btn-review {
            padding: 10px 20px;
            background: var(--text-main);
            color: white;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-review:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-1px);
        }

        /* Empty State */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
            background: var(--surface);
            border-radius: 16px;
            border: 2px dashed var(--border);
        }

        .empty-icon {
            font-size: 48px;
            color: #cbd5e1;
            margin-bottom: 16px;
        }
    </style>
</head>

<body>
    <div class="layout-container" style="display:flex;">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <main class="main-content">
            <div class="header-content">
                <h1>Tinjauan & Validasi Dokumen</h1>
                <p>Verifikasi draft HIRADC yang masuk dari Unit Kerja di bawah Departemen Anda.</p>
            </div>

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card sc-pending" onclick="filterByStat('Menunggu')">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <div class="stat-val" id="count-pending">0</div>
                        <div class="stat-label">Menunggu Verifikasi</div>
                    </div>
                </div>
                <div class="stat-card sc-approved" onclick="filterByStat('Disetujui')">
                    <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <div class="stat-val" id="count-approved">0</div>
                        <div class="stat-label">Telah Disetujui</div>
                    </div>
                </div>
                <div class="stat-card sc-revision" onclick="filterByStat('Revisi')">
                    <div class="stat-icon"><i class="fas fa-undo"></i></div>
                    <div>
                        <div class="stat-val" id="count-revision">0</div>
                        <div class="stat-label">Dikembalikan</div>
                    </div>
                </div>
                <div class="stat-card sc-total" onclick="filterByStat('Semua')">
                    <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                    <div>
                        <div class="stat-val" id="count-total">0</div>
                        <div class="stat-label">Total Dokumen</div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-bar">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput"
                        placeholder="Cari berdasarkan judul, unit kerja, atau penyusun..." onkeyup="renderDocuments()">
                </div>
                <div class="view-toggles">
                    <button class="view-btn active" onclick="setFilter('All', this)">Semua</button>
                    <button class="view-btn" onclick="setFilter('Menunggu', this)">Menunggu</button>
                    <button class="view-btn" onclick="setFilter('Disetujui', this)">Disetujui</button>
                    <button class="view-btn" onclick="setFilter('Revisi', this)" style="color:#ef4444;">Revisi</button>
                </div>
                <input type="hidden" id="statusFilter" value="All">
            </div>

            <div class="doc-list" id="docList">
                <!-- Populated by JS -->
            </div>
        </main>
    </div>

    <!-- SweetAlert & Logic -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#16a34a',
                timer: 3000
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}",
                confirmButtonColor: '#ef4444'
            });
        @endif

        const documentsData = @json($documentsData);

        function initStats() {
            const pending = documentsData.filter(d => d.status === 'Menunggu').length;
            // Includes both 'Disetujui' and 'Approved' as safe check
            const approved = documentsData.filter(d => ['Disetujui', 'Approved'].includes(d.status)).length;
            const revision = documentsData.filter(d => d.status === 'Revisi').length;
            const total = documentsData.length;

            document.getElementById('count-pending').innerText = pending;
            document.getElementById('count-approved').innerText = approved;
            document.getElementById('count-revision').innerText = revision;
            document.getElementById('count-total').innerText = total;
        }

        function setFilter(status, btn) {
            document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
            if (btn) btn.classList.add('active');
            document.getElementById('statusFilter').value = status;
            renderDocuments();
        }

        function filterByStat(status) {
            const btns = document.querySelectorAll('.view-btn');
            btns.forEach(b => {
                const btnText = b.innerText;
                if (btnText === status || (status === 'All' && btnText === 'Semua')) {
                    setFilter(status === 'Semua' ? 'All' : status, b);
                }
            });
        }

        function renderDocuments() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const container = document.getElementById('docList');

            container.innerHTML = '';

            const filtered = documentsData.filter(doc => {
                const matchSearch = (doc.title || '').toLowerCase().includes(search) ||
                    (doc.unit || '').toLowerCase().includes(search) ||
                    (doc.submitter || '').toLowerCase().includes(search);

                const matchStatus = statusFilter === 'All' || doc.status === statusFilter;
                return matchSearch && matchStatus;
            });

            if (filtered.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fas fa-folder-open"></i></div>
                        <h3 style="font-weight:700; color:#334155;">Tidak ada dokumen ditemukan</h3>
                        <p style="color:#64748b; font-size:14px;">Coba ubah filter atau kata kunci pencarian Anda.</p>
                    </div>`;
                return;
            }

            filtered.forEach(doc => {
                // Status Logic
                let statusClass = 'status-pending';
                let statusIcon = '<i class="fas fa-clock"></i>';
                let statusLabel = doc.display_status || doc.status;

                if (doc.status === 'Menunggu') {
                    statusClass = 'status-pending';
                    statusIcon = '<i class="fas fa-clock"></i>';
                } else if (doc.status === 'Disetujui') {
                    statusClass = 'status-approved';
                    statusIcon = '<i class="fas fa-check-circle"></i>';
                } else if (doc.status === 'Revisi') {
                    statusClass = 'status-revision';
                    statusIcon = '<i class="fas fa-undo"></i>';
                }

                // Sub-Status Badges
                let badgesHtml = '';
                if (doc.status_she) {
                    let color = (doc.status_she === 'approved' || doc.status_she === 'published') ? '#d1fae5' : '#f1f5f9';
                    let textCol = (doc.status_she === 'approved' || doc.status_she === 'published') ? '#065f46' : '#64748b';
                    badgesHtml += `<span style="font-size:10px; padding:3px 8px; border-radius:12px; background:${color}; color:${textCol}; font-weight:600; border:1px solid ${color};">SHE: ${doc.status_she}</span>`;
                }
                if (doc.status_security) {
                    let color = (doc.status_security === 'approved' || doc.status_security === 'published') ? '#d1fae5' : '#f1f5f9';
                    let textCol = (doc.status_security === 'approved' || doc.status_security === 'published') ? '#065f46' : '#64748b';
                    badgesHtml += `<span style="font-size:10px; padding:3px 8px; border-radius:12px; background:${color}; color:${textCol}; font-weight:600; border:1px solid ${color};">SEC: ${doc.status_security}</span>`;
                }

                // Parse Date
                const dateParts = doc.date_submit.split(' ');
                const day = dateParts[0] || '-';
                const month = dateParts[1] || '-';

                const html = `
                    <a href="${doc.viewUrl}" class="doc-item">
                        <!-- Date Badge -->
                        <div class="doc-date-box">
                            <span class="doc-day">${day}</span>
                            <span class="doc-month">${month}</span>
                        </div>

                        <!-- Info -->
                        <div class="doc-info">
                            <div class="doc-header-row">
                                <span class="doc-unit-badge"><i class="fas fa-building"></i> ${doc.unit}</span>
                                <span style="font-size:12px; color:#94a3b8;">• ${doc.time_submit} WIB</span>
                            </div>
                            <div class="doc-title">${doc.title}</div>
                            <div class="doc-submitter" style="margin-bottom:4px;"><i class="fas fa-user-edit"></i> ${doc.submitter}</div>
                            ${doc.category_label && doc.category_label !== 'ALL' ? `<div style="margin-bottom:6px; padding:4px 10px; background:#fef3c7; border:1px solid #f59e0b; border-radius:6px; display:inline-block;"><i class="fas fa-tag" style="color:#d97706;"></i> <span style="font-size:12px; color:#92400e; font-weight:600;">Dari Unit Pengelola ${doc.category_label}</span></div>` : ''}
                            <div style="display:flex; gap:6px; flex-wrap:wrap;">${badgesHtml}</div>
                        </div>

                        <!-- Status Badge -->
                        <div class="status-pill ${statusClass}">
                            ${statusIcon} ${statusLabel}
                        </div>

                        <!-- Action Button -->
                        <button class="btn-review" style="${doc.is_published ? 'background:#64748b;' : ''}">
                            ${doc.is_published ? 'Detail' : 'Review'} <i class="fas ${doc.is_published ? 'fa-eye' : 'fa-arrow-right'}"></i>
                        </button>
                    </a>
                `;
                container.insertAdjacentHTML('beforeend', html);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            initStats();
            renderDocuments();
        });
    </script>
</body>

</html>