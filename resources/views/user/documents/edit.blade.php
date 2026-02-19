<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form HIRADC | HIRADC System - PT Semen Padang</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Modern Design System - Consistent with Dashboard */
        :root {
            --primary-color: #c41e3a;
            --primary-hover: #a01729;
            --primary-dark: #9a1829;
            --bg-color: #f1f5f9;
            --sidebar-bg: #5b6fd8;
            --card-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-colored: 0 10px 25px -5px rgba(196, 30, 58, 0.15);
            --border-radius: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg-color);
            background-image:
                radial-gradient(at 0% 0%, rgba(196, 30, 58, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: #0f172a;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - Consistent with other pages */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 50;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        .logo-section {
            padding: 32px 24px;
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
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.2) 50%, transparent 100%);
        }

        .logo-circle {
            width: 90px;
            height: 90px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
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
            font-size: 18px;
            font-weight: 700;
            color: white;
            margin-bottom: 4px;
            letter-spacing: -0.02em;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .logo-subtext {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .nav-menu {
            flex: 1;
            padding: 24px 0;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
        }

        .nav-menu::-webkit-scrollbar {
            width: 6px;
        }

        .nav-menu::-webkit-scrollbar-track {
            background: transparent;
        }

        .nav-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 9999px;
        }

        .nav-item {
            padding: 16px 24px;
            margin: 4px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            color: rgba(255, 255, 255, 0.85);
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            position: relative;
            border-radius: 12px;
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
            border-radius: 0 8px 8px 0;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 18px;
            transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-item:hover i {
            transform: scale(1.1);
        }
        
        .badge {
            position: absolute;
            right: 20px;
            background: #c41e3a;
            color: white;
            font-size: 10px;
            padding: 4px 8px;
            border-radius: 10px;
            font-weight: 600;
        }

        .user-info-bottom {
            padding: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            background: transparent;
            position: relative;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: white;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5b6fd8;
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 15px;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 2px;
        }

        .user-role {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
        }

        .logout-btn {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%);
            padding: 32px 40px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 40;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, var(--primary-color) 50%, transparent 100%);
            opacity: 0.3;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s;
            padding: 8px 16px;
            border-radius: 10px;
        }

        .btn-back:hover {
            color: var(--primary-color);
            background: rgba(196, 30, 58, 0.05);
        }

        .content-area {
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Document Form Cards */
        .doc-card {
            background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .doc-card:hover {
            box-shadow: var(--shadow-colored);
        }

        .card-header {
            padding: 24px 30px;
            background: linear-gradient(to right, #fff1f2, #fff);
            border-bottom: 1px solid #fce7f3;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(196, 30, 58, 0.3);
        }

        .header-title h2 {
            font-size: 17px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.01em;
        }

        .header-title p {
            font-size: 13px;
            color: #64748b;
            margin-top: 4px;
            font-weight: 500;
        }

        .card-body {
            padding: 32px;
        }

        /* Grid Layouts */
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .form-grid-1 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }

        /* Form Controls - Modern Design */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 10px;
            letter-spacing: -0.01em;
        }

        .required {
            color: var(--primary-color);
            margin-left: 3px;
            font-weight: 700;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            color: #0f172a;
            font-weight: 500;
        }

        .form-control:hover {
            border-color: #cbd5e1;
        }

        .form-control:disabled,
        .form-control:read-only {
            background: #f8fafc;
            color: #64748b;
            cursor: not-allowed;
            border-color: #e2e8f0;
        }

        /* Select elements should have pointer cursor when enabled */
        select.form-control:not(:disabled) {
            cursor: pointer;
            background: white;
            color: #0f172a;
        }

        select.form-control:disabled {
            cursor: not-allowed;
            background: #f8fafc;
            color: #64748b;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.1);
        }

        .form-control::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
        }

        select.form-control {
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 18px;
            padding-right: 44px;
        }

        small {
            display: block;
            margin-top: 8px;
            color: #64748b;
            font-size: 13px;
            font-weight: 500;
        }

        /* Toggles & Checkboxes */
        .toggle-group { display:flex; gap:10px; padding:5px; background:#f3f4f6; border-radius:10px; width:fit-content; }
        .toggle-btn { padding:10px 20px; border:none; border-radius:8px; background:transparent; color:#6b7280; font-weight:600; font-size:13px; cursor:pointer; transition:0.2s; }
        .toggle-btn.active { background:white; color:var(--primary-color); box-shadow:0 2px 4px rgba(0,0,0,0.05); }
        
        .checkbox-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:16px; }
        .checkbox-card { border:1px solid #e2e8f0; border-radius:12px; padding:16px; transition:all 0.2s; cursor:pointer; display:flex; align-items:start; gap:12px; background:white; }
        .checkbox-card:hover { border-color:var(--primary-color); background:#fef2f3; box-shadow:0 2px 8px rgba(196,30,58,0.1); }
        .checkbox-card input[type="checkbox"] { margin-top:2px; accent-color:var(--primary-color); width:18px; height:18px; flex-shrink:0; cursor:pointer; }
        .checkbox-card label { cursor:pointer; font-size:14px; font-weight:500; color:#0f172a; line-height:1.5; }

        /* Risk Matrix */
        .risk-result-box { background:linear-gradient(135deg, #1e293b 0%, #334155 100%); color:white; padding:28px; border-radius:16px; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; box-shadow:0 10px 25px -5px rgba(0,0,0,0.2); }
        .risk-score { font-size:48px; font-weight:800; line-height:1; margin-bottom:12px; letter-spacing:-0.02em; }
        .risk-level { display:inline-block; padding:8px 20px; border-radius:24px; background:rgba(255,255,255,0.2); font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; backdrop-filter:blur(10px); }

        /* Action Bar */
        .action-bar { position:sticky; bottom:24px; background:white; padding:24px 32px; border-radius:20px; box-shadow:0 20px 40px rgba(0,0,0,0.15); margin-top:48px; display:flex; justify-content:space-between; align-items:center; border:1px solid #e2e8f0; z-index:30; }
        .action-buttons { display:flex; gap:12px; }
        .btn { padding:14px 28px; border-radius:12px; font-size:14px; font-weight:700; cursor:pointer; transition:all 0.2s cubic-bezier(0.4,0,0.2,1); border:none; display:inline-flex; align-items:center; gap:10px; text-decoration:none; letter-spacing:-0.01em; }
        .btn-secondary { background:#f1f5f9; color:#475569; border:1px solid #e2e8f0; }
        .btn-secondary:hover { background:#e2e8f0; color:#0f172a; border-color:#cbd5e1; }
        .btn-primary { background:linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%); color:white; box-shadow:0 4px 12px rgba(196,30,58,0.3); }
        .btn-primary:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(196,30,58,0.4); }
        
        .hidden { display:none; }
        .mt-4 { margin-top:1rem; }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                 <div style="display:flex; align-items:center; gap:20px;">
                    <a href="{{ route('documents.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <div style="height:24px; width:1px; background:#e5e7eb;"></div>
                    <h1>{{ $document->status == 'draft' ? 'Edit Form Draft' : 'Edit Form Revisi' }}</h1>
                </div>
            </div>

            <div class="content-area">
                
                @php
                    $lastRevision = $document->approvals->where('status', 'revision')->sortByDesc('created_at')->first();
                @endphp
                @if($lastRevision)
                    <div style="background:#fff7ed; border:1px solid #fed7aa; padding:15px; border-radius:8px; margin-bottom:24px; color:#9a3412;">
                        <strong><i class="fas fa-undo"></i> Catatan Revisi:</strong><br>
                        {{ $lastRevision->catatan }}
                    </div>
                @endif

                <form id="hiradcForm" action="{{ route('documents.update', $document->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" id="auto_probis_value" value="{{ isset($user->seksi->probis) ? $user->seksi->probis->nama_probis : (isset($user->unit->probis) ? $user->unit->probis->nama_probis : '') }}">

                    <!-- Alert for Partial Revision -->
                    @php
                        // Check which categories are locked (approved/published)
                        $isSheLocked = ($document->status_she == 'approved' || $document->status_she == 'published');
                        $isSecLocked = ($document->status_security == 'approved' || $document->status_security == 'published');

                        // Check which categories are in revision
                        $isSheRevision = ($document->status_she == 'revision');
                        $isSecRevision = ($document->status_security == 'revision');

                        $hiddenCount = 0;
                    @endphp

                    @if($isSheLocked || $isSecLocked || $isSheRevision || $isSecRevision)
                            <div class="alert alert-info" role="alert" style="margin-bottom: 30px; border-left: 5px solid #0ea5e9; background-color: #e0f2fe; color: #0369a1;">
                            <i class="fas fa-info-circle" style="margin-right: 8px;"></i>
                            <strong>Mode Revisi:</strong> Anda dapat mengubah data yang diperlukan. Pastikan semua perubahan disimpan sebelum mengirim ulang.
                        </div>
                    @endif

                    <div id="items-container">
                        @foreach($document->details as $index => $item)
                            <div class="doc-item item-loaded" data-index="{{ $index }}" style="margin-bottom: 30px;">
                                        <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">
                                        <div class="doc-card" style="border-left: 5px solid var(--primary-color);">
                                            <div class="card-header" style="justify-content: space-between; cursor: pointer;" onclick="toggleCollapse(this)">
                                                <div style="display: flex; align-items: center; gap: 15px;">
                                                    <div class="header-icon" style="background: var(--primary-color); color: white; border-radius: 50%;">
                                                        <span class="item-number">#{{ $index + 1 }}</span>
                                                    </div>
                                                    <div class="header-title">
                                                        <h2 style="color: #881337;">{{ $item->kolom2_kegiatan }}</h2>
                                                        <span class="item-summary" style="display:none;">(Klik untuk expand)</span>
                                                    </div>
                                                </div>
                                                <div class="header-actions" style="display: flex; gap: 10px;">
                                                    <button type="button" class="btn-collapse"><i class="fas fa-chevron-up transition-transform"></i></button>
                                                    <button type="button" class="btn-remove-item" onclick="removeItem(this); event.stopPropagation();" style="border:1px solid #fecaca; color:#ef4444;"><i class="fas fa-trash-alt"></i> Hapus</button>
                                                </div>
                                            </div>

                                            <div class="card-body collapsible-content">
                                                <!-- 1. Info -->
                                                <div style="margin-bottom:25px;">
                                                    <h3 style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                                                        <i class="fas fa-info-circle" style="color: var(--primary-color); margin-right: 8px;"></i>
                                                        BAGIAN 1: Informasi Dasar
                                                    </h3>
                                                    <div class="form-grid-2">
                                                        <div class="form-group"><label class="form-label">Proses Bisnis</label><input type="text" class="form-control" name="items[{{$index}}][kolom2_proses]" value="{{ $item->kolom2_proses }}" readonly style="background:#f8fafc; cursor:not-allowed;"></div>
                                                        <div class="form-group"><label class="form-label">Kegiatan</label><input type="text" class="form-control item-kegiatan-input" name="items[{{$index}}][kolom2_kegiatan]" value="{{ $item->kolom2_kegiatan }}" required oninput="updateSummary(this)"></div>
                                                        <div class="form-group"><label class="form-label">Lokasi</label><input type="text" class="form-control" name="items[{{$index}}][kolom3_lokasi]" value="{{ $item->kolom3_lokasi }}" required></div>

                                                        <div class="form-group">
                                                            <label class="form-label">Kategori</label>
                                                            <select class="form-control category-select" name="items[{{$index}}][kategori]" required onchange="updateConditions(this)">
                                                                @php
                                                                    // Filter kategori berdasarkan form type dokumen
                                                                    $isSheDoc = $document->hasSheContent();
                                                                    $isSecurityDoc = $document->hasSecurityContent();
                                                                @endphp
                                                                @if($isSheDoc)
                                                                    <option value="K3" {{ $item->kategori == 'K3' ? 'selected' : '' }}>K3 - Kesehatan & Keselamatan</option>
                                                                    <option value="KO" {{ $item->kategori == 'KO' ? 'selected' : '' }}>KO - Keselamatan Operasional</option>
                                                                    <option value="Lingkungan" {{ $item->kategori == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                                                @endif
                                                                @if($isSecurityDoc)
                                                                    <option value="Keamanan" {{ $item->kategori == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                                                                @endif
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label">Kondisi</label>
                                                            <select class="form-control condition-select" name="items[{{$index}}][kolom5_kondisi]" required>
                                                                 @php 
                                                                                                                                                                                                                                        $opts = match ($item->kategori) {
                                                                        'Lingkungan' => ['Normal', 'Abnormal', 'Emergency'],
                                                                        default => ['Rutin', 'Non-Rutin', 'Emergency']
                                                                    };
                                                                 @endphp
                                                                 @foreach($opts as $opt)
                                                                    <option value="{{ $opt }}" {{ $opt == $item->kolom5_kondisi ? 'selected' : '' }}>{{ $opt }}</option>
                                                                 @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 2. Identifikasi -->
                                                <div style="margin-bottom:25px;">
                                                    <h3 style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                                                        <i class="fas fa-exclamation-triangle" style="color: #f59e0b; margin-right: 8px;"></i>
                                                        BAGIAN 2: Identifikasi
                                                    </h3>

                                                    <!-- K3/KO: Bahaya -->
                                                    <div class="hazard-section k3-ko-field" data-category="K3,KO" style="{{ in_array($item->kategori, ['K3', 'KO']) ? '' : 'display:none;' }} background: #fffbeb; padding: 20px; border-radius: 8px; border: 1px solid #fcd34d; margin-bottom: 15px;">
                                                        <label class="form-label" style="font-weight: 600;">
                                                            <i class="fas fa-hard-hat" style="color: #f59e0b;"></i>
                                                            Kolom 6: POTENSI BAHAYA (K3/KO)
                                                        </label>
                                                        <div class="checkbox-grid">
                                                            @php $bahayaDetails = $item->kolom6_bahaya['details'] ?? []; @endphp
                                                            @foreach(['Bahaya Fisika', 'Bahaya Kimia', 'Bahaya Biologi', 'Bahaya Fisiologis/Ergonomi', 'Bahaya Psikologis', 'Bahaya dari Prilaku'] as $opt)
                                                                <label class="checkbox-card"><input type="checkbox" name="items[{{$index}}][kolom6_bahaya][]" value="{{$opt}}" {{ in_array($opt, $bahayaDetails) ? 'checked' : '' }}> {{$opt}}</label>
                                                            @endforeach
                                                        </div>
                                                        <div class="form-group mt-4">
                                                            <label class="form-label">Bahaya Lainnya (Manual)</label>
                                                            <input type="text" class="form-control" name="items[{{$index}}][bahaya_manual]" value="{{ $item->kolom6_bahaya['manual'] ?? '' }}">
                                                        </div>
                                                    </div>

                                                    <!-- Lingkungan: Aspek -->
                                                    <div class="lingkungan-field" data-category="Lingkungan" style="{{ $item->kategori == 'Lingkungan' ? '' : 'display:none;' }} background: #ecfdf5; padding: 20px; border-radius: 8px; border: 1px solid #10b981; margin-bottom: 15px;">
                                                        <label class="form-label" style="font-weight: 600;">
                                                            <i class="fas fa-leaf" style="color: #10b981;"></i>
                                                            Kolom 7: ASPEK LINGKUNGAN
                                                        </label>
                                                        <div class="checkbox-grid">
                                                            @php $aspekDetails = $item->kolom7_aspek_lingkungan['details'] ?? []; @endphp
                                                            @foreach(['Emisi ke udara', 'Pembuangan ke air', 'Pembuangan ke tanah', 'Penggunaan Bahan Baku dan SDA', 'Penggunaan energi', 'Paparan energi', 'Limbah'] as $opt)
                                                                <label class="checkbox-card"><input type="checkbox" name="items[{{$index}}][kolom7_aspek_lingkungan][]" value="{{$opt}}" {{ in_array($opt, $aspekDetails) ? 'checked' : '' }}> {{$opt}}</label>
                                                            @endforeach
                                                        </div>
                                                        <div class="form-group mt-4">
                                                            <label class="form-label">Aspek Lainnya (Manual)</label>
                                                            <input type="text" class="form-control" name="items[{{$index}}][aspek_manual]" value="{{ $item->kolom7_aspek_lingkungan['manual'] ?? '' }}">
                                                        </div>
                                                    </div>

                                                    <!-- Keamanan: Ancaman -->
                                                    <div class="keamanan-field" data-category="Keamanan" style="{{ $item->kategori == 'Keamanan' ? '' : 'display:none;' }} background: #fef2f2; padding: 20px; border-radius: 8px; border: 1px solid #ef4444; margin-bottom: 15px;">
                                                        <label class="form-label" style="font-weight: 600;">
                                                            <i class="fas fa-shield-alt" style="color: #ef4444;"></i>
                                                            Kolom 8: ANCAMAN KEAMANAN
                                                        </label>
                                                        <div class="checkbox-grid">
                                                            @php $ancamanDetails = $item->kolom8_ancaman['details'] ?? []; @endphp
                                                            @foreach(['Terorisme', 'Sabotase', 'Intimidasi', 'Pencurian', 'Perusakan aset'] as $opt)
                                                                <label class="checkbox-card"><input type="checkbox" name="items[{{$index}}][kolom8_ancaman][]" value="{{$opt}}" {{ in_array($opt, $ancamanDetails) ? 'checked' : '' }}> {{$opt}}</label>
                                                            @endforeach
                                                        </div>
                                                        <div class="form-group mt-4">
                                                            <label class="form-label">Ancaman Lainnya (Manual)</label>
                                                            <input type="text" class="form-control" name="items[{{$index}}][ancaman_manual]" value="{{ $item->kolom8_ancaman['manual'] ?? '' }}">
                                                        </div>
                                                    </div>

                                                    <!-- Kolom 9 Variants -->
                                                    <div class="form-group kolom9-k3ko-field" style="{{ in_array($item->kategori, ['K3', 'KO']) ? '' : 'display:none;' }}">
                                                        <label class="form-label">Kolom 9: RISIKO <span class="required">*</span></label>
                                                        <textarea class="form-control" name="items[{{$index}}][kolom9_risiko_k3ko]" rows="3">{{ $item->kolom9_risiko_k3ko ?? ($item->kategori == 'K3' || $item->kategori == 'KO' ? $item->kolom9_risiko : '') }}</textarea>
                                                    </div>

                                                    <div class="form-group kolom9-lingkungan-field" style="{{ $item->kategori == 'Lingkungan' ? '' : 'display:none;' }}">
                                                        <label class="form-label">Kolom 9: DAMPAK LINGKUNGAN <span class="required">*</span></label>
                                                        <textarea class="form-control" name="items[{{$index}}][kolom9_dampak_lingkungan]" rows="3">{{ $item->kolom9_dampak_lingkungan ?? ($item->kategori == 'Lingkungan' ? $item->kolom9_risiko : '') }}</textarea>
                                                    </div>

                                                    <div class="form-group kolom9-keamanan-field" style="{{ $item->kategori == 'Keamanan' ? '' : 'display:none;' }}">
                                                        <label class="form-label">Kolom 9: CELAH TIDAK AMAN <span class="required">*</span></label>
                                                        <textarea class="form-control" name="items[{{$index}}][kolom9_celah_keamanan]" rows="3">{{ $item->kolom9_celah_keamanan ?? ($item->kategori == 'Keamanan' ? $item->kolom9_risiko : '') }}</textarea>
                                                    </div>
                                                </div>


                                                <!-- BAGIAN 3: Pengendalian & Penilaian -->
                                                <div style="margin-bottom:25px;">
                                                    <h3 style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                                                        <i class="fas fa-shield-alt" style="color: #10b981; margin-right: 8px;"></i>
                                                        BAGIAN 3: Pengendalian & Penilaian Risiko Saat Ini
                                                    </h3>

                                                    <!-- Kolom 10-11: Pengendalian -->
                                                    <div class="form-group">
                                                        <label class="form-label">Kolom 10: Hirarki Pengendalian Risiko</label>
                                                        <div class="checkbox-grid hierarchy-checkboxes" style="grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));">
                                                            @php $hierarchyData = $item->kolom10_pengendalian['hierarchy'] ?? []; @endphp
                                                            <label class="checkbox-card"><input type="checkbox" name="items[{{$index}}][kolom10_pengendalian][]" value="Eliminasi" {{ in_array('Eliminasi', $hierarchyData) ? 'checked' : '' }} onchange="updateKolom11(this)"> Eliminasi</label>
                                                            <label class="checkbox-card"><input type="checkbox" name="items[{{$index}}][kolom10_pengendalian][]" value="Substitusi" {{ in_array('Substitusi', $hierarchyData) ? 'checked' : '' }} onchange="updateKolom11(this)"> Substitusi</label>
                                                            <label class="checkbox-card"><input type="checkbox" name="items[{{$index}}][kolom10_pengendalian][]" value="Rekayasa Teknik" {{ in_array('Rekayasa Teknik', $hierarchyData) ? 'checked' : '' }} onchange="updateKolom11(this)"> Rekayasa Teknik</label>
                                                            <label class="checkbox-card"><input type="checkbox" name="items[{{$index}}][kolom10_pengendalian][]" value="Pengendalian Administratif" {{ in_array('Pengendalian Administratif', $hierarchyData) ? 'checked' : '' }} onchange="updateKolom11(this)"> Pengendalian Administratif</label>
                                                            <label class="checkbox-card"><input type="checkbox" name="items[{{$index}}][kolom10_pengendalian][]" value="APD" {{ in_array('APD', $hierarchyData) ? 'checked' : '' }} onchange="updateKolom11(this)"> APD</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Kolom 11: Pengendalian yang Dilakukan <span class="required">*</span></label>
                                                        <small style="display: block; margin-bottom: 12px; color: #64748b;">
                                                            <i class="fas fa-info-circle"></i> Tambahkan penjelasan detail untuk setiap hierarki yang dipilih di atas.
                                                        </small>
                                                        <div class="kolom11-dynamic-container" style="background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 8px; padding: 16px; min-height: 200px;">
                                                            @php $existingControl = $item->kolom10_pengendalian['existing'] ?? $item->kolom11_existing ?? '-'; @endphp
                                                            @if($existingControl && $existingControl != '-')
                                                                <div style="padding: 12px; background: white; border-radius: 6px; border: 1px solid #e2e8f0;">
                                                                    <p style="margin: 0; white-space: pre-wrap;">{{ $existingControl }}</p>
                                                                </div>
                                                            @else
                                                                <div class="empty-state" style="padding: 40px; text-align: center; color: #94a3b8;">
                                                                    <i class="fas fa-hand-pointer" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                                                                    <p style="margin: 0;">Pilih hierarki pengendalian di  atas untuk mulai mengisi</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <input type="hidden" name="items[{{$index}}][kolom11_existing]" class="kolom11-hidden-input" value="{{ $existingControl }}">
                                                    </div>

                                                    <!-- Kolom 12-14: Penilaian Risiko Awal -->
                                                    <div style="background:#f8fafc; padding:20px; border-radius:12px; border:1px solid #e2e8f0; margin-top:20px;">
                                                        <h4 style="font-size:13px; font-weight:700; margin-bottom:15px; text-transform:uppercase; color:#334155;">Kolom 12-14: Penilaian Risiko Awal (dengan Pengendalian yang Ada)</h4>
                                                        <div style="display: flex; gap: 20px;">
                                                            <div style="flex:1; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                                                <div class="form-group">
                                                                    <label class="form-label">Kemungkinan (L)</label>
                                                                    <select class="form-control likelihood-select" name="items[{{$index}}][kolom12_kemungkinan]" required onchange="calculateItemRisk(this)">
                                                                        @foreach([1, 2, 3, 4, 5] as $v) <option value="{{$v}}" {{ $v == $item->kolom12_kemungkinan ? 'selected' : '' }}>{{$v}}</option> @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Konsekuensi (S)</label>
                                                                    <select class="form-control severity-select" name="items[{{$index}}][kolom13_konsekuensi]" required onchange="calculateItemRisk(this)">
                                                                        @foreach([1, 2, 3, 4, 5] as $v) <option value="{{$v}}" {{ $v == $item->kolom13_konsekuensi ? 'selected' : '' }}>{{$v}}</option> @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div style="flex: 0 0 160px; text-align:center;">
                                                                <label class="form-label">Tingkat Risiko</label>
                                                                <div class="risk-result-box" style="background:#1f2937; color:white; padding:15px; border-radius:8px;">
                                                                    <div class="risk-score display-score" style="font-size:24px;">{{ $item->kolom14_score }}</div>
                                                                    <span class="risk-level display-level" style="font-size:11px;">{{ $item->kolom14_level }}</span>
                                                                </div>
                                                                <input type="hidden" name="items[{{$index}}][kolom14_score]" class="input-score" value="{{ $item->kolom14_score }}">
                                                                <input type="hidden" name="items[{{$index}}][kolom14_level]" class="input-level" value="{{ $item->kolom14_level }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- BAGIAN 4: Legalitas & Signifikansi -->
                                                <div style="margin-bottom: 25px;">
                                                    <h3 style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                                                        <i class="fas fa-gavel" style="color: #3b82f6; margin-right: 8px;"></i>
                                                        BAGIAN 4: Legalitas & Signifikansi
                                                    </h3>
                                                    <div class="form-group">
                                                        <label class="form-label">Kolom 15: Peraturan/Regulasi</label>
                                                        <textarea class="form-control" name="items[{{$index}}][kolom15_regulasi]" rows="2">{{ $item->kolom15_regulasi }}</textarea>
                                                    </div>

                                                    <!-- Kolom 16: Lingkungan only -->
                                                    <div class="form-group lingkungan-only-field" style="{{ $item->kategori == 'Lingkungan' ? '' : 'display:none;' }}">
                                                        <label class="form-label">Kolom 16: Aspek Lingkungan Penting P/TP</label>
                                                        <div style="display:flex; gap:15px;">
                                                            <label class="control-radio">
                                                                <input type="radio" name="items[{{$index}}][kolom16_aspek]" value="P" {{ $item->kolom16_aspek == 'P' ? 'checked' : '' }}> Penting (P)
                                                            </label>
                                                            <label class="control-radio">
                                                                <input type="radio" name="items[{{$index}}][kolom16_aspek]" value="TP" {{ ($item->kolom16_aspek == 'TP' || !$item->kolom16_aspek) ? 'checked' : '' }}> Tidak Penting (TP)
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-grid-2">
                                                        <div class="form-group"><label class="form-label">Kolom 17: Peluang</label><textarea class="form-control" name="items[{{$index}}][kolom17_peluang]">{{ $item->kolom17_peluang }}</textarea></div>
                                                        <div class="form-group"><label class="form-label">Kolom 17: Risiko Tambahan</label><textarea class="form-control" name="items[{{$index}}][kolom17_risiko]">{{ $item->kolom17_risiko }}</textarea></div>
                                                    </div>
                                                </div>

                                                <!-- BAGIAN 5: Evaluasi & Program -->
                                                @php
                                                    // Calculate initial display state for Tolerance
                                                    $score = $item->kolom14_score ?? 0;
                                                    $level = $item->kolom14_level ?? 'Rendah';
                                                    $hasControls = !empty($item->kolom11_existing);
                                                    $tolerance = $item->kolom18_toleransi ?? 'Ya'; // Default

                                                    // Auto-calculate logic for display consistency (PHP side)
                                                    if ($score >= 10) {
                                                        $tolerance = 'Tidak';
                                                    } elseif ($score >= 5 && !$hasControls) {
                                                        $tolerance = 'Tidak';
                                                    }
                                                    // Or trust DB value:
                                                    $tolerance = $item->kolom18_toleransi ?? (($score >= 10 || ($score >= 5 && !$hasControls)) ? 'Tidak' : 'Ya');

                                                    // Styles
                                                    $tolBg = $tolerance == 'Tidak' ? '#fef2f2' : ($tolerance == 'Ya' ? '#ecfdf5' : 'white');
                                                    $tolBorder = $tolerance == 'Tidak' ? '#fca5a5' : ($tolerance == 'Ya' ? '#6ee7b7' : '#cbd5e1');
                                                    $tolIcon = $tolerance == 'Tidak' ? 'fa-exclamation-triangle' : ($tolerance == 'Ya' ? 'fa-check-circle' : 'fa-spinner');
                                                    $tolColor = $tolerance == 'Tidak' ? '#dc2626' : ($tolerance == 'Ya' ? '#10b981' : '#94a3b8');
                                                    $tolText = $tolerance == 'Tidak' ? 'Tidak - Perlu Program Pengendalian' : ($tolerance == 'Ya' ? 'Ya - Dapat Ditoleransi' : 'Menunggu Penilaian');
                                                @endphp

                                                <div class="bagian-5-section">
                                                    <h3 style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                                                        <i class="fas fa-check-double" style="color: #15803d; margin-right: 8px;"></i>
                                                        BAGIAN 5: Evaluasi & Program Pengendalian
                                                    </h3>
                                                    <div style="background:#f0fdf4; padding:20px; border-radius:12px; border:1px solid #bbf7d0;">

                                                        <!-- Column 18: Auto-Tolerance -->
                                                        <div class="form-group">
                                                            <label class="form-label">Kolom 18: Risiko Dapat Ditoleransi?</label>
                                                            <div class="tolerance-display" style="background: {{ $tolBg }}; padding: 16px; border-radius: 8px; border: 2px solid {{ $tolBorder }};">
                                                                <div style="display: flex; align-items: center; gap: 12px;">
                                                                    <div class="tolerance-icon" style="width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                                                        <i class="fas {{ $tolIcon }}" style="color: {{ $tolColor }};"></i>
                                                                    </div>
                                                                    <div style="flex: 1;">
                                                                        <div class="tolerance-value" style="font-size: 18px; font-weight: 700; margin-bottom: 4px;">{{ $tolText }}</div>
                                                                        <div class="tolerance-reason" style="font-size: 12px; color: #64748b;">Berdasarkan Skor Risiko & Pengendalian</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="items[{{$index}}][kolom18_toleransi]" class="tolerance-input" value="{{ $tolerance }}">
                                                            <input type="hidden" name="items[{{$index}}][kolom18_auto]" class="tolerance-auto" value="1">
                                                        </div>

                                                        <!-- Column 19: Rencana Pengendalian (Program Title) -->
                                                        <div class="kolom19-section" style="{{ $tolerance == 'Tidak' ? 'display:block;' : 'display:none;' }} margin-top: 20px;">
                                                            <div class="form-group">
                                                                <label class="form-label">Kolom 19: Rencana Pengendalian Tindak Lanjut <span class="required">*</span></label>
                                                                <textarea class="form-control kolom19-input" name="items[{{$index}}][kolom19_rencana]" rows="3" placeholder="Rencana/Judul Program..." {{ $tolerance == 'Tidak' ? 'required' : '' }}>{{ $item->kolom19_rencana }}</textarea>
                                                                <small class="text-muted"><i class="fas fa-info-circle"></i> Menjadi Judul Program PUK/PMK</small>
                                                            </div>
                                                        </div>

                                                        <!-- Risk After Control (Kolom 20-22) -->
                                                        <div class="risk-after-control-section" style="{{ $tolerance == 'Tidak' ? 'display:block;' : 'display:none;' }} margin-top: 25px;">
                                                            <div style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); padding: 20px; border-radius: 12px; border: 2px solid #93c5fd; margin-bottom: 20px;">
                                                                <h4 style="color: #1e40af; margin-bottom: 15px; font-size: 15px; font-weight: 700;"><i class="fas fa-chart-line"></i> Risiko Setelah Pengendalian Tindak Lanjut</h4>
                                                                <div style="display: flex; gap: 20px; align-items: flex-start;">
                                                                    <div style="flex:1; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Kolom 20: L</label>
                                                                            <select class="form-control likelihood-select-after" name="items[{{$index}}][kolom20_kemungkinan_lanjut]" onchange="calculateRiskAfterControl(this)">
                                                                                <option value="">--</option>
                                                                                @foreach([1, 2, 3, 4, 5] as $v) <option value="{{$v}}" {{ $v == $item->kolom20_kemungkinan_lanjut ? 'selected' : '' }}>{{$v}}</option> @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-label">Kolom 21: S</label>
                                                                            <select class="form-control severity-select-after" name="items[{{$index}}][kolom21_konsekuensi_lanjut]" onchange="calculateRiskAfterControl(this)">
                                                                                <option value="">--</option>
                                                                                @foreach([1, 2, 3, 4, 5] as $v) <option value="{{$v}}" {{ $v == $item->kolom21_konsekuensi_lanjut ? 'selected' : '' }}>{{$v}}</option> @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div style="flex: 0 0 160px; text-align:center;">
                                                                        @php
                                                                            $resScore = ($item->kolom20_kemungkinan_lanjut ?? 0) * ($item->kolom21_konsekuensi_lanjut ?? 0);
                                                                            $resLevel = $item->kolom22_level_lanjut ?? 'PENDING';
                                                                            $resBg = $resScore > 0 ? ($resScore >= 20 ? '#7f1d1d' : ($resScore >= 10 ? '#dc2626' : ($resScore >= 5 ? '#f59e0b' : '#10b981'))) : '#e2e8f0';
                                                                            $resColor = $resScore > 0 ? '#fff' : '#64748b';
                                                                        @endphp
                                                                        <label class="form-label">Level</label>
                                                                        <div class="risk-result-box-after" style="padding:15px; border-radius:8px; background: {{ $resBg }}; color: {{ $resColor }}; border: 1px solid #cbd5e1;">
                                                                            <div class="risk-score-after" style="font-size: 24px; font-weight: 800;">{{ $resScore > 0 ? $resScore : '-' }}</div>
                                                                            <span class="risk-level-after" style="font-size: 11px; font-weight: 700; text-transform: uppercase;">{{ $resLevel }}</span>
                                                                        </div>
                                                                        <input type="hidden" name="items[{{$index}}][kolom22_tingkat_risiko_lanjut]" class="input-score-after" value="{{ $resScore }}">
                                                                        <input type="hidden" name="items[{{$index}}][kolom22_level_lanjut]" class="input-level-after" value="{{ $resLevel }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Program Section -->
                                                        <div class="program-section" style="{{ $tolerance == 'Tidak' ? 'display:block;' : 'display:none;' }} margin-top: 25px;">
                                                            <div style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); padding: 20px; border-radius: 12px; border: 2px solid #fbbf24; margin-bottom: 20px;">
                                                                <h4 style="color: #92400e; margin-bottom: 15px; font-size: 15px; font-weight: 700;">
                                                                    <i class="fas fa-clipboard-list"></i> Program Pengendalian Lanjutan
                                                                </h4>
                                                                <div class="form-group">
                                                                    <label class="form-label">Jenis Program <span class="required">*</span></label>
                                                                    <select class="form-control program-type-select" name="items[{{$index}}][kolom19_program_type]">
                                                                        <option value="">-- Pilih --</option>
                                                                        <option value="PUK" class="option-puk" {{ $item->kolom19_program_type == 'PUK' ? 'selected' : '' }}>PUK - Program Unit Kerja</option>
                                                                        <option value="PMK" class="option-pmk" {{ $item->kolom19_program_type == 'PMK' ? 'selected' : '' }}>PMK - Program Manajemen Korporat</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- PUK/PMK Form Container -->
                                                            <div class="program-form-container" style="display:none;">
                                                                <div class="program-form" style="background: white; padding: 25px; border-radius: 12px; border: 2px solid #e5e7eb; margin-top: 20px;">
                                                                    <h5 class="program-form-title" style="color: #1e40af; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #dbeafe; font-size: 14px; font-weight: 700;">
                                                                        Form <span class="program-type-label">{{ $item->kolom19_program_type ?? 'PUK/PMK' }}</span>
                                                                    </h5>

                                                                    <!-- 1. Judul Program (Auto from Kolom 19) -->
                                                                    <div class="form-group">
                                                                        <label class="form-label">1. Judul Program <span class="required">*</span></label>
                                                                        <input type="text" class="form-control program-judul" readonly value="{{ $item->kolom19_rencana ?? '' }}" style="background: #f3f4f6; font-weight: 600; cursor: not-allowed;">
                                                                        <small class="text-muted"><i class="fas fa-link"></i> Diisi otomatis dari Kolom 19</small>
                                                                    </div>
                                                                        <div class="form-group">
                                                                            <label class="form-label">2. Tujuan <span class="required">*</span></label>
                                                                            <textarea class="form-control program-field" name="items[{{$index}}][program_tujuan]" rows="3" required>{{ $item->program_tujuan }}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-label">3. Sasaran <span class="required">*</span></label>
                                                                            <textarea class="form-control program-field" name="items[{{$index}}][program_sasaran]" rows="3" required>{{ $item->program_sasaran }}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-label">4. Penanggung Jawab</label>
                                                                            <input type="text" class="form-control program-field program-pj" name="items[{{$index}}][program_penanggung_jawab]" readonly value="{{ $item->program_penanggung_jawab ?? $user->unit->nama_unit ?? '' }}" style="background:#f8fafc; color:#64748b;">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-label">5. Uraian Revisi</label>
                                                                            <textarea class="form-control program-field" name="items[{{$index}}][program_uraian_revisi]" rows="3">{{ $item->program_uraian_revisi }}</textarea>
                                                                        </div>

                                                                        <!-- Table Program Kerja -->
                                                                        <div class="form-group">
                                                                            <label class="form-label" style="display:block; margin-bottom:10px;">6. Program Kerja <span class="required">*</span></label>
                                                                            <div class="program-kerja-scroll" style="overflow-x:auto; border:1px solid #e2e8f0; border-radius:8px;">
                                                                                <table class="table program-kerja-table table-bordered" style="margin-bottom:0; min-width:1400px; width:max-content;">
                                                                                    <thead>
                                                                                        <tr style="background: #5c7cfa; color: white; font-size: 12px; font-weight: 600;">
                                                                                            <th rowspan="2" style="width: 40px; text-align: center; vertical-align: middle; padding: 6px; border-color: #4c6ef5;">No</th>
                                                                                            <th rowspan="2" style="min-width: 150px; vertical-align: middle; padding: 6px; border-color: #4c6ef5;">Uraian Kegiatan</th>
                                                                                            <th rowspan="2" class="col-koordinator" style="min-width: 140px; vertical-align: middle; padding: 6px; border-color: #4c6ef5;">Koordinator</th>
                                                                                            <th rowspan="2" class="col-pelaksana" style="min-width: 140px; vertical-align: middle; padding: 6px; border-color: #4c6ef5;">Pelaksana</th>
                                                                                            <th colspan="12" style="text-align: center; padding: 6px; border-color: #4c6ef5;">Target (%)</th>
                                                                                            <th rowspan="2" class="col-anggaran" style="min-width: 120px; vertical-align: middle; display: none; padding: 6px; border-color: #4c6ef5;">Anggaran (Rp)</th>
                                                                                            <th rowspan="2" style="width: 40px; text-align: center; vertical-align: middle; padding: 6px; border-color: #4c6ef5;">Aksi</th>
                                                                                        </tr>
                                                                                        <tr style="background: #748ffc; color: white; font-size: 11px;">
                                                                                            @for($i = 1; $i <= 12; $i++)
                                                                                                <th style="align: center; padding: 4px; width: 40px; min-width: 40px; border-color: #5c7cfa;">{{ $i }}</th>
                                                                                            @endfor
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody class="program-kerja-tbody">
                                                                                        @php
                                                                                            $programKerja = $item->program_kerja ?? [];
                                                                                            $isPMK = $item->kolom19_program_type === 'PMK';
                                                                                        @endphp
                                                                                        @if(count($programKerja) > 0)
                                                                                            @foreach($programKerja as $pkKey => $pk)
                                                                                                <tr>
                                                                                                    <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
                                                                                                    <td style="padding: 0;">
                                                                                                        <textarea class="form-control" name="items[{{$index}}][program_kerja][{{$pkKey}}][uraian]" required style="border:none; width:100%; padding:6px; resize:vertical;" rows="2">{{ $pk['uraian'] ?? '' }}</textarea>
                                                                                                    </td>

                                                                                                    {{-- Koordinator (Hide if PMK) --}}
                                                                                                    <td class="col-koordinator" style="padding: 0; display: {{ $isPMK ? 'none' : 'table-cell' }};">
                                                                                                        <select class="form-select" name="items[{{$index}}][program_kerja][{{$pkKey}}][koordinator]" style="border:none; width:100%; padding:6px;">
                                                                                                            <option value="" disabled {{ empty($pk['koordinator']) ? 'selected' : '' }}>-- Pilih --</option>
                                                                                                            @foreach($pukKoordinatorUsers as $u)
                                                                                                                <option value="{{ $u['nama_user'] }}" {{ ($pk['koordinator'] ?? '') == $u['nama_user'] ? 'selected' : '' }}>{{ $u['nama_user'] }}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </td>

                                                                                                    {{-- Pelaksana / PIC --}}
                                                                                                    <td class="col-pelaksana" style="padding: 0;">
                                                                                                        @if($isPMK)
                                                                                                            <select class="form-select" name="items[{{$index}}][program_kerja][{{$pkKey}}][pelaksana]" style="border:none; width:100%; padding:6px;">
                                                                                                                <option value="" disabled {{ empty($pk['pelaksana']) ? 'selected' : '' }}>-- Pilih --</option>
                                                                                                                @foreach($pmkPicUsers as $u)
                                                                                                                    <option value="{{ $u['nama_user'] }}" {{ ($pk['pelaksana'] ?? '') == $u['nama_user'] ? 'selected' : '' }}>{{ $u['nama_user'] }}</option>
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                        @else
                                                                                                            <select class="form-select" name="items[{{$index}}][program_kerja][{{$pkKey}}][pelaksana]" style="border:none; width:100%; padding:6px;">
                                                                                                                <option value="" disabled {{ empty($pk['pelaksana']) ? 'selected' : '' }}>-- Pilih --</option>
                                                                                                                @foreach($pukPelaksanaUsers as $u)
                                                                                                                    <option value="{{ $u['nama_user'] }}" {{ ($pk['pelaksana'] ?? '') == $u['nama_user'] ? 'selected' : '' }}>{{ $u['nama_user'] }}</option>
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                        @endif
                                                                                                    </td>

                                                                                                    {{-- Targets 1-12 --}}
                                                                                                    @for($t = 0; $t < 12; $t++)
                                                                                                        <td style="border: 1px solid #d1d5db; padding: 0; min-width: 35px;">
                                                                                                            <input type="number" class="form-control target-input" 
                                                                                                                   name="items[{{$index}}][program_kerja][{{$pkKey}}][target][{{$t}}]" 
                                                                                                                   value="{{ $pk['target'][$t] ?? '' }}"
                                                                                                                   min="0" placeholder="-"
                                                                                                                   style="border:none; width:100%; text-align:center; padding:4px; font-size:11px;">
                                                                                                        </td>
                                                                                                    @endfor

                                                                                                    {{-- Anggaran (Hide if PUK) --}}
                                                                                                    <td class="col-anggaran" style="padding: 0; display: {{ $isPMK ? 'table-cell' : 'none' }};">
                                                                                                        <input type="number" class="form-control" name="items[{{$index}}][program_kerja][{{$pkKey}}][anggaran]" value="{{ $pk['anggaran'] ?? '' }}" placeholder="0" style="border:none; width:100%; padding:6px;">
                                                                                                    </td>

                                                                                                    <td style="text-align: center; vertical-align: middle;">
                                                                                                        <button type="button" onclick="this.closest('tr').remove(); renumberProgramKerja(this)" style="color:red; background:none; border:none;"><i class="fas fa-trash"></i></button>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addProgramKerjaRow(this)" style="background:#6366f1; color:white; border:none; padding:8px 16px; border-radius:6px;"><i class="fas fa-plus"></i> Tambah Baris Program Kerja</button>
                                                                        </div>
                                                                    </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-4 mb-4">
                        <button type="button" class="btn btn-secondary" onclick="addItem()" style="border: 2px dashed #94a3b8; background: #f8fafc; color: #475569; padding: 12px 24px; font-weight: 600; width: 100%; max-width: 400px; border-radius: 12px; transition: all 0.2s;">
                            <i class="fas fa-plus-circle" style="margin-right: 8px;"></i> Tambah Kegiatan Baru
                        </button>
                    </div>



                    <div class="form-footer" style="padding: 20px; background: #f8fafc; border-top: 1px solid #e2e8f0; border-radius: 0 0 12px 12px; margin-top: 30px; display: flex; justify-content: space-between; align-items: flex-end;">
                        
                        <div style="flex: 1; max-width: 60%; margin-right: 20px;">
                            @if(($document->status_she == 'revision' || $document->status_security == 'revision'))
                                <label for="revision_comment" style="display: block; font-weight: 600; color: #475569; margin-bottom: 5px;">Catatan Perbaikan (Wajib untuk Submit):</label>
                                <textarea name="revision_comment" id="revision_comment" class="form-control" rows="2" placeholder="Jelaskan perbaikan yang dilakukan..." style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 10px;"></textarea>
                                @error('revision_comment')
                                    <div style="color: #ef4444; font-size: 0.875rem; margin-top: 4px;">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- Revision Comment Field (Only visible if status is revision) --}}
                        @if($document->status == 'revision' || $document->status_she == 'revision' || $document->status_security == 'revision')
                        <div style="flex: 1; margin-right: 15px;">
                            <textarea name="revision_comment" 
                                      class="form-control" 
                                      placeholder="Tuliskan catatan perbaikan disini (Wajib diisi untuk submit revisi)..." 
                                      rows="2"
                                      style="border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; resize: none;"></textarea>
                        </div>
                        @endif

                        <div style="display: flex; align-items: center; gap: 12px;">
                            <input type="hidden" name="action" id="action_input" value="save_only">
                            
                            <button type="button" class="btn btn-primary" id="btnSubmit" onclick="confirmSubmit()" 
                                    style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none; padding: 12px 32px; border-radius: 10px; font-weight: 700; font-size: 15px; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3); transition: all 0.2s;">
                                <i class="fas fa-paper-plane" style="margin-right: 8px;"></i> Submit Revisi
                            </button>

                            <button type="button" class="btn btn-primary" id="btnSave" onclick="confirmSave()" 
                                    style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; padding: 12px 32px; border-radius: 10px; font-weight: 700; font-size: 15px; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3); transition: all 0.2s;">
                                <i class="fas fa-save" style="margin-right: 8px;"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>

    <script>
        function validateAndSubmit(actionType) {
            console.log('validateAndSubmit called with actionType:', actionType); // DEBUG
            // Set Action Input
            const actionInput = document.getElementById('action_input');
            if (actionInput) actionInput.value = actionType;
            const isDraft = actionType === 'draft' || actionType === 'save_only';
            console.log('isDraft:', isDraft); // DEBUG

            // Revision Comment Logic (Specific to Edit)
            const isRevision = @json(($document->status == 'revision' || $document->status_she == 'revision' || $document->status_security == 'revision'));
            
            // If submitting a Revision, enforce comment check
            // "save_only" skips this check.
            
            const commentField = document.querySelector('textarea[name="revision_comment"]');
            if (!isDraft && actionType === 'submit' && isRevision) {
                 if (commentField && !commentField.value.trim()) {
                     Swal.fire({
                        icon: 'warning',
                        title: 'Catatan Wajib Diisi',
                        text: 'Mohon isi catatan perbaikan pada kolom di samping tombol submit sebelum mengirim revisi.',
                        confirmButtonColor: '#c41e3a'
                     });
                     commentField.focus();
                     commentField.style.borderColor = '#c41e3a';
                     return false;
                 }
            }

            try {
                let isValid = true;
                let errorMsg = '';

                // Note: Title is not editable in Edit Form usually, so valid by default.

                // 1. Check if at least one item exists
                const items = document.querySelectorAll('.doc-item');
                if (isValid && items.length === 0) {
                    isValid = false;
                    errorMsg = 'Minimal harus ada 1 kegiatan.';
                }

                // 2. Item Validation
                if (isValid) {
                    items.forEach((item, idx) => {
                        const kegiatanInput = item.querySelector('.item-kegiatan-input');
                        const kegiatan = kegiatanInput?.value || 'Item #' + (idx + 1);

                        // Rule: Draft ONLY requires "Kegiatan". Submit requires "Kegiatan" too.
                        if (isValid && (!kegiatanInput || !kegiatanInput.value.trim())) {
                            isValid = false;
                            errorMsg = `Kegiatan belum diisi pada Item #${idx + 1}`;
                            const content = item.querySelector('.collapsible-content');
                            if (content && content.style.display === 'none') {
                                toggleCollapse(item.querySelector('.card-header'));
                            }
                            item.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }

                        // STRICT Checks (Only if NOT Draft/SaveOnly)
                        if (isValid && !isDraft) {
                            const scoreInput = item.querySelector('.input-score');
                            const resScoreInput = item.querySelector('.input-res-score');
                            const s = scoreInput ? scoreInput.value : 0;
                            const resS = resScoreInput ? resScoreInput.value : 0;
                            const kondisi = item.querySelector('.condition-select')?.value;

                            // Validate Conditions
                            if (!kondisi) {
                                isValid = false;
                                errorMsg = `Kondisi (Rutin/Non-Rutin/dll) belum dipilih untuk: ${kegiatan}`;
                                const content = item.querySelector('.collapsible-content');
                                if (content && content.style.display === 'none') {
                                    toggleCollapse(item.querySelector('.card-header'));
                                }
                                item.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }

                            // Validate Initial Risk
                            if (isValid && (!s || s == 0)) {
                                isValid = false;
                                errorMsg = `Penilaian risiko awal belum lengkap untuk: ${kegiatan}`;
                                const box = item.querySelector('.risk-result-box');
                                if (box) {
                                    box.style.border = '2px solid #ef4444';
                                    setTimeout(() => box.style.border = '', 3000);
                                }
                            }
                        }
                    });
                }

                if (!isValid) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validasi Gagal',
                        text: errorMsg,
                        confirmButtonColor: '#c41e3a'
                    });
                    return false;
                }

                // Show Loading
                // Try finding btnSubmit first (legacy), then btnSave
                const btn = document.getElementById('btnSubmit') || document.getElementById('btnSave');
                const originalText = btn ? btn.innerHTML : 'Submit';
                if(btn) {
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                    btn.disabled = true;
                }

                // Submit
                const form = document.getElementById('hiradcForm');
                if (isDraft) {
                    // Bypass HTML5 validation for draft/save_only
                    form.noValidate = true;
                    form.submit();
                } else {
                    form.noValidate = false;
                    if (form.reportValidity()) {
                        form.submit();
                    } else {
                        if(btn) {
                            btn.innerHTML = originalText;
                            btn.disabled = false;
                        }
                    }
                }

            } catch (e) {
                console.error(e);
                Swal.fire('System Error', e.message, 'error');
                const btn = document.getElementById('btnSubmit') || document.getElementById('btnSave');
                if (btn) btn.disabled = false;
            }
        }
    </script>
            </div>
        </main>
    </div>

    <!-- ITEM TEMPLATE (Hidden) -->
    <template id="item-template">
        @include('user.documents.partials.item-form-template', ['index' => '{index}'])
    </template>

    <!-- PUK/PMK Form Template -->
    <template id="program-form-template">
        @include('user.documents.partials.program-form-template')
    </template>

    <script>
        let itemIndex = {{ $document->details->count() }};
        const autoProbis = document.getElementById('auto_probis_value').value;

        const categories = {
            'K3': { label: 'K3', conditions: ['Rutin', 'Non-Rutin', 'Emergency'] },
            'KO': { label: 'KO', conditions: ['Rutin', 'Non-Rutin', 'Emergency'] },
            'Lingkungan': { label: 'Lingkungan', conditions: ['Normal', 'Abnormal', 'Emergency'] },
            'Keamanan': { label: 'Keamanan', conditions: ['Emergency'] }
        };

        // Note: 'hazards' array logic is removed in favor of create.blade.php's explicit HTML structure logic

        function addItem() {
            // Collapse all existing first
            document.querySelectorAll('.doc-item').forEach(el => collapseItem(el));

            const template = document.getElementById('item-template').innerHTML;
            const container = document.getElementById('items-container');
            
            let html = template.replace(/{index}/g, itemIndex)
                               .replace(/{displayIndex}/g, itemIndex + 1);
            
            const div = document.createElement('div');
            div.innerHTML = html;
            const itemNode = div.firstElementChild;
            
            const probisInput = itemNode.querySelector('.probis-input');
            if(probisInput) probisInput.value = autoProbis;

            container.appendChild(itemNode);
            itemNode.scrollIntoView({ behavior: 'smooth', block: 'center' });

            itemIndex++;
            updateItemNumbers();
        }

        function removeItem(btn) {
            Swal.fire({
                title: 'Hapus Item?',
                text: "Data item ini akan dihapus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('.doc-item').remove();
                    updateItemNumbers();
                }
            });
        }

        function toggleCollapse(header) {
            const item = header.closest('.doc-item');
            const content = item.querySelector('.collapsible-content');
            const icon = item.querySelector('.btn-collapse i');
            const summary = item.querySelector('.item-summary');
            
            if (!content || !icon) return; 

            if (content.style.display === 'none') {
                content.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
                if(summary) summary.style.display = 'none';
                item.classList.remove('collapsed');
            } else {
                content.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                if(summary) summary.style.display = 'inline';
                item.classList.add('collapsed');
            }
        }

         function collapseItem(item) {
             const content = item.querySelector('.collapsible-content');
             const icon = item.querySelector('.btn-collapse i');
             const summary = item.querySelector('.item-summary');
             
             if(content && icon) {
                content.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                if(summary) summary.style.display = 'inline';
                item.classList.add('collapsed');
             }
        }

        function updateSummary(input) {
            const item = input.closest('.doc-item');
            const summary = item.querySelector('.item-summary');
            if(input.value) {
                const limit = 40;
                let txt = input.value;
                if(txt.length > limit) txt = txt.substring(0, limit) + '...';
                summary.textContent = `(${txt})`;
            } else {
                summary.textContent = '(Klik untuk expand)';
            }
        }

        function updateItemNumbers() {
            const items = document.querySelectorAll('.doc-item');
            items.forEach((item, idx) => {
                const numBadge = item.querySelector('.item-number');
                if (numBadge) numBadge.textContent = '#' + (idx + 1);
            });
            updateRemoveButtons();
        }

        function updateRemoveButtons() {
            const buttons = document.querySelectorAll('.btn-remove-item');
            if (buttons.length === 1) buttons[0].style.display = 'none'; 
            else buttons.forEach(b => b.style.display = 'block');
        }

        function updateConditions(select) {
            const item = select.closest('.doc-item');
            const condSelect = item.querySelector('.condition-select');
            const cat = select.value;
            
            const k3KoField = item.querySelector('.k3-ko-field');
            const lingkunganField = item.querySelector('.lingkungan-field');
            const keamananField = item.querySelector('.keamanan-field');
            const lingkunganOnlyField = item.querySelector('.lingkungan-only-field');

            const kolom9K3KO = item.querySelector('.kolom9-k3ko-field');
            const kolom9Lingkungan = item.querySelector('.kolom9-lingkungan-field');
            const kolom9Keamanan = item.querySelector('.kolom9-keamanan-field');

            // PRESERVE existing selected value before clearing
            const currentValue = condSelect.value;

            condSelect.innerHTML = '<option value="">-- Pilih --</option>';

            // 1. Reset/Hide All
            if (k3KoField) k3KoField.style.display = 'none';
            if (lingkunganField) lingkunganField.style.display = 'none';
            if (keamananField) keamananField.style.display = 'none';
            if (lingkunganOnlyField) lingkunganOnlyField.style.display = 'none';

            if (kolom9K3KO) {
                kolom9K3KO.style.display = 'none';
                kolom9K3KO.querySelector('textarea')?.removeAttribute('required');
            }
            if (kolom9Lingkungan) {
                kolom9Lingkungan.style.display = 'none';
                kolom9Lingkungan.querySelector('textarea')?.removeAttribute('required');
            }
            if (kolom9Keamanan) {
                kolom9Keamanan.style.display = 'none';
                kolom9Keamanan.querySelector('textarea')?.removeAttribute('required');
            }

            // 3. Populate Conditions
            if (categories[cat]) {
                categories[cat].conditions.forEach(c => {
                    const opt = document.createElement('option');
                    opt.value = c;
                    opt.textContent = c;
                    // RESTORE selected state if this was the previous value
                    if (c === currentValue) {
                        opt.selected = true;
                    }
                    condSelect.appendChild(opt);
                });

                // 4. Show Specific
                if (cat === 'K3' || cat === 'KO') {
                     if (k3KoField) {
                         k3KoField.style.display = 'block';
                         k3KoField.querySelectorAll('input').forEach(i => i.disabled = false);
                     }
                     if (kolom9K3KO) {
                         kolom9K3KO.style.display = 'block';
                         kolom9K3KO.querySelector('textarea')?.setAttribute('required', 'required');
                     }
                     
                     if (lingkunganField) lingkunganField.querySelectorAll('input').forEach(i => i.disabled = true);
                     if (keamananField) keamananField.querySelectorAll('input').forEach(i => i.disabled = true);

                } else if (cat === 'Lingkungan') {
                     if (lingkunganField) {
                         lingkunganField.style.display = 'block';
                         lingkunganField.querySelectorAll('input').forEach(i => i.disabled = false);
                     }
                     if (lingkunganOnlyField) lingkunganOnlyField.style.display = 'block';
                     
                     if (kolom9Lingkungan) {
                         kolom9Lingkungan.style.display = 'block';
                         kolom9Lingkungan.querySelector('textarea')?.setAttribute('required', 'required');
                     }

                     if (k3KoField) k3KoField.querySelectorAll('input').forEach(i => i.disabled = true);
                     if (keamananField) keamananField.querySelectorAll('input').forEach(i => i.disabled = true);

                } else if (cat === 'Keamanan') {
                     if (keamananField) {
                         keamananField.style.display = 'block';
                         keamananField.querySelectorAll('input').forEach(i => i.disabled = false);
                     }

                     if (kolom9Keamanan) {
                         kolom9Keamanan.style.display = 'block';
                         kolom9Keamanan.querySelector('textarea')?.setAttribute('required', 'required');
                     }

                     if (k3KoField) k3KoField.querySelectorAll('input').forEach(i => i.disabled = true);
                     if (lingkunganField) lingkunganField.querySelectorAll('input').forEach(i => i.disabled = true);
                }
            }
        }

        function calculateItemRisk(el) {
            const item = el.closest('.doc-item');
            const likelihood = parseInt(item.querySelector('.likelihood-select').value) || 0;
            const severity = parseInt(item.querySelector('.severity-select').value) || 0;

            const score = likelihood * severity;
            const scoreEl = item.querySelector('.display-score');
            const levelEl = item.querySelector('.display-level');
            const inputScore = item.querySelector('.input-score');
            const inputLevel = item.querySelector('.input-level');
            const riskBox = item.querySelector('.risk-result-box');

            scoreEl.textContent = score || '-';
            inputScore.value = score;

            let level = 'Rendah';
            let bg = '#e2e8f0'; 
            let textColor = '#64748b';

            if (score > 0) {
                textColor = '#fff';
                if (score >= 15) { level = 'Tinggi'; bg = '#dc2626'; }
                else if (score >= 8) { level = 'Sedang'; bg = '#f59e0b'; }
                else { level = 'Rendah'; bg = '#10b981'; }
            }

            levelEl.textContent = (score > 0) ? level : 'PENDING';
            inputLevel.value = level;
            riskBox.style.background = bg;
            riskBox.style.color = textColor;

            // Trigger auto-tolerance calculation
            calculateAutoTolerance(item, score, level);
        }

        // calculateItemResidual Removed


        // validateForm Removed - Logic moved to validateAndSubmit

        document.addEventListener('DOMContentLoaded', () => {
             const loadedItems = document.querySelectorAll('.item-loaded');
             if(loadedItems.length === 0) {
                 addItem();
             } else {
                 loadedItems.forEach(item => {
                     // Initialize category-specific fields FIRST
                     const categorySelect = item.querySelector('.category-select');
                     const conditionSelect = item.querySelector('.condition-select');
                     
                     // Only call updateConditions if kondisi doesn't have a value yet
                     // This prevents clearing Blade-rendered selected values
                     if(categorySelect && categorySelect.value && (!conditionSelect || !conditionSelect.value)) {
                         updateConditions(categorySelect);
                     }
                     
                     // Init calculations
                     const lSelect = item.querySelector('.likelihood-select');
                     if(lSelect) calculateItemRisk(lSelect);
                     
                     // calculateItemResidual call removed

                     
                     if(item.dataset.index > 0) collapseItem(item);
                 });
             }
             updateRemoveButtons();
        });
        
        document.addEventListener('keydown', function(event) {
            if(event.key === 'Enter' && event.target.tagName !== 'TEXTAREA') {
                event.preventDefault();
            }
        });

        // ===== KOLOM 11 DYNAMIC HIERARCHY FUNCTIONS =====
        
        /**
         * Update Kolom 11 with dynamic hierarchy sections
         * Creates protected labels and editable textareas for each hierarchy
         */
        function updateKolom11(checkbox) {
            const item = checkbox.closest('.doc-item');
            const container = item.querySelector('.kolom11-dynamic-container');
            const hiddenInput = item.querySelector('.kolom11-hidden-input');
            const checkboxes = item.querySelectorAll('.hierarchy-checkboxes input[type="checkbox"]');

            if (!container) return;

            // Store existing content before clearing
            const existingData = {};
            container.querySelectorAll('.hierarchy-textarea').forEach(textarea => {
                const hierarchy = textarea.dataset.hierarchy;
                if (hierarchy && textarea.value.trim()) {
                    existingData[hierarchy] = textarea.value.trim();
                }
            });

            // Get currently checked values in order
            const checkedValues = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            // Clear container
            container.innerHTML = '';

            // If no checkboxes checked, show empty state
            if (checkedValues.length === 0) {
                container.innerHTML = `
                    <div class="empty-state" style="padding: 40px; text-align: center; color: #94a3b8;">
                        <i class="fas fa-hand-pointer" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                        <p style="margin: 0;">Pilih hierarki pengendalian di atas untuk mulai mengisi</p>
                    </div>
                `;
                hiddenInput.value = '';
                return;
            }

            // Create section for each checked hierarchy
            checkedValues.forEach((value, index) => {
                const section = document.createElement('div');
                section.className = 'hierarchy-section';
                section.style.marginBottom = index < checkedValues.length - 1 ? '20px' : '0';

                // Protected header (cannot be edited)
                const header = document.createElement('div');
                header.className = 'hierarchy-header';
                header.style.cssText = `
                    font-size: 14px;
                    font-weight: 600;
                    color: #1e293b;
                    margin-bottom: 8px;
                    padding: 10px 14px;
                    background: white;
                    border-left: 4px solid #3b82f6;
                    border-radius: 6px;
                    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
                `;
                header.innerHTML = `<i class="fas fa-shield-alt" style="color: #3b82f6; margin-right: 8px;"></i>${index + 1}. ${value}:`;

                // Editable textarea
                const textarea = document.createElement('textarea');
                textarea.className = 'form-control hierarchy-textarea';
                textarea.dataset.hierarchy = value;
                textarea.rows = 3;
                textarea.placeholder = `Tambahkan penjelasan detail untuk ${value}...`;
                textarea.style.cssText = `
                    border: 1px solid #e2e8f0;
                    border-radius: 6px;
                    padding: 12px;
                    font-size: 14px;
                    line-height: 1.6;
                    resize: vertical;
                    transition: all 0.2s ease;
                `;

                // Restore existing content if available
                if (existingData[value]) {
                    textarea.value = existingData[value];
                }

                // Focus/blur effects
                textarea.addEventListener('focus', function() {
                    this.style.borderColor = '#3b82f6';
                    this.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.1)';
                });
                textarea.addEventListener('blur', function() {
                    this.style.borderColor = '#e2e8f0';
                    this.style.boxShadow = 'none';
                });

                // Update hidden input on change
                textarea.addEventListener('input', function() {
                    updateHiddenInput(item);
                });

                section.appendChild(header);
                section.appendChild(textarea);
                container.appendChild(section);
            });

            // Initial update of hidden input
            updateHiddenInput(item);
        }

        /**
         * Update hidden input with combined data from all hierarchy textareas
         */
        function updateHiddenInput(item) {
            const textareas = item.querySelectorAll('.hierarchy-textarea');
            const hiddenInput = item.querySelector('.kolom11-hidden-input');

            if (!hiddenInput) return;

            let combinedText = '';
            textareas.forEach((textarea, index) => {
                const hierarchy = textarea.dataset.hierarchy;
                const content = textarea.value.trim();

                if (index > 0) combinedText += '\n\n';
                combinedText += `${index + 1}. ${hierarchy}:`;

                if (content) {
                    combinedText += `\n   ${content}`;
                }
            });

            hiddenInput.value = combinedText;
        }


        /**
         * Parse text content into hierarchy sections
         * Returns object with hierarchy as key and content as value
         */
        function parseKolom11Text(text) {
            const sections = {};
            const hierarchies = ['Eliminasi', 'Substitusi', 'Rekayasa Teknik', 'Pengendalian Administratif', 'APD'];
            
            if (!text || text.trim() === '') return sections;
            
            hierarchies.forEach(hierarchy => {
                // Find pattern: "N. Hierarchy:" followed by content until next numbered item or end
                const escapedHierarchy = hierarchy.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                const regex = new RegExp(`\\d+\\.\\s*${escapedHierarchy}:\\s*\\n([\\s\\S]*?)(?=\\n\\d+\\.|$)`, 'i');
                const match = text.match(regex);
                
                if (match) {
                    sections[hierarchy] = match[1].trim();
                }
            });
            
            return sections;
        }

        /**
         * Initialize Kolom 11 for existing items on page load
         */
        function initializeKolom11ForExistingItems() {
            document.querySelectorAll('.doc-item').forEach(item => {
                const container = item.querySelector('.kolom11-dynamic-container');
                const hiddenInput = item.querySelector('.kolom11-hidden-input');
                const checkboxes = item.querySelectorAll('.hierarchy-checkboxes input[type="checkbox"]');
                
                if (!container || !hiddenInput || checkboxes.length === 0) return;

                // Parse existing data from hidden input
                const existingText = hiddenInput.value || '';
                const parsedSections = parseKolom11Text(existingText);

                // Get checked hierarchies
                const checkedValues = Array.from(checkboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                // Clear container
                container.innerHTML = '';

                // If no checkboxes checked, show empty state
                if (checkedValues.length === 0) {
                    container.innerHTML = `
                        <div class="empty-state" style="padding: 40px; text-align: center; color: #94a3b8;">
                            <i class="fas fa-hand-pointer" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                            <p style="margin: 0;">Pilih hierarki pengendalian di atas untuk mulai mengisi</p>
                        </div>
                    `;
                    return;
                }

                // Create section for each checked hierarchy
                checkedValues.forEach((value, index) => {
                    const section = document.createElement('div');
                    section.className = 'hierarchy-section';
                    section.style.marginBottom = index < checkedValues.length - 1 ? '20px' : '0';

                    // Protected header
                    const header = document.createElement('div');
                    header.className = 'hierarchy-header';
                    header.style.cssText = `
                        font-size: 14px;
                        font-weight: 600;
                        color: #1e293b;
                        margin-bottom: 8px;
                        padding: 10px 14px;
                        background: white;
                        border-left: 4px solid #3b82f6;
                        border-radius: 6px;
                        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
                    `;
                    header.innerHTML = `<i class="fas fa-shield-alt" style="color: #3b82f6; margin-right: 8px;"></i>${index + 1}. ${value}:`;

                    // Editable textarea with existing content
                    const textarea = document.createElement('textarea');
                    textarea.className = 'form-control hierarchy-textarea';
                    textarea.dataset.hierarchy = value;
                    textarea.rows = 3;
                    textarea.placeholder = `Tambahkan penjelasan detail untuk ${value}...`;
                    textarea.style.cssText = `
                        border: 1px solid #e2e8f0;
                        border-radius: 6px;
                        padding: 12px;
                        font-size: 14px;
                        line-height: 1.6;
                        resize: vertical;
                        transition: all 0.2s ease;
                    `;

                    // Set existing content if available
                    if (parsedSections[value]) {
                        textarea.value = parsedSections[value];
                    }

                    // Focus/blur effects
                    textarea.addEventListener('focus', function() {
                        this.style.borderColor = '#3b82f6';
                        this.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.1)';
                    });
                    textarea.addEventListener('blur', function() {
                        this.style.borderColor = '#e2e8f0';
                        this.style.boxShadow = 'none';
                    });

                    // Update hidden input on change
                    textarea.addEventListener('input', function() {
                        updateHiddenInput(item);
                    });

                    section.appendChild(header);
                    section.appendChild(textarea);
                    container.appendChild(section);
                });
            });
        }

        // Initialize on page load
        initializeKolom11ForExistingItems();

        // ==================== PUK/PMK LOGIC (APPENDED) ====================

        function calculateAutoTolerance(item, riskScore, riskLevel) {
            const toleranceInput = item.querySelector('.tolerance-input');
            const toleranceAuto = item.querySelector('.tolerance-auto');
            const toleranceDisplay = item.querySelector('.tolerance-display');
            const toleranceIcon = toleranceDisplay ? toleranceDisplay.querySelector('.tolerance-icon') : null;
            const toleranceValue = toleranceDisplay ? toleranceDisplay.querySelector('.tolerance-value') : null;
            const toleranceReason = toleranceDisplay ? toleranceDisplay.querySelector('.tolerance-reason') : null;
            
            // Sections to show/hide
            const kolom19Section = item.querySelector('.kolom19-section');
            const riskAfterSection = item.querySelector('.risk-after-control-section');
            const programSection = item.querySelector('.program-section');
            const bagian5Section = item.querySelector('.bagian-5-section');

            // Check if controls exist (Kolom 10/11)
            const kolom11Input = item.querySelector('.kolom11-hidden-input');
            const hasControls = kolom11Input && kolom11Input.value && kolom11Input.value.trim() !== '' && kolom11Input.value !== '-';

            let tolerance = 'Ya';
            let icon = 'fa-check-circle';
            let iconColor = '#10b981';
            let bgcolor = '#ecfdf5';
            let borderColor = '#6ee7b7';
            let valueText = 'Ya - Dapat Ditoleransi';
            let reasonText = 'Risiko dapat ditoleransi';

            // Auto-tolerance logic (same as create)
            if (riskScore >= 10) {
                // Tinggi & Sangat Tinggi (10+): Auto "Tidak" - always need program
                tolerance = 'Tidak';
                icon = 'fa-exclamation-triangle';
                iconColor = '#dc2626';
                bgcolor = '#fef2f2';
                borderColor = '#fca5a5';
                valueText = 'Tidak - Perlu Program Pengendalian (Pilih PUK/PMK)';
                reasonText = 'Risiko Tinggi/Sangat Tinggi: Wajib membuat Program Pengendalian';
            } else if (riskScore >= 5) {
                // Sedang (5-9): Depends on existing controls
                if (!hasControls) {
                    // No controls? Need PUK
                    tolerance = 'Tidak';
                    icon = 'fa-exclamation-circle';
                    iconColor = '#f59e0b';
                    bgcolor = '#fffbeb';
                    borderColor = '#fcd34d';
                    valueText = 'Tidak - Perlu Program Pengendalian';
                    reasonText = 'Risiko Sedang tanpa pengendalian: Program PUK diperlukan';
                } else {
                    // Has controls? No PUK needed
                    tolerance = 'Ya';
                    icon = 'fa-check-circle';
                    iconColor = '#10b981';
                    bgcolor = '#ecfdf5';
                    borderColor = '#6ee7b7';
                    valueText = 'Ya - Dapat Ditoleransi (Cukup Pengendalian Kolom 10)';
                    reasonText = 'Risiko Sedang dengan pengendalian (Kolom 10) sudah cukup. Tidak perlu PUK.';
                }
            } else if (riskScore > 0) {
                // Rendah (1-4): Auto "Ya"
                valueText = 'Ya - Dapat Ditoleransi';
                reasonText = 'Risiko Rendah: Tidak perlu pengendalian tambahan';
            } else {
                // No risk calculated yet
                icon = 'fa-spinner';
                valueText = 'Menunggu Penilaian Risiko';
                reasonText = 'Hitung risiko di Kolom 12-14 untuk menentukan toleransi';
                bgcolor = 'white';
                borderColor = '#cbd5e1';
                iconColor = '#94a3b8';
            }

            // Update display
            if (toleranceIcon) toleranceIcon.innerHTML = `\u003ci class="fas ${icon}" style="color: ${iconColor};">\u003c/i>`;
            if (toleranceValue) toleranceValue.textContent = valueText;
            if (toleranceReason) toleranceReason.textContent = reasonText;
            if (toleranceDisplay) {
                toleranceDisplay.style.background = bgcolor;
                toleranceDisplay.style.borderColor = borderColor;
            }
            if (toleranceInput) toleranceInput.value = tolerance;

            // ==================== PUK/PMK FORCING LOGIC ====================
            const pmkOption = item.querySelector('.option-pmk');
            const pukOption = item.querySelector('option[value="PUK"]');
            const typeSelect = item.querySelector('.program-type-select');

            if (pmkOption && pukOption && typeSelect) {
                if (riskScore >= 20) {
                    // SANGAT TINGGI: FORCE PMK ONLY
                    pukOption.disabled = true;
                    pukOption.style.display = 'none';
                    
                    pmkOption.disabled = false;
                    pmkOption.textContent = 'PMK - Program Manajemen Korporat (Wajib untuk Risiko Sangat Tinggi)';
                    
                    // Force select PMK
                    if (typeSelect.value !== 'PMK') {
                        pmkOption.selected = true;
                        typeSelect.value = 'PMK';
                        typeSelect.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                } else if (riskScore >= 10) {
                    // TINGGI: ALLOW BOTH, SUGGEST PMK
                    pukOption.disabled = false;
                    pukOption.style.display = 'block';
                    
                    pmkOption.disabled = false;
                    pmkOption.textContent = 'PMK - Program Manajemen Korporat (Disarankan untuk Risiko Tinggi)';
                } else {
                    // SEDANG/RENDAH: PMK DISABLED, FORCE PUK
                    pmkOption.disabled = true;
                    if (pmkOption.selected) {
                        pmkOption.selected = false;
                        typeSelect.value = '';
                    }
                    
                    pmkOption.textContent = 'PMK - Program Manajemen Korporat (Hanya untuk Risiko Tinggi/Sangat Tinggi)';
                    
                    pukOption.disabled = false;
                    pukOption.style.display = 'block';
                    
                    // Auto-select PUK if nothing selected
                    if (typeSelect.value !== 'PUK' && tolerance === 'Tidak') {
                        pukOption.selected = true;
                        typeSelect.value = 'PUK';
                        typeSelect.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                }
            }

            // Show/hide Bagian 5
            if (bagian5Section) {
                if (riskScore > 0) {
                    bagian5Section.style.display = 'block';
                } else {
                    bagian5Section.style.display = 'none';
                }
            }

            // Show/hide Kolom 19 and Program section
            // Logic: Show ONLY if Tolerance is "Tidak" (High Risk OR Medium Risk without Controls)
            if (tolerance === 'Tidak') {
                if (kolom19Section) kolom19Section.style.display = 'block';
                if (programSection) {
                    programSection.style.display = 'block';
                    
                    // Show program form container immediately
                    const programFormContainer = item.querySelector('.program-form-container');
                    if (programFormContainer) {
                        programFormContainer.style.display = 'block';
                        
                        // Sync program title from Kolom 19
                        const kolom19Input = item.querySelector('.kolom19-input');
                        const programJudul = item.querySelector('.program-judul');
                        if (kolom19Input && programJudul) {
                            programJudul.value = kolom19Input.value;
                        }
                        
                        // Update program type label
                        const typeSelect = item.querySelector('.program-type-select');
                        const typeLabel = item.querySelector('.program-type-label');
                        if (typeSelect && typeLabel && typeSelect.value) {
                            typeLabel.textContent = typeSelect.value;
                        }
                    }
                }
                if (riskAfterSection) riskAfterSection.style.display = 'block';
                
                // Add required attributes
                const k19Input = item.querySelector('.kolom19-input');
                if(k19Input) k19Input.setAttribute('required', 'required');
                
                
            } else {
                if (kolom19Section) kolom19Section.style.display = 'none';
                if (riskAfterSection) riskAfterSection.style.display = 'none';
                if (programSection) programSection.style.display = 'none';
                
                // Remove required
                const k19Input = item.querySelector('.kolom19-input');
                if(k19Input) k19Input.removeAttribute('required');

                // Clear program selection if hidden? No, sustain data for now or clear.
                // Usually better to hide.
            }

            // Handle PUK/PMK Logic based on Risk Score
            const programTypeSelect = item.querySelector('.program-type-select');
            if (programTypeSelect && programSection) {
                 const pukOption = programTypeSelect.querySelector('.option-puk');
                 const pmkOption = programTypeSelect.querySelector('.option-pmk');
                 
                 // Logic:
                 // Score >= 20 (Sangat Tinggi): FORCE PMK
                 // Score 10-19 (Tinggi): Allow Both, Suggest PMK
                 // Score < 10: Allow PUK, Disable PMK?
                 
                 if (riskScore >= 20) {
                     // Force PMK
                     if (pukOption) { pukOption.disabled = true; pukOption.style.display = 'none'; }
                     if (pmkOption) { pmkOption.disabled = false; pmkOption.selected = true; }
                     // Trigger change?
                 } else if (riskScore >= 10) {
                     // Allow Both
                     if (pukOption) { pukOption.disabled = false; pukOption.style.display = 'block'; }
                     if (pmkOption) { pmkOption.disabled = false; }
                 } else {
                     // Low Risk but Tolerance=Tidak? (e.g. Medium 8-9)
                     // Allow PUK. PMK usually for High Risk.
                     if (pmkOption) { pmkOption.disabled = true; } // Or allow?
                     if (pukOption) { pukOption.disabled = false; pukOption.selected = true; }
                 }
            }
        }

        function calculateRiskAfterControl(el) {
            const item = el.closest('.doc-item');
            const likelihood = parseInt(item.querySelector('.likelihood-select-after').value) || 0;
            const severity = parseInt(item.querySelector('.severity-select-after').value) || 0;

            const score = likelihood * severity;
            const scoreEl = item.querySelector('.risk-score-after');
            const levelEl = item.querySelector('.risk-level-after');
            const box = item.querySelector('.risk-result-box-after');
            
            const inputScore = item.querySelector('.input-score-after');
            const inputLevel = item.querySelector('.input-level-after');

            scoreEl.textContent = score || '-';
            if (inputScore) inputScore.value = score;

            let level = 'Rendah';
            let bg = '#e2e8f0'; 
            let textColor = '#64748b';

            if (score > 0) {
                textColor = '#fff';
                if (score >= 15) { level = 'Tinggi'; bg = '#dc2626'; }
                else if (score >= 8) { level = 'Sedang'; bg = '#f59e0b'; }
                else { level = 'Rendah'; bg = '#166534'; }
            }

            levelEl.textContent = (score > 0) ? level : 'PENDING';
            if (inputLevel) inputLevel.value = level;
            
            if (box) {
                box.style.background = bg;
                box.querySelector('.risk-score-after').style.color = textColor;
                box.querySelector('.risk-level-after').style.color = textColor;
            }
        }

        // Program Type Selection Logic (For NEW/Changed Selection)
        document.addEventListener('change', function (e) {
            if (e.target.classList.contains('program-type-select')) {
                const item = e.target.closest('.doc-item');
                const programType = e.target.value;
                const container = item.querySelector('.program-form-container');
                const kolom19Value = item.querySelector('.kolom19-input')?.value || '';
                const itemIndex = item.getAttribute('data-index');

                if (!programType) {
                    container.style.display = 'none';
                    container.innerHTML = '';
                    return;
                }

                // If content is already loaded (via PHP) and type matches, do nothing?
                // But if user CHANGES type, we must reload template.
                // We can check if existing form matches type?
                // For now, simple logic: REPLACE content with Template.
                // THIS WILL WIPE EXISTING DATA IF CHANGING TYPE!
                // But that is expected behavior when switching forms.

                const template = document.getElementById('program-form-template').innerHTML;
                const processedHtml = template.replace(/{index}/g, itemIndex);

                container.innerHTML = processedHtml;
                container.style.display = 'block';

                // Setup Form
                toggleProgramHeaders(item);
                const title = container.querySelector('.program-form-title');
                if(title) title.textContent = `Form ${programType} - ${programType === 'PUK' ? 'Program Unit Kerja' : 'Program Manajemen Korporat'}`;

                const judulInput = container.querySelector('.program-judul');
                if(judulInput) judulInput.value = kolom19Value;

                const pjInput = container.querySelector('.program-pj');
                const userUnitName = document.getElementById('user_unit_name')?.value || '';
                if (pjInput) pjInput.value = userUnitName;

                const typeLabel = container.querySelector('.program-type-label');
                if(typeLabel) typeLabel.textContent = programType === 'PMK' ? '(Harus diisi untuk PMK)' : '(Opsional)';

                // Initialize one row
                setTimeout(() => {
                    const addBtn = container.querySelector('button'); // Assume button is for add row
                    if (addBtn && addBtn.textContent.includes('Tambah')) addProgramKerjaRow(addBtn);
                }, 50);
            }
        });

        // Sync Judul Program with Kolom 19
        document.addEventListener('input', function(e) {
            if(e.target.classList.contains('kolom19-input')) {
                const item = e.target.closest('.doc-item');
                const judul = item.querySelector('.program-judul');
                if(judul) judul.value = e.target.value;
            }
        });



        // User Data from Controller (Injected once)
        const pukKoordinatorUsers = @json($pukKoordinatorUsers ?? []);
        const pukPelaksanaUsers = @json($pukPelaksanaUsers ?? []);
        const pmkPicUsers = @json($pmkPicUsers ?? []);

        function isPmkSelected(context) {
            const item = context.closest('.doc-item');
            const typeSelect = item.querySelector('.program-type-select');
            return typeSelect && typeSelect.value === 'PMK';
        }

        function toggleProgramHeaders(item) {
             const isPMK = isPmkSelected(item);
             const table = item.querySelector('.program-kerja-table');
             if(!table) return;

             const colKoordinator = table.querySelector('.col-koordinator');
             const colPelaksana = table.querySelector('.col-pelaksana');
             const colAnggaran = table.querySelector('.col-anggaran');

             if(isPMK) {
                 if(colKoordinator) colKoordinator.style.display = 'none';
                 if(colPelaksana) {
                     colPelaksana.style.display = 'table-cell';
                     // colPelaksana.innerText = 'PIC (Manager)'; // Optional: Change Label
                 }
                 if(colAnggaran) colAnggaran.style.display = 'table-cell';
             } else {
                 if(colKoordinator) colKoordinator.style.display = 'table-cell';
                 if(colPelaksana) {
                     colPelaksana.style.display = 'table-cell';
                     // colPelaksana.innerText = 'Pelaksana';
                 }
                 if(colAnggaran) colAnggaran.style.display = 'none';
             }
        }

        function addProgramKerjaRow(btn) {
            const item = btn.closest('.doc-item');
            
            // Sync headers first
            toggleProgramHeaders(item);

            const table = item.querySelector('.program-kerja-tbody');
            const rowCount = table.querySelectorAll('tr').length + 1;
            const itemIndex = item.getAttribute('data-index');
            const uniqueId = Date.now() + Math.random().toString(36).substr(2, 5);
            const isPMK = isPmkSelected(btn);

            // Generate Options
            let pukKoordinatorOptions = '<option value="" disabled selected>-- Pilih --</option>';
            pukKoordinatorUsers.forEach(u => pukKoordinatorOptions += `<option value="${u.nama_user}">${u.nama_user}</option>`);

            let pukPelaksanaOptions = '<option value="" disabled selected>-- Pilih --</option>';
            pukPelaksanaUsers.forEach(u => pukPelaksanaOptions += `<option value="${u.nama_user}">${u.nama_user}</option>`);

            let pmkPicOptions = '<option value="" disabled selected>-- Pilih --</option>';
            pmkPicUsers.forEach(u => pmkPicOptions += `<option value="${u.nama_user}">${u.nama_user}</option>`);

            const row = document.createElement('tr');
            
            // Build Targets HTML (12 columns)
            let targetsHtml = '';
            for(let i=0; i<12; i++) {
                targetsHtml += `
                    <td style="border: 1px solid #d1d5db; padding: 0; min-width: 35px;">
                        <input type="number" class="form-control target-input" name="items[${itemIndex}][program_kerja][${uniqueId}][target][${i}]" 
                               min="0" placeholder="-"
                               style="border:none; width:100%; text-align:center; padding:4px; font-size:11px;">
                    </td>
                `;
            }

            if (isPMK) {
                // PMK Row Structure
                 row.innerHTML = `
                    <td style="text-align: center; vertical-align: middle;">${rowCount}</td>
                    <td style="padding: 0;">
                        <textarea class="form-control" name="items[${itemIndex}][program_kerja][${uniqueId}][uraian]" required style="border:none; width:100%; padding:6px; resize:vertical;" rows="2"></textarea>
                    </td>
                    <td style="padding: 0; display:none;"> <!-- Koordinator Hidden -->
                         <input type="hidden" name="items[${itemIndex}][program_kerja][${uniqueId}][koordinator]" value="-">
                    </td>
                    <td style="padding: 0;"> <!-- PIC -->
                        <select class="form-select" name="items[${itemIndex}][program_kerja][${uniqueId}][pelaksana]" required style="border:none; width:100%; padding:6px;">
                            ${pmkPicOptions}
                        </select>
                    </td>
                    ${targetsHtml}
                    <td style="padding: 0;">
                        <input type="number" class="form-control" name="items[${itemIndex}][program_kerja][${uniqueId}][anggaran]" placeholder="0" style="border:none; width:100%; padding:6px;">
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <button type="button" onclick="this.closest('tr').remove(); renumberProgramKerja(this)" style="color:red; background:none; border:none;"><i class="fas fa-trash"></i></button>
                    </td>
                `;
            } else {
                // PUK Row Structure
                row.innerHTML = `
                    <td style="text-align: center; vertical-align: middle;">${rowCount}</td>
                    <td style="padding: 0;">
                        <textarea class="form-control" name="items[${itemIndex}][program_kerja][${uniqueId}][uraian]" required style="border:none; width:100%; padding:6px; resize:vertical;" rows="2"></textarea>
                    </td>
                    <td style="padding: 0;">
                        <select class="form-select" name="items[${itemIndex}][program_kerja][${uniqueId}][koordinator]" required style="border:none; width:100%; padding:6px;">
                            ${pukKoordinatorOptions}
                        </select>
                    </td>
                    <td style="padding: 0;">
                        <select class="form-select" name="items[${itemIndex}][program_kerja][${uniqueId}][pelaksana]" required style="border:none; width:100%; padding:6px;">
                            ${pukPelaksanaOptions}
                        </select>
                    </td>
                    ${targetsHtml}
                    <td style="padding: 0; display:none;"> <!-- Anggaran Hidden --> </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <button type="button" onclick="this.closest('tr').remove(); renumberProgramKerja(this)" style="color:red; background:none; border:none;"><i class="fas fa-trash"></i></button>
                    </td>
                `;
            }

            table.appendChild(row);
        }

        function renumberProgramKerja(btn) {
            const table = btn.closest('table').querySelector('tbody');
            if(!table) return;
            table.querySelectorAll('tr').forEach((row, idx) => {
                row.cells[0].textContent = idx + 1;
            });
        }

        function confirmSave() {
            Swal.fire({
                title: 'Simpan Perubahan?',
                text: "Perubahan akan disimpan sebagai Draft Revisi (belum dikirim ke approval).",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    validateAndSubmit('save_only');
                }
            });
        }

        function confirmSubmit() {
            Swal.fire({
                title: 'Kirim Revisi?',
                text: "Dokumen akan dikirim ulang untuk proses approval.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim Revisi',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    validateAndSubmit('submit');
                }
            });
        }

        // ==================== RISK CALCULATION ====================
        
        function calculateItemRisk(el) {
            const item = el.closest('.doc-item') || el.closest('form');
            const likelihood = parseInt(item.querySelector('.likelihood-select')?.value) || 0;
            const severity = parseInt(item.querySelector('.severity-select')?.value) || 0;

            const score = likelihood * severity;
            const scoreEl = item.querySelector('.display-score');
            const levelEl = item.querySelector('.display-level');
            const inputScore = item.querySelector('.input-score');
            const inputLevel = item.querySelector('.input-level');
            const riskBox = item.querySelector('.risk-result-box');

            if (scoreEl) scoreEl.textContent = score || '-';
            if (inputScore) inputScore.value = score;

            let level = 'Rendah';
            let bg = '#e2e8f0'; // Default gray
            let textColor = '#64748b';

            if (score > 0) {
                textColor = '#fff';
                if (score >= 20) {
                    level = 'Sangat Tinggi';
                    bg = '#7f1d1d'; // Dark red
                }
                else if (score >= 10) {
                    level = 'Tinggi';
                    bg = '#dc2626'; // Red
                }
                else if (score >= 5) {
                    level = 'Sedang';
                    bg = '#f59e0b'; // Orange
                }
                else {
                    level = 'Rendah';
                    bg = '#10b981'; // Green
                }
            }

            if (levelEl) levelEl.textContent = (score > 0) ? level : 'PENDING';
            if (inputLevel) inputLevel.value = level;
            if (riskBox) {
                riskBox.style.background = bg;
                riskBox.style.color = textColor;
            }

            // Trigger auto-tolerance calculation
            calculateAutoTolerance(item, score, level);
        }



        // Target percentages have no maximum limit - users can enter any value per month
        function validateTargetPercentages(input) {
            // No validation - any value is allowed (can exceed 100% per month)
        }



        document.addEventListener('DOMContentLoaded', () => {
             // Init Program Headers and Data Persistence Logic
             document.querySelectorAll('.doc-item').forEach(item => {
                 // 1. Program Headers (PMK/PUK toggle)
                 toggleProgramHeaders(item);

                 // 2. Init Conditions (Trigger change if value selected)
                 const condSelect = item.querySelector('.condition-select');
                 const catSelect = item.querySelector('.category-select');
                 
                 // If category is selected, trigger updateConditions to populate Condition options
                 if(catSelect && catSelect.value) {
                      updateConditions(catSelect);
                      // Then set value from data-selected attribute
                      if(condSelect && condSelect.dataset.selected) {
                          condSelect.value = condSelect.dataset.selected;
                      }
                 }

                 // 3. Init Hierarchy (Visual list)
                 // updateKolom11 reads checkboxes and updates hidden input + visual list.
                 const anyHierarchyCheckbox = item.querySelector('input[name*="kolom10_pengendalian"]');
                 if(anyHierarchyCheckbox) {
                     updateKolom11(anyHierarchyCheckbox);
                 }

                 // 4. Init Risk Colors (Initial Assessment)
                 const riskSelect = item.querySelector('.severity-select');
                 if(riskSelect) calculateItemRisk(riskSelect);

                 // 5. Init After Control Risk Colors (Residual Assessment)
                 const afterSelect = item.querySelector('.severity-select-after');
                 if(afterSelect) calculateRiskAfterControl(afterSelect);

                 // 6. Init Program Type visibility (if needed, dependent on risk level)
                 // Usually handled by calculateItemRisk which calls toggleProgramHeaders logic? 
                 // No, toggleProgramHeaders handles PUK/PMK col visibility.
             });
        });

    </script>
    <!-- Activity Heartbeat & Lock Check -->
    <script>
        function sendHeartbeat() {
            fetch('{{ route("activity.heartbeat") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    action: 'edit',
                    doc_id: {{ $document->id }}
                })
            })
            .then(res => res.json())
            .then(data => {
                if(data.lock && data.lock.locked) {
                     // Locked by someone else! Show sticky warning
                     showLockWarning(data.lock.by);
                }
            })
            .catch(e => console.error('Heartbeat failed', e));
        }

        function showLockWarning(userName) {
            // Check if warning already exists
            if(document.getElementById('lock-warning-banner')) return;

            const banner = document.createElement('div');
            banner.id = 'lock-warning-banner';
            banner.style.cssText = `
                position: fixed; top: 0; left: 0; width: 100%; z-index: 9999;
                background-color: #fef2f2; border-bottom: 2px solid #ef4444; color: #991b1b;
                padding: 12px 20px; text-align: center; font-weight: 600;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); display: flex; align-items: center; justify-content: center; gap: 10px;
            `;
            banner.innerHTML = `
                <i class="fas fa-exclamation-triangle" style="color: #ef4444; font-size: 20px;"></i>
                <span>PERHATIAN: User <u>${userName}</u> juga sedang mengedit dokumen ini saat ini!</span>
                <button onclick="this.parentElement.remove()" style="margin-left: auto; background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
            `;
            document.body.prepend(banner);
        }

        document.addEventListener('DOMContentLoaded', () => {
            sendHeartbeat();
            setInterval(sendHeartbeat, 15000);
        });
    </script>
</body>
</html>

