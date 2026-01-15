<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen Saya - HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #c41e3a;
            --primary-hover: #a01729;
            --bg-color: #f5f5f5;
            --sidebar-width: 250px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-color);
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid #e0e0e0;
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 10;
        }

        .logo-section {
            padding: 30px 20px;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
        }

        .logo-circle {
            width: 70px;
            height: 70px;
            background: #fff;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo-circle img {
            max-width: 80%;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 3px;
        }

        .logo-subtext {
            font-size: 12px;
            color: #999;
            font-style: italic;
        }

        .nav-menu {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .nav-item {
            padding: 15px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #666;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            position: relative;
        }

        .nav-item:hover {
            background: #fff5f5;
            color: var(--primary-color);
        }

        .nav-item.active {
            background: #ffe5e5;
            color: var(--primary-color);
            border-left: 3px solid var(--primary-color);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        /* User Info */
        .user-info-bottom {
            padding: 20px;
            border-top: 2px solid #e0e0e0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-weight: 700;
            font-size: 16px;
            flex-shrink: 0;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: white;
        }

        .user-role {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.8);
        }

        .logout-btn {
            width: 100%;
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
        }

        .header {
            background: white;
            padding: 25px 40px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .content-area {
            padding: 30px 40px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.2s;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card.active {
            border-color: var(--primary-color);
            background: #fff5f5;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-info {
            display: flex;
            flex-direction: column;
        }

        .stat-label {
            font-size: 12px;
            color: #888;
            font-weight: 600;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .icon-blue {
            background: #e3f2fd;
            color: #1976d2;
        }

        .icon-orange {
            background: #fff3e0;
            color: #f57c00;
        }

        .icon-red {
            background: #ffebee;
            color: #d32f2f;
        }

        .icon-green {
            background: #e8f5e9;
            color: #388e3c;
        }

        /* Toolbar */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        .search-box input:focus {
            border-color: var(--primary-color);
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 12px;
            color: #999;
        }

        .view-toggles {
            display: flex;
            gap: 10px;
        }

        .view-btn {
            background: #f5f5f5;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            color: #666;
            transition: all 0.2s;
        }

        .view-btn.active {
            background: var(--primary-color);
            color: white;
        }

        .btn-create-new {
            background: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 6px -1px rgba(196, 30, 58, 0.2);
            transition: background 0.2s;
        }

        .btn-create-new:hover {
            background: var(--primary-hover);
        }

        /* Grid View */
        .doc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .doc-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.2s;
            border: 1px solid transparent;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .doc-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .cat-badge {
            font-size: 10px;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .cat-k3 {
            background: #e3f2fd;
            color: #1976d2;
        }

        .cat-lingkungan {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .cat-keamanan {
            background: #fff3e0;
            color: #ef6c00;
        }

        .doc-menu-btn {
            color: #999;
            cursor: pointer;
            padding: 4px;
        }

        .doc-menu-btn:hover {
            color: #333;
        }

        .doc-title {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .doc-meta {
            font-size: 12px;
            color: #888;
            margin-bottom: 15px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .status-container {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status-pill {
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .st-draft {
            background: #f5f5f5;
            color: #616161;
        }

        .st-pending {
            background: #fff8e1;
            color: #f57f17;
        }

        .st-revision {
            background: #ffebee;
            color: #c62828;
        }

        .st-approved {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .view-link {
            color: var(--primary-color);
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
        }

        .view-link:hover {
            text-decoration: underline;
        }

        /* List View (Table) */
        .doc-table-container {
            display: none;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .doc-table {
            width: 100%;
            border-collapse: collapse;
        }

        .doc-table th {
            background: #f9f9f9;
            padding: 15px 20px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            color: #888;
            text-transform: uppercase;
        }

        .doc-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: #555;
            vertical-align: middle;
        }

        .doc-table tr:hover {
            background: #fbfbfb;
        }

        /* Animation */
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

        .animate-item {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
</head>

<body>

    @include('partials.alerts')

    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('user.dashboard') }}" class="nav-item"><i
                        class="fas fa-th-large"></i><span>Dashboard</span></a>
                <a href="{{ route('documents.index') }}" class="nav-item active"><i
                        class="fas fa-folder-open"></i><span>Dokumen Saya</span></a>
                <a href="{{ route('documents.create') }}" class="nav-item"><i class="fas fa-plus-circle"></i><span>Buat
                        Dokumen Baru</span></a>
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
                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Dokumen Saya</h1>
                <a href="{{ route('documents.create') }}" class="btn-create-new">
                    <i class="fas fa-plus"></i> Buat Dokumen
                </a>
            </div>

            <div class="content-area">

                <!-- Stats Summary (Now Interactive) -->
                <div class="stats-grid">
                    <div class="stat-card active" onclick="filterByStatus('all', this)">
                        <div class="stat-icon icon-blue"><i class="fas fa-file-alt"></i></div>
                        <div class="stat-info"><span class="stat-label">Total Dokumen</span><span
                                class="stat-value">{{ $documents->count() }}</span></div>
                    </div>
                    <div class="stat-card" onclick="filterByStatus('pending', this)">
                        <div class="stat-icon icon-orange"><i class="fas fa-clock"></i></div>
                        <div class="stat-info"><span class="stat-label">Menunggu</span><span
                                class="stat-value">{{ $myPending->count() }}</span></div>
                    </div>
                    <div class="stat-card" onclick="filterByStatus('revision', this)">
                        <div class="stat-icon icon-red"><i class="fas fa-redo"></i></div>
                        <div class="stat-info"><span class="stat-label">Perlu Revisi</span><span
                                class="stat-value">{{ $myRevision->count() }}</span></div>
                    </div>
                    <div class="stat-card" onclick="filterByStatus('approved', this)">
                        <div class="stat-icon icon-green"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info"><span class="stat-label">Disetujui</span><span
                                class="stat-value">{{ $documents->filter(fn($d) => $d->status == 'approved')->count() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Toolbar -->
                <div class="toolbar">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Cari judul dokumen..."
                            onkeyup="filterContent()">
                    </div>
                    <div class="view-toggles">
                        <button class="view-btn active" id="btnGrid" onclick="switchView('grid')"><i
                                class="fas fa-th-large"></i> Grid</button>
                        <button class="view-btn" id="btnList" onclick="switchView('list')"><i class="fas fa-list"></i>
                            List</button>
                    </div>
                </div>

                <!-- Grid View -->
                <div class="doc-grid" id="gridView">
                    @foreach($documents as $doc)
                        @php
                            // Determine status key for filtering
                            $statusKey = 'draft';
                            if (in_array($doc->status, ['pending_level1', 'pending_level2', 'pending_level3'])) {
                                $statusKey = 'pending';
                            } elseif ($doc->status == 'revision') {
                                $statusKey = 'revision';
                            } elseif ($doc->status == 'approved') {
                                $statusKey = 'approved';
                            }
                        @endphp
                        <div class="doc-card animate-item searchable-item"
                            data-title="{{ strtolower($doc->kolom2_kegiatan) }}" data-status="{{ $statusKey }}">

                            <div class="card-top">
                                @php
                                    $catClass = 'cat-k3';
                                    if ($doc->kategori == 'Lingkungan')
                                        $catClass = 'cat-lingkungan';
                                    if ($doc->kategori == 'Keamanan')
                                        $catClass = 'cat-keamanan';
                                @endphp
                                <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                    <span class="cat-badge {{ $catClass }}">{{ $doc->kategori }}</span>
                                    <span class="cat-badge"
                                        style="background:#f3f4f6; color:#555; border:1px solid #e5e7eb;">
                                        <i class="fas fa-building"
                                            style="font-size:9px; margin-right:3px; color:#9ca3af;"></i>
                                        {{ Str::limit($doc->unit->nama_unit ?? '-', 15) }}
                                    </span>
                                </div>
                            </div>

                            <div class="doc-title" title="{{ $doc->kolom2_kegiatan }}">
                                {{ $doc->kolom2_kegiatan ?? 'Tanpa Judul' }}</div>
                            <div class="doc-meta" style="flex-direction: column; align-items: flex-start; gap: 5px;">
                                <div>
                                    <i class="far fa-calendar-alt"></i> {{ $doc->created_at->format('d M Y') }}
                                    <span style="color:#ccc; margin:0 5px;">|</span>
                                    <i class="far fa-clock"></i> {{ $doc->created_at->format('H:i') }}
                                </div>
                                <div style="font-weight: 500; color: #666;">
                                    <i class="far fa-user-circle"></i> {{ $doc->user->nama_user ?? 'Unknown' }}
                                </div>
                            </div>

                            <div class="status-container" style="display:block; border-top:1px solid #f1f5f9; padding-top:12px; margin-top:12px;">
                                @php
                                    $step = 1;
                                    $waitingFor = 'Anda';
                                    $position = 'Submitter';
                                    
                                    if ($statusKey == 'pending') {
                                        if ($doc->current_level == 2) {
                                            $position = 'Unit Pengelola';
                                            $waitingFor = ($doc->kategori == 'Keamanan') ? 'Unit Keamanan' : 'Unit SHE';
                                            $step = 2;
                                        } elseif ($doc->current_level == 3) {
                                            $position = 'Kepala Dept';
                                            $waitingFor = 'Ka. Dept ' . ($doc->user->departemen->nama_dept ?? ''); 
                                            $step = 3;
                                        }
                                    } elseif ($statusKey == 'revision') {
                                        $position = 'Draft';
                                        $waitingFor = 'Anda (Revisi)';
                                        $step = 1;
                                    } elseif ($statusKey == 'approved') {
                                        $position = 'Final';
                                        $waitingFor = '-';
                                        $step = 4;
                                    }
                                @endphp

                                <!-- Minimalist Stepper -->
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                                    @foreach(['Draft', 'Unit', 'Dept', 'Done'] as $index => $label)
                                        @php $i = $index + 1; $isActive = ($i <= $step); $isCurrent = ($i == $step); @endphp
                                        <div style="display: flex; flex-direction: column; align-items: center; gap: 4px; position: relative; width: 25%;">
                                            <!-- Line (Left) -->
                                            @if($i > 1)
                                                <div style="position: absolute; left: -50%; top: 6px; width: 100%; height: 2px; background: {{ $isActive ? '#c41e3a' : '#f3f4f6' }}; z-index: 0;"></div>
                                            @endif
                                            
                                            <!-- Dot -->
                                            <div style="width:{{ $isCurrent ? '12px' : '10px' }}; height:{{ $isCurrent ? '12px' : '10px' }}; border-radius: 50%; background: {{ $isActive ? '#c41e3a' : '#e5e7eb' }}; z-index: 1; border: 2px solid white; box-shadow: 0 0 0 1px {{ $isActive ? '#c41e3a' : '#e5e7eb' }};"></div>
                                            
                                            <!-- Label -->
                                            <span style="font-size: 9px; font-weight: {{ $isCurrent ? '700' : '500' }}; color: {{ $isActive ? '#333' : '#9ca3af' }};">{{ $label }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Informative Status & Action -->
                                <div style="display:flex; justify-content:space-between; align-items:center;">
                                    <div style="font-size: 11px; line-height: 1.4;">
                                        @if($statusKey == 'approved')
                                            <div style="color:#059669; font-weight:600;"><i class="fas fa-check-circle"></i> Dokumen Final</div>
                                            <div style="color:#6b7280;">Telah dipublikasi</div>
                                        @elseif($statusKey == 'revision')
                                            <div style="color:#dc2626; font-weight:600;"><i class="fas fa-exclamation-circle"></i> Butuh Revisi</div>
                                            <div style="color:#6b7280;">Menunggu perbaikan Anda</div>
                                        @else
                                            <div style="color:#d97706; font-weight:600;"><i class="fas fa-spinner fa-spin"></i> Proses Approval</div>
                                            <div style="color:#6b7280;">Menunggu: <b>{{ $waitingFor }}</b></div>
                                        @endif
                                    </div>

                                    <a href="{{ route('documents.show', $doc->id) }}" style="background: white; border: 1px solid #e5e7eb; color: #374151; padding: 6px 12px; border-radius: 6px; font-size: 11px; font-weight: 600; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.borderColor='#9ca3af'" onmouseout="this.style.borderColor='#e5e7eb'">
                                        {{ $statusKey == 'revision' ? 'Perbaiki' : 'Detail' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- List View (Table) -->
                <div class="doc-table-container" id="listView">
                    <table class="doc-table">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Judul Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $doc)
                                @php
                                    $statusKey = 'draft';
                                    if (in_array($doc->status, ['pending_level1', 'pending_level2', 'pending_level3'])) {
                                        $statusKey = 'pending';
                                    } elseif ($doc->status == 'revision') {
                                        $statusKey = 'revision';
                                    } elseif ($doc->status == 'approved') {
                                        $statusKey = 'approved';
                                    }
                                @endphp
                                <tr class="searchable-item" data-title="{{ strtolower($doc->kolom2_kegiatan) }}"
                                    data-status="{{ $statusKey }}">
                                    <td>
                                        <span
                                            class="cat-badge 
                                            {{ $doc->kategori == 'K3' ? 'cat-k3' : ($doc->kategori == 'Lingkungan' ? 'cat-lingkungan' : 'cat-keamanan') }}">
                                            {{ $doc->kategori }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; color: #333;">
                                            {{ Str::limit($doc->kolom2_kegiatan, 50) }}</div>
                                    </td>
                                    <td>{{ $doc->created_at->format('d M Y') }}</td>
                                    <td>
                                        @php
                                            $stClass = 'st-draft';
                                            $stText = 'Draft';
                                            if ($statusKey == 'pending') {
                                                $stClass = 'st-pending';
                                                $stText = 'Menunggu';
                                            } elseif ($statusKey == 'revision') {
                                                $stClass = 'st-revision';
                                                $stText = 'Revisi';
                                            } elseif ($statusKey == 'approved') {
                                                $stClass = 'st-approved';
                                                $stText = 'Disetujui';
                                            }
                                        @endphp
                                        <span class="status-pill {{ $stClass }}">{{ $stText }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('documents.show', $doc->id) }}" class="view-link">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>

    <script>
        let currentStatusFilter = 'all';

        function switchView(view) {
            const grid = document.getElementById('gridView');
            const list = document.getElementById('listView');
            const btnGrid = document.getElementById('btnGrid');
            const btnList = document.getElementById('btnList');

            if (view === 'grid') {
                grid.style.display = 'grid';
                list.style.display = 'none';
                btnGrid.classList.add('active');
                btnList.classList.remove('active');
            } else {
                grid.style.display = 'none';
                list.style.display = 'block';
                btnGrid.classList.remove('active');
                btnList.classList.add('active');
            }
        }

        function filterByStatus(status, card) {
            currentStatusFilter = status;

            // Update active card style
            document.querySelectorAll('.stat-card').forEach(c => c.classList.remove('active'));
            card.classList.add('active');

            // Re-run filter (combines status + search)
            filterContent();
        }

        function filterContent() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const items = document.querySelectorAll('.searchable-item');

            items.forEach(item => {
                const title = item.getAttribute('data-title');
                const status = item.getAttribute('data-status');

                const matchesSearch = title.includes(input);
                const matchesStatus = (currentStatusFilter === 'all') || (status === currentStatusFilter);

                if (matchesSearch && matchesStatus) {
                    item.style.display = item.classList.contains('doc-card') ? 'flex' : 'table-row';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>