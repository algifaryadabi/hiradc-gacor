<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen Direktur | HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #c41e3a;
            --primary-dark: #9a1829;
            --bg-body: #f8fafc;
            --surface: #ffffff;
            --text-main: #1e293b;
            --text-sub: #64748b;
            --border: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; outline: none; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-body); color: var(--text-main); min-height: 100vh; }

        /* Sidebar */
        .sidebar { width: 280px; background: #5b6fd8; position: fixed; height: 100vh; color: white; border-right: 1px solid rgba(255,255,255,0.1); z-index: 100; display: flex; flex-direction: column; }
        .logo-section { padding: 2rem; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .logo-circle { width: 80px; height: 80px; background: white; border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; }
        .logo-circle img { max-width: 70%; max-height: 70%; }
        .nav-menu { flex: 1; padding: 1.5rem 0; overflow-y: auto; }
        .nav-item { padding: 1rem 2rem; display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.8); text-decoration: none; transition: 0.2s; font-weight: 500; font-size: 0.95rem; }
        .nav-item:hover, .nav-item.active { background: rgba(255,255,255,0.1); color: white; border-left: 4px solid white; }
        .nav-item i { width: 24px; text-align: center; font-size: 1.2rem; }
        
        .user-info-bottom { padding: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1); }
        .user-profile { display: flex; gap: 1rem; align-items: center; margin-bottom: 1rem; }
        .user-avatar { width: 40px; height: 40px; background: white; color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; }
        .logout-btn { width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.2); border: none; color: white; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-weight: 600; text-decoration: none; }

        /* Main Content */
        .main-content { margin-left: 280px; padding: 40px 48px; }
        .header-content h1 { font-size: 24px; font-weight: 800; color: var(--text-main); margin-bottom: 8px; }
        .header-content p { color: var(--text-sub); font-size: 14px; }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin: 32px 0; }
        .stat-card { background: white; padding: 24px; border-radius: 16px; border: 1px solid var(--border); display: flex; gap: 16px; align-items: center; box-shadow: var(--shadow-sm); cursor: pointer; transition: 0.3s; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .sc-pending .stat-icon { background: #fff7ed; color: #ea580c; }
        .sc-count .stat-icon { background: #eff6ff; color: #2563eb; }
        
        /* Filters */
        .filters-bar { display: flex; justify-content: space-between; margin-bottom: 24px; }
        .search-box input { padding: 12px 16px; border-radius: 12px; border: 1px solid var(--border); width: 350px; font-family: inherit; }
        
        /* Doc List */
        .doc-list { display: flex; flex-direction: column; gap: 16px; }
        .doc-item { background: white; padding: 20px; border-radius: 16px; border: 1px solid var(--border); display: grid; grid-template-columns: auto 1fr auto auto; gap: 20px; align-items: center; box-shadow: var(--shadow-sm); }
        .doc-date-box { width: 60px; height: 60px; background: #f8fafc; border: 1px solid var(--border); border-radius: 12px; display: flex; flex-direction: column; align-items: center; justify-content: center; }
        .doc-date-box .day { font-size: 20px; font-weight: 800; }
        .doc-date-box .month { font-size: 11px; text-transform: uppercase; color: var(--text-sub); font-weight: 600; }
        
        .status-pill { padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; background: #fffbeb; color: #d97706; border: 1px solid #fcd34d; }
        .btn-action { padding: 10px 20px; background: var(--primary); color: white; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 8px; transition: 0.2s; }
        .btn-action:hover { background: var(--primary-dark); }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo-section">
            <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
            <div class="logo-text" style="font-weight:700; margin-bottom:4px;">PT Semen Padang</div>
            <div class="logo-subtext" style="opacity:0.8; font-size:12px;">HIRADC System</div>
        </div>
        <nav class="nav-menu">
            <a href="{{ route('direksi.dashboard') }}" class="nav-item">
                <i class="fas fa-th-large"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('direksi.check_documents') }}" class="nav-item active">
                <i class="fas fa-file-signature"></i><span>Review Dokumen</span>
            </a>
        </nav>
        <div class="user-info-bottom">
            <div class="user-profile">
                <div class="user-avatar">{{ substr(Auth::user()->nama_user ?? Auth::user()->username, 0, 2) }}</div>
                <div>
                     <div style="font-weight:600; font-size:14px;">{{ Auth::user()->nama_user }}</div>
                     <div style="font-size:12px; opacity:0.8;">Direksi</div>
                </div>
            </div>
            <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
    </aside>

    <!-- Main -->
    <main class="main-content">
        <div class="header-content">
            <h1>Tinjauan Dokumen Direksi</h1>
            <p>Daftar dokumen HIRADC dan Program Manajemen Korporat (PMK) yang menunggu persetujuan Anda.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card sc-pending">
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="stat-val" style="font-size:24px; font-weight:800; color:var(--text-main);">{{ collect($documentsData)->count() }}</div>
                    <div style="font-size:13px; color:var(--text-sub); font-weight:500;">Menunggu Approval</div>
                </div>
            </div>
            <div class="stat-card sc-count">
                <div class="stat-icon"><i class="fas fa-folder"></i></div>
                <div>
                    <div class="stat-val" style="font-size:24px; font-weight:800; color:var(--text-main);">{{ collect($documentsData)->count() }}</div>
                    <div style="font-size:13px; color:var(--text-sub); font-weight:500;">Total Dokumen Masuk</div>
                </div>
            </div>
        </div>

        <div class="filters-bar">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Cari dokumen..." onkeyup="filterDocs()">
            </div>
        </div>

        <div class="doc-list" id="docList">
            @forelse($documentsData as $doc)
            <div class="doc-item">
                <div class="doc-date-box">
                    <span class="day">{{ \Carbon\Carbon::parse($doc['date_submit'])->format('d') }}</span>
                    <span class="month">{{ \Carbon\Carbon::parse($doc['date_submit'])->format('M') }}</span>
                </div>
                <div>
                    <div style="font-size:11px; font-weight:700; text-transform:uppercase; color:#3b82f6; margin-bottom:4px;">
                        {{ $doc['unit'] }}
                    </div>
                    <h3 style="font-size:16px; font-weight:700; color:var(--text-main); margin-bottom:4px;">{{ $doc['title'] }}</h3>
                    <div style="font-size:13px; color:var(--text-sub);">
                        <i class="fas fa-user-circle" style="margin-right:4px;"></i> {{ $doc['submitter'] }}
                    </div>
                </div>
                <div>
                    <span class="status-pill">{{ $doc['status'] }}</span>
                </div>
                <div>
                    <a href="{{ $doc['viewUrl'] }}" class="btn-action">
                        <i class="fas fa-signature"></i> Review
                    </a>
                </div>
            </div>
            @empty
            <div style="text-align:center; padding:60px; background:white; border-radius:16px; border:2px dashed var(--border);">
                <i class="fas fa-check-circle" style="font-size:48px; color:#cbd5e1; margin-bottom:16px;"></i>
                <h3 style="color:var(--text-sub);">Tidak ada dokumen menunggu approval.</h3>
            </div>
            @endforelse
        </div>
    </main>

    <script>
        function filterDocs() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const items = document.querySelectorAll('.doc-item');
            
            items.forEach(item => {
                const text = item.innerText.toLowerCase();
                item.style.display = text.includes(search) ? 'grid' : 'none';
            });
        }
        
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonColor: '#c41e3a'
            });
        @endif
    </script>
</body>
</html>
