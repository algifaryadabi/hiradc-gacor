<table>
    <thead>
    <thead>
        <!-- HEADER SECTION -->
        <tr>
            <th colspan="19" style="font-weight: bold; font-size: 14pt; text-align: center; height: 30px; vertical-align: middle;">HAZARD IDENTIFICATION, RISK ASSESSMENT AND DETERMINING CONTROL (HIRADC)</th>
        </tr>
        <tr>
            <th colspan="19" style="font-weight: bold; font-size: 12pt; text-align: center; height: 25px; vertical-align: middle;">PT SEMEN PADANG</th>
        </tr>
        <tr>
            <th colspan="19"></th>
        </tr>
        
        <!-- METADATA -->
        <tr>
            <td colspan="3" style="font-weight: bold;">Judul Dokumen</td>
            <td colspan="7">: {{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</td>
            <td colspan="3" style="font-weight: bold;">No Dokumen</td>
            <td colspan="6">: {{ $document->dcoument_number ?? $document->id }}/HIRADC/{{ date('Y') }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Unit Kerja</td>
            <td colspan="7">: {{ $document->unit->nama_unit ?? '-' }}</td>
            <td colspan="3" style="font-weight: bold;">Revisi</td>
            <td colspan="6">: {{ $document->revision_number ?? 0 }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold;">Departemen</td>
            <td colspan="7">: {{ $document->departemen->nama_dept ?? '-' }}</td>
            <td colspan="3" style="font-weight: bold;">Tanggal</td>
            <td colspan="6">: {{ $document->created_at->format('d F Y') }}</td>
        </tr>
        <tr>
            <td colspan="19"></td>
        </tr>

        <!-- TABLE HEADERS -->
        <tr style="background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #000000;">
            <th rowspan="2" style="border: 1px solid #000000; vertical-align: middle; width: 5px;">No</th>
            <th rowspan="2" style="border: 1px solid #000000; vertical-align: middle; width: 20px;">Proses</th>
            <th rowspan="2" style="border: 1px solid #000000; vertical-align: middle; width: 20px;">Kegiatan</th>
            <th rowspan="2" style="border: 1px solid #000000; vertical-align: middle; width: 15px;">Lokasi</th>
            <th rowspan="2" style="border: 1px solid #000000; vertical-align: middle; width: 15px;">Kondisi</th>
            <th rowspan="2" style="border: 1px solid #000000; vertical-align: middle; width: 30px;">Bahaya</th>
            <th rowspan="2" style="border: 1px solid #000000; vertical-align: middle; width: 20px;">Dampak</th>
            <th rowspan="2" style="border: 1px solid #000000; vertical-align: middle; width: 15px;">Risiko Awal</th>
            <th rowspan="2" style="border: 1px solid #000000; vertical-align: middle; width: 25px;">Pengendalian Existing</th>
            <th colspan="4" style="border: 1px solid #000000; text-align: center;">Penilaian Risiko (Awal)</th>
            <th rowspan="2" style="border: 1px solid #000000; vertical-align: middle; width: 20px;">Peraturan / Standar</th>
            <th rowspan="2" style="border: 1px solid #000000; vertical-align: middle; width: 25px;">Pengendalian Lanjutan</th>
            <th colspan="4" style="border: 1px solid #000000; text-align: center;">Residual Risk (Sisa)</th>
        </tr>
        <tr style="background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #000000;">
            <th style="border: 1px solid #000000;">P</th>
            <th style="border: 1px solid #000000;">C</th>
            <th style="border: 1px solid #000000;">Score</th>
            <th style="border: 1px solid #000000;">Level</th>
            <th style="border: 1px solid #000000;">P</th>
            <th style="border: 1px solid #000000;">C</th>
            <th style="border: 1px solid #000000;">Score</th>
            <th style="border: 1px solid #000000;">Level</th>
        </tr>
    </thead>
    <tbody>
        @foreach($document->details as $item)
        <tr>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $loop->iteration }}</td>
            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom2_proses }}</td>
            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom2_kegiatan }}</td>
            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom3_lokasi }}</td>
            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom5_kondisi }}</td>
            <td style="border: 1px solid #000000; vertical-align: top;">
                @if(is_array($item->kolom6_bahaya))
                    {{ implode(', ', $item->kolom6_bahaya['details'] ?? []) }}
                    @if(!empty($item->kolom6_bahaya['manual'])) ({{ $item->kolom6_bahaya['manual'] }}) @endif
                @else
                    {{ $item->kolom6_bahaya }}
                @endif
            </td>
            <td style="border: 1px solid #000000; vertical-align: top;">
                @if($item->kolom7_dampak)
                    {{ $item->kolom7_dampak }}
                @elseif($item->kategori == 'Lingkungan' && isset($item->kolom7_aspek_lingkungan))
                    {{ is_array($item->kolom7_aspek_lingkungan) ? implode(', ', $item->kolom7_aspek_lingkungan['details'] ?? []) : $item->kolom7_aspek_lingkungan }}
                @else
                    -
                @endif
            </td>
            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom9_risiko ?? '-' }}</td>
            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom11_existing }}</td>

            <!-- Initial Risk -->
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kolom12_kemungkinan }}</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kolom13_konsekuensi }}</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->kolom14_score }}</td>
            
            @php
                $bg = '#ffffff';
                $text = '#000000';
                $lvl = strtolower($item->kolom14_level);
                if(str_contains($lvl, 'high') || str_contains($lvl, 'extreme')) { $bg = '#ff0000'; $text = '#ffffff'; }
                elseif(str_contains($lvl, 'medium') || str_contains($lvl, 'moderate')) { $bg = '#ffff00'; }
                elseif(str_contains($lvl, 'low')) { $bg = '#00ff00'; }
            @endphp
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top; background-color: {{ $bg }}; color: {{ $text }};">{{ $item->kolom14_level }}</td>

            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom15_regulasi }}</td>
            <td style="border: 1px solid #000000; vertical-align: top;">{{ $item->kolom18_tindak_lanjut ?? $item->kolom19_pengendalian_lanjut ?? '-' }}</td>

            <!-- Residual Risk -->
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->residual_kemungkinan }}</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->residual_konsekuensi }}</td>
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top;">{{ $item->residual_score }}</td>
            
            @php
                $bgRes = '#ffffff';
                $textRes = '#000000';
                $lvlRes = strtolower($item->residual_level);
                if(str_contains($lvlRes, 'high') || str_contains($lvlRes, 'extreme')) { $bgRes = '#ff0000'; $textRes = '#ffffff'; }
                elseif(str_contains($lvlRes, 'medium') || str_contains($lvlRes, 'moderate')) { $bgRes = '#ffff00'; }
                elseif(str_contains($lvlRes, 'low')) { $bgRes = '#00ff00'; }
            @endphp
            <td style="border: 1px solid #000000; text-align: center; vertical-align: top; background-color: {{ $bgRes }}; color: {{ $textRes }};">{{ $item->residual_level }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
