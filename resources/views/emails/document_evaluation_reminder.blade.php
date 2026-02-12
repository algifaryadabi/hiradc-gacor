<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #dc2626;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            background-color: #f9fafb;
            padding: 30px;
            border: 1px solid #d1d5db;
        }

        .alert-box {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            color: #6b7280;
            font-size: 12px;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>⚠️ PERINGATAN EVALUASI TAHUNAN DOKUMEN HIRADC</h2>
        </div>

        <div class="content">
            <p>Kepada Yth. <strong>{{ $kepalaName }}</strong>,</p>

            <p>Dengan hormat,</p>

            <div class="alert-box">
                <strong>Dokumen HIRADC berikut telah melewati batas waktu evaluasi tahunan:</strong>
            </div>

            <ul>
                <li><strong>Unit Kerja:</strong> {{ $unitName }}</li>
                <li><strong>Judul Dokumen:</strong> {{ $documentTitle }}</li>
                <li><strong>Tanggal Review Terakhir:</strong> {{ $lastReviewDate }}</li>
                <li><strong>Status:</strong> Memerlukan Evaluasi Ulang</li>
            </ul>

            <p>Sesuai dengan kebijakan K3, dokumen HIRADC yang telah berusia <strong>1 tahun</strong> sejak review
                terakhir wajib dievaluasi ulang untuk memastikan relevansinya dengan kondisi terkini.</p>

            <p><strong>Tindakan yang diperlukan:</strong></p>
            <ol>
                <li>Klik tombol di bawah ini untuk melihat dokumen</li>
                <li>Evaluasi apakah dokumen masih relevan atau perlu direvisi</li>
                <li>Jika perlu revisi, tekan tombol "Evaluasi / Revisi" pada halaman dokumen</li>
                <li>Submit kembali ke approval flow untuk memperbarui tanggal review</li>
            </ol>

            <div style="text-align: center;">
                <a href="{{ $documentUrl }}" class="btn">LIHAT DOKUMEN</a>
            </div>

            <p style="margin-top: 30px; font-size: 12px; color: #6b7280;">
                <em>Email ini dikirim secara otomatis oleh Sistem HIRADC. Mohon tidak membalas email ini.</em>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} PT Kereta Api Indonesia │ Sistem Manajemen HIRADC</p>
        </div>
    </div>
</body>

</html>