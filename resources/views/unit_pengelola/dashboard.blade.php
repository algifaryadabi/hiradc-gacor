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

            /* Semantic Colors */
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
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            --shadow-colored: 0 10px 25px -5px rgba(196, 30, 58, 0.15);
            --shadow-xs: 0 1px 2px 0 rgba(0, 0, 0, 0.05);

            /* Spacing */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;

            /* Radius */
            --radius-md: 0.375rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-full: 9999px;
            
            /* Legacy Compat */
             --sidebar-bg: #5b6fd8; 
        }

        /* Base Styles */
        * { margin: 0; padding: 0; box-sizing: border-box; outline: none; }
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

        .container { display: flex; min-height: 100vh; }

        /* Sidebar - Reference Design */
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
        
        .logo-section { padding: var(--space-8) var(--space-6); border-bottom: 1px solid rgba(255, 255, 255, 0.15); text-align: center; position: relative; }
        .logo-section::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.3) 50%, transparent 100%); }
        .logo-circle { width: 90px; height: 90px; margin: 0 auto var(--space-5); background: transparent; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s; }
        .logo-circle:hover { transform: scale(1.05); }
        .logo-circle img { max-width: 100%; max-height: 100%; object-fit: contain; filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.15)); }
        .logo-text { font-size: 1.125rem; font-weight: 700; color: white; margin-bottom: var(--space-1); text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15); }
        .logo-subtext { font-size: 0.75rem; color: rgba(255, 255, 255, 0.9); font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; }
        
        .nav-menu { flex: 1; padding: var(--space-6) 0; overflow-y: auto; scrollbar-width: thin; scrollbar-color: var(--gray-300) transparent; }
        
        .nav-item { padding: var(--space-4) var(--space-6); margin: var(--space-1) var(--space-4); display: flex; align-items: center; gap: var(--space-3); color: rgba(255,255,255,0.85); font-weight: 500; text-decoration: none; border-radius: var(--radius-lg); transition: all 0.2s; font-size: 0.9375rem; position: relative; }
        .nav-item:hover { background: rgba(255,255,255,0.15); color: white; transform: translateX(4px); }
        .nav-item.active { background: rgba(255,255,255,0.25); color: white; font-weight: 600; box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
        .nav-item.active::before { content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 4px; height: 60%; background: white; border-radius: 0 4px 4px 0; }
        .nav-item i { width: 24px; text-align: center; font-size: 1.125rem; }
        
        .badge { background: #ef4444; color: white; font-size: 0.65rem; padding: 2px 8px; border-radius: 99px; font-weight: 700; margin-left: auto; }

        .user-info-bottom { padding: var(--space-6); border-top: 1px solid rgba(255,255,255,0.15); background: transparent; }
        .user-profile { display: flex; align-items: center; gap: var(--space-3); margin-bottom: var(--space-4); }
        .user-avatar { width: 48px; height: 48px; background: var(--surface); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #667eea; font-weight: 700; font-size: 1.125rem; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border: 2px solid rgba(255,255,255,0.2); flex-shrink: 0; }
        .user-details { flex: 1; min-width: 0; }
        .user-name { font-weight: 600; font-size: 0.9375rem; color: white; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 2px; }
        .user-role { font-size: 0.75rem; color: rgba(255,255,255,0.85); }
        .logout-btn { width: 100%; padding: var(--space-3); background: rgba(255,255,255,0.15); color: white; border: 1px solid rgba(255,255,255,0.25); border-radius: var(--radius-lg); font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none; backdrop-filter: blur(10px); }
        .logout-btn:hover { background: rgba(255,255,255,0.25); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.2); }

        /* Main Content */
        .main-content { flex: 1; margin-left: 280px; padding: 0; background: var(--bg-body); }
        .header { background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%); padding: var(--space-8) var(--space-10); border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; box-shadow: var(--shadow-sm); position: sticky; top: 0; z-index: 50; backdrop-filter: blur(8px); }
        .header h1 { font-size: 1.875rem; font-weight: 800; color: var(--text-primary); letter-spacing: -0.02em; }
        .header::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent 0%, var(--primary) 50%, transparent 100%); opacity: 0.3; }

        .content-area { padding: var(--space-10); max-width: 1600px; margin: 0 auto; }

        /* Breadcrumb */
        .breadcrumb { display: flex; align-items: center; gap: 10px; margin-bottom: var(--space-6); font-size: 0.875rem; color: var(--text-secondary); }
        .breadcrumb-item { cursor: pointer; transition: color 0.2s; font-weight: 500; }
        .breadcrumb-item:hover { color: var(--primary); }
        .breadcrumb-item.active { font-weight: 600; color: var(--text-primary); cursor: default; }
        .breadcrumb-separator { color: var(--gray-300); font-size: 0.75rem; }

        /* Stats Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: var(--space-6); margin-bottom: var(--space-8); }
        .stat-card { background: var(--surface); padding: var(--space-6); border-radius: var(--radius-xl); box-shadow: var(--shadow-sm); display: flex; align-items: center; gap: var(--space-4); border: 1px solid var(--border); transition: all 0.2s; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: var(--primary-200); }
        .stat-icon { width: 56px; height: 56px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; background: var(--gray-50); color: var(--gray-500); }
        .stat-info h3 { font-size: 0.875rem; color: var(--text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; }
        .stat-info .value { font-size: 1.75rem; font-weight: 800; color: var(--text-primary); line-height: 1; }
        .stat-icon.primary { background: var(--primary-50); color: var(--primary); }
        .stat-icon.warning { background: var(--warning-light); color: var(--warning); }
        .stat-icon.success { background: var(--success-light); color: var(--success); }

        /* Tabs System */
        .nav-tabs { display: flex; gap: 1rem; margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1px; }
        .nav-link { padding: 0.75rem 1.5rem; font-weight: 600; color: var(--gray-500); cursor: pointer; border-bottom: 3px solid transparent; transition: all 0.2s; }
        .nav-link:hover { color: var(--primary); background: rgba(196, 30, 58, 0.05); border-radius: 0.5rem 0.5rem 0 0; }
        .nav-link.active { color: var(--primary); border-bottom-color: var(--primary); }

        .tab-content { display: none; animation: fadeIn 0.4s ease-out; }
        .tab-content.active { display: block; }
        
        .switch { position: relative; display: inline-block; width: 34px; height: 18px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #cbd5e1; transition: .4s; border-radius: 34px; }
        .slider:before { position: absolute; content: ""; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; transition: .4s; border-radius: 50%; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); }
        input:checked+.slider { background-color: var(--primary); }
        input:checked+.slider:before { transform: translateX(16px); }

        /* Status Badge */
        .status-badge { padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
        .status-badge.reviewer { background: #e0f2fe; color: #0284c7; }
        .status-badge.verifier { background: #f0fdf4; color: #16a34a; }
        .status-badge.user { background: #f1f5f9; color: #64748b; }

        /* Accordion Styles - Reference: Approver Dashboard */
        .accordion-container { margin-top: var(--space-6); display: flex; flex-direction: column; gap: var(--space-3); }
        .accordion-item { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-xl); overflow: hidden; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: var(--shadow-xs); }
        .accordion-item:hover { box-shadow: var(--shadow-md); border-color: var(--primary-200); transform: translateY(-2px); }
        .accordion-header { padding: var(--space-5) var(--space-6); cursor: pointer; display: flex; align-items: center; justify-content: space-between; background: var(--surface); transition: background 0.2s; }
        .accordion-header:hover { background: var(--gray-50); }
        .accordion-header.active { background: var(--primary-50); border-bottom: 1px solid var(--primary-100); }
        
        .dept-info { display: flex; align-items: center; gap: var(--space-4); }
        .dept-icon { width: 40px; height: 40px; background: var(--info-light); color: var(--info); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.125rem; }
        .dept-name { font-weight: 700; color: var(--text-primary); font-size: 1rem; }
        .accordion-header.active .dept-icon { background: white; color: var(--primary); }
        .accordion-header.active .dept-name { color: var(--primary-dark); }
        
        .accordion-icon { color: var(--text-tertiary); transition: transform 0.3s; }
        .accordion-header.active .accordion-icon { transform: rotate(180deg); color: var(--primary); }
        
        .accordion-body { display: none; background: var(--gray-50); border-top: 1px solid var(--border); }
        .accordion-body.show { display: block; animation: slideDown 0.3s ease-out; }
        
        .unit-list { list-style: none; padding: 0; margin: 0; }
        .unit-item { padding: var(--space-4) var(--space-6); padding-left: 80px; border-bottom: 1px solid var(--border-light); cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-size: 0.9375rem; color: var(--text-secondary); transition: all 0.2s; font-weight: 500; }
        .unit-item:last-child { border-bottom: none; }
        .unit-item:hover { background: white; color: var(--primary); padding-left: 85px; }
        .unit-item i { opacity: 0; transition: opacity 0.2s; color: var(--primary); }
        .unit-item:hover i { opacity: 1; transform: translateX(4px); }
        
        /* Table Styles */
        .table-section { background: var(--surface); border-radius: var(--radius-xl); box-shadow: var(--shadow-sm); overflow: hidden; border: 1px solid var(--border); margin-top: var(--space-6); animation: fadeIn 0.4s ease-out; }
        .table-header { padding: var(--space-6); display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border); background: linear-gradient(to bottom, var(--surface), var(--gray-50)); }
        .table-header h2 { font-size: 1.125rem; font-weight: 700; color: var(--text-primary); }
        
        .custom-table { width: 100%; border-collapse: collapse; }
        .custom-table thead { background: var(--gray-50); border-bottom: 2px solid var(--border); }
        .custom-table th { padding: var(--space-4) var(--space-6); text-align: left; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.05em; }
        .custom-table td { padding: var(--space-4) var(--space-6); font-size: 0.9375rem; color: var(--text-primary); border-bottom: 1px solid var(--border-light); vertical-align: middle; }
        .custom-table tr:hover { background: var(--surface-hover); }
        
        .status-pill { padding: 4px 12px; border-radius: 99px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; display: inline-flex; align-items: center; }
        .btn-action { padding: 6px 14px; background: var(--primary); color: white; border-radius: 6px; text-decoration: none; font-size: 0.75rem; font-weight: 600; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }

        /* === Card Process / PIC Card (For Staff Management) === */
        .card-process {
            background: var(--surface);
            padding: var(--space-8);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-colored);
            border: 1px solid var(--primary-100);
            margin-bottom: var(--space-8);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }
        .card-process::before {
            content: ''; position: absolute; top:0; left:0; width: 4px; height: 100%; background: var(--primary);
        }
        .process-title {
            font-size: 1.25rem; font-weight: 700; color: var(--text-primary);
        }
        .current-pic-box {
            padding: 1rem;
            background: var(--primary-50);
            border: 1px solid var(--primary-200);
            border-radius: var(--radius-lg);
            color: var(--primary);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .role-ag-control { display: flex; gap: 1rem; align-items: flex-end; }
        .role-select { width: 100%; padding: 10px 16px; border: 1px solid var(--border); border-radius: var(--radius-lg); font-size: 0.9375rem; transition: all 0.2s; }
        .btn-update-role { padding: 10px 24px; background: var(--primary); color: white; border: none; border-radius: var(--radius-lg); font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.5rem; height: 42px; white-space: nowrap; }
        .btn-update-role:hover { background: var(--primary-dark); transform: translateY(-1px); }

        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        @include('partials.sidebar')

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
                    <div class="nav-link active" onclick="switchTab('dashboard', this)">
                        <i class="fas fa-chart-pie" style="margin-right: 8px;"></i>Dashboard Utama
                    </div>
                    @if(Auth::user()->role_jabatan == 3)
                        <div class="nav-link" onclick="switchTab('users', this)">
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
                                    <tr data-user-id="{{ $staff->id_user }}">
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
                                            @if($staff->role_jabatan != 3)
                                                <label class="switch">
                                                    <input type="checkbox"
                                                        class="role-create"
                                                        data-user="{{ $staff->id_user }}"
                                                        onchange="updatePermission({{ $staff->id_user }}, 'can_create_documents', this.checked)"
                                                        {{ $staff->can_create_documents ? 'checked' : '' }}>
                                                    <span class="slider"></span>
                                                </label>
                                            @else
                                                <span class="text-muted" style="font-size:0.75rem;">-</span>
                                            @endif
                                        </td>
                                        <!-- REVIEWER COLUMN (Role 4 Only) -->
                                        <td>
                                            @if($staff->role_jabatan == 4)
                                                @if(auth()->user()->id_unit == 55)
                                                    <!-- Security: Simple Toggle -->
                                                    <label class="switch">
                                                        <input type="checkbox"
                                                            class="role-reviewer"
                                                            data-user="{{ $staff->id_user }}"
                                                            onchange="updatePermission({{ $staff->id_user }}, 'is_reviewer', this.checked)"
                                                            {{ $staff->is_reviewer ? 'checked' : '' }}>
                                                        <span class="slider"></span>
                                                    </label>
                                                @else
                                                    <!-- SHE: Kelola Button -->
                                                    <div style="display: flex; gap: 8px; align-items: center;">
                                                        @if($staff->is_reviewer)
                                                            <span class="status-badge reviewer" style="font-size: 0.7rem;">
                                                                {{ !empty($staff->assigned_categories) ? implode(', ', $staff->assigned_categories) : '-' }}
                                                            </span>
                                                        @endif
                                                        <button class="btn-action" style="background: white; color: var(--gray-700); border: 1px solid var(--border); padding: 4px 8px; font-size: 0.75rem;"
                                                            onclick='openReviewerModal({{ $staff->id_user }})'>
                                                            <i class="fas fa-cog"></i> Kelola
                                                        </button>
                                                    </div>
                                                @endif
                                            @else
                                                <span style="font-size:0.75rem; color:#9ca3af; font-style:italic;">N/A</span>
                                            @endif
                                        </td>

                                        <!-- VERIFIER COLUMN (Role 5 & 6) -->
                                        <td>
                                            @if(in_array($staff->role_jabatan, [5, 6]) || $staff->is_verifier)
                                                @if(auth()->user()->id_unit == 55)
                                                    <!-- Security: Simple Toggle -->
                                                    <label class="switch">
                                                        <input type="checkbox"
                                                            class="role-verifier"
                                                            data-user="{{ $staff->id_user }}"
                                                            onchange="updatePermission({{ $staff->id_user }}, 'is_verifier', this.checked)"
                                                            {{ $staff->is_verifier ? 'checked' : '' }}>
                                                        <span class="slider"></span>
                                                    </label>
                                                @else
                                                    <!-- SHE: Kelola Button -->
                                                    <div style="display: flex; gap: 8px; align-items: center;">
                                                        @if($staff->is_verifier)
                                                            <span class="status-badge verifier" style="font-size: 0.7rem;">
                                                                {{ !empty($staff->assigned_categories) ? implode(', ', $staff->assigned_categories) : '-' }}
                                                            </span>
                                                        @endif
                                                        <button class="btn-action" style="background: white; color: var(--gray-700); border: 1px solid var(--border); padding: 4px 8px; font-size: 0.75rem;"
                                                            onclick='openVerifierModal({{ $staff->id_user }})'>
                                                            <i class="fas fa-cog"></i> Kelola
                                                        </button>
                                                    </div>
                                                @endif
                                            @else
                                                <span style="font-size:0.75rem; color:#9ca3af; font-style:italic;">N/A</span>
                                            @endif
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

    <!-- Detail Document Modal -->
    <div id="detailModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); backdrop-filter: blur(4px);">
        <div class="modal-content" style="background-color: #fefefe; margin: 3% auto; padding: 0; border: 1px solid #888; width: 70%; max-width: 900px; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
            <div class="modal-header" style="padding: 20px 30px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; background: linear-gradient(135deg, #c41e3a 0%, #9a1829 100%); border-top-left-radius: 16px; border-top-right-radius: 16px;">
                <h2 style="font-size: 1.25rem; font-weight: 700; color: white; margin:0;">
                    <i class="fas fa-file-alt" style="margin-right: 10px;"></i>Detail Dokumen
                </h2>
                <span class="close" onclick="closeModal()" style="color: white; font-size: 28px; font-weight: bold; cursor: pointer; transition: opacity 0.2s; opacity: 0.8;">&times;</span>
            </div>
            <div class="modal-body" style="padding: 30px; max-height: 70vh; overflow-y: auto;">
                <!-- Document Title -->
                <div style="margin-bottom: 24px; padding-bottom: 20px; border-bottom: 2px solid #e2e8f0;">
                    <h3 id="m_title" style="font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-bottom: 12px; line-height: 1.4;"></h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                        <span id="m_status" style="background: #dcfce7; color: #166534; padding: 6px 14px; border-radius: 99px; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.05em;"></span>
                        <span id="m_category" style="background: #dbeafe; color: #1e40af; padding: 6px 14px; border-radius: 99px; font-size: 0.75rem; font-weight: 700;"></span>
                        <span id="m_risk" style="background: #fef3c7; color: #92400e; padding: 6px 14px; border-radius: 99px; font-size: 0.75rem; font-weight: 700;"></span>
                    </div>
                </div>

                <!-- Document Info Grid -->
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 24px;">
                    <div style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); padding: 18px; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">
                            <i class="fas fa-user-edit" style="margin-right: 6px;"></i>Penulis
                        </label>
                        <div id="m_author" style="font-weight: 600; color: #1e293b; font-size: 0.95rem;"></div>
                    </div>
                    <div style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); padding: 18px; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">
                            <i class="fas fa-calendar-check" style="margin-right: 6px;"></i>Tanggal Publikasi
                        </label>
                        <div id="m_date" style="font-weight: 600; color: #1e293b; font-size: 0.95rem;"></div>
                    </div>
                    <div style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); padding: 18px; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">
                            <i class="fas fa-building" style="margin-right: 6px;"></i>Unit
                        </label>
                        <div id="m_unit" style="font-weight: 600; color: #1e293b; font-size: 0.95rem;"></div>
                    </div>
                    <div style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); padding: 18px; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">
                            <i class="fas fa-user-check" style="margin-right: 6px;"></i>Disetujui Oleh
                        </label>
                        <div id="m_approver" style="font-weight: 600; color: #1e293b; font-size: 0.95rem;"></div>
                    </div>
                </div>

                <!-- Published Programs Section -->
                <div id="m_programs_section" style="margin-top: 24px; padding-top: 20px; border-top: 2px solid #e2e8f0; display: none;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                        <i class="fas fa-clipboard-list" style="color: #c41e3a; font-size: 1.2rem;"></i>
                        <h4 style="font-size: 1rem; font-weight: 700; color: #1e293b; margin: 0;">Program Terpublikasi</h4>
                    </div>
                    <div id="m_programs_list" style="display: grid; gap: 10px;">
                        <!-- Programs will be injected here -->
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 20px 30px; background: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom-left-radius: 16px; border-bottom-right-radius: 16px; display: flex; justify-content: flex-end; gap: 12px;">
                <button onclick="closeModal()" style="padding: 10px 24px; background: white; border: 1px solid #cbd5e1; border-radius: 8px; color: #475569; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                    <i class="fas fa-times" style="margin-right: 6px;"></i>Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        // Data from Controller
        const departments = @json($departmentsData);
        const units = @json($unitsData);
        const documents = @json($publishedData);

        // State
        let currentLevel = 'home';
        let selectedDept = null;
        let selectedUnit = null;

        // Init
        document.addEventListener('DOMContentLoaded', () => {
            renderDepartments();
            
            // Display success message if exists
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end'
                });
            @endif
        });

        // Tab Switching Logic
        function switchTab(tabName, el) {
            // Save tabName to localStorage
            localStorage.setItem('activeUnitPengelolaTab', tabName);

            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.nav-link').forEach(btn => {
                btn.classList.remove('active');
            });

            const contentEl = document.getElementById('tab-' + tabName);
            if (contentEl) {
                contentEl.classList.add('active');
            }

            if (el) {
                el.classList.add('active');
            }
        }

        // Initialize from localStorage or default
        document.addEventListener('DOMContentLoaded', function() {
            const savedTab = localStorage.getItem('activeUnitPengelolaTab');
            if (savedTab && savedTab !== 'dashboard') {
                const tabBtn = document.querySelector(`.nav-link[onclick*="'${savedTab}'"]`);
                if (tabBtn) {
                    tabBtn.click();
                }
            }
        });

        // --- View: Departments (Home) ---
        function renderDepartments() {
            currentLevel = 'home';
            selectedDept = null;
            selectedUnit = null;
            // Note: We don't have separate updateBreadcrumb yet in the view, 
            // but we can add one if we want breadcrumbs to update.
            // For now, let's keep it simple or implement the breadcrumb update.
            
            const container = document.getElementById('dynamicContent');
            if (departments.length === 0) {
                container.innerHTML = `<div class="empty-state"><i class="fas fa-building"></i><p>Tidak ada departemen ditemukan.</p></div>`;
                return;
            }

            let html = '<div class="accordion-container">';
            
            // 1. Regular Departments
            const regularDepts = departments.filter(d => d.id_dept != 0);
            regularDepts.forEach(dept => {
                const deptUnits = units.filter(u => u.id_dept == dept.id_dept);
                html += `
                    <div class="accordion-item">
                        <div class="accordion-header" onclick="toggleDepartment(${dept.id_dept})">
                            <div class="dept-info">
                                <div class="dept-icon"><i class="fas fa-building"></i></div>
                                <div class="dept-name">${dept.nama_dept}</div>
                            </div>
                            <div class="accordion-icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="accordion-body" id="dept-${dept.id_dept}" style="display:none;">
                            <ul class="unit-list">`;
                
                if (deptUnits.length > 0) {
                    deptUnits.forEach(unit => {
                        // Pass dept.id_dept to viewUnitDocs
                        html += `
                            <li class="unit-item" onclick="viewUnitDocs(${unit.id_unit}, '${unit.nama_unit.replace(/'/g, "\\'")}', ${dept.id_dept})">
                                <span>${unit.nama_unit}</span>
                                <i class="fas fa-arrow-right"></i>
                            </li>`;
                    });
                } else {
                     html += `<li class="unit-item" style="color:#999; cursor:default">Tidak ada unit</li>`;
                }
                html += `</ul></div></div>`;
            });

             // 2. Unassigned Units
             const unassignedDept = departments.find(d => d.id_dept == 0);
             if(unassignedDept) {
                  const directUnits = units.filter(u => u.id_dept == 0 && u.id_unit != 0);
                  if(directUnits.length > 0) {
                       directUnits.forEach(unit => {
                           // Use 0 as deptId
                           html += `
                            <div class="accordion-item" onclick="viewUnitDocs(${unit.id_unit}, '${unit.nama_unit.replace(/'/g, "\\'")}', 0)" style="cursor:pointer;">
                                <div class="accordion-header">
                                    <div class="dept-info">
                                        <div class="dept-icon" style="background:#fce4ec; color:#c2185b;"><i class="fas fa-layer-group"></i></div>
                                        <div class="dept-name">${unit.nama_unit}</div>
                                    </div>
                                    <div class="accordion-icon"><i class="fas fa-arrow-right"></i></div>
                                </div>
                            </div>`;
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
            if(!isShown) {
                document.querySelectorAll('.accordion-body').forEach(el => { el.classList.remove('show'); el.style.display = 'none'; });
                document.querySelectorAll('.accordion-header').forEach(el => el.classList.remove('active'));
                body.classList.add('show'); body.style.display = 'block'; header.classList.add('active');
            } else {
                body.classList.remove('show'); body.style.display = 'none'; header.classList.remove('active');
            }
        }

        // --- View: Unit Docs (Unified Table) ---
        function viewUnitDocs(unitId, unitName, deptId) {
            // Set State
            const d = departments.find(x => x.id_dept == deptId);
            selectedDept = d ? {id: d.id_dept, name: d.nama_dept} : null;
            selectedUnit = {id: unitId, name: unitName};
            currentLevel = 'docs';

            renderUnitDocs(unitId, unitName, deptId, 'ALL');
        }

        function renderUnitDocs(id, name, deptId, filterCategory = 'ALL') {
            const container = document.getElementById('dynamicContent');
            const rawDocs = documents.filter(doc => doc.unit_id == id);

            // SPLIT Categories Logic (Unified)
            let unitDocs = [];
            if (Array.isArray(rawDocs)) {
                rawDocs.forEach(doc => {
                    if (doc.category && doc.category.includes(',')) {
                        const cats = doc.category.split(',').map(c => c.trim());
                        cats.forEach(c => { unitDocs.push({ ...doc, category: c }); });
                    } else {
                        unitDocs.push(doc);
                    }
                });
            }

            // Map display labels to backend categories
            const categoryMap = {
                'K3/KO/Lingkungan': 'SHE',
                'Keamanan': 'Security'
            };

            // FILTER - map display label to backend category
            if (filterCategory !== 'ALL') {
                const backendCategory = categoryMap[filterCategory] || filterCategory;
                unitDocs = unitDocs.filter(doc => doc.category === backendCategory);
            }

            // User-friendly category labels for dropdown
            const categories = ['K3/KO/Lingkungan', 'Keamanan'];

            let html = `
                <!-- Breadcrumb (Optional if you want it exactly like User Dashboard, but we can stick to Title/Header) -->
                <!-- Note: The User Dashboard has a separate breadcrumb div outside dynamicContent. 
                     Here in Unit Manager, we might not have it or it's static. 
                     We'll add a simple breadcrumb-like header inside: -->
                <div style="margin-bottom: 2rem; display:flex; gap: 8px; align-items: center; font-size: 0.875rem; color: var(--text-secondary);">
                    <span style="cursor: pointer;" onclick="renderDepartments()">Home</span>
                    <i class="fas fa-chevron-right" style="font-size: 0.75rem; color: var(--gray-300);"></i>
                    ${selectedDept ? `<span style="color:var(--text-secondary);">${selectedDept.name}</span> <i class="fas fa-chevron-right" style="font-size: 0.75rem; color: var(--gray-300);"></i>` : ''}
                    <span style="font-weight: 700; color: var(--text-primary);">${name}</span>
                </div>

                 <div class="table-section">
                     <div class="table-header" style="flex-wrap: wrap; gap: 10px;">
                         <div>
                             <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary); margin-bottom: 4px;">Dokumen Terpublikasi - ${name}</h2>
                             <div style="font-size: 0.875rem; color: var(--text-secondary);">Menampilkan kategori: <b>${filterCategory}</b></div>
                         </div>
                         <div style="display:flex; gap:10px; align-items:center;">
                             <select onchange="renderUnitDocs(${id}, '${name.replace(/'/g, "\\'")}', ${deptId}, this.value)" style="padding: 8px 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 0.875rem; color: var(--text-primary); cursor: pointer;">
                                 <option value="ALL" ${filterCategory === 'ALL' ? 'selected' : ''}>Semua Kategori</option>
                                 ${categories.map(c => `<option value="${c}" ${filterCategory === c ? 'selected' : ''}>${c}</option>`).join('')}
                             </select>
                             <button class="btn-action" style="background: var(--text-secondary);" onclick="renderDepartments()">
                                <i class="fas fa-arrow-left"></i> Kembali
                             </button>
                         </div>
                     </div>
             `;

            if (unitDocs.length === 0) {
                html += `
                     <div style="text-align: center; padding: 4rem; color: var(--text-tertiary);">
                         <i class="fas fa-filter" style="font-size: 3rem; margin-bottom: 1rem; color: var(--gray-200);"></i>
                         <p>Tidak ada dokumen terpublikasi untuk kategori <b>${filterCategory}</b>.</p>
                     </div></div>`;
            } else {
                 html += `
                     <div style="overflow-x: auto;">
                     <table class="custom-table">
                         <thead>
                             <tr>
                                 <th>Judul Form</th>
                                 <th>Kategori</th>
                                 <th>Penulis</th>
                                 <th>Tanggal Publish</th>
                                 <th>Status</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                 `;

                unitDocs.forEach(doc => {
                    // Color coding for simplified categories
                    let catColor = '#f1f5f9';
                    let catText = '#64748b';
                    
                    // Get category display
                    const categories = doc.doc_categories || '-';
                    
                    // Color based on category type
                    if (categories.includes('K3') || categories.includes('KO') || categories.includes('Lingkungan')) {
                        catColor = '#dcfce7'; 
                        catText = '#166534';
                    } else if (categories.includes('Keamanan')) {
                        catColor = '#e0f2fe'; 
                        catText = '#075985';
                    }

                    html += `
                         <tr>
                             <td><div style="font-weight: 600; color: var(--text-primary);">${doc.title}</div></td>
                             <td><span class="status-pill" style="background:${catColor}; color:${catText};">${categories}</span></td>
                             <td><div style="font-size: 0.875rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase;">${doc.author}</div></td>
                             <td><div style="font-size: 0.875rem; color: var(--text-secondary);">${doc.date}</div></td>
                             <td><span class="status-pill" style="background: #ecfdf5; color: #059669;">DISETUJUI</span></td>
                             <td>
                                    <div style="display:flex; gap:6px;">
                                     <button class="btn-action" style="background: #be123c;" onclick="openDetail(${doc.id})">
                                         <i class="fas fa-eye"></i>
                                     </button>
                                     <a href="{{ url('/documents') }}/${doc.id}/published?filter=${doc.category}" class="btn-action" style="background: #2563eb;">
                                         <i class="fas fa-external-link-alt"></i>
                                     </a>
                                 </div>
                             </td>
                         </tr>
                     `;
                });
                html += `</tbody></table></div></div>`;
            }
            container.innerHTML = html;
        }

        // Modal Logic
        function openDetail(id) {
            const doc = documents.find(d => d.id == id);
            if (doc) {
                 // Basic Info
                 document.getElementById('m_title').innerText = doc.title;
                 document.getElementById('m_status').innerText = "DISETUJUI";
                 document.getElementById('m_unit').innerText = doc.unit || '-';
                 document.getElementById('m_author').innerText = doc.author;
                 document.getElementById('m_date').innerText = doc.date;
                 document.getElementById('m_approver').innerText = doc.approver || '-';
                 
                 // Category Badge
                 const categoryBadge = document.getElementById('m_category');
                 categoryBadge.innerText = doc.doc_categories || '-';
                 
                 // Risk Level Badge
                 const riskBadge = document.getElementById('m_risk');
                 const riskLevel = doc.risk_level || 'Normal';
                 riskBadge.innerText = `Risiko: ${riskLevel}`;
                 
                 // Color code risk level
                 if (riskLevel === 'High' || riskLevel === 'Tinggi') {
                     riskBadge.style.background = '#fee2e2';
                     riskBadge.style.color = '#991b1b';
                 } else if (riskLevel === 'Medium' || riskLevel === 'Sedang') {
                     riskBadge.style.background = '#fef3c7';
                     riskBadge.style.color = '#92400e';
                 } else {
                     riskBadge.style.background = '#d1fae5';
                     riskBadge.style.color = '#065f46';
                 }
                 
                 // Fetch and display published programs
                 fetchPublishedPrograms(doc.id);
                 
                 document.getElementById('detailModal').style.display = 'block';
            }
        }

        // Fetch published programs for a document
        function fetchPublishedPrograms(docId) {
            fetch(`{{ url('/api/documents') }}/${docId}/programs`)
                .then(response => response.json())
                .then(data => {
                    const programsSection = document.getElementById('m_programs_section');
                    const programsList = document.getElementById('m_programs_list');
                    
                    if (data.programs && data.programs.length > 0) {
                        programsList.innerHTML = data.programs.map(prog => {
                            const typeColor = prog.type === 'PUK' ? '#dbeafe' : '#fce7f3';
                            const typeTextColor = prog.type === 'PUK' ? '#1e40af' : '#9f1239';
                            const iconClass = prog.type === 'PUK' ? 'fa-shield-alt' : 'fa-clipboard-check';
                            
                            return `
                                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; display: flex; justify-content: space-between; align-items: center;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <i class="fas ${iconClass}" style="font-size: 1.2rem; color: #c41e3a;"></i>
                                        <div>
                                            <div style="font-weight: 600; color: #1e293b; font-size: 0.9rem; margin-bottom: 4px;">${prog.name || prog.kegiatan}</div>
                                            <div style="font-size: 0.75rem; color: #64748b;">PIC: ${prog.pic || '-'}</div>
                                        </div>
                                    </div>
                                    <span style="background: ${typeColor}; color: ${typeTextColor}; padding: 4px 10px; border-radius: 6px; font-size: 0.7rem; font-weight: 700;">${prog.type}</span>
                                </div>
                            `;
                        }).join('');
                        programsSection.style.display = 'block';
                    } else {
                        programsSection.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error fetching programs:', error);
                    document.getElementById('m_programs_section').style.display = 'none';
                });
        }

        function closeModal() {
            document.getElementById('detailModal').style.display = "none";
        }
        
        window.onclick = function(event) {
             const modal = document.getElementById('detailModal');
             if (event.target == modal) {
                 closeModal();
             }
        }

        // Global constant for Unit ID to ensure robust logic
        const CURRENT_UNIT_ID = {{ auth()->user()->id_unit }};

        // Permission Update Logic with Mutual Exclusion
        function updatePermission(userId, field, value) {
            const checkbox = event.target;
            
            // Define map first to avoid ReferenceError
            const roleMap = {
                'can_create_documents': { class: 'role-create', name: 'Creator' },
                'is_reviewer': { class: 'role-reviewer', name: 'Reviewer' },
                'is_verifier': { class: 'role-verifier', name: 'Verifikator' }
            };
            
            // SECURITY UNIT LOGIC (Frontend Radio Behavior)
            // Use loose check for safety (55 vs "55")
            const isSecurityUnit = (CURRENT_UNIT_ID == 55);
            
            // Only apply Auto-Switch Off (Radio behavior) if it's Security
            if (isSecurityUnit && value === true && (field === 'is_reviewer' || field === 'is_verifier')) {
                const currentRoleData = roleMap[field];
                if (currentRoleData) {
                     document.querySelectorAll('.' + currentRoleData.class).forEach(input => {
                         // Uncheck all OTHER checkboxes of the same role
                         if (input !== checkbox && input.checked) {
                             input.checked = false; // Visual Off only
                         }
                     });
                }
            }
            
            // If enabling a role, check for mutual exclusion (same user can't have multiple roles)
            if (value === true && (field === 'is_reviewer' || field === 'is_verifier' || field === 'can_create_documents')) {
                const userRow = document.querySelector(`tr[data-user-id="${userId}"]`);
                if (!userRow) {
                    console.error('User row not found for userId:', userId);
                    return;
                }
                
                const currentRole = roleMap[field];
                const otherRoles = Object.keys(roleMap).filter(r => r !== field);
                
                // Check if user already has another role
                let hasOtherRole = false;
                let otherRoleName = '';
                
                otherRoles.forEach(role => {
                    const otherCheckbox = userRow.querySelector(`.${roleMap[role].class}`);
                    if (otherCheckbox && otherCheckbox.checked) {
                        hasOtherRole = true;
                        otherRoleName = roleMap[role].name;
                    }
                });
                
                // If user has another role, ask for confirmation
                if (hasOtherRole) {
                    Swal.fire({
                        title: 'Konfirmasi Perubahan Role',
                        html: `User ini sudah memiliki role <b>${otherRoleName}</b>.<br><br>Apakah Anda ingin mengubahnya menjadi <b>${currentRole.name}</b>?<br><br><small style="color:#666;">Satu user hanya boleh memiliki satu role.</small>`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#c41e3a',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Ubah Role',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Uncheck other roles for this user
                            otherRoles.forEach(role => {
                                const otherCheckbox = userRow.querySelector(`.${roleMap[role].class}`);
                                if (otherCheckbox && otherCheckbox.checked) {
                                    otherCheckbox.checked = false;
                                    // Send update to backend to disable other role
                                    sendPermissionUpdate(userId, role, false);
                                }
                            });
                            
                            // Proceed with enabling the new role
                            sendPermissionUpdate(userId, field, value);
                            updateRoleAvailability(userId);
                        } else {
                            // User cancelled, revert the checkbox
                            checkbox.checked = false;
                        }
                    });
                    return; // Stop here, wait for confirmation
                }
                
                // Ensure only one person can have this role (existing logic)
                // (Logic removed) - "Existing logic" block was enforcing single-user for EVERYONE, breaking SHE (3 users).
                // We rely on the "Security Unit Logic" block above for Security (Single Active).
                // For SHE, we rely on Backend validation (Max 3).
            }
            
            // Send update to backend
            sendPermissionUpdate(userId, field, value);
            
            // Update visual state
            if (field === 'is_reviewer' || field === 'is_verifier' || field === 'can_create_documents') {
                updateRoleAvailability(userId);
            }
        }
        
        // Helper function to send permission update to backend
        function sendPermissionUpdate(userId, field, value) {
            fetch("{{ route('unit_pengelola.update_permissions') }}", {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify({ user_id: userId, [field]: value })
            })
            .then(async res => {
                 if (!res.ok) throw new Error((await res.text()).substring(0,100));
                 return res.json();
            })
            .then(data => {
                if(data.success) {
                    // For Security, reload to ensure state is perfectly synced (Database is source of truth)
                    if (CURRENT_UNIT_ID == 55) {
                         // Force reload immediately
                         window.location.reload();
                    } else {
                         Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 }).fire({ icon: 'success', title: 'Akses diperbarui' });
                    }
                } else { 
                    Swal.fire("Gagal", data.message, "error"); 
                    // Revert checkbox if failed
                    // Note: 'checkbox' is not defined in this scope, so we can't revert easily without passing it.
                    // For now, just show error. User will see the toggle is wrong on reload or can click again.
                }
            })
            .catch(err => Swal.fire("Error", "Gagal: " + err.message, "error"));
        }
        
        // Helper function to update role availability (disable/enable checkboxes)
        function updateRoleAvailability(userId) {
            const userRow = document.querySelector(`tr[data-user-id="${userId}"]`);
            if (!userRow) return;
            
            const checkboxes = {
                create: userRow.querySelector('.role-create'),
                reviewer: userRow.querySelector('.role-reviewer'),
                verifier: userRow.querySelector('.role-verifier')
            };
            
            // Find which role is active
            let activeRole = null;
            Object.entries(checkboxes).forEach(([role, checkbox]) => {
                if (checkbox && checkbox.checked) {
                    activeRole = role;
                }
            });
            
            // If a role is active, disable other checkboxes
            if (activeRole) {
                Object.entries(checkboxes).forEach(([role, checkbox]) => {
                    if (checkbox && role !== activeRole) {
                        const label = checkbox.closest('label');
                        if (label) {
                            label.style.opacity = '0.4';
                            label.style.cursor = 'not-allowed';
                            label.title = 'User sudah memiliki role lain';
                        }
                        checkbox.disabled = true;
                    }
                });
            } else {
                // No role active, enable all checkboxes
                Object.entries(checkboxes).forEach(([role, checkbox]) => {
                    if (checkbox) {
                        const label = checkbox.closest('label');
                        if (label) {
                            label.style.opacity = '1';
                            label.style.cursor = 'pointer';
                            label.title = '';
                        }
                        checkbox.disabled = false;
                    }
                });
            }
        }
        
        // Initialize role availability on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('tr[data-user-id]').forEach(row => {
                const userId = row.getAttribute('data-user-id');
                updateRoleAvailability(userId);
            });
        });
    </script>
    <!-- Reviewer Management Modal -->
    <div id="reviewerModal" class="modal" style="display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
        <div class="modal-content" style="background-color: #fefefe; margin: 10% auto; padding: 0; border: 1px solid #888; width: 450px; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
            <div class="modal-header" style="padding: 15px 25px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin:0; font-size: 1.125rem; font-weight: 700;">Kelola Staff Reviewer</h3>
                <span onclick="document.getElementById('reviewerModal').style.display='none'" style="cursor:pointer; font-size: 1.5rem;">&times;</span>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <form id="reviewerForm">
                    <input type="hidden" id="rev_user_id" name="user_id">
                    
                    <div style="margin-bottom: 20px;">
                        <h4 id="rev_user_name" style="margin-top:0; color:var(--primary);">Nama User</h4>
                        <p style="font-size:0.875rem; color:var(--gray-500);">Pilih wilayah kerja untuk staff reviewer ini.</p>
                    </div>

                    <!-- Category Radio Buttons -->
                    <!-- Category Radio Buttons -->
                    <div style="margin-bottom: 20px;">
                        <label style="display:block; font-weight: 600; margin-bottom: 10px;">Pilih Kategori (Wajib Satu)</label>
                        <div style="display:flex; flex-direction:column; gap: 10px;" id="rev_radios">
                            <!-- Radios injected by JS -->
                        </div>
                    </div>
                    
                    <!-- Option to Revoke -->
                     <div style="margin-bottom: 20px; border-top: 1px dashed var(--border); padding-top: 15px;">
                        <label style="display:flex; align-items:center; gap:10px; cursor:pointer; color: #ef4444;">
                            <input type="radio" name="reviewer_category" value="NONE">
                            <span>Non-aktifkan sebagai Reviewer</span>
                        </label>
                    </div>

                    <div style="text-align: right; display:flex; justify-content: flex-end; gap: 10px;">
                        <button type="button" onclick="document.getElementById('reviewerModal').style.display='none'" class="btn-action" style="background: white; color: var(--gray-600); border: 1px solid var(--border);">Batal</button>
                        <button type="button" onclick="saveReviewer()" class="btn-action" style="background: var(--primary); color: white; border:none; padding: 10px 20px;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Verifier Management Modal -->
    <div id="verifierModal" class="modal" style="display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
        <div class="modal-content" style="background-color: #fefefe; margin: 10% auto; padding: 0; border: 1px solid #888; width: 450px; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
            <div class="modal-header" style="padding: 15px 25px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin:0; font-size: 1.125rem; font-weight: 700;">Kelola Staff Verifikator</h3>
                <span onclick="document.getElementById('verifierModal').style.display='none'" style="cursor:pointer; font-size: 1.5rem;">&times;</span>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <form id="verifierForm">
                    <input type="hidden" id="ver_user_id" name="user_id">
                    <div style="margin-bottom: 20px;">
                        <h4 id="ver_user_name" style="margin-top:0; color:var(--primary);">Nama User</h4>
                        <p style="font-size:0.875rem; color:var(--gray-500);">Pilih wilayah kerja untuk staff verifikator ini.</p>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display:block; font-weight: 600; margin-bottom: 10px;">Pilih Kategori (Wajib Satu)</label>
                        <div style="display:flex; flex-direction:column; gap: 10px;" id="ver_radios">
                            <!-- Radios injected by JS -->
                        </div>
                    </div>
                    <div style="margin-bottom: 20px; border-top: 1px dashed var(--border); padding-top: 15px;">
                        <label style="display:flex; align-items:center; gap:10px; cursor:pointer; color: #ef4444;">
                            <input type="radio" name="verifier_category" value="NONE">
                            <span>Non-aktifkan sebagai Verifikator</span>
                        </label>
                    </div>
                    <div style="text-align: right; display:flex; justify-content: flex-end; gap: 10px;">
                        <button type="button" onclick="document.getElementById('verifierModal').style.display='none'" class="btn-action" style="background: white; color: var(--gray-600); border: 1px solid var(--border);">Batal</button>
                        <button type="button" onclick="saveVerifier()" class="btn-action" style="background: var(--primary); color: white; border:none; padding: 10px 20px;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Data from Backend for Validation
        const unitStaffData = @json($unitUsers);

        // Helper: Get categories taken by other users for a specific role
        function getTakenCategories(role, currentUserId) {
            const taken = [];
            unitStaffData.forEach(user => {
                if (user.id_user == currentUserId) return; // Skip self

                // Check Reviewer
                if (role === 'reviewer' && user.is_reviewer == 1 && user.assigned_categories) {
                    // assigned_categories is JSON or array. If string, parse it.
                    let cats = user.assigned_categories;
                    if (typeof cats === 'string') {
                        try { cats = JSON.parse(cats); } catch(e) { cats = []; }
                    }
                    if (Array.isArray(cats)) {
                        cats.forEach(c => taken.push(c));
                    }
                }
                // Check Verifier
                if (role === 'verifier' && user.is_verifier == 1 && user.assigned_categories) {
                    let cats = user.assigned_categories;
                    if (typeof cats === 'string') {
                        try { cats = JSON.parse(cats); } catch(e) { cats = []; }
                    }
                    if (Array.isArray(cats)) {
                        cats.forEach(c => taken.push(c));
                    }
                }
            });
            return taken;
        }

        // UPDATE PERMISSION (For Toggles: Create Access)
        function updatePermission(userId, field, isChecked) {
            const payload = {
                user_id: userId,
                [field]: isChecked ? 1 : 0
            };

            fetch("{{ route('unit_pengelola.update_permissions') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    const Toast = Swal.mixin({
                        toast: true, position: 'top-end', showConfirmButton: false, timer: 2000, timerProgressBar: true
                    });
                    Toast.fire({ icon: 'success', title: 'Akses diperbarui' }).then(() => location.reload());
                } else {
                    Swal.fire('Gagal', data.message || 'Terjadi kesalahan.', 'error').then(() => location.reload());
                }
            })
            .catch(error => {
                console.error(error);
                Swal.fire('Error', 'Terjadi kesalahan jaringan.', 'error').then(() => location.reload());
            });
        }

        // --- SHARED SUBMIT ---
        function submitRoleUpdate(idField, radioName, roleField) {
            const userId = document.getElementById(idField).value;
            const selected = document.querySelector(`input[name="${radioName}"]:checked`);

            if (!selected) {
                 Swal.fire('Error', 'Harap pilih salah satu opsi (Kategori atau Non-aktif).', 'error');
                 return;
            }

            // Client-side Validation for Taken Category (Double Check)
            const val = selected.value;
            if (val !== 'NONE') {
                const roleType = (roleField === 'is_reviewer') ? 'reviewer' : 'verifier';
                const taken = getTakenCategories(roleType, userId);
                if (taken.includes(val)) {
                     Swal.fire('Peringatan', `Kategori ${val} sudah diambil oleh staff lain.`, 'warning');
                     return; 
                }
            }

            // Close Modals Immediately
            document.getElementById('reviewerModal').style.display = 'none';
            document.getElementById('verifierModal').style.display = 'none';

            const isActive = val === 'NONE' ? 0 : 1;
            const categories = val === 'NONE' ? [] : [val];

            const payload = {
                user_id: userId,
                [roleField]: isActive,
                assigned_categories: categories
            };

            fetch("{{ route('unit_pengelola.update_permissions') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    Swal.fire('Berhasil', 'Akses berhasil diperbarui.', 'success').then(() => location.reload());
                } else {
                    Swal.fire('Gagal', data.message || 'Terjadi kesalahan.', 'error');
                }
            })
            .catch(error => {
                console.error(error);
                Swal.fire('Error', 'Terjadi kesalahan jaringan.', 'error');
            });
        }

        // --- REVIEWER FUNCTIONS ---
        function openReviewerModal(userId) {
            // Find staff from global data
            const staff = unitStaffData.find(u => u.id_user == userId);
            if (!staff) return;

            document.getElementById('rev_user_id').value = staff.id_user;
            document.getElementById('rev_user_name').innerText = staff.nama_user;
            
            const takenCats = getTakenCategories('reviewer', staff.id_user);
            // Parse categories if string
            let userCats = staff.assigned_categories;
             if (typeof userCats === 'string') {
                try { userCats = JSON.parse(userCats); } catch(e) { userCats = []; }
            }
            const userCat = (staff.is_reviewer == 1 && userCats && userCats.length) ? userCats[0] : null;

            const container = document.getElementById('rev_radios');
            container.innerHTML = '';
            
            const categories = ['K3', 'KO', 'Lingkungan'];

            categories.forEach(c => {
                const isTaken = takenCats.includes(c);
                const isChecked = userCat === c;
                
                let disabledAttr = isTaken ? 'disabled' : '';
                let opacity = isTaken ? '0.5' : '1';
                let cursor = isTaken ? 'not-allowed' : 'pointer';
                let note = isTaken ? '<span style="color:red; font-size:0.7em; margin-left:auto;">(Sudah Diambil)</span>' : '';

                const html = `
                    <label style="display:flex; align-items:center; gap:10px; cursor:${cursor}; padding: 8px; border: 1px solid var(--border); border-radius: 6px; opacity: ${opacity};" 
                           ${isTaken ? 'title="Kategori ini sudah diambil staff lain"' : ''}
                           onclick="${isTaken ? "Swal.fire('Info', 'Kategori ini sudah ada staff yang bertugas: " + c + "', 'info');" : ''}"
                    >
                        <input type="radio" name="reviewer_category" value="${c}" ${isChecked ? 'checked' : ''} ${disabledAttr}>
                        <span><b>${c}</b></span>
                        ${note}
                    </label>
                `;
                container.insertAdjacentHTML('beforeend', html);
            });

            if (!userCat) document.querySelector('input[name="reviewer_category"][value="NONE"]').checked = true;

            document.getElementById('reviewerModal').style.display = 'block';
        }

        function saveReviewer() {
            submitRoleUpdate('rev_user_id', 'reviewer_category', 'is_reviewer');
        }

        // --- VERIFIER FUNCTIONS ---
        function openVerifierModal(userId) {
            // Find staff from global data
            const staff = unitStaffData.find(u => u.id_user == userId);
            if (!staff) return;

            document.getElementById('ver_user_id').value = staff.id_user;
            document.getElementById('ver_user_name').innerText = staff.nama_user;
            
            const takenCats = getTakenCategories('verifier', staff.id_user);
             let userCats = staff.assigned_categories;
             if (typeof userCats === 'string') {
                try { userCats = JSON.parse(userCats); } catch(e) { userCats = []; }
            }
            const userCat = (staff.is_verifier == 1 && userCats && userCats.length) ? userCats[0] : null;
            
            const container = document.getElementById('ver_radios');
            container.innerHTML = '';
            
            const categories = ['K3', 'KO', 'Lingkungan'];

            categories.forEach(c => {
                const isTaken = takenCats.includes(c);
                const isChecked = userCat === c;
                
                let disabledAttr = isTaken ? 'disabled' : '';
                let opacity = isTaken ? '0.5' : '1';
                let cursor = isTaken ? 'not-allowed' : 'pointer';
                let note = isTaken ? '<span style="color:red; font-size:0.7em; margin-left:auto;">(Sudah Diambil)</span>' : '';

                const html = `
                    <label style="display:flex; align-items:center; gap:10px; cursor:${cursor}; padding: 8px; border: 1px solid var(--border); border-radius: 6px; opacity: ${opacity};"
                           ${isTaken ? 'title="Kategori ini sudah diambil staff lain"' : ''}
                           onclick="${isTaken ? "Swal.fire('Info', 'Kategori ini sudah ada staff yang bertugas: " + c + "', 'info');" : ''}"
                    >
                        <input type="radio" name="verifier_category" value="${c}" ${isChecked ? 'checked' : ''} ${disabledAttr}>
                        <span><b>${c}</b></span>
                        ${note}
                    </label>
                `;
                container.insertAdjacentHTML('beforeend', html);
            });

            if (!userCat) document.querySelector('input[name="verifier_category"][value="NONE"]').checked = true;

            document.getElementById('verifierModal').style.display = 'block';
        }

        function saveVerifier() {
            submitRoleUpdate('ver_user_id', 'verifier_category', 'is_verifier');
        }
    </script>
</body>

</html>