<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen - HIRADC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Base styles from create.blade.php */
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

        /* Added padding for fixed footer */
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
            z-index: 101;
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
            max-width: 1400px;
        }

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

        .form-actions {
            display: none;
        }

        /* Hide default Submit button in Review Mode */

        /* Review Footer Fixed */
        .review-footer {
            position: fixed;
            bottom: 0;
            left: 250px;
            right: 0;
            background: white;
            padding: 20px 40px;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08);
            z-index: 900;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 30px;
            align-items: end;
        }

        .comment-section {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .comment-label {
            font-size: 12px;
            font-weight: 600;
            color: #555;
        }

        .comment-input {
            width: 100%;
            height: 60px;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 10px;
            font-family: inherit;
            font-size: 14px;
            resize: none;
            background: #fff;
            transition: all 0.2s;
        }

        .comment-input:focus {
            border-color: #c41e3a;
            box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.1);
            height: 80px;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            padding-bottom: 5px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-family: 'Inter';
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-edit {
            background: #ffc107;
            color: #212529;
        }

        .btn-edit:hover {
            background: #e0a800;
        }

        .btn-edit.active {
            background: #e0a800;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .btn-revisi {
            background: white;
            border: 1px solid #dc3545;
            color: #dc3545;
        }

        .btn-revisi:hover {
            background: #fff5f5;
        }

        .btn-approve {
            background: #c41e3a;
            color: white;
        }

        .btn-approve:hover {
            background: #a01729;
        }

        .edit-badge {
            background: #ffc107;
            color: #212529;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            margin-left: 10px;
            display: none;
        }

        .form-control:disabled {
            background-color: #f9f9f9;
            color: #555;
            cursor: not-allowed;
            border-color: #eee;
        }

        .checkbox-item input:disabled {
            cursor: not-allowed;
        }

        .checkbox-item.disabled {
            background: #fafafa;
            border-color: #eee;
            color: #888;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar Approver -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System (Approver)</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('approver.dashboard') }}" class="nav-item">
                    <i class="fas fa-th-large"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('approver.check_documents') }}" class="nav-item active">
                    <i class="fas fa-file-signature"></i><span>Cek Dokumen</span>
                </a>

            </nav>
            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">KU</div>
                    <div class="user-details">
                        <div class="user-name">Budi Santoso</div>
                        <div class="user-role">Kepala Unit Kerja</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="fas fa-sign-out-alt"></i> Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf
                </form>
            </div>
        </aside>

        <!-- Main Content (Full Form) -->
        <main class="main-content">
            <div class="header">
                <div style="display:flex; align-items:center;">
                    <h1>Review Dokumen <span class="edit-badge" id="editBadge">MODE EDIT</span></h1>
                </div>
                <a href="{{ route('approver.check_documents') }}" class="btn" style="background:#ddd; color:#333;"><i
                        class="fas fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="content-area">
                <form id="hiradcForm" class="form-container">

                    <!-- Form sections identical to create.blade.php but inputs will be disabled by JS -->

                    <!-- KOLOM 2 -->
                    <div class="section-header">
                        <h2>📋 Kolom 2: Proses Bisnis / Kegiatan / Aset</h2>
                        <p>Proses bisnis dan kegiatan yang diajukan</p>
                    </div>
                    <div class="form-group"><label>Proses Bisnis</label><select class="form-control" id="kolom2_proses"
                            disabled>
                            <option value="PRODUKSI" selected>PRODUKSI</option>
                        </select></div>
                    <div class="form-group"><label>Kegiatan/Aset</label><input type="text" class="form-control"
                            value="Pengoperasian Mesin Crusher Area 4" disabled></div>

                    <!-- KOLOM 3 -->
                    <div class="section-header">
                        <h2>📍 Kolom 3: Lokasi / Area Kerja</h2>
                    </div>
                    <div class="form-group"><label>Lokasi</label><input type="text" class="form-control"
                            id="kolom3_lokasi" value="Pabrik Indarung V" disabled></div>

                    <!-- KOLOM 4 -->
                    <div class="section-header">
                        <h2>📑 Kolom 4: Kategori Dokumen</h2>
                    </div>
                    <div class="form-group"><label>Jenis Dokumen</label><select class="form-control"
                            id="kolom4_kategori" disabled>
                            <option value="K3" selected>K3 - Kesehatan & Keselamatan Kerja</option>
                            <option value="KO">KO</option>
                            <option value="Lingkungan">Lingkungan</option>
                            <option value="Keamanan">Keamanan</option>
                        </select></div>

                    <!-- KOLOM 5 -->
                    <div class="section-header">
                        <h2>⚙️ Kolom 5: Kondisi</h2>
                    </div>
                    <div class="form-group"><label>Kondisi</label><select class="form-control" id="kolom5_kondisi"
                            disabled>
                            <option value="N" selected>N - Normal</option>
                        </select></div>

                    <!-- KOLOM 6 -->
                    <div class="section-header">
                        <h2>⚠️ Kolom 6: Jenis Bahaya</h2>
                    </div>
                    <div class="form-group"><label>Identifikasi Bahaya</label><input type="text" class="form-control"
                            value="Kebisingan suara mesin > 85dB" disabled></div>

                    <!-- KOLOM 7 -->
                    <div class="section-header">
                        <h2>💥 Kolom 7: Dampak / Konsekuensi</h2>
                    </div>
                    <div class="form-group"><label>Dampak</label><textarea class="form-control" id="kolom7_dampak"
                            disabled>Potensi gangguan pendengaran (NIHL) pada operator.</textarea></div>

                    <!-- KOLOM 8 -->
                    <div class="section-header">
                        <h2>👥 Kolom 8: Pihak Terkena Dampak</h2>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-group">
                            <div class="checkbox-item disabled"><input type="checkbox" checked disabled><label>Pekerja
                                    Internal</label></div>
                            <div class="checkbox-item disabled"><input type="checkbox"
                                    disabled><label>Kontraktor</label></div>
                        </div>
                    </div>

                    <!-- KOLOM 9 -->
                    <div class="section-header">
                        <h2>🔍 Kolom 9: Identifikasi Risiko</h2>
                    </div>
                    <div class="form-group"><label>Risiko</label><textarea class="form-control" id="kolom9_risiko"
                            disabled>Paparan kebisingan terus menerus tanpa pelindung telinga.</textarea></div>

                    <!-- KOLOM 10 -->
                    <div class="section-header">
                        <h2>🛡️ Kolom 10: Hirarki Pengendalian</h2>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-group">
                            <div class="checkbox-item disabled"><input type="checkbox" disabled><label>1.
                                    Eliminasi</label></div>
                            <div class="checkbox-item disabled"><input type="checkbox" checked disabled><label>5. APD
                                    (Alat Pelindung Diri)</label></div>
                            <div class="checkbox-item disabled"><input type="checkbox" checked disabled><label>4.
                                    Administratif</label></div>
                        </div>
                    </div>

                    <!-- KOLOM 11 -->
                    <div class="section-header">
                        <h2>✅ Kolom 11: Pengendalian Existing</h2>
                    </div>
                    <div class="form-group"><label>Deskripsi Pengendalian</label><textarea class="form-control"
                            disabled>Wajib menggunakan Ear Plug/Ear Muff di area Crusher. Rambu peringatan kebisingan sudah terpasang.</textarea>
                    </div>

                    <!-- KOLOM 12-14 -->
                    <div class="section-header">
                        <h2>📊 Kolom 12-14: Penilaian Risiko Awal</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>Kolom 12: Kemungkinan (P)</label><select class="form-control"
                                disabled>
                                <option selected>4 - Sering</option>
                            </select></div>
                        <div class="form-group"><label>Kolom 13: Konsekuensi (C)</label><select class="form-control"
                                disabled>
                                <option selected>3 - Moderate</option>
                            </select></div>
                    </div>
                    <div class="form-group">
                        <label>Kolom 14: Risiko (Score)</label>
                        <div style="display:flex; gap:15px; align-items:center;">
                            <input type="text" class="form-control" value="12" readonly
                                style="width:80px; text-align:center; font-weight:bold;">
                            <span
                                style="background:#fd7e14; color:white; padding:8px 15px; border-radius:6px; font-weight:bold;">TINGGI</span>
                        </div>
                    </div>

                    <!-- KOLOM 15 -->
                    <div class="section-header">
                        <h2>📜 Kolom 15: Peraturan Perundangan</h2>
                    </div>
                    <div class="form-group"><label>Regulasi</label><textarea class="form-control"
                            disabled>Permenaker No. 5 Tahun 2018 tentang K3 Lingkungan Kerja.</textarea></div>

                    <!-- KOLOM 16 -->
                    <div class="section-header">
                        <h2>🌿 Kolom 16: Aspek Penting</h2>
                    </div>
                    <div class="form-group"><label>Status</label><input type="text" class="form-control"
                            value="P - Penting" disabled></div>

                    <!-- KOLOM 17 -->
                    <div class="section-header">
                        <h2>💡 Kolom 17: Risiko & Peluang</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>Risiko</label><textarea class="form-control"
                                disabled>Pekerja lalai menggunakan APD.</textarea></div>
                        <div class="form-group"><label>Peluang</label><textarea class="form-control"
                                disabled>Pemasangan sound barrier untuk mengurangi desibel mesin.</textarea></div>
                    </div>

                    <!-- KOLOM 18-22 (Full Structure present in Create) -->
                    <!-- Simplified for Brevity in this Mock, but structure implies full presence -->
                    <div class="section-header">
                        <h2>⚖️ Kolom 18-22: Tindak Lanjut & Residual</h2>
                    </div>
                    <div class="form-group"><label>Tindak Lanjut</label><textarea class="form-control"
                            disabled>Sosialisasi rutin safety talk dan inspeksi APD mendadak.</textarea></div>

                </form>

                <!-- Riwayat Aktivitas Section -->
                <div class="section-header" style="margin-top: 50px; border-left-color: #555;">
                    <h2 style="color: #555;"><i class="fas fa-history"></i> Riwayat Aktivitas Dokumen</h2>
                    <p>Jejak rekam status dan perubahan dokumen</p>
                </div>

                <div class="timeline-container">
                    <!-- Timeline Item 1 -->
                    <div class="timeline-item">
                        <div class="timeline-icon bg-blue"><i class="fas fa-paper-plane"></i></div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <span class="actor">John Doe (Staff Unit Kerja)</span>
                                <span class="time">18 Okt 2025, 09:30 WIB</span>
                            </div>
                            <div class="timeline-body">
                                Mengirimkan dokumen baru untuk direview.
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Item 2 -->
                    <div class="timeline-item">
                        <div class="timeline-icon bg-orange"><i class="fas fa-undo"></i></div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <span class="actor">Budi Santoso (Kepala Unit Kerja)</span>
                                <span class="time">19 Okt 2025, 10:15 WIB</span>
                            </div>
                            <div class="timeline-body">
                                <strong>Status: Revisi</strong><br>
                                "Mohon lengkapi bagian identifikasi bahaya, kurang spesifik."
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Item 3 -->
                    <div class="timeline-item">
                        <div class="timeline-icon bg-blue"><i class="fas fa-edit"></i></div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <span class="actor">John Doe (Staff Unit Kerja)</span>
                                <span class="time">20 Okt 2025, 08:00 WIB</span>
                            </div>
                            <div class="timeline-body">
                                Melakukan perbaikan pada Kolom 6 dan mengirim ulang.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add CSS for Timeline inline or safely -->
                <style>
                    .timeline-container {
                        position: relative;
                        padding-left: 20px;
                        border-left: 2px solid #e0e0e0;
                        margin-left: 10px;
                        margin-top: 20px;
                    }

                    .timeline-item {
                        position: relative;
                        margin-bottom: 25px;
                        padding-left: 25px;
                    }

                    .timeline-icon {
                        position: absolute;
                        left: -11px;
                        top: 0;
                        width: 20px;
                        height: 20px;
                        border-radius: 50%;
                        color: white;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 10px;
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

                    .bg-red {
                        background: #dc3545;
                    }

                    .timeline-content {
                        background: #f8f9fa;
                        padding: 15px;
                        border-radius: 8px;
                        border: 1px solid #e9ecef;
                    }

                    .timeline-header {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 8px;
                        font-size: 12px;
                    }

                    .timeline-header .actor {
                        font-weight: 700;
                        color: #333;
                    }

                    .timeline-header .time {
                        color: #888;
                    }

                    .timeline-body {
                        font-size: 13px;
                        color: #555;
                        line-height: 1.4;
                    }
                </style>
            </div>
        </main>

        <!-- Footer Actions -->
        <div class="review-footer">
            <div class="comment-section">
                <label class="comment-label">Komentar / Catatan Revisi</label>
                <textarea id="commentBox" class="comment-input"
                    placeholder="Tulis komentar revisi atau catatan edit di sini..."></textarea>
            </div>

            <div class="action-buttons">
                <button type="button" class="btn btn-edit" id="btnEdit" onclick="toggleEditMode()">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button type="button" class="btn btn-revisi" onclick="submitRevisi()">
                    <i class="fas fa-undo"></i> Revisi
                </button>
                <button type="button" class="btn btn-approve" onclick="submitApprove()">
                    <i class="fas fa-check-circle"></i> Disetujui
                </button>
            </div>
        </div>
    </div>

    <script>
        let isEditMode = false;

        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');

            if (status === 'Disetujui') {
                // Requirement 2: Hide actions and comment if approved
                document.querySelector('.review-footer').style.display = 'none';
                // Also disable form fields just in case
                const formElements = document.querySelectorAll('#hiradcForm input, #hiradcForm select, #hiradcForm textarea');
                formElements.forEach(el => el.disabled = true);
            } else if (status === 'Revisi') {
                // Requirement 3: Hide Revisi button if already in Revision
                const btnRevisi = document.querySelector('.btn-revisi');
                if (btnRevisi) btnRevisi.style.display = 'none';
            }
        });

        function toggleEditMode() {
            isEditMode = !isEditMode;
            const btnEdit = document.getElementById('btnEdit');
            const badge = document.getElementById('editBadge');

            // Toggle enable/disable all inputs/selects/textareas
            const formElements = document.querySelectorAll('#hiradcForm input, #hiradcForm select, #hiradcForm textarea');
            formElements.forEach(el => {
                el.disabled = !isEditMode;
            });

            // Toggle checkboxes special styling
            const checkboxes = document.querySelectorAll('.checkbox-item');
            checkboxes.forEach(box => {
                if (isEditMode) {
                    box.classList.remove('disabled');
                    box.querySelector('input').disabled = false;
                } else {
                    box.classList.add('disabled');
                    box.querySelector('input').disabled = true;
                }
            });

            if (isEditMode) {
                btnEdit.innerHTML = '<i class="fas fa-save"></i> Simpan Mode';
                btnEdit.classList.add('active');
                badge.style.display = 'inline-block';
                document.getElementById('commentBox').focus();
            } else {
                btnEdit.innerHTML = '<i class="fas fa-edit"></i> Edit';
                btnEdit.classList.remove('active');
                badge.style.display = 'none';
            }
        }

        function submitRevisi() {
            const comment = document.getElementById('commentBox').value;
            if (!comment.trim()) {
                alert('⚠️ Harap isi kolom komentar terlebih dahulu sebelum mengirim revisi!');
                document.getElementById('commentBox').focus();
                return;
            }

            if (confirm('Kirim dokumen kembali ke Unit Kerja untuk direvisi?')) {
                alert(`✅ Dokumen dikembalikan ke Unit Kerja.\n\nCatatan: "${comment}"`);
                window.location.href = "{{ route('approver.check_documents') }}";
            }
        }

        function submitApprove() {
            const category = document.getElementById('kolom4_kategori').value;
            const comment = document.getElementById('commentBox').value;
            let targetUnit = "";
            let message = "";

            if (["K3", "KO", "Lingkungan"].includes(category)) {
                targetUnit = "Unit Pengelola SHE";
            } else {
                targetUnit = "Unit Pengelola Keamanan";
            }

            if (isEditMode) {
                if (!comment.trim()) {
                    alert('⚠️ Karena Anda melakukan pengeditan, mohon sertakan catatan tentang apa yang diubah pada kolom komentar.');
                    document.getElementById('commentBox').focus();
                    return;
                }
                message = `✅ Perubahan disimpan & Dokumen DISETUJUI.\n\nDokumen diteruskan ke ${targetUnit}.`;
            } else {
                message = `✅ Dokumen DISETUJUI.\n\nDokumen diteruskan ke ${targetUnit}.`;
            }

            if (confirm(`Setujui dokumen ini dan kirim ke ${targetUnit}?`)) {
                alert(message);
                window.location.href = "{{ route('approver.check_documents') }}";
            }
        }
    </script>
</body>

</html>