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
            background: #fafafa;
        }

        .logout-btn {
            display: block;
            text-align: center;
            padding: 10px;
            background: #c41e3a;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
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
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
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
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="logo-section">
            <img src="{{ asset('images/logo-semen-padang.png') }}" alt="Logo">
            <div style="font-weight: 700; color: #c41e3a;">PT Semen Padang</div>
            <div style="font-size: 12px; color: #888;">Admin System</div>
        </div>
        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item">
                <i class="fas fa-users"></i> Manajemen User
            </a>
            <a href="{{ route('admin.master') }}" class="nav-item">
                <i class="fas fa-database"></i> Data Master
            </a>
        </nav>
        <div class="user-section">
            <div style="font-weight: 600; font-size: 14px;">Administrator</div>
            <div style="font-size: 12px; color: #666;">Super Admin</div>
            <a href="{{ route('logout') }}" class="logout-btn"
                onclick="event.preventDefault(); document.getElementById('logout').submit();">Keluar</a>
            <form id="logout" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
        </div>
    </aside>

    <main class="main-content">
        <div class="header">
            <h1>Selamat Datang, Admin</h1>
            <div class="date">{{ date('l, d F Y') }}</div>
        </div>

        <div class="cards">
            <div class="card">
                <div class="card-icon"><i class="fas fa-users"></i></div>
                <div class="card-info">
                    <h3>Total Users</h3>
                    <h2>1,250</h2>
                </div>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fas fa-file-contract"></i></div>
                <div class="card-info">
                    <h3>Total Dokumen</h3>
                    <h2>850</h2>
                </div>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fas fa-server"></i></div>
                <div class="card-info">
                    <h3>System Status</h3>
                    <h2 style="font-size: 18px; color: #2e7d32;">Online</h2>
                </div>
            </div>
        </div>

        <div
            style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); text-align: center; color: #888;">
            <img src="https://cdni.iconscout.com/illustration/premium/thumb/admin-panel-4439225-3687271.png" alt="Admin"
                style="width: 200px; opacity: 0.8;">
            <p>Pilih menu di samping untuk mengelola data sistem.</p>
        </div>
    </main>

</body>

</html>