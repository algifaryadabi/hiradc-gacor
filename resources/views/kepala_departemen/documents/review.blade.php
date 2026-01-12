<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen - Kepala Departemen</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Base styles from create.blade.php */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f5f5;
            color: #333;
            padding-bottom: 200px;
            /* Space for footer */
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: white;
            border-right: 1px solid #e0e0e0;
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 101;
        }

        .logo-section {
            padding: 30px 20px;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
        }

        .logo-circle {
            width: 70px;
            height: 70px;
            background: #fff;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo-circle img {
            max-width: 80%;
            max-height: 80%;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 700;
            color: #c41e3a;
            margin-bottom: 3px;
        }

        .logo-subtext {
            font-size: 12px;
            color: #999;
            font-style: italic;
        }

        .nav-menu {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .nav-item {
            padding: 15px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #666;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            position: relative;
        }

        .nav-item:hover {
            background: #fff5f5;
            color: #c41e3a;
        }

        .nav-item.active {
            background: #ffe5e5;
            color: #c41e3a;
            border-left: 3px solid #c41e3a;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .user-info-bottom {
            padding: 20px;
            border-top: 2px solid #e0e0e0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-weight: 700;
            font-size: 16px;
            flex-shrink: 0;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 2px;
        }

        .logout-btn {
            width: 100%;
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
        }

        .header {
            background: white;
            padding: 25px 40px;
            border-bottom: 1px solid #e0e0e0;
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .content-area {
            padding: 30px 40px;
            max-width: 1400px;
        }

        .form-container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            background-color: #f9f9f9;
            /* Readonly style */
        }

        .form-control:disabled {
            background-color: #f9f9f9;
            color: #555;
            cursor: not-allowed;
            border-color: #eee;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .section-header {
            background: #f8f8f8;
            padding: 15px 20px;
            border-left: 4px solid #c41e3a;
            margin: 30px 0 20px 0;
            border-radius: 4px;
        }

        .section-header h2 {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            margin-bottom: 3px;
        }

        .section-header p {
            font-size: 12px;
            color: #666;
        }

        /* Review Footer Fixed */
        .review-footer {
            position: fixed;
            bottom: 0;
            left: 250px;
            right: 0;
            background: white;
            padding: 20px 40px;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08);
            z-index: 900;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 30px;
            align-items: end;
        }

        .comment-section {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .comment-label {
            font-size: 12px;
            font-weight: 600;
            color: #555;
        }

        .comment-input {
            width: 100%;
            height: 60px;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 10px;
            font-family: inherit;
            font-size: 14px;
            resize: none;
            background: #fff;
            transition: all 0.2s;
        }

        .comment-input:focus {
            border-color: #c41e3a;
            box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.1);
            height: 80px;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            padding-bottom: 5px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-family: 'Inter';
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-reject {
            background: white;
            border: 1px solid #dc3545;
            color: #dc3545;
        }

        .btn-reject:hover {
            background: #fff5f5;
        }

        .btn-approve {
            background: #2e7d32;
            /* Green for Final Approval */
            color: white;
        }

        .btn-approve:hover {
            background: #1b5e20;
        }

        /* Timeline Styles */
        .timeline-container {
            position: relative;
            padding-left: 20px;
            border-left: 2px solid #e0e0e0;
            margin-left: 10px;
            margin-top: 20px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 25px;
            padding-left: 25px;
        }

        .timeline-icon {
            position: absolute;
            left: -11px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .bg-blue {
            background: #007bff;
        }

        .bg-orange {
            background: #fd7e14;
        }

        .bg-green {
            background: #28a745;
        }

        .timeline-header {
            font-size: 13px;
            margin-bottom: 4px;
            color: #777;
        }

        .timeline-header .actor {
            font-weight: 700;
            color: #333;
            margin-right: 5px;
        }

        .timeline-body {
            background: #fff;
            padding: 10px 15px;
            border-radius: 6px;
            border: 1px solid #eee;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle"><img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP"></div>
                <div class="logo-text">PT Semen Padang</div>
                <div class="logo-subtext">HIRADC System (Head Dept)</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('kepala_departemen.dashboard') }}" class="nav-item">
                    <i class="fas fa-th-large"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('kepala_departemen.check_documents') }}" class="nav-item active">
                    <i class="fas fa-file-contract"></i><span>Validasi Dokumen</span>
                </a>
            </nav>
            <div class="user-info-bottom">
                <div class="user-profile">
                    <div class="user-avatar">KD</div>
                    <div class="user-details">
                        <div class="user-name">Bpk. Wijaya</div>
                        <div class="user-role">Kepala Departemen</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="fas fa-sign-out-alt"></i> Keluar</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <div style="display:flex; align-items:center;">
                    <h1>Review & Validasi Dokumen</h1>
                </div>
                <a href="{{ route('kepala_departemen.check_documents') }}" class="btn"
                    style="background:#ddd; color:#333;"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="content-area">
                <form id="hiradcForm" class="form-container">
                    <!-- Readonly View of Form Data -->
                    <div class="section-header">
                        <h2>📋 Detail Dokumen</h2>
                        <p>Dokumen yang ditinjau untuk persetujuan akhir</p>
                    </div>

                    <div class="form-row">
                        <div class="form-group"><label>Unit Kerja</label><input type="text" class="form-control"
                                value="Unit Produksi A" disabled></div>
                        <div class="form-group"><label>Kategori</label><input type="text" class="form-control"
                                value="K3 - Kesehatan & Keselamatan Kerja" disabled></div>
                    </div>

                    <div class="form-group"><label>Judul / Kegiatan</label><input type="text" class="form-control"
                            value="Penilaian Risiko Unit A - Mesin Crusher" disabled></div>

                    <div class="form-row">
                        <div class="form-group"><label>Bahaya</label><input type="text" class="form-control"
                                value="Kebisingan suara mesin > 85dB" disabled></div>
                        <div class="form-group"><label>Risiko</label><input type="text" class="form-control"
                                value="Gangguan Pendengaran (NIHL)" disabled></div>
                    </div>

                    <div class="form-group"><label>Pengendalian Yang Diusulkan</label>
                        <textarea class="form-control" disabled>1. Pemasangan barrier akustik pada mesin area A.
2. Sosialisasi penggunaan ear muff wajib bagi operator.
3. Rotasi shift kerja untuk mengurangi durasi paparan.</textarea>
                    </div>

                    <div class="section-header">
                        <h2>📊 Penilaian Risiko</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>Level Risiko Awal</label><input type="text" class="form-control"
                                value="TINGGI (16)" disabled style="font-weight:bold; color:#d32f2f;"></div>
                        <div class="form-group"><label>Target Risiko</label><input type="text" class="form-control"
                                value="SEDANG (8)" disabled style="font-weight:bold; color:#f57c00;"></div>
                    </div>

                </form>

                <!-- Activity Log -->
                <div class="section-header" style="margin-top: 50px; border-left-color: #555;">
                    <h2 style="color: #555;"><i class="fas fa-history"></i> Riwayat Persetujuan</h2>
                </div>

                <div class="timeline-container">
                    <div class="timeline-item">
                        <div class="timeline-icon bg-blue"><i class="fas fa-paper-plane"></i></div>
                        <div class="timeline-content">
                            <div class="timeline-header"><span class="actor">Ahmad Rizki (Staff)</span> <span
                                    class="time">18 Okt 2025</span></div>
                            <div class="timeline-body">Mengimput data awal.</div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-icon bg-green"><i class="fas fa-check"></i></div>
                        <div class="timeline-content">
                            <div class="timeline-header"><span class="actor">Budi Santoso (Ka. Unit)</span> <span
                                    class="time">19 Okt 2025</span></div>
                            <div class="timeline-body">Dokumen disetujui dan diteruskan ke Kepala Departemen.</div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <!-- Footer Control -->
        <div class="review-footer">
            <div class="comment-section">
                <label class="comment-label">Catatan Penolakan / Tambahan (Opsional untuk Setujui, Wajib untuk
                    Tolak)</label>
                <textarea class="comment-input" id="commentBox"
                    placeholder="Tulis alasan penolakan atau catatan tambahan disini..."></textarea>
            </div>
            <div class="action-buttons">
                <button type="button" onclick="rejectDocument()" class="btn btn-reject">
                    <i class="fas fa-times"></i> Tolak & Kembalikan
                </button>
                <button type="button" onclick="approveDocument()" class="btn btn-approve">
                    <i class="fas fa-check-double"></i> Setujui & Publikasi
                </button>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');

            if (status === 'Disetujui' || status === 'Published') { // Logic for already processed
                document.querySelector('.review-footer').style.display = 'none';
                const badge = document.createElement('div');
                badge.innerHTML = '<br><div style="padding:15px; background:#d4edda; color:#155724; border:1px solid #c3e6cb; border-radius:8px; text-align:center;"><strong>✅ Dokumen ini sudah Di-Publikasi</strong></div>';
                document.querySelector('.content-area').appendChild(badge);
            }
        });

        function rejectDocument() {
            const comment = document.getElementById('commentBox').value;
            if (!comment.trim()) {
                alert('⚠️ Anda wajib mengisi catatan/alasan jika menolak dokumen ini!');
                document.getElementById('commentBox').focus();
                return;
            }

            if (confirm('Apakah Anda yakin ingin MENOLAK dokumen ini dan mengembalikannya ke User?')) {
                // Here you would typically make an AJAX request to update status
                alert(`🛑 Dokumen Ditolak.\n\nStatus diubah menjadi REVISI.\nDikembalikan ke User berisi form terakhir dengan catatan:\n"${comment}"`);
                window.location.href = "{{ route('kepala_departemen.check_documents') }}";
            }
        }

        function approveDocument() {
            const comment = document.getElementById('commentBox').value;
            let msg = '✅ Apakah Anda yakin ingin MENYETUJUI dan MEMPUBLIKASIKAN dokumen ini?';

            if (confirm(msg)) {
                // Here you would typically make an AJAX request to update status
                alert('🎉 Sukses! Dokumen telah disetujui dan kini Terpublikasi di Dashboard semua role.');
                window.location.href = "{{ route('kepala_departemen.check_documents') }}";
            }
        }
    </script>
</body>

</html>