<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f7fafc;
            color: #2d3748;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #2d3748 0%, #1a202c 100%);
            color: white;
            padding: 24px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar-brand {
            padding: 0 24px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 24px;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
        }

        .brand-text h1 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .brand-text p {
            font-size: 11px;
            opacity: 0.7;
        }

        .nav-menu {
            list-style: none;
            padding: 0 12px;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .nav-icon {
            font-size: 20px;
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 0;
        }

        /* Header */
        .header {
            background: white;
            padding: 20px 32px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .search-bar {
            flex: 1;
            max-width: 500px;
            position: relative;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 16px 10px 44px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification-btn {
            position: relative;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #4a5568;
            transition: color 0.3s ease;
        }

        .notification-btn:hover {
            color: #667eea;
        }

        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #f56565;
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 10px;
            transition: background 0.3s ease;
        }

        .user-profile:hover {
            background: #f7fafc;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .user-info h4 {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
        }

        .user-info p {
            font-size: 12px;
            color: #718096;
        }

        /* Content Area */
        .content {
            padding: 32px;
        }

        .welcome-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 32px;
            border-radius: 16px;
            color: white;
            margin-bottom: 32px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .welcome-section h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome-section p {
            font-size: 16px;
            opacity: 0.9;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .filter-section h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #2d3748;
        }

        .filter-controls {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-dropdown {
            padding: 10px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .filter-dropdown:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn-filter {
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        /* Documents Grid */
        .documents-section h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #2d3748;
        }

        .documents-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .document-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .document-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            border-color: #667eea;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .document-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-ko { background: #bee3f8; color: #2c5282; }
        .badge-k3 { background: #fbd38d; color: #7c2d12; }
        .badge-lingkungan { background: #9ae6b4; color: #22543d; }
        .badge-keamanan { background: #fbb6ce; color: #702459; }
        .badge-published { background: #c6f6d5; color: #22543d; }

        .card-body h4 {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .card-meta {
            display: flex;
            gap: 16px;
            font-size: 13px;
            color: #718096;
            margin-bottom: 16px;
        }

        .card-meta span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-view {
            width: 100%;
            padding: 10px;
            background: #f7fafc;
            color: #667eea;
            border: 2px solid #667eea;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            background: #667eea;
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #718096;
        }

        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state h4 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #4a5568;
        }

        .empty-state p {
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .sidebar {
                width: 70px;
            }

            .main-content {
                margin-left: 70px;
            }

            .brand-text, .nav-text {
                display: none;
            }

            .sidebar-brand {
                padding: 0 12px 24px;
            }

            .nav-link {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <div class="brand-logo">
                    <div class="brand-icon">H</div>
                    <div class="brand-text">
                        <h1>HIRADC</h1>
                        <p>Risk Management</p>
                    </div>
                </div>
            </div>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('user.dashboard') }}" class="nav-link active">
                        <span class="nav-icon">🏠</span>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('documents.create') }}" class="nav-link">
                        <span class="nav-icon">➕</span>
                        <span class="nav-text">Buat Dokumen Baru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('documents.my') }}" class="nav-link">
                        <span class="nav-icon">📄</span>
                        <span class="nav-text">Dokumen Saya</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('notifications') }}" class="nav-link">
                        <span class="nav-icon">🔔</span>
                        <span class="nav-text">Notifikasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile') }}" class="nav-link">
                        <span class="nav-icon">⚙️</span>
                        <span class="nav-text">Pengaturan</span>
                    </a>
                </li>
                <li class="nav-item" style="margin-top: 24px;">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <span class="nav-icon">🚪</span>
                        <span class="nav-text">Keluar</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="search-bar">
                    <span class="search-icon">🔍</span>
                    <input type="text" placeholder="Cari dokumen risiko...">
                </div>

                <div class="header-actions">
                    <button class="notification-btn">
                        🔔
                        <span class="notification-badge">3</span>
                    </button>

                    <div class="user-profile">
                        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        <div class="user-info">
                            <h4>{{ Auth::user()->name }}</h4>
                            <p>Staff Unit Kerja</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="content">
                <!-- Welcome Section -->
                <div class="welcome-section">
                    <h2>Selamat Datang, {{ Auth::user()->name }}!</h2>
                    <p>Berikut adalah dokumen risiko yang telah dipublikasikan</p>
                </div>

                <!-- Filter Section -->
                <div class="filter-section">
                    <h3>🔍 Filter Dokumen</h3>
                    <div class="filter-controls">
                        <select class="filter-dropdown" id="filter-type">
                            <option value="">Semua Jenis Dokumen</option>
                            <option value="KO">KO (Keselamatan Operasional)</option>
                            <option value="K3">K3 (Kesehatan & Keselamatan Kerja)</option>
                            <option value="Lingkungan">Lingkungan</option>
                            <option value="Keamanan">Keamanan</option>
                        </select>

                        <select class="filter-dropdown" id="filter-date">
                            <option value="">Semua Tanggal</option>
                            <option value="today">Hari Ini</option>
                            <option value="week">Minggu Ini</option>
                            <option value="month">Bulan Ini</option>
                            <option value="year">Tahun Ini</option>
                        </select>

                        <button class="btn-filter" onclick="applyFilter()">Terapkan Filter</button>
                    </div>
                </div>

                <!-- Documents Section -->
                <div class="documents-section">
                    <h3>📊 Dokumen Risiko Terpublikasi</h3>
                    
                    @if($documents->count() > 0)
                        <div class="documents-grid">
                            @foreach($documents as $doc)
                            <div class="document-card" onclick="viewDocument({{ $doc->id }})">
                                <div class="card-header">
                                    <div class="document-icon">📋</div>
                                    <span class="badge badge-{{ strtolower($doc->type->code) }}">{{ $doc->type->name }}</span>
                                </div>
                                <div class="card-body">
                                    <h4>{{ $doc->title }}</h4>
                                    <div class="card-meta">
                                        <span>📅 {{ $doc->published_at->format('d M Y') }}</span>
                                        <span class="badge badge-published">Published</span>
                                    </div>
                                    <button class="btn-view">Lihat Detail</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon">📭</div>
                            <h4>Belum Ada Dokumen</h4>
                            <p>Belum ada dokumen risiko yang dipublikasikan</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <script>
        function viewDocument(id) {
            window.location.href = `/documents/${id}`;
        }

        function applyFilter() {
            const type = document.getElementById('filter-type').value;
            const date = document.getElementById('filter-date').value;
            
            // Build query string
            const params = new URLSearchParams();
            if (type) params.append('type', type);
            if (date) params.append('date', date);
            
            // Reload with filters
            window.location.href = `{{ route('user.dashboard') }}?${params.toString()}`;
        }
    </script>
</body>
</html>
