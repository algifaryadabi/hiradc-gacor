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
                <a href="{{ route('documents.index') }}" class="nav-item {{ request('mode') == 'edit' ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i>
                    <span>Dokumen Saya</span>
                    <span class="badge">9</span>
                </a>
                <a href="{{ route('documents.create') }}" class="nav-item {{ request('mode') != 'edit' ? 'active' : '' }}">
                    <i class="fas fa-plus-circle"></i>
                    <span>Buat Dokumen Baru</span>
                </a>
            </nav>

            <!-- User Info at Bottom -->
            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">JD</div>
                    <div class="user-details">
                        <div class="user-name">John Doe</div>
                        <div class="user-role">Staff Unit Kerja</div>
                    </div>
                </div>
                <!-- Logout via Form/Link -->
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
                <form id="hiradcForm" class="form-container">
                    
                    <!-- REVISION ALERT (Hidden by default) -->
                    <div id="revision_alert_container" class="hidden" style="margin-bottom: 30px;">
                        <div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 20px; border-radius: 4px;">
                            <div style="display: flex; align-items: start; gap: 15px;">
                                <div style="font-size: 24px; color: #856404;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <h3 style="margin: 0 0 10px 0; color: #856404; font-size: 16px;">Dokumen Perlu Perbaikan</h3>
                                    <p style="margin: 0 0 10px 0; font-size: 14px; color: #666;">
                                        Dokumen ini dikembalikan oleh <strong><span id="reviewer_name">Nama Reviewer</span></strong> 
                                        (<span id="reviewer_role">Role</span>) pada <span id="revision_date">Tanggal</span>.
                                    </p>
                                    <div style="background: rgba(255,255,255,0.5); padding: 15px; border-radius: 6px; font-style: italic; color: #333; border: 1px solid rgba(0,0,0,0.05);">
                                        "<span id="revision_comment">Komentar revisi akan muncul di sini...</span>"
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM 2: Proses Bisnis/Kegiatan/Aset -->
                    <div class="section-header">
                        <h2>📋 Kolom 2: Proses Bisnis / Kegiatan / Aset</h2>
                        <p>Pilih proses bisnis, lalu centang kegiatan yang sesuai</p>
                    </div>

                    <div class="form-group">
                        <label>Pilih Proses Bisnis <span class="required">*</span></label>
                        <select class="form-control" id="kolom2_proses" required onchange="showActivityOptions()">
                            <option value="">-- Pilih Proses Bisnis --</option>
                            <option value="PERPUSTAKAAN">PERPUSTAKAAN</option>
                            <option value="LABORATORIUM">LABORATORIUM</option>
                            <option value="LISTRIK">LISTRIK</option>
                            <option value="SATPAM">SATPAM</option>
                            <option value="PRODUKSI">PRODUKSI</option>
                            <option value="SAAT OVERHAUL">SAAT OVERHAUL</option>
                            <option value="SAAT TROUBLE SHOOTING">SAAT TROUBLE SHOOTING</option>
                            <option value="POOL KENDARAAN">POOL KENDARAAN</option>
                        </select>
                    </div>

                    <!-- Activity Options Container -->
                    <div id="activity_options_container" class="hidden" style="margin-top: 20px;">
                        <div class="form-group">
                            <label>Pilih Kegiatan yang Sesuai <span class="required">*</span></label>
                            <p class="help-text">Centang satu atau lebih kegiatan yang sesuai dengan proses bisnis</p>

                            <div class="checkbox-group" id="activity_checkboxes">
                                <!-- Checkboxes will be populated by JavaScript -->
                            </div>

                            <!-- Manual Input for Other Activities -->
                            <div class="form-group" style="margin-top: 15px;">
                                <label>Atau Input Kegiatan Lainnya (Opsional)</label>
                                <input type="text" class="form-control" id="kolom2_activity_manual"
                                    placeholder="Masukkan kegiatan lain jika tidak ada di list...">
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM 3: Lokasi/Area Kerja -->
                    <div class="section-header">
                        <h2>📍 Kolom 3: Lokasi / Area Kerja</h2>
                        <p>Input manual lokasi atau area kerja</p>
                    </div>

                    <div class="form-group">
                        <label>Lokasi / Area Kerja <span class="required">*</span></label>
                        <input type="text" class="form-control" id="kolom3_lokasi"
                            placeholder="Contoh: Gedung A Lantai 2, Area Produksi, dll" required>
                    </div>

                    <!-- KOLOM 4: Kategori Dokumen -->
                    <div class="section-header">
                        <h2>📑 Kolom 4: Kategori Dokumen</h2>
                        <p>Pilih jenis dokumen risiko</p>
                    </div>

                    <div class="form-group">
                        <label>Jenis Dokumen <span class="required">*</span></label>
                        <select class="form-control" id="kolom4_kategori" required>
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
                        <select class="form-control" id="kolom5_kondisi" required>
                            <option value="">-- Pilih Kondisi --</option>
                            <option value="R">R - Rutin (Kegiatan sehari-hari terkait operasi khusus K3)</option>
                            <option value="NR">NR - Non Rutin (Kegiatan diluar operasi, maintenance tidak terjadwal,
                                shut down, mati listrik, dll)</option>
                            <option value="N">N - Normal (Kegiatan rutin dan non-rutin berjalan sesuai standar)</option>
                            <option value="TN">TN - Tidak Normal (Kegiatan rutin dan non-rutin tidak sesuai standar)
                            </option>
                            <option value="EM">EM - Emergency (Potensi bahaya muncul saat emergency/tanggap darurat)
                            </option>
                        </select>
                    </div>

                    <!-- KOLOM 6: Jenis Bahaya -->
                    <div class="section-header">
                        <h2>⚠️ Kolom 6: Jenis Bahaya</h2>
                        <p>Pilih jenis bahaya: Unsafe Condition atau Unsafe Action, lalu pilih kategori bahaya</p>
                    </div>

                    <div class="button-group">
                        <button type="button" class="btn-toggle" id="btn_unsafe_condition"
                            onclick="selectBahayaType('condition')">
                            Bahaya (Unsafe Condition)
                        </button>
                        <button type="button" class="btn-toggle" id="btn_unsafe_action"
                            onclick="selectBahayaType('action')">
                            Bahaya (Unsafe Action)
                        </button>
                    </div>

                    <!-- Unsafe Condition Options -->
                    <div id="unsafe_condition_options" class="hidden">
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="bahaya_fisika" onchange="toggleBahayaDropdown('fisika')">
                                <label for="bahaya_fisika">Bahaya Fisika</label>
                            </div>
                            <div class="dynamic-dropdown" id="dropdown_fisika">
                                <label>Pilih Contoh Bahaya Fisika:</label>
                                <select class="form-control" id="select_fisika" multiple size="5">
                                    <option value="Kebisingan">Kebisingan</option>
                                    <option value="Getaran">Getaran</option>
                                    <option value="Suhu ekstrim">Suhu ekstrim</option>
                                    <option value="Pencahayaan kurang">Pencahayaan kurang</option>
                                    <option value="Radiasi">Radiasi</option>
                                </select>
                                <input type="text" class="form-control" style="margin-top: 10px;"
                                    placeholder="Atau input manual jika tidak ada di list">
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="bahaya_kimia" onchange="toggleBahayaDropdown('kimia')">
                                <label for="bahaya_kimia">Bahaya Kimia</label>
                            </div>
                            <div class="dynamic-dropdown" id="dropdown_kimia">
                                <label>Pilih Contoh Bahaya Kimia:</label>
                                <select class="form-control" id="select_kimia" multiple size="5">
                                    <option value="Gas beracun">Gas beracun</option>
                                    <option value="Cairan korosif">Cairan korosif</option>
                                    <option value="Debu kimia">Debu kimia</option>
                                    <option value="Asap berbahaya">Asap berbahaya</option>
                                    <option value="Bahan mudah terbakar">Bahan mudah terbakar</option>
                                </select>
                                <input type="text" class="form-control" style="margin-top: 10px;"
                                    placeholder="Atau input manual jika tidak ada di list">
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="bahaya_biologi" onchange="toggleBahayaDropdown('biologi')">
                                <label for="bahaya_biologi">Bahaya Biologi</label>
                            </div>
                            <div class="dynamic-dropdown" id="dropdown_biologi">
                                <label>Pilih Contoh Bahaya Biologi:</label>
                                <select class="form-control" id="select_biologi" multiple size="5">
                                    <option value="Bakteri">Bakteri</option>
                                    <option value="Virus">Virus</option>
                                    <option value="Jamur">Jamur</option>
                                    <option value="Parasit">Parasit</option>
                                    <option value="Limbah medis">Limbah medis</option>
                                </select>
                                <input type="text" class="form-control" style="margin-top: 10px;"
                                    placeholder="Atau input manual jika tidak ada di list">
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="bahaya_ergonomi" onchange="toggleBahayaDropdown('ergonomi')">
                                <label for="bahaya_ergonomi">Bahaya Ergonomi</label>
                            </div>
                            <div class="dynamic-dropdown" id="dropdown_ergonomi">
                                <label>Pilih Contoh Bahaya Ergonomi:</label>
                                <select class="form-control" id="select_ergonomi" multiple size="5">
                                    <option value="Posisi kerja tidak ergonomis">Posisi kerja tidak ergonomis</option>
                                    <option value="Gerakan berulang">Gerakan berulang</option>
                                    <option value="Mengangkat beban berat">Mengangkat beban berat</option>
                                    <option value="Kursi tidak ergonomis">Kursi tidak ergonomis</option>
                                </select>
                                <input type="text" class="form-control" style="margin-top: 10px;"
                                    placeholder="Atau input manual jika tidak ada di list">
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="bahaya_psikososial"
                                    onchange="toggleBahayaDropdown('psikososial')">
                                <label for="bahaya_psikososial">Bahaya Psikososial</label>
                            </div>
                            <div class="dynamic-dropdown" id="dropdown_psikososial">
                                <label>Pilih Contoh Bahaya Psikososial:</label>
                                <select class="form-control" id="select_psikososial" multiple size="5">
                                    <option value="Stres kerja">Stres kerja</option>
                                    <option value="Beban kerja berlebih">Beban kerja berlebih</option>
                                    <option value="Konflik interpersonal">Konflik interpersonal</option>
                                    <option value="Jam kerja panjang">Jam kerja panjang</option>
                                </select>
                                <input type="text" class="form-control" style="margin-top: 10px;"
                                    placeholder="Atau input manual jika tidak ada di list">
                            </div>
                        </div>
                    </div>

                    <!-- Unsafe Action Options -->
                    <div id="unsafe_action_options" class="hidden">
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="action_prosedur" onchange="toggleBahayaDropdown('prosedur')">
                                <label for="action_prosedur">Tidak Mengikuti Prosedur</label>
                            </div>
                            <div class="dynamic-dropdown" id="dropdown_prosedur">
                                <label>Pilih Contoh:</label>
                                <select class="form-control" id="select_prosedur" multiple size="5">
                                    <option value="Tidak menggunakan APD">Tidak menggunakan APD</option>
                                    <option value="Mengabaikan SOP">Mengabaikan SOP</option>
                                    <option value="Bekerja tanpa izin">Bekerja tanpa izin</option>
                                    <option value="Shortcut berbahaya">Mengambil jalan pintas berbahaya</option>
                                </select>
                                <input type="text" class="form-control" style="margin-top: 10px;"
                                    placeholder="Atau input manual jika tidak ada di list">
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="action_kecerobohan"
                                    onchange="toggleBahayaDropdown('kecerobohan')">
                                <label for="action_kecerobohan">Kecerobohan</label>
                            </div>
                            <div class="dynamic-dropdown" id="dropdown_kecerobohan">
                                <label>Pilih Contoh:</label>
                                <select class="form-control" id="select_kecerobohan" multiple size="5">
                                    <option value="Bekerja sambil mengantuk">Bekerja sambil mengantuk</option>
                                    <option value="Tidak fokus">Tidak fokus/terganggu</option>
                                    <option value="Terburu-buru">Terburu-buru</option>
                                    <option value="Kurang pelatihan">Kurang pelatihan</option>
                                </select>
                                <input type="text" class="form-control" style="margin-top: 10px;"
                                    placeholder="Atau input manual jika tidak ada di list">
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM 7: Dampak/Konsekuensi -->
                    <div class="section-header">
                        <h2 id="kolom7_title">💥 Kolom 7: Dampak / Konsekuensi</h2>
                        <p id="kolom7_desc">Jelaskan dampak atau konsekuensi yang mungkin terjadi</p>
                    </div>

                    <div class="form-group">
                        <label id="kolom7_label">Dampak / Konsekuensi <span class="required">*</span></label>
                        <textarea class="form-control" id="kolom7_dampak" required
                            placeholder="Jelaskan dampak yang mungkin terjadi akibat bahaya tersebut..."></textarea>
                    </div>

                    <!-- KOLOM 8: Pihak Terkena Dampak -->
                    <div class="section-header">
                        <h2>👥 Kolom 8: Pihak Terkena Dampak</h2>
                        <p>Pilih pihak yang berpotensi terkena dampak</p>
                    </div>

                    <div class="form-group">
                        <label>Pilih Pihak Terkena <span class="required">*</span></label>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="pihak_pekerja" value="Pekerja">
                                <label for="pihak_pekerja">Pekerja Internal</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="pihak_kontraktor" value="Kontraktor">
                                <label for="pihak_kontraktor">Kontraktor</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="pihak_pengunjung" value="Pengunjung">
                                <label for="pihak_pengunjung">Pengunjung</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="pihak_masyarakat" value="Masyarakat">
                                <label for="pihak_masyarakat">Masyarakat Sekitar</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="pihak_lingkungan" value="Lingkungan">
                                <label for="pihak_lingkungan">Lingkungan</label>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="pihak_lainnya" style="margin-top: 10px;"
                            placeholder="Atau sebutkan pihak lainnya...">
                    </div>

                    <!-- KOLOM 9: Identifikasi Risiko (Category-specific) -->
                    <div class="section-header">
                        <h2 id="kolom9_title">🔍 Kolom 9: Identifikasi Risiko K3/KO</h2>
                        <p id="kolom9_desc">Identifikasi risiko yang mungkin terjadi</p>
                    </div>

                    <div class="form-group">
                        <label id="kolom9_label">Identifikasi Risiko <span class="required">*</span></label>
                        <textarea class="form-control" id="kolom9_risiko" required
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
                    </div>

                    <!-- KOLOM 11: Pengendalian yang Sudah Dilakukan -->
                    <div class="section-header">
                        <h2>✅ Kolom 11: Pengendalian yang Sudah Dilakukan</h2>
                        <p>Jelaskan pengendalian yang sudah diterapkan saat ini (Berkaitan dengan Kolom 10)</p>
                    </div>

                    <div class="form-group">
                        <label>Pengendalian Existing <span class="required">*</span></label>
                        <textarea class="form-control" id="kolom11_pengendalian" required
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
                            <select class="form-control" id="kolom12_kemungkinan" required onchange="calculateRisk()">
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
                            <select class="form-control" id="kolom13_konsekuensi" required onchange="calculateRisk()">
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
                        <textarea class="form-control" id="kolom15_peraturan" oninput="checkRegulasi()"
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
                            <textarea class="form-control" id="kolom17_risiko"
                                placeholder="Jelaskan risiko yang perlu dimitigasi..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Peluang</label>
                            <textarea class="form-control" id="kolom17_peluang"
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
                        <textarea class="form-control" id="kolom19_tindak_lanjut" required
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
                            <select class="form-control" id="kolom20_kemungkinan" required
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
                            <select class="form-control" id="kolom21_konsekuensi" required
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
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim untuk Review
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Data Dummy untuk Kegiatan
        const activitiesDB = {
            "PERPUSTAKAAN": [
                "Peminjaman buku",
                "Pengembalian buku",
                "Perawatan buku berkala",
                "Penataan rak buku"
            ],
            "LABORATORIUM": [
                "Pengujian sampel air",
                "Pengujian sampel udara",
                "Kalibrasi alat ukur",
                "Penanganan limbah B3"
            ],
            "PRODUKSI": [
                "Pengoperasian mesin crusher",
                "Pemantauan conveyor belt",
                "Pembersihan area kerja",
                "Maintenance ringan mesin"
            ],
            "LISTRIK": [
                "Perbaikan panel listrik",
                "Instalasi kabel baru",
                "Pengecekan genset",
                "Pergantian lampu area"
            ]
        };

        function showActivityOptions() {
            const proses = document.getElementById('kolom2_proses').value;
            const container = document.getElementById('activity_options_container');
            const checkboxContainer = document.getElementById('activity_checkboxes');

            if (proses && activitiesDB[proses]) {
                container.classList.remove('hidden');
                checkboxContainer.innerHTML = ''; // Clear existing

                activitiesDB[proses].forEach((activity, index) => {
                    const id = `activity_${index}`;
                    const html = `
                        <div class="checkbox-item">
                            <input type="checkbox" id="${id}" name="kegiatan[]" value="${activity}">
                            <label for="${id}">${activity}</label>
                        </div>
                    `;
                    checkboxContainer.insertAdjacentHTML('beforeend', html);
                });
            } else {
                container.classList.add('hidden');
            }
        }

        function selectBahayaType(type) {
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

        function toggleBahayaDropdown(idSuffix) {
            const checkbox = document.querySelector(`input[onchange="toggleBahayaDropdown('${idSuffix}')"]`);
            const dropdown = document.getElementById(`dropdown_${idSuffix}`);

            if (checkbox.checked) {
                dropdown.classList.add('active');
            } else {
                dropdown.classList.remove('active');
            }
        }

        // Auto-check Regulation Logic
        function checkRegulasi() {
            const val = document.getElementById('kolom15_peraturan').value;
            const radioP = document.querySelector('input[name="kolom16_penting"][value="P"]');

            if (val.trim().length > 0) {
                radioP.checked = true;
            }
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
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const mode = urlParams.get('mode');
            const docId = urlParams.get('id');

            if (mode === 'edit' && docId) {
                loadDocumentData(docId);
            }
        });

        function loadDocumentData(id) {
            const doc = mockDocuments[id];
            const rev = revisionComments[id];

            if (!doc) return;

            // 1. Show Revision Alert
            if (rev) {
                document.getElementById('revision_alert_container').classList.remove('hidden');
                document.getElementById('reviewer_name').textContent = rev.name;
                document.getElementById('reviewer_role').textContent = rev.reviewer;
                document.getElementById('revision_date').textContent = rev.date;
                document.getElementById('revision_comment').textContent = rev.comment;
                
                // Scroll to top
                window.scrollTo(0, 0);
            }

            // 2. Pre-fill Form Fields
            document.getElementById('kolom2_proses').value = doc.proses;
            showActivityOptions(); // Trigger change event logic
            // Handle activity checkboxes or manual input logic here (simplified for demo)
            if (doc.kegiatan_lain) {
                document.getElementById('kolom2_activity_manual').value = doc.kegiatan_lain;
            }

            document.getElementById('kolom3_lokasi').value = doc.lokasi;
            document.getElementById('kolom4_kategori').value = doc.kategori;
            document.getElementById('kolom5_kondisi').value = doc.kondisi;

            // Bahaya Type
            if (doc.bahaya_type === 'condition') {
                selectBahayaType('condition');
                // Tick categories
                if (doc.bahaya_kategori === 'kimia') {
                    document.getElementById('bahaya_kimia').checked = true;
                    toggleBahayaDropdown('kimia');
                    // Select options in multi-select (simplified)
                } 
                 if (doc.bahaya_kategori === 'fisika') {
                    document.getElementById('bahaya_fisika').checked = true;
                    toggleBahayaDropdown('fisika');
                }
            } else {
                selectBahayaType('action');
            }

            document.getElementById('kolom7_dampak').value = doc.dampak;

            // Pihak
            doc.pihak.forEach(p => {
                if(p === 'Pekerja') document.getElementById('pihak_pekerja').checked = true;
                if(p === 'Lingkungan') document.getElementById('pihak_lingkungan').checked = true;
            });

            document.getElementById('kolom10_bahaya').value = doc.bahaya_identifikasi;
            document.getElementById('kolom11_risiko_k3').value = doc.risiko_k3;
            document.getElementById('kolom11_risiko_lingkungan').value = doc.risiko_lingkungan;
            document.getElementById('kolom12_regulasi').value = doc.regulasi;

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