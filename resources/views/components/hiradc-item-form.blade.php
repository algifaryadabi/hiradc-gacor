@props(['item', 'index' => 0, 'prefix' => 'items'])

<!-- Form Container (JS scope uses this form) -->
<div class="hiradc-edit-form" style="padding: 10px;">

    <!-- 1. INFO -->
    <div style="margin-bottom:25px;">
        <h3 style="font-size:14px; font-weight:700; border-bottom:2px solid #e2e8f0; margin-bottom:15px; padding-bottom:8px; color:#1e293b;">1. Informasi Dasar</h3>
        <div class="form-grid-2" style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div class="form-group">
                <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Proses Bisnis</label>
                <input type="text" class="form-control" name="{{ $prefix }}[{{$index}}][kolom2_proses]" value="{{ $item->kolom2_proses ?? '' }}" readonly style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px; background:#f1f5f9; cursor:not-allowed;">
            </div>
            <div class="form-group">
                <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Kegiatan</label>
                <input type="text" class="form-control" name="{{ $prefix }}[{{$index}}][kolom2_kegiatan]" value="{{ $item->kolom2_kegiatan ?? '' }}" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
            </div>
            <div class="form-group">
                <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Lokasi</label>
                <input type="text" class="form-control" name="{{ $prefix }}[{{$index}}][kolom3_lokasi]" value="{{ $item->kolom3_lokasi ?? '' }}" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
            </div>

            <!-- Category -->
            <div class="form-group">
                <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Kategori</label>
                <select class="form-control" name="{{ $prefix }}[{{$index}}][kategori]" required onchange="updateConditions(this)" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
                    @foreach(['K3','KO','Lingkungan','Keamanan'] as $cat)
                        <option value="{{$cat}}" {{ ($item->kategori ?? '') == $cat ? 'selected' : '' }}>{{$cat}}</option>
                    @endforeach
                </select>
            </div>
            <!-- Condition -->
            <div class="form-group">
                <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Kondisi</label>
                <select class="form-control condition-select" name="{{ $prefix }}[{{$index}}][kolom5_kondisi]" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
                     @php 
                        $opts = match($item->kategori ?? '') {
                            'Lingkungan' => ['Normal', 'Abnormal', 'Emergency'],
                            'Keamanan'   => ['Emergency'],
                            default => ['Rutin', 'Non-Rutin', 'Emergency']
                        };
                     @endphp
                     @foreach($opts as $opt)
                        <option value="{{ $opt }}" {{ ($item->kolom5_kondisi ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                     @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- 2. IDENTIFIKASI -->
    <div style="margin-bottom:25px;">
        <h3 style="font-size:14px; font-weight:700; border-bottom:2px solid #e2e8f0; margin-bottom:15px; padding-bottom:8px; color:#1e293b;">2. Identifikasi Bahaya / Aspek / Ancaman</h3>
        @php $cat = $item->kategori ?? 'K3'; @endphp

        <!-- K3/KO Field -->
        <div class="k3-ko-field" style="{{ in_array($cat, ['K3','KO']) ? 'display:block' : 'display:none' }}; background: #fffbeb; padding: 20px; border-radius: 8px; border:1px solid #fef3c7; margin-bottom:15px;">
            <label style="font-weight:600; margin-bottom:10px; display:block;">Potensi Bahaya (K3/KO)</label>
            <div class="checkbox-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:10px;">
                @php $bahaya = $item->kolom6_bahaya ?? []; $bDetails = $bahaya['details'] ?? []; @endphp
                @foreach(['Bahaya Fisika','Bahaya Kimia','Bahaya Biologi','Bahaya Fisiologis/Ergonomi','Bahaya Psikologis','Bahaya dari Prilaku'] as $opt)
                    <label style="display:flex; gap:10px; align-items:center;"><input type="checkbox" name="{{ $prefix }}[{{$index}}][kolom6_bahaya][]" value="{{$opt}}" {{ in_array($opt, $bDetails) ? 'checked' : '' }}> {{$opt}}</label>
                @endforeach
            </div>
            <div class="mt-3" style="margin-top:10px;">
                <input type="text" class="form-control" name="{{ $prefix }}[{{$index}}][bahaya_manual]" value="{{ $bahaya['manual'] ?? '' }}" placeholder="Bahaya Lainnya..." style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:4px;">
            </div>
        </div>

        <!-- Lingkungan Field -->
        <div class="lingkungan-field" style="{{ $cat == 'Lingkungan' ? 'display:block' : 'display:none' }}; background: #ecfdf5; padding: 20px; border-radius: 8px; border:1px solid #10b981; margin-bottom:15px;">
            <label style="font-weight:600; margin-bottom:10px; display:block;">Aspek Lingkungan</label>
             <div class="checkbox-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:10px;">
                @php $aspek = $item->kolom7_aspek_lingkungan ?? []; $aDetails = $aspek['details'] ?? []; @endphp
                @foreach(['Emisi ke udara','Pembuangan ke air','Pembuangan ke tanah','Penggunaan Bahan Baku dan SDA','Penggunaan energi','Paparan energi','Limbah'] as $opt)
                     <label style="display:flex; gap:10px; align-items:center;"><input type="checkbox" name="{{ $prefix }}[{{$index}}][kolom7_aspek_lingkungan][]" value="{{$opt}}" {{ in_array($opt, $aDetails) ? 'checked' : '' }}> {{$opt}}</label>
                @endforeach
            </div>
            <div class="mt-3" style="margin-top:10px;">
                 <input type="text" class="form-control" name="{{ $prefix }}[{{$index}}][aspek_manual]" value="{{ $aspek['manual'] ?? '' }}" placeholder="Aspek Lainnya..." style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:4px;">
            </div>
        </div>

        <!-- Keamanan Field -->
        <div class="keamanan-field" style="{{ $cat == 'Keamanan' ? 'display:block' : 'display:none' }}; background: #fef2f2; padding: 20px; border-radius: 8px; border:1px solid #ef4444; margin-bottom:15px;">
            <label style="font-weight:600; margin-bottom:10px; display:block;">Ancaman Keamanan</label>
            <div class="checkbox-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:10px;">
                @php $ancaman = $item->kolom8_ancaman ?? []; $anDetails = $ancaman['details'] ?? []; @endphp
                @foreach(['Terorisme','Sabotase','Intimidasi','Pencurian','Perusakan aset'] as $opt)
                     <label style="display:flex; gap:10px; align-items:center;"><input type="checkbox" name="{{ $prefix }}[{{$index}}][kolom8_ancaman][]" value="{{$opt}}" {{ in_array($opt, $anDetails) ? 'checked' : '' }}> {{$opt}}</label>
                @endforeach
            </div>
             <div class="mt-3" style="margin-top:10px;">
                 <input type="text" class="form-control" name="{{ $prefix }}[{{$index}}][ancaman_manual]" value="{{ $ancaman['manual'] ?? '' }}" placeholder="Ancaman Lainnya..." style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:4px;">
            </div>
        </div>

        <!-- Kolom 9 Variants -->
        <div class="kolom9-k3ko-field" style="{{ in_array($cat,['K3','KO']) ? 'display:block' : 'display:none' }}">
            <label class="form-label" style="font-weight:600; font-size:13px;">Risiko (K3/KO)</label>
            <textarea class="form-control" name="{{ $prefix }}[{{$index}}][kolom9_risiko]" style="width:100%; min-height:80px; padding:10px; border:1px solid #cbd5e1;">{{ $item->kolom9_risiko ?? '' }}</textarea>
        </div>
        <div class="kolom9-lingkungan-field" style="{{ $cat == 'Lingkungan' ? 'display:block' : 'display:none' }}">
            <label class="form-label" style="font-weight:600; font-size:13px;">Dampak Lingkungan</label>
            <textarea class="form-control" name="{{ $prefix }}[{{$index}}][kolom9_dampak_lingkungan]" style="width:100%; min-height:80px; padding:10px; border:1px solid #cbd5e1;">{{ $item->kolom9_dampak_lingkungan ?? $item->kolom9_risiko }}</textarea>
        </div>
        <div class="kolom9-keamanan-field" style="{{ $cat == 'Keamanan' ? 'display:block' : 'display:none' }}">
             <label class="form-label" style="font-weight:600; font-size:13px;">Celah Tidak Aman (Keamanan)</label>
            <textarea class="form-control" name="{{ $prefix }}[{{$index}}][kolom9_celah_keamanan]" style="width:100%; min-height:80px; padding:10px; border:1px solid #cbd5e1;">{{ $item->kolom9_celah_keamanan ?? $item->kolom9_risiko }}</textarea>
        </div>
    </div>

    <!-- 3. PENGENDALIAN -->
    <div style="margin-bottom:25px;">
        <h3 style="font-size:14px; font-weight:700; border-bottom:2px solid #e2e8f0; margin-bottom:15px; padding-bottom:8px; color:#1e293b;">3. Pengendalian</h3>
        <div class="form-group" style="margin-bottom:15px;">
             <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px;">Hirarki Pengendalian</label>
             <div style="display:flex; flex-wrap:wrap; gap:10px;">
                 @php $h = $item->kolom10_pengendalian['hierarchy'] ?? []; @endphp
                 @foreach(['Eliminasi','Substitusi','Rekayasa Teknik','Pengendalian Administratif','APD'] as $opt)
                    <label style="background:white; padding:8px 12px; border:1px solid #e2e8f0; border-radius:6px; cursor:pointer;">
                        <input type="checkbox" name="{{ $prefix }}[{{$index}}][kolom10_pengendalian][]" value="{{$opt}}" {{ in_array($opt, (array)$h) ? 'checked' : '' }}> {{ $opt }}
                    </label>
                 @endforeach
             </div>
        </div>
        <div class="form-group">
            <label class="form-label" style="font-weight:600; font-size:13px;">Pengendalian Existing</label>
            <textarea class="form-control" name="{{ $prefix }}[{{$index}}][kolom11_existing]" style="width:100%; min-height:80px; padding:10px;">{{ $item->kolom11_existing ?? '' }}</textarea>
        </div>
    </div>

    <!-- 4. PENILAIAN AWAL -->
    <div style="margin-bottom:25px;">
        <div class="risk-container" style="background:#f8fafc; padding:20px; border-radius:12px; border:1px solid #e2e8f0;">
             <h4 style="font-size:13px; font-weight:700; margin-bottom:15px;">Penilaian Risiko Awal</h4>
             <div style="display: flex; gap: 20px;">
                <div style="flex:1; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="form-label" style="font-weight:600;">Kemungkinan (L)</label>
                        <select class="form-control likelihood" name="{{ $prefix }}[{{$index}}][kolom12_kemungkinan]" required onchange="calculateSimpleRisk(this)">
                             @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ ($item->kolom12_kemungkinan ?? 0) == $v ? 'selected' : '' }}>{{$v}}</option> @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                         <label class="form-label" style="font-weight:600;">Konsekuensi (S)</label>
                         <select class="form-control severity" name="{{ $prefix }}[{{$index}}][kolom13_konsekuensi]" required onchange="calculateSimpleRisk(this)">
                             @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ ($item->kolom13_konsekuensi ?? 0) == $v ? 'selected' : '' }}>{{$v}}</option> @endforeach
                        </select>
                    </div>
                </div>
                <div style="flex: 0 0 100px; text-align:center;">
                     @php $sc = $item->kolom14_score ?? 0; $bg = ($sc >= 15 ? '#dc2626' : ($sc >= 8 ? '#f59e0b' : '#10b981')); @endphp
                     <div class="risk-badge-box" style="background:{{$bg}}; color:white; padding:15px; border-radius:10px;">
                        <div class="display-score" style="font-size:24px; font-weight:800;">{{ $sc }}</div>
                     </div>
                     <input type="hidden" name="{{ $prefix }}[{{$index}}][kolom14_score]" class="input-score" value="{{ $sc }}">
                </div>
             </div>
        </div>
    </div>

    <!-- 5. LEGALITAS -->
    <div style="margin-bottom:25px;">
         <h3 style="font-size:14px; font-weight:700; border-bottom:2px solid #e2e8f0; margin-bottom:15px;">4. Legalitas & Signifikansi</h3>
         <div class="form-group">
              <label class="form-label" style="font-weight:600;">Regulasi</label>
              <textarea class="form-control" name="{{ $prefix }}[{{$index}}][kolom15_regulasi]" rows="2" style="width:100%; padding:10px;">{{ $item->kolom15_regulasi ?? '' }}</textarea>
         </div>
         
         <!-- Lingkungan Only Field -->
         <div class="lingkungan-only-field" style="{{ $cat == 'Lingkungan' ? 'display:block' : 'display:none' }}; margin-top:15px;">
              <label class="form-label" style="font-weight:600;">Aspek Lingkungan Penting</label>
              <div style="display:flex; gap:20px;">
                  <label><input type="radio" name="{{ $prefix }}[{{$index}}][kolom16_aspek]" value="P" {{ ($item->kolom16_aspek ?? '') == 'P' ? 'checked' : '' }}> Penting (P)</label>
                  <label><input type="radio" name="{{ $prefix }}[{{$index}}][kolom16_aspek]" value="TP" {{ ($item->kolom16_aspek ?? '') == 'TP' ? 'checked' : '' }}> Tidak Penting (TP)</label>
              </div>
         </div>

         <div class="form-grid-2" style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-top:15px;">
             <div>
                 <label class="form-label" style="font-weight:600;">Peluang (+)</label>
                 <textarea class="form-control" name="{{ $prefix }}[{{$index}}][kolom17_peluang]" rows="2" style="width:100%; padding:8px;">{{ $item->kolom17_peluang ?? '' }}</textarea>
             </div>
             <div>
                  <label class="form-label" style="font-weight:600;">Risiko (-)</label>
                 <textarea class="form-control" name="{{ $prefix }}[{{$index}}][kolom17_risiko]" rows="2" style="width:100%; padding:8px;">{{ $item->kolom17_risiko ?? '' }}</textarea>
             </div>
         </div>
    </div>

    <!-- 6. MITIGASI LANJUTAN (Follow Up) -->
    <div class="bagian-5-section">
        <h3 style="font-size:14px; font-weight:700; border-bottom:2px solid #e2e8f0; margin-bottom:15px; color:#15803d;">5. Mitigasi Lanjutan & Risiko Sisa</h3>
        <div style="background:#f0fdf4; padding:20px; border-radius:12px; border:1px solid #bbf7d0;">
             <div class="form-group">
                 <label class="form-label" style="font-weight:600;">Risiko Dapat Ditoleransi?</label>
                 <select class="form-control tolerance-select" name="{{ $prefix }}[{{$index}}][kolom18_toleransi]" onchange="toggleFollowUpFields(this)" style="width:100%; padding:10px; border:1px solid #cbd5e1;">
                      <option value="Ya" {{ ($item->kolom18_toleransi ?? 'Ya') == 'Ya' ? 'selected' : '' }}>Ya</option>
                      <option value="Tidak" {{ ($item->kolom18_toleransi ?? '') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                 </select>
             </div>

             <!-- Follow Up Section -->
             <div class="follow-up-section" style="{{ ($item->kolom18_toleransi ?? '') == 'Tidak' ? 'display:block' : 'display:none' }}; margin-top:15px;">
                  <div class="form-group">
                      <label class="form-label" style="font-weight:600;">Tindak Lanjut</label>
                      <textarea class="form-control" name="{{ $prefix }}[{{$index}}][kolom19_pengendalian_lanjut]" rows="3" style="width:100%; padding:10px;">{{ $item->kolom19_pengendalian_lanjut ?? '' }}</textarea>
                  </div>
                  
                  <!-- FollowUp Risk Score -->
                  <div class="followup-container" style="background: #dcfce7; padding: 15px; border-radius: 8px; border: 1px solid #86efac; margin-top:10px;">
                        <h5 style="font-size:12px; font-weight:700; margin-bottom:10px;">Risiko Setelah Tindak Lanjut</h5>
                        <div style="display:flex; gap:20px;">
                             <div style="flex:1; display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                                 <div><label>L</label><select class="form-control followup-l" name="{{ $prefix }}[{{$index}}][kolom20_kemungkinan_lanjut]" onchange="calculateFollowUpRisk(this)"> @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ ($item->kolom20_kemungkinan_lanjut ?? 0) == $v ? 'selected' : '' }}>{{$v}}</option> @endforeach </select></div>
                                 <div><label>S</label><select class="form-control followup-s" name="{{ $prefix }}[{{$index}}][kolom21_konsekuensi_lanjut]" onchange="calculateFollowUpRisk(this)"> @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ ($item->kolom21_konsekuensi_lanjut ?? 0) == $v ? 'selected' : '' }}>{{$v}}</option> @endforeach </select></div>
                             </div>
                             <div style="flex:0 0 60px; text-align:center;">
                                  @php $fsc = $item->kolom22_tingkat_risiko_lanjut ?? 0; @endphp
                                  <div class="followup-score-display" style="font-size:20px; font-weight:800; color:#166534;">{{ $fsc }}</div>
                                  <input type="hidden" name="{{ $prefix }}[{{$index}}][kolom22_tingkat_risiko_lanjut]" class="input-followup-score" value="{{ $fsc }}">
                             </div>
                        </div>
                  </div>
             </div>
             
             <hr style="border-top:1px dashed #bbf7d0; margin:15px 0;">

             <!-- Residual Risk (Always Visible) -->
             <div class="risk-container" style="background:#15803d; color:white; padding:15px; border-radius:8px;">
                 <label style="font-weight:700; display:block; margin-bottom:10px;">Risiko Sisa (Residual)</label>
                 <div style="display: flex; gap: 20px;">
                    <div style="flex:1; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label class="form-label" style="color:#dcfce7; font-size:12px;">Kemungkinan</label>
                            <select class="form-control res-likelihood" name="{{ $prefix }}[{{$index}}][residual_kemungkinan]" required onchange="calculateSimpleRisk(this, true)" style="color:black;">
                                 @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ ($item->residual_kemungkinan ?? 0) == $v ? 'selected' : '' }}>{{$v}}</option> @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                             <label class="form-label" style="color:#dcfce7; font-size:12px;">Konsekuensi</label>
                             <select class="form-control res-severity" name="{{ $prefix }}[{{$index}}][residual_konsekuensi]" required onchange="calculateSimpleRisk(this, true)" style="color:black;">
                                 @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ ($item->residual_konsekuensi ?? 0) == $v ? 'selected' : '' }}>{{$v}}</option> @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="flex: 0 0 100px; text-align:center;">
                         @php $rsc = $item->residual_score ?? 0; @endphp
                         <div class="risk-badge-box" style="background:rgba(255,255,255,0.2); color:white; padding:10px; border-radius:10px;">
                            <div class="display-score" style="font-size:24px; font-weight:800;">{{ $rsc }}</div>
                         </div>
                         <input type="hidden" name="{{ $prefix }}[{{$index}}][residual_score]" class="input-res-score" value="{{ $rsc }}">
                    </div>
                 </div>
             </div>
        </div>
    </div>

</div>
