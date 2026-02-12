<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>PMK Export</title>
    <style>
        /* CSS for PDF/Browser view, Excel might ignore some of this but good for fallback */
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

        .bg-gray {
            background-color: #f2f2f2;
        }

        .border-all {
            border: 1px solid #000000;
        }

        .border-none {
            border: none;
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

        // Signatories
        $kaUnit = $pmkProgram->approvedByUnit;
        $kaDept = $pmkProgram->approvedByDept;
        $direktur = $pmkProgram->approvedByDireksi;
    @endphp

    {{-- layout is 17 columns (A-Q) --}}

    <table>
        {{-- PAGE 1: COVER --}}
        <tr>
            <td colspan="17"></td>
        </tr> {{-- Spacer --}}
        <tr>
            <td colspan="17"></td>
        </tr>

        <tr>
            <td colspan="17" align="center" style="font-size: 20pt; font-weight: bold;">PROGRAM MANAJEMEN
                {{ $categoryTitle }}</td>
        </tr>
        <tr>
            <td colspan="17" align="center" style="font-size: 16pt; font-weight: bold;">{{ strtoupper($unitName) }}</td>
        </tr>

        <tr>
            <td colspan="17" height="30"></td>
        </tr> {{-- Spacer --}}

        <tr>
            {{-- Logo Inserted via PmkProgramExport class (WithDrawings) --}}
            <td colspan="17" height="80"></td>
        </tr>

        <tr>
            <td colspan="17" height="30"></td>
        </tr>

        {{-- Cover Details --}}
        <tr>
            <td colspan="6"></td> {{-- Left Spacer --}}
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
            <td colspan="17" height="50"></td>
        </tr> {{-- Page Break Simulation --}}

        {{-- PAGE 2: SIGNATURES --}}
        <tr>
            <td colspan="17" align="center" style="font-size: 16pt; font-weight: bold; text-decoration: underline;">
                LEMBAR PENGESAHAN</td>
        </tr>
        <tr>
            <td colspan="17" align="center">Padang, {{ $date }}</td>
        </tr>

        <tr>
            <td colspan="17" height="20"></td>
        </tr>

        {{-- Signatures Header --}}
        <tr>
            <td colspan="5" align="center" style="font-weight: bold;">Disiapkan oleh</td>
            <td colspan="1"></td>
            <td colspan="5" align="center" style="font-weight: bold;">Disetujui oleh</td>
            <td colspan="1"></td>
            <td colspan="5" align="center" style="font-weight: bold;">Disahkan oleh</td>
        </tr>

        <tr>
            <td colspan="17" height="60"></td>
        </tr> {{-- Space for signature --}}

        {{-- Signatures Names --}}
        <tr>
            <td colspan="5" align="center" style="font-weight: bold; text-decoration: underline;">
                {{ $kaUnit ? strtoupper($kaUnit->nama_user) : '........................' }}</td>
            <td colspan="1"></td>
            <td colspan="5" align="center" style="font-weight: bold; text-decoration: underline;">
                {{ $kaDept ? strtoupper($kaDept->nama_user) : '........................' }}</td>
            <td colspan="1"></td>
            <td colspan="5" align="center" style="font-weight: bold; text-decoration: underline;">
                {{ $direktur ? strtoupper($direktur->nama_user) : '........................' }}</td>
        </tr>
        <tr>
            <td colspan="5" align="center">
                {{ $kaUnit && $kaUnit->roleJabatan ? $kaUnit->roleJabatan->nama_role_jabatan : 'Kepala Unit' }}</td>
            <td colspan="1"></td>
            <td colspan="5" align="center">
                {{ $kaDept && $kaDept->roleJabatan ? $kaDept->roleJabatan->nama_role_jabatan : 'Kepala Departemen' }}
            </td>
            <td colspan="1"></td>
            <td colspan="5" align="center">Direktur</td>
        </tr>

        <tr>
            <td colspan="17" height="50"></td>
        </tr>

        {{-- PAGE 3: CONTENT --}}

        {{-- Program Info --}}
        <tr>
            <td colspan="3" style="font-weight: bold;">1. Judul</td>
            <td align="center">:</td>
            <td colspan="13">{{ $pmkProgram->judul }}</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="13" style="font-style: italic; color: #555;">(Judul Program Manajemen)</td>
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
            <td colspan="17" style="font-style: italic; color: #555;">(menjelaskan tentang Uraian kegiatan program
                skedul pelaksanaan, PIC, target dan anggaran program yang diisi pada tabel dibawah)</td>
        </tr>

        <tr>
            <td colspan="17" height="10"></td>
        </tr>

        {{-- Program Table Header --}}
        {{-- Row 1 of Header --}}
        <tr>
            <td rowspan="2" align="center" valign="middle"
                style="border: 1px solid #000; font-weight: bold; background-color: #e2e8f0;">NO</td>
            <td rowspan="2" align="center" valign="middle"
                style="border: 1px solid #000; font-weight: bold; background-color: #e2e8f0; width: 40px;">URAIAN
                KEGIATAN</td>
            <td rowspan="2" align="center" valign="middle"
                style="border: 1px solid #000; font-weight: bold; background-color: #e2e8f0; width: 20px;">PIC</td>
            <td rowspan="2" align="center" valign="middle"
                style="border: 1px solid #000; font-weight: bold; background-color: #e2e8f0;">PELAKSANA</td>
            <td colspan="12" align="center" valign="middle"
                style="border: 1px solid #000; font-weight: bold; background-color: #e2e8f0;">TARGET (%)</td>
            <td rowspan="2" align="center" valign="middle"
                style="border: 1px solid #000; font-weight: bold; background-color: #e2e8f0;">ANGGARAN</td>
        </tr>
        {{-- Row 2 of Header (Months) --}}
        <tr>
            @for($m = 1; $m <= 12; $m++)
                <td align="center" valign="middle"
                    style="border: 1px solid #000; font-weight: bold; background-color: #e2e8f0; width: 5px;">{{ $m }}</td>
            @endfor
        </tr>

        {{-- Table Content --}}
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
                <td colspan="17" align="center" style="border: 1px solid #000; padding: 20px;">Belum ada data program kerja
                </td>
            </tr>
        @endif

    </table>
</body>

</html>