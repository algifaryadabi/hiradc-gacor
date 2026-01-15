<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Form HIRADC - System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #c41e3a;
            --primary-hover: #a01729;
            --bg-color: #f5f5f5;
            --sidebar-width: 250px;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            --border-radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-color);
            color: #1f2937;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid #e5e7eb;
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 50;
        }

        .logo-section {
            padding: 30px 20px;
            border-bottom: 1px solid #e5e7eb;
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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #f3f4f6;
        }

        .logo-circle img {
            max-width: 80%;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 800;
            color: var(--primary-color);
            letter-spacing: -0.5px;
            margin-bottom: 3px;
        }

        .logo-subtext {
            font-size: 12px;
            color: #9ca3af;
            font-weight: 500;
        }

        .nav-menu {
            flex: 1;
            padding: 20px 15px;
            overflow-y: auto;
        }

        .nav-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #4b5563;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .nav-item:hover {
            background: #fee2e2;
            color: var(--primary-color);
        }

        .nav-item.active {
            background: #fee2e2;
            color: var(--primary-color);
            font-weight: 600;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

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
            padding: 20px 40px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 40;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .header h1 {
            font-size: 22px;
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.5px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #6b7280;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-back:hover {
            color: #111827;
        }

        .content-area {
            padding: 40px;
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Document Form Cards */
        .doc-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            overflow: hidden;
            border: 1px solid #f3f4f6;
        }

        .card-header {
            padding: 20px 30px;
            background: #fff;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-icon {
            width: 40px;
            height: 40px;
            background: #fef2f2;
            color: var(--primary-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .header-title h2 {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
        }

        .header-title p {
            font-size: 13px;
            color: #6b7280;
            margin-top: 2px;
        }

        .card-body {
            padding: 30px;
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

        /* Form Controls */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .required {
            color: var(--primary-color);
            margin-left: 2px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
            background: #f9fafb;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.1);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
            line-height: 1.5;
        }

        select.form-control {
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
        }

        .toggle-group {
            display: flex;
            gap: 10px;
            padding: 5px;
            background: #f3f4f6;
            border-radius: 10px;
            width: fit-content;
        }

        .toggle-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: #6b7280;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: 0.2s;
        }

        .toggle-btn.active {
            background: white;
            color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Checkbox Groups */
        .checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 15px;
        }

        .checkbox-card {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 15px;
            transition: 0.2s;
            cursor: pointer;
            display: flex;
            align-items: start;
            gap: 12px;
        }

        .checkbox-card:hover {
            border-color: var(--primary-color);
            background: #fef2f2;
        }

        .checkbox-card input[type="checkbox"] {
            margin-top: 3px;
            accent-color: var(--primary-color);
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .checkbox-card label {
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: #4b5563;
            line-height: 1.4;
        }

        /* Risk Matrix */
        .risk-result-box {
            background: #1f2937;
            color: white;
            padding: 20px;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .risk-score {
            font-size: 36px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 5px;
        }

        .risk-level {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.2);
            font-size: 12px;
            font-weight: 700;
            uppercase;
        }

        /* Action Bar */
        .action-bar {
            position: sticky;
            bottom: 20px;
            background: white;
            padding: 20px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #f3f4f6;
            z-index: 30;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #4b5563;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
            color: #111827;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
            box-shadow: 0 4px 12px rgba(196, 30, 58, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .hidden {
            display: none;
        }

        .mt-4 {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('user.dashboard') }}"
                    class="nav-item {{ Request::routeIs('user.dashboard') ? 'active' : '' }}"><i
                        class="fas fa-th-large"></i><span>Dashboard</span></a>
                <a href="{{ route('documents.index') }}"
                    class="nav-item {{ Request::routeIs('documents.index') ? 'active' : '' }}"><i
                        class="fas fa-folder-open"></i><span>Form Saya</span></a>
                <a href="{{ route('documents.create') }}"
                    class="nav-item {{ Request::routeIs('documents.create') ? 'active' : '' }}"><i
                        class="fas fa-plus-circle"></i><span>Buat Form Baru</span></a>
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
                <div style="display: flex; align-items: center; gap: 20px;">
                    <a href="{{ route('documents.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i>
                        Kembali</a>
                    <div style="height: 24px; width: 1px; background: #e5e7eb;"></div>
                    <h1>Buat Form Baru</h1>
                </div>
            </div>

            <div class="content-area">
                <form id="hiradcForm" action="{{ route('documents.store') }}" method="POST">
                    @csrf
                    <!-- Messages -->
                    @if(session('success'))
                        <div
                            style="background:#ecfdf5; border:1px solid #10b981; color:#065f46; padding:15px; border-radius:8px; margin-bottom:20px;">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div
                            style="background:#fef2f2; border:1px solid #ef4444; color:#991b1b; padding:15px; border-radius:8px; margin-bottom:20px;">
                            <ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                        </div>
                    @endif

                    <!-- Card 1: Informasi Dasar -->
                    <div class="doc-card">
                        <div class="card-header">
                            <div class="header-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="header-title">
                                <h2>Informasi Dasar</h2>
                                <p>Kolom 2 - 5</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">Proses Bisnis <span class="required">*</span></label>
                                    @php
                                        $autoProbis = '';
                                        if (isset($user->seksi->probis)) {
                                            $autoProbis = $user->seksi->probis->nama_probis;
                                        } elseif (isset($user->unit->probis)) {
                                            $autoProbis = $user->unit->probis->nama_probis;
                                        }
                                        
                                        $displayValue = $autoProbis;
                                    @endphp
                                    
                                    @if($displayValue)
                                        <input type="text" class="form-control" value="{{ $displayValue }}" readonly style="background-color: #f3f4f6; cursor: not-allowed; border: 1px solid #10b981;">
                                        <input type="hidden" name="kolom2_proses" value="{{ $displayValue }}">
                                        <small style="color:#059669; font-size:11px; margin-top:5px; display:block;"><i class="fas fa-check-circle"></i> Otomatis terisi sesuai Unit/Seksi Anda</small>
                                    @else
                                        <select name="kolom2_proses" class="form-control" required>
                                            <option value="">-- Pilih Proses Bisnis --</option>
                                            @foreach($probis as $p)
                                                <option value="{{ $p->nama_probis }}">
                                                    {{ $p->nama_probis }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small style="color:#ef4444; font-size:11px;">*Unit Anda belum terhubung. Silakan pilih manual.</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kegiatan <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="kolom2_kegiatan" required
                                        placeholder="Nama kegiatan spesifik...">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Lokasi / Area Kerja <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" name="kolom3_lokasi" required
                                        placeholder="Contoh: Area Kiln 1...">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kategori <span class="required">*</span></label>
                                    <select class="form-control" id="kolom4_kategori" name="kategori" required
                                        onchange="updateConditionOptions()">
                                        <option value="">-- Pilih --</option>
                                        <option value="K3">K3 - Kesehatan & Keselamatan</option>
                                        <option value="KO">KO - Keselamatan Operasional</option>
                                        <option value="Lingkungan">Lingkungan</option>
                                        <option value="Keamanan">Keamanan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kondisi <span class="required">*</span></label>
                                    <select class="form-control" id="kolom5_kondisi" name="kolom5_kondisi" required>
                                        <option value="">-- Pilih Kategori Dulu --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Identifikasi Bahaya (Kolom 6) -->
                    <div class="doc-card">
                        <div class="card-header">
                            <div class="header-icon"><i class="fas fa-exclamation-triangle"></i></div>
                            <div class="header-title">
                                <h2>Identifikasi Bahaya (Kolom 6)</h2>
                                <p>Tentukan potensi bahaya</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="bahaya_type" id="bahaya_type">

                            <div id="section_k3_ko" class="hidden">
                                <div class="toggle-group" style="margin-bottom:20px;">
                                    <button type="button" class="toggle-btn active" id="btn_unsafe_condition"
                                        onclick="selectBahayaType('condition')">Unsafe Condition</button>
                                    <button type="button" class="toggle-btn" id="btn_unsafe_action"
                                        onclick="selectBahayaType('action')">Unsafe Action</button>
                                </div>
                                <div id="unsafe_condition_options" class="checkbox-grid hidden"></div>
                                <div id="unsafe_action_options" class="checkbox-grid hidden"></div>
                            </div>

                            <div id="section_lingkungan" class="checkbox-grid hidden" id="lingkungan_options"></div>
                            <div id="section_keamanan" class="checkbox-grid hidden" id="keamanan_options"></div>

                            <div class="form-group mt-4">
                                <label class="form-label" id="manual_bahaya_label">Input Bahaya Lainnya (Manual)</label>
                                <input type="text" class="form-control" name="bahaya_manual"
                                    placeholder="Deskripsikan jika pilihan diatas tidak sesuai...">
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Analisis Risiko (Kolom 7 & 9) -->
                    <div class="doc-card">
                        <div class="card-header">
                            <div class="header-icon"><i class="fas fa-search-dollar"></i></div>
                            <div class="header-title">
                                <h2>Analisis Risiko (Col 7 & 9)</h2>
                                <p>Konsekuensi dan Identifikasi</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">Dampak / Konsekuensi (Col 7) <span
                                            class="required">*</span></label>
                                    <textarea class="form-control" name="kolom7_dampak" required
                                        placeholder="Jelaskan dampak negatif..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Identifikasi Risiko (Col 9) <span
                                            class="required">*</span></label>
                                    <textarea class="form-control" name="kolom9_risiko" required
                                        placeholder="Apa risiko spesifiknya?"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Penilaian Risiko Awal (Kolom 12-14) -->
                    <div class="doc-card">
                        <div class="card-header">
                            <div class="header-icon"><i class="fas fa-calculator"></i></div>
                            <div class="header-title">
                                <h2>Penilaian Risiko Awal (Col 12-14)</h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="display: flex; gap: 30px;">
                                <div style="flex:1;">
                                    <div class="form-group">
                                        <label class="form-label">Kemungkinan (Likelihood)</label>
                                        <select class="form-control" id="kolom12_kemungkinan" name="kolom12_kemungkinan"
                                            required onchange="calculateRisk()">
                                            <option value="">-- Pilih (1-5) --</option>
                                            <option value="1">1 - Sangat Jarang</option>
                                            <option value="2">2 - Jarang</option>
                                            <option value="3">3 - Kadang-kadang</option>
                                            <option value="4">4 - Sering</option>
                                            <option value="5">5 - Sangat Sering</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Konsekuensi (Severity)</label>
                                        <select class="form-control" id="kolom13_konsekuensi" name="kolom13_konsekuensi"
                                            required onchange="calculateRisk()">
                                            <option value="">-- Pilih (1-5) --</option>
                                            <option value="1">1 - Tidak Signifikan</option>
                                            <option value="2">2 - Minor</option>
                                            <option value="3">3 - Moderate</option>
                                            <option value="4">4 - Major</option>
                                            <option value="5">5 - Catastrophic</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="flex: 0 0 250px;">
                                    <label class="form-label">Hasil Penilaian</label>
                                    <div class="risk-result-box">
                                        <div class="risk-score" id="display_risk_score">-</div>
                                        <span class="risk-level" id="display_risk_level">PENDING</span>
                                    </div>
                                    <input type="hidden" id="kolom14_nilai_risiko" name="kolom14_nilai_risiko">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5 (NEW): Regulasi & Evaluasi (Kolom 15 & 16) -->
                    <div class="doc-card">
                        <div class="card-header">
                            <div class="header-icon"><i class="fas fa-gavel"></i></div>
                            <div class="header-title">
                                <h2>Regulasi & Evaluasi (Col 15 & 16)</h2>
                                <p>Peraturan dan Prioritas</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Peraturan Perundangan (Col 15)</label>
                                <textarea class="form-control" name="kolom15_regulasi" id="kolom15_peraturan"
                                    oninput="checkRegulasi()" placeholder="Contoh: UU No. 1 Tahun 1970..."></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Aspek Penting / Prioritas (Col 16)</label>
                                <div style="display: flex; gap: 20px;">
                                    <label style="display:flex; align-items:center; gap:8px;">
                                        <input type="radio" name="kolom16_penting" value="P"> <strong>P</strong> -
                                        Penting
                                    </label>
                                    <label style="display:flex; align-items:center; gap:8px;">
                                        <input type="radio" name="kolom16_penting" value="TP"> <strong>TP</strong> -
                                        Tidak Penting
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6 (NEW): Risiko & Peluang (Kolom 17) -->
                    <div class="doc-card">
                        <div class="card-header">
                            <div class="header-icon"><i class="fas fa-lightbulb"></i></div>
                            <div class="header-title">
                                <h2>Risiko & Peluang (Col 17)</h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">Risiko (Negatif)</label>
                                    <textarea class="form-control" name="kolom17_risiko"
                                        placeholder="Risiko tambahan..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Peluang (Positif)</label>
                                    <textarea class="form-control" name="kolom17_peluang"
                                        placeholder="Peluang improvement..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 7: Pengendalian Risiko (Kolom 10 & 11) -->
                    <div class="doc-card">
                        <div class="card-header">
                            <div class="header-icon"><i class="fas fa-shield-alt"></i></div>
                            <div class="header-title">
                                <h2>Pengendalian Risiko</h2>
                                <p>Hirarki dan Rencana</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Hirarki Pengendalian (Pilih minimal satu)</label>
                                <div class="checkbox-grid">
                                    <div class="checkbox-card"><input type="checkbox" name="hirarki[]"
                                            value="Eliminasi"> Eliminasi</div>
                                    <div class="checkbox-card"><input type="checkbox" name="hirarki[]"
                                            value="Substitusi"> Substitusi</div>
                                    <div class="checkbox-card"><input type="checkbox" name="hirarki[]"
                                            value="Rekayasa Teknik"> Rekayasa Teknik</div>
                                    <div class="checkbox-card"><input type="checkbox" name="hirarki[]"
                                            value="Administratif"> Administratif</div>
                                    <div class="checkbox-card"><input type="checkbox" name="hirarki[]" value="APD"> APD
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Additional Controls -->
                            <div id="additional_controls" style="margin-top: 20px;"></div>
                            <button type="button" class="btn btn-secondary mt-4"
                                style="width:100%; border:1px dashed #ccc;" onclick="addControlInput()">
                                <i class="fas fa-plus"></i> Tambah Detail Pengendalian Baru
                            </button>

                            <div class="form-group mt-4">
                                <label class="form-label">Pengendalian Existing (Col 11)</label>
                                <textarea class="form-control" name="kolom11_existing" required
                                    placeholder="Jelaskan pengendalian yg sudah ada..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Card 8: Tindak Lanjut & Residual (Col 18-22) -->
                    <div class="doc-card">
                        <div class="card-header">
                            <div class="header-icon"><i class="fas fa-history"></i></div>
                            <div class="header-title">
                                <h2>Tindak Lanjut & Residual Risk</h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Pengendalian Tindak Lanjut (Col 19)</label>
                                <textarea class="form-control" name="kolom18_tindak_lanjut" required
                                    placeholder="Rencana kedepan..."></textarea>
                            </div>

                            <div
                                style="display:flex; gap:30px; margin-top:30px; padding-top:20px; border-top:1px dashed #eee;">
                                <div style="flex:1;">
                                    <div class="form-group">
                                        <label class="form-label">Kemungkinan Baru (Col 20)</label>
                                        <select class="form-control" id="kolom20_kemungkinan"
                                            name="residual_kemungkinan" required onchange="calculateResidualRisk()">
                                            <option value="">-- Pilih --</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Konsekuensi Baru (Col 21)</label>
                                        <select class="form-control" id="kolom21_konsekuensi"
                                            name="residual_konsekuensi" required onchange="calculateResidualRisk()">
                                            <option value="">-- Pilih --</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Risiko Dapat Ditoleransi? (Col 18)</label>
                                        <div style="display:flex; gap:20px;">
                                            <label style="display:flex; gap:5px;"><input type="radio"
                                                    name="kolom18_toleransi" value="Ya" checked> Ya</label>
                                            <label style="display:flex; gap:5px;"><input type="radio"
                                                    name="kolom18_toleransi" value="Tidak"> Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div style="flex:0 0 250px;">
                                    <div class="risk-result-box">
                                        <div class="risk-score" id="display_resid_score">-</div>
                                        <span class="risk-level" id="display_resid_level">PENDING</span>
                                    </div>
                                    <input type="hidden" id="kolom22_nilai_risiko" name="kolom22_nilai_risiko">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Bar -->
                    <div class="action-bar">
                        <div class="action-info"><i class="fas fa-info-circle"></i> Lengkapi data sebelum kirim.</div>
                        <div class="action-buttons">
                            <a href="{{ route('documents.index') }}" class="btn btn-secondary">Batal</a>
                            <input type="hidden" name="submit_for_approval" value="1">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>
                                Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Logic Script -->
    <script>
        const hazardData = {
            k3_condition: {
                "Fisika": ["Ketinggian", "Licin", "Material Jatuh", "Ruang Terbatas", "Benda Berputar", "Bising", "Panas/Dingin"],
                "Kimia": ["Terhirup", "Terkena Kulit", "Tertelan", "Penyimpanan Salah"],
                "Biologi": ["Virus", "Bakteri", "Hewan Liar"]
            },
            k3_action: {
                "Ergonomi": ["Angkat Berat", "Posisi Salah", "Gerakan Berulang"],
                "Perilaku": ["Tidak Pakai APD", "Tidak Fokus", "Jalan Pintas", "Langgar Prosedur"]
            },
            lingkungan: {
                "Emisi Udara": "Debu, Asap, Gas", "Limbah Cair": "Oli, Kimia", "Limbah Padat": "B3, Sampah", "Energi": "Boros Listrik/Air"
            },
            keamanan: ["Pencurian", "Sabotase", "Kekerasan", "Terorisme"]
        };

        function selectBahayaType(type) {
            document.getElementById('bahaya_type').value = type;
            if (type === 'condition') {
                document.getElementById('btn_unsafe_condition').classList.add('active');
                document.getElementById('btn_unsafe_action').classList.remove('active');
                document.getElementById('unsafe_condition_options').classList.remove('hidden');
                document.getElementById('unsafe_action_options').classList.add('hidden');
            } else {
                document.getElementById('btn_unsafe_condition').classList.remove('active');
                document.getElementById('btn_unsafe_action').classList.add('active');
                document.getElementById('unsafe_condition_options').classList.add('hidden');
                document.getElementById('unsafe_action_options').classList.remove('hidden');
            }
        }

        function updateBahayaContent(cat) {
            ['section_k3_ko', 'section_lingkungan', 'section_keamanan'].forEach(id => document.getElementById(id).classList.add('hidden'));

            if (cat === 'K3' || cat === 'KO') {
                document.getElementById('section_k3_ko').classList.remove('hidden');
                document.querySelector('#unsafe_condition_options').innerHTML = renderChecks(hazardData.k3_condition);
                document.querySelector('#unsafe_action_options').innerHTML = renderChecks(hazardData.k3_action);
                selectBahayaType('condition');
            } else if (cat === 'Lingkungan') {
                document.getElementById('section_lingkungan').classList.remove('hidden');
                document.getElementById('section_lingkungan').innerHTML = renderChecks(hazardData.lingkungan);
            } else if (cat === 'Keamanan') {
                document.getElementById('section_keamanan').classList.remove('hidden');
                let html = '';
                hazardData.keamanan.forEach(i => html += `<div class="checkbox-card"><input type="checkbox" name="bahaya_security[]" value="${i}"> ${i}</div>`);
                document.getElementById('section_keamanan').innerHTML = html;
            }
        }

        function renderChecks(data) {
            let html = '';
            for (const [k, v] of Object.entries(data)) {
                if (Array.isArray(v)) {
                    html += `<div style="grid-column:1/-1; font-weight:bold; margin-top:10px;">${k}</div>`;
                    v.forEach(i => html += `<div class="checkbox-card"><input type="checkbox" name="bahaya_detail[]" value="${k}: ${i}"> ${i}</div>`);
                } else {
                    html += `<div class="checkbox-card"><input type="checkbox" name="bahaya_aspect[]" value="${k}"> ${k} (${v})</div>`;
                }
            }
            return html;
        }

        function updateConditionOptions() {
            const cat = document.getElementById('kolom4_kategori').value;
            const sel = document.getElementById('kolom5_kondisi');
            sel.innerHTML = '<option value="">-- Pilih --</option>';
            let opts = [];

            if (cat === 'K3' || cat === 'KO') opts = ['R - Rutin', 'NR - Non Rutin', 'EM - Emergency'];
            else if (cat === 'Lingkungan') opts = ['N - Normal', 'TN - Tak Normal', 'EM - Emergency'];
            else if (cat === 'Keamanan') opts = ['EM - Emergency'];

            opts.forEach(o => {
                let op = document.createElement('option');
                op.value = o.split(' ')[0]; op.text = o;
                sel.add(op);
            });
            updateBahayaContent(cat);
        }

        function addControlInput() {
            const container = document.getElementById('additional_controls');
            const idx = container.children.length;
            const div = document.createElement('div');
            div.style.marginBottom = '10px';
            div.innerHTML = `
                <div style="display:flex; gap:10px;">
                    <select class="form-control" name="new_controls[${idx}][type]" style="width:30%;">
                        <option>Eliminasi</option><option>Substitusi</option><option>Rekayasa Teknik</option><option>Administratif</option><option>APD</option>
                    </select>
                    <input type="text" class="form-control" name="new_controls[${idx}][desc]" placeholder="Deskripsi...">
                    <button type="button" class="btn btn-secondary" style="color:red;" onclick="this.parentElement.parentElement.remove()">X</button>
                </div>
            `;
            container.appendChild(div);
        }

        function checkRegulasi() {
            const val = document.getElementById('kolom15_peraturan').value;
            const p = document.querySelector('input[name="kolom16_penting"][value="P"]');
            const tp = document.querySelector('input[name="kolom16_penting"][value="TP"]');
            if (val.length > 0) p.checked = true; else tp.checked = true;
        }

        function getLevel(s) {
            if (s <= 3) return { l: 'RENDAH', c: '#10b981' };
            if (s <= 9) return { l: 'SEDANG', c: '#f59e0b' };
            if (s <= 16) return { l: 'TINGGI', c: '#f97316' };
            return { l: 'EXTREME', c: '#ef4444' };
        }

        function calculateRisk() {
            const L = parseInt(document.getElementById('kolom12_kemungkinan').value) || 0;
            const S = parseInt(document.getElementById('kolom13_konsekuensi').value) || 0;
            if (L && S) {
                const sc = L * S; const r = getLevel(sc);
                document.getElementById('kolom14_nilai_risiko').value = sc;
                document.getElementById('display_risk_score').innerHTML = sc;
                const badge = document.getElementById('display_risk_level');
                badge.innerHTML = r.l; badge.style.backgroundColor = r.c;
            }
        }

        function calculateResidualRisk() {
            const L = parseInt(document.getElementById('kolom20_kemungkinan').value) || 0;
            const S = parseInt(document.getElementById('kolom21_konsekuensi').value) || 0;
            if (L && S) {
                const sc = L * S; const r = getLevel(sc);
                document.getElementById('kolom22_nilai_risiko').value = sc;
                document.getElementById('display_resid_score').innerHTML = sc;
                const badge = document.getElementById('display_resid_level');
                badge.innerHTML = r.l; badge.style.backgroundColor = r.c;
            }
        }
    </script>
</body>

</html>