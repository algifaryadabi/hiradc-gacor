<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - HIRADC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f4f6f9;
            margin: 0;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background: white;
            height: 100vh;
            position: fixed;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
        }

        .logo-section {
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .logo-section img {
            width: 50px;
            margin-bottom: 10px;
        }

        .nav-menu {
            padding: 20px 0;
            flex: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: #555;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-item i {
            width: 25px;
            text-align: center;
            margin-right: 10px;
        }

        .nav-item:hover,
        .nav-item.active {
            background: #fee2e2;
            color: #c41e3a;
            border-left: 4px solid #c41e3a;
        }

        .user-section {
            padding: 20px;
            border-top: 1px solid #eee;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .logout-btn {
            display: block;
            text-align: center;
            padding: 10px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
            margin: 0;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: #fee2e2;
            color: #c41e3a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .card-info h3 {
            margin: 0;
            font-size: 14px;
            color: #666;
            font-weight: 500;
        }

        .card-info h2 {
            margin: 5px 0 0;
            font-size: 28px;
            color: #333;
        }

        .documents-table {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .table-header {
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h2 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px 25px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        th {
            background: #fafafa;
            font-weight: 600;
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            font-size: 14px;
            color: #333;
        }

        .badge-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-approved {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .badge-pending {
            background: #fff3e0;
            color: #f57c00;
        }

        .btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 2px 4px rgba(102, 126, 234, 0.2);
        }

        .btn-detail:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
            background: linear-gradient(135deg, #5568d3 0%, #6a3f8f 100%);
        }

        .btn-detail i {
            font-size: 11px;
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        @include('admin.partials.sidebar')
    </aside>

    <main class="main-content">
        <div class="header">
            <h1>Selamat Datang, {{ Auth::user()->nama_user ?? Auth::user()->username }}</h1>
            <div class="date">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
        </div>

        <div class="cards">
            <div class="card">
                <div class="card-icon"><i class="fas fa-users"></i></div>
                <div class="card-info">
                    <h3>Total Users</h3>
                    <h2>{{ \App\Models\User::where('user_aktif', 1)->count() }}</h2>
                </div>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fas fa-file-contract"></i></div>
                <div class="card-info">
                    <h3>Total Form</h3>
                    <h2>{{ $totalDocuments ?? 0 }}</h2>
                </div>
            </div>
            <div class="card">
                <div class="card-icon" style="background: #e8f5e9; color: #2e7d32;"><i class="fas fa-check-circle"></i>
                </div>
                <div class="card-info">
                    <h3>Dipublikasi</h3>
                    <h2>{{ $publishedDocuments ?? 0 }}</h2>
                </div>
            </div>
            <div class="card">
                <div class="card-icon" style="background: #fff3e0; color: #f57c00;"><i class="fas fa-clock"></i></div>
                <div class="card-info">
                    <h3>Menunggu Approval</h3>
                    <h2>{{ $pendingDocuments ?? 0 }}</h2>
                </div>
            </div>
            <div class="card">
                <div class="card-icon" style="background: #ffebee; color: #c62828;"><i class="fas fa-edit"></i></div>
                <div class="card-info">
                    <h3>Perlu Revisi</h3>
                    <h2>{{ $revisionDocuments ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="documents-table">
            <div class="table-header">
                <h2>Form Terbaru yang Dipublikasi</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Pembuat</th>
                        <th>Unit</th>
                        <th>Tanggal Publikasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents ?? [] as $doc)
                        <tr>
                            <td>{{ $doc->kolom2_kegiatan ?? 'Form HIRADC' }}</td>
                            <td>{{ $doc->kategori }}</td>
                            <td>{{ $doc->user->nama_user ?? $doc->user->username ?? '-' }}</td>
                            <td>{{ $doc->unit->nama_unit ?? '-' }}</td>
                            <td>{{ $doc->published_at ? $doc->published_at->format('d M Y') : '-' }}</td>
                            <td><span class="badge-status badge-approved">Dipublikasi</span></td>
                            <td>
                                <a href="{{ route('documents.published', $doc->id) }}" class="btn-detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 40px; color: #999;">
                                Belum ada form yang dipublikasi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>

</html>