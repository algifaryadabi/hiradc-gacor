<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Unit Pengelola | HIRADC System</title>
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

            /* Surface & Background */
            --bg-body: #f1f5f9;
            --surface: #ffffff;
            --surface-hover: #f9fafb;
            --border: #e2e8f0;

            /* Shadows */
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);

            /* Spacing */
            --space-4: 1rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;

            /* Border Radius */
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-full: 9999px;

            /* Fonts */
            --font-sans: 'Plus Jakarta Sans', sans-serif;
            --font-weight-bold: 700;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-sans);
            background: var(--bg-body);
            background-image:
                radial-gradient(at 0% 0%, rgba(196, 30, 58, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--gray-900);
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - Exact Clone of User Dashboard */
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
            background: transparent;
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
            position: relative;
            border-radius: 0.75rem;
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
        }

        .header h1 {
            font-size: 1.875rem;
            font-weight: 800;
            color: var(--gray-900);
            letter-spacing: -0.02em;
        }

        .content-area {
            padding: var(--space-10);
            max-width: 1600px;
            margin: 0 auto;
        }

        /* Tabs System */
        .nav-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 1px;
        }

        .nav-link {
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: var(--gray-500);
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
        }

        .nav-link:hover {
            color: var(--primary);
            background: rgba(196, 30, 58, 0.05);
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .nav-link.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        /* Containers to Toggle */
        .tab-content {
            display: none;
            animation: fadeIn 0.4s ease-out;
        }

        .tab-content.active {
            display: block;
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

        /* Table Components (Shared) */
        .table-section {
            background: var(--surface);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th {
            background: var(--gray-50);
            padding: 1rem 1.5rem;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--gray-500);
            border-bottom: 1px solid var(--border);
        }

        .custom-table td {
            padding: 1rem 1.5rem;
            font-size: 0.9375rem;
            color: var(--gray-900);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .custom-table tr:hover {
            background: var(--surface-hover);
        }

        /* Toggle Switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        input:checked+.slider {
            background-color: var(--primary);
        }

        input:checked+.slider:before {
            transform: translateX(24px);
        }

        /* Status Badge */
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-badge.reviewer {
            background: #e0f2fe;
            color: #0284c7;
        }

        .status-badge.verifier {
            background: #f0fdf4;
            color: #16a34a;
        }

        .status-badge.user {
            background: #f1f5f9;
            color: #64748b;
        }

        .permission-label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 5px;
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        /* Accordion Styles (Migrated) */
        .accordion-item {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            margin-bottom: 0.75rem;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .accordion-header {
            padding: 1.25rem 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
        }

        .accordion-header:hover {
            background: var(--gray-50);
        }

        .accordion-header.active {
            background: #eff6ff;
        }

        .dept-icon {
            width: 40px;
            height: 40px;
            background: #dbeafe;
            color: #3b82f6;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-right: 1rem;
        }

        .unit-list {
            list-style: none;
        }

        .unit-item {
            padding: 1rem 1.5rem 1rem 4rem;
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            justify-content: space-between;
            font-size: 0.9375rem;
        }

        .unit-item:hover {
            background: var(--surface-hover);
            color: var(--primary);
            padding-left: 4.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle">
                    <img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP">
                </div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System</div>
            </div>

            <nav class="nav-menu">
                <a href="{{ route('unit_pengelola.dashboard') }}" class="nav-item active">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>

                @if(Auth::user()->can_create_documents)
                    <a href="{{ route('documents.create') }}" class="nav-item">
                        <i class="fas fa-plus-circle"></i>
                        <span>Buat Dokumen</span>
                    </a>
                @endif

                @if(Auth::user()->role_jabatan == 3 || Auth::user()->is_reviewer || Auth::user()->is_verifier)
                    <a href="{{ route('unit_pengelola.check_documents') }}" class="nav-item">
                        <i class="fas fa-file-contract"></i>
                        <span>Review Dokumen</span>
                        @if(isset($pendingCount) && $pendingCount > 0)
                            <span
                                style="background: white; color: var(--primary); padding: 2px 8px; border-radius: 12px; font-size: 11px; margin-left: auto; font-weight: bold;">
                                {{ $pendingCount }}
                            </span>
                        @endif
                    </a>
                @endif
            </nav>

            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->nama_user ?? Auth::user()->username, 0, 2)) }}
                    </div>
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->nama_user ?? Auth::user()->username }}</div>
                        <div class="user-role">{{ Auth::user()->role_jabatan_name }}</div>
                        <div class="user-role" style="font-weight: normal; opacity: 0.8;">
                            {{ Auth::user()->unit_or_dept_name }}
                        </div>
                    </div>
                </div>
                <!-- Standard Logout Logic using Form -->
                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Dashboard Unit Pengelola</h1>
                <div style="font-size: 0.875rem; color: var(--gray-500); font-weight: 500;">
                    {{ Carbon\Carbon::now()->format('l, d F Y') }}
                </div>
            </div>

            <div class="content-area">
                <!-- Navigation Tabs -->
                <div class="nav-tabs">
                    <div class="nav-link active" onclick="switchTab('dashboard')">
                        <i class="fas fa-chart-pie" style="margin-right: 8px;"></i>Dashboard Utama
                    </div>
                    @if(Auth::user()->role_jabatan == 3)
                        <div class="nav-link" onclick="switchTab('users')">
                            <i class="fas fa-users-cog" style="margin-right: 8px;"></i>Manajemen Staff
                        </div>
                    @endif
                </div>

                <!-- Tab 1: Dashboard Content -->
                <div id="tab-dashboard" class="tab-content active">
                    <!-- Standard Accordion Content (Retained logic from previous dashboard) -->
                    <div id="dynamicContent"></div>
                </div>

                <!-- Tab 2: User Management -->
                <div id="tab-users" class="tab-content">
                    <div class="table-section">
                        <div
                            style="padding: 1.5rem; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h2 style="font-size: 1.125rem; font-weight: 700; color: var(--gray-900);">Daftar Staff
                                    Unit</h2>
                                <p style="font-size: 0.875rem; color: var(--gray-500); margin-top: 4px;">Kelola hak
                                    akses pembuatan dokumen, reviewer, dan verifikator.</p>
                            </div>
                        </div>
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Nama User</th>
                                    <th>Jabatan</th>
                                    <th>Create Access</th>
                                    <th>Reviewer</th>
                                    <th>Verifier</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($unitUsers as $staff)
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <div
                                                    style="width: 36px; height: 36px; background: var(--primary-50); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                                                    {{ strtoupper(substr($staff->nama_user, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: var(--gray-900);">
                                                        {{ $staff->nama_user }}</div>
                                                    <div style="font-size: 0.75rem; color: var(--gray-500);">
                                                        {{ $staff->email_user ?? $staff->username }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="status-badge user">{{ $staff->role_jabatan_name }}</span>
                                        </td>
                                        <!-- Toggle: Can Create -->
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox"
                                                    onchange="updatePermission({{ $staff->id_user }}, 'can_create_documents', this.checked)"
                                                    {{ $staff->can_create_documents ? 'checked' : '' }}>
                                                <span class="slider"></span>
                                            </label>
                                        </td>
                                        <!-- Toggle: Is Reviewer -->
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox"
                                                    onchange="updatePermission({{ $staff->id_user }}, 'is_reviewer', this.checked)"
                                                    {{ $staff->is_reviewer ? 'checked' : '' }}>
                                                <span class="slider"></span>
                                            </label>
                                        </td>
                                        <!-- Toggle: Is Verifier -->
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox"
                                                    onchange="updatePermission({{ $staff->id_user }}, 'is_verifier', this.checked)"
                                                    {{ $staff->is_verifier ? 'checked' : '' }}>
                                                <span class="slider"></span>
                                            </label>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 3rem; color: var(--gray-500);">
                                            <i class="fas fa-users-slash"
                                                style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                                            Tidak ada staff lain di unit ini.
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

    @php
        // Prepare Data for JS
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

    <script>
        // Data for Accordion
        const departments = @json($departmentsData);
        const units = @json($unitsData);

        // Tab Switching Logic
        function switchTab(tabName) {
            // Hide all
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));

            // Show Target
            document.getElementById('tab-' + tabName).classList.add('active');

            // Highlight Tab
            const buttons = document.querySelectorAll('.nav-link');
            if (tabName === 'dashboard') buttons[0].classList.add('active');
            if (tabName === 'users') buttons[1].classList.add('active');
        }

        // Accordion Render Logic (Same as before but styled)
        document.addEventListener('DOMContentLoaded', () => {
            renderDepartments();
        });

        function renderDepartments() {
            const container = document.getElementById('dynamicContent');
            if (departments.length === 0) {
                container.innerHTML = `<div style="text-align:center;color:#999;">No data</div>`;
                return;
            }

            let html = '';
            const regularDepts = departments.filter(d => d.id_dept != 0);

            regularDepts.forEach(dept => {
                const deptUnits = units.filter(u => u.id_dept == dept.id_dept);
                html += `
                    <div class="accordion-item">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <div style="display:flex; align-items:center;">
                                <div class="dept-icon"><i class="fas fa-building"></i></div>
                                <div style="font-weight:600; color:#333;">${dept.nama_dept}</div>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                        <div class="accordion-body" style="display:none; padding:0;">
                            <ul class="unit-list">
                `;

                if (deptUnits.length === 0) {
                    html += `<li class="unit-item" style="color:#999;">Tidak ada unit</li>`;
                } else {
                    deptUnits.forEach(unit => {
                        html += `
                            <li class="unit-item" onclick="viewUnitDocs(${unit.id_unit})">
                                <span>${unit.nama_unit}</span>
                                <i class="fas fa-arrow-right text-gray-300"></i>
                            </li>
                        `;
                    });
                }
                html += `</ul></div></div>`;
            });
            container.innerHTML = html;
        }

        function toggleAccordion(header) {
            const body = header.nextElementSibling;
            const isOpen = body.style.display === 'block';
            body.style.display = isOpen ? 'none' : 'block';
            header.classList.toggle('active', !isOpen);
        }

        // Permission Update Logic
        function updatePermission(userId, field, value) {
            fetch("{{ route('unit_pengelola.update_permissions') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    user_id: userId,
                    [field]: value
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({ icon: 'success', title: 'Akses diperbarui' });
                    } else {
                        Swal.fire("Gagal", data.message, "error");
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire("Error", "Gagal menghubungi server", "error");
                });
        }

        // Placeholder for view unit docs
        function viewUnitDocs(unitId) {
            // In real logic, this might filter the table or charts below
            console.log("Viewing unit:", unitId);
            // Could trigger an AJAX call to load docs for that unit
        }
    </script>

    <!-- Close Modal Logic -->
    <script>
        function closeModal() {
            document.getElementById('detailModal').style.display = "none";
        }
    </script>
</body>

</html>