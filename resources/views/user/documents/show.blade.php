<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Dokumen - HIRADC System</title>
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

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-back {
            padding: 8px 12px;
            background: white;
            color: #666;
            border: 1px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-back:hover {
            background: #f5f5f5;
        }

        .header h1 {
            font-size: 20px;
            font-weight: 700;
            color: #333;
        }

        .content-area {
            padding: 30px 40px;
            max-width: 1200px;
        }

        /* Document Header */
        .doc-header-section {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .doc-title-main {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .doc-number-main {
            font-size: 14px;
            color: #999;
            font-family: 'Courier New', monospace;
            margin-bottom: 20px;
        }

        .doc-meta-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px 0;
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
            font-size: 14px;
            color: #333;
            font-weight: 600;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            display: inline-block;
        }

        .status-revision {
            background: #ffebee;
            color: #c62828;
        }

        /* Document Content */
        .doc-content-section {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #c41e3a;
        }

        .info-grid {
            display: grid;
            gap: 20px;
        }

        .info-row {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 15px;
        }

        .info-label {
            font-size: 13px;
            font-weight: 600;
            color: #666;
        }

        .info-value {
            font-size: 14px;
            color: #333;
        }

        /* Risk Matrix Display */
        .risk-matrix-display {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .risk-result-display {
            padding: 15px 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 16px;
            font-weight: 700;
            margin-top: 15px;
        }

        .risk-extreme {
            background: #f44336;
            color: white;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 40px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e0e0e0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-dot {
            position: absolute;
            left: -32px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #c41e3a;
            border: 3px solid white;
            box-shadow: 0 0 0 2px #c41e3a;
        }

        .timeline-content {
            background: #f9f9f9;
            padding: 15px 20px;
            border-radius: 8px;
            border-left: 3px solid #c41e3a;
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .timeline-title {
            font-size: 14px;
            font-weight: 700;
            color: #333;
        }

        .timeline-date {
            font-size: 12px;
            color: #999;
        }

        .timeline-message {
            font-size: 13px;
            color: #666;
            line-height: 1.6;
        }

        .timeline-author {
            font-size: 12px;
            color: #999;
            margin-top: 8px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: #c41e3a;
            color: white;
        }

        .btn-primary:hover {
            background: #a01729;
        }

        .btn-secondary {
            background: white;
            color: #666;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background: #f5f5f5;
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
                <a href="{{ route('documents.index') }}" class="nav-item">
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
                    <div class="user-avatar">{{ substr(Auth::user()->nama_user, 0, 2) }}</div>
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->nama_user }}</div>
                        <div class="user-role">{{ Auth::user()->role_jabatan_name ?? ucfirst(str_replace('_', ' ', Auth::user()->role_user)) }}</div>
                        <div class="user-role" style="font-weight: normal; opacity: 0.8;">{{ Auth::user()->unit->nama_unit ?? '' }}</div>
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
                <div class="header-left">
                    <a href="{{ route('documents.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1>Detail Dokumen Risiko</h1>
                </div>
            </div>

            <div class="content-area">
                <!-- Document Header -->
                <div class="doc-header-section">
                    <div class="doc-title-main">{{ $document->kolom2_kegiatan ?? 'Dokumen Tanpa Judul' }}</div>
                    <div class="doc-number-main">ID: {{ $document->id_document ?? '-' }}</div>

                    <div class="doc-meta-grid">
                        <div class="meta-item">
                            <div class="meta-label">Status</div>
                            <div class="meta-value">
                                <span
                                    class="badge-status {{ $document->status == 'revision' ? 'status-revision' : '' }}">{{ $document->status_label }}</span>
                            </div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-label">Kategori</div>
                            <div class="meta-value">{{ $document->kategori }}</div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-label">Unit Kerja</div>
                            <div class="meta-value">{{ $document->unit->nama_unit ?? '-' }}</div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-label">Tanggal Dibuat</div>
                            <div class="meta-value">{{ $document->created_at->format('d M Y') }}</div>
                        </div>
                    </div>

                    <div class="action-buttons">
                        @if($document->status == 'revision' || $document->status == 'draft')
                            <a href="{{ route('documents.create', ['mode' => 'edit', 'id' => $document->id_document]) }}"
                                class="btn btn-primary">
                                <i class="fas fa-edit"></i> Perbaiki / Edit
                            </a>
                        @endif
                        <button class="btn btn-secondary" onclick="window.print()">
                            <i class="fas fa-print"></i> Cetak
                        </button>
                    </div>
                </div>

                <!-- Document Content -->
                <div class="doc-content-section">
                    <h2 class="section-title">Informasi Dokumen</h2>
                    <div class="info-grid">
                        <div class="info-row">
                            <div class="info-label">Proses Bisnis/Kegiatan</div>
                            <div class="info-value">{{ $document->kolom2_proses }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Lokasi/Area Kerja</div>
                            <div class="info-value">{{ $document->kolom3_lokasi }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Kondisi</div>
                            <div class="info-value">{{ $document->kolom5_kondisi }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Bahaya Identifikasi</div>
                            <div class="info-value">
                                @php 
                                    $bahaya = is_string($document->kolom6_bahaya) ? json_decode($document->kolom6_bahaya, true) : $document->kolom6_bahaya;
                                @endphp
                            @if($bahaya)
                                <div><strong>Type:</strong> {{ $bahaya['type'] ?? '-' }}</div>
                                    <div><strong>Kategori:</strong> {{ $bahaya['kategori'] ?? '-' }}</div>
                                <div><strong>Manual:</strong> {{ $bahaya['manual'] ?? '-' }}</div>
                            @else
                                    -
                                @endif
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Dampak</div>
                            <div class="info-value">{{ $document->kolom7_dampak }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Risiko Awal</div>
                            <div class="info-value">{{ $document->kolom9_risiko }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Kondisi</div>
                            <div class="info-value">Rutin - Operasional normal</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Deskripsi Bahaya</div>
                            <div class="info-value">Limbah cair dari proses produksi mengandung bahan kimia berbahaya
                                yang dapat mencemari lingkungan jika tidak ditangani dengan benar. Potensi kebocoran
                                pada sistem pembuangan dapat menyebabkan kontaminasi tanah dan air tanah.</div>
                        </div>
                    </div>
                </div>

                <!-- Risk Assessment -->
                <div class="doc-content-section">
                    <h2 class="section-title">Penilaian Risiko</h2>
                    <div class="risk-matrix-display">
                        <div class="info-grid">
                            <div class="info-row">
                                <div class="info-label">Likelihood (Kemungkinan)</div>
                                <div class="info-value">4 - Sering</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Severity (Keparahan)</div>
                                <div class="info-value">4 - Tinggi</div>
                            </div>
                        </div>
                        <div class="risk-result-display risk-extreme">
                            RISIKO TINGGI (Skor: 16)
                        </div>
                    </div>
                </div>

                <!-- Control Measures -->
                <div class="doc-content-section">
                    <h2 class="section-title">Pengendalian Risiko</h2>
                    <div class="info-grid">
                        @php
                            $controls = is_string($document->kolom10_pengendalian) ? json_decode($document->kolom10_pengendalian, true) : $document->kolom10_pengendalian;
                        @endphp
                        
                        @if($controls)
                            <div class="info-row">
                                <div class="info-label">Hirarki Pengendalian</div>
                                <div class="info-value">{{ $controls['hirarki'] ?? '-' }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Tindakan Pengendalian</div>
                                <div class="info-value">{{ $controls['tindakan'] ?? '-' }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Penanggung Jawab</div>
                                <div class="info-value">{{ $controls['pic'] ?? '-' }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Target Penyelesaian</div>
                                <div class="info-value">{{ $controls['deadline'] ?? '-' }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Status Implementasi</div>
                                <div class="info-value">{{ $controls['status'] ?? '-' }}</div>
                            </div>
                        @else
                           <div class="info-row"><div class="info-value">- Belum ada data pengendalian -</div></div>
                        @endif
                    </div>
                </div>

                <!-- Revision History -->
                <div class="doc-content-section">
                    <h2 class="section-title">Riwayat Revisi & Komentar</h2>
                    <div class="timeline">
                        @forelse($document->approvals->sortByDesc('created_at') as $approval)
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-header">
                                    <div class="timeline-title">
                                        @if($approval->action == 'approved')
                                            Disetujui
                                        @elseif($approval->action == 'revised')
                                            Permintaan Revisi
                                        @elseif($approval->action == 'rejected')
                                            Ditolak
                                        @else
                                            {{ ucfirst($approval->action) }}
                                        @endif
                                    </div>
                                    <div class="timeline-date">{{ $approval->created_at->format('d M Y, H:i') }}</div>
                                </div>
                                <div class="timeline-message">
                                    {{ $approval->catatan ?? '-' }}
                                </div>
                                <div class="timeline-author">
                                    <i class="fas fa-user"></i> {{ $approval->approver->nama_user ?? 'Unknown' }}
                                    ({{ $approval->approver->role_jabatan_name ?? ($approval->approver->role_user ?? '-') }})
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="timeline-item">
                            <div class="timeline-dot" style="background: #ccc; border-color: #fff;"></div>
                            <div class="timeline-content">
                                <div class="timeline-message">Belum ada riwayat approval/revisi.</div>
                            </div>
                        </div>
                        @endforelse

                        <!-- Submission Log -->
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-header">
                                    <div class="timeline-title">Dokumen Dibuat</div>
                                    <div class="timeline-date">{{ $document->created_at->format('d M Y, H:i') }}</div>
                                </div>
                                <div class="timeline-message">
                                    Dokumen risiko dibuat dan disubmit.
                                </div>
                                <div class="timeline-author">
                                    <i class="fas fa-user"></i> {{ $document->user->nama_user ?? 'Unknown' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>