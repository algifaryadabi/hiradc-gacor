@props(['item', 'index' => 0, 'prefix' => 'items'])

<!-- 1. Info -->
<div style="margin-bottom:25px;">
    <h3 style="font-size:14px; font-weight:700; border-bottom:2px solid #e2e8f0; margin-bottom:15px; padding-bottom:8px; color:#1e293b;">1. Informasi Dasar</h3>
    <div class="form-grid-2" style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group" style="margin-bottom:15px;">
            <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Proses Bisnis</label>
            <input type="text" class="form-control" name="{{ $prefix }}[{{$index}}][kolom2_proses]" value="{{ $item->kolom2_proses ?? '' }}" readonly style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px; background:#f1f5f9; cursor:not-allowed;">
        </div>
        <div class="form-group" style="margin-bottom:15px;">
            <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Kegiatan</label>
            <input type="text" class="form-control" name="{{ $prefix }}[{{$index}}][kolom2_kegiatan]" value="{{ $item->kolom2_kegiatan ?? '' }}" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
        </div>
        <div class="form-group" style="margin-bottom:15px;">
            <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Lokasi</label>
            <input type="text" class="form-control" name="{{ $prefix }}[{{$index}}][kolom3_lokasi]" value="{{ $item->kolom3_lokasi ?? '' }}" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
        </div>
        <div class="form-group" style="margin-bottom:15px;">
            <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Pihak Berkepentingan</label>
            <input type="text" class="form-control" name="{{ $prefix }}[{{$index}}][kolom4_pihak]" value="{{ $item->kolom4_pihak ?? '' }}" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
        </div>
        <!-- Category -->
        <div class="form-group" style="margin-bottom:15px;">
            <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Kategori</label>
            <select class="form-control" name="{{ $prefix }}[{{$index}}][kategori]" required onchange="updateConditions(this)" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
                @foreach(['K3','KO','Lingkungan','Keamanan'] as $cat)
                    <option value="{{$cat}}" {{ ($item->kategori ?? '') == $cat ? 'selected' : '' }}>{{$cat}}</option>
                @endforeach
            </select>
        </div>
        <!-- Condition -->
        <div class="form-group" style="margin-bottom:15px;">
            <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Kondisi</label>
            <select class="form-control" name="{{ $prefix }}[{{$index}}][kolom5_kondisi]" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
                 @php 
                    $opts = match($item->kategori ?? '') {
                        'Lingkungan' => ['Normal', 'Abnormal', 'Emergency'],
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

<!-- 2. Hazard -->
<div style="margin-bottom:25px;">
    <h3 style="font-size:14px; font-weight:700; border-bottom:2px solid #e2e8f0; margin-bottom:15px; padding-bottom:8px; color:#1e293b;">2. Identifikasi Bahaya</h3>
    <div style="background: #fffbeb; padding: 20px; border-radius: 8px; border:1px solid #fef3c7;">
        @php 
            $bahaya = $item->kolom6_bahaya ?? []; 
            $details = $bahaya['details'] ?? []; 
        @endphp
        
        <div class="checkbox-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:10px;">
            @foreach($details as $d)
                <label style="display:flex; gap:10px; align-items:center; background:white; padding:10px; border:1px solid #e2e8f0; border-radius:6px;">
                    <input type="checkbox" name="{{ $prefix }}[{{$index}}][kolom6_bahaya][]" value="{{ $d }}" checked> {{ $d }}
                </label>
            @endforeach
        </div>
        <div class="form-group mt-4" style="margin-top:15px;">
            <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Bahaya Lainnya (Manual)</label>
            <input type="text" class="form-control" name="{{ $prefix }}[{{$index}}][bahaya_manual]" value="{{ $bahaya['manual'] ?? '' }}" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
        </div>
    </div>
</div>

<!-- 3. Risk Analysis -->
<div style="margin-bottom:25px;">
     <h3 style="font-size:14px; font-weight:700; border-bottom:2px solid #e2e8f0; margin-bottom:15px; padding-bottom:8px; color:#1e293b;">3. Analisis Risiko</h3>
     <div class="form-grid-2" style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Dampak</label>
            <textarea class="form-control" name="{{ $prefix }}[{{$index}}][kolom7_dampak]" required style="width:100%; min-height:80px; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">{{ $item->kolom7_dampak ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Risiko</label>
            <textarea class="form-control" name="{{ $prefix }}[{{$index}}][kolom9_risiko]" required style="width:100%; min-height:80px; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">{{ $item->kolom9_risiko ?? '' }}</textarea>
        </div>
    </div>
</div>

<!-- 4. Assessment -->
<div style="margin-bottom: 25px;">
    <div style="background:#f8fafc; padding:20px; border-radius:12px; border:1px solid #e2e8f0;">
        <h4 style="font-size:13px; font-weight:700; margin-bottom:15px;">Penilaian Risiko Awal</h4>
        <div style="display: flex; gap: 20px;">
            <div style="flex:1; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Kemungkinan (L)</label>
                    <select class="form-control" name="{{ $prefix }}[{{$index}}][kolom12_kemungkinan]" required onchange="calculateSimpleRisk(this)" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
                        @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ ($item->kolom12_kemungkinan ?? 0) == $v ? 'selected' : '' }}>{{$v}}</option> @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Konsekuensi (S)</label>
                    <select class="form-control" name="{{ $prefix }}[{{$index}}][kolom13_konsekuensi]" required onchange="calculateSimpleRisk(this)" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
                        @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ ($item->kolom13_konsekuensi ?? 0) == $v ? 'selected' : '' }}>{{$v}}</option> @endforeach
                    </select>
                </div>
            </div>
            <div style="flex: 0 0 120px; text-align:center;">
                @php $score = isset($item) ? $item->kolom14_score : 0; @endphp
                <div style="background:#1e293b; color:white; padding:15px; border-radius:10px;">
                    <div class="display-score" style="font-size:24px; font-weight:800;">{{ $score }}</div>
                </div>
                <input type="hidden" name="{{ $prefix }}[{{$index}}][kolom14_score]" class="input-score" value="{{ $score }}">
            </div>
        </div>
    </div>
</div>

<!-- 5. Controls -->
<div style="margin-bottom: 25px;">
     <h3 style="font-size:14px; font-weight:700; border-bottom:2px solid #e2e8f0; margin-bottom:15px; padding-bottom:8px; color:#1e293b;">5. Pengendalian</h3>
     <div class="form-group" style="margin-bottom:15px;">
         <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Hirarki Pengendalian</label>
         <div style="display:flex; flex-wrap:wrap; gap:10px;">
             @php $h = isset($item) ? ($item->kolom10_pengendalian['hierarchy'] ?? []) : []; @endphp
             @foreach(['Eliminasi','Substitusi','Rekayasa Teknik','Administratif','APD'] as $opt)
                <label style="background:white; padding:8px 12px; border:1px solid #e2e8f0; border-radius:6px; cursor:pointer; display:flex; align-items:center; gap:8px;">
                    <input type="checkbox" name="{{ $prefix }}[{{$index}}][kolom10_pengendalian][]" value="{{$opt}}" {{ in_array($opt, (array)$h) ? 'checked' : '' }}> {{ $opt }}
                </label>
             @endforeach
         </div>
     </div>
     <div class="form-group" style="margin-bottom:15px;">
         <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Pengendalian Existing</label>
         <textarea class="form-control" name="{{ $prefix }}[{{$index}}][kolom11_existing]" style="width:100%; min-height:80px; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">{{ $item->kolom11_existing ?? '' }}</textarea>
     </div>
     <div class="form-group" style="margin-bottom:15px;">
         <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Regulasi</label>
         <textarea class="form-control" name="{{ $prefix }}[{{$index}}][kolom15_regulasi]" style="width:100%; min-height:60px; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">{{ $item->kolom15_regulasi ?? '' }}</textarea>
     </div>
</div>

<!-- 6. Residual -->
<div style="background:#f0fdf4; padding:20px; border-radius:12px; border:1px solid #bbf7d0; margin-bottom:20px;">
      <div class="form-group" style="margin-bottom:15px;">
        <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Tindak Lanjut</label>
        <textarea class="form-control" name="{{ $prefix }}[{{$index}}][kolom18_tindak_lanjut]" style="width:100%; min-height:80px; padding:10px; border:1px solid #bbf7d0; border-radius:6px;">{{ $item->kolom18_tindak_lanjut ?? '' }}</textarea>
      </div>
      
      <div style="display:flex; gap:20px;">
          <div style="flex:1; display:flex; gap:20px;">
              <div class="form-group" style="flex:1;">
                    <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Res. Kemungkinan</label>
                    <select class="form-control" name="{{ $prefix }}[{{$index}}][residual_kemungkinan]" onchange="calculateSimpleRisk(this, true)" style="width:100%; padding:10px; border:1px solid #bbf7d0; border-radius:6px;">
                        @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ ($item->residual_kemungkinan ?? 0) == $v ? 'selected' : '' }}>{{$v}}</option> @endforeach
                    </select>
              </div>
              <div class="form-group" style="flex:1;">
                    <label class="form-label" style="font-weight:600; font-size:13px; margin-bottom:5px; display:block;">Res. Konsekuensi</label>
                    <select class="form-control" name="{{ $prefix }}[{{$index}}][residual_konsekuensi]" onchange="calculateSimpleRisk(this, true)" style="width:100%; padding:10px; border:1px solid #bbf7d0; border-radius:6px;">
                        @foreach([1,2,3,4,5] as $v) <option value="{{$v}}" {{ ($item->residual_konsekuensi ?? 0) == $v ? 'selected' : '' }}>{{$v}}</option> @endforeach
                    </select>
              </div>
          </div>
           <div style="flex:0 0 100px; text-align:center;">
               @php $resScore = isset($item) ? $item->residual_score : 0; @endphp
               <div style="background:#14532d; color:white; padding:10px; border-radius:10px;">
                    <div class="display-res-score" style="font-size:20px; font-weight:800;">{{ $resScore }}</div>
                </div>
                <input type="hidden" name="{{ $prefix }}[{{$index}}][residual_score]" class="input-res-score" value="{{ $resScore }}">
           </div>
      </div>
</div>
