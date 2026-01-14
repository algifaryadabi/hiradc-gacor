<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen - HIRADC (Ka. Dept)</title>
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
            padding-bottom: 200px;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: white;
            border-right: 1px solid #e0e0e0;
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            /* Fixed typo */
            z-index: 101;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
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
        }

        .nav-item:hover,
        .nav-item.active {
            background: #fff5f5;
            color: #c41e3a;
        }

        .nav-item.active {
            border-left: 3px solid #c41e3a;
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
        }

        .header {
            background: white;
            padding: 25px 40px;
            border-bottom: 1px solid #e0e0e0;
            position: sticky;
            top: 0;
            z-index: 100;
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
            max-width: 1200px;
            /* Constrain width for cleaner look */
            margin: 0 auto;
        }

        /* CARD STYLING */
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            padding: 30px;
            margin-bottom: 25px;
            border: 1px solid #f0f0f0;
        }

        .section-header {
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 15px;
        }

        .section-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .section-icon {
            width: 36px;
            height: 36px;
            background: #fff5f5;
            color: #c41e3a;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }

        .required {
            color: #c41e3a;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
            background: #fcfcfc;
        }

        .form-control:focus {
            outline: none;
            border-color: #c41e3a;
            background: white;
            box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.1);
        }

        /* Form Row Grid */
        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
            line-height: 1.5;
        }

        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            background: white;
        }

        .checkbox-item:hover {
            background: #fff5f5;
            border-color: #c41e3a;
        }

        .checkbox-item input {
            accent-color: #c41e3a;
        }

        .checkbox-item label {
            margin: 0;
            cursor: pointer;
            font-weight: 500;
        }

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

        .hidden {
            display: none;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-family: 'Inter', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* Footer & Actions */
        .review-footer {
            position: fixed;
            bottom: 0;
            left: 250px;
            right: 0;
            background: white;
            padding: 20px 40px;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);
            z-index: 900;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 30px;
            align-items: center;
            border-top: 1px solid #f0f0f0;
        }

        .comment-section {
            flex: 1;
        }

        .comment-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #666;
            margin-bottom: 5px;
        }

        .comment-input {
            width: 100%;
            height: 50px;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px 15px;
            font-family: inherit;
            font-size: 14px;
            resize: none;
            transition: all 0.3s;
        }

        .comment-input:focus {
            outline: none;
            border-color: #c41e3a;
            height: 80px;
            /* Auto expand on focus */
        }

        .action-buttons {
            display: flex;
            gap: 12px;
        }

        .btn-approve {
            background: #28a745;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            transition: background 0.2s;
        }

        .btn-approve:hover {
            background: #218838;
        }

        .btn-revisi {
            background: white;
            color: #dc3545;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            border: 1px solid #dc3545;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .btn-revisi:hover {
            background: #fff5f5;
        }

        .btn-secondary {
            background: white;
            color: #555;
            border: 1px solid #ddd;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-secondary:hover {
            background: #f9f9f9;
        }

        /* Timeline Styling */
        .timeline-container {
            margin-top: 20px;
            padding-left: 20px;
            border-left: 2px solid #e0e0e0;
            margin-left: 10px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            padding-left: 25px;
        }

        .timeline-icon {
            position: absolute;
            left: -33px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 11px;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .bg-blue {
            background: #007bff;
        }

        .bg-green {
            background: #28a745;
        }

        .bg-orange {
            background: #fd7e14;
        }

        .timeline-content {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 12px;
            color: #999;
        }

        .actor {
            font-weight: 700;
            color: #333;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar Kepala Departemen -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System (Ka. Dept)</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('kepala_departemen.dashboard') }}" class="nav-item">
                    <i class="fas fa-th-large"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('kepala_departemen.check_documents') }}" class="nav-item active">
                    <i class="fas fa-file-signature"></i><span>Cek Dokumen</span>
                </a>
            </nav>
            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">{{ substr(Auth::user()->nama_user, 0, 2) }}</div>
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->nama_user }}</div>
                        <div class="user-role">{{ Auth::user()->departemen->nama_dept ?? 'Kepala Departemen' }}</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="fas fa-sign-out-alt"></i> Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Review Dokumen</h1>
                <a href="{{ route('kepala_departemen.check_documents') }}" class="btn-secondary"><i
                        class="fas fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="content-area">
                <form id="hiradcForm" method="POST" action="{{ route('kepala_departemen.approve', $document->id) }}">
                    @csrf
                    <!-- Hidden Actions -->
                    <input type="hidden" name="action" id="action_input" value="approve">
                    <input type="hidden" name="catatan" id="catatan_input">

                    <!-- CARD 1: Informasi Dasar -->
                    <div class="card">
                        <div class="section-header">
                            <div class="section-icon"><i class="fas fa-info-circle"></i></div>
                            <h2>Informasi Dasar</h2>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Proses Bisnis</label>
                                <input type="text" class="form-control" id="kolom2_proses" name="kolom2_proses" required
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label>Kegiatan / Aktivitas</label>
                                <input type="text" class="form-control" id="kolom2_activity_manual"
                                    name="kolom2_kegiatan" required disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Lokasi / Area Kerja</label>
                            <input type="text" class="form-control" id="kolom3_lokasi" name="kolom3_lokasi" required
                                disabled>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Kategori Dokumen</label>
                                <select class="form-control" id="kolom4_kategori" name="kategori" required
                                    onchange="updateConditionOptions()" disabled>
                                    <option value="">-- Pilih --</option>
                                    <option value="K3">K3</option>
                                    <option value="KO">KO</option>
                                    <option value="Lingkungan">Lingkungan</option>
                                    <option value="Keamanan">Keamanan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kondisi Operasional</label>
                                <select class="form-control" id="kolom5_kondisi" name="kolom5_kondisi" required
                                    disabled>
                                    <option value="">-- Pilih Kategori Dulu --</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2: Identifikasi Bahaya -->
                    <div class="card">
                        <div class="section-header">
                            <div class="section-icon"><i class="fas fa-exclamation-triangle"></i></div>
                            <h2>Identifikasi Bahaya / Aspek</h2>
                        </div>

                        <div id="section_k3_ko" class="hidden">
                            <input type="hidden" name="bahaya_type" id="bahaya_type">
                            <div class="button-group">
                                <button type="button" class="btn-toggle active" id="btn_unsafe_condition"
                                    disabled>Unsafe Condition</button>
                                <button type="button" class="btn-toggle" id="btn_unsafe_action" disabled>Unsafe
                                    Action</button>
                            </div>
                            <div id="unsafe_condition_options" class="hidden"></div>
                            <div id="unsafe_action_options" class="hidden"></div>
                        </div>
                        <div id="section_lingkungan" class="hidden">
                            <div id="lingkungan_options"></div>
                        </div>
                        <div id="section_keamanan" class="hidden">
                            <div id="keamanan_options"></div>
                        </div>
                        <div class="form-group" style="margin-top:20px;">
                            <label id="manual_bahaya_label">Detail / Input Manual</label>
                            <input type="text" class="form-control" id="bahaya_manual" name="bahaya_manual" disabled>
                        </div>
                    </div>

                    <!-- CARD 3: Dampak & Risiko -->
                    <div class="card">
                        <div class="section-header">
                            <div class="section-icon"><i class="fas fa-fire"></i></div>
                            <h2>Dampak & Risiko</h2>
                        </div>
                        <div class="form-group">
                            <label>Dampak (Konsekuensi)</label>
                            <textarea class="form-control" id="kolom7_dampak" name="kolom7_dampak" required
                                disabled></textarea>
                        </div>
                        <div class="form-group">
                            <label>Identifikasi Risiko</label>
                            <textarea class="form-control" id="kolom9_risiko" name="kolom9_risiko" required
                                disabled></textarea>
                        </div>
                    </div>

                    <!-- CARD 4: Pengendalian -->
                    <div class="card">
                        <div class="section-header">
                            <div class="section-icon"><i class="fas fa-shield-alt"></i></div>
                            <h2>Pengendalian Risiko</h2>
                        </div>

                        <div class="form-group">
                            <label style="margin-bottom:15px; display:block;">Hirarki Pengendalian</label>
                            <div class="checkbox-group">
                                <div class="checkbox-item"><input type="checkbox" id="h1" name="hirarki[]"
                                        value="Eliminasi" disabled><label for="h1">Eliminasi</label></div>
                                <div class="checkbox-item"><input type="checkbox" id="h2" name="hirarki[]"
                                        value="Substitusi" disabled><label for="h2">Substitusi</label></div>
                                <div class="checkbox-item"><input type="checkbox" id="h3" name="hirarki[]"
                                        value="Rekayasa Teknik" disabled><label for="h3">Rekayasa Teknik</label></div>
                                <div class="checkbox-item"><input type="checkbox" id="h4" name="hirarki[]"
                                        value="Administratif" disabled><label for="h4">Administratif</label></div>
                                <div class="checkbox-item"><input type="checkbox" id="h5" name="hirarki[]" value="APD"
                                        disabled><label for="h5">APD</label></div>
                            </div>
                            <div id="additional_controls" style="margin-top:20px;"></div>
                        </div>

                        <div class="form-group">
                            <label>Pengendalian Existing (Saat ini)</label>
                            <textarea class="form-control" id="kolom11_pengendalian" name="kolom11_existing" required
                                disabled></textarea>
                        </div>
                    </div>

                    <!-- CARD 5: Penilaian Risiko Awal -->
                    <div class="card">
                        <div class="section-header">
                            <div class="section-icon"><i class="fas fa-chart-bar"></i></div>
                            <h2>Penilaian Risiko Awal</h2>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Kemungkinan (Likelihood)</label>
                                <select class="form-control" id="kolom12_kemungkinan" name="kolom12_kemungkinan"
                                    onchange="calculateRisk()" disabled>
                                    <option value="1">1 - Sangat Jarang</option>
                                    <option value="2">2 - Jarang</option>
                                    <option value="3">3 - Mungkin</option>
                                    <option value="4">4 - Sering</option>
                                    <option value="5">5 - Sangat Sering</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Konsekuensi (Severity)</label>
                                <select class="form-control" id="kolom13_konsekuensi" name="kolom13_konsekuensi"
                                    onchange="calculateRisk()" disabled>
                                    <option value="1">1 - Tidak Signifikan</option>
                                    <option value="2">2 - Kecil</option>
                                    <option value="3">3 - Sedang</option>
                                    <option value="4">4 - Besar</option>
                                    <option value="5">5 - Bencana</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nilai Risiko (Score)</label>
                            <input type="text" class="form-control" id="kolom14_nilai_risiko" readonly
                                style="font-weight:700; background:#f0f0f0;">
                        </div>
                    </div>

                    <!-- CARD 6: Regulasi -->
                    <div class="card">
                        <div class="section-header">
                            <div class="section-icon"><i class="fas fa-gavel"></i></div>
                            <h2>Regulasi & Kewajiban</h2>
                        </div>
                        <div class="form-group">
                            <label>Peraturan / Standar Terkait</label>
                            <textarea class="form-control" id="kolom15_peraturan" name="kolom15_regulasi"
                                disabled></textarea>
                        </div>
                        <div class="form-group" id="kolom16_container">
                            <label>Status Penting?</label>
                            <div style="display: flex; gap: 20px; margin-top:5px;">
                                <label><input type="radio" name="kolom16_penting" value="P" disabled> Penting</label>
                                <label><input type="radio" name="kolom16_penting" value="TP" disabled> Tidak
                                    Penting</label>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 7: Risiko & Peluang Lanjutan -->
                    <div class="card">
                        <div class="section-header">
                            <div class="section-icon"><i class="fas fa-lightbulb"></i></div>
                            <h2>Risiko & Peluang Lanjutan</h2>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Risiko Lain</label>
                                <textarea class="form-control" id="kolom17_risiko" name="kolom17_risiko"
                                    disabled></textarea>
                            </div>
                            <div class="form-group">
                                <label>Peluang (Opportunity)</label>
                                <textarea class="form-control" id="kolom17_peluang" name="kolom17_peluang"
                                    disabled></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 8: Tindak Lanjut & Residual -->
                    <div class="card">
                        <div class="section-header">
                            <div class="section-icon"><i class="fas fa-forward"></i></div>
                            <h2>Tindak Lanjut & Risiko Residual</h2>
                        </div>
                        <div class="form-group">
                            <label>Rencana Tindak Lanjut</label>
                            <textarea class="form-control" id="kolom19_tindak_lanjut" name="kolom18_tindak_lanjut"
                                required disabled></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Kemungkinan Residual</label>
                                <select class="form-control" id="kolom20_kemungkinan" name="residual_kemungkinan"
                                    onchange="calculateResidualRisk()" disabled>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Konsekuensi Residual</label>
                                <select class="form-control" id="kolom21_konsekuensi" name="residual_konsekuensi"
                                    onchange="calculateResidualRisk()" disabled>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nilai Risiko Residual</label>
                            <input type="text" class="form-control" id="kolom22_nilai_risiko" readonly
                                style="font-weight:700; background:#f0f0f0;">
                        </div>
                    </div>
                </form>

                <!-- CARD HISTORY (Outside Form) -->
                <div class="card">
                    <div class="section-header">
                        <div class="section-icon"><i class="fas fa-history"></i></div>
                        <h2>Riwayat Aktivitas</h2>
                    </div>
                    <div class="timeline-container">
                        @foreach($document->approvals as $approval)
                            <div class="timeline-item">
                                <div
                                    class="timeline-icon {{ $approval->action == 'approved' ? 'bg-green' : ($approval->action == 'revision' ? 'bg-orange' : 'bg-blue') }}">
                                    <i
                                        class="fas {{ $approval->action == 'approved' ? 'fa-check' : ($approval->action == 'revision' ? 'fa-undo' : 'fa-info') }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <span class="actor">{{ $approval->approver->nama_user ?? 'User' }}</span>
                                        <span class="time">{{ $approval->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                    <div class="timeline-body">
                                        <strong>Status: {{ ucfirst($approval->action) }}</strong><br>
                                        "{{ $approval->catatan ?? '-' }}"
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- REVIEW FOOTER -->
                <div class="review-footer">
                    <div class="comment-section">
                        <label class="comment-label">Catatan Review / Revisi:</label>
                        <textarea class="comment-input" id="review_notes"
                            placeholder="Tuliskan catatan untuk penyetuju atau pemohon..."></textarea>
                    </div>
                    <div class="action-buttons">
                        <button type="button" class="btn-revisi" onclick="submitReview('revision')"><i
                                class="fas fa-undo"></i> Tolak / Revisi</button>
                        <button type="button" class="btn-approve" onclick="submitReview('approved')"><i
                                class="fas fa-check"></i> Setujui Dokumen</button>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Inject JS (Preserved Logic) -->
    <script>
        window.editingDocument = @json($document);
        const routeApprove = "{{ route('kepala_departemen.approve', $document->id) }}";
        const routeRevise = "{{ route('kepala_departemen.revise', $document->id) }}";

        const hazardData = {
            k3_condition: {
                "Fisika": ["Bekerja di ketinggian", "Permukaan licin", "Kejatuhan material", "Ruang terbatas", "Benda berputar", "Radiasi", "Bising", "Tersengat listrik", "Suhu ekstrim"],
                "Kimia": ["Terhirup bahan kimia", "Kontak bahan kimia", "Tertelan bahan kimia", "Penyimpanan tidak sesuai"],
                "Biologi": ["Virus", "Bakteri", "Ular", "Serangga", "Makanan terkontaminasi"]
            },
            k3_action: { "Fisiologis/Ergonomi": ["Pengangkatan manual berlebih", "Posisi kerja janggal"], "Psikologis": ["Bekerja berlebihan", "Stress kerja"], "Prilaku": ["Tidak pakai APD", "Penyimpangan prosedur"] },
            lingkungan: { "Emisi": "Debu", "Air": "Limbah Cair", "Tanah": "Sampah Padat", "SDA": "Air", "Energi": "Listrik", "Limbah": "B3" },
            keamanan: { "Fisik": "Pencurian", "Siber": "Peretasan", "Personil": "Sabotase" }
        };

        function selectBahayaType(type) {
            // Only affect styling if user were editing, but this is review mode
            const bType = document.getElementById('bahaya_type');
            if (bType) bType.value = type;

            const divCondition = document.getElementById('unsafe_condition_options');
            const divAction = document.getElementById('unsafe_action_options');
            if (type === 'condition') {
                document.getElementById('btn_unsafe_condition').classList.add('active');
                document.getElementById('btn_unsafe_action').classList.remove('active');
                divCondition.classList.remove('hidden');
                divAction.classList.add('hidden');
            } else {
                document.getElementById('btn_unsafe_condition').classList.remove('active');
                document.getElementById('btn_unsafe_action').classList.add('active');
                divCondition.classList.add('hidden');
                divAction.classList.remove('hidden');
            }
        }

        function updateBahayaContent(category) {
            document.getElementById('section_k3_ko').classList.add('hidden');
            document.getElementById('section_lingkungan').classList.add('hidden');
            document.getElementById('section_keamanan').classList.add('hidden');

            if (category === 'K3' || category === 'KO') {
                document.getElementById('section_k3_ko').classList.remove('hidden');
                document.getElementById('unsafe_condition_options').innerHTML = renderCheckboxes(hazardData.k3_condition, 'cond', 'bahaya_detail[]');
                document.getElementById('unsafe_action_options').innerHTML = renderCheckboxes(hazardData.k3_action, 'act', 'bahaya_detail[]');
                selectBahayaType('condition');
            } else if (category === 'Lingkungan') {
                document.getElementById('section_lingkungan').classList.remove('hidden');
                document.getElementById('lingkungan_options').innerHTML = renderSimpleCheckboxes(hazardData.lingkungan, 'bahaya_aspect[]');
            } else if (category === 'Keamanan' || category === 'Pengamanan') {
                const kData = hazardData.keamanan || ["Terorisme", "Sabotase", "Pencurian"];
                document.getElementById('section_keamanan').classList.remove('hidden');
                document.getElementById('keamanan_options').innerHTML = renderSimpleCheckboxes(kData, 'bahaya_security[]');
            }
        }

        function renderCheckboxes(data, prefix, name) {
            let html = '<div class="checkbox-group">';
            for (const entry of Object.entries(data)) {
                const key = entry[0];
                const vals = entry[1];
                html += `<div><strong style="display:block;margin-bottom:5px;font-size:12px;">${key}</strong>`;
                vals.forEach(v => {
                    html += `<div class="checkbox-item"><input type="checkbox" name="${name}" value="${key}: ${v}" disabled><label>${v}</label></div>`;
                });
                html += `</div>`;
            }
            html += '</div>';
            return html;
        }

        function renderSimpleCheckboxes(data, name) {
            let html = '<div class="checkbox-group">';
            if (Array.isArray(data)) {
                data.forEach(v => { html += `<div class="checkbox-item"><input type="checkbox" name="${name}" value="${v}" disabled><label>${v}</label></div>`; });
            } else {
                for (const [k, v] of Object.entries(data)) {
                    html += `<div class="checkbox-item"><input type="checkbox" name="${name}" value="${k}" disabled><label>${k} (${v})</label></div>`;
                }
            }
            html += '</div>';
            return html;
        }

        function updateConditionOptions() {
            const cat = document.getElementById('kolom4_kategori').value;
            let html = '<option value="">-- Pilih --</option>';
            if (cat === 'K3' || cat === 'KO') { html += '<option value="R">Rutin</option><option value="NR">Non Rutin</option><option value="EM">Emergency</option>'; }
            else if (cat === 'Lingkungan') { html += '<option value="N">Normal</option><option value="TN">Tak Normal</option><option value="EM">Emergency</option>'; }
            else { html += '<option value="EM">Emergency</option>'; }
            document.getElementById('kolom5_kondisi').innerHTML = html;
            updateBahayaContent(cat);
        }

        function addControlInput() {
            // Disabled in review mode
        }

        function calculateRisk() {
            const l = document.getElementById('kolom12_kemungkinan').value;
            const c = document.getElementById('kolom13_konsekuensi').value;
            if (l && c) document.getElementById('kolom14_nilai_risiko').value = l * c;
        }
        function calculateResidualRisk() {
            const l = document.getElementById('kolom20_kemungkinan').value;
            const c = document.getElementById('kolom21_konsekuensi').value;
            if (l && c) document.getElementById('kolom22_nilai_risiko').value = l * c;
        }
        function checkRegulasi() {
            const val = document.getElementById('kolom15_peraturan').value;
            if (val && val.length > 0) document.querySelector('input[name="kolom16_penting"][value="P"]').checked = true;
            else document.querySelector('input[name="kolom16_penting"][value="TP"]').checked = true;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const doc = window.editingDocument;
            if (!doc) return;

            if (document.getElementById('kolom2_proses')) document.getElementById('kolom2_proses').value = doc.kolom2_proses || '';
            if (document.getElementById('kolom2_activity_manual')) document.getElementById('kolom2_activity_manual').value = doc.kolom2_kegiatan || '';
            if (document.getElementById('kolom3_lokasi')) document.getElementById('kolom3_lokasi').value = doc.kolom3_lokasi || '';

            if (document.getElementById('kolom4_kategori')) {
                document.getElementById('kolom4_kategori').value = doc.kategori;
                updateConditionOptions();
            }
            if (document.getElementById('kolom5_kondisi')) document.getElementById('kolom5_kondisi').value = doc.kolom5_kondisi || '';

            if (doc.kolom6_bahaya && typeof doc.kolom6_bahaya === 'object') {
                const h = doc.kolom6_bahaya;
                if (h.type) selectBahayaType(h.type);
                if (document.getElementById('bahaya_manual')) document.getElementById('bahaya_manual').value = h.manual || '';
            }

            if (document.getElementById('kolom7_dampak')) document.getElementById('kolom7_dampak').value = doc.kolom7_dampak || '';
            if (document.getElementById('kolom9_risiko')) document.getElementById('kolom9_risiko').value = doc.kolom9_risiko || '';

            if (doc.kolom10_pengendalian && typeof doc.kolom10_pengendalian === 'object') {
                const c = doc.kolom10_pengendalian;
                if (c.hierarchy) {
                    c.hierarchy.forEach(v => {
                        // In review mode, items are disabled, but we must check them
                        const el = document.querySelector(`input[name="hirarki[]"][value="${v}"]`);
                        if (el) el.checked = true;
                    });
                }
            }

            if (document.getElementById('kolom11_pengendalian')) document.getElementById('kolom11_pengendalian').value = doc.kolom11_existing || '';
            if (document.getElementById('kolom12_kemungkinan')) document.getElementById('kolom12_kemungkinan').value = doc.kolom12_kemungkinan || 1;
            if (document.getElementById('kolom13_konsekuensi')) document.getElementById('kolom13_konsekuensi').value = doc.kolom13_konsekuensi || 1;
            calculateRisk();

            if (document.getElementById('kolom15_peraturan')) {
                document.getElementById('kolom15_peraturan').value = doc.kolom15_regulasi || '';
                checkRegulasi();
            }

            if (document.getElementById('kolom19_tindak_lanjut')) document.getElementById('kolom19_tindak_lanjut').value = doc.kolom18_tindak_lanjut || '';

            // Other optional fields
            if (document.getElementById('kolom17_risiko')) document.getElementById('kolom17_risiko').value = doc.kolom17_risiko || '';
            if (document.getElementById('kolom17_peluang')) document.getElementById('kolom17_peluang').value = doc.kolom17_peluang || '';

            if (document.getElementById('kolom20_kemungkinan')) document.getElementById('kolom20_kemungkinan').value = doc.residual_kemungkinan || 1;
            if (document.getElementById('kolom21_konsekuensi')) document.getElementById('kolom21_konsekuensi').value = doc.residual_konsekuensi || 1;
            calculateResidualRisk();
        });

        function submitReview(action) {
            const form = document.getElementById('hiradcForm');
            if (action === 'revision') form.action = routeRevise;
            else form.action = routeApprove;

            document.getElementById('action_input').value = action;
            document.getElementById('catatan_input').value = document.getElementById('review_notes').value;
            if (action === 'revision' && document.getElementById('review_notes').value.trim() === '') {
                // SweetAlert for error
                Swal.fire({
                    title: 'Gagal',
                    text: 'Harap isi catatan revisi!',
                    icon: 'warning',
                    confirmButtonColor: '#c41e3a'
                });
                return;
            }
            document.getElementById('hiradcForm').submit();
        }
    </script>
    <!-- SweetAlert for client side validation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>