            <!-- PROGRESS PROGRAM TABLES (PUK & PMK) -->
            @php
                $puk = $document->pukProgram;
                $pmk = $document->pmkProgram;
            @endphp

            <!-- 1. CARD PUK -->
            @if($puk)
            <div class="content-card" style="margin-top: 30px; border-left: 4px solid #3b82f6; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; padding: 20px; border-radius: 12px 12px 0 0;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-tasks" style="font-size: 24px;"></i>
                        <div>
                            <div style="font-size: 18px; font-weight: 700; letter-spacing: -0.02em;">
                                PROGRAM UNIT KERJA (PUK)
                            </div>
                            <div style="font-size: 13px; opacity: 0.9; margin-top: 4px;">
                                Program Mitigasi Risiko Unit Kerja
                            </div>
                        </div>
                    </div>
                </div>
                
                <div style="padding: 24px; background: #ffffff;">
                    <!-- Informasi Program -->
                    <div style="background: #f8fafc; padding: 20px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #e2e8f0;">
                        <h4 style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-info-circle" style="color: #3b82f6;"></i>
                            Informasi Program
                        </h4>
                        <table style="width: 100%; font-size: 14px;">
                            <tr>
                                <td style="padding: 10px 0; width: 200px; font-weight: 600; color: #475569;">Judul Program</td>
                                <td style="padding: 10px 0; color: #0f172a;">: {{ $puk->judul }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; font-weight: 600; color: #475569; vertical-align: top;">Tujuan</td>
                                <td style="padding: 10px 0; color: #0f172a;">: {{ $puk->tujuan }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; font-weight: 600; color: #475569; vertical-align: top;">Sasaran</td>
                                <td style="padding: 10px 0; color: #0f172a;">: {{ $puk->sasaran }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; font-weight: 600; color: #475569;">Penanggung Jawab</td>
                                <td style="padding: 10px 0; color: #0f172a;">: {{ $puk->penanggung_jawab }}</td>
                            </tr>
                            @if($puk->uraian_revisi)
                            <tr>
                                <td style="padding: 10px 0; font-weight: 600; color: #475569; vertical-align: top;">Uraian Revisi</td>
                                <td style="padding: 10px 0; color: #0f172a;">: {{ $puk->uraian_revisi }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>

                    <!-- Tabel Program Kerja -->
                    @if($puk->program_kerja && is_array($puk->program_kerja) && count($puk->program_kerja) > 0)
                    <div>
                        <h4 style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-list-check" style="color: #3b82f6;"></i>
                            Detail Program Kerja
                        </h4>
                        <div class="hiradc-wrapper" style="margin-bottom: 0;">
                            <table class="excel-table" style="min-width: 1500px;">
                                <thead>
                                    <tr style="background: #1e293b; color: white;">
                                        <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: center; width: 50px;">NO</th>
                                        <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; min-width: 250px;">URAIAN KEGIATAN</th>
                                        <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; width: 150px;">KOORDINATOR</th>
                                        <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; width: 150px;">PELAKSANA</th>
                                        <th colspan="12" style="border: 1px solid #cbd5e1; padding: 12px; text-align: center;">TARGET (%)</th>
                                        <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; width: 150px; border-right: 1px solid #cbd5e1;">ANGGARAN</th>
                                    </tr>
                                    <tr style="background: #334155; color: white;">
                                        @for($m=1; $m<=12; $m++)
                                            <th style="border: 1px solid #cbd5e1; padding: 8px; text-align: center; width: 60px;">{{ $m }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($puk->program_kerja as $itemIndex => $item)
                                    <tr style="background: {{ $itemIndex % 2 == 0 ? '#ffffff' : '#f9fafb' }};">
                                        <td style="border: 1px solid #cbd5e1; padding: 10px; text-align: center; font-weight: 600;">{{ $itemIndex + 1 }}</td>
                                        <td style="border: 1px solid #cbd5e1; padding: 10px;">{{ $item['uraian'] ?? '-' }}</td>
                                        <td style="border: 1px solid #cbd5e1; padding: 10px;">{{ $item['koordinator'] ?? '-' }}</td>
                                        <td style="border: 1px solid #cbd5e1; padding: 10px;">{{ $item['pelaksana'] ?? '-' }}</td>
                                        @php
                                            $targets = $item['target'] ?? [];
                                        @endphp
                                        @for($m=0; $m<12; $m++)
                                            <td style="border: 1px solid #cbd5e1; padding: 6px; text-align: center; font-size: 12px;">
                                                {{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '-' }}
                                            </td>
                                        @endfor
                                        <td style="border: 1px solid #cbd5e1; padding: 10px; border-right: 1px solid #cbd5e1;">
                                            {{ isset($item['anggaran']) ? 'Rp ' . number_format($item['anggaran'], 0, ',', '.') : '-' }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div style="text-align: center; padding: 30px; background: #f9fafb; border-radius: 8px; color: #64748b;">
                        <i class="fas fa-inbox" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                        <p style="margin: 0;">Belum ada detail program kerja</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- 2. CARD PMK -->
            @if($pmk)
            <div class="content-card" style="margin-top: 30px; border-left: 4px solid #c026d3; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #c026d3 0%, #a21caf 100%); color: white; padding: 20px; border-radius: 12px 12px 0 0;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-project-diagram" style="font-size: 24px;"></i>
                        <div>
                            <div style="font-size: 18px; font-weight: 700; letter-spacing: -0.02em;">
                                PROGRAM MANAJEMEN KORPORAT (PMK)
                            </div>
                            <div style="font-size: 13px; opacity: 0.9; margin-top: 4px;">
                                Program Mitigasi Risiko Tingkat Korporat
                            </div>
                        </div>
                    </div>
                </div>
                
                <div style="padding: 24px; background: #ffffff;">
                    <!-- Informasi Program -->
                    <div style="background: #faf5ff; padding: 20px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #e9d5ff;">
                        <h4 style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-info-circle" style="color: #c026d3;"></i>
                            Informasi Program
                        </h4>
                        <table style="width: 100%; font-size: 14px;">
                            <tr>
                                <td style="padding: 10px 0; width: 200px; font-weight: 600; color: #475569;">Judul Program</td>
                                <td style="padding: 10px 0; color: #0f172a;">: {{ $pmk->judul }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; font-weight: 600; color: #475569; vertical-align: top;">Tujuan</td>
                                <td style="padding: 10px 0; color: #0f172a;">: {{ $pmk->tujuan }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; font-weight: 600; color: #475569; vertical-align: top;">Sasaran</td>
                                <td style="padding: 10px 0; color: #0f172a;">: {{ $pmk->sasaran }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; font-weight: 600; color: #475569;">Penanggung Jawab</td>
                                <td style="padding: 10px 0; color: #0f172a;">: {{ $pmk->penanggung_jawab }}</td>
                            </tr>
                            @if($pmk->uraian_revisi)
                            <tr>
                                <td style="padding: 10px 0; font-weight: 600; color: #475569; vertical-align: top;">Uraian Revisi</td>
                                <td style="padding: 10px 0; color: #0f172a;">: {{ $pmk->uraian_revisi }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>

                    <!-- Tabel Program Kerja -->
                    @if($pmk->program_kerja && is_array($pmk->program_kerja) && count($pmk->program_kerja) > 0)
                    <div>
                        <h4 style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-list-check" style="color: #c026d3;"></i>
                            Detail Program Kerja
                        </h4>
                        <div class="hiradc-wrapper" style="margin-bottom: 0;">
                            <table class="excel-table" style="min-width: 1500px;">
                                <thead>
                                    <tr style="background: #1e293b; color: white;">
                                        <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: center; width: 50px;">NO</th>
                                        <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; min-width: 250px;">URAIAN KEGIATAN</th>
                                        <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; width: 120px;">PIC</th>
                                        <th colspan="12" style="border: 1px solid #cbd5e1; padding: 12px; text-align: center;">TARGET (%)</th>
                                        <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; width: 120px; border-right: 1px solid #cbd5e1;">ANGGARAN</th>
                                    </tr>
                                    <tr style="background: #334155; color: white;">
                                        @for($m=1; $m<=12; $m++)
                                            <th style="border: 1px solid #cbd5e1; padding: 8px; text-align: center; width: 60px;">{{ $m }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pmk->program_kerja as $itemIndex => $item)
                                    <tr style="background: {{ $itemIndex % 2 == 0 ? '#ffffff' : '#faf9fb' }};">
                                        <td style="border: 1px solid #cbd5e1; padding: 10px; text-align: center; font-weight: 600;">{{ $itemIndex + 1 }}</td>
                                        <td style="border: 1px solid #cbd5e1; padding: 10px;">{{ $item['uraian'] ?? '-' }}</td>
                                        <td style="border: 1px solid #cbd5e1; padding: 10px;">{{ $item['koordinator'] ?? '-' }}</td>
                                        @php
                                            $targets = $item['target'] ?? [];
                                        @endphp
                                        @for($m=0; $m<12; $m++)
                                            <td style="border: 1px solid #cbd5e1; padding: 6px; text-align: center; font-size: 12px;">
                                                {{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '-' }}
                                            </td>
                                        @endfor
                                        <td style="border: 1px solid #cbd5e1; padding: 10px; border-right: 1px solid #cbd5e1;">
                                            {{ isset($item['anggaran']) ? 'Rp ' . number_format($item['anggaran'], 0, ',', '.') : '-' }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div style="text-align: center; padding: 30px; background: #f9fafb; border-radius: 8px; color: #64748b;">
                        <i class="fas fa-inbox" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                        <p style="margin: 0;">Belum ada detail program kerja</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

