<div class="doc-card">
    <div class="doc-header">
        <h3 class="doc-title">{{ $doc->kolom2_kegiatan ?? 'Judul Tidak Tersedia' }}</h3>
        
        @php
            $statusClass = 'status-pending'; // Default
            $statusLabel = $doc->status_label ?? 'Memproses';

            // Logic mapping based on current_level or existing status
            // Assuming status_label is populated, or using current_level logic
            if(isset($doc->status)) {
                 if($doc->status == 'approved' || $doc->status == 'Disetujui') {
                    $statusClass = 'status-disetujui';
                    $statusLabel = 'DISETUJUI';
                 } elseif($doc->status == 'rejected' || $doc->status == 'Ditolak') {
                    $statusClass = 'status-ditolak';
                    $statusLabel = 'DITOLAK';
                 } elseif($doc->status == 'revision' || $doc->status == 'Perlu Revisi') {
                    $statusClass = 'status-revisi';
                    $statusLabel = 'PERLU REVISI';
                 }
            } else {
                // Fallback logic if status column isn't direct
                if($doc->current_level == 1) $statusLabel = 'Level 1: Ka. Unit';
                // You might need to refine this based on real status data availability
            }

            // Override for specific tabs logic if needed, but the card should be smart
            // Check for revision text to be sure
            $isRev = isset($isRevision) && $isRevision;
            if ($isRev) {
                 $statusClass = 'status-revisi';
                 $statusLabel = 'PERLU REVISI';
            }
        @endphp

        <span class="status-badge-pill {{ $statusClass }}">{{ $statusLabel }}</span>
    </div>

    <style>
        .doc-meta-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr) !important;
            gap: 15px;
            margin-bottom: 20px;
        }
        @media (max-width: 900px) {
            .doc-meta-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
    </style>
    <div class="doc-meta-grid">
        <div class="meta-group">
            <span class="meta-label">KATEGORI</span>
            <span class="meta-value">{{ $doc->kategori ?? '-' }}</span>
        </div>
        <div class="meta-group">
            <span class="meta-label">UNIT KERJA</span>
            <span class="meta-value">{{ $doc->unit->nama_unit ?? '-' }}</span>
        </div>
        <div class="meta-group">
            <span class="meta-label">TANGGAL DIBUAT</span>
            <span class="meta-value">{{ $doc->created_at ? $doc->created_at->format('d M Y') : '-' }}</span>
        </div>
        <div class="meta-group">
            <span class="meta-label">TINGKAT RISIKO</span>
            <span class="meta-value">{{ $doc->risk_level ?? 'Sedang' }}</span>
        </div>
        <div class="meta-group">
            <span class="meta-label">WAKTU PENGISIAN</span>
            <span class="meta-value">{{ $doc->created_at ? $doc->created_at->format('H:i') . ' WIB' : '-' }}</span>
        </div>
    </div>

    @if(isset($isRevision) && $isRevision)
        @php 
            $lastRev = $doc->approvals->where('action', 'revision')->first(); 
        @endphp
        @if($lastRev)
        <div class="revision-box">
            <strong class="text-amber-800">
                <i class="fas fa-exclamation-triangle"></i> Revisi dari {{ $lastRev->approver->nama_user ?? 'Approver' }} ({{ $lastRev->approver->role_jabatan_name ?? 'Role' }}) - {{ $lastRev->created_at->format('d M Y') }}
            </strong>
            <p>"{{ $lastRev->catatan ?? 'Mohon lengkapi data.' }}"</p>
        </div>
        @endif
    @endif

    <div class="action-row">
        @if(isset($isRevision) && $isRevision)
            <a href="{{ route('documents.create', ['edit' => $doc->id]) }}" class="btn-custom btn-edit">
                <i class="fas fa-edit"></i> Perbaiki Dokumen
            </a>
        @endif

        <a href="{{ route('documents.show', $doc->id) }}" class="btn-custom btn-detail">
            <i class="fas fa-eye"></i> Lihat Detail
        </a>
    </div>
</div>
