<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dokumen Revisi - HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root { --primary: #c41e3a; --bg-body: #f1f5f9; --text-main: #1e293b; --text-sub: #64748b; --border: #e2e8f0; }
        * { margin:0; padding:0; box-sizing:border-box; outline:none; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-body); color: var(--text-main); padding-bottom: 50px; }
        .container { display:flex; min-height:100vh; }
        
        /* Sidebar (Same as Create) */
        .sidebar { width:260px; background:white; border-right:1px solid var(--border); position:fixed; height:100vh; display:flex; flex-direction:column; z-index:50; }
        .logo-section { padding:24px; border-bottom:1px solid var(--border); text-align:center; }
        .logo-circle { width:64px; height:64px; background:white; border-radius:50%; margin:0 auto 12px; display:flex; align-items:center; justify-content:center; box-shadow:0 1px 3px rgba(0,0,0,0.1); border:1px solid var(--border); }
        .logo-circle img { max-width:65%; }
        .logo-text { font-size:16px; font-weight:800; color:var(--primary); }
        .logo-subtext { font-size:11px; color:var(--text-sub); margin-top:2px; }
        .nav-menu { flex:1; padding:24px 16px; overflow-y:auto; }
        .nav-item { padding:12px 16px; display:flex; align-items:center; gap:12px; cursor:pointer; color:var(--text-sub); font-size:14px; font-weight:500; text-decoration:none; border-radius:8px; margin-bottom:4px; }
        .nav-item:hover, .nav-item.active { background:#fff1f2; color:var(--primary); }
        .nav-item.active { font-weight:600; }
        .nav-item i { width:20px; text-align:center; font-size:16px; }
        .user-info-bottom { padding:20px; border-top:2px solid #e0e0e0; background:linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .user-profile { display:flex; align-items:center; gap:12px; margin-bottom:15px; }
        .user-avatar { width:40px; height:40px; background:white; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#667eea; font-weight:700; font-size:14px; flex-shrink:0; }
        .user-details { flex:1; min-width:0; }
        .user-name { font-weight:600; font-size:13px; color:white; }
        .user-role { font-size:11px; color:rgba(255,255,255,0.85); }
        .logout-btn { width:100%; padding:8px; background:rgba(255,255,255,0.2); color:white; border:1px solid rgba(255,255,255,0.3); border-radius:6px; font-size:12px; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; text-decoration:none; }
        .logout-btn:hover { background:rgba(255,255,255,0.3); }

        /* Content */
        .main-content { flex:1; margin-left:260px; padding:32px 48px; max-width:1400px; margin:0 auto; margin-left:260px; }
        .header { display:flex; align-items:center; gap:20px; margin-bottom:32px; }
        .btn-back { padding:8px 16px; border-radius:6px; background:white; border:1px solid var(--border); color:var(--text-main); font-weight:600; font-size:13px; text-decoration:none; display:flex; align-items:center; gap:8px; }
        .btn-back:hover { background:var(--bg-body); }
        .header h1 { font-size:24px; font-weight:800; color:var(--text-main); }

        .doc-card { background:white; border-radius:16px; border:1px solid var(--border); box-shadow:0 1px 2px rgba(0,0,0,0.05); overflow:hidden; margin-bottom:24px; }
        .card-header { padding:20px 24px; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:16px; background:#f8fafc; }
        .header-icon { width:40px; height:40px; background:var(--primary); color:white; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:18px; }
        .header-title h2 { font-size:16px; font-weight:700; color:var(--text-main); }
        .header-title p { font-size:12px; color:var(--text-sub); }
        .card-body { padding:24px; }

        .form-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
        .form-group { margin-bottom:15px; }
        .form-label { display:block; font-size:13px; font-weight:600; color:var(--text-main); margin-bottom:6px; }
        .required { color:var(--primary); }
        .form-control { width:100%; padding:10px 14px; border:1px solid var(--border); border-radius:8px; font-size:14px; transition:all 0.2s; }
        .form-control:focus { outline:none; border-color:var(--primary); box-shadow:0 0 0 3px rgba(196,30,58,0.1); }
        textarea.form-control { min-height:100px; resize:vertical; }

        /* Risk Badge */
        .risk-result-box { background:#1f2937; color:white; padding:16px; border-radius:12px; text-align:center; }
        .risk-score { font-size:32px; font-weight:800; line-height:1; }
        .risk-level { display:inline-block; padding:4px 12px; border-radius:20px; background:rgba(255,255,255,0.2); font-size:11px; font-weight:700; margin-top:4px; }

        /* Action Bar */
        .action-bar { border-top:1px solid var(--border); padding:20px 24px; background:#f8fafc; display:flex; justify-content:flex-end; gap:12px; }
        .btn { padding:12px 24px; border-radius:8px; font-weight:600; font-size:14px; cursor:pointer; border:none; display:inline-flex; align-items:center; gap:8px; transition:transform 0.1s; }
        .btn:active { transform:scale(0.98); }
        .btn-primary { background:var(--primary); color:white; }
        .btn-secondary { background:white; border:1px solid var(--border); color:var(--text-sub); }

        /* Checkboxes */
        .checkbox-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(250px, 1fr)); gap:10px; }
        .checkbox-card { border:1px solid var(--border); border-radius:6px; padding:10px; display:flex; align-items:center; gap:10px; font-size:13px; }
        .hidden { display:none; }
    </style>
</head>
<body>
    <div class="container">
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
            </nav>
            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_user, 0, 2)) }}</div>
                    <div class="user-details"><div class="user-name">{{ Auth::user()->nama_user }}</div><div class="user-role">{{ Auth::user()->role_jabatan_name }}</div></div>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                <form id="logout-form" style="display:none;" action="{{ route('logout') }}" method="POST">@csrf</form>
            </div>
        </aside>

        <main class="main-content">
            <div class="header">
                <a href="{{ route('documents.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
                <h1>Edit Dokumen Revisi</h1>
            </div>

            @if(count($document->approvals) > 0)
            <div style="background:#fff7ed; border:1px solid #fed7aa; padding:15px; border-radius:8px; margin-bottom:24px; color:#9a3412;">
                <strong><i class="fas fa-undo"></i> Catatan Revisi Terakhir:</strong><br>
                {{ $document->approvals->sortByDesc('created_at')->first()->catatan }}
            </div>
            @endif

            <form action="{{ route('documents.update', $document->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Card 1: Info -->
                <div class="doc-card">
                    <div class="card-header"><div class="header-icon"><i class="fas fa-info-circle"></i></div><div class="header-title"><h2>Informasi Dasar</h2><p>Kolom 2 - 5</p></div></div>
                    <div class="card-body">
                        <div class="form-grid-2">
                             <div class="form-group"><label class="form-label">Proses Bisnis</label><input type="text" class="form-control" name="kolom2_proses" value="{{ $document->kolom2_proses }}" required></div>
                             <div class="form-group"><label class="form-label">Kegiatan</label><input type="text" class="form-control" name="kolom2_kegiatan" value="{{ $document->kolom2_kegiatan }}" required></div>
                             <div class="form-group"><label class="form-label">Lokasi</label><input type="text" class="form-control" name="kolom3_lokasi" value="{{ $document->kolom3_lokasi }}" required></div>
                             <div class="form-group">
                                 <label class="form-label">Kategori</label>
                                 <select class="form-control" name="kategori" readonly style="background:#f1f5f9; cursor:not-allowed;">
                                     <option value="{{ $document->kategori }}" selected>{{ $document->kategori }}</option>
                                 </select>
                             </div>
                             <div class="form-group"><label class="form-label">Kondisi</label><input type="text" class="form-control" name="kolom5_kondisi" value="{{ $document->kolom5_kondisi }}" required></div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Bahaya -->
                <div class="doc-card">
                    <div class="card-header"><div class="header-icon"><i class="fas fa-exclamation-triangle"></i></div><div class="header-title"><h2>Bahaya (Kolom 6)</h2></div></div>
                     <div class="card-body">
                        <!-- Reuse simiplified logic for manual input, as full dynamic JS is complex to re-init with data without a lot of JS -->
                        <div class="form-group">
                             <label class="form-label">Type Bahaya</label>
                             <input type="text" class="form-control" name="bahaya_type" value="{{ $document->kolom6_bahaya['type'] ?? '' }}" readonly style="background:#f1f5f9;">
                        </div>
                        <div class="form-group">
                             <label class="form-label">Rincian Bahaya (Text/Existing)</label>
                             @php 
                                $b = $document->kolom6_bahaya; 
                                $details = array_merge($b['details']??[], $b['aspects']??[], $b['threats']??[]);
                             @endphp
                             @foreach($details as $d) <input type="hidden" name="bahaya_detail[]" value="{{$d}}"> @endforeach
                             <div style="padding:10px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:6px;">
                                 {{ implode(', ', $details) }}
                             </div>
                        </div>
                         <div class="form-group"><label class="form-label">Bahaya Manual</label><input type="text" class="form-control" name="bahaya_manual" value="{{ $b['manual'] ?? '' }}"></div>
                     </div>
                </div>

                <!-- Card 3: Risiko -->
                <div class="doc-card">
                     <div class="card-header"><div class="header-icon"><i class="fas fa-search-dollar"></i></div><div class="header-title"><h2>Risiko (Kolom 7 & 9)</h2></div></div>
                     <div class="card-body">
                         <div class="form-grid-2">
                             <div class="form-group"><label class="form-label">Dampak</label><textarea class="form-control" name="kolom7_dampak" required>{{ $document->kolom7_dampak }}</textarea></div>
                             <div class="form-group"><label class="form-label">Identifikasi Risiko</label><textarea class="form-control" name="kolom9_risiko" required>{{ $document->kolom9_risiko }}</textarea></div>
                         </div>
                     </div>
                </div>

                <!-- Card 4: Penilaian Awal -->
                 <div class="doc-card">
                     <div class="card-header"><div class="header-icon"><i class="fas fa-calculator"></i></div><div class="header-title"><h2>Penilaian Awal (Kolom 12-14)</h2></div></div>
                     <div class="card-body">
                        <div style="display:flex; gap:30px;">
                            <div style="flex:1;">
                                <div class="form-group"><label class="form-label">Kemungkinan</label><select class="form-control" id="k12" name="kolom12_kemungkinan" onchange="calcRisk()"><option value="{{$document->kolom12_kemungkinan}}" selected>{{$document->kolom12_kemungkinan}}</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>
                                <div class="form-group"><label class="form-label">Konsekuensi</label><select class="form-control" id="k13" name="kolom13_konsekuensi" onchange="calcRisk()"><option value="{{$document->kolom13_konsekuensi}}" selected>{{$document->kolom13_konsekuensi}}</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>
                            </div>
                            <div style="width:200px;">
                                <div class="risk-result-box"><div class="risk-score" id="score">-</div><span class="risk-level" id="level">PENDING</span></div>
                            </div>
                        </div>
                     </div>
                 </div>

                 <!-- Card 5: Pengendalian & Residual -->
                 <div class="doc-card">
                     <div class="card-header"><div class="header-icon"><i class="fas fa-shield-alt"></i></div><div class="header-title"><h2>Pengendalian & Residual</h2></div></div>
                     <div class="card-body">
                         <div class="form-group">
                             <label class="form-label">Hirarki Pengendalian</label>
                             <div class="checkbox-grid">
                                 @php $h = $document->kolom10_pengendalian['hierarchy'] ?? []; @endphp
                                 @foreach(['Eliminasi','Substitusi','Rekayasa Teknik','Administratif','APD'] as $opt)
                                    <div class="checkbox-card"><input type="checkbox" name="hirarki[]" value="{{$opt}}" {{in_array($opt, $h)?'checked':''}}> {{$opt}}</div>
                                 @endforeach
                             </div>
                         </div>
                         <div class="form-group"><label class="form-label">Pengendalian Existing</label><textarea class="form-control" name="kolom11_existing">{{$document->kolom11_existing}}</textarea></div>
                         <div class="form-group"><label class="form-label">Regulasi</label><textarea class="form-control" name="kolom15_regulasi">{{$document->kolom15_regulasi}}</textarea></div>
                         <div class="form-group"><label class="form-label">Tindak Lanjut</label><textarea class="form-control" name="kolom18_tindak_lanjut">{{$document->kolom18_tindak_lanjut}}</textarea></div>
                         
                         <div style="display:flex; gap:30px; margin-top:20px;">
                            <div style="flex:1;">
                                <div class="form-group"><label class="form-label">Kemungkinan Residual</label><select class="form-control" id="r_k" name="residual_kemungkinan" onchange="calcResid()"><option value="{{$document->residual_kemungkinan}}" selected>{{$document->residual_kemungkinan}}</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>
                                <div class="form-group"><label class="form-label">Konsekuensi Residual</label><select class="form-control" id="r_c" name="residual_konsekuensi" onchange="calcResid()"><option value="{{$document->residual_konsekuensi}}" selected>{{$document->residual_konsekuensi}}</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>
                            </div>
                             <div style="width:200px;">
                                <div class="risk-result-box"><div class="risk-score" id="r_score">-</div><span class="risk-level" id="r_level">PENDING</span></div>
                            </div>
                         </div>
                     </div>
                 </div>

                 <div class="action-bar">
                     <a href="{{ route('documents.index') }}" class="btn btn-secondary">Batal</a>
                     <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Simpan Revisi</button>
                 </div>
            </form>
        </main>
    </div>

    <script>
        function getLevel(s) {
            if (s <= 3) return { l: 'RENDAH', c: '#10b981' };
            if (s <= 9) return { l: 'SEDANG', c: '#f59e0b' };
            if (s <= 16) return { l: 'TINGGI', c: '#f97316' };
            return { l: 'EXTREME', c: '#ef4444' };
        }
        function calcRisk() {
            const L = parseInt(document.getElementById('k12').value)||0; const S = parseInt(document.getElementById('k13').value)||0;
            if(L&&S){ const sc=L*S; const r=getLevel(sc); document.getElementById('score').innerText=sc; const b=document.getElementById('level'); b.innerText=r.l; b.style.backgroundColor=r.c; }
        }
        function calcResid() {
            const L = parseInt(document.getElementById('r_k').value)||0; const S = parseInt(document.getElementById('r_c').value)||0;
            if(L&&S){ const sc=L*S; const r=getLevel(sc); document.getElementById('r_score').innerText=sc; const b=document.getElementById('r_level'); b.innerText=r.l; b.style.backgroundColor=r.c; }
        }
        calcRisk(); calcResid();
    </script>
</body>
</html>
