<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program Kerja - {{ $document->judul_dokumen ?? 'Dokumen' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Shared Styles (Copied from show.blade.php to maintain consistency) */
        :root {
            --primary: #c41e3a;
            --primary-dark: #9a1829;
            --text-main: #0f172a;
            --text-sub: #64748b;
            --bg-body: #f1f5f9;
            --surface: #ffffff;
            --border: #e2e8f0;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            padding: 20px;
            padding-bottom: 100px; /* Space for fixed card */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--text-sub);
            font-weight: 600;
            background: white;
            padding: 10px 16px;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: #f8fafc;
            color: var(--text-main);
        }

        .program-card {
            background: var(--surface);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .program-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .program-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-revision {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .excel-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .excel-table th, .excel-table td {
            border: 1px solid #e2e8f0;
            padding: 8px 12px;
            vertical-align: middle;
        }

        .excel-table th {
            background: #f8fafc;
            font-weight: 600;
            text-align: left;
            color: #475569;
        }

        /* Editing Styles */
        .cell-content[contenteditable="true"] {
            background: #fff;
            border: 2px solid #3b82f6;
            padding: 4px;
            border-radius: 4px;
            outline: none;
            display: block;
            min-height: 20px;
        }

        .btn-edit {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-save {
            background: #10b981;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-cancel {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .action-group {
            display: flex;
            gap: 8px;
        }

        /* Revision Card Styles */
        .revision-card-container {
            position: fixed;
            bottom: 30px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            z-index: 100;
            pointer-events: none;
        }

        .revision-card {
            pointer-events: auto;
            background: white;
            padding: 12px 20px;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1px solid #e2e8f0;
            min-width: 600px;
            max-width: 90%;
        }

        .btn-action {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-draft {
            background: #f59e0b; /* Yellow warning */
            color: white;
        }
        .btn-draft:hover { background: #d97706; }

        .btn-submit-revision {
            background: #b91c1c; /* Red danger */
            color: white;
        }
        .btn-submit-revision:hover { background: #991b1b; }

        .note-input-wrapper {
            flex: 1;
            position: relative;
            display: flex;
            align-items: center;
        }

        .note-input {
            width: 100%;
            padding: 10px 16px;
            padding-right: 40px;
            border-radius: 99px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            outline: none;
            font-size: 14px;
            color: #334155;
            transition: all 0.2s;
        }

        .note-input:focus {
            border-color: #94a3b8;
            background: white;
            box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.1);
        }

        .note-icon {
            position: absolute;
            right: 16px;
            color: #94a3b8;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <div>
                <a href="{{ route('documents.show', $document->id) }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali ke Detail
                </a>
            </div>
            <div style="text-align: right;">
                <h1 style="font-size: 24px; font-weight: 800; margin: 0; color: var(--text-main);">Edit Program Kerja</h1>
                <p style="margin: 4px 0 0; color: var(--text-sub); font-size: 14px;">{{ $document->judul_dokumen ?? 'Dokumen Tanpa Judul' }}</p>
            </div>
        </div>

        @if(!$document->pukProgram && !$document->pmkProgram)
            <div style="text-align: center; padding: 40px; background: white; border-radius: 12px; border: 1px solid #e2e8f0;">
                <i class="fas fa-file-excel" style="font-size: 48px; color: #cbd5e1; margin-bottom: 16px;"></i>
                <h3 style="color: #64748b;">Tidak ada Program Kerja yang tersedia untuk dokumen ini.</h3>
            </div>
        @endif

        <!-- PUK SECTION -->
        @if($document->pukProgram)
            <div class="program-card">
                <div class="program-header" style="background: #fef2f2; border-bottom: 1px solid #fecaca;">
                    <div class="program-title" style="color: #b91c1c;">
                        <i class="fas fa-tasks"></i> Program Unit Kerja (PUK)
                        @if($document->pukProgram->status == 'revision')
                            <span class="badge badge-revision">Perlu Revisi</span>
                        @endif
                    </div>
                    <div class="action-group">
                        <button type="button" class="btn-edit" 
                            style="background: #dc2626;"
                            id="editBtn_puk_{{ $document->pukProgram->id }}"
                            onclick="enableEditMode('puk', {{ $document->pukProgram->id }})">
                            <i class="fas fa-edit"></i> Edit Tabel
                        </button>
                        
                        <div id="editActions_puk_{{ $document->pukProgram->id }}" style="display: none; gap: 8px;">
                            <button type="button" class="btn-cancel" onclick="cancelEdit('puk', {{ $document->pukProgram->id }})">
                                <i class="fas fa-times"></i> Batal
                            </button>
                            <button type="button" class="btn-save" onclick="saveProgram('puk', {{ $document->pukProgram->id }})">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="program-body" id="tableWrapper_puk_{{ $document->pukProgram->id }}" style="overflow-x: auto;">
                    <table class="excel-table" id="programTable_puk_{{ $document->pukProgram->id }}">
                        <thead>
                            <tr style="background: #fef2f2;">
                                <th rowspan="2" style="width: 40px; text-align: center;">No</th>
                                <th rowspan="2" style="width: 250px;">Uraian Kegiatan</th>
                                <th colspan="2" style="text-align: center;">Tanggung Jawab</th>
                                <th colspan="12" style="text-align: center;">Bulan (Target %)</th>
                            </tr>
                            <tr style="background: #fef2f2;">
                                <th>Koordinator</th>
                                <th>Pelaksana</th>
                                @for($m=1; $m<=12; $m++) <th style="width: 35px; text-align: center; font-size: 10px;">{{ $m }}</th> @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($document->pukProgram->program_kerja as $itemIndex => $item)
                            <tr data-row-index="{{ $itemIndex }}">
                                <td style="text-align: center;">{{ $itemIndex + 1 }}</td>
                                <td><span class="cell-content" data-field="uraian" data-row="{{ $itemIndex }}">{{ $item['uraian'] ?? '-' }}</span></td>
                                <td><span class="cell-content" data-field="koordinator" data-row="{{ $itemIndex }}">{{ $item['koordinator'] ?? '-' }}</span></td>
                                <td><span class="cell-content" data-field="pelaksana" data-row="{{ $itemIndex }}">{{ $item['pelaksana'] ?? '-' }}</span></td>
                                @php $targets = $item['target'] ?? []; @endphp
                                @for($m=0; $m<12; $m++)
                                    <td style="text-align: center; font-size: 11px; background: {{ (isset($targets[$m]) && $targets[$m] != '') ? '#fef2f2' : 'transparent' }};">
                                        <span class="cell-content" data-field="target_{{ $m }}" data-row="{{ $itemIndex }}">{{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '' }}</span>
                                    </td>
                                @endfor

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- PMK SECTION -->
        @if($document->pmkProgram)
            <div class="program-card">
                <div class="program-header" style="background: #fef2f2; border-bottom: 1px solid #fecaca;">
                    <div class="program-title" style="color: #b91c1c;">
                        <i class="fas fa-project-diagram"></i> Program Manajemen Korporat (PMK)
                        @if($document->pmkProgram->status == 'revision')
                            <span class="badge badge-revision">Perlu Revisi</span>
                        @endif
                    </div>
                    <div class="action-group">
                        <button type="button" class="btn-edit" 
                            style="background: #dc2626;"
                            id="editBtn_pmk_{{ $document->pmkProgram->id }}"
                            onclick="enableEditMode('pmk', {{ $document->pmkProgram->id }})">
                            <i class="fas fa-edit"></i> Edit Tabel
                        </button>
                        
                        <div id="editActions_pmk_{{ $document->pmkProgram->id }}" style="display: none; gap: 8px;">
                            <button type="button" class="btn-cancel" onclick="cancelEdit('pmk', {{ $document->pmkProgram->id }})">
                                <i class="fas fa-times"></i> Batal
                            </button>
                            <button type="button" class="btn-save" onclick="saveProgram('pmk', {{ $document->pmkProgram->id }})">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="program-body" id="tableWrapper_pmk_{{ $document->pmkProgram->id }}" style="overflow-x: auto;">
                    <table class="excel-table" id="programTable_pmk_{{ $document->pmkProgram->id }}">
                        <thead>
                            <tr style="background: #ffe4e6;">
                                <th rowspan="2" style="width: 40px; text-align: center;">No</th>
                                <th rowspan="2" style="width: 250px;">Uraian Kegiatan</th>
                                <th rowspan="2" style="width: 150px;">PIC</th>
                                <th colspan="12" style="text-align: center;">Bulan (Target %)</th>
                                <th rowspan="2" style="width: 150px;">Anggaran (Rp)</th>
                            </tr>
                            <tr style="background: #ffe4e6;">
                                @for($m=1; $m<=12; $m++) <th style="width: 35px; text-align: center; font-size: 10px;">{{ $m }}</th> @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($document->pmkProgram->program_kerja as $itemIndex => $item)
                            <tr data-row-index="{{ $itemIndex }}">
                                <td style="text-align: center;">{{ $itemIndex + 1 }}</td>
                                <td><span class="cell-content" data-field="uraian" data-row="{{ $itemIndex }}">{{ $item['uraian'] ?? '-' }}</span></td>
                                <td><span class="cell-content" data-field="koordinator" data-row="{{ $itemIndex }}">{{ (!empty($item['koordinator']) && $item['koordinator'] !== '-') ? $item['koordinator'] : ($item['pelaksana'] ?? $item['pic'] ?? '-') }}</span></td>
                                @php $targets = $item['target'] ?? []; @endphp
                                @for($m=0; $m<12; $m++)
                                    <td style="text-align: center; font-size: 11px; background: {{ (isset($targets[$m]) && $targets[$m] != '') ? '#fff1f2' : 'transparent' }};">
                                        <span class="cell-content" data-field="target_{{ $m }}" data-row="{{ $itemIndex }}">{{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '' }}</span>
                                    </td>
                                @endfor
                                <td><span class="cell-content" data-field="anggaran" data-row="{{ $itemIndex }}">{{ isset($item['anggaran']) ? $item['anggaran'] : '0' }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>

    <!-- REVISION ACTION CARD (Fixed Bottom) -->
    @if(($document->pukProgram && $document->pukProgram->status == 'revision') || ($document->pmkProgram && $document->pmkProgram->status == 'revision'))
    <div class="revision-card-container">
        <div class="revision-card">
            <button type="button" class="btn-action btn-draft" onclick="handleDraft()">
                <i class="fas fa-save"></i> Simpan Draft
            </button>
            
            <div class="note-input-wrapper">
                <input type="text" id="revisionNote" placeholder="Tulis catatan (opsional)..." class="note-input">
                <i class="fas fa-comment-alt note-icon"></i>
            </div>

            <button type="button" class="btn-action btn-submit-revision" onclick="handleSubmitRevision()">
                <i class="fas fa-paper-plane"></i> Submit Revisi
            </button>
        </div>
    </div>
    @endif

    <script>
        // Shared Logic for Inline Editing (Copied and Adapted)
        let originalData = {};

        function enableEditMode(type, id) {
            const tableId = `programTable_${type}_${id}`;
            const table = document.getElementById(tableId);
            
            // Store Original Data
            if (!originalData[type]) originalData[type] = {};
            originalData[type][id] = table.innerHTML;

            // Show Save/Cancel, Hide Edit
            document.getElementById(`editBtn_${type}_${id}`).style.display = 'none';
            document.getElementById(`editActions_${type}_${id}`).style.display = 'flex';

            // Enable ContentEditable
            table.querySelectorAll('.cell-content').forEach(cell => {
                cell.contentEditable = "true";
                // Style adjustment for editing
                cell.style.background = "#fff";
                cell.style.border = "1px solid #3b82f6";
                cell.style.padding = "4px";
            });
        }

        function cancelEdit(type, id) {
             const tableId = `programTable_${type}_${id}`;
             const table = document.getElementById(tableId);
             
             // Restore Original
             if (originalData[type] && originalData[type][id]) {
                 table.innerHTML = originalData[type][id];
             }

             // Toggle Buttons
             document.getElementById(`editBtn_${type}_${id}`).style.display = 'inline-flex';
             document.getElementById(`editActions_${type}_${id}`).style.display = 'none';
        }

        function saveProgram(type, id) {
            const tableId = `programTable_${type}_${id}`;
            const rows = document.querySelectorAll(`#${tableId} tbody tr`);
            let data = [];

            // Parse Table Data
            rows.forEach(row => {
                let rowData = {
                    uraian: row.querySelector('[data-field="uraian"]').innerText,
                    koordinator: row.querySelector('[data-field="koordinator"]') ? row.querySelector('[data-field="koordinator"]').innerText : '-',
                    pelaksana: row.querySelector('[data-field="pelaksana"]') ? row.querySelector('[data-field="pelaksana"]').innerText : '-',
                    target: [],
                    // Anggaran column removed but key kept for backend compatibility if needed, or default to 0
                    anggaran: row.querySelector('[data-field="anggaran"]') 
                        ? row.querySelector('[data-field="anggaran"]').innerText.replace(/[^0-9]/g, '') 
                        : 0
                };

                // Collect Targets (0-11)
                for(let i=0; i<12; i++) {
                    let val = row.querySelector(`[data-field="target_${i}"]`).innerText;
                    rowData.target.push(val === '' ? null : val);
                }

                data.push(rowData);
            });

            // AJAX Update
            const url = type === 'puk' 
                ? `{{ route('puk.update.program', ':id') }}`.replace(':id', id)
                : `{{ route('pmk.update.program', ':id') }}`.replace(':id', id);

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({ program_kerja: data })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data program kerja berhasil diperbarui!',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message || 'Gagal menyimpan data.', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Error', 'Terjadi kesalahan sistem.', 'error');
            });
        }

        // New Logic for Revision Loop
        function handleDraft() {
            Swal.fire({
                icon: 'info',
                title: 'Draft Disimpan',
                text: 'Perubahan pada tabel telah disimpan secara otomatis.', // Since saveProgram saves per table
                timer: 2000,
                showConfirmButton: false
            });
        }

        function handleSubmitRevision() {
            const note = document.getElementById('revisionNote').value;
            
            // Determine which program to submit
            // We can check if PUK or PMK is in revision
            const pukId = '{{ $document->pukProgram->id ?? "" }}';
            const pmkId = '{{ $document->pmkProgram->id ?? "" }}';
            const pukStatus = '{{ $document->pukProgram->status ?? "" }}';
            const pmkStatus = '{{ $document->pmkProgram->status ?? "" }}';

            let promises = [];

            if(pukId && pukStatus === 'revision') {
                promises.push(
                    fetch(`{{ route('puk.resubmit', ':id') }}`.replace(':id', pukId), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ note: note })
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => { throw new Error(err.message || 'Gagal mengirim revisi.') });
                        }
                        return response.json();
                    })
                );
            }

            if(pmkId && pmkStatus === 'revision') {
                promises.push(
                    fetch(`{{ route('pmk.resubmit', ':id') }}`.replace(':id', pmkId), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ note: note })
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => { throw new Error(err.message || 'Gagal mengirim revisi.') });
                        }
                        return response.json();
                    })
                );
            }

            if(promises.length === 0) {
                 Swal.fire('Info', 'Tidak ada program yang perlu direvisi.', 'info');
                 return;
            }

            Swal.fire({
                title: 'Mengirim Revisi...',
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            Promise.all(promises)
            .then(results => {
                // Check if any success - results only contain success if promises resolved
                // If promises reject (response !ok), catch block handles it
                const success = results.some(r => r.success);
                if(success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Revisi program kerja berhasil dikirim ke approval!',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                         window.location.href = "{{ route('documents.index') }}";
                    });
                } else {
                     // Should be unreachable if promises reject on error, unless successes are all false but ok response
                     // But backend returns success: true on success
                     Swal.fire('Error', 'Gagal mengirim revisi (Unknown error).', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Error', err.message || 'Terjadi kesalahan sistem.', 'error');
            });
        }
    </script>
</body>
</html>
```
