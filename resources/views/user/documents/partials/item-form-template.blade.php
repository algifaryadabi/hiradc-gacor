<div class="doc-item" data-index="{index}" style="margin-bottom: 30px; transition: all 0.3s ease;">
    <div class="doc-card"
        style="border-left: 5px solid var(--primary-color); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border-radius: 12px; overflow: hidden; background: white;">

        <!-- Card Header -->
        <div class="card-header"
            style="justify-content: space-between; background: linear-gradient(to right, #fff1f2, #fff); padding: 15px 25px; border-bottom: 1px solid #fce7f3; cursor: pointer;"
            onclick="toggleCollapse(this)">
            <div style="display: flex; align-items: center; gap: 15px;">
                <div class="header-icon"
                    style="background: var(--primary-color); color: white; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%; box-shadow: 0 2px 4px rgba(196, 30, 58, 0.3);">
                    <span class="item-number" style="font-weight: 700; font-size: 14px;">#{displayIndex}</span>
                </div>
                <div class="header-title">
                    <h2 style="font-size: 16px; margin: 0; color: #881337; font-weight: 700;">Detail Kegiatan
                    </h2>
                    <span class="item-summary"
                        style="font-size: 12px; color: #64748b; font-weight: 500; display: none;">(Klik untuk
                        expand)</span>
                </div>
            </div>
            <div class="header-actions" style="display: flex; gap: 10px;">
                <button type="button" class="btn-collapse"
                    style="background: transparent; border: none; color: #64748b; cursor: pointer;" title="Minimize">
                    <i class="fas fa-chevron-up transition-transform"></i>
                </button>
                <button type="button" class="btn-remove-item" onclick="removeItem(this); event.stopPropagation();"
                    style="background: white; border: 1px solid #fecaca; color: #ef4444; cursor: pointer; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 6px; transition: all 0.2s;">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body collapsible-content" style="padding: 25px;">

            <!-- 1. Basic Info -->
            <div style="margin-bottom: 25px;">
                <h3
                    style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                    <i class="fas fa-info-circle" style="color: var(--primary-color); margin-right: 8px;"></i>
                    1. Informasi Dasar
                </h3>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Proses Bisnis <span class="required">*</span></label>
                        @if($probis->count() == 1)
                            <input type="text" class="form-control" value="{{ $probis->first()->nama_probis }}" readonly
                                style="background-color: #f3f4f6; color: #6b7280; font-weight: 600;">
                            <input type="hidden" class="probis-input" name="items[{index}][kolom2_proses]"
                                value="{{ $probis->first()->nama_probis }}">
                        @else
                            <select class="form-control probis-input" name="items[{index}][kolom2_proses]" required>
                                <option value="">-- Pilih Proses Bisnis --</option>
                                @foreach($probis as $p)
                                    <option value="{{ $p->nama_probis }}">{{ $p->nama_probis }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">Lainnya / Kegiatan / Aset</label>
                        <input type="text" class="form-control item-kegiatan-input"
                            name="items[{index}][kolom2_kegiatan]" required placeholder="Contoh: Pengelasan Pipa..."
                            oninput="updateSummary(this)"
                            value="{{ old('items.' . $index . '.kolom2_kegiatan', $item->kolom2_kegiatan ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Lokasi <span class="required">*</span></label>
                        <input type="text" class="form-control" name="items[{index}][kolom3_lokasi]" required
                            placeholder="Contoh: Area Workshop..."
                            value="{{ old('items.' . $index . '.kolom3_lokasi', $item->kolom3_lokasi ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kategori <span class="required">*</span></label>
                        <select class="form-control category-select" name="items[{index}][kategori]" required
                            onchange="updateConditions(this)">
                            <option value="">-- Pilih --</option>
                            @php $selCat = old('items.' . $index . '.kategori', $item->kategori ?? ''); @endphp
                            @if(in_array(Auth::user()->id_unit, [55, 56]) && Auth::user()->can_create_documents)
                                {{-- SHE/Security staff with create access: All categories --}}
                                <option value="K3" {{ $selCat == 'K3' ? 'selected' : '' }}>K3 - Kesehatan & Keselamatan
                                </option>
                                <option value="KO" {{ $selCat == 'KO' ? 'selected' : '' }}>KO - Keselamatan Operasional
                                </option>
                                <option value="Lingkungan" {{ $selCat == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                <option value="Keamanan" {{ $selCat == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                            @elseif(Auth::user()->id_unit == 55)
                                {{-- Security Unit without create access: Only Keamanan --}}
                                <option value="Keamanan" {{ $selCat == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                            @elseif(Auth::user()->id_unit == 56)
                                {{-- SHE Unit without create access: Only K3, KO, Lingkungan --}}
                                <option value="K3" {{ $selCat == 'K3' ? 'selected' : '' }}>K3 - Kesehatan & Keselamatan
                                </option>
                                <option value="KO" {{ $selCat == 'KO' ? 'selected' : '' }}>KO - Keselamatan Operasional
                                </option>
                                <option value="Lingkungan" {{ $selCat == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                            @else
                                {{-- Other Units: All categories --}}
                                <option value="K3" {{ $selCat == 'K3' ? 'selected' : '' }}>K3 - Kesehatan & Keselamatan
                                </option>
                                <option value="KO" {{ $selCat == 'KO' ? 'selected' : '' }}>KO - Keselamatan Operasional
                                </option>
                                <option value="Lingkungan" {{ $selCat == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                <option value="Keamanan" {{ $selCat == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kondisi <span class="required">*</span></label>
                        <select class="form-control condition-select" name="items[{index}][kolom5_kondisi]" required
                            disabled
                            data-selected="{{ old('items.' . $index . '.kolom5_kondisi', $item->kolom5_kondisi ?? '') }}">
                            <option value="">-- Pilih Kategori Dulu --</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- 2. Identifikasi (Bahaya/Aspek/Ancaman) -->
            <div class="bagian-2-container" style="margin-bottom: 25px; display: none;">
                <h3
                    style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                    <i class="fas fa-exclamation-triangle" style="color: #f59e0b; margin-right: 8px;"></i>
                    BAGIAN 2: Identifikasi
                </h3>

                <!-- Column 6: POTENSI BAHAYA (K3/KO) -->
                <div class="hazard-section k3-ko-field" data-category="K3,KO"
                    style="background: #fffbeb; padding: 20px; border-radius: 8px; border: 1px solid #fcd34d; margin-bottom: 15px;">
                    <label class="form-label" style="font-weight: 600;">
                        <i class="fas fa-hard-hat" style="color: #f59e0b;"></i>
                        Kolom 6: POTENSI BAHAYA (K3)
                    </label>
                    <div class="hazard-options checkbox-grid"
                        style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
                        @php $bahayaChecked = old('items.' . $index . '.kolom6_bahaya', $item->kolom6_bahaya['details'] ?? $item->kolom6_bahaya ?? []); @endphp
                        <label class="checkbox-card"><input type="checkbox" name="items[{index}][kolom6_bahaya][]"
                                value="Bahaya Fisika" {{ in_array('Bahaya Fisika', $bahayaChecked) ? 'checked' : '' }}>
                            Bahaya
                            Fisika</label>
                        <label class="checkbox-card"><input type="checkbox" name="items[{index}][kolom6_bahaya][]"
                                value="Bahaya Kimia" {{ in_array('Bahaya Kimia', $bahayaChecked) ? 'checked' : '' }}>
                            Bahaya
                            Kimia</label>
                        <label class="checkbox-card"><input type="checkbox" name="items[{index}][kolom6_bahaya][]"
                                value="Bahaya Biologi" {{ in_array('Bahaya Biologi', $bahayaChecked) ? 'checked' : '' }}> Bahaya
                            Biologi</label>
                        <label class="checkbox-card"><input type="checkbox" name="items[{index}][kolom6_bahaya][]"
                                value="Bahaya Fisiologis/Ergonomi" {{ in_array('Bahaya Fisiologis/Ergonomi', $bahayaChecked) ? 'checked' : '' }}>
                            Bahaya Fisiologis/Ergonomi</label>
                        <label class="checkbox-card"><input type="checkbox" name="items[{index}][kolom6_bahaya][]"
                                value="Bahaya Psikologis" {{ in_array('Bahaya Psikologis', $bahayaChecked) ? 'checked' : '' }}> Bahaya
                            Psikologis</label>
                        <label class="checkbox-card"><input type="checkbox" name="items[{index}][kolom6_bahaya][]"
                                value="Bahaya dari Prilaku" {{ in_array('Bahaya dari Prilaku', $bahayaChecked) ? 'checked' : '' }}> Bahaya dari
                            Prilaku</label>
                    </div>
                    <div class="form-group mt-4">
                        <label class="form-label">Bahaya Lainnya (Manual)</label>
                        <input type="text" class="form-control bahaya-manual-input" name="items[{index}][bahaya_manual]"
                            placeholder="Deskripsi bahaya lain..."
                            value="{{ old('items.' . $index . '.bahaya_manual', $item->kolom6_bahaya['manual'] ?? '') }}">
                    </div>
                </div>

                <!-- Column 7: ASPEK LINGKUNGAN (Lingkungan) -->
                <div class="lingkungan-field" data-category="Lingkungan"
                    style="background: #ecfdf5; padding: 20px; border-radius: 8px; border: 1px solid #10b981; margin-bottom: 15px; display: none;">
                    <label class="form-label" style="font-weight: 600;">
                        <i class="fas fa-leaf" style="color: #10b981;"></i>
                        Kolom 7: ASPEK LINGKUNGAN
                    </label>
                    <div class="checkbox-grid" style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
                        @php $aspekChecked = old('items.' . $index . '.kolom7_aspek_lingkungan', $item->kolom7_aspek_lingkungan['details'] ?? $item->kolom7_aspek_lingkungan ?? []); @endphp
                        <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                name="items[{index}][kolom7_aspek_lingkungan][]" value="Emisi ke udara" {{ in_array('Emisi ke udara', $aspekChecked) ? 'checked' : '' }}>
                            Emisi ke udara</label>
                        <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                name="items[{index}][kolom7_aspek_lingkungan][]" value="Pembuangan ke air" {{ in_array('Pembuangan ke air', $aspekChecked) ? 'checked' : '' }}>
                            Pembuangan ke air</label>
                        <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                name="items[{index}][kolom7_aspek_lingkungan][]" value="Pembuangan ke tanah" {{ in_array('Pembuangan ke tanah', $aspekChecked) ? 'checked' : '' }}>
                            Pembuangan ke tanah</label>
                        <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                name="items[{index}][kolom7_aspek_lingkungan][]" value="Penggunaan Bahan Baku dan SDA"
                                {{ in_array('Penggunaan Bahan Baku dan SDA', $aspekChecked) ? 'checked' : '' }}>
                            Penggunaan Bahan Baku dan SDA</label>
                        <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                name="items[{index}][kolom7_aspek_lingkungan][]" value="Penggunaan energi" {{ in_array('Penggunaan energi', $aspekChecked) ? 'checked' : '' }}>
                            Penggunaan energi</label>
                        <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                name="items[{index}][kolom7_aspek_lingkungan][]" value="Paparan energi" {{ in_array('Paparan energi', $aspekChecked) ? 'checked' : '' }}>
                            Paparan energi</label>
                        <label class="checkbox-card"><input type="checkbox" class="aspek-lingkungan-checkbox"
                                name="items[{index}][kolom7_aspek_lingkungan][]" value="Limbah" {{ in_array('Limbah', $aspekChecked) ? 'checked' : '' }}>
                            Limbah</label>
                    </div>
                    <div class="form-group mt-4">
                        <label class="form-label">Aspek Lainnya (Manual)</label>
                        <input type="text" class="form-control aspects-manual-input" name="items[{index}][aspek_manual]"
                            placeholder="Deskripsi aspek lain..."
                            value="{{ old('items.' . $index . '.aspek_manual', $item->kolom7_aspek_lingkungan['manual'] ?? '') }}">
                    </div>
                </div>

                <!-- Column 8: ANCAMAN KEAMANAN (Keamanan) -->
                <div class="keamanan-field" data-category="Keamanan"
                    style="background: #fef2f2; padding: 20px; border-radius: 8px; border: 1px solid #ef4444; margin-bottom: 15px; display: none;">
                    <label class="form-label" style="font-weight: 600;">
                        <i class="fas fa-shield-alt" style="color: #ef4444;"></i>
                        Kolom 8: ANCAMAN KEAMANAN
                    </label>
                    <div class="checkbox-grid" style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
                        @php $ancamanChecked = old('items.' . $index . '.kolom8_ancaman', $item->kolom8_ancaman['details'] ?? $item->kolom8_ancaman ?? []); @endphp
                        <label class="checkbox-card"><input type="checkbox" class="ancaman-keamanan-checkbox"
                                name="items[{index}][kolom8_ancaman][]" value="Terorisme" {{ in_array('Terorisme', $ancamanChecked) ? 'checked' : '' }}> Terorisme</label>
                        <label class="checkbox-card"><input type="checkbox" class="ancaman-keamanan-checkbox"
                                name="items[{index}][kolom8_ancaman][]" value="Sabotase" {{ in_array('Sabotase', $ancamanChecked) ? 'checked' : '' }}> Sabotase</label>
                        <label class="checkbox-card"><input type="checkbox" class="ancaman-keamanan-checkbox"
                                name="items[{index}][kolom8_ancaman][]" value="Intimidasi" {{ in_array('Intimidasi', $ancamanChecked) ? 'checked' : '' }}> Intimidasi</label>
                        <label class="checkbox-card"><input type="checkbox" class="ancaman-keamanan-checkbox"
                                name="items[{index}][kolom8_ancaman][]" value="Pencurian" {{ in_array('Pencurian', $ancamanChecked) ? 'checked' : '' }}> Pencurian</label>
                        <label class="checkbox-card"><input type="checkbox" class="ancaman-keamanan-checkbox"
                                name="items[{index}][kolom8_ancaman][]" value="Perusakan aset" {{ in_array('Perusakan aset', $ancamanChecked) ? 'checked' : '' }}> Perusakan
                            aset</label>
                    </div>
                    <div class="form-group mt-4">
                        <label class="form-label">Ancaman Lainnya (Manual)</label>
                        <input type="text" class="form-control threats-manual-input"
                            name="items[{index}][ancaman_manual]" placeholder="Deskripsi ancaman lain..."
                            value="{{ old('items.' . $index . '.ancaman_manual', $item->kolom8_ancaman['manual'] ?? '') }}">
                    </div>
                </div>

                <!-- Column 9: RISIKO / DAMPAK / CELAH (3 separate fields based on category) -->
                <!-- Kolom 9a: RISIKO (K3/KO) -->
                <div class="form-group kolom9-k3ko-field" style="display: none;">
                    <label class="form-label">
                        Kolom 9: RISIKO <span class="required">*</span>
                    </label>
                    <textarea class="form-control" name="items[{index}][kolom9_risiko_k3ko]"
                        placeholder="Jelaskan risiko yang dapat terjadi dari bahaya yang teridentifikasi..."
                        rows="3">{{ old('items.' . $index . '.kolom9_risiko_k3ko', $item->kolom9_risiko_k3ko ?? '') }}</textarea>
                </div>

                <!-- Kolom 9b: DAMPAK LINGKUNGAN (Lingkungan) -->
                <div class="form-group kolom9-lingkungan-field" style="display: none;">
                    <label class="form-label">
                        Kolom 9: DAMPAK LINGKUNGAN <span class="required">*</span>
                    </label>
                    <textarea class="form-control" name="items[{index}][kolom9_dampak_lingkungan]"
                        placeholder="Jelaskan dampak lingkungan yang dapat terjadi dari aspek lingkungan yang teridentifikasi..."
                        rows="3">{{ old('items.' . $index . '.kolom9_dampak_lingkungan', $item->kolom9_dampak_lingkungan ?? '') }}</textarea>
                </div>

                <!-- Kolom 9c: CELAH TIDAK AMAN (Keamanan) -->
                <div class="form-group kolom9-keamanan-field" style="display: none;">
                    <label class="form-label">
                        Kolom 9: CELAH TIDAK AMAN <span class="required">*</span>
                    </label>
                    <textarea class="form-control" name="items[{index}][kolom9_celah_keamanan]"
                        placeholder="Jelaskan celah tidak aman yang dapat dieksploitasi dari ancaman yang teridentifikasi..."
                        rows="3">{{ old('items.' . $index . '.kolom9_celah_keamanan', $item->kolom9_celah_keamanan ?? '') }}</textarea>
                </div>

                <!-- Removed old Risk Analysis - now part of column 9 above -->

                <!-- 3. Pengendalian & Penilaian Risiko Saat Ini -->
                <div style="margin-bottom: 25px;">
                    <h3
                        style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                        <i class="fas fa-shield-alt" style="color: #10b981; margin-right: 8px;"></i>
                        BAGIAN 3: Pengendalian & Penilaian Risiko Saat Ini
                    </h3>

                    <!-- Columns 10-11: Pengendalian -->
                    <div class="form-group">
                        <label class="form-label">Kolom 10: Hirarki Pengendalian Risiko</label>
                        <div class="checkbox-grid hierarchy-checkboxes"
                            style="grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));">
                            <label class="checkbox-card"><input type="checkbox"
                                    name="items[{index}][kolom10_pengendalian][]" value="Eliminasi"
                                    onchange="updateKolom11(this)">
                                Eliminasi</label>
                            <label class="checkbox-card"><input type="checkbox"
                                    name="items[{index}][kolom10_pengendalian][]" value="Substitusi"
                                    onchange="updateKolom11(this)">
                                Substitusi</label>
                            <label class="checkbox-card"><input type="checkbox"
                                    name="items[{index}][kolom10_pengendalian][]" value="Rekayasa Teknik"
                                    onchange="updateKolom11(this)"> Rekayasa
                                Teknik</label>
                            <label class="checkbox-card"><input type="checkbox"
                                    name="items[{index}][kolom10_pengendalian][]" value="Pengendalian Administratif"
                                    onchange="updateKolom11(this)">
                                Pengendalian Administratif</label>
                            <label class="checkbox-card"><input type="checkbox"
                                    name="items[{index}][kolom10_pengendalian][]" value="APD"
                                    onchange="updateKolom11(this)"> APD</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kolom 11: Pengendalian yang Dilakukan <span
                                class="required">*</span></label>
                        <small style="display: block; margin-bottom: 12px; color: #64748b;">
                            <i class="fas fa-info-circle"></i> Tambahkan penjelasan detail untuk setiap hierarki
                            yang dipilih di atas.
                        </small>

                        <!-- Dynamic container for hierarchy sections -->
                        <div class="kolom11-dynamic-container" style="background: #f8fafc; 
                                            border: 2px solid #e2e8f0; 
                                            border-radius: 8px; 
                                            padding: 16px; 
                                            min-height: 200px;">
                            <!-- Empty state -->
                            <div class="empty-state" style="padding: 40px; text-align: center; color: #94a3b8;">
                                <i class="fas fa-hand-pointer"
                                    style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                                <p style="margin: 0;">Pilih hierarki pengendalian di atas untuk mulai mengisi
                                </p>
                            </div>
                        </div>

                        <!-- Hidden input to store combined data for submission -->
                        <input type="hidden" name="items[{index}][kolom11_existing]" class="kolom11-hidden-input">
                    </div>

                    <!-- Columns 12-14: Penilaian Risiko Awal (was section 4) -->
                    <div
                        style="background:#f8fafc; padding:20px; border-radius:12px; border:1px solid #e2e8f0; margin-top:20px;">
                        <h4
                            style="font-size:13px; font-weight:700; margin-bottom:15px; text-transform:uppercase; color:#334155;">
                            Kolom 12-14: Penilaian Risiko Awal (dengan Pengendalian yang Ada)</h4>
                        <div style="display: flex; gap: 20px; align-items: flex-start;">


                            <div style="flex:1; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div class="form-group">
                                    <label class="form-label">Kolom 12: Kemungkinan (Likelihood)</label>
                                    <select class="form-control likelihood-select"
                                        name="items[{index}][kolom12_kemungkinan]" required
                                        onchange="calculateItemRisk(this)">
                                        <option value="">-- Pilih --</option>
                                        <option value="1">1 - Sangat Jarang</option>
                                        <option value="2">2 - Jarang</option>
                                        <option value="3">3 - Kadang-kadang</option>
                                        <option value="4">4 - Sering</option>
                                        <option value="5">5 - Sangat Sering</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kolom 13: Konsekuensi (Severity)</label>
                                    <select class="form-control severity-select"
                                        name="items[{index}][kolom13_konsekuensi]" required
                                        onchange="calculateItemRisk(this)">
                                        <option value="">-- Pilih --</option>
                                        @php $sVal = old('items.' . $index . '.kolom13_konsekuensi', $item->kolom13_konsekuensi ?? ''); @endphp
                                        <option value="1" {{ $sVal == '1' ? 'selected' : '' }}>1 - Tidak Signifikan
                                        </option>
                                        <option value="2" {{ $sVal == '2' ? 'selected' : '' }}>2 - Minor</option>
                                        <option value="3" {{ $sVal == '3' ? 'selected' : '' }}>3 - Moderate</option>
                                        <option value="4" {{ $sVal == '4' ? 'selected' : '' }}>4 - Major</option>
                                        <option value="5" {{ $sVal == '5' ? 'selected' : '' }}>5 - Catastrophic</option>
                                    </select>
                                </div>
                            </div>
                            <div style="flex: 0 0 160px; text-align:center;">
                                <label class="form-label">Kolom 14: Tingkat Risiko</label>
                                <div class="risk-result-box"
                                    style="padding:15px; border-radius:8px; transition: background 0.3s; background: #e2e8f0; border: 1px solid #cbd5e1;">
                                    <div class="risk-score display-score" style="font-size: 24px;">
                                        {{ old('items.' . $index . '.kolom14_score', $item->kolom14_score ?? '-') }}</div>
                                    <span class="risk-level display-level"
                                        style="font-size: 11px;">{{ old('items.' . $index . '.kolom14_level', $item->kolom14_level ?? 'PENDING') }}</span>
                                </div>
                                <input type="hidden" name="items[{index}][kolom14_score]" class="input-score"
                                    value="{{ old('items.' . $index . '.kolom14_score', $item->kolom14_score ?? '') }}">
                                <input type="hidden" name="items[{index}][kolom14_level]" class="input-level"
                                    value="{{ old('items.' . $index . '.kolom14_level', $item->kolom14_level ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Legalitas & Signifikansi -->
                <div style="margin-bottom: 25px;">
                    <h3
                        style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                        <i class="fas fa-gavel" style="color: #8b5cf6; margin-right: 8px;"></i>
                        BAGIAN 4: Legalitas & Signifikansi
                    </h3>

                    <!-- Column 15: Peraturan -->
                    <div class="form-group">
                        <label class="form-label">Kolom 15: Peraturan Perundangan Terkait</label>
                        <textarea class="form-control" name="items[{index}][kolom15_regulasi]" rows="2"
                            placeholder="Referensi UU, PP, Permenaker, atau standar lain yang relevan...">{{ old('items.' . $index . '.kolom15_regulasi', $item->kolom15_regulasi ?? '') }}</textarea>
                    </div>

                    <!-- Column 16: ASPEK LINGKUNGAN PENTING (only for Lingkungan category) -->
                    <div class="form-group lingkungan-only-field" style="display: none;">
                        <label class="form-label">Kolom 16: Aspek Lingkungan Penting P/TP</label>
                        <div style="display:flex; gap:15px; margin-top:10px;">
                            <label class="control-radio"
                                style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="radio" name="items[{index}][kolom16_aspek]" value="P"
                                    style="cursor: pointer;" {{ old('items.' . $index . '.kolom16_aspek', $item->kolom16_aspek ?? '') == 'P' ? 'checked' : '' }}>
                                <span>Penting (P)</span>
                            </label>
                            <label class="control-radio"
                                style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="radio" name="items[{index}][kolom16_aspek]" value="TP"
                                    style="cursor: pointer;" {{ old('items.' . $index . '.kolom16_aspek', $item->kolom16_aspek ?? 'TP') == 'TP' ? 'checked' : '' }}>
                                <span>Tidak Penting (TP)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Column 17: Peluang & Risiko -->
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Kolom 17: Peluang</label>
                            <textarea class="form-control" name="items[{index}][kolom17_peluang]" rows="2"
                                placeholder="Jika ada peluang perbaikan atau inovasi...">{{ old('items.' . $index . '.kolom17_peluang', $item->kolom17_peluang ?? '') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kolom 17: Risiko</label>
                            <textarea class="form-control" name="items[{index}][kolom17_risiko]" rows="2"
                                placeholder="Jika ada risiko tambahan yang belum tercover...">{{ old('items.' . $index . '.kolom17_risiko', $item->kolom17_risiko ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 5. PUK/PMK Program Management -->
                <div class="bagian-5-section">
                    <h3
                        style="font-size:14px; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; color:#475569; margin-bottom:15px; border-bottom:2px solid #e2e8f0; padding-bottom:8px;">
                        <i class="fas fa-check-double" style="color: #15803d; margin-right: 8px;"></i>
                        BAGIAN 5: Evaluasi & Program Pengendalian
                    </h3>
                    <div style="background:#f0fdf4; padding:20px; border-radius:12px; border:1px solid #bbf7d0;">

                        <!-- Column 18: Auto-Tolerance -->
                        <div class="form-group">
                            <label class="form-label">Kolom 18: Risiko Dapat Ditoleransi?</label>
                            <div class="tolerance-display"
                                style="background: white; padding: 16px; border-radius: 8px; border: 2px solid #cbd5e1;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div class="tolerance-icon"
                                        style="width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                        <i class="fas fa-spinner"></i>
                                    </div>
                                    <div style="flex: 1;">
                                        <div class="tolerance-value"
                                            style="font-size: 18px; font-weight: 700; margin-bottom: 4px;">
                                            Menunggu Penilaian Risiko
                                        </div>
                                        <div class="tolerance-reason" style="font-size: 12px; color: #64748b;">
                                            Hitung risiko di Kolom 12-14 untuk menentukan toleransi
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="items[{index}][kolom18_toleransi]" class="tolerance-input">
                            <input type="hidden" name="items[{index}][kolom18_auto]" class="tolerance-auto" value="1">
                        </div>

                        <!-- Column 19: Program Title (conditional) -->
                        <div class="kolom19-section" style="display:none; margin-top: 20px;">
                            <div class="form-group">
                                <label class="form-label">
                                    Kolom 19: Rencana Pengendalian Tindak Lanjut <span class="required">*</span>
                                </label>
                                <textarea class="form-control kolom19-input" name="items[{index}][kolom19_rencana]"
                                    rows="3"
                                    placeholder="Masukkan rencana pengendalian yang akan menjadi judul program PUK/PMK..."></textarea>
                                <small style="display: block; margin-top: 6px; color: #64748b;">
                                    <i class="fas fa-info-circle"></i> Ini akan menjadi judul Program PUK/PMK
                                </small>
                            </div>
                        </div>

                        <!-- Column 20-22: Risiko Setelah Pengendalian Tindak Lanjut (Moved Here) -->
                        <div class="risk-after-control-section" style="display:none; margin-top: 25px;">
                            <div
                                style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); padding: 20px; border-radius: 12px; border: 2px solid #93c5fd; margin-bottom: 20px;">
                                <h4 style="color: #1e40af; margin-bottom: 15px; font-size: 15px; font-weight: 700;">
                                    <i class="fas fa-chart-line"></i> Risiko Setelah Pengendalian Tindak Lanjut
                                </h4>

                                <div style="display: flex; gap: 20px; align-items: flex-start;">
                                    <div style="flex:1; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                        <div class="form-group">
                                            <label class="form-label">Kolom 20: L (Likelihood)</label>
                                            <select class="form-control likelihood-select-after"
                                                name="items[{index}][kolom20_kemungkinan_lanjut]"
                                                onchange="calculateRiskAfterControl(this)">
                                                <option value="">-- Pilih --</option>
                                                <option value="1">1 - Sangat Jarang</option>
                                                <option value="2">2 - Jarang</option>
                                                <option value="3">3 - Kadang-kadang</option>
                                                <option value="4">4 - Sering</option>
                                                <option value="5">5 - Sangat Sering</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kolom 21: S (Severity)</label>
                                            <select class="form-control severity-select-after"
                                                name="items[{index}][kolom21_konsekuensi_lanjut]"
                                                onchange="calculateRiskAfterControl(this)">
                                                <option value="">-- Pilih --</option>
                                                <option value="1">1 - Tidak Signifikan</option>
                                                <option value="2">2 - Minor</option>
                                                <option value="3">3 - Moderate</option>
                                                <option value="4">4 - Major</option>
                                                <option value="5">5 - Catastrophic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="flex: 0 0 160px; text-align:center;">
                                        <label class="form-label">Kolom 22: Level</label>
                                        <div class="risk-result-box-after"
                                            style="padding:15px; border-radius:8px; transition: background 0.3s; background: #e2e8f0; border: 1px solid #cbd5e1;">
                                            <div class="risk-score-after"
                                                style="font-size: 24px; font-weight: 800; color: #64748b;">
                                                {{ old('items.' . $index . '.residual_score', $item->residual_score ?? '-') }}
                                            </div>
                                            <span class="risk-level-after"
                                                style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b;">{{ old('items.' . $index . '.residual_level', $item->residual_level ?? 'PENDING') }}</span>
                                        </div>
                                        <!-- Hidden inputs for columns 20, 21, 22 are already named correctly in selects/logic -->
                                        <input type="hidden" name="items[{index}][kolom22_tingkat_risiko_lanjut]"
                                            class="input-score-after"
                                            value="{{ old('items.' . $index . '.residual_score', $item->residual_score ?? '') }}">
                                        <input type="hidden" name="items[{index}][kolom22_level_lanjut]"
                                            class="input-level-after"
                                            value="{{ old('items.' . $index . '.residual_level', $item->residual_level ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Metadata -->
                        <input type="hidden" id="user_unit_name" value="{{ $user->unit->nama_unit ?? '' }}">

                        <!-- PUK/PMK Program Section (conditional) -->
                        <div class="program-section" style="display:none; margin-top: 25px;">
                            <div
                                style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); padding: 20px; border-radius: 12px; border: 2px solid #fbbf24; margin-bottom: 20px;">
                                <h4 style="color: #92400e; margin-bottom: 15px; font-size: 15px; font-weight: 700;">
                                    <i class="fas fa-clipboard-list"></i> Program Pengendalian Lanjutan
                                    Diperlukan
                                </h4>

                                <div class="form-group">
                                    <label class="form-label">Pilih Jenis Program <span
                                            class="required">*</span></label>
                                    <select class="form-control program-type-select"
                                        name="items[{index}][kolom19_program_type]">
                                        <option value="">-- Pilih Program --</option>
                                        @php $pTyp = old('items.' . $index . '.kolom19_program_type', $item->kolom19_program_type ?? ''); @endphp
                                        <option value="PUK" class="option-puk" {{ $pTyp == 'PUK' ? 'selected' : '' }}>PUK
                                            - Program Unit Kerja</option>
                                        <option value="PMK" class="option-pmk" {{ $pTyp == 'PMK' ? 'selected' : '' }}>PMK
                                            - Program Manajemen Korporat
                                        </option>
                                    </select>
                                    <small style="display: block; margin-top: 8px; color: #78350f;">
                                        <strong>PUK:</strong> Risiko dapat ditangani di level unit<br>
                                        <strong>PMK:</strong> Memerlukan keputusan/budget dari Direksi
                                    </small>
                                </div>
                            </div>

                            <!-- PUK/PMK Form Container (shown when type selected) -->
                            <div class="program-form-container" style="display:none;"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>