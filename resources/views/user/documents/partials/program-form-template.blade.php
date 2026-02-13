<div class="program-form"
    style="background: white; padding: 25px; border-radius: 12px; border: 2px solid #e5e7eb; margin-top: 20px;">
    <h5 class="program-form-title"
        style="color: #1e40af; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #dbeafe; font-size: 14px; font-weight: 700;">
    </h5>

    <!-- 1. Judul (Auto-filled from Kolom 19) -->
    <div class="form-group">
        <label class="form-label">1. Judul Program <span class="required">*</span></label>
        <input type="text" class="form-control program-judul" readonly style="background: #f3f4f6; font-weight: 600;">
        <small class="text-muted">
            <i class="fas fa-link"></i> Diisi otomatis dari Kolom 19
        </small>
    </div>

    <!-- 2. Tujuan -->
    <div class="form-group">
        <label class="form-label">2. Tujuan <span class="required">*</span></label>
        <textarea class="form-control program-field" name="items[{index}][program_tujuan]" rows="3" required
            placeholder="Menjelaskan tujuan Program dan target pengurangan dampak..."></textarea>
        <small class="text-muted">Detail tentang tujuan program dan target yang ingin dicapai</small>
    </div>

    <!-- 3. Sasaran -->
    <div class="form-group">
        <label class="form-label">3. Sasaran <span class="required">*</span></label>
        <textarea class="form-control program-field" name="items[{index}][program_sasaran]" rows="3" required
            placeholder="Menjelaskan sasaran, tahapan pelaksanaan, dan target program..."></textarea>
        <small class="text-muted">Sasaran konkret, tahapan (tahun), dan target terukur</small>
    </div>

    <!-- 4. Penanggung Jawab -->
    <div class="form-group">
        <label class="form-label">4. Penanggung Jawab <span class="required">*</span></label>
        <input type="text" class="form-control program-field program-pj" name="items[{index}][program_penanggung_jawab]"
            required readonly style="background-color: #f8fafc; color: #64748b; cursor: not-allowed;">
        <small class="text-muted">Unit kerja yang bertanggung jawab atas program ini (Auto-filled)</small>
    </div>

    <!-- 5. Uraian Revisi -->
    <div class="form-group">
        <label class="form-label">5. Uraian Revisi <span class="program-type-label"></span></label>
        <textarea class="form-control program-field" name="items[{index}][program_uraian_revisi]" rows="3"
            placeholder="Revisi program, kendala, kajian (opsional jika program lanjutan)"></textarea>
        <small class="text-muted">Jika program lanjutan, jelaskan revisi, kendala, dan kajiannya</small>
    </div>

    <!-- 6. Program Kerja Table -->
    <div class="form-group">
        <label class="form-label" style="display: block; margin-bottom: 10px;">6. Program Kerja <span
                class="required">*</span></label>
        <div class="program-kerja-scroll"
            style="overflow-x: auto; overflow-y: visible; max-width: 100%; border: 1px solid #e2e8f0; border-radius: 8px; background: white;">
            <table class="table program-kerja-table table-bordered"
                style="margin-bottom: 0; min-width: 1400px; width: max-content;">
                <thead>
                    <tr style="background: #5c7cfa; color: white; font-size: 12px; font-weight: 600;">
                        <th rowspan="2"
                            style="width: 40px; text-align: center; vertical-align: middle; padding: 6px; border-color: #4c6ef5;">
                            No</th>
                        <th rowspan="2"
                            style="min-width: 150px; vertical-align: middle; padding: 6px; border-color: #4c6ef5;">
                            Uraian Kegiatan</th>
                        <th rowspan="2" class="col-koordinator"
                            style="min-width: 140px; vertical-align: middle; padding: 6px; border-color: #4c6ef5;">
                            Koordinator</th>
                        <th rowspan="2" class="col-pelaksana"
                            style="min-width: 140px; vertical-align: middle; padding: 6px; border-color: #4c6ef5;">
                            Pelaksana</th>
                        <th colspan="12" style="text-align: center; padding: 6px; border-color: #4c6ef5;">Target
                            (%)</th>
                        <th rowspan="2" class="col-anggaran"
                            style="min-width: 120px; vertical-align: middle; display: none; padding: 6px; border-color: #4c6ef5;">
                            Anggaran (Rp)</th>
                        <th rowspan="2"
                            style="width: 40px; text-align: center; vertical-align: middle; padding: 6px; border-color: #4c6ef5;">
                            Aksi</th>
                    </tr>
                    <tr style="background: #748ffc; color: white; font-size: 11px;">
                        <th
                            style="text-align: center; padding: 4px; width: 40px; min-width: 40px; border-color: #5c7cfa;">
                            1</th>
                        <th
                            style="text-align: center; padding: 4px; width: 40px; min-width: 40px; border-color: #5c7cfa;">
                            2</th>
                        <th
                            style="text-align: center; padding: 4px; width: 40px; min-width: 40px; border-color: #5c7cfa;">
                            3</th>
                        <th
                            style="text-align: center; padding: 4px; width: 40px; min-width: 40px; border-color: #5c7cfa;">
                            4</th>
                        <th
                            style="text-align: center; padding: 4px; width: 40px; min-width: 40px; border-color: #5c7cfa;">
                            5</th>
                        <th
                            style="text-align: center; padding: 4px; width: 40px; min-width: 40px; border-color: #5c7cfa;">
                            6</th>
                        <th
                            style="text-align: center; padding: 4px; width: 40px; min-width: 40px; border-color: #5c7cfa;">
                            7</th>
                        <th
                            style="text-align: center; padding: 4px; width: 40px; min-width: 40px; border-color: #5c7cfa;">
                            8</th>
                        <th
                            style="text-align: center; padding: 4px; width: 40px; min-width: 40px; border-color: #5c7cfa;">
                            9</th>
                        <th
                            style="text-align: center; padding: 4px; width: 40px; min-width: 40px; border-color: #5c7cfa;">
                            10</th>
                        <th
                            style="text-align: center; padding: 4px; width: 40px; min-width: 40px; border-color: #5c7cfa;">
                            11</th>
                        <th
                            style="text-align: center; padding: 4px; width: 40px; min-width: 40px; border-color: #5c7cfa;">
                            12</th>
                    </tr>
                </thead>
                <tbody class="program-kerja-tbody">
                    <!-- Rows will be added dynamically -->
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addProgramKerjaRow(this)"
            style="background: #6366f1; color: white; border: none; padding: 8px 16px; border-radius: 6px; font-size: 13px;">
            <i class="fas fa-plus"></i> Tambah Baris Program Kerja
        </button>
    </div>
</div>