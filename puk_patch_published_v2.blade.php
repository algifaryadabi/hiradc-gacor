
<!-- PROGRESS PROGRAM TABLES (PUK & PMK) - INSERTED VIA PATCH -->
@php
    $puk = $document->pukProgram;
    $pmk = $document->pmkProgram;
@endphp

@if($puk)
<div class="history-card" style="margin-top: 40px; border-left: 5px solid #3b82f6; position: relative;">
    <div class="timeline-header" style="display: flex; align-items: center; gap: 10px; margin-bottom: 24px; font-weight: 700; font-size: 16px; color: var(--text-main);">
        <i class="fas fa-tasks" style="color: #3b82f6;"></i> Program Unit Kerja (PUK)
    </div>

    <div style="background: #f8fafc; padding: 20px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #e2e8f0;">
        <table style="width: 100%; font-size: 14px; border-collapse: separate; border-spacing: 0 8px;">
            <tr>
                <td style="width: 180px; font-weight: 600; color: #64748b;">Judul Program</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $puk->judul }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600; color: #64748b;">Tujuan</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $puk->tujuan }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600; color: #64748b;">Sasaran</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $puk->sasaran }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600; color: #64748b;">Penanggung Jawab</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $puk->penanggung_jawab }}</td>
            </tr>
        </table>
    </div>

    @if($puk->program_kerja && is_array($puk->program_kerja) && count($puk->program_kerja) > 0)
        <div style="margin-bottom: 12px; font-weight: 700; color: #334155;">Detail Program Kerja:</div>
        <div class="table-wrapper" style="margin-bottom: 0;">
            <table class="excel-table" style="min-width: 1000px;">
                <thead>
                    <tr>
                         <th rowspan="2" style="width: 50px;">NO</th>
                         <th rowspan="2" style="min-width: 250px;">URAIAN KEGIATAN</th>
                         <th rowspan="2" style="min-width: 150px;">KOORD.</th>
                         <th rowspan="2" style="min-width: 150px;">PELAKSANA</th>
                         <th colspan="12" class="text-center">TARGET (%)</th>
                    </tr>
                    <tr>
                        @for($m=1; $m<=12; $m++)
                            <th style="width: 50px; text-align: center;">{{ $m }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($puk->program_kerja as $idx => $item)
                        <tr>
                            <td style="text-align: center;">{{ $idx + 1 }}</td>
                            <td>{{ $item['uraian'] ?? '-' }}</td>
                            <td>{{ $item['koordinator'] ?? '-' }}</td>
                            <td>{{ $item['pelaksana'] ?? '-' }}</td>
                            @php $targets = $item['target'] ?? []; @endphp
                            @for($m=0; $m<12; $m++)
                                <td style="text-align: center;">
                                    {{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '-' }}
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="font-style: italic; color: #94a3b8;">Tidak ada data program kerja.</div>
    @endif
</div>
@endif

@if($pmk)
<div class="history-card" style="margin-top: 40px; border-left: 5px solid #c026d3; position: relative;">
    <div class="timeline-header" style="display: flex; align-items: center; gap: 10px; margin-bottom: 24px; font-weight: 700; font-size: 16px; color: var(--text-main);">
        <i class="fas fa-shield-virus" style="color: #c026d3;"></i> Program Manajemen Kesehatan (PMK)
    </div>

    <div style="background: #fdf4ff; padding: 20px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #f0abfc;">
        <table style="width: 100%; font-size: 14px; border-collapse: separate; border-spacing: 0 8px;">
            <tr>
                <td style="width: 180px; font-weight: 600; color: #86198f;">Judul Program</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $pmk->judul }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600; color: #86198f;">Tujuan</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $pmk->tujuan }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600; color: #86198f;">Sasaran</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $pmk->sasaran }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600; color: #86198f;">Penanggung Jawab</td>
                <td style="font-weight: 500; color: #0f172a;">: {{ $pmk->penanggung_jawab }}</td>
            </tr>
        </table>
    </div>

    @if($pmk->program_kerja && is_array($pmk->program_kerja) && count($pmk->program_kerja) > 0)
        <div style="margin-bottom: 12px; font-weight: 700; color: #334155;">Detail Program Kerja:</div>
        <div class="table-wrapper" style="margin-bottom: 0;">
            <table class="excel-table" style="min-width: 1000px;">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 50px;">NO</th>
                        <th rowspan="2" style="min-width: 200px;">URAIAN KEGIATAN</th>
                        <th rowspan="2" style="width: 150px;">PIC</th>
                        <th colspan="12" class="text-center">TARGET (%)</th>
                        <th rowspan="2" style="min-width: 150px;">ANGGARAN</th>
                    </tr>
                    <tr>
                        @for($m=1; $m<=12; $m++)
                            <th style="width: 50px; text-align: center;">{{ $m }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($pmk->program_kerja as $idx => $item)
                        <tr>
                            <td style="text-align: center;">{{ $idx + 1 }}</td>
                            <td>{{ $item['uraian'] ?? '-' }}</td>
                            <td>{{ $item['koordinator'] ?? '-' }}</td>
                            @php $targets = $item['target'] ?? []; @endphp
                            @for($m=0; $m<12; $m++)
                                <td style="text-align: center;">
                                    {{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '-' }}
                                </td>
                            @endfor
                            <td>
                                {{ isset($item['anggaran']) ? 'Rp ' . number_format($item['anggaran'], 0, ',', '.') : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="font-style: italic; color: #94a3b8;">Tidak ada data program kerja.</div>
    @endif
</div>
@endif
<!-- END PROGRESS PROGRAM TABLES -->
