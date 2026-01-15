<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Dokumen - HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #c41e3a;
            --primary-light: #fff1f2;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --gray-light: #f1f5f9;
            --sidebar-width: 260px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #334155;
        }

        .container { display: flex; min-height: 100vh; }

        /* Sidebar (Same as Index) */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid #e2e8f0;
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 10;
        }

        .logo-section { padding: 24px; text-align: center; border-bottom: 1px solid #f1f5f9; }
        .logo-circle {
            width: 64px; height: 64px; background: white; border-radius: 50%;
            margin: 0 auto 12px; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .logo-circle img { max-width: 70%; }
        .logo-text { font-size: 16px; font-weight: 700; color: var(--primary-color); }
        .logo-subtext { font-size: 11px; color: #64748b; }

        .nav-menu { flex: 1; padding: 20px 12px; overflow-y: auto; }
        .nav-item {
            display: flex; align-items: center; gap: 12px; padding: 12px 16px;
            margin-bottom: 4px; border-radius: 8px; color: #64748b;
            text-decoration: none; font-size: 14px; font-weight: 500; transition: all 0.2s;
        }
        .nav-item:hover { background-color: #fff1f2; color: var(--primary-color); }
        .user-info-bottom {
            padding: 20px; border-top: 2px solid #e0e0e0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .user-profile { display: flex; align-items: center; gap: 12px; margin-bottom: 15px; }
        .user-avatar {
            width: 45px; height: 45px; background: white; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #667eea; font-weight: 700; font-size: 16px; flex-shrink: 0;
        }
        .user-details { flex: 1; min-width: 0; }
        .user-name { font-weight: 600; font-size: 14px; color: white; }
        .user-role { font-size: 11px; color: rgba(255, 255, 255, 0.8); }
        .logout-btn {
            width: 100%; padding: 10px 15px; background: rgba(255, 255, 255, 0.2);
            color: white; border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 6px;
            font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s;
            display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none;
        }
        .logout-btn:hover { background: rgba(255, 255, 255, 0.3); }

        /* Main Content */
        .main-content {
            flex: 1; margin-left: var(--sidebar-width); padding: 32px 48px;
        }

        .btn-back { display: inline-flex; align-items: center; gap: 8px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 500; margin-bottom: 24px; transition: color 0.2s; }
        .btn-back:hover { color: var(--primary-color); }

        /* Process Wizard */
        .wizard-container {
            background: white; border-radius: 12px; padding: 30px; border: 1px solid #e2e8f0; margin-bottom: 24px;
        }
        .wizard-steps { display: flex; justify-content: space-between; position: relative; }
        .wizard-steps::before {
            content: ''; position: absolute; top: 15px; left: 0; right: 0; height: 2px; background: #e2e8f0; z-index: 1;
        }
        .step-item { position: relative; z-index: 2; text-align: center; flex: 1; }
        .step-circle {
            width: 32px; height: 32px; background: white; border: 2px solid #cbd5e1;
            border-radius: 50%; margin: 0 auto 10px; display: flex; align-items: center;
            justify-content: center; color: #cbd5e1; font-weight: 600; transition: all 0.3s;
        }
        .step-label { font-size: 12px; color: #64748b; font-weight: 500; }
        
        /* Active/Complete State */
        .step-item.active .step-circle { border-color: var(--primary-color); background: var(--primary-light); color: var(--primary-color); }
        .step-item.active .step-label { color: var(--primary-color); font-weight: 700; }
        .step-item.completed .step-circle { background: var(--primary-color); border-color: var(--primary-color); color: white; }
        .step-item.completed .step-label { color: var(--primary-color); }

        /* Content Layout */
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }
        
        .card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 24px; margin-bottom: 24px; }
        .card-header { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; }
        .card-title { font-size: 16px; font-weight: 700; color: #1e293b; }
        
        .info-list { display: flex; flex-direction: column; gap: 16px; }
        .info-item { display: flex; flex-direction: column; gap: 4px; }
        .info-label { font-size: 12px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .info-value { font-size: 14px; color: #334155; line-height: 1.5; }

        .risk-matrix-box {
            background: #f8fafc; border-radius: 8px; padding: 20px; text-align: center; border: 1px solid #e2e8f0;
        }
        .risk-score { font-size: 32px; font-weight: 800; color: #1e293b; margin: 10px 0; }
        .risk-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }
        .risk-high { background: #fee2e2; color: #b91c1c; }
        .risk-medium { background: #ffedd5; color: #c2410c; }
        .risk-low { background: #dcfce7; color: #15803d; }

        .timeline-item { position: relative; padding-left: 24px; margin-bottom: 20px; border-left: 2px solid #e2e8f0; }
        .timeline-item:last-child { margin-bottom: 0; }
        .timeline-dot { position: absolute; left: -6px; top: 0; width: 10px; height: 10px; border-radius: 50%; background: #94a3b8; }
        .timeline-active .timeline-dot { background: var(--primary-color); border: 2px solid white; box-shadow: 0 0 0 2px var(--primary-color); width: 12px; height: 12px; left: -7px;}
        .timeline-date { font-size: 11px; color: #94a3b8; margin-bottom: 4px; }
        .timeline-title { font-size: 14px; font-weight: 600; color: #1e293b; }
        .timeline-desc { font-size: 13px; color: #64748b; margin-top: 4px; background: #f8fafc; padding: 8px; border-radius: 6px;}

        .action-bar {
            display: flex; gap: 12px; margin-bottom: 24px;
        }
        .btn { padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; }
        .btn-primary { background: var(--primary-color); color: white; }
        .btn-primary:hover { background: var(--primary-hover); }
        .btn-outline { background: white; border: 1px solid #cbd5e1; color: #475569; }
        .btn-outline:hover { background: #f8fafc; }
    </style>
</head>

<body>
    <!-- Alerts -->
    @include('partials.alerts')

    <div class="container">
        <!-- Sidebar -->
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('user.dashboard') }}" class="nav-item"><i class="fas fa-th-large"></i><span>Dashboard</span></a>
                <a href="{{ route('documents.index') }}" class="nav-item active"><i class="fas fa-folder-open"></i><span>Dokumen Saya</span></a>
                <a href="{{ route('documents.create') }}" class="nav-item"><i class="fas fa-plus-circle"></i><span>Buat Dokumen Baru</span></a>
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
                <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <a href="{{ route('documents.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Dokumen Saya</a>

            <div class="header-section" style="margin-bottom: 24px;">
                <h1 style="font-size: 24px; font-weight: 700; color: #1e293b;">{{ $document->kolom2_kegiatan }}</h1>
                <p style="color: #64748b; font-size: 14px;">#{{ $document->id }} • {{ $document->created_at->format('d M Y, H:i') }}</p>
            </div>

            <!-- Process Wizard -->
            <div class="wizard-container">
                <div class="wizard-steps">
                    <!-- Step 1: Draft/Unit -->
                    <div class="step-item {{ $document->current_level >= 1 ? 'completed' : 'active' }}">
                        <div class="step-circle"><i class="fas fa-file-signature"></i></div>
                        <div class="step-label">Draft & Submit</div>
                    </div>
                    <!-- Step 2: Kepala Unit -->
                    <div class="step-item {{ $document->current_level > 1 ? 'completed' : ($document->current_level == 1 ? 'active' : '') }}">
                        <div class="step-circle">1</div>
                        <div class="step-label">Kepala Unit</div>
                    </div>
                    <!-- Step 3: Unit Pengelola -->
                    <div class="step-item {{ $document->current_level > 2 ? 'completed' : ($document->current_level == 2 ? 'active' : '') }}">
                        <div class="step-circle">2</div>
                        <div class="step-label">Unit Pengelola</div>
                    </div>
                    <!-- Step 4: Kepala Dept -->
                    <div class="step-item {{ $document->status == 'approved' ? 'completed' : ($document->current_level == 3 ? 'active' : '') }}">
                        <div class="step-circle">3</div>
                        <div class="step-label">Kepala Dept.</div>
                    </div>
                    <!-- Step 5: Selesai -->
                    <div class="step-item {{ $document->status == 'approved' ? 'completed active' : '' }}">
                        <div class="step-circle"><i class="fas fa-check"></i></div>
                        <div class="step-label">Selesai</div>
                    </div>
                </div>
                @if($document->status == 'revision')
                    <div style="background: #fff7ed; color: #c2410c; padding: 12px; border-radius: 8px; margin-top: 20px; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Status Revisi: </strong> Dokumen ini dikembalikan untuk perbaikan. Silakan cek komentar di bawah.
                    </div>
                @endif
            </div>

            <div class="action-bar">
                @if($document->status == 'revision' || $document->status == 'draft')
                    <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Dokumen
                    </a>
                @endif
                <button onclick="window.print()" class="btn btn-outline">
                    <i class="fas fa-print"></i> Cetak / PDF
                </button>
            </div>

            <div class="content-grid">
                <!-- Left Column: Details -->
                <div class="detail-column">
                    <!-- Basic Info -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-info-circle" style="color: var(--primary-color);"></i>
                            <h2 class="card-title">Informasi Dasar</h2>
                        </div>
                        <div class="info-list">
                            <div class="info-item">
                                <span class="info-label">Unit Kerja</span>
                                <span class="info-value">{{ $document->unit->nama_unit ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Proses / Kegiatan</span>
                                <span class="info-value">{{ $document->kolom2_proses }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Lokasi</span>
                                <span class="info-value">{{ $document->kolom3_lokasi }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Hazards & Risks -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-exclamation-triangle" style="color: #f59e0b;"></i>
                            <h2 class="card-title">Identifikasi Bahaya</h2>
                        </div>
                        <div class="info-list">
                            <div class="info-item">
                                <span class="info-label">Bahaya</span>
                                <div class="info-value">
                                    <ul style="padding-left: 20px; margin: 0;">
                                        @php
                                            $bahaya = $document->kolom6_bahaya;
                                            if(!is_array($bahaya)) $bahaya = [$bahaya];
                                        @endphp
                                        @foreach($bahaya as $key => $val)
                                            @if(is_array($val) && !empty($val))
                                                <li><strong>{{ ucfirst($key) }}:</strong> {{ implode(', ', $val) }}</li>
                                            @elseif(is_string($val) && !empty($val) && !in_array($key, ['type', 'kategori']))
                                                <li>{{ $val }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Dampak / Risiko Awal</span>
                                <span class="info-value">{{ $document->kolom7_dampak }} / {{ $document->kolom9_risiko }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-shield-alt" style="color: #10b981;"></i>
                            <h2 class="card-title">Pengendalian Risiko</h2>
                        </div>
                        <div class="info-list">
                            <div class="info-item">
                                <span class="info-label">Hirarki Pengendalian</span>
                                <span class="info-value">
                                    @php
                                        $ctrl = $document->kolom10_pengendalian;
                                        if(is_array($ctrl) && isset($ctrl['hierarchy'])) {
                                            echo implode(', ', $ctrl['hierarchy']);
                                        } else {
                                            echo is_string($ctrl) ? $ctrl : '-';
                                        }
                                    @endphp
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Pengendalian Existing</span>
                                <span class="info-value">{{ $document->kolom11_existing }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Scores & History -->
                <div class="side-column">
                    <!-- Risk Matrix -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-bar"></i>
                            <h2 class="card-title">Penilaian Risiko</h2>
                        </div>
                        <div class="risk-matrix-box">
                            <div style="font-size: 12px; color: #64748b; margin-bottom: 4px;">SKOR RISIKO AWAL</div>
                            <div class="risk-score">{{ $document->kolom14_score }}</div>
                            @php
                                $score = $document->kolom14_score;
                                $badgeClass = 'risk-low'; $label = 'RENDAH';
                                if($score >= 15) { $badgeClass = 'risk-high'; $label = 'TINGGI (EXTREME)'; }
                                elseif($score >= 6) { $badgeClass = 'risk-medium'; $label = 'SEDANG'; }
                            @endphp
                            <span class="risk-badge {{ $badgeClass }}">{{ $label }}</span>
                            
                            <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 16px 0;">

                            <div style="font-size: 12px; color: #64748b; margin-bottom: 4px;">SKOR RESIDUAL</div>
                            <div class="risk-score" style="font-size: 24px;">{{ $document->residual_score ?? '-' }}</div>
                        </div>
                    </div>

                    <!-- Appoval History -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-history"></i>
                            <h2 class="card-title">Riwayat Approval</h2>
                        </div>
                        <div class="timeline">
                            @forelse($document->approvals->sortByDesc('created_at') as $log)
                            <div class="timeline-item timeline-active">
                                <div class="timeline-dot"></div>
                                <div class="timeline-date">{{ $log->created_at->format('d M Y, H:i') }}</div>
                                <div class="timeline-title">
                                    @if($log->action == 'approved') <span style="color: #15803d;">Disetujui</span>
                                    @elseif($log->action == 'revised') <span style="color: #b91c1c;">Revisi diminta</span>
                                    @else {{ ucfirst($log->action) }} @endif
                                    oleh {{ $log->approver->nama_user ?? 'System' }}
                                </div>
                                @if($log->catatan)
                                <div class="timeline-desc">
                                    "{{ $log->catatan }}"
                                </div>
                                @endif
                            </div>
                            @empty
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-title">Belum ada aktivitas approval.</div>
                            </div>
                            @endforelse
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-date">{{ $document->created_at->format('d M Y, H:i') }}</div>
                                <div class="timeline-title">Dokumen Dibuat</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>
</html>