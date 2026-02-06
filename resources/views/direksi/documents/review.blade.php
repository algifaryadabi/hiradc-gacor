<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen Direktur | HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Reuse styles from Kepala Departemen for consistency */
        :root {
            --primary: #c41e3a; /* Semen Padang Red */
            --primary-dark: #9a1829;
            --primary-light: #e63950;
            --bg-body: #f1f5f9;
            --surface: #ffffff;
            --text-main: #0f172a;
            --text-sub: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; outline: none; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-body); color: var(--text-main); padding-bottom: 120px; }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: #5b6fd8;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }
        .logo-section { padding: 2rem 1.5rem; border-bottom: 1px solid rgba(255, 255, 255, 0.15); text-align: center; }
        .logo-circle { width: 90px; height: 90px; margin: 0 auto 1.25rem; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .logo-circle img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .logo-text { font-size: 1.125rem; font-weight: 700; color: white; margin-bottom: 0.25rem; }
        .logo-subtext { font-size: 0.75rem; color: rgba(255, 255, 255, 0.9); font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; }
        .nav-menu { flex: 1; padding: 1.5rem 0; overflow-y: auto; }
        .nav-item { padding: 1rem 1.5rem; margin: 0.25rem 1rem; display: flex; align-items: center; gap: 0.75rem; color: rgba(255, 255, 255, 0.85); text-decoration: none; border-radius: 0.75rem; transition: all 0.2s; font-weight: 500; font-size: 0.9375rem; }
        .nav-item:hover, .nav-item.active { background: rgba(255, 255, 255, 0.25); color: white; font-weight: 600; }
        .nav-item i { width: 20px; text-align: center; font-size: 1.125rem; }
        .user-info-bottom { padding: 1.5rem; border-top: 1px solid rgba(255, 255, 255, 0.15); }
        .user-profile { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; }
        .user-avatar { width: 48px; height: 48px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #5b6fd8; font-weight: 700; font-size: 1.125rem; }
        .user-details { flex: 1; min-width: 0; }
        .user-name { font-weight: 600; font-size: 0.9375rem; color: white; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-role { font-size: 0.75rem; color: rgba(255, 255, 255, 0.85); font-weight: 500; }
        .logout-btn { width: 100%; padding: 0.75rem 1rem; background: rgba(255, 255, 255, 0.15); color: white; border: 1px solid rgba(255, 255, 255, 0.25); border-radius: 0.75rem; font-size: 0.875rem; font-weight: 600; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 0.5rem; text-decoration: none; }
        .logout-btn:hover { background: rgba(255, 255, 255, 0.25); }

        /* Main Content */
        .main-content { margin-left: 280px; padding: 32px 48px; min-height: 100vh; }
        .back-nav { margin-bottom: 32px; }
        .back-link { display: inline-flex; align-items: center; gap: 10px; color: var(--text-sub); font-size: 14px; font-weight: 600; text-decoration: none; padding: 8px 16px; background: white; border-radius: 100px; border: 1px solid var(--border); transition: all 0.2s; }
        .back-link:hover { color: var(--text-main); border-color: var(--text-sub); transform: translateX(-4px); }

        /* Doc Card */
        .doc-card { background: white; border-radius: 16px; border: 1px solid var(--border); box-shadow: var(--shadow-sm); overflow: hidden; margin-bottom: 30px; }
        .doc-header { padding: 20px 24px; background: #f8fafc; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 12px; }
        .doc-body { padding: 24px; }
        .doc-title-block { background: white; border-radius: 16px 16px 0 0; border: 1px solid var(--border); border-bottom: none; padding: 20px 28px; display: flex; align-items: center; justify-content: space-between; }
        .doc-label { font-size: 12px; font-weight: 600; color: var(--text-sub); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; }
        .doc-main-title { font-size: 18px; font-weight: 800; color: var(--text-main); line-height: 1.4; }

        /* Tables */
        .table-wrapper { background: white; border: 1px solid var(--border); border-top: none; border-radius: 0 0 20px 20px; overflow-x: auto; }
        .excel-table { width: 100%; border-collapse: collapse; font-size: 11px; }
        .excel-table th { background: #0f172a; color: white; padding: 10px; border: 1px solid #334155; text-align: center; font-weight: 700; text-transform: uppercase; }
        .excel-table td { padding: 10px; border: 1px solid var(--border); color: var(--text-main); vertical-align: top; }
        
        .hiradc-table { width: 100%; border-collapse: separate; font-size: 14px; min-width: 2200px; }
        .hiradc-table th { background: #1e293b; color: white; padding: 12px 14px; text-align: left; position: sticky; top: 0; z-index: 10; border-right: 1px solid #334155; border-bottom: 1px solid #334155; white-space: nowrap; }
        .hiradc-table td { padding: 14px; border-bottom: 1px solid var(--border); border-right: 1px solid var(--border); }

        /* Action Bar */
        .action-bar { position: fixed; bottom: 0; left: 280px; right: 0; background: linear-gradient(to top, #ffffff 0%, #fefefe 100%); padding: 20px 48px; border-top: 1px solid var(--border); box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08); display: flex; align-items: center; gap: 20px; z-index: 100; backdrop-filter: blur(10px); }
        .note-input { flex: 1; padding: 12px 16px; border: 1.5px solid var(--border); border-radius: 12px; font-size: 14px; font-family: inherit; resize: vertical; min-height: 60px; }
        .btn-action { padding: 12px 24px; border-radius: 12px; font-size: 14px; font-weight: 600; cursor: pointer; border: none; color: white; display: inline-flex; align-items: center; gap: 8px; }
        .btn-approve { background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); }
        .btn-reject { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
        
        /* Helpers */
        .info-table { width: 100%; border-collapse: collapse; font-size: 14px; }
        .info-table td { padding: 8px 12px; vertical-align: top; border-bottom: 1px solid #f1f5f9; }
        .info-label { font-weight: 600; color: #475569; width: 180px; }

        /* Passport Card (Simplified) */
        .passport-card { background: white; border-radius: 16px; padding: 20px 28px; border: 1px solid var(--border); margin-bottom: 28px; display: flex; align-items: center; justify-content: space-between; }
        .pp-profile { display: flex; gap: 16px; align-items: center; }
        .pp-avatar { width: 56px; height: 56px; background: #e0e7ff; color: #3730a3; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 20px; }
        .pp-status { padding: 8px 20px; border-radius: 100px; font-size: 13px; font-weight: 700; text-transform: uppercase; background: #fffbeb; color: #d97706; border: 1px solid #f59e0b; }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo-section">
            <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
            <div class="logo-text">PT Semen Padang</div>
            <div class="logo-subtext">HIRADC System</div>
        </div>
        <nav class="nav-menu">
            <a href="{{ route('direksi.dashboard') }}" class="nav-item">
                <i class="fas fa-th-large"></i><span>Dashboard</span>
            </a>
            <a href="#" class="nav-item active">
                <i class="fas fa-file-signature"></i><span>Review Dokumen</span>
            </a>
        </nav>
        <div class="user-info-bottom">
            <div class="user-profile">
                <div class="user-avatar">{{ substr(Auth::user()->nama_user ?? Auth::user()->username, 0, 2) }}</div>
                <div class="user-details">
                    <div class="user-name">{{ Auth::user()->nama_user }}</div>
                    <div class="user-role">{{ Auth::user()->role_jabatan_name ?? 'Direksi' }}</div>
                    <div class="user-role" style="font-weight: normal; opacity: 0.8;">{{ Auth::user()->unit_or_dept_name }}</div>
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
        <div class="back-nav">
            <a href="{{ route('direksi.dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Document Info Card -->
        <div class="passport-card">
            <div class="pp-profile">
                <div class="pp-avatar">
                    {{ optional($document->user)->nama_user ? strtoupper(substr($document->user->nama_user, 0, 2)) : 'U' }}
                </div>
                <div>
                    <h2 style="font-size:18px; font-weight:700;">{{ optional($document->user)->nama_user ?? 'Unknown User' }}</h2>
                    <p style="font-size:13px; color:var(--text-sub);">{{ optional($document->unit)->nama_unit }}</p>
                </div>
            </div>
            <div class="pp-status">
                Menunggu Approval Direksi
            </div>
        </div>

        <!-- Review Form Wrapper -->
        <form id="reviewForm" method="POST" action="">
            @csrf
            
            <!-- HIRADC Document Title -->
            <div class="doc-title-block">
                <div>
                    <div class="doc-label">Judul Dokumen HIRADC</div>
                    <div class="doc-main-title">{{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</div>
                </div>
                <div>
                    <span class="doc-label" style="background:var(--primary); color:white; padding:4px 10px; border-radius:20px;">HIRADC + PMK</span>
                </div>
            </div>

            <!-- HIRADC Table (Simplified View for Context) -->
            <div class="table-wrapper">
                <table class="hiradc-table">
                   <thead>
                        <tr>
                            <th style="width: 40px;">No</th>
                            <th>Aktivitas (Kol 2)</th>
                            <th>Bahaya (Kol 6)</th>
                            <th>Risiko (Kol 9)</th>
                            <th>Risiko Awal (Kol 14)</th>
                            <th>Pengendalian Lanjut (Kol 19)</th>
                            <th>Risiko Sisa (Kol 22)</th>
                        </tr>
                   </thead>
                   <tbody>
                       @foreach($document->details as $index => $item)
                       <tr>
                           <td style="text-align:center;">{{ $index + 1 }}</td>
                           <td>{{ $item->kolom2_kegiatan }}</td>
                           <td>
                               @php $bahayaDetails = $item->kolom6_bahaya['details'] ?? []; @endphp
                               {{ implode(', ', $bahayaDetails) }}
                           </td>
                           <td>{{ $item->kolom9_risiko }}</td>
                           <td style="text-align:center; font-weight:bold;">{{ $item->kolom14_score }}</td>
                           <td>{{ $item->kolom19_pengendalian_lanjut }}</td>
                           <td style="text-align:center; font-weight:bold;">{{ $item->kolom22_tingkat_risiko_lanjut }}</td>
                       </tr>
                       @endforeach
                   </tbody>
                </table>
            </div>

            <!-- PMK Section -->
            @php $pmk = $document->pmkProgram; @endphp
            @if($pmk)
            <div class="doc-card" style="margin-top: 32px; border-left: 5px solid #c026d3;">
                <div class="doc-header">
                    <i class="fas fa-project-diagram" style="color: #c026d3; font-size: 20px;"></i>
                    <h2 style="margin:0; font-size:18px; color:#1e293b;">Review Program Manajemen Korporat (PMK)</h2>
                </div>
                
                <div class="doc-body">
                    <div style="background: #faf5ff; padding: 16px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #e9d5ff;">
                        <table class="info-table">
                            <tr><td class="info-label">Judul Program</td><td class="info-value">: {{ $pmk->judul }}</td></tr>
                            <tr><td class="info-label">Tujuan</td><td class="info-value">: {{ $pmk->tujuan }}</td></tr>
                            <tr><td class="info-label">Sasaran</td><td class="info-value">: {{ $pmk->sasaran }}</td></tr>
                            <tr><td class="info-label">Penanggung Jawab</td><td class="info-value">: {{ $pmk->penanggung_jawab }}</td></tr>
                        </table>
                    </div>

                    @if($pmk->program_kerja && is_array($pmk->program_kerja))
                    <h4 style="font-size:15px; font-weight:700; color:#0f172a; margin-bottom: 12px;">Detail Program Kerja:</h4>
                    <div class="table-wrapper" style="border-radius: 8px;">
                        <table class="excel-table">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Uraian Kegiatan</th>
                                    <th rowspan="2">PIC</th>
                                    <th colspan="12">Target (%)</th>
                                    <th rowspan="2">Anggaran</th>
                                </tr>
                                <tr>
                                    @for($m=1; $m<=12; $m++) <th>{{ $m }}</th> @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pmk->program_kerja as $idx => $prog)
                                <tr>
                                    <td style="text-align:center;">{{ $idx + 1 }}</td>
                                    <td>{{ $prog['uraian'] ?? '-' }}</td>
                                    <td>{{ $prog['pic'] ?? '-' }}</td>
                                    @for($m=0; $m<12; $m++)
                                        <td style="text-align:center;">{{ $prog['target'][$m] ?? '-' }}</td>
                                    @endfor
                                    <td>{{ isset($prog['anggaran']) ? 'Rp ' . number_format($prog['anggaran'], 0, ',', '.') : '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Action Bar -->
            <div class="action-bar">
                <div class="note-input-wrapper" style="flex:1;">
                    <label style="font-size:12px; font-weight:600; color:var(--text-sub); display:block; margin-bottom:4px;">CATATAN APPROVAL:</label>
                    <textarea name="catatan" class="note-input" placeholder="Tambahkan catatan untuk approval atau revisi..."></textarea>
                </div>
                <div style="display:flex; gap:12px;">
                    <button type="button" class="btn-action btn-reject" onclick="submitDecision('reject')">
                        <i class="fas fa-times"></i> Tolak / Revisi
                    </button>
                    <button type="button" class="btn-action btn-approve" onclick="submitDecision('approve')">
                        <i class="fas fa-check"></i> Publishkan PMK
                    </button>
                </div>
            </div>
        </form>
    </main>

    <script>
        function submitDecision(action) {
            const form = document.getElementById('reviewForm');
            const note = document.querySelector('textarea[name="catatan"]').value;

            if (action === 'reject' && !note.trim()) {
                Swal.fire('Error', 'Harap isi catatan jika menolak dokumen.', 'error');
                return;
            }

            let title = action === 'approve' ? 'Publish Dokumen?' : 'Tolak Dokumen?';
            let text = action === 'approve' 
                ? 'Dokumen akan dipublikasikan ke seluruh user.' 
                : 'Dokumen akan dikembalikan ke Unit Kerja untuk revisi.';
            let confirmBtn = action === 'approve' ? 'Ya, Publish' : 'Ya, Tolak';
            let confirmColor = action === 'approve' ? '#16a34a' : '#ef4444';

            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: confirmColor,
                cancelButtonColor: '#3085d6',
                confirmButtonText: confirmBtn
            }).then((result) => {
                if (result.isConfirmed) {
                    // Set action URL dynamically
                    if (action === 'approve') {
                        form.action = "{{ route('direksi.approve', $document->id) }}";
                    } else {
                        form.action = "{{ route('direksi.revise', $document->id) }}";
                    }
                    form.submit();
                }
            });
        }
    </script>
</body>
</html>