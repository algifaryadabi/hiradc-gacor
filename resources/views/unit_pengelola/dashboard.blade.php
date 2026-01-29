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
                                        <!-- Toggle: Is Reviewer (Supervisor 5, Associate 6) -->
                                        <td>
                                            @if(in_array($staff->role_jabatan, [5, 6]))
                                                <label class="switch">
                                                    <input type="checkbox"
                                                        class="role-reviewer"
                                                        data-user="{{ $staff->id_user }}"
                                                        onchange="updatePermission({{ $staff->id_user }}, 'is_reviewer', this.checked)"
                                                        {{ $staff->is_reviewer ? 'checked' : '' }}>
                                                    <span class="slider"></span>
                                                </label>
                                            @else
                                                <span style="font-size:0.75rem; color:#9ca3af; font-style:italic;">N/A</span>
                                            @endif
                                        </td>
                                        <!-- Toggle: Is Verifier (Manager 4) -->
                                        <td>
                                            @if($staff->role_jabatan == 4)
                                                <label class="switch">
                                                    <input type="checkbox"
                                                        class="role-verifier"
                                                        data-user="{{ $staff->id_user }}"
                                                        onchange="updatePermission({{ $staff->id_user }}, 'is_verifier', this.checked)"
                                                        {{ $staff->is_verifier ? 'checked' : '' }}>
                                                    <span class="slider"></span>
                                                </label>
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
        <div class="modal-content" style="background-color: #fefefe; margin: 5% auto; padding: 0; border: 1px solid #888; width: 60%; max-width: 800px; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
            <div class="modal-header" style="padding: 20px 30px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; background: #f8fafc; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                <h2 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin:0;">Detail Dokumen</h2>
                <span class="close" onclick="closeModal()" style="color: #64748b; font-size: 28px; font-weight: bold; cursor: pointer; transition: color 0.2s;">&times;</span>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <div style="margin-bottom: 24px;">
                    <h3 id="m_title" style="font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-bottom: 12px; line-height: 1.4;"></h3>
                    <div style="display: flex; gap: 10px;">
                        <span id="m_status" style="background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 99px; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.05em;"></span>
                        <span id="m_unit" style="background: #f1f5f9; color: #475569; padding: 4px 12px; border-radius: 99px; font-size: 0.75rem; font-weight: 600;"></span>
                    </div>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
                    <div style="background: #f8fafc; padding: 16px; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Penulis</label>
                        <div id="m_author" style="font-weight: 600; color: #334155;"></div>
                    </div>
                    <div style="background: #f8fafc; padding: 16px; border-radius: 12px; border: 1px solid #e2e8f0;">
                         <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Tanggal Publikasi</label>
                        <div id="m_date" style="font-weight: 600; color: #334155;"></div>
                    </div>
                    <div style="background: #f8fafc; padding: 16px; border-radius: 12px; border: 1px solid #e2e8f0; grid-column: span 2;">
                         <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Disetujui Oleh</label>
                        <div id="m_approver" style="font-weight: 600; color: #334155;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 20px 30px; background: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom-left-radius: 16px; border-bottom-right-radius: 16px; text-align: right;">
                <button onclick="closeModal()" style="padding: 10px 24px; background: white; border: 1px solid #cbd5e1; border-radius: 8px; color: #475569; font-weight: 600; cursor: pointer; transition: all 0.2s;">Tutup</button>
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
        });

        // Tab Switching Logic
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
            document.getElementById('tab-' + tabName).classList.add('active');
            const buttons = document.querySelectorAll('.nav-link');
            if (tabName === 'dashboard') buttons[0].classList.add('active');
            if (tabName === 'users') buttons[1].classList.add('active');
        }

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

            // FILTER
            if (filterCategory !== 'ALL') {
                unitDocs = unitDocs.filter(doc => doc.category === filterCategory);
            }

            const categories = ['SHE', 'Security'];

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
                                 <th>Unit Pengelola</th>
                                 <th>Penulis</th>
                                 <th>Tanggal Publish</th>
                                 <th>Status</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                 `;

                unitDocs.forEach(doc => {
                    let catColor = '#f1f5f9';
                    let catText = '#64748b';
                    if (doc.category == 'SHE') { catColor = '#dcfce7'; catText = '#166534'; }
                    else if (doc.category == 'Security') { catColor = '#e0f2fe'; catText = '#075985'; }

                    html += `
                         <tr>
                             <td><div style="font-weight: 600; color: var(--text-primary);">${doc.title}</div></td>
                             <td><span class="status-pill" style="background:${catColor}; color:${catText};">${doc.category || '-'}</span></td>
                             <td><div style="font-size: 0.875rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase;">${doc.author}</div></td>
                             <td><div style="font-size: 0.875rem; color: var(--text-secondary);">${doc.date}</div></td>
                             <td><span class="status-pill" style="background: #ecfdf5; color: #059669;">DISETUJUI</span></td>
                             <td>
                                 <div style="display:flex; gap:6px;">
                                     <button class="btn-action" style="background: #be123c;" onclick="openDetail(${doc.id})">
                                         <i class="fas fa-eye"></i> Detail
                                     </button>
                                     <a href="{{ url('/documents') }}/${doc.id}/published?filter=${doc.category}" class="btn-action" style="background: #2563eb;">
                                         <i class="fas fa-external-link-alt"></i> Buka
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
                 document.getElementById('m_title').innerText = doc.title;
                 document.getElementById('m_status').innerText = "DISETUJUI";
                 document.getElementById('m_unit').innerText = selectedUnit ? selectedUnit.name : '-';
                 document.getElementById('m_author').innerText = doc.author;
                 document.getElementById('m_date').innerText = doc.date;
                 document.getElementById('m_approver').innerText = doc.approver || '-'; // Need approver data?
                 document.getElementById('detailModal').style.display = 'block';
            }
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

        // Permission Update Logic
        function updatePermission(userId, field, value) {
             // ... Existing logic ...
             if (value === true && (field === 'is_reviewer' || field === 'is_verifier' || field === 'can_create_documents')) {
                let className = '';
                if (field === 'is_reviewer') className = 'role-reviewer';
                else if (field === 'is_verifier') className = 'role-verifier';
                else if (field === 'can_create_documents') className = 'role-create';
                document.querySelectorAll('.' + className).forEach(input => { if (input.dataset.user != userId) input.checked = false; });
            }
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
                      Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 }).fire({ icon: 'success', title: 'Akses diperbarui' });
                } else { Swal.fire("Gagal", data.message, "error"); }
            })
            .catch(err => Swal.fire("Error", "Gagal: " + err.message, "error"));
        }
    </script>
</body>

</html>