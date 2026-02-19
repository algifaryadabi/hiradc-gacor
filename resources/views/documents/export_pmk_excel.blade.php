<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>PMK Export</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
        }

        .text-center {
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .bg-header {
            background-color: #e2e8f0;
        }

        .bg-gray {
            background-color: #f9f9f9;
        }

        .border-all {
            border: 1px solid #000000;
        }
    </style>
</head>

<body>
    @php
        // Determine Category Title
        $categoryTitle = 'KO.K3/LINGKUNGAN';
        if ($document->kategori === 'Keamanan' || $document->managing_unit === 'Security' || ($document->status_security != 'none')) {
            $categoryTitle = 'PENGAMANAN';
        }

        $unitName = $document->unit ? $document->unit->nama_unit : ($document->kolom3_lokasi ?? 'UNIT KERJA');
        $currentYear = date('Y');
        $docNo = "DOC-" . str_pad($document->id, 3, '0', STR_PAD_LEFT);
        $revision = "0";
        $date = now()->locale('id')->isoFormat('D MMMM YYYY');

        // Signatories — Ambil berdasar unit/dept dari dokumen submitter
        // Kepala Unit dari unit submitter
        $kaUnit = null;
        if ($document->id_unit) {
            $kaUnit = \App\Models\User::where('id_unit', $document->id_unit)
                ->where('role_jabatan', 3) // Kepala Unit
                ->where('user_aktif', 1)
                ->first();
        }

        // Kepala Departemen dari dept submitter
        $kaDept = null;
        if ($document->id_dept) {
            $kaDept = \App\Models\User::where('id_dept', $document->id_dept)
                ->where('role_jabatan', 2) // Kepala Departemen
                ->where('user_aktif', 1)
                ->first();
        }

        // Direktur
        $direktur = null;
        if ($document->id_direktorat) {
            $direktur = \App\Models\User::where('id_direktorat', $document->id_direktorat)
                ->where('role_jabatan', 1)
                ->where('user_aktif', 1)
                ->first();
        }
    @endphp

    {{-- Layout: 17 kolom (A–Q) --}}
    {{-- Kolom: A=No, B=Uraian, C=PIC, D=Pelaksana, E-P=Target(12bln), Q=Anggaran --}}

    <table>

        {{-- ===== HALAMAN 1: COVER ===== --}}
        <tr>
            <td colspan="17" height="20"></td>
        </tr>
        <tr>
            <td colspan="17" height="20"></td>
        </tr>

        <tr>
            <td colspan="17" align="center" style="font-size: 20pt; font-weight: bold;">
                PROGRAM MANAJEMEN {{ $categoryTitle }}
            </td>
        </tr>
        <tr>
            <td colspan="17" align="center" style="font-size: 16pt; font-weight: bold;">
                {{ strtoupper($unitName) }}
            </td>
        </tr>

        <tr>
            <td colspan="17" height="30"></td>
        </tr>

        {{-- Placeholder baris untuk logo (logo di-inject via WithDrawings di I6) --}}
        <tr>
            <td colspan="17" height="80"></td>
        </tr>

        <tr>
            <td colspan="17" height="30"></td>
        </tr>

        {{-- Cover Details --}}
        <tr>
            <td colspan="6"></td>
            <td colspan="2" style="font-weight: bold;">No. Dok.</td>
            <td align="center">:</td>
            <td colspan="8">{{ $docNo }}</td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td colspan="2" style="font-weight: bold;">Departemen</td>
            <td align="center">:</td>
            <td colspan="8">{{ $document->departemen->nama_dept ?? '-' }}</td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td colspan="2" style="font-weight: bold;">Revisi</td>
            <td align="center">:</td>
            <td colspan="8">{{ $revision }}</td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td colspan="2" style="font-weight: bold;">Tanggal</td>
            <td align="center">:</td>
            <td colspan="8">{{ $date }}</td>
        </tr>

        <tr>
            <td colspan="17" height="50"></td>
        </tr>

        <tr>
            <td colspan="17" align="center" style="font-size: 16pt; font-weight: bold;">PT SEMEN PADANG</td>
        </tr>
        <tr>
            <td colspan="17" align="center" style="font-size: 16pt; font-weight: bold;">TAHUN {{ $currentYear }}</td>
        </tr>

        <tr>
            <td colspan="17" height="60"></td>
        </tr> {{-- Simulasi page break --}}

        {{-- ===== HALAMAN 2: LEMBAR PENGESAHAN ===== --}}
        <tr>
            <td colspan="17" align="center" style="font-size: 16pt; font-weight: bold; text-decoration: underline;">
                LEMBAR PENGESAHAN
            </td>
        </tr>
        <tr>
            <td colspan="17" align="center">Padang, {{ $date }}</td>
        </tr>
        <tr>
            <td colspan="17" height="20"></td>
        </tr>

        {{-- Label Signatures --}}
        <tr>
            <td colspan="5" align="center" style="font-weight: bold;">Disiapkan oleh</td>
            <td colspan="1"></td>
            <td colspan="5" align="center" style="font-weight: bold;">Disetujui oleh</td>
            <td colspan="1"></td>
            <td colspan="5" align="center" style="font-weight: bold;">Disahkan oleh</td>
        </tr>

        @php
            // Logic approval dengan fallback untuk data lama
            $isApprovedStatus = $pmkProgram->status === 'APPROVED';

            // Individual per-level: masing-masing kolom hanya approved jika level itu sendiri yang approve
            // ATAU jika status final APPROVED (untuk data lama)
            $unitApproved = !empty($pmkProgram->unit_approval_at) || $isApprovedStatus;
            $deptApproved = !empty($pmkProgram->dept_approval_at) || $isApprovedStatus;
            $direksiApproved = !empty($pmkProgram->direksi_approval_at) || $isApprovedStatus;

            // Timestamp fallback
            $fallbackDate = $pmkProgram->updated_at->locale('id')->isoFormat('D MMM YYYY, HH:mm');

            $unitApprovalAt = !empty($pmkProgram->unit_approval_at) ? $pmkProgram->unit_approval_at->locale('id')->isoFormat('D MMM YYYY, HH:mm') : ($isApprovedStatus ? $fallbackDate : null);
            $deptApprovalAt = !empty($pmkProgram->dept_approval_at) ? $pmkProgram->dept_approval_at->locale('id')->isoFormat('D MMM YYYY, HH:mm') : ($isApprovedStatus ? $fallbackDate : null);
            $direksiAt = !empty($pmkProgram->direksi_approval_at) ? $pmkProgram->direksi_approval_at->locale('id')->isoFormat('D MMM YYYY, HH:mm') : ($isApprovedStatus ? $fallbackDate : null);
        @endphp

        {{-- Badge Approved per kolom --}}
        <tr>
            <td colspan="5" align="center">
                @if($unitApproved)
                    <div
                        style="display:inline-block; background:#f0fdf4; border:1.5px solid #16a34a; border-radius:8px; padding:6px 10px; text-align:center;">
                        <div style="font-size:14pt; color:#16a34a; font-weight:bold;">&#10003;</div>
                        <div style="font-weight:bold; color:#15803d; font-size:9pt;">Approved by System</div>
                        <div style="font-size:7.5pt; color:#166534; margin-top:2px;">{{ $unitApprovalAt }}</div>
                    </div>
                @else
                    &nbsp;
                @endif
            </td>
            <td colspan="1"></td>
            <td colspan="5" align="center">
                @if($deptApproved)
                    <div
                        style="display:inline-block; background:#f0fdf4; border:1.5px solid #16a34a; border-radius:8px; padding:6px 10px; text-align:center;">
                        <div style="font-size:14pt; color:#16a34a; font-weight:bold;">&#10003;</div>
                        <div style="font-weight:bold; color:#15803d; font-size:9pt;">Approved by System</div>
                        <div style="font-size:7.5pt; color:#166534; margin-top:2px;">{{ $deptApprovalAt }}</div>
                    </div>
                @else
                    &nbsp;
                @endif
            </td>
            <td colspan="1"></td>
            <td colspan="5" align="center">
                @if($direksiApproved)
                    <div
                        style="display:inline-block; background:#f0fdf4; border:1.5px solid #16a34a; border-radius:8px; padding:6px 10px; text-align:center;">
                        <div style="font-size:14pt; color:#16a34a; font-weight:bold;">&#10003;</div>
                        <div style="font-weight:bold; color:#15803d; font-size:9pt;">Approved by System</div>
                        <div style="font-size:7.5pt; color:#166534; margin-top:2px;">{{ $direksiAt }}</div>
                    </div>
                @else
                    &nbsp;
                @endif
            </td>
        </tr>

        @if(!$unitApproved || !$deptApproved || !$direksiApproved)
            <tr>
                <td colspan="17" height="40"></td>
            </tr> {{-- Ruang TTD jika belum semua approve --}}
        @endif

        {{-- Nama --}}
        <tr>
            <td colspan="5" align="center" style="border-top: 1.5px solid #000; font-weight: bold;">
                {{ $kaUnit ? strtoupper($kaUnit->nama_user) : '.................................' }}
            </td>
            <td colspan="1"></td>
            <td colspan="5" align="center" style="border-top: 1.5px solid #000; font-weight: bold;">
                {{ $kaDept ? strtoupper($kaDept->nama_user) : '.................................' }}
            </td>
            <td colspan="1"></td>
            <td colspan="5" align="center" style="border-top: 1.5px solid #000; font-weight: bold;">
                {{ $direktur ? strtoupper($direktur->nama_user) : '.................................' }}
            </td>
        </tr>

        {{-- Jabatan --}}
        <tr>
            <td colspan="5" align="center">
                {{ $kaUnit && $kaUnit->roleJabatan ? $kaUnit->roleJabatan->nama_role_jabatan : 'Kepala Unit' }}
            </td>
            <td colspan="1"></td>
            <td colspan="5" align="center">
                {{ $kaDept && $kaDept->roleJabatan ? $kaDept->roleJabatan->nama_role_jabatan : 'Kepala Departemen' }}
            </td>
            <td colspan="1"></td>
            <td colspan="5" align="center">Direktur</td>
        </tr>

        <tr>
            <td colspan="17" height="60"></td>
        </tr> {{-- Simulasi page break --}}

        {{-- ===== HALAMAN 3: KONTEN PROGRAM ===== --}}

        {{-- Info Program --}}
        <tr>
            <td colspan="3" style="font-weight: bold;">1. Judul</td>
            <td align="center">:</td>
            <td colspan="13">{{ $pmkProgram->judul }}</td>
        </tr>

        <tr>
            <td colspan="3" style="font-weight: bold;">2. Tujuan</td>
            <td align="center">:</td>
            <td colspan="13">{{ $pmkProgram->tujuan }}</td>
        </tr>

        <tr>
            <td colspan="3" style="font-weight: bold;">3. Sasaran</td>
            <td align="center">:</td>
            <td colspan="13">{{ $pmkProgram->sasaran }}</td>
        </tr>

        <tr>
            <td colspan="3" style="font-weight: bold;">4. Penanggung Jawab</td>
            <td align="center">:</td>
            <td colspan="13" style="font-weight: bold;">{{ $pmkProgram->penanggung_jawab }}</td>
        </tr>

        <tr>
            <td colspan="3" style="font-weight: bold;">5. Uraian Revisi</td>
            <td align="center">:</td>
            <td colspan="13">{{ $latestRevision ?? '-' }}</td>
        </tr>

        <tr>
            <td colspan="17" height="10"></td>
        </tr>

        <tr>
            <td colspan="17" style="font-weight: bold; font-size: 12pt;">6. Program Kerja</td>
        </tr>

        <tr>
            <td colspan="17" height="5"></td>
        </tr>

        {{-- Header Tabel --}}
        {{-- Baris 1: Judul Kolom --}}
        <tr>
            <td rowspan="2" align="center" valign="middle"
                style="border: 1px solid #000; font-weight: bold; background-color: #d1dce8;">NO</td>
            <td rowspan="2" align="center" valign="middle"
                style="border: 1px solid #000; font-weight: bold; background-color: #d1dce8;">URAIAN KEGIATAN</td>
            <td rowspan="2" align="center" valign="middle"
                style="border: 1px solid #000; font-weight: bold; background-color: #d1dce8;">PIC</td>
            <td rowspan="2" align="center" valign="middle"
                style="border: 1px solid #000; font-weight: bold; background-color: #d1dce8;">PELAKSANA</td>
            <td colspan="12" align="center" valign="middle"
                style="border: 1px solid #000; font-weight: bold; background-color: #d1dce8;">TARGET (%)</td>
            <td rowspan="2" align="center" valign="middle"
                style="border: 1px solid #000; font-weight: bold; background-color: #d1dce8;">ANGGARAN</td>
        </tr>
        {{-- Baris 2: Bulan 1-12 --}}
        <tr>
            @for($m = 1; $m <= 12; $m++)
                <td align="center" valign="middle"
                    style="border: 1px solid #000; font-weight: bold; background-color: #d1dce8;">{{ $m }}</td>
            @endfor
        </tr>

        {{-- Isi Tabel --}}
        @if($pmkProgram->program_kerja && is_array($pmkProgram->program_kerja) && count($pmkProgram->program_kerja) > 0)
            @foreach($pmkProgram->program_kerja as $index => $item)
                <tr>
                    <td align="center" valign="middle" style="border: 1px solid #000; font-weight: bold;">{{ $index + 1 }}</td>
                    <td valign="middle" style="border: 1px solid #000; word-wrap: break-word;">{{ $item['uraian'] ?? '-' }}</td>
                    <td align="center" valign="middle" style="border: 1px solid #000;">
                        {{ (!empty($item['koordinator']) && $item['koordinator'] !== '-') ? $item['koordinator'] : ($item['pic'] ?? '-') }}
                    </td>
                    <td align="center" valign="middle" style="border: 1px solid #000;">
                        {{ $item['pelaksana'] ?? '-' }}
                    </td>

                    @php $targets = $item['target'] ?? []; @endphp
                    @for($m = 0; $m < 12; $m++)
                        <td align="center" valign="middle" style="border: 1px solid #000; background-color: #f9f9f9;">
                            @if(isset($targets[$m]) && $targets[$m] !== '' && $targets[$m] !== null)
                                <b>{{ $targets[$m] }}</b>
                            @else
                                <span style="color: #ccc;">-</span>
                            @endif
                        </td>
                    @endfor

                    <td align="right" valign="middle" style="border: 1px solid #000;">
                        {{ isset($item['anggaran']) && $item['anggaran'] ? 'Rp ' . number_format($item['anggaran'], 0, ',', '.') : '-' }}
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="17" align="center" style="border: 1px solid #000; padding: 20px;">
                    Belum ada data program kerja
                </td>
            </tr>
        @endif

    </table>
</body>

</html>