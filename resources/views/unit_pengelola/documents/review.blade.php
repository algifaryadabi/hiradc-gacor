<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Document - HIRADC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin:0; padding:0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #fff; height: 100vh; display: flex; flex-direction: column; overflow: hidden; }

        /* Top Nav */
        .top-nav { height: 60px; border-bottom: 1px solid #eee; display: flex; align-items: center; padding: 0 30px; background: white; justify-content: space-between; position: relative; z-index: 10; }
        .back-link { text-decoration: none; color: #555; font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 8px; }
        .page-title { font-weight: 700; font-size: 16px; color: #333; position: absolute; left: 50%; transform: translateX(-50%); }

        .main-container { flex: 1; display: flex; overflow: hidden; }

        /* LEFT PANEL */
        .left-panel { width: 45%; border-right: 1px solid #ddd; overflow-y: auto; padding: 40px; }
        .panel-header { margin-bottom: 30px; }
        .panel-header h2 { font-size: 22px; color: #c41e3a; font-weight: 700; margin-bottom: 5px; }
        .panel-header p { font-size: 12px; color: #666; font-style: italic; }

        .section-title { font-size: 14px; font-weight: 700; color: #c41e3a; margin-top: 30px; margin-bottom: 15px; }
        .field-group { margin-bottom: 20px; }
        .field-label { font-size: 11px; font-weight: 700; color: #888; text-transform: uppercase; margin-bottom: 6px; }
        .field-value { background: #f9f9f9; padding: 12px; border-radius: 6px; font-size: 14px; color: #333; font-weight: 500; border: 1px solid #eee; }

        /* RIGHT PANEL */
        .right-panel { width: 55%; overflow-y: auto; padding: 40px; background: #fff; }
        .right-header h2 { font-size: 22px; color: #333; font-weight: 700; margin-bottom: 20px; }

        .table-container { border: 1px solid #eee; border-radius: 8px; overflow: hidden; margin-top: 10px; }
        .table-head { background: #c41e3a; color: white; padding: 12px 20px; font-weight: 600; font-size: 14px; }
        
        .verify-table { width: 100%; border-collapse: collapse; }
        .verify-table th { background: #f9f9f9; color: #555; font-size: 11px; font-weight: 700; padding: 15px 20px; text-align: left; border-bottom: 1px solid #eee; text-transform: uppercase; }
        .verify-table td { padding: 15px 20px; border-bottom: 1px solid #eee; font-size: 14px; vertical-align: middle; }
        .verify-table tr:last-child td { border-bottom: none; }

        /* Form Controls */
        .select-status { padding: 8px; border-radius: 6px; border: 1px solid #ccc; font-size: 13px; width: 100%; font-weight: 500; cursor: pointer; }
        .select-status.ok { border-color: #2e7d32; color: #2e7d32; background: #e8f5e9; }
        .select-status.nok { border-color: #c62828; color: #c62828; background: #ffebee; }

        .input-ket { width: 100%; border: 1px solid #eee; background: #f9f9f9; border-radius: 6px; padding: 8px; font-size: 13px; resize: vertical; min-height: 40px; transition: all 0.2s;}
        .input-ket:disabled { color: #aaa; cursor: not-allowed; }
        .input-ket.required { background: white; border-color: #c62828; }

        /* Footer */
        .footer-action { height: 80px; border-top: 1px solid #eee; display: flex; justify-content: flex-end; align-items: center; padding: 0 40px; gap: 15px; position: absolute; bottom: 0; width: 100%; background: white; z-index: 20; }
        .btn { padding: 12px 24px; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 14px; border: 1px solid transparent; text-decoration: none; display: inline-block; }
        .btn-outline { border-color: #ddd; color: #555; background: white; }
        .btn-outline:hover { background: #f5f5f5; }
        .btn-primary { background: #2e7d32; color: white; }
        .btn-primary:hover { background: #1b5e20; }

        /* Scroll padding for footer */
        .right-panel { padding-bottom: 100px; } 
    </style>
</head>
<body>

    <nav class="top-nav">
        <a href="{{ route('unit_pengelola.dashboard') }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="page-title">Verifikasi Dokumen: Penilaian Risiko Unit A</div>
        <div></div>
    </nav>

    <div class="main-container">
        <!-- LEFT: FORM DATA -->
        <div class="left-panel">
            <div class="panel-header">
                <h2>Detail Formulir HIRADC</h2>
                <p>Data ini bersifat read-only (tidak dapat diubah) sesuai dokumen yang disetujui Kepala Unit Kerja.</p>
            </div>

            <!-- 1. Informasi Kegiatan -->
            <div class="section-title">1. Informasi Kegiatan</div>
            <div class="field-group"><div class="field-label">Kegiatan Utama (Kolom 1)</div><div class="field-value">Pengoperasian Mesin Produksi A</div></div>
            <div class="field-group"><div class="field-label">Sub Kegiatan (Kolom 2)</div><div class="field-value">Persiapan dan Startup Mesin</div></div>
            <div class="field-group"><div class="field-label">Kondisi (R/NR/N/E) (Kolom 3)</div><div class="field-value">R (Rutin)</div></div>

            <!-- 2. Identifikasi Bahaya -->
            <div class="section-title">2. Identifikasi Bahaya & Dampak</div>
            <div class="field-group"><div class="field-label">Bahaya / Aspek (Kolom 4)</div><div class="field-value">Terjepit bagian mesin yang berputar saat setting awal</div></div>
            <div class="field-group"><div class="field-label">Konsekuensi / Dampak (Kolom 5)</div><div class="field-value">Cedera tangan, amputasi jari, pendarahan</div></div>
            
            <!-- More Simulation -->
             <div class="section-title">3. Penilaian Risiko</div>
             <div class="field-group"><div class="field-label">Tingkat Risiko (Kolom 10)</div><div class="field-value" style="color:red; font-weight:700;">12 (HIGH)</div></div>
             
             <div class="section-title">4. Pengesahan</div>
            <div class="field-group"><div class="field-label">Approval Dokumen (Kolom 22)</div><div class="field-value">Approved by Kepala Unit Kerja</div></div>
            
            <!-- HISTORY SECTION -->
            <div style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 20px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                    <i class="fas fa-history" style="color: #555;"></i>
                    <h3 style="font-size: 16px; font-weight: 700; color: #333; margin: 0;">Riwayat Aktivitas Dokumen</h3>
                </div>
                
                <div class="timeline">
                    <!-- Item 1 -->
                    <div class="timeline-item">
                        <div class="timeline-icon bg-blue"><i class="fas fa-paper-plane"></i></div>
                        <div class="timeline-content">
                            <div class="time">18 Okt 2025, 09:30 WIB</div>
                            <div class="actor">John Doe (Staff Unit Kerja)</div>
                            <div class="msg">Mengirimkan dokumen baru untuk direview.</div>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="timeline-item">
                        <div class="timeline-icon bg-orange"><i class="fas fa-undo"></i></div>
                        <div class="timeline-content">
                            <div class="time">19 Okt 2025, 10:15 WIB</div>
                            <div class="actor">Budi Santoso (Kepala Unit Kerja)</div>
                            <div class="status-badge rev">Status: Revisi</div>
                            <div class="msg">"Mohon lengkapi bagian identifikasi bahaya, kurang spesifik."</div>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="timeline-item">
                        <div class="timeline-icon bg-blue"><i class="fas fa-edit"></i></div>
                        <div class="timeline-content">
                            <div class="time">20 Okt 2025, 08:00 WIB</div>
                            <div class="actor">John Doe (Staff Unit Kerja)</div>
                            <div class="msg">Melakukan perbaikan pada Kolom 6 dan mengirim ulang.</div>
                        </div>
                    </div>
                     <!-- Item 4 -->
                    <div class="timeline-item">
                        <div class="timeline-icon bg-green"><i class="fas fa-check"></i></div>
                        <div class="timeline-content">
                            <div class="time">20 Okt 2025, 14:00 WIB</div>
                            <div class="actor">Budi Santoso (Kepala Unit Kerja)</div>
                            <div class="status-badge app">Status: Disetujui</div>
                            <div class="msg">Menyetujui dokumen. Meneruskan ke Unit Pengelola.</div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .timeline { display: flex; flex-direction: column; gap: 20px; }
                .timeline-item { display: flex; gap: 15px; position: relative; }
                .timeline-item:not(:last-child)::after { content: ''; position: absolute; left: 18px; top: 40px; bottom: -20px; width: 2px; background: #f0f0f0; }
                .timeline-icon { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0; font-size: 14px; position: relative; z-index: 2; }
                .bg-blue { background: #2196f3; }
                .bg-orange { background: #ff9800; }
                .bg-green { background: #4caf50; }
                .timeline-content { flex: 1; background: #fcfcfc; border: 1px solid #f0f0f0; padding: 15px; border-radius: 8px; }
                .timeline-content .actor { font-weight: 700; font-size: 13px; color: #333; margin-bottom: 4px; }
                .timeline-content .time { font-size: 11px; color: #999; float: right; }
                .timeline-content .msg { font-size: 13px; color: #555; line-height: 1.4; }
                .status-badge { display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 600; margin-bottom: 6px; }
                .status-badge.rev { background: #fff3e0; color: #ef6c00; }
                .status-badge.app { background: #e8f5e9; color: #2e7d32; }
            </style>
        </div>

        <!-- RIGHT: VERIFICATION TABLE -->
        <div class="right-panel">
            <div class="right-header">
                <h2>Verifikasi Kesesuaian</h2>
            </div>
            
            <div class="table-container">
                <div class="table-head">Checklist Kesesuaian Dokumen</div>
                <table class="verify-table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="35%">Kriteria</th>
                            <th width="30%">Kesesuaian</th>
                            <th width="30%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 1 -->
                        <tr>
                            <td>1</td>
                            <td>Standart Format</td>
                            <td>
                                <select class="select-status" onchange="updateRow(this, 1)">
                                    <option value="">Pilih...</option>
                                    <option value="OK">OK (Sesuai)</option>
                                    <option value="NOK">NOK (Tidak Sesuai)</option>
                                    <option value="INCOMPLETE">Tidak Lengkap</option>
                                </select>
                            </td>
                            <td><textarea id="ket-1" class="input-ket" rows="1" disabled placeholder="Wajib diisi..."></textarea></td>
                        </tr>
                        <!-- 2 -->
                        <tr>
                            <td>2</td>
                            <td>Sumber Format</td>
                            <td>
                                <select class="select-status" onchange="updateRow(this, 2)">
                                    <option value="">Pilih...</option>
                                    <option value="OK">OK (Sesuai)</option>
                                    <option value="NOK">NOK (Tidak Sesuai)</option>
                                    <option value="INCOMPLETE">Tidak Lengkap</option>
                                </select>
                            </td>
                            <td><textarea id="ket-2" class="input-ket" rows="1" disabled placeholder="Wajib diisi..."></textarea></td>
                        </tr>
                        <!-- 3 -->
                        <tr>
                            <td>3</td>
                            <td>Penamaan Dokumen</td>
                            <td>
                                <select class="select-status" onchange="updateRow(this, 3)">
                                    <option value="">Pilih...</option>
                                    <option value="OK">OK (Sesuai)</option>
                                    <option value="NOK">NOK (Tidak Sesuai)</option>
                                    <option value="INCOMPLETE">Tidak Lengkap</option>
                                </select>
                            </td>
                            <td><textarea id="ket-3" class="input-ket" rows="1" disabled placeholder="Wajib diisi..."></textarea></td>
                        </tr>
                        <!-- 4 -->
                        <tr>
                            <td>4</td>
                            <td>Kemutakhiran Nomor Revisi</td>
                            <td>
                                <select class="select-status" onchange="updateRow(this, 4)">
                                    <option value="">Pilih...</option>
                                    <option value="OK">OK (Sesuai)</option>
                                    <option value="NOK">NOK (Tidak Sesuai)</option>
                                    <option value="INCOMPLETE">Tidak Lengkap</option>
                                </select>
                            </td>
                            <td><textarea id="ket-4" class="input-ket" rows="1" disabled placeholder="Wajib diisi..."></textarea></td>
                        </tr>
                        <!-- 5 -->
                        <tr>
                            <td>5</td>
                            <td>Approval Dokumen</td>
                            <td>
                                <select class="select-status" onchange="updateRow(this, 5)">
                                    <option value="">Pilih...</option>
                                    <option value="OK">OK (Sesuai)</option>
                                    <option value="NOK">NOK (Tidak Sesuai)</option>
                                    <option value="INCOMPLETE">Tidak Lengkap</option>
                                </select>
                            </td>
                            <td><textarea id="ket-5" class="input-ket" rows="1" disabled placeholder="Wajib diisi..."></textarea></td>
                        </tr>
                        <!-- 6 -->
                        <tr>
                            <td>6</td>
                            <td>Identifikasi Proses Bisnis / Aset</td>
                            <td>
                                <select class="select-status" onchange="updateRow(this, 6)">
                                    <option value="">Pilih...</option>
                                    <option value="OK">OK (Sesuai)</option>
                                    <option value="NOK">NOK (Tidak Sesuai)</option>
                                    <option value="INCOMPLETE">Tidak Lengkap</option>
                                </select>
                            </td>
                            <td><textarea id="ket-6" class="input-ket" rows="1" disabled placeholder="Wajib diisi..."></textarea></td>
                        </tr>
                        <!-- 7 -->
                        <tr>
                            <td>7</td>
                            <td>Kesesuaian Program Mitigasi</td>
                            <td>
                                <select class="select-status" onchange="updateRow(this, 7)">
                                    <option value="">Pilih...</option>
                                    <option value="OK">OK (Sesuai)</option>
                                    <option value="NOK">NOK (Tidak Sesuai)</option>
                                    <option value="INCOMPLETE">Tidak Lengkap</option>
                                </select>
                            </td>
                            <td><textarea id="ket-7" class="input-ket" rows="1" disabled placeholder="Wajib diisi..."></textarea></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- FIXED FOOTER -->
    <div class="footer-action">
        <button class="btn btn-outline" onclick="returnToApprover()">Kembalikan (Perlu Revisi)</button>
        <button class="btn btn-primary" onclick="approveDocument()">Disetujui</button>
    </div>

    <script>
        function updateRow(select, id) {
            const val = select.value;
            const textInput = document.getElementById('ket-' + id);
            
            // Visual Update
            select.className = 'select-status'; // reset
            if(val === 'OK') select.classList.add('ok');
            if(val === 'NOK' || val === 'INCOMPLETE') select.classList.add('nok');

            // Logic Update
            if (val === 'NOK' || val === 'INCOMPLETE') {
                textInput.disabled = false;
                textInput.classList.add('required');
                textInput.focus();
            } else {
                textInput.disabled = true;
                textInput.value = '';
                textInput.classList.remove('required');
            }
        }

        function returnToApprover() {
            // Optional: Check if any item is marked as NOK/INCOMPLETE
            // const nokItems = document.querySelectorAll('.select-status.nok').length;
            // if (nokItems === 0) {
            //     if(!confirm('Tidak ada item yang ditandai NOK/Tidak Lengkap. Tetap ingin mengembalikan?')) return;
            // }

            if(confirm('Apakah Anda yakin ingin mengembalikan dokumen ini ke KEPALA UNIT KERJA untuk diperbaiki?')) {
                alert('↩️ Dokumen berhasil dikembalikan ke Kepala Unit Kerja.\nStatus diubah menjadi: Perlu Perbaikan (Unit Pengelola).');
                window.location.href = "{{ route('unit_pengelola.check_documents') }}";
            }
        }

        function approveDocument() {
            // Check if all items are OK?
            // For now, just confirm
            if(confirm('Apakah Anda yakin dokumen ini sudah sesuai dan siap diteruskan ke KEPALA DEPARTEMEN?')) {
                alert('✅ Dokumen Disetujui!\nDokumen telah diteruskan ke Kepala Departemen untuk validasi akhir.');
                window.location.href = "{{ route('unit_pengelola.check_documents') }}";
            }
        }
    </script>
</body>
</html>