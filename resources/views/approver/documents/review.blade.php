<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen - HIRADC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #c41e3a;
            --primary-light: #fff1f2;
            --secondary: #64748b;
            --bg-body: #f1f5f9;
            --surface: #ffffff;
            --text-main: #1e293b;
            --text-sub: #64748b;
            --border: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            padding-bottom: 120px;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--surface);
            border-right: 1px solid var(--border);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 50;
        }

        .logo-section {
            padding: 24px;
            border-bottom: 1px solid var(--border);
            text-align: center;
        }

        .logo-circle {
            width: 64px;
            height: 64px;
            background: white;
            border-radius: 50%;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
        }

        .logo-circle img {
            max-width: 65%;
        }

        .logo-text {
            font-size: 16px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -0.02em;
        }

        .logo-subtext {
            font-size: 11px;
            color: var(--text-sub);
            font-weight: 500;
            margin-top: 2px;
        }

        .nav-menu {
            flex: 1;
            padding: 24px 16px;
            overflow-y: auto;
        }

        .nav-item {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--text-sub);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 4px;
        }

        .nav-item:hover,
        .nav-item.active {
            background: var(--primary-light);
            color: var(--primary);
        }

        .nav-item.active {
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
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 13px;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.85);
            margin-top: 2px;
        }

        .logout-btn {
            width: 100%;
            padding: 8px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
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
            margin-left: 260px;
            padding: 32px 48px;
            max-width: 1400px;
            margin-right: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 32px;
        }

        .header-title h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.03em;
            margin-bottom: 4px;
        }

        .header-title p {
            font-size: 14px;
            color: var(--text-sub);
        }

        .btn-back {
            padding: 8px 16px;
            border-radius: 6px;
            background: white;
            border: 1px solid var(--border);
            color: var(--text-main);
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: var(--bg-body);
            border-color: var(--text-sub);
        }

        /* Cards */
        .doc-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .doc-header {
            background: #f8fafc;
            padding: 20px 32px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .doc-title-label {
            font-size: 12px;
            color: var(--text-sub);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }

        .doc-title-value {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-main);
        }

        .doc-meta-badge {
            background: var(--primary-light);
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .card-header-slim {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border);
            background: #f8fafc;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-header-slim i {
            color: var(--primary);
        }

        .card-header-slim h2 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
        }

        .doc-body {
            padding: 24px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-sub);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-size: 14px;
            color: var(--text-main);
            background: white;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .read-only-mode .form-control {
            background: #f1f5f9;
            cursor: not-allowed;
        }

        /* Style for locked inputs */

        /* Risk Matrix */
        .risk-result-box {
            background: #1f2937;
            color: white;
            padding: 16px;
            border-radius: 12px;
            text-align: center;
        }

        .risk-score {
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }

        .risk-level {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.2);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Action Footer */
        .review-footer {
            position: fixed;
            bottom: 0;
            left: 260px;
            right: 0;
            background: white;
            padding: 20px 48px;
            border-top: 1px solid var(--border);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.05);
            z-index: 100;
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .notes-area {
            flex: 1;
        }

        .notes-area label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 6px;
            display: block;
        }

        .notes-input {
            width: 100%;
            height: 80px;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-family: inherit;
            font-size: 14px;
            resize: none;
        }

        .notes-input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .action-btns {
            display: flex;
            gap: 12px;
            align-items: flex-end;
        }

        .btn {
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: transform 0.1s;
            display: flex;
            align-items: center;
            gap: 8px;
            height: 50px;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-approve {
            background: #16a34a;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2);
        }

        .btn-approve:hover {
            background: #15803d;
        }

        .btn-revise {
            background: #dc2626;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.2);
        }

        .btn-revise:hover {
            background: #b91c1c;
        }

        /* Checkboxes */
        .checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 12px;
        }

        .checkbox-card {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }

        .checkbox-card input {
            accent-color: var(--primary);
            transform: scale(1.1);
        }

        .hidden {
            display: none;
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
                <div class="logo-subtext">HIRADC System (Approver)</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('approver.dashboard') }}" class="nav-item"><i
                        class="fas fa-th-large"></i><span>Dashboard</span></a>
                <a href="{{ route('approver.check_documents') }}" class="nav-item active"><i
                        class="fas fa-file-signature"></i><span>Cek Dokumen</span></a>
            </nav>
            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->nama_user ?? Auth::user()->username, 0, 2)) }}</div>
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->nama_user ?? Auth::user()->username }}</div>
                        <div class="user-role">{{ Auth::user()->role_jabatan_name }}</div>
                        <div class="user-role" style="font-weight: normal; opacity: 0.8;">
                            {{ Auth::user()->unit_or_dept_name }}</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="fas fa-sign-out-alt"></i> Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <div class="header-title">
                    <h1>Review & Edit Dokumen</h1>
                    <p>Periksa, edit jika perlu, dan setujui atau minta revisi.</p>
                </div>
                <a href="{{ route('approver.check_documents') }}" class="btn-back"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
            </div>

            <!-- Header Card -->
            <div class="doc-card">
                <div class="doc-header">
                    <div>
                        <div class="doc-title-label">Judul Kegiatan / Proses</div>
                        <div class="doc-title-value">{{ $document->kolom2_kegiatan }}</div>
                    </div>
                    <div class="doc-meta-badge">{{ $document->kategori }}</div>
                </div>
            </div>

            <form id="reviewForm" method="POST" action="">
                @csrf
                <input type="hidden" name="action" id="action_input">
                <input type="hidden" name="catatan" id="catatan_input_form">

                <!-- Card 1: Info Dasar -->
                <div class="doc-card">
                    <div class="card-header-slim"><i class="fas fa-info-circle"></i>
                        <h2>Informasi Dasar (Kolom 2-5)</h2>
                    </div>
                    <div class="doc-body">
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Proses Bisnis</label>
                                <input type="text" class="form-control" name="kolom2_proses"
                                    value="{{ $document->kolom2_proses }}">
                            </div>
                            <div class="form-group">
                                <label>Kegiatan</label>
                                <input type="text" class="form-control" name="kolom2_kegiatan"
                                    value="{{ $document->kolom2_kegiatan }}">
                            </div>
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="text" class="form-control" name="kolom3_lokasi"
                                    value="{{ $document->kolom3_lokasi }}">
                            </div>
                            <div class="form-group">
                                <label>Kondisi (Kolom 5)</label>
                                <input type="text" class="form-control" name="kolom5_kondisi"
                                    value="{{ $document->kolom5_kondisi }}">
                            </div>
                            <!-- Hidden Kategori (Needed for update logic) -->
                            <input type="hidden" name="kategori" value="{{ $document->kategori }}">
                        </div>
                    </div>
                </div>

                <!-- Card 2: Bahaya (Simplified for Edit - Text/List) -->
                <!-- Note: Re-implementing full dynamic hazard toggle is complex. 
                     We will allow editing "Bahaya Manual" and show selected hazards as text/checkboxes if possible.
                     For now, let's keep it as read-only detailed list + editable Manual field. -->
                <div class="doc-card">
                    <div class="card-header-slim"><i class="fas fa-exclamation-triangle"></i>
                        <h2>Identifikasi Bahaya (Kolom 6)</h2>
                    </div>
                    <div class="doc-body">
                        <div class="form-group">
                            <label>Rincian Bahaya Terpilih</label>
                            @php
                                $bahaya = $document->kolom6_bahaya;
                                $details = [];
                                if (isset($bahaya['details']))
                                    $details = array_merge($details, $bahaya['details']);
                                if (isset($bahaya['aspects']))
                                    $details = array_merge($details, $bahaya['aspects']);
                                if (isset($bahaya['threats']))
                                    $details = array_merge($details, $bahaya['threats']);
                            @endphp
                            <div style="background:#f8fafc; padding:15px; border-radius:8px; border:1px solid #e2e8f0;">
                                @if(count($details) > 0)
                                    <ul style="padding-left:20px;">
                                        @foreach($details as $d) <li>{{ $d }}</li> @endforeach
                                    </ul>
                                @else
                                    <span style="color:#64748b;">Tidak ada rincian terpilih.</span>
                                @endif
                                <!-- Hidden inputs to preserve data on update -->
                                @foreach($details as $d) <input type="hidden" name="bahaya_detail[]" value="{{ $d }}">
                                @endforeach
                                <input type="hidden" name="bahaya_type" value="{{ $bahaya['type'] ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Bahaya Lainnya (Manual)</label>
                            <input type="text" class="form-control" name="bahaya_manual"
                                value="{{ $bahaya['manual'] ?? '' }}">
                        </div>
                    </div>
                </div>

                <!-- Card 3: Risiko -->
                <div class="doc-card">
                    <div class="card-header-slim"><i class="fas fa-search-dollar"></i>
                        <h2>Analisis Risiko (Kolom 7 & 9)</h2>
                    </div>
                    <div class="doc-body">
                        <div class="form-grid">
                            <div class="form-group"><label>Dampak (Col 7)</label><textarea class="form-control"
                                    name="kolom7_dampak">{{ $document->kolom7_dampak }}</textarea></div>
                            <div class="form-group"><label>Identifikasi Risiko (Col 9)</label><textarea
                                    class="form-control" name="kolom9_risiko">{{ $document->kolom9_risiko }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Penilaian Risiko Awal -->
                <div class="doc-card">
                    <div class="card-header-slim"><i class="fas fa-calculator"></i>
                        <h2>Penilaian Risiko Awal (Kolom 12-14)</h2>
                    </div>
                    <div class="doc-body">
                        <div style="display:flex; gap:24px;">
                            <div style="flex:1;">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label>Kemungkinan (1-5)</label>
                                        <select class="form-control" id="kolom12_kemungkinan" name="kolom12_kemungkinan"
                                            onchange="calculateRisk()">
                                            @foreach([1, 2, 3, 4, 5] as $v) <option value="{{$v}}"
                                                {{$document->kolom12_kemungkinan == $v ? 'selected' : ''}}>{{$v}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Konsekuensi (1-5)</label>
                                        <select class="form-control" id="kolom13_konsekuensi" name="kolom13_konsekuensi"
                                            onchange="calculateRisk()">
                                            @foreach([1, 2, 3, 4, 5] as $v) <option value="{{$v}}"
                                                {{$document->kolom13_konsekuensi == $v ? 'selected' : ''}}>{{$v}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style="width:200px;">
                                <div class="risk-result-box">
                                    <div class="risk-score" id="display_risk_score">{{ $document->kolom14_score }}</div>
                                    <span class="risk-level" id="display_risk_level">PENDING</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Regulasi -->
                <div class="doc-card">
                    <div class="card-header-slim"><i class="fas fa-gavel"></i>
                        <h2>Regulasi (Kolom 15 & 16)</h2>
                    </div>
                    <div class="doc-body">
                        <div class="form-group">
                            <label>Peraturan</label>
                            <textarea class="form-control"
                                name="kolom15_regulasi">{{ $document->kolom15_regulasi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Status Penting?</label>
                            <div style="display: flex; gap: 20px; margin-top:5px;">
                                <label><input type="radio" name="kolom16_penting" value="P" {{ ($document->kolom16_penting ?? '') == 'P' ? 'checked' : '' }}> Penting</label>
                                <label><input type="radio" name="kolom16_penting" value="TP" {{ ($document->kolom16_penting ?? '') == 'TP' ? 'checked' : '' }}> Tidak
                                    Penting</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 6: Risiko & Peluang Additional -->
                <div class="doc-card">
                    <div class="card-header-slim"><i class="fas fa-lightbulb"></i>
                        <h2>Risiko & Peluang (Kolom 17)</h2>
                    </div>
                    <div class="doc-body">
                        <div class="form-grid">
                            <div class="form-group"><label>Risiko</label><textarea class="form-control"
                                    name="kolom17_risiko">{{ $document->kolom17_risiko }}</textarea></div>
                            <div class="form-group"><label>Peluang</label><textarea class="form-control"
                                    name="kolom17_peluang">{{ $document->kolom17_peluang }}</textarea></div>
                        </div>
                    </div>
                </div>

                <!-- Card 7: Pengendalian -->
                <div class="doc-card">
                    <div class="card-header-slim"><i class="fas fa-shield-alt"></i>
                        <h2>Pengendalian (Kolom 10 & 11)</h2>
                    </div>
                    <div class="doc-body">
                        <div class="form-group">
                            <label>Hirarki Pengendalian</label>
                            <div class="checkbox-grid">
                                @php $h = $document->kolom10_pengendalian['hierarchy'] ?? []; @endphp
                                <div class="checkbox-card"><input type="checkbox" name="hirarki[]" value="Eliminasi" {{ in_array('Eliminasi', $h) ? 'checked' : '' }}> Eliminasi</div>
                                <div class="checkbox-card"><input type="checkbox" name="hirarki[]" value="Substitusi" {{ in_array('Substitusi', $h) ? 'checked' : '' }}> Substitusi</div>
                                <div class="checkbox-card"><input type="checkbox" name="hirarki[]"
                                        value="Rekayasa Teknik" {{ in_array('Rekayasa Teknik', $h) ? 'checked' : '' }}>
                                    Rekayasa Teknik</div>
                                <div class="checkbox-card"><input type="checkbox" name="hirarki[]" value="Administratif"
                                        {{ in_array('Administratif', $h) ? 'checked' : '' }}> Administratif</div>
                                <div class="checkbox-card"><input type="checkbox" name="hirarki[]" value="APD" {{ in_array('APD', $h) ? 'checked' : '' }}> APD</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pengendalian Existing</label>
                            <textarea class="form-control"
                                name="kolom11_existing">{{ $document->kolom11_existing }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Card 8: Tindak Lanjut -->
                <div class="doc-card">
                    <div class="card-header-slim"><i class="fas fa-history"></i>
                        <h2>Tindak Lanjut & Residual (Kolom 18-22)</h2>
                    </div>
                    <div class="doc-body">
                        <div class="form-group"><label>Rencana Tindak Lanjut (Col 19)</label><textarea
                                class="form-control"
                                name="kolom18_tindak_lanjut">{{ $document->kolom18_tindak_lanjut }}</textarea></div>

                        <div style="display:flex; gap:24px; margin-top:20px;">
                            <div style="flex:1;">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label>Kemungkinan Residual</label>
                                        <select class="form-control" id="kolom20_kemungkinan"
                                            name="residual_kemungkinan" onchange="calculateResidualRisk()">
                                            @foreach([1, 2, 3, 4, 5] as $v) <option value="{{$v}}"
                                                {{$document->residual_kemungkinan == $v ? 'selected' : ''}}>{{$v}}
                                            </option> @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Konsekuensi Residual</label>
                                        <select class="form-control" id="kolom21_konsekuensi"
                                            name="residual_konsekuensi" onchange="calculateResidualRisk()">
                                            @foreach([1, 2, 3, 4, 5] as $v) <option value="{{$v}}"
                                                {{$document->residual_konsekuensi == $v ? 'selected' : ''}}>{{$v}}
                                            </option> @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Dapat Ditoleransi?</label>
                                    <div style="display: flex; gap: 20px;">
                                        <label><input type="radio" name="kolom18_toleransi" value="Ya" {{ ($document->kolom18_toleransi ?? 'Ya') == 'Ya' ? 'checked' : '' }}>
                                            Ya</label>
                                        <label><input type="radio" name="kolom18_toleransi" value="Tidak" {{ ($document->kolom18_toleransi ?? '') == 'Tidak' ? 'checked' : '' }}>
                                            Tidak</label>
                                    </div>
                                </div>
                            </div>
                            <div style="width:200px;">
                                <div class="risk-result-box">
                                    <div class="risk-score" id="display_resid_score">
                                        {{ $document->residual_score ?? '-' }}</div>
                                    <span class="risk-level" id="display_resid_level">PENDING</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </main>

        <!-- Footer -->
        <div class="review-footer">
            <div class="notes-area">
                <label>Catatan Review (Wajib untuk Approve & Revisi)</label>
                <textarea class="notes-input" id="notes"
                    placeholder="Berikan catatan, masukan, atau alasan revisi..."></textarea>
            </div>
            <div class="action-btns">
                @if($document->canBeApprovedBy(Auth::user()))
                    <button type="button" class="btn btn-revise" onclick="confirmAction('revise')">
                        <i class="fas fa-undo"></i> Minta Revisi
                    </button>
                    <button type="button" class="btn btn-approve" onclick="confirmAction('approve')">
                        <i class="fas fa-check"></i> Simpan & Setujui
                    </button>
                @else
                    <div style="padding:10px 20px; background:#e2e8f0; color:#64748b; border-radius:8px; font-weight:600;">
                        <i class="fas fa-lock"></i> Read Only
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        const routeApprove = "{{ route('approver.approve', $document->id) }}";
        const routeRevise = "{{ route('approver.revise', $document->id) }}";

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
                document.getElementById('display_risk_score').innerText = sc;
                const badge = document.getElementById('display_risk_level');
                badge.innerText = r.l; badge.style.backgroundColor = r.c;
            }
        }

        function calculateResidualRisk() {
            const L = parseInt(document.getElementById('kolom20_kemungkinan').value) || 0;
            const S = parseInt(document.getElementById('kolom21_konsekuensi').value) || 0;
            if (L && S) {
                const sc = L * S; const r = getLevel(sc);
                document.getElementById('display_resid_score').innerText = sc;
                const badge = document.getElementById('display_resid_level');
                badge.innerText = r.l; badge.style.backgroundColor = r.c;
            }
        }

        function confirmAction(type) {
            const notes = document.getElementById('notes').value.trim();
            if (notes.length < 5) {
                Swal.fire({ icon: 'warning', title: 'Catatan Wajib', text: 'Minimal 5 karakter.' });
                return;
            }

            Swal.fire({
                title: type === 'approve' ? 'Setujui Dokumen?' : 'Minta Revisi?',
                text: type === 'approve' ? 'Perubahan pada form akan disimpan.' : 'Dokumen akan dikembalikan ke submitter.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                confirmButtonColor: type === 'approve' ? '#16a34a' : '#dc2626'
            }).then((res) => {
                if (res.isConfirmed) {
                    document.getElementById('catatan_input_form').value = notes;
                    document.getElementById('reviewForm').action = type === 'approve' ? routeApprove : routeRevise;
                    document.getElementById('reviewForm').submit();
                }
            });
        }

        // Init calculations
        calculateRisk();
        calculateResidualRisk();

        // Flash Messages
        @if(session('success')) Swal.fire({ icon: 'success', title: 'Berhasil', text: "{{ session('success') }}", timer: 2000 }); @endif
        @if($errors->any()) Swal.fire({ icon: 'error', title: 'Error', html: `<ul>@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>` }); @endif
    </script>
</body>

</html>