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
            width: 250px;
            background: white;
            border-right: 1px solid #e0e0e0;
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 50;
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
        <!-- Sidebar -->
        @include('user.partials.sidebar')

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
                    <!-- Hidden Metadata -->
                    <input type="hidden" id="auto_probis_value"
                        value="{{ isset($user->seksi->probis) ? $user->seksi->probis->nama_probis : (isset($user->unit->probis) ? $user->unit->probis->nama_probis : '') }}">

                    <!-- Document Title Section -->
                    <div
                        style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #1e293b;">
                                Judul Form <span style="color: #ef4444;">*</span>
                            </label>
                            <input type="text" name="judul_dokumen" class="form-control" required
                                placeholder="Contoh: Identifikasi Bahaya Area Produksi Line 1"
                                style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
                            <small style="display: block; margin-top: 6px; color: #64748b;">
                                Berikan judul yang jelas untuk form HIRADC ini.
                            </small>
                        </div>
                    </div>

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

                    <div id="items-container">
                        <!-- Items will be injected here by JS -->
                    </div>


                    <div style="text-align: center; margin-bottom: 40px;">
                        <button type="button" class="btn btn-secondary" onclick="addItem()"
                            style="border: 2px dashed #cbd5e1; background: white; width: 100%; justify-content: center; padding: 20px;">
                            <i class="fas fa-plus-circle" style="font-size: 18px; color: var(--primary-color);"></i>
                            Tambah Kegiatan / Aktivitas Lain
                        </button>
                    </div>

                    <!-- Action Bar (Static Position) -->
                    <div class="action-bar">
                        <div class="action-info">
                            <i class="fas fa-check-circle" style="color: #10b981;"></i>
                            <span>Pastikan semua data sudah terisi dengan benar.</span>
                        </div>
                        <div class="action-buttons">
                            <a href="{{ route('documents.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <input type="hidden" name="submit_for_approval" value="1">
                            <button type="button" id="btnSubmit" class="btn btn-primary" onclick="validateForm()">
                                <i class="fas fa-paper-plane"></i> Kirim Form
                            </button>
                        </div>
                    </div>



                </form>
            </div>
        </main>
    </div>

    <!-- ITEM TEMPLATE (Hidden) -->
    <template id="item-template">
        <div class="doc-item" data-index="{index}" style="margin-bottom: 30px; transition: all 0.3s ease;">
            <div class="doc-card"
                style="border-left: 5px solid var(--primary-color); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border-radius: 12px; overflow: hidden; background: white;">

                <!-- Card Header -->
                <div class="card-header"
                    style="justify-content: space-between; background: linear-gradient(to right, #fff1f2, #fff); padding: 15px 25px; border-bottom: 1px solid #fce7f3; cursor: pointer;"
                    onclick="toggleCollapse(this)">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div class="header-icon"
                            style="background: var(--primary-color); color: white; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%; box-shadow: 0 2px 4px rgba(196, 30, 58, 0.3);">
                            <span class="item-number" style="font-weight: 700; font-size: 14px;">#{displayIndex}</span>
                        </div>
                        <div class="header-title">
                            <h2 style="font-size: 16px; margin: 0; color: #881337; font-weight: 700;">Detail Kegiatan
                            </h2>
                            <span class="item-summary"
                                style="font-size: 12px; color: #64748b; font-weight: 500; display: none;">(Klik untuk
                                expand)</span>
                        </div>
                    </div>
                    <div class="header-actions" style="display: flex; gap: 10px;">
                        <button type="button" class="btn-collapse"
                            style="background: transparent; border: none; color: #64748b; cursor: pointer;"
                            title="Minimize">
                            <i class="fas fa-chevron-up transition-transform"></i>
                        </button>
                        <button type="button" class="btn-remove-item"
                            onclick="removeItem(this); event.stopPropagation();"
                            style="background: white; border: 1px solid #fecaca; color: #ef4444; cursor: pointer; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 6px; transition: all 0.2s;">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body collapsible-content" style="padding: 25px;">

                    <!-- 1. Basic Info -->
                    <div style="margin-bottom: 25px;">
                        <h3
                            style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                            <i class="fas fa-info-circle" style="color: var(--primary-color); margin-right: 8px;"></i>
                            1. Informasi Dasar
                        </h3>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">Proses Bisnis</label>
                                <input type="text" class="form-control probis-input"
                                    name="items[{index}][kolom2_proses]" readonly
                                    style="background-color: #f8fafc; color: #64748b; cursor: not-allowed; border-color: #e2e8f0;">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kegiatan <span class="required">*</span></label>
                                <input type="text" class="form-control item-kegiatan-input"
                                    name="items[{index}][kolom2_kegiatan]" required
                                    placeholder="Contoh: Pengelasan Pipa..." oninput="updateSummary(this)">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Lokasi <span class="required">*</span></label>
                                <input type="text" class="form-control" name="items[{index}][kolom3_lokasi]" required
                                    placeholder="Contoh: Area Workshop...">
                            </div>
                            <!-- NEW: Pihak Berkepentingan -->
                            <div class="form-group">
                                <label class="form-label">Pihak Berkepentingan (Optional)</label>
                                <input type="text" class="form-control" name="items[{index}][kolom4_pihak]"
                                    placeholder="Contoh: Internal, Kontraktor, Tamu...">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kategori <span class="required">*</span></label>
                                <select class="form-control category-select" name="items[{index}][kategori]" required
                                    onchange="updateConditions(this)">
                                    <option value="">-- Pilih --</option>
                                    <option value="K3">K3 - Kesehatan & Keselamatan</option>
                                    <option value="KO">KO - Keselamatan Operasional</option>
                                    <option value="Lingkungan">Lingkungan</option>
                                    <option value="Keamanan">Keamanan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kondisi <span class="required">*</span></label>
                                <select class="form-control condition-select" name="items[{index}][kolom5_kondisi]"
                                    required>
                                    <option value="">-- Pilih Kategori Dulu --</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Identifikasi (Bahaya/Aspek/Ancaman) -->
                    <div style="margin-bottom: 25px;">
                        <h3
                            style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                            <i class="fas fa-exclamation-triangle" style="color: #f59e0b; margin-right: 8px;"></i>
                            BAGIAN 2: Identifikasi
                        </h3>

                        <!-- Column 6: POTENSI BAHAYA (K3/KO) -->
                        <div class="hazard-section k3-ko-field" data-category="K3,KO"
                            style="background: #fffbeb; padding: 20px; border-radius: 8px; border: 1px solid #fcd34d; margin-bottom: 15px;">
                            <label class="form-label" style="font-weight: 600;">
                                <i class="fas fa-hard-hat" style="color: #f59e0b;"></i>
                                Kolom 6: POTENSI BAHAYA (K3/KO)
                            </label>
                            <div class="hazard-options checkbox-grid"
                                style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
                                <label class="checkbox-card"><input type="checkbox"
                                        name="items[{index}][kolom6_bahaya][]" value="Bahaya Fisika"> Bahaya
                                    Fisika</label>
                                <label class="checkbox-card"><input type="checkbox"
                                        name="items[{index}][kolom6_bahaya][]" value="Bahaya Kimia"> Bahaya
                                    Kimia</label>
                                <label class="checkbox-card"><input type="checkbox"
                                        name="items[{index}][kolom6_bahaya][]" value="Bahaya Biologi"> Bahaya
                                    Biologi</label>
                                <label class="checkbox-card"><input type="checkbox"
                                        name="items[{index}][kolom6_bahaya][]" value="Bahaya Fisiologis/Ergonomi">
                                    Bahaya Fisiologis/Ergonomi</label>
                                <label class="checkbox-card"><input type="checkbox"
                                        name="items[{index}][kolom6_bahaya][]" value="Bahaya Psikologis"> Bahaya
                                    Psikologis</label>
                                <label class="checkbox-card"><input type="checkbox"
                                        name="items[{index}][kolom6_bahaya][]" value="Bahaya dari Prilaku"> Bahaya dari
                                    Prilaku</label>
                            </div>
                            <div class="form-group mt-4">
                                <label class="form-label">Bahaya Lainnya (Manual)</label>
                                <input type="text" class="form-control bahaya-manual-input"
                                    name="items[{index}][bahaya_manual]" placeholder="Deskripsi bahaya lain...">
                            </div>
                        </div>

                        <!-- Column 7: ASPEK LINGKUNGAN (Lingkungan) -->
                        <div class="lingkungan-field" data-category="Lingkungan"
                            style="background: #ecfdf5; padding: 20px; border-radius: 8px; border: 1px solid #10b981; margin-bottom: 15px; display: none;">
                            <label class="form-label" style="font-weight: 600;">
                                <i class="fas fa-leaf" style="color: #10b981;"></i>
                                Kolom 7: ASPEK LINGKUNGAN
                            </label>
                            <div class="checkbox-grid"
                                style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
                                <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                        name="items[{index}][kolom7_aspek_lingkungan][]" value="Emisi ke udara">
                                    Emisi ke udara</label>
                                <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                        name="items[{index}][kolom7_aspek_lingkungan][]" value="Pembuangan ke air">
                                    Pembuangan ke air</label>
                                <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                        name="items[{index}][kolom7_aspek_lingkungan][]" value="Pembuangan ke tanah">
                                    Pembuangan ke tanah</label>
                                <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                        name="items[{index}][kolom7_aspek_lingkungan][]"
                                        value="Penggunaan Bahan Baku dan SDA">
                                    Penggunaan Bahan Baku dan SDA</label>
                                <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                        name="items[{index}][kolom7_aspek_lingkungan][]" value="Penggunaan energi">
                                    Penggunaan energi</label>
                                <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                        name="items[{index}][kolom7_aspek_lingkungan][]" value="Paparan energi">
                                    Paparan energi</label>
                                <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                        name="items[{index}][kolom7_aspek_lingkungan][]" value="Limbah">
                                    Limbah</label>
                            </div>
                            <div class="form-group mt-4">
                                <label class="form-label">Aspek Lainnya (Manual)</label>
                                <input type="text" class="form-control aspects-manual-input"
                                    name="items[{index}][aspek_manual]" placeholder="Deskripsi aspek lain...">
                            </div>
                        </div>

                        <!-- Column 8: ANCAMAN KEAMANAN (Keamanan) -->
                        <div class="keamanan-field" data-category="Keamanan"
                            style="background: #fef2f2; padding: 20px; border-radius: 8px; border: 1px solid #ef4444; margin-bottom: 15px; display: none;">
                            <label class="form-label" style="font-weight: 600;">
                                <i class="fas fa-shield-alt" style="color: #ef4444;"></i>
                                Kolom 8: ANCAMAN KEAMANAN
                            </label>
                            <div class="checkbox-grid"
                                style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
                                <label class="checkbox-card"><input type="checkbox" class="ancaman-keamanan-checkbox"
                                        name="items[{index}][kolom8_ancaman][]" value="Terorisme"> Terorisme</label>
                                <label class="checkbox-card"><input type="checkbox" class="ancaman-keamanan-checkbox"
                                        name="items[{index}][kolom8_ancaman][]" value="Sabotase"> Sabotase</label>
                                <label class="checkbox-card"><input type="checkbox" class="ancaman-keamanan-checkbox"
                                        name="items[{index}][kolom8_ancaman][]" value="Intimidasi"> Intimidasi</label>
                                <label class="checkbox-card"><input type="checkbox" class="ancaman-keamanan-checkbox"
                                        name="items[{index}][kolom8_ancaman][]" value="Pencurian"> Pencurian</label>
                                <label class="checkbox-card"><input type="checkbox" class="ancaman-keamanan-checkbox"
                                        name="items[{index}][kolom8_ancaman][]" value="Perusakan aset"> Perusakan
                                    aset</label>
                            </div>
                            <div class="form-group mt-4">
                                <label class="form-label">Ancaman Lainnya (Manual)</label>
                                <input type="text" class="form-control threats-manual-input"
                                    name="items[{index}][ancaman_manual]" placeholder="Deskripsi ancaman lain...">
                            </div>
                        </div>

                        <!-- Column 9: RISIKO / DAMPAK / CELAH (3 separate fields based on category) -->
                        <!-- Kolom 9a: RISIKO (K3/KO) -->
                        <div class="form-group kolom9-k3ko-field" style="display: none;">
                            <label class="form-label">
                                Kolom 9: RISIKO <span class="required">*</span>
                            </label>
                            <textarea class="form-control" name="items[{index}][kolom9_risiko_k3ko]"
                                placeholder="Jelaskan risiko yang dapat terjadi dari bahaya yang teridentifikasi..."
                                rows="3"></textarea>
                        </div>

                        <!-- Kolom 9b: DAMPAK LINGKUNGAN (Lingkungan) -->
                        <div class="form-group kolom9-lingkungan-field" style="display: none;">
                            <label class="form-label">
                                Kolom 9: DAMPAK LINGKUNGAN <span class="required">*</span>
                            </label>
                            <textarea class="form-control" name="items[{index}][kolom9_dampak_lingkungan]"
                                placeholder="Jelaskan dampak lingkungan yang dapat terjadi dari aspek lingkungan yang teridentifikasi..."
                                rows="3"></textarea>
                        </div>

                        <!-- Kolom 9c: CELAH TIDAK AMAN (Keamanan) -->
                        <div class="form-group kolom9-keamanan-field" style="display: none;">
                            <label class="form-label">
                                Kolom 9: CELAH TIDAK AMAN <span class="required">*</span>
                            </label>
                            <textarea class="form-control" name="items[{index}][kolom9_celah_keamanan]"
                                placeholder="Jelaskan celah tidak aman yang dapat dieksploitasi dari ancaman yang teridentifikasi..."
                                rows="3"></textarea>
                        </div>

                        <!-- Removed old Risk Analysis - now part of column 9 above -->

                        <!-- 3. Pengendalian & Penilaian Risiko Saat Ini -->
                        <div style="margin-bottom: 25px;">
                            <h3
                                style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                                <i class="fas fa-shield-alt" style="color: #10b981; margin-right: 8px;"></i>
                                BAGIAN 3: Pengendalian & Penilaian Risiko Saat Ini
                            </h3>

                            <!-- Columns 10-11: Pengendalian -->
                            <div class="form-group">
                                <label class="form-label">Kolom 10: Hirarki Pengendalian Risiko</label>
                                <div class="checkbox-grid hierarchy-checkboxes"
                                    style="grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));">
                                    <label class="checkbox-card"><input type="checkbox"
                                            name="items[{index}][kolom10_pengendalian][]" value="Eliminasi"
                                            onchange="updateKolom11(this)">
                                        Eliminasi</label>
                                    <label class="checkbox-card"><input type="checkbox"
                                            name="items[{index}][kolom10_pengendalian][]" value="Substitusi"
                                            onchange="updateKolom11(this)">
                                        Substitusi</label>
                                    <label class="checkbox-card"><input type="checkbox"
                                            name="items[{index}][kolom10_pengendalian][]" value="Rekayasa Teknik"
                                            onchange="updateKolom11(this)"> Rekayasa
                                        Teknik</label>
                                    <label class="checkbox-card"><input type="checkbox"
                                            name="items[{index}][kolom10_pengendalian][]"
                                            value="Pengendalian Administratif" onchange="updateKolom11(this)">
                                        Pengendalian Administratif</label>
                                    <label class="checkbox-card"><input type="checkbox"
                                            name="items[{index}][kolom10_pengendalian][]" value="APD"
                                            onchange="updateKolom11(this)"> APD</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kolom 11: Pengendalian yang Dilakukan <span
                                        class="required">*</span></label>
                                <small style="display: block; margin-bottom: 8px; color: #64748b;">
                                    <i class="fas fa-info-circle"></i> Hierarki pengendalian yang dipilih akan muncul di
                                    bawah. Tambahkan penjelasan detail untuk masing-masing.
                                </small>
                                <textarea class="form-control kolom11-textarea" name="items[{index}][kolom11_existing]"
                                    required rows="5"
                                    placeholder="Pengendalian akan muncul otomatis berdasarkan pilihan di atas. Tambahkan penjelasan detail untuk setiap hierarki..."></textarea>
                            </div>

                            <!-- Columns 12-14: Penilaian Risiko Awal (was section 4) -->
                            <div
                                style="background:#f8fafc; padding:20px; border-radius:12px; border:1px solid #e2e8f0; margin-top:20px;">
                                <h4
                                    style="font-size:13px; font-weight:700; margin-bottom:15px; text-transform:uppercase; color:#334155;">
                                    Kolom 12-14: Penilaian Risiko Awal (dengan Pengendalian yang Ada)</h4>
                                <div style="display: flex; gap: 20px; align-items: flex-start;">


                                    <div style="flex:1; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                        <div class="form-group">
                                            <label class="form-label">Kolom 12: Kemungkinan (Likelihood)</label>
                                            <select class="form-control likelihood-select"
                                                name="items[{index}][kolom12_kemungkinan]" required
                                                onchange="calculateItemRisk(this)">
                                                <option value="">-- Pilih --</option>
                                                <option value="1">1 - Sangat Jarang</option>
                                                <option value="2">2 - Jarang</option>
                                                <option value="3">3 - Kadang-kadang</option>
                                                <option value="4">4 - Sering</option>
                                                <option value="5">5 - Sangat Sering</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kolom 13: Konsekuensi (Severity)</label>
                                            <select class="form-control severity-select"
                                                name="items[{index}][kolom13_konsekuensi]" required
                                                onchange="calculateItemRisk(this)">
                                                <option value="">-- Pilih --</option>
                                                <option value="1">1 - Tidak Signifikan</option>
                                                <option value="2">2 - Minor</option>
                                                <option value="3">3 - Moderate</option>
                                                <option value="4">4 - Major</option>
                                                <option value="5">5 - Catastrophic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="flex: 0 0 160px; text-align:center;">
                                        <label class="form-label">Kolom 14: Tingkat Risiko</label>
                                        <div class="risk-result-box"
                                            style="padding:15px; border-radius:8px; transition: background 0.3s; background: #e2e8f0; border: 1px solid #cbd5e1;">
                                            <div class="risk-score display-score" style="font-size: 24px;">-</div>
                                            <span class="risk-level display-level"
                                                style="font-size: 11px;">PENDING</span>
                                        </div>
                                        <input type="hidden" name="items[{index}][kolom14_score]" class="input-score">
                                        <input type="hidden" name="items[{index}][kolom14_level]" class="input-level">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Legalitas & Signifikansi -->
                        <div style="margin-bottom: 25px;">
                            <h3
                                style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                                <i class="fas fa-gavel" style="color: #8b5cf6; margin-right: 8px;"></i>
                                BAGIAN 4: Legalitas & Signifikansi
                            </h3>

                            <!-- Column 15: Peraturan -->
                            <div class="form-group">
                                <label class="form-label">Kolom 15: Peraturan Perundangan Terkait</label>
                                <textarea class="form-control" name="items[{index}][kolom15_regulasi]" rows="2"
                                    placeholder="Referensi UU, PP, Permenaker, atau standar lain yang relevan..."></textarea>
                            </div>

                            <!-- Column 16: ASPEK LINGKUNGAN PENTING (only for Lingkungan category) -->
                            <div class="form-group lingkungan-only-field" style="display: none;">
                                <label class="form-label">Kolom 16: Aspek Lingkungan Penting P/TP</label>
                                <div style="display:flex; gap:15px; margin-top:10px;">
                                    <label class="control-radio"
                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                        <input type="radio" name="items[{index}][kolom16_aspek]" value="P"
                                            style="cursor: pointer;">
                                        <span>Penting (P)</span>
                                    </label>
                                    <label class="control-radio"
                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                        <input type="radio" name="items[{index}][kolom16_aspek]" value="TP" checked
                                            style="cursor: pointer;">
                                        <span>Tidak Penting (TP)</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Column 17: Peluang & Risiko -->
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">Kolom 17: Peluang</label>
                                    <textarea class="form-control" name="items[{index}][kolom17_peluang]" rows="2"
                                        placeholder="Jika ada peluang perbaikan atau inovasi..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kolom 17: Risiko</label>
                                    <textarea class="form-control" name="items[{index}][kolom17_risiko]" rows="2"
                                        placeholder="Jika ada risiko tambahan yang belum tercover..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Mitigasi Lanjutan & Risiko Sisa -->
                        <div class="bagian-5-section">
                            <h3
                                style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                                <i class="fas fa-check-double" style="color: #15803d; margin-right: 8px;"></i>
                                BAGIAN 5: Mitigasi Lanjutan & Risiko Sisa
                            </h3>
                            <div
                                style="background:#f0fdf4; padding:20px; border-radius:12px; border:1px solid #bbf7d0;">

                                <!-- Column 18: Toleransi -->
                                <div class="form-group">
                                    <label class="form-label">Kolom 18: Risiko Dapat Ditoleransi? <span
                                            class="required">*</span></label>
                                    <select class="form-control tolerance-select"
                                        name="items[{index}][kolom18_toleransi]" required
                                        onchange="toggleFollowUpFields(this)">
                                        <option value="Ya" selected>Ya - Dapat Ditoleransi</option>
                                        <option value="Tidak">Tidak - Perlu Tindak Lanjut</option>
                                    </select>
                                    <small style="display: block; margin-top: 6px; color: #64748b;">
                                        Jika "Tidak", kolom 19-22 (Pengendalian Tindak Lanjut) akan muncul.
                                    </small>
                                </div>

                                <!-- Columns 19-22: Follow-up Controls (only if tolerance = Tidak) -->
                                <div class="follow-up-section" style="display: none; margin-top: 20px;">
                                    <h4
                                        style="font-size:13px; font-weight:700; margin-bottom:15px; text-transform:uppercase; color:#15803d; border-top: 2px dashed #bbf7d0; padding-top: 15px;">
                                        <i class="fas fa-exclamation-circle" style="margin-right:8px;"></i>
                                        Pengendalian Tindak Lanjut (Kolom 19-22)
                                    </h4>

                                    <!-- Column 19: Pengendalian Lanjut -->
                                    <div class="form-group">
                                        <label class="form-label">Kolom 19: Rencana Pengendalian Tindak Lanjut <span
                                                class="required">*</span></label>
                                        <textarea class="form-control follow-up-field"
                                            name="items[{index}][kolom19_pengendalian_lanjut]" rows="3"
                                            placeholder="Jelaskan tindakan pengendalian tambahan yang akan dilakukan..."></textarea>
                                    </div>

                                    <!-- Columns 20-22: Penilaian Risiko Setelah Tindak Lanjut -->
                                    <div
                                        style="background: #dcfce7; padding: 15px; border-radius: 8px; border: 1px solid #86efac;">
                                        <h5 style="font-size:12px; font-weight:700; margin-bottom:12px; color:#166534;">
                                            Penilaian Risiko Setelah Pengendalian Tindak Lanjut
                                        </h5>
                                        <div style="display: flex; gap: 20px; align-items: flex-start;">
                                            <div
                                                style="flex:1; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                                <div class="form-group">
                                                    <label class="form-label">Kolom 20: Kemungkinan (Lanjut)</label>
                                                    <select class="form-control follow-up-field"
                                                        name="items[{index}][kolom20_kemungkinan_lanjut]"
                                                        onchange="calculateFollowUpRisk(this)">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="1">1 - Sangat Jarang</option>
                                                        <option value="2">2 - Jarang</option>
                                                        <option value="3">3 - Kadang-kadang</option>
                                                        <option value="4">4 - Sering</option>
                                                        <option value="5">5 - Sangat Sering</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Kolom 21: Konsekuensi (Lanjut)</label>
                                                    <select class="form-control follow-up-field"
                                                        name="items[{index}][kolom21_konsekuensi_lanjut]"
                                                        onchange="calculateFollowUpRisk(this)">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="1">1 - Tidak Signifikan</option>
                                                        <option value="2">2 - Minor</option>
                                                        <option value="3">3 - Moderate</option>
                                                        <option value="4">4 - Major</option>
                                                        <option value="5">5 - Catastrophic</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div style="flex: 0 0 160px; text-align:center;">
                                                <label class="form-label">Kolom 22: Tingkat Risiko</label>
                                                <div class="risk-result-box followup-box"
                                                    style="padding:15px; border-radius:8px; background:#166534; color:white;">
                                                    <div class="risk-score followup-score" style="font-size:24px;">-
                                                    </div>
                                                    <span class="risk-level followup-level"
                                                        style="font-size:11px; opacity:0.9;">PENDING</span>
                                                </div>
                                                <input type="hidden"
                                                    name="items[{index}][kolom22_tingkat_risiko_lanjut]"
                                                    class="input-followup-score">
                                                <input type="hidden" name="items[{index}][kolom22_level_lanjut]"
                                                    class="input-followup-level">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr style="border:0; border-top:1px dashed #bbf7d0; margin:20px 0;">

                                <!-- Residual Risk (Always shown - this is the final risk after controls) -->
                                <h4
                                    style="font-size:13px; font-weight:700; margin-bottom:15px; text-transform:uppercase; color:#15803d;">
                                    <i class="fas fa-chart-line" style="margin-right:8px;"></i>
                                    Risiko Residual (Risiko Akhir)
                                </h4>
                                <div style="display: flex; gap: 20px; align-items:flex-start;">
                                    <div style="flex:1; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                        <div class="form-group">
                                            <label class="form-label">Kemungkinan (Residual) <span
                                                    class="required">*</span></label>
                                            <select class="form-control res-val"
                                                name="items[{index}][residual_kemungkinan]" required
                                                onchange="calculateItemResidual(this)">
                                                <option value="">-- Pilih --</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Konsekuensi (Residual) <span
                                                    class="required">*</span></label>
                                            <select class="form-control res-val"
                                                name="items[{index}][residual_konsekuensi]" required
                                                onchange="calculateItemResidual(this)">
                                                <option value="">-- Pilih --</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="flex: 0 0 160px; text-align:center;">
                                        <label class="form-label">Risiko Residual</label>
                                        <div class="risk-result-box res-box"
                                            style="padding:15px; border-radius:8px; background:#15803d; color:white;">
                                            <div class="risk-score res-score" style="font-size:24px;">-</div>
                                            <span class="risk-level res-level"
                                                style="font-size:11px; opacity:0.9;">PENDING</span>
                                        </div>
                                        <input type="hidden" name="items[{index}][residual_score]"
                                            class="input-res-score">
                                        <input type="hidden" name="items[{index}][residual_level]"
                                            class="input-res-level">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </template>

    <script>
        let itemIndex = 0;
        const autoProbis = document.getElementById('auto_probis_value').value;

        // Static Options Data
        const categories = {
            'K3': { label: 'K3', conditions: ['Rutin', 'Non-Rutin', 'Emergency'] },
            'KO': { label: 'KO', conditions: ['Rutin', 'Non-Rutin', 'Emergency'] },
            'Lingkungan': { label: 'Lingkungan', conditions: ['Normal', 'Abnormal', 'Emergency'] },
            'Keamanan': { label: 'Keamanan', conditions: ['Emergency'] }
        };



        function addItem() {
            // Collapse all existing first
            document.querySelectorAll('.doc-item').forEach(el => collapseItem(el));

            const template = document.getElementById('item-template').innerHTML;
            const container = document.getElementById('items-container');

            // Use simple index for name attributes
            let html = template.replace(/{index}/g, itemIndex);

            const div = document.createElement('div');
            div.innerHTML = html;
            const itemNode = div.firstElementChild;

            // Auto fill probis
            const probisInput = itemNode.querySelector('.probis-input');
            if (probisInput) probisInput.value = autoProbis;

            container.appendChild(itemNode);

            // Scroll to new item top
            itemNode.scrollIntoView({ behavior: 'smooth', block: 'start' });

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

            if (content.style.display === 'none') {
                // EXPAND
                content.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
                summary.style.display = 'none';
                item.classList.remove('collapsed');
            } else {
                // COLLAPSE
                content.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                summary.style.display = 'inline';
                item.classList.add('collapsed');
            }
        }

        function collapseItem(item) {
            const content = item.querySelector('.collapsible-content');
            const icon = item.querySelector('.btn-collapse i');
            const summary = item.querySelector('.item-summary');

            if (content && icon && summary) {
                content.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                summary.style.display = 'inline';
                item.classList.add('collapsed');
            }
        }

        function updateSummary(input) {
            const item = input.closest('.doc-item');
            const summary = item.querySelector('.item-summary');
            if (input.value) {
                const limit = 40;
                let txt = input.value;
                if (txt.length > limit) txt = txt.substring(0, limit) + '...';
                summary.textContent = `(${txt})`;
            } else {
                summary.textContent = '(Klik untuk expand)';
            }
        }

        function updateItemNumbers() {
            const items = document.querySelectorAll('.doc-item');
            items.forEach((item, idx) => {
                // Update Badge Number
                const numBadge = item.querySelector('.item-number');
                if (numBadge) numBadge.textContent = '#' + (idx + 1);
            });
            updateRemoveButtons();
        }

        function updateRemoveButtons() {
            const buttons = document.querySelectorAll('.btn-remove-item');
            if (buttons.length === 1) {
                buttons[0].style.display = 'none';
            } else {
                buttons.forEach(b => b.style.display = 'block');
            }
        }

        function updateConditions(select) {
            const item = select.closest('.doc-item');
            const condSelect = item.querySelector('.condition-select');
            const cat = select.value;
            const hazardSection = item.querySelector('.hazard-section');
            const hazardOptions = item.querySelector('.hazard-options');

            // Get all conditional field sections using CORRECT classes
            const k3KoField = item.querySelector('.k3-ko-field'); // Column 6
            const lingkunganField = item.querySelector('.lingkungan-field'); // Column 7
            const keamananField = item.querySelector('.keamanan-field'); // Column 8
            const lingkunganOnlyField = item.querySelector('.lingkungan-only-field'); // Column 16

            // Get kolom 9 variants
            const kolom9K3KO = item.querySelector('.kolom9-k3ko-field');
            const kolom9Lingkungan = item.querySelector('.kolom9-lingkungan-field');
            const kolom9Keamanan = item.querySelector('.kolom9-keamanan-field');

            condSelect.innerHTML = '<option value="">-- Pilih --</option>';

            // 1. Reset/Hide All Categories First
            if (k3KoField) k3KoField.style.display = 'none';
            if (lingkunganField) lingkunganField.style.display = 'none';
            if (keamananField) keamananField.style.display = 'none';
            if (lingkunganOnlyField) lingkunganOnlyField.style.display = 'none';

            // 2. Hide All Kolom 9 Variants & Reset Required
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

            // 3. Populate Conditions Dropdown
            if (categories[cat]) {
                categories[cat].conditions.forEach(c => {
                    const opt = document.createElement('option');
                    opt.value = c;
                    opt.textContent = c;
                    condSelect.appendChild(opt);
                });

                // 4. Show Specific Fields Based on Category
                if (cat === 'K3' || cat === 'KO') {
                    // Show Kolom 6 & 9a
                    if (k3KoField) {
                        k3KoField.style.display = 'block';
                        k3KoField.querySelectorAll('input').forEach(i => i.disabled = false);
                    }

                    if (kolom9K3KO) {
                        kolom9K3KO.style.display = 'block';
                        kolom9K3KO.querySelector('textarea')?.setAttribute('required', 'required');
                    }

                    // Disable others to prevent submission
                    if (lingkunganField) lingkunganField.querySelectorAll('input').forEach(i => i.disabled = true);
                    if (keamananField) keamananField.querySelectorAll('input').forEach(i => i.disabled = true);

                } else if (cat === 'Lingkungan') {
                    // Show Kolom 7, 16 & 9b
                    if (lingkunganField) {
                        lingkunganField.style.display = 'block';
                        lingkunganField.querySelectorAll('input').forEach(i => i.disabled = false);
                    }
                    if (lingkunganOnlyField) lingkunganOnlyField.style.display = 'block';

                    if (kolom9Lingkungan) {
                        kolom9Lingkungan.style.display = 'block';
                        kolom9Lingkungan.querySelector('textarea')?.setAttribute('required', 'required');
                    }

                    // Disable others
                    if (k3KoField) k3KoField.querySelectorAll('input').forEach(i => i.disabled = true);
                    if (keamananField) keamananField.querySelectorAll('input').forEach(i => i.disabled = true);

                } else if (cat === 'Keamanan') {
                    // Show Kolom 8 & 9c
                    if (keamananField) {
                        keamananField.style.display = 'block';
                        keamananField.querySelectorAll('input').forEach(i => i.disabled = false);
                    }

                    if (kolom9Keamanan) {
                        kolom9Keamanan.style.display = 'block';
                        kolom9Keamanan.querySelector('textarea')?.setAttribute('required', 'required');
                    }

                    // Disable others
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
            let bg = '#e2e8f0'; // Default gray
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

            // Show/Hide BAGIAN 5 based on risk level
            const bagian5 = item.querySelector('.bagian-5-section');
            if (bagian5) {
                if (score < 8) {
                    // Risk is LOW - hide BAGIAN 5 (no further mitigation needed)
                    bagian5.style.display = 'none';
                    // Remove required from residual fields
                    const resFields = bagian5.querySelectorAll('.res-val');
                    resFields.forEach(field => field.removeAttribute('required'));
                } else {
                    // Risk is MEDIUM or HIGH - show BAGIAN 5
                    bagian5.style.display = 'block';
                    // Add required back to residual fields
                    const resFields = bagian5.querySelectorAll('.res-val');
                    resFields.forEach(field => field.setAttribute('required', 'required'));
                }
            }
        }

        function calculateItemResidual(el) {
            const item = el.closest('.doc-item');
            const likelihood = parseInt(item.querySelector('[name*="residual_kemungkinan"]').value) || 0;
            const severity = parseInt(item.querySelector('[name*="residual_konsekuensi"]').value) || 0;

            const score = likelihood * severity;
            const scoreEl = item.querySelector('.res-score');
            const levelEl = item.querySelector('.res-level');
            const resBox = item.querySelector('.res-box');

            scoreEl.textContent = score || '-';
            item.querySelector('.input-res-score').value = score;

            let level = '-';
            let bg = '#e2e8f0';
            let textColor = '#64748b';

            if (score > 0) {
                textColor = '#fff';
                if (score >= 15) { level = 'Tinggi'; bg = '#dc2626'; }
                else if (score >= 8) { level = 'Sedang'; bg = '#f59e0b'; }
                else { level = 'Rendah'; bg = '#15803d'; }
            }

            levelEl.textContent = (score > 0) ? level : 'PENDING';
            item.querySelector('.input-res-level').value = level;
            if (resBox) {
                resBox.style.background = bg;
                resBox.style.color = textColor;
            }
        }

        function validateForm() {
            let valid = true;
            let missingItems = [];

            document.querySelectorAll('.doc-item').forEach(item => {
                const itemName = item.querySelector('[name*="kolom2_kegiatan"]')?.value || 'Item';
                const initialScore = item.querySelector('.input-score').value;

                // Check initial risk assessment
                if (!initialScore || initialScore == 0) {
                    valid = false;
                    missingItems.push(itemName);
                    return;
                }

                // Only check residual risk if BAGIAN 5 is visible (risk >= 8)
                const bagian5 = item.querySelector('.bagian-5-section');
                if (bagian5 && bagian5.style.display !== 'none') {
                    const residualScore = item.querySelector('.input-res-score').value;
                    if (!residualScore || residualScore == 0) {
                        valid = false;
                        missingItems.push(itemName + ' (Residual)');
                    }
                }
            });

            if (!valid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Mohon lengkapi penilaian risiko untuk: ' + missingItems.join(', '),
                });
                return false;
            }
            return true;
        }

        // Init
        document.addEventListener('DOMContentLoaded', () => {
            addItem(); // Add first item
        });
    </script>

    <style>
        /* Action Bar - Static Style */
        .action-bar {
            margin-top: 20px;
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .action-info {
            font-size: 14px;
            color: #475569;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            /* Space between buttons */
            flex-shrink: 0;
            /* Prevent shrinking */
        }

        .btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Ensure content isn't hidden behind bar */
        .content-area {
            padding-bottom: 100px;
        }
    </style>

    <script>
        // ... (Existing functions: addItem, removeItem, etc - keeping logic) ...

        function validateForm(event) {
            // Only prevent default if event is passed (when called from submit listener)
            if (event && event.type === 'submit') event.preventDefault();

            try {
                let isValid = true;
                let errorMsg = '';

                // Check Document Title
                const titleInput = document.querySelector('input[name="judul_dokumen"]');
                if (!titleInput || !titleInput.value.trim()) {
                    isValid = false;
                    errorMsg = 'Judul Form wajib diisi.';
                    if (titleInput) titleInput.focus();
                }

                // 1. Check if at least one item exists
                const items = document.querySelectorAll('.doc-item');
                if (isValid && items.length === 0) {
                    isValid = false;
                    errorMsg = 'Minimal harus ada 1 kegiatan.';
                }

                // 2. Check each item for Risk Score
                if (isValid) {
                    items.forEach((item, idx) => {
                        const s = item.querySelector('.input-score').value;
                        const residualS = item.querySelector('.input-res-score').value;

                        const kegiatan = item.querySelector('.item-kegiatan-input')?.value || 'Item #' + (idx + 1);
                        const kondisi = item.querySelector('.condition-select')?.value;

                        // Validate Conditions
                        if (!kondisi) {
                            isValid = false;
                            errorMsg = `Kondisi (Rutin/Non-Rutin/dll) belum dipilih untuk: ${kegiatan}`;
                            const content = item.querySelector('.collapsible-content');
                            if (content.style.display === 'none') {
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

                        // Validate Residual Risk - ONLY if BAGIAN 5 is visible (risk >= 8)
                        const bagian5 = item.querySelector('.bagian-5-section');
                        const isBagian5Visible = bagian5 && bagian5.style.display !== 'none';

                        if (isValid && isBagian5Visible && (!residualS || residualS == 0)) {
                            isValid = false;
                            errorMsg = `Penilaian risiko residual belum lengkap untuk: ${kegiatan}`;
                            const content = item.querySelector('.collapsible-content');
                            if (content.style.display === 'none') {
                                toggleCollapse(item.querySelector('.card-header'));
                            }

                            const resBox = item.querySelector('.risk-result-box.res-box');
                            if (resBox) {
                                resBox.style.border = '2px solid #ef4444';
                                setTimeout(() => resBox.style.border = '1px solid #15803d', 3000);
                            }
                            item.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });
                }

                // 3. Check Required Fields (Native HTML required might miss hidden tabs)
                // Adding specific checks if needed, but 'required' attribute handles most.

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
                const btn = document.getElementById('btnSubmit');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
                btn.disabled = true;

                // Submit manually 
                const form = document.getElementById('hiradcForm');
                if (form.reportValidity()) {
                    form.submit();
                } else {
                    // Even if custom validation passes, standard HTML validation might fail (e.g. required texts)
                    // This catches that silently.
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }

            } catch (e) {
                console.error(e);
                Swal.fire('System Error', e.message, 'error');
                const btn = document.getElementById('btnSubmit');
                if (btn) btn.disabled = false;
            }
        }

        // NEW: Toggle follow-up fields based on tolerance selection (columns 19-22)
        function toggleFollowUpFields(select) {
            const item = select.closest('.doc-item');
            const followUpSection = item.querySelector('.follow-up-section');
            const tolerance = select.value;

            if (tolerance === 'Tidak') {
                // Show columns 19-22
                followUpSection.style.display = 'block';
                // Make follow-up fields required
                followUpSection.querySelectorAll('.follow-up-field').forEach(field => {
                    if (field.tagName === 'TEXTAREA') {
                        field.setAttribute('required', 'required');
                    }
                });
            } else {
                // Hide columns 19-22
                followUpSection.style.display = 'none';
                // Remove required from follow-up fields and clear values
                followUpSection.querySelectorAll('.follow-up-field').forEach(field => {
                    field.removeAttribute('required');
                    field.value = '';
                });
                // Clear hidden inputs
                item.querySelector('.input-followup-score').value = '';
                item.querySelector('.input-followup-level').value = '';
            }
        }

        // NEW: Calculate Follow-up Risk (columns 20-22)
        function calculateFollowUpRisk(el) {
            const item = el.closest('.doc-item');
            const likelihood = parseInt(item.querySelector('[name*="kolom20_kemungkinan_lanjut"]').value) || 0;
            const severity = parseInt(item.querySelector('[name*="kolom21_konsekuensi_lanjut"]').value) || 0;

            const score = likelihood * severity;
            const scoreEl = item.querySelector('.followup-score');
            const levelEl = item.querySelector('.followup-level');
            const followupBox = item.querySelector('.followup-box');

            scoreEl.textContent = score || '-';
            item.querySelector('.input-followup-score').value = score;

            let level = '-';
            let bg = '#e2e8f0';
            let textColor = '#64748b';

            if (score > 0) {
                textColor = '#fff';
                if (score >= 15) { level = 'Tinggi'; bg = '#dc2626'; }
                else if (score >= 8) { level = 'Sedang'; bg = '#f59e0b'; }
                else { level = 'Rendah'; bg = '#166534'; }
            }

            levelEl.textContent = (score > 0) ? level : 'PENDING';
            item.querySelector('.input-followup-level').value = level;
            if (followupBox) {
                followupBox.style.background = bg;
                followupBox.style.color = textColor;
            }
        }



        // NEW: Update Kolom 11 when hierarchy checkboxes are changed
        function updateKolom11(checkbox) {
            const item = checkbox.closest('.doc-item');
            const textarea = item.querySelector('.kolom11-textarea');
            const checkboxes = item.querySelectorAll('.hierarchy-checkboxes input[type="checkbox"]:checked');

            if (!textarea) return;

            // Get all checked values
            const checkedValues = Array.from(checkboxes).map(cb => cb.value);

            if (checkedValues.length === 0) {
                // No checkboxes checked, clear the textarea
                textarea.value = '';
                return;
            }

            // Build the text with each hierarchy as a header
            let text = '';
            checkedValues.forEach((value, index) => {
                if (index > 0) text += '\n\n';
                text += `${index + 1}. ${value}:\n   `;
            });

            textarea.value = text;

            // Set cursor at the end
            textarea.focus();
            textarea.setSelectionRange(textarea.value.length, textarea.value.length);
        }
    </script>



    </form>
    </div> <!-- End Content-Area -->
    </main>
    </div> <!-- End Container -->
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>