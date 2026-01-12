<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form HIRADC - Input Risiko Lengkap</title>
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
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .content-area {
            padding: 30px 40px;
            max-width: 1400px;
        }

        /* Form Container */
        .form-container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .required {
            color: #c41e3a;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #c41e3a;
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            padding-right: 40px;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        /* Section Headers */
        .section-header {
            background: #f8f8f8;
            padding: 15px 20px;
            border-left: 4px solid #c41e3a;
            margin: 30px 0 20px 0;
            border-radius: 4px;
        }

        .section-header h2 {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            margin-bottom: 3px;
        }

        .section-header p {
            font-size: 12px;
            color: #666;
        }

        /* Checkbox Groups */
        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .checkbox-item:hover {
            background: #f9f9f9;
            border-color: #c41e3a;
        }

        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-item label {
            cursor: pointer;
            margin: 0;
            font-weight: 500;
        }

        /* Dropdown Container for Dynamic Options */
        .dynamic-dropdown {
            margin-top: 10px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 6px;
            display: none;
        }

        .dynamic-dropdown.active {
            display: block;
        }

        /* Button Groups */
        .button-group {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .btn-toggle {
            flex: 1;
            padding: 15px 20px;
            border: 2px solid #ddd;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            font-size: 14px;
            text-align: center;
        }

        .btn-toggle:hover {
            border-color: #c41e3a;
            background: #fff5f5;
        }

        .btn-toggle.active {
            border-color: #c41e3a;
            background: #c41e3a;
            color: white;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #e0e0e0;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-family: 'Inter', sans-serif;
        }

        .btn-secondary {
            background: white;
            color: #666;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background: #f5f5f5;
        }

        .btn-primary {
            background: #c41e3a;
            color: white;
        }

        .btn-primary:hover {
            background: #a01729;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(196, 30, 58, 0.3);
        }

        .help-text {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }

        .hidden {
            display: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .main-content {
                margin-left: 70px;
            }

            .logo-text,
            .logo-subtext,
            .nav-item span {
                display: none;
            }

            .form-row,
            .form-row-3 {
                grid-template-columns: 1fr;
            }
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
                <a href="{{ route('documents.index') }}"
                    class="nav-item {{ request('mode') == 'edit' ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i>
                    <span>Dokumen Saya</span>
                    @if(isset($revisionCount) && $revisionCount > 0)
                        <span class="badge">{{ $revisionCount }}</span>
                    @endif
                </a>
                <a href="{{ route('documents.create') }}"
                    class="nav-item {{ request('mode') != 'edit' ? 'active' : '' }}">
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
                <h1>Form Input Risiko HIRADC</h1>
            </div>

            <div class="content-area">
                <form id="hiradcForm" class="form-container" method="POST" action="{{ route('documents.store') }}">
                    @csrf

                    <!-- SUCCESS MESSAGE -->
                    @if(session('success'))
                        <div
                            style="background: #d4edda; border-left: 4px solid #28a745; padding: 20px; border-radius: 4px; margin-bottom: 20px;">
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <i class="fas fa-check-circle" style="font-size: 24px; color: #28a745;"></i>
                                <div>
                                    <strong style="color: #155724;">Berhasil!</strong>
                                    <p style="margin: 5px 0 0 0; color: #155724;">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- VALIDATION ERRORS -->
                    @if($errors->any())
                        <div
                            style="background: #f8d7da; border-left: 4px solid #dc3545; padding: 20px; border-radius: 4px; margin-bottom: 20px;">
                            <div style="display: flex; align-items: start; gap: 15px;">
                                <i class="fas fa-exclamation-circle" style="font-size: 24px; color: #721c24;"></i>
                                <div>
                                    <strong style="color: #721c24;">Terjadi Kesalahan!</strong>
                                    <ul style="margin: 10px 0 0 20px; color: #721c24;">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- REVISION ALERT (Hidden by default) -->
                    <div id="revision_alert_container" class="hidden" style="margin-bottom: 30px;">
                        <div
                            style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 20px; border-radius: 4px;">
                            <div style="display: flex; align-items: start; gap: 15px;">
                                <div style="font-size: 24px; color: #856404;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <h3 style="margin: 0 0 10px 0; color: #856404; font-size: 16px;">Dokumen Perlu
                                        Perbaikan</h3>
                                    <p style="margin: 0 0 10px 0; font-size: 14px; color: #666;">
                                        Dokumen ini dikembalikan oleh <strong><span id="reviewer_name">Nama
                                                Reviewer</span></strong>
                                        (<span id="reviewer_role">Role</span>) pada <span
                                            id="revision_date">Tanggal</span>.
                                    </p>
                                    <div
                                        style="background: rgba(255,255,255,0.5); padding: 15px; border-radius: 6px; font-style: italic; color: #333; border: 1px solid rgba(0,0,0,0.05);">
                                        "<span id="revision_comment">Komentar revisi akan muncul di sini...</span>"
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM 2: Proses Bisnis/Kegiatan/Aset -->
                    <div class="section-header">
                        <h2>📋 Kolom 2: Proses Bisnis / Kegiatan / Aset</h2>
                        <p>Input proses bisnis dan kegiatan yang dilakukan</p>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Proses Bisnis <span class="required">*</span></label>
                            <input type="text" class="form-control" id="kolom2_proses" name="kolom2_proses" required
                                placeholder="Contoh: Produksi, Maintenance, Gudang...">
                        </div>
                        <div class="form-group">
                            <label>Kegiatan <span class="required">*</span></label>
                            <input type="text" class="form-control" id="kolom2_activity_manual" name="kolom2_kegiatan"
                                required placeholder="Jelaskan kegiatan spesifik...">
                        </div>
                    </div>

                    <!-- KOLOM 3: Lokasi/Area Kerja -->
                    <div class="section-header">
                        <h2>📍 Kolom 3: Lokasi / Area Kerja</h2>
                        <p>Input manual lokasi atau area kerja</p>
                    </div>

                    <div class="form-group">
                        <label>Lokasi / Area Kerja <span class="required">*</span></label>
                        <input type="text" class="form-control" id="kolom3_lokasi" name="kolom3_lokasi"
                            placeholder="Contoh: Gedung A Lantai 2, Area Produksi, dll" required>
                    </div>

                    <!-- KOLOM 4: Kategori Dokumen -->
                    <div class="section-header">
                        <h2>📑 Kolom 4: Kategori Dokumen</h2>
                        <p>Pilih jenis dokumen risiko</p>
                    </div>

                    <div class="form-group">
                        <label>Jenis Dokumen <span class="required">*</span></label>
                        <select class="form-control" id="kolom4_kategori" name="kategori" required
                            onchange="updateConditionOptions()">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="K3">K3 - Kesehatan & Keselamatan Kerja</option>
                            <option value="KO">KO - Keselamatan Operasional</option>
                            <option value="Lingkungan">Lingkungan - Dampak Lingkungan</option>
                            <option value="Keamanan">Keamanan - Keamanan & Proteksi</option>
                        </select>
                    </div>

                    <!-- KOLOM 5: Kondisi -->
                    <div class="section-header">
                        <h2>⚙️ Kolom 5: Kondisi</h2>
                        <p>Pilih kondisi kegiatan yang sesuai</p>
                    </div>

                    <div class="form-group">
                        <label>Kondisi <span class="required">*</span></label>
                        <select class="form-control" id="kolom5_kondisi" name="kolom5_kondisi" required>
                            <option value="">-- Pilih Kategori Terlebih Dahulu --</option>
                        </select>
                    </div>

                    <!-- KOLOM 6: Jenis Bahaya -->
                    <!-- KOLOM 6: Jenis Bahaya / Aspek / Ancaman -->
                    <div class="section-header">
                        <h2 id="kolom6_title">⚠️ Kolom 6: Jenis Bahaya / Aspek / Ancaman</h2>
                        <p id="kolom6_desc">Pilih jenis bahaya atau aspek yang sesuai dengan kategori</p>
                    </div>

                    <!-- K3 / KO Section: Unsafe Condition vs Unsafe Action -->
                    <div id="section_k3_ko" class="hidden">
                        <input type="hidden" name="bahaya_type" id="bahaya_type">
                        <div class="button-group">
                            <button type="button" class="btn-toggle active" id="btn_unsafe_condition"
                                onclick="selectBahayaType('condition')">
                                Bahaya (Unsafe Condition)
                            </button>
                            <button type="button" class="btn-toggle" id="btn_unsafe_action"
                                onclick="selectBahayaType('action')">
                                Bahaya (Unsafe Action)
                            </button>
                        </div>

                        <!-- Unsafe Condition -->
                        <div id="unsafe_condition_options" class="hidden">
                            <!-- Populated via JS -->
                        </div>

                        <!-- Unsafe Action -->
                        <div id="unsafe_action_options" class="hidden">
                            <!-- Populated via JS -->
                        </div>
                    </div>

                    <!-- Lingkungan Section -->
                    <div id="section_lingkungan" class="hidden">
                        <div id="lingkungan_options">
                            <!-- Populated via JS -->
                        </div>
                    </div>

                    <!-- Keamanan Section -->
                    <div id="section_keamanan" class="hidden">
                        <div id="keamanan_options">
                            <!-- Populated via JS -->
                        </div>
                    </div>

                    <!-- Manual Input (Always available but labeled dynamically) -->
                    <div class="form-group" style="margin-top: 20px;">
                        <label id="manual_bahaya_label">Input Bahaya/Aspek Lainnya (Manual)</label>
                        <input type="text" class="form-control" id="bahaya_manual" name="bahaya_manual"
                            placeholder="Deskripsikan potensi bahaya/aspek secara spesifik...">
                    </div>

                    <!-- KOLOM 7: Dampak/Konsekuensi -->
                    <div class="section-header">
                        <h2 id="kolom7_title">💥 Kolom 7: Dampak / Konsekuensi</h2>
                        <p id="kolom7_desc">Jelaskan dampak atau konsekuensi yang mungkin terjadi</p>
                    </div>

                    <div class="form-group">
                        <label id="kolom7_label">Dampak / Konsekuensi <span class="required">*</span></label>
                        <textarea class="form-control" id="kolom7_dampak" name="kolom7_dampak" required
                            placeholder="Jelaskan dampak yang mungkin terjadi akibat bahaya tersebut..."></textarea>
                    </div>



                    <!-- KOLOM 9: Identifikasi Risiko (Category-specific) -->
                    <div class="section-header">
                        <h2 id="kolom9_title">🔍 Kolom 9: Identifikasi Risiko K3/KO</h2>
                        <p id="kolom9_desc">Identifikasi risiko yang mungkin terjadi</p>
                    </div>

                    <div class="form-group">
                        <label id="kolom9_label">Identifikasi Risiko <span class="required">*</span></label>
                        <textarea class="form-control" id="kolom9_risiko" name="kolom9_risiko" required
                            placeholder="Jelaskan risiko yang teridentifikasi..."></textarea>
                    </div>

                    <!-- KOLOM 10: Hirarki Pengendalian (Checkboxes) -->
                    <div class="section-header">
                        <h2>🛡️ Kolom 10: Hirarki Pengendalian Risiko</h2>
                        <p>Pilih tingkat pengendalian yang akan diterapkan (Bisa lebih dari satu)</p>
                    </div>

                    <div class="form-group">
                        <label>Hirarki Pengendalian <span class="required">*</span></label>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="hirarki_eliminasi" name="hirarki[]" value="Eliminasi">
                                <label for="hirarki_eliminasi">1. Eliminasi (Menghilangkan bahaya sepenuhnya)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="hirarki_substitusi" name="hirarki[]" value="Substitusi">
                                <label for="hirarki_substitusi">2. Substitusi (Mengganti dengan yang lebih aman)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="hirarki_rekayasa" name="hirarki[]" value="Rekayasa Teknik">
                                <label for="hirarki_rekayasa">3. Rekayasa Teknik (Modifikasi teknis)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="hirarki_admin" name="hirarki[]" value="Administratif">
                                <label for="hirarki_admin">4. Administratif (Prosedur dan pelatihan)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="hirarki_apd" name="hirarki[]" value="APD">
                                <label for="hirarki_apd">5. APD (Alat Pelindung Diri)</label>
                            </div>
                        </div>

                        <!-- Dynamic Control Inputs -->
                        <div id="additional_controls" style="margin-top: 20px;">
                            <!-- Dynamic inputs will appear here -->
                        </div>

                        <button type="button" class="btn btn-secondary" onclick="addControlInput()"
                            style="margin-top: 10px; width: 100%;">
                            <i class="fas fa-plus"></i> Tambahkan Detail Pengendalian Baru
                        </button>
                    </div>

                    <!-- KOLOM 11: Pengendalian yang Sudah Dilakukan -->
                    <div class="section-header">
                        <h2>✅ Kolom 11: Pengendalian yang Sudah Dilakukan</h2>
                        <p>Jelaskan pengendalian yang sudah diterapkan saat ini (Berkaitan dengan Kolom 10)</p>
                    </div>

                    <div class="form-group">
                        <label>Pengendalian Existing <span class="required">*</span></label>
                        <textarea class="form-control" id="kolom11_pengendalian" name="kolom11_existing" required
                            placeholder="Jelaskan pengendalian yang sudah diterapkan sesuai hirarki yang dipilih..."></textarea>
                    </div>

                    <!-- KOLOM 12-14: Penilaian Risiko Awal -->
                    <!-- Note: Kolom 10-11 Matrix removed as per request -->
                    <div class="section-header">
                        <h2>📊 Kolom 12-14: Penilaian Risiko Awal</h2>
                        <p>Tentukan tingkat kemungkinan dan konsekuensi untuk menghitung risiko</p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label>Kolom 12: Nilai Kemungkinan (Likelihood) <span class="required">*</span></label>
                            <select class="form-control" id="kolom12_kemungkinan" name="kolom12_kemungkinan" required
                                onchange="calculateRisk()">
                                <option value="">-- Pilih --</option>
                                <option value="1">1 - Sangat Jarang (Hampir tidak pernah terjadi)</option>
                                <option value="2">2 - Jarang (Terjadi dalam kondisi tertentu)</option>
                                <option value="3">3 - Kadang-kadang (Mungkin terjadi)</option>
                                <option value="4">4 - Sering (Kemungkinan besar terjadi)</option>
                                <option value="5">5 - Sangat Sering (Hampir pasti terjadi)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kolom 13: Nilai Konsekuensi (Consequence) <span class="required">*</span></label>
                            <select class="form-control" id="kolom13_konsekuensi" name="kolom13_konsekuensi" required
                                onchange="calculateRisk()">
                                <option value="">-- Pilih --</option>
                                <option value="1">1 - Tidak Signifikan (Cedera ringan)</option>
                                <option value="2">2 - Minor (Cedera sedang, P3K)</option>
                                <option value="3">3 - Moderate (Cedera berat, rawat inap)</option>
                                <option value="4">4 - Major (Cacat permanen)</option>
                                <option value="5">5 - Catastrophic (Fatality/kematian)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kolom 14: Nilai & Tingkat Risiko (Auto-calculated)</label>
                        <div style="display: flex; gap: 15px; align-items: center;">
                            <input type="text" class="form-control" id="kolom14_nilai_risiko" readonly
                                style="max-width: 100px; font-weight: 700; font-size: 18px; text-align: center;">
                            <span id="kolom14_tingkat_risiko"
                                style="padding: 8px 20px; border-radius: 6px; font-weight: 700; font-size: 14px;">
                                -
                            </span>
                        </div>
                    </div>

                    <!-- KOLOM 15: Peraturan Perundangan -->
                    <div class="section-header">
                        <h2>📜 Kolom 15: Peraturan Perundangan Terkait</h2>
                        <p>Sebutkan regulasi atau peraturan yang relevan</p>
                    </div>

                    <div class="form-group">
                        <label>Peraturan Perundangan</label>
                        <textarea class="form-control" id="kolom15_peraturan" name="kolom15_regulasi"
                            oninput="checkRegulasi()"
                            placeholder="Contoh: UU No. 1 Tahun 1970, PP No. 50 Tahun 2012, dll..."></textarea>
                    </div>

                    <!-- KOLOM 16: Aspek Lingkungan Penting (Lingkungan only but shown for all per logic) -->
                    <!-- Note: Logic adjusted. Usually P/TP is for Lingkungan. Assuming generic P/TP concept here. -->
                    <div class="section-header" id="kolom16_section">
                        <h2>🌿 Kolom 16: Aspek Penting (P/TP)</h2>
                        <p>Tentukan apakah aspek ini penting (P) atau tidak penting (TP)</p>
                    </div>

                    <div class="form-group" id="kolom16_container">
                        <label>Status Penting?</label>
                        <div style="display: flex; gap: 20px;">
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="radio" name="kolom16_penting" value="P">
                                <span>P - Penting (Diatur Undang-Undang / Risiko Tinggi)</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="radio" name="kolom16_penting" value="TP">
                                <span>TP - Tidak Penting</span>
                            </label>
                        </div>
                    </div>

                    <!-- KOLOM 17: Risiko & Peluang (Split) -->
                    <div class="section-header">
                        <h2>💡 Kolom 17: Risiko & Peluang</h2>
                        <p>Identifikasi risiko dan peluang untuk perbaikan</p>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Risiko</label>
                            <textarea class="form-control" id="kolom17_risiko" name="kolom17_risiko"
                                placeholder="Jelaskan risiko yang perlu dimitigasi..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Peluang</label>
                            <textarea class="form-control" id="kolom17_peluang" name="kolom17_peluang"
                                placeholder="Jelaskan peluang untuk improvement..."></textarea>
                        </div>
                    </div>

                    <!-- KOLOM 18: Risiko Dapat Ditoleransi -->
                    <div class="section-header">
                        <h2>⚖️ Kolom 18: Risiko Dapat Ditoleransi?</h2>
                        <p>Tentukan apakah risiko dapat diterima atau perlu tindakan lanjut</p>
                    </div>

                    <div class="form-group">
                        <label>Risiko Dapat Ditoleransi? <span class="required">*</span></label>
                        <div style="display: flex; gap: 20px;">
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="radio" name="kolom18_toleransi" value="Ya" required>
                                <span>Ya - Risiko dapat diterima</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="radio" name="kolom18_toleransi" value="Tidak" required>
                                <span>Tidak - Perlu tindakan lanjut</span>
                            </label>
                        </div>
                    </div>

                    <!-- KOLOM 19: Pengendalian Tindak Lanjut -->
                    <div class="section-header">
                        <h2>🎯 Kolom 19: Pengendalian Tindak Lanjut</h2>
                        <p>Rencana tindakan untuk mengendalikan risiko</p>
                    </div>

                    <div class="form-group">
                        <label>Pengendalian Tindak Lanjut <span class="required">*</span></label>
                        <textarea class="form-control" id="kolom19_tindak_lanjut" name="kolom18_tindak_lanjut" required
                            placeholder="Jelaskan rencana tindakan yang akan dilakukan untuk mengendalikan risiko..."></textarea>
                    </div>

                    <!-- KOLOM 20-22: Penilaian Risiko Ulang (Residual Risk) -->
                    <div class="section-header">
                        <h2>🔄 Kolom 20-22: Penilaian Risiko Ulang (Residual Risk)</h2>
                        <p>Penilaian ulang setelah pengendalian diterapkan</p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label>Kolom 20: Nilai Kemungkinan Ulang <span class="required">*</span></label>
                            <select class="form-control" id="kolom20_kemungkinan" name="residual_kemungkinan" required
                                onchange="calculateResidualRisk()">
                                <option value="">-- Pilih --</option>
                                <option value="1">1 - Sangat Jarang</option>
                                <option value="2">2 - Jarang</option>
                                <option value="3">3 - Kadang-kadang</option>
                                <option value="4">4 - Sering</option>
                                <option value="5">5 - Sangat Sering</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kolom 21: Nilai Konsekuensi Ulang <span class="required">*</span></label>
                            <select class="form-control" id="kolom21_konsekuensi" name="residual_konsekuensi" required
                                onchange="calculateResidualRisk()">
                                <option value="">-- Pilih --</option>
                                <option value="1">1 - Tidak Signifikan</option>
                                <option value="2">2 - Minor</option>
                                <option value="3">3 - Moderate</option>
                                <option value="4">4 - Major</option>
                                <option value="5">5 - Catastrophic</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kolom 22: Nilai Risiko Residual (Auto-calculated)</label>
                        <div style="display: flex; gap: 15px; align-items: center;">
                            <input type="text" class="form-control" id="kolom22_nilai_risiko" readonly
                                style="max-width: 100px; font-weight: 700; font-size: 18px; text-align: center;">
                            <span id="kolom22_tingkat_risiko"
                                style="padding: 8px 20px; border-radius: 6px; font-weight: 700; font-size: 14px;">
                                -
                            </span>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <input type="hidden" name="submit_for_approval" value="1">
                        <a href="{{ route('documents.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim untuk Review
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>


        // ---- NEW HAZARD DATA STRUCTURE ----
        const hazardData = {
            k3_condition: {
                "Fisika": ["Bekerja di ketinggian", "Permukaan licin", "Permukaan tidak selevel", "Kejatuhan material", "Ruang kerja terbatas", "Pekerjaan berulang", "Tersangkut/Terjerat", "Terbakar/Peledakan", "Benda berputar", "Radiasi", "Bising", "Tersengat listrik", "Getaran", "Gas bertekanan", "Suhu ekstrim"],
                "Kimia": ["Terhirup bahan kimia", "Kontak bahan kimia", "Tertelan bahan kimia", "Penyimpanan tidak sesuai", "Limbah kimia tidak sesuai"],
                "Biologi": ["Virus", "Bakteri", "Ular", "Serangga", "Laba-laba", "Nyamuk", "Makanan kadaluarsa/terkontaminasi"]
            },
            k3_action: {
                "Fisiologis/Ergonomi": ["Pengangkatan manual berlebih", "Gerakan berulang", "Posisi kerja buruk", "Layout kerja buruk"],
                "Psikologis": ["Bekerja berlebihan", "Gelisah", "Intimidasi", "Kekerasan fisik", "Ancaman"],
                "Prilaku": ["Tidak pakai APD", "Tidak konsentrasi", "Short cut", "Bercanda saat kerja", "Abaikan prosedur"]
            },
            lingkungan: {
                "Emisi ke udara": "Contoh: Emisi debu, gas (asap, uap, fume)",
                "Pembuangan ke air": "Contoh: Tumpahan oli, limbah laboratorium",
                "Pembuangan ke tanah": "Contoh: Tumpahan oli, limbah lab, terak, sampah",
                "Penggunaan Bahan Baku & SDA": "Contoh: Penggunaan air, kertas, bahan uji",
                "Penggunaan energi": "Contoh: Listrik",
                "Paparan energi": "Contoh: Panas, radiasi, getaran",
                "Limbah": "Contoh: Limbah B3 (padat/cair/gas), Limbah Non B3"
            },
            keamanan: [
                "Terorisme", "Sabotase", "Intimidasi", "Pencurian", "Perusakan aset"
            ]
        };

        function selectBahayaType(type) {
            document.getElementById('bahaya_type').value = type;
            const btnCondition = document.getElementById('btn_unsafe_condition');
            const btnAction = document.getElementById('btn_unsafe_action');
            const divCondition = document.getElementById('unsafe_condition_options');
            const divAction = document.getElementById('unsafe_action_options');

            if (type === 'condition') {
                btnCondition.classList.add('active');
                btnAction.classList.remove('active');
                divCondition.classList.remove('hidden');
                divAction.classList.add('hidden');
            } else {
                btnCondition.classList.remove('active');
                btnAction.classList.add('active');
                divCondition.classList.add('hidden');
                divAction.classList.remove('hidden');
            }
        }

        function updateBahayaContent(category) {
            // Hide all first
            document.getElementById('section_k3_ko').classList.add('hidden');
            document.getElementById('section_lingkungan').classList.add('hidden');
            document.getElementById('section_keamanan').classList.add('hidden');

            const containerCondition = document.getElementById('unsafe_condition_options');
            const containerAction = document.getElementById('unsafe_action_options');
            const containerLingkungan = document.getElementById('lingkungan_options');
            const containerKeamanan = document.getElementById('keamanan_options');

            if (category === 'K3' || category === 'KO') {
                document.getElementById('section_k3_ko').classList.remove('hidden');
                document.getElementById('manual_bahaya_label').textContent = "Input Bahaya Lainnya (Manual)";

                // Render K3 Conditions
                containerCondition.innerHTML = renderK3Checkboxes(hazardData.k3_condition, 'cond');
                // Render K3 Actions
                containerAction.innerHTML = renderK3Checkboxes(hazardData.k3_action, 'act');

                // Default to Condition
                selectBahayaType('condition');

            } else if (category === 'Lingkungan') {
                document.getElementById('section_lingkungan').classList.remove('hidden');
                document.getElementById('manual_bahaya_label').textContent = "Input Aspek Lingkungan Lainnya (Manual)";

                let html = '<div class="checkbox-group">';
                for (const [key, desc] of Object.entries(hazardData.lingkungan)) {
                    html += `
                        <div class="checkbox-item" style="flex-direction:column; align-items:flex-start;">
                            <div style="display:flex; align-items:center; width:100%;">
                                <input type="checkbox" name="bahaya_aspect[]" value="${key}">
                                <label style="margin-left:10px;">${key}</label>
                            </div>
                            <div style="font-size:11px; color:#666; margin-left:30px; margin-top:2px;">${desc}</div>
                        </div>
                    `;
                }
                html += '</div>';
                containerLingkungan.innerHTML = html;

            } else if (category === 'Keamanan') {
                document.getElementById('section_keamanan').classList.remove('hidden');
                document.getElementById('manual_bahaya_label').textContent = "Input Ancaman Keamanan Lainnya (Manual)";

                let html = '<div class="checkbox-group">';
                hazardData.keamanan.forEach(item => {
                    html += `
                        <div class="checkbox-item">
                            <input type="checkbox" name="bahaya_security[]" value="${item}">
                            <label style="margin-left:10px;">${item}</label>
                        </div>
                    `;
                });
                html += '</div>';
                containerKeamanan.innerHTML = html;
            }
        }

        function renderK3Checkboxes(data, prefix) {
            let html = '<div class="checkbox-group">';
            for (const [subCat, examples] of Object.entries(data)) {

                const idSafe = subCat.replace(/[^a-zA-Z0-9]/g, '_');
                html += `
                    <div class="checkbox-item" style="flex-wrap:wrap;">
                        <div style="display:flex; align-items:center; width:100%;">
                            <input type="checkbox" id="chk_${prefix}_${idSafe}" onchange="toggleChild('${prefix}_${idSafe}')">
                            <label for="chk_${prefix}_${idSafe}" style="margin-left:10px; font-weight:bold;">${subCat}</label>
                        </div>
                        <div id="child_${prefix}_${idSafe}" class="hidden" style="width:100%; margin-left:30px; margin-top:10px; border-top:1px dashed #eee; padding-top:10px;">
                            ${examples.map(ex => `
                                <div style="margin-bottom:5px;">
                                    <label style="font-weight:normal; font-size:13px; display:flex; align-items:center;">
                                        <input type="checkbox" name="bahaya_detail[]" value="${subCat}: ${ex}"> 
                                        <span style="margin-left:8px;">${ex}</span>
                                    </label>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;
            }
            html += '</div>';
            return html;
        }

        function toggleChild(idSuffix) {
            const parentChk = document.getElementById(`chk_${idSuffix}`);
            const childDiv = document.getElementById(`child_${idSuffix}`);
            if (parentChk.checked) {
                childDiv.classList.remove('hidden');
            } else {
                childDiv.classList.add('hidden');
                const checkboxes = childDiv.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(cb => cb.checked = false);
            }
        }

        // Auto-check Regulation Logic
        function checkRegulasi() {
            const val = document.getElementById('kolom15_peraturan').value;
            const radioP = document.querySelector('input[name="kolom16_penting"][value="P"]');
            const radioTP = document.querySelector('input[name="kolom16_penting"][value="TP"]');

            if (val.trim().length > 0) {
                radioP.checked = true;
            } else {
                radioTP.checked = true;
            }
        }

        function updateConditionOptions() {
            const category = document.getElementById('kolom4_kategori').value;
            const conditionSelect = document.getElementById('kolom5_kondisi');

            // Clear current options
            conditionSelect.innerHTML = '<option value="">-- Pilih Kondisi --</option>';

            let options = [];

            if (category === 'K3' || category === 'KO') {
                options = [
                    { val: 'R', text: 'R - Rutin (Kegiatan sehari-hari)' },
                    { val: 'NR', text: 'NR - Non Rutin (Maintenance, Shut down, dll)' },
                    { val: 'EM', text: 'EM - Emergency' }
                ];
            } else if (category === 'Lingkungan') {
                options = [
                    { val: 'N', text: 'N - Normal' },
                    { val: 'TN', text: 'TN - Tak Normal' },
                    { val: 'EM', text: 'EM - Emergency' }
                ];
            } else if (category === 'Keamanan') {
                options = [
                    { val: 'EM', text: 'EM - Emergency' }
                ];
            }

            options.forEach(opt => {
                const option = document.createElement('option');
                option.value = opt.val;
                option.textContent = opt.text;
                conditionSelect.appendChild(option);
            });

            if (typeof updateBahayaContent === 'function') {
                updateBahayaContent(category);
            }
        }

        function addControlInput() {
            const container = document.getElementById('additional_controls');
            const index = container.children.length + 1;
            const div = document.createElement('div');
            div.style.marginBottom = '10px';
            div.innerHTML = `
                <div style="display:flex; gap:10px;">
                    <select class="form-control" name="new_controls[${index}][type]" style="width: 30%;">
                         <option value="Eliminasi">Eliminasi</option>
                         <option value="Substitusi">Substitusi</option>
                         <option value="Rekayasa Teknik">Rekayasa Teknik</option>
                         <option value="Administratif">Administratif</option>
                         <option value="APD">APD</option>
                    </select>
                    <input type="text" class="form-control" name="new_controls[${index}][desc]" placeholder="Deskripsi pengendalian baru...">
                    <button type="button" class="btn btn-secondary" style="padding: 0 15px; color: red;" onclick="this.parentElement.parentElement.remove()">X</button>
                </div>
            `;
            container.appendChild(div);
        }

        // Calculate Risk (Kolom 12-14)
        function calculateRisk() {
            const likelihood = parseInt(document.getElementById('kolom12_kemungkinan').value);
            const consequence = parseInt(document.getElementById('kolom13_konsekuensi').value);

            if (likelihood && consequence) {
                const riskScore = likelihood * consequence;
                let riskLevel = '';
                let riskColor = '';

                if (riskScore >= 1 && riskScore <= 3) {
                    riskLevel = 'RENDAH';
                    riskColor = '#28a745'; // Green
                } else if (riskScore >= 4 && riskScore <= 9) {
                    riskLevel = 'SEDANG';
                    riskColor = '#ffc107'; // Yellow
                } else if (riskScore >= 10 && riskScore <= 16) {
                    riskLevel = 'TINGGI';
                    riskColor = '#fd7e14'; // Orange
                } else if (riskScore >= 20 && riskScore <= 25) {
                    riskLevel = 'SANGAT TINGGI';
                    riskColor = '#dc3545'; // Red
                }

                document.getElementById('kolom14_nilai_risiko').value = riskScore;
                const tingkatRisiko = document.getElementById('kolom14_tingkat_risiko');
                tingkatRisiko.textContent = riskLevel;
                tingkatRisiko.style.backgroundColor = riskColor;
                tingkatRisiko.style.color = 'white';
            }
        }

        // Calculate Residual Risk (Kolom 20-22)
        function calculateResidualRisk() {
            const likelihood = parseInt(document.getElementById('kolom20_kemungkinan').value);
            const consequence = parseInt(document.getElementById('kolom21_konsekuensi').value);

            if (likelihood && consequence) {
                const riskScore = likelihood * consequence;
                let riskLevel = '';
                let riskColor = '';

                if (riskScore >= 1 && riskScore <= 3) {
                    riskLevel = 'RENDAH';
                    riskColor = '#28a745';
                } else if (riskScore >= 4 && riskScore <= 9) {
                    riskLevel = 'SEDANG';
                    riskColor = '#ffc107';
                } else if (riskScore >= 10 && riskScore <= 16) {
                    riskLevel = 'TINGGI';
                    riskColor = '#fd7e14';
                } else if (riskScore >= 20 && riskScore <= 25) {
                    riskLevel = 'SANGAT TINGGI';
                    riskColor = '#dc3545';
                }

                document.getElementById('kolom22_nilai_risiko').value = riskScore;
                const tingkatRisiko = document.getElementById('kolom22_tingkat_risiko');
                tingkatRisiko.textContent = riskLevel;
                tingkatRisiko.style.backgroundColor = riskColor;
                tingkatRisiko.style.color = 'white';
            }
        }


        // MOCK DATA FOR EDIT MODE
        const mockDocuments = {
            'DOC-102': {
                id: 'DOC-102',
                proses: 'PRODUKSI',
                kegiatan_lain: 'Pembuangan Limbah Cair',
                lokasi: 'Area IPAL Unit Produksi',
                kategori: 'Lingkungan',
                kondisi: 'R',
                bahaya_type: 'condition',
                bahaya_kategori: 'kimia',
                bahaya_detail: ['Cairan korosif'],
                bahaya_manual: '',
                dampak: 'Pencemaran air sungai dan tanah sekitar, potensi iritasi kulit pada pekerja.',
                pihak: ['Lingkungan', 'Masyarakat'],
                pihak_lain: '',
                bahaya_identifikasi: 'Kebocoran pipa pembuangan limbah',
                risiko_k3: 'Iritasi kulit',
                risiko_lingkungan: 'Pencemaran sungai',
                regulasi: 'UU No. 32 Tahun 2009 tentang PPLH',
                keparahan: '3',
                frekuensi_k3: '2',
                kemungkinan_lingkungan: '3',
                // Control
                eliminasi: '',
                substitusi: '',
                rekayasa: 'Pemasangan sensor kebocoran otomatis',
                administrasi: 'SOP Penanganan Limbah Cair',
                apd: 'Sarung tangan karet, Sepatu safety boot',
                // Result
                kemungkinan_akhir: '1',
                konsekuensi_akhir: '3'
            },
            'DOC-107': {
                id: 'DOC-107',
                proses: 'PRODUKSI',
                kegiatan_lain: 'Maschine Running',
                lokasi: 'Factory Floor 1',
                kategori: 'K3',
                kondisi: 'N',
                bahaya_type: 'condition',
                bahaya_kategori: 'fisika',
                bahaya_detail: ['Kebisingan'],
                bahaya_manual: '',
                dampak: 'Gangguan pendengaran permanen (NIHL) pada pekerja jika terpapar jangka panjang.',
                pihak: ['Pekerja'],
                pihak_lain: '',
                bahaya_identifikasi: 'Suara mesin turbin lebihi 85dB',
                risiko_k3: 'Tuli konduktif',
                risiko_lingkungan: '',
                regulasi: 'Permenaker No. 5 Tahun 2018',
                keparahan: '4',
                frekuensi_k3: '4',
                kemungkinan_lingkungan: '',
                // Control
                eliminasi: '',
                substitusi: '',
                rekayasa: 'Pemasangan silencer pada mesin',
                administrasi: 'Rotasi kerja, Training kebisingan',
                apd: 'Ear plug / Ear muff',
                // Result
                kemungkinan_akhir: '2',
                konsekuensi_akhir: '4'
            }
        };

        const revisionComments = {
            'DOC-102': {
                reviewer: 'Kepala Unit Produksi',
                name: 'Budi Santoso',
                date: '08 Jan 2026',
                comment: 'Mohon lengkapi data tindakan pengendalian pada kolom 13. Sertakan juga timeline implementasi yang lebih detail.'
            },
            'DOC-107': {
                reviewer: 'Kepala Unit Produksi',
                name: 'Ahmad Rizki',
                date: '22 Des 2025',
                comment: 'Data pengukuran kebisingan perlu dilengkapi dengan hasil kalibrasi alat ukur. Tambahkan juga rekomendasi APD yang spesifik.'
            }
        };

        // CHECK FOR EDIT MODE ON LOAD
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const mode = urlParams.get('mode');
            const docId = urlParams.get('id');

            if (mode === 'edit' && docId) {
                loadDocumentData(docId);
            }
        });

        function loadDocumentData(id) {
            // Check for global editingDocument loaded from Controller
            if (typeof editingDocument === 'undefined' || !editingDocument) return;

            const doc = editingDocument;
            const rev = doc.latest_approval_rejection;
            if (doc.status === 'revision' && rev) {
                document.getElementById('revision_alert_container').classList.remove('hidden');
                document.getElementById('reviewer_name').textContent = rev.approver ? rev.approver.name : 'Unknown';
                document.getElementById('reviewer_role').textContent = rev.approver ? rev.approver.role_user.replace('_', ' ').toUpperCase() : '-';
                document.getElementById('revision_date').textContent = new Date(rev.created_at).toLocaleDateString();
                document.getElementById('revision_comment').textContent = rev.catatan;

                // Scroll to top
                window.scrollTo(0, 0);
            }

            // 2. Pre-fill Form Fields
            if (document.getElementById('kolom2_proses')) document.getElementById('kolom2_proses').value = doc.kolom2_proses || '';

            if (document.getElementById('kolom2_activity_manual')) document.getElementById('kolom2_activity_manual').value = doc.kolom2_kegiatan || '';
            if (document.getElementById('kolom3_lokasi')) document.getElementById('kolom3_lokasi').value = doc.kolom3_lokasi || '';
            if (document.getElementById('kolom4_kategori')) {
                document.getElementById('kolom4_kategori').value = doc.kategori;
                updateConditionOptions();
            }
            if (document.getElementById('kolom5_kondisi')) document.getElementById('kolom5_kondisi').value = doc.kolom5_kondisi || '';

            // Bahaya Type
            // 3. Pre-fill Kolom 6 (Bahaya) JSON Data
            if (doc.kolom6_bahaya && typeof doc.kolom6_bahaya === 'object') {
                const hazard = doc.kolom6_bahaya;

                if (hazard.type) selectBahayaType(hazard.type);

                if (document.getElementById('bahaya_manual')) {
                    document.getElementById('bahaya_manual').value = hazard.manual || '';
                }

                if ((doc.kategori === 'K3' || doc.kategori === 'KO') && hazard.details && Array.isArray(hazard.details)) {
                    hazard.details.forEach(val => {
                        const chk = document.querySelector(`input[name="bahaya_detail[]"][value="${val}"]`);
                        if (chk) {
                            chk.checked = true;
                            const parentDiv = chk.closest('div[id^="child_"]');
                            if (parentDiv) {
                                parentDiv.classList.remove('hidden');
                                const parentId = parentDiv.id.replace('child_', 'chk_');
                                const parentChk = document.getElementById(parentId);
                                if (parentChk) parentChk.checked = true;
                            }
                        }
                    });
                }
                else if (doc.kategori === 'Lingkungan' && hazard.aspects && Array.isArray(hazard.aspects)) {
                    hazard.aspects.forEach(val => {
                        const chk = document.querySelector(`input[name="bahaya_aspect[]"][value="${val}"]`);
                        if (chk) chk.checked = true;
                    });
                }
                else if (doc.kategori === 'Keamanan' && hazard.threats && Array.isArray(hazard.threats)) {
                    hazard.threats.forEach(val => {
                        const chk = document.querySelector(`input[name="bahaya_security[]"][value="${val}"]`);
                        if (chk) chk.checked = true;
                    });
                }
            }

            document.getElementById('kolom7_dampak').value = doc.dampak;

            document.getElementById('kolom7_dampak').value = doc.dampak;

            // Pihak (Legacy removed)

            if (document.getElementById('kolom7_dampak')) document.getElementById('kolom7_dampak').value = doc.kolom7_dampak || '';
            if (document.getElementById('kolom9_risiko')) document.getElementById('kolom9_risiko').value = doc.kolom9_risiko || '';

            // 4. Pre-fill Kolom 10 (Pengendalian) JSON
            if (doc.kolom10_pengendalian && typeof doc.kolom10_pengendalian === 'object') {
                const controls = doc.kolom10_pengendalian;

                if (controls.hierarchy && Array.isArray(controls.hierarchy)) {
                    controls.hierarchy.forEach(val => {
                        const chk = document.querySelector(`input[name="hirarki[]"][value="${val}"]`);
                        if (chk) chk.checked = true;
                    });
                }

                if (controls.new_controls && Array.isArray(controls.new_controls)) {
                    const container = document.getElementById('additional_controls');
                    if (container) {
                        controls.new_controls.forEach((nc, idx) => {
                            const index = container.children.length + 1;
                            const div = document.createElement('div');
                            div.style.marginBottom = '10px';
                            div.innerHTML = `
                                <div style="display:flex; gap:10px;">
                                    <select class="form-control" name="new_controls[${index}][type]" style="width: 30%;">
                                         <option value="Eliminasi" ${nc.type == 'Eliminasi' ? 'selected' : ''}>Eliminasi</option>
                                         <option value="Substitusi" ${nc.type == 'Substitusi' ? 'selected' : ''}>Substitusi</option>
                                         <option value="Rekayasa Teknik" ${nc.type == 'Rekayasa Teknik' ? 'selected' : ''}>Rekayasa Teknik</option>
                                         <option value="Administratif" ${nc.type == 'Administratif' ? 'selected' : ''}>Administratif</option>
                                         <option value="APD" ${nc.type == 'APD' ? 'selected' : ''}>APD</option>
                                    </select>
                                    <input type="text" class="form-control" name="new_controls[${index}][desc]" value="${nc.desc}" placeholder="Deskripsi pengendalian baru...">
                                    <button type="button" class="btn btn-secondary" style="padding: 0 15px; color: red;" onclick="this.parentElement.parentElement.remove()">X</button>
                                </div>
                            `;
                            container.appendChild(div);
                        });
                    }
                }
            }

            if (document.getElementById('kolom11_pengendalian')) document.getElementById('kolom11_pengendalian').value = doc.kolom11_existing || '';
            if (document.getElementById('kolom15_peraturan')) {
                document.getElementById('kolom15_peraturan').value = doc.kolom15_regulasi || '';
                checkRegulasi();
            }

            // Risk Assessment
            if (doc.kategori === 'Lingkungan') {
                document.getElementById('kolom14_frekuensi_k3').value = 0; // Reset
                document.getElementById('kolom14_kemungkinan_lingkungan').value = doc.kemungkinan_lingkungan;
            } else {
                document.getElementById('kolom14_frekuensi_k3').value = doc.frekuensi_k3;
            }
            document.getElementById('kolom14_keparahan').value = doc.keparahan;
            calculateRisk(); // Recalculate

            // Controls
            document.getElementById('kolom15_rekayasa').value = doc.rekayasa;
            document.getElementById('kolom16_administrasi').value = doc.administrasi;
            document.getElementById('kolom17_apd').value = doc.apd;

            // Residual
            document.getElementById('kolom20_kemungkinan').value = doc.kemungkinan_akhir;
            document.getElementById('kolom21_konsekuensi').value = doc.konsekuensi_akhir;
            calculateResidualRisk();
        }

    </script>
</body>

</html>