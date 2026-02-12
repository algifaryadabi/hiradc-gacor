<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Form | HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
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

            /* Semantic Colors (Twin Code) */
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
            --shadow-colored: 0 10px 25px -5px rgba(196, 30, 58, 0.15);

            /* Spacing */
            --space-4: 1rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;

            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-full: 9999px;

            --sidebar-bg: #5b6fd8;
        }

        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
        }

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

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Copy */
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

        .logo-section {
            padding: var(--space-8) var(--space-6);
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
            background: transparent;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .logo-circle:hover {
            transform: scale(1.05);
        }

        .logo-circle img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.15));
        }

        .logo-text {
            font-size: 1.125rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
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
            padding: var(--space-6) 0;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--gray-300) transparent;
        }

        .nav-item {
            padding: 1rem 1.5rem;
            margin: 0.25rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            text-decoration: none;
            border-radius: 0.75rem;
            transition: all 0.2s;
            font-size: 0.9375rem;
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

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: white;
            border-radius: 0 4px 4px 0;
        }

        .nav-item i {
            width: 24px;
            text-align: center;
            font-size: 1.125rem;
        }

        .badge {
            background: #ef4444;
            color: white;
            font-size: 0.65rem;
            padding: 2px 8px;
            border-radius: 99px;
            font-weight: 700;
            margin-left: auto;
        }

        .user-info-bottom {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            background: transparent;
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
            background: var(--surface);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-weight: 700;
            font-size: 1.125rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.2);
            flex-shrink: 0;
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
            margin-bottom: 2px;
        }

        .user-role {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
        }

        .logout-btn {
            width: 100%;
            padding: 0.75rem;
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
            gap: 8px;
            text-decoration: none;
            backdrop-filter: blur(10px);
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 0;
            background: var(--bg-body);
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%);
            padding: var(--space-8) var(--space-10);
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(8px);
        }

        .header h1 {
            font-size: 1.875rem;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.02em;
        }

        .header p {
            font-size: 0.925rem;
            color: var(--text-secondary);
            margin-top: 4px;
            font-weight: 500;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, var(--primary) 50%, transparent 100%);
            opacity: 0.3;
        }

        .content-area {
            padding: var(--space-10);
            max-width: 1600px;
            margin: 0 auto;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--space-6);
            margin-bottom: var(--space-8);
        }

        .stat-card {
            background: var(--surface);
            padding: var(--space-6);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            gap: var(--space-6);
            border: 1px solid var(--border);
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-200);
        }

        .stat-icon {
            width: 64px;
            height: 64px;
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            background: var(--gray-50);
            color: var(--gray-500);
        }

        .stat-info h3 {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 0px;
        }

        .stat-info p {
            font-size: 0.875rem;
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-top: 4px;
        }

        .stat-icon.orange {
            background: var(--warning-light);
            color: var(--warning);
        }

        .stat-icon.green {
            background: var(--success-light);
            color: var(--success);
        }

        .stat-icon.red {
            background: var(--error-light);
            color: var(--error);
        }

        /* Filters Tabs */
        .filters-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-6);
        }

        .tabs {
            display: flex;
            gap: 4px;
            background: var(--gray-200);
            padding: 4px;
            border-radius: var(--radius-lg);
        }

        .tab-btn {
            padding: 8px 16px;
            border-radius: var(--radius-lg);
            border: none;
            background: transparent;
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .tab-btn:hover {
            color: var(--text-primary);
        }

        .tab-btn.active {
            background: white;
            color: var(--primary);
            box-shadow: var(--shadow-sm);
        }

        /* Table Styles */
        .table-section {
            background: var(--surface);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            border: 1px solid var(--border);
            animation: fadeIn 0.4s ease-out;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table thead {
            background: var(--gray-50);
            border-bottom: 2px solid var(--border);
        }

        .custom-table th {
            padding: var(--space-4) var(--space-6);
            text-align: left;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-secondary);
            letter-spacing: 0.05em;
        }

        .custom-table td {
            padding: var(--space-4) var(--space-6);
            font-size: 0.9375rem;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-light);
            vertical-align: middle;
        }

        .custom-table tr:hover {
            background: var(--surface-hover);
        }

        .status-pill {
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-menunggu {
            background: var(--warning-light);
            color: var(--warning);
        }

        .status-disetujui {
            background: var(--success-light);
            color: var(--success);
        }

        .status-revisi {
            background: var(--error-light);
            color: var(--error);
        }

        .status-diproses {
            background: var(--info-light);
            color: var(--info);
        }

        .btn-action-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            border: 1px solid var(--border);
            transition: all 0.2s;
            background: white;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-action-icon:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-50);
        }

        .btn-review {
            width: auto;
            padding: 6px 14px;
            background: var(--primary);
            color: white;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8125rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-review:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(196, 30, 58, 0.2);
        }

        .empty-state {
            padding: 60px;
            text-align: center;
        }

        .empty-state i {
            font-size: 3.5rem;
            color: var(--gray-300);
            margin-bottom: 16px;
        }

        .empty-state p {
            font-size: 1rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* Modern Select for Staff */
        .form-select {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: var(--font-sans);
            font-size: 0.875rem;
            color: var(--text-primary);
            outline: none;
            transition: border 0.2s;
            cursor: pointer;
        }

        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-50);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <div>
                    <h1>Review Form Masuk</h1>
                    <p>Kelola persetujuan form HIRADC dari unit kerja Anda.</p>
                </div>

                <!-- NEW: Staff Delegation Dropdown (Only for Kepala Unit) -->
                @if(Auth::user()->role_jabatan == 3 && isset($staffList) && $staffList->count() > 0)
                    <div
                        style="display: flex; align-items: center; gap: 12px; background: var(--surface); padding: 8px 16px; border-radius: var(--radius-lg); border: 1px solid var(--border); box-shadow: var(--shadow-sm);">
                        <div style="text-align: right;">
                            <label
                                style="display: block; font-size: 0.75rem; color: var(--text-secondary); font-weight: 700; text-transform: uppercase;">
                                Delegasi Staff
                            </label>
                            <small style="font-size: 0.75rem; color: var(--primary);">PIC Bertanggung Jawab</small>
                        </div>
                        <select id="assignStaffDropdown" class="form-select" onchange="assignStaff(this.value)">
                            <option value="">-- Pilih Staff --</option>
                            @foreach($staffList as $staff)
                                <option value="{{ $staff->id_user }}">
                                    {{ $staff->nama_user }} ({{ $staff->role_jabatan == 4 ? 'Mgr' : 'Spv' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>

            <div class="content-area">
                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon orange"><i class="fas fa-hourglass-half"></i></div>
                        <div class="stat-info">
                            <h3 id="count-waiting">0</h3>
                            <p>Menunggu Review</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info">
                            <h3 id="count-approved">0</h3>
                            <p>Telah Disetujui</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon red"><i class="fas fa-undo-alt"></i></div>
                        <div class="stat-info">
                            <h3 id="count-revision">0</h3>
                            <p>Perlu Revisi</p>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="filters-bar">
                    <div class="tabs">
                        <button class="tab-btn active" onclick="filterData('Semua', this)">Semua</button>
                        <button class="tab-btn" onclick="filterData('Menunggu', this)">Menunggu</button>
                        <button class="tab-btn" onclick="filterData('Disetujui', this)">Disetujui</button>
                        <button class="tab-btn" onclick="filterData('Terpublikasi', this)">Terpublikasi</button>
                        <button class="tab-btn" onclick="filterData('Revisi', this)">Revisi</button>
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <!-- Additional filters can go here -->
                    </div>
                </div>

                <!-- Document List Table -->
                <div class="table-section">
                    <div id="documentListTable">
                        <!-- Javascript will populate table -->
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script>
        const documents = @json($documentsData);
        let activeStatusFilter = 'Semua';

        function renderDocumentList() {
            const container = document.getElementById('documentListTable');
            let filtered = documents;

            if (activeStatusFilter !== 'Semua') {
                if (activeStatusFilter === 'Menunggu') {
                    filtered = documents.filter(d => d.status.includes('Menunggu'));
                } else if (activeStatusFilter === 'Disetujui') {
                    filtered = documents.filter(d => d.status === 'Disetujui');
                } else if (activeStatusFilter === 'Terpublikasi') {
                    filtered = documents.filter(d => d.status === 'Published' || d.status === 'Terpublikasi' || d.raw_status === 'published');
                } else if (activeStatusFilter === 'Revisi') {
                    filtered = documents.filter(d => d.status === 'Revisi');
                }
            }

            if (filtered.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <p>Tidak ada form yang ditemukan untuk filter ini.</p>
                        <div style="font-size:0.75rem; color:var(--text-tertiary); margin-top:8px;">Filter: ${activeStatusFilter}</div>
                    </div>
                `;
                return;
            }

            let html = `
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Unit / Departemen</th>
                            <th>Judul Dokumen</th>
                            <th>Submitter</th>
                            <th>Waktu Submit</th>
                            <th>Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            filtered.forEach(doc => {
                let badgeClass, badgeIcon;

                // Badge Logic
                // Note: 'Disetujui' usually means Level 1 approved but pending others.
                // 'Published' means fully done.

                // Map to logic
                const isPublished = (doc.status === 'Published' || doc.status === 'Terpublikasi' || doc.raw_status === 'published');

                if (isPublished) {
                    badgeClass = 'status-diproses'; // Blue for Published (as requested "not yellow", Blue is distinct from Green/Red)
                    badgeIcon = '<i class="fas fa-globe"></i>'; // Globe for published
                } else if (doc.status === 'Disetujui' || doc.status.includes('Final')) {
                    badgeClass = 'status-disetujui'; // Green for internal approval
                    badgeIcon = '<i class="fas fa-check-circle"></i>';
                } else if (doc.status === 'Revisi') {
                    badgeClass = 'status-revisi';
                    badgeIcon = '<i class="fas fa-exclamation-circle"></i>';
                } else {
                    badgeClass = 'status-menunggu'; // Yellow default for pending
                    badgeIcon = '<i class="fas fa-clock"></i>';
                }

                // Button Logic
                let actionBtn = '';
                if (doc.status.includes('Menunggu')) {
                    actionBtn = `
                        <a href="${doc.viewUrl}" class="btn-review">
                            <i class="fas fa-pen-fancy"></i> Review
                        </a>
                     `;
                } else {
                    actionBtn = `
                        <a href="${doc.viewUrl}" class="btn-action-icon" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                     `;
                }

                html += `
                    <tr>
                        <td>
                            <div style="font-weight: 700;">${doc.unit}</div>
                            <div style="font-size: 0.75rem; color: var(--text-secondary);">${doc.department}</div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--text-primary);">${doc.title}</div>
                            <div style="font-size: 0.75rem; color: var(--text-tertiary); margin-top: 2px;">${doc.category || '-'}</div>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <i class="far fa-user-circle" style="color: var(--text-tertiary);"></i>
                                <span style="font-weight: 500;">${doc.submitter}</span>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 500;">${doc.date_submit}</div>
                            <div style="font-size: 0.75rem; color: var(--text-tertiary);">${doc.time_submit}</div>
                        </td>
                        <td>
                            <span class="status-pill ${badgeClass}">
                                ${badgeIcon} ${doc.status}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            ${actionBtn}
                        </td>
                    </tr>
                `;
            });

            html += `</tbody></table>`;
            container.innerHTML = html;
        }

        function filterData(status, btn) {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            activeStatusFilter = status;
            renderDocumentList();
        }

        function updateCounts() {
            const waiting = documents.filter(d => d.status.includes('Menunggu')).length;
            const approved = documents.filter(d => d.status === 'Disetujui').length;
            const revision = documents.filter(d => d.status === 'Revisi').length;

            document.getElementById('count-waiting').textContent = waiting;
            document.getElementById('count-approved').textContent = approved;
            document.getElementById('count-revision').textContent = revision;
        }

        // Initialize
        updateCounts();
        renderDocumentList();
    </script>

    <!-- Flash Messages -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK',
                confirmButtonColor: '#c41e3a'
            });
        </script>
    @endif
</body>

</html>