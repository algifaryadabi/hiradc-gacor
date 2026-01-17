<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen (Kepala Departemen) - HIRADC System</title>
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
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 32px 48px;
            max-width: 1400px;
            margin-right: auto;
        }

        .header-action {
            margin-bottom: 32px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-sub);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            margin-bottom: 12px;
        }

        .back-link:hover {
            color: var(--primary);
        }

        .passport-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: white;
            padding: 24px 32px;
            border-radius: 16px;
            margin-bottom: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .pp-content {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
        }

        .pp-profile {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .pp-avatar {
            width: 52px;
            height: 52px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .pp-info h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .pp-info p {
            margin: 2px 0 0;
            opacity: 0.7;
            font-size: 13px;
            font-weight: 500;
        }

        .pp-meta-grid {
            display: flex;
            gap: 40px;
            border-left: 1px solid rgba(255, 255, 255, 0.15);
            padding-left: 40px;
        }

        .pp-stat-block {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .pp-stat-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.5;
            font-weight: 700;
        }

        .pp-stat-val {
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-badge-lg {
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.4);
            color: #34d399;
        }

        .status-badge-lg.pending {
            background: rgba(245, 158, 11, 0.2);
            border-color: rgba(245, 158, 11, 0.4);
            color: #fbbf24;
        }

        .status-badge-lg.revision {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.4);
            color: #f87171;
        }

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

        .hiradc-wrapper {
            overflow-x: auto;
            background: white;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            border-radius: 8px;
            margin-bottom: 40px;
        }

        .excel-table {
            width: max-content;
            min-width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 13px;
        }

        .excel-table th {
            background: #1e293b;
            color: #ffffff;
            padding: 12px;
            border-bottom: 1px solid #334155;
            border-right: 1px solid #334155;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
        }

        .excel-table td {
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px;
            vertical-align: top;
            color: #334155;
        }

        .section-border-right {
            border-right: 3px solid #94a3b8 !important;
        }

        .risk-badge {
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: 700;
            color: white;
        }

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

        .notes-input {
            width: 100%;
            height: 80px;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
            resize: none;
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
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            height: 50px;
            color: white;
        }

        .btn-approve {
            background: #16a34a;
        }

        .btn-approve:hover {
            background: #15803d;
        }

        .btn-revise {
            background: #dc2626;
        }

        .btn-revise:hover {
            background: #b91c1c;
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
                <div class="logo-subtext">HIRADC System (Dept Head)</div>
            </div>
            <nav class="nav-menu"><a href="{{ route('kepala_departemen.dashboard') }}" class="nav-item"><i
                        class="fas fa-th-large"></i><span>Dashboard</span></a><a
                    href="{{ route('kepala_departemen.check_documents') }}" class="nav-item active"><i
                        class="fas fa-file-signature"></i><span>Cek Dokumen</span></a></nav>
            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ optional(Auth::user())->nama_user ? strtoupper(substr(Auth::user()->nama_user, 0, 2)) : 'U' }}
                    </div>
                    <div class="user-details">
                        <div class="user-name">{{ optional(Auth::user())->nama_user ?? 'User' }}</div>
                        <div class="user-role">{{ optional(Auth::user())->role_jabatan_name }}</div>
                        <div class="user-role" style="opacity:0.8">{{ optional(Auth::user())->unit_or_dept_name }}</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="fas fa-sign-out-alt"></i>Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
        </aside>

        <main class="main-content">
            <div class="header-action"><a href="{{ route('kepala_departemen.check_documents') }}" class="back-link"><i
                        class="fas fa-arrow-left"></i>Kembali</a>
                <h1 style="font-size: 20px; font-weight: 700; margin: 0;">Review Dokumen Final</h1>
            </div>

            <!-- Passport Card (Safe) -->
            <div class="passport-card">
                <div class="pp-content">
                    <div class="pp-profile">
                        <div class="pp-avatar">
                            {{ optional($document->user)->nama_user ? strtoupper(substr($document->user->nama_user, 0, 2)) : 'NA' }}
                        </div>
                        <div class="pp-info">
                            <h3>{{ optional($document->user)->nama_user ?? 'Unknown User' }}</h3>
                            <p>{{ optional($document->unit)->nama_unit ?? 'Unit Tidak Diketahui' }}</p>
                        </div>
                    </div>
                    <div class="pp-meta-grid">
                        <div class="pp-stat-block">
                            <div class="pp-stat-label">Waktu Submit</div>
                            <div class="pp-stat-val"><i class="far fa-clock"></i>
                                {{ $document->created_at->format('d M Y, H:i') }} WIB</div>
                        </div>
                        <div class="pp-stat-block">
                            <div class="pp-stat-label">Departemen</div>
                            <div class="pp-stat-val"><i class="far fa-building"></i>
                                {{ optional(optional($document->user)->departemen)->nama_dept ?? '-' }}</div>
                        </div>
                        <div class="pp-stat-block">
                            <div class="pp-stat-label">Status Terkini</div>
                            <div class="pp-stat-val"><span
                                    class="status-badge-lg {{ $document->status == 'revision' ? 'revision' : ($document->status == 'approved' ? '' : 'pending') }}">{{ $document->status == 'revision' ? 'REVISI' : ($document->status == 'approved' ? 'DISETUJUI' : 'PENDING') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Title -->
            <div class="doc-card">
                <div class="doc-header">
                    <div>
                        <div class="doc-title-label">Judul Dokumen</div>
                        <div class="doc-title-value">{{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</div>
                    </div>
                </div>
            </div>

            <form id="reviewForm" method="POST" action="">
                @csrf
                <input type="hidden" name="compliance_checklist" id="compliance_checklist_input">
                <input type="hidden" name="catatan" id="catatan_input_form">

                <div class="hiradc-wrapper">
                    <table class="excel-table">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width: 50px;">No</th>
                                <th colspan="4" class="section-border-right">Kegiatan & Situasi</th>
                                <th colspan="3" class="section-border-right">Identifikasi Bahaya & Risiko</th>
                                <th colspan="2" class="section-border-right">Pengendalian Risiko</th>
                                <th colspan="3" class="section-border-right">Penilaian Risiko Awal</th>
                                <th rowspan="2" style="width: 250px;">Peraturan / Regulasi</th>
                                <th rowspan="2" style="width: 100px;" class="section-border-right">Penting / TP</th>
                                <th colspan="5">Penilaian Risiko Sisa & Tindak Lanjut</th>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Kegiatan</th>
                                <th style="width: 100px;">Kategori</th>
                                <th style="width: 150px;">Lokasi</th>
                                <th style="width: 100px;" class="section-border-right">Kondisi</th>
                                <th style="width: 250px;">Potensi Bahaya</th>
                                <th style="width: 220px;">Dampak / Konsekuensi</th>
                                <th style="width: 220px;" class="section-border-right">Risiko & Peluang</th>
                                <th style="width: 300px;">Hirarki Pengendalian</th>
                                <th style="width: 250px;" class="section-border-right">Pengendalian Existing</th>
                                <th style="width: 60px;">L</th>
                                <th style="width: 60px;">S</th>
                                <th style="width: 80px;" class="section-border-right">Level</th>
                                <th style="width: 200px;">Tindak Lanjut</th>
                                <th style="width: 60px;">L</th>
                                <th style="width: 60px;">L</th>
                                <th style="width: 60px;">S</th>
                                <th style="width: 80px;">Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($document->details as $index => $item)
                                @php 
                                    // DEFENSIVE CODING: Ensure arrays are valid
                                    $bahaya = is_array($item->kolom6_bahaya) ? $item->kolom6_bahaya : [];
                                    $pengendalian = is_array($item->kolom10_pengendalian) ? $item->kolom10_pengendalian : [];
                                    $bahayaList = $bahaya['details'] ?? [];
                                    $hierarchyList = $pengendalian['hierarchy'] ?? [];
                                    if (!is_array($bahayaList)) $bahayaList = [];
                                    if (!is_array($hierarchyList)) $hierarchyList = [];
                                @endphp
                                <tr>
                                    <td style="text-align:center;">{{ $index + 1 }}</td>
                                    <td>{{ $item->kolom2_kegiatan }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->kolom3_lokasi }}</td>
                                    <td class="section-border-right">{{ $item->kolom5_kondisi }}</td>
                                    <td>
                                        <strong>Type:</strong> {{ $bahaya['type'] ?? '-' }}<br>
                                        <strong>Detail:</strong><br>
                                        @foreach($bahayaList as $d) - {{ $d }}<br> @endforeach
                                    </td>
                                    <td>{{ $item->kolom7_dampak }}</td>
                                    <td class="section-border-right">
                                        <strong>Risiko (-):</strong> {{ $item->kolom17_risiko ?? '-' }}<br>
                                        <strong>Peluang (+):</strong> {{ $item->kolom17_peluang ?? '-' }}
                                    </td>
                                    <td>
                                        @foreach($hierarchyList as $h) <span class="badge" style="background:#f1f5f9; color:#475569; padding:2px 6px; border-radius:4px; margin-bottom:2px; display:inline-block;">{{ $h }}</span> @endforeach
                                    </td>
                                    <td class="section-border-right">{{ $item->kolom11_existing }}</td>
                                    
                                    <!-- Awal -->
                                    <td>{{ $item->kolom12_kemungkinan }}</td>
                                    <td>{{ $item->kolom13_konsekuensi }}</td>
                                    <td class="section-border-right">
                                        <span class="risk-badge" style="background: {{ ($item->kolom14_score >= 15) ? '#ef4444' : (($item->kolom14_score >= 8) ? '#f59e0b' : '#10b981') }}">
                                            {{ ($item->kolom14_score >= 15) ? 'HIGH' : (($item->kolom14_score >= 8) ? 'MED' : 'LOW') }} ({{ $item->kolom14_score }})
                                        </span>
                                    </td>
                                    
                                    <td>{{ $item->kolom15_regulasi }}</td>
                                    <td class="section-border-right">{{ $item->kolom16_aspek }}</td>
                                    
                                    <!-- Residual -->
                                    <td>{{ $item->kolom18_tindak_lanjut }}</td>
                                    <td>{{ $item->residual_kemungkinan }}</td>
                                    <td>{{ $item->residual_konsekuensi }}</td>
                                    <td>
                                        <span class="risk-badge" style="background: {{ ($item->residual_score >= 15) ? '#ef4444' : (($item->residual_score >= 8) ? '#f59e0b' : '#10b981') }}">
                                            {{ ($item->residual_score >= 15) ? 'HIGH' : (($item->residual_score >= 8) ? 'MED' : 'LOW') }} ({{ $item->residual_score }})
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Action Footer -->
                @if($document->status == 'pending_level3')
                    <div class="review-footer">
                        <div class="notes-area">
                            <label><i class="fas fa-edit"></i> Catatan Persetujuan / Revisi</label>
                            <input type="text" name="catatan" id="catatan_input_ui" class="notes-input"
                                placeholder="Tulis catatan (wajib)...">
                        </div>
                        <div class="action-btns">
                            <button type="button" class="btn btn-revise" onclick="confirmAction('revise')"><i
                                    class="fas fa-undo"></i> Minta Revisi</button>
                            <button type="button" class="btn btn-approve" onclick="confirmAction('approve')"><i
                                    class="fas fa-check"></i> Publikasikan</button>
                        </div>
                    </div>
                @else
                    <div class="review-footer" style="justify-content: center;">
                        <button class="btn" style="background:#e2e8f0; color:#64748b; cursor:default;"><i
                                class="fas fa-lock"></i> Mode Read-Only ({{ $document->status }})</button>
                    </div>
                @endif
            </form>

            <!-- History Log -->
            <div class="history-section" style="margin-top:40px; border-top:1px solid #e2e8f0; padding-top:20px;">
                <h3 style="font-size:16px; font-weight:700; color:#1e293b; margin-bottom:15px;">Riwayat Persetujuan</h3>
                <table class="excel-table" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Oleh</th>
                            <th>Aksi</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($document->approvals as $log)
                            <tr>
                                <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                                <td>{{ optional($log->approver)->nama_user ?? 'System' }}
                                    ({{ optional($log->approver)->role_jabatan_name ?? '-' }})</td>
                                <td>{{ ucfirst($log->action) }}</td>
                                <td>{{ $log->catatan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        function confirmAction(type) {
            const form = document.getElementById('reviewForm');
            const noteUI = document.getElementById('catatan_input_ui');
            const noteHidden = document.getElementById('catatan_input_form');
            const notes = noteUI.value;
            if (!notes || notes.trim().length < 5) {
                Swal.fire({ icon: 'warning', title: 'Catatan Wajib Diisi', text: 'Mohon tuliskan catatan (min 5 karakter).' }); return;
            }
            let actionUrl = type === 'approve' ? "{{ route('kepala_departemen.approve', $document->id) }}" : "{{ route('kepala_departemen.revise', $document->id) }}";
            let msg = type === 'approve' ? 'Dokumen akan dipublikasikan.' : 'Dokumen akan dikembalikan untuk revisi.';

            Swal.fire({
                title: 'Konfirmasi', text: msg, icon: 'question', showCancelButton: true, confirmButtonText: 'Ya, Lanjutkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    noteHidden.value = notes;
                    form.action = actionUrl;
                    form.submit();
                }
            });
        }
    </script>
</body>

</html>