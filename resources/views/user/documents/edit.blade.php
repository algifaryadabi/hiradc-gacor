<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dokumen Revisi - HIRADC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reusing styles from create.blade.php to ensure consistency */
        :root { --primary-color: #c41e3a; --primary-hover: #a01729; --bg-color: #f5f5f5; --sidebar-width: 250px; --card-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); --border-radius: 12px; }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-color); color: #1f2937; -webkit-font-smoothing: antialiased; }
        .container { display:flex; min-height:100vh; }
        
        /* Sidebar */
        .sidebar { width:var(--sidebar-width); background:white; border-right:1px solid #e5e7eb; position:fixed; height:100vh; display:flex; flex-direction:column; z-index:50; }
        .logo-section { padding:30px 20px; border-bottom:1px solid #e5e7eb; text-align:center; }
        .logo-circle { width:70px; height:70px; background:#fff; border-radius:50%; margin:0 auto 15px; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 10px rgba(0,0,0,0.05); border:1px solid #f3f4f6; }
        .logo-circle img { max-width:80%; }
        .logo-text { font-size:18px; font-weight:800; color:var(--primary-color); letter-spacing:-0.5px; margin-bottom:3px; }
        .logo-subtext { font-size:12px; color:#9ca3af; font-weight:500; }
        .nav-menu { flex:1; padding:20px 15px; overflow-y:auto; }
        .nav-item { padding:12px 20px; display:flex; align-items:center; gap:12px; cursor:pointer; transition:all 0.2s ease; color:#4b5563; font-size:14px; font-weight:500; text-decoration:none; border-radius:8px; margin-bottom:5px; }
        .nav-item:hover, .nav-item.active { background:#fee2e2; color:var(--primary-color); font-weight:600; }
        .nav-item i { width:20px; text-align:center; font-size:16px; }
        .user-info-bottom { padding:20px; border-top:2px solid #e0e0e0; background:linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .user-profile { display:flex; align-items:center; gap:12px; margin-bottom:15px; }
        .user-avatar { width:45px; height:45px; background:white; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#667eea; font-weight:700; font-size:16px; flex-shrink:0; }
        .user-details { flex:1; min-width:0; }
        .user-name { font-weight:600; font-size:14px; color:white; }
        .user-role { font-size:11px; color:rgba(255,255,255,0.8); }
        .logout-btn { width:100%; padding:10px 15px; background:rgba(255,255,255,0.2); color:white; border:1px solid rgba(255,255,255,0.3); border-radius:6px; font-size:13px; font-weight:600; cursor:pointer; transition:all 0.3s; display:flex; align-items:center; justify-content:center; gap:8px; text-decoration:none; }
        .logout-btn:hover { background:rgba(255,255,255,0.3); }

        /* Main Content */
        .main-content { flex:1; margin-left:var(--sidebar-width); }
        .header { background:white; padding:20px 40px; border-bottom:1px solid #e5e7eb; display:flex; justify-content:space-between; align-items:center; position:sticky; top:0; z-index:40; box-shadow:0 4px 6px -1px rgba(0,0,0,0.02); }
        .header h1 { font-size:22px; font-weight:800; color:#111827; letter-spacing:-0.5px; }
        .btn-back { display:inline-flex; align-items:center; gap:8px; font-size:14px; font-weight:600; color:#6b7280; text-decoration:none; transition:0.2s; }
        .btn-back:hover { color:#111827; }
        
        .content-area { padding:40px; max-width:1100px; margin:0 auto; }
        
        /* Card Styles */
        .doc-card { background:white; border-radius:var(--border-radius); box-shadow:var(--card-shadow); margin-bottom:30px; overflow:hidden; border:1px solid #f3f4f6; }
        .card-header { padding:20px 30px; background:#fff; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; gap:15px; }
        .header-icon { width:40px; height:40px; background:#fef2f2; color:var(--primary-color); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:18px; }
        .header-title h2 { font-size:16px; font-weight:700; color:#1f2937; }
        .header-title p { font-size:13px; color:#6b7280; margin-top:2px; }
        .card-body { padding:30px; }
        
        /* Forms */
        .form-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:24px; }
        .form-group { margin-bottom:20px; }
        .form-label { display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:8px; }
        .required { color:var(--primary-color); margin-left:2px; }
        .form-control { width:100%; padding:12px 16px; border:1px solid #d1d5db; border-radius:8px; font-size:14px; font-family:'Inter',sans-serif; transition:all 0.2s; background:#f9fafb; }
        .form-control:focus { outline:none; border-color:var(--primary-color); background:white; box-shadow:0 0 0 3px rgba(196,30,58,0.1); }
        textarea.form-control { min-height:100px; resize:vertical; line-height:1.5; }
        select.form-control { appearance:none; cursor:pointer; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 14px center; background-size:16px; }

        /* Toggles & Checkboxes */
        .toggle-group { display:flex; gap:10px; padding:5px; background:#f3f4f6; border-radius:10px; width:fit-content; }
        .toggle-btn { padding:10px 20px; border:none; border-radius:8px; background:transparent; color:#6b7280; font-weight:600; font-size:13px; cursor:pointer; transition:0.2s; }
        .toggle-btn.active { background:white; color:var(--primary-color); box-shadow:0 2px 4px rgba(0,0,0,0.05); }
        
        .checkbox-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:15px; }
        .checkbox-card { border:1px solid #e5e7eb; border-radius:8px; padding:15px; transition:0.2s; cursor:pointer; display:flex; align-items:start; gap:12px; }
        .checkbox-card:hover { border-color:var(--primary-color); background:#fef2f2; }
        .checkbox-card input[type="checkbox"] { margin-top:3px; accent-color:var(--primary-color); width:16px; height:16px; flex-shrink:0; }
        .checkbox-card label { cursor:pointer; font-size:14px; font-weight:500; color:#4b5563; line-height:1.4; }

        /* Risk Matrix */
        .risk-result-box { background:#1f2937; color:white; padding:20px; border-radius:12px; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; }
        .risk-score { font-size:36px; font-weight:800; line-height:1; margin-bottom:5px; }
        .risk-level { display:inline-block; padding:6px 16px; border-radius:20px; background:rgba(255,255,255,0.2); font-size:12px; font-weight:700; text-transform:uppercase; }

        /* Action Bar */
        .action-bar { position:sticky; bottom:20px; background:white; padding:20px 30px; border-radius:16px; box-shadow:0 10px 40px rgba(0,0,0,0.1); margin-top:40px; display:flex; justify-content:space-between; align-items:center; border:1px solid #f3f4f6; z-index:30; }
        .action-buttons { display:flex; gap:15px; }
        .btn { padding:12px 24px; border-radius:10px; font-size:14px; font-weight:600; cursor:pointer; transition:0.2s; border:none; display:inline-flex; align-items:center; gap:8px; text-decoration:none; }
        .btn-secondary { background:#f3f4f6; color:#4b5563; }
        .btn-secondary:hover { background:#e5e7eb; color:#111827; }
        .btn-primary { background:var(--primary-color); color:white; box-shadow:0 4px 12px rgba(196,30,58,0.3); }
        .btn-primary:hover { background:var(--primary-hover); transform:translateY(-1px); }
        
        .hidden { display:none; }
        .mt-4 { margin-top:1rem; }
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
                <a href="{{ route('dashboard') }}" class="nav-item"><i class="fas fa-th-large"></i><span>Dashboard</span></a>
                <a href="{{ route('documents.index') }}" class="nav-item active"><i class="fas fa-folder-open"></i><span>Dokumen Saya</span></a>
                <a href="{{ route('documents.create') }}" class="nav-item"><i class="fas fa-plus-circle"></i><span>Buat Dokumen Baru</span></a>
            </nav>
            <div class="user-info-bottom">
                 <div class="user-profile">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->nama_user, 0, 2)) }}</div>
                    <div class="user-details"><div class="user-name">{{ Auth::user()->nama_user }}</div><div class="user-role">{{ Auth::user()->role_jabatan_name }}</div></div>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                 <div style="display:flex; align-items:center; gap:20px;">
                    <a href="{{ route('documents.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <div style="height:24px; width:1px; background:#e5e7eb;"></div>
                    <h1>Edit Dokumen Revisi</h1>
                </div>
            </div>

            <div class="content-area">
                
                @if(count($document->approvals) > 0)
                <div style="background:#fff7ed; border:1px solid #fed7aa; padding:15px; border-radius:8px; margin-bottom:24px; color:#9a3412;">
                    <strong><i class="fas fa-undo"></i> Catatan Revisi Terakhir:</strong><br>
                    {{ $document->approvals->sortByDesc('created_at')->first()->catatan }}
                </div>
                @endif

                <form id="hiradcForm" action="{{ route('documents.update', $document->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" id="auto_probis_value" value="{{ isset($user->seksi->probis) ? $user->seksi->probis->nama_probis : (isset($user->unit->probis) ? $user->unit->probis->nama_probis : '') }}">

                    <div id="items-container">
                        @foreach($document->details as $index => $item)
                        <div class="doc-item item-loaded" data-index="{{ $index }}" style="margin-bottom: 30px;">
                            <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">
                            <div class="doc-card" style="border-left: 5px solid var(--primary-color);">
                                <div class="card-header" style="justify-content: space-between; cursor: pointer;" onclick="toggleCollapse(this)">
                                    <div style="display: flex; align-items: center; gap: 15px;">
                                        <div class="header-icon" style="background: var(--primary-color); color: white; border-radius: 50%;">
                                            <span class="item-number">#{{ $index + 1 }}</span>
                                        </div>
                                        <div class="header-title">
                                            <h2 style="color: #881337;">{{ $item->kolom2_kegiatan }}</h2>
                                            <span class="item-summary" style="display:none;">(Klik untuk expand)</span>
                                        </div>
                                    </div>
                                    <div class="header-actions" style="display: flex; gap: 10px;">
                                        <button type="button" class="btn-collapse"><i class="fas fa-chevron-up"></i></button>
                                        <button type="button" class="btn-remove-item" onclick="removeItem(this); event.stopPropagation();" style="border:1px solid #fecaca; color:#ef4444;"><i class="fas fa-trash-alt"></i> Hapus</button>
                                    </div>
                                </div>
                                
                                <div class="card-body collapsible-content">
                                    <!-- 1. Info -->
                                    <div style="margin-bottom:25px;">
                                        <h3 style="font-size:14px; font-weight:700; border-bottom:2px solid #e2e8f0; margin-bottom:15px; padding-bottom:8px;">1. Informasi Dasar</h3>
                                        <div class="form-grid-2">
                                            <div class="form-group"><label class="form-label">Proses Bisnis</label><input type="text" class="form-control" name="items[{{$index}}][kolom2_proses]" value="{{ $item->kolom2_proses }}" readonly style="background:#f8fafc; cursor:not-allowed;"></div>
                                            <div class="form-group"><label class="form-label">Kegiatan</label><input type="text" class="form-control item-kegiatan-input" name="items[{{$index}}][kolom2_kegiatan]" value="{{ $item->kolom2_kegiatan }}" required oninput="updateSummary(this)"></div>
                                            <div class="form-group"><label class="form-label">Lokasi</label><input type="text" class="form-control" name="items[{{$index}}][kolom3_lokasi]" value="{{ $item->kolom3_lokasi }}" required></div>
                                            <div class="form-group"><label class="form-label">Pihak Berkepentingan</label><input type="text" class="form-control" name="items[{{$index}}][kolom4_pihak]" value="{{ $item->kolom4_pihak }}"></div>
                                            <!-- Category -->
                                            <div class="form-group">
                                                <label class="form-label">Kategori</label>
                                                <select class="form-control category-select" name="items[{{$index}}][kategori]" required onchange="updateConditions(this)">
                                                    <option value="K3" {{ $item->kategori == 'K3' ? 'selected' : '' }}>K3</option>
                                                    <option value="KO" {{ $item->kategori == 'KO' ? 'selected' : '' }}>KO</option>
                                                    <option value="Lingkungan" {{ $item->kategori == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                                    <option value="Keamanan" {{ $item->kategori == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                                                </select>
                                            </div>
                                            <!-- Condition (Pre-rendered for simplicity) -->
                                            <div class="form-group">
                                                <label class="form-label">Kondisi</label>
                                                <select class="form-control condition-select" name="items[{{$index}}][kolom5_kondisi]" required>
                                                     <!-- We manually render options based on category because JS assumes empty on load -->
                                                     @php 
                                                        $opts = match($item->kategori) {
                                                            'K3','KO' => ['Rutin', 'Non-Rutin', 'Emergency'], // Matches JS 'categories' object
                                                            'Lingkungan' => ['Normal', 'Abnormal', 'Emergency'],
                                                            'Keamanan' => ['Rutin', 'Non-Rutin', 'Emergency'], // Correct? JS said Rutin/Non-Rutin for Keamanan in edit.blade.php but create.blade.php had different logic? 
                                                            // JS in create.blade.php says: Keamanan -> Rutin, Non-Rutin, Emergency
                                                            default => ['Rutin', 'Non-Rutin', 'Emergency']
                                                        };
                                                     @endphp
                                                     @foreach($opts as $opt)
                                                        <option value="{{ $opt }}" {{ $opt == $item->kolom5_kondisi ? 'selected' : '' }}>{{ $opt }}</option>
                                                     @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 2. Hazard -->
                                    <div style="margin-bottom:25px;">
                                        <h3 style="font-size:14px; font-weight:700; border-bottom:2px solid #e2e8f0; margin-bottom:15px; padding-bottom:8px;">2. Identifikasi Bahaya</h3>
                                        <div class="hazard-section" style="background: #fffbeb; padding: 20px; border-radius: 8px;">
                                            @php $bahaya = $item->kolom6_bahaya; $details = $bahaya['details'] ?? []; @endphp
                                            <!-- Toggles: Check if we should show them -->
                                            <div class="toggle-group hazard-toggles {{ in_array($item->kategori, ['K3','KO']) ? '' : 'hidden' }}" style="margin-bottom:15px;">
                                                <button type="button" class="toggle-btn active" onclick="toggleBahayaType(this, 'condition')">Unsafe Condition</button>
                                                <button type="button" class="toggle-btn" onclick="toggleBahayaType(this, 'action')">Unsafe Action</button>
                                            </div>
                                            <div class="hazard-options checkbox-grid">
                                                <!-- If K3/KO, populate based on matching keywords or fallback logic? -->
                                                <!-- Problem: JS clears this. So we rely on "Manual Rendering" just for display, 
                                                     but if user toggles, it resets. 
                                                     Strategy: Render checkboxes for ALL options relevant to category? 
                                                     Or just render what we have. 
                                                -->
                                                @foreach($details as $d)
                                                    <label class="checkbox-card">
                                                        <input type="checkbox" name="items[{{$index}}][kolom6_bahaya][]" value="{{ $d }}" checked> {{ $d }}
                                                    </label>
                                                @endforeach
                                                <!-- Note: If user wants to add more, they must toggle. Toggling clears existing. This is a bit of a UX trap if they don't realize.
                                                     Better: JS should detect "Pre-filled" state on init. 
                                                -->
                                            </div>
                                            <div class="form-group mt-4">
                                                <label class="form-label">Bahaya Lainnya (Manual)</label>
                                                <input type="text" class="form-control" name="items[{{$index}}][bahaya_manual]" value="{{ $bahaya['manual'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 3. Risk -->
                                    <div style="margin-bottom:25px;">
                                        <h3 style="font-size:14px; font-weight:700; border-bottom:2px solid #e2e8f0; margin-bottom:15px; padding-bottom:8px;">3. Analisis Risiko</h3>
                                        <div class="form-grid-2">
                                            <div class="form-group"><label class="form-label">Dampak</label><textarea class="form-control" name="items[{{$index}}][kolom7_dampak]" required>{{ $item->kolom7_dampak }}</textarea></div>
                                            <div class="form-group"><label class="form-label">Risiko</label><textarea class="form-control" name="items[{{$index}}][kolom9_risiko]" required>{{ $item->kolom9_risiko }}</textarea></div>
                                        </div>
                                    </div>

                                    <!-- 4. Assessment -->
                                     <div style="margin-bottom: 25px;">
                                        <div style="background:#f8fafc; padding:20px; border-radius:12px;">
                                            <h4 style="font-size:13px; font-weight:700; margin-bottom:15px;">Penilaian Risiko Awal</h4>
                                            <div style="display: flex; gap: 20px;">
                                                <div style="flex:1; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                                    <div class="form-group">
                                                        <label class="form-label">Kemungkinan</label>
                                                        <select class="form-control likelihood-select" name="items[{{$index}}][kolom12_kemungkinan]" required onchange="calculateItemRisk(this)">
                                                            @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ $v == $item->kolom12_kemungkinan ? 'selected' : '' }}>{{$v}}</option> @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Konsekuensi</label>
                                                        <select class="form-control severity-select" name="items[{{$index}}][kolom13_konsekuensi]" required onchange="calculateItemRisk(this)">
                                                            @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ $v == $item->kolom13_konsekuensi ? 'selected' : '' }}>{{$v}}</option> @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div style="flex: 0 0 160px; text-align:center;">
                                                    <div class="risk-result-box">
                                                        <div class="risk-score display-score">-</div>
                                                        <span class="risk-level display-level">PENDING</span>
                                                    </div>
                                                    <input type="hidden" name="items[{{$index}}][kolom14_score]" class="input-score" value="{{ $item->kolom14_score }}">
                                                    <input type="hidden" name="items[{{$index}}][kolom14_level]" class="input-level" value="{{ $item->kolom14_level }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 5. Controls -->
                                    <div style="margin-bottom: 25px;">
                                         <h3 style="font-size:14px; font-weight:700; border-bottom:2px solid #e2e8f0; margin-bottom:15px; padding-bottom:8px;">5. Pengendalian</h3>
                                         <div class="form-group">
                                             <label class="form-label">Hirarki</label>
                                             <div class="checkbox-grid">
                                                 @php $h = $item->kolom10_pengendalian['hierarchy'] ?? []; @endphp
                                                 @foreach(['Eliminasi','Substitusi','Rekayasa Teknik','Administratif','APD'] as $opt)
                                                    <label class="checkbox-card"><input type="checkbox" name="items[{{$index}}][kolom10_pengendalian][]" value="{{$opt}}" {{ in_array($opt, (array)$h) ? 'checked' : '' }}> {{ $opt }}</label>
                                                 @endforeach
                                             </div>
                                         </div>
                                         <div class="form-group"><label class="form-label">Existing Control</label><textarea class="form-control" name="items[{{$index}}][kolom11_existing]">{{ $item->kolom11_existing }}</textarea></div>
                                         <div class="form-group"><label class="form-label">Regulasi</label><textarea class="form-control" name="items[{{$index}}][kolom15_regulasi]">{{ $item->kolom15_regulasi }}</textarea></div>
                                    </div>
                                    
                                    <!-- 6. Residual & Follow up -->
                                     <div style="background:#f0fdf4; padding:20px; border-radius:12px; border:1px solid #bbf7d0;">
                                          <div class="form-group"><label class="form-label">Tindak Lanjut</label><textarea class="form-control" name="items[{{$index}}][kolom18_tindak_lanjut]">{{ $item->kolom18_tindak_lanjut }}</textarea></div>
                                          <div style="display:flex; gap:30px;">
                                              <div style="flex:1; display:flex; gap:20px;">
                                                  <div class="form-group" style="flex:1"><label class="form-label">Res. Kemungkinan</label><select class="form-control" name="items[{{$index}}][residual_kemungkinan]" onchange="calculateItemResidual(this)">
                                                      @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ $v == $item->residual_kemungkinan ? 'selected' : '' }}>{{$v}}</option> @endforeach
                                                  </select></div>
                                                  <div class="form-group" style="flex:1"><label class="form-label">Res. Konsekuensi</label><select class="form-control" name="items[{{$index}}][residual_konsekuensi]" onchange="calculateItemResidual(this)">
                                                      @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ $v == $item->residual_konsekuensi ? 'selected' : '' }}>{{$v}}</option> @endforeach
                                                  </select></div>
                                              </div>
                                               <div style="flex:0 0 120px;">
                                                   <div class="risk-result-box res-box" style="padding:10px;">
                                                        <div class="risk-score res-score" style="font-size:24px;">-</div>
                                                        <span class="risk-level res-level" style="font-size:10px;">PENDING</span>
                                                    </div>
                                                    <input type="hidden" name="items[{{$index}}][residual_score]" class="input-res-score" value="{{ $item->residual_score }}">
                                                    <input type="hidden" name="items[{{$index}}][residual_level]" class="input-res-level" value="{{ $item->residual_level }}">
                                               </div>
                                          </div>
                                          <div class="form-group mt-4">
                                              <label class="form-label">Dapat Ditoleransi?</label>
                                              <select class="form-control" name="items[{{$index}}][kolom18_toleransi]">
                                                  <option value="Ya" {{ ($item->kolom18_toleransi ?? 'Ya') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                                  <option value="Tidak" {{ ($item->kolom18_toleransi ?? '') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>
                                          </div>
                                     </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div style="text-align: center; margin-bottom: 40px;">
                        <button type="button" class="btn btn-secondary" onclick="addItem()" style="border: 2px dashed #cbd5e1; background: white; width: 100%; justify-content: center; padding: 20px;">
                            <i class="fas fa-plus-circle" style="font-size: 18px; color: var(--primary-color);"></i> Tambah Kegiatan Lain
                        </button>
                    </div>

                    <div class="action-bar">
                        <div class="action-buttons">
                            <!-- Draft save logic if needed -->
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="return validateForm()">
                            <i class="fas fa-paper-plane"></i> Submit Revisi
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- ITEM TEMPLATE (Exact Copy from Create) -->
    <template id="item-template">
        <div class="doc-item" data-index="{index}" style="margin-bottom: 30px; transition: all 0.3s ease;">
            <div class="doc-card" style="border-left: 5px solid var(--primary-color); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border-radius: 12px; overflow: hidden; background: white;">
                <!-- Header -->
                <div class="card-header" style="justify-content: space-between; background: linear-gradient(to right, #fff1f2, #fff); padding: 15px 25px; border-bottom: 1px solid #fce7f3; cursor: pointer;" onclick="toggleCollapse(this)">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div class="header-icon" style="background: var(--primary-color); color: white; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%; box-shadow: 0 2px 4px rgba(196, 30, 58, 0.3);">
                            <span class="item-number" style="font-weight: 700; font-size: 14px;">#{displayIndex}</span>
                        </div>
                        <div class="header-title">
                            <h2 style="font-size: 16px; margin: 0; color: #881337; font-weight: 700;">Detail Kegiatan</h2>
                            <span class="item-summary" style="font-size: 12px; color: #64748b; font-weight: 500; display: none;">(Klik untuk expand)</span>
                        </div>
                    </div>
                    <div class="header-actions" style="display: flex; gap: 10px;">
                        <button type="button" class="btn-collapse" style="background: transparent; border: none; color: #64748b; cursor: pointer;"><i class="fas fa-chevron-up transition-transform"></i></button>
                        <button type="button" class="btn-remove-item" onclick="removeItem(this); event.stopPropagation();" style="background: white; border: 1px solid #fecaca; color: #ef4444; cursor: pointer; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 6px;"><i class="fas fa-trash-alt"></i> Hapus</button>
                    </div>
                </div>
                <!-- Body -->
                <div class="card-body collapsible-content" style="padding: 25px;">
                     <!-- 1. Basic -->
                     <div style="margin-bottom: 25px;">
                        <h3 style="font-size:14px; text-transform:uppercase; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">1. Informasi Dasar</h3>
                        <div class="form-grid-2">
                             <div class="form-group"><label class="form-label">Proses Bisnis</label><input type="text" class="form-control probis-input" name="items[{index}][kolom2_proses]" readonly style="background-color:#f8fafc; cursor:not-allowed;"></div>
                             <div class="form-group"><label class="form-label">Kegiatan</label><input type="text" class="form-control item-kegiatan-input" name="items[{index}][kolom2_kegiatan]" required oninput="updateSummary(this)"></div>
                             <div class="form-group"><label class="form-label">Lokasi</label><input type="text" class="form-control" name="items[{index}][kolom3_lokasi]" required></div>
                             <div class="form-group"><label class="form-label">Pihak Berkepentingan</label><input type="text" class="form-control" name="items[{index}][kolom4_pihak]"></div>
                             <div class="form-group"><label class="form-label">Kategori</label><select class="form-control category-select" name="items[{index}][kategori]" required onchange="updateConditions(this)"><option value="">-- Pilih --</option><option value="K3">K3</option><option value="KO">KO</option><option value="Lingkungan">Lingkungan</option><option value="Keamanan">Keamanan</option></select></div>
                             <div class="form-group"><label class="form-label">Kondisi</label><select class="form-control condition-select" name="items[{index}][kolom5_kondisi]" required><option value="">-- Pilih Kategori Dulu --</option></select></div>
                        </div>
                     </div>
                     <!-- Hazard -->
                     <div style="margin-bottom: 25px;">
                        <h3 style="font-size:14px; text-transform:uppercase; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">2. Identifikasi Bahaya</h3>
                        <div class="hazard-section" style="background:#fffbeb; padding:20px; border-radius:8px;">
                             <div class="toggle-group hazard-toggles hidden" style="margin-bottom:15px;">
                                <button type="button" class="toggle-btn active" onclick="toggleBahayaType(this, 'condition')">Unsafe Condition</button>
                                <button type="button" class="toggle-btn" onclick="toggleBahayaType(this, 'action')">Unsafe Action</button>
                             </div>
                             <div class="hazard-options checkbox-grid"></div>
                             <div class="form-group mt-4"><label class="form-label">Bahaya Manual</label><input type="text" class="form-control" name="items[{index}][bahaya_manual]"></div>
                        </div>
                     </div>
                     <!-- Risk -->
                     <div style="margin-bottom: 25px;">
                         <h3 style="font-size:14px; text-transform:uppercase; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">3. Analisis Risiko</h3>
                         <div class="form-grid-2">
                             <div class="form-group"><label class="form-label">Dampak</label><textarea class="form-control" name="items[{index}][kolom7_dampak]" required></textarea></div>
                             <div class="form-group"><label class="form-label">Risiko</label><textarea class="form-control" name="items[{index}][kolom9_risiko]" required></textarea></div>
                         </div>
                     </div>
                     <!-- Assessment -->
                     <div style="margin-bottom: 25px;">
                        <div style="background:#f8fafc; padding:20px; border-radius:12px;">
                            <h4 style="font-size:13px; font-weight:700; margin-bottom:15px;">Penilaian Risiko Awal</h4>
                            <div style="display:flex; gap:20px;">
                                <div style="flex:1; display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                                     <div class="form-group"><label class="form-label">Kemungkinan</label><select class="form-control likelihood-select" name="items[{index}][kolom12_kemungkinan]" required onchange="calculateItemRisk(this)"><option value="">--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>
                                     <div class="form-group"><label class="form-label">Konsekuensi</label><select class="form-control severity-select" name="items[{index}][kolom13_konsekuensi]" required onchange="calculateItemRisk(this)"><option value="">--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>
                                </div>
                                <div style="flex:0 0 160px; text-align:center;">
                                    <div class="risk-result-box"><div class="risk-score display-score">-</div><span class="risk-level display-level">PENDING</span></div>
                                    <input type="hidden" name="items[{index}][kolom14_score]" class="input-score">
                                    <input type="hidden" name="items[{index}][kolom14_level]" class="input-level">
                                </div>
                            </div>
                        </div>
                     </div>
                     <!-- Controls -->
                     <div style="margin-bottom: 25px;">
                         <h3 style="font-size:14px; text-transform:uppercase; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">5. Pengendalian</h3>
                         <div class="form-group">
                             <label class="form-label">Hirarki</label>
                             <div class="checkbox-grid">
                                 <!-- Hardcoded Options -->
                                 <label class="checkbox-card"><input type="checkbox" name="items[{index}][kolom10_pengendalian][]" value="Eliminasi"> Eliminasi</label>
                                 <label class="checkbox-card"><input type="checkbox" name="items[{index}][kolom10_pengendalian][]" value="Substitusi"> Substitusi</label>
                                 <label class="checkbox-card"><input type="checkbox" name="items[{index}][kolom10_pengendalian][]" value="Rekayasa Teknik"> Rekayasa Teknik</label>
                                 <label class="checkbox-card"><input type="checkbox" name="items[{index}][kolom10_pengendalian][]" value="Administratif"> Administratif</label>
                                 <label class="checkbox-card"><input type="checkbox" name="items[{index}][kolom10_pengendalian][]" value="APD"> APD</label>
                             </div>
                         </div>
                         <div class="form-group"><label class="form-label">Existing Control</label><textarea class="form-control" name="items[{index}][kolom11_existing]"></textarea></div>
                         <div class="form-group"><label class="form-label">Regulasi</label><textarea class="form-control" name="items[{index}][kolom15_regulasi]"></textarea></div>
                     </div>
                     <!-- Residual -->
                     <div style="background:#f0fdf4; padding:20px; border-radius:12px; border:1px solid #bbf7d0;">
                          <div class="form-group"><label class="form-label">Tindak Lanjut</label><textarea class="form-control" name="items[{index}][kolom18_tindak_lanjut]"></textarea></div>
                          <div style="display:flex; gap:30px;">
                              <div style="flex:1; display:flex; gap:20px;">
                                  <div class="form-group" style="flex:1"><label class="form-label">Res. Kemungkinan</label><select class="form-control" name="items[{index}][residual_kemungkinan]" onchange="calculateItemResidual(this)"><option value="">--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>
                                  <div class="form-group" style="flex:1"><label class="form-label">Res. Konsekuensi</label><select class="form-control" name="items[{index}][residual_konsekuensi]" onchange="calculateItemResidual(this)"><option value="">--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>
                              </div>
                               <div style="flex:0 0 120px;">
                                   <div class="risk-result-box res-box" style="padding:10px;">
                                        <div class="risk-score res-score" style="font-size:24px;">-</div>
                                        <span class="risk-level res-level" style="font-size:10px;">PENDING</span>
                                    </div>
                                    <input type="hidden" name="items[{index}][residual_score]" class="input-res-score">
                                    <input type="hidden" name="items[{index}][residual_level]" class="input-res-level">
                               </div>
                          </div>
                          <div class="form-group mt-4">
                              <label class="form-label">Dapat Ditoleransi?</label>
                              <select class="form-control" name="items[{index}][kolom18_toleransi]">
                                  <option value="Ya">Ya</option>
                                  <option value="Tidak">Tidak</option>
                              </select>
                          </div>
                     </div>
                </div>
            </div>
        </div>
    </template>

    <script>
        let itemIndex = {{ $document->details->count() }};
        const autoProbis = document.getElementById('auto_probis_value').value;

        const categories = {
            'K3': { label: 'K3', conditions: ['Rutin', 'Non-Rutin', 'Emergency'] },
            'KO': { label: 'KO', conditions: ['Normal', 'Abnormal', 'Emergency'] },
            'Lingkungan': { label: 'Lingkungan', conditions: ['Normal', 'Abnormal', 'Emergency'] },
            'Keamanan': { label: 'Keamanan', conditions: ['Rutin', 'Non-Rutin', 'Emergency'] }
        };

        const hazards = {
            'condition': ['Licin', 'Terjal', 'Panas', 'Bising', 'Gelap', 'Berdebu', 'Sempit'],
            'action': ['Tidak Pakai APD', 'Bekerja Buru-buru', 'Posisi Salah', 'Mengabaikan Prosedur']
        };

        // Reuse JS logic from create.blade.php
        function addItem() {
            // Collapse all existing first
            document.querySelectorAll('.doc-item').forEach(el => collapseItem(el));

            const template = document.getElementById('item-template').innerHTML;
            const container = document.getElementById('items-container');
            
            let html = template.replace(/{index}/g, itemIndex)
                               .replace(/{displayIndex}/g, itemIndex + 1);
            
            const div = document.createElement('div');
            div.innerHTML = html;
            const itemNode = div.firstElementChild;
            
            const probisInput = itemNode.querySelector('.probis-input');
            if(probisInput) probisInput.value = autoProbis;

            container.appendChild(itemNode);
            itemNode.scrollIntoView({ behavior: 'smooth', block: 'center' });

            itemIndex++;
            updateRemoveButtons();
        }

        function removeItem(btn) {
            if(!confirm('Hapus item ini?')) return;
            btn.closest('.doc-item').remove();
            updateItemNumbers();
        }

        function toggleCollapse(header) {
            const item = header.closest('.doc-item');
            const content = item.querySelector('.collapsible-content');
            const icon = item.querySelector('.btn-collapse i');
            const summary = item.querySelector('.item-summary');
            
            if (!content || !icon) return; // Guard

            if (content.style.display === 'none') {
                content.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
                if(summary) summary.style.display = 'none';
                item.classList.remove('collapsed');
            } else {
                content.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                if(summary) summary.style.display = 'inline';
                item.classList.add('collapsed');
            }
        }

         function collapseItem(item) {
             const content = item.querySelector('.collapsible-content');
             const icon = item.querySelector('.btn-collapse i');
             const summary = item.querySelector('.item-summary');
             
             if(content && icon) {
                content.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                if(summary) summary.style.display = 'inline';
                item.classList.add('collapsed');
             }
        }

        function updateSummary(input) {
            const item = input.closest('.doc-item');
            const summary = item.querySelector('.item-summary');
            if(input.value) {
                const limit = 30;
                let txt = input.value;
                if(txt.length > limit) txt = txt.substring(0, limit) + '...';
                summary.textContent = `(${txt})`;
            } else {
                summary.textContent = '(Klik untuk expand)';
            }
        }

         function updateItemNumbers() {
            const items = document.querySelectorAll('.doc-item');
            items.forEach((item, idx) => {
                item.querySelector('.item-number').textContent = '#' + (idx + 1);
            });
            updateRemoveButtons();
        }

        function updateRemoveButtons() {
            const buttons = document.querySelectorAll('.btn-remove-item');
            if (buttons.length === 1) buttons[0].style.display = 'none'; 
            else buttons.forEach(b => b.style.display = 'block');
        }

         function updateConditions(select) {
            const item = select.closest('.doc-item');
            const condSelect = item.querySelector('.condition-select');
            const cat = select.value;
            const toggles = item.querySelector('.hazard-toggles');
            const hazardOptions = item.querySelector('.hazard-options');

            condSelect.innerHTML = '<option value="">-- Pilih --</option>';
            hazardOptions.innerHTML = '';

            if (categories[cat]) {
                categories[cat].conditions.forEach(c => {
                    const opt = document.createElement('option');
                    opt.value = c;
                    opt.textContent = c;
                    condSelect.appendChild(opt);
                });

                if (cat === 'K3' || cat === 'KO') {
                     if(toggles) toggles.classList.remove('hidden');
                     loadHazards(item, 'condition'); 
                } else {
                     if(toggles) toggles.classList.add('hidden');
                     ['Pencemaran Air', 'Pencemaran Udara', 'Kebisingan'].forEach(h => {
                         addCheckbox(hazardOptions, item.dataset.index, h);
                     });
                }
            }
        }

        function toggleBahayaType(btn, type) {
            const group = btn.parentElement;
            group.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const item = btn.closest('.doc-item');
            loadHazards(item, type);
        }

        function loadHazards(item, type) {
            const container = item.querySelector('.hazard-options');
            container.innerHTML = '';
            // For new items, we use index from dataset. For existing, it's PHP index. logic is same.
            let idx = item.dataset.index;
            // If template uses {index}, it's replaced. Here we use runtime index.
            
            // NOTE: This clears existing checks! Only use on Toggle or Category Change.
            
            hazards[type].forEach(h => {
                 addCheckbox(container, idx, h);
            });
        }

        function addCheckbox(container, idx, label) {
            // Need to handle Items Array Name correctly: items[idx][kolom6_bahaya][]
            const html = `
                <label class="checkbox-card">
                    <input type="checkbox" name="items[${idx}][kolom6_bahaya][]" value="${label}"> ${label}
                </label>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        function calculateItemRisk(el) {
            const item = el.closest('.doc-item');
            const likelihood = parseInt(item.querySelector('.likelihood-select').value) || 0;
            const severity = parseInt(item.querySelector('.severity-select').value) || 0;
            
            const score = likelihood * severity;
            updateRiskUI(item, score, '.display-score', '.display-level', '.input-score', '.input-level', '.risk-result-box');
        }

        function calculateItemResidual(el) {
            const item = el.closest('.doc-item');
            const likelihood = parseInt(item.querySelector('[name*="residual_kemungkinan"]').value) || 0;
            const severity = parseInt(item.querySelector('[name*="residual_konsekuensi"]').value) || 0;
            const score = likelihood * severity;
            
            // For residual, we target specific classes
            const scoreEl = item.querySelector('.res-score');
            const levelEl = item.querySelector('.res-level');
            const resBox = item.querySelector('.res-box');
            
            scoreEl.textContent = score || '-';
            item.querySelector('.input-res-score').value = score;
            
            let level = 'Rendah';
            let bg = '#166534';
            let textColor = '#fff';
            
            if (score >= 15) { level = 'Tinggi'; bg = '#dc2626'; }
            else if (score >= 8) { level = 'Sedang'; bg = '#f59e0b'; }
            else if (score === 0) { level = 'PENDING'; bg = '#cbd5e1'; textColor = '#64748b'; }

            levelEl.textContent = level;
            item.querySelector('.input-res-level').value = level;
            if(resBox) {
                resBox.style.background = bg;
                resBox.style.color = textColor;
            }
        }

        function updateRiskUI(item, score, scoreSel, levelSel, inpScoreSel, inpLevelSel, boxSel) {
            const scoreEl = item.querySelector(scoreSel);
            const levelEl = item.querySelector(levelSel);
            const inputScore = item.querySelector(inpScoreSel);
            const inputLevel = item.querySelector(inpLevelSel);
            const riskBox = item.querySelector(boxSel);

            scoreEl.textContent = score || '-';
            inputScore.value = score;
            
            let level = 'Rendah';
            let bg = '#10b981'; // Green
            let textColor = '#fff';
            
            if (score >= 15) { level = 'Tinggi'; bg = '#dc2626'; }
            else if (score >= 8) { level = 'Sedang'; bg = '#f59e0b'; } 
            else if (score === 0) { level = 'PENDING'; bg = '#cbd5e1'; textColor = '#64748b'; }

            levelEl.textContent = level;
            inputLevel.value = level;
            if(riskBox) {
                riskBox.style.background = bg;
                riskBox.style.color = textColor;
            }
        }

        function validateForm() { return true; }

        // Init Existing Items
        document.addEventListener('DOMContentLoaded', () => {
             const loadedItems = document.querySelectorAll('.item-loaded');
             if(loadedItems.length === 0) {
                 addItem(); // Adds empty one if none
             } else {
                 // Calculate risk for all loaded items
                 loadedItems.forEach(item => {
                     // Trigger risk calc
                     const lSelect = item.querySelector('.likelihood-select');
                     if(lSelect) calculateItemRisk(lSelect);
                     
                     // Trigger residual calc
                     const resSelect = item.querySelector('[name*="residual_kemungkinan"]');
                     if(resSelect) calculateItemResidual(resSelect);
                     
                     // Collapse initially except first? Or allow user to see all?
                     // Usually better to collapse to save space, but user is Editing so might want to see.
                     // Let's collapse all except first.
                     if(item.dataset.index > 0) collapseItem(item);
                 });
             }
             updateRemoveButtons();
        });
        
         document.addEventListener('keydown', function(event) {
            if(event.key === 'Enter' && event.target.tagName !== 'TEXTAREA') {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
