<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen Saya - HIRADC System</title>
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
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo-circle img {
            max-width: 80%;
            max-height: 80%;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 700;
            color: #c41e3a;
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
            color: #c41e3a;
        }

        .nav-item.active {
            background: #ffe5e5;
            color: #c41e3a;
            border-left: 3px solid #c41e3a;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .badge {
            position: absolute;
            right: 20px;
            background: #c41e3a;
            color: white;
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 10px;
            font-weight: 600;
        }

        /* User Info at Bottom */
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
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 2px;
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
            border-color: rgba(255, 255, 255, 0.5);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 30px 40px;
            min-height: 100vh;
        }

        .header {
            background: white;
            padding: 25px 40px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* Negative margin to span full width of main-content padding */
            margin: -30px -40px 30px -40px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        /* Tabs */
        .custom-tabs {
            display: flex;
            gap: 30px;
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
            padding-bottom: 0;
        }

        .tab-item {
            padding: 0 5px 15px 5px;
            font-size: 14px;
            font-weight: 600;
            color: #777;
            cursor: pointer;
            position: relative;
            transition: all 0.3s;
            background: none;
            border: none;
            outline: none;
        }

        .tab-item:hover {
            color: #333;
        }

        .tab-item.active {
            color: #c41e3a;
        }

        .tab-item.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #c41e3a;
            border-radius: 3px 3px 0 0;
        }

        .tab-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #eee;
            color: #555;
            border-radius: 12px;
            padding: 2px 8px;
            font-size: 11px;
            margin-left: 6px;
            min-width: 20px;
        }

        .tab-item.active .tab-badge {
            background-color: #c41e3a;
            color: white;
        }

        /* Card Styles included via partial or defined here if specific to page structure */
        /* Document Card Styles - Global for this page */
        .doc-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            border: 1px solid #f0f0f0;
            border-left: 4px solid #c41e3a;
            position: relative;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .doc-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .doc-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 20px;
        }

        .doc-title {
            font-size: 18px;
            font-weight: 700;
            color: #222;
            margin: 0;
            line-height: 1.4;
        }

        .status-badge-pill {
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-revisi {
            background-color: #ffebee;
            color: #c62828;
        }

        .status-disetujui {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .status-ditolak {
            background-color: #fce4ec;
            color: #880e4f;
        }

        .status-pending {
            background-color: #fff3e0;
            color: #ef6c00;
        }

        .status-draft {
            background-color: #f5f5f5;
            color: #616161;
        }

        .doc-meta-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        @media (max-width: 900px) {
            .doc-meta-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .meta-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .meta-label {
            font-size: 11px;
            text-transform: uppercase;
            color: #999;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .meta-value {
            font-size: 14px;
            color: #333;
            font-weight: 600;
        }

        .revision-box {
            background-color: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #5d4037;
        }

        .revision-box strong {
            display: block;
            color: #795548;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .revision-box p {
            margin: 0;
            font-style: italic;
            line-height: 1.5;
        }

        .action-row {
            display: flex;
            gap: 12px;
        }

        .btn-custom {
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-edit {
            background-color: #ff9800;
            color: white;
        }

        .btn-edit:hover {
            background-color: #f57c00;
        }

        .btn-detail {
            background-color: #c41e3a;
            color: white;
        }

        .btn-detail:hover {
            background-color: #a01729;
        }

        .empty-placeholder {
            text-align: center;
            padding: 60px 20px;
            color: #aaa;
        }

        .empty-placeholder i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.5;
            color: #ccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle">
                    <!-- Placeholder or real logo -->
                    <img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP">
                </div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System</div>
            </div>

            <nav class="nav-menu">
                <a href="{{ route('user.dashboard') }}" class="nav-item">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('documents.index') }}" class="nav-item active">
                    <i class="fas fa-folder-open"></i>
                    <span>Dokumen Saya</span>
                    @if(isset($revisionCount) && $revisionCount > 0)
                        <span class="badge">{{ $revisionCount }}</span>
                    @endif
                </a>
                <a href="{{ route('documents.create') }}" class="nav-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>Buat Dokumen Baru</span>
                </a>
            </nav>

            <!-- User Info at Bottom -->
            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">{{ substr(Auth::user()->nama_user ?? Auth::user()->username, 0, 2) }}</div>
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
                <h1>Dokumen Saya</h1>
            </div>

            <div class="content-area" style="padding: 0;">

                <!-- Tabs Navigation -->
                <div class="custom-tabs">
                    <button class="tab-item active" onclick="showTab('all', this)">
                        Semua <span class="tab-badge">{{ $documents->count() }}</span>
                    </button>
                    <button class="tab-item" onclick="showTab('pending', this)">
                        Menunggu <span class="tab-badge">{{ $myPending->count() }}</span>
                    </button>
                    <button class="tab-item" onclick="showTab('revision', this)">
                        Perlu Revisi <span class="tab-badge">{{ $myRevision->count() }}</span>
                    </button>
                    <button class="tab-item" onclick="showTab('approved', this)">
                        Disetujui <span
                            class="tab-badge">{{ $documents->filter(fn($d) => $d->status == 'approved' || $d->status == 'Disetujui')->count() }}</span>
                    </button>
                </div>

                <!-- Content Sections -->

                <!-- TAB: SEMUA -->
                <div id="tab-all" class="tab-content">
                    @if($documents->isEmpty())
                        <div class="empty-placeholder">
                            <i class="fas fa-folder-open"></i>
                            <p>Belum ada dokumen.</p>
                        </div>
                    @else
                        @foreach($documents as $doc)
                            @include('user.documents.partials.doc_card', ['doc' => $doc])
                        @endforeach
                    @endif
                </div>

                <!-- TAB: PENDING (MENUNGGU) -->
                <div id="tab-pending" class="tab-content" style="display: none;">
                    @if($myPending->isEmpty())
                        <div class="empty-placeholder">
                            <i class="fas fa-clock"></i>
                            <p>Tidak ada dokumen yang sedang menunggu approval.</p>
                        </div>
                    @else
                        @foreach($myPending as $doc)
                            @include('user.documents.partials.doc_card', ['doc' => $doc])
                        @endforeach
                    @endif
                </div>

                <!-- TAB: REVISION -->
                <div id="tab-revision" class="tab-content" style="display: none;">
                    @if($myRevision->isEmpty())
                        <div class="empty-placeholder">
                            <i class="fas fa-check-circle"></i>
                            <p>Tidak ada dokumen yang perlu direvisi.</p>
                        </div>
                    @else
                        @foreach($myRevision as $doc)
                            @include('user.documents.partials.doc_card', ['doc' => $doc, 'isRevision' => true])
                        @endforeach
                    @endif
                </div>

                <!-- TAB: APPROVED -->
                <div id="tab-approved" class="tab-content" style="display: none;">
                    @php
                        $approvedDocs = $documents->filter(fn($d) => $d->status == 'approved' || $d->status == 'Disetujui');
                    @endphp
                    @if($approvedDocs->isEmpty())
                        <div class="empty-placeholder">
                            <i class="fas fa-certificate"></i>
                            <p>Belum ada dokumen yang disetujui.</p>
                        </div>
                    @else
                        @foreach($approvedDocs as $doc)
                            @include('user.documents.partials.doc_card', ['doc' => $doc])
                        @endforeach
                    @endif
                </div>



            </div>
        </main>
    </div>

    <script>
        function showTab(tabName, btn) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');

            // Show selected tab content
            document.getElementById('tab-' + tabName).style.display = 'block';

            // Update active tab button
            document.querySelectorAll('.tab-item').forEach(el => el.classList.remove('active'));
            btn.classList.add('active');
        }
    </script>
</body>

</html>