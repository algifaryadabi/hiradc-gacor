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

        .btn-primary {
            padding: 10px 20px;
            background: #c41e3a;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            background: #a01729;
            transform: translateY(-1px);
        }

        .content-area {
            padding: 30px 40px;
        }

        /* Status Tabs */
        .status-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            border-bottom: 2px solid #e0e0e0;
        }

        .tab {
            padding: 12px 24px;
            background: transparent;
            border: none;
            font-size: 14px;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }

        .tab:hover {
            color: #c41e3a;
        }

        .tab.active {
            color: #c41e3a;
            border-bottom-color: #c41e3a;
        }

        .tab .count {
            background: #e0e0e0;
            color: #666;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 11px;
            margin-left: 8px;
        }

        .tab.active .count {
            background: #c41e3a;
            color: white;
        }

        /* Document Cards */
        .documents-grid {
            display: grid;
            gap: 20px;
        }

        .document-card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            border-left: 4px solid #c41e3a;
        }

        .document-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .doc-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .doc-title {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .doc-meta {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin: 15px 0;
            padding: 15px 0;
            border-top: 1px solid #f0f0f0;
            border-bottom: 1px solid #f0f0f0;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .meta-label {
            font-size: 11px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-value {
            font-size: 13px;
            color: #333;
            font-weight: 600;
        }

        .doc-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-view {
            background: #c41e3a;
            color: white;
        }

        .btn-view:hover {
            background: #a01729;
        }

        .btn-edit {
            background: #ff9800;
            color: white;
        }

        .btn-edit:hover {
            background: #e68900;
        }

        /* Status Badges */
        .badge-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-revision {
            background: #ffebee;
            color: #c62828;
        }

        .status-approved {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-rejected {
            background: #fce4ec;
            color: #880e4f;
        }

        /* Revision Alert */
        .revision-alert {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 12px 15px;
            border-radius: 4px;
            margin-top: 10px;
            font-size: 13px;
        }

        .revision-alert strong {
            color: #856404;
        }

        .revision-comment {
            margin-top: 5px;
            font-style: italic;
            color: #666;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #666;
        }

        .empty-state p {
            font-size: 14px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            overflow-y: auto;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            max-width: 900px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            padding: 25px 30px;
            border-bottom: 2px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
        }

        .modal-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .modal-close {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #f5f5f5;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            font-size: 20px;
            color: #666;
        }

        .modal-close:hover {
            background: #c41e3a;
            color: white;
        }

        .modal-body {
            padding: 30px;
        }

        .detail-section {
            margin-bottom: 30px;
        }

        .detail-section-title {
            font-size: 16px;
            font-weight: 700;
            color: #c41e3a;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #c41e3a;
        }

        .detail-grid {
            display: grid;
            gap: 15px;
        }

        .detail-item {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 15px;
        }

        .detail-label {
            font-size: 13px;
            font-weight: 600;
            color: #666;
        }

        .detail-value {
            font-size: 14px;
            color: #333;
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

                <!-- STATUS TRACKER -->
                <div class="filters-container" style="display: block; padding: 0; overflow: hidden; margin-bottom: 40px;">
                    <!-- Tabs -->
                    <div style="display: flex; border-bottom: 1px solid #eee; background: #fbfbfb;">
                        <button class="tab-btn active" onclick="switchTab('tab_pending')">
                            Menunggu Approval <span class="badge-count">{{ $myPending->count() }}</span>
                        </button>
                        <button class="tab-btn" onclick="switchTab('tab_revision')">
                            Perlu Revisi <span class="badge-count" style="background: #e67e22;">{{ $myRevision->count() }}</span>
                        </button>
                        <button class="tab-btn" onclick="switchTab('tab_draft')">
                            Draft <span class="badge-count" style="background: #95a5a6;">{{ $myDraft->count() }}</span>
                        </button>
                        <button class="tab-btn" onclick="switchTab('tab_all')">
                            Semua Dokumen <span class="badge-count" style="background: #333;">{{ $documents->count() }}</span>
                        </button>
                    </div>

                    <!-- Pending Content -->
                    <div id="tab_pending" class="tab-content" style="display: block;">
                        @if($myPending->isEmpty())
                            <div class="empty-state">
                                <i class="fas fa-folder-open"></i>
                                <p>Tidak ada dokumen yang sedang diproses.</p>
                            </div>
                        @else
                            <table class="custom-table" style="width:100%; border-collapse: collapse; margin-top:20px;">
                                <thead style="background:#f8f9fa;">
                                    <tr>
                                        <th style="padding:15px; text-align:left;">Judul Kegiatan</th>
                                        <th style="padding:15px; text-align:left;">Lokasi</th>
                                        <th style="padding:15px; text-align:left;">Status Saat Ini</th>
                                        <th style="padding:15px; text-align:left;">Update</th>
                                        <th style="padding:15px; text-align:left;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myPending as $doc)
                                    <tr style="border-bottom:1px solid #eee;">
                                        <td style="padding:15px;">{{ Str::limit($doc->kolom2_kegiatan, 50) }}</td>
                                        <td style="padding:15px;">{{ $doc->kolom3_lokasi }}</td>
                                        <td style="padding:15px;">
                                            @if($doc->current_level == 1) <span class="badge-status" style="background:#e3f2fd; color:#1565c0; padding:5px 10px; border-radius:15px; font-size:11px;">Level 1: Ka. Unit</span>
                                            @elseif($doc->current_level == 2) <span class="badge-status" style="background:#f3e5f5; color:#7b1fa2; padding:5px 10px; border-radius:15px; font-size:11px;">Level 2: Unit Pengelola</span>
                                            @else <span class="badge-status" style="background:#fff3e0; color:#ef6c00; padding:5px 10px; border-radius:15px; font-size:11px;">Level 3: Ka. Dept</span>
                                            @endif
                                        </td>
                                        <td style="padding:15px;">{{ $doc->updated_at->diffForHumans() }}</td>
                                        <td style="padding:15px;">
                                            <a href="{{ route('documents.show', $doc->id) }}" class="btn" style="background: #34495e; color:white; padding:8px 15px; border-radius:4px; text-decoration:none;"><i class="fas fa-eye"></i> Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                    <!-- Revision Content -->
                    <div id="tab_revision" class="tab-content" style="display: none;">
                        @if($myRevision->isEmpty())
                             <div class="empty-state">
                                 <i class="fas fa-check-circle"></i>
                                 <p>Tidak ada dokumen yang perlu direvisi.</p>
                             </div>
                        @else
                            <table class="custom-table" style="width:100%; border-collapse: collapse; margin-top:20px;">
                                <thead style="background:#f8f9fa;">
                                    <tr>
                                        <th style="padding:15px; text-align:left;">Judul Kegiatan</th>
                                        <th style="padding:15px; text-align:left;">Catatan Revisi</th>
                                        <th style="padding:15px; text-align:left;">Dari</th>
                                        <th style="padding:15px; text-align:left;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myRevision as $doc)
                                    @php $lastRev = $doc->approvals->where('action', 'revision')->first(); @endphp
                                    <tr style="border-bottom:1px solid #eee;">
                                        <td style="padding:15px;">{{ Str::limit($doc->kolom2_kegiatan, 50) }}</td>
                                        <td style="padding:15px; color:#c0392b; font-style:italic;">"{{ Str::limit($lastRev->catatan ?? '-', 60) }}"</td>
                                        <td style="padding:15px;">{{ $lastRev->approver->nama_user ?? 'Approver' }}</td>
                                        <td style="padding:15px;">
                                            <a href="{{ route('documents.show', $doc->id) }}" class="btn" style="background: #e67e22; color:white; padding:8px 15px; border-radius:4px; text-decoration:none;"><i class="fas fa-edit"></i> Perbaiki</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                    <!-- Draft Content -->
                    <div id="tab_draft" class="tab-content" style="display: none;">
                        @if($myDraft->isEmpty())
                           <div class="empty-state">
                                <i class="fas fa-pencil-ruler"></i>
                                <p>Tidak ada draft.</p>
                           </div>
                        @else
                            <table class="custom-table" style="width:100%; border-collapse: collapse; margin-top:20px;">
                                <thead style="background:#f8f9fa;">
                                    <tr>
                                        <th style="padding:15px; text-align:left;">Judul Kegiatan</th>
                                        <th style="padding:15px; text-align:left;">Kategori</th>
                                        <th style="padding:15px; text-align:left;">Terakhir Diedit</th>
                                        <th style="padding:15px; text-align:left;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myDraft as $doc)
                                    <tr style="border-bottom:1px solid #eee;">
                                        <td style="padding:15px;">{{ Str::limit($doc->kolom2_kegiatan, 50) }}</td>
                                        <td style="padding:15px;">{{ $doc->kategori }}</td>
                                        <td style="padding:15px;">{{ $doc->updated_at->diffForHumans() }}</td>
                                        <td style="padding:15px;">
                                            <a href="{{ route('documents.show', $doc->id) }}" class="btn" style="background: #95a5a6; color:white; padding:8px 15px; border-radius:4px; text-decoration:none;"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                
                    <!-- All Content -->
                    <div id="tab_all" class="tab-content" style="display: none;">
                         <div class="documents-grid" id="documentsGrid">
                            @foreach($documents as $doc)
                                <div class="document-card" style="margin-bottom:20px;">
                                    <div class="doc-header" style="justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                         <div style="display: flex; gap: 10px;">
                                            <a href="{{ route('documents.show', $doc->id) }}" class="btn btn-view"><i class="fas fa-eye"></i> Detail</a>
                                         </div>
                                         <span class="badge-status">{{ $doc->status_label }}</span>
                                    </div>
                                    <div class="doc-meta">
                                        <div class="meta-item"><div class="meta-label">Kategori</div><div class="meta-value">{{ $doc->kategori }}</div></div>
                                        <div class="meta-item"><div class="meta-label">Tanggal</div><div class="meta-value">{{ $doc->created_at->format('d M Y') }}</div></div>
                                    </div>
                                </div>
                            @endforeach
                         </div>
                    </div>
                </div>

                <style>
                    .tab-btn {
                        padding: 15px 25px;
                        border: none;
                        background: none;
                        font-weight: 600;
                        color: #666;
                        cursor: pointer;
                        border-bottom: 3px solid transparent;
                        display: flex;
                        align-items: center;
                        gap: 8px;
                    }
                    .tab-btn.active {
                        color: #667eea;
                        border-bottom-color: #667eea;
                        background: white;
                    }
                    .badge-count {
                        background: #667eea;
                        color: white;
                        font-size: 10px;
                        padding: 2px 6px;
                        border-radius: 10px;
                    }
                    .empty-state {
                        text-align: center;
                        padding: 40px;
                        color: #ccc;
                    }
                    .empty-state i {
                        font-size: 40px;
                        margin-bottom: 15px;
                    }
                </style>

                <script>
                    function switchTab(tabId) {
                        document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
                        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
                        document.getElementById(tabId).style.display = 'block';
                        
                        // Set active button
                        const btn = document.querySelector(`button[onclick="switchTab('${tabId}')"]`);
                        if(btn) btn.classList.add('active');
                    }
                    
                    document.addEventListener("DOMContentLoaded", function() {
                        @if(session('open_tab'))
                            switchTab('{{ session('open_tab') }}');
                        @endif
                    });
                </script>
        </main>
    </div>

    <script>
        @php
            $documentsJson = $documents->map(function ($doc) {
                // Find relevant approval actions
                $lastRevision = $doc->approvals->where('action', 'revised')->sortByDesc('created_at')->first();
                $lastRejection = $doc->approvals->where('action', 'rejected')->sortByDesc('created_at')->first();
                $approval = $doc->approvals->where('action', 'approved')->sortByDesc('created_at')->first();

                // Determine map status for JS
                $jsStatus = match ($doc->status) {
                    'revision' => 'revision',
                    'approved' => 'approved',
                    'published' => 'approved',
                    'rejected' => 'rejected',
                    default => 'pending'
                };

                return [
                    'id' => $doc->id_document, // Or preserve ID string format? JS uses string ID for find. int is fine.
                    'title' => $doc->kolom2_kegiatan ?? 'Dokumen Tanpa Judul',
                    'category' => $doc->kategori,
                    'unit' => $doc->unit->nama_unit ?? '-',
                    'date' => $doc->created_at->translatedFormat('d M Y'),
                    'status' => $jsStatus,
                    'statusText' => $doc->status_label,
                    'riskLevel' => $doc->risk_level,

                    // Revision Data
                    'revisionBy' => $lastRevision ? ($lastRevision->approver->nama_user ?? '-') : '-',
                    'revisionDate' => $lastRevision ? $lastRevision->created_at->translatedFormat('d M Y') : '-',
                    'revisionComment' => $lastRevision ? $lastRevision->catatan : '-',
                    'reviewer' => $lastRevision ? ($lastRevision->approver->role_jabatan_name ?? '-') : '-',

                    // Approved Data
                    'approvedBy' => $approval ? ($approval->approver->nama_user ?? '-') : '-',
                    'approvedDate' => $doc->published_at ? $doc->published_at->translatedFormat('d M Y') : '-',

                    // Rejected Data
                    'rejectedBy' => $lastRejection ? ($lastRejection->approver->nama_user ?? '-') : '-',
                    'rejectedDate' => $lastRejection ? $lastRejection->created_at->translatedFormat('d M Y') : '-',
                    'rejectionReason' => $lastRejection ? $lastRejection->catatan : '-',
                ];
            });
        @endphp

        // Real data from database
        const myDocuments = @json($documentsJson);

        function renderDocuments(docs) {
            const grid = document.getElementById('documentsGrid');

            if (docs.length === 0) {
                grid.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <h3>Tidak ada dokumen</h3>
                        <p>Belum ada dokumen dengan status ini</p>
                    </div>
                `;
                return;
            }

            grid.innerHTML = docs.map(doc => {
                let statusBadge = '';
                let actionButtons = '';
                let alertSection = '';

                // Status badge
                switch (doc.status) {
                    case 'revision':
                        statusBadge = '<span class="badge-status status-revision">Perlu Revisi</span>';
                        alertSection = `
                            <div class="revision-alert">
                                <strong><i class="fas fa-exclamation-triangle"></i> Revisi dari ${doc.revisionBy} (${doc.reviewer}) - ${doc.revisionDate}</strong>
                                <div class="revision-comment">"${doc.revisionComment}"</div>
                            </div>
                        `;
                        actionButtons = `
                            <a href="{{ route('documents.create') }}?id=${doc.id}&mode=edit" class="btn btn-edit">
                                <i class="fas fa-edit"></i> Perbaiki Dokumen
                            </a>
                            <button onclick="showDocumentDetail('${doc.id}')" class="btn btn-view">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </button>
                        `;
                        break;
                    case 'approved':
                        statusBadge = '<span class="badge-status status-approved">Disetujui</span>';
                        actionButtons = `
                            <button onclick="window.location.href='{{ url('/user/documents') }}/${doc.id}'" class="btn btn-view">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </button>
                        `;
                        break;
                    case 'rejected':
                        statusBadge = '<span class="badge-status status-rejected">Ditolak</span>';
                        alertSection = `
                            <div class="revision-alert" style="background: #ffebee; border-color: #c62828;">
                                <strong style="color: #b71c1c;"><i class="fas fa-times-circle"></i> Ditolak oleh ${doc.rejectedBy} (${doc.rejectedDate})</strong>
                                <div class="revision-comment">"${doc.rejectionReason}"</div>
                            </div>
                        `;
                        actionButtons = `
                            <a href="{{ route('documents.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Buat Dokumen Baru
                            </a>
                            <button onclick="window.location.href='{{ url('/user/documents') }}/${doc.id}'" class="btn btn-view">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </button>
                        `;
                        break;
                }

                return `
                    <div class="document-card">
                        <div class="doc-header" style="justify-content: space-between; align-items: center; margin-bottom: 20px;">
                             <div style="display: flex; gap: 10px;">${actionButtons}</div>
                             ${statusBadge}
                        </div>

                        <div class="doc-meta">
                            <div class="meta-item">
                                <div class="meta-label">Kategori</div>
                                <div class="meta-value">${doc.category}</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Unit Kerja</div>
                                <div class="meta-value">${doc.unit}</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Tanggal Dibuat</div>
                                <div class="meta-value">${doc.date}</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Tingkat Risiko</div>
                                <div class="meta-value">${doc.riskLevel}</div>
                            </div>
                        </div>

                        ${alertSection}
                    </div>
                `;
            }).join('');
        }

        function filterByStatus(status) {
            // Update active tab
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');

            // Filter documents
            let filtered = myDocuments;
            if (status !== 'all') {
                filtered = myDocuments.filter(doc => doc.status === status);
            }

            renderDocuments(filtered);
        }

        // Modal functions
        function showDocumentDetail(docId) {
            const doc = myDocuments.find(d => d.id === docId);
            if (!doc) return;

            const modal = document.getElementById('documentModal');
            const modalBody = document.getElementById('modalBody');

            let statusBadge = '';
            let additionalSection = '';

            switch (doc.status) {
                case 'revision':
                    statusBadge = '<span class="badge-status status-revision">PERLU REVISI</span>';
                    additionalSection = `
                        <div class="detail-section">
                            <h3 class="detail-section-title">⚠️ Riwayat Revisi</h3>
                            <div style="background: #fff3cd; padding: 15px; border-radius: 6px; border-left: 4px solid #ffc107;">
                                <div style="font-size: 12px; color: #856404; margin-bottom: 8px;">
                                    <i class="fas fa-exclamation-triangle"></i> 
                                    <strong>Revisi dari ${doc.revisionBy} (${doc.reviewer}) - ${doc.revisionDate}</strong>
                                </div>
                                <div style="font-size: 13px; color: #666; font-style: italic; line-height: 1.6;">
                                    "${doc.revisionComment}"
                                </div>
                            </div>
                        </div>
                    `;
                    break;
                case 'approved':
                    statusBadge = '<span class="badge-status status-approved">DISETUJUI</span>';
                    additionalSection = `
                        <div class="detail-section">
                            <h3 class="detail-section-title">✅ Informasi Persetujuan</h3>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <div class="detail-label">Disetujui Oleh:</div>
                                    <div class="detail-value">${doc.approvedBy}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Tanggal Disetujui:</div>
                                    <div class="detail-value">${doc.approvedDate}</div>
                                </div>
                            </div>
                        </div>
                    `;
                    break;
                case 'rejected':
                    statusBadge = '<span class="badge-status status-rejected">DITOLAK</span>';
                    additionalSection = `
                        <div class="detail-section">
                            <h3 class="detail-section-title">❌ Informasi Penolakan</h3>
                            <div style="background: #ffebee; padding: 15px; border-radius: 6px; border-left: 4px solid #c62828;">
                                <div style="font-size: 12px; color: #b71c1c; margin-bottom: 8px;">
                                    <i class="fas fa-times-circle"></i> 
                                    <strong>Ditolak oleh ${doc.rejectedBy} - ${doc.rejectedDate}</strong>
                                </div>
                                <div style="font-size: 13px; color: #666; line-height: 1.6;">
                                    "${doc.rejectionReason}"
                                </div>
                            </div>
                        </div>
                    `;
                    break;
            }

            modalBody.innerHTML = `
                <div class="detail-section">
                    <h3 class="detail-section-title">📋 Informasi Dokumen</h3>
                    <div class="detail-grid">
        
                        <div class="detail-item">
                            <div class="detail-label">Status:</div>
                            <div class="detail-value">${statusBadge}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Kategori:</div>
                            <div class="detail-value">${doc.category}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Unit Kerja:</div>
                            <div class="detail-value">${doc.unit}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Tanggal Dibuat:</div>
                            <div class="detail-value">${doc.date}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Tingkat Risiko:</div>
                            <div class="detail-value"><strong style="color: #c41e3a;">${doc.riskLevel}</strong></div>
                        </div>
                    </div>
                </div>
                ${additionalSection}
            `;

            modal.classList.add('active');
        }

        function closeModal() {
            document.getElementById('documentModal').classList.remove('active');
        }

        // Close modal when clicking outside
        window.onclick = function (event) {
            const modal = document.getElementById('documentModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Initial render
        renderDocuments(myDocuments);
    </script>

    <!-- Document Detail Modal -->
    <div id="documentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Detail Dokumen</h2>
                <button class="modal-close" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
    </div>
</body>

</html>